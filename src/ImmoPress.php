<?php

/**
 *
 */
class ImmoPress
{
    /**
     *
     * @var Immocaster_Sdk
     */
    public $api;

    /**
     *
     * @var array
     */
    public $apiKeys;

    /**
     *
     * @var array
     */
    public $apiOptions;

    /**
     *
     * @var string
     */
    public $post_type;

    /**
     *
     * @var string
     */
    public $taxonomy;

    /**
     *
     * @var array
     */
    public $terms;

    /**
     *
     * @var array
     */
    public $fields;

    /**
     *
     * @var array
     */
    public $values;

    /**
     *
     * @var string
     */
    private $db_table;

    /**
     *
     * @var string
     */
    private $db_vars;

    /**
     *
     * @var string
     */
    private $prefix;

    /**
     * Initializes the plugin by setting localization, filters, and
     * administration functions.
     */
    public function __construct()
    {
        $this->api        = null;
        $this->apiKeys    = require __DIR__ . '/../data/apiKeys.php';
        $this->apiOptions = require __DIR__ . '/../data/apiOptions.php';
        $this->post_type  = 'immopress_property';
        $this->taxonomy   = 'immopress_tax';
        $this->terms      = require __DIR__ . '/../data/terms.php';
        $this->fields     = require __DIR__ . '/../data/fields.php';
        $this->values     = require __DIR__ . '/../data/values.php';

        $this->db_table = 'immopress';
        $this->db_vars  = 'immopress_vars';
        $this->prefix   = 'immopress_';

        // set textdomain
        load_plugin_textdomain(
            'immopress',
            false,
            dirname(plugin_basename(__FILE__)) . '/languages/'
        );

        // Load JavaScript and stylesheets
        //$this->register_scripts_and_styles();

        register_activation_hook(__FILE__, array('ImmoPress', 'activate'));
        register_deactivation_hook(__FILE__, array(&$this, 'deactivate'));

        // connect with REST-API
        add_filter('init', array($this, 'connect_api'));

        // create custom post type and taxonomy
        add_filter('init', array($this, 'register_post_type'));
        add_filter('init', array($this, 'register_taxonomy'));

        // create import page
        add_action('admin_menu', array($this, 'add_import_page'));

        // create plugin settings
        add_action('admin_menu', array($this, 'add_settings_page'));
        add_action('admin_init', array($this, 'immopress_settings_api_init'));

        //create group page
        add_action('admin_menu', array($this, 'add_group_page'));

        // handle admin notices
        add_action('admin_notices', array($this, 'admin_message'));

        // handle import job
        add_action('init', array($this, 'import_expose'));

        // custom action trigger
        do_action('immopress_init', $this);

        // register scripts and styles
        add_action('init', array($this, 'register_scripts_and_styles'));

        // add 4c + is24 logo to the end of content
        add_filter('the_content', array($this, 'add_logo'), 10 );

        add_filter('init', array($this, 'activate'));

        if(in_array('advanced-custom-fields-pro/acf.php', apply_filters('active_plugins', get_option('active_plugins'))) || in_array('advanced-custom-fields/acf.php', apply_filters('active_plugins', get_option('active_plugins')))){ 
            add_filter('acf/settings/remove_wp_meta_box', '__return_false');
        }
        
    }

    /**
     * Fired when the plugin is activated.
     */
    public function activate()
    {

        $this->register_post_type();
        $this->register_taxonomy();

        // Sets the two parents
        $parents = array(
            __('Mieten', 'immopress'),
            __('Kaufen', 'immopress')
        );

        $i = 0;

        foreach ($this->terms as $parent_term) {
            // See if parent does already exists
            $parent_exists = term_exists(
                $parents[$i], // the term
                $this->taxonomy // the taxonomy
            );

            // If not, create it
            if ($parent_exists == 0) {
                $parent_exists = wp_insert_term(
                    $parents[$i], // the term
                    $this->taxonomy, // the taxonomy
                    array(
                        'description' => '',
                        'slug'        => $parents[$i]
                    )
                );
            }

            // Now that we have the parent, let's create its children
            foreach ($parent_term as $key => $value) {
                // See if child already exists.
                $child_exists = term_exists(
                    $value, // the term
                    $this->taxonomy, // the taxonomy
                    $parent_exists['term_id']
                );

                // If not, create it.
                if ($child_exists == 0) {
                    wp_insert_term(
                        $value, // the term
                        $this->taxonomy, // the taxonomy
                        array(
                            'description' => '',
                            'slug'        => sanitize_title( $value ),
                            'parent'      => $parent_exists['term_id']
                        )
                    );
                }
            }

            $i++;
        }

        // clear term object caches
        // See: http://wordpress.org/support/topic/problems-inserting-terms-in-a-hierarchical-taxonomy
        delete_option($this->taxonomy .'_children');

        // Ensure the $wp_rewrite global is loaded
        global $wp_rewrite;

        // Call flush_rules() as a method of the $wp_rewrite object
        $wp_rewrite->flush_rules();
    }

    /**
     * Fired when the plugin is deactivated.
     */
    public function deactivate()
    {
        delete_option('immopress_settings');
        delete_option('immopress_authorized');

        global $wpdb;
        $table = $wpdb->prefix . $this->db_table;

        $wpdb->query("DROP TABLE IF EXISTS $table");
    }

    /*------------------------------------------------------------------------*
     * Core Functions                                                         *
     *------------------------------------------------------------------------*/

    /**
     * registers the CPT for our objects
     */
    public function register_post_type()
    {
        // custom action trigger
        do_action('immopress_pre_register_post_type');

        // checks if CPT name is already taken. If so, choose alternative
        if (post_type_exists($this->post_type)) {
            return false;
        }

        $labels = array(
            'name'               => __('Immobilien'),
            'singular_name'      => __('Immobilie'),
            'add_new'            => __('Neu hinzufügen'),
            'add_new_item'       => __('Neue Immobilie hinzufügen'),
            'edit_item'          => __('Immobilie bearbeiten'),
            'new_item'           => __('Neue Immobilie'),
            'all_items'          => __('Alle Immobilien'),
            'view_item'          => __('Immobile anzeigen'),
            'search_items'       => __('Suche Immobilie'),
            'not_found'          => __('Nichts gefunden'),
            'not_found_in_trash' => __('Nichts im Papierkorb gefunden'),
            'parent_item_colon'  => '',
            'menu_name'          => __('Immobilien')
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array('slug' => __('immobilie')),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'supports'           => array('title', 'thumbnail', 'excerpt', 'custom-fields', 'editor', 'author'),
            'menu_icon'          => 'dashicons-admin-home'
        );

        register_post_type($this->post_type, $args);

        return true;
    }

    /**
     * registers the custom taxonomy for our CPT
     */
    public function register_taxonomy()
    {
        // checks if taxonomy name is already taken
        if (post_type_exists($this->taxonomy)) {
            return false;
        }

        $labels = array(
            'name'              => _x('Kategorien', 'taxonomy general name'),
            'singular_name'     => _x('Kategorie', 'taxonomy singular name'),
            'search_items'      => __('Suche Kategorien'),
            'all_items'         => __('Alle Kategorien'),
            'parent_item'       => __('Eltern-Kategorie'),
            'parent_item_colon' => __('Eltern-Kategorie:'),
            'edit_item'         => __('Bearbeite Kategorie'),
            'update_item'       => __('Aktualisiere Kategorie'),
            'add_new_item'      => __('Neue Kategorie'),
            'new_item_name'     => __('Neuen Kategoriename'),
            'menu_name'         => __('Kategorie')
        );

        register_taxonomy(
            $this->taxonomy,
            array($this->post_type),
            array(
                'hierarchical' => true,
                'labels'       => $labels,
                'show_ui'      => true,
                'query_var'    => true,
                'rewrite'      => array(
                    'slug'         => __('immobilien'),
                    'with_front'   => false,
                    'hierarchical' => true
                ),
                //disable editing and creating new terms – just the importer!
                'capabilities' => array(
                    'assign_terms' => 'do_not_allow',
                    'edit_terms' => 'do_not_allow'
                )
            )
        );

        return true;
    }

    /**
     * handle admin messages
     */
    public function admin_message()
    {
        if (
            isset($_POST['immopress_import_success'])
            && intval($_POST['immopress_import_success'])
        ) {
            $id = intval($_POST['immopress_import_success']);

            $args = array(
                'post_type'   => 'attachment',
                'post_parent' => $id,
                'numberposts' => -1,
                'post_status' => null
            );

            $attachments = get_posts($args);
            $count       = count($attachments);
            $title       = get_the_title($id);
            $object      = get_post_type_object($this->post_type);
            $edit_item   = $object->labels->edit_item;

            echo '<div id="message" class="updated fade"><p>';
            printf(__('<strong>%1$s</strong> erfolgreich mit %2$s Anhängen importiert.', 'immopress'), $title, $count);
            echo ' <a href="post.php?post=' . $id . '&amp;action=edit">' . $edit_item . '</a>';
            echo '</p></div>';

            unset($_POST['immopress_import_success']);
        }

        if (isset($_POST['immopress_import_fail'])) {
            echo '<div class="notice notice-error"><p>';
            printf(__('<strong>Fehler:</strong> %1$s', 'immopress'), $_POST['immopress_import_fail']);
            echo '</p></div>';

            unset($_POST['immopress_import_fail']);
        }
    }

    /**
     * adds the options item to CPT submenu
     */
    public function add_settings_page()
    {
        add_submenu_page(
            'edit.php?post_type=' . $this->post_type,
            __('Einrichten', 'immopress'),
            __('Einrichten', 'immopress'),
            'manage_options',
            'immopress_settings',
            array($this, 'options_page')
        );
    }

    /**
     * prints the admin settings page
     */
    public function options_page()
    {
        require __DIR__ . '/templates/admin/settings.php';
    }

    /**
     * create plugin settings
     */
    public function immopress_settings_api_init()
    {
        // Add the section to reading settings so we can add our
        // fields to it
        add_settings_section(
            'immopress_api_access',
            'API-Zugangsdaten',
            array($this, 'immopress_api_section_cb'),
            'immopress'
        );

        // Add the field with the names and function to use for our new
        // settings, put it in our new section
        add_settings_field(
            'immopress_key',
            'Key',
            array($this, 'immopress_field_key_cb'),
            'immopress',
            'immopress_api_access'
        );

        add_settings_field(
            'immopress_secret',
            'Secret',
            array($this, 'immopress_field_secret_cb'),
            'immopress',
            'immopress_api_access'
        );

        add_settings_field(
            'immopress_logo',
            'Logo',
            array($this, 'immopress_field_logo_cb'),
            'immopress',
            'immopress_api_access'
        );

        // Register our setting so that $_POST handling is done for us and
        // our callback function just has to echo the <input>
        register_setting('immopress_settings','immopress_settings');
    }

    /**
     * Registers settings
     */
    public function immopress_api_section_cb()
    {
        return true;
    }

    /**
     * Settings field templates
     */
    public function immopress_field_key_cb($field)
    {
        $options = get_option('immopress_settings');
        echo "<input id='immopress_settings-key' name='immopress_settings[key]' size='40' type='text' value='{$options['key']}' />";
    }

    /**
     *
     * @param type $field
     */
    public function immopress_field_secret_cb($field)
    {
        $options = get_option('immopress_settings');
        echo "<input id='immopress_settings-secret' name='immopress_settings[secret]' size='40' type='text' value='{$options['secret']}' />";
    }

    /**
     *
     * @param type $field
     */
    public function immopress_field_logo_cb( $field )
    {
        $options = get_option('immopress_settings');

        echo '<div class="immopress_settings-logo"><input id="immopress_settings-logo" name="immopress_settings[logo]" type="checkbox" value="1" ' . checked( 1, $options['logo'], false ) . ' /> <label for="immopress_settings-logo">'. __( 'Logo automatisch hinzufügen' ) .'</label></div>';
    }

    /**
     * adds the options item to CPT submenu
     */
    public function add_import_page()
    {
        if (get_option('immopress_authorized') == 'true' || $_GET['state'] == 'authorized') {
            add_submenu_page(
                'edit.php?post_type=' . $this->post_type,
                __('Exposes von immobilienscout24.de importieren', 'immopress'),
                __('Importieren', 'immopress'),
                'manage_options',
                'immopress_import',
                array($this, 'import_page')
            );
        }
    }

    /**
     * Prints the import page
     */
    public function import_page()
    {
        require __DIR__ . '/templates/admin/import.php';
    }

    /**
     * adds the groups to CPT submenu
     */
    public function add_group_page()
    {
        if (get_option('immopress_authorized') == 'true' || $_GET['state'] == 'authorized') {
            add_submenu_page(
                'edit.php?post_type=' . $this->post_type,
                __('Exposégruppen und -felder', 'immopress'),
                __('Exposégruppen und -felder', 'immopress'),
                'manage_options',
                'immopress_groups',
                array($this, 'groups_page')
            );
        }
    }

    /**
     * Prints the import page
     */
    public function groups_page()
    {
        require __DIR__ . '/templates/admin/group.php';
    }

    /**
     * registers the CPT for our objects
     */
    public function connect_api()
    {
        /* @todo fix this */
        // load SDK
        require_once __DIR__ . '/../sdk/Sdk.php';

        // connect
        $options = get_option('immopress_settings');
        $api = Immocaster_Sdk::getInstance(
            'is24',
            $options['key'],
            $options['secret']
        );
        $api->setRequestUrl('live');

        //$api->setContentResultType( ( $settings['json'] ? 'json' : 'xml') );

        $api_db = array(
            'mysql',
            DB_HOST,
            DB_USER,
            DB_PASSWORD,
            DB_NAME
        );

        global $wpdb;

        $api->setDataStorage(
            $api_db,
            $wpdb->prefix . $this->db_vars,
            $wpdb->prefix . $this->db_table
        );

        // custom action trigger
        do_action('immopress_connect_api', $api);

        $this->api = $api;

        return $api;
    }

    /**
     * Requests API response for given $exposeID
     * Returns result as ( object )
     */
    private function get_expose($exposeID)
    {
        $exposeID = intval($exposeID);

        $response = $this->api->getExpose(array(
            'exposeid' => $exposeID
        ));

        // parse XML result into PHP object
        $xml  = new SimpleXMLElement($response);
        $data = $this->object_to_array($xml);

        // Check for errors/invalid data

        if (isset($data['message'])) {
            if ('ERROR_RESOURCE_NOT_FOUND' === $data['message']['messageCode']) {
                return false;
            }
        }

        if (!isset($data['realEstate'])) {
            return false;
        }

        /**
         * @todo For some reason the xsi.type attribute gets lost when parsing from XML.
         * As a workaround lets request via json and convert that response to an array
         * so we can get to the "@xsi.type" key.
         * Yes, this is all bullshit.
         */
        /*$json_api = $this->connect_api( array( 'json' => true ) ); // set api to json
        $json_data = $this->object_to_array( json_decode( $json_api->getExpose( $args ) ) );
        $xsi_type = $json_data["expose.expose"]["realEstate"]["@xsi:type"];
        $data['realEstate']["@xsi.type"] = $xsi_type;
        $this->connect_api(); // reset api*/
        $resSplit        = explode('xsi:type="expose:', $response);
        $exposeTypeSplit = explode('"', $resSplit[1]);
        $exposeType      = $exposeTypeSplit[0];
        $data['realEstate']['exposeType'] = $exposeType;
        $data['realEstate']['exposeID']   = $exposeID;

        // allow plugins/themes to alter the value
        $data = apply_filters( 'immopress_get_expose', $data, $response );

        return $data;
    }

    /**
     * Requests API response for given $exposeID
     * Returns result as ( object )
     */
    private function get_attachments($exposeID)
    {
        $exposeID = intval($exposeID);

        $response = $this->api->getAttachment(array(
            'exposeid' => $exposeID
        ));

        // parse XML result into PHP array
        $data = new SimpleXMLElement($response);
        $data = $this->object_to_array($data);

        // Correct nested array.
        $data = (isset($data['attachment'][0]) ? $data['attachment'] : array($data['attachment']));

        // allow plugins/themes to alter the value
        $data = apply_filters('immopress_get_attachments', $data, $response);

        // if the realEstate array is not present we know
        // something must have gone wrong and return false
        return ($data == '' ? false : $data);
    }

    /**
     *
     * @param array $expose
     */
    private function clean_expose_data(array $expose)
    {
        // Let's loop through the first level of $expose['realEstate'].
        // But wait, not everything we want is on at the first level.
        // Some values are hidden deeper inside the array.
        // This array locates these values
        $digDeep = array(
            'city'           => $this->array_get($expose, 'realEstate.address.city'), // Stadt
            'courtage'       => $this->array_get($expose,'realEstate.courtage.courtage'), // Provisionshöhe
            'courtageNote'   => $this->array_get($expose,'realEstate.courtage.courtageNote'), // Provisionshinweis
            'firingTypes'    => $this->array_get($expose,'realEstate.firingTypes.firingType'), // Befeuerungsart
            'hasCourtage'    => $this->array_get($expose,'realEstate.courtage.hasCourtage'), // Provision
            'houseNumber'    => $this->array_get($expose,'realEstate.address.houseNumber'), // Hausnummer
            'latitude'       => $this->array_get($expose,'realEstate.address.wgs84Coordinate.latitude'), // Breitengrad
            'longitude'      => $this->array_get($expose,'realEstate.address.wgs84Coordinate.longitude'), // Längengrad
            'postcode'       => $this->array_get($expose,'realEstate.address.postcode'), // Postleitzahl
            'street'         => $this->array_get($expose,'realEstate.address.street'), // Straße
            'price'          => $this->array_get($expose,'realEstate.price.value'), // Hauspreis
            'quarter'        => $this->array_get($expose,'realEstate.address.quarter'), // Viertel
            'contactDetails' => serialize($expose['contactDetails']) // Kontaktdaten
        );

        $fields = array_merge($expose['realEstate'], $digDeep);

        $fieldsClean = array_filter($fields, function ($value) {
            if (!is_string($value) && !is_numeric($value)) {
                return false;
            }

            if ('' == $value) {
                return false;
            }

            return true;
        });

        ksort($fieldsClean);

        return $fieldsClean;
    }

    function array_get($array, $key, $default = null)
    {
        if (is_null($key)) {
            return $array;
        }
        if (isset($array[$key])) {
            return $array[$key];
        }
        foreach (explode('.', $key) as $segment) {
            if (!is_array($array) || !array_key_exists($segment, $array)) {
                return $this->value($default);
            }
            $array = $array[$segment];
        }
        return $array;
    }

    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }

    /**
     *
     * @param type $s
     */
    private function errorNotify($s)
    {
        $_POST['immopress_import_fail'] = $s;
    }

    /**
     * Handles import process based on passed in expose ID
     */
    public function import_expose($exposeID)
    {

        $exposeID = intval(($exposeID) ? $exposeID : $_POST['exposeID']);

        if (false === ($exposeID > 0)) {
            return false;
        }

        $expose = $this->get_expose($exposeID);

        // allow plugins/themes to alter value
        #$expose = apply_filters('immopress_import_fields', $expose);

        // get expose
        if (false === $expose) {
            $this->errorNotify(
                sprintf(__('Die Immobilie mit ID %s konnte nicht gefunden werden.', 'immopress'), $exposeID)
            );
            return false;
        }

        unset($exposeID);

        $data = $this->clean_expose_data($expose);

        #unset($expose);

        // ---------------------------------------------------------------------

        if (false) {
            header('Content-Type: text/html; charset=utf-8');

            echo '<h1>Import von Exposé ' . $data['exposeID'] . '</h1>';

            echo '<p>Exposé-Type: ' . $data['exposeType'] . '</p>';

            echo '<table border=1>';
            echo '<tr>';
            echo '<th>Schlüssel</th>';
            echo '<th>Übersetzung</th>';
            echo '<th>Wert</th>';
            echo '</tr>';
            foreach ($data as $key => $value) {
                echo '<tr><td>' . $key . '</td>';

                $trans = '<span style="background: red;">*** FEHLT ***</span>';

                if (isset($this->apiKeys[$data['exposeType']][$key])) {
                    $trans = $this->apiKeys[$data['exposeType']][$key];
                }

                echo '<td>' . $trans . '</td>';
                echo '<td>' . $value . '</td></tr>';
            }
            echo '</table>';

            echo '<h2>apiKeys</h2>';

            echo '<pre>';
            var_dump($this->apiKeys[$data['exposeType']]);
            echo '</pre>';

            echo '<h2>$expose</h2>';

            echo '<pre>';
            var_dump($expose);
            echo '</pre>';

            exit;
        }

        // ---------------------------------------------------------------------

        // Create new WP post
        $postId = wp_insert_post(array(
            'post_name'  => sanitize_title($data['title']),
            'post_title' => $data['title'],
            'post_type'  => $this->post_type
        ));

        if (false === (is_int($postId) && $postId > 0)) {
            return false;
        }

        $valArray = get_option('immopress_values');

        // Set custom fields
        foreach ($data as $key => $value) {
            update_post_meta($postId, $key, $value);

            if(!array_key_exists($value, $valArray)  && $this->check_value($value, $key)) {
                $valArray[$value] = '';
            }
        }

        update_option('immopress_values', $valArray);

        $this->set_post_terms($data, $postId);

        // write expose data to database
        update_post_meta($postId, 'immopress_fields', $expose);

        // get the attachments
        $this->import_attachments($data['exposeID'], $postId);

        // tell user success
        $_POST['immopress_import_success'] = $postId;

        // custom action trigger
        do_action('immopress_import_expose', $postId);

        return $postId;
    }

    private function check_value($val, $key) {
        if(is_numeric($val)) {
            return false;
        }

        if (strpos($val, ' ') !== false || strpos($val, '://') !== false) {
            return false;
        }

        if(strpos($key, 'Date') !== false || strpos($key, 'city') !== false) {
            return false;
        }

        return true;
    }

    /**
     * imports attachments, assigns to post
     */
    private function import_attachments($exposeID, $post_id)
    {
        if (!isset($exposeID) || !isset($post_id)) {
            return false;
        }

        // get attachment urls
        $attachments = $this->get_attachments($exposeID);

        // vars
        $set_thumb      = false;
        $attachment_ids = array();
        $uploads        = wp_upload_dir();

        foreach ($attachments as $attachment) {
            try {
                // get image url
                $length    = count($attachment["urls"]["url"]);
                $image_url = $attachment["urls"]["url"][$length - 1]["@attributes"]["href"]; // get HQ image version
                $image_url = strtok($image_url, '?'); // remove URL Parameter (legacy)
                $image_url = substr($image_url, 0, strpos($image_url, '/ORIG')); // remove everything after file url
                $image_url = stripslashes($image_url);

                /* @todo 87869388 */
                if ('' === trim($image_url)) {
                    continue;
                }

                // prepare image save
                $filename          = wp_unique_filename($uploads['path'], basename($image_url));
                $fullpath_filename = $uploads['path'] . "/" . $filename;
                $wp_filetype       = wp_check_filetype($filename, null);

                // get remote image
                $image_string = $this->fetch_image($image_url);

                // put image
                        $xpath = $uploads['path'] . "/" . $filename;
                        $xdir  = dirname($xpath);

                        if (false === file_exists($xdir)) {
                            $xret = mkdir($xdir, 0755, true);
                        }

                        if (isset($xret) && false === $xret) {
                            throw new Exception('Could not create directory "'.$xdir.'"');
                        }

                $file_saved = file_put_contents($xpath, $image_string);

                if (!$file_saved) {
                    throw new Exception(__('Anhang konnte nicht übertragen werden. ("' . $image_url . '")'));
                }

                // prepare and insert new attachment
                $new_attachment = array(
                     'post_mime_type' => $wp_filetype['type'],
                     'post_title'     => $this->array_get($attachment, 'title'),
                     'post_content'   => serialize($attachment),
                     'post_status'    => 'inherit',
                     'guid'           => $uploads['url'] . "/" . $filename
                );
                $attach_id = wp_insert_attachment($new_attachment, $fullpath_filename, $post_id);

                if (!$attach_id) {
                    throw new Exception(__('"Anhang konnte nicht in die Datenbank geschrieben werden."'));
                }

                // handle attachment meta
                require_once ABSPATH . 'wp-admin' . '/includes/image.php';
                $attach_data = wp_generate_attachment_metadata($attach_id, $fullpath_filename);
                wp_update_attachment_metadata($attach_id,  $attach_data);

                $attachment_ids[] = $attach_id;

                // assign floorplan
                if(isset($attachment) && is_object($attachment)) {
                    if ($attachment->floorplan === true) {
                        update_post_meta($post_id, 'immopress_floorplan', $attach_id);
                    }
                }

                // make first image post thumbnail
                if (!$set_thumb) {
                    update_post_meta($post_id, '_thumbnail_id', $attach_id);
                    $set_thumb = true;
                }
            } catch (Exception $e) {
                $this->errorNotify($e->getMessage());
            }
        }

        return (count($attachment_ids) == 0 ? false : $attachment_ids);
    }

    /**
     *
     * @param type $xsiType
     * @param type $id
     * @return boolean
     */
    private function set_post_terms($data, $id)
    {

        $xsiType = $data['exposeType'];

        if (!isset($xsiType)) {
            return false;
        }

        // get term name key
        $xsi_type = $xsiType;
        //$term_key = $this->from_camel_case(str_replace('expose:', '', $xsi_type));
        $term_key = strtoupper($xsiType);

        $immo_terms = get_option('immopress_cats');

        $comtype = NULL;

        //so here we have to check which type of expose: buy or rent
        if(array_key_exists('commercializationType', $data)) {
            $comtype = strtolower($data['commercializationType']);
        } else {
            if ((strpos($term_key, 'RENT') !== false) || (strpos($term_key, 'BUY') !== false)) {
                $comtype = 'buy';
                if ((strpos($term_key, 'RENT') !== false)) {
                    $comtype = 'rent';
                }
            } else {
                if(array_key_exists('calculatedTotalRentScope', $data)) {
                    $comtype = 'buy';
                    if (strpos($term_key, 'RENT') !== false) {
                        $comtype = 'rent';
                    }
                }
            }
        }


        if($comtype == 'rent') {
            $term_nicename = 'Mieten';
        } else {
            $term_nicename = 'Kaufen';
        }
        $term_parent   = term_exists($term_nicename, $this->taxonomy);

        //check if type exists
        if(!array_key_exists($term_key, $immo_terms[$comtype])) {
            wp_insert_term( $term_key, $this->taxonomy, $args = array('parent' => $term_parent['term_id']) );
            $immo_terms[$comtype][$term_key] = array(
                'fields' => array(),
                'translation' => ''
            );
            update_option('immopress_cats', $immo_terms);
        }

        //add post to term
        $searched_term = term_exists($term_key, $this->taxonomy);
        wp_set_post_terms($id, array(intval($term_parent['term_id']), intval($searched_term['term_id'])), $this->taxonomy);


        //add new fields immo_terms
        foreach ($data as $key => $field) {
            if(!array_key_exists($key, $immo_terms[$comtype][$term_key]['fields'])) {
                $immo_terms[$comtype][$term_key]['fields'][$key] = array(
                    'translation' => NULL,
                    'group' => NULL,
                    'unit' => 'none'
                );
            }
        }

        update_option('immopress_cats', $immo_terms);

        /*

        // get term cat nice name
        $term_parent          = (array_key_exists($term_key, $this->terms['rent'])) ? 'rent' : 'buy';
        $term_parent_nicename = ($term_parent == 'rent') ? __('Mieten', 'immopress') : __('Kaufen', 'immopress');
        $term_arr = $term_parent;

        $immo_terms = get_option('immopress_cats');

        // get term parent – hier vielleicht key verwenden?
        $term_nicename = $immo_terms[$term_parent][$term_key];

        $term_parent   = term_exists($term_parent_nicename, $this->taxonomy);

        if($term_nicename == NULL) :
            wp_insert_term( $term_key, $this->taxonomy, $args = array('parent' => $term_parent['term_id']) );
            $immo_terms[$term_arr][$term_key] = $term_key;

            update_option('immopress_cats', $immo_terms);

            $term_nicename = $immo_terms[$term_arr][$term_key];
        endif;

        // set term parent # Y U NO WORK?!?
        // wp_set_object_terms( $id, intval( $term_parent['term_id'] ), $this->taxonomy );

        // get child term
        $term_child_exists = term_exists($term_nicename, $this->taxonomy, $term_parent['term_id']);

        // set child term
        wp_set_object_terms($id, intval($term_child_exists['term_id']), $this->taxonomy);*/

        return true;
    }

    /**
     * adds 4c + is24 logos
     */
    public function add_logo($content)
    {
        //global $post;

        $immopress_settings = get_option('immopress_settings');

        if(array_key_exists('logo', $immopress_settings)) {

            if ($immopress_settings['logo'] == '1') {
                $notice = '<p><img style="margin-right: 30px;" src="' . plugins_url('', dirname(__FILE__)) . '/assets/images/api-logo.png" alt="In Zusammenarbeit mit Immobilienscout24" />';
                $notice .= '<a title="WordPress Integration und Import ImmoPress von 4c media" href="http://www.cccc.de/"><img src="' . $this->dir . '/assets/images/plugin-logo.png" alt="ImmoPress by 4c media" /></a></p>';

                return $content . $notice;
            }
        }

        return $content;
    }

    /*------------------------------------------------------------------------*
     * Private Functions                                                      *
     *------------------------------------------------------------------------*/

    /**
     * Tests if application has connection to API
     */
//    private function is_connected()
//    {
//        // Place an example request
//        $response = $this->api->getRegions(array('q' => 'Berlin'));
//
//        $data = new SimpleXMLElement($response);
//        $data = $this->object_to_array($data);
//
//        // we got 'region' back. We're online!
//        if ($data['region']) {
//            return true;
//        }
//
//        // 'message' means no.
//        if ($data['message']) {
//            return false;
//        }
//
//        return false;
//    }

    /**
     * register_scripts_and_styles
     */
    public function register_scripts_and_styles()
    {
        if (is_admin()) {
            wp_register_script('immopress-admin-script', plugins_url( 'assets/js/admin.js', dirname(__FILE__) ), array('jquery'),'1.0', true);
            wp_enqueue_script('immopress-admin-script');
            wp_register_style( 'mmopress-admin-style', plugins_url( 'assets/css/admin.css', dirname(__FILE__) ) );
            wp_enqueue_style( 'mmopress-admin-style' );
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script('jquery-ui-tabs');

            $wp_scripts = wp_scripts();
            wp_enqueue_style(
                'jquery-ui-theme-base',
                sprintf(
                    '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', // working for https as well now
                    $wp_scripts->registered['jquery-ui-core']->ver
                )
            );
        }
    }

    /**
     * Helper function for registering and enqueueing scripts and styles.
     *
     * @name      The ID to register with WordPress
     * @file_path The path to the actual file
     * @is_script Optional argument for if the incoming file_path is a JavaScript source file.
     */
    private function load_file($name, $file_path, $is_script = false)
    {
        $url  = plugins_url($file_path, __FILE__);
        $file = plugin_dir_path(__FILE__) . $file_path;

        if (file_exists($file)) {
            if ($is_script) {
                wp_register_script($name, $url, array('jquery'));
                wp_enqueue_script($name);
            } else {
                wp_register_style($name, $url);
                wp_enqueue_style($name);
            }
        }
    }

    /**
     * Gets $url either by curl or file_get_contents
     */
    private function fetch_image($url)
    {
        if (function_exists('curl_init')) {
            return $this->curl_fetch_image($url);
        } elseif (ini_get('allow_url_fopen')) {
            return $this->fopen_fetch_image($url);
        }
    }

    /**
     *
     * @param string $url
     * @return string
     */
    private function curl_fetch_image($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $image = curl_exec($ch);
        curl_close($ch);

        return $image;
    }

    /**
     *
     * @param string $url
     * @return string
     */
    private function fopen_fetch_image($url)
    {
        $image = file_get_contents($url, false);

        return $image;
    }

    /**
     * convert camelcase strings to uppcase with underscore
     * Based on: http://www.paulferrett.com/2009/php-camel-case-functions/
     */
    private function from_camel_case($str)
    {
        $str[0] = strtolower($str[0]);
        $func   = create_function('$c', 'return "_" . strtolower($c[1]);');

        return strtoupper(preg_replace_callback('/([A-Z])/', $func, $str));
    }

    /**
     * Function to Convert stdClass Objects to Multidimensional Arrays
     * Source: http://www.if-not-true-then-false.com/2009/php-tip-convert-stdclass-object-to-multidimensional-array-and-convert-multidimensional-array-to-stdclass-object/
     */
    private function object_to_array($d)
    {
        if (is_object($d)) {
            $d = get_object_vars($d);
        }

        if (is_array($d)) {
            return array_map(array($this, 'object_to_array'), $d);
        }

        return $d;
    }
}

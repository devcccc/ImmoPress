<?php
/*
Plugin Name: ImmoPress
Plugin URI:  http://www.cccc.de/
Description: Erlaubt den einfachen Expose-Import von Immobilienscout24.de in WordPress.
Version: 0.0.4
Author:      4c media
Author URI:  http://www.cccc.de/
License:     GPL2

Copyright 2012 4c media (dev@cccc.de)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// remove when deploying
// define( 'WP_DEBUG', true ); 

// instantiate class
$ImmoPress = new ImmoPress();

// provides an interface for typical methods that you would use to access your data
require 'core/functions.php';

class ImmoPress {
	
	var $post_type;
	var $taxonomy;
	var $api;
	var $fields;
	var $values;
	var $terms;
	
	private $dir;
	private $path;
	private $site_url;
	private $wpadmin_url;
	private $options_url;
	private $db_vars;
	private $db_table;
	private $prefix;
		

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {
		
		// set class variables
		$this->path = dirname( __FILE__ ).'';
		$this->dir = plugins_url( '', __FILE__ );
		$this->site_url = get_bloginfo( 'url' );
		$this->dir_name = basename( dirname( __FILE__ ) );
		$this->wpadmin_url = admin_url();
		$this->prefix = 'immopress_';
		$this->post_type = 'immopress_property';
		$this->taxonomy = 'immopress_tax';
		$this->options_url = admin_url() .'edit.php?post_type='. $this->post_type;
		$this->db_table = 'immopress';
		$this->db_vars = 'immopress_vars';
		
		// translates abstract field and value names into human readable form
		include('core/translation.php');

		// set textdomain
		load_plugin_textdomain( 'immopress', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

    	// Load JavaScript and stylesheets
		$this->register_scripts_and_styles();
				
		register_activation_hook( __FILE__, array( &$this, 'activate' ) );
		register_deactivation_hook( __FILE__, array( &$this, 'deactivate' ) );
		
		// connect with REST-API
		add_filter( 'init', array( $this, 'connect_api' ) );
	    
	    // create custom post type and taxonomy
	    add_filter( 'init', array( $this, 'register_post_type' ) );
	    add_filter( 'init', array( $this, 'register_taxonomy' ) );
	    add_filter( 'admin_head', array( $this, 'menu_icon' ) );
	    
	    // create import page
	    add_action( 'admin_menu', array( $this, 'add_import_page' ) );
	    
	    // create plugin settings
	    add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
	    add_action( 'admin_init', array( $this, 'immopress_settings_api_init' ) );
	    
	    // handle admin notices
	    add_action('admin_notices', array( $this, 'admin_message' ) );
	    
	    // handle import job
	    add_action( 'init', array( $this, 'import_expose' ) );
	    
	    // custom action trigger
	    do_action( 'immopress_init', $this );
	    
	    // add 4c + is24 logo to the end of content
	    add_filter('the_content', array( $this, 'add_logo'), 10  );
	    	    	    	    
	    return true;

	} // end constructor

	/**
	 * Fired when the plugin is activated.
	 *
	 * @params	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
	 */
	function activate( $network_wide ) {
	
	    $this->register_post_type();
	    $this->register_taxonomy();

	    // Sets the two parents
	    $parents = array(
	    	__( 'Mieten', 'immopress' ),
	    	__( 'Kaufen', 'immopress' )
	    );
	    $i = 0;
	    
	    foreach ( $this->terms as $parent_term ) {
	    	
	    	// See if parent does already exists
	    	$parent_exists = term_exists( 
	    		$parents[$i], // the term 
	    		$this->taxonomy // the taxonomy
	    	);
	    	
	    	// If not, create it
	    	if ( $parent_exists == 0 ) {
	    	    
	    	    $parent_exists = wp_insert_term(
	    	    $parents[$i], // the term 
	    	    $this->taxonomy, // the taxonomy
	    	    	array(
	    	    		'description'=> '',
	    	    		'slug' => $parents[$i]
	    	    	)
	    	    );
	    	}
	    	
	    	// Now that we have the parent, let's create its children
	    	foreach ( $parent_term as $key => $value ) {
	    		
	    		// See if child already exists.
	    		$child_exists = term_exists( 
	    			$value, // the term 
	    			$this->taxonomy, // the taxonomy
	    			$parent_exists['term_id']
	    		);
	    		
	    		// If not, create it.
	    		if ( $child_exists == 0 ) {
	    			wp_insert_term(
	    			$value, // the term 
	    			$this->taxonomy, // the taxonomy
	    				array(
	    					'description'=> '',
	    					'slug' => sanitize_title( $value ),
	    					'parent'=> $parent_exists['term_id']
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
		
	} // end activate

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @params	$network_wide	True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog 
	 */
	function deactivate( $network_wide ) {
	
		delete_option( 'immopress_settings' );
		delete_option( 'immopress_authorized' );
		
		global $wpdb;
		$table = $wpdb->prefix . $this->db_table;

		$wpdb->query("DROP TABLE IF EXISTS $table");
		
	} // end deactivate
	
	/*--------------------------------------------*
	 * Core Functions
	 *---------------------------------------------*/

	/** 
	 * registers the CPT for our objects
	 */				
	function register_post_type() {
		
		// custom action trigger
		do_action( 'immopress_pre_register_post_type' );
		
		// checks if CPT name is already taken. If so, choose alternative
		if ( post_type_exists( $this->post_type ) )
			return false;
		
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
			'rewrite'            => array( 'slug' => __( 'immobilie' ) ),
			'capability_type'    => 'post',
			'has_archive'        => true, 
			'hierarchical'       => false,
			'supports'           => array( 'title', 'thumbnail', 'excerpt', 'custom-fields', 'editor', 'author' )
		); 
		
		register_post_type( $this->post_type, $args );
		
		return true;
		
	} // register_post_type 	
		
	/** 
	 * registers the custom taxonomy for our CPT
	 */	
	 	
	function register_taxonomy() {
		
		// checks if taxonomy name is already taken
		if ( post_type_exists( $this->taxonomy ) ) 
			return false;
		 
		$labels = array(
			'name'              => _x( 'Kategorien', 'taxonomy general name' ),
			'singular_name'     => _x( 'Kategorie', 'taxonomy singular name' ),
			'search_items'      => __( 'Suche Kategorien' ),
			'all_items'         => __( 'Alle Kategorien' ),
			'parent_item'       => __( 'Eltern-Kategorie' ),
			'parent_item_colon' => __( 'Eltern-Kategorie:' ),
			'edit_item'         => __( 'Bearbeite Kategorie' ), 
			'update_item'       => __( 'Aktualisiere Kategorie' ),
			'add_new_item'      => __( 'Neue Kategorie' ),
			'new_item_name'     => __( 'Neuen Kategoriename' ),
			'menu_name'         => __( 'Kategorie' ),
		); 	
		
		register_taxonomy( $this->taxonomy, array( $this->post_type ), array(
			'hierarchical' => true,
			'labels'       => $labels,
			'show_ui'      => true,
			'query_var'    => true,
			'rewrite'      => array( 'slug' => __( 'immobilien' ), 'with_front' => false, 'hierarchical' => true )
		));
		
		return true;
		
	} // end register_taxonomy
	
	/** 
	 * handle admin messages
	 */	
	 
	function admin_message() {
		
		if ( isset( $_POST['immopress_import_success'] ) && intval( $_POST['immopress_import_success'] ) ) {
									
			$id = $_POST['immopress_import_success'];
			$args = array( 
				'post_type' => 'attachment', 
				'post_parent' => $id,
				'numberposts' => -1, 
				'post_status' => null); 
				
			$attachments = get_posts( $args );
			$count = count( $attachments );
			$title = get_the_title( $id );
			$object = get_post_type_object( $this->post_type );
			$edit_item = $object->labels->edit_item;
						
			echo '<div id="message" class="updated fade"><p>';
			printf(__('<strong>%1$s</strong> erfolgreich mit %2$s Anhängen importiert.', 'immopress' ), $title, $count );
			echo " <a href='post.php?post=$id&action=edit'>$edit_item.</a></p></div>";
				
			unset($_POST['immopress_import_success']);
		}
				
	} // end admin_message
			
	/** 
	 * handle menu icon and hover effect
	 */	
	function menu_icon() {
	
		global $post_type; ?>
			
		<style>

		<?php if ( ( $_GET['post_type'] == $this->post_type ) || ( $post_type == $this->post_type ) ) : ?>

			#icon-edit { 
				background: transparent url('<?php echo $this->dir .'/images/menu_icon.png'; ?>') no-repeat center top;
				margin-right: 0; 
			}		
			
		<?php endif; ?>
		
			#adminmenu #menu-posts-<?php echo $this->post_type; ?> div.wp-menu-image {
				background: transparent url("<?php echo $this->dir .'/images/menu_icon.png'; ?>") no-repeat center -34px;
			}
			#adminmenu #menu-posts-<?php echo $this->post_type; ?>:hover div.wp-menu-image,
			#adminmenu #menu-posts-<?php echo $this->post_type; ?>.wp-has-current-submenu div.wp-menu-image {
				background: transparent url("<?php echo $this->dir .'/images/menu_icon.png'; ?>") no-repeat center -2px;
			}	
		</style> 
		
	<?php } // end menu_icon
	
	/** 
	 * adds the options item to CPT submenu
	 */
	function add_settings_page() {
		add_submenu_page(
			'edit.php?post_type='. $this->post_type, 
			__( 'Einrichten', 'immopress' ), 
			__( 'Einrichten', 'immopress' ), 
			'manage_options', 
			'immopress_settings', 
			array( $this, 'options_page') );
	} // end add_settings_page
	
	/** 
	 * prints the admin settings page
	 */
	function options_page() {		
		require 'core/admin/settings.php';
	} // end options_page
	
	/** 
	 * create plugin settings
	 */
	function immopress_settings_api_init() {
	
		// Add the section to reading settings so we can add our
		// fields to it
		add_settings_section('immopress_api_access',
			'API-Zugangsdaten',
			array( $this, 'immopress_api_section_cb' ),
			'immopress');
		
		// Add the field with the names and function to use for our new
		// settings, put it in our new section
		add_settings_field('immopress_key',
			'Key',
			array( $this, 'immopress_field_key_cb' ),
			'immopress',
			'immopress_api_access'
			);
			
		add_settings_field('immopress_secret',
			'Secret',
			array( $this, 'immopress_field_secret_cb' ),
			'immopress',
			'immopress_api_access'
			);
		
		add_settings_field('immopress_logo',
			'Logo',
			array( $this, 'immopress_field_logo_cb' ),
			'immopress',
			'immopress_api_access'
			);
		
		// Register our setting so that $_POST handling is done for us and
		// our callback function just has to echo the <input>
		register_setting( 'immopress_settings','immopress_settings' );
	
	} // end immopress_settings_api_init
	
	/** 
	 * Registers settings
	 */
	function immopress_api_section_cb() {
		return true;
	}
	
	/** 
	 * Settings field templates
	 */
	function immopress_field_key_cb( $field ) {

		$options = get_option( 'immopress_settings' ); 
		echo "<input id='immopress_settings-key' name='immopress_settings[key]' size='40' type='text' value='{$options['key']}' />";
	}
	function immopress_field_secret_cb( $field ) {
	
		$options = get_option( 'immopress_settings' ); 
		echo "<input id='immopress_settings-secret' name='immopress_settings[secret]' size='40' type='text' value='{$options['secret']}' />";
	}
	function immopress_field_logo_cb( $field ) {
	
		$options = get_option( 'immopress_settings' );

		echo '<div class="immopress_settings-logo"><input id="immopress_settings-logo" name="immopress_settings[logo]" type="checkbox" value="1" ' . checked( 1, $options['logo'], false ) . ' /> <label for="immopress_settings-logo">'. __( 'Logo automatisch hinzufügen' ) .'</label></div>';
	}
	
	/** 
	 * adds the options item to CPT submenu
	 */
	function add_import_page() {
				
		if ( get_option('immopress_authorized') == 'true' || $_GET['state'] == 'authorized' ) {
			add_submenu_page(
				'edit.php?post_type='. $this->post_type, 
				__( 'Exposes von immobilienscout24.de importieren', 'immopress' ), 
				__( 'Importieren', 'immopress' ), 
				'manage_options', 
				'immopress_import', 
				array( $this, 'import_page') 
			);
		}
	}
	
	/** 
	 * prints the admin settings page
	 */
	function import_page() {		
		require 'core/admin/import.php';
	}
	
	/** 
	 * registers the CPT for our objects
	 */	
	function connect_api( $settings = array() ) {
		
		// load SDK
		require_once( 'sdk/Sdk.php' );
		
		// connect
		$options = get_option('immopress_settings'); 
		$api = Immocaster_Sdk::getInstance(
			'is24',
			$options['key'],
			$options['secret']
		);
		$api->setRequestUrl( 'live' );
		
		$api->setContentResultType( ( $settings['json'] ? 'json' : 'xml') );
		
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
		do_action( 'immopress_connect_api', $api );
		 
		$this->api = $api;
		
		return $api;
	
	} // end connect_api
	
	/**
	 * Requests API response for given $exposeID
	 * Returns result as ( object )
	 */
	function get_expose( $exposeID ) {
			
		$args = array(
			'exposeid' => intval( $exposeID )
		);
		$response = $this->api->getExpose( $args );
		
		// parse XML result into PHP object
		$data = new SimpleXMLElement( $response );
		$data = object_to_array( $data );
		
		/**
		 * For some reason the xsi.type attribute gets lost when parsing from XML.
		 * As a workaround lets request via json and convert that response to an array
		 * so we can get to the "@xsi.type" key.
		 * Yes, this is all bullshit.
		 */ 
		$json_api = $this->connect_api( array( 'json' => true ) ); // set api to json
		$json_data = object_to_array( json_decode( $json_api->getExpose( $args ) ) );
		$xsi_type = $json_data["expose.expose"]["realEstate"]["@xsi.type"];
		$data['realEstate']["@xsi.type"] = $xsi_type;
		$this->connect_api(); // reset api
		
		// allow plugins/themes to alter the value
		$data = apply_filters( 'immopress_get_expose', $data, $response );
		
		// if the realEstate array is not present we know 
		// something must have gone wrong and return false
		return ( $data['realEstate'] != '' ? $data : false );

	} // end get_expose
	
	/**
	 * Requests API response for given $exposeID
	 * Returns result as ( object )
	 */
	function get_attachments( $exposeID ) {
			
		$args = array(
			'exposeid' => intval( $exposeID )
		);
		$response = $this->api->getAttachment( $args );
		
		// parse XML result into PHP array
		$data = new SimpleXMLElement( $response );
		$data = object_to_array( $data );
		
		// Correct nested array.
		$data = ( isset( $data['attachment'][0] ) ? $data['attachment'] : array( $data['attachment'] ) );
		
		// allow plugins/themes to alter the value
		$data = apply_filters( 'immopress_get_attachments', $data, $response );
		
		// if the realEstate array is not present we know 
		// something must have gone wrong and return false
		return ( $data == '' ? false : $data );

	} // end get_attachment
	
	/**
	 * Handles import process based on passed in expose ID
	 */
	function import_expose( $exposeID ) {
						
		$exposeID = ( $exposeID ? $exposeID : $_POST['exposeID'] );

		if ($exposeID == '')
			return false;
		
		// get expose								
		if ( ! $expose = $this->get_expose( $exposeID ) )
			return false;
										
		// Create new post array
		$new_post = array(
			'post_name'  => sanitize_title( $expose['realEstate']['title'] ),
			'post_title' => $expose['realEstate']['title'],
			'post_type'  => $this->post_type	
		); 
		$id = wp_insert_post( $new_post );
				
		// auto-assign post terms based on expose data
		$this->set_post_terms( $expose, $id );
		
		// set custom fields
		$this->add_post_meta( $expose, $id );
						
		// allow plugins/themes to alter value
		$expose = apply_filters( 'immopress_import_fields', $expose );
		
		// write expose data to database
		update_post_meta( $id, 'immopress_fields', $expose );
		update_post_meta( $id, 'exposeID', $exposeID );		
				
		// get the attachments
		$this->import_attachments( $exposeID, $id );
		
		// tell user success
		$_POST['immopress_import_success'] = $id;		
		
		// custom action trigger
		do_action( 'immopress_import_expose', $id );
		
		return ( $id == '' ? false : $id );
			
	} // end import_expose
	
	/**
	 * imports attachments, assigns to post
	 */
	function import_attachments( $exposeID, $post_id ) {
		
		if ( !isset( $exposeID ) || !isset( $post_id ) ) 
			return false;
						
		// get attachment urls
		$attachments = $this->get_attachments( $exposeID );
								
		// vars
		$set_thumb = false;
		$attachment_ids = array();
		$uploads = wp_upload_dir();
		
		foreach ( $attachments as $attachment ) {
									
			try {
				                                
			    // get image url
			    $length = count( $attachment["urls"]["url"] );
			    $image_url = $attachment["urls"]["url"][ $length - 1 ][ "@attributes" ][ "href" ]; // get HQ image version
			    $image_url = strtok( $image_url, '?' ); // remove URL Parameter (legacy)
			    $image_url = substr($image_url, 0, strpos($image_url, '/ORIG')); // remove everything after file url
			    $image_url = stripslashes( $image_url );
			    
			    // prepare image save
			    $filename = wp_unique_filename( $uploads[ 'path' ], basename( $image_url ), $unique_filename_callback = null );
			    $fullpath_filename = $uploads[ 'path' ] . "/" . $filename;
			    $wp_filetype = wp_check_filetype( $filename, null );
			    
				// get remote image
				$image_string = $this->fetch_image( $image_url );
				
				// put image
				$file_saved = file_put_contents( $uploads['path'] . "/" . $filename, $image_string );
				
				if ( !$file_saved ) 
					throw new Exception( __( '"Anhang konnte nicht übertragen werden."' ) );
				
				// prepare and insert new attachment
				$new_attachment = array(
					 'post_mime_type' => $wp_filetype[ 'type' ],
					 'post_title' => $attachment[ "title" ],
					 'post_content' => '',
					 'post_status' => 'inherit',
					 'guid' => $uploads[ 'url' ] . "/" . $filename
				);
				$attach_id = wp_insert_attachment( $new_attachment, $fullpath_filename, $post_id );
						
				if ( !$attach_id )
					throw new Exception( __( '"Anhang konnte nicht in die Datenbank geschrieben werden."' ) );

                // handle attachment meta
				require_once(ABSPATH . "wp-admin" . '/includes/image.php');
				$attach_data = wp_generate_attachment_metadata( $attach_id, $fullpath_filename );
				wp_update_attachment_metadata( $attach_id,  $attach_data );
				
				$attachment_ids[] = $attach_id;
				
				// assign floorplan
				if ( $attachment->floorplan === true ) 
					update_post_meta( $post_id, 'immopress_floorplan', $attach_id );
                
                // make first image post thumbnail
				if ( !$set_thumb ) {
					update_post_meta( $post_id, '_thumbnail_id', $attach_id );
					$set_thumb = true;
				}
			
			} catch ( Exception $e ) {
				$_POST['immopress_import_fail'] = $e->getMessage();
			}
			
		} 
		return ( count( $attachment_ids ) == 0 ? false : $attachment_ids );
		
	} // end import_attachments
	
	function set_post_terms( $expose, $id ) {
		
		if ( !isset( $expose['realEstate']['@xsi.type'] ) ) 
			return false;
			
		// get term name key
		$xsi_type = $expose['realEstate']['@xsi.type'];
		$term_key = from_camel_case( str_replace( 'expose:', '', $xsi_type ) );
		
		// get term cat nice name
		$term_parent = ( array_key_exists( $term_key, $this->terms['rent'] ) ? 'rent' : 'buy' );
		$term_parent_nicename = ( $term_parent == 'rent' ? __( 'Mieten', 'immopress' ) : __( 'Kaufen', 'immopress' ) );
		
		// get term parent
		$term_nicename = $this->terms[$term_parent][$term_key];
		$term_parent = term_exists( $term_parent_nicename, $this->taxonomy );
		
		// set term parent # Y U NO WORK?!?
		// wp_set_object_terms( $id, intval( $term_parent['term_id'] ), $this->taxonomy ); 
				
		// get child term
		$term_child_exists = term_exists( $term_nicename, $this->taxonomy, $term_parent['term_id'] );
				
		// set child term
		wp_set_object_terms( $id, intval( $term_child_exists['term_id'] ), $this->taxonomy );
		
		return true;
		
	} // end set_post_terms

	/**
	 * Takes $expose data and splits it into individual custom fields
	 */
	function add_post_meta( $expose, $id ) {
		
		if ( !isset( $expose ) || !isset( $id ) ) 
			return false;
			
		// Let's loop through the first level of $expose['realEstate'].
		// But wait, not everything we want is on at the first level. 
		// Some values are hidden deeper inside the array.
		// This array locates these values
		$digDeep = array(
			'city'         => $expose['realEstate']['address']['city'], // Stadt
			'courtage'     => $expose['realEstate']['courtage']['courtage'], // Provisionshöhe
			'courtageNote' => $expose['realEstate']['courtage']['courtageNote'], // Provisionshinweis
			'firingTypes'  => $expose['realEstate']['firingTypes']['firingType'], // Befeuerungsart
			'hasCourtage'  => $expose['realEstate']['courtage']['hasCourtage'], // Provision
			'houseNumber'  => $expose['realEstate']['address']['houseNumber'], // Hausnummer
			'latitude'     => $expose['realEstate']['address']['wgs84Coordinate']['latitude'], // Breitengrad
			'longitude'    => $expose['realEstate']['address']['wgs84Coordinate']['longitude'], // Längengrad
			'postcode'     => $expose['realEstate']['address']['postcode'], // Postleitzahl
			'street'       => $expose['realEstate']['address']['street'], // Straße
			'price'        => $expose['realEstate']['price']['value'], // Hauspreis
			'quarter'      => $expose['realEstate']['address']['quarter'], // Viertel
		);
		$fields = array_merge( $expose['realEstate'], $digDeep );
		
		// Write fields to database as custom fields.
		foreach ( $fields as $key => $value ) {
			
			if ( $value != '' ) {
				if ( is_string( $value ) || is_numeric( $value ) ) {
					update_post_meta( $id, $key, $value );
				}
			}
		} 
		
		return true;
		
	} // end add_post_meta
	
	/**
	 * adds 4c + is24 logos 
	 */
	 
	function add_logo( $content ) {
	
		global $post;
		
		$immopress_settings = get_option( 'immopress_settings' );
		
		if ( $immopress_settings['logo'] == '1' ) {
			
			$notice = '<p><img style="margin-right: 30px;" src="'. $this->dir .'/images/api-logo.png" alt="In Zusammenarbeit mit Immobilienscout24" />';
			$notice .= '<a title="WordPress Integration und Import ImmoPress von 4c media" href="http://www.cccc.de/"><img src="'. $this->dir .'/images/plugin-logo.png" alt="ImmoPress by 4c media" /></a></p>';
			
			return $content . $notice;
		}
		return $content;
		
	} // endpowered_by
			
	/*--------------------------------------------*
	 * Private Functions
	 *---------------------------------------------*/

	/**
	 * Tests if application has connection to API
	 */
	private function is_connected() {
		
		// Place an example request
		$response = $this->api->getRegions( array( 'q'=>'Berlin' ) );
		
		$data = new SimpleXMLElement( $response );
		$data = object_to_array( $data );
		
		// we got 'region' back. We're online!
		if ( $data['region'] )
			return true;

		// 'message' means no.
		if ( $data['message'] )
			return false;
		
		return false;
		
	} // end is_connected
	
	/**
	 * register_scripts_and_styles
	 */
	private function register_scripts_and_styles() {

		if ( is_admin() ) {

			$this->load_file( 'immopress-admin-script', '/js/admin.js', true );
			$this->load_file( 'immopress-admin-style', '/css/admin.css' );

		}

	} // end register_scripts_and_styles

	/**
	 * Helper function for registering and enqueueing scripts and styles.
	 *
	 * @name			The ID to register with WordPress
	 * @file_path		The path to the actual file
	 * @is_script		Optional argument for if the incoming file_path is a JavaScript source file.
	 */
	private function load_file( $name, $file_path, $is_script = false ) {

		$url = plugins_url( $file_path, __FILE__ );
		$file = plugin_dir_path( __FILE__ ) . $file_path;

		if( file_exists( $file ) ) {

			if( $is_script ) {

				wp_register_script( $name, $url, array( 'jquery' ) );
				wp_enqueue_script( $name );

			} else {

				wp_register_style( $name, $url );
				wp_enqueue_style( $name );

			} // end if

		} // end if
    
	} // end load_file
	
	/**
	 * Gets $url either by curl or file_get_contents
	 */
	private function fetch_image( $url ) {
		if ( function_exists( 'curl_init' ) ) {
			return $this->curl_fetch_image( $url );
		} elseif ( ini_get( 'allow_url_fopen' ) ) {
			return $this->fopen_fetch_image( $url );
		}
	}
	private function curl_fetch_image( $url ) {
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		$image = curl_exec( $ch );
		curl_close( $ch );
		return $image;
	}
	private function fopen_fetch_image( $url ) {
		$image = file_get_contents( $url, false, $context );
		return $image;
	}
	
	
} // end class
	
  
/**
 * Function to Convert stdClass Objects to Multidimensional Arrays
 * Source: http://www.if-not-true-then-false.com/2009/php-tip-convert-stdclass-object-to-multidimensional-array-and-convert-multidimensional-array-to-stdclass-object/
 */
function object_to_array( $d ) {

	if ( is_object( $d ) ) {
		// Gets the properties of the given object
		// with get_object_vars function
		$d = get_object_vars( $d );
	}
		if ( is_array( $d ) ) {
		/*
		* Return array converted to object
		* Using __FUNCTION__ (Magic constant)
		* for recursive call
		*/
		return array_map( __FUNCTION__, $d );
	} else {
		// Return array
		return $d;
	}
} 

/**
 * convert camelcase strings to uppcase with underscore
 * Based on: http://www.paulferrett.com/2009/php-camel-case-functions/
 */
function from_camel_case( $str ) {
    $str[0] = strtolower( $str[0] );
    $func = create_function( '$c', 'return "_" . strtolower($c[1]);' );
    return strtoupper( preg_replace_callback( '/([A-Z])/', $func, $str ) );
}
	    
?>
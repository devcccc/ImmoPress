<?php
/**
 * provides an interface for typical methods that you would use to access your data
 */

/**
 *
 * @global type $post
 * @global type $ImmoPress
 * @param type $args
 * @return boolean
 */
function immopress_get_fields( $args )
{
    global $post, $ImmoPress;

    // Parse incomming $args into an array and merge it with $defaults
    extract( wp_parse_args( $args, array (
            'id' => $post->ID,
    'exclude' => array(),
            'include' => array()
    ) ), EXTR_SKIP );

    if ( !isset( $ImmoPress->fields ) ) {
            return false;
    }

    if(!is_array($exclude)){
            $exclude = explode( ',', $exclude );
    }
    if(!is_array($include)){
            $include = explode( ',', $include );
    }

    $fields = $ImmoPress->fields;
    $arr = array();
    $currency_fields = array( 'price', 'baseRent', 'serviceCharge', 'totalRent', 'parkingSpacePrice', 'heatingCosts' );
    $square_fields = array( 'livingSpace', 'usableFloorSpace', 'totalFloorSpace', 'netFloorSpace', 'additionalArea', 'plotArea', 'usableFloorSpace');
    $energy_type = array( 'thermalCharacteristic' );
    setlocale(LC_MONETARY, 'de_DE');

    foreach ( $fields as $key => $value) {

            // Pop fields
            if ( is_array($exclude) && $exclude[0] && in_array( $key, $exclude ) ) {
                    continue;
            }

            //add fields
            if (is_array($include) && $include[0] && !in_array( $key, $include ) ) {
                    continue;
            }

            $entry = get_post_meta( $id, $key, true );

            if ( $entry ) {

                    // Use correct currency display.
                    if ( in_array( $key, $currency_fields ) ) {
                            $entry = money_format('%.2n', $entry);
                    }

                    // Append unit to square measure
                    if ( in_array( $key, $square_fields ) ) {
                            $entry = str_replace('.', ',', $entry) . '&thinsp;m²';
                    }

                    // Append energy consuption to its entity
                    if ( in_array( $key, $energy_type ) ) {

                            $entry = str_replace( '.', ',', $entry ) .'&thinsp;kWh/(m² *a)';

                    }

                    $arr[$key] = $entry;

            }
    }

    foreach($arr as $field => $value){
        $entry = $ImmoPress->values[$value];
        #if($field == 'buildingEnergyRatingType') var_dump($entry);
        if ( $entry == '') {
            $entry = $value;
        }
        $arr[$field] = $entry;
    }

    return $arr;
}

/**
 *
 * @global type $post
 * @global type $ImmoPress
 * @param type $args
 * @return string|boolean
 */
function immopress_the_fields( $args ) {

    global $post, $ImmoPress;

    extract( wp_parse_args( $args, array (
            'id' => $post->ID,
    'exclude' => array(),
            'include' => array(),
    'echo' => TRUE,
            'outputvalues' => FALSE
    ) ), EXTR_SKIP );

    if(!is_array($exclude)){
            $exclude = explode( ',', $exclude );
    }
    if(!is_array($include)){
            $include = explode( ',', $include );
    }

    $fields = immopress_get_fields( $args );


    if ( !$fields ) {
            return false;
    }

    $output = '';

    

    $outputFields = array();

    foreach ( $fields as $key => $value) {

            $entry = $ImmoPress->values[$value];

            if ( $entry == '') {
                    $entry = $value;
            }

            $includeIndex = array_search($key,$include);

            $outputFields[] = array(
                    'key' => $key,
                    'label' => $ImmoPress->fields[$key],
                    'value' => $entry
            );

            if($key == 'thermalCharacteristic' && !empty($entry)){
                    //calculate energy class
                    $energyClass = 'A+';
                    if ($entry >= 30) { $energyClass = 'A'; }
                    if ($entry >= 50) { $energyClass = 'B'; }
                    if ($entry >= 75) { $energyClass = 'C'; }
                    if ($entry >= 100){ $energyClass = 'D'; }
                    if ($entry >= 130){ $energyClass = 'E'; }
                    if ($entry >= 160){ $energyClass = 'F'; }
                    if ($entry >= 200){ $energyClass = 'G'; }
                    if ($entry >= 250){ $energyClass = 'H'; }

                    //append energy class
                    $outputFields[count($include)+5] = array(
                            'key' => 'energyEfficiencyClass',
                            'label' => $ImmoPress->fields['energyEfficiencyClass'],
                            'value' => $energyClass
                    );
            }

    }

    //var_dump($outputFields);

    ksort($outputFields);

    return $outputFields;

    if ($outputvalues) {
        return $outputFields;
    } elseif ($echo) {
        echo $output;
    } else {
        return $output;
    }
}

/**
 *
 * @param type $atts
 * @return type
 */


function immopress_fields_shortcode($atts) {

    global $post;

    $args = wp_parse_args( $atts, array(
        'echo' => false,
        'groupid' => 0,
        'immoid' => $post->ID
    ));

    $group = $args['groupid'];
    if(is_numeric($args['immoid'])) {
        $id = intval($args['immoid']);
    } else {
        $id = $post->ID;
    }

    $output = '';

    $custom_fields = get_post_meta($id);

    $exposetype = strtoupper($custom_fields['exposeType'][0]);

    if(array_key_exists('commercializationType', $custom_fields)) {
        $comtype = strtolower($custom_fields['commercializationType'][0]);
    } else {
        if ((strpos($exposetype, 'RENT') !== false) || (strpos($exposetype, 'BUY') !== false)) {
            $comtype = 'buy';
            if ((strpos($exposetype, 'RENT') !== false)) {
                $comtype = 'rent';
            }
        } else {
            if(array_key_exists('calculatedTotalRentScope', $custom_fields)) {
                $comtype = 'buy';
                if (strpos($exposetype, 'RENT') !== false) {
                    $comtype = 'rent';
                }
            }
        }
    }

    $types = get_option('immopress_cats')[$comtype][$exposetype]['fields'];
    $groups = get_option('immopress_groups');

    if($group > 0 && array_key_exists($group, $groups)) {

        $output = '<table class="immopress-fields">';

        if($group > 0) {

            $valtranslations = get_option('immopress_values');

            $groupname = $groups[$group];

            $output .= '<thead><tr class="immopress-group"><th colspan="2">' . $groupname . '</th></tr></thead>';
            $output .= '<tbody>';

            foreach ($types as $typekey => $typefield) {

                if (isset($custom_fields[$typekey])) {
                    $fieldval = $custom_fields[$typekey][0];
                } else {
                    continue;
                }

                if (intval($typefield['group']) == intval($group)) {

                    $fieldtranslation = $typekey;

                    if (!empty($typefield['translation'])) {
                        $fieldtranslation = $typefield['translation'];
                    }
                    $output .= '<tr class="immopress-field-' . strtolower($fieldtranslation) . '">';
                    $output .= '<td class="immopress-key">' . $fieldtranslation . ':</td>';
                    if(is_numeric($fieldval) && $typefield['unit'] != 'none') {
                        switch ($typefield['unit']) {
                            case 'squaremeter':
                                $unit = 'm²';
                                break;
                            case 'squarekilometer':
                                $unit = 'km²';
                                break;
                            case 'euro':
                                $unit = '€';
                                break;
                            case 'dollar':
                                $unit = '$';
                                break;
                            case 'energy':
                                $unit = 'kWh/(m²*a)';
                                break;
                            case 'meter':
                                $unit = 'm';
                                break;
                            case 'kilogramm':
                                $unit = 'kg/m²';
                                break;
                            default:
                                $unit = '';
                        }


                        $fieldval = number_format($fieldval, 2, ',', ' ') . ' ' . $unit;
                    }

                    $output .= '<td class="immopress-value">' . get_field_translation($fieldval, $valtranslations) . '</td></tr>';
                }
            }
        }

        $output .= '</tbody></table>';
    }

    return $output;
}

add_shortcode( 'immopress_fields', 'immopress_fields_shortcode' );



function get_field_translation($val, $translations) {

    if(array_key_exists($val, $translations)) {

        if($translations[$val] != '') {
            return $translations[$val];
        }
    }

    return $val;
}


/***************************************************************
* Function: Location Map
* Description: Displays object on a google map
***************************************************************/

/**
 *
 * @global type $post
 * @param type $args
 * @return boolean
 */
function immopress_get_map( $args )
{
    global $post;

    // Parse incomming $args into an array and merge it with $defaults
    extract( wp_parse_args( $args, array (
        'id' => $post->ID,
        'width' => 584,
        'height' => 400,
        'show_empty' => TRUE
    ) ), EXTR_SKIP );

    $address = get_post_meta( $id, 'street', true).' '.get_post_meta( $id, 'houseNumber', true ).', '.get_post_meta( $id, 'postcode', true ).' '.get_post_meta( $id, 'city', true );

    $address = urlencode($address);

    $latitude = get_post_meta( $id, 'longitude', true);
    $longitude = get_post_meta( $id, 'latitude', true);

    if ( ( $latitude == '' || $longitude == '' ) ) {

        if ( $show_empty ) {
            return '<p>'. __( 'Es sind leider keine Informationen zur Lage verfügbar.' ) .'</p>';
        } else {
            return false;
        }

    } else {
        return "<iframe width='$width' height='$height' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=de&amp;geocode=&amp;q=$address&amp;aq=0&amp;ie=UTF8&amp;hq=&amp;hnear=$address&amp;t=m&amp;ll=$longitude,$latitude&amp;z=14&amp;iwloc=&amp;output=embed'></iframe>";
    }
}

/**
 *
 * @param type $args
 */
function immopress_the_map( $args )
{
        echo immopress_get_map( $args );
}

/**
 *
 * @global type $post
 * @param type $atts
 * @return type
 */
function immopress_map_shortcode( $atts )
{
    global $post;

    $args = shortcode_atts( array(
        'id'     => $post->ID,
        'width'  => 584,
        'height' => 400
    ), $atts );
    return immopress_get_map( $args );
}
add_shortcode( 'immopress_map', 'immopress_map_shortcode' );


/**
 *
 * @return type
 */
function update_immo_terms($field_data, $immo_terms, $groups) {
    //first remove save_button
    unset($field_data['immopress_save']);;

    for ($i = 0; $i < (sizeof($field_data) / 6); $i++) {

        $term_name = $field_data['termname_' . $i];
        $term_parent = $field_data['termparent_' . $i];
        $term_translation = $field_data['termtranslation_' . $i];
        $key_translations = $field_data['keytranslation_' . $i]; //übergebenes keys;
        $key_group = $field_data['keygroup_' . $i];
        $key_unit = $field_data['keyunit_' . $i];

        $fields = $immo_terms[$term_parent][$term_name]['fields'];

        //checking if the arraykey wasn't manipulated
        foreach ($key_translations as $key => $keyValue) {
            if(!array_key_exists($key, $fields)) {
                return $immo_terms;
            }
        }

        $immo_terms[$term_parent][$term_name]['translation'] = $term_translation;

        $immo_terms[$term_parent][$term_name]['fields'] = sort_immo_terms($key_translations, $fields);

        foreach ($fields as $field => $data) {
            $immo_terms[$term_parent][$term_name]['fields'][$field]['translation'] = filter_var($key_translations[$field], FILTER_SANITIZE_STRING);

            //here we have to check if the posted group value is really a group and not manipulated
            $validGroup = 0;
            if (array_key_exists($key_group[$field], $groups)) {
                $validGroup = $key_group[$field];
            }

            $immo_terms[$term_parent][$term_name]['fields'][$field]['group'] = $validGroup;

            //here we have to check if the posted value is really a selected value and not manipulated
            switch ($key_unit[$field]) {
                case 'squaremeter':
                    $validUnit = 'squaremeter';
                    break;
                case 'squarekilometer':
                    $validUnit = 'squarekilometer';
                    break;
                case 'euro':
                    $validUnit = 'euro';
                    break;
                case 'dollar':
                    $validUnit = 'dollar';
                    break;
                case 'energy':
                    $validUnit = 'energy';
                    break;
                case 'meter':
                    $validUnit = 'meter';
                    break;
                case 'kilogramm':
                    $validUnit = 'kilogramm';
                    break;
                default:
                    $validUnit = 'none';
            }

            $immo_terms[$term_parent][$term_name]['fields'][$field]['unit'] = $validUnit;
        }
    }

    update_option('immopress_cats', $immo_terms);

    return $immo_terms;
}

/**
 *
 * @return type
 */
function sort_immo_terms($fields, $terms) {

    $termsReordered = $fields;

    array_walk(
        $termsReordered,
        function (&$item, $key) use ($terms) {
            $item = $terms[$key];
        }
    );

    return $termsReordered;
}

/**
 *
 * @param String groupname
 * @return type groups
 */
function update_groups($groupname) {
    $groups = get_option('immopress_groups');

    if($groups == NULL) {
        $groups = array(
            0 => __('Nicht anzeigen', 'immopress'),
            1 => filter_var($groupname, FILTER_SANITIZE_STRING)
        );
    } else {
        end( $groups );
        $key = intval(key( $groups )) + 1;

        $groups[$key] = filter_var($groupname, FILTER_SANITIZE_STRING);
    }

    update_option('immopress_groups', $groups);

    return $groups;
}

/**
 *
 * @param int groupid
 * @return type groups
 */
function delete_group($group_id) {

    $groups = get_option('immopress_groups');

    if($group_id > 0) {

        $immo_terms = get_option('immopress_cats');

        foreach ($immo_terms as $term => $termval) {

            foreach ($termval as $cat => $catval) {
                $fields = $catval['fields'];

                foreach ($fields as $field => $fieldval) {

                    if($fieldval['group'] == $group_id) {
                        $immo_terms[$term][$cat]['fields'][$field]['group'] = 0;
                    }

                }
            }
        }

        update_option('immopress_cats', $immo_terms);

        unset($groups[intval($group_id)]);

        update_option('immopress_groups', $groups);

    }

    return $groups;
}

/**
 *
 * @param int groupid
 * @return type groups
 */
function delete_term_and_group( $term_id, $tt_id, $taxonomy ){
    $tax_name = strtoupper($taxonomy->name);
    $parent_id = $taxonomy->parent;

    $parent_term = get_term($parent_id, 'immopress_tax');

    $immotype = 'rent';
    if($parent_term->name == 'Kaufen') {
        $immotype = 'buy';
    }

    $immo_terms = get_option('immopress_cats');

    unset($immo_terms[$immotype][$tax_name]);

    update_option('immopress_cats', $immo_terms);
}
add_action( 'delete_immopress_tax', 'delete_term_and_group', 10, 3 );
<?php
	
	function immopress_get_fields( $args ) {
		
		global $post, $ImmoPress;
		
		// Parse incomming $args into an array and merge it with $defaults
		extract( wp_parse_args( $args, array (
			'id' => $post->ID,
	        'exclude' => array()
 		) ), EXTR_SKIP );
		
		if ( !isset( $ImmoPress->fields ) ) 
			return false;
		
		$exclude = split( ',', $exclude );	
		$fields = $ImmoPress->fields;
		$arr = array();
		$currency_fields = array( 'price', 'baseRent', 'serviceCharge', 'totalRent' );
		$square_fields = array( 'livingSpace', 'usableFloorSpace' );
		setlocale(LC_MONETARY, 'de_DE');
		
		foreach ( $fields as $key => $value) {	
		
			// Pop fields
			if ( in_array( $key, $exclude ) ) {
				continue;
			}
			
			$entry = get_post_meta( $id, $key, true );
			
			if ( $entry ) {
				
				// Use correct currency display.
				if ( in_array( $key, $currency_fields ) )
					$entry = money_format( '%.2n', $entry);
					
				// Append unit to square measure
				if ( in_array( $key, $square_fields ) )
					$entry = str_replace( '.', ',', $entry ) .'&thinsp;m²';
				
				$arr[$key] = $entry;
				
			}
		}
		
		return $arr;
		
	}
	
	function immopress_the_fields( $args ) {
		
		global $post, $ImmoPress;
		
		extract( wp_parse_args( $args, array (
			'id' => $post->ID,
	        'exclude' => $exclude,
	        'echo' => TRUE
 		) ), EXTR_SKIP );
		
		$fields = immopress_get_fields( $args );
					
		if ( !$fields ) 
			return false;
						
		$output = '';
		
		$output .= '<ul class="immopress-fields">';
		
		foreach ( $fields as $key => $value) {
			
			$entry = $ImmoPress->values[$value];
			if ( $entry == '') 
				$entry = $value;

			$output .= "<li class='immopress-field-$key'>";
			$output .= "<strong class='immopress-key'>{$ImmoPress->fields[$key]}: </strong>";
			$output .= "<span class='immopress-value'>$entry</span>";
			$output .= "</li>";	
		}
		
		$output .= '</ul>';
		
		if ( $echo ) {
			echo $output;
		} else {
			return $output;
		}
	}
	
	function immopress_fields_shortcode( $atts ) {
		
		$args = wp_parse_args( $atts, array (
	        'echo' => FALSE
 		) );
		
	    return immopress_the_fields( $args );	    
	}
	add_shortcode( 'immopress_fields', 'immopress_fields_shortcode' ); 
	

/***************************************************************
* Function: Location Map
* Description: Displays object on a google map
***************************************************************/
	
	function immopress_get_map( $args ) {
		
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
			
			if ( $show_empty )
				return '<p>'. __( 'Es sind leider keine Informationen zur Lage verfügbar.' ) .'</p>';
			else 
				return false;
				
		} else {
			
			return "<iframe width='$width' height='$height' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' src='http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=de&amp;geocode=&amp;q=$address&amp;aq=0&amp;ie=UTF8&amp;hq=&amp;hnear=$address&amp;t=m&amp;ll=$longitude,$latitude&amp;z=14&amp;iwloc=&amp;output=embed'></iframe>";

		}
	}
	
	function immopress_the_map( $args ) {
		echo immopress_get_map( $args );
	}

	function immopress_map_shortcode( $atts ) {

		global $post;

	    $args = shortcode_atts( array(
	        'id' => $post->ID,
	        'width' => 584,
	        'height' => 400
	    ), $atts );
	    return immopress_get_map( $args );	    
	}
	add_shortcode( 'immopress_map', 'immopress_map_shortcode' );  
	
	
	
	
	?>
<?php 
	
if ( !current_user_can( 'manage_options' ) )
	wp_die( __( 'You do not have sufficient permissions to access this page.' ) );

// if user submits form
if ( $_GET['settings-updated'] == 'true' ) {
	
	update_option('immopress_authorized', 'false');

	$args = array(
		'callback_url'      => $this->wpadmin_url .'edit.php?post_type='. $this->post_type .'&page=immopress_settings',
		'verifyApplication' => true
	);
	
	// authenticate app, return to admin view
	if ( $this->api->getAccess( $args ) ) {
		echo 'Anwendung erfolgreich authentifiziert', 'immopress';
	}
}

if ( $_GET['state'] == 'authorized' ) {
	update_option('immopress_authorized', 'true');
}

?>

<div class="wrap" id="immopress_options">
<form method="post" action="options.php">
	<div class="wp-box">
		<div class="wp-box-half left">
			<div class="inner">
				<h2><div id="icon-link-manager" class="icon32"></div><?php _e( 'Zugriff einrichten', 'immopress' ) ?></h2>
					
				<?php if ( $_GET['state'] == 'authorized' ) { ?>
					
					<div id="message" class="updated"><p><?php _e( 'Anwendung erfolgreich authentifiziert' ); ?></p></div>
				
				<?php } ?>
						
		    	<?php settings_fields('immopress_settings'); ?>
		    	<?php do_settings_sections('immopress'); ?>
		    	
		    	<p class="immopress_explain-logo"><?php _e( 'Wenn Sie die API für produktive Daten nutzen, sind Sie verpflichtet ein ImmobilienScout24-Logo in Ihrer Anwendung zu platzieren.' ) ?></p>
			    
			    <p class="submit">
			    <input type="submit" name="submit" class="button-primary" value="<?php _e( 'Authentifizieren' ) ?>" />
			    				    				    				
			</div>
		</div>
		<div class="wp-box-half right">
			<div class="inner">
				<h2><?php _e( 'Anleitung', 'immopress' ) ?></h2>
				<ol>
					<li><a href="http://developer.immobilienscout24.de/rest-api-zugang/"><?php _e( 'Fordern Sie den Zugang zur REST-API für Produktivdaten an.', 'immopress' ) ?></a></li>
					<li><?php _e( 'Tragen Sie Ihre <strong>API-Zugangsdaten</strong> in die nebenstehenden Felder ein.', 'immopress' ) ?></li>
					<li><?php _e( 'Nach dem Klick auf <strong>Authentifizieren</strong> werden Sie auf die Website von immobilienscout24.de weitergeleitet.', 'immopress' ) ?></li>
					<li><?php _e( 'Melden Sie sich dort bitte mit Ihren normalen <strong>Konto-Zugangsdaten</strong> von immobilienscout24.de ein.', 'immopress' ) ?></li>
					<li><?php printf(__( 'Herzlichen Glückwunsch, Sie haben es geschafft!<br /> Sie können nun anfangen <a href="%1$s">neue Immobilien importieren</a>.', 'immopress' ), $this->options_url .'&page=immopress_import') ?></li>
				</ol>
			</div>
			<div class="footer">
				<h3><?php _e( 'Benötigen Sie Hilfe? Wir helfen gerne!', 'immopress' ) ?></h3>
				<p><?php _e( 'Beim Erstellen einer individuellen Kundenwebsite, mit Hilfe dieses Plugins, helfen Ihnen die Profis von <b>4c&nbsp;media</b> gerne weiter.', 'immopress' ) ?></p>
				<p><?php printf(__('Rufen Sie uns unter unserer <b>kostenlosen Rufnummer 0800 2222 633</b> an oder schreiben sie uns eine Mail an %1$s um ein unverbindliches Angebot zu erhalten.', 'immopress'), '<a href="mailto:dev@cccc.de">dev@cccc.de</a>'); ?></p>
				
			</div>
		</div>
		<div class="clear"></div>
	</div>
</form>
<div class="wrap" id="immopress_import">
	<div id="icon-tools" class="icon32"><br></div>
	<h2><?php _e( 'Import' ); ?></h2>	
	<p><?php _e( 'Tragen Sie im unten stehenden Feld die Expose-ID/Scout-ID des Objektes ein, das Sie importieren möchte. Diese ID finden Sie sowohl auf den öffentlichen Seiten des Objekts, als auch in der Verwaltungsoberfläche auf immobilienscout24.de.', 'immopress' ); ?></p>
	
	<form method="post" action="edit.php?post_type=<?php echo $this->post_type; ?>">
		<label for="exposeID">Expose ID: </label>
		<input type="text" placeholder="<?php _e( 'z.B.: 64529860', 'immopress' ) ?>" name="exposeID" id="exposeID" value="" />
		<input type="submit" class="button-primary" value="<?php _e( 'Importieren', 'immopress' ) ?>" />
	</form>
</div>
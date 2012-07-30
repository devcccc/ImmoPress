=== ImmoPress ===
Contributors: jancbeck
Plugin URI:: http://www.cccc.de/immopress/
Tags: immobilienscout24.de, real-estate, import
Requires at least: 3.2.1
Tested up to: 3.3.1
Stable tag: 0.0.1

Erlaubt den einfachen Expose-Import von Immobilienscout24.de in WordPress.

== Description ==

Achtung, dies ist eine frühe Version des Plugins. Feedback bitte an **dev@cccc.de**.

== Installation ==

Um das Plugin zu installieren gehen Sie wie folgt vor:

1. Laden Sie den Plugin-Ordner in das Pluginverzeichnis von WordPress `/wp-content/plugins/`
2. Aktivieren Sie das Plugin im Adminbereich ihrer WordPress-Installation unter **Plugins**
3. Navigieren Sie im Menü zu **Immobilien → Einrichten** und folgend Sie den Anweisungen dort
4. Nach erfolgreicher Einrichtung des Plugins können Sie unter **Immobilien → Importieren** Objekt-IDs importieren
5. Verwenden Sie `[immopress_fields]` im Editorfeld eines Immoblienobjekts, um seine hinterlegten Daten abzurufen. Wenn eine Adresse hinterlegt wurde zeigt `[immopress_map]` die Lage des Objekts in einer Google Map an.


== Screenshots ==

1. **Einrichten**: Über diese Eingabemaske können Sie Ihre Anwendung bei immoblienscout24.de authentifizieren lassen.
2. **Importieren**: Um Immobilienobjekte zu importieren benötigen Sie lediglich die jeweilige Objekt-ID.
3. **Verwenden**: Über Template Tags können Sie die importierten Informationen in Ihren Angeboten anzeigen.

== Changelog ==

= 0.0.1 =
* Erste Version
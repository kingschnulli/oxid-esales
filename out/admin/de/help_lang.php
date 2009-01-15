<?php
/**
 *    This file is part of OXID eShop Community Edition.
 *
 *    OXID eShop Community Edition is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    OXID eShop Community Edition is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @link http://www.oxid-esales.com
 * @package lang
 * @copyright © OXID eSales AG 2003-2009
 * $Id: help_lang.php 15260 2009-01-14 14:43:53Z philipp.grashoff $
 */

/**
 * In this file, all help content displayed in eShop admin is stored.
 * 3 different types of help are stored:
 *
 *   1) Tooltips
 *      Syntax for identifier: TOOLTIP_TABNAME_INPUTNAME, e.g. TOOLTIP_ARTICLE_MAIN_OXSEARCHWORDS
 *
 *   2) Additional Information, popping up when clicking on icon
 *      Syntax for identifier: HELP_TABNAME_INPUTNAME, e.g. HELP_SHOP_CONFIG_BIDIRECTCROSS. 
 *      !!!The INPUTNAME is same as in lang.php for avoiding even more different Identifiers.!!!
 *
 *   3) Links to Manual pages
 *      Syntax for identifier: MANUAL_TABNAME, e.g. MANUAL_ARTICLE_EXTENDED
 * 
 * 
 * HTML Tags for markup:
 * <var>...</var> for names of input fields, selectlists and Buttons, e.g. <var>Active</var>
 * <code>...</code> for preformatted text
 * <ul><li> for lists
 */

$aLang =  array(

/*
 * Additional Information
 */
'HELP_SHOP_SYSTEM_OTHERCOUNTRYORDER'		=> 	"Diese Einstellung beeinflusst das Verhalten des OXID eShops, wenn für ein Land, in das Benutzer bestellen wollen, keine Versandkosten definiert sind:<br>" .
                                                "<ul><li>Wenn die Einstellung aktiv ist, erhalten diese Benutzer im Bestellprozess eine Meldung: Die Versandkosten werden ihnen nachträglich mitgeteilt, wenn Sie damit einverstanden ist. Sie können mit der Bestellung fortfahren.</li>" .
                                                "<li>Wenn die Option ausgeschaltet ist, können Benutzer aus Ländern, für die keine Versandkosten definiert sind, nicht bestellen.</li></ul>",

'HELP_SHOP_SYSTEM_DISABLENAVBARS'			=>	"Wenn Sie diese Einstellung aktivieren, werden die meisten Navigationselemente im Bestellprozess ausgeblendet. Dadurch werden die Benutzer beim Bestellen nicht unnötig abgelenkt.",

'HELP_SHOP_SYSTEM_DEFAULTIMAGEQUALITY'		=>	"Empfehlenswerte Einstellungen sind ca. 40-80:<br>" .
                                                "<ul><li>Unterhalb von ca. 40 werden deutliche Kompressionsartefakte sichtbar, und die Bilder wirken unscharf.</li>".
                                                "<li>Oberhalb von ca. 80 kann man kaum eine Verbesserung der Bildqualität feststellen, während die Dateigröße enorm zunimmt.</li></ul><br>".
                                                "Die Standardeinstellung ist 75.",



'HELP_SHOP_CONFIG_TOPNAVILAYOUT'			=>	"In der Kategorien-Navigation werden die Kategorien angezeigt. Die Kategorien-Navigation wird normalerweise links angezeigt. Wenn Sie diese Einstellung aktivieren, wird die Kategorien-Navigation anstatt links oben angezeigt.",

'HELP_SHOP_CONFIG_ORDEROPTINEMAIL'			=>	"Wenn Double-Opt-In aktiviert ist, erhalten die Benutzer eine E-Mail mit einem Bestätigungs-Link, wenn sie sich für den Newsletter registrieren. Erst, wenn sie diesen Link besuchen, sind sie für den Newsletter angemeldet.<br>" .
                                                "Double-Opt-In schützt vor Anmeldungen, die nicht gewollt sind. Ohne Double-Opt-In können beliebige E-Mail Adressen für den Newsletter angemeldet werden. Dies wird z. B. auch von Spam-Robotern gemacht. Durch Double-Opt-In kann der Besitzer der E-Mail Adresse bestätigen, dass er den Newsletter wirklich empfangen will.",

'HELP_SHOP_CONFIG_BIDIRECTCROSS'			=>	"Durch Crossselling können zu einem Artikel passende Artikel angeboten werden. Crossselling-Artikel werden im eShop bei <i>Kennen Sie schon?</i> angezeigt.<br>" .
                                                "Wenn z. B. einem Auto als Crossselling-Artikel Winterreifen zugeordnet sind, werden beim Auto die Winterreifen angezeigt." .
                                                "Wenn Bidirektionales Crossselling aktiviert ist, funktioniert Crossselling in beide Richtungen: bei den Winterreifen wird das Auto angezeigt.",

'HELP_SHOP_CONFIG_ICONSIZE'					=>	"Icons sind die kleinsten Bilder eines Artikels. Icons werden z. B. <br>" .
                                                "<ul><li>im Warenkorb angezeigt.</li>" .
                                                "<li>angezeigt, wenn Artikel in der rechten Leiste aufgelistet werden (z.B. bei den Aktionen <i>Top of the Shop</i> und <i>Schnäppchen</i>.</li></ul>" .
                                                "Damit das Design des eShops nicht durch zu große Icons gestört wird, werden zu große Icons automatisch verkleinert. Die maximale Größe können Sie hier eingeben.<br>" ,

'HELP_SHOP_CONFIG_THUMBNAILSIZE'			=>  "Thumbnails sind kleine Bilder eines Artikels. Thumbnails werden z. B. <br>" .
                                                "<ul><li>in Artikellisten angezeigt. Artikellisten sind z. B. Kategorieansichten (alle Artikel in einer Kategorie werden aufgelistet) und die Suchergebnisse.</li>" .
                                                "<li>in Aktionen angezeigt, die in der Mitte der Startseite angezeigt werden, z. B. <i>Die Dauerbrenner</i> und <i>Frisch eingetroffen!</i>.</li></ul>" .
                                                "Damit das Design des eShops nicht durch zu große Thumbnails gestört wird, werden zu große Thumbnails automatisch verkleinert. Die maximale Größe können Sie hier eingeben.",

'HELP_SHOP_CONFIG_STOCKONDEFAULTMESSAGE'	=>	"Bei jedem Artikel können Sie einrichten, welche Meldung den Benutzern angezeigt wird, wenn der Artikel auf Lager ist. " .
                                                "Wenn diese Einstellung aktiv ist, wird den Benutzern auch dann eine Meldung angezeigt, wenn bei einem Artikel keine eigene Meldung hinterlegt ist. Dann die Standardmeldung &quot;sofort lieferbar&quot; angezeigt.",

'HELP_SHOP_CONFIG_STOCKOFFDEFAULTMESSAGE'	=>	"Bei jedem Artikel können Sie einrichten, welche Meldung den Benutzern angezeigt wird, wenn der Artikel nicht auf Lager ist. " .
                                                "Wenn diese Einstellung aktiv ist, wird den Benutzern auch dann eine Meldung angezeigt, wenn bei einem Artikel keine eigene Meldung hinterlegt ist. Dann die Standardmeldung &quot;Dieser Artikel ist nicht auf Lager und muss erst nachbestellt werden&quot; angezeigt.",

'HELP_SHOP_CONFIG_OVERRIDEZEROABCPRICES'	=>	"Sie können für bestimmte Benutzer spezielle Preise einrichten. Dadurch können Sie bei jedem Artikel A, B, und C-Preise eingeben. Wenn Benutzer z. B. in der Benutzergruppe Preis A sind, werden ihnen die A-Preise anstatt dem normalen Artikelpreis angezeigt.<br>" .
                                                "Wenn die Einstellung aktiv ist, wird diesen Benutzern der normale Artikelpreis angezeigt, wenn für den Artikel kein A, B oder C-Preis vorhanden ist.<br>" .
                                                "Sie sollten diese Einstellung aktivieren, wenn Sie A,B und C-Preise verwenden: Ansonsten wird den bestimmten Benutzern ein Preis von 0,00 angezeigt, wenn kein A,B oder C-Preis hinterlegt ist.",

'HELP_SHOP_CONFIG_SEARCHFIELDS'				=>	"Hier können Sie die Datenbankfelder der Artikel eingeben, in denen gesucht wird. Geben Sie pro Zeile nur ein Datenbankfeld ein.<br>" .
                                                " Die am häufigsten benötigten Einträge sind:" .
                                                "<ul><li>oxtitle = Titel (Name) der Artikel</li>" .
                                                "<li>oxshortdesc = Kurzbeschreibung der Artikel</li>" .
                                                "<li>oxsearchkeys = Suchwörter, die bei den Artikeln eingetragen sind</li>" .
                                                "<li>oxartnum = Artikelnummern</li>" .
                                                "<li>oxtags	= Stichworte, bei den Artikeln eingetragen sind</li></ul>",

'HELP_SHOP_CONFIG_SORTFIELDS'				=>	"Hier können Sie die Datenbankfelder der Artikel eingeben, nach denen Artikellisten sortiert werden können. Geben Sie pro Zeile nur ein Datenbankfeld ein.<br>" .
                                                "Die am häufigsten benötigten Einträge sind:" .
                                                "<ul><li>oxtitle = Titel (Name) der Artikel</li>" .
                                                "<li>oxprice = Preis der Artikel</li>" .
                                                "<li>oxvarminprice	= Der niedrigste Preis der Artikel, wenn Varianten mit verschiedenen Preisen verwendet werden.</li>" .
                                                "<li>oxartnum = Artikelnummern</li>" .
                                                "<li>oxrating = Die Bewertung der Artikel</li>" .
                                                "<li>oxstock = Lagerbestand der Artikel</li></ul>",

'HELP_SHOP_CONFIG_MUSTFILLFIELDS'			=>	"Hier können Sie eingeben, welche Felder von Benutzern ausgefüllt werden müssen, wenn Sie sich registieren. Sie müssen die entsprechenden Datenbankfelder angeben. Geben Sie pro Zeile nur ein Datenbankfeld ein.<br>" .
                                                "Die am häufigsten benötigten Einträge für die Benutzerdaten sind:" .
                                                "<ul><li>oxuser__oxfname = Vorname</li>" .
                                                "<li>oxuser__oxlname = Nachname</li>" .
                                                "<li>oxuser__oxstreet = Straße</li>" .
                                                "<li>oxuser__oxstreetnr = Hausnummer</li>" .
                                                "<li>oxuser__oxzip = Postleitzahl</li>" .
                                                "<li>oxuser__oxcity = Stadt</li>" .
                                                "<li>oxuser__oxcountryid = Land</li>" .
                                                "<li>oxuser__oxfon = Telefonnummer</li></ul><br>" .
                                                "Sie können auch angeben, welche Felder ausgefüllt werden müssen, wenn Benutzer eine Lieferadresse eingeben. Die am häufigsten benötigten Einträge sind:" .
                                                "<ul><li>oxaddress__oxfname = Vorname</li>" .
                                                "<li>oxaddress__oxlname = Nachname</li>" .
                                                "<li>oxaddress__oxstreet = Straße</li>" .
                                                "<li>oxaddress__oxstreetnr = Strassennummer</li>" .
                                                "<li>oxaddress__oxzip = Postleitzahl</li>" .
                                                "<li>oxaddress__oxcity = Stadt</li>" .
                                                "<li>oxaddress__oxcountryid = Land</li>" .
                                                "<li>oxaddress__oxfon = Telefonnummer</li></ul>",

'HELP_SHOP_CONFIG_USENEGATIVESTOCK'			=>	"Mit <var>Negative Lagerbestände erlauben</var> können Sie einstellen, welcher Lagerbestand berechnet wird, wenn ein Artikel ausverkauft ist:<br>" .
												"<ul><li>Wenn die Einstellung aktiv ist, werden negative Lagerbestände berechnet, wenn weitere Exemplare bestellt werden.</li>" .
												"<li>Wenn die Einstellung nicht aktiv ist, fällt der Lagerbestand eines Artikels nie unter 0. Auch dann nicht, wenn der Artikel bereits ausverkauft ist und noch weitere Exemplare bestellt werden.</li></ul>",

'HELP_SHOP_CONFIG_NEWARTBYINSERT'  			=>	"Auf der Startseite Ihres eShops werden die unter \"Frisch eingetroffen!\" die neusten Artikel in Ihrem eShop angezeigt. Sie können die Artikel, die hier angezeigt werden, manuell einstellen oder automatisch berechnen lassen. Mit dieser Einstellung wählen Sie, wie die neusten Artikel berechnet werden sollen: Nach dem Datum, an dem die Artikel erstellt wurden, oder nach dem Datum der letzten Änderung.",


'HELP_SHOP_SEO_TITLEPREFIX'					=>	"Jede einzelne Seite hat einen Titel. Er wird im Browser als Titel des Browser-Fensters angezeigt. Mit Titel Prefix und Titel Postfix haben Sie die Möglichkeit, vor und hinter jeden Seitentitel Text einzufügen:<br>" .
                                                "<ul><li>Geben Sie Titel Prefix den Text ein, der vor dem Titel erscheinen soll.</li>" .
                                                "<li>Geben Sie in Titel Postfix den Text ein, der hinter dem Titel erscheinen soll.</li></ul>",

'HELP_SHOP_SEO_TITLESUFFIX'					=>	"Jede einzelne Seite hat einen Titel. Er wird im Browser als Titel des Browser-Fensters angezeigt. Mit Titel Prefix und Titel Postfix haben Sie die Möglichkeit, vor und hinter jeden Seitentitel Text einzufügen:<br>" .
                                                "<ul><li>Geben Sie Titel Prefix den Text ein, der vor dem Titel erscheinen soll.</li>" .
                                                "<li>Geben Sie in Titel Postfix den Text ein, der hinter dem Titel erscheinen soll.</li></ul>",

'HELP_SHOP_SEO_IDSSEPARATOR'				=>	"Das Trennzeichen wird verwendet, wenn Kategorie- oder Artikelnamen aus mehreren Worten bestehen. Das Trennzeichen wird anstelle eines Leerzeichens in die URL eingefügt, z. B. www.ihronlineshop.de/Kategorie-aus-mehreren-Worten/Artikel-aus-mehreren-Worten.html<br>" .
												"Wenn Sie kein Trennzeichen eingeben, wird der Bindestrich - als Trennzeichen verwendet",

'HELP_SHOP_SEO_SAFESEOPREF'					=>	"Wenn mehrere Artikel den gleichen Namen haben und in der gleichen Kategorie sind, würden sie die gleiche SEO URL erhalten. Damit das nicht passiert, wird das SEO Suffix angehängt. Dadurch werden gleiche SEO URLs vermieden. Wenn Sie kein SEO Suffix angeben, wird 'oxid' als Standard verwendet.",

'HELP_SHOP_SEO_REPLACECHARS'				=>	"Bestimmte Sonderzeichen wie Umlaute (Ä,Ö,Ü) sollten in URLs nicht vorkommen, da Sie Probleme verursachen können. In dem Eingabefeld wird angegeben, mit welchen Zeichen die Sonderzeichen ersetzt werden. Die Syntax ist <code>Sonderzeichen => Ersatzzeichen</code>, z. B. <code>Ü => Ue</code>.<br>" .
												"Für die deutsche Sprache sind die Ersetzungen bereits eingetragen.",

'HELP_SHOP_SEO_RESERVEDWORDS'				=>	"Bestimmte URLs sind im eShop festgelegt, z.B. www.ihronlineshop.de/admin, um den Administrationsbereich zu öffnen. Wenn eine Kategorie 'admin' heißen würde, wäre die SEO URL zu dieser Kategorie ebenfalls www.ihronlineshop.de/admin - die Kategorie könnte nicht geöffnet werden. Deswegen wird an solche SEO URLs automatisch das SEO Suffix angehängt. Mit dem Eingabefeld können Sie einstellen, an welche SEO URLs das SEO Suffix automatisch angehängt werden soll.",

'SHOP_SEO_MAINLANGUAGE'						=>	"Hier können Sie einstellen, welche Sprache als Primärsprache für die SEO URLs verwendet wird: Bei der Primärsprache wird kein Sprachkürzel in die SEO URL eingebaut, z. B. www.ihronlineshop.de/kategorie/artikel.html. Bei allen anderen Sprachen wird zusätzlich ein Sprachkürzel eingebaut, z. B. www.ihronlineshop.de/en/category/article.",

'HELP_SHOP_SEO_SKIPTAGS'					=>	"Wenn bei Artikeln oder Kategorien keine SEO-Einstellungen für die META-Tags vorhanden sind, werden diese Informationen aus der Beschreibung generiert. Dabei können Wörter weggelassen werden, die besonders häufig vorkommen. Alle Wörter die in diesem Eingabefeld stehen, werden bei der automatischen Generierung ignoriert.",

'HELP_SHOP_SEO_STATICURLS'					=>	"Für bestimmte Seiten (z. B. AGB's) im eShop können Sie feste suchmaschinenfreundliche URLs festlegen. Wenn Sie eine statische URL auswählen, wird in dem Feld <var>Standard URL</var> die normale URL angezeigt. In den Eingabefeldern weiter unten können Sie für jede Sprache suchmaschinenfreundliche URLs eingeben.",



'HELP_SHOP_MAIN_PRODUCTIVE'					=>	"Wenn die Einstellung <b>nicht</b> aktiv ist, werden am unteren Ende jeder Seite Informationen zu Ladezeiten angezeigt. Außerdem werden Debug-Informationen angezeigt. Diese Informationen sind für Entwickler wichtig, wenn sie den OXID eShop anpassen.<br>" .
                                                "<b>Aktivieren Sie diese Einstellung, bevor ihr eShop öffentlich zugänglich gemacht wird! Dadurch wird den Benutzern nur der eShop ohne die zusätzlichen Informationen angezeigt.</b>",

'HELP_SHOP_MAIN_ACTIVE'						=>	"Mit <var>Aktiv</var> können Sie ihren kompletten eShop ein- und ausschalten. Wenn ihr eShop ausgeschaltet ist, wird Ihren Kunden eine Meldung angezeigt, dass der eShop vorübergehend offline ist. Das kann für Wartungsarbeiten am eShop nützlich sein.",

'HELP_SHOP_MAIN_INFOEMAIL'					=>	"An diese E-Mail Adresse werden E-Mails gesendet, wenn die Benutzer E-Mails über das Kontaktformular senden.",

'HELP_SHOP_MAIN_ORDEREMAIL'					=>	"Wenn Benutzer bestellen, erhalten sie eine E-Mail, in der die Bestellung nochmals zusammengefasst ist. Wenn die Benutzer auf diese E-Mail antworten, wird die Antwort an die <var>Bestell E-Mail Reply</var> gesendet.",

'HELP_SHOP_MAIN_OWNEREMAIL'					=>	"Wenn Benutzer bestellen, wird an Sie als eShop-Administrator eine E-Mail gesendet, dass eine Bestellung im eShop gemacht wurde. Diese E-Mails werden an <var>Bestellungen an</var> gesendet.",



'HELP_ARTICLE_STOCK_STOCKFLAG'				=>	"Hier können Sie einstellen, wie sich der eShop verhält, wenn der Artikel ausverkauft ist:<br>" .
                                                "<ul><li>Standard: Der Artikel kann auch dann bestellt werden, wenn er ausverkauft ist.</li>" .
                                                "<li>Fremdlager: Der Artikel kann immer gekauft werden und wird immer als &quot;auf Lager&quot; angezeigt. (In einem Fremdlager kann der Lagerbestand nicht ermittelt werden. Deswegen wird der Artikel immer als „auf Lager“ geführt).</li>" .
                                                "<li>Wenn Ausverkauft offline: Der Artikel wird nicht angezeigt, wenn er ausverkauft ist.</li>" .
                                                "<li>Wenn Ausverkauft nicht bestellbar: Der Artikel wird angezeigt, wenn er ausverkauft ist, aber er kann nicht bestellt werden.</li></ul>",

'HELP_ARTICLE_STOCK_REMINDACTIV'			=>	"Hier können Sie einrichten, dass Ihnen eine E-Mail gesendet wird, sobald der der Lagerbestand unter den hier eingegebenen Wert sinkt. Dadurch werden Sie rechtzeitig informiert, wenn der Artikel fast ausverkauft ist. Setzen Sie hierzu das Häkchen und geben Sie den Bestand ein, ab dem Sie informiert werden wollen.",

'HELP_ARTICLE_STOCK_DELIVERY'				=>	"Hier können Sie eingeben, ab wann ein Artikel wieder lieferbar ist, wenn er ausverkauft ist. Das Format ist Jahr-Monat-Tag, z. B. 2008-10-21.",



'HELP_DELIVERY_MAIN_COUNTRULES'				=>	"Mit dieser Einstellung können Sie auswählen, wie oft der Preis Auf-/Abschlag berechnet wird:<br>" .
                                                "<ul><li>Einmal pro Warenkorb: Der Preis wird einmal für die gesamte Bestellung berechnet.</li>" .
                                                "<li>Einmal pro unterschiedlichem Artikel: Der Preis wird für jeden unterschiedlichen Artikel im Warenkorb einmal berechnet. Wie oft ein Artikel bestellt wird, ist dabei egal.</li>" .
                                                "<li>Für jeden Artikel: Der Preis wird für jeden Artikel im Warenkorb berechnet.</li></ul>",

'HELP_DELIVERY_MAIN_CONDITION'				=>	"Mit Bedingung können Sie einstellen, dass die Versandkostenregel nur für eine bestimmte Bedingung gültig ist. Sie können zwischen 4 Bedingungen wählen:<br>" .
                                                "<ul><li>Menge: Anzahl aller Artikel im Warenkorb.</li>" .
                                                "<li>Größe: Die Gesamtgröße aller Artikel.</li>" .
                                                "<li>Gewicht: Das Gesamtgewicht der Bestellung in Kilogramm.</li>" .
                                                "<li>Preis: Der Einkaufswert der Bestellung.</li></ul>" .
                                                "Mit den Eingabefeldern <b>&gt;=</b> (größer gleich) und <b>&lt;=</b> (kleiner gleich) können Sie den Bereich einstellen, für den die Bedingung gültig sein soll. Bei <b>&lt;=</b> muss eine größere Zahl als bei <b>&gt;=</b> eingegeben werden.",



'HELP_DELIVERYSET_MAIN_POS'					=>	"Die Sortierung gibt an, in welcher Reihenfolge die Versandarten den Benutzern angezeigt werden:<br>" .
                                                "<ul><li>Die Versandart mit der niedrigsten Zahl wird ganz oben angezeigt.</li>" .
                                                "<li>Die Versandart mit der höchsten Zahl wird ganz unten angezeigt.</li></ul>",



'HELP_PAYMENT_MAIN_SORT'					=>	"Die Sortierung gibt an, in welcher Reihenfolge die Zahlungsarten den Benutzern angezeigt werden:<br>" .
                                                "<ul><li>Die Zahlungsart mit der niedrigsten Sortierung wird an erster Stelle angezeigt.</li>" .
                                                "<li>Die Zahlungsart mit der höchten Sortierung wird an letzter Stelle angezeigt.</li></ul>",

'HELP_PAYMENT_MAIN_FROMBONI'				=>	"Hier können Sie einstellen, dass die Zahlungsarten nur Benutzern zur Verfügung stehen, die mindestens einen bestimmten Bonitätsindex haben. Den Bonitätsindex können Sie für jeden Benutzer unter <b><i><Benutzer verwalten -&gt; Benutzer -&gt; Erweitert</i></b> eingeben",



'HELP_CATEGORY_MAIN_SORT'					=>	"Mit Sortierung können Sie festlegen, in welcher Reihenfolge die Kategorien angezeigt werden: Die Kategorie mit der kleinsten Zahl wird oben angezeigt, die Kategorie mit der größten Zahl unten.",

'HELP_CATEGORY_MAIN_PRICEFROMTILL'			=>	"Mit Preis von/bis können Aie einstellen, dass in der Kategorie nur die zugeordneten Artikel angezeigt werden, die einen bestimmten Preis haben. Im ersten Eingabefeld wird die Untergrenze eingegeben, in das zweite Eingabefeld die Obergrenze.<br>" .
                                                "<b>Wenn alle zugeordneten Artikel angezeigt werden sollen, dann geben Sie in Preis von/bis nichts ein!</b>",                                              
);


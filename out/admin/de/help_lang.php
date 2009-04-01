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
 * @copyright (C) OXID eSales AG 2003-2009
 * $Id: help_lang.php 17699 2009-03-31 13:29:49Z arvydas $
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
 * 		In some cases, in lang.php GENERAL_ identifiers are used. In this file, always the tab name is used.
 *
 *   3) Links to Manual pages
 *      Syntax for identifier: MANUAL_TABNAME, e.g. MANUAL_ARTICLE_EXTENDED
 *
 *
 * HTML Tags for markup:
 * <var>...</var> for names of input fields, selectlists and Buttons, e.g. <var>Active</var>
 * <code>...</code> for preformatted text
 * <kdb>...</kdb> for input in input fields (also options in selectlists)
 * <strong>...</strong> for warning and important things
 * <ul><li> for lists
 */

$aLang =  array(
'HELP_SHOP_SYSTEM_OTHERCOUNTRYORDER'			=> 	"Diese Einstellung beeinflusst das Verhalten des OXID eShops, wenn f�r ein Land, in das Benutzer bestellen wollen, keine Versandkosten definiert sind:<br />" .
                                                    "<ul><li>Wenn die Einstellung aktiv ist, erhalten diese Benutzer im Bestellprozess eine Meldung: Die Versandkosten werden ihnen nachtr�glich mitgeteilt, wenn Sie damit einverstanden ist. Sie k�nnen mit der Bestellung fortfahren.</li>" .
                                                    "<li>Wenn die Option ausgeschaltet ist, k�nnen Benutzer aus L�ndern, f�r die keine Versandkosten definiert sind, nicht bestellen.</li></ul>",

'HELP_SHOP_SYSTEM_DISABLENAVBARS'				=>	"Wenn Sie diese Einstellung aktivieren, werden die meisten Navigationselemente im Bestellprozess ausgeblendet. Dadurch werden die Benutzer beim Bestellen nicht unn�tig abgelenkt.",

'HELP_SHOP_SYSTEM_DEFAULTIMAGEQUALITY'			=>	"Empfehlenswerte Einstellungen sind ca. 40-80:<br />" .
                                                    "<ul><li>Unterhalb von ca. 40 werden deutliche Kompressionsartefakte sichtbar, und die Bilder wirken unscharf.</li>".
                                                    "<li>Oberhalb von ca. 80 kann man kaum eine Verbesserung der Bildqualit�t feststellen, w�hrend die Dateigr��e enorm zunimmt.</li></ul><br />".
                                                    "Die Standardeinstellung ist 75.",

'HELP_SHOP_SYSTEM_SHOWVARIANTREVIEWS'			=>	"Diese Einstellung beeinflusst das Verhalten, wenn Varianten bewertet werden: Wenn die Einstellung aktiv ist, dann werden die Bewertungen der Varianten auch beim Vater-Artikel angezeigt.",

'HELP_SHOP_SYSTEM_VARIANTSSELECTION'			=>	"Im eShop gibt es oft Listen, in denen Sie Artikel zuordnen k�nnen, z. B. wenn Sie Artikel zu Rabatten zuordnen. Wenn die Einstellung aktiv ist, werden in diesen Listen auch  Varianten angezeigt.",

'HELP_SHOP_SYSTEM_VARIANTPARENTBUYABLE'			=>	"Hier k�nnen Sie einstellen, ob der Vater-Artikel gekauft werden kann:" .
                                                    "<ul><li>Wenn die Einstellung aktiv ist, kann auch der Vater-Artikel gekauft werden.</li>" .
                                                    "<li>Wenn die Einstellung nicht aktiv ist, k�nnen nur die Varianten gekauft werden.</li></ul>",

'HELP_SHOP_SYSTEM_VARIANTINHERITAMOUNTPRICE'	=>	"Diese Einstellung beeinflusst das Verhalten des eShops, wenn beim Vater-Artikel Staffelpreise eingerichtet sind: Wenn die Einstellung aktiv ist, werden die Staffelpreise auch bei den Varianten verwendet.",

'HELP_SHOP_SYSTEM_ISERVERTIMESHIFT'				=>	"Es kann sein, dass sich der Server in einer anderen Zeitzone befindet. Mit dieser Einstellung k�nnen Sie die Zeitverschiebung korrigieren: Geben Sie die Anzahl der Stunden, die zur Serverzeit addiert/abgezogen werden sollen ein, z. B. <kdb>+2</kdb> oder <kdb>-2</kdb>",

'HELP_SHOP_SYSTEM_INLINEIMGEMAIL'				=>	"Wenn die Einstellung aktiv ist, werden die Bilder, die in E-Mails verwendet werden, zusammen mit der E-Mail versendet. Wenn die Einstellung nicht aktiv ist, l�dt das E-Mail Programm die Bilder herunter, wenn Benutzer die E-Mail �ffnen.",



'HELP_SHOP_CONFIG_TOPNAVILAYOUT'				=>	"In der Kategorien-Navigation werden die Kategorien angezeigt. Die Kategorien-Navigation wird normalerweise links angezeigt. Wenn Sie diese Einstellung aktivieren, wird die Kategorien-Navigation anstatt links oben angezeigt.",

'HELP_SHOP_CONFIG_ORDEROPTINEMAIL'				=>	"Wenn Double-Opt-In aktiviert ist, erhalten die Benutzer eine E-Mail mit einem Best�tigungs-Link, wenn sie sich f�r den Newsletter registrieren. Erst, wenn sie diesen Link besuchen, sind sie f�r den Newsletter angemeldet.<br />" .
                                                    "Double-Opt-In sch�tzt vor Anmeldungen, die nicht gewollt sind. Ohne Double-Opt-In k�nnen beliebige E-Mail Adressen f�r den Newsletter angemeldet werden. Dies wird z. B. auch von Spam-Robotern gemacht. Durch Double-Opt-In kann der Besitzer der E-Mail Adresse best�tigen, dass er den Newsletter wirklich empfangen will.",

'HELP_SHOP_CONFIG_BIDIRECTCROSS'				=>	"Durch Crossselling k�nnen zu einem Artikel passende Artikel angeboten werden. Crossselling-Artikel werden im eShop bei <i>Kennen Sie schon?</i> angezeigt.<br />" .
                                                    "Wenn z. B. einem Auto als Crossselling-Artikel Winterreifen zugeordnet sind, werden beim Auto die Winterreifen angezeigt." .
                                                    "Wenn Bidirektionales Crossselling aktiviert ist, funktioniert Crossselling in beide Richtungen: bei den Winterreifen wird das Auto angezeigt.",

'HELP_SHOP_CONFIG_ICONSIZE'						=>	"Icons sind die kleinsten Bilder eines Artikels. Icons werden z. B. <br />" .
                                                    "<ul><li>im Warenkorb angezeigt.</li>" .
                                                    "<li>angezeigt, wenn Artikel in der rechten Leiste aufgelistet werden (z.B. bei den Aktionen <i>Top of the Shop</i> und <i>Schn�ppchen</i>.</li></ul>" .
                                                    "Damit das Design des eShops nicht durch zu gro�e Icons gest�rt wird, werden zu gro�e Icons automatisch verkleinert. Die maximale Gr��e k�nnen Sie hier eingeben.<br />" ,

'HELP_SHOP_CONFIG_THUMBNAILSIZE'				=>  "Thumbnails sind kleine Bilder eines Artikels. Thumbnails werden z. B. <br />" .
                                                    "<ul><li>in Artikellisten angezeigt. Artikellisten sind z. B. Kategorieansichten (alle Artikel in einer Kategorie werden aufgelistet) und die Suchergebnisse.</li>" .
                                                    "<li>in Aktionen angezeigt, die in der Mitte der Startseite angezeigt werden, z. B. <i>Die Dauerbrenner</i> und <i>Frisch eingetroffen!</i>.</li></ul>" .
                                                    "Damit das Design des eShops nicht durch zu gro�e Thumbnails gest�rt wird, werden zu gro�e Thumbnails automatisch verkleinert. Die maximale Gr��e k�nnen Sie hier eingeben.",

'HELP_SHOP_CONFIG_STOCKONDEFAULTMESSAGE'		=>	"Bei jedem Artikel k�nnen Sie einrichten, welche Meldung den Benutzern angezeigt wird, wenn der Artikel auf Lager ist. " .
                                                    'Wenn diese Einstellung aktiv ist, wird den Benutzern auch dann eine Meldung angezeigt, wenn bei einem Artikel keine eigene Meldung hinterlegt ist. Dann die Standardmeldung "sofort lieferbar" angezeigt.',

'HELP_SHOP_CONFIG_STOCKOFFDEFAULTMESSAGE'		=>	"Bei jedem Artikel k�nnen Sie einrichten, welche Meldung den Benutzern angezeigt wird, wenn der Artikel nicht auf Lager ist. " .
                                                    'Wenn diese Einstellung aktiv ist, wird den Benutzern auch dann eine Meldung angezeigt, wenn bei einem Artikel keine eigene Meldung hinterlegt ist. Dann die Standardmeldung "Dieser Artikel ist nicht auf Lager und muss erst nachbestellt werden" angezeigt.',

'HELP_SHOP_CONFIG_OVERRIDEZEROABCPRICES'		=>	"Sie k�nnen f�r bestimmte Benutzer spezielle Preise einrichten. Dadurch k�nnen Sie bei jedem Artikel A, B, und C-Preise eingeben. Wenn Benutzer z. B. in der Benutzergruppe Preis A sind, werden ihnen die A-Preise anstatt dem normalen Artikelpreis angezeigt.<br />" .
                                                    "Wenn die Einstellung aktiv ist, wird diesen Benutzern der normale Artikelpreis angezeigt, wenn f�r den Artikel kein A, B oder C-Preis vorhanden ist.<br />" .
                                                    "Sie sollten diese Einstellung aktivieren, wenn Sie A,B und C-Preise verwenden: Ansonsten wird den bestimmten Benutzern ein Preis von 0,00 angezeigt, wenn kein A,B oder C-Preis hinterlegt ist.",

'HELP_SHOP_CONFIG_SEARCHFIELDS'					=>	"Hier k�nnen Sie die Datenbankfelder der Artikel eingeben, in denen gesucht wird. Geben Sie pro Zeile nur ein Datenbankfeld ein.<br />" .
                                                    "Die am h�ufigsten ben�tigten Eintr�ge sind:" .
                                                    "<ul><li>oxtitle = Titel (Name) der Artikel</li>" .
                                                    "<li>oxshortdesc = Kurzbeschreibung der Artikel</li>" .
                                                    "<li>oxsearchkeys = Suchw�rter, die bei den Artikeln eingetragen sind</li>" .
                                                    "<li>oxartnum = Artikelnummern</li>" .
                                                    "<li>oxtags	= Stichworte, bei den Artikeln eingetragen sind</li></ul>",

'HELP_SHOP_CONFIG_SORTFIELDS'					=>	"Hier k�nnen Sie die Datenbankfelder der Artikel eingeben, nach denen Artikellisten sortiert werden k�nnen. Geben Sie pro Zeile nur ein Datenbankfeld ein.<br />" .
                                                    "Die am h�ufigsten ben�tigten Eintr�ge sind:" .
                                                    "<ul><li>oxtitle = Titel (Name) der Artikel</li>" .
                                                    "<li>oxprice = Preis der Artikel</li>" .
                                                    "<li>oxvarminprice = Der niedrigste Preis der Artikel, wenn Varianten mit verschiedenen Preisen verwendet werden.</li>" .
                                                    "<li>oxartnum = Artikelnummern</li>" .
                                                    "<li>oxrating = Die Bewertung der Artikel</li>" .
                                                    "<li>oxstock = Lagerbestand der Artikel</li></ul>",

'HELP_SHOP_CONFIG_MUSTFILLFIELDS'				=>	"Hier k�nnen Sie eingeben, welche Felder von Benutzern ausgef�llt werden m�ssen, wenn Sie sich registrieren. Sie m�ssen die entsprechenden Datenbankfelder angeben. Geben Sie pro Zeile nur ein Datenbankfeld ein.<br />" .
                                                    "Die am h�ufigsten ben�tigten Eintr�ge f�r die Benutzerdaten sind:" .
                                                    "<ul><li>oxuser__oxfname = Vorname</li>" .
                                                    "<li>oxuser__oxlname = Nachname</li>" .
                                                    "<li>oxuser__oxstreet = Stra�e</li>" .
                                                    "<li>oxuser__oxstreetnr = Hausnummer</li>" .
                                                    "<li>oxuser__oxzip = Postleitzahl</li>" .
                                                    "<li>oxuser__oxcity = Stadt</li>" .
                                                    "<li>oxuser__oxcountryid = Land</li>" .
                                                    "<li>oxuser__oxfon = Telefonnummer</li></ul><br />" .
                                                    "Sie k�nnen auch angeben, welche Felder ausgef�llt werden m�ssen, wenn Benutzer eine Lieferadresse eingeben. Die am h�ufigsten ben�tigten Eintr�ge sind:" .
                                                    "<ul><li>oxaddress__oxfname = Vorname</li>" .
                                                    "<li>oxaddress__oxlname = Nachname</li>" .
                                                    "<li>oxaddress__oxstreet = Stra�e</li>" .
                                                    "<li>oxaddress__oxstreetnr = Stra�ennummer</li>" .
                                                    "<li>oxaddress__oxzip = Postleitzahl</li>" .
                                                    "<li>oxaddress__oxcity = Stadt</li>" .
                                                    "<li>oxaddress__oxcountryid = Land</li>" .
                                                    "<li>oxaddress__oxfon = Telefonnummer</li></ul>",

'HELP_SHOP_CONFIG_USENEGATIVESTOCK'				=>	"Mit <var>Negative Lagerbest�nde erlauben</var> k�nnen Sie einstellen, welcher Lagerbestand berechnet wird, wenn ein Artikel ausverkauft ist:<br />" .
                                                    "<ul><li>Wenn die Einstellung aktiv ist, werden negative Lagerbest�nde berechnet, wenn weitere Exemplare bestellt werden.</li>" .
                                                    "<li>Wenn die Einstellung nicht aktiv ist, f�llt der Lagerbestand eines Artikels nie unter 0. Auch dann nicht, wenn der Artikel bereits ausverkauft ist und noch weitere Exemplare bestellt werden.</li></ul>",

'HELP_SHOP_CONFIG_NEWARTBYINSERT'  				=>	"Auf der Startseite Ihres eShops werden die unter \"Frisch eingetroffen!\" die neusten Artikel in Ihrem eShop angezeigt. Sie k�nnen die Artikel, die hier angezeigt werden, manuell einstellen oder automatisch berechnen lassen. Mit dieser Einstellung w�hlen Sie, wie die neusten Artikel berechnet werden sollen: Nach dem Datum, an dem die Artikel erstellt wurden, oder nach dem Datum der letzten �nderung.",

'HELP_SHOP_CONFIG_LOAD_DYNAMIC_PAGES'			=>	"Wenn diese Einstellung aktiv ist, werden zus�tzliche Informationen zu anderen OXID-Produkten im Administrationsbereich angezeigt, z. B. zu OXID eFire. Welche Informationen geladen werden, h�ngt vom Standort ihres eShops ab.",

'HELP_SHOP_CONFIG_DELETERATINGLOGS'				=>	"Wenn Benutzer einen Artikel bewerten, k�nnen Sie den Artikel nicht erneut bewerten. Hier k�nnen Sie einstellen, dass die Benutzer nach einer bestimmten Anzahl von Tagen den Artikel erneut bewerten k�nnen.",



'HELP_SHOP_PERF_NEWESTARTICLES'					=>	"In Ihrem eShop wird eine Liste mit den neusten Artikeln (Frisch eingetroffen!) angezeigt. Hier k�nnen Sie einstellen, wie die Liste generiert wird:" .
                                                    "<ul><li><kbd>ausgeschaltet</kbd>: Die Liste wird nicht angezeigt</li>" .
                                                    "<li><kbd>manuell</kbd>: Sie k�nnen unter <em>Kundeninformationen -> Aktionen verwalten</em> in der Aktion <var>Frisch eingetroffen</var> einstellen, welche Artikel in der Liste angezeigt werden</li>" .
                                                    "<li><kbd>automatisch</kbd>: Die Liste der neusten Artikel wird automatisch berechnet.</li></ul>",

'HELP_SHOP_PERF_TOPSELLER'						=>	"In Ihrem eShop wird eine Liste mit den meistverkauften Artikeln (Top of the Shop) angezeigt. Hier k�nnen Sie einstellen, wie die Liste generiert wird:" .
                                                    "<ul><li><kbd>ausgeschaltet</kbd>: Die Liste wird nicht angezeigt</li>" .
                                                    "<li><kbd>manuell</kbd>: Sie k�nnen unter <em>Kundeninformationen -> Aktionen verwalten</em> in der Aktion <var>Topseller</var> einstellen, welche Artikel in der Liste angezeigt werden</li>" .
                                                    "<li><kbd>automatisch</kbd>: Die Liste der meistverkauften Artikel wird automatisch berechnet.</li></ul>",

'HELP_SHOP_PERF_LOADFULLTREE'					=>	"Wenn die Einstellung aktiv ist, wird in der Kategoriennavigation der komplette Kategoriebaum angezeigt (Alle Kategorien sind \"ausgeklappt\"). Diese Einstellung funktioniert nur, wenn die Kategoriennavigation <strong>nicht</strong> oben angezeigt wird.",

'HELP_SHOP_PERF_LOADACTION'						=>	"Wenn die Einstellung aktiv ist, werden Aktionen wie 'Die Dauerbrenner', 'Top of the Shop', 'Frisch eingetroffen!' geladen und angezeigt.",

'HELP_SHOP_PERF_LOADREVIEWS'					=>	"Benutzer k�nnen Artikel bewerten und Kommentare zu Artikeln verfassen. Wenn die Einstellung aktiv ist, werden die bereits abgegebenen Kommentare und Bewertungen beim Artikel angezeigt.",

'HELP_SHOP_PERF_USESELECTLISTPRICE'				=>	"In Auswahllisten k�nnen Sie Preis Auf/Abschl�ge einstellen. Wenn diese Einstellung aktiv ist, werden die Auf/Abschl�ge berechnet, ansonsten nicht.",

'HELP_SHOP_PERF_DISBASKETSAVING'				=>	"Der Warenkorb von angemeldeten Benutzern wird gespeichert. Wenn sich die Benutzer bei einem weiteren Besuch in Ihrem eShop anmelden, wird der gespeicherte Warenkorb automatisch wieder geladen. Wenn sie diese Einstellung aktivieren, werden die Warenk�rbe nicht mehr gespeichert.",

'HELP_SHOP_PERF_LOADDELIVERY'					=>	"Wenn Sie diese Einstellung ausschalten, berechnet der eShop keine Versandkosten: es werden immer 0,00 EUR als Versandkosten angegeben.",

'HELP_SHOP_PERF_LOADPRICE'						=>	"Wenn Sie diese Einstellung ausschalten, wird der Artikelpreis nicht mehr berechnet und bei den Artikeln kein Preis mehr angezeigt. ",

'HELP_SHOP_PERF_PARSELONGDESCINSMARTY'			=>	"Wenn die Einstellung aktiv ist, werden die Beschreibungstexte von Artikeln und Kategorien mit Smarty ausgef�hrt: Dann k�nnen Sie Smarty-Tags in die Beschreibungstexte einbinden (z. B. Variablen ausgeben). <br />" .
                                                    "Wenn die Einstellung nicht aktiv ist, werden die Beschreibungstexte so eingegeben, wie sie im Editor eingegeben werden.",

'HELP_SHOP_PERF_LOADATTRIBUTES'					=>	"Normalerweise werden die Attribute eines Artikels nur in der Detailansicht des Artikels geladen. Wenn die Einstellung aktiv ist, werden die Attribute immer zusammen mit dem Artikel geladen (z. B. wenn der Artikel in einem Suchergebnis vorkommt).<br />" .
                                                    "Diese Einstellung kann n�tzlich sein, wenn Sie die Templates anpassen und die Attribute eines Artikels auch an anderen Stellen anzeigen m�chten.",
'HELP_SHOP_PERF_LOADSELECTLISTSINALIST'			=>	"Normalerweise werden Auswahllisten nur in der Detailansicht eines Artikels angezeigt. Wenn Sie die Einstellung aktivieren, werden die Auswahllisten auch in Artikellisten (z. B. Suchergebnisse, Kategorieansichten) angezeigt.",



'HELP_SHOP_SEO_TITLEPREFIX'						=>	"Jede einzelne Seite hat einen Titel. Er wird im Browser als Titel des Browser-Fensters angezeigt. Mit Titel Prefix und Titel Postfix haben Sie die M�glichkeit, vor und hinter jeden Seitentitel Text einzuf�gen:<br />" .
                                                    "<ul><li>Geben Sie in <var>Titel Prefix</var> den Text ein, der vor dem Titel erscheinen soll.</li>" .
                                                    "<li>Geben Sie in <var>Titel Postfix</var> den Text ein, der hinter dem Titel erscheinen soll.</li></ul>",

'HELP_SHOP_SEO_TITLESUFFIX'						=>	"Jede einzelne Seite hat einen Titel. Er wird im Browser als Titel des Browser-Fensters angezeigt. Mit Titel Prefix und Titel Postfix haben Sie die M�glichkeit, vor und hinter jeden Seitentitel Text einzuf�gen:<br />" .
                                                    "<ul><li>Geben Sie Titel Prefix den Text ein, der vor dem Titel erscheinen soll.</li>" .
                                                    "<li>Geben Sie in Titel Postfix den Text ein, der hinter dem Titel erscheinen soll.</li></ul>",

'HELP_SHOP_SEO_IDSSEPARATOR'					=>	"Das Trennzeichen wird verwendet, wenn Kategorie- oder Artikelnamen aus mehreren Worten bestehen. Das Trennzeichen wird anstelle eines Leerzeichens in die URL eingef�gt, z. B. www.ihronlineshop.de/Kategorie-aus-mehreren-Worten/Artikel-aus-mehreren-Worten.html<br />" .
                                                    "Wenn Sie kein Trennzeichen eingeben, wird der Bindestrich - als Trennzeichen verwendet",

'HELP_SHOP_SEO_SAFESEOPREF'						=>	"Wenn mehrere Artikel den gleichen Namen haben und in der gleichen Kategorie sind, w�rden sie die gleiche SEO URL erhalten. Damit das nicht passiert, wird das SEO Suffix angeh�ngt. Dadurch werden gleiche SEO URLs vermieden. Wenn Sie kein SEO Suffix angeben, wird 'oxid' als Standard verwendet.",

'HELP_SHOP_SEO_REPLACECHARS'					=>	"Bestimmte Sonderzeichen wie Umlaute (�,�,�) sollten in URLs nicht vorkommen, da Sie Probleme verursachen k�nnen. In dem Eingabefeld wird angegeben, mit welchen Zeichen die Sonderzeichen ersetzt werden. Die Syntax ist <code>Sonderzeichen => Ersatzzeichen</code>, z. B. <code>� => Ue</code>.<br />" .
                                                    "F�r die deutsche Sprache sind die Ersetzungen bereits eingetragen.",

'HELP_SHOP_SEO_RESERVEDWORDS'					=>	"Bestimmte URLs sind im eShop festgelegt, z.B. www.ihronlineshop.de/admin, um den Administrationsbereich zu �ffnen. Wenn eine Kategorie 'admin' hei�en w�rde, w�re die SEO URL zu dieser Kategorie ebenfalls www.ihronlineshop.de/admin - die Kategorie k�nnte nicht ge�ffnet werden. Deswegen wird an solche SEO URLs automatisch das SEO Suffix angeh�ngt. Mit dem Eingabefeld k�nnen Sie einstellen, an welche SEO URLs das SEO Suffix automatisch angeh�ngt werden soll.",

'HELP_SHOP_SEO_SKIPTAGS'						=>	"Wenn bei Artikeln oder Kategorien keine SEO-Einstellungen f�r die META-Tags vorhanden sind, werden diese Informationen aus der Beschreibung generiert. Dabei k�nnen W�rter weggelassen werden, die besonders h�ufig vorkommen. Alle W�rter die in diesem Eingabefeld stehen, werden bei der automatischen Generierung ignoriert.",

'HELP_SHOP_SEO_STATICURLS'						=>	"F�r bestimmte Seiten (z. B. AGB's) im eShop k�nnen Sie feste suchmaschinenfreundliche URLs festlegen. Wenn Sie eine statische URL ausw�hlen, wird in dem Feld <var>Standard URL</var> die normale URL angezeigt. In den Eingabefeldern weiter unten k�nnen Sie f�r jede Sprache suchmaschinenfreundliche URLs eingeben.",



'HELP_SHOP_MAIN_PRODUCTIVE'						=>	"Wenn die Einstellung <b>nicht</b> aktiv ist, werden am unteren Ende jeder Seite Informationen zu Ladezeiten angezeigt. Au�erdem werden Debug-Informationen angezeigt. Diese Informationen sind f�r Entwickler wichtig, wenn sie den OXID eShop anpassen.<br />" .
                                                    "<b>Aktivieren Sie diese Einstellung, bevor ihr eShop �ffentlich zug�nglich gemacht wird! Dadurch wird den Benutzern nur der eShop ohne die zus�tzlichen Informationen angezeigt.</b>",

'HELP_SHOP_MAIN_ACTIVE'							=>	"Mit <var>Aktiv</var> k�nnen Sie ihren kompletten eShop ein- und ausschalten. Wenn ihr eShop ausgeschaltet ist, wird Ihren Kunden eine Meldung angezeigt, dass der eShop vor�bergehend offline ist. Das kann f�r Wartungsarbeiten am eShop n�tzlich sein.",

'HELP_SHOP_MAIN_INFOEMAIL'						=>	"An diese E-Mail Adresse werden E-Mails gesendet, wenn die Benutzer E-Mails �ber das Kontaktformular senden.",

'HELP_SHOP_MAIN_ORDEREMAIL'						=>	"Wenn Benutzer bestellen, erhalten sie eine E-Mail, in der die Bestellung nochmals zusammengefasst ist. Wenn die Benutzer auf diese E-Mail antworten, wird die Antwort an die <var>Bestell E-Mail Reply</var> gesendet.",

'HELP_SHOP_MAIN_OWNEREMAIL'						=>	"Wenn Benutzer bestellen, wird an Sie als eShop-Administrator eine E-Mail gesendet, dass eine Bestellung im eShop gemacht wurde. Diese E-Mails werden an <var>Bestellungen an</var> gesendet.",



'HELP_ARTICLE_MAIN_ALDPRICE'					=>	"Mit <var>Alt. Preise</var> k�nnen Sie f�r bestimmte Benutzer spezielle Preise einrichten. Wie das funktioniert, erfahren Sie im <a href=\"http://www.oxid-esales.com/de/resources/help-faq/eshop-manual/fuer-bestimmte-benutzer-besondere-preise-einrichten\">Handbuch auf der OXID eSales Website.</a>.",



'HELP_ARTICLE_EXTEND_UNITQUANTITY'				=>	"Mit <var>Menge</var> und <var>Mengeneinheit</var> k�nnen Sie den Grundpreis des Artikels (Preis pro Mengeneinheit) einstellen (z. B. 1,43 EUR pro Liter): Geben Sie bei <var>Menge</var> die Menge des Artikels (z. B. 1,5) und bei <var>Mengeneinheit</var> die entsprechende Mengeneinheit (z. B. Liter) ein. Dann wird der Grundpreis pro Mengeneinheit berechnet und beim Artikel angezeigt.",

'HELP_ARTICLE_EXTEND_EXTURL'					=>	"Bei <var>Externe URL</var> k�nnen Sie einen Link eingeben, wo weitere Informationen zu dem Artikel erh�ltlich sind (z. B. auf der Hersteller-Website). Bei <var>Text f�r ext. URL</var> k�nnen Sie den Text eingeben, der verlinkt wird (z. B. <kbd>weitere Informationen vom Hersteller</kbd>).",

'HELP_ARTICLE_EXTEND_TPRICE'					=>	"Bei <var>UVP</var> k�nnen Sie die Unverbindliche Preisempfehlung des Herstellers eingeben. Wenn Sie die UVP eingeben, wird diese den Benutzern angezeigt: Beim Artikel wird �ber dem Preis \"statt UVP nur\" angezeigt.",

'HELP_ARTICLE_EXTEND_QUESTIONEMAIL'				=>	"Bei <var>Alt. Anspr.partn.</var> k�nnen Sie eine E-Mail Adresse eingeben. Wenn die Benutzer eine Frage zu diesem Artikel absenden, wird Sie an diese E-Mail Adresse geschickt. Wenn keine E-Mail Adresse eingetragen ist, wird die Anfrage an die normale Info E-Mail Adresse geschickt.",

'HELP_ARTICLE_EXTEND_SKIPDISCOUNTS'				=>	"Wenn <var>Alle neg. Nachl�sse ignorieren</var> aktiviert ist, werden f�r diesen Artikel keine negativen Nachl�sse berechnet. Das sind z. B. Rabatte und Gutscheine.",



'HELP_ARTICLE_STOCK_STOCKFLAG'					=>	"Hier k�nnen Sie einstellen, wie sich der eShop verh�lt, wenn der Artikel ausverkauft ist:<br />" .
                                                    "<ul><li>Standard: Der Artikel kann auch dann bestellt werden, wenn er ausverkauft ist.</li>" .
                                                    '<li>Fremdlager: Der Artikel kann immer gekauft werden und wird immer als "auf Lager" angezeigt. (In einem Fremdlager kann der Lagerbestand nicht ermittelt werden. Deswegen wird der Artikel immer als ⤸auf Lager⤽ gef�hrt).</li>' .
                                                    "<li>Wenn Ausverkauft offline: Der Artikel wird nicht angezeigt, wenn er ausverkauft ist.</li>" .
                                                    "<li>Wenn Ausverkauft nicht bestellbar: Der Artikel wird angezeigt, wenn er ausverkauft ist, aber er kann nicht bestellt werden.</li></ul>",

'HELP_ARTICLE_STOCK_REMINDACTIV'				=>	"Hier k�nnen Sie einrichten, dass Ihnen eine E-Mail gesendet wird, sobald der der Lagerbestand unter den hier eingegebenen Wert sinkt. Dadurch werden Sie rechtzeitig informiert, wenn der Artikel fast ausverkauft ist. Setzen Sie hierzu das H�kchen und geben Sie den Bestand ein, ab dem Sie informiert werden wollen.",

'HELP_ARTICLE_STOCK_DELIVERY'					=>	"Hier k�nnen Sie eingeben, ab wann ein Artikel wieder lieferbar ist, wenn er ausverkauft ist. Das Format ist Jahr-Monat-Tag, z. B. 2008-10-21.",



'HELP_ARTICLE_SEO_FIXED'						=>	"Sie k�nnen die SEO URLs vom eShop neu berechnen lassen. Eine Artikelseite bekommt z. B. eine neue SEO URL, wenn Sie den Titel des Artikels �ndern. Die Einstellung <var>URL fixiert</var> unterbindet das: Wenn sie aktiv ist, wird die alte SEO URL beibehalten und keine neue SEO URL berechnet.",

'HELP_ARTICLE_SEO_KEYWORDS'						=>	"Diese Stichw�rter werden in den HTML-Quelltext (Meta Keywords) eingebunden. Diese Information wird von Suchmaschinen ausgewertet. Hier k�nnen Sie passende Stichw�rter zu dem Artikel eingeben. Wenn Sie nichts eingeben, werden die Stichw�rter automatisch erzeugt.",

'HELP_ARTICLE_SEO_DESCRIPTION'					=>	"Dieser Beschreibungstext wird in den HTML-Quelltext (Meta Description) eingebunden. Dieser Text wird von vielen Suchmaschinen bei den Suchergebnissen angezeigt. Hier k�nnen Sie eine passende Beschreibung zu dem Artikel eingeben. Wenn Sie nichts eingeben, wird die Beschreibung automatisch erzeugt.",

'HELP_ARTICLE_SEO_ACTCAT'						=>	"Sie k�nnen f�r einen Artikel unterschiedliche SEO URLs festlegen: F�r bestimmte Kategorien und f�r den Hersteller des Artikels. Mit <var>Aktive Kategorie/Hersteller</var> k�nnen Sie w�hlen, welche SEO URL Sie anpassen m�chten.",



'HELP_CATEGORY_MAIN_HIDDEN'						=>	"Mit <var>Versteckt</var> k�nnen Sie einstellen, ob die Kategorie den Benutzern angezeigt werden soll. Wenn eine Kategorie versteckt ist, wird Sie den Benutzern nicht angezeigt, auch wenn die Kategorie aktiv ist.",

'HELP_CATEGORY_MAIN_PARENTID'					=>	"Bei <var>Unterkategorie von</var> stellen Sie ein, an welcher Stelle die Kategorie erscheinen soll:" .
                                                    "<ul>" .
                                                    "<li>Wenn die Kategorie keiner anderen Kategorie untergeordnet sein soll, dann w�hlen Sie <kbd>--</kbd> aus.</li>" .
                                                    "<li>Wenn die Kategorie einer anderen Kategorie untergeordnet sein soll, dann w�hlen Sie die entsprechende Kategorie aus.</li>",

'HELP_CATEGORY_MAIN_EXTLINK'					=>	"Bei <var>Externer Link</var> k�nnen Sie einen Link eingeben, der ge�ffnet wird, wenn Benutzer auf die Kategorie klicken. <strong>Verwenden Sie diese Funktion nur, wenn Sie einen Link in der Kategorien-Navigation anzeigen wollen. Die Kategorie verliert dadurch Ihre normale Funktion!</strong>",

'HELP_CATEGORY_MAIN_PRICEFROMTILL'				=>	"Mit <var>Preis von/bis</var> k�nnen sie einstellen, dass in der Kategorie <strong>alle</strong> Artikel angezeigt werden, die einen bestimmten Preis haben. Im ersten Eingabefeld wird die Untergrenze eingegeben, in das zweite Eingabefeld die Obergrenze. Dann werden in der Kategorie <strong>alle Artikel Ihres eShops</strong> angezeigt, die einen entsprechenden Preis haben.",

'HELP_CATEGORY_MAIN_DEFSORT'					=>	"Mit <var>Schnellsortierung</var> stellen Sie ein, wie die Artikel in der Kategorie sortiert werden. Welche M�glichkeiten Sie haben, erfahren Sie im <a href=\"http://www.oxid-esales.com/de/resources/help-faq/eshop-manual/artikel-sortieren\">eShop Handbuch</a> auf der OXID eSsales Website.",

'HELP_CATEGORY_MAIN_SORT'						=>	"Mit <var>Sortierung</var> k�nnen Sie festlegen, in welcher Reihenfolge die Kategorien angezeigt werden: Die Kategorie mit der kleinsten Zahl wird oben angezeigt, die Kategorie mit der gr��ten Zahl unten.",

'HELP_CATEGORY_MAIN_THUMB'						=>	"Bei <var>Bild</var> und <var>Bild hochladen</var> k�nnen Sie ein Bild f�r die Kategorie hochladen. Das Bild wird in der Kategorie oben angezeigt. W�hlen Sie bei <var>Bild hochladen</var> das Bild aus, das Sie hochladen m�chten. Wenn Sie auf Speichern klicken, wird das Bild hochgeladen. Nachdem das Bild hochgeladen ist, wird der Dateiname des Bildes in <var>Bild</var> angezeigt.",

'HEOLP_CATEGORY_MAIN_SKIPDISCOUNTS'				=>	"Wenn<var> Alle neg. Nachl�sse ignorieren</var> aktiv ist, werden f�r alle Artikel in dieser Kategorie keine negativen Nachl�sse berechnet.",



'HELP_CATEGORY_SEO_FIXED'						=>	"Sie k�nnen die SEO URLs vom eShop neu berechnen lassen. Eine Kategorie bekommt z. B. eine neue SEO URL, wenn Sie den Titel der Kategorie �ndern. Die Einstellung <var>URL fixiert</var> unterbindet das: Wenn sie aktiv ist, wird die alte SEO URL beibehalten und keine neue SEO URL berechnet.",

'HELP_CATEGORY_SEO_SHOWSUFFIX'					=>	"Diese Einstellung bestimmt, ob das Suffix f�r den Fenstertitel angezeigt wird, wenn die Kategorieseite im eShop aufgerufen wird. Das Titel Suffix k�nnen Sie unter <em>Stammdaten -> Grundeinstellungen -> SEO -> Titel Suffix</em> einstellen.",

'HELP_CATEGORY_SEO_KEYWORDS'					=>	"Diese Stichw�rter werden in den HTML-Quelltext (Meta Keywords) eingebunden. Diese Information wird von Suchmaschinen ausgewertet. Hier k�nnen Sie passende Stichw�rter zu der Kategorie eingeben. Wenn Sie nichts eingeben, werden die Stichw�rter automatisch erzeugt.",

'HELP_CATEGORY_SEO_DESCRIPTION'					=>	"Dieser Beschreibungstext wird in den HTML-Quelltext (Meta Description) eingebunden. Dieser Text wird von vielen Suchmaschinen bei den Suchergebnissen angezeigt. Hier k�nnen Sie eine passende Beschreibung f�r die Kategorie eingeben. Wenn Sie nichts eingeben, wird die Beschreibung automatisch erzeugt.",



'HELP_CONTENT_MAIN_SNIPPET'						=>	"Wenn Sie <var>Snippet</var> ausw�hlen, k�nnen Sie die CMS-Seite in anderen Seiten mit Hilfe des Idents einbinden: [{ oxcontent ident=\"Ident_der_CMS_Seite\" }]",

'HELP_CONTENT_MAIN_MAINMENU'					=>	"Wenn Sie <var>Hauptmen�</var> ausw�hlen, wird in der oberen Men�leiste ein Link zu der CMS-Seite angezeigt (bei AGB und Impressum).",

'HELP_CONTENT_MAIN_CATEGORY'					=>	"Wenn Sie <var>Kategorie</var> ausw�hlen, wird in der Kategoriennavigation unter den normalen Kategorien ein Link zu der CMS-Seite angezeigt.",

'HELP_CONTENT_MAIN_MANUAL'						=>	"Wenn Sie <var>Manuell</var> ausw�hlen, wird ein Link erzeugt, mit dem Sie die CMS-Seite in andere CMS-Seiten einbinden k�nnen. Der Link wird weiter unten angezeigt, wenn Sie auf Speichern klicken.",



'HELP_CONTENT_SEO_FIXED'						=>	"Sie k�nnen die SEO URLs vom eShop neu berechnen lassen. Eine CMS-Seite bekommt z. B. eine neue SEO URL, wenn Sie den Titel der CMS-Seite �ndern. Die Einstellung <var>URL fixiert</var> unterbindet das: Wenn sie aktiv ist, wird die alte SEO URL beibehalten und keine neue SEO URL berechnet.",

'HELP_CONTENT_SEO_KEYWORDS'						=>	"Diese Stichw�rter werden in den HTML-Quelltext (Meta Keywords) eingebunden. Diese Information wird von Suchmaschinen ausgewertet. Hier k�nnen Sie passende Stichw�rter zu der CMS-Seite eingeben. Wenn Sie nichts eingeben, werden die Stichw�rter automatisch erzeugt.",

'HELP_CONTENT_SEO_DESCRIPTION'					=>	"Dieser Beschreibungstext wird in den HTML-Quelltext (Meta Description) eingebunden. Dieser Text wird von vielen Suchmaschinen bei den Suchergebnissen angezeigt. Hier k�nnen Sie eine passende Beschreibung f�r die CMS-Seite eingeben. Wenn Sie nichts eingeben, wird die Beschreibung automatisch erzeugt.",



'HELP_DELIVERY_MAIN_COUNTRULES'					=>	"Mit dieser Einstellung k�nnen Sie ausw�hlen, wie oft der Preis Auf-/Abschlag berechnet wird:<br />" .
                                                    "<ul><li>Einmal pro Warenkorb: Der Preis wird einmal f�r die gesamte Bestellung berechnet.</li>" .
                                                    "<li>Einmal pro unterschiedlichem Artikel: Der Preis wird f�r jeden unterschiedlichen Artikel im Warenkorb einmal berechnet. Wie oft ein Artikel bestellt wird, ist dabei egal.</li>" .
                                                    "<li>F�r jeden Artikel: Der Preis wird f�r jeden Artikel im Warenkorb berechnet.</li></ul>",

'HELP_DELIVERY_MAIN_CONDITION'					=>	"Mit <var>Bedingung</var> k�nnen Sie einstellen, dass die Versandkostenregel nur f�r eine bestimmte Bedingung g�ltig ist. Sie k�nnen zwischen 4 Bedingungen w�hlen:<br />" .
                                                    "<ul><li>Menge: Anzahl aller Artikel im Warenkorb.</li>" .
                                                    "<li>Gr��e: Die Gesamtgr��e aller Artikel.</li>" .
                                                    "<li>Gewicht: Das Gesamtgewicht der Bestellung in Kilogramm.</li>" .
                                                    "<li>Preis: Der Einkaufswert der Bestellung.</li></ul>" .
                                                    "Mit den Eingabefeldern <b>>=</b> (gr��er gleich) und <b><=</b> (kleiner gleich) k�nnen Sie den Bereich einstellen, f�r den die Bedingung g�ltig sein soll. Bei <b><=</b> muss eine gr��ere Zahl als bei <b>>=</b> eingegeben werden.",

'HELP_DELIVERY_MAIN_PRICE'						=>	"Mit <var>Preis Auf-/Abschlag</var> k�nnen Sie eingeben, wie hoch die Versandkosten sind. Der Preis kann auf zwei verschiedene Arten berechnet werden:" .
                                                    "<ul>" .
                                                    "<li>Mit <kbd>abs</kbd> wird der Preis absolut angegeben (z. B.: Mit <kbd>6,90</kbd> werden 6,90 Euro berechnet).</li>" .
                                                    "<li>Mit <kbd>%</kbd> wird der Preis relativ zum Einkaufswert angegeben (z. B.: Mit <kbd>10</kbd> werden 10% des Einkaufswerts berechnet).</li>",

'HELP_DELIVERY_MAIN_ORDER'						=>	"Mit <var>Reihenfolge der Regelberechnung</var> k�nnen Sie festlegen, in welcher Reihenfolge die Versandkostenregeln berechnet werden: Die Versandkostenregel mit der kleinsten Zahl wird als erstes berechnet. Die Reihenfolge ist wichtig, wenn die Einstellung <var>Keine weiteren Regeln nach dieser berechnen</var> verwendet wird.",

'HELP_DELIVERY_MAIN_FINALIZE'					=>	"Mit <var>Keine weiteren Regeln nach dieser berechnen</var> k�nnen Sie einstellen, dass keine weitere Versandkostenregeln berechnet werden, falls diese Versandkostenregel g�ltig ist und berechnet wird. F�r diese Einstellung ist die Reihenfolge wichtig, in der die Versandkostenregeln berechnet werden: Sie wird durch <var>Reihenfolge der Regelberechnung</var> festgelegt.",



'HELP_DELIVERYSET_MAIN_POS'						=>	"Mit <var>Sortierung</var> k�nnen Sie einstellen, in welcher Reihenfolge die Versandarten den Benutzern angezeigt werden:<br />" .
                                                    "<ul><li>Die Versandart mit der niedrigsten Zahl wird ganz oben angezeigt.</li>" .
                                                    "<li>Die Versandart mit der h�chsten Zahl wird ganz unten angezeigt.</li></ul>",



'HELP_DISCOUNT_MAIN_PRICE'						=>	"Mit <var>Einkaufswert</var> k�nnen Sie einstellen, dass der Rabatt nur f�r bestimmte Einkaufswerte g�ltig ist. Wenn der Rabatt f�r alle Einkaufswerte g�ltig sein soll, dann geben Sie in <var>von</var> <kbd>0</kbd> ein und in <var>bis</var> <kbd>0</kbd> ein.",

'HELP_DISCOUNT_MAIN_AMOUNT'						=>	"Mit <var>Einkaufsmenge</var> k�nnen Sie einstellen, dass der Rabatt nur f�r bestimmte Einkaufsmengen g�ltig ist. Wenn Sie m�chten, dass der Rabatt f�r alle Einkaufsmengen g�ltig ist, dann geben Sie in <var>von</var> <kbd>0</kbd> ein und in <var>bis</var> <kbd>0</kbd> ein.",

'HELP_DISCOUNT_MAIN_REBATE'						=>	"Bei <var>Rabatt</var> stellen Sie ein, wie hoch der Rabatt sein soll. Mit der Auswahlliste hinter dem Eingabefeld k�nnen Sie ausw�hlen, ob der Rabatt absolut oder prozentual sein soll:" .
                                                    "<ul>" .
                                                    "<li><kbd>abs</kbd>: Der Rabatt ist absolut, z. B. 5 Euro.</li>" .
                                                    "<li><kbd>%</kbd>: Der Rabatt ist prozentual, z. B. 10 Prozent vom Einkaufswert.</li>" .
                                                    "</ul>",



'HELP_PAYMENT_MAIN_SORT'						=>	"Mit <var>Sortierung</var> k�nnen Sie einstellen, in welcher Reihenfolge die Zahlungsarten den Benutzern angezeigt werden:<br />" .
                                                    "<ul><li>Die Zahlungsart mit der niedrigsten Zahl wird an erster Stelle angezeigt.</li>" .
                                                    "<li>Die Zahlungsart mit der h�chten Zahl wird an letzter Stelle angezeigt.</li></ul>",

'HELP_PAYMENT_MAIN_FROMBONI'					=>	"Hier k�nnen Sie einstellen, dass die Zahlungsarten nur Benutzern zur Verf�gung stehen, die mindestens einen bestimmten Bonit�tsindex haben. Den Bonit�tsindex k�nnen Sie f�r jeden Benutzer unter <b><i><Benutzer verwalten -> Benutzer -> Erweitert</i></b> eingeben",

'HELP_PAYMENT_MAIN_SELECTED'					=>	"Mit <var>Ausgew�hlt</var> k�nnen Sie bestimmen, welche Zahlungsart als Standard ausgew�hlt sein soll, wenn die Benutzer zwischen den Zahlungsarten w�hlen k�nnen.",

'HELP_PAYMENT_MAIN_AMOUNT'						=>	"Mit <var>Einkaufswert</var> k�nnen Sie einstellen, dass die Zahlungsart nur f�r bestimmte Einkaufswerte g�ltig ist. Mit den Feldern <var>von</var> und <var>bis</var> k�nnen Sie den Bereich einstellen.<br />" .
                                                    "Wenn die Zahlungsart f�r jeden Einkaufswert g�ltig sein soll, m�ssen Sie eine Bedingung eingeben, die immer g�ltig ist: Geben sie in das Feld <var>von</var> <kbd>0</kdb> ein, in das Feld <var>bis</var> <kbd>999999999</kbd>.",

'HELP_PAYMENT_MAIN_ADDPRICE'					=>	"Bei <var>Preis Auf-/Abschlag</var> wird der Preis f�r die Zahlungsart eingegeben. Die Preise k�nnen auf zwei verschiedene Arten angegeben werden:" .
                                                    "<ul>" .
                                                    "<li>Mit <kbd>abs</kbd> wird der Preis absolut angegeben (z. B.: Wenn Sie <kbd>7,50</kbd> eingebem, werden 7,50 Euro berechnet.)</li>" .
                                                    "<li>Mit <kbd>%</kbd> wird der Preis relativ zum Einkaufspreis berechnet (z. B.: Wenn Sie <kbd>2</kbd> eingeben, werden 2 Prozent des Einkaufspreises)</li>",



'HELP_SELECTLIST_MAIN_IDENTTITLE'				=>	"Bei <var>Arbeitstitel</var> k�nnen Sie einen zus�tzlichen Titel eingeben, der den Benutzern Ihres eShops nicht angezeigt wird. Sie k�nnen den Arbeitstitel dazu verwenden um �hnliche Auswahllisten zu unterscheiden (z. B. <i>Gr��e f�r Hosen</i> und <i>Gr��e f�r Hemden</i>).",

'HELP_SELECTLIST_MAIN_FIELDS'					=>	"In der Liste <var>Felder</var> werden alle vorhandenen Ausf�hrungen der Auswahlliste angezeigt. Mit den Eingabefeldern rechts neben <var>Felder</var> k�nnen Sie neue Ausf�hrungen anlegen. Weitere Informationen finden Sie im <a href=\"http://www.oxid-esales.com/de/resources/help-faq/eshop-manual/einfache-varianten-mit-auswahllisten-umsetzen\">eShop Handbuch</a>.",



'HELP_USER_MAIN_HASPASSWORD'					=>	"Hier wird angezeigt, ob der Benutzer ein Passwort hat. Daran k�nnen Sie unterscheiden, ob sich der Benutzer bei der Bestellung registriert hat:" .
                                                    "<ul><li>Wenn ein Passwort vorhanden ist, hat sich der Benutzer registriert.</li>" .
                                                    "<li>Wenn kein Passwort vorhanden ist, hat der Benutzer bestellt ohne sich zu registrieren.</li></ul>",



'HELP_USER_EXTEND_NEWSLETTER'					=>	"Diese Einstellung zeigt an, ob der Benutzer den Newsletter abonniert hat oder nicht.",

'HELP_USER_EXTEND_EMAILFAILED'					=>	"Wenn an die E-Mail Adresse des Benutzers keine E-Mails versendet werden k�nnen (z. B. weil die Adresse falsch eingetragen ist), dann setzen Sie hier das H�kchen. Dann werden dem Benutzer keine Newsletter mehr zugesendet. Andere E-Mails werden weiterhin versendet.",

'HELP_USER_EXTEND_DISABLEAUTOGROUP'				=>	"Die Benutzer werden automatisch zu Benutzergruppen zugeordnet. Wenn Sie diese Einstellung aktivieren, wird dieser Benutzer nicht mehr automatisch zu Benutzergruppen zugeordnet. Die automatischen Benutzergruppen-Zuordnungen werden im <a href=\"http://www.oxid-esales.com/de/resources/help-faq/eshop-manual/automatische-benutzergruppen-zuordnungen\">eShop Handbuch</a> auf der OXID eSales Website aufgelistet.",

'HELP_USER_EXTEND_BONI'							=>	"Hier k�nnen Sie einen Zahlenwert f�r die Bonit�t des Benutzers eingeben. Mit der Bonit�t k�nnen Sie beeinflussen, welche Zahlungsarten dem Benutzer zur Verf�gung stehen.",



'HELP_MANUFACTURER_MAIN_ICON'					=>	"Bei <var>Icon</var> und <var>Hersteller-Icon hochladen</var> k�nnen Sie ein Bild f�r den Hersteller hochladen (z. B. das Logo des Herstellers). W�hlen Sie bei <var>Hersteller-Icon hochladen</var> das Bild aus, das Sie hochladen m�chten. Wenn Sie auf Speichern klicken, wird das Bild hochgeladen. Nachdem das Bild hochgeladen ist, wird der Dateiname des Bildes in <var>Icon</var> angezeigt.",



'HELP_MANUFACTURER_SEO_FIXED'					=>	"Sie k�nnen die SEO URLs vom eShop neu berechnen lassen. Eine Herstellerseite bekommt z. B. eine neue SEO URL, wenn Sie den Titel des Herstellers �ndern. Die Einstellung <var>URL fixiert</var> unterbindet das: Wenn sie aktiv ist, wird die alte SEO URL beibehalten und keine neue SEO URL berechnet.",

'HELP_MANUFACTURER_SEO_SHOWSUFFIX'				=>	"Diese Einstellung bestimmt, ob das Suffix f�r den Fenstertitel angezeigt wird, wenn die Herstellerseite im eShop aufgerufen wird. Das Titel Suffix k�nnen Sie unter <em>Stammdaten -> Grundeinstellungen -> SEO -> Titel Suffix</em> einstellen.",

'HELP_MANUFACTURER_SEO_KEYWORDS'				=>	"Diese Stichw�rter werden in den HTML-Quelltext (Meta Keywords) eingebunden. Diese Information wird von Suchmaschinen ausgewertet. Hier k�nnen Sie passende Stichw�rter zu dem Hersteller eingeben. Wenn Sie nichts eingeben, werden die Stichw�rter automatisch erzeugt.",

'HELP_MANUFACTURER_SEO_DESCRIPTION'				=>	"Dieser Beschreibungstext wird in den HTML-Quelltext (Meta Description) eingebunden. Dieser Text wird von vielen Suchmaschinen bei den Suchergebnissen angezeigt. Hier k�nnen Sie eine passende Beschreibung f�r den Hersteller eingeben. Wenn Sie nichts eingeben, wird die Beschreibung automatisch erzeugt.",


'HELP_VOUCHERSERIE_MAIN_DISCOUNT'				=>	"Bei <var>Rabatt</var> stellen Sie ein, wie hoch der Rabatt des Gutscheins sein soll sein soll. Mit der Auswahlliste hinter dem Eingabefeld k�nnen Sie ausw�hlen, ob der Rabatt absolut oder prozentual sein soll:" .
                                                    "<ul>" .
                                                    "<li><kbd>abs</kbd>: Der Rabatt ist absolut, z. B. 5 Euro.</li>" .
                                                    "<li><kbd>%</kbd>: Der Rabatt ist prozentual, z. B. 10 Prozent vom Einkaufswert.</li>" .
                                                    "</ul>",

'HELP_VOUCHERSERIE_MAIN_ALLOWSAMESERIES'		=>	"Hier k�nnen Sie einstellen, ob Benutzer mehrere Gutscheine dieser Gutscheinserie bei einer Bestellung einl�sen d�rfen.",

'HELP_VOUCHERSERIE_MAIN_ALLOWOTHERSERIES'		=>	"Hier k�nnen Sie einstellen, ob Benutzer Gutscheine verschiedener Gutscheinserien bei einer Bestellung einl�sen d�rfen.",

'HELP_VOUCHERSERIE_MAIN_SAMESEROTHERORDER'		=>	"Hier k�nnen Sie einstellen, ob Benutzer Gutscheine dieser Gutscheinserie bei mehreren Bestellungen einl�sen d�rfen.",

'HELP_VOUCHERSERIE_MAIN_RANDOMNUM'				=>	"Wenn Sie diese Einstellung aktivieren, wird f�r jeden Gutschein eine Zufallsnummer erzeugt.",

'HELP_VOUCHERSERIE_MAIN_VOUCHERNUM'				=>	"Hier k�nnen Sie eine Gutscheinnummer eingeben. Diese wird verwendet wenn Sie neue Gutscheine anlegen. Wenn Sie mehrere Gutscheine anlegen, erhalten alle Gutscheine die gleiche Nummer.",

'HELP_WRAPPING_MAIN_PICTURE'					=>	"Bei <var>Bild</var> und <var>Bild hochladen</var> k�nnen Sie ein Bild f�r die Geschenkverpackung hochladen. W�hlen Sie bei <var>Bild hochladen</var> das Bild aus, das Sie hochladen m�chten. Wenn Sie auf Speichern klicken, wird das Bild hochgeladen. Nachdem das Bild hochgeladen ist, wird der Dateiname des Bildes in <var>Bild</var> angezeigt.",
);

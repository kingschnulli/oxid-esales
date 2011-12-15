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
 * @link      http://www.oxid-esales.com
 * @package   lang
 * @copyright (C) OXID eSales AG 2003-2010
 * @version OXID eShop CE
 * @version   SVN: $Id: cust_lang.php 27028 2010-04-06 07:05:15Z arvydas $
 */

$sLangName  = "Fran�ais";
// -------------------------------
// RESOURCE IDENTITFIER = STRING
// -------------------------------
$aLang = array(
'charset'                                   => 'ISO-8859-15',
'EMAIL_PRICEALARM_CUSTOMER_PRICEALARMIN'    => 'Alerte prix sur ',
'EMAIL_PRICEALARM_CUSTOMER_HY'              => 'Bonjour,',
'EMAIL_PRICEALARM_CUSTOMER_HAVEPRICEALARM'  => 'Nous avons une alerte prix sur',
'EMAIL_PRICEALARM_CUSTOMER_ITEM1'           => 'Le produit',
'EMAIL_PRICEALARM_CUSTOMER_ITEM2'           => "pour lequel vous avez manifest� votre int�r�t et en avez offert un prix de",
'EMAIL_PRICEALARM_CUSTOMER_ITEM3'           => 'est maintenant disponible au prix de',
'EMAIL_PRICEALARM_CUSTOMER_ITEM4'           => '!',
'EMAIL_PRICEALARM_CUSTOMER_CLICKHERE1'      => 'Pour acc�der directement au produit, cliquez ',
'EMAIL_PRICEALARM_CUSTOMER_CLICKHERE2'      => 'ici',
'EMAIL_PRICEALARM_CUSTOMER_TEAM1'           => 'Votre',
'EMAIL_PRICEALARM_CUSTOMER_TEAM2'           => 'Service client',
'EMAIL_SENDEDNOW_HTML_ORDERSHIPPEDTO'       => "La commande est exp�di�e �:",
'EMAIL_SENDEDNOW_HTML_ORDERNOMBER'          => "Commande n�:",
'EMAIL_SENDEDNOW_HTML_QUANTITY'             => "Quantit�",
'EMAIL_SENDEDNOW_HTML_PRODUCT'              => "Produit",
'EMAIL_SENDEDNOW_HTML_PRODUCTRATING'        => "Notation du produit",
'EMAIL_SENDEDNOW_HTML_ARTNOMBER'            => "Produit n�:",
'EMAIL_SENDEDNOW_HTML_REVIEW'               => "Donnez votre avis",
'EMAIL_SENDEDNOW_HTML_YUORTEAM1'            => "Votre",
'EMAIL_SENDEDNOW_HTML_YUORTEAM2'            => "Service client",

//Module VADS
'VADS_MODULE_TITLE'  =>  "Solution de Paiement PayZen",
'VADS_MODULE_DESCRIPTION'  =>  "Vous trouverez plus d\'informations sur la m�thode de paiement PayZen dans la documentation et la F.A.Q. dans la rubrique aide.",
'VADS_SETUP'  =>  "Installer",
'VADS_UPDATE'  =>  "Enregistrer",

'charset'  =>  "ISO-8859-15",
'mxvads'  =>  "Paiements PayZen",
'mxvads_configure'  =>  "Configuration",

//ADMINISTRATION INTERFACE - INFORMATIONS
'VADS_MODULE_INFO'  =>  "Informations sur le module",
'VADS_DEVELOPED_BY'  =>  "D�velopp� par : ",
'VADS_CONTACT_EMAIL'  =>  "Courriel de contact : ",
'VADS_CONTRIB_VERSION'  =>  "Version du module : ",
'VADS_CMS_VERSION'  =>  "Test� avec : ",
'VADS_GATEWAY_VERSION'  =>  "Version de la plateforme : ",

//ADMINISTRATION INTERFACE - PARAMETERS 
'VADS_GATEWAY_ACCESS'  =>  "Acc�s �la plateforme",
'VADS_GATEWAY_URL'  =>  "Url de la plateforme",
'VADS_GATEWAY_URL_DESC'  =>  "Le client sera redirig� � cette adresse pour payer.",
'VADS_SITE_ID'  =>  "Identifiant du Site",
'VADS_SITE_ID_DESC'  =>  "Identifiant fourni par votre banque.",
'VADS_KEY_TEST'  =>  "Certificat en mode test",
'VADS_KEY_TEST_DESC'  =>  "Certificat fourni par PayZen (Disponible sur l\'outil de gestion de caisse).",
'VADS_KEY_PROD'  =>  "Certificat en mode production",
'VADS_KEY_PROD_DESC'  =>  "Certificat fourni par PayZen (Disponible sur l\'outil de gestion de caisse apr�s passage en production).",
'VADS_CTX_MODE'  =>  "Mode",
'VADS_CTX_MODE_DESC'  =>  "Mode de fonctionnement du module.",

'VADS_PAYMENT_PAGE'  =>  "Page de paiement",
'VADS_LANGUAGE'  =>  "Langue par d�faut",
'VADS_LANGUAGE_DESC'  =>  "Langue par d�faut de la page de paiement.",
'VADS_AVAILABLE_LANGUAGES'  =>  "Langues disponibles",
'VADS_AVAILABLE_LANGUAGES_DESC'  =>  "Ne rien s�lectionner pour utiliser la configuration de la plateforme.",
'VADS_CAPTURE_DELAY'  =>  "D�lai avant remise en banque",
'VADS_CAPTURE_DELAY_DESC'  =>  "Le nombre de jours avant la remise en banque (param�trable sur votre back office PayZen).",
'VADS_VALIDATION_MODE'  =>  "Mode de validation",
'VADS_VALIDATION_MODE_DESC'  =>  "En mode manuel, vous devrez confirmer les paiements dans l\'outil de gestion de caisse.",
'VADS_PAYMENT_CARDS'  =>  "Types de carte",
'VADS_PAYMENT_CARDS_DESC'  =>  "Le(s) type(s) de carte pouvant �tre utilis�(s) pour le paiement, s�par�s par des points-virgules.",

'VADS_RETURN_TO_SHOP'  =>  "Retour �la boutique",
'VADS_REDIRECT_ENABLED'  =>  "Redirection automatique",
'VADS_REDIRECT_ENABLED_DESC'  =>  "Si activ�e, le client sera redirig� automatiquement vers votre site �la fin du processus de paiement.",
'VADS_REDIRECT_SUCCESS_TIMEOUT'  =>  "Temps avant redirection (succ�s)",
'VADS_REDIRECT_SUCCESS_TIMEOUT_DESC'   =>  "Temps en secondes (0-300) avant que le client ne soit redirig� automatiquement vers votre site lorsque le paiement a r�ussi.",
'VADS_REDIRECT_SUCCESS_MESSAGE'  =>  "Message avant redirection (succ�s)",
'VADS_REDIRECT_SUCCESS_MESSAGE_DESC'  =>  "Message affich� sur la plateforme de paiement avant redirection lorsque le paiement a r�ussi.",
'VADS_REDIRECT_SUCCESS_MESSAGE_DEFAULT'  =>   "Votre paiement a bien �t� pris en compte, vous allez être redirig� dans quelques instants.",
'VADS_REDIRECT_ERROR_TIMEOUT'  =>  "Temps avant redirection (�chec)",
'VADS_REDIRECT_ERROR_TIMEOUT_DESC'  =>   "Temps en secondes (0-300) avant que le client ne soit redirig� automatiquement vers votre site lorsque le paiement a �chou�.",
'VADS_REDIRECT_ERROR_MESSAGE'   =>  "Message avant redirection (�chec)",
'VADS_REDIRECT_ERROR_MESSAGE_DESC'  =>  "Message affich� sur la plateforme de paiement avant redirection, lorsque le paiement a �chou�.",
'VADS_REDIRECT_ERROR_MESSAGE_DEFAULT'  =>   "Une erreur est survenue, vous allez �tre redirig� dans quelques instants.",
'VADS_RETURN_MODE'  =>  "Mode de retour",
'VADS_RETURN_MODE_DESC'  =>  "Fa�on dont le client transmettra le r�sultat du paiement lors de son retour sur la boutique.",
'VADS_URL_CHECK'  =>  "URL serveur � renseigner sur le back office PayZen de votre boutique",
'VADS_URL_RETURN'  =>  "URL de retour",
'VADS_URL_RETURN_DESC'   =>  "URL vers laquelle le client sera redirig� � la fin du paiement.", 

# AVAILABLE LANGUAGES
'VADS_FRENCH'  =>  'Fran�ais',
'VADS_GERMAN'  =>  'Allemand',
'VADS_ENGLISH'  =>  'Anglais',
'VADS_SPANISH'  =>  'Espagnol',
'VADS_CHINESE'  =>  'Chinois',
'VADS_ITALIAN'  =>  'Italien',
'VADS_JAPANESE'  =>  'Japonais',
'VADS_PORTUGUESE'  =>  'Portugais',

# VALIDATION MODE OPTIONS
'VADS_DEFAULT'  =>  'Par d�faut',
'VADS_AUTOMATIC'  =>  'Automatique',
'VADS_MANUAL'  =>  'Manuel',
 
# REDIRECTION OPTIONS
'VADS_YES'  =>  'Oui',
'VADS_NO'  =>  "Non"

);

/*
[{ oxmultilang ident="GENERAL_YOUWANTTODELETE" }]
*/

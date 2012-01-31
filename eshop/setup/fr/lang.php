<?php
/**
 * This Software is the property of OXID eSales and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license key
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * @link      http://www.oxid-esales.com
 * @package   lang
 * @copyright (C) OXID eSales AG 2003-2011
 * @version OXID eShop EE
 * @version   SVN: $Id: theme_lang.php 28697 2010-06-29 11:09:58Z vilma $
 */

$aLang = array(

'charset'                                         => 'ISO-8859-15',
'HEADER_META_MAIN_TITLE'                          => "Assistant d'installation OXID eShop",
'HEADER_TEXT_SETUP_NOT_RUNS_AUTOMATICLY'          => "Si la procédure d'installation ne démarre pas sous quelques secondes, cliquez",
'FOOTER_OXID_ESALES'                              => "&copy; OXID eSales AG 2003 - ".@date("Y"),

'TAB_0_TITLE'                                     => "Configuration requise",
'TAB_1_TITLE'                                     => "Bienvenue",
'TAB_2_TITLE'                                     => "Conditions de licence",
'TAB_3_TITLE'                                     => "Base de données",
'TAB_4_TITLE'                                     => "Répertoire & connexion",
'TAB_5_TITLE'                                     => "Licence",
'TAB_6_TITLE'                                     => "Terminée",

'TAB_0_DESC'                                      => "Vérification de la conformité de votre configuration",
'TAB_1_DESC'                                      => "Bienvenue dans l'assistant d'installation d'OXID eShop",
'TAB_2_DESC'                                      => "Veuillez confirmer les conditions de licence",
'TAB_3_DESC'                                      => "Test de connexion à la base de données, création des tables",
'TAB_4_DESC'                                      => "Configuration des répertoires et définition du compte administrateur",
'TAB_5_DESC'                                      => "Appliquer la clé de licence",
'TAB_6_DESC'                                      => "Installation effectuée avec succès",

'HERE'                                            => "ici",

'ERREUR_NOT_AVAILABLE'                             => "ERREUR: %s non trouvé!",
'ERREUR_NOT_WRITABLE'                              => "ERREUR: Impossiblité d'écriture de %s!",
'ERREUR_DB_CONNECT'                                => "ERREUR: Impossibilité de connexion à la base de données!",
'ERREUR_OPENING_SQL_FILE'                          => "ERREUR: Impossible d'ouvrir le fichier SQL %s!",
'ERREUR_FILL_ALL_FIELDS'                           => "ERREUR: Merci de renseigner tous les champs nécessaires!",
'ERREUR_COULD_NOT_CREATE_DB'                       => "ERREUR: Base de données inexistante, la base ne peut être créée!",
'ERREUR_DB_ALREADY_EXISTS'                         => "ERREUR: Il semble qu'OXID eShop soit déjà installé dans la base %s. Merci de bien vouloir la supprimer avant de continuer!",
'ERREUR_BAD_SQL'                                   => "ERREUR: Problème rencontré lors de l'insertion SQL: ",
'ERREUR_BAD_DEMODATA'                              => "ERREUR: Problème rencontré lors de l'insertion SQL: ",
'ERREUR_CONFIG_FILE_IS_NOT_WRITABLE'               => "ERREUR: %s/config.inc.php"." n'est pas modifiable!",
'ERREUR_BAD_SERIAL_NUMBER'                         => "ERREUR: Numéro de licence non valide!",
'ERREUR_COULD_NOT_OPEN_CONFIG_FILE'                => "Lecture impossible de %s ! Merci de vous reporter à notre FAQ, forum ou bien contacter notre équipe de support OXID!",
'ERREUR_COULD_NOT_FIND_FILE'                       => "Le processus d'installation n'a pas pu trouver le fichier \"%s\"!",
'ERREUR_COULD_NOT_READ_FILE'                       => "Le processus d'installation n'a pas pu ouvrir le fichier \"%s\" en lecture!",
'ERREUR_COULD_NOT_WRITE_TO_FILE'                   => "Le processus d'installation n'a pas pu écrire dans le fichier \"%s\"!",
'ERREUR_PASSWORD_TOO_SHORT'                        => "Le mot de passe saisi est trop court!",
'ERREUR_PASSWORDS_DO_NOT_MATCH'                    => "Les mots de passe saisis ne concordent pas!",
'ERREUR_USER_NAME_DOES_NOT_MATCH_PATTERN'          => "Merci de renseigner une adresse e-mail valide!",
'ERREUR_MYSQL_VERSION_DOES_NOT_FIT_REQUIREMENTS'   => "La version du serveur MySQL ne satisfait pas à la configuration requise",

'MOD_PHP_EXTENNSIONS'                             => 'Extensions PHP',
'MOD_PHP_CONFIG'                                  => 'Configuration PHP',
'MOD_SERVER_CONFIG'                               => 'Configuration Serveur',

'MOD_MOD_REWRITE'                                 => 'Module apache mod_rewrite',
'MOD_SERVER_PERMISSIONS'                          => 'Droits d\'accès sur les répertoires/fichiers',
'MOD_ALLOW_URL_FOPEN'                             => 'Le module allow_url_fopen ou fsockopen doit utiliser le port 80',
'MOD_PHP4_COMPAT'                                 => 'La compatibilité Zend doit être off',
'MOD_PHP_VERSION'                                 => 'La version de PHP minimale est 5.2.0',
'MOD_REQUEST_URI'                                 => 'Le module REQUEST_URI est activé',
'MOD_LIB_XML2'                                    => 'Module LIB XML2',
'MOD_PHP_XML'                                     => 'Module DOM',
'MOD_J_SON'                                       => 'Module JSON',
'MOD_I_CONV'                                      => 'Module ICONV',
'MOD_TOKENIZER'                                   => 'Module Tokenizer',
'MOD_BC_MATH'                                     => 'Module BCMath',
'MOD_MYSQL_CONNECT'                               => 'Module MySQL pour MySQL 5',
'MOD_GD_INFO'                                     => 'Module GDlib v2 [v1] incl. support du format JPEG',
'MOD_INI_SET'                                     => 'Module ini_set autorisé',
'MOD_REGISTER_GLOBALS'                            => 'Le module register_globals doit être off',
'MOD_ZEND_OPTIMIZER'                              => 'Module Zend Optimizer ou Zend Guard Loader installé',
'MOD_ZEND_PLATFORM_OR_SERVER'                     => 'Module Zend Platform ou Zend Server installé',
'MOD_MB_STRING'                                   => 'Module mbstring',
'MOD_CURL'                                        => 'Module cURL',
'MOD_OPEN_SSL'                                    => 'Module OpenSSL',
'MOD_SOAP'                                        => 'Module SOAP',
'MOD_UNICODE_SUPPORT'                             => 'UTF-8 supporté',

'STEP_0_ERREUR_TEXT'                              => 'Votre système ne satisfait pas la configuration requise',
'STEP_0_ERREUR_URL'                               => "http://www.oxid-esales.com/en/products/community-edition/system-requirements",
'STEP_0_TEXT'                                     => '<ul class="req">'.
                                                     '<li class="pass"> - Votre système satisfait aux conditions requises.</li>'.
                                                     '<li class="pmin"> - Les conditions requises ne sont pas pleinement satisfaites. OXID eShop pourra cependant fonctionner et peut être installé..</li>'.
                                                     '<li class="fail"> - Votre système ne satisfait pas au conditions requises. OXID eShop ne peut fonctionner dans ces conditions et ne peut être installé dans l\'état.</li>'.
                                                     '<li class="null"> - Les conditions requises n\'ont pas pu être vérifiées.'.
                                                     '</ul>',
'STEP_0_DESC'                                     => 'Cette étape permet de vérifier si votre système est conforme aux conditions requises:',
'STEP_0_TITLE'                                    => 'Vérification de la configuration',

'STEP_1_TITLE'                                    => "Bienvenue",
'STEP_1_DESC'                                     => "Bienvenue dans l'assistant d'installation d'OXID eShop",
'STEP_1_TEXT'                                     => "Merci de lire attentivement les instructions ci-après afin de garantir une installation sans encombres.
                                                      Nous vous souhaitons le plus grand succès dans l'utilisation d'OXID eShop",
'STEP_1_ADDRESS'                                  => "OXID eSales France<br>",
'STEP_1_CHECK_UPDATES'                            => 'Vérifiez la présence de mise à jour régulièrement',
'BUTTON_BEGIN_INSTALL'                            => "Démarrer l'installation",
'BUTTON_PROCEED_INSTALL'                          => "Lancer l'installation",

'STEP_2_TITLE'                                    => "Conditions de licence",
'BUTTON_RADIO_LICENCE_ACCEPT'                     => "J'accepte les conditions de licence.",
'BUTTON_RADIO_LICENCE_NOT_ACCEPT'                 => "Je refuse les conditions de licence.",
'BUTTON_LICENCE'                                  => "Continuer",

'STEP_3_TITLE'                                    => "Base de données",
'STEP_3_DESC'                                     => "La base de données va être créée ainsi que les tables nécessaires. Merci de renseigner les information suivantes:",
'STEP_3_DB_HOSTNAME'                              => "Nom d'hôte ou adresse IP du serveur de base de données",
'STEP_3_DB_USER_NAME'                             => "Nom d'utilisateur du serveur de bases de données",
'STEP_3_DB_PASSWORD'                              => "Mot de passe du serveur de bases de données",
'STEP_3_DB_PASSWORD_SHOW'                         => "Afficher le mot de passe",
'STEP_3_DB_DATABSE_NAME'                          => "Nom de la base de données",
'STEP_3_DB_DEMODATA'                              => "Jeu de données de démonstration",
'STEP_3_UTFMODE'                                  => "Utiliser l'encodage UTF-8",
'STEP_3_UTFNOTSUPPORTED'                          => "OXID eShop ne peut fonctionner en mode UTF-8, pour les raisons suivantes:",
'STEP_3_UTFNOTSUPPORTED1'                         => " Le module PHP mbstring est absent",
'STEP_3_UTFNOTSUPPORTED2'                         => " Le module PCRE installé ne supporte pas UTF-8",
'STEP_3_UTFINFO'                                  => "L'encodage UTF-8 procure un meilleur support des caractères spéciaux que les autres encodages. Ce point est particulièrement important pour les boutiques multilingue. Cependant, UTF-8 est légèrement plus lent que les encodages standard (ISO 8859-15). <br /> Si vous prévoyez de proposer votre boutiques dans plusieurs langues, vous devriez utiliser UTF-8. Si vous souhaitez proposer seulement quelques langues utilisant le même alphabet (ex: English, German, French), UTF-8 n'est pas nécessaire.",
'STEP_3_CREATE_DB_WHEN_NO_DB_FOUND'               => "Si la base de données n'esiste pas, elle sera créée",
'BUTTON_RADIO_INSTALL_DB_DEMO'                    => "Installer le jeu de données de démonstration",
'BUTTON_RADIO_NOT_INSTALL_DB_DEMO'                => "Ne <strong>pas</strong> installer le jeu de données de démonstration",
'BUTTON_DB_INSTALL'                               => "Créer la base de données maintenant",

'STEP_3_1_TITLE'                                  => "Base de données - En cours de création ...",
'STEP_3_1_DB_CONNECT_IS_OK'                       => "Test de connexion à la base de données effectué ...",
'STEP_3_1_DB_CREATE_IS_OK'                        => "La base de données %s à bien été créée ...",
'STEP_3_1_CREATING_TABLES'                        => "Création des tables ...",

'STEP_3_2_TITLE'                                  => "Base de données - Tables en cours de création ...",
'STEP_3_2_CONTINUE_INSTALL_OVER_EXISTING_DB'      => "Si vous souhaitez continuer et écraser vos données existantes cliquez ",
'STEP_3_2_CREATING_DATA'                          => "La base de données à bien été créée. Merci de patienter ...",

'STEP_4_TITLE'                                    => "Configuration des dossiers et URL d'OXID eShop",
'STEP_4_DESC'                                     => "Merci de renseigner les données nécessaires au bon fonctionnement d'OXID eShop:",
'STEP_4_SHOP_URL'                                 => "Adresse URL de la boutique OXID eShop",
'STEP_4_SHOP_DIR'                                 => "Répertoire d'OXID eShop",
'STEP_4_SHOP_TMP_DIR'                             => "Répertoire pour les données temporaires",
'STEP_4_ADMIN_LOGIN_NAME'                         => "Adresse e-mail de l'administrateur (Utilisée comme login)",
'STEP_4_ADMIN_PASS'                               => "Mot de passe pour l'administrateur",
'STEP_4_ADMIN_PASS_CONFIRM'                       => "Confirmer le mot de passe pour l'administrateur",
'STEP_4_ADMIN_PASS_MINCHARS'                      => "6 caractères minimum",

'STEP_4_1_TITLE'                                  => "Répertoires - en cours de création ...",
'STEP_4_1_DATA_WAS_WRITTEN'                       => "Insertion et vérification des données. Merci de patienter ...",
'BUTTON_WRITE_DATA'                               => "Enregistrer et continuer",

'STEP_5_TITLE'                                    => "Licence OXID eShop",
'STEP_5_DESC'                                     => "Merci de confirmer votre clé de licence:",
'STEP_5_LICENCE_KEY'                              => "Clé de licence",
'STEP_5_LICENCE_DESC'                             => "La clé fournie est valide pour une durée de 30 jours. Après cette période l'intégralité de vos modifications seront conservées si vous insérez une clé de licence valide.",
'BUTTON_WRITE_LICENCE'                            => "Enregister la clé de licence",

'STEP_5_1_TITLE'                                  => "La clé de licence est en cours de sauvegarde ...",
'STEP_5_1_SERIAL_ADDED'                           => "La clé de licence est sauvegardée. Merci de patienter ...",

'STEP_6_TITLE'                                    => "OXID eShop a été installé avec succès",
'STEP_6_DESC'                                     => "Votre boutique OXID eShop a été installée avec succès.",
'STEP_6_LINK_TO_SHOP'                             => "Accéder à votre boutique OXID eShop",
'STEP_6_LINK_TO_SHOP_ADMIN_AREA'                  => "Accéder à l'administration de votre boutique OXID eShop",
'STEP_6_TO_SHOP'                                  => "A la boutique",
'STEP_6_TO_SHOP_ADMIN'                            => "A l'administration de la boutique",

'ATTENTION'                                       => "Attention, important",
'SETUP_DIR_DELETE_NOTICE'                         => "Pour des raisons de sécurité, veuillez supprimer le répertoire 'setup' s'il n'avait pas été supprimé durant le processus d'installation.",
'SETUP_CONFIG_PERMISSIONS'                        => "Pour des raisons de sécurité, veuillez modifier les propriétés du fichier config.inc.php en lecture seule!",

'SELECT_SETUP_LANG'                               => "Veuillez choisir une langue",
'SELECT_COUNTRY_LANG'                             => "Veuillez choisir un pays",
'SELECT_DELIVERY_COUNTRY'                         => "[tr]Main delivery country",
'SELECT_DELIVERY_COUNTRY_HINT'                    => "[tr]If needed, activate easily more delivery countries in admin",
'SELECT_SETUP_LANG_SUBMIT'                        => "Selectionner",
'USE_DYNAMIC_PAGES'                               => "Afin d'augmenter votre réussite des information supplementaires sont disponibles sur les serveurs d'OXID. Vous trouverez davantage d'information dans ",
'PRIVACY_POLICY'                                  => "déclaration de confidentialité",

'LOAD_DYN_CONTENT_NOTICE'                         => "<p>Si la case à cocher &quot;Plus d'information&quot; est activée, vous verrez apparaître un menu additionel dans l'interface d'administration de votre boutique OXID eShop.</p><p>Dans ce menu, vous trouverez davantage d'information concernant les services eCommerce comme Google product search.</p> <p>Vous pouvez modifier ces paramètres à tout moment.</p>",
'ERREUR_SETUP_CANCELLED'                          => "La procédure d'installation à été annulée car vous avez refusé les conditions de licence.",
'BUTTON_START_INSTALL'                            => "Relancer l'installation",


);

$aLang['MOD_MEMORY_LIMIT']                        = 'Module PHP MEMORY_LIMIT (min. 14MB, 30MB recommandé)';

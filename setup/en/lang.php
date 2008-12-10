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
 * @copyright � OXID eSales AG 2003-2008
 * $Id: lang.php 13765 2008-10-27 12:14:58Z ralf $
 */

$aLang = array(

'charset'                                         => 'iso-8859-1',
'HEADER_META_MAIN_TITLE'                          => "OXID eShop installation wizzard",
'HEADER_TEXT_SETUP_NOT_RUNS_AUTOMATICLY'          => "If setup does not continue in a few seconds, please click ",
'FOOTER_OXID_ESALES'                              => "&copy; OXID eSales AG 2008",

'TAB_1_TITLE'                                     => "Welcome",
'TAB_2_TITLE'                                     => "License conditions",
'TAB_3_TITLE'                                     => "Database",
'TAB_4_TITLE'                                     => "Directory",
'TAB_5_TITLE'                                     => "License",
'TAB_6_TITLE'                                     => "Finish",

'TAB_1_DESC'                                      => "Welcome to OXID eShop installation wizzard",
'TAB_2_DESC'                                      => "Confirm license conditions",
'TAB_3_DESC'                                      => "Test database connection, building tables",
'TAB_4_DESC'                                      => "Configuring your shop and writing configuration file",
'TAB_5_DESC'                                      => "Apply license key",
'TAB_6_DESC'                                      => "Installation succeeded",

'HERE'                                            => "here",

'ERROR_NOT_AVAILABLE'                             => "ERROR: %s not found!",
'ERROR_CHMOD'                                     => "ERROR: Not possible to change %s's rights to (chmod 0755)!",
'ERROR_NOT_WRITABLE'                              => "ERROR: %s not writeable!",
'ERROR_DB_CONNECT'                                => "ERROR: No database connection possible!",
'ERROR_OPENING_SQL_FILE'                          => "ERROR: Cannot open SQL file %s!",
'ERROR_FILL_ALL_FIELDS'                           => "ERROR: Please fill in all needed fields!",
'ERROR_COULD_NOT_CONNECT_TO_DB'                   => "ERROR: No database connection possible!",
'ERROR_COULD_NOT_CREATE_DB'                       => "ERROR: Database not available and also cannot be created!",
'ERROR_DB_ALREADY_EXISTS'                         => "ERROR: Seems there is already OXID eShop installed in database %s. Please delete it prior continuing!",
'ERROR_BAD_SQL'                                   => "ERROR: Issue while inserting this SQL statements: ",
'ERROR_BAD_DEMODATA'                              => "ERROR: Issue while inserting this SQL statements: ",
'ERROR_CONFIG_FILE_IS_NOT_WRITABLE'               => "ERROR: %s/config.inc.php"." not writeable!",
'ERROR_BAD_SERIAL_NUMBER'                         => "ERROR: Wrong license key!",
'ERROR_COULD_NOT_OPEN_CONFIG_FILE'                => "Could not open %s for reading! Please consult our FAQ, forum or contact OXID Support staff!",

'STEP_1_TITLE'                                    => "Welcome",
'STEP_1_DESC'                                     => "Welcome to installation wizzard of OXID eShop",
'STEP_1_TEXT'                                     => "Please read carefully the following instructions to guarantee a smooth installation.
                                                      Wishes for best success in using your OXID eShop by",
'STEP_1_ADDRESS'                                  => "OXID eSales AG<br>
                                                      Bertoldstr. 48<br>
                                                      79098 Freiburg<br>
                                                      Deutschland<br>",
'BUTTON_BEGIN_INSTALL'                            => "Start installation",

'STEP_2_TITLE'                                    => "License conditions",
'BUTTON_RADIO_LICENCE_ACCEPT'                     => "I acceppt license conditions.",
'BUTTON_RADIO_LICENCE_NOT_ACCEPT'                 => "I do not accept license conditions.",
'BUTTON_LICENCE'                                  => "Continue",

'STEP_3_TITLE'                                    => "Database",
'STEP_3_DESC'                                     => "Database is going to be created and needed tables are written. Please provide some information:",
'STEP_3_DB_HOSTNAME'                              => "Database hostname or IP",
'STEP_3_DB_USER_NAME'                             => "Database username",
'STEP_3_DB_PASSWORD'                              => "Database password",
'STEP_3_DB_DATABSE_NAME'                          => "Database name",
'STEP_3_DB_DEMODATA'                              => "Demodata",
'STEP_3_CREATE_DB_WHEN_NO_DB_FOUND'               => "If database does not exist, it's going to be created",
'BUTTON_RADIO_INSTALL_DB_DEMO'                    => "Install demodata",
'BUTTON_RADIO_NOT_INSTALL_DB_DEMO'                => "Do <strong>not</strong> install demodata",
'BUTTON_DB_INSTALL'                               => "Create database now",

'STEP_3_1_TITLE'                                  => "Database - being created ...",
'STEP_3_1_DB_CONNECT_IS_OK'                       => "Database connection successfully tested ...",
'STEP_3_1_DB_CREATE_IS_OK'                        => "Database %s successfully created ...",
'STEP_3_1_CREATING_TABLES'                        => "Creating tables, applying data ...",

'STEP_3_2_TITLE'                                  => "Database - tables are beeing created ...",
'STEP_3_2_CONTINUE_INSTALL_OVER_EXISTING_DB'      => "If you want to overwrite all existing data and install anyway click ",
'STEP_3_2_CREATING_DATA'                          => "Database successfully created. Please wait ...",

'STEP_4_TITLE'                                    => "Setting up OXID eShop directories and URL",
'STEP_4_DESC'                                     => "Please provide neccesairy data for running OXID eShop:",
'STEP_4_SHOP_URL'                                 => "Shop URL",
'STEP_4_SHOP_DIR'                                 => "Directory for OXID eShop",
'STEP_4_SHOP_TMP_DIR'                             => "Directory for temporary data",
'STEP_4_DELETE_SETUP_DIR'                         => "Delete setup directory after installation",

'STEP_4_1_TITLE'                                  => "Directories - being created ...",
'STEP_4_1_DATA_WAS_WRITTEN'                       => "Check and writing data successful. Please wait ...",
'BUTTON_WRITE_DATA'                               => "Save and continue",

'STEP_5_TITLE'                                    => "OXID eShop license",
'STEP_5_DESC'                                     => "Please confirm license key:",
'STEP_5_LICENCE_KEY'                              => "License key",
'STEP_5_LICENCE_DESC'                             => "The provided key is valid for 30 days. After this period all of your changes remain if you insert a valid license key.",
'BUTTON_WRITE_LICENCE'                            => "Save license key",

'STEP_5_1_TITLE'                                  => "License key is being inserted ...",
'STEP_5_1_SERIAL_ADDED'                           => "License key successfully saved. Please wait ...",

'STEP_6_TITLE'                                    => "OXID eShop successfully installed",
'STEP_6_DESC'                                     => "Your OXID eShop has been installed successfully.",
'STEP_6_LINK_TO_SHOP'                             => "Continue to your OXID eShop",
'STEP_6_LINK_TO_SHOP_ADMIN_AREA'                  => "Continue to your OXID eShop admin interface",
'STEP_6_TO_SHOP'                                  => "To Shop",
'STEP_6_TO_SHOP_ADMIN'                            => "To admin interface",

'ATTENTION'                                       => "Attention, important",
'SETUP_DIR_DELETE_NOTICE'                         => "Due to security reasons remove setup directory if not yet done during installation.",

'SELECT_SETUP_LANG'                               => "Please choose your language",
'SELECT_COUNTRY_LANG'                             => "Please choose your country",
'SELECT_SETUP_LANG_SUBMIT'                        => "Select",
'USE_DYNAMIC_PAGES'                               => "To improve your bussiness get additional information from OXID's server. <br>Learn about our ",
'PRIVACY_POLICY'                                  => "privacy policy",

'LOAD_DYN_CONTENT_NOTICE'                         => "<p>If checkbox &quot;more information&quot; is set, you will see an additonal menu in admin area of your OXID eShop.</p><p>In that menu you get further information about E-Commerce Services like Google productsearch.</p> <p>You can change this settings at any time.</p>",


);

?>

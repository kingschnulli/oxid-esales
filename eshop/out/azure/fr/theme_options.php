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
'charset'                               => 'ISO-8859-15',

'SHOP_THEME_GROUP_images'               => 'Images',
'SHOP_THEME_GROUP_features'             => 'Fonctionnalités',
'SHOP_THEME_GROUP_display'              => 'Affichage',

'SHOP_THEME_sIconsize'                  => 'Taille des icônes (largeur x hauteur)',//SHOP_CONFIG_ICONSIZE
'HELP_SHOP_THEME_sIconsize'             => 'Les icônes sont les plus petites images d\'un produit. Elles sont utilisées: <br>' .
                                           '<ul><li>Dans le panier.</li>' .
                                           '<li> Si les produits sont affichés dans le menu de droite (ex: dans <span class="filename_filepath_or_italic">TOP de la boutique</span> et <span class="filename_filepath_or_italic">Bonnes affaires</span>).</li></ul>' .
                                           'Afin d\'éviter les problèmes de mise en forme liés à des images trop grandes, les icônes sont redimensionnées. Entrez la taille maximale des icônes ici.',

'SHOP_THEME_sThumbnailsize'             => 'Taille des vignettes (largeur x hauteur)',//SHOP_CONFIG_THUMBNAILSIZE
'HELP_SHOP_THEME_sThumbnailsize'        => 'Les vignettes sont de petites images des produits. Elles sont utilisées:<br>' .
                                           '<ul><li>Dans les listes de produits.</li>' .
                                           '<li>Dans les promotions affichées au centre de la page d\'accueil, ex: <span class="filename_filepath_or_italic">Serniers arrivages!</span>.</li></ul>' .
                                           'Afin d\'éviter les problèmes de mise en forme liés à des images trop grandes, les vignettes sont redimensionnées. E Entrez la taille maximale des vignettes ici.',

'SHOP_THEME_sZoomImageSize'             => 'Taille des images Zoom (largeur x hauteur)',//SHOP_CONFIG_ZOOMIMAGESIZE
'SHOP_THEME_sCatThumbnailsize'          => 'Taille des images de catégories (largeur x hauteur)',//SHOP_CONFIG_CATEGORYTHUMBNAILSIZE
'SHOP_THEME_aDetailImageSizes'          => 'Taille des images produits (largeur x hauteur)',//SHOP_CONFIG_DETAILIMAGESIZE

'SHOP_THEME_sManufacturerIconsize'      => 'Fabricant : Taille du logo', // Check if this is really manufacturer or if it is more like "brand"
'HELP_SHOP_THEME_sManufacturerIconsize' => 'Le Logo du fabricant est affiché en page d\'accueil dans le slider des marques.',

'SHOP_THEME_sCatIconsize'               => 'Taille des images des catégories/ sous-catégories (largeur*hauteur)',
'HELP_SHOP_THEME_sCatIconsize'          => 'Dans la vue par catégorie, les images de s catégories sont affichées dans la taille définie ici.',

'SHOP_THEME_sCatPromotionsize'          => 'Images des catégories pour l\'encart promotion de la page d\'accueil. (largeur*hauteur)',
'HELP_SHOP_THEME_sCatPromotionsize'     => 'L\'encart promotion sur la page d\'accueil nécessite une taille de visuels de catégorie particulière. Merci de la définir ici.',


'SHOP_THEME_bl_showGiftWrapping'        => 'Utiliser les emballages cadeau',   //SHOP_CONFIG_SHOWGIFTWRAPPING
'SHOP_THEME_bl_showVouchers'            => 'Utiliser les coupons',        //SHOP_CONFIG_SHOWVOUCHERS
'SHOP_THEME_bl_showWishlist'            => 'Utiliser les listes de souhaits',   //SHOP_CONFIG_SHOWWISHLIST
'SHOP_THEME_bl_showCompareList'         => 'Utiliser les listes de comparaison',    //SHOP_CONFIG_SHOWCOMPARELIST
'SHOP_THEME_bl_showListmania'           => 'Utiliser les listmanias',       //SHOP_CONFIG_SHOWLISTMANIA
'SHOP_THEME_bl_perfShowLeftBasket'      => 'Afficher les panier à gauche',//SHOP_PERF_SHOWLEFTBASKET
'SHOP_THEME_bl_perfShowRightBasket'     => 'Afficher les panier à droite',//SHOP_PERF_SHOWRIGHTBASKET
'SHOP_THEME_bl_perfShowTopBasket'       => 'Afficher les panier en haut',//SHOP_PERF_SHOWTOPBASKET
'SHOP_THEME_blShowBirthdayFields'       => 'Afficher le champ date de naissance lors de l\'enregistrement des clients',//SHOP_CONFIG_SHOWBIRTHDAYFIELDS
'SHOP_THEME_blTopNaviLayout'            => 'Afficher la navigation par catégories en haut',//SHOP_CONFIG_TOPNAVILAYOUT
'HELP_SHOP_THEME_blTopNaviLayout'       => 'Habituellement, la navigation par catégories est affichée à gauche. Si ce paramètre est activé, la navigation par catégories sera affiché en haut uniquement.',

'SHOP_THEME_iTopNaviCatCount'           => 'Nombre de catégories à afficher en haut',//SHOP_CONFIG_TOPNAVICATCOUNT
'SHOP_THEME_blShowFinalStep'            => 'Afficher une confirmation de commande une fois la commande terminée (5ème étape de commande)',//SHOP_SYSTEM_SHOWFINALSTEP
'SHOP_THEME_iNewBasketItemMessage'      => 'Choisir une action lors de la mise au panier d\'un produit',//SHOP_SYSTEM_SHOWNEWBASKETITEMMESSAGE
'HELP_SHOP_THEME_iNewBasketItemMessage' => 'Lorsqu\'un client met un produit dans le panier, OXID eShop peut se comporter de différentes manières. Définissez le comportement à adopter.',//SHOP_SYSTEM_SHOWNEWBASKETITEMMESSAGE
'SHOP_THEME_iNewBasketItemMessage_0'    => 'Aucun',
'SHOP_THEME_iNewBasketItemMessage_1'    => 'Afficher un message',
'SHOP_THEME_iNewBasketItemMessage_2'    => 'Ouvrir une pop-up',
'SHOP_THEME_iNewBasketItemMessage_3'    => 'Ouvrir le panier',

'SHOP_THEME_blShowListDisplayType'            => 'Afficher le sélecteur de présentation des listes de produits',
'HELP_SHOP_THEME_blShowListDisplayType'       => 'Decide if the visitor of your store can select the type of the product list in store front. If this options is not activated, your visitors will see the lists displayed like you adjusted in the drop box "product list type".',
'SHOP_THEME_sDefaultListDisplayType'          => 'Mode d\'affichage par défaut des listes de produits',
'SHOP_THEME_sDefaultListDisplayType_grid'     => 'Grille',
'SHOP_THEME_sDefaultListDisplayType_line'     => 'Liste',
'SHOP_THEME_sDefaultListDisplayType_infogrid' => 'Double grille',

'SHOP_THEME_sStartPageListDisplayType'        => 'Type de listing produit en page d\'accueil',
'SHOP_THEME_aNrofCatArticlesInGrid'           => 'Grille: Nombre de produits à afficher par page dans les listes dans la liste de séléction (categories, résulats de recherche)<br><br>Attention: performances impactées si valeur > 100',
'SHOP_THEME_aNrofCatArticles'                 => 'Nombre de produits à afficher par page dans les listes dans la liste de séléction (categories, résulats de recherche)<br><br>Attention: performances impactées si valeur > 100',

);

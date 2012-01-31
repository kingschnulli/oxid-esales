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
'SHOP_THEME_GROUP_features'             => 'Fonctionnalit�s',
'SHOP_THEME_GROUP_display'              => 'Affichage',

'SHOP_THEME_sIconsize'                  => 'Taille des ic�nes (largeur x hauteur)',//SHOP_CONFIG_ICONSIZE
'HELP_SHOP_THEME_sIconsize'             => 'Les ic�nes sont les plus petites images d\'un produit. Elles sont utilis�es: <br>' .
                                           '<ul><li>Dans le panier.</li>' .
                                           '<li> Si les produits sont affich�s dans le menu de droite (ex: dans <span class="filename_filepath_or_italic">TOP de la boutique</span> et <span class="filename_filepath_or_italic">Bonnes affaires</span>).</li></ul>' .
                                           'Afin d\'�viter les probl�mes de mise en forme li�s � des images trop grandes, les ic�nes sont redimensionn�es. Entrez la taille maximale des ic�nes ici.',

'SHOP_THEME_sThumbnailsize'             => 'Taille des vignettes (largeur x hauteur)',//SHOP_CONFIG_THUMBNAILSIZE
'HELP_SHOP_THEME_sThumbnailsize'        => 'Les vignettes sont de petites images des produits. Elles sont utilis�es:<br>' .
                                           '<ul><li>Dans les listes de produits.</li>' .
                                           '<li>Dans les promotions affich�es au centre de la page d\'accueil, ex: <span class="filename_filepath_or_italic">Serniers arrivages!</span>.</li></ul>' .
                                           'Afin d\'�viter les probl�mes de mise en forme li�s � des images trop grandes, les vignettes sont redimensionn�es. E Entrez la taille maximale des vignettes ici.',

'SHOP_THEME_sZoomImageSize'             => 'Taille des images Zoom (largeur x hauteur)',//SHOP_CONFIG_ZOOMIMAGESIZE
'SHOP_THEME_sCatThumbnailsize'          => 'Taille des images de cat�gories (largeur x hauteur)',//SHOP_CONFIG_CATEGORYTHUMBNAILSIZE
'SHOP_THEME_aDetailImageSizes'          => 'Taille des images produits (largeur x hauteur)',//SHOP_CONFIG_DETAILIMAGESIZE

'SHOP_THEME_sManufacturerIconsize'      => 'Fabricant : Taille du logo', // Check if this is really manufacturer or if it is more like "brand"
'HELP_SHOP_THEME_sManufacturerIconsize' => 'Le Logo du fabricant est affich� en page d\'accueil dans le slider des marques.',

'SHOP_THEME_sCatIconsize'               => 'Taille des images des cat�gories/ sous-cat�gories (largeur*hauteur)',
'HELP_SHOP_THEME_sCatIconsize'          => 'Dans la vue par cat�gorie, les images de s cat�gories sont affich�es dans la taille d�finie ici.',

'SHOP_THEME_sCatPromotionsize'          => 'Images des cat�gories pour l\'encart promotion de la page d\'accueil. (largeur*hauteur)',
'HELP_SHOP_THEME_sCatPromotionsize'     => 'L\'encart promotion sur la page d\'accueil n�cessite une taille de visuels de cat�gorie particuli�re. Merci de la d�finir ici.',


'SHOP_THEME_bl_showGiftWrapping'        => 'Utiliser les emballages cadeau',   //SHOP_CONFIG_SHOWGIFTWRAPPING
'SHOP_THEME_bl_showVouchers'            => 'Utiliser les coupons',        //SHOP_CONFIG_SHOWVOUCHERS
'SHOP_THEME_bl_showWishlist'            => 'Utiliser les listes de souhaits',   //SHOP_CONFIG_SHOWWISHLIST
'SHOP_THEME_bl_showCompareList'         => 'Utiliser les listes de comparaison',    //SHOP_CONFIG_SHOWCOMPARELIST
'SHOP_THEME_bl_showListmania'           => 'Utiliser les listmanias',       //SHOP_CONFIG_SHOWLISTMANIA
'SHOP_THEME_bl_perfShowLeftBasket'      => 'Afficher les panier � gauche',//SHOP_PERF_SHOWLEFTBASKET
'SHOP_THEME_bl_perfShowRightBasket'     => 'Afficher les panier � droite',//SHOP_PERF_SHOWRIGHTBASKET
'SHOP_THEME_bl_perfShowTopBasket'       => 'Afficher les panier en haut',//SHOP_PERF_SHOWTOPBASKET
'SHOP_THEME_blShowBirthdayFields'       => 'Afficher le champ date de naissance lors de l\'enregistrement des clients',//SHOP_CONFIG_SHOWBIRTHDAYFIELDS
'SHOP_THEME_blTopNaviLayout'            => 'Afficher la navigation par cat�gories en haut',//SHOP_CONFIG_TOPNAVILAYOUT
'HELP_SHOP_THEME_blTopNaviLayout'       => 'Habituellement, la navigation par cat�gories est affich�e � gauche. Si ce param�tre est activ�, la navigation par cat�gories sera affich� en haut uniquement.',

'SHOP_THEME_iTopNaviCatCount'           => 'Nombre de cat�gories � afficher en haut',//SHOP_CONFIG_TOPNAVICATCOUNT
'SHOP_THEME_blShowFinalStep'            => 'Afficher une confirmation de commande une fois la commande termin�e (5�me �tape de commande)',//SHOP_SYSTEM_SHOWFINALSTEP
'SHOP_THEME_iNewBasketItemMessage'      => 'Choisir une action lors de la mise au panier d\'un produit',//SHOP_SYSTEM_SHOWNEWBASKETITEMMESSAGE
'HELP_SHOP_THEME_iNewBasketItemMessage' => 'Lorsqu\'un client met un produit dans le panier, OXID eShop peut se comporter de diff�rentes mani�res. D�finissez le comportement � adopter.',//SHOP_SYSTEM_SHOWNEWBASKETITEMMESSAGE
'SHOP_THEME_iNewBasketItemMessage_0'    => 'Aucun',
'SHOP_THEME_iNewBasketItemMessage_1'    => 'Afficher un message',
'SHOP_THEME_iNewBasketItemMessage_2'    => 'Ouvrir une pop-up',
'SHOP_THEME_iNewBasketItemMessage_3'    => 'Ouvrir le panier',

'SHOP_THEME_blShowListDisplayType'            => 'Afficher le s�lecteur de pr�sentation des listes de produits',
'HELP_SHOP_THEME_blShowListDisplayType'       => 'Decide if the visitor of your store can select the type of the product list in store front. If this options is not activated, your visitors will see the lists displayed like you adjusted in the drop box "product list type".',
'SHOP_THEME_sDefaultListDisplayType'          => 'Mode d\'affichage par d�faut des listes de produits',
'SHOP_THEME_sDefaultListDisplayType_grid'     => 'Grille',
'SHOP_THEME_sDefaultListDisplayType_line'     => 'Liste',
'SHOP_THEME_sDefaultListDisplayType_infogrid' => 'Double grille',

'SHOP_THEME_sStartPageListDisplayType'        => 'Type de listing produit en page d\'accueil',
'SHOP_THEME_aNrofCatArticlesInGrid'           => 'Grille: Nombre de produits � afficher par page dans les listes dans la liste de s�l�ction (categories, r�sulats de recherche)<br><br>Attention: performances impact�es si valeur > 100',
'SHOP_THEME_aNrofCatArticles'                 => 'Nombre de produits � afficher par page dans les listes dans la liste de s�l�ction (categories, r�sulats de recherche)<br><br>Attention: performances impact�es si valeur > 100',

);

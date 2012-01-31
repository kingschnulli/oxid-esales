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
 * @version   SVN: $Id: lang.php 34553 2011-04-09 15:31:35Z vilma $
 */

/*
 * Capitalisation in this document:
 * First letter is always capitalized
 * All nouns are capitalized
 */

$aLang =  array(
'charset'                                       =>  'ISO-8859-15',

'HELP_SHOP_SYSTEM_OTHERCOUNTRYORDER'            =>  'D�finissez ici si des commandes peuvent �tre pass�es dans des pays pour lesquels aucun mode de livraison n\'a �t� d�fini:' .
                                                    '<ul><li>Si cette fonction est activ�e, les utilisateurs peuvent commander: Les utilisateurs seront notifi�s manuellement des co�ts de transport pour leur commande.</li>' .
                                                    '<li>Si cette fonction est d�sactiv�e, les utilisateurs de pays pour lesquels aucun mode de livraison n\'a �t� d�fini ne pourront pas commander.</li></ul>',

'HELP_SHOP_SYSTEM_DISABLENAVBARS'               =>  'Si cette fonction est activ�e, la plupart des �l�ments de navigation ne seront pas affich�s pendant le passage de commande. Le but est ici de ne pas distraire inutilement l\'utilisateur.',

'HELP_SHOP_SYSTEM_DEFAULTIMAGEQUALITY'          =>  'Valeurs recommand�es entre 40 et 80:<br>' .
                                                    '<ul><li>En de�� de 40, la compression de vient visible et les images sont troubles.</li>'.
                                                    '<li>Au-del� de 80 les am�liorations visuelles sont imperceptibles, en revanche la taille des images augmente de mani�re significative.</li></ul><br>'.
                                                    'La valeur par d�faut est 75.',

'HELP_SHOP_SYSTEM_SHOWVARIANTREVIEWS'           =>  'Ce param�tre d�fini le mode de gestion des commentaires client avec les variantes produit: Si activ�, les commentaires des variantes sont affich�es �galement sur le produit principal.',

'HELP_SHOP_SYSTEM_VARIANTSSELECTION'            =>  'Dans OXID eShop vous pouvez assigner des produits � de nombreuses listes, ex: promotions. Lorsque ce param�tre est activ�, les variantes sont affich�es dans ces listes �galement.',

'HELP_SHOP_SYSTEM_VARIANTPARENTBUYABLE'         =>  'Ce param�tre permet de d�finir si les produits parents peuvent �tre achet�s:' .
                                                    '<ul><li>Lorsque ce param�tre est activ�, les produits parents peuvent �tre achet�s �galement.</li>' .
                                                    '<li>Lorsque ce param�tre est d�sactiv�, seules les variantes du produit peuvent �tre achet�es.</li></ul>',

'HELP_SHOP_SYSTEM_VARIANTINHERITAMOUNTPRICE'    =>  'Ici, vous pouvez d�finir si les �chelles de prix sont h�rit�es du produit parent: Si activ�, les �chelles de prix sont disponibles pour les variantes du produit.',

'HELP_SHOP_SYSTEM_ISERVERTIMESHIFT'             =>  'Le serveur h�bergeant la solution peut utiliser un fuseau horaire diff�rent. Ce param�tre vous permet de d�finir un d�calage horaire: Saisissez le nombre d\'heures � ajouter/retrancher de l\'heure du serveur. ex: <kdb>+2</kdb> ou <kdb>-2</kdb>',

'HELP_SHOP_SYSTEM_INLINEIMGEMAIL'               =>  'Lorsque ce param�tre est activ�, les images sont envoy�es dans l\'email. Lorsque d�sactiv�, les images sont t�l�charg�es par le client de messagerie � l\'ouverture du message.',



'HELP_SHOP_CACHE_ENABLED'                       =>  'Lorsque la gestion de cache dynamique est activ�e, des contenus additionnels sont mis en cache pour augmenter les performances. D�sactivez ce param�tre pendant le param�trage de la solution (Cr�ation de modules/ templates...).',

'HELP_SHOP_CACHE_LIFETIME'                      =>  'Saisissez ici le temps de mise en cache (en secondes) des contenus avant leur mise � jour. La valeur par d�faut est 36000 secondes.',

'HELP_SHOP_CACHE_CLASSES'                       =>  'Vous pouvez d�finir ici quelles classes de vues sont mises en cache.<br> Ne changez ces param�tres que si vous �tes familier avec les mecanismes de mise en cache!',



'HELP_SHOP_CONFIG_ORDEROPTINEMAIL'              =>  'Lorsque le double-opt-dans est actif, les utilisateurs recoivent un eMail avec un lien de confirmation lorsqu\'ils s\'abonnent � la Newsletter. L\'inscription n\'est valide que lorsque la confirmation � �t� effectu�e.<br>' .
                                                    'Le Double-opt-dans prot�ge les utilisateurs d\'abonnements non sollicit�s. Sans double-opt-dans, n\'importe quelle adresse eMail peut �tre utilis�e pour la Newsletter. Avec le double-opt-dans, le propri�taire de l\'adresse doit confirmer sont inscription.',

'HELP_SHOP_CONFIG_BIDIRECTCROSS'                =>  'Avec le Cross-selling vous pouvez proposer des produits compl�mentaires � un produit: Si par exemple des pneus sont d�finis comme produits compl�mentaires � une voiture, les pneus sont affich�s avec la voiture.<br>' .
                                                    'Si le Cross-selling bidirectionnel est activ�, il fonctionnera dans les deux sens.',

'HELP_SHOP_CONFIG_STOCKONDEFAULTMESSAGE'        =>  'Pour chaque produit, vous pouvez d�finir un message si le produit est en stock.<br>' .
                                                    'Lorsque ce param�tre est activ�, un message g�n�rique est affich� si aucun message sp�cifique n\'a �t� d�fini. Le message g�n�rique <span class="filename_filepath_or_italic">Produit en stock</span> est affich�.',

'HELP_SHOP_CONFIG_STOCKOFFDEFAULTMESSAGE'       =>  'Pour chaque produit, vous pouvez d�finir un message si le produit n\'est pas en stock.<br>' .
                                                    'Lorsque ce param�tre est activ�, un message g�n�rique est affich� si aucun message sp�cifique n\'a �t� d�fini. Le message g�n�rique <span class="filename_filepath_or_italic">Produit en rupture de stock. En cours de r�approvisionnement</span> est affich�.',

'HELP_SHOP_CONFIG_OVERRIDEZEROABCPRICES'        =>  'Vous pouvez d�finir des prix sp�ciaux pour des utilisateurs sp�cifiques: Pour cela, dans chaque produit vous pouvez d�finir des prix A, B et C. Si les utilisateurs appartiennent au groupe <span class="filename_filepath_or_italic">Price A</span>, Le prix A sera affich� � la place du prix normal.<br>' .
                                                    'Lorsque ce param�tre est actif, le prix normal est utilis� si aucun prix A, B ou C n\'a �t� d�fini.<br>' .
                                                    'A n\'activer que si vous utilisez des prix A, B et C prices.',

'HELP_SHOP_CONFIG_SEARCHFIELDS'                 =>  'Ici, vous pouvez d�finir les champs dans lesquels la recherche sera effective. Saisissez un champ par ligne.<br>' .
                                                    'Les champs fr�quemment d�finis sont:' .
                                                    '<ul><li>oxtitle = Titre</li>' .
                                                    '<li>oxshortdesc = Description courte</li>' .
                                                    '<li>oxsearchkeys = Mots cl�s de recherche</li>' .
                                                    '<li>oxartnum = R�f produit</li>' .
                                                    '<li>oxtags = Tags</li></ul>',

'HELP_SHOP_CONFIG_SORTFIELDS'                   =>  'Ici, vous pouvez d�finir les champs utilis�s pour les tris dans les listes produits. Saisissez un champ par ligne.<br>' .
                                                    'Les champs fr�quemment d�finis sont:' .
                                                    '<ul><li>oxtitle = Titre</li>' .
                                                    '<li>oxprice = Prix</li>' .
                                                    '<li>oxvarminprice = Prix minimum si utilisation prix par variante.</li>' .
                                                    '<li>oxartnum = R�f produit</li>' .
                                                    '<li>oxrating = Notation</li>' .
                                                    '<li>oxstock = Stock</li></ul>',

'HELP_SHOP_CONFIG_MUSTFILLFIELDS'               =>  'Ici, vous pouvez d�finir les champs obligatoires pour la cr�ation d\'un utilisateur. Saisissez un champ par ligne.<br>' .
                                                    'Les champs fr�quemment d�finis sont:' .
                                                    '<ul><li>oxuser__oxfname = Pr�nom</li>' .
                                                    '<li>oxuser__oxlname = Nom</li>' .
                                                    '<li>oxuser__oxstreet = Adresse</li>' .
                                                    '<li>oxuser__oxstreetnr = N� de voie</li>' .
                                                    '<li>oxuser__oxzip = Code postal</li>' .
                                                    '<li>oxuser__oxcity = Ville</li>' .
                                                    '<li>oxuser__oxcountryid = Pays</li>' .
                                                    '<li>oxuser__oxfon = T�l�phone</li></ul><br>' .
                                                    'Vous pouvez �galement d�finir des champs obligatoires lors de l\'utilisation d\'une adresse de livraison diff�rente. Les champs fr�quemment d�finis sont:' .
                                                    '<ul><li>oxaddress__oxfname = Pr�nom</li>' .
                                                    '<li>oxaddress__oxlname = Nom</li>' .
                                                    '<li>oxaddress__oxstreet = Adresse</li>' .
                                                    '<li>oxaddress__oxstreetnr = N� de voie</li>' .
                                                    '<li>oxaddress__oxzip = Code postal</li>' .
                                                    '<li>oxaddress__oxcity = Ville</li>' .
                                                    '<li>oxaddress__oxcountryid = Pays</li>' .
                                                    '<li>oxaddress__oxfon = T�l�phone</li></ul>',

'HELP_SHOP_CONFIG_USENEGATIVESTOCK'             =>  'Le param�tre <span class="navipath_or_inputname">Autoriser les valeurs de stock n�gatives</span> vous permet de d�finir comment g�rer vos stocks:<br>' .
                                                    '<ul><li>Lorsque ce param�tre est activ�, des niveaux de stocks n�gatifs sont calcul�s.</li>' .
                                                    '<li>Lorsque ce param�tre est d�sactiv�, la valeur du stock ne descend jamais en dessous de 0.</li></ul>',

'HELP_SHOP_CONFIG_NEWARTBYINSERT'               =>  'Sur la page d\'accueil de la boutique, les derniers produits propos�s � la vente sont affich�s dans <span class="filename_filepath_or_italic">Derniers arrivages</span>.  Ce param�tre permet de choisir comment les nouveaux produits sont d�finis : par date de rc�ation our par date de derni�re modification.',

'HELP_SHOP_CONFIG_LOAD_DYNAMIC_PAGES'           =>  'Si cette fonction est activ�e, des informations additionnelles � propos des produits OXID sont affich�es dans le menu. Ex: � propos d\'OXID eFire.',


'HELP_SHOP_CONFIG_DELETERATINGLOGS'             =>  'Si un utilisateur note un  produit, il ne peut plus le noter une seconde fois. Vous pouvez d�finir ici un d�lai entre deux notations produit pour un utilisateur. Laisser vide pour d�sactiver - Une seule notation produit par utilisateur sera alors possible.',

'HELP_SHOP_CONFIG_DISABLEONLINEVATIDCHECK'      =>  'La validation en ligne du num�ro de TVA est effectu�e si un client de la zone EURO renseigne un num�ro de TVA lors d\'une commande. Si le num�ro de TVA renseign� est valide, la TVA ne sera pas calcul�e sur la commande.<br>'.
                                                    'Si cette fonction n\'est pas activ�e, le taux de TVA applicable est utilis�.',

'HELP_SHOP_CONFIG_ALTVATIDCHECKINTERFACEWSDL'   =>  'Vous pouvez renseigner ici une URL alternative pour la validation des num�ros de TVA.',

'HELP_SHOP_CONFIG_PSLOGIN'                      =>  'La Connexion Ventes Priv�es transforme votre shop en site de ventes priv�es r�serv� aux seuls membres.',

'HELP_SHOP_CONFIG_BASKETEXCLUDE'                =>  'Autorise la mise au panier de produits d\'une seule cat�gorie (Principale). Si un changement de cat�gorie est ' .
                                                    'd�tect�, l\'utilisateur se vera demand� de finaliser sa commande ou bien de continuer son shopping ' .
                                                    '(dans le seuxi�me cas, le panier sera vid�). Cette fonctionnalit� est � utiliser conjointement avec ' .
                                                    ' une structure de cat�gories proprement organis�e.',

'HELP_SHOP_CONFIG_BASKETRESERVATION'            =>  'Lorsque cette fonctionnalit� est d�sactiv�e, eShop diminue la quantit� en stock du produit imm�diatement ' .
                                                    'lorsque la commande est confirm�e et le processus de commande termin�.<br><br> ' .
                                                    'Lorsque activ�e, cette fonctionnalit� permet : la r�duction du stock de produit ' .
                                                    'temporairement <b>r�serv�</b> lors de la mise au panier. La r�servation est annul�e '.
                                                    'lorsque la commande est pass�e ou � l\'expiration du panier.',

'HELP_SHOP_CONFIG_BASKETRESERVATIONTIMEOUT'     =>  'Apr�s ce d�lai, les produits r�serv�s retournent dans le stock et le panier du client est vid�.',

'HELP_SHOP_CONFIG_INVITATION'                   =>  'Les invitations sont utiliser pour inviter ' .
                                                    'ses amis � se connecter sur la boutique et gagner des points.',

'HELP_SHOP_CONFIG_POINTSFORINVITATION'          =>  'Le montant de points gagn�s par un utilisateur invit� par un utilisateur existant.' .
                                                    'L\'invit� doit s\'enregistrer pour collecter ces points.' .
                                                    'Les points collect�s sont enregistr�s dans la fiche client et peuvent �tre utilis�s par le gestionnaire de la boutique comme il l\'entend.',

'HELP_SHOP_CONFIG_POINTSFORREGISTRATION'        =>  'Le montant de points gagn�s par un utilisateur ayant invit� une personne. ' .
                                                    'L\'utilisateur re�oit des points uniquement si son invit� s\'inscrit effectivement dans la boutique.' .
                                                    'Les points collect�s sont enregistr�s dans la fiche client et peuvent �tre utilis�s par le gestionnaire de la boutique comme il l\'entend.',

'HELP_SHOP_CONFIG_SHOP_CONFIG_FACEBOOKAPPID'    =>  'Pour connecter votre boutique � Facebook vous devez saisir votre Application ID. ' .
                                                    'Un guide pour la connexion de votre boutique � Facebook est accessible ici : ' .
                                                    '<a href="http://wiki.oxidforge.org/Tutorials/Connecting_website_to_facebook" target="_blank" target="_blank">tutoriel (anglais)</a>.',

'HELP_SHOP_CONFIG_SHOP_CONFIG_FBSECRETKEY'      =>  'Pour assurer la s�curit� des connexions avec Facebook, vous devez ' .
                                                    'saisir la cl� de s�curit� obtenue lors de l\'enregistrement de votre site aupr�s de ' .
                                                    'Facebook. Voir le <a href="http://wiki.oxidforge.org/Tutorials/Connecting_website_to_facebook" target="_blank" target="_blank">tutoriel</a> ' .
                                                    'Comment se connecter avec Facebook.',

'HELP_SHOP_CONFIG_FBCOMMENTS'                   =>  "La bo�te de commentaires permet � vos visiteurs de facilement commenter les contenus de votre boutique.",

'HELP_SHOP_CONFIG_FBFACEPILE'                   =>  "Facepile affiche les images du profil des visiteurs qui suivent votre site sur Facebook.",

'HELP_SHOP_CONFIG_FBLIVESTREAM'                 =>  'Live stream permet � vos utilisateurs de partager leurs commentaires et activit� en temps r��l sur votre site.',

'HELP_SHOP_CONFIG_FBINVITE'                     =>  'Affiche la liste d\'amis Facebook de vos utilisateurs pour leur permettre de les inviter � se connecter sur votre boutique.',

'HELP_SHOP_CONFIG_FBSHARE'                      =>  'Affiche le bouton "Facebook share" sur votre boutique.',

'HELP_SHOP_CONFIG_FBLIKE'                       =>  'Permet � vos utilisateurs d\'�tablir des connexions sur vos pages et partager ces contenus avec leurs amis sur Facebook en un clic.',

'HELP_SHOP_CONFIG_FACEBOOKCONNECT'              =>  'Affiche la bo�te de connexion "Facebook Connect" permettant aux utilisateurs de se connecter � la boutique avec leur compte Facebook.',


'HELP_SHOP_CONFIG_ATTENTION'                    => 'Attention: M�me si du cryptage est utilis�, cette pratique est dangereuse et non recommand�e!',

'HELP_SHOP_MALL_MALLMODE'                       =>  'D�finissez ici ce qui est affich� en page d\'accueil de votre boutique:' .
                                                    '<ul><li><span class="navipath_or_inputname">Afficher la liste des boutiques</span>: Une page listant les boutiques disponibles est affich�e.</li>' .
                                                    '<li><span class="navipath_or_inputname">Afficher la page d\'accueil de la boutique principale</span>: La page d\'accueil du site principal est affich�e normalement.</li></ul>',

'HELP_SHOP_MALL_PRICEADDITION'                  =>  'Vous pouvez d�finir une surcharge des prix sur l\'ensemble des produits de cette boutique: Saisissez la valeur de cette surcharge et s�lectionnez son type (<span class="userinput_or_code">%</span>) ou bien (<span class="userinput_or_code">abs</span>).',



'HELP_SHOP_PERF_NEWESTARTICLES'                 =>  'Un listes des produits r�cents est affich�e dans <span class="filename_filepath_or_italic">Derniers arrivages!</span>. Vous pouvez sp�cifier ici comment est g�r�e cette liste:' .
                                                    '<ul><li><span class="userinput_or_code">inactive</span>: La liste n\'est pas affich�e.</li>' .
                                                    '<li><span class="userinput_or_code">manuel</span>: Vous d�finissez le contenu dans <span class="navipath_or_inputname">Information clients -> Promotions -></span> dans la promotion <span class="filename_filepath_or_italic">Derniers arrivages!</span>.</li>' .
                                                    '<li><span class="userinput_or_code">automatique</span>: Les produits sont calcul�s automatiquement.</li></ul>',

'HELP_SHOP_PERF_TOPSELLER'                      =>  'Une liste des produits les plus command�s est affich�e dans <span class="filename_filepath_or_italic">Best sellers</span>. Vous pouvez sp�cifier ici comment est g�r�e cette liste:' .
                                                    '<ul><li><span class="userinput_or_code">inactive</span>: La liste n\'est pas affich�e.</li>' .
                                                    '<li><span class="userinput_or_code">manual</span>: Vous d�finissez le contenu dans <span class="navipath_or_inputname">Information clients -> Promotions -></span> dans la promotion <span class="filename_filepath_or_italic">Best sellers</span>.</li>' .
                                                    '<li><span class="userinput_or_code">automatic</span>: Les produits sont calcul�s automatiquement.</li></ul>',

'HELP_SHOP_PERF_LOADFULLTREE'                   =>  'Lorsque ce param�tre est coch�, l\'arbre complet des cat�gories est affich� dans la navigation par cat�gorie (Toutes les cat�gories sont d�ploy�es). Cela ne fonctionne que si la navigation par cat�gories n\'est pas affich�e en haut.',

'HELP_SHOP_PERF_LOADACTION'                     =>  'Lorsque ce param�tre est coch�, les promotions comme <span class="filename_filepath_or_italic">Derniers arrivages!</span> et/ou <span class="filename_filepath_or_italic">Best sellers</span> sont charg�es et affich�es.',

'HELP_SHOP_PERF_LOADREVIEWS'                    =>  'Les utilisateurs peuvent noter et commenter les produits. Si ce param�tre est activ�, les commentaires et notations existants sont charg�s et affich�s dans la fiche produit.',

'HELP_SHOP_PERF_USESELECTLISTPRICE'             =>  'Les surcharges/remises peuvent �tre activ�s. Si ce param�tre est activ�, les surcharges/ remises sont charg�es et activ�es. Sinon, elles ne le seront pas.',

'HELP_SHOP_PERF_DISBASKETSAVING'                =>  'Le panier des utilisateurs est sauvegard�. Lorsqu\'ils reviennent sur la boutique, le contenu de leur panier est charg�. Si vous activ� ce param�tre, les paniers ne seront plus enregistr�s.',

'HELP_SHOP_PERF_LOADDELIVERY'                   =>  'Si vous d�sactivez ce param�tre, aucun frais de port ne sera calcul�: Les frais de port seront tous fix�s � 0.00 �.',

'HELP_SHOP_PERF_LOADPRICE'                      =>  'Si vous d�sactivez ce param�tre, aucun prix de produit ne sera calcul�: Aucun prix ne sera alors affich�.',

'HELP_SHOP_PERF_PARSELONGDESCINSMARTY'          =>  'Si ce param�tre est activ�, les descriptions des produits et les cat�gories seront pars�es via Smarty: Vous pourrez utiliser les tags Smarty (ex: pour utiliser des variables) <br>',

'HELP_SHOP_PERF_LOADATTRIBUTES'                 =>  'Normalement, les attributs ne sont acharg�s que dans la fiche produit. Si ce param�tre est activ�, les attributs seront toujours charg�s avec un produit.<br>' .
                                                    'Ce param�tre peut �tre utile lorsque vous souhaitez adapter les templates. Ex: Afficher les attributs dans les listes produits �galement.',

'HELP_SHOP_PERF_LOADSELECTLISTSINALIST'         =>  'Normalement, les listes de s�l�ctions ne sont acharg�s que dans la fiche produit. Si ce param�tre est activ�, les listes de s�l�ctions seront �galement affich�es dans les listes produits (Ex: R�sultats de recherche, cat�gories).',

'HELP_SHOP_PERF_CHECKIFTPLCOMPILE'              =>  'Si ce param�tre est activ�, Votre boutique eShop v�rifiera � chaque appel si un temaplate a �t� modifi�. Si tel est le cas, le rendu est recalcul�. Pour des raisons de performance, n\'activez ce param�tre uniquement lorsque vous effectuez des modifiactions sur les templates.',

'HELP_SHOP_PERF_CLEARCACHEONLOGOUT'             =>  'En temps normal, le cache est vid� � chaque sauvegarde de modifications dans le back-office. Ceci peut g�n�rer des probl�mes de performance dans le back-office. Si ce param�tre est activ�, le cache ne sera vid� que lorsque vous vous d�connecterez du back-office.',

'HELP_SHOP_SEO_TITLEPREFIX'                     =>  'Chaque page dispose d\'un titre. ce titre est affich� en haut de la fen�tre du navigateur. Avec <span class="navipath_or_inputname">Prefixe Titre</span> et <span class="navipath_or_inputname">Suffixe Titre</span> vous pouvez ajouter du texte avant et apr�s le titre:<br>' .
                                                    '<ul><li>Dans <span class="navipath_or_inputname">Pr�fixe Titre</span>, saisissez le texte � afficher avant le titre de la page.</li></ul>',

'HELP_SHOP_SEO_TITLESUFFIX'                     =>  'Chaque page dispose d\'un titre. ce titre est affich� en haut de la fen�tre du navigateur. Avec <span class="navipath_or_inputname">Prefixe Titre</span> et <span class="navipath_or_inputname">Suffixe Titre</span> vous pouvez ajouter du texte avant et apr�s le titre:<br>' .
                                                    '<ul><li>Dans <span class="navipath_or_inputname">Suffixe Titre</span>, saisissez le texte � afficher apr�s le titre de la page.</li></ul>',

'HELP_SHOP_SEO_IDSSEPARATOR'                    =>  'Le s�parateur est utilis� lorsque le nom des cat�gories et des produits est compos� de plusieurs mots Le s�parateur sera utilis� � la place des espaces. ex: www.youreshop.com/category-name-of-several-words<br>' .
                                                    'Si aucun s�parateur n\'est d�fini, - sera utilis�.',

'HELP_SHOP_SEO_SAFESEOPREF'                     =>  'Si plusieurs produits ont le m�me nom et se trouvent dans une m�me cat�gorie, ils devraient avoir la m�me URL SEO. Afin d\'�viter cela, le Suffixe SEO est rajout�. Si aucun suffixe SEO n\'est d�fini, <span class="filename_filepath_or_italic">oxid</span> sera utilis�.',

'HELP_SHOP_SEO_REPLACECHARS'                    =>  'Des caract�res accentu�s, comme le � fran�ais doivent �tre enelv�s des URLs SEO, car ils peuvent poser probl�me. Vous pourrez d�finir ici comment ces caract�res seront remplac�s. La syntaxe est <code>caract�re sp�cial => caract�re de substitution</code>, ex: <code>� => Ue</code>.<br>' .
                                                    'Pour l\'allemand, les caract�res de substitution sont d�j� d�finis.',

'HELP_SHOP_SEO_RESERVEDWORDS'                   =>  'Quelques URLs sont r�serv�es dans OXID eShop, comme www.youreshop.com/admin pour acc�der au back-office. Si une cat�gorie est nomm�e <span class="filename_filepath_or_italic">admin</span> son URL SEO devrait logiquement �tre www.youreshop.com/admin �galement - dans ce cas, la cat�gorie ne pourra�t �tre accessible. Voici donc la raison d\'�tre du suffixe SEO, qui est rajout� � ces URLs. Vous pouvez d�finir ici quelles URLs seront automatiquement suffix�es.',

'HELP_SHOP_SEO_SKIPTAGS'                        =>  'Si aucun META tags n\'est d�fini pour un produit ou une cat�gorie, les META tags sont cr��s automatiquement. De cette fa�on, certains termes non souhait�s pourraient �tre d�finis. Tous les mots saisi ici  seront automatiquement exclus de la g�n�ration des META Tags.',

'HELP_SHOP_SEO_STATICURLS'                      =>  'Pour les pages sp�ciales (ex: conditions g�n�rales) vous pouvez d�finir des URLs SEO fixes. Lorsque vous s�l�ctionnez une URL statique, son URL normale est affich�e dans <span class="navipath_or_inputname">URL Standard</span>. Dans le champ de saisie situ� en dessous, vous pouvez d�fiir une URL SEO pour chaque langue.',

'HELP_SHOP_MAIN_PRODUCTIVE'                     =>  'Tant que ce param�tre n\'est <span class="warning_or_important_hint">pas</span> actif, les informations relatives aux temps d\'execution et au debuggage sont affich�es en pied de page. Ces informations sont tr�s utilies lors de la customization de la boutique.<br>' .
                                                    '<span class="warning_or_important_hint">Activez ce param�tres lorsque vous passez en production. Dans ce cas, seul le contenu de la boutique sera affich� � vos utilisateurs.</span>',

'HELP_SHOP_MAIN_ACTIVE'                         =>  'Avec <span class="navipath_or_inputname">Actif</span> vous pouvez activer ou d�sactiver compl�tement votre boutique. Si votre boutique est d�sactiv�e, a message expliquent que la boutique est temporairement inaccessible est affich� � vos utilisateurs. Ce param�tre peut �tre utile dans le cadre d\'op�rations de maintenance.',

'HELP_SHOP_MAIN_INFOEMAIL'                      =>  'Tous les e-mails envoy�s par le biais du formulaire de contact sont envoy�s � cette adresse e-mail.',

'HELP_SHOP_MAIN_ORDEREMAIL'                     =>  'Lorsque les utilisateurs re�oivent un e-mail avec un r�sum� de leur commande, les r�ponses � cet e-mail sont envoy�s � <span class="navipath_or_inputname">R�ponse mail de commande</span>.',

'HELP_SHOP_MAIN_OWNEREMAIL'                     =>  'Lorsque les utilisateurs re�oivent un e-mail avec un r�sum� de leur commande. Ces e-mails sont envoy�s par <span class="navipath_or_inputname">Exp�diteur mail commande</span>.',

'HELP_SHOP_MAIN_SMTPSERVER'                     =>  'Les param�tres SMTP sont n�cessaires � l\'envoi des e-mails (ex: envoi d\'un e-mail de confirmation de commande).',

'HELP_ARTICLE_MAIN_ALDPRICE'                    =>  'Gr�ce � <span class="navipath_or_inputname">Prix Alt.</span> vous pouvez d�finir des prix sp�ciaux enfonction de groupes d\'utilisateurs.',

'HELP_ARTICLE_MAIN_VAT'                         =>  'Vous pouvez d�finir ici un taux de TVA sp�cifique pour ce produit. Ce taux de TVA sera prix en compte dans tous les calculs relatifs � ce produit (panier, commande, facture)',

'HELP_ARTICLE_MAIN_TAGS'                        =>  'Saisissez ici des tags pour le produit. Ces tags seront utilis�s pour le nuage de tags sur la page d\'accueil. Les Tags sont s�par�s par une virgule.',

'HELP_ARTICLE_EXTEND_UNITQUANTITY'              =>  'Gr�ce � <span class="navipath_or_inputname">Quantit�</span> et <span class="navipath_or_inputname">Unit�</span> vous pouvez afficher le prix par unit� de mesure (ex: 1,43�/ Litre). Dans <span class="navipath_or_inputname">Quantit�</span>, s�lectionn� la quantit� de produit (ex: <span class="userinput_or_code">1,5</span>), dans <span class="navipath_or_inputname">Unit�</span> l\'unit� de mesure correspondante. (ex: <span class="userinput_or_code">litre</span>). Le prix par unit� sera alors calcul� et affich� sur la fiche produit.',

'HELP_ARTICLE_EXTEND_EXTURL'                    =>  'Dans <span class="navipath_or_inputname">URL Externe</span> vous pouvez renseigner un lien vers des informations compl�mentaires (ex: Vers le site de la marque). Dans <span class="navipath_or_inputname">Texte de l\'URL externe</span> saisissez le texte qui sera affich� pour le lien (ex: <span class="userinput_or_code">Plus d\'information sur le site de la marque</span>.',

'HELP_ARTICLE_EXTEND_TPRICE'                    =>  'Dans <span class="navipath_or_inputname">PPR</span> saisissez le Prix Public Recommand� par le fabricant. Si cette donn�e est renseign�e, elle sera affich�e (prix barr�) � vos utilisateurs, au-dessus du prix de vente.',

'HELP_ARTICLE_EXTEND_QUESTIONEMAIL'             =>  'Dans <span class="navipath_or_inputname">Alt. Contact</span> vous saisirez une adresse e-mail. Lorsque des utilisateurs demanderons des renseignements sur ce produit, ces demandes seront envoy�es � cette adresse. Si aucun e-mail n\'est renseign�, la demande sera rout�e � l\'adresse e-mail de contact par d�faut.',

'HELP_ARTICLE_EXTEND_SKIPDISCOUNTS'             =>  'Si <span class="navipath_or_inputname">Ne pas appliquer de rabais</span> est actif, aucun rabais ne sera calcul� pour ce produit. Ceci inclus les promotions et les bons de r�duction.',

'HELP_ARTICLE_EXTEND_TEMPLATE'                  =>  'La fiche produit peut �tre affich�e avec diff�rents templates. Pour se faire, saisissez le nom du template � utiliser.',

'HELP_ARTICLE_EXTEND_ISCONFIGURABLE'            =>  'Si le produit est customizable, un champ de saisie additionel est affich� sur la fiche produit et dans le panier d\'achats. Les clients pourront alors saisir un texte pour customiser le produit.<br><br>'.
                                                    'Un exemple typique de l\'utilit� de cette fonction pour la vente de tee-shirts qui peuvent �tre imprim�s avec un message personnalis�.',

'HELP_ARTICLE_PICTURES_ICON'                    =>  'Les ic�nes sont les plus petits visuels produits. Ils sont utilis�s entre autres dans le panier.<br>'.
                                                    'Transf�rer une image ic�ne remplacera l\'image actuelle g�n�r�e depuis la premi�re image produit.<br>' .
                                                    'Apr�s transfert, le nom de l\'image est affich� dans ic�ne. Si aucune ic�ne n\'a �t� transf�r�e, --- est affich�.<br>',

'HELP_ARTICLE_PICTURES_THUMB'                   =>  'Les vignettes sont de petites images produit. Elles sont principalement utilis�es dans les listes produits (cat�gories, r�sultats de recherche).<br>' .
                                                    'Transf�rer une image vignette remplacera l\'image actuelle g�n�r�e depuis la premi�re image produit.<br>' .
                                                    'Apr�s transfert, le nom de l\'image est affich� dans vignette. Si aucune vignette n\'a �t� transf�r�e, --- est affich�.<br>',

'HELP_ARTICLE_PICTURES_PIC1'                    =>  'Les visuels produits sont utilis�s dans la fiche produit. Vous pouvez transf�rer jusqu\'� 7 images par produit. Apr�s transfert, le nom de l\'image est affich� dans le champ correspondant. Si aucune image n\'a �t� transf�r�e, --- est affich�.<br>' .
                                                    'Transf�rez des visuels de grande r�solution.  Apr�s le transfert, l\'image principale, l\'image Zoom, la vignette et l\'ic�ne seront g�n�r�es automatiquement.',

'HELP_ARTICLE_PICTURES_ZOOM1'                   =>  'Les images Zomm sont des visuels de grande taille qui sont accessibles depuis la fiche produit. </br>' .
                                                    'Vous pouvez transf�rer des images Zoom dans <span class="navipath_or_inputname">Zoom X upload</span>. Apr�s transfert, le nom de l\'image est affich� dans <span class="navipath_or_inputname">Zoom X</span> . Si aucune image Zoom n\'a �t� transf�r�e, <span class="userinput_or_code">nopic.jpg</span> est affich�.<br>',

'HELP_ARTICLE_STOCK_STOCKFLAG'                  =>  'Dans <span class="navipath_or_inputname">Type de stock</span> vous pouvez choisir parmi 4 possibilit�s:' .
                                                    '<ul><li><span class="userinput_or_code">Standard</span>: Le produit peut �tre command� m�me si pas de stock disponible.</li>' .
                                                    '<li><span class="userinput_or_code">Entrep�t Externe</span>: Le produit peut toujours �tre command� et sera toujours affich� <span class="filename_filepath_or_italic">En stock</span>.</li>' .
                                                    '<li><span class="userinput_or_code">Si hors stock, ne pas afficher</span>: Le produit n\'est pas affich� aux clients lorsque pas de stock disponible.</li>' .
                                                    '<li><span class="userinput_or_code">Si hors stock, pas de commande possible</span>: Le produit est affich� aux clients mais la commande n\'est pas possible.</li></ul>',

'HELP_ARTICLE_STOCK_REMINDACTIV'                =>  'Avec <span class="navipath_or_inputname">Envoyer un E-mail si le stock tombe sous un seuil de</span> vous pouvez demander qu\'un e-mail soit envoy� lorsque le stock atteint un seuil fix�. Pour activer cette fonction, cochez la case et d�finissez le niveau d\'alerte.',

'HELP_ARTICLE_STOCK_DELIVERY'                   =>  'Vous pouvez d�finir ici la date � partir de laquelle le produit sera � nouveau disponible (date de r�approvisonnement). Le format est jour-mois-ann�e, ex: 12-02-2010.',

'HELP_ARTICLE_SEO_FIXED'                        =>  'Vous pouvez laissez OXID eShop recalculer les URLs SEO. Une page produit recevra une nouvelle URL SEO si par exemple le titre du produit � chang�. Le param�tre <span class="navipath_or_inputname">URL Fixe</span> vous permet d\'�viter ce cas de figure : Si activ�, l\'ancienne URL SEO est conserv�e et aucune nouvelle URL n\'est calcul�e.',

'HELP_ARTICLE_SEO_KEYWORDS'                     =>  'Ces mots cl� sont int�gr�s dans le code source HTML des pages produit (META keywords). Ces informations sont utilis�es par les moteurs de recherche. Des mots cl�s adapt�s pour le produit peuvent �tre saisis ici. Si aucun mot cl� n\'est renseign�, les mots cl� seront automatiquement g�n�r�s.',

'HELP_ARTICLE_SEO_DESCRIPTION'                  =>  'Cette description est int�gr�e dans le code source HTML des pages produit (META description). Ce texte est souvent affich� dans les pages de r�sultats des moteurs de recherche. Une description adapt�e pour le produit peut �tre saisie ici. Si aucun texte n\'est renseign�, une description sera automatiquement g�n�r�e.',

'HELP_ARTICLE_SEO_ACTCAT'                       =>  'Vous pouvez d�finir plusieurs URLs SEO pour les produits: Pour certaines pages cat�gories et marque. Avec <span class="navipath_or_inputname">Cat�gorie/ Vendeur active</span> vous pouvez s�lectionner l\'URL SEO que vous souhaitez modifier.',

'HELP_ARTICLE_STOCK_STOCKTEXT'                  =>  'Saisissez ici un message qui sera affich� si le produit est "En stock".',

'HELP_ARTICLE_STOCK_NOSTOCKTEXT'                =>  'Saisissez ici un message qui sera affich� si le produit est "En rupture de stock".',

'HELP_ARTICLE_STOCK_AMOUNTPRICE_AMOUNTFROM'     =>  'Dans <span class="navipath_or_inputname">Quantit� de/ �</span> vous pourrez d�finir pour quelles quantit�s le prix gradu� est valide.<br>',

'HELP_ARTICLE_STOCK_AMOUNTPRICE_PRICE'          =>  'Ici, vous renseignerez le prix correspondant aux quantit�s saisies plus haut. Votre prix peut �tre exprim� en valeur abolue ou bien en pourcentage de remise.<br> ',

'HELP_ARTICLE_VARIANT_VARNAME'                  =>  '<span class="navipath_or_inputname">Nom de la s�lection</span> permet de nommer une s�lection de variantes. Ex: <span class="userinput_or_code">Couleur</span> ou <span class="userinput_or_code">Taille</span>.<br> ',

'HELP_CATEGORY_MAIN_HIDDEN'                     =>  'Avec <span class="navipath_or_inputname">Masqu�e</span> D�finissez si cette cat�gorie est affich�e ou non aux utilisateurs de la boutique.',

'HELP_CATEGORY_MAIN_PARENTID'                   =>  'Dans <span class="navipath_or_inputname">Sous-cat�gorie de</span> d�finissez la hi�rarchie de votre cat�gorie, � quel endroit sera affich�e cette cat�gorie :<br>' .
                                                    '<ul><li>Si la categorie est une cat�gorie principale (niveau 1), alors s�lectionnez <span class="userinput_or_code">--</span>.</li>' .
                                                    '<li>Si la categorie est une sous-cat�gorie d\'une autre cat�gorie, alors s�lectionnez cette cat�gorie "parente" dans la liste.</li></ul>',

'HELP_CATEGORY_MAIN_EXTLINK'                    =>  'Avec <span class="navipath_or_inputname">Lien externe</span>, vous pouvez renseigner un lien qui s\'ouvrira lorsque l\'utilisateur cliquera sur la cat�gorie. <span class="warning_or_important_hint">Utilisez cette fonction seulement si vous souhaitez afficher un lien dans le menu cat�gories!</span>',

'HELP_CATEGORY_MAIN_PRICEFROMTILL'              =>  'Avec <span class="navipath_or_inputname">Prix � partir de/ �</span> vous pouvez d�finir que <span class="warning_or_important_hint">tous</span> les produits compris dans cette fourchette de prix seront affich�s dans cette cat�gorie.',

'HELP_CATEGORY_MAIN_DEFSORT'                    =>  'Avec <span class="navipath_or_inputname">Tri rapide</span> vous permet de d�finir l\'ordre d\'affichage des produits dans la cat�gorie.',

'HELP_CATEGORY_MAIN_SORT'                       =>  'Vous pouvez utiliser <span class="navipath_or_inputname">Tri</span> to define the order dans which categories are displayed: The category with the lowest number is displayed at the top, and the category with the highest number at the bottom.',

'HELP_CATEGORY_MAIN_THUMB'                      =>  'Avec <span class="navipath_or_inputname">Image</span> et <span class="navipath_or_inputname">Envoyer image</span> vous pourrez transf�rer un visuel pour cette cat�gorie. Le visuel sera affich� en haut de page lorsque la cat�gorie sera consult�e. Apr�s la sauvegarde, via le bouton <span class="navipath_or_inputname">Enregistrer</span>, l\'image est g�n�r�e et son nom s\'affiche dans <span class="navipath_or_inputname">Image</span>.',

'HELP_CATEGORY_MAIN_PROMOTION_ICON'             =>  'Avec <span class="navipath_or_inputname">Ic�ne pour les promotions</span> et <span class="navipath_or_inputname">Envoyer ic�ne</span> vous pourrez transf�rer un visuel de cat�gorie promotionnel (mise en avant) pour la page d\'accueil. Pour mettre en avant une cat�gorie, rendez-vous dans <span class="navipath_or_inputname">Information client -> Meilleures offres de la cat�gorie/span>',

'HELP_CATEGORY_MAIN_SKIPDISCOUNTS'              =>  '<li>Si <span class="navipath_or_inputname">Ne pas appliquer les remises</span> est actif, aucune remise/ promotion ne sera calcul�e/appliqu�e sur les produits de la cat�gorie.',

'HELP_CATEGORY_SEO_FIXED'                       =>  'Vous pouvez laissez OXID eShop recalculer les URLs SEO. Une page cat�gorie recevra une nouvelle URL SEO si par exemple le titre de la cat�gorie � chang�. Le param�tre <span class="navipath_or_inputname">URL Fixe</span> vous permet d\'�viter ce cas de figure : Si activ�, l\'ancienne URL SEO est conserv�e et aucune nouvelle URL n\'est calcul�e.',

'HELP_CATEGORY_SEO_KEYWORDS'                    =>  'Ces mots cl� sont int�gr�s dans le code source HTML des pages cat�gorie (META keywords). Si aucun mot cl� n\'est renseign�, ils seront automatiquement g�n�r�s.',

'HELP_CATEGORY_SEO_DESCRIPTION'                 =>  'Cette description est int�gr�e dans le code source HTML des pages cat�gorie (META description). Ce texte est souvent affich� dans les pages de r�sultats des moteurs de recherche. Une description adapt�e pour la cat�gorie peut �tre saisi ici. Si aucun texte n\'est renseign�, une description sera automatiquement g�n�r�e.',

'HELP_CATEGORY_SEO_SHOWSUFFIX'                  =>  'Ce param�tre vous permet de d�finir si le suffixe du titre est affich� dans le titre de la fen�tre quand la page cat�gorie est affich�e. Le suffixe Titre est d�fini dans <span class="navipath_or_inputname">Configuration g�n�rale -> Syst�me -> SEO -> Suffixe titre</span>.',

'HELP_CONTENT_MAIN_SNIPPET'                     =>  'Si vous s�lectionnez <span class="navipath_or_inputname">Snippet</span> Vous pouvez inclure cette page CMS dans une autre page CMS ou un template en utilisant don identifiant : <span class="userinput_or_code">[{ oxcontent ident=id_de_la_page_CMS }]</span>',

'HELP_CONTENT_MAIN_MAINMENU'                    =>  'Si vous s�lectionnez <span class="navipath_or_inputname">Menu</span>, un lien vers cette page CMS appara�tra dans le menu Information (Conditions g�n�rales, Qui sommes-nous...).',

'HELP_CONTENT_MAIN_CATEGORY'                    =>  'Si vous s�lectionnez <span class="navipath_or_inputname">Categorie</span>, un lien vers cette page CMS est afficher dans la navigation par cat�gories, apr�s "autres cat�gories".',

'HELP_CONTENT_MAIN_MANUAL'                      =>  'Si vous s�lectionnez <span class="navipath_or_inputname">Manuellement</span>, un lien est g�n�r� qui vous pourrez utiliser dans d\'autres pages CMS. Le lien s\'affichera apr�s avoir cliqu� sur <span class="navipath_or_inputname">Enregistrer</span>',

'HELP_CONTENT_SEO_FIXED'                        =>  'Vous pouvez laissez OXID eShop recalculer les URLs SEO. Une page CMS recevra une nouvelle URL SEO si par exemple le titre de la page � chang�. Le param�tre <span class="navipath_or_inputname">URL Fixe</span> vous permet d\'�viter ce cas de figure : Si activ�, l\'ancienne URL SEO est conserv�e et aucune nouvelle URL n\'est calcul�e.',

'HELP_CONTENT_SEO_KEYWORDS'                     =>  'Ces mots cl� sont int�gr�s dans le code source HTML des pages CMS (META keywords). Si aucun mot cl� n\'est renseign�, ils seront automatiquement g�n�r�s.',

'HELP_CONTENT_SEO_DESCRIPTION'                  =>  'Cette description est int�gr�e dans le code source HTML des pages CMS (META description). Ce texte est souvent affich� dans les pages de r�sultats des moteurs de recherche. Une description adapt�e pour le contenu de la page peut �tre saisi ici. Si aucun texte n\'est renseign�, une description sera automatiquement g�n�r�e.',



'HELP_DELIVERY_MAIN_COUNTRULES'                 =>  'Dans <span class="navipath_or_inputname">R�gles de calcul</span> vous s�lectionnerez comemnt le prix est calcul�:' .
                                                    '<ul><li><span class="userinput_or_code">Une fois par panier</span>: Le prix est calcul� une fois pour toute la commande.</li>' .
                                                    '<li><span class="userinput_or_code">Une fois pour chaque type de produit diff�rent</span>: Le prix est calcul� pour chaque produit diff�rent dans le panier, Quelle que soit la quantit� command�e.</li>' .
                                                    '<li><span class="userinput_or_code">Pour chaque produit</span>: Le prix est calcul� pour chaque unit� de produit dans le panier.</li></ul>',

'HELP_DELIVERY_MAIN_CONDITION'                  =>  'Dans <span class="navipath_or_inputname">Condition</span> vous pouvez sp�cifier que les r�gles de calcul des co�ts de transport s\'appliquent seulement sous certaines conditions. 4 conditions sont possibles:' .
                                                    '<ul><li><span class="userinput_or_code">Nombre de produits</span>: Nombre de produits dans le panier.</li>' .
                                                    '<li><span class="userinput_or_code">Dimensions</span>: Dimensions totales des produits. Pour que ce param�tre soit valable, vous devrez renseigner les dimensions de vos produits.</li>' .
                                                    '<li><span class="userinput_or_code">Poids</span>: Poids total de la commande en Kgs. Pour que ce param�tre soit valable, vous devrez renseigner le poids de vos produits.</li>' .
                                                    '<li><span class="userinput_or_code">Prix</span>: Monatant de la commande.</li></ul>' .
                                                    'Vous pouvez utiliser les champs de saisie <span class="navipath_or_inputname">>=</span> (sup�rieur ou �gal) et <span class="navipath_or_inputname"><=</span> (inf�rieur ou �gal) pour d�finir une plage sur laquelle la condition s\'appliquera. Un nombre plus grand doit �tre saisi pour <span class="navipath_or_inputname"><=</span> que pour <span class="navipath_or_inputname">=></span>.',

'HELP_DELIVERY_MAIN_PRICE'                      =>  'Vous pouvez utiliser <span class="navipath_or_inputname">Prix : frais/rabais</span> pour d�finir le co�t de transport. Le prix peut �tre calcul� de 2 mani�res diff�rentes:' .
                                                    '<ul><li>Avec <span class="userinput_or_code">abs</span>, le prix est exprim� en valeur absolue (ex: avec <span class="userinput_or_code">6,90</span>, un prix de 6.90 � est appliqu�).</li>' .
                                                    '<li>Avec <span class="userinput_or_code">%</span>,  prix est exprim� en valeur relative par rapport au prix de vente (ex: avec <span class="userinput_or_code">10</span>, un prix de 10% du montant de commande est appliqu�).</li></ul>',

'HELP_DELIVERY_MAIN_ORDER'                      =>  'Vous pouvez utiliser <span class="navipath_or_inputname">Ordre de traitement des r�gles</span> pour sp�cifer l\'ordre dans lequel les r�gle de co�ts de transport seront trait�es. La r�gle avec le plus petit nombre sera trait�e en premier.',

'HELP_DELIVERY_MAIN_FINALIZE'                   =>  'Vous pouvez utiliser <span class="navipath_or_inputname">Ne pas chercher d\'autres r�gles si celle-ci est applicable</span>. Si vous utilisez cette option, attention de bien d�finir l\'ordre de traitement des r�gles de co�ts de transport. L\'ordre de traitement des r�gles se d�finit dans <span class="navipath_or_inputname">Ordre de traitement des r�gles</span>.',



'HELP_DELIVERYSET_MAIN_POS'                     =>  '<span class="navipath_or_inputname">Ordre</span> d�fini l\'ordre dans lequel les moyens de livraison sont affich�s � l\'utilisateur: Affichage par ordre croissant.',



'HELP_DISCOUNT_MAIN_PRICE'                      =>  'Le param�tre <span class="navipath_or_inputname">Prix</span> vous permet de d�finir des promotion en fonction du prix des produits. Si la promotion doit s\'appliquer sans contrainte de prix de vente de produits, saisissez la valeur <span class="userinput_or_code">0</span> dans <span class="navipath_or_inputname">De</span> et <span class="userinput_or_code">0</span> dans <span class="navipath_or_inputname">�</span>.',

'HELP_DISCOUNT_MAIN_AMOUNT'                     =>  'Le param�tre <span class="navipath_or_inputname">Quantit�</span>  vous permet de d�finir la quantit� de produits minimale pour que la r�duction s\'applique. Si vous ne souhaitez pas fixer de quantit� minimale, saisissez la valeur <span class="userinput_or_code">0</span> dans <span class="navipath_or_inputname">De</span> et <span class="userinput_or_code">0</span> dans <span class="navipath_or_inputname">�</span>.',

'HELP_DISCOUNT_MAIN_REBATE'                     =>  'Dans <span class="navipath_or_inputname">Promotions</span>, vous pouvez d�finir le niveau de vos r�ductions. La liste de choix sous le champ remise vous permet de choisir entre une r�duction en valeur absolue ou relative:' .
                                                    '<ul>' .
                                                    '<li><span class="userinput_or_code">abs</span>: R�duction absolue, ex: 5�.</li>' .
                                                    '<li><span class="userinput_or_code">%</span>: Pourcentage de r�duction, ex: 10% du prix de vente.</li>' .
                                                    '</ul>',



'HELP_GENERAL_SEO_ACTCAT'                       =>  'Vous pouvez d�finir plusieurs URL SEO pour vos produits: Pour certaines pages cat�gories ou marques/fabricants. Avec <span class="navipath_or_inputname">Categorie/Distributeur Active</span> vous pouvez s�lectionner l\'URL SEO que vous souhaitez modifier.',

'HELP_GENERAL_SEO_FIXED'                        =>  'OXID eShop calcule automatiquement les URL SEO. Par exemple, si un produit change de titre, une nouvelle URL SEO est calcul�e. Une valeur saisie dans <span class="navipath_or_inputname">URL Fixe</span> emp�che le recalcul des URL.',

'HELP_GENERAL_SEO_SHOWSUFFIX'                   =>  'Ce param�tre vous permet de sp�cifier sir le suffixe Titre est affich� dans le titre de la fen�tre � l\'ouverture de la page. Le suffixe Titre peut �tre d�fini dans <span class="navipath_or_inputname">Configuration g�n�rale -> Syst�me -> SEO -> Suffixe Titre</span>.',

'HELP_GENERAL_SEO_OXKEYWORDS'                   =>  'Les mots cl�s sont int�gr�s dans le code source de la page (META keywords). Ces donn�es sont utilis�es par les moteurs de recherche. Des mots cl� adapt�s peuvent �tre saisis ici. Si ce param�tre n\'est pas renseign�, des mots cl�s seront g�n�r�s automatiquement.',

'HELP_GENERAL_SEO_OXDESCRIPTION'                =>  'La description est int�gr�e dans le code source de la page (META description). Ce texte est souvent affich� dans les pages de r�sultats des moteurs de recherche. Une description adapt�e peut �tre saisie ici. Si ce param�tre n\'est pas renseign�, une description sera g�n�r�e automatiquement.',



'HELP_GENIMPORT_FIRSTCOLHEADER'                 =>  'Activez ce param�tre si la premi�re ligne de votre fichier CSV contient les noms des champs de BDD dans lesquels les valeurs de la colonne doivent �tre enregistr�s.',

'HELP_GENIMPORT_REPEATIMPORT'                   =>  'Lorsque ce param�tre eest activ�, l\'�tape 1 est affich� lorsque l\'import a �t� r�alis� avec succ�s. Ainsi, vous pouvez lancer un nouvel import imm�diatement.',

'HELP_LANGUAGE_DEFAULT'                         => 'La langue par d�faut est utilis�e lorsque le syst�me n\'est pas capable de d�tecter la langue d\'un utilisateur: ID de langue non pr�sent dans l\'URL, Langue non pr�sente dans le navigateur, non d�finie dans la session etc. La langue par d�faut ne peut �tre que d�sativ�e, aucunement supprim�e.',

'HELP_LANGUAGE_ACTIVE'                          => "Cette option permet de d�finir les langues accessibles � vos utilisateurs sur la boutique: si activ� - la langue est affich�e sur la boutique.",

'HELP_PAYMENT_MAIN_SORT'                        =>  'Le param�tre <span class="navipath_or_inputname">Position</span> vous permet de sp�cifier l\'ordre d\'affichage des moyens de paiement � vos utilisateurs.',

'HELP_PAYMENT_MAIN_FROMBONI'                    =>  'Utilisez le param�tre <span class="navipath_or_inputname">Niveau de confiance min.</span> pour restreindre l\'acc�s � vos moyens de paiement aux clients de confiance. Un niveau de confiance peut �tre d�fini pour chaque client dans <span class="navipath_or_inputname">Gesttion des clients -> Clients -> Etendu</span>.',

'HELP_PAYMENT_MAIN_SELECTED'                    =>  'Utilisez le param�tre <span class="navipath_or_inputname">Selectionn�</span> pour d�finir un moyen de paiement par d�faut.',

'HELP_PAYMENT_MAIN_AMOUNT'                      =>  'Vous pouvez utiliser le <span class="navipath_or_inputname">Montant de commande</span> pour d�finir l\'acc�s aux moyens de paiement. Les champs <span class="navipath_or_inputname">de</span> et <span class="navipath_or_inputname">�</span> vous permettent de renseigner une fourchette de montants.<br>' .
                                                    'Si vous soiuhaitez qu\'un moyen de paiement soit toujours disponible, vous devez d�finir une condition qui sera toujours remplie: Saisissez <span class="userinput_or_code">0</span> dans le champ <span class="navipath_or_inputname">de</span>  et <span class="userinput_or_code">99999999</span> dans le champ <span class="navipath_or_inputname">�</span>.',

'HELP_PAYMENT_MAIN_ADDPRICE'                    =>  'Le param�tre <span class="navipath_or_inputname">Frais suppl�mentaires/R�duction</span>, permet de diff�rencier les prix en fonction des moyens de paiement. Le prix peut �tre d�fini de deux mani�res diff�rentes:' .
                                                    '<ul><li>Avec <span class="userinput_or_code">abs</span> le prix est saisi en valeur absolue pour le moyen de paiement (ex: Si vous saisissez <span class="userinput_or_code">7.50</span> un surco�t de 7.50 � est appliqu�.)</li>' .
                                                    '<li>Avec <span class="userinput_or_code">%</span>, le prix est calcul� sur la base du prix de vente (ex: Si vous saisissez <span class="userinput_or_code">2</span>, un surco�t de 2% est appliqu� au prix de vente)</li></ul>',


'HELP_SELECTLIST_MAIN_TITLEIDENT'               =>  'Dans <span class="navipath_or_inputname">Titre interne</span>, vous pouvez d�finir un autre nom qui ne sera pas affich� � vos clients sur la boutique. Les titres personnalis�s sont utilis�s pour diff�rencier des listes de s�lection similaires (ex: Taille pour pantalons, taille pour Tee Shirts).',

'HELP_SELECTLIST_MAIN_FIELDS'                   =>  'Toutes les options/variantes disponibles sont affich�es dans la liste des <span class="navipath_or_inputname">Champs</span>. Vous pouvez d�finir de nouvelles options dans la partie droite. Pour plus d\' informations :<a href="http://www.oxid-esales.com/en/resources/help-faq/eshop-manual/implementing-simple-variants-selection-lists" target="_blank">Manuel OXID eShop</a>.',



'HELP_USER_MAIN_HASPASSWORD'                    =>  'Vous pouvez ici identifier si les utilisateurs se sont enregistr�s pour passer commande:' .
                                                    '<ul><li>Si un mot de passe a �t� d�fini, l\'utilisateur s\'est enregistr�.</li>' .
                                                    '<li>Sinon, il a pass� commande sans cr�er de compte client.</li></ul>',



'HELP_USER_EXTEND_NEWSLETTER'                   =>  'Ce param�tre indique si l\'utilisateur est abonn� � la newsletter.',

'HELP_USER_EXTEND_EMAILFAILED'                  =>  'Si vous ne parvenez pas � envoyer des eMails � cet utilisateur, activez ce param�tre. Aisin, les newsletters ne seront plus envoy�es � cet utilisateurs. Cepandant, tous les autres eMails seront toujours envoy�s.',

'HELP_USER_EXTEND_DISABLEAUTOGROUP'             =>  'Par d�faut, les utilisateurs sont automatiquement assign�s � certains groupes d\'utilisateurs. Si vous ne souhaitez pas ce mode de fonctionnement, activez ce param�tre.',

'HELP_USER_EXTEND_BONI'                         =>  'Definissez ici un niveau de confiance � votre client. Le niveau de confiance est utilis� pour les moyens de paiements autoris�s pour les clients.',



'HELP_MANUFACTURER_MAIN_ICON'                   =>  'Avec <span class="navipath_or_inputname">Ic�ne</span> et <span class="navipath_or_inputname">Envi Ic�ne</span> vous pouvez d�finir une image pour ce fabricant/ cette marque(ex: Son logo). Cliquez sur <span class="navipath_or_inputname">Envoi Ic�ne</span>, selectionnez l\'image que vous souhaitez envoyer. En cliquant sur <span class="navipath_or_inputname">Enregister</span> L\'image est envoy�e sur le serveur. Apr�s l\'envoi, le nom du fichier est affich� dans <span class="navipath_or_inputname">Ic�ne</span>..',



'HELP_MANUFACTURER_SEO_FIXED'                   =>  'Vous pouvez laisser le syst�me recalculer les URL SEO. Un fabricant / une marque re�oit une nouvelle URL par exemple dans le cas d\'un changement de nom. Le param�tre <span class="navipath_or_inputname">URL Fixe</span> permet d\'emp�cher cela: Si ce param�tre est activ�, les URL ne seront pas recalcul�es.',

'HELP_MANUFACTURER_SEO_KEYWORDS'                =>  'Les mots cl�s sont int�gr�s dans le code source de la page Marques/ Fabricants (META keywords). Ces donn�es sont utilis�es par les moteurs de recherche. Des mots cl� adapt�s peuvent �tre saisis ici. Si ce param�tre n\'est pas renseign�, des mots cl�s seront g�n�r�s automatiquement.',

'HELP_MANUFACTURER_SEO_DESCRIPTION'             =>  'La description est int�gr�e dans le code source de la page Marques/ Fabricants (META description). Ce texte est souvent affich� dans les pages de r�sultats des moteurs de recherche. Une description adapt�e peut �tre saisie ici. Si ce param�tre n\'est pas renseign�, une description sera g�n�r�e automatiquement.',

'HELP_MANUFACTURER_SEO_SHOWSUFFIX'              =>  'Ici, vous pouvez sp�cifier le suffixe du titre qui sera afficher dans le titre de votre navigateur lorsque la page Marques/fabricants est ouverte. Ce suffixe de titre peut �tre d�fini dans <span class="navipath_or_inputname">Configuration g�n�rale -> Param�tres syst�me -> SEO -> Title Suffix</span>.',

'HELP_VOUCHERSERIE_MAIN_DISCOUNT'               =>  'Dans <span class="navipath_or_inputname">Promotions</span>, vous d�finissez la valeur de vos promotions. Vous pouvez utiliser la liste de s�lection ci-apr�s pour d�finir le type de r�duction souhait�e (Absolue/Relative):' .
                                                    '<ul>' .
                                                    '<li><span class="userinput_or_code">abs</span>: R�duction en valeur absolue, ex: 5 �.</li>' .
                                                    '<li><span class="userinput_or_code">%</span>: R�duction en pourcentage, ex: 10% du prix de vente.</li>' .
                                                    '</ul>',



'HELP_VOUCHERSERIE_MAIN_ALLOWSAMESERIES'        =>  'Vous pouvez d�finir ici si les clients peuvent utiliser plusieurs bons de r�duction d\'une m�me s�rie dans une m�me commande.',

'HELP_VOUCHERSERIE_MAIN_ALLOWOTHERSERIES'       =>  'Vous pouvez d�finir ici si les clients peuvent utiliser des bons de r�duction des s�ries diff�rentes dans une m�me commande.',

'HELP_VOUCHERSERIE_MAIN_SAMESEROTHERORDER'      =>  'Vous pouvez d�finir ici si les clients peuvent utiliser des bons de r�duction d\'une m�me s�rie dans diff�rentes commandes.',

'HELP_VOUCHERSERIE_MAIN_RANDOMNUM'              =>  'Lorsque ce param�tre est activ�, un num�ro al�atoire est attribu� � chaque bon de r�duction.',

'HELP_VOUCHERSERIE_MAIN_VOUCHERNUM'             =>  'Ici vous pouvez saisir un num�ro pour les codes de r�duction. Ce nom�ro est utilis� lors de la g�n�ration de nouveaux codes de r�duction si <span class="navipath_or_inputname">Num�ros al�atoires</span> est d�sactiv�. Tous les coupons porterons le m�me num�ro.',

'HELP_WRAPPING_MAIN_PICTURE'                    =>  'Avec <span class="navipath_or_inputname">Image</span> et <span class="navipath_or_inputname">Envoyer image</span> Vous pouvez envoyer une image pour les emaballages cadeau. Dans <span class="navipath_or_inputname">Envoyer image</span>, Choisissez l\'image � envoyer. En cliquent sur <span class="navipath_or_inputname">Enregistrer</span>, L\'image est envoy�e sur le serveur. Apr�s l\'envoi, le nom du fichier est affich� dans <span class="navipath_or_inputname">Image</span>.',



'HELP_DYN_TRUSTED_RATINGS_ID'                   => 'Vous recevrez votre identifiant Trusted Shops dans votre eMail de confirmation de commande. Si vous �tes d�j� cleint Trusted Shops, veuillez utiliser votre identifiant actuel. L\'indicateur vert indique que l\'�valuation des clients a bien �t� v�rifi�e et activ�e.',
'HELP_DYN_TRUSTED_RATINGS_WIDGET'               => 'Activer le widget de notation client.',
'HELP_DYN_TRUSTED_RATINGS_THANKYOU'             => 'Activer le bouton "Donnez votre avis!" dans l\'email "Commande valid�e".',
'HELP_DYN_TRUSTED_RATINGS_ORDEREMAIL'           => 'Activer le bouton "Donnez votre avis!" dans l\'email "Commande confirm�e".',
'HELP_DYN_TRUSTED_RATINGS_ORDERSENDEMAIL'       => 'Activer le bouton "Donnez votre avis!" dans l\'email "Commande exp�di�e".',
'HELP_DYN_TRUSTED_TSID'                         => 'Identifiant Trusted Shops pour la boutique (pour langage).',
'HELP_DYN_TRUSTED_USER'                         => 'Un nom d\'utilisateur (wsUser) est obligatoire pour le Webservice Trusted Shops si vous souhaitez activer la protection des acheteurs Trusted Shops Excellence. La protection des acheteurs Classique ne n�cessite pas de nom d\'utilisateur.',
'HELP_DYN_TRUSTED_PASSWORD'                     => 'Un mot de passe (wsPassword) est obligatoire pour le Webservice Trusted Shops si vous souhaitez activer la protection des acheteurs Trusted Shops Excellence. La protection des acheteurs Classique ne n�cessite pas de mot de passe.',
'HELP_DYN_TRUSTED_TESTMODUS'                    => 'Environnement de test ("Sandbox") activ�. Une fois la proc�dure de certification Trusted Shops termin�e, Trusted Shops vous enverra un eMail avec vos information d\'identification.',
'HELP_DYN_TRUSTED_ACTIVE'                       => 'Activez cette option pour afficher le label Trusted Shops sur la boutique.',
'HELP_DYN_TRUSTED_TSPAYMENT'                    => 'D�finir les moyens de paiement aux modes de paiement appropri�s de Trusted Store.',

'HELP_PROMOTIONS_BANNER_PICTUREANDLINK'         => 'Envoyer une image banni�re et saisissez une adresse URL qui sera affect� � l\'image lors d\'un clic. Si la banni�re est associ�e � un article et qu\'aucune URL n\'est d�finie, l\'adresse de l\'article sera utilis�e.',


);

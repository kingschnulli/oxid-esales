#A quick way to set english as the default for eShop demodata

#Set English as default language
update oxconfig set oxvarvalue=0x4dba852e754d5687a270cb8d387ce18cfbe97cefe2a891e96b0a959b1d1590109486763f5069846f010640b23e534c448353e850b90779ce6ea921ec1842a7c50e3b3259f9f0afa7bed537e45a where oxvarname='aLanguages';
update oxconfig set oxvarvalue=0x4dba852e754d5687a270cb8d387c849e65f804bae3b08ed2703056ef3560a66386f76468a3a43fb8399bc6ddf78397857cc4e505811ca6edb24a3bf6a8060d2608e8568610d11726cfd6598af7bac25887fa1f0e01357a13ea6a27a52a223e6d64fde6d1b29ed2aacea2a00f7678cae92127d8ad32e3de17f02cf05af5794692585dbf235533ffbc19d4545270a9808d94ed5a13bd4a30defdf44bce92ec5b7c15090ef1d1be66cd62ea19623d706460832d0fba039670ada5fc9f8d261e1dd90f54b7c93bac03396f0250fe8370c5f0fbd003c0d866ae614b368d3fb667aa9aff7bf2198a7ef4effb782d570db7adafb4ce4ae857e5eb1780d8bdc77d7d8ae94a08e2fd7801e2ca95f5c60c04bf6e72787f53af2af1799c where oxvarname='aLanguageParams';
update oxconfig set oxvarvalue=0xde where oxvarname='sDefaultLang';

#insert USD and set it as default currency
update oxconfig set oxvarvalue=0x4dbace2972e14bf2cbd3a9a4e65502affef12a8b1770b083941ecabd1e9db4f031b4833877ea92decd25ad81b376d5b5ff7e9dbb493c076950a749885908c06042bec27e548e5abc3bac9a04ee9df3a51166abd619cacb7945c5fbae3fc5bbe8f414e94058b8d0d479bd832c9b53aab3d8dabf06568768e98211b486ffb45dcb1571b621d6d1f4055066982786cabecdd553aac23bbdcaf6c692f9b7c45e42004d where oxvarname='aCurrencies';

#USA as default country
update oxconfig set oxvarvalue=0x4dba322c77e44ef7ced6aca1f35700f1faf1449d20b668839639fa0a2e80391cf6d752f91cff81d994785485 where oxvarname='aHomeCountry';

#swap SEO URLs
UPDATE oxseo SET oxlang = -1 WHERE oxlang=0;
UPDATE oxseo SET oxlang = 0 WHERE oxlang=1;
UPDATE oxseo SET oxlang = 1 WHERE oxlang=-1;

#swap all multilanguage data fields
UPDATE oxactions SET
  OXTITLE = (@oxactionsTEMP1:=OXTITLE), OXTITLE = OXTITLE_1, OXTITLE_1 = @oxactionsTEMP1,
  OXLONGDESC = (@oxactionsTEMP2:=OXLONGDESC), OXLONGDESC = OXLONGDESC_1, OXLONGDESC_1 = @oxactionsTEMP2;

UPDATE oxarticles SET
  OXVARNAME = (@oxarticlesTEMP1:=OXVARNAME), OXVARNAME = OXVARNAME_1, OXVARNAME_1 = @oxarticlesTEMP1,
  OXVARSELECT = (@oxarticlesTEMP2:=OXVARSELECT), OXVARSELECT = OXVARSELECT_1, OXVARSELECT_1 = @oxarticlesTEMP2,
  OXTITLE = (@oxarticlesTEMP3:=OXTITLE), OXTITLE = OXTITLE_1, OXTITLE_1 = @oxarticlesTEMP3,
  OXSHORTDESC = (@oxarticlesTEMP4:=OXSHORTDESC), OXSHORTDESC = OXSHORTDESC_1, OXSHORTDESC_1 = @oxarticlesTEMP4,
  OXURLDESC = (@oxarticlesTEMP5:=OXURLDESC), OXURLDESC = OXURLDESC_1, OXURLDESC_1 = @oxarticlesTEMP5,
  OXSEARCHKEYS = (@oxarticlesTEMP6:=OXSEARCHKEYS), OXSEARCHKEYS = OXSEARCHKEYS_1, OXSEARCHKEYS_1 = @oxarticlesTEMP6,
  OXSTOCKTEXT = (@oxarticlesTEMP7:=OXSTOCKTEXT), OXSTOCKTEXT = OXSTOCKTEXT_1, OXSTOCKTEXT_1 = @oxarticlesTEMP7,
  OXNOSTOCKTEXT = (@oxarticlesTEMP8:=OXNOSTOCKTEXT), OXNOSTOCKTEXT = OXNOSTOCKTEXT_1, OXNOSTOCKTEXT_1 = @oxarticlesTEMP8;

UPDATE oxartextends SET
  OXLONGDESC = (@oxartextendsTEMP1:=OXLONGDESC), OXLONGDESC = OXLONGDESC_1, OXLONGDESC_1 = @oxartextendsTEMP1,
  OXTAGS = (@oxartextendsTEMP2:=OXTAGS), OXTAGS = OXTAGS_1, OXTAGS_1 = @oxartextendsTEMP2;

UPDATE oxattribute SET
  OXTITLE = (@oxattributeTEMP:=OXTITLE), OXTITLE = OXTITLE_1, OXTITLE_1 = @oxattributeTEMP;

UPDATE oxcategories SET
  OXACTIVE = (@oxcategoriesTEMP1:=OXACTIVE), OXACTIVE = OXACTIVE_1, OXACTIVE_1 = @oxcategoriesTEMP1,
  OXTITLE = (@oxcategoriesTEMP2:=OXTITLE), OXTITLE = OXTITLE_1, OXTITLE_1 = @oxcategoriesTEMP2,
  OXDESC = (@oxcategoriesTEMP3:=OXDESC), OXDESC = OXDESC_1, OXDESC_1 = @oxcategoriesTEMP3,
  OXTHUMB = (@oxcategoriesTEMP4:=OXTHUMB), OXTHUMB = OXTHUMB_1, OXTHUMB_1 = @oxcategoriesTEMP4,
  OXLONGDESC = (@oxcategoriesTEMP5:=OXLONGDESC), OXLONGDESC = OXLONGDESC_1, OXLONGDESC_1 = @oxcategoriesTEMP5;

UPDATE oxcontents SET
  OXACTIVE = (@oxcontentsTEMP1:=OXACTIVE), OXACTIVE = OXACTIVE_1, OXACTIVE_1 = @oxcontentsTEMP1,
  OXTITLE = (@oxcontentsTEMP2:=OXTITLE), OXTITLE = OXTITLE_1, OXTITLE_1 = @oxcontentsTEMP2,
  OXCONTENT = (@oxcontentsTEMP3:=OXCONTENT), OXCONTENT = OXCONTENT_1, OXCONTENT_1 = @oxcontentsTEMP3;

UPDATE oxcountry SET
  OXTITLE = (@oxcountryTEMP1:=OXTITLE), OXTITLE = OXTITLE_1, OXTITLE_1 = @oxcountryTEMP1,
  OXSHORTDESC = (@oxcountryTEMP2:=OXSHORTDESC), OXSHORTDESC = OXSHORTDESC_1, OXSHORTDESC_1 = @oxcountryTEMP2,
  OXLONGDESC = (@oxcountryTEMP3:=OXLONGDESC), OXLONGDESC = OXLONGDESC_1, OXLONGDESC_1 = @oxcountryTEMP3;

UPDATE oxdelivery SET
  OXTITLE = (@oxdeliveryTEMP:=OXTITLE), OXTITLE = OXTITLE_1, OXTITLE_1 = @oxdeliveryTEMP;

UPDATE oxdiscount SET
  OXTITLE = (@oxdiscountTEMP:=OXTITLE), OXTITLE = OXTITLE_1, OXTITLE_1 = @oxdiscountTEMP;

UPDATE oxlinks SET
  OXURLDESC = (@oxlinksTEMP:=OXURLDESC), OXURLDESC = OXURLDESC_1, OXURLDESC_1 = @oxlinksTEMP;

UPDATE oxnews SET
  OXACTIVE = (@oxnewsTEMP1:=OXACTIVE), OXACTIVE = OXACTIVE_1, OXACTIVE_1 = @oxnewsTEMP1,
  OXSHORTDESC = (@oxnewsTEMP2:=OXSHORTDESC), OXSHORTDESC = OXSHORTDESC_1, OXSHORTDESC_1 = @oxnewsTEMP2,
  OXLONGDESC = (@oxnewsTEMP3:=OXLONGDESC), OXLONGDESC = OXLONGDESC_1, OXLONGDESC_1 = @oxnewsTEMP3;

UPDATE oxobject2attribute SET
  OXVALUE = (@oxobject2attributeTEMP:=OXVALUE), OXVALUE = OXVALUE_1, OXVALUE_1 = @oxobject2attributeTEMP;

UPDATE oxpayments SET
  OXDESC = (@oxpaymentsTEMP1:=OXDESC), OXDESC = OXDESC_1, OXDESC_1 = @oxpaymentsTEMP1,
  OXVALDESC = (@oxpaymentsTEMP2:=OXVALDESC), OXVALDESC = OXVALDESC_1, OXVALDESC_1 = @oxpaymentsTEMP2,
  OXLONGDESC = (@oxpaymentsTEMP3:=OXLONGDESC), OXLONGDESC = OXLONGDESC_1, OXLONGDESC_1 = @oxpaymentsTEMP3;

update oxselectlist SET
  OXTITLE = (@oxselectlistTEMP1:=OXTITLE), OXTITLE = OXTITLE_1, OXTITLE_1 = @oxselectlistTEMP1,
  OXVALDESC = (@oxselectlistTEMP2:=OXVALDESC), OXVALDESC = OXVALDESC_1, OXVALDESC_1 = @oxselectlistTEMP2;

update oxshops SET
  OXTITLEPREFIX = (@oxshopsTEMP1:=OXTITLEPREFIX), OXTITLEPREFIX = OXTITLEPREFIX_1, OXTITLEPREFIX_1 = @oxshopsTEMP1,
  OXTITLESUFFIX = (@oxshopsTEMP2:=OXTITLESUFFIX), OXTITLESUFFIX = OXTITLESUFFIX_1, OXTITLESUFFIX_1 = @oxshopsTEMP2,
  OXSTARTTITLE = (@oxshopsTEMP3:=OXSTARTTITLE), OXSTARTTITLE = OXSTARTTITLE_1, OXSTARTTITLE_1 = @oxshopsTEMP3,
  OXORDERSUBJECT = (@oxshopsTEMP4:=OXORDERSUBJECT), OXORDERSUBJECT = OXORDERSUBJECT_1, OXORDERSUBJECT_1 = @oxshopsTEMP4,
  OXREGISTERSUBJECT = (@oxshopsTEMP5:=OXREGISTERSUBJECT), OXREGISTERSUBJECT = OXREGISTERSUBJECT_1, OXREGISTERSUBJECT_1 = @oxshopsTEMP5,
  OXFORGOTPWDSUBJECT = (@oxshopsTEMP6:=OXFORGOTPWDSUBJECT), OXFORGOTPWDSUBJECT = OXFORGOTPWDSUBJECT_1, OXFORGOTPWDSUBJECT_1 = @oxshopsTEMP6,
  OXSENDEDNOWSUBJECT = (@oxshopsTEMP7:=OXSENDEDNOWSUBJECT), OXSENDEDNOWSUBJECT = OXSENDEDNOWSUBJECT_1, OXSENDEDNOWSUBJECT_1 = @oxshopsTEMP7,
  OXSEOACTIVE = (@oxshopsTEMP8:=OXSEOACTIVE), OXSEOACTIVE = OXSEOACTIVE_1, OXSEOACTIVE_1 = @oxshopsTEMP8;

UPDATE oxwrapping SET
  OXACTIVE = (@oxwrappingTEMP1:=OXACTIVE), OXACTIVE = OXACTIVE_1, OXACTIVE_1 = @oxwrappingTEMP1,
  OXNAME = (@oxwrappingTEMP2:=OXNAME), OXNAME = OXNAME_1, OXNAME_1 = @oxwrappingTEMP2;

UPDATE oxdeliveryset SET
  OXTITLE = (@oxdeliverysetTEMP:=OXTITLE), OXTITLE = OXTITLE_1, OXTITLE_1 = @oxdeliverysetTEMP;

UPDATE oxvendor SET
  OXTITLE = (@oxvendorTEMP1:=OXTITLE), OXTITLE = OXTITLE_1, OXTITLE_1 = @oxvendorTEMP1,
  OXSHORTDESC = (@oxvendorTEMP2:=OXSHORTDESC), OXSHORTDESC = OXSHORTDESC_1, OXSHORTDESC_1 = @oxvendorTEMP2;

UPDATE oxmanufacturers SET
  OXTITLE = (@oxmanufacturersTEMP1:=OXTITLE), OXTITLE = OXTITLE_1, OXTITLE_1 = @oxmanufacturersTEMP1,
  OXSHORTDESC = (@oxmanufacturersTEMP2:=OXSHORTDESC), OXSHORTDESC = OXSHORTDESC_1, OXSHORTDESC_1 = @oxmanufacturersTEMP2;

UPDATE oxmediaurls SET
  OXDESC = (@oxmediaurlsTEMP:=OXDESC), OXDESC = OXDESC_1, OXDESC_1 = @oxmediaurlsTEMP;

UPDATE oxstates SET
  OXTITLE = (@oxstatesTEMP:=OXTITLE), OXTITLE = OXTITLE_1, OXTITLE_1 = @oxstatesTEMP;

#English newsletter sample
REPLACE INTO `oxnewsletter` VALUES ('oxidnewsletter', 'oxbaseshop', 'Newsletter Example', '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">\r\n<html>\r\n<head>\r\n<title>OXID eSales Newsletter</title>\r\n<style media="screen" type="text/css"><!--\r\nA        {\r\n        font-size: 9pt;\r\n        text-decoration: none;\r\n        color: black;\r\n        }\r\nA:Hover     {\r\n        text-decoration: underline;\r\n        color: #AB0101;\r\n        }\r\nbody    {\r\n    margin-bottom : 0;\r\n    margin-left : 0;\r\n    margin-right : 0;\r\n    margin-top : 0;\r\n    background-color: #FFFFFF;\r\n}\r\n.pagehead {\r\n font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n font-size: 10px;\r\n    color: #000000;\r\n font-weight: normal;\r\n    background-color: #494949;\r\n  height : 50;\r\n    vertical-align : bottom;\r\n}\r\n.pageheadlink {\r\n    font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n font-size: 11px;\r\n    color: #F7F7F7;\r\n font-weight: normal;\r\n}\r\n.pagebottom {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 9px;\r\n        color: #000000;\r\n        font-weight: normal;\r\n     height : 13;\r\n        vertical-align : top;\r\n}\r\n.defaultcontent {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 10px;\r\n        color: #000000;\r\n        font-weight: normal;\r\n       vertical-align : top;\r\n}\r\n.detailcontent {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 10px;\r\n        color: #000000;\r\n        font-weight: normal;\r\n        vertical-align : top;\r\n       padding-left: 10px;\r\n}\r\n.detailproductlink {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 9px;\r\n        color: #9D0101;\r\n        font-weight: bold;\r\n}\r\n.detailheader {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 11px;\r\n        color: #9D0101;\r\n        font-weight: bold;\r\n}\r\n.detailsales {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 10px;\r\n        color: #000000;\r\n        font-weight: bold;\r\n      background-color: #CECDCD;\r\n}\r\n.aktionhead {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 10px;\r\n        color: #FFFFFF;\r\n        font-weight: bold;\r\n        background-color: #767575;\r\n}\r\n.aktionmain {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 10px;\r\n        color: #000000;\r\n        font-weight: normal;\r\n      border : 3px #767575;\r\n       border-style : none solid solid solid;\r\n      padding-left : 2px;\r\n     padding-top : 5px;\r\n      padding-bottom : 5px;\r\n       padding-right : 2px;\r\n}\r\n.aktion {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 10px;\r\n        color: #000000;\r\n        font-weight: normal;\r\n}\r\n.aktionhighlight {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 10px;\r\n        color: #AB0101;\r\n        font-weight: bold;\r\n}\r\n.startpageFirstProductTitle {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 12px;\r\n        color: #AB0101;\r\n        font-weight: bold;\r\n}\r\n.startpageFirstProductText {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 10px;\r\n        color: #242424;\r\n        font-weight: normal;\r\n}\r\n.startpageFirstProductPrice {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 17px;\r\n        color: #AB0101;\r\n        font-weight: bold;\r\n}\r\n.startpageFirstProductOldPrice {\r\n font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n font-size: 17px;\r\n    color: #AB0101;\r\n font-weight: bold;\r\n  text-decoration : line-through;\r\n}\r\n.startpageProductTitle {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 12px;\r\n        color: #242424;\r\n        font-weight: bold;\r\n}\r\n.startpageProductText {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 10px;\r\n        color: #AB0101;\r\n        font-weight: normal;\r\n}\r\n.startpageBoxContent {\r\n   font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n font-size: 10px;\r\n    color: #000000;\r\n font-weight: normal;\r\n    border : 3px #CECDCD;\r\n   border-style : none solid solid solid;\r\n  padding-left : 5px;\r\n padding-top : 5px;\r\n  padding-bottom : 5px;\r\n   padding-right : 5px;\r\n}\r\n.startpageBoxHead {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 10px;\r\n        color: #000000;\r\n        font-weight: bold;\r\n        background-color: #CECDCD;\r\n}\r\n.newestProductHead {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 10px;\r\n        color: #8D0101;\r\n        font-weight: bold;\r\n}\r\n.newestProduct {\r\n        font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;\r\n        font-size: 10px;\r\n        color: #000000;\r\n        font-weight: normal;\r\n}\r\n}\r\n--></style>\r\n</head>\r\n<body marginwidth="0" marginheight="0" leftmargin="0" topmargin="0">\r\n<table width="780" height="100%" cellspacing="0" cellpadding="0" border="0"><!-- Kopf Start --><tbody><tr><td class="pagehead">\r\n<table width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td width="152" align="right" class="pagehead"> <a class="pageheadlink" href="[{$oViewConf->getBaseDir()}]"><img border="0" alt="" src="[{$oViewConf->getImageUrl(''logo.png'')}]"></a> </td></tr></tbody></table></td></tr><tr><td height="15"> <br>\r\n</td></tr><!-- Kopf Ende --> <!-- Content Start --><tr><td valign="top">\r\n<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="defaultcontent">\r\nHello [{ $myuser->oxuser__oxsal->value|oxmultilangsal }] [{ $myuser->oxuser__oxfname->value }] [{ $myuser->oxuser__oxlname->value }],<br>\r\n<br>\r\nas you can see, our newsletter works really well.<br>\r\n<br>\r\nIt is not only possible to display your address here:<br>\r\n[{ $myuser->oxuser__oxaddinfo->value }]<br>\r\n[{ $myuser->oxuser__oxstreet->value }]<br>\r\n[{ $myuser->oxuser__oxzip->value }] [{ $myuser->oxuser__oxcity->value }]<br>\r\n[{ $myuser->oxuser__oxcountry->value }]<br>\r\nPhone: [{ $myuser->oxuser__oxfon->value }]<br>\r\n<br>\r\nYou want to unsubscribe from our newsletter? No problem - simply click <a class="defaultcontent" href="[{$oViewConf->getBaseDir()}]index.php?cl=newsletter&fnc=removeme&uid=[{$myuser->oxuser__oxid->value}]">here</a>.\r\n<br>\r\n<br>\r\n [{if isset($simarticle0) }]\r\n     This is a similar product related to your last order:<br>\r\n\r\n<table cellspacing="0" cellpadding="0" border="0"><tbody><tr><td> <a href="[{$simarticle0->getLink()}]" class="startpageProduct"><img vspace="0" hspace="0" border="0" alt="[{ $simarticle0->oxarticles__oxtitle->value }]" src="[{$oViewConf->getPictureDir()}][{$simarticle0->oxarticles__oxpic1->value }]"></a> </td><td width="10" valign="top" class="startpageFirstProductTitle">*</td><td width="320" valign="top" class="startpageFirstProductTitle"> [{ $simarticle0->oxarticles__oxtitle->value }]<br>\r\n <br>\r\n <span class="startpageFirstProductText">[{ $simarticle0->oxarticles__oxshortdesc->value }]</span><br>\r\n <br>\r\n <span class="startpageProductText"><strong>Now </strong></span><span class="startpageFirstProductPrice">[{ $mycurrency->sign}][{ $simarticle0->getFPrice() }]</span> instead of <span class="startpageFirstProductOldPrice">[{ $mycurrency->sign}][{ $simarticle0->getFTPrice()}]</span><br>\r\n <br>\r\n <a href="[{$simarticle0->getLink()}]" class="startpageProductText"><strong>more information</strong></a><br>\r\n </td></tr></tbody></table> [{/if}] <br>\r\n<br>\r\n [{if isset($articlelist) }]\r\n     Assorted products from our store especially for this newsletter: <br>\r\n\r\n<table cellspacing="0" cellpadding="0" border="0"><tbody><tr><td height="1" bgcolor="#cecdcd"><br>\r\n</td><td height="1" bgcolor="#cecdcd"><br>\r\n</td></tr><tr><td height="7"><br>\r\n</td><td><br>\r\n</td></tr>[{assign var="iPos" value=1}]\r\n       [{foreach from=$articlelist item=product}]\r\n     \r\n        [{if $iPos == 1}] <tr><td valign="top">\r\n<table cellspacing="0" cellpadding="0" border="0"><tbody><tr><td width="220" height="100" align="left" class="startpageProduct"> <a href="[{$product->getLink()}]" class="startpageProduct"><img vspace="0" hspace="0" border="0" alt="[{ $product->oxarticles__oxtitle->value }]" src="[{$oViewConf->getPictureDir()}][{$product->oxarticles__oxthumb->value }]"></a> </td></tr><tr><td align="left" class="startpageProductTitle"> [{ $product->oxarticles__oxtitle->value }] </td></tr><tr><td height="20" align="left" class="startpageProductText"> <strong>Only [{ $mycurrency->sign}][{ $product->getFPrice() }]</strong> </td></tr><tr><td height="20" align="left" class="startpageProductText"> <a href="[{$product->getLink()}]" class="startpageProductText">more information</a><br>\r\n </td></tr></tbody></table> </td>[{assign var="iPos" value=2}]\r\n       [{elseif $iPos==2}] <td valign="top">\r\n<table cellspacing="0" cellpadding="0" border="0"><tbody><tr><td width="220" height="100" align="left" class="startpageProduct"> <a href="[{$product->getLink()}]" class="startpageProduct"><img vspace="0" hspace="0" border="0" alt="[{ $product->oxarticles__oxtitle->value }]" src="[{$oViewConf->getPictureDir()}][{$product->oxarticles__oxthumb->value }]"></a> </td></tr><tr><td align="left" class="startpageProductTitle"> [{ $product->oxarticles__oxtitle->value }] </td></tr><tr><td height="20" align="left" class="startpageProductText"> <strong>Only [{ $mycurrency->sign}][{ $product->getFPrice() }]</strong> </td></tr><tr><td height="20" align="left" class="startpageProductText"> <a href="[{$product->getLink()}]" class="startpageProductText">more information</a><br>\r\n </td></tr></tbody></table> </td></tr><tr><td height="7"><br>\r\n</td><td><br>\r\n</td></tr><tr><td height="1" bgcolor="#cecdcd"><br>\r\n</td><td height="1" bgcolor="#cecdcd"><br>\r\n</td></tr><tr><td height="7"><br>\r\n</td><td><br>\r\n</td></tr><!-- end of line --> [{assign var="iPos" value=1}]\r\n       [{/if}]\r\n     [{/foreach}] <!-- adjust missing --> [{if $iPos == 1}] <tr><td><br>\r\n</td></tr>[{/if}] </tbody></table> [{/if}] <br>\r\n </td><td width="165" align="right" class="defaultcontent"> [{ if $simarticle1 }]\r\n     This is a similar product related to your last order as well:<br>\r\n\r\n<table width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td width="100%" height="15" align="center" class="aktionhead">Top Bargain of the Week</td></tr><tr><td class="aktionmain">\r\n<table cellspacing="0" cellpadding="0" border="0"><tbody><tr><td class="aktion"><a href="[{$simarticle1->getLink()}]" class="aktion"><img vspace="0" hspace="0" border="0" alt="[{ $simarticle1->oxarticles__oxtitle->value }]" src="[{$oViewConf->getPictureDir()}][{$simarticle1->oxarticles__oxthumb->value }]"></a></td></tr><tr><td height="15" class="aktion">[{ $simarticle1->oxarticles__oxtitle->value }]</td><td class="aktion"><br>\r\n</td></tr><tr><td height="15" class="aktionhighlight"><strong>Only [{ $mycurrency->sign}][{ $simarticle1->getFPrice() }]!!</strong></td></tr><tr><td height="25" class="aktion">\r\n<table cellspacing="0" cellpadding="0" border="0"><tbody><tr><td width="120" class="aktion"><a href="[{$simarticle1->getLink()}]" class="aktion">more information</a></td></tr></tbody></table> </td></tr></tbody></table> </td></tr></tbody></table> [{ /if }] <br>\r\n <br>\r\n [{ if $simarticle2 }]\r\n       And at last a similar product related to your last order again:<br>\r\n\r\n<table width="100%" cellspacing="0" cellpadding="0" border="0"><tbody><tr><td width="165" height="15" align="center" class="aktionhead">Bargain!</td></tr><tr><td valign="top" height="145" class="aktionmain"> You will get our bestseller <a class="aktionhighlight" href="[{$simarticle2->getLink()}]">[{ $simarticle2->oxarticles__oxtitle->value }]</a> in a special edition on a suitable price exklusively at OXID!<br>\r\n Order <a class="aktionhighlight" href="[{$simarticle2->getToBasketLink()}]&am=1">now</a> !<br>\r\n </td></tr></tbody></table> [{/if}] </td></tr></tbody></table> </td></tr><tr><td align="right" class="pagebottom">\r\n© 2009 OXID </td></tr></tbody></table>\r\n</body>\r\n</html>', 'OXID eSales Newsletter\r\n\r\nHello [{ $myuser->oxuser__oxsal->value|oxmultilangsal }] [{ $myuser->oxuser__oxfname->getRawValue() }] [{ $myuser->oxuser__oxlname->getRawValue() }],\r\n\r\nas you can see, our newsletter works really well.\r\n\r\nIt is not only possible to display your address here:\r\n\r\n[{ $myuser->oxuser__oxaddinfo->getRawValue() }]\r\n[{ $myuser->oxuser__oxstreet->getRawValue() }]\r\n[{ $myuser->oxuser__oxzip->value }] [{ $myuser->oxuser__oxcity->getRawValue() }]\r\n[{ $myuser->oxuser__oxcountry->getRawValue() }]\r\nPhone: [{ $myuser->oxuser__oxfon->value }]\r\n\r\nYou want to unsubscribe from our newsletter? No problem - simply click here: [{$oViewConf->getBaseDir()}]index.php?cl=newsletter&fnc=removeme&uid=[{ $myuser->oxuser__oxid->value}]\r\n\r\n[{if isset($simarticle0) }]\r\n   This is a similar product related to your last order:\r\n \r\n    [{ $simarticle0->oxarticles__oxtitle->getRawValue() }] \r\nOnly [{ $mycurrency->name}][{ $simarticle0->getFPrice() }] instead of [{ $mycurrency->name}][{ $simarticle0->getFTPrice()}]\r\n[{/if}]\r\n\r\n[{if isset($articlelist) }]\r\n  Assorted products from our store especially for this newsletter: \r\n     [{foreach from=$articlelist item=product}]  \r\n        [{ $product->oxarticles__oxtitle->getRawValue() }]   Only [{ $mycurrency->name}][{ $product->getFPrice() }]\r\n    [{/foreach}] \r\n[{/if}]');

#US as a default user country
UPDATE oxuser SET oxstateid = 'CA', oxcountryid = '8f241f11096877ac0.98748826';

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxarticles AS SELECT oxarticles.* FROM oxarticles;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxarticles_en AS SELECT OXID,OXSHOPID,OXPARENTID,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXARTNUM,OXEAN,OXDISTEAN,OXMPN,OXTITLE,OXSHORTDESC,OXPRICE,OXBLFIXEDPRICE,OXPRICEA,OXPRICEB,OXPRICEC,OXBPRICE,OXTPRICE,OXUNITNAME,OXUNITQUANTITY,OXEXTURL,OXURLDESC,OXURLIMG,OXVAT,OXTHUMB,OXICON,OXPICSGENERATED,OXPIC1,OXPIC2,OXPIC3,OXPIC4,OXPIC5,OXPIC6,OXPIC7,OXPIC8,OXPIC9,OXPIC10,OXPIC11,OXPIC12,OXWEIGHT,OXSTOCK,OXSTOCKFLAG,OXSTOCKTEXT,OXNOSTOCKTEXT,OXDELIVERY,OXINSERT,OXTIMESTAMP,OXLENGTH,OXWIDTH,OXHEIGHT,OXFILE,OXSEARCHKEYS,OXTEMPLATE,OXQUESTIONEMAIL,OXISSEARCH,OXISCONFIGURABLE,OXVARNAME,OXVARSTOCK,OXVARCOUNT,OXVARSELECT,OXVARMINPRICE,OXBUNDLEID,OXFOLDER,OXSUBCLASS,OXSORT,OXSOLDAMOUNT,OXNONMATERIAL,OXFREESHIPPING,OXREMINDACTIVE,OXREMINDAMOUNT,OXAMITEMID,OXAMTASKID,OXVENDORID,OXMANUFACTURERID,OXSKIPDISCOUNTS,OXRATING,OXRATINGCNT,OXMINDELTIME,OXMAXDELTIME,OXDELTIMEUNIT,OXUPDATEPRICE, OXUPDATEPRICEA, OXUPDATEPRICEB, OXUPDATEPRICEC, OXUPDATEPRICETIME, OXISDOWNLOADABLE FROM oxarticles;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxarticles_de AS SELECT OXID,OXSHOPID,OXPARENTID,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXARTNUM,OXEAN,OXDISTEAN,OXMPN,OXTITLE_1 AS OXTITLE,OXSHORTDESC_1 AS OXSHORTDESC,OXPRICE,OXBLFIXEDPRICE,OXPRICEA,OXPRICEB,OXPRICEC,OXBPRICE,OXTPRICE,OXUNITNAME,OXUNITQUANTITY,OXEXTURL,OXURLDESC_1 AS OXURLDESC,OXURLIMG,OXVAT,OXTHUMB,OXICON,OXPICSGENERATED,OXPIC1,OXPIC2,OXPIC3,OXPIC4,OXPIC5,OXPIC6,OXPIC7,OXPIC8,OXPIC9,OXPIC10,OXPIC11,OXPIC12,OXWEIGHT,OXSTOCK,OXSTOCKFLAG,OXSTOCKTEXT_1 AS OXSTOCKTEXT,OXNOSTOCKTEXT_1 AS OXNOSTOCKTEXT,OXDELIVERY,OXINSERT,OXTIMESTAMP,OXLENGTH,OXWIDTH,OXHEIGHT,OXFILE,OXSEARCHKEYS_1 AS OXSEARCHKEYS,OXTEMPLATE,OXQUESTIONEMAIL,OXISSEARCH,OXISCONFIGURABLE,OXVARNAME_1 AS OXVARNAME,OXVARSTOCK,OXVARCOUNT,OXVARSELECT_1 AS OXVARSELECT,OXVARMINPRICE,OXBUNDLEID,OXFOLDER,OXSUBCLASS,OXSORT,OXSOLDAMOUNT,OXNONMATERIAL,OXFREESHIPPING,OXREMINDACTIVE,OXREMINDAMOUNT,OXAMITEMID,OXAMTASKID,OXVENDORID,OXMANUFACTURERID,OXSKIPDISCOUNTS,OXRATING,OXRATINGCNT,OXMINDELTIME,OXMAXDELTIME,OXDELTIMEUNIT,OXUPDATEPRICE, OXUPDATEPRICEA, OXUPDATEPRICEB, OXUPDATEPRICEC, OXUPDATEPRICETIME, OXISDOWNLOADABLE FROM oxarticles;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxarticles_fr AS SELECT OXID,OXSHOPID,OXPARENTID,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXARTNUM,OXEAN,OXDISTEAN,OXMPN,OXTITLE_2 AS OXTITLE,OXSHORTDESC_2 AS OXSHORTDESC,OXPRICE,OXBLFIXEDPRICE,OXPRICEA,OXPRICEB,OXPRICEC,OXBPRICE,OXTPRICE,OXUNITNAME,OXUNITQUANTITY,OXEXTURL,OXURLDESC_2 AS OXURLDESC,OXURLIMG,OXVAT,OXTHUMB,OXICON,OXPICSGENERATED,OXPIC1,OXPIC2,OXPIC3,OXPIC4,OXPIC5,OXPIC6,OXPIC7,OXPIC8,OXPIC9,OXPIC10,OXPIC11,OXPIC12,OXWEIGHT,OXSTOCK,OXSTOCKFLAG,OXSTOCKTEXT_2 AS OXSTOCKTEXT,OXNOSTOCKTEXT_2 AS OXNOSTOCKTEXT,OXDELIVERY,OXINSERT,OXTIMESTAMP,OXLENGTH,OXWIDTH,OXHEIGHT,OXFILE,OXSEARCHKEYS_2 AS OXSEARCHKEYS,OXTEMPLATE,OXQUESTIONEMAIL,OXISSEARCH,OXISCONFIGURABLE,OXVARNAME_2 AS OXVARNAME,OXVARSTOCK,OXVARCOUNT,OXVARSELECT_2 AS OXVARSELECT,OXVARMINPRICE,OXBUNDLEID,OXFOLDER,OXSUBCLASS,OXSORT,OXSOLDAMOUNT,OXNONMATERIAL,OXFREESHIPPING,OXREMINDACTIVE,OXREMINDAMOUNT,OXAMITEMID,OXAMTASKID,OXVENDORID,OXMANUFACTURERID,OXSKIPDISCOUNTS,OXRATING,OXRATINGCNT,OXMINDELTIME,OXMAXDELTIME,OXDELTIMEUNIT,OXUPDATEPRICE, OXUPDATEPRICEA, OXUPDATEPRICEB, OXUPDATEPRICEC, OXUPDATEPRICETIME, OXISDOWNLOADABLE FROM oxarticles;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxartextends AS SELECT oxartextends.* FROM oxartextends;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxartextends_en AS SELECT OXID,OXLONGDESC,OXTAGS FROM oxartextends;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxartextends_de AS SELECT OXID,OXLONGDESC_1 AS OXLONGDESC,OXTAGS_1 AS OXTAGS FROM oxartextends;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxartextends_fr AS SELECT OXID,OXLONGDESC_2 AS OXLONGDESC,OXTAGS_2 AS OXTAGS FROM oxartextends;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxattribute AS SELECT oxattribute.* FROM oxattribute;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxattribute_en AS SELECT OXID,OXSHOPID,OXTITLE,OXPOS FROM oxattribute;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxattribute_de AS SELECT OXID,OXSHOPID,OXTITLE_1 AS OXTITLE,OXPOS FROM oxattribute;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxattribute_fr AS SELECT OXID,OXSHOPID,OXTITLE_2 AS OXTITLE,OXPOS FROM oxattribute;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxcategories AS SELECT oxcategories.* FROM oxcategories;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxcategories_en AS SELECT OXID,OXPARENTID,OXLEFT,OXRIGHT,OXROOTID,OXSORT,OXACTIVE,OXHIDDEN,OXSHOPID,OXTITLE,OXDESC,OXLONGDESC,OXTHUMB,OXEXTLINK,OXTEMPLATE,OXDEFSORT,OXDEFSORTMODE,OXPRICEFROM,OXPRICETO,OXICON,OXPROMOICON,OXVAT,OXSKIPDISCOUNTS,OXSHOWSUFFIX FROM oxcategories;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxcategories_de AS SELECT OXID,OXPARENTID,OXLEFT,OXRIGHT,OXROOTID,OXSORT,OXACTIVE_1 AS OXACTIVE,OXHIDDEN,OXSHOPID,OXTITLE_1 AS OXTITLE,OXDESC_1 AS OXDESC,OXLONGDESC_1 AS OXLONGDESC,OXTHUMB_1 AS OXTHUMB,OXEXTLINK,OXTEMPLATE,OXDEFSORT,OXDEFSORTMODE,OXPRICEFROM,OXPRICETO,OXICON,OXPROMOICON,OXVAT,OXSKIPDISCOUNTS,OXSHOWSUFFIX FROM oxcategories;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxcategories_fr AS SELECT OXID,OXPARENTID,OXLEFT,OXRIGHT,OXROOTID,OXSORT,OXACTIVE_2 AS OXACTIVE,OXHIDDEN,OXSHOPID,OXTITLE_2 AS OXTITLE,OXDESC_2 AS OXDESC,OXLONGDESC_2 AS OXLONGDESC,OXTHUMB_2 AS OXTHUMB,OXEXTLINK,OXTEMPLATE,OXDEFSORT,OXDEFSORTMODE,OXPRICEFROM,OXPRICETO,OXICON,OXPROMOICON,OXVAT,OXSKIPDISCOUNTS,OXSHOWSUFFIX FROM oxcategories;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxcontents AS SELECT oxcontents.* FROM oxcontents;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxcontents_en AS SELECT OXID,OXLOADID,OXSHOPID,OXSNIPPET,OXTYPE,OXACTIVE,OXPOSITION,OXTITLE,OXCONTENT,OXCATID,OXFOLDER,OXTERMVERSION FROM oxcontents;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxcontents_de AS SELECT OXID,OXLOADID,OXSHOPID,OXSNIPPET,OXTYPE,OXACTIVE_1 AS OXACTIVE,OXPOSITION,OXTITLE_1 AS OXTITLE,OXCONTENT_1 AS OXCONTENT,OXCATID,OXFOLDER,OXTERMVERSION FROM oxcontents;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxcontents_fr AS SELECT OXID,OXLOADID,OXSHOPID,OXSNIPPET,OXTYPE,OXACTIVE_2 AS OXACTIVE,OXPOSITION,OXTITLE_2 AS OXTITLE,OXCONTENT_2 AS OXCONTENT,OXCATID,OXFOLDER,OXTERMVERSION FROM oxcontents;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxcountry AS SELECT oxcountry.* FROM oxcountry;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxcountry_en AS SELECT OXID,OXACTIVE,OXTITLE,OXISOALPHA2,OXISOALPHA3,OXUNNUM3,OXORDER,OXSHORTDESC,OXLONGDESC,OXVATSTATUS FROM oxcountry;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxcountry_de AS SELECT OXID,OXACTIVE,OXTITLE_1 AS OXTITLE,OXISOALPHA2,OXISOALPHA3,OXUNNUM3,OXORDER,OXSHORTDESC_1 AS OXSHORTDESC,OXLONGDESC_1 AS OXLONGDESC,OXVATSTATUS FROM oxcountry;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxcountry_fr AS SELECT OXID,OXACTIVE,OXTITLE_2 AS OXTITLE,OXISOALPHA2,OXISOALPHA3,OXUNNUM3,OXORDER,OXSHORTDESC_2 AS OXSHORTDESC,OXLONGDESC_2 AS OXLONGDESC,OXVATSTATUS FROM oxcountry;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxdelivery AS SELECT oxdelivery.* FROM oxdelivery;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxdelivery_en AS SELECT OXID,OXSHOPID,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXTITLE,OXADDSUMTYPE,OXADDSUM,OXDELTYPE,OXPARAM,OXPARAMEND,OXFIXED,OXSORT,OXFINALIZE FROM oxdelivery;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxdelivery_de AS SELECT OXID,OXSHOPID,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXTITLE_1 AS OXTITLE,OXADDSUMTYPE,OXADDSUM,OXDELTYPE,OXPARAM,OXPARAMEND,OXFIXED,OXSORT,OXFINALIZE FROM oxdelivery;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxdelivery_fr AS SELECT OXID,OXSHOPID,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXTITLE_2 AS OXTITLE,OXADDSUMTYPE,OXADDSUM,OXDELTYPE,OXPARAM,OXPARAMEND,OXFIXED,OXSORT,OXFINALIZE FROM oxdelivery;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxdiscount AS SELECT oxdiscount.* FROM oxdiscount;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxdiscount_en AS SELECT OXID,OXSHOPID,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXTITLE,OXAMOUNT,OXAMOUNTTO,OXPRICETO,OXPRICE,OXADDSUMTYPE,OXADDSUM,OXITMARTID,OXITMAMOUNT,OXITMMULTIPLE FROM oxdiscount;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxdiscount_de AS SELECT OXID,OXSHOPID,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXTITLE_1 AS OXTITLE,OXAMOUNT,OXAMOUNTTO,OXPRICETO,OXPRICE,OXADDSUMTYPE,OXADDSUM,OXITMARTID,OXITMAMOUNT,OXITMMULTIPLE FROM oxdiscount;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxdiscount_fr AS SELECT OXID,OXSHOPID,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXTITLE_2 AS OXTITLE,OXAMOUNT,OXAMOUNTTO,OXPRICETO,OXPRICE,OXADDSUMTYPE,OXADDSUM,OXITMARTID,OXITMAMOUNT,OXITMMULTIPLE FROM oxdiscount;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxgroups AS SELECT oxgroups.* FROM oxgroups;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxgroups_en AS SELECT OXID,OXACTIVE,OXTITLE FROM oxgroups;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxgroups_de AS SELECT OXID,OXACTIVE,OXTITLE_1 AS OXTITLE FROM oxgroups;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxgroups_fr AS SELECT OXID,OXACTIVE,OXTITLE_2 AS OXTITLE FROM oxgroups;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxlinks AS SELECT oxlinks.* FROM oxlinks;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxlinks_en AS SELECT OXID,OXSHOPID,OXACTIVE,OXURL,OXURLDESC,OXINSERT FROM oxlinks;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxlinks_de AS SELECT OXID,OXSHOPID,OXACTIVE,OXURL,OXURLDESC_1 AS OXURLDESC,OXINSERT FROM oxlinks;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxlinks_fr AS SELECT OXID,OXSHOPID,OXACTIVE,OXURL,OXURLDESC_2 AS OXURLDESC,OXINSERT FROM oxlinks;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxnews AS SELECT oxnews.* FROM oxnews;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxnews_en AS SELECT OXID,OXSHOPID,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXDATE,OXSHORTDESC,OXLONGDESC FROM oxnews;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxnews_de AS SELECT OXID,OXSHOPID,OXACTIVE_1 AS OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXDATE,OXSHORTDESC_1 AS OXSHORTDESC,OXLONGDESC_1 AS OXLONGDESC FROM oxnews;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxnews_fr AS SELECT OXID,OXSHOPID,OXACTIVE_2 AS OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXDATE,OXSHORTDESC_2 AS OXSHORTDESC,OXLONGDESC_2 AS OXLONGDESC FROM oxnews;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxobject2attribute AS SELECT oxobject2attribute.* FROM oxobject2attribute;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxobject2attribute_en AS SELECT OXID,OXOBJECTID,OXATTRID,OXVALUE,OXPOS FROM oxobject2attribute;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxobject2attribute_de AS SELECT OXID,OXOBJECTID,OXATTRID,OXVALUE_1 AS OXVALUE,OXPOS FROM oxobject2attribute;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxobject2attribute_fr AS SELECT OXID,OXOBJECTID,OXATTRID,OXVALUE_2 AS OXVALUE,OXPOS FROM oxobject2attribute;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxpayments AS SELECT oxpayments.* FROM oxpayments;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxpayments_en AS SELECT OXID,OXACTIVE,OXDESC,OXADDSUM,OXADDSUMTYPE,OXADDSUMRULES,OXFROMBONI,OXFROMAMOUNT,OXTOAMOUNT,OXVALDESC,OXCHECKED,OXLONGDESC,OXSORT,OXTSPAYMENTID FROM oxpayments;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxpayments_de AS SELECT OXID,OXACTIVE,OXDESC_1 AS OXDESC,OXADDSUM,OXADDSUMTYPE,OXADDSUMRULES,OXFROMBONI,OXFROMAMOUNT,OXTOAMOUNT,OXVALDESC_1 AS OXVALDESC,OXCHECKED,OXLONGDESC_1 AS OXLONGDESC,OXSORT,OXTSPAYMENTID FROM oxpayments;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxpayments_fr AS SELECT OXID,OXACTIVE,OXDESC_2 AS OXDESC,OXADDSUM,OXADDSUMTYPE,OXADDSUMRULES,OXFROMBONI,OXFROMAMOUNT,OXTOAMOUNT,OXVALDESC_2 AS OXVALDESC,OXCHECKED,OXLONGDESC_2 AS OXLONGDESC,OXSORT,OXTSPAYMENTID FROM oxpayments;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxselectlist AS SELECT oxselectlist.* FROM oxselectlist;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxselectlist_en AS SELECT OXID,OXSHOPID,OXTITLE,OXIDENT,OXVALDESC FROM oxselectlist;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxselectlist_de AS SELECT OXID,OXSHOPID,OXTITLE_1 AS OXTITLE,OXIDENT,OXVALDESC_1 AS OXVALDESC FROM oxselectlist;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxselectlist_fr AS SELECT OXID,OXSHOPID,OXTITLE_2 AS OXTITLE,OXIDENT,OXVALDESC_2 AS OXVALDESC FROM oxselectlist;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxshops AS SELECT oxshops.* FROM oxshops;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxshops_en AS SELECT OXID,OXACTIVE,OXPRODUCTIVE,OXDEFCURRENCY,OXDEFLANGUAGE,OXNAME,OXTITLEPREFIX,OXTITLESUFFIX,OXSTARTTITLE,OXINFOEMAIL,OXORDEREMAIL,OXOWNEREMAIL,OXORDERSUBJECT,OXREGISTERSUBJECT,OXFORGOTPWDSUBJECT,OXSENDEDNOWSUBJECT,OXSMTP,OXSMTPUSER,OXSMTPPWD,OXCOMPANY,OXSTREET,OXZIP,OXCITY,OXCOUNTRY,OXBANKNAME,OXBANKNUMBER,OXBANKCODE,OXVATNUMBER,OXBICCODE,OXIBANNUMBER,OXFNAME,OXLNAME,OXTELEFON,OXTELEFAX,OXURL,OXDEFCAT,OXHRBNR,OXCOURT,OXADBUTLERID,OXAFFILINETID,OXSUPERCLICKSID,OXAFFILIWELTID,OXAFFILI24ID,OXEDITION,OXVERSION,OXSEOACTIVE FROM oxshops;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxshops_de AS SELECT OXID,OXACTIVE,OXPRODUCTIVE,OXDEFCURRENCY,OXDEFLANGUAGE,OXNAME,OXTITLEPREFIX_1 AS OXTITLEPREFIX,OXTITLESUFFIX_1 AS OXTITLESUFFIX,OXSTARTTITLE_1 AS OXSTARTTITLE,OXINFOEMAIL,OXORDEREMAIL,OXOWNEREMAIL,OXORDERSUBJECT_1 AS OXORDERSUBJECT,OXREGISTERSUBJECT_1 AS OXREGISTERSUBJECT,OXFORGOTPWDSUBJECT_1 AS OXFORGOTPWDSUBJECT,OXSENDEDNOWSUBJECT_1 AS OXSENDEDNOWSUBJECT,OXSMTP,OXSMTPUSER,OXSMTPPWD,OXCOMPANY,OXSTREET,OXZIP,OXCITY,OXCOUNTRY,OXBANKNAME,OXBANKNUMBER,OXBANKCODE,OXVATNUMBER,OXBICCODE,OXIBANNUMBER,OXFNAME,OXLNAME,OXTELEFON,OXTELEFAX,OXURL,OXDEFCAT,OXHRBNR,OXCOURT,OXADBUTLERID,OXAFFILINETID,OXSUPERCLICKSID,OXAFFILIWELTID,OXAFFILI24ID,OXEDITION,OXVERSION,OXSEOACTIVE_1 AS OXSEOACTIVE FROM oxshops;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxshops_fr AS SELECT OXID,OXACTIVE,OXPRODUCTIVE,OXDEFCURRENCY,OXDEFLANGUAGE,OXNAME,OXTITLEPREFIX_2 AS OXTITLEPREFIX,OXTITLESUFFIX_2 AS OXTITLESUFFIX,OXSTARTTITLE_2 AS OXSTARTTITLE,OXINFOEMAIL,OXORDEREMAIL,OXOWNEREMAIL,OXORDERSUBJECT_2 AS OXORDERSUBJECT,OXREGISTERSUBJECT_2 AS OXREGISTERSUBJECT,OXFORGOTPWDSUBJECT_2 AS OXFORGOTPWDSUBJECT,OXSENDEDNOWSUBJECT_2 AS OXSENDEDNOWSUBJECT,OXSMTP,OXSMTPUSER,OXSMTPPWD,OXCOMPANY,OXSTREET,OXZIP,OXCITY,OXCOUNTRY,OXBANKNAME,OXBANKNUMBER,OXBANKCODE,OXVATNUMBER,OXBICCODE,OXIBANNUMBER,OXFNAME,OXLNAME,OXTELEFON,OXTELEFAX,OXURL,OXDEFCAT,OXHRBNR,OXCOURT,OXADBUTLERID,OXAFFILINETID,OXSUPERCLICKSID,OXAFFILIWELTID,OXAFFILI24ID,OXEDITION,OXVERSION,OXSEOACTIVE_2 AS OXSEOACTIVE FROM oxshops;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxactions AS SELECT oxactions.* FROM oxactions;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxactions_en AS SELECT OXID,OXSHOPID,OXTYPE,OXTITLE,OXLONGDESC,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXPIC,OXLINK,OXSORT FROM oxactions;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxactions_de AS SELECT OXID,OXSHOPID,OXTYPE,OXTITLE_1 AS OXTITLE,OXLONGDESC_1 AS OXLONGDESC,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXPIC_1 AS OXPIC,OXLINK_1 AS OXLINK,OXSORT FROM oxactions;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxactions_fr AS SELECT OXID,OXSHOPID,OXTYPE,OXTITLE_2 AS OXTITLE,OXLONGDESC_2 AS OXLONGDESC,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXPIC_2 AS OXPIC,OXLINK_2 AS OXLINK,OXSORT FROM oxactions;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxwrapping AS SELECT oxwrapping.* FROM oxwrapping;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxwrapping_en AS SELECT OXID,OXSHOPID,OXACTIVE,OXTYPE,OXNAME,OXPIC,OXPRICE FROM oxwrapping;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxwrapping_de AS SELECT OXID,OXSHOPID,OXACTIVE_1 AS OXACTIVE,OXTYPE,OXNAME_1 AS OXNAME,OXPIC,OXPRICE FROM oxwrapping;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxwrapping_fr AS SELECT OXID,OXSHOPID,OXACTIVE_2 AS OXACTIVE,OXTYPE,OXNAME_2 AS OXNAME,OXPIC,OXPRICE FROM oxwrapping;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxdeliveryset AS SELECT oxdeliveryset.* FROM oxdeliveryset;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxdeliveryset_en AS SELECT OXID,OXSHOPID,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXTITLE,OXPOS FROM oxdeliveryset;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxdeliveryset_de AS SELECT OXID,OXSHOPID,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXTITLE_1 AS OXTITLE,OXPOS FROM oxdeliveryset;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxdeliveryset_fr AS SELECT OXID,OXSHOPID,OXACTIVE,OXACTIVEFROM,OXACTIVETO,OXTITLE_2 AS OXTITLE,OXPOS FROM oxdeliveryset;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxvendor AS SELECT oxvendor.* FROM oxvendor;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxvendor_en AS SELECT OXID,OXSHOPID,OXACTIVE,OXICON,OXTITLE,OXSHORTDESC,OXSHOWSUFFIX FROM oxvendor;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxvendor_de AS SELECT OXID,OXSHOPID,OXACTIVE,OXICON,OXTITLE_1 AS OXTITLE,OXSHORTDESC_1 AS OXSHORTDESC,OXSHOWSUFFIX FROM oxvendor;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxvendor_fr AS SELECT OXID,OXSHOPID,OXACTIVE,OXICON,OXTITLE_2 AS OXTITLE,OXSHORTDESC_2 AS OXSHORTDESC,OXSHOWSUFFIX FROM oxvendor;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxmanufacturers AS SELECT oxmanufacturers.* FROM oxmanufacturers;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxmanufacturers_en AS SELECT OXID,OXSHOPID,OXACTIVE,OXICON,OXTITLE,OXSHORTDESC,OXSHOWSUFFIX FROM oxmanufacturers;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxmanufacturers_de AS SELECT OXID,OXSHOPID,OXACTIVE,OXICON,OXTITLE_1 AS OXTITLE,OXSHORTDESC_1 AS OXSHORTDESC,OXSHOWSUFFIX FROM oxmanufacturers;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxmanufacturers_fr AS SELECT OXID,OXSHOPID,OXACTIVE,OXICON,OXTITLE_2 AS OXTITLE,OXSHORTDESC_2 AS OXSHORTDESC,OXSHOWSUFFIX FROM oxmanufacturers;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxmediaurls AS SELECT oxmediaurls.* FROM oxmediaurls;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxmediaurls_en AS SELECT OXID,OXOBJECTID,OXURL,OXDESC,OXISUPLOADED FROM oxmediaurls;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxmediaurls_de AS SELECT OXID,OXOBJECTID,OXURL,OXDESC_1 AS OXDESC,OXISUPLOADED FROM oxmediaurls;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxmediaurls_fr AS SELECT OXID,OXOBJECTID,OXURL,OXDESC_2 AS OXDESC,OXISUPLOADED FROM oxmediaurls;

CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxstates AS SELECT oxstates.* FROM oxstates;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxstates_en AS SELECT OXID,OXCOUNTRYID,OXTITLE,OXISOALPHA2 FROM oxstates;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxstates_de AS SELECT OXID,OXCOUNTRYID,OXTITLE_1 AS OXTITLE,OXISOALPHA2 FROM oxstates;
CREATE OR REPLACE SQL SECURITY INVOKER VIEW oxv_oxstates_fr AS SELECT OXID,OXCOUNTRYID,OXTITLE_2 AS OXTITLE,OXISOALPHA2 FROM oxstates;

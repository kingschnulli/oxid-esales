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
REPLACE INTO `oxnewsletter` VALUES ('oxidnewsletter', 'oxbaseshop', 'Newsletter Example', '<!DOCTYPE HTML>\r\n<html>\r\n  <head>\r\n      <title>OXID eSales Newsletter</title>\r\n  </head>\r\n\r\n  <body bgcolor="#ffffff" link="#355222" alink="#18778E" vlink="#389CB4" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">\r\n\r\n    <div width="600" style="width: 600px">\r\n\r\n        <div style="padding: 10px 0;">\r\n            <img src="[{$oViewConf->getImageUrl(''logo_email.png'', false)}]" border="0" hspace="0" vspace="0" alt="[{ $shop->oxshops__oxname->value }]" align="texttop">\r\n        </div>\r\n        \r\n        <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">\r\n            Hello [{ $myuser->oxuser__oxsal->value|oxmultilangsal }] [{ $myuser->oxuser__oxfname->value }] [{ $myuser->oxuser__oxlname->value }],\r\n        </p>\r\n        \r\n        <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">\r\n            as you can see, our newsletter works really well.\r\n        </p>\r\n\r\n        <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">\r\n            It is not only possible to display your address here:\r\n        </p>\r\n\r\n        <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; padding-left: 20px;">\r\n            [{ $myuser->oxuser__oxaddinfo->value }]<br>\r\n            [{ $myuser->oxuser__oxstreet->value }]<br>\r\n            [{ $myuser->oxuser__oxzip->value }] [{ $myuser->oxuser__oxcity->value }]<br>\r\n            [{ $myuser->oxuser__oxcountry->value }]<br>\r\n            Phone: [{ $myuser->oxuser__oxfon->value }]<br>\r\n        </p>\r\n\r\n        <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">\r\n            You want to unsubscribe from our newsletter? No problem - simply click <a href="[{ $oViewConf->getBaseDir() }]index.php?cl=newsletter&amp;fnc=removeme&amp;uid=[{$myuser->oxuser__oxid->value}]" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;" target="_blank">here</a>.<br>\r\n        </p>\r\n\r\n        [{if isset($simarticle0) }]\r\n            <h3 style="font-weight: bold; margin: 20px 0 7px; padding: 0; line-height: 35px; font-size: 12px;font-family: Arial, Helvetica, sans-serif; text-transform: uppercase; border-bottom: 4px solid #ddd;">\r\n                This is a similar product related to your last order:\r\n            </h3>\r\n\r\n            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; padding-bottom: 10px; margin-bottom: 20px; border-bottom: 2px solid #ddd;">\r\n                <tbody>\r\n                    <tr>\r\n                        <td valign="top" style="padding-right: 25px;">\r\n                            <a href="[{$simarticle0->getLink()}]"><img alt="[{ $simarticle0->oxarticles__oxtitle->value }]" src="[{$simarticle0->getThumbnailUrl()}]" border="0" hspace="0" vspace="0"></a>\r\n                        </td>\r\n                        <td valign="top">\r\n                            <h4 style="font-size: 14px; font-weight: bold; margin: 0 0 15px;">[{ $simarticle0->oxarticles__oxtitle->value }]</h4>\r\n                            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">\r\n                                [{ $simarticle0->oxarticles__oxshortdesc->value }]\r\n                            </p>\r\n                            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin: 0;">\r\n                                <b>Now <s>[{ $simarticle0->getFTPrice()}]</s></b>\r\n                                instead of <span style="font-size: 14px;"><b>[{ $simarticle0->getFPrice() }] [{ $mycurrency->sign}]</b></span>\r\n                                <br><br>\r\n                                <a href="[{$simarticle0->getLink()}]">more information</a>\r\n                            </p>\r\n                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n        [{/if}]\r\n        \r\n        [{if isset($simarticle1) }]\r\n            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">\r\n                This is a similar product related to your last order as well:\r\n            </p>\r\n            \r\n            <h3 style="font-weight: bold; margin: 10px 0 7px; padding: 0; line-height: 35px; font-size: 12px;font-family: Arial, Helvetica, sans-serif; text-transform: uppercase; border-bottom: 4px solid #ddd;">\r\n                Top Bargain of the Week\r\n            </h3>\r\n\r\n            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; padding-bottom: 10px; margin-bottom: 20px;  border-bottom: 2px solid #ddd;">\r\n                <tbody>\r\n                    <tr>\r\n                        <td valign="top" style="padding-right: 25px;">\r\n                            <a href="[{$simarticle1->getLink()}]"><img alt="[{ $simarticle1->oxarticles__oxtitle->value }]" src="[{$simarticle1->getThumbnailUrl()}]" border="0" hspace="0" vspace="0"></a>\r\n                        </td>\r\n                        <td valign="top">\r\n                            <h4 style="font-size: 14px; font-weight: bold; margin: 0 0 15px;">[{ $simarticle1->oxarticles__oxtitle->value }]</h4>\r\n                            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">\r\n                                [{ $simarticle0->oxarticles__oxshortdesc->value }]\r\n                            </p>\r\n                            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin: 0;">\r\n                                Jetzt nur <span style="font-size: 14px;"><b>[{ $simarticle1->getFPrice() }] [{ $mycurrency->sign}] !!!</b></span>\r\n                                <br><br>\r\n                                <a href="[{$simarticle1->getLink()}]">more information</a>\r\n                            </p>\r\n                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n        [{/if}]\r\n\r\n        [{if isset($simarticle2) }]\r\n            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">\r\n                And at last a similar product related to your last order again:\r\n            </p>\r\n\r\n            <h3 style="font-weight: bold; margin: 10px 0 7px; padding: 0; line-height: 35px; font-size: 12px;font-family: Arial, Helvetica, sans-serif; text-transform: uppercase; border-bottom: 4px solid #ddd;">\r\n                Bargain!\r\n            </h3>\r\n\r\n            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; padding-bottom: 10px; margin-bottom: 20px; border-bottom: 2px solid #ddd;">\r\n                <tbody>\r\n                    <tr>\r\n                        <td>\r\n                            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">\r\n                                You will get our bestseller <a href="[{$simarticle2->getLink()}]">[{ $simarticle2->oxarticles__oxtitle->value }]</a> in a special edition on a suitable price exklusively at OXID!<br>\r\n                            </p>\r\n                            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px;">\r\n                                <a href="[{$simarticle2->getToBasketLink()}]&amp;am=1">Order now</a>!\r\n                            </p>\r\n                        </td>\r\n                    </tr>\r\n                </tbody>\r\n            </table>\r\n        [{/if}]\r\n\r\n\r\n        [{if isset($articlelist) }]\r\n\r\n            <h3 style="font-weight: bold; margin: 10px 0 7px; padding: 0; line-height: 35px; font-size: 12px;font-family: Arial, Helvetica, sans-serif; text-transform: uppercase; border-bottom: 4px solid #ddd;">\r\n                Assorted products from our store especially for this newsletter: \r\n            </h3>\r\n        \r\n            [{foreach from=$articlelist item=product}]\r\n                <table cellspacing="0" cellpadding="0" border="0" align="left" style="width: 220px; margin-right: 15px; margin-bottom: 10px; border: 1px solid #ccc; padding: 10px;">\r\n                    <tr>\r\n                        <td align="center">\r\n                            <a href="[{$product->getLink()}]" class="startpageProduct"><img vspace="0" hspace="0" border="0" alt="[{ $product->oxarticles__oxtitle->value }]" src="[{$product->getThumbnailUrl()}]"></a>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>\r\n                            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin: 5px;">\r\n                                <b>[{ $product->oxarticles__oxtitle->value }]</b>\r\n                            </p>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td height="20">\r\n                            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin: 5px;">\r\n                                Jetzt nur <b>[{ $product->getFPrice() }] [{ $mycurrency->sign}]</b>\r\n                            </p>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td height="20">\r\n                            <a href="[{$product->getLink()}]" class="startpageProductText" style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin: 5px;">more information</a><br>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n            [{/foreach}]\r\n        [{/if}]\r\n\r\n        <div style="clear: both; height: 3px;">&nbsp;</div>\r\n        \r\n        <div style="border: 1px solid #3799B1; margin: 30px 0 15px 0; padding: 12px 20px; background-color: #eee; border-radius: 4px 4px 4px 4px; linear-gradient(center top , #FFFFFF, #D1D8DB) repeat scroll 0 0 transparent;">\r\n            <p style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; margin: 0; padding: 0;">\r\n                [{ oxcontent ident="oxemailfooter" }]\r\n            </p>\r\n        </div>\r\n\r\n    </div>\r\n\r\n  </body>\r\n</html>', 'OXID eSales Newsletter\r\n\r\nHello [{ $myuser->oxuser__oxsal->value|oxmultilangsal }] [{ $myuser->oxuser__oxfname->getRawValue() }] [{ $myuser->oxuser__oxlname->getRawValue() }],\r\n\r\nas you can see, our newsletter works really well.\r\n\r\nIt is not only possible to display your address here:\r\n\r\n[{ $myuser->oxuser__oxaddinfo->getRawValue() }]\r\n[{ $myuser->oxuser__oxstreet->getRawValue() }]\r\n[{ $myuser->oxuser__oxzip->value }] [{ $myuser->oxuser__oxcity->getRawValue() }]\r\n[{ $myuser->oxuser__oxcountry->getRawValue() }]\r\nPhone: [{ $myuser->oxuser__oxfon->value }]\r\n\r\nYou want to unsubscribe from our newsletter? No problem - simply click here: [{$oViewConf->getBaseDir()}]index.php?cl=newsletter&fnc=removeme&uid=[{ $myuser->oxuser__oxid->value}]\r\n\r\n[{if isset($simarticle0) }]\r\n   This is a similar product related to your last order:\r\n \r\n    [{ $simarticle0->oxarticles__oxtitle->getRawValue() }] \r\nOnly [{ $mycurrency->name}][{ $simarticle0->getFPrice() }] instead of [{ $mycurrency->name}][{ $simarticle0->getFTPrice()}]\r\n[{/if}]\r\n\r\n[{if isset($articlelist) }]\r\n  Assorted products from our store especially for this newsletter: \r\n     [{foreach from=$articlelist item=product}]  \r\n        [{ $product->oxarticles__oxtitle->getRawValue() }]   Only [{ $mycurrency->name}][{ $product->getFPrice() }]\r\n    [{/foreach}] \r\n[{/if}]');

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

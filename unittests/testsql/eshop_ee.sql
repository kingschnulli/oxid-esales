-- phpMyAdmin SQL Dump
-- version 2.10.3deb1ubuntu0.2
-- http://www.phpmyadmin.net
-- 
-- Darbinė stotis: localhost
-- Atlikimo laikas:  2008 m. Gruodžio 09 d.  10:10
-- Serverio versija: 5.0.45
-- PHP versija: 5.2.3-1ubuntu6.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Duombazė: `eshop_ee`
-- 

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `adodb_logsql`
-- 

DROP TABLE IF EXISTS `adodb_logsql`;
CREATE TABLE IF NOT EXISTS `adodb_logsql` (
  `created` datetime NOT NULL,
  `sql0` varchar(250) collate latin1_general_ci NOT NULL,
  `sql1` text collate latin1_general_ci NOT NULL,
  `params` text collate latin1_general_ci NOT NULL,
  `tracer` text collate latin1_general_ci NOT NULL,
  `timer` decimal(16,6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `adodb_logsql`
-- 

INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '27.1994821062', 'SET @@session.sql_mode = ""', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxdb.php - Execute:208\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - getDb:973\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - _isValidShopId:934\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - getShopId:528\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000282);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '121.1325328432', 'select oxvarname, oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - _loadVarsFromDb:531\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000664);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '190.-2004035283', 'select oxvarname, oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1'' and oxvarname in ( "blMallUsers", "aSerials", "IMD", "IMA", "IMS" ) ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - _loadVarsFromDb:536\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000763);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '132.-1788992125', 'select oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1'' and oxvarname = ''IMS''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:1789\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - getConfVar:227\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - pageStart:37\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - appInit:639\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000615);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '132.-1864523499', 'select oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1'' and oxvarname = ''IMD''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:1789\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - getConfVar:228\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - pageStart:37\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - appInit:639\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000433);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '132.-307604144', 'select oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1'' and oxvarname = ''IMA''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:1789\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - getConfVar:229\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - pageStart:37\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - appInit:639\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000605);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '137.-48677512', 'select oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1'' and oxvarname = ''aSerials''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:1789\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - getConfVar:230\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - pageStart:37\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - appInit:639\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000524);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '138.-1484902309', 'select oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1'' and oxvarname = ''blBackTag''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:1789\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - getConfVar:231\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - pageStart:37\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - appInit:639\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000708);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '137.1175458748', 'select oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1'' and oxvarname = ''sTagList''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:1789\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - getConfVar:232\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - pageStart:37\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - appInit:639\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000459);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1052.2025238739', 'select oxshops.oxid, oxshops.oxparentid, oxshops.oxactive, oxshops.oxisinherited, oxshops.oxismultishop, oxshops.oxissupershop, oxshops.oxproductive, oxshops.oxdefcurrency, oxshops.oxdeflanguage, oxshops.oxname, oxshops.oxtitleprefix, oxshops.oxtitlesuffix, oxshops.oxinfoemail, oxshops.oxorderemail, oxshops.oxowneremail, oxshops.oxordersubject, oxshops.oxregistersubject, oxshops.oxforgotpwdsubject, oxshops.oxsendednowsubject, oxshops.oxsmtp, oxshops.oxsmtpuser, oxshops.oxsmtppwd, oxshops.oxserial, oxshops.oxcompany, oxshops.oxstreet, oxshops.oxzip, oxshops.oxcity, oxshops.oxcountry, oxshops.oxbankname, oxshops.oxbanknumber, oxshops.oxbankcode, oxshops.oxvatnumber, oxshops.oxbiccode, oxshops.oxibannumber, oxshops.oxfname, oxshops.oxlname, oxshops.oxtelefon, oxshops.oxtelefax, oxshops.oxurl, oxshops.oxdefcat, oxshops.oxhrbnr, oxshops.oxcourt, oxshops.oxadbutlerid, oxshops.oxaffilinetid, oxshops.oxsuperclicksid, oxshops.oxaffiliweltid, oxshops.oxaffili24id, oxshops.oxversion, oxshops.oxseoactive from oxshops where 1  and oxshops.oxid = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - assignRecord:594\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxi18n.php - load:187\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - load:1895\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxutils.php - getActiveShop:665\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - seoIsActive:50\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - init:278\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000897);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '328.572479759', 'select oxv_oxvendor_1.oxid, oxv_oxvendor_1.oxshopid, oxv_oxvendor_1.oxshopincl, oxv_oxvendor_1.oxshopexcl, oxv_oxvendor_1.oxactive, oxv_oxvendor_1.oxicon, oxv_oxvendor_1.oxtitle, oxv_oxvendor_1.oxshortdesc from oxv_oxvendor_1  where  oxv_oxvendor_1.oxactive = 1  and oxv_oxvendor_1.oxtitle != ''''  order by oxv_oxvendor_1.oxtitle', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxvendorlist.php - selectString:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxvendorlist.php - loadVendorList:115\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_categories.php - buildVendorTree:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_categories.php - _loadVendorTree:96\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxview.php - init:196\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - init:114\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - init:55\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - init:278\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000395);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '871.-1839749580', 'select oxv_oxcategories_1.oxid, oxv_oxcategories_1.oxparentid, oxv_oxcategories_1.oxleft, oxv_oxcategories_1.oxright, oxv_oxcategories_1.oxrootid, oxv_oxcategories_1.oxsort, oxv_oxcategories_1.oxactive, oxv_oxcategories_1.oxhidden, oxv_oxcategories_1.oxshopid, oxv_oxcategories_1.oxshopincl, oxv_oxcategories_1.oxshopexcl, oxv_oxcategories_1.oxtitle, oxv_oxcategories_1.oxdesc, oxv_oxcategories_1.oxlongdesc, oxv_oxcategories_1.oxthumb, oxv_oxcategories_1.oxextlink, oxv_oxcategories_1.oxtemplate, oxv_oxcategories_1.oxdefsort, oxv_oxcategories_1.oxdefsortmode, oxv_oxcategories_1.oxpricefrom, oxv_oxcategories_1.oxpriceto, oxv_oxcategories_1.oxicon, oxv_oxcategories_1.oxvat, oxv_oxcategories_1.oxskipdiscounts,not ( 1  and oxv_oxcategories_1.oxactive) as remove from oxv_oxcategories_1 where  1  order by oxv_oxcategories_1.oxrootid desc, oxv_oxcategories_1.oxleft desc', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcategorylist.php - selectString:209\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_categories.php - buildTree:126\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_categories.php - _loadCategoryTree:100\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxview.php - init:196\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - init:114\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - init:55\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - init:278\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000536);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '143.-321273588', 'select * from oxcontents where oxactive = ''1'' and oxtype = ''2'' and oxsnippet = ''0'' and oxshopid = ''1'' and oxcatid is not null order by oxloadid', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontentlist.php - selectString:82\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontentlist.php - _loadMenue:53\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcategorylist.php - loadCatMenues:377\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcategorylist.php - _ppAddContentCategories:220\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_categories.php - buildTree:126\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_categories.php - _loadCategoryTree:100\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxview.php - init:196\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - init:114\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - init:55\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - init:278\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000515);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '263.1332336247', 'select oxv_oxvendor_1.oxid, oxv_oxvendor_1.oxshopid, oxv_oxvendor_1.oxshopincl, oxv_oxvendor_1.oxshopexcl, oxv_oxvendor_1.oxactive, oxv_oxvendor_1.oxicon, oxv_oxvendor_1.oxtitle, oxv_oxvendor_1.oxshortdesc from oxv_oxvendor_1 where 1  and oxv_oxvendor_1.oxid = ''''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - assignRecord:594\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxi18n.php - load:187\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - load:382\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_categories.php - getActVendor:180\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxview.php - render:343\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - render:253\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - render:75\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000481);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '120.1459038012', 'select * from oxcontents where oxactive = ''1'' and oxtype = ''1'' and oxsnippet = ''0'' and oxshopid = ''1''  order by oxloadid', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontentlist.php - selectString:82\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontentlist.php - _loadMenue:43\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_utils.php - loadMainMenulist:262\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxview.php - render:343\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - render:253\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - render:75\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000650);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1150.1385519856', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxactions2article\r\n                              left join oxv_oxarticles_1 on oxv_oxarticles_1.oxid = oxactions2article.oxartid\r\n                              where oxactions2article.oxshopid = ''1'' and oxactions2article.oxactionid = ''oxstart''\r\n                              and oxv_oxarticles_1.oxid is not null and (   oxv_oxarticles_1.oxactive = 1  and ( oxv_oxarticles_1.oxstockflag != 2 or ( oxv_oxarticles_1.oxstock + oxv_oxarticles_1.oxvarstock ) > 0  )  ) \r\n                              order by oxactions2article.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:83\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000420);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-714977504', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2080''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:83\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.001893);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1387.1677389222', 'select oxv_oxdiscount_1.oxid, oxv_oxdiscount_1.oxshopid, oxv_oxdiscount_1.oxshopincl, oxv_oxdiscount_1.oxshopexcl, oxv_oxdiscount_1.oxactive, oxv_oxdiscount_1.oxactivefrom, oxv_oxdiscount_1.oxactiveto, oxv_oxdiscount_1.oxtitle, oxv_oxdiscount_1.oxamount, oxv_oxdiscount_1.oxamountto, oxv_oxdiscount_1.oxpriceto, oxv_oxdiscount_1.oxprice, oxv_oxdiscount_1.oxaddsumtype, oxv_oxdiscount_1.oxaddsum, oxv_oxdiscount_1.oxitmartid, oxv_oxdiscount_1.oxitmamount, oxv_oxdiscount_1.oxitmmultiple from oxv_oxdiscount_1 where (   oxv_oxdiscount_1.oxactive = 1  or  ( oxv_oxdiscount_1.oxactivefrom < ''2008-07-10 14:56:19'' and oxv_oxdiscount_1.oxactiveto > ''2008-07-10 14:56:19'' ) )  and (\r\n            select\r\n                if(EXISTS(select 1 from oxobject2discount where oxobject2discount.OXDISCOUNTID=oxv_oxdiscount_1.OXID and oxobject2discount.oxtype=''oxcountry'' LIMIT 1),\r\n                        0,\r\n                        1) &&\r\n                if(EXISTS(select 1 from oxobject2discount where oxobject2discount.OXDISCOUNTID=oxv_oxdiscount_1.OXID and oxobject2discount.oxtype=''oxuser'' LIMIT 1),\r\n                        0,\r\n                        1) &&\r\n                if(EXISTS(select 1 from oxobject2discount where oxobject2discount.OXDISCOUNTID=oxv_oxdiscount_1.OXID and oxobject2discount.oxtype=''oxgroups'' LIMIT 1),\r\n                        0,\r\n                        1)\r\n            )', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxdiscountlist.php - selectString:93\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxdiscountlist.php - _getList:198\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getArticleDiscounts:1506\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:83\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.001790);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-1108796114', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1651''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:83\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000540);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1153.104844907', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxactions2article\r\n                              left join oxv_oxarticles_1 on oxv_oxarticles_1.oxid = oxactions2article.oxartid\r\n                              where oxactions2article.oxshopid = ''1'' and oxactions2article.oxactionid = ''oxtopstart''\r\n                              and oxv_oxarticles_1.oxid is not null and (   oxv_oxarticles_1.oxactive = 1  and ( oxv_oxarticles_1.oxstockflag != 2 or ( oxv_oxarticles_1.oxstock + oxv_oxarticles_1.oxvarstock ) > 0  )  ) \r\n                              order by oxactions2article.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:89\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000535);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '714.-246523717', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxv_oxarticles_1 where  oxv_oxarticles_1.oxparentid =''2275''  order by oxv_oxarticles_1.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:89\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000594);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.-753236205', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2275-01''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:89\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000390);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.-1782009225', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2275-02''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:89\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000653);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1988790730', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2275''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:89\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000338);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1151.640344170', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxactions2article\r\n                              left join oxv_oxarticles_1 on oxv_oxarticles_1.oxid = oxactions2article.oxartid\r\n                              where oxactions2article.oxshopid = ''1'' and oxactions2article.oxactionid = ''oxnewest''\r\n                              and oxv_oxarticles_1.oxid is not null and (   oxv_oxarticles_1.oxactive = 1  and ( oxv_oxarticles_1.oxstockflag != 2 or ( oxv_oxarticles_1.oxstock + oxv_oxarticles_1.oxvarstock ) > 0  )  ) \r\n                              order by oxactions2article.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000439);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1736085756', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2176''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000373);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1523285024', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2177''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000693);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1470176859', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1873''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000366);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '714.1394590409', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxv_oxarticles_1 where  oxv_oxarticles_1.oxparentid =''2041''  order by oxv_oxarticles_1.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000423);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.182919496', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2041-01''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000391);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.1278546988', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2041-02''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000744);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.1904539888', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2041-03''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000402);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.432502893', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2041''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000429);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1152.1778781721', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxactions2article\r\n                              left join oxv_oxarticles_1 on oxv_oxarticles_1.oxid = oxactions2article.oxartid\r\n                              where oxactions2article.oxshopid = ''1'' and oxactions2article.oxactionid = ''oxbargain''\r\n                              and oxv_oxarticles_1.oxid is not null and (   oxv_oxarticles_1.oxactive = 1  and ( oxv_oxarticles_1.oxstockflag != 2 or ( oxv_oxarticles_1.oxstock + oxv_oxarticles_1.oxvarstock ) > 0  )  ) \r\n                              order by oxactions2article.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000423);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1021317265', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2026''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000357);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.559528331', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2092''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000528);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-1000125947', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2264''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000456);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '714.-1043990909', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxv_oxarticles_1 where  oxv_oxarticles_1.oxparentid =''1661''  order by oxv_oxarticles_1.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000441);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '69.-174572396', 'UPDATE oxarticles SET oxicon = ''nopic_ico.jpg'' WHERE oxid = ''1661-01''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2643\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _getIcon:3093\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPictureValues:717\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000609);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.103973967', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1661-01''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000325);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.1088467243', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1661-02''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000607);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-143627686', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1661''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000360);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-968205458', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2108''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000352);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1056600109', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1672''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000396);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1149.-544924683', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxactions2article\r\n                              left join oxv_oxarticles_1 on oxv_oxarticles_1.oxid = oxactions2article.oxartid\r\n                              where oxactions2article.oxshopid = ''1'' and oxactions2article.oxactionid = ''oxtop5''\r\n                              and oxv_oxarticles_1.oxid is not null and (   oxv_oxarticles_1.oxactive = 1  and ( oxv_oxarticles_1.oxstockflag != 2 or ( oxv_oxarticles_1.oxstock + oxv_oxarticles_1.oxvarstock ) > 0  )  ) \r\n                              order by oxactions2article.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadTop5Articles:483\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000654);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-2017846536', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2028''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadTop5Articles:483\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000460);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.595703027', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2219''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadTop5Articles:483\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000438);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-1663614473', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1876''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadTop5Articles:483\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000368);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.45003411', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1131''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadTop5Articles:483\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000447);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-70728091', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1431''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadTop5Articles:483\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000545);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1038293908', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1126''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadTop5Articles:483\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000360);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1155.930342098', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxactions2article\r\n                              left join oxv_oxarticles_1 on oxv_oxarticles_1.oxid = oxactions2article.oxartid\r\n                              where oxactions2article.oxshopid = ''1'' and oxactions2article.oxactionid = ''oxfirststart''\r\n                              and oxv_oxarticles_1.oxid is not null and (   oxv_oxarticles_1.oxactive = 1  and ( oxv_oxarticles_1.oxstockflag != 2 or ( oxv_oxarticles_1.oxstock + oxv_oxarticles_1.oxvarstock ) > 0  )  ) \r\n                              order by oxactions2article.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:108\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000403);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '714.905332154', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxv_oxarticles_1 where  oxv_oxarticles_1.oxparentid =''2363''  order by oxv_oxarticles_1.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:108\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000571);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '69.1408190384', 'UPDATE oxarticles SET oxicon = ''nopic_ico.jpg'' WHERE oxid = ''2363-01''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2643\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _getIcon:3093\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPictureValues:717\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:108\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000882);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.354150646', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2363-01''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:108\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000473);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '69.2025985139', 'UPDATE oxarticles SET oxicon = ''nopic_ico.jpg'' WHERE oxid = ''2363-02''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2643\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _getIcon:3093\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPictureValues:717\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:108\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000627);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.1405738386', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2363-02''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:108\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000383);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-263727648', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2363''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:108\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000354);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '359.-698190680', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxstartmetakeywords'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadByIdent:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - setMetaKeywords:117\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000455);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '362.-1666702906', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxstartmetadescription'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadByIdent:174\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - setMetaDescription:118\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000474);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1153.774512529', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxactions2article\r\n                              left join oxv_oxarticles_1 on oxv_oxarticles_1.oxid = oxactions2article.oxartid\r\n                              where oxactions2article.oxshopid = ''1'' and oxactions2article.oxactionid = ''oxcatoffer''\r\n                              and oxv_oxarticles_1.oxid is not null and (   oxv_oxarticles_1.oxactive = 1  and ( oxv_oxarticles_1.oxstockflag != 2 or ( oxv_oxarticles_1.oxstock + oxv_oxarticles_1.oxvarstock ) > 0  )  ) \r\n                              order by oxactions2article.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:124\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000808);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1150249432', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1351''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:124\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000779);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '714.751723927', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxv_oxarticles_1 where  oxv_oxarticles_1.oxparentid =''2278''  order by oxv_oxarticles_1.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:124\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000433);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.1618949523', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2278-01''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:124\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000418);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.648872183', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2278-02''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:124\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000579);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.454880299', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2278-03''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:124\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000713);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-1962756409', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2278''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:124\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000354);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '415.-900366194', 'select oxv_oxcategories_1.* from oxv_oxobject2category_1 as oxobject2category left join oxv_oxcategories_1 on\r\n                         oxv_oxcategories_1.oxid = oxobject2category.oxcatnid\r\n                         where oxobject2category.oxobjectid=''1351'' and oxv_oxcategories_1.oxid is not null  and (  oxv_oxcategories_1.oxactive = 1  and  oxv_oxcategories_1.oxhidden = ''0''  )  order by oxobject2category.oxtime ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - assignRecord:1174\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - getCategory:127\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000483);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '415.-1143641712', 'select oxv_oxcategories_1.* from oxv_oxobject2category_1 as oxobject2category left join oxv_oxcategories_1 on\r\n                         oxv_oxcategories_1.oxid = oxobject2category.oxcatnid\r\n                         where oxobject2category.oxobjectid=''2278'' and oxv_oxcategories_1.oxid is not null  and (  oxv_oxcategories_1.oxactive = 1  and  oxv_oxcategories_1.oxhidden = ''0''  )  order by oxobject2category.oxtime ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - assignRecord:1174\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - getCategory:127\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000428);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:20', '354.901546263', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxstartwelcome'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/plugins/function.oxcontent.php - loadByIdent:28\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%FF^FF3^FF38A491%%inc_wellcomeitem.tpl.php - smarty_function_oxcontent:8\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1873\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%18^186^186A9544%%start.tpl.php - _smarty_include:22\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1265\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - fetch:347\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000441);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:20', '352.-1663279065', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxfirststart'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/plugins/function.oxcontent.php - loadByIdent:28\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%18^186^186A9544%%start.tpl.php - smarty_function_oxcontent:40\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1265\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - fetch:347\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000907);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:20', '352.-1663279065', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxfirststart'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/plugins/function.oxcontent.php - loadByIdent:28\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%18^186^186A9544%%start.tpl.php - smarty_function_oxcontent:42\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1265\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - fetch:347\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000450);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:20', '349.7452504', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxbargain'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/plugins/function.oxcontent.php - loadByIdent:28\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%0F^0F5^0F56EDBA%%inc_rightitem.tpl.php - smarty_function_oxcontent:76\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1873\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%5E^5E6^5E655575%%inc_footer.tpl.php - _smarty_include:8\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1873\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%18^186^186A9544%%start.tpl.php - _smarty_include:163\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1265\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - fetch:347\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000440);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:20', '349.7452504', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxbargain'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/plugins/function.oxcontent.php - loadByIdent:28\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%0F^0F5^0F56EDBA%%inc_rightitem.tpl.php - smarty_function_oxcontent:79\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1873\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%5E^5E6^5E655575%%inc_footer.tpl.php - _smarty_include:8\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1873\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%18^186^186A9544%%start.tpl.php - _smarty_include:163\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1265\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - fetch:347\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000423);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:20', '351.-27655666', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxstdfooter'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/plugins/function.oxcontent.php - loadByIdent:28\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%5E^5E6^5E655575%%inc_footer.tpl.php - smarty_function_oxcontent:84\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1873\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%18^186^186A9544%%start.tpl.php - _smarty_include:163\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1265\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - fetch:347\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000425);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '27.1994821062', 'SET @@session.sql_mode = ""', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxdb.php - Execute:208\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - getDb:973\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - _isValidShopId:934\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - getShopId:528\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000282);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '121.1325328432', 'select oxvarname, oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - _loadVarsFromDb:531\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000664);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '190.-2004035283', 'select oxvarname, oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1'' and oxvarname in ( "blMallUsers", "aSerials", "IMD", "IMA", "IMS" ) ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - _loadVarsFromDb:536\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000763);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '132.-1788992125', 'select oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1'' and oxvarname = ''IMS''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:1789\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - getConfVar:227\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - pageStart:37\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - appInit:639\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000615);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '132.-1864523499', 'select oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1'' and oxvarname = ''IMD''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:1789\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - getConfVar:228\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - pageStart:37\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - appInit:639\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000433);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '132.-307604144', 'select oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1'' and oxvarname = ''IMA''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:1789\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - getConfVar:229\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - pageStart:37\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - appInit:639\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000605);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '137.-48677512', 'select oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1'' and oxvarname = ''aSerials''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:1789\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - getConfVar:230\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - pageStart:37\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - appInit:639\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000524);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '138.-1484902309', 'select oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1'' and oxvarname = ''blBackTag''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:1789\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - getConfVar:231\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - pageStart:37\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - appInit:639\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000708);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '137.1175458748', 'select oxvartype, DECODE( oxvarvalue, ''fq45QS09_fqyx09239QQ'') as oxvarvalue from oxconfig where oxshopid = ''1'' and oxvarname = ''sTagList''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - Execute:1789\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - getConfVar:232\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxstart.php - pageStart:37\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - appInit:639\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - init:660\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - getInstance:84\n', 0.000459);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1052.2025238739', 'select oxshops.oxid, oxshops.oxparentid, oxshops.oxactive, oxshops.oxisinherited, oxshops.oxismultishop, oxshops.oxissupershop, oxshops.oxproductive, oxshops.oxdefcurrency, oxshops.oxdeflanguage, oxshops.oxname, oxshops.oxtitleprefix, oxshops.oxtitlesuffix, oxshops.oxinfoemail, oxshops.oxorderemail, oxshops.oxowneremail, oxshops.oxordersubject, oxshops.oxregistersubject, oxshops.oxforgotpwdsubject, oxshops.oxsendednowsubject, oxshops.oxsmtp, oxshops.oxsmtpuser, oxshops.oxsmtppwd, oxshops.oxserial, oxshops.oxcompany, oxshops.oxstreet, oxshops.oxzip, oxshops.oxcity, oxshops.oxcountry, oxshops.oxbankname, oxshops.oxbanknumber, oxshops.oxbankcode, oxshops.oxvatnumber, oxshops.oxbiccode, oxshops.oxibannumber, oxshops.oxfname, oxshops.oxlname, oxshops.oxtelefon, oxshops.oxtelefax, oxshops.oxurl, oxshops.oxdefcat, oxshops.oxhrbnr, oxshops.oxcourt, oxshops.oxadbutlerid, oxshops.oxaffilinetid, oxshops.oxsuperclicksid, oxshops.oxaffiliweltid, oxshops.oxaffili24id, oxshops.oxversion, oxshops.oxseoactive from oxshops where 1  and oxshops.oxid = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - assignRecord:594\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxi18n.php - load:187\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxconfig.php - load:1895\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxutils.php - getActiveShop:665\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - seoIsActive:50\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - init:278\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000897);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '328.572479759', 'select oxv_oxvendor_1.oxid, oxv_oxvendor_1.oxshopid, oxv_oxvendor_1.oxshopincl, oxv_oxvendor_1.oxshopexcl, oxv_oxvendor_1.oxactive, oxv_oxvendor_1.oxicon, oxv_oxvendor_1.oxtitle, oxv_oxvendor_1.oxshortdesc from oxv_oxvendor_1  where  oxv_oxvendor_1.oxactive = 1  and oxv_oxvendor_1.oxtitle != ''''  order by oxv_oxvendor_1.oxtitle', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxvendorlist.php - selectString:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxvendorlist.php - loadVendorList:115\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_categories.php - buildVendorTree:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_categories.php - _loadVendorTree:96\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxview.php - init:196\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - init:114\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - init:55\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - init:278\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000395);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '871.-1839749580', 'select oxv_oxcategories_1.oxid, oxv_oxcategories_1.oxparentid, oxv_oxcategories_1.oxleft, oxv_oxcategories_1.oxright, oxv_oxcategories_1.oxrootid, oxv_oxcategories_1.oxsort, oxv_oxcategories_1.oxactive, oxv_oxcategories_1.oxhidden, oxv_oxcategories_1.oxshopid, oxv_oxcategories_1.oxshopincl, oxv_oxcategories_1.oxshopexcl, oxv_oxcategories_1.oxtitle, oxv_oxcategories_1.oxdesc, oxv_oxcategories_1.oxlongdesc, oxv_oxcategories_1.oxthumb, oxv_oxcategories_1.oxextlink, oxv_oxcategories_1.oxtemplate, oxv_oxcategories_1.oxdefsort, oxv_oxcategories_1.oxdefsortmode, oxv_oxcategories_1.oxpricefrom, oxv_oxcategories_1.oxpriceto, oxv_oxcategories_1.oxicon, oxv_oxcategories_1.oxvat, oxv_oxcategories_1.oxskipdiscounts,not ( 1  and oxv_oxcategories_1.oxactive) as remove from oxv_oxcategories_1 where  1  order by oxv_oxcategories_1.oxrootid desc, oxv_oxcategories_1.oxleft desc', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcategorylist.php - selectString:209\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_categories.php - buildTree:126\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_categories.php - _loadCategoryTree:100\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxview.php - init:196\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - init:114\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - init:55\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - init:278\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000536);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '143.-321273588', 'select * from oxcontents where oxactive = ''1'' and oxtype = ''2'' and oxsnippet = ''0'' and oxshopid = ''1'' and oxcatid is not null order by oxloadid', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontentlist.php - selectString:82\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontentlist.php - _loadMenue:53\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcategorylist.php - loadCatMenues:377\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcategorylist.php - _ppAddContentCategories:220\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_categories.php - buildTree:126\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_categories.php - _loadCategoryTree:100\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxview.php - init:196\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - init:114\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - init:55\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - init:278\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000515);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '263.1332336247', 'select oxv_oxvendor_1.oxid, oxv_oxvendor_1.oxshopid, oxv_oxvendor_1.oxshopincl, oxv_oxvendor_1.oxshopexcl, oxv_oxvendor_1.oxactive, oxv_oxvendor_1.oxicon, oxv_oxvendor_1.oxtitle, oxv_oxvendor_1.oxshortdesc from oxv_oxvendor_1 where 1  and oxv_oxvendor_1.oxid = ''''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - assignRecord:594\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxi18n.php - load:187\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - load:382\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_categories.php - getActVendor:180\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxview.php - render:343\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - render:253\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - render:75\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000481);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '120.1459038012', 'select * from oxcontents where oxactive = ''1'' and oxtype = ''1'' and oxsnippet = ''0'' and oxshopid = ''1''  order by oxloadid', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontentlist.php - selectString:82\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontentlist.php - _loadMenue:43\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxcmp_utils.php - loadMainMenulist:262\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxview.php - render:343\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - render:253\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - render:75\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000650);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1150.1385519856', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxactions2article\r\n                              left join oxv_oxarticles_1 on oxv_oxarticles_1.oxid = oxactions2article.oxartid\r\n                              where oxactions2article.oxshopid = ''1'' and oxactions2article.oxactionid = ''oxstart''\r\n                              and oxv_oxarticles_1.oxid is not null and (   oxv_oxarticles_1.oxactive = 1  and ( oxv_oxarticles_1.oxstockflag != 2 or ( oxv_oxarticles_1.oxstock + oxv_oxarticles_1.oxvarstock ) > 0  )  ) \r\n                              order by oxactions2article.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:83\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000420);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-714977504', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2080''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:83\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.001893);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1387.1677389222', 'select oxv_oxdiscount_1.oxid, oxv_oxdiscount_1.oxshopid, oxv_oxdiscount_1.oxshopincl, oxv_oxdiscount_1.oxshopexcl, oxv_oxdiscount_1.oxactive, oxv_oxdiscount_1.oxactivefrom, oxv_oxdiscount_1.oxactiveto, oxv_oxdiscount_1.oxtitle, oxv_oxdiscount_1.oxamount, oxv_oxdiscount_1.oxamountto, oxv_oxdiscount_1.oxpriceto, oxv_oxdiscount_1.oxprice, oxv_oxdiscount_1.oxaddsumtype, oxv_oxdiscount_1.oxaddsum, oxv_oxdiscount_1.oxitmartid, oxv_oxdiscount_1.oxitmamount, oxv_oxdiscount_1.oxitmmultiple from oxv_oxdiscount_1 where (   oxv_oxdiscount_1.oxactive = 1  or  ( oxv_oxdiscount_1.oxactivefrom < ''2008-07-10 14:56:19'' and oxv_oxdiscount_1.oxactiveto > ''2008-07-10 14:56:19'' ) )  and (\r\n            select\r\n                if(EXISTS(select 1 from oxobject2discount where oxobject2discount.OXDISCOUNTID=oxv_oxdiscount_1.OXID and oxobject2discount.oxtype=''oxcountry'' LIMIT 1),\r\n                        0,\r\n                        1) &&\r\n                if(EXISTS(select 1 from oxobject2discount where oxobject2discount.OXDISCOUNTID=oxv_oxdiscount_1.OXID and oxobject2discount.oxtype=''oxuser'' LIMIT 1),\r\n                        0,\r\n                        1) &&\r\n                if(EXISTS(select 1 from oxobject2discount where oxobject2discount.OXDISCOUNTID=oxv_oxdiscount_1.OXID and oxobject2discount.oxtype=''oxgroups'' LIMIT 1),\r\n                        0,\r\n                        1)\r\n            )', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxdiscountlist.php - selectString:93\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxdiscountlist.php - _getList:198\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getArticleDiscounts:1506\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:83\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.001790);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-1108796114', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1651''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:83\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000540);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1153.104844907', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxactions2article\r\n                              left join oxv_oxarticles_1 on oxv_oxarticles_1.oxid = oxactions2article.oxartid\r\n                              where oxactions2article.oxshopid = ''1'' and oxactions2article.oxactionid = ''oxtopstart''\r\n                              and oxv_oxarticles_1.oxid is not null and (   oxv_oxarticles_1.oxactive = 1  and ( oxv_oxarticles_1.oxstockflag != 2 or ( oxv_oxarticles_1.oxstock + oxv_oxarticles_1.oxvarstock ) > 0  )  ) \r\n                              order by oxactions2article.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:89\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000535);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '714.-246523717', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxv_oxarticles_1 where  oxv_oxarticles_1.oxparentid =''2275''  order by oxv_oxarticles_1.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:89\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000594);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.-753236205', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2275-01''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:89\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000390);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.-1782009225', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2275-02''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:89\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000653);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1988790730', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2275''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:89\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000338);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1151.640344170', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxactions2article\r\n                              left join oxv_oxarticles_1 on oxv_oxarticles_1.oxid = oxactions2article.oxartid\r\n                              where oxactions2article.oxshopid = ''1'' and oxactions2article.oxactionid = ''oxnewest''\r\n                              and oxv_oxarticles_1.oxid is not null and (   oxv_oxarticles_1.oxactive = 1  and ( oxv_oxarticles_1.oxstockflag != 2 or ( oxv_oxarticles_1.oxstock + oxv_oxarticles_1.oxvarstock ) > 0  )  ) \r\n                              order by oxactions2article.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000439);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1736085756', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2176''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000373);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1523285024', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2177''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000693);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1470176859', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1873''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000366);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '714.1394590409', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxv_oxarticles_1 where  oxv_oxarticles_1.oxparentid =''2041''  order by oxv_oxarticles_1.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000423);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.182919496', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2041-01''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000391);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.1278546988', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2041-02''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000744);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.1904539888', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2041-03''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000402);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.432502893', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2041''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:148\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadNewestArticles:98\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000429);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1152.1778781721', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxactions2article\r\n                              left join oxv_oxarticles_1 on oxv_oxarticles_1.oxid = oxactions2article.oxartid\r\n                              where oxactions2article.oxshopid = ''1'' and oxactions2article.oxactionid = ''oxbargain''\r\n                              and oxv_oxarticles_1.oxid is not null and (   oxv_oxarticles_1.oxactive = 1  and ( oxv_oxarticles_1.oxstockflag != 2 or ( oxv_oxarticles_1.oxstock + oxv_oxarticles_1.oxvarstock ) > 0  )  ) \r\n                              order by oxactions2article.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000423);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1021317265', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2026''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000357);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.559528331', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2092''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000528);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-1000125947', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2264''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000456);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '714.-1043990909', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxv_oxarticles_1 where  oxv_oxarticles_1.oxparentid =''1661''  order by oxv_oxarticles_1.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000441);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '69.-174572396', 'UPDATE oxarticles SET oxicon = ''nopic_ico.jpg'' WHERE oxid = ''1661-01''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2643\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _getIcon:3093\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPictureValues:717\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000609);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.103973967', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1661-01''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000325);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.1088467243', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1661-02''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000607);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-143627686', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1661''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000360);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-968205458', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2108''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000352);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1056600109', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1672''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadAktionArticles:475\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000396);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1149.-544924683', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxactions2article\r\n                              left join oxv_oxarticles_1 on oxv_oxarticles_1.oxid = oxactions2article.oxartid\r\n                              where oxactions2article.oxshopid = ''1'' and oxactions2article.oxactionid = ''oxtop5''\r\n                              and oxv_oxarticles_1.oxid is not null and (   oxv_oxarticles_1.oxactive = 1  and ( oxv_oxarticles_1.oxstockflag != 2 or ( oxv_oxarticles_1.oxstock + oxv_oxarticles_1.oxvarstock ) > 0  )  ) \r\n                              order by oxactions2article.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadTop5Articles:483\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000654);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-2017846536', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2028''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadTop5Articles:483\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000460);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.595703027', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2219''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadTop5Articles:483\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000438);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-1663614473', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1876''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadTop5Articles:483\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000368);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.45003411', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1131''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadTop5Articles:483\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000447);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-70728091', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1431''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadTop5Articles:483\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000545);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1038293908', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1126''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - loadAktionArticles:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxubase.php - loadTop5Articles:483\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - _loadActions:104\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000360);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1155.930342098', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxactions2article\r\n                              left join oxv_oxarticles_1 on oxv_oxarticles_1.oxid = oxactions2article.oxartid\r\n                              where oxactions2article.oxshopid = ''1'' and oxactions2article.oxactionid = ''oxfirststart''\r\n                              and oxv_oxarticles_1.oxid is not null and (   oxv_oxarticles_1.oxactive = 1  and ( oxv_oxarticles_1.oxstockflag != 2 or ( oxv_oxarticles_1.oxstock + oxv_oxarticles_1.oxvarstock ) > 0  )  ) \r\n                              order by oxactions2article.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:108\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000403);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '714.905332154', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxv_oxarticles_1 where  oxv_oxarticles_1.oxparentid =''2363''  order by oxv_oxarticles_1.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:108\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000571);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '69.1408190384', 'UPDATE oxarticles SET oxicon = ''nopic_ico.jpg'' WHERE oxid = ''2363-01''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2643\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _getIcon:3093\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPictureValues:717\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:108\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000882);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.354150646', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2363-01''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:108\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000473);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '69.2025985139', 'UPDATE oxarticles SET oxicon = ''nopic_ico.jpg'' WHERE oxid = ''2363-02''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2643\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _getIcon:3093\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPictureValues:717\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:108\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000627);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.1405738386', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2363-02''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:108\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000383);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-263727648', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2363''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:108\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000354);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '359.-698190680', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxstartmetakeywords'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadByIdent:193\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - setMetaKeywords:117\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000455);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '362.-1666702906', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxstartmetadescription'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadByIdent:174\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - setMetaDescription:118\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000474);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '1153.774512529', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxactions2article\r\n                              left join oxv_oxarticles_1 on oxv_oxarticles_1.oxid = oxactions2article.oxartid\r\n                              where oxactions2article.oxshopid = ''1'' and oxactions2article.oxactionid = ''oxcatoffer''\r\n                              and oxv_oxarticles_1.oxid is not null and (   oxv_oxarticles_1.oxactive = 1  and ( oxv_oxarticles_1.oxstockflag != 2 or ( oxv_oxarticles_1.oxstock + oxv_oxarticles_1.oxvarstock ) > 0  )  ) \r\n                              order by oxactions2article.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:124\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000808);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.1150249432', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''1351''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:124\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000779);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '714.751723927', 'select oxv_oxarticles_1.oxid, oxv_oxarticles_1.oxtitle, oxv_oxarticles_1.oxparentid, oxv_oxarticles_1.oxvarcount, oxv_oxarticles_1.oxvarstock, oxv_oxarticles_1.oxicon, oxv_oxarticles_1.oxstock, oxv_oxarticles_1.oxstockflag, oxv_oxarticles_1.oxshopid, oxv_oxarticles_1.oxprice, oxv_oxarticles_1.oxvat, oxv_oxarticles_1.oxskipdiscounts, oxv_oxarticles_1.oxunitquantity, oxv_oxarticles_1.oxthumb, oxv_oxarticles_1.oxactive, oxv_oxarticles_1.oxunitname, oxv_oxarticles_1.oxvarselect, oxv_oxarticles_1.oxartnum, oxv_oxarticles_1.oxvarname, oxv_oxarticles_1.oxpic1, oxv_oxarticles_1.oxshortdesc, oxv_oxarticles_1.oxtprice from oxv_oxarticles_1 where  oxv_oxarticles_1.oxparentid =''2278''  order by oxv_oxarticles_1.oxsort', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - Execute:387\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:124\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000433);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.1618949523', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2278-01''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:124\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000418);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.648872183', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2278-02''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:124\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000579);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '214.454880299', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2278-03''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - selectString:1086\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getVariants:3058\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignParentFieldValues:715\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:124\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000713);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '211.-1962756409', 'SELECT oxid, oxaddabs, oxaddperc, oxamount, oxamountto\r\n                    FROM oxprice2article\r\n                    WHERE\r\n                        oxartid = ''2278''\r\n                         and oxshopid = ''1'' ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - Execute:2328\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _modifyAmountPrice:1443\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getBasePrice:1486\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - getPrice:3221\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - _assignPrices:720\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxlist.php - assign:407\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:87\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticlelist.php - selectString:235\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - loadAktionArticles:124\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000354);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '415.-900366194', 'select oxv_oxcategories_1.* from oxv_oxobject2category_1 as oxobject2category left join oxv_oxcategories_1 on\r\n                         oxv_oxcategories_1.oxid = oxobject2category.oxcatnid\r\n                         where oxobject2category.oxobjectid=''1351'' and oxv_oxcategories_1.oxid is not null  and (  oxv_oxcategories_1.oxactive = 1  and  oxv_oxcategories_1.oxhidden = ''0''  )  order by oxobject2category.oxtime ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - assignRecord:1174\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - getCategory:127\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000483);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:19', '415.-1143641712', 'select oxv_oxcategories_1.* from oxv_oxobject2category_1 as oxobject2category left join oxv_oxcategories_1 on\r\n                         oxv_oxcategories_1.oxid = oxobject2category.oxcatnid\r\n                         where oxobject2category.oxobjectid=''2278'' and oxv_oxcategories_1.oxid is not null  and (  oxv_oxcategories_1.oxactive = 1  and  oxv_oxcategories_1.oxhidden = ''0''  )  order by oxobject2category.oxtime ', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxarticle.php - assignRecord:1174\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/start.php - getCategory:127\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - render:308\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000428);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:20', '354.901546263', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxstartwelcome'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/plugins/function.oxcontent.php - loadByIdent:28\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%FF^FF3^FF38A491%%inc_wellcomeitem.tpl.php - smarty_function_oxcontent:8\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1873\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%18^186^186A9544%%start.tpl.php - _smarty_include:22\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1265\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - fetch:347\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000441);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:20', '352.-1663279065', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxfirststart'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/plugins/function.oxcontent.php - loadByIdent:28\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%18^186^186A9544%%start.tpl.php - smarty_function_oxcontent:40\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1265\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - fetch:347\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000907);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:20', '352.-1663279065', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxfirststart'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/plugins/function.oxcontent.php - loadByIdent:28\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%18^186^186A9544%%start.tpl.php - smarty_function_oxcontent:42\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1265\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - fetch:347\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000450);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:20', '349.7452504', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxbargain'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/plugins/function.oxcontent.php - loadByIdent:28\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%0F^0F5^0F56EDBA%%inc_rightitem.tpl.php - smarty_function_oxcontent:76\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1873\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%5E^5E6^5E655575%%inc_footer.tpl.php - _smarty_include:8\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1873\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%18^186^186A9544%%start.tpl.php - _smarty_include:163\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1265\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - fetch:347\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000440);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:20', '349.7452504', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxbargain'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/plugins/function.oxcontent.php - loadByIdent:28\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%0F^0F5^0F56EDBA%%inc_rightitem.tpl.php - smarty_function_oxcontent:79\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1873\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%5E^5E6^5E655575%%inc_footer.tpl.php - _smarty_include:8\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1873\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%18^186^186A9544%%start.tpl.php - _smarty_include:163\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1265\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - fetch:347\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000423);
INSERT INTO `adodb_logsql` VALUES ('2008-07-10 14:56:20', '351.-27655666', 'select oxcontents.oxid, oxcontents.oxloadid, oxcontents.oxshopid, oxcontents.oxsnippet, oxcontents.oxtype, oxcontents.oxactive, oxcontents.oxposition, oxcontents.oxtitle, oxcontents.oxcontent, oxcontents.oxcatid, oxcontents.oxfolder, oxcontents.oxtimestamp from oxcontents where 1  and oxcontents.oxloadid = ''oxstdfooter'' and oxcontents.oxactive = ''1''', '', '<br>eshop-linux/index.php\n\nBacktrace:\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/adodblite/adodb.inc.php - adodb_log_sql:314\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxbase.php - Execute:649\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/oxcontent.php - assignRecord:119\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/plugins/function.oxcontent.php - loadByIdent:28\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%5E^5E6^5E655575%%inc_footer.tpl.php - smarty_function_oxcontent:84\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1873\n/mnt/hgfs/htdocs/oxideshop/eshop/source/tmp_ubuntu/1.0^%%18^186^186A9544%%start.tpl.php - _smarty_include:163\n/mnt/hgfs/htdocs/oxideshop/eshop/source/core/smarty/Smarty.class.php - include:1265\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - fetch:347\n/mnt/hgfs/htdocs/oxideshop/eshop/source/views/oxshopcontrol.php - _process:77\n/mnt/hgfs/htdocs/oxideshop/eshop/source/index.php - start:117\n', 0.000425);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxaccessoire2article`
-- 

DROP TABLE IF EXISTS `oxaccessoire2article`;
CREATE TABLE IF NOT EXISTS `oxaccessoire2article` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXARTICLENID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSORT` int(5) NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `OXOBJECTID` (`OXOBJECTID`),
  KEY `OXARTICLENID` (`OXARTICLENID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxaccessoire2article`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxactions`
-- 

DROP TABLE IF EXISTS `oxactions`;
CREATE TABLE IF NOT EXISTS `oxactions` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXTITLE` char(128) collate latin1_general_ci NOT NULL default '',
  `OXACTIVE` tinyint(1) NOT NULL default '1',
  `OXACTIVEFROM` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXACTIVETO` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`OXID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxactions`
-- 

INSERT INTO `oxactions` VALUES ('oxstart', 'Startseite unten', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `oxactions` VALUES ('oxtopstart', 'Topangebot Startseite', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `oxactions` VALUES ('oxfirststart', 'Großes Angebot Startseite', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `oxactions` VALUES ('oxbargain', 'Schnäppchen', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `oxactions` VALUES ('oxtop5', 'Topseller', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `oxactions` VALUES ('oxcatoffer', 'Kategorien-Topangebot', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `oxactions` VALUES ('oxnewest', 'Frisch eingetroffen', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxactions2article`
-- 

DROP TABLE IF EXISTS `oxactions2article`;
CREATE TABLE IF NOT EXISTS `oxactions2article` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXACTIONID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXARTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSORT` int(11) NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `OXMAINIDX` (`OXSHOPID`,`OXACTIONID`,`OXSORT`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxactions2article`
-- 

INSERT INTO `oxactions2article` VALUES ('d8842e3c913930f47.00463447', 1, 'oxstart', '2077', 0);
INSERT INTO `oxactions2article` VALUES ('d8842e3c8eb4b7095.65397492', 1, 'oxstart', '1651', 1);
INSERT INTO `oxactions2article` VALUES ('79042e787800a8465.75238508', 1, 'oxbargain', '85b42c94a32b3fdd2.66642220', 0);
INSERT INTO `oxactions2article` VALUES ('38c44b659cd3d2e76.79391364', 1, 'oxtop5', '2028', 0);
INSERT INTO `oxactions2article` VALUES ('d1744acb227e74050.43822729', 1, 'oxbargain', '2026', 0);
INSERT INTO `oxactions2article` VALUES ('9f542c5221ba79456.89971266', 1, 'oxfirststart', '1964', 0);
INSERT INTO `oxactions2article` VALUES ('95842e9fde5c6f051.82672143', 1, 'oxnewest', '1952', 3);
INSERT INTO `oxactions2article` VALUES ('95842e9fdde94e653.04821580', 1, 'oxnewest', 'be642cada8422f150.29332483', 2);
INSERT INTO `oxactions2article` VALUES ('95842e9fdd03b5296.91384984', 1, 'oxnewest', 'd8842e3cb356356f4.93820547', 0);
INSERT INTO `oxactions2article` VALUES ('95842e9fdd770ecf8.14629724', 1, 'oxnewest', '2024', 1);
INSERT INTO `oxactions2article` VALUES ('38c44b65d3a23aa83.76581394', 1, 'oxbargain', '2092', 0);
INSERT INTO `oxactions2article` VALUES ('38c44b65952a15963.37865922', 1, 'oxcatoffer', '1351', 0);
INSERT INTO `oxactions2article` VALUES ('f9c42d5052de14851.06748579', 1, 'oxcatoffer', 'be642cad637adf214.28850610', 0);
INSERT INTO `oxactions2article` VALUES ('78e44b7528a274d21.05772668', 1, 'oxtop5', '2219', 0);
INSERT INTO `oxactions2article` VALUES ('38c44b6597cd2e186.83225308', 1, 'oxtop5', '1876', 0);
INSERT INTO `oxactions2article` VALUES ('38c44b659756d8b06.26814398', 1, 'oxtop5', '1131', 0);
INSERT INTO `oxactions2article` VALUES ('d8842e3ca342c5fb8.21231681', 1, 'oxtop5', '1940', 1);
INSERT INTO `oxactions2article` VALUES ('79042e78791e8ef10.24050762', 1, 'oxbargain', 'd8842e3cbf9290351.59301740', 0);
INSERT INTO `oxactions2article` VALUES ('38c44b657bd7a8ed7.77587037', 1, 'oxnewest', '2176', 0);
INSERT INTO `oxactions2article` VALUES ('38c44b6528272f340.69498456', 1, 'oxnewest', '2177', 0);
INSERT INTO `oxactions2article` VALUES ('38c44b6586e7670d4.51083953', 1, 'oxnewest', '1873', 0);
INSERT INTO `oxactions2article` VALUES ('38c44b659a5680256.85010138', 1, 'oxnewest', '2041', 0);
INSERT INTO `oxactions2article` VALUES ('38c44b6530c9a9ee0.48943185', 1, 'oxcatoffer', '2278', 0);
INSERT INTO `oxactions2article` VALUES ('d1744acb1ff201bf0.49294549', 1, 'oxfirststart', '2363', 0);
INSERT INTO `oxactions2article` VALUES ('38c44b65cf81d4230.58882910', 1, 'oxbargain', '2264', 0);
INSERT INTO `oxactions2article` VALUES ('38c44b6536b1446e2.17112560', 1, 'oxstart', '2080', 0);
INSERT INTO `oxactions2article` VALUES ('38c44b6579a38bf20.36651380', 1, 'oxtopstart', '2275', 0);
INSERT INTO `oxactions2article` VALUES ('78e44b752997a98d2.92863609', 1, 'oxtop5', '1431', 0);
INSERT INTO `oxactions2article` VALUES ('78e44b7529c48bf21.89689609', 1, 'oxtop5', '1126', 0);
INSERT INTO `oxactions2article` VALUES ('78e44b752bf9a43a8.66412748', 1, 'oxbargain', '1661', 0);
INSERT INTO `oxactions2article` VALUES ('78e44b752d12715a7.33665849', 1, 'oxbargain', '2108', 0);
INSERT INTO `oxactions2article` VALUES ('78e44b752dd8ad184.06453263', 1, 'oxbargain', '1672', 0);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxaddress`
-- 

DROP TABLE IF EXISTS `oxaddress`;
CREATE TABLE IF NOT EXISTS `oxaddress` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXUSERID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXADDRESSUSERID` varchar(32) collate latin1_general_ci NOT NULL,
  `OXCOMPANY` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXFNAME` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXLNAME` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSTREET` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSTREETNR` varchar(16) collate latin1_general_ci NOT NULL default '',
  `OXADDINFO` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXCITY` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXCOUNTRY` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXCOUNTRYID` varchar(32) collate latin1_general_ci NOT NULL,
  `OXZIP` varchar(50) collate latin1_general_ci NOT NULL default '',
  `OXFON` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXFAX` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXSAL` varchar(128) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`OXID`),
  KEY `OXUSERID` (`OXUSERID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxaddress`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxadminlog`
-- 

DROP TABLE IF EXISTS `oxadminlog`;
CREATE TABLE IF NOT EXISTS `oxadminlog` (
  `OXDATE` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `OXUSERID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL,
  `OXSESSID` char(40) collate latin1_general_ci NOT NULL,
  `OXCLASS` varchar(50) collate latin1_general_ci NOT NULL,
  `OXFNC` varchar(30) collate latin1_general_ci NOT NULL,
  `OXITMID` char(32) collate latin1_general_ci NOT NULL,
  `OXPARAM` text collate latin1_general_ci NOT NULL,
  `OXSQL` text collate latin1_general_ci NOT NULL,
  KEY `OXITMID` (`OXITMID`),
  KEY `OXUSERID` (`OXUSERID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxadminlog`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxartextends`
-- 

DROP TABLE IF EXISTS `oxartextends`;
CREATE TABLE IF NOT EXISTS `oxartextends` (
  `OXID` char(32) collate latin1_general_ci NOT NULL,
  `OXLONGDESC` text collate latin1_general_ci NOT NULL,
  `OXLONGDESC_1` text collate latin1_general_ci NOT NULL,
  `OXLONGDESC_2` text collate latin1_general_ci NOT NULL,
  `OXLONGDESC_3` text collate latin1_general_ci NOT NULL,
  `OXTAGS` varchar(255) collate latin1_general_ci NOT NULL,
  `OXTAGS_1` varchar(255) collate latin1_general_ci NOT NULL,
  `OXTAGS_2` varchar(255) collate latin1_general_ci NOT NULL,
  `OXTAGS_3` varchar(255) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`OXID`),
  FULLTEXT KEY `OXTAGS` (`OXTAGS`),
  FULLTEXT KEY `OXTAGS_1` (`OXTAGS_1`),
  FULLTEXT KEY `OXTAGS_2` (`OXTAGS_2`),
  FULLTEXT KEY `OXTAGS_3` (`OXTAGS_3`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxartextends`
-- 

INSERT INTO `oxartextends` VALUES ('2177', '<div>\r\n<p></p>\r\n<div>Messerblock mit hochwertigem 5er Edelstahl-Messerset.</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span> <br>\r\n</div>\r\n</div>', '<div>\r\n<p>&nbsp;</p></div>', '', '', 'messerblock hochwertigem 5er_ edelstahl-messersetbezugshinweis', '', '', '');
INSERT INTO `oxartextends` VALUES ('2174', '<div>\r\n<p>Wenn dein Opfer nicht wirklich starke Schmerzen haben soll, aber merken muss, dass er Dich mal Ernst zu nehmen hat, dann sind diese Boxhandschuhe PLÜSCH genau das richtige für Dich. .</p>\r\n<div>\r\n<p></p>\r\n<div>Plüschige Boxhandschuhe in trendigem rosa, weich und zärtlich.</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span> <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'opfer wirklich starke schmerzen soll merken muss dass', '', '', '');
INSERT INTO `oxartextends` VALUES ('2172', '<div>\r\n<p>Das ideale Trainings-Equipment für die Boxhandschuhe PLÜSCH! Mit Einschub für ein Foto, um Deinen Punch zu steigern.</p>\r\n<div>\r\n<p></p>\r\n<div>Höhe: 1,60 m.</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span> <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'ideale trainings-equipment boxhandschuhe plüsch einschub', '', '', '');
INSERT INTO `oxartextends` VALUES ('1436', '<div>\r\n<p>Die Zeiten in denen Mädchen noch so richtig brav waren sind vorbei. Die Zeiten von Kernseife auch. Heute leistet die Washlotion DIRTY GIRL auf rein pflanzlicher Basis, angereichert mit Plankton und Aloe gute Dienste nach dem Ausflug ins Nachtleben.</p>\r\n<div>\r\n<p></p>\r\n<div>Inhalt: 250 ml</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span> <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'zeiten denen mädchen richtig brav vorbei zeiten', '', '', '');
INSERT INTO `oxartextends` VALUES ('2176', '<div>\r\n<p>Dein aufblasbarer und treuer Spielkamarad!</p>\r\n<p>MARVIN ist ferngesteuert und mit einem Walkie-Talkie ausgestattet - deshalb kann er auch sprechen.</p>\r\n<p>Maße: H 72cm, B 40cm</p>\r\n<div>\r\n<p></p>\r\n<div>Info: Batterien 4D und 1x 9V nicht im Lieferumfang enthalten.</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span> <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'aufblasbarer treuer spielkamaradmarvin ferngesteuert', '', '', '');
INSERT INTO `oxartextends` VALUES ('2292', '<div>\r\n<p></p>\r\n<div>Das Set beinhaltet zwei Pistolen und zwei Brustpanzer. Ziel ist es den Gegner per Infrarot-Schuss zu treffen, der Verlierer bekommt durch die Pistole einen leichten, aber harmlosen Stromschlag.</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span> <br>\r\n</div>\r\n</div>', '<div>\r\n<p>Das Set beinhaltet zwei Pistolen und zwei Brustpanzer. Ziel ist es den Gegner per Infrarot-Schuss zu treffen, der Verlierer bekommt durch die Pistole einen leichten, aber harmlosen Stromschlag.</p></div>', '', '', 'set_ beinhaltet zwei pistolen zwei brustpanzer ziel gegner', '', '', '');
INSERT INTO `oxartextends` VALUES ('2219', '<div>\r\n<p>Dieses kleine Buch ist eine »Betriebsanleitung« für Mädchen. Hunderte von Erfahrungen und Ratschlägen werden zu Ihrem Begleiter durch ein ganzes Mädchenleben ? mit Schule und Pickeln, Jungs und Sport, Geld und Autos. Bis zu dem Tag, an dem Sie sie endgültig ziehen lassen müssen...</p>\r\n<p>Vater & Tochter / Buch</p>\r\n<p>320 Seiten, zweifarbig, Broschur, Format 11 x 11 cm</p>\r\n<div>\r\n<p></p>\r\n<div>Autor: Harrison, Harry</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span> <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'kleine buch betriebsanleitung mädchen hunderte erfahrungen', '', '', '');
INSERT INTO `oxartextends` VALUES ('2196', '<div>\r\n<p>Dieses kleine Buch ist so etwas Ähnliches: Hunderte von Erfahrungen und Ratschlägen, praktisch und erprobt, aber auch humorvoll und inspirierend. Es wird sehr bald zu Ihrem unentbehrlichen Erziehungsratgeber werden...</p>\r\n<p>Vater & Sohn / Buch</p>\r\n<p>320 Seiten, zweifarbig, Broschur, Format 11 x 11 cm</p>\r\n<p>Autor: Harrison, Harry</p></div>', '<div>\r\n<p>Dieses kleine Buch ist so etwas Ähnliches: Hunderte von Erfahrungen und Ratschlägen, praktisch und erprobt, aber auch humorvoll und inspirierend. Es wird sehr bald zu Ihrem unentbehrlichen Erziehungsratgeber werden...</p>\r\n<p>&nbsp;</p>\r\n<p>Vater & Sohn / Buch</p>\r\n<p>320 Seiten, zweifarbig, Broschur, Format 11 x 11 cm</p>\r\n<p>Autor: Harrison, Harry</p></div>', '', '', 'kleine buch etwas ähnliches hunderte erfahrungen ratschlägen', '', '', '');
INSERT INTO `oxartextends` VALUES ('2162', '<div>\r\n<p></p>\r\n<div>Gängige Management-Techniken sind dem Mann von heute geläufig, den Job meistert er effizient und erfolgreich. Aber wie sieht´s in den eigenen vier Wänden aus? Endlich ist es da: das ultimative Handbuch für die Managementaufgabe No.1 - DIE HAUSARBEIT! Was bedeuten die Symbole auf den Pflegeetiketten? Wie bügele ich faltenfrei ein Hemd? Und wie bringe ich meine Wohnung schnell auf Vordermann, falls sich spontan Besuch ankündigt? Hier finden sich zahlreiche ungewöhnliche Tipps und Tricks für mehr Ordnung und Effektivität im privaten Bereich- und für die wahren Herausforderungen des modernen Alltags!</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span> <br>\r\n</div>\r\n</div>', '<div>\r\n<p>&nbsp;</p></div>', '', '', 'gängige management-techniken mann heute geläufig job_ meistert', '', '', '');
INSERT INTO `oxartextends` VALUES ('2229', '<div>\r\n<p>Macht aus Deiner Hütte einen glamurösen Salon!</p>\r\n<p>Kronleuchter mit 6 Armen.</p>\r\n<p>Druchmesser: 60 cm</p>\r\n<p>Höhe: 58 cm </p>\r\n<div>\r\n<p></p>\r\n<div>Max. 25 Watt mit 6 Birnen</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span> <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'macht hütte glamurösen salonkronleuchter armendruchmesser', '', '', '');
INSERT INTO `oxartextends` VALUES ('2231', '<div>\r\n<div>\r\n<p>Der absolute Hingucker im Wohnzimmer!</p>\r\n<p>Die Hängeläuchte COSMOS funktioniert mit handelsüblichen Glühbirnen (max. 10 Watt) und ist in 2 unterschiedlichen Grössen lieferbar. </p>\r\n<p>Material: Chrom</p>\r\n<p>Lieferumfang: inkl. 24 Glühbirnen</p></div>\r\n<div>\r\n<div>Variante medium:</div></div>\r\n<div>\r\n<p>Durchmesser 30 cm </p>\r\n<p>Variante large:</p>\r\n<div>Durchmesser 38 cm</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp; <br>\r\n</div></div></div>', '<br>', '', '', 'absolute hingucker wohnzimmerdie hängeläuchte cosmos funktioniert', '', '', '');
INSERT INTO `oxartextends` VALUES ('2275', '<div>\r\n<p>Die Grilltonne BBQ verbreitet coole Harlem-Atmosphäre bei Deiner Grillparty.</p>\r\n<p>Farbe: pink oder hellblau</p>\r\n<p>Material: Stahl</p>\r\n<p>Lieferumfang: Grill, Grillrost, Standhilfe</p>\r\n<div>\r\n<p></p>\r\n<div>Maße: D30cm, H24cm</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp; <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'grilltonne bbq_ verbreitet coole harlem-atmosphäre grillpartyfarbe', '', '', '');
INSERT INTO `oxartextends` VALUES ('2026', '<div>\r\n<p>Grillkoffer ausgestattet mit 18 hochwertigen Accessoires aus Edelstahl. Der leichte, aber robuste Koffer enthält Gabel, Zange, Wender, Pinsel, Messer, 4 Grillspieße, 8 Maiskolbenhalter und eine Reinigungsbürste. Kurz, ein komplettes Set für den Profi-Griller. </p>\r\n<div>\r\n<p></p>\r\n<div>Maße: 50 x 25 x 7 cm.</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp; <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'grillkoffer ausgestattet hochwertigen accessoires edelstahl leichte', '', '', '');
INSERT INTO `oxartextends` VALUES ('2347', '<div>\r\n<p>Die Lust auf das perfekte Fleisch ? El Torro, der ultimative Steaktimer! </p>\r\n<p>Männer, erobert die Küchen!</p>\r\n<p>El Torro ist der Steaktimer zum Mitgrillen. Medium, rare oder Well done? El Torro grillt Ihr Steak auf den Punkt, genau so wie Sie es am Liebsten haben! Natürlich funktioniert El Torro etwas anders als andere Küchengeräte!</p>\r\n<p>Ein Temperatursensor für die Grill- bzw. Brattemperatur misst die Temperatur der Pfanne oder des Grills. Aus dieser Außentemperatur wird über eine Differentialgleichung die Innentemperatur im Fleisch berechnet.</p>\r\n<p>Einfach Fleischdicke und Garungsart einstellen und dann ab in die Pfanne. Wenn das Fleisch den gewünschten Garungsgrad erreicht hat, spielt El Torro eine Westernmelodie.</p>\r\n<p>Ihr wollt El Torro nicht mit dem Steak in die Pfanne stellen? Kein Problem! Alternativ gibt es auch die ?intravenöse? Methode mit dem Sensorkabel. Die Nadel des Kabels einfach mittig in das Fleisch stecken. Dann die Garungsart (medium rare, medium oder well done) einstellen und los geht''s.</p>\r\n<p>El Torro kann aber nicht nur Rindersteaks auf den Punkt garen. Auch Fisch, Geflügel oder Schwein sind für El Torro kein Problem.</p>\r\n<p>Wollt Ihr das Fleisch im Backofen, auf dem offenen Grill oder auf einem Haubengrill zubereiten? Dann sollten Ihr die Methode mit dem Sensorkabel wählen, denn im Ofen und auf dem Grill ist es für El Torro zu heiß ? er soll ja beim Garen helfen und nicht gegart werden!</p>\r\n<p>Neben seinem funktionalen Nutzen ist El Torro übrigens auch ein Schmuckstück für Ihre Küche. Kühler Edelstahl gepaart mit einem goldenen oder stählernen Stier ? ein echter Hingucker!</p>\r\n<div>\r\n<p></p>\r\n<div>Praktisch ? Einfach ? Genial! El Torro, das perfekte Männergeschenk!</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp; <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'lust perfekte fleisch torro ultimative steaktimer männer', '', '', '');
INSERT INTO `oxartextends` VALUES ('2264', '<div>\r\n<p>Schickes Aerobic Set für sportliche Girls. </p>\r\n<p>Farbe: pink mit schwarz</p>\r\n<div>\r\n<p></p>\r\n<div>Lieferumfang: Tasche, 2 Hanteln, Springseil, Zangen und Band</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp; <br>\r\n</div></div></div>', '<br>', '', '', 'schickes aerobic set_ sportliche girls farbe pink schwarzlieferumfang', '', '', '');
INSERT INTO `oxartextends` VALUES ('2092', '<div>\r\n<p>Handtuch oder ein Spiel? Beides!</p>\r\n<p>Spielart: BACKGAMMON</p>\r\n<p>Inhalt: Handtuch + Spielsteine</p>\r\n<p>Länge: 180 cm</p>\r\n<div>\r\n<p></p>\r\n<div>Breite: 90 cm</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp; <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'handtuch spiel beidesspielart backgammoninhalt handtuch spielsteinelänge', '', '', '');
INSERT INTO `oxartextends` VALUES ('2276', '<div>\r\n<p>Diese Lichterkette sorgt für urgemütliche Stimmung bei Deiner Gartenparty. </p>\r\n<p>Material Laternen: Kunststoff. </p>\r\n<div>\r\n<p></p>\r\n<div>Höhe Laterne, ca. 16 cm.</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp; <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'lichterkette sorgt urgemütliche stimmung gartenparty material', '', '', '');
INSERT INTO `oxartextends` VALUES ('1651', '<div>\r\n<p>Da kann das Bier aus dem Getränkemarkt in Zukunft nicht mehr mithalten. Dein edles Gebräu Marke "Do it yourself" ist ein riesen Partyspaß und schmeckt sogar richtig gut! Das Set PROSIT enthält alles was Du zur Herstellung von ca. 25 Litern naturtrübem Bier benötigst. Die mitgelieferte Brauanleitung beschreibt wie es funktioniert und enthält Rezepte für unterschiedliche Biersorten. Keine Vorkenntnisse notwendig. Einfach loslegen und Dein eigener Braumeister werden.</p>\r\n<p>Lieferumfang:</p>\r\n<p>10 l Gärbehälter mit Deckel</p>\r\n<p>Zapfhahn</p>\r\n<p>alle Zutaten für 25 l Bier</p>\r\n<div>\r\n<p></p>\r\n<div>Rezeptsammlung</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp; <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'bier getränkemarkt zukunft mehr mithalten edles', '', '', '');
INSERT INTO `oxartextends` VALUES ('1661', '<div>\r\n<p></p>\r\n<div>Wenn man es sich recht überlegt, dann steht die Schürze BAVARIA auch Männern gar nicht schlecht!</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp; <br>\r\n</div>\r\n</div>', '<div>\r\n<p><br>\r\n </p></div>', '', '', 'recht überlegt dann steht schürze bavaria männern', '', '', '');
INSERT INTO `oxartextends` VALUES ('2311', '<div>\r\n<p>O''zapft is!</p>\r\n<p>Die Stimmungsknaller vom größten Volksfest der Welt,</p>\r\n<p>zum mitschunkeln. <br>\r\n</p>\r\n<ol>\r\n<li>Bayerischer Defiliermarsch (2:03)</li>\r\n<li>Ein Prosit (0:32)</li>\r\n<li>Zillertaler Hochzeitsmarsch (2:53)</li>\r\n<li>Hollarie Hollarei (2:48)</li>\r\n<li>Ententanz(2:45)</li>\r\n<li>Anton aus Tirol (3:26)</li>\r\n<li>Koa Hiatamadl (3:37)</li>\r\n<li>Skandal im Sperrbezirk (3:40)</li>\r\n<li>Schunkelkarussell (2:16)</li>\r\n<li>Gstanz''ln (2:08)</li>\r\n<li>Die Goass is weg (2:36)</li>\r\n<li>Werd scho werd''n, sagt d''Frau Kern (2:14)</li>\r\n<li>Her mit meine Henna (4:26)</li>\r\n<li>Live is life (3:54)</li>\r\n<li>Fürstenfeld (3:57)</li>\r\n<li>Juche auf der hohen Alm (2:58)</li>\r\n<li>Drei Tag gehen ma nimmer hoam (2:40)</li>\r\n<li>La Bamba (3:12)</li>\r\n<li>Sierra Madre (2:58)</li>\r\n<li>Time to say Goodbye (3:50</li></ol>\r\n<div>\r\n<p></p>\r\n<div>TOTAL TIME 00:58:53</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp; <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'ozapft isdie stimmungsknaller vom_ größten volksfest weltzum mitschunkeln', '', '', '');
INSERT INTO `oxartextends` VALUES ('a7c44be4a5ddee114.67356237', '<div>Ein Feuerwerk der Romantik, überraschend schön und Bote bester Laune.\r\nDas Tischfeuerwerk Magic Roses schießt mit einem lauten Plopp nach\r\nAbbrennen der (ungefährlichen) Zündschnur hunderte täuschendechte\r\nRosenblütenblätter aus hochwertigem Taft in die Luft, die dann zart zu\r\nBoden schweben. Ein ausgefallenes Geschenk und für jeden Gastgeber ein\r\ntraumhafter Tischschmuck, denn die Blütenblätter können nach dem\r\nFeuerwerk zusammen mit anderen schönen Kleinigkeiten dekorativ\r\narrangiert werden. </div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;&nbsp; <br>\r\n</div>', '<br>\r\n<div>&nbsp; <br>\r\n</div>', '', '', 'feuerwerk romantik überraschend schön bote bester launedas tischfeuerwerk', '', '', '');
INSERT INTO `oxartextends` VALUES ('2357', '<div>\r\n<p>Was bezeichnet der Biertrinker als ?Tulpe?? Welche Biermenge enthält eine ?Maß?? Diese und fast 200 weitere Fragen rund um das ?kühle Gold? beantwortet das neue Bier-Quiz von Kultquartett. </p>\r\n<p>Bierliebhaber erfahren so spielerisch viel Wissenswertes zu Biersorten, Trinkkultur, Historie und anderen spannenden Themen aus dem Reich des Gerstensaftes. </p>\r\n<div>\r\n<p></p>\r\n<div>Und Prost!</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'was_ bezeichnet biertrinker tulpe welche biermenge enthält maß_', '', '', '');
INSERT INTO `oxartextends` VALUES ('2360', '<div>\r\n<p>Von Petrus bis Benedikt XVI. </p>\r\n<p>Im edlen Golddruck!</p>\r\n<p>Wir sind Papst! Grund genug sich näher mit der Geschichte der Päpste zu beschäftigen. Spielerisch geht das nun im neuen Papstquartett, das 32 Päpste der Geschichte in einem Spiel vereinigt. </p>\r\n<div>\r\n<p></p>\r\n<div>Durch kurze Texte und informative Spielkategorien (Anzahl der Namensvetter, Dienstjahre, Petrusnachfolge, Entfernung Geburtsort-Rom) erfahren die Spieler viel über die Geschichte der Kirchenoberhäupter.</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'petrus benedikt xvi_ edlen golddruckwir papst grund genug', '', '', '');
INSERT INTO `oxartextends` VALUES ('2355', '<div>\r\n<p>Das Spiel zur schönsten Nebensache der Welt </p>\r\n<p>Wer schoss das Wembley-Tor? Wie groß ist ein Spielfeld? Wie oft war Deutschland Weltmeister? 48 Fragekarten bieten Wissen kompakt rund um die schönste Nebensache der Welt. </p>\r\n<p>Neben Fragen zu berühmten Spielern und Stadien gibt es Regelkunde, Fußballersprüche und viele Kuriositäten. </p>\r\n<div>\r\n<p></p>\r\n<div>Der ideale Spaß für das Trainingslager oder die Halbzeitpause.</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'spiel zur_ schönsten nebensache welt wer_ schoss wembley-tor groß', '', '', '');
INSERT INTO `oxartextends` VALUES ('2108', '<div>\r\n<p>Das Quartettspiel mit 32 Liebespositionen</p>\r\n<p>Kamasutra war gestern!</p>\r\n<p>Das ORIGINAL Bettsport-Quartett zeigt auf 32 Spielkarten alltägliche und verrückte Liebesstellungen im spielerischen Vergleich. </p>\r\n<p>Mit Original DUREX-Kondom!</p>\r\n<p>Eine "Expertendiskussion" sowie 25 junge Paare haben alle Positionen in den Kategorien "Spaßfaktor SIE und ER", "Verletzungsrisiko", "Rückbanktauglichkeit" und "Pornofaktor" bewertet. </p>\r\n<p>Alle Stellungen sind im stilvollen Comic-Style dargestellt und garantieren viel Spaß auf Parties und "im Bett". </p>\r\n<p>Mit dabei u.a. : </p>\r\n<p>- Der Perlentaucher</p>\r\n<p>- Die Hängende Fledermaus </p>\r\n<p>- Die Budapester Beinschere</p>\r\n<p>- Heiß am Stil</p>\r\n<p>usw.</p>\r\n<p>Viel Spaß beim Spielen!</p>\r\n<p>Inhalt:</p>\r\n<p>32 Spielkarten in Kunstoffbox</p>\r\n<div>\r\n<p></p>\r\n<div>DUREX Kondom</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'quartettspiel liebespositionenkamasutra gesterndas original', '', '', '');
INSERT INTO `oxartextends` VALUES ('2296', '<div>\r\n<p>DRUNKEN DUCKS ist eine neue Variante des Mensch-Ärger-Dich-Nicht Spiels - ist aber nicht für Kinder gedacht.</p>\r\n<p>Wer rausfliegt muss sein Glas leer trinken.</p>\r\n<div>\r\n<p></p>\r\n<div>Da finden die Erwachsenen auch wieder Spass an Brettspielen.</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'drunken ducks neue variante mensch-ärger-dich-nicht spiels', '', '', '');
INSERT INTO `oxartextends` VALUES ('1889', '<div>\r\n<p>Dieses Spiel ist nur für die erfahrenen Biertrinker ab 18 unter Euch! Alles ist dabei: Ein bischen Würfeln, ein bischen Karten ziehen und vor allem viel Bier. Als Spielfiguren kommen stilechte Kronkorken zum Einsatz. Das Ganze ist ein ziemlicher Spaß unter trinkfesten Freunden!</p>\r\n<div>\r\n<p></p>\r\n<div>Inhalt: Spielbrett, Würfel, 4 Flaschenverschlüsse, 32 Bierkarten</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'spiel erfahrenen biertrinker unter euch alles', '', '', '');
INSERT INTO `oxartextends` VALUES ('2363', '<div>\r\n<p>Viel Vergnügen mit diesem robusten Designer-Kicker. Mit 7 Bällen, 2 Ersatzspielern und Werkzeug für die Montage. Lackierte Buchenholzgriffe, handbemalte Spieler, </p>\r\n<p>4 Getränkehalterungen, Spielstandanzeige an den Toren, automatische Ballausgabe. Fussball-Tisch für den Außenbereich.</p>\r\n<p>Die Spielfiguren sind handbemalt!</p>\r\n<p>Die Spielfiguren stellen das Spiel Real Madrid gegen den FC Barcelona dar. </p>\r\n<p>Auf Anfrage können die Spielfiguren in deinen Lieblingsvereinen bemalt werden.</p>\r\n<p>Lieferzeit dann 3-4 Wochen und ein Aufpreis von 250?. </p>\r\n<p>Lieferung per Spedition.</p>\r\n<p>Material: Edelstahl </p>\r\n<p>Maße: 150 x 113 x 97,5 cm</p>\r\n<div>\r\n<p></p>\r\n<div>Gewicht: 124 kg</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'vergnügen diesem robusten designer-kicker bällen ersatzspielern', '', '', '');
INSERT INTO `oxartextends` VALUES ('2041', '<div>\r\n<p></p>\r\n<div>Gleichzeitig durch die Wohnung tanzen und Boden putzen - einfach genial!</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div>', '<div>\r\n<p>&nbsp;</p></div>', '', '', 'gleichzeitig durch wohnung tanzen boden putzen einfach genialbezugshinweis', '', '', '');
INSERT INTO `oxartextends` VALUES ('2000', '<div>\r\n<p>Wanduhr im coolen ROBOTER Look!</p>\r\n<p>Durchmesser: 40 cm</p>\r\n<div>\r\n<p></p>\r\n<div>Material: Glas</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'wanduhr coolen roboter lookdurchmesser cmmaterial glasbezugshinweis', '', '', '');
INSERT INTO `oxartextends` VALUES ('1354', '<div>\r\n<p>Eine Wanduhr mit zwölf Armen für zwölf Stunden... und für jeden Tag!</p>\r\n<p>Benötigt Batterie: 1 * 1,5 V Mignon ''AA''</p></div>', '<div><br>\r\n</div>', '', '', 'wanduhr zwölf armen zwölf stunden jeden tagbenötigt', '', '', '');
INSERT INTO `oxartextends` VALUES ('1951', '<div>\r\n<div>\r\n<p>Bella Italia, wir kommen! Dieser Ausblick, frisch wie der junge Morgen versüsst die Stunden, Minuten und Sekunden bis zum nächsten Urlaub vor der Küste Jesolos.</p></div>\r\n<div>\r\n<div>Durchmesser: 34 cm </div></div>\r\n<div>\r\n<p>Material: Glas</p></div></div>', '<br>', '', '', 'bella italia kommen ausblick frisch junge morgen versüsst', '', '', '');
INSERT INTO `oxartextends` VALUES ('1771', '<div>\r\n<p>Digitale Wanduhr mit Fernbedienung und Netzteil. </p>\r\n<div>\r\n<p></p>\r\n<div>Masse: 31,5 x 19,5 cm</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'digitale wanduhr fernbedienung netzteil masse x___ cmbezugshinweis', '', '', '');
INSERT INTO `oxartextends` VALUES ('1672', '<div>\r\n<p>Jede Stunde hat ihr eigenes Gesicht! In die Wanduhr PHOTOFRAME passen 12 Fotos mit einem Durchmesser von 3,5 cm. Ausreichend Platz für die ganze Familie.</p>\r\n<div>&nbsp;&nbsp;</div>Durchmesser: 25 cm\r\n \r\n<div>\r\n<p></p>\r\n<div>Material: Metall, silber</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'stunde eigenes gesicht wanduhr photoframe passen fotos', '', '', '');
INSERT INTO `oxartextends` VALUES ('2028', '<div>\r\n<p>Im Piktogrammstil nach Otl Aicher! </p>\r\n<p>Größe: 24x19x4cm </p> \r\n<div>\r\n<p></p>\r\n<div>Design: Chris Koens</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'piktogrammstil otl_ aicher größe design chris koensbezugshinweis', '', '', '');
INSERT INTO `oxartextends` VALUES ('2080', '<div>\r\n<p>Die kleine Zange zeichnet sich durch funktionales Design aus. Dadurch entfernt sie ideal nicht nur den Verschlussdraht von Flaschen, sondern ist bestens dazu geeignet festsitzende Champagner-und Sektkorke sowie Schraubverschlüsse einfach zu öffnen. </p>\r\n<p>Schnelle Hilfe bietet die Barzange ebenfalls als Kapselhebel und auch als Deckelheber für Schraubgläser: Deckel anheben, Luft hineinlassen und ohne Kraftaufwand das Glas aufschrauben.</p>\r\n<p>Design: Numsen</p>\r\n<p>Edler Zinkdruckguß + satiniert.</p>\r\n<p>Masse: 16,9 cm x 4,3 cm x 2,3 cm.</p>\r\n<div>\r\n<p></p>\r\n<div>Gewicht: 268g</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'kleine zange zeichnet durch funktionales design dadurch entfernt', '', '', '');
INSERT INTO `oxartextends` VALUES ('1876', '<div>\r\n<p>Schicker Barwagen im James Bond Style. Inklusive Eisbehälter und Eiszange. </p>\r\n<p>Material: Chrom, Glas</p>\r\n<div>\r\n<p></p>\r\n<div>Höhe: 63 cm Durchmesser: 54 cm</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'schicker barwagen james bond style inklusive eisbehälter eiszange material', '', '', '');
INSERT INTO `oxartextends` VALUES ('1127', '<div>\r\n<p>Schön geglitzert hat Eis ja schon immer, aber dieses hier bietet nochmals eine andere Dimension! Einige Stunden vorher ins Gefrierfach gepackt, fangen die Eiswürfel FLASH beim Kontakt mit dem Drink an wie wild zu blinken. Ausgeschaltet werden sie, indem du sie einfach abtrocknest. Ca. 100 Stunden lang kannst du das Schauspiel bewundern. Das sind, je nach Trinkgfestigkeit deiner Gäste, eine ganze Menge Partys <br>\r\n</p>\r\n<div>\r\n<p></p>\r\n<div>Inhalt: 2 Stück im Set</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'schön geglitzert eis_ schon immer hier bietet nochmals', '', '', '');
INSERT INTO `oxartextends` VALUES ('1849', '<div>\r\n<p>Für 6 Flaschen.</p>\r\n<p>Höhe: 52 cm</p>\r\n<div>\r\nMaterial: Chrom</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'flaschenhöhe cmmaterial chrombezugshinweis interesse', '', '', '');
INSERT INTO `oxartextends` VALUES ('1351', '<div>\r\n<p>Leg sie einfach einige Stunden vor Gebrauch ins Gefrierfach und serviere deine Drinks mit 2-3 Steinen im Glas. Der riesen Vorteil: Du hast keine verwässerten Cocktails mehr.</p>\r\n<div>\r\n<p></p>\r\n<div>Inhalt: 8 Stück</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'leg_ einfach stunden gebrauch gefrierfach serviere deine', '', '', '');
INSERT INTO `oxartextends` VALUES ('1906', '<div>\r\n<p>Origineller Korkenzieher zum Öffnen von Weinflaschen. Funktioniert mit verblüffend wenig Kraft. <br>\r\n</p>\r\n<p>Material: Stahl, verchromt. <br>\r\n</p>\r\n<p>Abmessungen: 20,9 * 8 * 4,4 cm <br>\r\n</p>\r\n<div>\r\nGewicht: ca. 420 g</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'origineller korkenzieher öffnen weinflaschen funktioniert verblüffend', '', '', '');
INSERT INTO `oxartextends` VALUES ('1477', '<div>\r\n<p>Champagnerverschluss GOLF </p>\r\n<div>\r\n<p></p>\r\n<div>Wenn du bereits einen Golfball unter dem Kopfkissen liegen hast, dann wird dich sicher auch unser Champagnerverschluss GOLF erfreuen. Er arbeitet zuverlässig nach dem ''Silberlöffelprinzip'' und ist richtig massiv gebaut.Abmessungen: 11 * 4 cm</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'champagnerverschluss golf bereits golfball unter kopfkissen', '', '', '');
INSERT INTO `oxartextends` VALUES ('1431', '<div>\r\n<p>Nicht nur für liebliche Drinks! Du packst sie so wie sie sind ins Gefrierfach und dann ab damit ins Glas. Kein lästiges eingiessen von Wasser in irgendwelche Formen. Darüberhinaus gehören verwässerte Drinks damit der Vergangenheit an!</p>\r\n<div>\r\n<p></p>\r\n<div>Menge: 18 Stück</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;&nbsp; <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'liebliche drinks packst gefrierfach', '', '', '');
INSERT INTO `oxartextends` VALUES ('2036', '<div>\r\n<p>Material Chrome </p> \r\n<div>\r\n<p></p>\r\n<div>Höhe: 22cm, Durchmesser: 8cm</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'material chrome höhe durchmesser 8cmbezugshinweis', '', '', '');
INSERT INTO `oxartextends` VALUES ('1142', '<div>\r\n<p>Das richtige Werkzeug für den Feierabend. Also die Jungs draussen auf dem Bau nehmen ja normalerweise eine zweite Flasche um die erste zu köpfen. Aber das wollen wir euch nicht wirklich antun. </p>\r\n<div>\r\n<p></p>\r\n<div>Dann sind die Heimwerker also einfach mal einen Schritt voraus.</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<br>', '', '', 'richtige werkzeug feierabend jungs draussen bau_ nehmen', '', '', '');
INSERT INTO `oxartextends` VALUES ('1131', '<div>\r\n<p></p>\r\n<div>Die Lösung nicht nur für WGs oder brüchige Partnerschaften. Du kannst sehr gut die Flasche mit dem edlen Tropfen auch vor dir selbst schützen. Einfach den Flaschenverschluss EGO drauf, die Zahlenkombination verstellen und dann schnell aus dem Kopf damit...</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div>', '<br>', '', '', 'lösung wgs_ brüchige partnerschaften kannst sehr gut_', '', '', '');
INSERT INTO `oxartextends` VALUES ('1126', '<div>\r\n<div>\r\n<p>Schon viele Intellektuelle vor dir, von Hemingway bis Oscar Wild, haben sich seit dem 18. Jahrhundert von dem teuflischen Getränk um den Verstand bringen lassen. Alles für das sehr spezielle Trink-Ritual und noch einige Rezepte dazu, stecken in unserem Barset ABSINTH. All inclusive sozusagen.&nbsp;</p></div>\r\n<div>\r\n<div>Ab 18 Jahren! Inhalt:</div></div>\r\n<div>\r\n<p>2 Absinth Gläser</p>\r\n<p>1 Absinthlöffel Devil</p>\r\n<div>\r\n<p></p>\r\n<div>2 Fläschchen Absinth (je 4 cl)</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n&nbsp;\r\n&nbsp;\r\n&nbsp;</div></div></div>', '<div>\r\n<p>weiss so genau, was sich hinter den wilden Geschichten verbirgt. Schon viele Intellektuelle vor dir, von Hemingway bis Oscar Wild, haben sich seit dem 18. Jahrhundert von dem teuflischen Getränk um den Verstand bringen lassen. Alles für das sehr spezielle Trink-Ritual und noch einige Rezepte dazu, stecken in unserem Barset ABSINTH. All inclusive sozusagen. </p>\r\n<p>&nbsp;</p>\r\n<p>Ab 18 Jahren! Inhalt:</p>\r\n<p>2 Absinth Gläser</p>\r\n<p>1 Absinthlöffel Devil</p>\r\n<p>2 Fläschchen Absinth (je 4 cl)</p></div>', '', '', 'schon viele intellektuelle hemingway oscar wild', '', '', '');
INSERT INTO `oxartextends` VALUES ('2201', '<div>\r\n<p>* Bringen Sie Haushalt und Bikinifigur in einem Aufwasch auf Vordermann!<br>\r\n* über 25 Workouts vom Keller bis zum Dachboden.<br>\r\n* Spart Geld, spart Zeit, macht Spaß – und ist nicht immer ganz ernst gemeint…</p>\r\n<p>Putz Dich schlank!128 Seiten, vierfarbig, Paperback<br>\r\nFormat: 22 x 16,4 cm<br>\r\nAutor: Millard, Anne-Marie</p>&nbsp;</div>', '', '', '', 'bringen haushalt bikinifigur aufwasch vordermann über', '', '', '');
INSERT INTO `oxartextends` VALUES ('1487', '<div>\r\n<p>In zeitlos klassischem Design und aus edlem Holz gefertigt. Hier überleben die mühsam gesammelten Geburtstagstermine deiner Freunde auch die nächsten fünfzig Pocket-PC Generationen und Computerabstürze. Der HAPPY B wird mit Pergamentröllchen und einem Hochzeitspin geliefert!</p>\r\n<p>Abmessungen: 48 * 37 * 2 cm</p>\r\n<p>Gewicht: 1300 g</p>\r\n<p>Material: Buchenschichtholz</p>\r\n<div>\r\n<p></p>\r\n<div>Design: Alexander Schnell-Waltenberger</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n</div></div>', '<div><br>\r\n</div>', '', '', 'zeitlos klassischem design edlem holz gefertigt hier überleben', '', '', '');
INSERT INTO `oxartextends` VALUES ('2278', '<div>Super trendige Hängelampe in den Farben:<br>\r\nhellblau <br>\r\ngelb <br>\r\npink<br>\r\n<br>\r\nMaße: D25cm,<br>\r\nLieferumfang: 1 Birne 40 Watt<br>\r\nInfo: E27</div>\r\n&nbsp;\r\n<div><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp;  <br>\r\n</div>\r\n&nbsp;\r\n&nbsp;', '<br>', '', '', 'super trendige hängelampe farbenhellblau gelb pinkmaße d25cmlieferumfang', '', '', '');
INSERT INTO `oxartextends` VALUES ('2278-01', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('2278-02', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('2278-03', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('2229-01', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('2229-02', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('2231-01', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('2231-02', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('2275-01', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('2275-02', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('1661-01', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('1661-02', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('2363-01', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('2363-02', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('2041-01', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('2041-02', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('2041-03', '', '', '', '', '', '', '', '');
INSERT INTO `oxartextends` VALUES ('1873', '<div> Das smarte Täschchen wird wie ein Armreif am Handgelenk getragen.</div>\r\n&nbsp;\r\n<div>Deine individuelle Beschriftung bitte oben in das Textfeld eingeben.&nbsp;</div>\r\n<div>\r\n<div class="product_text3">\r\n<div>\r\n<p>Farbe: violett</p>\r\n<div>\r\nLänge: 26 cm</div>\r\n<div>Höhe: 12 cm</div>\r\n<p><span style="color: #666666;"><strong>Bezugshinweis:</strong> bei Interesse können Sie dieses Produkt bei <a href="http://www.desaster.com/" style="color: #666666;">www.desaster.com</a> erwerben.</span>&nbsp; <br>\r\n</p>\r\n&nbsp;\r\n&nbsp;</div></div>&nbsp;</div>', '<br>\r\n<div>\r\n<div class="product_text3">\r\n<div>\r\n&nbsp;\r\n&nbsp;</div></div>&nbsp;</div>', '', '', 'smarte täschchen armreif handgelenk getragendeine', '', '', '');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxarticles`
-- 

DROP TABLE IF EXISTS `oxarticles`;
CREATE TABLE IF NOT EXISTS `oxarticles` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXSHOPINCL` bigint(20) unsigned NOT NULL,
  `OXSHOPEXCL` bigint(20) unsigned NOT NULL,
  `OXPARENTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXACTIVE` tinyint(1) NOT NULL default '1',
  `OXACTIVEFROM` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXACTIVETO` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXARTNUM` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXEAN` varchar(13) collate latin1_general_ci NOT NULL default '',
  `OXDISTEAN` varchar(13) collate latin1_general_ci NOT NULL default '',
  `OXTITLE` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSHORTDESC` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXPRICE` double NOT NULL default '0',
  `OXBLFIXEDPRICE` tinyint(1) NOT NULL default '0',
  `OXPRICEA` double NOT NULL default '0',
  `OXPRICEB` double NOT NULL default '0',
  `OXPRICEC` double NOT NULL default '0',
  `OXBPRICE` double NOT NULL default '0',
  `OXTPRICE` double NOT NULL default '0',
  `OXUNITNAME` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXUNITQUANTITY` double NOT NULL default '0',
  `OXEXTURL` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXURLDESC` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXURLIMG` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXVAT` float default NULL,
  `OXTHUMB` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXICON` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC1` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC2` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC3` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC4` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC5` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC6` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC7` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC8` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC9` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC10` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC11` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC12` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXZOOM1` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXZOOM2` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXZOOM3` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXZOOM4` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXWEIGHT` double NOT NULL default '0',
  `OXSTOCK` double NOT NULL default '-1',
  `OXSTOCKFLAG` tinyint(1) NOT NULL default '1',
  `OXSTOCKTEXT` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXNOSTOCKTEXT` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXDELIVERY` date NOT NULL default '0000-00-00',
  `OXINSERT` date NOT NULL default '0000-00-00',
  `OXTIMESTAMP` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `OXLENGTH` double NOT NULL default '0',
  `OXWIDTH` double NOT NULL default '0',
  `OXHEIGHT` double NOT NULL default '0',
  `OXFILE` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXSEARCHKEYS` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTEMPLATE` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXQUESTIONEMAIL` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXISSEARCH` tinyint(1) NOT NULL default '1',
  `OXVARNAME` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXVARSTOCK` int(5) NOT NULL default '0',
  `OXVARCOUNT` int(1) NOT NULL default '0',
  `OXVARSELECT` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXVARMINPRICE` double NOT NULL default '0',
  `OXVARNAME_1` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXVARSELECT_1` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXVARNAME_2` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXVARSELECT_2` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXVARNAME_3` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXVARSELECT_3` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSHORTDESC_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXURLDESC_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSEARCHKEYS_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSHORTDESC_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXURLDESC_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSEARCHKEYS_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSHORTDESC_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXURLDESC_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSEARCHKEYS_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXFOLDER` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXSUBCLASS` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXSTOCKTEXT_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSTOCKTEXT_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSTOCKTEXT_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXNOSTOCKTEXT_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXNOSTOCKTEXT_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXNOSTOCKTEXT_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSORT` int(5) NOT NULL default '0',
  `OXSOLDAMOUNT` double NOT NULL default '0',
  `OXNONMATERIAL` int(1) NOT NULL default '0',
  `OXFREESHIPPING` int(1) NOT NULL default '0',
  `OXREMINDACTIV` int(1) NOT NULL default '0',
  `OXREMINDAMOUNT` double NOT NULL default '0',
  `OXAMITEMID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXAMTASKID` varchar(16) collate latin1_general_ci NOT NULL default '0',
  `OXVENDORID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSKIPDISCOUNTS` tinyint(1) NOT NULL default '0',
  `OXORDERINFO` varchar(255) collate latin1_general_ci NOT NULL,
  `OXPIXIEXPORT` tinyint(1) NOT NULL default '0',
  `OXPIXIEXPORTED` timestamp NOT NULL default '0000-00-00 00:00:00',
  `OXVPE` int(11) NOT NULL default '1',
  `OXRATING` double NOT NULL default '0',
  `OXRATINGCNT` int(11) NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `OXPARENTID` (`OXPARENTID`),
  KEY `varidx` (`OXSHOPINCL`,`OXVARSELECT`),
  KEY `OXVENDORID` (`OXVENDORID`),
  KEY `linkidx` (`OXVARSELECT`,`OXID`,`OXARTNUM`),
  KEY `vendoridx` (`OXSHOPINCL`,`OXSHOPEXCL`,`OXVENDORID`,`OXVARSELECT`),
  KEY `mainidx` (`OXSHOPINCL`,`OXSHOPEXCL`,`OXACTIVE`,`OXACTIVEFROM`,`OXACTIVETO`,`OXSTOCKFLAG`,`OXSTOCK`,`OXVARSTOCK`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxarticles`
-- 

INSERT INTO `oxarticles` VALUES ('1126', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1126', '', '', 'Bar-Set ABSINTH', 'Darf in keiner Alkohol-Sammlung fehlen!', 34, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1126_th.jpg', '1126_ico.jpg', '1126_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1126_z1.jpg', '1126_z2.jpg', 'nopic.jpg', 'nopic.jpg', 0, 0, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 34, '', '', '', '', '', '', 'Bar-Set ABSINTH', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1127', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1127', '', '', 'Blinkende Eiswürfel FLASH', '', 8, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1127_th.jpg', '1127_ico.jpg', '1127_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1127_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 0, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 8, '', '', '', '', '', '', 'Ice Cubes FLASH', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1131', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1131', '', '', 'Flaschenverschluss EGO', '', 23, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1131_th.jpg', '1131_ico.jpg', '1131_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1131_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 0, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 23, '', '', '', '', '', '', 'Bottle Cap EGO', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b31fcce448.08890330', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1142', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1142', '', '', 'Flaschenöffner HAMMER', '', 7, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1142_th.jpg', '1142_ico.jpg', '1142_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 0, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 7, '', '', '', '', '', '', 'Bottle Opener HAMMER', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b31fcce448.08890330', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1351', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1351', '', '', 'Kühlwürfel NORDIC ROCKS ''Eiswürfel Ersatz''', 'Unglaubliche 400 Mio. Jahre alt sind unsere Kühlwürfel aus Schwedens Berggestein.', 12, 0, 0, 0, 0, 0, 0, 'kg', 0.3, '', '', '', NULL, '1351_th.jpg', '1351_ico.jpg', '1351_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1351_z1.jpg', '1351_z2.jpg', '1351_z3.jpg', 'nopic.jpg', 0, 50, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', 'ar party eiswrfel cocktail drink hype stein felsen', '', '', 1, '', 0, 0, '', 12, '', '', '', '', '', '', 'Ice Cubes NORDIC ROCKS ''ice cube substitute''', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1354', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1354', '', '', 'Wanduhr SPIDER', '', 49, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1354_th.jpg', '1354_ico.jpg', '1354_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 0, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 49, '', '', '', '', '', '', 'Wall Clock SPIDER', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1431', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1431', '', '', 'Eiswürfel HERZ', '', 4, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1431_th.jpg', '1431_ico.jpg', '1431_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1431_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 30, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 4, '', '', '', '', '', '', 'Ice Cubes HEART', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1436', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1436', '', '', 'Washlotion DIRTY GIRL', '', 17.9, 0, 0, 0, 0, 0, 0, 'Liter', 0.25, '', '', '', NULL, '1436_th.jpg', '1436_ico.jpg', '1436_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 1000, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 17.9, '', '', '', '', '', '', 'Body Lotion DIRTY GIRL', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b32fd2c224.65443178', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1477', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1477', '', '', 'Champagnerverschluss GOLF', '', 12, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1477_th.jpg', '1477_ico.jpg', '1477_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1477_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 50, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 12, '', '', '', '', '', '', 'Champagne Lock GOLF', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b31fcce448.08890330', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1487', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1487', '', '', 'Geburtstagkalendar Happy B', 'Hochwertiger Erinngerungs-Kalender aus Buche.', 72, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1487_th.jpg', '1487_ico.jpg', '1487_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 0, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 72, '', '', '', '', '', '', 'Birthday-kalendar Happy B', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b32fd2c224.65443178', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1651', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1651', '', '', 'Bierbrauset PROSIT', '', 29.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1651_th.jpg', '1651_ico.jpg', '1651_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1651_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 10000, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 29.9, '', '', '', '', '', '', 'Beer homebrew kit CHEERS!', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1661', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1661', '', '', 'Schürze BAVARIA', '', 13.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1661_th.jpg', '1661_ico.jpg', '1661_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1661_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 0, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, 'Variante', 200, 2, '', 13.9, '', '', '', '', '', '', 'Pinafore BAVARIA', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1661-01', 1, 1, 0, '1661', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1661-01', '', '', '', '', 13.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, 'nopic.jpg', 'nopic_ico.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 100, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'Bayerin', 0, '', 'Bavarian female', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1661-02', 1, 1, 0, '1661', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1661-02', '', '', '', '', 19.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, 'nopic.jpg', '1661-02_ico.jpg', '1661-02_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1661-02_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 100, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'Bayer', 0, '', 'Bavarian male', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1672', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1672', '', '', 'Wanduhr PHOTOFRAME', '', 23, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1672_th.jpg', '1672_ico.jpg', '1672_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1672_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 501, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 23, '', '', '', '', '', '', 'Wall Clock PHOTOFRAME', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1771', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1771', '', '', 'Wanduhr DIGITAL', '', 59, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1771_th.jpg', '1771_ico.jpg', '1771_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1771_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 0, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 59, '', '', '', '', '', '', 'Wall Clock DIGITAL', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1849', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1849', '', '', 'Bar Butler 6 BOTTLES', '', 89, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1849_th.jpg', '1849_ico.jpg', '1849_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1849_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 2, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 89, '', '', '', '', '', '', 'Bar Butler 6 BOTTLES', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b31fcce448.08890330', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1873', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1873', '', '', 'Purse GLAM', 'Kultiges Täschchen - mit persönlicher Message.', 14.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1873_th.jpg', '1873_ico.jpg', '1873_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1873_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 200, 1, '', '', '0000-00-00', '2006-07-13', '2008-09-02 12:52:41', 0, 0, 0, '', '', 'details_persparam.tpl', '', 1, '', 0, 0, '', 14.9, '', '', '', '', '', '', 'Purse GLAM', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b32fd2c224.65443178', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1876', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1876', '', '', 'Barwagen LOUNGE', '', 179, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1876_th.jpg', '1876_ico.jpg', '1876_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1876_z2.jpg', 'nopic.jpg', 'nopic.jpg', 0, 66, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 179, '', '', '', '', '', '', 'Bar Cart LOUNGE', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b31fcce448.08890330', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1889', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1889', '', '', 'Bierspiel OANS, ZWOA, GSUFFA ...', '', 19.5, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1889_th.jpg', '1889_ico.jpg', '1889_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '1889_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 60, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 19.5, '', '', '', '', '', '', 'Beergame OANS, ZWOA, GSUFFA ...', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b32fd2c224.65443178', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1906', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1906', '', '', 'Korkenzieher SHARK', '', 25, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1906_th.jpg', '1906_ico.jpg', '1906_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 9, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 25, '', '', '', '', '', '', 'Corkscrew SHARK', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b31fcce448.08890330', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('1951', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '1951', '', '', 'Wanduhr BIKINI GIRL', '', 14, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '1951_th.jpg', '1951_ico.jpg', '1951_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 20, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 14, '', '', '', '', '', '', 'Wall Clock BIKINI GIRL', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2000', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2000', '', '', 'Wanduhr ROBOT', '', 29.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2000_th.jpg', '2000_ico.jpg', '2000_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 3, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 29.9, '', '', '', '', '', '', 'Wall Clock ROBOT', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2026', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2026', '', '', 'Grillbesteck GRILLMEISTER', 'Das Accessoires für den Profi!', 59.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2026_th.jpg', '2026_ico.jpg', '2026_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 5, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 59.9, '', '', '', '', '', '', 'Grill Tools GRILLMEISTER', 'Das Accessoires für den Profi!', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b31fcce448.08890330', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2028', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2028', '', '', 'Wanduhr EXIT', '', 22, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2028_th.jpg', '2028_ico.jpg', '2028_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2028_z1.jpg', '2028_z2.jpg', 'nopic.jpg', 'nopic.jpg', 0, 55, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 22, '', '', '', '', '', '', 'Wall Clock EXIT', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2036', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2036', '', '', 'Cocktail Shaker ROCKET', '', 29, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2036_th.jpg', '2036_ico.jpg', '2036_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 2, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 29, '', '', '', '', '', '', 'Cocktail Shaker ROCKET', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b31fcce448.08890330', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2041', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2041', '', '', 'Pantoffel WISCHMOB', '', 19.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2041_th.jpg', '2041_ico.jpg', '2041_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 50, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, 'Variante', 300, 3, '', 19.9, '', '', '', '', '', '', 'Slipper WISCHMOB', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b32fd2c224.65443178', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2041-01', 1, 1, 0, '2041', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2041-01', '', '', '', '', 19.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, 'nopic.jpg', '2041-01_ico.jpg', '2041-01_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 100, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'grau', 0, '', 'gray', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2041-02', 1, 1, 0, '2041', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2041-02', '', '', '', '', 19.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, 'nopic.jpg', '2041-02_ico.jpg', '2041-02_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 100, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'pink', 0, '', 'pink', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2041-03', 1, 1, 0, '2041', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2041-03', '', '', '', '', 19.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2041-03_th.jpg', '2041-03_ico.jpg', '2041-03_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 100, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'rot', 0, '', 'red', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2080', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2080', '', '', 'Barzange PROFI', 'Multifunktionales Bar-Werkzeug', 17, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2080_th.jpg', '2080_ico.jpg', '2080_p1.jpg', '2080_p2.jpg', '2080_p3.jpg', '2080_p4.jpg', '2080_p5.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2080_z1.jpg', '2080_z2.jpg', '2080_z3.jpg', '2080_z4.jpg', 0, 11, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 17, '', '', '', '', '', '', 'Champagne Pliers & Bottle Opener PROFI', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 1, 0, 0, 0, 0, '', '', 'd2e44d9b31fcce448.08890330', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2092', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2092', '', '', 'Badetuch GAME BACKGAMMON', '', 19.5, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2092_th.jpg', '2092_ico.jpg', '2092_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2092_z1.jpg', '2092_z2.jpg', 'nopic.jpg', 'nopic.jpg', 0, 0, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 19.5, '', '', '', '', '', '', 'Beach Towel GAME BACKGAMMON', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b32fd2c224.65443178', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2108', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2108', '', '', 'Kartenspiel Quartett BETTSPORT', '', 9.8, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2108_th.jpg', '2108_ico.jpg', '2108_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 69, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 9.8, '', '', '', '', '', '', 'Card-game BED SPORT', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2162', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2162', '', '', 'Haushaltsmanagement DIE HAUSARBEIT', '', 21, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2162_th.jpg', '2162_ico.jpg', '2162_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 0, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 21, '', '', '', '', '', '', 'THE HOUSEHOLD', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b32fd2c224.65443178', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2172', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2172', '', '', 'Boxsack PUNCH HIM', '', 19.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2172_th.jpg', '2172_ico.jpg', '2172_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 1, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 19.9, '', '', '', '', '', '', 'Punching Bag PUNCH HIM', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b32fd2c224.65443178', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2174', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2174', '', '', 'Boxhandschuhe PLÜSCH', 'Für alle die gerne zuschlagen, aber keine Gewalt mögen!', 19.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2174_th.jpg', '2174_ico.jpg', '2174_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 5, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 19.9, '', '', '', '', '', '', 'Boxing Gloves PLUSH', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b32fd2c224.65443178', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2176', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2176', '', '', 'Roboter MARVIN', '', 49.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2176_th.jpg', '2176_ico.jpg', '2176_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 2, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 49.9, '', '', '', '', '', '', 'Robot MARVIN', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 1, 0, 0, 0, 0, '', '', 'd2e44d9b31fcce448.08890330', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2177', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2177', '', '', 'Messerblock VOODOO', '', 99, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2177_th.jpg', '2177_ico.jpg', '2177_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 20, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 99, '', '', '', '', '', '', 'Knife Block VOODOO', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b32fd2c224.65443178', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2196', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2196', '', '', 'Buch VATER & SOHN', 'Was Ihr Sohn nur von Ihnen lernen kann', 7.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2196_th.jpg', '2196_ico.jpg', '2196_p1.jpg', '2196_p2.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2196_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 6, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 7.9, '', '', '', '', '', '', 'Book FATHER & SON', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2201', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2201', '', '', 'Putz dich schlank!', 'Fit und schlank mit Staubsauger und Wischmopp!', 12.95, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2201_th.jpg', '2201_ico.jpg', '2201_p1.jpg', '2201_p2.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 50, 1, '', '', '0000-00-00', '0000-00-00', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 12.95, '', '', '', '', '', '', 'Putz dich schlank!', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b32fd2c224.65443178', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2219', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2219', '', '', 'Buch VATER & TOCHTER', 'Was Ihre Tocher nur von Ihnen lernen kann', 7.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2219_th.jpg', '2219_ico.jpg', '2219_p1.jpg', '2219_p2.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2219_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 1, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 7.9, '', '', '', '', '', '', 'Book FATHER & DAUGHTER', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2229', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2229', '', '', 'Kronleuchter GYPSY ', '', 89, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2229_th.jpg', '2229_ico.jpg', '2229_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 4, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, 'Variante', 200, 2, '', 89, '', '', '', '', '', '', 'Candelabrum GYPSY ', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2229-01', 1, 1, 0, '2229', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2229-01', '', '', '', '', 89, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2229-01_th.jpg', '2229-01_ico.jpg', '2229-01_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 100, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'colored', 0, '', 'colored', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2229-02', 1, 1, 0, '2229', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2229-02', '', '', '', '', 89, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2229-02_th.jpg', '2229-02_ico.jpg', '2229-02_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 100, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'black', 0, '', 'black', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2231', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2231', '', '', 'Hängeleuchte COSMOS', 'Der absolute Hingucker im Wohnzimmer!', 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2231_th.jpg', '2231_ico.jpg', '2231_p1.jpg', '2231_p2.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 20, 1, '', '', '0000-00-00', '2006-07-05', '2008-05-16 19:24:12', 0, 0, 0, '', 'lampe', '', '', 1, 'Variante', 200, 2, '', 0, '', '', '', '', '', '', 'Pendant COSMOS', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2231-01', 1, 1, 0, '2231', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2231-01', '', '', '', '', 119, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, 'nopic.jpg', '2231-01_ico.jpg', '2231-01_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 100, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'large', 0, '', 'large', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2231-02', 1, 1, 0, '2231', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2231-02', '', '', '', '', 109, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, 'nopic.jpg', '2231-02_ico.jpg', '2231-02_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 100, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'medium', 0, '', 'medium', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2264', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2264', '', '', 'Aerobic Set JANE', '', 26, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2264_th.jpg', '2264_ico.jpg', '2264_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 2, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 26, '', '', '', '', '', '', 'Aerobic Set JANE', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b32fd2c224.65443178', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2275', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2275', '', '', 'BBQ Grill TONNE', '', 27.85, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2275_th.jpg', '2275_ico.jpg', '2275_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2275_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 100, 2, '', '', '0000-00-00', '2006-07-05', '2008-12-05 18:21:52', 0, 0, 0, '', '', '', '', 1, 'Variante', 199, 2, '', 27.85, 'Variante:', '', '', '', '', '', 'Barbecue Grill HARLEM', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 1, 0, 0, 0, 0, '', '', 'd2e44d9b31fcce448.08890330', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2275-01', 1, 1, 0, '2275', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2275-01', '', '', '', '', 27.85, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2275-01_th.jpg', '2275-01_ico.jpg', '2275-01_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 99, 2, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'pink', 0, '', 'pink', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2275-02', 1, 1, 0, '2275', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2275-02', '', '', '', '', 27.85, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2275-02_th.jpg', '2275-02_ico.jpg', '2275-02_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 100, 2, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'gelb/orange', 0, '', 'yellow/orange', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2276', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2276', '', '', 'Lichterkette ÖLLAMPE', '', 29.95, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2276_th.jpg', '2276_ico.jpg', '2276_p1.jpg', '2276_p2.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 0, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 29.95, '', '', '', '', '', '', 'Fairy Lights OIL', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2278', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2278', '', '', 'Hängelampe REFLECTOR', '', 30.75, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2278_th.jpg', '2278_ico.jpg', '2278_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2278_z1.jpg', '2278_z2.jpg', '2278_z3.jpg', 'nopic.jpg', 0, 30, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, 'Variante', 200, 3, '', 30.75, 'Variante:', '', '', '', '', '', 'Pendant REFLECTOR', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2278-01', 1, 1, 0, '2278', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2278-01', '', '', 'Hängelampe REFLECTOR', '', 30.75, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, 'nopic.jpg', '2278-01_ico.jpg', '2278-01_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2278-01_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 100, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'hellblau', 0, '', 'light blue', '', '', '', '', 'Hängelampe REFLECTOR', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2278-02', 1, 1, 0, '2278', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2278-02', '', '', '', '', 30.75, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, 'nopic.jpg', '2278-02_ico.jpg', '2278-02_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2278-02_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 100, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'gelb', 0, '', 'yellow', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2278-03', 1, 1, 0, '2278', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2278-03', '', '', '', '', 30.75, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, 'nopic.jpg', '2278-03_ico.jpg', '2278-03_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2278-03_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 0, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'pink', 0, '', 'pink', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2292', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2292', '', '', 'Elektroschock PISTOLEN', '', 59.95, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2292_th.jpg', '2292_ico.jpg', '2292_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2292_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 50, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 59.95, '', '', '', '', '', '', 'Electric Shock PISTOLS', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b31fcce448.08890330', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2296', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2296', '', '', 'Gesellschaftspiel DRUNKEN DUCKS', 'Das etwas andere Mensch-ärger-Dich-nicht Spiel!', 22.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2296_th.jpg', '2296_ico.jpg', '2296_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2296_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 6, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 22.9, '', '', '', '', '', '', 'Parlour Game DRUNKEN DUCKS', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b32fd2c224.65443178', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2311', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2311', '', '', 'Musik-CD OKTOBERFEST', '', 16.2, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2311_th.jpg', '2311_ico.jpg', '2311_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2311_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 70, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 16.2, '', '', '', '', '', '', 'Music-CD OKTOBERFEST', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2347', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2347', '', '', 'Grilltimer EL TORRO GOLD', 'Das Geheimnis zum perfekten Steak!', 34.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2347_th.jpg', '2347_ico.jpg', '2347_p1.jpg', '2347_p2.jpg', '2347_p3.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2347_z1.jpg', '2347_z2.jpg', '2347_z3.jpg', 'nopic.jpg', 0, 4, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 34.9, '', '', '', '', '', '', 'Grilltimer EL TORRO GOLD', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b31fcce448.08890330', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2355', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2355', '', '', 'Kartenspiel FUSSBALL QUIZ', 'Fußballwissen kompakt ? In einem Spiel!', 9.8, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2355_th.jpg', '2355_ico.jpg', '2355_p1.jpg', '2355_p2.jpg', '2355_p3.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 20, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 9.8, '', '', '', '', '', '', 'Card-game FOOTBALL QUIZ', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2357', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2357', '', '', 'Kartenspiel BIER QUIZ', 'Frei nach dem Motto: Wissen macht Durst!', 9.8, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2357_th.jpg', '2357_ico.jpg', '2357_p1.jpg', '2357_p2.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 0, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 9.8, '', '', '', '', '', '', 'Card-game BEER QUIZ', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2360', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2360', '', '', 'Kartenspiel PAPST', '32 Päpste im lehrreichen Vergleich', 9.8, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2360_th.jpg', '2360_ico.jpg', '2360_p1.jpg', '2360_p2.jpg', '2360_p3.jpg', '2360_p4.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 6, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 9.8, '', '', '', '', '', '', 'Card-game POPE', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2363', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2363', '', '', 'Tischfussball BIG KICK', 'Der Kicker der Superlative!', 3490, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2363_th.jpg', '2363_ico.jpg', '2363_p1.jpg', '2363_p2.jpg', '2363_p3.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2363_z1.jpg', '2363_z2.jpg', '2363_z3.jpg', 'nopic.jpg', 0, 11, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, 'Variante', 100, 2, '', 3490, '', '', '', '', '', '', 'Soccer Table BIG KICK', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b31fcce448.08890330', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2363-01', 1, 1, 0, '2363', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2363-01', '', '', '', '', 4490, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, 'nopic.jpg', 'nopic_ico.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 50, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'mit Münzeinwurf', 0, '', 'with coin slot', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('2363-02', 1, 1, 0, '2363', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2363-02', '', '', '', '', 3490, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, 'nopic.jpg', 'nopic_ico.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 50, 1, '', '', '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 0, 0, 'ohne Münzeinwurf', 0, '', 'without coin slot', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', '', 0, '', 0, '0000-00-00 00:00:00', 1, 0, 0);
INSERT INTO `oxarticles` VALUES ('a7c44be4a5ddee114.67356237', 1, 1, 0, '', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2006', '', '', 'Tischbombe MAGIC ROSES', '', 19.9, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', NULL, '2006_th.jpg', '2006_ico.jpg', '2006_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', '2006_z1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 0, 1, '', '', '0000-00-00', '0000-00-00', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 0, 0, '', 19.9, '', '', '', '', '', '', 'Tablebomb MAGIC ROSES', '', '', '', '', '', '', '', '', '', '', '', '', 'oxarticle', '', '', '', '', '', '', 0, 0, 0, 0, 0, 0, '', '', 'd2e44d9b32fd2c224.65443178', 0, '', 0, '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxattribute`
-- 

DROP TABLE IF EXISTS `oxattribute`;
CREATE TABLE IF NOT EXISTS `oxattribute` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXSHOPINCL` bigint(20) unsigned NOT NULL default '0',
  `OXSHOPEXCL` bigint(20) unsigned NOT NULL default '0',
  `OXTITLE` char(128) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_1` char(128) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_2` char(128) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_3` char(128) collate latin1_general_ci NOT NULL default '',
  `OXPOS` int(11) NOT NULL default '9999',
  PRIMARY KEY  (`OXID`),
  KEY `OXSHOPID` (`OXSHOPID`),
  KEY `OXSHOPINCL` (`OXSHOPINCL`),
  KEY `OXSHOPEXCL` (`OXSHOPEXCL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxattribute`
-- 

INSERT INTO `oxattribute` VALUES ('8a142c3e9cd961518.80299776', 1, 1, 0, 'Design', 'Design', '', '', 0);
INSERT INTO `oxattribute` VALUES ('8a142c3ee0edb75d4.80743302', 1, 1, 0, 'Anzeige', 'Display', '', '', 0);
INSERT INTO `oxattribute` VALUES ('8a142c3f0a792c0c3.93013584', 1, 1, 0, 'Modell', 'Model', '', '', 0);
INSERT INTO `oxattribute` VALUES ('8a142c3f0b9527634.96987022', 1, 1, 0, 'Größe', 'Size', '', '', 0);
INSERT INTO `oxattribute` VALUES ('8a142c3f0e2cf1a34.78041155', 1, 1, 0, 'Material', 'Material', '', '', 0);
INSERT INTO `oxattribute` VALUES ('8a142c3f0fdb08972.22223006', 1, 1, 0, 'Farbe', 'Color', '', '', 0);
INSERT INTO `oxattribute` VALUES ('8a142c3f14ef22a14.79693851', 1, 1, 0, 'Einsatzbereich', 'Area of application', '', '', 0);
INSERT INTO `oxattribute` VALUES ('8a142c3fb2344b7e6.08706912', 1, 1, 0, 'Getränk', 'Drink', '', '', 0);
INSERT INTO `oxattribute` VALUES ('8a142c3fd8f69f6d0.34274236', 1, 1, 0, 'Design', 'Design', '', '', 0);
INSERT INTO `oxattribute` VALUES ('d8842e3b51c3342c8.87563759', 1, 1, 0, 'Plush', '', '', '', 0);
INSERT INTO `oxattribute` VALUES ('d8842e3b7c5e108c1.63072778', 1, 1, 0, 'Beschaffenheit', 'Texture', '', '', 0);
INSERT INTO `oxattribute` VALUES ('e7744be103ccf54a8.48792250', 1, 1, 0, 'Buch', '', '', '', 0);
INSERT INTO `oxattribute` VALUES ('e7744be1339af28b3.24750515', 1, 1, 0, 'kartenspiel', '', '', '', 0);
INSERT INTO `oxattribute` VALUES ('e7744be1353176001.72682063', 1, 1, 0, 'Brettspiel', '', '', '', 0);
INSERT INTO `oxattribute` VALUES ('e7744be1aa6a58aa1.45635133', 1, 1, 0, 'Grund-Material', '', '', '', 0);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxcache`
-- 

DROP TABLE IF EXISTS `oxcache`;
CREATE TABLE IF NOT EXISTS `oxcache` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXEXPIRE` int(11) unsigned NOT NULL default '0',
  `OXRESETON` char(255) collate latin1_general_ci NOT NULL default '',
  `OXSID` char(32) character set latin1 collate latin1_bin NOT NULL default '',
  `OXSIZE` int(11) unsigned NOT NULL default '0',
  `OXHITS` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`OXID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxcache`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxcategories`
-- 

DROP TABLE IF EXISTS `oxcategories`;
CREATE TABLE IF NOT EXISTS `oxcategories` (
  `OXID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXPARENTID` varchar(32) collate latin1_general_ci NOT NULL default 'oxrootid',
  `OXLEFT` int(11) NOT NULL default '0',
  `OXRIGHT` int(11) NOT NULL default '0',
  `OXROOTID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXSORT` int(11) NOT NULL default '9999',
  `OXACTIVE` tinyint(1) NOT NULL default '1',
  `OXHIDDEN` tinyint(1) NOT NULL default '0',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXSHOPINCL` bigint(20) unsigned NOT NULL default '0',
  `OXSHOPEXCL` bigint(20) unsigned NOT NULL default '0',
  `OXTITLE` varchar(254) collate latin1_general_ci NOT NULL default '',
  `OXDESC` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXLONGDESC` text collate latin1_general_ci NOT NULL,
  `OXTHUMB` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXEXTLINK` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTEMPLATE` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXDEFSORT` varchar(64) collate latin1_general_ci NOT NULL default '',
  `OXDEFSORTMODE` tinyint(1) NOT NULL default '0',
  `OXPRICEFROM` double default NULL,
  `OXPRICETO` double default NULL,
  `OXACTIVE_1` tinyint(1) NOT NULL default '0',
  `OXTITLE_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXDESC_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXLONGDESC_1` text collate latin1_general_ci NOT NULL,
  `OXACTIVE_2` tinyint(1) NOT NULL default '0',
  `OXTITLE_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXDESC_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXLONGDESC_2` text collate latin1_general_ci NOT NULL,
  `OXACTIVE_3` tinyint(1) NOT NULL default '0',
  `OXTITLE_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXDESC_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXLONGDESC_3` text collate latin1_general_ci NOT NULL,
  `OXICON` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXVAT` float default NULL,
  `OXSKIPDISCOUNTS` tinyint(1) NOT NULL default '0',
  `OXSHOWSUFFIX` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`OXID`),
  KEY `OXROOTID` (`OXROOTID`),
  KEY `OXPARENTID` (`OXPARENTID`),
  KEY `OXPRICEFROM` (`OXPRICEFROM`),
  KEY `OXPRICETO` (`OXPRICETO`),
  KEY `OXHIDDEN` (`OXHIDDEN`),
  KEY `OXSHOPID` (`OXSHOPID`),
  KEY `OXSHOPINCL` (`OXSHOPINCL`),
  KEY `OXSHOPEXCL` (`OXSHOPEXCL`),
  KEY `OXSORT` (`OXSORT`),
  KEY `OXVAT` (`OXVAT`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxcategories`
-- 

INSERT INTO `oxcategories` VALUES ('30e44ab82c03c3848.49471214', 'oxrootid', 1, 6, '30e44ab82c03c3848.49471214', 100, 1, 0, 1, 1, 0, 'Für Sie', '', '', '', '', '', '', 0, 0, 0, 1, 'For Her', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab83159266c7.83602558', '30e44ab82c03c3848.49471214', 2, 3, '30e44ab82c03c3848.49471214', 9999, 1, 0, 1, 1, 0, 'Sport', '', '', '', '', '', '', 0, 0, 0, 1, 'Sports', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab8338d7bf06.79655612', '30e44ab82c03c3848.49471214', 4, 5, '30e44ab82c03c3848.49471214', 9999, 1, 0, 1, 1, 0, 'Wellness', '', '', '', '', '', '', 0, 0, 0, 1, 'Wellness', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab834ea42417.86131097', 'oxrootid', 1, 6, '30e44ab834ea42417.86131097', 200, 1, 0, 1, 1, 0, 'Für Ihn', '', '', '', '', '', '', 0, 0, 0, 1, 'For Him', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab835e52cd24.95278795', '30e44ab834ea42417.86131097', 2, 3, '30e44ab834ea42417.86131097', 9999, 1, 0, 1, 1, 0, 'Gadgets', '', '', '', '', '', '', 0, 0, 0, 1, 'Gadgets', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab838094a7d2.59137554', '30e44ab834ea42417.86131097', 4, 5, '30e44ab834ea42417.86131097', 9999, 1, 0, 1, 1, 0, 'Bücher', '', '', '', '', '', '', 0, 0, 0, 1, 'Books', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab83b6e585c9.63147165', 'oxrootid', 1, 6, '30e44ab83b6e585c9.63147165', 300, 1, 0, 1, 1, 0, 'Wohnen', 'Die Liebe steckt im Detail', '', '', '', '', '', 0, 0, 0, 1, 'Living', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab83c31b4485.54423065', '30e44ab83b6e585c9.63147165', 2, 3, '30e44ab83b6e585c9.63147165', 9999, 1, 0, 1, 1, 0, 'Lampen', '', '', '', '', '', '', 0, 0, 0, 1, 'Lamps', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab83d52c6d74.06410508', 'oxrootid', 1, 4, '30e44ab83d52c6d74.06410508', 500, 1, 0, 1, 1, 0, 'Outdoor', 'Alles für Frischluft-Fanatiker', '', '', '', '', '', 0, 0, 0, 1, 'Outdoor', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab83e7a45c03.75889797', '30e44ab83d52c6d74.06410508', 2, 3, '30e44ab83d52c6d74.06410508', 9999, 1, 0, 1, 1, 0, 'Grillen', '', '', '', '', '', '', 0, 0, 0, 1, 'Barbecue', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab83fdee7564.23264141', 'oxrootid', 1, 16, '30e44ab83fdee7564.23264141', 400, 1, 0, 1, 1, 0, 'Party', '', '', '', '', '', '', 0, 0, 0, 1, 'Party', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab841af13e46.42570689', '30e44ab83fdee7564.23264141', 2, 3, '30e44ab83fdee7564.23264141', 9999, 1, 0, 1, 1, 0, 'Wiesn', 'Oans, zwoa, gsuffa....', '', '', '', '', '', 0, 0, 0, 1, 'Wiesn', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab8539ce4931.41747937', 'oxrootid', 1, 6, '30e44ab8539ce4931.41747937', 9999, 1, 0, 1, 1, 0, 'Spiele', '', '', '', '', '', '', 0, 0, 0, 1, 'Games', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab854b0d88f7.58173260', '30e44ab8539ce4931.41747937', 2, 3, '30e44ab8539ce4931.41747937', 9999, 1, 0, 1, 1, 0, 'Kartenspiele', '', '', '', '', '', '', 0, 0, 0, 1, 'Cards', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab85808a1f05.26160932', '30e44ab83b6e585c9.63147165', 4, 5, '30e44ab83b6e585c9.63147165', 9999, 1, 0, 1, 1, 0, 'Uhren', '', '', 'uhren3_tc.jpg', '', '', '', 0, 0, 0, 1, 'Clocks', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab8593023055.23928895', '30e44ab83fdee7564.23264141', 4, 13, '30e44ab83fdee7564.23264141', 9999, 1, 0, 1, 1, 0, 'Bar-Equipment', 'Stilvoll saufen!', '', 'bar_tc.jpg', '', '', '', 0, 0, 0, 1, 'Bar-Equipment', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('30e44ab85ace67180.85905139', '30e44ab83fdee7564.23264141', 14, 15, '30e44ab83fdee7564.23264141', 9999, 1, 0, 1, 1, 0, 'Geburtstag', '', '', '', '', '', '', 0, 0, 0, 1, 'Birthday', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('28344abcb845cc232.04196124', '30e44ab8539ce4931.41747937', 4, 5, '30e44ab8539ce4931.41747937', 9999, 1, 0, 1, 1, 0, 'Brettspiele', '', '', '', '', '', '', 0, 0, 0, 1, 'Boardgames', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('3ee44bf92addf2da2.73918494', '30e44ab8593023055.23928895', 5, 6, '30e44ab83fdee7564.23264141', 9999, 1, 0, 1, 1, 0, 'Flaschenverschlüsse', '', '', '', '', '', '', 0, 0, 0, 1, 'Bottle Caps', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('3ee44bf93154089e5.13807232', '30e44ab8593023055.23928895', 7, 8, '30e44ab83fdee7564.23264141', 9999, 1, 0, 1, 1, 0, 'Kühlwürfel', '', '', '', '', '', '', 0, 0, 0, 1, 'Ice Cubes', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('3ee44bf933cf342e2.99739972', '30e44ab8593023055.23928895', 9, 12, '30e44ab83fdee7564.23264141', 9999, 1, 0, 1, 1, 0, 'Flaschenöffner', '', '', '', '', '', '', 0, 0, 0, 1, 'Bottle Opener', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);
INSERT INTO `oxcategories` VALUES ('b3e44bf962f314624.45760494', '3ee44bf933cf342e2.99739972', 10, 11, '30e44ab83fdee7564.23264141', 9999, 1, 0, 1, 1, 0, 'Bier', '', '', '', '', '', '', 0, 0, 0, 1, 'Beer', '', '', 0, '', '', '', 0, '', '', '', '', NULL, 0, 1);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxcategory2attribute`
-- 

DROP TABLE IF EXISTS `oxcategory2attribute`;
CREATE TABLE IF NOT EXISTS `oxcategory2attribute` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXATTRID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSORT` int(11) NOT NULL default '9999',
  PRIMARY KEY  (`OXID`),
  KEY `OXOBJECTID` (`OXOBJECTID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxcategory2attribute`
-- 

INSERT INTO `oxcategory2attribute` VALUES ('4c544c5d68a55d674.58678253', '30e44ab834ea42417.86131097', '8a142c3f14ef22a14.79693851', 9999);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxconfig`
-- 

DROP TABLE IF EXISTS `oxconfig`;
CREATE TABLE IF NOT EXISTS `oxconfig` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXVARNAME` char(32) collate latin1_general_ci NOT NULL default '',
  `OXVARTYPE` varchar(4) collate latin1_general_ci NOT NULL default '',
  `OXVARVALUE` blob NOT NULL,
  PRIMARY KEY  (`OXID`),
  KEY `OXSHOPID` (`OXSHOPID`),
  KEY `OXVARNAME` (`OXVARNAME`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxconfig`
-- 

INSERT INTO `oxconfig` VALUES ('a1544b76735e4f185.64062667', 1, 'blEnterNetPrice', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('a1544b76735e10a14.72158823', 1, 'blCalculateDelCostIfNotLoggedIn', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('a1544b76735e16764.59301084', 1, 'blAllowUnevenAmounts', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('a1544b76735e1a432.28879509', 1, 'blUseStock', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('a1544b76735e28f21.47730452', 1, 'blStoreCreditCardInfo', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('a1544b76735ed3943.27888263', 1, 'dDefaultVAT', 'str', 0x07a1);
INSERT INTO `oxconfig` VALUES ('a1544b76735ed70a4.45006375', 1, 'sDefaultLang', 'str', 0xde);
INSERT INTO `oxconfig` VALUES ('8563fba1965a2b330.65668120', 1, 'sMerchantID', 'str', '');
INSERT INTO `oxconfig` VALUES ('8563fba1965a2d181.97927980', 1, 'sHost', 'str', 0x00d0e1aeebd778fac282663570d1660f41dc61385dbcd5d5d6f6);
INSERT INTO `oxconfig` VALUES ('8563fba1965a2eee6.68137602', 1, 'sPaymentUser', 'str', '');
INSERT INTO `oxconfig` VALUES ('8563fba1965a30cf7.41846088', 1, 'sPaymentPwd', 'str', '');
INSERT INTO `oxconfig` VALUES ('a1544b76735ef6fd6.81537135', 1, 'aLanguages', 'aarr', 0x4dba832f744c5786a371d9df3377ea87f0e2773dbaf685493e0b949a1c149111959424345b628f640a0d92ea6047ec118252e992);
INSERT INTO `oxconfig` VALUES ('a1544b76735f08dc9.20950323', 1, 'aCurrencies', 'arr', 0x4dba852e75e64cf5ccd4aea3e152054127ec2d8c1077b7849319dbb81b0ebffb281b2c97d8453d71628a022e1c6e78187dc2f901f386bdb37c107a301958ec2c08ec03528ef5cf06aa7f512665f93f5d82b6164eda08b259d8d1f0698b19eabf5d456ffc081f9fd422938e986f5a0b2b9283bbf8221c1cbe6c60);
INSERT INTO `oxconfig` VALUES ('a1544b76735f207b3.34062759', 1, 'aLexwareVAT', 'aarr', 0x4dba682873e04a2acbd3a9a4113b832e198a7e75fb770da528d4e916d042856bcaa4b6795b839a7c836f43faae6ef75d3e6f91e3a0384990c0b7fae81c46aeca010521bb89b5);
INSERT INTO `oxconfig` VALUES ('a1544b76735ee5648.79833616', 1, 'aNrofCatArticles', 'arr', 0x4dbace2972e14bf2cbd3a9a4113b83ad1c8f7b704f710ba39fd1ecd29b438b41809712e316c6f4fdc92741f7876cc6fca127d78994e604dcc99519);
INSERT INTO `oxconfig` VALUES ('a1544b76735e83d42.99780860', 1, 'iNrofSimilarArticles', 'str', 0x5d);
INSERT INTO `oxconfig` VALUES ('a1544b76735e879d5.39441574', 1, 'iNrofCustomerWhoArticles', 'str', 0x5d);
INSERT INTO `oxconfig` VALUES ('a1544b76735e8ede4.83220589', 1, 'iNrofCrossellArticles', 'str', 0x5d);
INSERT INTO `oxconfig` VALUES ('a1544b76735e965e4.01753655', 1, 'iUseGDVersion', 'str', 0xb6);
INSERT INTO `oxconfig` VALUES ('a1544b76735ea0c76.00349886', 1, 'sThumbnailsize', 'str', 0x07c4b144c7b838);
INSERT INTO `oxconfig` VALUES ('a1544b76735ea73d2.78486272', 1, 'sCatThumbnailsize', 'str', 0x5d43334072bf3f);
INSERT INTO `oxconfig` VALUES ('a1544b76735eadae8.82424194', 1, 'sCSVSign', 'str', 0x86);
INSERT INTO `oxconfig` VALUES ('a1544b76735eb6584.28717044', 1, 'iExportNrofLines', 'str', 0xb644b7);
INSERT INTO `oxconfig` VALUES ('a1544b76735eb9d22.29469978', 1, 'iExportTickerRefresh', 'str', 0x07);
INSERT INTO `oxconfig` VALUES ('a1544b76735ebd282.56059138', 1, 'iImportNrofLines', 'str', 0x07c4b1);
INSERT INTO `oxconfig` VALUES ('a1544b76735ec0b92.19534042', 1, 'iImportTickerRefresh', 'str', 0x07);
INSERT INTO `oxconfig` VALUES ('a1544b76735ec45c3.50765578', 1, 'iCntofMails', 'str', 0xb6c7);
INSERT INTO `oxconfig` VALUES ('a1544b76735f11c04.21437281', 1, 'aOrderfolder', 'aarr', 0x4dba852e754d5681a371fff5f6192073120d7739a70fd0e39371558fad9bc9f0c3b66e727c25fa3e0a690db0d556b71d7eeed4a6886c839a435935e4b4d0efb56982c5fd5969c1137a0405d6abe69e04dbb3ef798ad83c0efe7ef0);
INSERT INTO `oxconfig` VALUES ('570dea2b21398b6639b11f95531a8119', 1, 'blCheckTemplates', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('8563fba1c3936a472.04220012', 1, 'blTemplateCaching', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('5702a1ccf29d15c75184098ecbd203f0', 1, 'blLoadFullTree', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fb71d49.13936795', 1, 'blLogChangesInAdmin', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fb97ad1.48250264', 1, 'sUtilModule', 'str', '');
INSERT INTO `oxconfig` VALUES ('8563fba1c3937ee60.91079898', 1, 'iMallMode', 'str', 0x07);
INSERT INTO `oxconfig` VALUES ('8563fba1c39381962.39392958', 1, 'aCacheViews', 'arr', 0x4dba852e75e64cf5ccd4ae48113baca2c2f96704c777824cbc13da72f905064aea430c1a75e7bb914d80360cf25cf5bd5ed9fcaf3d310ab4);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fbc0b60.94048881', 1, 'aSkipTags', 'arr', 0x4dba85c975d460d7927733e9525403bc01ae3616da4e6cdf0a9b83cf8359894abce65f2103ad7e83270c4eb019ecf2fc0a3dcde5325b2bb08143bb43ec2c868c29d48dc7bea7f3abf16f6ebd6b97c50114bb53f0f23f59568f0fe9da452cfab264b8aa17ba9e978e892fc6cdef47b7f495e487027dcd08f12ce35d7d997b031d80044d60ba090f1d82a01b62d201d77ef25ce01e68a94948b3d48c2f6c5d612c2dcd6e8af2f00dd435f5e4a4884431560fe092e46de90ebdea5199915de557220607bfc0f7c9c945192e7640e2fda7d7f36ff1215b22ea4b3569cb47763d13e81f0a2dcf9398a5ccdd093ffa578c3c505b13a91d85f0d839543b340a4407ff6ec7d0948b0e7794bc05b993636dd6ac010b7c315f671a5c9b734402efbe207473995291e3122d474f0a86d07d643df2910af62397b4dbfb27c2bc2485498d0ff6bd0eaadc6e63a0fbb596fb50f7dc04a26f6ea8fc1b36f3ea274de76375b6dc82b3924a048a7f8a6ea741e8325b280a8d8c8c33c9d044fae750ad46b80dccfd8ae0c8471bf20c4236ecc4f3220011f7318b51e8c4276141f29a88c248a7563e89decc6561ac568f444fc75b5721947e980a280cde376532a0c7af16d6ad3a7decf89a8c3f1fd923fb11f8dd3bdea9319c71ba0be02c7f1fa10c276240727b56aafa61cc48f5b4f4852d184b3cf12e879a7d96b3b3134de64d0a9f8582632d1d18e1e7c007e2fc5dc95fd460e9d02db3fd2958ca5600d1b66f0853a6cd1488133f0299e1f20f);
INSERT INTO `oxconfig` VALUES ('3c544b77f62d20929.56357273', 1, 'aLogSkipTags', 'arr', 0x4dbaeb2d768d);
INSERT INTO `oxconfig` VALUES ('a193fbb7085f21150.58370641', 1, 'iShopID_TrustedShops', 'str', 0x53203d);
INSERT INTO `oxconfig` VALUES ('570edcc8a8f03c5fb908e2d900bd184a', 1, 'blLoadVariants', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fb67325.72583401', 1, 'blVariantsSelection', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('b883fc1dd260a1494.25373720', 1, 'iShopID_iPayment_Account', 'str', '');
INSERT INTO `oxconfig` VALUES ('b883fc1dd260a3f28.32999702', 1, 'iShopID_iPayment_User', 'str', '');
INSERT INTO `oxconfig` VALUES ('b883fc1dd260a60c7.01993775', 1, 'iShopID_iPayment_Passwort', 'str', '');
INSERT INTO `oxconfig` VALUES ('c083fc73e85b65906.75446129', 1, 'iShopID_pointspereuro', 'str', 0x07);
INSERT INTO `oxconfig` VALUES ('c083fc74093591ea3.61037664', 1, 'iShopID_pointspernews', 'str', 0xb0);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fba25c6.64448279', 1, 'sDefaultImageQuality', 'str', 0x7741);
INSERT INTO `oxconfig` VALUES ('a1544b76735e92d14.86505006', 1, 'iMaxGBEntriesPerDay', 'str', 0xb0);
INSERT INTO `oxconfig` VALUES ('a1544b76735ee9295.93006601', 1, 'aSortCols', 'arr', 0x4dba832f74e74df4cdd5af631238e7040fc97a18cf6cb28fd522f05ae28cf374f04ceeb7bd886eb10ac36ba86043beb02e);
INSERT INTO `oxconfig` VALUES ('57066cb30b560547f75c4fea191779da', 1, 'iTop5Mode', 'str', 0x07);
INSERT INTO `oxconfig` VALUES ('a1544b76735dfeef8.47912262', 1, 'blShowSorting', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('a1544b76735eecb98.66059782', 1, 'aSearchCols', 'arr', 0x4dba682873e04af3cad2a864153fe00308ce7d1fc86bb588d225f75de58b4371f549ebf5f054a8aa5d72ff4f9b5bb590240b14921d5f21962f67c7bd29417e61149f025b96cdf815d975cc85278913ee4b505bdfea13af328807c5ddd68d655b20d74de1e812236ebd97ee);
INSERT INTO `oxconfig` VALUES ('a1544b76735f0d486.95460273', 1, 'aHomeCountry', 'arr', 0x4dba322c77e44ef7ced6aca1f357003cad231d1d78fe80070841979cd58fd7eca88459d4cb9ce3b72a2804d5);
INSERT INTO `oxconfig` VALUES ('a1544b76735ef0a03.24522515', 1, 'aMustFillFields', 'arr', 0x4dba322775d460d7927733e9e5fb6bf2ef688abcc84baef2405f16b906eec019f3a63b927c45a833864604543fe611a86d4a9f4027235e1a3f8572bfe00be3f1f0efee2efcc915c759d77d9270c9fef10bc707cdf5bc1a299c3795b96e0b85d032c55ff31364daf0e7a37ec5362cfdfb60e2de223e8160c91b08887f22196bfa2abae5f5d862fb1d0a7e35b2ceaf862088ab34b7029b1d598e61c436d21111682cf3442e4f9f16b936b1cdc085ed0dbda4b996a2a573c0aa47d3fb73ab13d4193b4d32c87bf9994e175f864102872ef2535d5d3df359ca2b25d26640038bbe74de0c8e2ef4b4c4e887afc4d889da38c63bf1c13c57a5c8d3f66a0615e155e4c3ec6dc279693b96e5b04004171fca59cb133027c34a309d9393736914ba027d21fa8ef1b9c79ec170ffa1a2bbf4746175c0e04b9cff68ae4f2875973518b9b1abc64f8e940d42183ed4ec6e1d285b2503869374d82727fae6f33ef4dd71c52de6bf9e460837768460a9fe62570ba2f75e83fd21be7e0c8fb78106e713d0e2e79fd19f04304989166dda296361a897ad15cc9f11db0566c70e968282da76ebb76fef0409f0);
INSERT INTO `oxconfig` VALUES ('492443a4042f94.00184646', 1, 'sTagList', 'str', 0x07acdbf0da7c4ad4866d);
INSERT INTO `oxconfig` VALUES ('79e417a3726a0a010.44960388', 1, 'blBackTag', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('570f561ad47da77353c4d17e22092e9b', 1, 'bl_perfLoadAktion', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('570639384fdc0a1c8e118ff056f12e69', 1, 'bl_perfLoadReviews', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('5703a3bd0b8587b5ba35bee19c1452d6', 1, 'bl_perfLoadCrossselling', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('5709a56e5a4d49b6f30e5b2b6c872754', 1, 'bl_perfLoadAccessoires', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('5701c4402d12e1786138575b968e64f1', 1, 'bl_perfLoadCustomerWhoBoughtThis', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('5709e59d04f4858f8aad25ba2b5d54e3', 1, 'bl_perfLoadSimilar', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('570282ded313fcb527633e2d26294dac', 1, 'bl_perfLoadSelectLists', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('2e244d9a2f780a912.46038886', 1, 'bl_perfLoadDiscounts', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('5700c017b5aa757e3020e7718b7e06a2', 1, 'bl_perfLoadDelivery', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('5703cdf8b87f08086259bd5822b8f737', 1, 'bl_perfLoadPrice', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('570c38cc604e77aaebe6e2e0e7b73bc3', 1, 'bl_perfLoadCatTree', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('57028cded04eda146d4a020f456f0c9e', 1, 'bl_perfLoadCurrency', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('570f9ac8a75c6c42be7316a54372adaf', 1, 'bl_perfLoadLanguages', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('570ed8e3d0b4287fc6b9d85930b22a33', 1, 'bl_perfLoadNews', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('570ae142c15715a71823235aadaa60aa', 1, 'bl_perfLoadNewsOnlyStart', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('570fe14772f5d63e6ccec666a88c359c', 1, 'bl_perfLoadTreeForSearch', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('570a9cd27c269fe3a7b78b847b655c45', 1, 'bl_perfShowActionCatArticleCnt', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('5709f5e826c69b2492eddbcc324d2474', 1, 'bl_perfLoadCompare', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('57075ea2ee342bea17d36a4a59eaf397', 1, 'bl_perfLoadPriceForAddList', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('57077bc0533776b992ca3e95dd2d202d', 1, 'bl_perfParseLongDescinSmarty', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('570030f417c8f811f1ca3313bbf127ff', 1, 'bl_perfLoadVendorTree', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('570efae5d03421de678505b5f1d8aac7', 1, 'bl_perfShowLeftBasket', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('570ae53c061f05d227a78ee4522b8a4e', 1, 'bl_perfShowRightBasket', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fb7c8d9.21975416', 1, 'blStoreIPs', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fbc84a4.38498015', 1, 'aDeniedDynGroups', 'arr', 0x4dba322c77e44ef7ced6acac1f35ea091294b94a7572f88ffe92);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fba5ea7.09576108', 1, 'iAttributesPercent', 'str', 0x77c2);
INSERT INTO `oxconfig` VALUES ('a1544b76735eb2829.54417317', 1, 'sDecimalSeparator', 'str', 0xc9);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fbd73f8.27481232', 1, 'aInterfaceProfiles', 'aarr', 0x4dbace29724a51b6af7d09aac117301142e91c3c5b7eed9a850f85c1e3d58739aa9ea92523f05320a95060d60d57fbb027bad88efdaa0b928ebcd6aacf58084d31dd6ed5e718b833f1079b3805d28203f284492955c82cea3405879ea7588ec610ccde56acede495);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fba9710.18643282', 1, 'iSessionTimeout', 'str', 0x17c3);
INSERT INTO `oxconfig` VALUES ('a1544b76735e8b361.19517647', 1, 'iNrofNewcomerArticles', 'str', 0xfb);
INSERT INTO `oxconfig` VALUES ('a1544b76735e9a517.95770581', 1, 'sIconsize', 'str', 0x5d09ae6470);
INSERT INTO `oxconfig` VALUES ('a1544b76735ec8059.65614643', 1, 'sMidlleCustPrice', 'str', 0xfbc1);
INSERT INTO `oxconfig` VALUES ('a1544b76735ecc305.01703700', 1, 'sLargeCustPrice', 'str', 0x07c4b1);
INSERT INTO `oxconfig` VALUES ('a1544b76735e25659.01166573', 1, 'blWarnOnSameArtNums', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('a1544b76735dfb747.80338171', 1, 'blAutoIcons', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('a1544b76735ed0226.00592456', 1, 'sStockWarningLimit', 'str', 0x07c4);
INSERT INTO `oxconfig` VALUES ('a1544b76735e03606.07808540', 1, 'blSearchUseAND', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('570394955016b150b77fbc918246649d', 1, 'blDontShowEmptyCategories', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('570dda907154a51762fdb62ec381075a', 1, 'bl_perfUseSelectlistPrice', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('5709cf3ba19ed235df642af4946b9527', 1, 'bl_perfCalcVatOnlyForBasketOrder', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('a1544b76735e1e177.94484114', 1, 'blStockOnDefaultMessage', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('a1544b76735e21958.34291560', 1, 'blStockOffDefaultMessage', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fbb07a7.86247636', 1, 'iNewBasketItemMessage', 'str', 0xb6);
INSERT INTO `oxconfig` VALUES ('a1544b76735ee1cf5.03136408', 1, 'sCntOfNewsLoaded', 'str', 0x07);
INSERT INTO `oxconfig` VALUES ('570ec1ff975231aa5f05c9540d8ff642', 1, 'iNewestArticlesMode', 'str', 0x07);
INSERT INTO `oxconfig` VALUES ('a1544b76735df7bd7.33980002', 1, 'blConfirmAGB', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('a1544b76735f1c5e3.41421843', 1, 'aZoomImageSizes', 'aarr', 0x4dbace29724a5141a07274204edcbb15d2d328acf5c699c5c961b5a7a697d857bd436fb658ab3a493887f51ae808e94320b08af8f6a61adfa35c30b7e783bc1135dec501ad2044dbd7687502411a6f1ad6406499d626443d87a3d044b627b375703f1dfcc5cfc674c264fb3affbf8abb576c8e5d22fa);
INSERT INTO `oxconfig` VALUES ('a1544b76735f17c78.54278132', 1, 'aDetailImageSizes', 'aarr', 0x4dba326a73d2cdcb471b9533d7800b4b898873f7ae9dc29edf3ce8fab64f8609e31d318807f46516ea31aa94cb0b4edaaf32e7cb502403b480dd7cb1451f56975c3fd6159579cd2cab97104f17ae6a99af864bc1acb550c7e78b82f4618aeb8ba7fbec5409f277e0a2b84e66c24f96ba3fa76665f6a9294d8bf365bf7d3d0d56faf2355df799bc2892994db56203b0f5967ddbe8d403cead91988dfc82772557950eb1ba0d9468f3d8ca7170cde789d6c1282016056e51005091e7440fa453b1235c40010a71ff46f681c74515b4fda6da204abf3178561e271f8202652eabe106a93f9f4d1ed363f2f33c1e29716b95be88112373c48373148b134f2e0312bcfa2f2ba96f5cb15338dee7265d0efc66fe6526a6047b0e2bc4896143076e8dbc7dd8a7448ba2a5233814dd6abc39cb811a4d295c95cdaffde7cb8a5a3fddfe14f9a580973e9660a622f0d774bdb9);
INSERT INTO `oxconfig` VALUES ('a1544b76735e09eb5.40000526', 1, 'blShowBirthdayFields', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('e9244781359d1dd18.54146261', 1, 'iMallPriceAddition', 'str', 0xde);
INSERT INTO `oxconfig` VALUES ('e924478126bb80968.65249125', 1, 'blMallPriceAdditionPercent', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('13c44abc1eb0e08c9.55267104', 1, 'iCacheLifeTime', 'str', 0xb00fb55d00);
INSERT INTO `oxconfig` VALUES ('13c44abc1eb0e6841.92235277', 1, 'aCachableClasses', 'arr', 0x4dba682873e04af3cad2a8e8163c00a3f12c7c5c9004269540d12483cff3c29cdee114412197adf9b241e1d6c74fe8fc9e1ce815996a5eacb8d09fc83e579c765a959bb2c398ad40c7279ed7f2fc27520aca6f9007df58216811bba3b7);
INSERT INTO `oxconfig` VALUES ('a1544b76735df0778.27790276', 1, 'blTopNaviLayout', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('a1544b76735e80574.11610551', 1, 'iTopNaviCatCount', 'str', 0xfb);
INSERT INTO `oxconfig` VALUES ('570601160a3afec28e75fa078c7966a7', 1, 'bl_perfLoadSelectListsInAList', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('570cee633221add7471a25b64dcc44d3', 1, 'bl_perfLoadAttributes', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('a1544b76735e2d8e8.37455553', 1, 'blCalcVATForDelivery', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('a1544b76735e421e0.22942938', 1, 'blCalcVATForPayCharge', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('a1544b76735e48c05.33803554', 1, 'blExclNonMaterialFromDelivery', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('a1544b76735e557a6.57474874', 1, 'blAutoSearchOnCat', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('a1544b76735e63209.62380160', 1, 'blCalcVatForWrapping', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('a1544b76735e7ca13.12478344', 1, 'blNewArtByInsert', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('a1544b76735edac06.77267220', 1, 'sLocalDateFormat', 'str', 0x7170ae);
INSERT INTO `oxconfig` VALUES ('a1544b76735ede2e3.94589565', 1, 'sLocalTimeFormat', 'str', 0x7170ae);
INSERT INTO `oxconfig` VALUES ('a1544b76735efde80.49414162', 1, 'aLanguageURLs', 'arr', 0x4dbaeb2d768d);
INSERT INTO `oxconfig` VALUES ('a1544b76735f04ae6.56548895', 1, 'aLanguageSSLURLs', 'arr', 0x4dbaeb2d768d);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fb6ac06.91704848', 1, 'blVariantParentBuyable', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fb6e4a9.96876634', 1, 'blVariantInheritAmountPrice', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fb6e4a9.96876633', 1, 'blShowVariantReviews', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fb83d07.70346107', 1, 'blAutoSave', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fb8aef2.33450414', 1, 'blGBModerate', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fb8e7a0.12563737', 1, 'blLogging', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fb93c94.74487583', 1, 'blUseLDAP', 'bool', 0x7900fdf51e);
INSERT INTO `oxconfig` VALUES ('e7744be1b5fbacf84.23562842', 1, 'iSessionTimeoutAdmin', 'str', '');
INSERT INTO `oxconfig` VALUES ('e7744be1b5fbb4cf1.34834569', 1, 'iServerTimeShift', 'str', '');
INSERT INTO `oxconfig` VALUES ('e7744be1b5fb9ece3.82840270', 1, 'iAdminLogTime', 'str', 0x17c3);
INSERT INTO `oxconfig` VALUES ('d8d44bbdea56b3ed0.58768595', 1, 'blMallCustomPrice', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('51e44d9a1e3bc2571.58800338', 1, 'blShopStopped', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('565453dd98249dfd8.82247667', 1, 'aCMSfolder', 'aarr', 0x4dba852e754d5636461a94d500fa85e977b4e362efc6891c67a459b290a6f4bdd6e209e22277cecd4f6c4052b78bed9a0d108e2c19712fa655a80dbf45c0c417537711f0c23d9dd7d12767cd78c0582cf18e2d689e312815c1408c2a1f7b6ceed9e1d32094b912d0fc72f6d5ec618ed173cf8a37689d7396);
INSERT INTO `oxconfig` VALUES ('570ad0d40c9e427f2700c397cabefedb', 1, 'bl_perfShowTopBasket', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('e73455b29d0db9b78.23162955', 1, 'blShowFinalStep', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('6f8453f77d174e0a0.31854175', 1, 'blOtherCountryOrder', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('6c914914e95082ddc29d3a4a18a2cc52', 1, 'iRssItemsCount', 'str', 0xb6c7);
INSERT INTO `oxconfig` VALUES ('59f5f862d78d554a4fdedf7c193cd66e', 1, 'aSeoReplaceChars', 'aarr', 0x4dba422a71495232a5777b11e101a218a65b6b8b54eb9139b44875f08d1f732c8b944cff73f2854633a67da52ac4258fecbd4331beae8950ab6d7a407e73fddcddc272e7bb6d190b8cb03718368f899425b48d2108358c2e40c08d0f808894c323ba6240f4d0b7fb5aa4bab1938cc98a9d2045789d6fc428547da6cb0d);
INSERT INTO `oxconfig` VALUES ('8b831f739c5d16cf4571b14a76006568', 1, 'aSEOReservedWords', 'arr', 0x4dba422a71e248f1c8d0aa4c153fcde9eec56a0fcc7c8947b718d1dff30f2db6d7a60c59398fb5e1aa5999cfde45071ab225fba4d72b3ba9c23a4b0adb75314b1e7a2de97adee42d81197c0b48d4621740313f9df1ad63f693b7c47aa031ed88093c0e12eb85a75de769ede4f57823a56c6576106fb7);
INSERT INTO `oxconfig` VALUES ('cb6cdb441255938e1d311bb7104202b8', 1, 'aRssSelected', 'arr', 0x4dbace2972e14bf2cbd3a91552540312fdb89dff9b147c0068096323a537f01e08d3c10e9db1838a83fe046c5136fbf8900f15f0c03307f5e788c7903ceca9e6a5341f11619d68ddd447f63664c6348ec0f55993b4d3923b7d4ce09603e84c4099a7505f62ab3810f0daa3);
INSERT INTO `oxconfig` VALUES ('492443987cda60.43957201', 1, 'blLoadDynContents', 'bool', 0x93ea1218);
INSERT INTO `oxconfig` VALUES ('492443987ce500.72428790', 1, 'sShopCountry', 'str', 0xce92);
INSERT INTO `oxconfig` VALUES ('492443a4043068.56408865', 1, 'IMD', 'str', 0xb0c6);
INSERT INTO `oxconfig` VALUES ('492443a4043110.98442916', 1, 'IMA', 'str', 0xfbc1b45c);
INSERT INTO `oxconfig` VALUES ('492443a40431c7.49835839', 1, 'IMS', 'str', 0x07c4);
INSERT INTO `oxconfig` VALUES ('492443a4042a24.96258369', 1, 'aSerials', 'arr', 0x4dba322c77e44ef7ced6aca7b8550246ca6fd31de97aa3193dcde8b5c5640c55d9b0387c5886f00375cd11bb89a1d33dbe05938f9b);
INSERT INTO `oxconfig` VALUES ('570de5b21e67deb046963bd91a912fb2', 1, 'blUseTimeCheck', 'bool', 0x7900fdf51e);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxcontents`
-- 

DROP TABLE IF EXISTS `oxcontents`;
CREATE TABLE IF NOT EXISTS `oxcontents` (
  `OXID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXLOADID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXSNIPPET` tinyint(1) NOT NULL default '1',
  `OXTYPE` tinyint(1) NOT NULL default '0',
  `OXACTIVE` tinyint(1) NOT NULL default '1',
  `OXACTIVE_1` tinyint(1) NOT NULL default '1',
  `OXPOSITION` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXTITLE` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXCONTENT` text collate latin1_general_ci NOT NULL,
  `OXTITLE_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXCONTENT_1` text collate latin1_general_ci NOT NULL,
  `OXACTIVE_2` tinyint(1) NOT NULL default '1',
  `OXTITLE_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXCONTENT_2` text collate latin1_general_ci NOT NULL,
  `OXACTIVE_3` tinyint(1) NOT NULL default '1',
  `OXTITLE_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXCONTENT_3` text collate latin1_general_ci NOT NULL,
  `OXCATID` varchar(32) collate latin1_general_ci default NULL,
  `OXFOLDER` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXTIMESTAMP` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`OXID`),
  UNIQUE KEY `OXLOADID` (`OXLOADID`,`OXSHOPID`),
  KEY `cat_search` (`OXTYPE`,`OXSHOPID`,`OXSNIPPET`,`OXCATID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxcontents`
-- 

INSERT INTO `oxcontents` VALUES ('c4241316b2e5c1966.96997015', 'oxstartwelcome', 1, 1, 0, 1, 1, '', 'start.tpl Begrüßungstext', '<h1><strong>Willkommen</strong> [{ if $oxcmp_user }]<strong>[{ $oxcmp_user->oxuser__oxfname->value }] [{ $oxcmp_user->oxuser__oxlname->value }] </strong>[{else}] [{/if}][{ if !$oxcmp_user }]<strong>im OXID eShop EE </strong>[{/if}]\r\n</h1>\r\n\r\n<div>Dies ist eine Demo-Installation des <strong>OXID eShop EE 4.0</strong>. Also keine Sorge, wenn Sie bestellen: Die Ware wird weder ausgeliefert, noch in Rechnung gestellt. Die gezeigten Produkte (und Preise) dienen nur zur Veranschaulichung der umfangreichen Funktionalität des Systems.</div>\r\n<div>&nbsp;</div>\r\n\r\n<div><strong>Wir wünschen viel Spass beim Testen!</strong></div>\r\n<div><strong>Ihr OXID eSales Team</strong></div>', 'start.tpl welcome text', '<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> start.tpl welcome text</div>\r\n<div>&nbsp;</div>', 1, '', '', 1, '', '', '30e44ab834ea42417.86131097', 'CMSFOLDER_USERINFO', '2006-08-13 12:22:15');
INSERT INTO `oxcontents` VALUES ('1544167b4666ccdc1.28484600', 'oxblocked', 1, 1, 0, 1, 1, '', 'Benutzer geblockt', '<div><img width="200" height="200" src="[{$shop->currenthomedir}]out/1/pictures/wysiwigpro/stopsign.jpg" alt="" title="">&nbsp;</div>\r\n<div><br>\r\n></div>\r\n<div><span style="color: #ff0000"><strong>Der Zugang wurde Ihnen verweigert !</strong></span></div>\r\n<div>&nbsp;</div>\r\n<div>&nbsp;</div>', 'user blocked', '<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> user blocked</div>\r\n<div>&nbsp;</div>', 1, '', '', 1, '', '', '30e44ab82c03c3848.49471214', 'CMSFOLDER_USERINFO', '2007-04-20 10:03:08');
INSERT INTO `oxcontents` VALUES ('c4241316c6e7b9503.93160420', 'oxbargain', 1, 1, 0, 1, 1, '', 'Schnäppchen', '<table>[{foreach from=$articlebargainlist item=articlebargain_item}] <tbody><tr><td>\r\n<div class="product_image_s_container"><a href="[{$articlebargain_item->oxdetaillink}]"><img border="0" src="[{ $articlebargain_item->dimagedir}]/[{$articlebargain_item->oxarticles__oxicon->value}]" alt="[{ $articlebargain_item->oxarticles__oxtitle->value }][{if $articlebargain_item->oxarticles__oxvarselect->value }] [{ $articlebargain_item->oxarticles__oxvarselect->value }][{/if}] [{$oxcmp_shop->oxshops__oxtitlesuffix->value}]"></a></div> </td><td class="boxrightproduct-td"> <a class="boxrightproduct-td" href="[{$articlebargain_item->oxdetaillink}]"><strong>[{\r\n$articlebargain_item->oxarticles__oxtitle->value|cat:"\r\n"|cat:$articlebargain_item->oxarticles__oxvarselect->value|strip_tags|smartwordwrap:15:"<br>\r\n":2:1:"..."\r\n}]</strong></a><br>\r\n [{ if !$articlebargain_item->blNotBuyable  && !$articlebargain_item->blNotBuyableParent}] <a onclick="showBasketWnd();" class="details" href="[{$articlebargain_item->tobasketlink}]&am=1" rel="nofollow"><img border="0" alt="" src="[{$shop->imagedir}]/arrow_details.gif"> Jetzt bestellen! </a> [{/if}] </td></tr>[{/foreach}]\r\n</tbody></table>', 'Bargain', '<table>[{foreach from=$articlebargainlist item=articlebargain_item}] <tbody><tr><td>\r\n<div class="product_image_s_container"><a href="[{$articlebargain_item->oxdetaillink}]"><img border="0" src="[{ $articlebargain_item->dimagedir}]/[{$articlebargain_item->oxarticles__oxicon->value}]" alt="[{ $articlebargain_item->oxarticles__oxtitle->value }][{if $articlebargain_item->oxarticles__oxvarselect->value }] [{ $articlebargain_item->oxarticles__oxvarselect->value }][{/if}] [{$oxcmp_shop->oxshops__oxtitlesuffix->value}]"></a></div> </td><td class="boxrightproduct-td"> <a class="boxrightproduct-td" href="[{$articlebargain_item->oxdetaillink}]"><strong>[{\r\n$articlebargain_item->oxarticles__oxtitle->value|cat:"\r\n"|cat:$articlebargain_item->oxarticles__oxvarselect->value|strip_tags|smartwordwrap:15:"<br>\r\n ":2:1:"..."\r\n}]</strong></a><br>\r\n [{ if !$articlebargain_item->blNotBuyable  && !$articlebargain_item->blNotBuyableParent}] <a onclick="showBasketWnd();" class="details" href="[{$articlebargain_item->tobasketlink}]&am=1" rel="nofollow"><img border="0" alt="" src="[{$shop->imagedir}]/arrow_details.gif"> Order now! </a> [{/if}] </td></tr>[{/foreach}] </tbody></table>', 1, '', '', 1, '', '', 'oxrootid', 'CMSFOLDER_PRODUCTINFO', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('1074279e67a85f5b1.96907412', 'oxorderinfo', 1, 1, 0, 1, 1, '', 'Wie bestellen?', '<div>Beispieltext:</div>\r\n<div>&nbsp;</div>\r\n<div>OXID eShop, Ihr Online-Shop für ... <br>\r\n<br>\r\nBei uns haben Sie die Wahl aus mehr als ... Artikeln von bester Qualität und namhaften Herstellern. Schauen Sie sich um, stöbern Sie in unseren Angeboten! <br>\r\nOXID eShop steht Ihnen im Internet rund um die Uhr und 7 Tage die Woche offen.<br>\r\n<br>\r\nUnd wenn Sie eine Bestellung aufgeben möchten, können Sie das: \r\n<ul>\r\n<li class="font11">direkt im Internet über unseren Shop </li>\r\n<li class="font11">per Fax unter&nbsp;+49(0)761-36889-29 </li>\r\n<li class="font11">per Telefon unter +49(0)761-36889-0 </li>\r\n<li class="font11">oder per e-Mail unter <a href="mailto:demo@oxid-esales.com?subject=Bestellung"><strong>demo@oxid-esales.com</strong></a> </li></ul>Telefonisch sind wir für Sie <br>\r\nMontag bis Freitag von 10 bis 18 Uhr erreichbar. <br>\r\nWenn Sie auf der Suche nach einem Artikel sind, der zum Sortiment von OXID eShop passen könnte, ihn aber nirgends finden, lassen Sie''s uns wissen. Gern bemühen wir uns um eine Lösung für Sie. <br>\r\n<br>\r\nSchreiben Sie an <a href="mailto:demo@oxid-esales.com?subject=Produktidee"><strong>demo@oxid-esales.com</strong></a>.</div>', 'how to order', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> how to order</div></div>', 1, '', '', 1, '', '', '', 'CMSFOLDER_USERINFO', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('f41427a07519469f1.34718981', 'oxdeliveryinfo', 1, 1, 0, 1, 1, '', 'Versand', '<p>Fügen Sie hier Ihre Versandinformationen- und kosten ein.</p>', 'shipping', '<p>Add your shipping information and costs here.</p>', 1, '', '', 1, '', '', '', 'CMSFOLDER_USERINFO', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('f41427a099a603773.44301043', 'oxsecurityinfo', 1, 1, 0, 1, 1, '', 'Sicherheitsinformationen', 'Fügen Sie hier Ihre Datenschutzbestimmungen ein.', 'security information', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> security information</div></div>', 1, '', '', 1, '', '', '30e44ab82c03c3848.49471214', 'CMSFOLDER_USERINFO', '2007-04-20 10:02:35');
INSERT INTO `oxcontents` VALUES ('f41427a10afab8641.52768563', 'oxnewstlerinfo', 1, 1, 0, 1, 1, '', 'Neuigkeiten bei uns', '<div>Mit dem [{ $oxcmp_shop->oxshops__oxname->value }]-Newsletter alle paar Wochen. <br>\r\nMit Tipps, Infos, Aktionen ... <br>\r\n<br>\r\nDas Abo kann jederzeit durch Austragen der e-Mail-Adresse beendet werden. <br>\r\nEine <span class="newsletter_title">Weitergabe Ihrer Daten an Dritte lehnen wir ab</span>. <br>\r\n<br>\r\nSie bekommen zur Bestätigung nach dem Abonnement eine e-Mail - so stellen wir sicher, dass kein Unbefugter Sie in unseren Newsletter eintragen kann (sog. "Double Opt-In").<br>\r\n<br>\r\n</div>', 'newsletter info', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> newsletter info</div></div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_USERINFO', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('ad542e49541c1add9.70119314', 'oxpassinfoemail', 1, 1, 0, 1, 1, '', 'Ihr Passwort im eShop', 'Hallo [{ $user->oxuser__oxsal->value }] [{\r\n$user->oxuser__oxfname->value }] [{\r\n$user->oxuser__oxlname->value }],<br>\r\n<br>\r\nauf Ihren Wunsch hier die Zugangsdaten zum [{ $shop->oxshops__oxname->value }]:<br>\r\n<br>\r\nIhr Passwort lautet : [{ $user->oxuser__oxpassword->value }].<br>\r\n<br>\r\nIhr [{ $shop->oxshops__oxname->value }] Team<br>', 'password info', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> password info</div></div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('ad542e495c392c6e5.90671640', 'oxpassinfoplainemail', 1, 1, 0, 1, 1, '', 'Ihr Passwort im eShop Plain', 'Hallo [{ $user->oxuser__oxsal->value }] [{\r\n$user->oxuser__oxfname->value }] [{\r\n$user->oxuser__oxlname->value }],\r\n\r\nauf Ihren Wunsch hier die Zugangsdaten zum [{\r\n$shop->oxshops__oxname->value }]:\r\n\r\nIhr Passwort lautet: [{ $user->oxuser__oxpassword->value }].\r\n\r\nIhr [{ $shop->oxshops__oxname->value }] Team', 'password info plain', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> password info plain</div></div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('ad542e49ae50c60f0.64307543', 'oxuserorderemail', 1, 1, 0, 1, 1, '', 'Ihre Bestellung', 'Vielen Dank für Ihre Bestellung!<br>\r\n<br>\r\nNachfolgend haben wir zur Kontrolle Ihre Bestellung noch einmal aufgelistet.<br>\r\nBei Fragen sind wir jederzeit für Sie da: Schreiben Sie einfach an [{ $shop->oxshops__oxorderemail->value }]!<br>\r\n<br>', 'your order', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> your order</div></div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('ad542e49bff479009.64538090', 'oxadminorderemail', 1, 1, 0, 1, 1, '', 'Ihre Bestellung Admin', 'Folgende Artikel wurden soeben unter [{ $shop->oxshops__oxname->value }] bestellt:<br>\r\n<br>', 'your order admin', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> your order admin</div></div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('ad542e49b08c65017.19848749', 'oxuserorderplainemail', 1, 1, 0, 1, 1, '', 'Ihre Bestellung Plain', 'Vielen Dank fuer Ihre Bestellung!\r\n\r\nNachfolgend haben wir zur Kontrolle Ihre Bestellung noch einmal aufgelistet.\r\nBei Fragen sind wir jederzeit fuer Sie da: Schreiben Sie einfach an [{ $shop->oxshops__oxorderemail->value }] !', 'your order plain', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> your order plain</div></div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('ad542e49c19109ad6.04198712', 'oxadminorderplainemail', 1, 1, 0, 1, 1, '', 'Ihre Bestellung Admin Plain', 'Folgende Artikel wurden soeben unter [{ $shop->oxshops__oxname->value }] bestellt :', 'your order admin plain', '<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> your order admin plain</div>\r\n<div>&nbsp;</div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('ad542e49c585394e4.36951640', 'oxpricealarmemail', 1, 1, 0, 1, 1, '', 'Preisalarm', 'Preisalarm im [{ $shop->oxshops__oxname->value }]!<br>\r\n<br>\r\n[{ $email }] bietet für Artikel [{ $product->oxarticles__oxtitle->value }], Artnum. [{ $product->oxarticles__oxartnum->value }]<br>\r\n<br>\r\nOriginalpreis: [{ $product->fprice }] [{ $currency->name}]<br>\r\nGEBOTEN: [{ $bidprice }] [{ $currency->name}]<br>\r\n<br>\r\n<br>\r\nIhr Shop.<br>', 'price alert', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> price alert</div></div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('ad542e49c8ec04201.39247735', 'oxregisteremail', 1, 1, 0, 1, 1, '', 'Vielen Dank für Ihre Registrierung', 'Hallo, [{ $user->oxuser__oxsal->value }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }], vielen Dank für Ihre Registrierung bei [{ $shop->oxshops__oxname->value }] !<br>\r\n<br>\r\nSie können sich ab sofort auch mit Ihrer Kundennummer <strong>[{ $user->oxuser__oxcustnr->value }]</strong> einloggen.<br>\r\n<br>\r\nIhr [{ $shop->oxshops__oxname->value }] Team<br>', 'thanks for your registration', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> thanks for your registration</div></div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('ad542e49ca4750015.09588134', 'oxregisterplainemail', 1, 1, 0, 1, 1, '', 'Vielen Dank für Ihre Registrierung Plain', '[{ $shop->oxshops__oxregistersubject->value }] Hallo, [{ $user->oxuser__oxsal->value }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }], vielen Dank fuer Ihre Registrierung bei [{ $shop->oxshops__oxname->value }] ! Sie koennnen sich ab sofort auch mit Ihrer Kundennummer ([{ $user->oxuser__oxcustnr->value }]) einloggen. Ihr [{ $shop->oxshops__oxname->value }] Team', 'thanks for your registration plain', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> thanks for your registration plain</div></div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('ad542e49d6de4a4f4.88594616', 'oxordersendemail', 1, 1, 0, 1, 1, '', 'Ihre Bestellung wurde versandt', 'Guten Tag, [{ $order->oxorder__oxbillsal->value }] [{ $order->oxorder__oxbillfname->value }] [{ $order->oxorder__oxbilllname->value }],<br>\r\n<br>\r\nunser Vertriebszentrum hat soeben folgende Artikel versandt.<br>\r\n<br>', 'your order has been shipped', '<div>\r\n<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> your order has been shipped</div></div></div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('ad542e49d856b5b68.98220446', 'oxordersendplainemail', 1, 1, 0, 1, 1, '', 'Ihre Bestellung wurde versandt Plain', 'Guten Tag [{ $order->oxorder__oxbillsal->value }] [{\r\n$order->oxorder__oxbillfname->value }] [{\r\n$order->oxorder__oxbilllname->value }],\r\n\r\nunser Vertriebszentrum hat soeben folgende Artikel versandt.', 'your order has been shipped plain', '<div>\r\n<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> your order has been shipped plain</div></div></div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('84a42e66105998a86.14045828', 'oxuserorderemailend', 1, 1, 0, 1, 1, '', 'Ihre Bestellung Abschluss', '<div align="left">Fügen Sie hier Ihre Widerrufsbelehrung ein.</div>', 'your order terms', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> your order terms</div></div>', 1, '', '', 1, '', '', '30e44ab82c03c3848.49471214', 'CMSFOLDER_EMAILS', '2007-04-20 10:09:31');
INSERT INTO `oxcontents` VALUES ('84a42e66123887821.29772527', 'oxuserorderemailendplain', 1, 1, 0, 1, 1, '', 'Ihre Bestellung Abschluss Plain', 'Fügen Sie hier Ihre Widerrufsbelehrung ein.', 'your order terms plain', '<div>\r\n<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> your order terms plain</div></div></div>', 1, '', '', 1, '', '', '30e44ab82c03c3848.49471214', 'CMSFOLDER_EMAILS', '2007-04-20 10:09:51');
INSERT INTO `oxcontents` VALUES ('c8d45408c08bbaf79.09887022', 'oxuserordernpemail', 1, 1, 0, 1, 1, '', 'Ihre Bestellung (Fremdländer)', '<div>Vielen Dank für Ihre Bestellung!</div>\r\n<p><strong><span style="color: #ff0000">Hinweis:</span></strong> Derzeit ist uns keine Versandmethode für dieses Land bekannt. Wir werden versuchen, Versandmethoden zu finden und Sie über das Ergebnis unter Angabe der Versandkosten informieren. </p>Bei Fragen sind wir jederzeit für Sie da: Schreiben Sie einfach an [{ $shop->oxshops__oxorderemail->value }]! <br />\r\n<br />', 'your order (other country)', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> your order</div></div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('c8d45408c4998f421.15746968', 'oxadminordernpemail', 1, 1, 0, 1, 1, '', 'Ihre Bestellung Admin (Fremdländer)', '<div>\r\n<p> <span style="color: #ff0000;"><strong>Hinweis:</strong></span> Derzeit ist keine Liefermethode für dieses Land bekannt. Bitte Liefermöglichkeiten suchen und den Besteller unter Angabe der <strong>Lieferkosten</strong> informieren!\r\n&nbsp;</p> </div>\r\n<div>Folgende Artikel wurden soeben unter [{ $shop->oxshops__oxname->value }] bestellt:<br>\r\n<br>\r\n</div>', 'your order admin (other country)', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> your order admin</div></div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('c8d45408c5c39ea22.75925645', 'oxuserordernpplainemail', 1, 1, 0, 1, 1, '', 'Ihre Bestellung (Fremdländer) Plain', 'Vielen Dank für Ihre Bestellung!\r\n\r\nHinweis: Derzeit ist uns keine Versandmethode für dieses Land bekannt. Wir werden versuchen, Versandmethoden zu finden und Sie über das Ergebnis unter Angabe der Versandkosten informieren.\r\n\r\nBei Fragen sind wir jederzeit für Sie da: Schreiben Sie einfach an [{ $shop->oxshops__oxorderemail->value }]!', 'your order plain (other country)', 'Notice for Shop Administrator:\r\n \r\nUpdate this text easily and comfortable in the Admin with a WYSYWYG-Editor. \r\n \r\nAdmin Menu: Customer Info -> CMS Pages -> your order plain\r\n\r\n', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('c8d45408c718782f3.21298666', 'oxadminordernpplainemail', 1, 1, 0, 1, 1, '', 'Ihre Bestellung Admin (Fremdländer) Plain', 'Hinweis: Derzeit ist keine Liefermethode für dieses Land bekannt. Bitte Liefermöglichkeiten suchen und den Besteller informieren!\r\n\r\nFolgende Artikel wurden soeben unter [{ $shop->oxshops__oxname->value }] bestellt:', 'your order admin plain (other country)', 'Notice for Shop Administrator:\r\n \r\nUpdate this text easily and comfortable in the Admin with a WYSYWYG-Editor. \r\n \r\nAdmin Menu: Customer Info -> CMS Pages -> your order admin plain\r\n', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('29142e76dd32dd477.41262508', 'oxforgotpwd', 1, 1, 0, 1, 1, '', 'Passwort vergessen', 'Sollten Sie innerhalb der nächsten Minuten KEINE e-Mail mit Ihren Zugangsdaten erhalten, so überprüfen Sie bitte: Haben Sie sich in unserem Shop bereits registriert? Wenn nicht, so tun Sie dies bitte einmalig im Rahmen des Bestellprozesses. Sie können dann selbst ein Passwort festlegen. Sobald Sie registriert sind, können Sie sich in Zukunft mit Ihrer e-Mail-Adresse und Ihrem Passwort einloggen.\r\n<ul>\r\n<li class="font11">Wenn Sie sich sicher sind, dass Sie sich in unserem Shop bereits registriert haben, dann überprüfen Sie bitte, ob Sie sich bei der Eingabe Ihrer e-Mail-Adresse evtl. vertippt haben.</li></ul>\r\n<p>Sollten Sie trotz korrekter e-Mail-Adresse und bereits bestehender Registrierung weiterhin Probleme mit dem Login haben und auch keine "Passwort vergessen"-e-Mail erhalten, so wenden Sie sich bitte per e-Mail an: <a href="mailto:demo@oxid-esales.com?subject=Passwort"><strong>demo@oxid-esales.com</strong></a></p>', '', '', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('ad542e49975709a72.52261121', 'oxnewsletteremail', 1, 1, 0, 1, 1, '', 'Newsletter eShop', 'Hallo, [{ $user->oxuser__oxsal->value }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],<br>\r\nvielen Dank fuer Ihre Anmeldung zu unserem Newsletter.<br>\r\n<br>\r\nUm den Newsletter freizuschalten klicken Sie bitte auf folgenden Link:<br>\r\n<br>\r\n<a href="[{$shop->selflink}]cl=newsletter&fnc=addme&uid=[{ $user->oxuser__oxid->value}]">[{$shop->selflink}]cl=newsletter&fnc=addme&uid=[{ $user->oxuser__oxid->value}]</a><br>\r\n<br>\r\nIhr [{ $shop->oxshops__oxname->value }] Team<br>', 'newsletter confirmation', '<div>\r\n<div><strong>Notice for Shop Administrator:</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Update this text easily and comfortable in the Admin with a WYSYWYG-Editor.<strong>&nbsp;</strong></div>\r\n<div>&nbsp;</div>\r\n<div>Admin Menu: Customer Info -> CMS Pages -> newsletter confirmation</div></div>', 1, '', '', 1, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('90345702449c7eef6.07775979', 'oxnewsletterplainemail', 1, 1, 0, 1, 1, '', 'Newsletter eShop Plain', 'Hallo, [{ $user->oxuser__oxsal->value }] [{ $user->oxuser__oxfname->value }] [{ $user->oxuser__oxlname->value }],\r\n\r\nvielen Dank fuer Ihre Anmeldung zu unserem Newsletter.\r\nUm den Newsletter freizuschalten klicken Sie bitte auf folgenden Link:\r\n[{$shop->selflink}]cl=newsletter&fnc=addme&uid=[{ $user->oxuser__oxid->value}]\r\n\r\nIhr [{ $shop->oxshops__oxname->value }] Team', 'newsletter confirmation plain', 'Notice for Shop Administrator:\r\n\r\nUpdate this text easily and comfortable in the Admin with a WYSYWYG-Editor.\r\n\r\nAdmin Menu: Customer Info -> CMS Pages -> newsletter confirmation plain', 1, '', '', 1, '', '', '30e44ab82c03c3848.49471214', 'CMSFOLDER_EMAILS', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('e7a4518ce1e2c36a9.60268505', 'oxfirststart', 1, 1, 0, 1, 1, '', 'UNSER SCHNÄPPCHEN !', '<div> Gültig solange Vorrat reicht. </div>', 'Our Bargain!', '<div>As long as supply lasts&nbsp;</div>', 1, '', '', 1, '', '', '', 'CMSFOLDER_PRODUCTINFO', '2007-04-20 10:10:12');
INSERT INTO `oxcontents` VALUES ('0a0456569ed67b9f2.04660638', 'oxrightofwithdrawal', 1, 1, 0, 1, 1, '', 'Widerrufsrecht', 'Fügen Sie hier Ihre Widerrufsbelehrung ein.', 'Rights of Withdrawal', '<div>English version of rights of withdrawal&nbsp;</div>', 1, '', '', 1, '', '', '30e44ab82c03c3848.49471214', 'CMSFOLDER_USERINFO', '2007-04-20 10:10:23');
INSERT INTO `oxcontents` VALUES ('2eb46767947d21851.22681675', 'oximpressum', 1, 1, 0, 1, 1, '', 'Impressum', '<p>Fügen Sie hier Ihre Anbieterkennzeichnung ein.</p>', 'About Us', '<p>Add provider identification here.</p>', 0, '', '', 0, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_USERINFO', '2007-04-20 10:10:23');
INSERT INTO `oxcontents` VALUES ('2eb4676806a3d2e87.06076523', 'oxagb', 1, 1, 0, 1, 1, '', 'AGB', '<div><strong>AGB</strong></div>\r\n<div><strong>&nbsp;</strong></div>\r\n<div>Fügen Sie hier Ihre allgemeinen Geschäftsbedingungen ein:</div>\r\n<div>&nbsp;</div>\r\n<div><span style="font-weight: bold">Strukturvorschlag:</span><br>\r\n<br>\r\n<ol>\r\n<li>Geltungsbereich </li>\r\n<li>Vertragspartner </li>\r\n<li>Angebot und Vertragsschluss </li>\r\n<li>Widerrufsrecht, Widerrufsbelehrung, Widerrufsfolgen </li>\r\n<li>Preise und Versandkosten </li>\r\n<li>Lieferung </li>\r\n<li>Zahlung </li>\r\n<li>Eigentumsvorbehalt </li>\r\n<li>Gewährleistung </li>\r\n<li>Weitere Informationen</li></ol></div>', 'Terms', 'English AGB', 0, '', '', 0, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_USERINFO', '2007-04-20 10:10:23');
INSERT INTO `oxcontents` VALUES ('8705399d7b7960d0d17faba5e90bcf52', 'oxstdfooter', 1, 1, 0, 1, 1, '', 'Standard Footer', '<div>OXID Geschenke Shop - Geschenkideen für alle Anlässe günstig online kaufen</div>\r\n<div>Online Versand für Trend-Produkte, Lifestyle-Artikel und Accessoires</div>\r\n<div>Witzige, originelle Geschenke bestellen</div>', 'Standard Footer', '<div>OXID Gift Shop - Buy gift ideas for all ocasions online</div>\r\n<div>Online store for trndy products, lifestyle articles and accessories</div>\r\n<div>Order funny and original presents online</div>', 1, '', '', 1, '', '', '30e44ab82c03c3848.49471214', '', '0000-00-00 00:00:00');
INSERT INTO `oxcontents` VALUES ('ce79015b6f6f07612270975889', 'oxstartmetadescription', 1, 1, 0, 1, 1, '', 'META Description Startseite', 'Witzige und originelle Geschenke. Online Versand für Trend-Produkte, Lifestyle-Artikel und Accessoires. Geschenkideen für alle Anlässe günstig online kaufen.', 'META Description Startseite', 'Funny and original presents. Online store for trendy products, lifestyle articles and accessories. Gift ideas for all occasions.', 1, '', '', 1, '', '', '30e44ab82c03c3848.49471214', '', '2008-07-01 16:02:20');
INSERT INTO `oxcontents` VALUES ('ce77743c334edf92b0cab924a7', 'oxstartmetakeywords', 1, 1, 0, 1, 1, '', 'META Keywords Startseite', 'geschenk, geschenke, geschenkideen, geschenkeshop, trend-produkte, lifestyle-artikel, lifestyle, accessoires, geburtstagsgeschenke, hochzeitsgeschenke', 'META Keywords Startseite', 'gifts, gift, gift ideas, presents, birthday gifts, gift shop, wedding gifts, lifestyle products, accessories', 1, '', '', 1, '', '', '30e44ab82c03c3848.49471214', '', '2008-07-01 16:06:45');
INSERT INTO `oxcontents` VALUES ('42e4667ffcf844be0.22563656', 'oxemailfooter', 1, 1, 0, 1, 1, '', 'E-Mail Fußtext', '<p align="left">--</p align="left">\r\n<p>Bitte fügen Sie hier Ihre vollständige Anbieterkennzeichnung ein.</p>', '', '', 0, '', '', 0, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '2008-07-01 16:06:45');
INSERT INTO `oxcontents` VALUES ('3194668fde854d711.73798992', 'oxemailfooterplain', 1, 1, 0, 1, 1, '', 'E-Mail Fußtext Plain', '-- Bitte fügen Sie hier Ihre vollständige Anbieterkennzeichnung ein.', 'Email footer', '', 0, '', '', 0, '', '', '8a142c3e4143562a5.46426637', 'CMSFOLDER_EMAILS', '2008-07-01 16:06:45');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxcountry`
-- 

DROP TABLE IF EXISTS `oxcountry`;
CREATE TABLE IF NOT EXISTS `oxcountry` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXACTIVE` tinyint(1) NOT NULL default '0',
  `OXTITLE` char(128) collate latin1_general_ci NOT NULL default '',
  `OXISOALPHA2` char(2) collate latin1_general_ci NOT NULL default '',
  `OXISOALPHA3` char(3) collate latin1_general_ci NOT NULL default '',
  `OXUNNUM3` char(3) collate latin1_general_ci NOT NULL default '',
  `OXORDER` int(11) NOT NULL default '9999',
  `OXSHORTDESC` char(255) collate latin1_general_ci NOT NULL default '',
  `OXLONGDESC` char(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_1` char(128) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_2` char(128) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_3` char(128) collate latin1_general_ci NOT NULL default '',
  `OXSHORTDESC_1` char(128) collate latin1_general_ci NOT NULL default '',
  `OXSHORTDESC_2` char(128) collate latin1_general_ci NOT NULL default '',
  `OXSHORTDESC_3` char(128) collate latin1_general_ci NOT NULL default '',
  `OXLONGDESC_1` char(255) collate latin1_general_ci NOT NULL,
  `OXLONGDESC_2` char(255) collate latin1_general_ci NOT NULL,
  `OXLONGDESC_3` char(255) collate latin1_general_ci NOT NULL,
  `OXVATSTATUS` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `OXACTIVE` (`OXACTIVE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxcountry`
-- 

INSERT INTO `oxcountry` VALUES ('a7c40f631fc920687.20179984', 1, 'Deutschland', 'DE', 'DEU', '276', 9999, 'EU1', '', 'Germany', '', '', 'EU1', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('a7c40f6320aeb2ec2.72885259', 1, 'Österreich', 'AT', 'AUT', '40', 9999, 'EU1', '', 'Austria', '', '', 'EU1', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('a7c40f6321c6f6109.43859248', 1, 'Schweiz', 'CH', 'CHE', '756', 9999, 'EU1', '', 'Switzerland', '', '', 'EU1', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('a7c40f6322d842ae3.83331920', 0, 'Liechtenstein', 'LI', 'LIE', '438', 9999, 'EU1', '', 'Liechtenstein', '', '', 'EU1', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('a7c40f6323c4bfb36.59919433', 0, 'Italien', 'IT', 'ITA', '380', 9999, 'EU1', '', 'Italy', '', '', 'EU1', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('a7c40f63264309e05.58576680', 0, 'Luxemburg', 'LU', 'LUX', '442', 9999, 'EU1', '', 'Luxembourg', '', '', 'EU1', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('a7c40f63272a57296.32117580', 0, 'Frankreich', 'FR', 'FRA', '250', 9999, 'EU1', '', 'France', '', '', 'EU1', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('a7c40f632848c5217.53322339', 0, 'Schweden', 'SE', 'SWE', '752', 9999, 'EU2', '', 'Sweden', '', '', 'EU2', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('a7c40f63293c19d65.37472814', 0, 'Finnland', 'FI', 'FIN', '246', 9999, 'EU2', '', 'Finland', '', '', 'EU2', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('a7c40f632a0804ab5.18804076', 0, 'Grossbritannien', 'GB', 'GBR', '826', 9999, 'EU2', '', 'United Kingdom', '', '', 'EU2', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('a7c40f632be4237c2.48517912', 0, 'Irland', 'IE', 'IRL', '372', 9999, 'EU2', '', 'Ireland', '', '', 'EU2', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('a7c40f632cdd63c52.64272623', 0, 'Niederlande', 'NL', 'NLD', '528', 9999, 'EU2', '', 'Netherlands', '', '', 'EU2', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('a7c40f632e04633c9.47194042', 0, 'Belgien', 'BE', 'BEL', '56', 9999, 'Rest Europäische Union', '', 'Belgium', '', '', 'Rest of EU', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('a7c40f632f65bd8e2.84963272', 0, 'Portugal', 'PT', 'PRT', '620', 9999, 'Rest Europäische Union', '', 'Portugal', '', '', 'Rest of EU', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('a7c40f633038cd578.22975442', 0, 'Spanien', 'ES', 'ESP', '724', 9999, 'Rest Europäische Union', '', 'Spain', '', '', 'Rest of EU', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('a7c40f633114e8fc6.25257477', 0, 'Griechenland', 'GR', 'GRC', '300', 9999, 'Rest Europäische Union', '', 'Greece', '', '', 'Rest of EU', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('8f241f11095306451.36998225', 0, 'Afghanistan', 'AF', 'AFG', '4', 9999, 'Rest Welt', '', 'Afghanistan', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110953265a5.25286134', 0, 'Albanien', 'AL', 'ALB', '8', 9999, 'Rest Europa', '', 'Albania', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109533b943.50287900', 0, 'Algerien', 'DZ', 'DZA', '12', 9999, 'Rest Welt', '', 'Algeria', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109534f8c7.80349931', 0, 'Amerikanisch-Samoa', 'AS', 'ASM', '16', 9999, 'Rest Welt', '', 'American Samoa', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095363464.89657222', 0, 'Andorra', 'AD', 'AND', '20', 9999, 'Europa', '', 'Andorra', '', '', 'Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095377d33.28678901', 0, 'Angola', 'AO', 'AGO', '24', 9999, 'Rest Welt', '', 'Angola', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095392e41.74397491', 0, 'Anguilla', 'AI', 'AIA', '660', 9999, 'Rest Welt', '', 'Anguilla', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110953a8d10.29474848', 0, 'Antarktis', 'AQ', 'ATA', '10', 9999, 'Rest Welt', '', 'Antarctica', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110953be8f2.56248134', 0, 'Antigua Und Barbuda', 'AG', 'ATG', '28', 9999, 'Rest Welt', '', 'Antigua And Barbuda', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110953d2fb0.54260547', 0, 'Argentinien', 'AR', 'ARG', '32', 9999, 'Rest Welt', '', 'Argentina', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110953e7993.88180360', 0, 'Armenien', 'AM', 'ARM', '51', 9999, 'Rest Europa', '', 'Armenia', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110953facc6.31621036', 0, 'Aruba', 'AW', 'ABW', '533', 9999, 'Rest Welt', '', 'Aruba', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095410f38.37165361', 0, 'Australien', 'AU', 'AUS', '36', 9999, 'Rest Welt', '', 'Australia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109543cf47.17877015', 0, 'Aserbaidschan', 'AZ', 'AZE', '31', 9999, 'Rest Welt', '', 'Azerbaijan', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095451379.72078871', 0, 'Bahamas', 'BS', 'BHS', '44', 9999, 'Rest Welt', '', 'Bahamas', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110954662e3.27051654', 0, 'Bahrain', 'BH', 'BHR', '48', 9999, 'Welt', '', 'Bahrain', '', '', 'World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109547ae49.60154431', 0, 'Bangladesh', 'BD', 'BGD', '50', 9999, 'Rest Welt', '', 'Bangladesh', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095497083.21181725', 0, 'Barbados', 'BB', 'BRB', '52', 9999, 'Rest Welt', '', 'Barbados', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110954ac5b9.63105203', 0, 'Belarus', 'BY', 'BLR', '112', 9999, 'Rest Europa', '', 'Belarus', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110954d3621.45362515', 0, 'Belize', 'BZ', 'BLZ', '84', 9999, 'Rest Welt', '', 'Belize', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110954ea065.41455848', 0, 'Benin', 'BJ', 'BEN', '204', 9999, 'Rest Welt', '', 'Benin', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110954fee13.50011948', 0, 'Bermuda', 'BM', 'BMU', '60', 9999, 'Rest Welt', '', 'Bermuda', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095513ca0.75349731', 0, 'Bhutan', 'BT', 'BTN', '64', 9999, 'Rest Welt', '', 'Bhutan', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109552aee2.91004965', 0, 'Bolivien', 'BO', 'BOL', '68', 9999, 'Rest Welt', '', 'Bolivia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109553f902.06960438', 0, 'Bosnien-Herzegowina', 'BA', 'BIH', '70', 9999, 'Rest Europa', '', 'Bosnia And Herzegovina', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095554834.54199483', 0, 'Botsuana', 'BW', 'BWA', '72', 9999, 'Rest Welt', '', 'Botswana', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109556dd57.84292282', 0, 'Bouvet-insel', 'BV', 'BVT', '74', 9999, 'Rest Welt', '', 'Bouvet Island', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095592407.89986143', 0, 'Brasilien', 'BR', 'BRA', '76', 9999, 'Rest Welt', '', 'Brazil', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110955a7644.68859180', 0, 'Britische Territorien im Indischen Ozean', 'IO', 'IOT', '86', 9999, 'Rest Welt', '', 'British Indian Ocean Territory', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110955bde61.63256042', 0, 'Brunei (Sultanat Brunei)', 'BN', 'BRN', '96', 9999, 'Rest Welt', '', 'Brunei Darussalam', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110955d3260.55487539', 0, 'Bulgarien', 'BG', 'BGR', '100', 9999, 'Rest Europa', '', 'Bulgaria', '', '', 'Rest Europe', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('8f241f110955ea7c8.36762654', 0, 'Burkina Faso', 'BF', 'BFA', '854', 9999, 'Rest Welt', '', 'Burkina Faso', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110956004d5.11534182', 0, 'Burundi', 'BI', 'BDI', '108', 9999, 'Rest Welt', '', 'Burundi', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110956175f9.81682035', 0, 'Kambodscha', 'KH', 'KHM', '116', 9999, 'Rest Welt', '', 'Cambodia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095632828.20263574', 0, 'Kamerun', 'CM', 'CMR', '120', 9999, 'Rest Welt', '', 'Cameroon', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095649d18.02676059', 0, 'Kanada', 'CA', 'CAN', '124', 9999, 'Welt', '', 'Canada', '', '', 'World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109565e671.48876354', 0, 'Kap Verde', 'CV', 'CPV', '132', 9999, 'Rest Welt', '', 'Cape Verde', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095673248.50405852', 0, 'Kaiman-Inseln', 'KY', 'CYM', '136', 9999, 'Rest Welt', '', 'Cayman Islands', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109568a509.03566030', 0, 'Zentralafrikanische Republik', 'CF', 'CAF', '140', 9999, 'Rest Welt', '', 'Central African Republic', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109569d4c2.42800039', 0, 'Tschad', 'TD', 'TCD', '148', 9999, 'Rest Welt', '', 'Chad', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110956b3ea7.11168270', 0, 'Chile', 'CL', 'CHL', '152', 9999, 'Rest Welt', '', 'Chile', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110956c8860.37981845', 0, 'China', 'CN', 'CHN', '156', 9999, 'Rest Welt', '', 'China', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110956df6b2.52283428', 0, 'Weihnachtsinsel (AUS)', 'CX', 'CXR', '162', 9999, 'Rest Welt', '', 'Christmas Island', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110956f54b4.26327849', 0, 'Cocos (Keeling) Inseln', 'CC', 'CCK', '166', 9999, 'Rest Welt', '', 'Cocos (keeling) Islands', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109570a1e3.69772638', 0, 'Kolumbien', 'CO', 'COL', '170', 9999, 'Rest Welt', '', 'Colombia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109571f018.46251535', 0, 'Komoren', 'KM', 'COM', '174', 9999, 'Rest Welt', '', 'Comoros', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095732184.72771986', 0, 'Der Kongo', 'CG', 'COG', '178', 9999, 'Rest Welt', '', 'Congo', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095746a92.94878441', 0, 'Cook-Inseln', 'CK', 'COK', '184', 9999, 'Rest Welt', '', 'Cook Islands', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109575d708.20084150', 0, 'Costa Rica', 'CR', 'CRI', '188', 9999, 'Rest Welt', '', 'Costa Rica', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095771f76.87904122', 0, 'Elfenbeinküste (Cote d''Ivoire)', 'CI', 'CIV', '384', 9999, 'Rest Welt', '', 'Cote D''ivoire', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095789a04.65154246', 0, 'Kroatien', 'HR', 'HRV', '191', 9999, 'Rest Europa', '', 'Croatia', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109579ef49.91803242', 0, 'Kuba', 'CU', 'CUB', '192', 9999, 'Rest Welt', '', 'Cuba', '', '', 'World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110957b6896.52725150', 0, 'Zypern', 'CY', 'CYP', '196', 9999, 'Rest Europa', '', 'Cyprus', '', '', 'Rest Europe', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('8f241f110957cb457.97820918', 0, 'Tschechien', 'CZ', 'CZE', '203', 9999, 'Europa', '', 'Czech Republic', '', '', 'Europe', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('8f241f110957e6ef8.56458418', 0, 'Dänemark', 'DK', 'DNK', '208', 9999, 'Europa', '', 'Denmark', '', '', 'Europe', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('8f241f110957fd356.02918645', 0, 'Dschibuti', 'DJ', 'DJI', '262', 9999, 'Rest Welt', '', 'Djibouti', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095811ea5.84717844', 0, 'Dominica', 'DM', 'DMA', '212', 9999, 'Rest Welt', '', 'Dominica', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095825bf2.61063355', 0, 'Dominikanische Republik', 'DO', 'DOM', '214', 9999, 'Rest Welt', '', 'Dominican Republic', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095839323.86755169', 0, 'Ost-Timor', 'TL', 'TLS', '626', 9999, 'Rest Welt', '', 'East Timor', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109584d512.06663789', 0, 'Ecuador', 'EC', 'ECU', '218', 9999, 'Rest Welt', '', 'Ecuador', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095861fb7.55278256', 0, 'Ägypten', 'EG', 'EGY', '818', 9999, 'Welt', '', 'Egypt', '', '', 'World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110958736a9.06061237', 0, 'El Salvador', 'SV', 'SLV', '222', 9999, 'Rest Welt', '', 'El Salvador', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109588d077.74284490', 0, 'Äquatorialguinea', 'GQ', 'GNQ', '226', 9999, 'Rest Welt', '', 'Equatorial Guinea', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110958a2216.38324531', 0, 'Eritrea', 'ER', 'ERI', '232', 9999, 'Rest Welt', '', 'Eritrea', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110958b69e4.93886171', 0, 'Estland', 'EE', 'EST', '233', 9999, 'Rest Europa', '', 'Estonia', '', '', 'Rest Europe', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('8f241f110958caf67.08982313', 0, 'Äthiopien', 'ET', 'ETH', '210', 9999, 'Rest Welt', '', 'Ethiopia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110958e2cc3.90770249', 0, 'Falklandinseln (malvinas)', 'FK', 'FLK', '238', 9999, 'Rest Welt', '', 'Falkland Islands (malvinas)', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110958f7ba4.96908065', 0, 'Färöer', 'FO', 'FRO', '234', 9999, 'Rest Welt', '', 'Faroe Islands', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109590d226.07938729', 0, 'Fidschi', 'FJ', 'FJI', '242', 9999, 'Rest Welt', '', 'Fiji', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109594fcb1.79441780', 0, 'Französisch-Guayana', 'GF', 'GUF', '254', 9999, 'Rest Welt', '', 'French Guiana', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110959636f5.71476354', 0, 'Französisch-Polynesien', 'PF', 'PYF', '258', 9999, 'Rest Welt', '', 'French Polynesia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110959784a3.34264829', 0, 'Französischen Süd- und Antarktisgebiete', 'TF', 'ATF', '260', 9999, 'Rest Welt', '', 'French Southern Territories', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095994cb6.59353392', 0, 'Gabun', 'GA', 'GAB', '266', 9999, 'Rest Welt', '', 'Gabon', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110959ace77.17379319', 0, 'Gambia', 'GM', 'GMB', '270', 9999, 'Rest Welt', '', 'Gambia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110959c2341.01830199', 0, 'Georgien', 'GE', 'GEO', '268', 9999, 'Rest Europa', '', 'Georgia', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110959e96b3.05752152', 0, 'Ghana', 'GH', 'GHA', '288', 9999, 'Rest Welt', '', 'Ghana', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110959fdde0.68919405', 0, 'Gibraltar', 'GI', 'GIB', '292', 9999, 'Rest Welt', '', 'Gibraltar', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095a29f47.04102343', 0, 'Grönland', 'GL', 'GRL', '304', 9999, 'Europa', '', 'Greenland', '', '', 'Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095a3f195.88886789', 0, 'Grenada', 'GD', 'GRD', '308', 9999, 'Rest Welt', '', 'Grenada', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095a52578.45413493', 0, 'Guadeloupe', 'GP', 'GLP', '312', 9999, 'Rest Welt', '', 'Guadeloupe', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095a717b3.68126681', 0, 'Guam', 'GU', 'GUM', '316', 9999, 'Rest Welt', '', 'Guam', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095a870a5.42235635', 0, 'Guatemala', 'GT', 'GTM', '320', 9999, 'Rest Welt', '', 'Guatemala', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095a9bf82.19989557', 0, 'Guine', 'GN', 'GIN', '324', 9999, 'Rest Welt', '', 'Guinea', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095ab2b56.83049280', 0, 'Guinea-Bissau', 'GW', 'GNB', '624', 9999, 'Rest Welt', '', 'Guinea-bissau', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095ac9d30.56640429', 0, 'Guyana', 'GY', 'GUY', '328', 9999, 'Rest Welt', '', 'Guyana', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095aebb06.34405179', 0, 'Haiti', 'HT', 'HTI', '332', 9999, 'Rest Welt', '', 'Haiti', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095aff2c3.98054755', 0, 'Australien Heard und McDonald Inseln', 'HM', 'HMD', '334', 9999, 'Rest Welt', '', 'Heard Island & Mcdonald Islands', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095b13f57.56022305', 0, 'Honduras', 'HN', 'HND', '340', 9999, 'Rest Welt', '', 'Honduras', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095b29021.49657118', 0, 'Hong Kong', 'HK', 'HKG', '344', 9999, 'Rest Welt', '', 'Hong Kong', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095b3e016.98213173', 0, 'Ungarn', 'HU', 'HUN', '348', 9999, 'Rest Europa', '', 'Hungary', '', '', 'Rest Europe', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('8f241f11095b55846.26192602', 0, 'Island', 'IS', 'ISL', '352', 9999, 'Rest Europa', '', 'Iceland', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095b6bb86.01364904', 0, 'Indien', 'IN', 'IND', '356', 9999, 'Rest Welt', '', 'India', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095b80526.59927631', 0, 'Indonesien', 'ID', 'IDN', '360', 9999, 'Rest Welt', '', 'Indonesia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095b94476.05195832', 0, 'Iran', 'IR', 'IRN', '364', 9999, 'Welt', '', 'Iran', '', '', 'World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095bad5b2.42645724', 0, 'Irak', 'IQ', 'IRQ', '368', 9999, 'Welt', '', 'Iraq', '', '', 'World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095bd65e1.59459683', 0, 'Israel', 'IL', 'ISR', '376', 9999, 'Rest Europa', '', 'Israel', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095bfe834.63390185', 0, 'Jamaika', 'JM', 'JAM', '388', 9999, 'Rest Welt', '', 'Jamaica', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095c11d43.73419747', 0, 'Japan', 'JP', 'JPN', '392', 9999, 'Rest Welt', '', 'Japan', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095c2b304.75906962', 0, 'Jordanien', 'JO', 'JOR', '400', 9999, 'Rest Welt', '', 'Jordan', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095c3e2d1.36714463', 0, 'Kasachstan', 'KZ', 'KAZ', '398', 9999, 'Rest Europa', '', 'Kazakhstan', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095c5b8e8.66333679', 0, 'Kenia', 'KE', 'KEN', '404', 9999, 'Rest Welt', '', 'Kenya', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095c6e184.21450618', 0, 'Kiribati', 'KI', 'KIR', '296', 9999, 'Rest Welt', '', 'Kiribati', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095c87284.37982544', 0, 'Nordkorea', 'KP', 'PRK', '408', 9999, 'Rest Welt', '', 'North Korea', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095c9de64.01275726', 0, 'Südkorea', 'KR', 'KOR', '410', 9999, 'Rest Welt', '', 'South Korea', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095cb1546.46652174', 0, 'Kuwait', 'KW', 'KWT', '414', 9999, 'Welt', '', 'Kuwait', '', '', 'World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095cc7ef5.28043767', 0, 'Kirgisistans', 'KG', 'KGZ', '417', 9999, 'Rest Welt', '', 'Kyrgyzstan', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095cdccd5.96388808', 0, 'Laos (Demokratische Volksrepublik Laos)', 'LA', 'LAO', '418', 9999, 'Rest Welt', '', 'Lao People''s Democratic Republic', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095cf2ea6.73925511', 0, 'Latvia', 'LV', 'LVA', '428', 9999, 'Rest Europa', '', 'Latvia', '', '', 'Rest Europe', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('8f241f11095d07d87.58986129', 0, 'Libanon (Libanesische Republik)', 'LB', 'LBN', '422', 9999, 'Welt', '', 'Lebanon', '', '', 'World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095d1c9b2.21548132', 0, 'Lesotho', 'LS', 'LSO', '426', 9999, 'Rest Welt', '', 'Lesotho', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095d2fd28.91858908', 0, 'Liberia', 'LR', 'LBR', '430', 9999, 'Welt', '', 'Liberia', '', '', 'World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095d46188.64679605', 0, 'Libyen (Libysch-Arabische Dschamahirija)', 'LY', 'LBY', '434', 9999, 'Rest Welt', '', 'Libyan Arab Jamahiriya', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095d6ffa8.86593236', 0, 'Litauen', 'LT', 'LTU', '440', 9999, 'Rest Europa', '', 'Lithuania', '', '', 'Rest Europe', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('8f241f11095d9c1b2.13577033', 0, 'Macao', 'MO', 'MAC', '446', 9999, 'Rest Welt', '', 'Macau', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095db2291.58912887', 0, 'Mazedonien', 'MK', 'MKD', '807', 9999, 'Rest Europa', '', 'Macedonia', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095dccf17.06266806', 0, 'Madagaskar', 'MG', 'MDG', '450', 9999, 'Rest Welt', '', 'Madagascar', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095de2119.60795833', 0, 'Malawi', 'MW', 'MWI', '454', 9999, 'Rest Welt', '', 'Malawi', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095df78a8.44559506', 0, 'Malaysia', 'MY', 'MYS', '458', 9999, 'Rest Welt', '', 'Malaysia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095e0c6c9.43746477', 0, 'Malediven (Republik der Malediven)', 'MV', 'MDV', '462', 9999, 'Rest Welt', '', 'Maldives', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095e24006.17141715', 0, 'Mali', 'ML', 'MLI', '466', 9999, 'Rest Welt', '', 'Mali', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095e36eb3.69050509', 0, 'Malta', 'MT', 'MLT', '470', 9999, 'Rest Welt', '', 'Malta', '', '', 'Rest World', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('8f241f11095e4e338.26817244', 0, 'Marshallinseln (Republik der Marshallinseln)', 'MH', 'MHL', '584', 9999, 'Rest Welt', '', 'Marshall Islands', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095e631e1.29476484', 0, 'Martinique', 'MQ', 'MTQ', '474', 9999, 'Rest Welt', '', 'Martinique', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095e7bff9.09518271', 0, 'Mauretanien', 'MR', 'MRT', '478', 9999, 'Rest Welt', '', 'Mauritania', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095e90a81.01156393', 0, 'Mauritius', 'MU', 'MUS', '480', 9999, 'Rest Welt', '', 'Mauritius', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095ea6249.81474246', 0, 'Mayotte', 'YT', 'MYT', '175', 9999, 'Rest Welt', '', 'Mayotte', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095ebf3a6.86388577', 0, 'Mexiko', 'MX', 'MEX', '484', 9999, 'Rest Welt', '', 'Mexico', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095ed4902.49276197', 0, 'Mikronesien', 'FM', 'FSM', '583', 9999, 'Rest Welt', '', 'Micronesia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095ee9923.85175653', 0, 'Moldawien (Republik Moldau)', 'MD', 'MDA', '498', 9999, 'Rest Europa', '', 'Moldova', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095f00d65.30318330', 0, 'Monaco', 'MC', 'MCO', '492', 9999, 'Europa', '', 'Monaco', '', '', 'Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095f160c9.41059441', 0, 'Mongolei', 'MN', 'MNG', '496', 9999, 'Rest Welt', '', 'Mongolia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11095f314f5.05830324', 0, 'Montserrat', 'MS', 'MSR', '500', 9999, 'Rest Welt', '', 'Montserrat', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096006828.49285591', 0, 'Marokko', 'MA', 'MAR', '504', 9999, 'Welt', '', 'Morocco', '', '', 'World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109601b419.55269691', 0, 'Mosambik', 'MZ', 'MOZ', '508', 9999, 'Rest Welt', '', 'Mozambique', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096030af5.65449043', 0, 'Myanmar', 'MM', 'MMR', '104', 9999, 'Rest Welt', '', 'Myanmar', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096046575.31382060', 0, 'Namibia', 'NA', 'NAM', '516', 9999, 'Rest Welt', '', 'Namibia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109605b1f4.20574895', 0, 'Nauru', 'NR', 'NRU', '520', 9999, 'Rest Welt', '', 'Nauru', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109607a9e7.03486450', 0, 'Nepal', 'NP', 'NPL', '524', 9999, 'Rest Welt', '', 'Nepal', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110960aeb64.09757010', 0, 'Niederländische Antillen', 'AN', 'ANT', '530', 9999, 'Rest Welt', '', 'Netherlands Antilles', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110960c3e97.21901471', 0, 'Neukaledonien', 'NC', 'NCL', '540', 9999, 'Rest Welt', '', 'New Caledonia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110960d8e58.96466103', 0, 'Neuseeland', 'NZ', 'NZL', '554', 9999, 'Rest Welt', '', 'New Zealand', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110960ec345.71805056', 0, 'Nicaragua', 'NI', 'NIC', '558', 9999, 'Rest Welt', '', 'Nicaragua', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096101a79.70513227', 0, 'Niger', 'NE', 'NER', '562', 9999, 'Rest Welt', '', 'Niger', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096116744.92008092', 0, 'Nigeria', 'NG', 'NGA', '566', 9999, 'Rest Welt', '', 'Nigeria', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109612dc68.63806992', 0, 'Niue', 'NU', 'NIU', '570', 9999, 'Rest Welt', '', 'Niue', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110961442c2.82573898', 0, 'Norfolk Inseln (Kingston)', 'NF', 'NFK', '574', 9999, 'Rest Welt', '', 'Norfolk Island', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096162678.71164081', 0, 'Nordliche Mariannen Insel', 'MP', 'MNP', '580', 9999, 'Rest Welt', '', 'Northern Mariana Islands', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096176795.61257067', 0, 'Norwegen', 'NO', 'NOR', '578', 9999, 'Rest Europa', '', 'Norway', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109618d825.87661926', 0, 'Oman', 'OM', 'OMN', '512', 9999, 'Rest Welt', '', 'Oman', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110961a2401.59039740', 0, 'Pakistan', 'PK', 'PAK', '586', 9999, 'Rest Welt', '', 'Pakistan', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110961b7729.14290490', 0, 'Palau', 'PW', 'PLW', '585', 9999, 'Rest Welt', '', 'Palau', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110961cc384.18166560', 0, 'Panama', 'PA', 'PAN', '591', 9999, 'Rest Welt', '', 'Panama', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110961e3538.78435307', 0, 'Papua Neuguinea', 'PG', 'PNG', '598', 9999, 'Rest Welt', '', 'Papua New Guinea', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110961f9d61.52794273', 0, 'Paraguay', 'PY', 'PRY', '600', 9999, 'Rest Welt', '', 'Paraguay', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109620b245.16261506', 0, 'Peru', 'PE', 'PER', '604', 9999, 'Rest Welt', '', 'Peru', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109621faf8.40135556', 0, 'Philippinen', 'PH', 'PHL', '608', 9999, 'Rest Welt', '', 'Philippines', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096234d62.44125992', 0, 'Pitcairn-Inseln', 'PN', 'PCN', '612', 9999, 'Rest Welt', '', 'Pitcairn', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109624d3f8.50953605', 0, 'Polen', 'PL', 'POL', '616', 9999, 'Europa', '', 'Poland', '', '', 'Europe', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('8f241f11096279a22.50582479', 0, 'Puerto Rico', 'PR', 'PRI', '630', 9999, 'Rest Welt', '', 'Puerto Rico', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109628f903.51478291', 0, 'Katar', 'QA', 'QAT', '634', 9999, 'Rest Welt', '', 'Qatar', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110962a3ec5.65857240', 0, 'Reunion', 'RE', 'REU', '638', 9999, 'Rest Welt', '', 'Reunion', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110962c3007.60363573', 0, 'Rumänien', 'RO', 'ROU', '642', 9999, 'Rest Europa', '', 'Romania', '', '', 'Rest Europe', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('8f241f110962e40e6.75062153', 0, 'Russland (Russiche Föderation)', 'RU', 'RUS', '643', 9999, 'Rest Europa', '', 'Russian Federation', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110962f8615.93666560', 0, 'Ruanda', 'RW', 'RWA', '646', 9999, 'Rest Welt', '', 'Rwanda', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110963177a7.49289900', 0, 'Saint Kitts und Nevis', 'KN', 'KNA', '659', 9999, 'Rest Welt', '', 'Saint Kitts And Nevis', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109632fab4.68646740', 0, 'St. Lucia', 'LC', 'LCA', '662', 9999, 'Rest Welt', '', 'Saint Lucia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110963443c3.29598809', 0, 'Saint Vincent u. Grenadinen oder St. Vinc. u. Grenadinen', 'VC', 'VCT', '670', 9999, 'Rest Welt', '', 'Saint Vincent And The Grenadines', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096359986.06476221', 0, 'Samoa', 'WS', 'WSM', '882', 9999, 'Rest Welt', '', 'Samoa', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096375757.44126946', 0, 'San Marino', 'SM', 'SMR', '674', 9999, 'Europa', '', 'San Marino', '', '', 'Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109639b8c4.57484984', 0, 'Sao Tome und Principe', 'ST', 'STP', '678', 9999, 'Rest Welt', '', 'Sao Tome And Principe', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110963b9b20.41500709', 0, 'Saudi Arabien', 'SA', 'SAU', '682', 9999, 'Welt', '', 'Saudi Arabia', '', '', 'World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110963d9962.36307144', 0, 'Senegal', 'SN', 'SEN', '686', 9999, 'Rest Welt', '', 'Senegal', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110963f98d8.68428379', 0, 'Serbien und Montenegro', 'CS', 'SCG', '891', 9999, 'Rest Europa', '', 'Serbia and Montenegro', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096418496.77253079', 0, 'Seychellen', 'SC', 'SYC', '690', 9999, 'Rest Welt', '', 'Seychelles', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096436968.69551351', 0, 'Sierra Leone', 'SL', 'SLE', '694', 9999, 'Rest Welt', '', 'Sierra Leone', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096456a48.79608805', 0, 'Singapur', 'SG', 'SGP', '702', 9999, 'Rest Welt', '', 'Singapore', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109647a265.29938154', 0, 'Slowakei', 'SK', 'SVK', '703', 9999, 'Europa', '', 'Slovakia', '', '', 'Europe', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('8f241f11096497149.85116254', 0, 'Slowenien', 'SI', 'SVN', '705', 9999, 'Rest Europa', '', 'Slovenia', '', '', 'Rest Europe', '', '', '', '', '', 1);
INSERT INTO `oxcountry` VALUES ('8f241f110964b7bf9.49501835', 0, 'Salomonen', 'SB', 'SLB', '90', 9999, 'Rest Welt', '', 'Solomon Islands', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110964d5f29.11398308', 0, 'Somalia', 'SO', 'SOM', '706', 9999, 'Rest Welt', '', 'Somalia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110964f2623.74976876', 0, 'Südafrika', 'ZA', 'ZAF', '710', 9999, 'Rest Welt', '', 'South Africa', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096531330.03198083', 0, 'Sri Lanka', 'LK', 'LKA', '144', 9999, 'Rest Welt', '', 'Sri Lanka', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109654dca4.99466434', 0, 'St. Helena', 'SH', 'SHN', '654', 9999, 'Rest Welt', '', 'Saint Helena', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109656cde9.10816078', 0, 'Saint Pierre und Miquelon', 'PM', 'SPM', '666', 9999, 'Rest Welt', '', 'Saint Pierre And Miquelon', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109658cbe5.08293991', 0, 'Sudan', 'SD', 'SDN', '736', 9999, 'Rest Welt', '', 'Sudan', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110965c7347.75108681', 0, 'Suriname', 'SR', 'SUR', '740', 9999, 'Rest Welt', '', 'Suriname', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110965eb7b7.26149742', 0, 'Svalbard und Jan Mayen', 'SJ', 'SJM', '744', 9999, 'Rest Welt', '', 'Svalbard And Jan Mayen Islands', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109660c113.62780718', 0, 'Swasiland', 'SZ', 'SWZ', '748', 9999, 'Rest Welt', '', 'Swaziland', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109666b7f3.81435898', 0, 'Syrische Arabische Republik', 'SY', 'SYR', '760', 9999, 'Rest Welt', '', 'Syrian Arab Republic', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096687ec7.58824735', 0, 'China, Republik (Taiwan)', 'TW', 'TWN', '158', 9999, 'Rest Welt', '', 'Taiwan', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110966a54d1.43798997', 0, 'Tadschikistan', 'TJ', 'TJK', '762', 9999, 'Rest Welt', '', 'Tajikistan', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110966c3a75.68297960', 0, 'Tansania', 'TZ', 'TZA', '834', 9999, 'Rest Welt', '', 'Tanzania', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096707e08.60512709', 0, 'Thailand', 'TH', 'THA', '764', 9999, 'Rest Welt', '', 'Thailand', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110967241e1.34925220', 0, 'Togo', 'TG', 'TGO', '768', 9999, 'Rest Welt', '', 'Togo', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096742565.72138875', 0, 'Tokelau', 'TK', 'TKL', '772', 9999, 'Rest Welt', '', 'Tokelau', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096762b31.03069244', 0, 'Tonga', 'TO', 'TON', '776', 9999, 'Rest Welt', '', 'Tonga', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109677ed23.84886671', 0, 'Trinidad Und Tobago', 'TT', 'TTO', '780', 9999, 'Rest Welt', '', 'Trinidad And Tobago', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109679d988.46004322', 0, 'Tunesien', 'TN', 'TUN', '788', 9999, 'Welt', '', 'Tunisia', '', '', 'World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110967bba40.88233204', 0, 'Türkei', 'TR', 'TUR', '792', 9999, 'Rest Europa', '', 'Turkey', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110967d8f65.52699796', 0, 'Turkmenistan', 'TM', 'TKM', '795', 9999, 'Rest Welt', '', 'Turkmenistan', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110967f73f8.13141492', 0, 'Turks- und Caicosinseln', 'TC', 'TCA', '796', 9999, 'Rest Welt', '', 'Turks And Caicos Islands', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109680ec30.97426963', 0, 'Tuvalu', 'TV', 'TUV', '798', 9999, 'Rest Welt', '', 'Tuvalu', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096823019.47846368', 0, 'Uganda', 'UG', 'UGA', '800', 9999, 'Rest Welt', '', 'Uganda', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110968391d2.37199812', 0, 'Ukraine', 'UA', 'UKR', '804', 9999, 'Rest Europa', '', 'Ukraine', '', '', 'Rest Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109684bf15.63071279', 0, 'Vereinigte Arabische Emirate', 'AE', 'ARE', '784', 9999, 'Rest Welt', '', 'United Arab Emirates', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096877ac0.98748826', 0, 'Vereinigte Staaten', 'US', 'USA', '840', 9999, 'Welt', '', 'United States', '', '', 'World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096894977.41239553', 0, 'Amerikanisch-Ozeanien', 'UM', 'UMI', '581', 9999, 'Rest Welt', '', 'United States Minor Outlying Islands', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110968a7cc9.56710143', 0, 'Uruguay', 'UY', 'URY', '858', 9999, 'Rest Welt', '', 'Uruguay', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110968bec45.44161857', 0, 'Usbekistan', 'UZ', 'UZB', '860', 9999, 'Rest Welt', '', 'Uzbekistan', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110968d3f03.13630334', 0, 'Vanuatu', 'VU', 'VUT', '548', 9999, 'Rest Welt', '', 'Vanuatu', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110968ebc30.63792746', 0, 'Vatikanstadt', 'VA', 'VAT', '336', 9999, 'Europa', '', 'Vatican', '', '', 'Europe', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096902d92.14742486', 0, 'Venezuela', 'VE', 'VEN', '862', 9999, 'Rest Welt', '', 'Venezuela', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096919d00.92534927', 0, 'Vietnam', 'VN', 'VNM', '704', 9999, 'Rest Welt', '', 'Viet Nam', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109692fc04.15216034', 0, 'Britischen Jungferninseln (UK)', 'VG', 'VGB', '92', 9999, 'Rest Welt', '', 'Virgin Islands (british)', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096944468.61956573', 0, 'Amerikanischen Jungferninseln (USA)', 'VI', 'VIR', '850', 9999, 'Rest Welt', '', 'Virgin Islands (u.s.)', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110969598c8.76966113', 0, 'Wallis und Futuna', 'WF', 'WLF', '876', 9999, 'Rest Welt', '', 'Wallis And Futuna Islands', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f1109696e4e9.33006292', 0, 'Westsahara (Demokratische Arabische Republik Sahara)', 'EH', 'ESH', '732', 9999, 'Rest Welt', '', 'Western Sahara', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f11096982354.73448958', 0, 'Jemen', 'YE', 'YEM', '887', 9999, 'Rest Welt', '', 'Yemen', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110969afa62.05474721', 0, 'Demokratische Republik Kongo', 'ZR', 'ZAR', '180', 9999, 'Rest Welt', '', 'Zaire', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110969c34a2.42564730', 0, 'Sambia', 'ZM', 'ZMB', '894', 9999, 'Rest Welt', '', 'Zambia', '', '', 'Rest World', '', '', '', '', '', 0);
INSERT INTO `oxcountry` VALUES ('8f241f110969da699.04185888', 0, 'Simbabwe', 'ZW', 'ZWE', '716', 9999, 'Rest Welt', '', 'Zimbabwe', '', '', 'Rest World', '', '', '', '', '', 0);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxdel2delset`
-- 

DROP TABLE IF EXISTS `oxdel2delset`;
CREATE TABLE IF NOT EXISTS `oxdel2delset` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXDELID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXDELSETID` char(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`OXID`),
  KEY `OXDELID` (`OXDELID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxdel2delset`
-- 

INSERT INTO `oxdel2delset` VALUES ('5be44bc9261862fc4.78617917', '1b842e734b62a4775.45738618', 'oxidstandard');
INSERT INTO `oxdel2delset` VALUES ('4ba44c7251a587071.83952129', '1b842e73470578914.54719298', 'oxidstandard');
INSERT INTO `oxdel2delset` VALUES ('4ba44c72528a26008.03376396', '1b842e7352422a708.01472527', 'oxidstandard');
INSERT INTO `oxdel2delset` VALUES ('4ba44c7252d6d5785.89997750', '1b842e738970d31e3.71258327', '1b842e732a23255b1.91207750');
INSERT INTO `oxdel2delset` VALUES ('4ba44c7252d6d5785.89997751', '1b842e738970d31e3.71258328', '1b842e732a23255b1.91207751');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxdelivery`
-- 

DROP TABLE IF EXISTS `oxdelivery`;
CREATE TABLE IF NOT EXISTS `oxdelivery` (
  `OXID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXSHOPINCL` bigint(20) unsigned NOT NULL default '0',
  `OXSHOPEXCL` bigint(20) unsigned NOT NULL default '0',
  `OXACTIVE` tinyint(1) NOT NULL default '0',
  `OXACTIVEFROM` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXACTIVETO` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXTITLE` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXADDSUMTYPE` enum('%','abs') collate latin1_general_ci NOT NULL default 'abs',
  `OXADDSUM` double NOT NULL default '0',
  `OXDELTYPE` enum('a','s','w','p') collate latin1_general_ci NOT NULL default 'a',
  `OXPARAM` double NOT NULL default '0',
  `OXPARAMEND` double NOT NULL default '0',
  `OXFIXED` tinyint(1) NOT NULL default '0',
  `OXSORT` int(11) NOT NULL default '9999',
  `OXFINALIZE` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `OXSHOPID` (`OXSHOPID`),
  KEY `OXSHOPINCL` (`OXSHOPINCL`),
  KEY `OXSHOPEXCL` (`OXSHOPEXCL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxdelivery`
-- 

INSERT INTO `oxdelivery` VALUES ('1b842e734b62a4775.45738618', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Versandkosten für Standard: Versandkostenfrei ab 80,-', '', '', '', 'abs', 0, 'p', 80, 999999, 0, 1000, 1);
INSERT INTO `oxdelivery` VALUES ('1b842e73470578914.54719298', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Versandkosten für Standard: 3,90 Euro innerhalb Deutschland', '', '', '', 'abs', 3.9, 'p', 0, 79.99, 0, 2000, 1);
INSERT INTO `oxdelivery` VALUES ('1b842e7352422a708.01472527', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Versandkosten für Standard: 6,90 Rest EU', '', '', '', 'abs', 6.9, 'p', 0, 999999, 0, 3000, 1);
INSERT INTO `oxdelivery` VALUES ('1b842e738970d31e3.71258327', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Versandkosten für Beispiel Set1: UPS 48 Std.: 9,90.-', '', '', '', 'abs', 9.9, 'p', 0, 99999, 0, 4000, 1);
INSERT INTO `oxdelivery` VALUES ('1b842e738970d31e3.71258328', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Versandkosten für Beispiel Set2: UPS 24 Std. Express: 12,90.-', '', '', '', 'abs', 12.9, 'p', 0, 99999, 0, 5000, 1);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxdeliveryset`
-- 

DROP TABLE IF EXISTS `oxdeliveryset`;
CREATE TABLE IF NOT EXISTS `oxdeliveryset` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXSHOPINCL` bigint(20) unsigned NOT NULL default '0',
  `OXSHOPEXCL` bigint(20) unsigned NOT NULL default '0',
  `OXACTIVE` tinyint(1) NOT NULL default '0',
  `OXACTIVEFROM` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXACTIVETO` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXTITLE` char(128) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_1` char(128) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_2` char(128) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_3` char(128) collate latin1_general_ci NOT NULL default '',
  `OXPOS` int(11) NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `OXSHOPID` (`OXSHOPID`),
  KEY `OXSHOPINCL` (`OXSHOPINCL`),
  KEY `OXSHOPEXCL` (`OXSHOPEXCL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxdeliveryset`
-- 

INSERT INTO `oxdeliveryset` VALUES ('oxidstandard', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Standard', 'Standard', '', '', 10);
INSERT INTO `oxdeliveryset` VALUES ('1b842e732a23255b1.91207750', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Beispiel Set1: UPS 48 Std.', 'Example Set1: UPS 48 hours', '', '', 30);
INSERT INTO `oxdeliveryset` VALUES ('1b842e732a23255b1.91207751', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Beispiel Set1: UPS 24 Std. Express', 'Example Set2: UPS Express 24 hours', '', '', 30);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxdiscount`
-- 

DROP TABLE IF EXISTS `oxdiscount`;
CREATE TABLE IF NOT EXISTS `oxdiscount` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXSHOPINCL` bigint(20) unsigned NOT NULL default '0',
  `OXSHOPEXCL` bigint(20) unsigned NOT NULL default '0',
  `OXACTIVE` tinyint(1) NOT NULL default '0',
  `OXACTIVEFROM` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXACTIVETO` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXTITLE` char(128) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_1` char(128) collate latin1_general_ci NOT NULL,
  `OXTITLE_2` char(128) collate latin1_general_ci NOT NULL,
  `OXTITLE_3` char(128) collate latin1_general_ci NOT NULL,
  `OXAMOUNT` double NOT NULL default '0',
  `OXAMOUNTTO` double NOT NULL default '999999',
  `OXPRICETO` double NOT NULL default '999999',
  `OXPRICE` double NOT NULL default '0',
  `OXADDSUMTYPE` enum('%','abs','itm') collate latin1_general_ci NOT NULL default '%',
  `OXADDSUM` double NOT NULL default '0',
  `OXITMARTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXITMAMOUNT` double NOT NULL default '1',
  `OXITMMULTIPLE` int(1) NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `OXSHOPID` (`OXSHOPID`),
  KEY `OXSHOPINCL` (`OXSHOPINCL`),
  KEY `OXSHOPEXCL` (`OXSHOPEXCL`),
  KEY `OXACTIVE` (`OXACTIVE`),
  KEY `OXACTIVEFROM` (`OXACTIVEFROM`),
  KEY `OXACTIVETO` (`OXACTIVETO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxdiscount`
-- 

INSERT INTO `oxdiscount` VALUES ('9fc3e801d40332ae4.08296552', 1, 1, 0, 0, '2003-03-29 00:00:00', '2003-03-30 00:00:00', '15% auf den gesamten Shop an einem Tag', '15% on all articles for one day', '', '', 0, 999999, 999999, 0, '%', 15, '', 0, 0);
INSERT INTO `oxdiscount` VALUES ('9fc3e801da9cdd0b2.74513077', 1, 1, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '10% ab 200 Euro Einkaufswert', '10% on 200 Euro or more', '', '', 0, 999999, 999999, 200, '%', 10, '', 0, 0);
INSERT INTO `oxdiscount` VALUES ('4e542e4e8dd127836.00288451', 1, 1, 0, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Aktion Schnäppchen', 'Current Bargain', '', '', 1, 99999, 0, 0, '%', 10, '', 0, 0);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxfield2role`
-- 

DROP TABLE IF EXISTS `oxfield2role`;
CREATE TABLE IF NOT EXISTS `oxfield2role` (
  `OXFIELDID` char(255) collate latin1_general_ci NOT NULL,
  `OXTYPE` char(32) collate latin1_general_ci NOT NULL,
  `OXROLEID` char(32) collate latin1_general_ci NOT NULL,
  `OXIDX` int(1) NOT NULL,
  PRIMARY KEY  (`OXFIELDID`,`OXTYPE`,`OXROLEID`),
  KEY `OXIDX` (`OXIDX`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxfield2role`
-- 

INSERT INTO `oxfield2role` VALUES ('tbclshop_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_config', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_system', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_mall', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_license', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_performance', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_cache', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_seo', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxcoresett', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcountry_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxcountries', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvendor_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvendor_mall', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxvendor', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxmainmenu', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpayment_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpayment_country', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxpaymeth', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_articles', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_users', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_mall', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxdiscount', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_payment', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_users', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_mall', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxshippingset', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_articles', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_users', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_mall', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxshipping', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_groups', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_mall', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_export', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxvouchers', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclwrapping_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclwrapping_mall', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxwrapping', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxshopsett', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_main', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_extend', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_stock', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_mall', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_attribute', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_crossselling', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_variant', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_pictures', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_review', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_overview', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_rights', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('mxarticles', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('tbclactions_main', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('mxactions', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_main', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_category', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_mall', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('mxattributes', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_main', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_text', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_pictures', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_order', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_mall', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_rights', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('mxcategories', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclselectlist_main', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('tbclselectlist_mall', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('mxsellist', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('mxremlist', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('mxmanageprod', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('tbcluser_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_extend', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_article', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_remark', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_address', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_payment', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxusers', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclusergroup_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxugroups', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxlist', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_bemain', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_beobject', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_beuser', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxberoles', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_femain', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_feuser', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxferoles', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxuadmin', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_overview', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_address', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_article', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_remark', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxdisplayorders', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxorders', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclnews_main', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('tbclnews_text', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('tbclnews_mall', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('mxnews', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('tbcladminlinks_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcladminlinks_mall', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxurls', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcladminguestbook_main', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('mxguestbook', 'oxview', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclcontent_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxcontent', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpricealarm_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpricealarm_mail', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxpricealarm', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxcustnews', 'oxview', '38c44b64462a30409.68943490', 2);
INSERT INTO `oxfield2role` VALUES ('tbcl_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxerp', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxsysinfo', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbcltools_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxtools', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('tbclgenexport_main', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxgenexp', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('mxservice', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('dyn_about', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('dyn_interface', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('dyn_menu', 'oxview', '38c44b64462a30409.68943490', 0);
INSERT INTO `oxfield2role` VALUES ('oxactive', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxactiveto', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxactivefrom', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxartnum', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxblfixedprice', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxbprice', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxdelivery', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxdistean', 'oxarticles', '38c44b64462a30409.68943490', 3);
INSERT INTO `oxfield2role` VALUES ('oxean', 'oxarticles', '38c44b64462a30409.68943490', 3);
INSERT INTO `oxfield2role` VALUES ('oxexturl', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxfile', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxfreeshipping', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxheight', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxicon', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxissearch', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxlength', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxlongdesc', 'oxarticles', '38c44b64462a30409.68943490', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic1', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxpic2', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxpic3', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxpic4', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxpic5', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxpic6', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxpic7', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxprice', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxpricea', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxpriceb', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxpricec', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxquestionemail', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxnonmaterial', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxnostocktext', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxremindactiv', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxorderinfo', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxsearchkeys', 'oxarticles', '38c44b64462a30409.68943490', 3);
INSERT INTO `oxfield2role` VALUES ('oxshortdesc', 'oxarticles', '38c44b64462a30409.68943490', 3);
INSERT INTO `oxfield2role` VALUES ('oxskipdiscounts', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxsort', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxstock', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxstocktext', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxstockflag', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxtemplate', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxtitle', 'oxarticles', '38c44b64462a30409.68943490', 3);
INSERT INTO `oxfield2role` VALUES ('oxthumb', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxtprice', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxurldesc', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxurlimg', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxunitquantity', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxunitname', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxvarname', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxvarselect', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxvendorid', 'oxarticles', '38c44b64462a30409.68943490', 3);
INSERT INTO `oxfield2role` VALUES ('oxvat', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxvpe', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxwidth', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxweight', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxzoom1', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxzoom2', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxzoom3', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxzoom4', 'oxarticles', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxarticles', 'oxarticles', '38c44b64462a30409.68943490', 3);
INSERT INTO `oxfield2role` VALUES ('oxactive', 'oxcategories', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxextlink', 'oxcategories', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxdefsort', 'oxcategories', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxdesc', 'oxcategories', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxhidden', 'oxcategories', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxicon', 'oxcategories', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxlongdesc', 'oxcategories', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxorder', 'oxcategories', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxparentid', 'oxcategories', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxskipdiscounts', 'oxcategories', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxtemplate', 'oxcategories', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxthumb', 'oxcategories', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxtitle', 'oxcategories', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('oxcategories', 'oxcategories', '38c44b64462a30409.68943490', 1);
INSERT INTO `oxfield2role` VALUES ('tbclshop_main', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('tbclshop_config', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('tbclshop_system', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('tbclshop_mall', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('tbclshop_license', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('tbclshop_performance', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('tbclshop_cache', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('tbclshop_seo', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('mxcoresett', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('tbclcountry_main', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('mxcountries', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('tbclvendor_main', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('tbclvendor_mall', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('mxvendor', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('mxmainmenu', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('tbclpayment_main', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpayment_country', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxpaymeth', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_main', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_articles', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_users', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_mall', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxdiscount', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_main', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_payment', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_users', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_mall', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxshippingset', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_main', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_articles', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_users', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_mall', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxshipping', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_main', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_groups', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_mall', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_export', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxvouchers', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclwrapping_main', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclwrapping_mall', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxwrapping', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxshopsett', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_main', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_extend', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_stock', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_mall', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_attribute', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_crossselling', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_variant', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_pictures', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_review', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_overview', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_rights', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('mxarticles', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclactions_main', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('mxactions', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_main', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_category', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_mall', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('mxattributes', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_main', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_text', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_pictures', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_order', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_mall', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_rights', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('mxcategories', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclselectlist_main', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbclselectlist_mall', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('mxsellist', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('mxremlist', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('mxmanageprod', 'oxview', '38c44b643ca8c1434.78110631', 2);
INSERT INTO `oxfield2role` VALUES ('tbcluser_main', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_extend', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_article', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_remark', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_address', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_payment', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxusers', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclusergroup_main', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxugroups', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxlist', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_bemain', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_beobject', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_beuser', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxberoles', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_femain', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_feuser', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxferoles', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxuadmin', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_overview', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_main', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_address', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_article', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_remark', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxdisplayorders', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxorders', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclnews_main', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclnews_text', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclnews_mall', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxnews', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcladminlinks_main', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcladminlinks_mall', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxurls', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcladminguestbook_main', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxguestbook', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcontent_main', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxcontent', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpricealarm_main', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpricealarm_mail', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxpricealarm', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('mxcustnews', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('tbcl_main', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('mxerp', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('mxsysinfo', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('tbcltools_main', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('mxtools', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('tbclgenexport_main', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('mxgenexp', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('mxservice', 'oxview', '38c44b643ca8c1434.78110631', 1);
INSERT INTO `oxfield2role` VALUES ('dyn_about', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('dyn_interface', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('dyn_menu', 'oxview', '38c44b643ca8c1434.78110631', 0);
INSERT INTO `oxfield2role` VALUES ('oxactive', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxactiveto', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxactivefrom', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxartnum', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxblfixedprice', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxbprice', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxdelivery', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxdistean', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxean', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxexturl', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxfile', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxfreeshipping', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxheight', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxicon', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxissearch', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxlength', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxlongdesc', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic1', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic2', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic3', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic4', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic5', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic6', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic7', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxprice', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxpricea', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxpriceb', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxpricec', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxquestionemail', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxnonmaterial', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxnostocktext', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxremindactiv', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxorderinfo', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxsearchkeys', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxshortdesc', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxskipdiscounts', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxsort', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxstock', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxstocktext', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxstockflag', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxtemplate', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxtitle', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxthumb', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxtprice', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxurldesc', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxurlimg', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxunitquantity', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxunitname', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxvarname', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxvarselect', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxvendorid', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxvat', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxvpe', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxwidth', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxweight', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom1', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom2', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom3', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom4', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxarticles', 'oxarticles', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxactive', 'oxcategories', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxextlink', 'oxcategories', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxdefsort', 'oxcategories', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxdesc', 'oxcategories', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxhidden', 'oxcategories', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxicon', 'oxcategories', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxlongdesc', 'oxcategories', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxorder', 'oxcategories', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxparentid', 'oxcategories', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxskipdiscounts', 'oxcategories', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxtemplate', 'oxcategories', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxthumb', 'oxcategories', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxtitle', 'oxcategories', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('oxcategories', 'oxcategories', '38c44b643ca8c1434.78110631', 3);
INSERT INTO `oxfield2role` VALUES ('tbclshop_main', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclshop_config', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclshop_system', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclshop_mall', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclshop_license', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclshop_performance', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclshop_cache', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclshop_seo', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxcoresett', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcountry_main', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxcountries', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclvendor_main', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclvendor_mall', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxvendor', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxmainmenu', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclpayment_main', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclpayment_country', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxpaymeth', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_main', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_articles', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_users', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_mall', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxdiscount', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_main', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_payment', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_users', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_mall', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxshippingset', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_main', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_articles', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_users', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_mall', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxshipping', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_main', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_groups', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_mall', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_export', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxvouchers', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclwrapping_main', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclwrapping_mall', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxwrapping', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxshopsett', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_main', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_extend', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_stock', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_mall', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_attribute', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_crossselling', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_variant', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_pictures', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_review', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_overview', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_rights', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxarticles', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclactions_main', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxactions', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_main', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_category', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_mall', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxattributes', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_main', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_text', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_pictures', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_order', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_mall', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_rights', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxcategories', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclselectlist_main', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbclselectlist_mall', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxsellist', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxremlist', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('mxmanageprod', 'oxview', '78e44b759b7090603.28752953', 2);
INSERT INTO `oxfield2role` VALUES ('tbcluser_main', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_extend', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_article', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_remark', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_address', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_payment', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxusers', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclusergroup_main', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxugroups', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxlist', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_bemain', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_beobject', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_beuser', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxberoles', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_femain', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_feuser', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxferoles', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxuadmin', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_overview', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_main', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_address', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_article', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_remark', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxdisplayorders', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxorders', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclnews_main', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclnews_text', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclnews_mall', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxnews', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbcladminlinks_main', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbcladminlinks_mall', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxurls', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbcladminguestbook_main', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxguestbook', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcontent_main', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxcontent', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpricealarm_main', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpricealarm_mail', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxpricealarm', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxcustnews', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbcl_main', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxerp', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxsysinfo', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbcltools_main', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxtools', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('tbclgenexport_main', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxgenexp', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('mxservice', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('dyn_about', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('dyn_interface', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('dyn_menu', 'oxview', '78e44b759b7090603.28752953', 0);
INSERT INTO `oxfield2role` VALUES ('oxactive', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxactiveto', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxactivefrom', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxartnum', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxblfixedprice', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxbprice', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxdelivery', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxdistean', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxean', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxexturl', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxfile', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxfreeshipping', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxheight', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxicon', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxissearch', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxlength', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxlongdesc', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic1', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic2', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic3', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic4', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic5', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic6', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic7', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxprice', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxpricea', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxpriceb', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxpricec', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxquestionemail', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxnonmaterial', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxnostocktext', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxremindactiv', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxorderinfo', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxsearchkeys', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxshortdesc', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxskipdiscounts', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxsort', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxstock', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxstocktext', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxstockflag', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxtemplate', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxtitle', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxthumb', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxtprice', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxurldesc', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxurlimg', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxunitquantity', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxunitname', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxvarname', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxvarselect', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxvendorid', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxvat', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxvpe', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxwidth', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxweight', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom1', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom2', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom3', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom4', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxarticles', 'oxarticles', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxactive', 'oxcategories', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxextlink', 'oxcategories', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxdefsort', 'oxcategories', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxdesc', 'oxcategories', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxhidden', 'oxcategories', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxicon', 'oxcategories', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxlongdesc', 'oxcategories', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxorder', 'oxcategories', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxparentid', 'oxcategories', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxskipdiscounts', 'oxcategories', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxtemplate', 'oxcategories', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxthumb', 'oxcategories', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxtitle', 'oxcategories', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('oxcategories', 'oxcategories', '78e44b759b7090603.28752953', 3);
INSERT INTO `oxfield2role` VALUES ('tbclshop_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclshop_config', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclshop_system', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclshop_mall', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclshop_license', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclshop_performance', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclshop_cache', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclshop_seo', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxcoresett', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcountry_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxcountries', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclvendor_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclvendor_mall', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxvendor', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxmainmenu', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclpayment_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclpayment_country', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxpaymeth', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_articles', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_users', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_mall', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxdiscount', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_payment', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_users', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_mall', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxshippingset', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_articles', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_users', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_mall', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxshipping', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_groups', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_mall', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_export', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxvouchers', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclwrapping_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclwrapping_mall', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxwrapping', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxshopsett', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_extend', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_stock', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_mall', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_attribute', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_crossselling', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_variant', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_pictures', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_review', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_overview', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_rights', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxarticles', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclactions_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxactions', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_category', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_mall', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxattributes', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_text', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_pictures', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_order', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_mall', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_rights', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxcategories', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclselectlist_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclselectlist_mall', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxsellist', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxremlist', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxmanageprod', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcluser_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcluser_extend', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcluser_article', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcluser_remark', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcluser_address', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcluser_payment', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxusers', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclusergroup_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxugroups', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxlist', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclroles_bemain', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclroles_beobject', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclroles_beuser', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxberoles', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclroles_femain', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclroles_feuser', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxferoles', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxuadmin', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclorder_overview', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclorder_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclorder_address', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclorder_article', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclorder_remark', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxdisplayorders', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxorders', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclnews_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclnews_text', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclnews_mall', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxnews', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcladminlinks_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcladminlinks_mall', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxurls', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcladminguestbook_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxguestbook', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclcontent_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxcontent', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclpricealarm_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclpricealarm_mail', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxpricealarm', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxcustnews', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcl_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxerp', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxsysinfo', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbcltools_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxtools', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('tbclgenexport_main', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxgenexp', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('mxservice', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('dyn_about', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('dyn_interface', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('dyn_menu', 'oxview', '38c44b637c40361a5.19114394', 2);
INSERT INTO `oxfield2role` VALUES ('oxactive', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxactiveto', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxactivefrom', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxartnum', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxblfixedprice', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxbprice', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxdelivery', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxdistean', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxean', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxexturl', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxfile', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxfreeshipping', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxheight', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxicon', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxissearch', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxlength', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxlongdesc', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic1', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic2', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic3', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic4', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic5', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic6', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic7', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxprice', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxpricea', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxpriceb', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxpricec', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxquestionemail', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxnonmaterial', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxnostocktext', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxremindactiv', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxorderinfo', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxsearchkeys', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxshortdesc', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxskipdiscounts', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxsort', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxstock', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxstocktext', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxstockflag', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxtemplate', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxtitle', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxthumb', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxtprice', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxurldesc', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxurlimg', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxunitquantity', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxunitname', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxvarname', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxvarselect', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxvendorid', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxvat', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxvpe', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxwidth', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxweight', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom1', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom2', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom3', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom4', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxarticles', 'oxarticles', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxactive', 'oxcategories', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxextlink', 'oxcategories', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxdefsort', 'oxcategories', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxdesc', 'oxcategories', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxhidden', 'oxcategories', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxicon', 'oxcategories', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxlongdesc', 'oxcategories', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxorder', 'oxcategories', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxparentid', 'oxcategories', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxskipdiscounts', 'oxcategories', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxtemplate', 'oxcategories', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxthumb', 'oxcategories', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxtitle', 'oxcategories', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('oxcategories', 'oxcategories', '38c44b637c40361a5.19114394', 3);
INSERT INTO `oxfield2role` VALUES ('tbclshop_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_config', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_system', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_mall', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_license', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_performance', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_cache', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_seo', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxcoresett', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcountry_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxcountries', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvendor_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvendor_mall', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxvendor', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxmainmenu', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpayment_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpayment_country', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxpaymeth', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_articles', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_users', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_mall', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxdiscount', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_payment', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_users', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_mall', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxshippingset', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_articles', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_users', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_mall', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxshipping', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_groups', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_mall', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_export', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxvouchers', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclwrapping_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclwrapping_mall', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxwrapping', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxshopsett', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_extend', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_stock', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_mall', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_attribute', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_crossselling', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_variant', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_pictures', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_review', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_overview', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_rights', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxarticles', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclactions_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxactions', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_category', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_mall', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxattributes', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_text', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_pictures', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_order', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_mall', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_rights', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxcategories', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclselectlist_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclselectlist_mall', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxsellist', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxremlist', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxmanageprod', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_extend', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_article', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_remark', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_address', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_payment', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxusers', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclusergroup_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxugroups', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxlist', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_bemain', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_beobject', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_beuser', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxberoles', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_femain', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_feuser', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxferoles', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxuadmin', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_overview', 'oxview', '78e44b7594125ee20.14450974', 2);
INSERT INTO `oxfield2role` VALUES ('tbclorder_main', 'oxview', '78e44b7594125ee20.14450974', 2);
INSERT INTO `oxfield2role` VALUES ('tbclorder_address', 'oxview', '78e44b7594125ee20.14450974', 2);
INSERT INTO `oxfield2role` VALUES ('tbclorder_article', 'oxview', '78e44b7594125ee20.14450974', 2);
INSERT INTO `oxfield2role` VALUES ('tbclorder_remark', 'oxview', '78e44b7594125ee20.14450974', 2);
INSERT INTO `oxfield2role` VALUES ('mxdisplayorders', 'oxview', '78e44b7594125ee20.14450974', 2);
INSERT INTO `oxfield2role` VALUES ('mxorders', 'oxview', '78e44b7594125ee20.14450974', 2);
INSERT INTO `oxfield2role` VALUES ('tbclnews_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclnews_text', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclnews_mall', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxnews', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcladminlinks_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcladminlinks_mall', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxurls', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcladminguestbook_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxguestbook', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcontent_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxcontent', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpricealarm_main', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpricealarm_mail', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxpricealarm', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('mxcustnews', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbcl_main', 'oxview', '78e44b7594125ee20.14450974', 1);
INSERT INTO `oxfield2role` VALUES ('mxerp', 'oxview', '78e44b7594125ee20.14450974', 1);
INSERT INTO `oxfield2role` VALUES ('mxsysinfo', 'oxview', '78e44b7594125ee20.14450974', 1);
INSERT INTO `oxfield2role` VALUES ('tbcltools_main', 'oxview', '78e44b7594125ee20.14450974', 1);
INSERT INTO `oxfield2role` VALUES ('mxtools', 'oxview', '78e44b7594125ee20.14450974', 1);
INSERT INTO `oxfield2role` VALUES ('tbclgenexport_main', 'oxview', '78e44b7594125ee20.14450974', 1);
INSERT INTO `oxfield2role` VALUES ('mxgenexp', 'oxview', '78e44b7594125ee20.14450974', 1);
INSERT INTO `oxfield2role` VALUES ('mxservice', 'oxview', '78e44b7594125ee20.14450974', 1);
INSERT INTO `oxfield2role` VALUES ('dyn_about', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('dyn_interface', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('dyn_menu', 'oxview', '78e44b7594125ee20.14450974', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_config', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_system', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_mall', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_license', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_performance', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_cache', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclshop_seo', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxcoresett', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcountry_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxcountries', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvendor_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvendor_mall', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxvendor', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxmainmenu', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpayment_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpayment_country', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxpaymeth', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_articles', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_users', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldiscount_mall', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxdiscount', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_payment', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_users', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldeliveryset_mall', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxshippingset', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_articles', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_users', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcldelivery_mall', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxshipping', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_groups', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_mall', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclvoucherserie_export', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxvouchers', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclwrapping_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclwrapping_mall', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxwrapping', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxshopsett', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_main', 'oxview', '78e44b758c022a272.51251423', 1);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_extend', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_stock', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_mall', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_attribute', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_crossselling', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_variant', 'oxview', '78e44b758c022a272.51251423', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_pictures', 'oxview', '78e44b758c022a272.51251423', 2);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_review', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_overview', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclarticle_rights', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxarticles', 'oxview', '78e44b758c022a272.51251423', 2);
INSERT INTO `oxfield2role` VALUES ('tbclactions_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxactions', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_category', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclattribute_mall', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxattributes', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_text', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_pictures', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_order', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_mall', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcategory_rights', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxcategories', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclselectlist_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclselectlist_mall', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxsellist', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxremlist', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxmanageprod', 'oxview', '78e44b758c022a272.51251423', 2);
INSERT INTO `oxfield2role` VALUES ('tbcluser_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_extend', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_article', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_remark', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_address', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcluser_payment', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxusers', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclusergroup_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxugroups', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxlist', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_bemain', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_beobject', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_beuser', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxberoles', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_femain', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclroles_feuser', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxferoles', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxuadmin', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_overview', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_address', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_article', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclorder_remark', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxdisplayorders', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxorders', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclnews_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclnews_text', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclnews_mall', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxnews', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcladminlinks_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcladminlinks_mall', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxurls', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcladminguestbook_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxguestbook', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclcontent_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxcontent', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpricealarm_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclpricealarm_mail', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxpricealarm', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxcustnews', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcl_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxerp', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxsysinfo', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbcltools_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxtools', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('tbclgenexport_main', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxgenexp', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('mxservice', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('dyn_about', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('dyn_interface', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('dyn_menu', 'oxview', '78e44b758c022a272.51251423', 0);
INSERT INTO `oxfield2role` VALUES ('oxactive', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxactiveto', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxactivefrom', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxartnum', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxblfixedprice', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxbprice', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxdelivery', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxdistean', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxean', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxexturl', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxfile', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxfreeshipping', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxheight', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxicon', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxissearch', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxlength', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxlongdesc', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic1', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic2', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic3', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic4', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic5', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic6', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxpic7', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxprice', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxpricea', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxpriceb', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxpricec', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxquestionemail', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxnonmaterial', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxnostocktext', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxremindactiv', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxorderinfo', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxsearchkeys', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxshortdesc', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxskipdiscounts', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxsort', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxstock', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxstocktext', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxstockflag', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxtemplate', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxtitle', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxthumb', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxtprice', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxurldesc', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxurlimg', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxunitquantity', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxunitname', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxvarname', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxvarselect', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxvendorid', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxvat', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxvpe', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxwidth', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxweight', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom1', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom2', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom3', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxzoom4', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxarticles', 'oxarticles', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxactive', 'oxcategories', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxextlink', 'oxcategories', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxdefsort', 'oxcategories', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxdesc', 'oxcategories', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxhidden', 'oxcategories', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxicon', 'oxcategories', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxlongdesc', 'oxcategories', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxorder', 'oxcategories', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxparentid', 'oxcategories', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxskipdiscounts', 'oxcategories', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxtemplate', 'oxcategories', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxthumb', 'oxcategories', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxtitle', 'oxcategories', '78e44b758c022a272.51251423', 3);
INSERT INTO `oxfield2role` VALUES ('oxcategories', 'oxcategories', '78e44b758c022a272.51251423', 3);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxfield2shop`
-- 

DROP TABLE IF EXISTS `oxfield2shop`;
CREATE TABLE IF NOT EXISTS `oxfield2shop` (
  `OXID` char(32) collate latin1_general_ci NOT NULL,
  `OXARTID` char(32) collate latin1_general_ci NOT NULL,
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXPRICE` double NOT NULL,
  `OXPRICEA` double NOT NULL,
  `OXPRICEB` double NOT NULL,
  `OXPRICEC` double NOT NULL,
  PRIMARY KEY  (`OXID`),
  KEY `OXARTID` (`OXARTID`,`OXSHOPID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxfield2shop`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxgbentries`
-- 

DROP TABLE IF EXISTS `oxgbentries`;
CREATE TABLE IF NOT EXISTS `oxgbentries` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXUSERID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXCONTENT` text collate latin1_general_ci NOT NULL,
  `OXCREATE` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXACTIVE` tinyint(1) NOT NULL default '0',
  `OXVIEWED` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`OXID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Guestbook`s entries';

-- 
-- Sukurta duomenų kopija lentelei `oxgbentries`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxgroups`
-- 

DROP TABLE IF EXISTS `oxgroups`;
CREATE TABLE IF NOT EXISTS `oxgroups` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXACTIVE` tinyint(1) NOT NULL default '1',
  `OXTITLE` char(128) collate latin1_general_ci NOT NULL default '',
  `OXRRID` bigint(21) unsigned NOT NULL,
  PRIMARY KEY  (`OXID`),
  KEY `OXACTIVE` (`OXACTIVE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxgroups`
-- 

INSERT INTO `oxgroups` VALUES ('oxidblacklist', 1, 'Blacklist', 0);
INSERT INTO `oxgroups` VALUES ('oxidsmallcust', 1, 'Geringer Umsatz', 1);
INSERT INTO `oxgroups` VALUES ('oxidmiddlecust', 1, 'Mittlerer Umsatz', 2);
INSERT INTO `oxgroups` VALUES ('oxidgoodcust', 1, 'Grosser Umsatz', 3);
INSERT INTO `oxgroups` VALUES ('oxidforeigncustomer', 1, 'Auslandskunde', 4);
INSERT INTO `oxgroups` VALUES ('oxidnewcustomer', 1, 'Inlandskunde', 5);
INSERT INTO `oxgroups` VALUES ('oxidpowershopper', 1, 'Powershopper', 6);
INSERT INTO `oxgroups` VALUES ('oxiddealer', 1, 'Händler', 7);
INSERT INTO `oxgroups` VALUES ('oxidnewsletter', 1, 'Newsletter-Abonnenten', 8);
INSERT INTO `oxgroups` VALUES ('oxidadmin', 1, 'Shop-Admin', 9);
INSERT INTO `oxgroups` VALUES ('oxidpriceb', 1, 'Preis B', 10);
INSERT INTO `oxgroups` VALUES ('oxidpricea', 1, 'Preis A', 11);
INSERT INTO `oxgroups` VALUES ('oxidpricec', 1, 'Preis C', 12);
INSERT INTO `oxgroups` VALUES ('oxidblocked', 1, 'BLOCKED', 13);
INSERT INTO `oxgroups` VALUES ('oxidcustomer', 1, 'Kunde', 14);
INSERT INTO `oxgroups` VALUES ('36944b76defac5622.13882269', 1, 'admin_demo', 15);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxlinks`
-- 

DROP TABLE IF EXISTS `oxlinks`;
CREATE TABLE IF NOT EXISTS `oxlinks` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXSHOPINCL` bigint(20) unsigned NOT NULL default '0',
  `OXSHOPEXCL` bigint(20) unsigned NOT NULL default '0',
  `OXACTIVE` tinyint(1) NOT NULL default '0',
  `OXURL` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXURLDESC` text collate latin1_general_ci NOT NULL,
  `OXURLDESC_1` text collate latin1_general_ci NOT NULL,
  `OXURLDESC_2` text collate latin1_general_ci NOT NULL,
  `OXURLDESC_3` text collate latin1_general_ci NOT NULL,
  `OXURLDESC_4` text collate latin1_general_ci NOT NULL,
  `OXINSERT` datetime default NULL,
  PRIMARY KEY  (`OXID`),
  KEY `OXSHOPID` (`OXSHOPID`),
  KEY `OXSHOPINCL` (`OXSHOPINCL`),
  KEY `OXSHOPEXCL` (`OXSHOPEXCL`),
  KEY `OXINSERT` (`OXINSERT`),
  KEY `OXACTIVE` (`OXACTIVE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxlinks`
-- 

INSERT INTO `oxlinks` VALUES ('ce342e8acb69f1748.25672556', 1, 1, 0, 1, 'http://www.oxid-esales.com', 'dudu Die OXID eSales AG ist Hersteller der E-Commerce Software OXID eShop. Mit den Produktlinien Professional Edition und Enterprise Edition sowie der Mietshop-Lösung OXID eShop easy setzt das Unternehmen Standards im Online-Versandhandel zu einem außergewöhnlichen Preis-/Leistungsverhältnis. Die OXID eShop Produkte basieren auf modernster Technologie, lassen sich umfassend anpassen und vollständig in Ihre Geschäftsprozesse integrieren. Die ergänzende E-Commerce Plattform OXID eFire bietet Schnittstellen zu E-Commerce Partnern wie Payment-Dienstleistern, Webcontrolling und Datamining, Produktportalen, Preissuchmaschinen oder Affiliate-Programmen und sorgt dafür, dass der Onlinehandel nachhaltig zum Erfolg wird.', '<br>', '', '', '', '2006-07-01 00:00:00');
INSERT INTO `oxlinks` VALUES ('d9de5567ecc73f9bb3f6eea8cc34c59a', 1, 1, 0, 1, 'http://sarunasv/', '<p>taip ir taip</p>', '', '', '', '', '2008-12-08 00:00:00');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxlogs`
-- 

DROP TABLE IF EXISTS `oxlogs`;
CREATE TABLE IF NOT EXISTS `oxlogs` (
  `OXTIME` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXUSERID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSESSID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXCLASS` char(32) collate latin1_general_ci NOT NULL default '',
  `OXFNC` char(32) collate latin1_general_ci NOT NULL default '',
  `OXCNID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXANID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXPARAMETER` char(64) collate latin1_general_ci NOT NULL default ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxlogs`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxmediaurls`
-- 

DROP TABLE IF EXISTS `oxmediaurls`;
CREATE TABLE IF NOT EXISTS `oxmediaurls` (
  `OXID` char(32) collate latin1_general_ci NOT NULL,
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL,
  `OXURL` varchar(255) collate latin1_general_ci NOT NULL,
  `OXDESC` varchar(255) collate latin1_general_ci NOT NULL,
  `OXDESC_1` varchar(255) collate latin1_general_ci NOT NULL,
  `OXDESC_2` varchar(255) collate latin1_general_ci NOT NULL,
  `OXDESC_3` varchar(255) collate latin1_general_ci NOT NULL,
  `OXISUPLOADED` int(1) NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `OXOBJECTID` (`OXOBJECTID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxmediaurls`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxnews`
-- 

DROP TABLE IF EXISTS `oxnews`;
CREATE TABLE IF NOT EXISTS `oxnews` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXSHOPINCL` bigint(20) unsigned NOT NULL default '0',
  `OXSHOPEXCL` bigint(20) unsigned NOT NULL default '0',
  `OXACTIVE` tinyint(1) NOT NULL default '1',
  `OXACTIVEFROM` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXACTIVETO` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXDATE` date NOT NULL default '0000-00-00',
  `OXSHORTDESC` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXLONGDESC` text collate latin1_general_ci NOT NULL,
  `OXACTIVE_1` tinyint(1) NOT NULL default '0',
  `OXSHORTDESC_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXLONGDESC_1` text collate latin1_general_ci NOT NULL,
  `OXACTIVE_2` tinyint(1) NOT NULL default '0',
  `OXSHORTDESC_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXLONGDESC_2` text collate latin1_general_ci NOT NULL,
  `OXACTIVE_3` tinyint(1) NOT NULL default '0',
  `OXSHORTDESC_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXLONGDESC_3` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`OXID`),
  KEY `OXSHOPID` (`OXSHOPID`),
  KEY `OXSHOPINCL` (`OXSHOPINCL`),
  KEY `OXSHOPEXCL` (`OXSHOPEXCL`),
  KEY `OXACTIVE` (`OXACTIVE`),
  KEY `OXACTIVEFROM` (`OXACTIVEFROM`),
  KEY `OXACTIVETO` (`OXACTIVETO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxnews`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxnewssubscribed`
-- 

DROP TABLE IF EXISTS `oxnewssubscribed`;
CREATE TABLE IF NOT EXISTS `oxnewssubscribed` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXUSERID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSAL` char(64) collate latin1_general_ci NOT NULL default '',
  `OXFNAME` char(128) collate latin1_general_ci NOT NULL default '',
  `OXLNAME` char(128) collate latin1_general_ci NOT NULL default '',
  `OXEMAIL` char(128) collate latin1_general_ci NOT NULL default '',
  `OXDBOPTIN` tinyint(1) NOT NULL default '0',
  `OXEMAILFAILED` tinyint(1) NOT NULL default '0',
  `OXSUBSCRIBED` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXUNSUBSCRIBED` datetime NOT NULL default '0000-00-00 00:00:00',
  UNIQUE KEY `OXUSERID` (`OXUSERID`),
  KEY `OXEMAIL` (`OXEMAIL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxnewssubscribed`
-- 

INSERT INTO `oxnewssubscribed` VALUES ('0b742e66fd94c88b8.61001136', 'oxdefaultadmin', 'Herr', 'Hans', 'Mustermann', 'admin', 1, 0, '2005-07-26 19:16:09', '0000-00-00 00:00:00');
INSERT INTO `oxnewssubscribed` VALUES ('36944b76cc9639101.18366310', '36944b76cc9604c53.04579642', 'Herr', 'Max', 'Manager', 'management', 0, 0, '2006-07-14 12:07:05', '0000-00-00 00:00:00');
INSERT INTO `oxnewssubscribed` VALUES ('36944b76d204210c1.05764016', '36944b76d203d4a35.41417835', 'Frau', 'Lisa', 'Leser', 'redaktion', 0, 0, '2006-07-14 12:08:32', '0000-00-00 00:00:00');
INSERT INTO `oxnewssubscribed` VALUES ('36944b76d6e5bd545.44755823', '36944b76d6e583fe2.12734046', 'Frau', 'Theresa', 'Bild', 'bild', 0, 0, '2006-07-14 12:09:50', '0000-00-00 00:00:00');
INSERT INTO `oxnewssubscribed` VALUES ('36944b76daea2c536.99998884', '36944b76dae9ef333.88219217', 'Herr', 'Franz', 'Zahlendreher', 'buchhaltung', 0, 0, '2006-07-14 12:10:54', '0000-00-00 00:00:00');
INSERT INTO `oxnewssubscribed` VALUES ('36944b76e7181c237.17167204', '36944b76e717de855.40215733', 'Herr', 'Peter', 'Produktmanager', 'produkt', 0, 0, '2006-07-14 12:14:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxobject2article`
-- 

DROP TABLE IF EXISTS `oxobject2article`;
CREATE TABLE IF NOT EXISTS `oxobject2article` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXARTICLENID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSORT` int(5) NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `OXARTICLENID` (`OXARTICLENID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxobject2article`
-- 

INSERT INTO `oxobject2article` VALUES ('f3b42c8ebed014e90.57967132', '1127', '1126', 0);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ebf5e7d097.00651074', '2080', '1126', 1);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ec10b52d55.03696996', '1849', '1126', 2);
INSERT INTO `oxobject2article` VALUES ('d8842e3ba844fb876.30128335', '1477', '1131', 1);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ecd2d0bf53.53048959', '1127', '1142', 0);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ecd2e562b4.74239963', '1351', '1142', 1);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ecd309d112.45788358', '1431', '1142', 2);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ecd30d6668.80327393', '2036', '1142', 3);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ecfda636a5.65181642', '1131', '1351', 0);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ecfdaec183.82755295', '1906', '1351', 1);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ecfdb4f5b6.17263944', '2080', '1351', 2);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ed3e6500a6.86708939', '2036', '1431', 0);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ed3eb9cab8.97437591', '2080', '1431', 1);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ed621749e5.27436018', '1131', '1477', 0);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ed622969d0.41462911', '2080', '1477', 1);
INSERT INTO `oxobject2article` VALUES ('38c44b6501f6d5044.22435851', '2357', '1661', 0);
INSERT INTO `oxobject2article` VALUES ('d8842e3be6810fe50.67693228', '1951', 'be642cada8422f150.29332483', 0);
INSERT INTO `oxobject2article` VALUES ('f3b42c8edf399ab81.72500117', '2036', '1849', 1);
INSERT INTO `oxobject2article` VALUES ('f3b42c8edf3a05d20.39589386', '2080', '1849', 2);
INSERT INTO `oxobject2article` VALUES ('d8842e3bb8c4c9149.18616434', '1131', '1906', 0);
INSERT INTO `oxobject2article` VALUES ('d8842e3b47a690447.21503517', '2036', '2000', 0);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ee9da3f3f4.64346108', '1672', '1952', 0);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ee9daf7fe4.85344142', '2080', '1952', 4);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ef2304f374.62829975', '1126', '1964', 0);
INSERT INTO `oxobject2article` VALUES ('f3b42c8ef2306b686.51689146', '1127', '1964', 1);
INSERT INTO `oxobject2article` VALUES ('d8842e3ba478b9962.82403257', '1431', '2036', 3);
INSERT INTO `oxobject2article` VALUES ('d8842e3ba4036b480.96652024', '1849', '2036', 2);
INSERT INTO `oxobject2article` VALUES ('f3b42c8efc6e41037.73937097', '2080', '2036', 0);
INSERT INTO `oxobject2article` VALUES ('f3b42c8f002cb1758.49045846', '2036', '2077', 2);
INSERT INTO `oxobject2article` VALUES ('f3b42c8f017b58b27.95751501', '2036', '2080', 2);
INSERT INTO `oxobject2article` VALUES ('d8842e3cbf92dd116.12031970', '2080', 'd8842e3cbf9290351.59301740', 0);
INSERT INTO `oxobject2article` VALUES ('d8842e3cbf92db338.80458251', '2036', 'd8842e3cbf9290351.59301740', 0);
INSERT INTO `oxobject2article` VALUES ('d8842e3cbf92d9079.86009844', '1849', 'd8842e3cbf9290351.59301740', 0);
INSERT INTO `oxobject2article` VALUES ('d8842e3cbf92d5951.69775644', '1351', 'd8842e3cbf9290351.59301740', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf62b8b3c508.91985336', '2347', '2026', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf626d8c5482.82382089', '2041', '2201', 0);
INSERT INTO `oxobject2article` VALUES ('38c44b64f036a67f6.41168463', '2176', '2219', 0);
INSERT INTO `oxobject2article` VALUES ('38c44b64f1ff269c7.18640778', '2041', '2162', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf62b56ef0a5.30862429', '2275', '2026', 0);
INSERT INTO `oxobject2article` VALUES ('38c44b64f49686c37.75477286', '2347', '2275', 0);
INSERT INTO `oxobject2article` VALUES ('38c44b64f4c993fc8.80085792', '2026', '2275', 0);
INSERT INTO `oxobject2article` VALUES ('38c44b64fa79f5e18.84077232', '2275', '2276', 0);
INSERT INTO `oxobject2article` VALUES ('38c44b6502a875cd9.42555034', '1661', '2311', 0);
INSERT INTO `oxobject2article` VALUES ('38c44b65043260459.20684634', '2355', '2360', 0);
INSERT INTO `oxobject2article` VALUES ('38c44b65049512ca4.88743248', '2108', '2360', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf628ac45e03.53889729', '2201', '2041', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf62c89f4c03.33753189', '2275', '2347', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf62d07268b4.16438095', '2026', '2347', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf62f22e5bc9.78899516', '2357', '2363', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf62f96b1a49.11789063', '2355', '2363', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf6317351fd5.26954673', '2363', '2355', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf63202d12f2.36881283', '2355', '2355', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf632f47b793.31781529', '2363', '2357', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf633de8a776.51495131', '2357', '2357', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf6354278740.33847706', '2172', '2174', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf635ee6a7b5.35465247', '2174', '2172', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf6372ed39e1.18903087', '2177', '2174', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf6388067632.06814755', '2174', '2177', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf638ae8aa69.90066763', '2172', '2177', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf63a23e9858.97912444', '1849', '1876', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf63ad83dc82.58131113', '1876', '1849', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf63c10e5651.48088036', '1889', '2092', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf63c2cfc502.55918663', '2296', '2092', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf63d4a86de9.70608207', '1889', '1889', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf63d73c20d1.72735106', '2296', '1889', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf63eb800db4.62528403', '1889', '2296', 0);
INSERT INTO `oxobject2article` VALUES ('99b44bf63f9164090.55988818', '2092', '2296', 0);
INSERT INTO `oxobject2article` VALUES ('56344c5f09553f772.99823869', '2357', '1651', 0);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxobject2attribute`
-- 

DROP TABLE IF EXISTS `oxobject2attribute`;
CREATE TABLE IF NOT EXISTS `oxobject2attribute` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXATTRID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXVALUE` char(255) collate latin1_general_ci NOT NULL default '',
  `OXPOS` int(11) NOT NULL default '9999',
  `OXVALUE_1` char(255) collate latin1_general_ci NOT NULL default '',
  `OXVALUE_2` char(255) collate latin1_general_ci NOT NULL default '',
  `OXVALUE_3` char(255) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`OXID`),
  KEY `mainidx` (`OXATTRID`,`OXOBJECTID`),
  KEY `OXOBJECTID` (`OXOBJECTID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxobject2attribute`
-- 

INSERT INTO `oxobject2attribute` VALUES ('8a142c3e9d9ce6bb3.51485896', '1354', '8a142c3e9cd961518.80299776', 'originell', 0, 'funny', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3e9d9d30f75.33413698', '1672', '8a142c3e9cd961518.80299776', 'multifunktional', 0, 'multifunctional', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3e9d9d3ed54.65742055', '1951', '8a142c3e9cd961518.80299776', 'illustriert, 50ies Pin Up', 0, 'illustrated, 50 years', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3e9d9d49cd4.67697295', '2000', '8a142c3e9cd961518.80299776', 'illustriert', 0, 'illustrated', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3e9d9d5e4b1.56864379', '1771', '8a142c3e9cd961518.80299776', 'funktionell', 0, 'functional', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3ee3589ec00.03197472', '2000', '8a142c3ee0edb75d4.80743302', 'Zeiger', 0, 'hand', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3ee358b3323.54909751', '1771', '8a142c3ee0edb75d4.80743302', 'Digital', 0, 'Digital', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3ee358f7563.02508843', '1354', '8a142c3ee0edb75d4.80743302', 'Zeiger', 0, 'hand', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3ee359027e7.48825244', '1672', '8a142c3ee0edb75d4.80743302', 'Zeiger', 0, 'hand', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3ee359146b7.31524434', '1951', '8a142c3ee0edb75d4.80743302', 'Zeiger', 0, 'hand', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0c0b8e053.52460881', '1771', '8a142c3f0b9527634.96987022', 'H:19.9cm B:31.5cm', 0, 'H:19.9cm W:31.5cm', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0c0ba01f8.44433505', '1354', '8a142c3f0b9527634.96987022', '33 cm', 0, '33 cm', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0c0baa3f4.54955953', '1672', '8a142c3f0b9527634.96987022', '25 cm', 0, '25 cm', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0c0bb4b68.14329516', '1951', '8a142c3f0b9527634.96987022', '34 cm', 0, '34 cm', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0c0bfbbd9.42656154', '2000', '8a142c3f0b9527634.96987022', '40 cm', 0, '40 cm', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0cd0510f6.51670429', '1771', '8a142c3f0a792c0c3.93013584', 'Wanduhr', 0, 'Wall clock', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0cd05bc70.58004989', '1354', '8a142c3f0a792c0c3.93013584', 'Wanduhr', 0, 'Wall clock', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0cd067859.85982626', '1672', '8a142c3f0a792c0c3.93013584', 'Wanduhr', 0, 'Wall clock', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0cd0ae949.59059588', '1951', '8a142c3f0a792c0c3.93013584', 'Wanduhr', 0, 'Wall clock', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0cd0bc247.63949489', '2000', '8a142c3f0a792c0c3.93013584', 'Wanduhr', 0, 'Wall clock', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0ec842861.09161716', '1771', '8a142c3f0e2cf1a34.78041155', 'Aluminium', 0, 'Aluminium', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0ec853a41.11711465', '1354', '8a142c3f0e2cf1a34.78041155', 'Stahl poliert', 0, 'polished steel', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0ec85dd05.40730849', '1672', '8a142c3f0e2cf1a34.78041155', 'Kunststoff', 0, 'plastic', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0ec868691.52087408', '1951', '8a142c3f0e2cf1a34.78041155', 'Glas', 0, 'Glas', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f0ec8feb39.36965590', '2000', '8a142c3f0e2cf1a34.78041155', 'Glas', 0, 'Glas', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f108bf3fd2.63605568', '1771', '8a142c3f0fdb08972.22223006', 'Silber/Schwarz', 0, 'Silver/Black', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f108c04441.47766572', '1354', '8a142c3f0fdb08972.22223006', 'silber', 0, 'silver', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f108c11931.94573917', '1672', '8a142c3f0fdb08972.22223006', 'Silber', 0, 'Silver', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f108ca9c20.04110659', '1951', '8a142c3f0fdb08972.22223006', 'Abbildung', 0, 'see picture', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f108cef349.65903283', '2000', '8a142c3f0fdb08972.22223006', 'Rot', 0, 'Red', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f1aa822c72.38290888', '1771', '8a142c3f14ef22a14.79693851', 'Büro', 0, 'Office', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f1aa8353c1.59930732', '1354', '8a142c3f14ef22a14.79693851', 'Büro, Home', 0, 'Office, home', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f1aa83f560.02678287', '1672', '8a142c3f14ef22a14.79693851', 'Wohnzimmer', 0, 'Living room', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f1aa848f03.11137616', '1951', '8a142c3f14ef22a14.79693851', 'Home', 0, 'Home', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3f1aa88ab66.37411341', '2000', '8a142c3f14ef22a14.79693851', 'Wohnzimmer', 0, 'Living room', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3fbad372cd7.91952738', '2080', '8a142c3fb2344b7e6.08706912', 'Vielseitig einsetzbar', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('d8842e3cb3567e562.26057815', 'd8842e3cb356356f4.93820547', '8a142c3f0a792c0c3.93013584', 'Wanduhr', 9999, 'Wall clock', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3fbad3d8fb1.67233936', '1142', '8a142c3fb2344b7e6.08706912', 'Bier', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3fbad3e4d33.27220828', '1906', '8a142c3fb2344b7e6.08706912', 'Wein', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('d8842e3cb35681eb1.55581384', 'd8842e3cb356356f4.93820547', '8a142c3f0e2cf1a34.78041155', 'Kunststoff', 9999, 'plastic', '', '');
INSERT INTO `oxobject2attribute` VALUES ('d8842e3b7d4e72977.23671537', '1127', 'd8842e3b7c5e108c1.63072778', 'Kunsstoff, LED mit Mini-Batterie', 0, 'plastic with LED', '', '');
INSERT INTO `oxobject2attribute` VALUES ('d8842e3b7d4e7acb1.34583879', '1351', 'd8842e3b7c5e108c1.63072778', 'Granit', 0, 'granite', '', '');
INSERT INTO `oxobject2attribute` VALUES ('d8842e3cb356854d5.98403201', 'd8842e3cb356356f4.93820547', '8a142c3f14ef22a14.79693851', 'Home,Büro', 9999, 'Home,Office', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3fd986a0003.92771543', '1142', '8a142c3fd8f69f6d0.34274236', 'Originell', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3fd986abcb4.31354108', '1906', '8a142c3fd8f69f6d0.34274236', 'Originell', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3fd986bfab3.13382583', '1431', '8a142c3fd8f69f6d0.34274236', 'romantisch', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3fd986cd448.22057721', '1127', '8a142c3fd8f69f6d0.34274236', 'Trendig', 0, 'trendy', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3fd987b4a62.74940302', '1351', '8a142c3fd8f69f6d0.34274236', 'Naturbelassen', 0, 'natural', '', '');
INSERT INTO `oxobject2attribute` VALUES ('d8842e3cb35683ae4.14639307', 'd8842e3cb356356f4.93820547', '8a142c3f0fdb08972.22223006', 'Grün/Silber', 9999, 'Green/Silver', '', '');
INSERT INTO `oxobject2attribute` VALUES ('d8842e3b7d4e7fde9.04464303', '1431', 'd8842e3b7c5e108c1.63072778', 'Kunsstoff mit Gel-Füllung (lebensmittelecht)', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('8a142c3fd987d9ef7.68545233', '2080', '8a142c3fd8f69f6d0.34274236', 'Modern', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('d8842e3cb3567c010.42997902', 'd8842e3cb356356f4.93820547', '8a142c3ee0edb75d4.80743302', 'Zeiger', 9999, 'hand', '', '');
INSERT INTO `oxobject2attribute` VALUES ('d8842e3cb35675756.41352910', 'd8842e3cb356356f4.93820547', '8a142c3e9cd961518.80299776', 'Futuristisch', 9999, 'futuristic', '', '');
INSERT INTO `oxobject2attribute` VALUES ('d8842e3b541cfaee2.08718010', '85b42c94a32b3fdd2.66642220', 'd8842e3b51c3342c8.87563759', '', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be104a556628.31114952', '2162', 'e7744be103ccf54a8.48792250', '', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be104a582309.42000481', '2196', 'e7744be103ccf54a8.48792250', '', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be104a587429.73755495', '2219', 'e7744be103ccf54a8.48792250', '', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be104a58c0d7.17498404', '2201', 'e7744be103ccf54a8.48792250', '', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be1345511966.65783365', '2360', 'e7744be1339af28b3.24750515', '', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be134550c936.78637065', '2355', 'e7744be1339af28b3.24750515', '', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be1345506897.50487126', '2357', 'e7744be1339af28b3.24750515', '', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be1345516819.86899725', '2108', 'e7744be1339af28b3.24750515', '', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be135d226cd7.78490562', '1889', 'e7744be1353176001.72682063', '', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be135d22c7e3.23514799', '2296', 'e7744be1353176001.72682063', '', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be1a030e58d7.69238825', '2278', '8a142c3fd8f69f6d0.34274236', 'Pop-Industrial', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be1a29391472.78864723', '2276', '8a142c3fd8f69f6d0.34274236', 'Retro-Rustikal', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be1a4c0297e4.50924934', '2229', '8a142c3fd8f69f6d0.34274236', 'Glamour-Kitsch', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be1a5f43ab35.10557744', '2231', '8a142c3fd8f69f6d0.34274236', 'Modern-Avantgarde', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be1abd605f45.36310164', '2276', 'e7744be1aa6a58aa1.45635133', 'Kunsstoff', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be1acdd22a79.34618246', '2278', 'e7744be1aa6a58aa1.45635133', 'Kunsstoff', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be1af4646335.28089502', '2229', 'e7744be1aa6a58aa1.45635133', 'Acryl-Glas', 0, '', '', '');
INSERT INTO `oxobject2attribute` VALUES ('e7744be1b07824824.87780568', '2231', 'e7744be1aa6a58aa1.45635133', 'Chrom', 0, '', '', '');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxobject2category`
-- 

DROP TABLE IF EXISTS `oxobject2category`;
CREATE TABLE IF NOT EXISTS `oxobject2category` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXSHOPINCL` bigint(20) unsigned NOT NULL default '1',
  `OXSHOPEXCL` bigint(20) unsigned NOT NULL default '0',
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXCATNID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXPOS` int(11) NOT NULL default '0',
  `OXTIME` int(11) NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `OXOBJECTID` (`OXOBJECTID`),
  KEY `OXPOS` (`OXPOS`),
  KEY `OXMAINIDX` (`OXCATNID`,`OXOBJECTID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxobject2category`
-- 

INSERT INTO `oxobject2category` VALUES ('db744b7714e4c5244.33824891', 1, 18446744073709551615, 0, '2201', '30e44ab82c03c3848.49471214', 0, 0);
INSERT INTO `oxobject2category` VALUES ('c3944abfce4abac04.37379630', 1, 18446744073709551615, 0, '1487', '30e44ab85ace67180.85905139', 0, 1152122084);
INSERT INTO `oxobject2category` VALUES ('c3944abfcd1cd6ef4.04831554', 1, 18446744073709551615, 0, '2176', '30e44ab835e52cd24.95278795', 0, 1152122065);
INSERT INTO `oxobject2category` VALUES ('c3944abfcb65fa403.64304052', 1, 18446744073709551615, 0, '2080', '30e44ab8593023055.23928895', 0, 1152122038);
INSERT INTO `oxobject2category` VALUES ('c3944abfcb65f3946.95102257', 1, 18446744073709551615, 0, '1876', '30e44ab8593023055.23928895', 0, 1152122038);
INSERT INTO `oxobject2category` VALUES ('c3944abfcb65ece06.71780964', 1, 18446744073709551615, 0, '1127', '30e44ab8593023055.23928895', 0, 1152122038);
INSERT INTO `oxobject2category` VALUES ('c3944abfcb65e61d1.80568237', 1, 18446744073709551615, 0, '1849', '30e44ab8593023055.23928895', 0, 1152122038);
INSERT INTO `oxobject2category` VALUES ('c3944abfcb65df896.82849720', 1, 18446744073709551615, 0, '1351', '30e44ab8593023055.23928895', 0, 1152122038);
INSERT INTO `oxobject2category` VALUES ('c3944abfcb65d8f79.03178254', 1, 18446744073709551615, 0, '1906', '30e44ab8593023055.23928895', 0, 1152122038);
INSERT INTO `oxobject2category` VALUES ('c3944abfcb65d25d0.68292962', 1, 18446744073709551615, 0, '1477', '30e44ab8593023055.23928895', 0, 1152122038);
INSERT INTO `oxobject2category` VALUES ('c3944abfcb65cbd65.18363702', 1, 18446744073709551615, 0, '1431', '30e44ab8593023055.23928895', 0, 1152122038);
INSERT INTO `oxobject2category` VALUES ('c3944abfcb65c55a5.10604209', 1, 18446744073709551615, 0, '2036', '30e44ab8593023055.23928895', 0, 1152122038);
INSERT INTO `oxobject2category` VALUES ('c3944abfcb65bed58.28124061', 1, 18446744073709551615, 0, '1142', '30e44ab8593023055.23928895', 0, 1152122038);
INSERT INTO `oxobject2category` VALUES ('c3944abfcb65b8301.93421266', 1, 18446744073709551615, 0, '1131', '30e44ab8593023055.23928895', 0, 1152122038);
INSERT INTO `oxobject2category` VALUES ('c3944abfcb65b13a3.66180278', 1, 18446744073709551615, 0, '1126', '30e44ab8593023055.23928895', 0, 1152122038);
INSERT INTO `oxobject2category` VALUES ('c3944abfc725d4390.62544611', 1, 18446744073709551615, 0, '2000', '30e44ab85808a1f05.26160932', 0, 1152121970);
INSERT INTO `oxobject2category` VALUES ('c3944abfc725cdaa3.41721299', 1, 18446744073709551615, 0, '1354', '30e44ab85808a1f05.26160932', 0, 1152121970);
INSERT INTO `oxobject2category` VALUES ('c3944abfc725c7098.57460526', 1, 18446744073709551615, 0, '1951', '30e44ab85808a1f05.26160932', 0, 1152121970);
INSERT INTO `oxobject2category` VALUES ('c3944abfc725c07e1.97215894', 1, 18446744073709551615, 0, '1771', '30e44ab85808a1f05.26160932', 0, 1152121970);
INSERT INTO `oxobject2category` VALUES ('c3944abfc725b9e35.10358633', 1, 18446744073709551615, 0, '1672', '30e44ab85808a1f05.26160932', 0, 1152121970);
INSERT INTO `oxobject2category` VALUES ('c3944abfc725b3176.60999936', 1, 18446744073709551615, 0, '2028', '30e44ab85808a1f05.26160932', 0, 1152121970);
INSERT INTO `oxobject2category` VALUES ('c3944abfc5bc0ff27.23085327', 1, 18446744073709551615, 0, '2041', '30e44ab82c03c3848.49471214', 0, 1152121947);
INSERT INTO `oxobject2category` VALUES ('c3944abfc39cab664.32559432', 1, 18446744073709551615, 0, '2363', '30e44ab835e52cd24.95278795', 0, 1152121913);
INSERT INTO `oxobject2category` VALUES ('c3944abfbfaea4da7.08004407', 1, 18446744073709551615, 0, '1889', '28344abcb845cc232.04196124', 0, 1152121850);
INSERT INTO `oxobject2category` VALUES ('c3944abfbf5847884.13396412', 1, 18446744073709551615, 0, '2296', '28344abcb845cc232.04196124', 0, 1152121845);
INSERT INTO `oxobject2category` VALUES ('c3944abfbdde28392.30779079', 1, 18446744073709551615, 0, '2357', '30e44ab854b0d88f7.58173260', 0, 1152121821);
INSERT INTO `oxobject2category` VALUES ('c3944abfbdde212f2.21348592', 1, 18446744073709551615, 0, '2360', '30e44ab854b0d88f7.58173260', 0, 1152121821);
INSERT INTO `oxobject2category` VALUES ('c3944abfbdde1a943.92178804', 1, 18446744073709551615, 0, '2355', '30e44ab854b0d88f7.58173260', 0, 1152121821);
INSERT INTO `oxobject2category` VALUES ('c3944abfbdde13b21.99336838', 1, 18446744073709551615, 0, '2108', '30e44ab854b0d88f7.58173260', 0, 1152121821);
INSERT INTO `oxobject2category` VALUES ('c3944abfbc62724f8.33178780', 1, 18446744073709551615, 0, '2311', '30e44ab83fdee7564.23264141', 0, 1152121798);
INSERT INTO `oxobject2category` VALUES ('c3944abfbc279fef7.45530319', 1, 18446744073709551615, 0, '1661', '30e44ab83fdee7564.23264141', 0, 1152121794);
INSERT INTO `oxobject2category` VALUES ('c3944abfbbe0227d5.75452498', 1, 18446744073709551615, 0, '1651', '30e44ab83fdee7564.23264141', 0, 1152121790);
INSERT INTO `oxobject2category` VALUES ('c3944abfbb9932011.94438302', 1, 18446744073709551615, 0, '2276', '30e44ab83fdee7564.23264141', 0, 1152121785);
INSERT INTO `oxobject2category` VALUES ('c3944abfb9f8985f4.02746626', 1, 18446744073709551615, 0, '2264', '30e44ab83159266c7.83602558', 0, 0);
INSERT INTO `oxobject2category` VALUES ('c3944abfb8e61db28.07821933', 1, 18446744073709551615, 0, '2092', '30e44ab83159266c7.83602558', 0, 1152121742);
INSERT INTO `oxobject2category` VALUES ('c3944abfb53dfcfb2.84222065', 1, 18446744073709551615, 0, '2347', '30e44ab83e7a45c03.75889797', 0, 1152121683);
INSERT INTO `oxobject2category` VALUES ('c3944abfb4e652ea5.38457513', 1, 18446744073709551615, 0, '2026', '30e44ab83e7a45c03.75889797', 0, 1152121678);
INSERT INTO `oxobject2category` VALUES ('c3944abfb49a70933.53421865', 1, 18446744073709551615, 0, '2275', '30e44ab83e7a45c03.75889797', 0, 1152121673);
INSERT INTO `oxobject2category` VALUES ('c3944abfb2473a1c0.24052688', 1, 18446744073709551615, 0, '2231', '30e44ab83c31b4485.54423065', 0, 1152121636);
INSERT INTO `oxobject2category` VALUES ('c3944abfb2059e776.01370794', 1, 18446744073709551615, 0, '2229', '30e44ab83c31b4485.54423065', 0, 1152121632);
INSERT INTO `oxobject2category` VALUES ('c3944abfb15da0dc1.98792274', 1, 18446744073709551615, 0, '2278', '30e44ab83c31b4485.54423065', 0, 1152121621);
INSERT INTO `oxobject2category` VALUES ('c3944abfaf5988ab3.52884863', 1, 18446744073709551615, 0, '2162', '30e44ab838094a7d2.59137554', 0, 1152121589);
INSERT INTO `oxobject2category` VALUES ('c3944abfaea7bf509.00517743', 1, 18446744073709551615, 0, '2219', '30e44ab838094a7d2.59137554', 0, 1152121578);
INSERT INTO `oxobject2category` VALUES ('c3944abfaea7b8646.93657656', 1, 18446744073709551615, 0, '2196', '30e44ab838094a7d2.59137554', 0, 1152121578);
INSERT INTO `oxobject2category` VALUES ('c3944abfad12e9971.49004472', 1, 18446744073709551615, 0, '2292', '30e44ab835e52cd24.95278795', 0, 1152121553);
INSERT INTO `oxobject2category` VALUES ('a1544b76779234310.78393139', 1, 18446744073709551615, 0, '2275', '30e44ab83d52c6d74.06410508', 0, 1152870265);
INSERT INTO `oxobject2category` VALUES ('c3944abfabc07ea64.88135196', 1, 18446744073709551615, 0, '1436', '30e44ab8338d7bf06.79655612', 0, 1152121532);
INSERT INTO `oxobject2category` VALUES ('c3944abfa9e14d6c8.76396864', 1, 18446744073709551615, 0, '2172', '30e44ab83159266c7.83602558', 0, 1152121502);
INSERT INTO `oxobject2category` VALUES ('c3944abfa9ab9bc95.67531314', 1, 18446744073709551615, 0, '2174', '30e44ab83159266c7.83602558', 0, 1152121498);
INSERT INTO `oxobject2category` VALUES ('7cb44b5010a9e7814.12977139', 1, 18446744073709551615, 0, '2177', '30e44ab82c03c3848.49471214', 0, 0);
INSERT INTO `oxobject2category` VALUES ('7cb44b5018c95ec35.93432869', 1, 18446744073709551615, 0, '2174', '30e44ab82c03c3848.49471214', 0, 1152713100);
INSERT INTO `oxobject2category` VALUES ('7cb44b5019a9ec8f1.66334763', 1, 18446744073709551615, 0, '2172', '30e44ab82c03c3848.49471214', 0, 1152713114);
INSERT INTO `oxobject2category` VALUES ('7cb44b501abd04228.20270813', 1, 18446744073709551615, 0, '1436', '30e44ab82c03c3848.49471214', 0, 1152713131);
INSERT INTO `oxobject2category` VALUES ('7cb44b501b75c15c0.20050806', 1, 18446744073709551615, 0, '2176', '30e44ab834ea42417.86131097', 0, 1152713143);
INSERT INTO `oxobject2category` VALUES ('7cb44b501c533df43.28242402', 1, 18446744073709551615, 0, '2292', '30e44ab834ea42417.86131097', 0, 1152713157);
INSERT INTO `oxobject2category` VALUES ('7cb44b501d3da0777.36186466', 1, 18446744073709551615, 0, '2219', '30e44ab834ea42417.86131097', 0, 1152713171);
INSERT INTO `oxobject2category` VALUES ('7cb44b501e55aefa7.32881112', 1, 18446744073709551615, 0, '2196', '30e44ab834ea42417.86131097', 0, 1152713189);
INSERT INTO `oxobject2category` VALUES ('7cb44b501f0d948d1.75815104', 1, 18446744073709551615, 0, '2162', '30e44ab82c03c3848.49471214', 0, 1152713200);
INSERT INTO `oxobject2category` VALUES ('7cb44b5022b88a587.73743358', 1, 18446744073709551615, 0, '2092', '30e44ab8539ce4931.41747937', 0, 1152713259);
INSERT INTO `oxobject2category` VALUES ('7cb44b50243291e53.08912427', 1, 18446744073709551615, 0, '1651', '30e44ab841af13e46.42570689', 0, 1152713283);
INSERT INTO `oxobject2category` VALUES ('7cb44b502c9db9161.28084089', 1, 18446744073709551615, 0, '1661', '30e44ab841af13e46.42570689', 0, 1152713417);
INSERT INTO `oxobject2category` VALUES ('7cb44b502e584f5e5.97677557', 1, 18446744073709551615, 0, '2311', '30e44ab841af13e46.42570689', 0, 1152713445);
INSERT INTO `oxobject2category` VALUES ('7cb44b502f74b2e29.53966942', 1, 18446744073709551615, 0, '2357', '30e44ab841af13e46.42570689', 0, 1152713463);
INSERT INTO `oxobject2category` VALUES ('7cb44b502fb48fa40.90425050', 1, 18446744073709551615, 0, '2357', '30e44ab8539ce4931.41747937', 0, 1152713467);
INSERT INTO `oxobject2category` VALUES ('7cb44b50307c5fd30.58557692', 1, 18446744073709551615, 0, '2360', '30e44ab8539ce4931.41747937', 0, 1152713479);
INSERT INTO `oxobject2category` VALUES ('7cb44b50313ee13b5.50992449', 1, 18446744073709551615, 0, '2355', '30e44ab8539ce4931.41747937', 0, 1152713491);
INSERT INTO `oxobject2category` VALUES ('e7744be1bc1a88908.42990222', 1, 18446744073709551615, 0, '2276', '30e44ab83c31b4485.54423065', 0, 1153309633);
INSERT INTO `oxobject2category` VALUES ('7cb44b50328605951.30534016', 1, 18446744073709551615, 0, '2296', '30e44ab8539ce4931.41747937', 0, 1152713512);
INSERT INTO `oxobject2category` VALUES ('7cb44b5033f06d214.16441241', 1, 18446744073709551615, 0, '1889', '30e44ab8539ce4931.41747937', 0, 1152713535);
INSERT INTO `oxobject2category` VALUES ('7cb44b5034982d496.53691063', 1, 18446744073709551615, 0, '2363', '30e44ab834ea42417.86131097', 0, 1152713545);
INSERT INTO `oxobject2category` VALUES ('7cb44b50482b83e12.14327886', 1, 18446744073709551615, 0, '1127', '30e44ab83fdee7564.23264141', 0, 1152713858);
INSERT INTO `oxobject2category` VALUES ('7cb44b504a678e179.67682959', 1, 18446744073709551615, 0, '2278', '30e44ab83b6e585c9.63147165', 0, 1152713894);
INSERT INTO `oxobject2category` VALUES ('38c44b63e51e5f453.55744559', 1, 18446744073709551615, 0, '1873', '30e44ab82c03c3848.49471214', 0, 1152794193);
INSERT INTO `oxobject2category` VALUES ('38c44b66b317773d2.12304214', 1, 18446744073709551615, 0, '2000', '30e44ab83b6e585c9.63147165', 0, 1152805681);
INSERT INTO `oxobject2category` VALUES ('38c44b66b43b1b3f3.92840480', 1, 18446744073709551615, 0, '1354', '30e44ab83b6e585c9.63147165', 0, 1152805699);
INSERT INTO `oxobject2category` VALUES ('a1544b7678e1014e2.93119993', 1, 18446744073709551615, 0, '2276', '30e44ab83d52c6d74.06410508', 0, 1152870286);
INSERT INTO `oxobject2category` VALUES ('db744b77154ef88f0.61935626', 1, 18446744073709551615, 0, '2201', '30e44ab83159266c7.83602558', 0, 1152872798);
INSERT INTO `oxobject2category` VALUES ('db744b7723e7b4020.46092151', 1, 18446744073709551615, 0, '2229', '30e44ab83b6e585c9.63147165', 0, 1152873022);
INSERT INTO `oxobject2category` VALUES ('3c544b782ad33d8f7.00311321', 1, 18446744073709551615, 0, '2201', '30e44ab838094a7d2.59137554', 0, 1152877229);
INSERT INTO `oxobject2category` VALUES ('81c44bf3b69472c28.10496242', 1, 18446744073709551615, 0, 'a7c44be4a5ddee114.67356237', '30e44ab85ace67180.85905139', 0, 1153383273);
INSERT INTO `oxobject2category` VALUES ('e7744be16142ac1f4.83025663', 1, 18446744073709551615, 0, '2092', '30e44ab83d52c6d74.06410508', 0, 1153308180);
INSERT INTO `oxobject2category` VALUES ('e7744be1658772cc6.33163739', 1, 18446744073709551615, 0, '1351', '30e44ab83fdee7564.23264141', 0, 1153308248);
INSERT INTO `oxobject2category` VALUES ('0d144bf8da887e9f0.30302616', 1, 18446744073709551615, 0, '1131', '30e44ab835e52cd24.95278795', 0, 1153404328);
INSERT INTO `oxobject2category` VALUES ('3ee44bf92b838cb80.18678924', 1, 18446744073709551615, 0, '1131', '3ee44bf92addf2da2.73918494', 0, 1153405624);
INSERT INTO `oxobject2category` VALUES ('3ee44bf92becd4a70.92945346', 1, 18446744073709551615, 0, '1477', '3ee44bf92addf2da2.73918494', 0, 1153405630);
INSERT INTO `oxobject2category` VALUES ('3ee44bf931cefb8e2.60508902', 1, 18446744073709551615, 0, '1351', '3ee44bf93154089e5.13807232', 0, 1153405724);
INSERT INTO `oxobject2category` VALUES ('3ee44bf9321bbfb50.23229931', 1, 18446744073709551615, 0, '1431', '3ee44bf93154089e5.13807232', 0, 1153405729);
INSERT INTO `oxobject2category` VALUES ('3ee44bf9324b54e68.83296968', 1, 18446744073709551615, 0, '1127', '3ee44bf93154089e5.13807232', 0, 1153405732);
INSERT INTO `oxobject2category` VALUES ('3ee44bf9343cf1b50.42044918', 1, 18446744073709551615, 0, '2080', '3ee44bf933cf342e2.99739972', 0, 1153405763);
INSERT INTO `oxobject2category` VALUES ('3ee44bf9347723d67.57572579', 1, 18446744073709551615, 0, '1906', '3ee44bf933cf342e2.99739972', 0, 1153405767);
INSERT INTO `oxobject2category` VALUES ('3ee44bf934fad55d9.91241596', 1, 18446744073709551615, 0, '1142', '3ee44bf933cf342e2.99739972', 0, 1153405775);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxobject2delivery`
-- 

DROP TABLE IF EXISTS `oxobject2delivery`;
CREATE TABLE IF NOT EXISTS `oxobject2delivery` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXDELIVERYID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXTYPE` char(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`OXID`),
  KEY `OXOBJECTID` (`OXOBJECTID`),
  KEY `OXDELIVERYID` (`OXDELIVERYID`,`OXTYPE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxobject2delivery`
-- 

INSERT INTO `oxobject2delivery` VALUES ('1b842e73492c49fc1.89449037', '1b842e73470578914.54719298', 'a7c40f631fc920687.20179984', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('1b842e73518675688.37164512', '1b842e734b62a4775.45738618', 'a7c40f631fc920687.20179984', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('1b842e7365236d723.56675119', '1b842e7352422a708.01472527', 'a7c40f6320aeb2ec2.72885259', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('1b842e73652371be0.05571694', '1b842e7352422a708.01472527', 'a7c40f6321c6f6109.43859248', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('1b842e7379e4a8fe8.52771023', 'oxidstandard', 'a7c40f6320aeb2ec2.72885259', 'oxdelset');
INSERT INTO `oxobject2delivery` VALUES ('1b842e7379e4ad6b4.73750214', 'oxidstandard', 'a7c40f6321c6f6109.43859248', 'oxdelset');
INSERT INTO `oxobject2delivery` VALUES ('b0e42247b75236c85.30800643', 'oxidstandard', 'a7c40f631fc920687.20179984', 'oxdelset');
INSERT INTO `oxobject2delivery` VALUES ('1b842e738a57b13d8.84689294', '1b842e738970d31e3.71258328', 'a7c40f631fc920687.20179984', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('1b842e738a57b53e5.95343864', '1b842e738970d31e3.71258328', 'a7c40f6320aeb2ec2.72885259', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('1b842e738a57b88d2.91633326', '1b842e738970d31e3.71258328', 'a7c40f6321c6f6109.43859248', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('1b842e738a57b13d8.84689291', '1b842e738970d31e3.71258327', 'a7c40f631fc920687.20179984', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('1b842e738a57b53e5.95343861', '1b842e738970d31e3.71258327', 'a7c40f6320aeb2ec2.72885259', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('1b842e738a57b88d2.91633321', '1b842e738970d31e3.71258327', 'a7c40f6321c6f6109.43859248', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('1b842e738b67c10d2.46463031', '1b842e732a23255b1.91207750', 'a7c40f631fc920687.20179984', 'oxdelset');
INSERT INTO `oxobject2delivery` VALUES ('1b842e738b67c10d2.46463030', '1b842e732a23255b1.91207751', 'a7c40f631fc920687.20179984', 'oxdelset');
INSERT INTO `oxobject2delivery` VALUES ('1b842e738b67c6567.02889856', '1b842e732a23255b1.91207750', 'a7c40f6320aeb2ec2.72885259', 'oxdelset');
INSERT INTO `oxobject2delivery` VALUES ('1b842e738b67c6567.02889857', '1b842e732a23255b1.91207751', 'a7c40f6320aeb2ec2.72885259', 'oxdelset');
INSERT INTO `oxobject2delivery` VALUES ('1b842e738b67c99e7.94996181', '1b842e732a23255b1.91207750', 'a7c40f6321c6f6109.43859248', 'oxdelset');
INSERT INTO `oxobject2delivery` VALUES ('1b842e738b67c99e7.94996180', '1b842e732a23255b1.91207751', 'a7c40f6321c6f6109.43859248', 'oxdelset');
INSERT INTO `oxobject2delivery` VALUES ('b0e42247b8d71f086.77687951', 'f324215af31591936.94392085', 'a7c40f631fc920687.20179984', 'oxdelset');
INSERT INTO `oxobject2delivery` VALUES ('b0e42247b8d74bcc1.13991977', 'f324215af31591936.94392085', 'a7c40f6320aeb2ec2.72885259', 'oxdelset');
INSERT INTO `oxobject2delivery` VALUES ('b0e42247b8d762574.83891789', 'f324215af31591936.94392085', 'a7c40f6321c6f6109.43859248', 'oxdelset');
INSERT INTO `oxobject2delivery` VALUES ('ae04162c305b43e28.80521046', '3033e968fb5b30930.92732498', 'a7c40f631fc920687.20179984', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('ae04162c305b8a214.78574016', '3033e968fb5b30930.92732498', 'a7c40f6320aeb2ec2.72885259', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('ae04162c305b93482.59033720', '3033e968fb5b30930.92732498', 'a7c40f6321c6f6109.43859248', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('ae04162c30bf11d09.84389223', 'b763e957be61108f8.80080127', 'a7c40f631fc920687.20179984', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('ae04162c30bf20431.70969824', 'b763e957be61108f8.80080127', 'a7c40f6320aeb2ec2.72885259', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('ae04162c30bf29273.07047115', 'b763e957be61108f8.80080127', 'a7c40f6321c6f6109.43859248', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('ae04162c31189e656.37716651', '3033e968ea11e6761.68821765', 'a7c40f631fc920687.20179984', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('ae04162c3118b0159.44708340', '3033e968ea11e6761.68821765', 'a7c40f6320aeb2ec2.72885259', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('ae04162c3118b8f10.17475457', '3033e968ea11e6761.68821765', 'a7c40f6321c6f6109.43859248', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('ae04162c316767f38.84312273', 'b763e957d6d42dd40.18579550', 'a7c40f631fc920687.20179984', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('ae04162c31677dcf2.40358333', 'b763e957d6d42dd40.18579550', 'a7c40f6320aeb2ec2.72885259', 'oxcountry');
INSERT INTO `oxobject2delivery` VALUES ('ae04162c316786d15.81085559', 'b763e957d6d42dd40.18579550', 'a7c40f6321c6f6109.43859248', 'oxcountry');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxobject2discount`
-- 

DROP TABLE IF EXISTS `oxobject2discount`;
CREATE TABLE IF NOT EXISTS `oxobject2discount` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXDISCOUNTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXTYPE` char(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`OXID`),
  KEY `mainidx` (`OXOBJECTID`,`OXDISCOUNTID`,`OXTYPE`),
  KEY `oxdiscidx` (`OXDISCOUNTID`,`OXTYPE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxobject2discount`
-- 

INSERT INTO `oxobject2discount` VALUES ('4e542e4e8f60a0562.61817542', '4e542e4e8dd127836.00288451', '1771', 'oxarticles');
INSERT INTO `oxobject2discount` VALUES ('79042e787b414fae9.16540313', '4e542e4e8dd127836.00288451', '85b42c94a32b3fdd2.66642220', 'oxarticles');
INSERT INTO `oxobject2discount` VALUES ('0a842e4fd23a60e04.47404876', '4e542e4e8dd127836.00288451', '1431', 'oxarticles');
INSERT INTO `oxobject2discount` VALUES ('79042e787aea9e9d9.36926408', '4e542e4e8dd127836.00288451', 'd8842e3cbf9290351.59301740', 'oxarticles');
INSERT INTO `oxobject2discount` VALUES ('1b842e75a0d186fa8.13645432', '0693e8aab9b01dc46.38765070', 'a7c40f6320aeb2ec2.72885259', 'oxcountry');
INSERT INTO `oxobject2discount` VALUES ('1b842e75a0d181dc5.03163547', '0693e8aab9b01dc46.38765070', 'a7c40f631fc920687.20179984', 'oxcountry');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxobject2group`
-- 

DROP TABLE IF EXISTS `oxobject2group`;
CREATE TABLE IF NOT EXISTS `oxobject2group` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXGROUPSID` char(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`OXID`),
  KEY `OXOBJECTID` (`OXOBJECTID`),
  KEY `OXGROUPSID` (`OXGROUPSID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxobject2group`
-- 

INSERT INTO `oxobject2group` VALUES ('e913fdd8443ed43e1.51222316', 1, 'oxdefaultadmin', 'oxidadmin');
INSERT INTO `oxobject2group` VALUES ('f1d3fdd845d646ce0.54037160', 1, 'oxidcashondel', 'oxidsmallcust');
INSERT INTO `oxobject2group` VALUES ('f1d3fdd845d64f368.38782882', 1, 'oxidcashondel', 'oxidmiddlecust');
INSERT INTO `oxobject2group` VALUES ('f1d3fdd845d655500.24044370', 1, 'oxidcashondel', 'oxidgoodcust');
INSERT INTO `oxobject2group` VALUES ('f1d3fdd845d664a36.22008654', 1, 'oxidcashondel', 'oxidforeigncustomer');
INSERT INTO `oxobject2group` VALUES ('f1d3fdd845d66bfa6.86175113', 1, 'oxidcashondel', 'oxidnewcustomer');
INSERT INTO `oxobject2group` VALUES ('f1d3fdd845d671e32.96237048', 1, 'oxidcashondel', 'oxidpowershopper');
INSERT INTO `oxobject2group` VALUES ('f1d3fdd845d67e7c5.10668991', 1, 'oxidcashondel', 'oxiddealer');
INSERT INTO `oxobject2group` VALUES ('f1d3fdd845d6896c1.03162238', 1, 'oxidcashondel', 'oxidnewsletter');
INSERT INTO `oxobject2group` VALUES ('f1d3fdd845d691ec8.81166485', 1, 'oxidcashondel', 'oxidadmin');
INSERT INTO `oxobject2group` VALUES ('f1d3fdd845d69e885.91443232', 1, 'oxidcashondel', 'oxidpriceb');
INSERT INTO `oxobject2group` VALUES ('f1d3fdd845d6a67e0.02859671', 1, 'oxidcashondel', 'oxidpricea');
INSERT INTO `oxobject2group` VALUES ('f1d3fdd845d6ad995.44313456', 1, 'oxidcashondel', 'oxidpricec');
INSERT INTO `oxobject2group` VALUES ('c193fddd471979db5.85262084', 1, 'oxiddebitnote', 'oxidsmallcust');
INSERT INTO `oxobject2group` VALUES ('c193fddd471987391.56507198', 1, 'oxiddebitnote', 'oxidnewcustomer');
INSERT INTO `oxobject2group` VALUES ('c193fddd4719915f1.10073644', 1, 'oxiddebitnote', 'oxidnewsletter');
INSERT INTO `oxobject2group` VALUES ('c193fddd4719996f2.77898155', 1, 'oxiddebitnote', 'oxidadmin');
INSERT INTO `oxobject2group` VALUES ('c193fddd4831e2713.21232210', 1, 'oxidcreditcard', 'oxidsmallcust');
INSERT INTO `oxobject2group` VALUES ('c193fddd4831f6f46.50917349', 1, 'oxidcreditcard', 'oxidmiddlecust');
INSERT INTO `oxobject2group` VALUES ('c193fddd4831ff385.99230154', 1, 'oxidcreditcard', 'oxidgoodcust');
INSERT INTO `oxobject2group` VALUES ('c193fddd483207c10.92807988', 1, 'oxidcreditcard', 'oxidforeigncustomer');
INSERT INTO `oxobject2group` VALUES ('c193fddd483215d21.77186691', 1, 'oxidcreditcard', 'oxidnewcustomer');
INSERT INTO `oxobject2group` VALUES ('c193fddd48321e633.40782090', 1, 'oxidcreditcard', 'oxidpowershopper');
INSERT INTO `oxobject2group` VALUES ('c193fddd483225762.33412275', 1, 'oxidcreditcard', 'oxiddealer');
INSERT INTO `oxobject2group` VALUES ('c193fddd483233a87.07118337', 1, 'oxidcreditcard', 'oxidnewsletter');
INSERT INTO `oxobject2group` VALUES ('c193fddd48323bcb8.16273041', 1, 'oxidcreditcard', 'oxidadmin');
INSERT INTO `oxobject2group` VALUES ('c193fddd483242bc6.72020207', 1, 'oxidcreditcard', 'oxidpriceb');
INSERT INTO `oxobject2group` VALUES ('c193fddd483251c35.30210206', 1, 'oxidcreditcard', 'oxidpricea');
INSERT INTO `oxobject2group` VALUES ('c193fddd48325a223.07587162', 1, 'oxidcreditcard', 'oxidpricec');
INSERT INTO `oxobject2group` VALUES ('c193fddd4939c95b3.22730175', 1, 'oxidinvoice', 'oxidnewcustomer');
INSERT INTO `oxobject2group` VALUES ('c193fddd49772de88.87420931', 1, 'oxidinvoice', 'oxidgoodcust');
INSERT INTO `oxobject2group` VALUES ('c193fddd49b560bf7.83973615', 1, 'oxidpayadvance', 'oxidblacklist');
INSERT INTO `oxobject2group` VALUES ('c193fddd49b578c58.17144323', 1, 'oxidpayadvance', 'oxidsmallcust');
INSERT INTO `oxobject2group` VALUES ('c193fddd49b581dd2.00588439', 1, 'oxidpayadvance', 'oxidmiddlecust');
INSERT INTO `oxobject2group` VALUES ('c193fddd49b591ad7.64823006', 1, 'oxidpayadvance', 'oxidgoodcust');
INSERT INTO `oxobject2group` VALUES ('c193fddd49b599565.04338675', 1, 'oxidpayadvance', 'oxidforeigncustomer');
INSERT INTO `oxobject2group` VALUES ('c193fddd49b5a06b3.75268916', 1, 'oxidpayadvance', 'oxidnewcustomer');
INSERT INTO `oxobject2group` VALUES ('c193fddd49b5b5021.38970407', 1, 'oxidpayadvance', 'oxidpowershopper');
INSERT INTO `oxobject2group` VALUES ('c193fddd49b5bd575.90280311', 1, 'oxidpayadvance', 'oxiddealer');
INSERT INTO `oxobject2group` VALUES ('c193fddd49b5cc515.90816240', 1, 'oxidpayadvance', 'oxidnewsletter');
INSERT INTO `oxobject2group` VALUES ('c193fddd49b5d43e6.35256824', 1, 'oxidpayadvance', 'oxidadmin');
INSERT INTO `oxobject2group` VALUES ('c193fddd49b5db4e8.17741481', 1, 'oxidpayadvance', 'oxidpriceb');
INSERT INTO `oxobject2group` VALUES ('c193fddd49b5ed246.01214326', 1, 'oxidpayadvance', 'oxidpricea');
INSERT INTO `oxobject2group` VALUES ('c193fddd49b5f65d4.60703125', 1, 'oxidpayadvance', 'oxidpricec');
INSERT INTO `oxobject2group` VALUES ('dfc42e744180bf4a9.98598495', 1, 'dfc42e74417f07347.45624764', 'oxidnewcustomer');
INSERT INTO `oxobject2group` VALUES ('36944b76e00e9f3b6.01910047', 1, '36944b76d6e583fe2.12734046', '36944b76defac5622.13882269');
INSERT INTO `oxobject2group` VALUES ('36944b76e7667b2b0.39657742', 1, '36944b76e717de855.40215733', '36944b76defac5622.13882269');
INSERT INTO `oxobject2group` VALUES ('36944b76e00eb69e3.13916368', 1, '36944b76d203d4a35.41417835', '36944b76defac5622.13882269');
INSERT INTO `oxobject2group` VALUES ('36944b76e00ebdd99.48916836', 1, '36944b76cc9604c53.04579642', '36944b76defac5622.13882269');
INSERT INTO `oxobject2group` VALUES ('36944b76e00ec5232.02170826', 1, '36944b76dae9ef333.88219217', '36944b76defac5622.13882269');
INSERT INTO `oxobject2group` VALUES ('92044c0db9271e5b8.58103839', 1, '92044c0db9220e842.85595739', 'oxidnewcustomer');
INSERT INTO `oxobject2group` VALUES ('da8774741b377dfa7ffe783e90496194', 1, 'oxdefaultadmin', 'oxidnewcustomer');
INSERT INTO `oxobject2group` VALUES ('da89b1f4b1b99026437921da5aacee21', 1, 'oxdefaultadmin', 'oxidcustomer');
INSERT INTO `oxobject2group` VALUES ('da880e18ef8885a7238042363c4817a0', 1, 'oxdefaultadmin', 'oxidsmallcust');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxobject2ipayment`
-- 

DROP TABLE IF EXISTS `oxobject2ipayment`;
CREATE TABLE IF NOT EXISTS `oxobject2ipayment` (
  `OXID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXPAYMENTID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXTYPE` varchar(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`OXID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxobject2ipayment`
-- 

INSERT INTO `oxobject2ipayment` VALUES ('c8943789bdb2e1ba1.96380151', 'oxiddebitnote', '1', 'elv');
INSERT INTO `oxobject2ipayment` VALUES ('c894378a7416eec74.89531379', 'oxidcreditcard', '1', 'cc');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxobject2list`
-- 

DROP TABLE IF EXISTS `oxobject2list`;
CREATE TABLE IF NOT EXISTS `oxobject2list` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXLISTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXDESC` text collate latin1_general_ci NOT NULL,
  `OXTIMESTAMP` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`OXID`),
  KEY `OXOBJECTID` (`OXOBJECTID`),
  KEY `OXLISTID` (`OXLISTID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxobject2list`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxobject2payment`
-- 

DROP TABLE IF EXISTS `oxobject2payment`;
CREATE TABLE IF NOT EXISTS `oxobject2payment` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXPAYMENTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXTYPE` char(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`OXID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxobject2payment`
-- 

INSERT INTO `oxobject2payment` VALUES ('92d4214bf673df592.85542338', 'oxidpayadvance', 'a434214960877b879.20979568', 'oxdelset');
INSERT INTO `oxobject2payment` VALUES ('1b842e7375676dd84.15824521', 'oxidinvoice', 'oxidstandard', 'oxdelset');
INSERT INTO `oxobject2payment` VALUES ('1b842e737567681b7.32408586', 'oxidpayadvance', 'oxidstandard', 'oxdelset');
INSERT INTO `oxobject2payment` VALUES ('1b842e73756761653.33874589', 'oxiddebitnote', 'oxidstandard', 'oxdelset');
INSERT INTO `oxobject2payment` VALUES ('1b842e7375675b807.24061946', 'oxidcreditcard', 'oxidstandard', 'oxdelset');
INSERT INTO `oxobject2payment` VALUES ('f324215af5c89b870.26091752', 'oxidcreditcard', 'f324215af31591936.94392085', 'oxdelset');
INSERT INTO `oxobject2payment` VALUES ('f324215af5c8be899.90598822', 'oxiddebitnote', 'f324215af31591936.94392085', 'oxdelset');
INSERT INTO `oxobject2payment` VALUES ('1b842e737567541b1.16932982', 'oxidcashondel', 'oxidstandard', 'oxdelset');
INSERT INTO `oxobject2payment` VALUES ('0f941664de07fe713.78180932', 'oxiddebitnote', 'a7c40f631fc920687.20179984', 'oxcountry');
INSERT INTO `oxobject2payment` VALUES ('0f941664de081d815.03693723', 'oxiddebitnote', 'a7c40f6320aeb2ec2.72885259', 'oxcountry');
INSERT INTO `oxobject2payment` VALUES ('0f941664de082a1b0.85265324', 'oxiddebitnote', 'a7c40f6321c6f6109.43859248', 'oxcountry');
INSERT INTO `oxobject2payment` VALUES ('0f941664e70744a73.85113769', 'oxidcreditcard', 'a7c40f631fc920687.20179984', 'oxcountry');
INSERT INTO `oxobject2payment` VALUES ('0f941664e70758467.23169947', 'oxidcreditcard', 'a7c40f6320aeb2ec2.72885259', 'oxcountry');
INSERT INTO `oxobject2payment` VALUES ('0f941664e707657e4.30674465', 'oxidcreditcard', 'a7c40f6321c6f6109.43859248', 'oxcountry');
INSERT INTO `oxobject2payment` VALUES ('0f941664e9e60f698.58333517', 'oxidcashondel', 'a7c40f631fc920687.20179984', 'oxcountry');
INSERT INTO `oxobject2payment` VALUES ('0f941664ee2448a22.44967166', 'oxidinvoice', 'a7c40f631fc920687.20179984', 'oxcountry');
INSERT INTO `oxobject2payment` VALUES ('0f941664ee245e458.07911799', 'oxidinvoice', 'a7c40f6320aeb2ec2.72885259', 'oxcountry');
INSERT INTO `oxobject2payment` VALUES ('0f941664ee246ac84.39868591', 'oxidinvoice', 'a7c40f6321c6f6109.43859248', 'oxcountry');
INSERT INTO `oxobject2payment` VALUES ('0f941664efa30a021.06837665', 'oxidpayadvance', 'a7c40f631fc920687.20179984', 'oxcountry');
INSERT INTO `oxobject2payment` VALUES ('0f941664efa320ca8.35650805', 'oxidpayadvance', 'a7c40f6320aeb2ec2.72885259', 'oxcountry');
INSERT INTO `oxobject2payment` VALUES ('0f941664efa32d4e5.28625433', 'oxidpayadvance', 'a7c40f6321c6f6109.43859248', 'oxcountry');
INSERT INTO `oxobject2payment` VALUES ('1b842e738b3f1ca46.72529947', 'oxidcreditcard', '1b842e732a23255b1.91207750', 'oxdelset');
INSERT INTO `oxobject2payment` VALUES ('1b842e738b3f1ca46.72529948', 'oxidcreditcard', '1b842e732a23255b1.91207751', 'oxdelset');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxobject2role`
-- 

DROP TABLE IF EXISTS `oxobject2role`;
CREATE TABLE IF NOT EXISTS `oxobject2role` (
  `OXID` char(32) collate latin1_general_ci NOT NULL,
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL,
  `OXROLEID` char(32) collate latin1_general_ci NOT NULL,
  `OXTYPE` char(32) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`OXID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxobject2role`
-- 

INSERT INTO `oxobject2role` VALUES ('36944b76eb318b6a1.14803373', '36944b76d6e583fe2.12734046', '78e44b758c022a272.51251423', 'oxuser');
INSERT INTO `oxobject2role` VALUES ('36944b76ec206d882.56219205', '36944b76dae9ef333.88219217', '78e44b7594125ee20.14450974', 'oxuser');
INSERT INTO `oxobject2role` VALUES ('36944b76ed32d3915.91240134', '36944b76cc9604c53.04579642', '38c44b637c40361a5.19114394', 'oxuser');
INSERT INTO `oxobject2role` VALUES ('36944b76ee0a4db62.85778657', '36944b76e717de855.40215733', '38c44b643ca8c1434.78110631', 'oxuser');
INSERT INTO `oxobject2role` VALUES ('36944b76eeb573b40.79530944', '36944b76d203d4a35.41417835', '38c44b64462a30409.68943490', 'oxuser');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxobject2selectlist`
-- 

DROP TABLE IF EXISTS `oxobject2selectlist`;
CREATE TABLE IF NOT EXISTS `oxobject2selectlist` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSELNID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSORT` int(5) NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `OXOBJECTID` (`OXOBJECTID`),
  KEY `OXSELNID` (`OXSELNID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxobject2selectlist`
-- 

INSERT INTO `oxobject2selectlist` VALUES ('d941da282abe0601e70c90f5814a9d35', '1354', 'd94686238045ec4d510a0c9f82994db2', 0);
INSERT INTO `oxobject2selectlist` VALUES ('d942b8733f0a97874d3ba41f597fcf2d', '1771', 'd94686238045ec4d510a0c9f82994db2', 0);
INSERT INTO `oxobject2selectlist` VALUES ('d9484aca78b22e1a8898f534e27c1fd2', '1951', 'd94686238045ec4d510a0c9f82994db2', 0);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxobjectrights`
-- 

DROP TABLE IF EXISTS `oxobjectrights`;
CREATE TABLE IF NOT EXISTS `oxobjectrights` (
  `OXID` char(32) collate latin1_general_ci NOT NULL,
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL,
  `OXGROUPIDX` bigint(20) unsigned NOT NULL,
  `OXOFFSET` int(10) unsigned NOT NULL,
  `OXACTION` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`OXOBJECTID`,`OXOFFSET`,`OXACTION`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxobjectrights`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxorder`
-- 

DROP TABLE IF EXISTS `oxorder`;
CREATE TABLE IF NOT EXISTS `oxorder` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXUSERID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXORDERDATE` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXORDERNR` int(11) NOT NULL default '0',
  `OXBILLCOMPANY` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXBILLEMAIL` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXBILLFNAME` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXBILLLNAME` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXBILLSTREET` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXBILLSTREETNR` varchar(16) collate latin1_general_ci NOT NULL default '',
  `OXBILLADDINFO` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXBILLUSTID` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXBILLUSTIDSTATUS` tinyint(1) NOT NULL default '0',
  `OXBILLCITY` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXBILLCOUNTRYID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXBILLZIP` varchar(16) collate latin1_general_ci NOT NULL default '',
  `OXBILLFON` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXBILLFAX` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXBILLSAL` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXDELCOMPANY` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXDELFNAME` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXDELLNAME` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXDELSTREET` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXDELSTREETNR` varchar(16) collate latin1_general_ci NOT NULL default '',
  `OXDELADDINFO` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXDELCITY` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXDELCOUNTRYID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXDELZIP` varchar(16) collate latin1_general_ci NOT NULL default '',
  `OXDELFON` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXDELFAX` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXDELSAL` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPAYMENTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXPAYMENTTYPE` char(32) collate latin1_general_ci NOT NULL default '',
  `OXTOTALNETSUM` double NOT NULL default '0',
  `OXTOTALBRUTSUM` double NOT NULL default '0',
  `OXTOTALORDERSUM` double NOT NULL default '0',
  `OXDELCOST` double NOT NULL default '0',
  `OXDELVAT` double NOT NULL default '0',
  `OXPAYCOST` double NOT NULL default '0',
  `OXPAYVAT` double NOT NULL default '0',
  `OXWRAPCOST` double NOT NULL default '0',
  `OXWRAPVAT` double NOT NULL default '0',
  `OXCARDID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXCARDTEXT` text collate latin1_general_ci NOT NULL,
  `OXDISCOUNT` double NOT NULL default '0',
  `OXEXPORT` tinyint(4) NOT NULL default '0',
  `OXBILLNR` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXTRACKCODE` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXSENDDATE` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXREMARK` text collate latin1_general_ci NOT NULL,
  `OXVOUCHERDISCOUNT` double NOT NULL default '0',
  `OXCURRENCY` char(32) collate latin1_general_ci NOT NULL default '',
  `OXCURRATE` double NOT NULL default '0',
  `OXFOLDER` char(32) collate latin1_general_ci NOT NULL default '',
  `OXPIDENT` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXTRANSID` varchar(64) collate latin1_general_ci NOT NULL default '',
  `OXPAYID` varchar(64) collate latin1_general_ci NOT NULL default '',
  `OXXID` varchar(64) collate latin1_general_ci NOT NULL default '',
  `OXPAID` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXSTORNO` tinyint(1) NOT NULL default '0',
  `OXIP` varchar(16) collate latin1_general_ci NOT NULL default '',
  `OXTRANSSTATUS` varchar(30) collate latin1_general_ci NOT NULL default '',
  `OXLANG` int(2) NOT NULL default '0',
  `OXINVOICENR` int(11) NOT NULL default '0',
  `OXDELTYPE` char(32) collate latin1_general_ci NOT NULL default '',
  `OXPIXIEXPORT` tinyint(1) NOT NULL default '0',
  `MYPREFIX_NEWCOL` varchar(20) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`OXID`),
  KEY `OXUSERID` (`OXUSERID`),
  KEY `MAINIDX` (`OXSHOPID`,`OXORDERDATE`),
  KEY `OXORDERNR` (`OXORDERNR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxorder`
-- 

INSERT INTO `oxorder` VALUES ('8fa56bc3bc1932f3ee4a7288f4d7871d', 1, 'oxdefaultadmin', '2008-12-05 18:21:52', 2, 'Ihr Firmenname', 'admin', 'Hans', 'Mustermann', 'Musterstr.', '10', '', '', 1, 'Musterstadt', 'a7c40f631fc920687.20179984', '79098', '0800 1234567', '0800 1234567', 'Herr', '', '', '', '', '', '', '', '', '', '', '', '', '', 'oxidcreditcard', 23.4, 27.85, 52.65, 3.9, 19, 20.9, 19, 0, 0, '', '', 0, 0, '', '', '0000-00-00 00:00:00', '', 0, 'EUR', 1, 'Neu', '', '', '', '', '2008-12-05 18:21:23', 0, '', 'OK', 0, 0, '1b842e732a23255b1.91207750', 0, '');
INSERT INTO `oxorder` VALUES ('da88a5d41998ee6e47351448fe5d02ad', 1, 'oxdefaultadmin', '2008-12-05 18:13:49', 1, 'Ihr Firmenname', 'admin', 'Hans', 'Mustermann', 'Musterstr.', '10', '', '', 1, 'Musterstadt', 'a7c40f631fc920687.20179984', '79098', '0800 1234567', '0800 1234567', 'Herr', '', '', '', '', '', '', '', '', '', '', '', '', '0a55f66c57b25febb5acdda76dd4a4fb', 'oxempty', 14.29, 17, 20.9, 3.9, 19, 0, 0, 0, 0, '', '', 0, 0, '', '', '0000-00-00 00:00:00', '', 0, 'EUR', 1, 'Neu', '', '', '', '', '0000-00-00 00:00:00', 0, '', 'OK', 0, 0, '1b842e732a23255b1.91207750', 0, '');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxorderarticles`
-- 

DROP TABLE IF EXISTS `oxorderarticles`;
CREATE TABLE IF NOT EXISTS `oxorderarticles` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXORDERID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXAMOUNT` double NOT NULL default '0',
  `OXARTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXARTNUM` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLE` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSHORTDESC` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSELVARIANT` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXNETPRICE` double NOT NULL default '0',
  `OXBRUTPRICE` double NOT NULL default '0',
  `OXVATPRICE` double NOT NULL default '0',
  `OXVAT` double NOT NULL default '0',
  `OXPERSPARAM` text collate latin1_general_ci NOT NULL,
  `OXPRICE` double NOT NULL default '0',
  `OXBPRICE` double NOT NULL default '0',
  `OXNPRICE` double NOT NULL default '0',
  `OXWRAPID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXEXTURL` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXURLDESC` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXURLIMG` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXTHUMB` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC1` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC2` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC3` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC4` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC5` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXWEIGHT` double NOT NULL default '0',
  `OXSTOCK` double NOT NULL default '-1',
  `OXDELIVERY` date NOT NULL default '0000-00-00',
  `OXINSERT` date NOT NULL default '0000-00-00',
  `OXTIMESTAMP` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `OXLENGTH` double NOT NULL default '0',
  `OXWIDTH` double NOT NULL default '0',
  `OXHEIGHT` double NOT NULL default '0',
  `OXFILE` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXSEARCHKEYS` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTEMPLATE` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXQUESTIONEMAIL` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXISSEARCH` tinyint(1) NOT NULL default '1',
  `OXFOLDER` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSUBCLASS` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSTORNO` tinyint(1) NOT NULL default '0',
  `OXORDERSHOPID` int(11) NOT NULL default '1',
  `OXERPSTATUS` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`OXID`),
  KEY `OXORDERID` (`OXORDERID`),
  KEY `OXARTID` (`OXARTID`),
  KEY `OXARTNUM` (`OXARTNUM`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxorderarticles`
-- 

INSERT INTO `oxorderarticles` VALUES ('0a565e356c26d184c372b3f2faf7f49c', '8fa56bc3bc1932f3ee4a7288f4d7871d', 1, '2275-01', '2275-01', 'BBQ Grill TONNE pink', '', 'pink', 23.4033613445, 27.85, 4.44663865546, 19, '', 27.85, 27.85, 23.4033613445, '', '', '', '', '2275-01_th.jpg', '2275-01_p1.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 'nopic.jpg', 0, 100, '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 0, '', 'oxarticle', 0, 1, '');
INSERT INTO `oxorderarticles` VALUES ('0a5d44fd6605e6ad41b2564918d9f0eb', 'da88a5d41998ee6e47351448fe5d02ad', 1, '2080', '2080', 'Barzange PROFI', 'Multifunktionales Bar-Werkzeug', '', 14.2857142857, 17, 2.71428571429, 19, '', 17, 17, 14.2857142857, '', '', '', '', '2080_th.jpg', '2080_p1.jpg', '2080_p2.jpg', '2080_p3.jpg', '2080_p4.jpg', '2080_p5.jpg', 0, 12, '0000-00-00', '2006-07-05', '2008-09-02 12:52:41', 0, 0, 0, '', '', '', '', 1, '', 'oxarticle', 0, 1, '');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxpaylogs`
-- 

DROP TABLE IF EXISTS `oxpaylogs`;
CREATE TABLE IF NOT EXISTS `oxpaylogs` (
  `OXID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXSESSID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXTIME` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `OXORDERID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXTRANSID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXPAYID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXUID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXAMOUNT` double NOT NULL default '0',
  `OXCURR` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXGWTYPE` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXERRCODE` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXERRTEXT` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`OXID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxpaylogs`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxpayments`
-- 

DROP TABLE IF EXISTS `oxpayments`;
CREATE TABLE IF NOT EXISTS `oxpayments` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXACTIVE` tinyint(1) NOT NULL default '1',
  `OXDESC` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXADDSUM` double NOT NULL default '0',
  `OXADDSUMTYPE` enum('abs','%') collate latin1_general_ci NOT NULL default 'abs',
  `OXFROMBONI` int(11) NOT NULL default '0',
  `OXFROMAMOUNT` double NOT NULL default '0',
  `OXTOAMOUNT` double NOT NULL default '0',
  `OXVALDESC` text collate latin1_general_ci NOT NULL,
  `OXCHECKED` tinyint(1) NOT NULL default '0',
  `OXDESC_1` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXVALDESC_1` text collate latin1_general_ci NOT NULL,
  `OXDESC_2` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXVALDESC_2` text collate latin1_general_ci NOT NULL,
  `OXDESC_3` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXVALDESC_3` text collate latin1_general_ci NOT NULL,
  `OXLONGDESC` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXLONGDESC_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXLONGDESC_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXLONGDESC_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSORT` int(5) NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `OXACTIVE` (`OXACTIVE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxpayments`
-- 

INSERT INTO `oxpayments` VALUES ('oxidcashondel', 1, 'Nachnahme', 7.5, 'abs', 0, 0, 1000000, '', 1, 'COD cash on delivery', '', '', '', '', '', '', '', '', '', 0);
INSERT INTO `oxpayments` VALUES ('oxidcreditcard', 1, 'Kreditkarte', 20.9, 'abs', 500, 0, 1000000, 'kktype__@@kknumber__@@kkmonth__@@kkyear__@@kkname__@@kkpruef__@@', 1, 'Credit Card', 'kktype__@@kknumber__@@kkmonth__@@kkyear__@@kkname__@@kkpruef__@@', '', '', '', '', 'Die Belastung Ihres Kreditkarte erfolgt mit dem Abschluss der Bestellung.', 'Your Credit Card is charged when you submit the order.', '', '', 0);
INSERT INTO `oxpayments` VALUES ('oxiddebitnote', 1, 'Bankeinzug/Lastschrift', 0, 'abs', 0, 0, 1000000, 'lsbankname__@@lsblz__@@lsktonr__@@lsktoinhaber__@@', 0, 'Wire Transfer', 'lsbankname__@@lsblz__@@lsktonr__@@lsktoinhaber__@@', '', '', '', '', 'Die Belastung Ihres Kontos erfolgt mit dem Versand der Ware.', 'Your account is charged when the order is shipped.', '', '', 0);
INSERT INTO `oxpayments` VALUES ('oxidpayadvance', 1, 'Vorauskasse 2% Skonto', -2, '%', 0, 0, 1000000, '', 1, 'Payment in advance 2% Skonto', '', '', '', '', '', '', '', '', '', 0);
INSERT INTO `oxpayments` VALUES ('oxidinvoice', 1, 'Rechnung', 0, 'abs', 800, 0, 1000000, '', 0, 'Invoice', '', '', '', '', '', '', '', '', '', 0);
INSERT INTO `oxpayments` VALUES ('oxempty', 1, 'Empty', 0, 'abs', 0, 0, 0, '', 0, 'Empty', '', '', '', '', '', 'for other countries', 'for other countries', '', '', 0);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxprice2article`
-- 

DROP TABLE IF EXISTS `oxprice2article`;
CREATE TABLE IF NOT EXISTS `oxprice2article` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXARTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXADDABS` double NOT NULL default '0',
  `OXADDPERC` double NOT NULL default '0',
  `OXAMOUNT` double NOT NULL default '0',
  `OXAMOUNTTO` double NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `OXSHOPID` (`OXSHOPID`),
  KEY `OXARTID` (`OXARTID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxprice2article`
-- 

INSERT INTO `oxprice2article` VALUES ('68342e29772235496.46936441', 1, '1651', 27.5, 0, 6, 15);
INSERT INTO `oxprice2article` VALUES ('68342e29783d33c72.52399677', 1, '1651', 25, 0, 16, 50);
INSERT INTO `oxprice2article` VALUES ('1b842e75abb2e7bb1.31308046', 1, '1651', 23, 0, 51, 999);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxpricealarm`
-- 

DROP TABLE IF EXISTS `oxpricealarm`;
CREATE TABLE IF NOT EXISTS `oxpricealarm` (
  `OXID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXUSERID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXEMAIL` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXARTID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXPRICE` double NOT NULL default '0',
  `OXCURRENCY` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXINSERT` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXSENDED` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`OXID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxpricealarm`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxratings`
-- 

DROP TABLE IF EXISTS `oxratings`;
CREATE TABLE IF NOT EXISTS `oxratings` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXUSERID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXTYPE` enum('oxarticle','oxrecommlist') collate latin1_general_ci NOT NULL,
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXRATING` int(1) NOT NULL default '0',
  `OXTIMESTAMP` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`OXID`),
  KEY `oxobjectsearch` (`OXTYPE`,`OXOBJECTID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxratings`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxrecommlists`
-- 

DROP TABLE IF EXISTS `oxrecommlists`;
CREATE TABLE IF NOT EXISTS `oxrecommlists` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXUSERID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXAUTHOR` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLE` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXDESC` text collate latin1_general_ci NOT NULL,
  `OXRATINGCNT` int(11) NOT NULL default '0',
  `OXRATING` double NOT NULL default '0',
  PRIMARY KEY  (`OXID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxrecommlists`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxremark`
-- 

DROP TABLE IF EXISTS `oxremark`;
CREATE TABLE IF NOT EXISTS `oxremark` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXPARENTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXTYPE` enum('o','r','n','c') collate latin1_general_ci NOT NULL default 'r',
  `OXHEADER` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTEXT` text collate latin1_general_ci NOT NULL,
  `OXCREATE` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`OXID`),
  KEY `OXPARENTID` (`OXPARENTID`),
  KEY `OXTYPE` (`OXTYPE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxremark`
-- 

INSERT INTO `oxremark` VALUES ('36944b76cc962c229.86477647', '36944b76cc9604c53.04579642', 'c', '2006-07-14 12:07:05', 'Der Benutzer wird nach der Eingabe seines Passwortes registriert', '2006-07-14 12:07:05');
INSERT INTO `oxremark` VALUES ('36944b76d2040de09.45408183', '36944b76d203d4a35.41417835', 'c', '2006-07-14 12:08:32', 'Der Benutzer wird nach der Eingabe seines Passwortes registriert', '2006-07-14 12:08:32');
INSERT INTO `oxremark` VALUES ('36944b76d6e5acaf2.97279092', '36944b76d6e583fe2.12734046', 'c', '2006-07-14 12:09:50', 'Der Benutzer wird nach der Eingabe seines Passwortes registriert', '2006-07-14 12:09:50');
INSERT INTO `oxremark` VALUES ('36944b76daea181f6.05579439', '36944b76dae9ef333.88219217', 'c', '2006-07-14 12:10:54', 'Der Benutzer wird nach der Eingabe seines Passwortes registriert', '2006-07-14 12:10:54');
INSERT INTO `oxremark` VALUES ('36944b76e7180be40.23772898', '36944b76e717de855.40215733', 'c', '2006-07-14 12:14:09', 'Der Benutzer wird nach der Eingabe seines Passwortes registriert', '2006-07-14 12:14:09');
INSERT INTO `oxremark` VALUES ('92044c0db92949335.28953950', '92044c0db9220e842.85595739', 'c', '2006-07-21 15:50:10', 'usrRegistered', '2006-07-21 15:50:10');
INSERT INTO `oxremark` VALUES ('da8ddbd725ebc94606ebf73a04bef278', 'oxdefaultadmin', 'o', '2008-11-25 16:40:20', 'Folgende Artikel wurden soeben unter OXID eShop EE 4 bestellt :\n\nBestellnr. 1\n\n\nBarzange PROFIGeschenkverp.: KEINEAnzahl 1\nEinzelpreis 17,00 EUR\nGesamt 17,00 EUR\n------------------------------------------------------------------\nSumme Produkte (netto): 14,29 EUR\nzzgl. MwSt. 19% Betrag: 2,71 EUR\nSumme Produkte (brutto): 17,00 EUR\nVersandkosten (netto): 3,28 EUR\nzzgl. MwSt. 19% Betrag:  0,62 EUR\nVersandkosten (brutto) : 3,90 EUR\n\n\nGesamtsumme: 20,90 EUR\n\nMitteilung: Hier können Sie uns noch etwas mitteilen.\n\nBezahlinformation:\nDie Bezahlung erfolgt mit:Rechnung\n<b>BEZAHLINFORMATIONEN AUSGESCHALTET</b> - um diese einzuschalten bitte email_order_owner_html.tpl\naendern.\n : \nE-Mail Adresse : admin\n\nRechnungsanschrift:\nIhr Firmenname\nHerr Hans Mustermann\nMusterstr. 10\n79098 Musterstadt\n\nTelefon: 0800 1234567\n\n\nDer Versand erfolgt mit Standard\n\n-- Bitte fügen Sie hier Ihre vollständige Anbieterkennzeichnung ein.\n', '2008-11-25 16:40:20');
INSERT INTO `oxremark` VALUES ('8faa57cb81f4b6a0ed2beeb29cbadda4', 'oxdefaultadmin', 'o', '2008-12-05 18:16:37', 'Folgende Artikel wurden soeben unter OXID eShop EE 4 bestellt :\n\nBestellnr. 2\n\n\nBBQ Grill TONNE, pinkGeschenkverp.: KEINEAnzahl 1\nEinzelpreis 27,85 EUR\nGesamt 27,85 EUR\n------------------------------------------------------------------\nSumme Produkte (netto): 23,40 EUR\nzzgl. MwSt. 19% Betrag: 4,45 EUR\nSumme Produkte (brutto): 27,85 EUR\nVersandkosten (netto): 3,28 EUR\nzzgl. MwSt. 19% Betrag:  0,62 EUR\nVersandkosten (brutto) : 3,90 EUR\nAbschlag Zahlungsart: -0,56 EUR\n  \n\nGesamtsumme: 31,19 EUR\n\nMitteilung: Hier können Sie uns noch etwas mitteilen.\n\nBezahlinformation:\nDie Bezahlung erfolgt mit:Vorauskasse 2% Skonto\n<b>BEZAHLINFORMATIONEN AUSGESCHALTET</b> - um diese einzuschalten bitte email_order_owner_html.tpl\naendern.\n : \nE-Mail Adresse : admin\n\nRechnungsanschrift:\nIhr Firmenname\nHerr Hans Mustermann\nMusterstr. 10\n79098 Musterstadt\n\nTelefon: 0800 1234567\n\n\nDer Versand erfolgt mit Standard\n\n-- Bitte fügen Sie hier Ihre vollständige Anbieterkennzeichnung ein.\n', '2008-12-05 18:16:37');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxreviews`
-- 

DROP TABLE IF EXISTS `oxreviews`;
CREATE TABLE IF NOT EXISTS `oxreviews` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXACTIVE` tinyint(1) NOT NULL default '0',
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL,
  `OXTYPE` enum('oxarticle','oxrecommlist') collate latin1_general_ci NOT NULL,
  `OXTEXT` text collate latin1_general_ci NOT NULL,
  `OXUSERID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXCREATE` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXLANG` tinyint(3) NOT NULL default '0',
  `OXRATING` int(1) NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `oxobjectsearch` (`OXTYPE`,`OXOBJECTID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxreviews`
-- 

INSERT INTO `oxreviews` VALUES ('59144bf9e8fde1c26.77830717', 0, '1351', 'oxarticle', 'Endlich mal was anderes. Bis jetzt hab ich immer versucht mit Cocktailkirschen die Drinks schicker aussehen zu lassen. Doch die Idee ist auch nicht so neu. Die Nordic Rocks hingegen sind ein echter Hingucker. … und keine Panik, das Getränk „versandet“  auch nicht. Auf dass die nächste „coole“ Party kommt.', '36944b76d6e583fe2.12734046', '2006-07-20 17:17:35', 0, 0);
INSERT INTO `oxreviews` VALUES ('4fd44bf5966c23f43.16449256', 0, '', 'oxarticle', 'Endlich mal was anderes. Bis jetzt hab ich immer versucht mit Cocktailkirschen die Drinks schicker aussehen zu lassen. Doch die Idee ist auch nicht so neu. Die Nordic Rocks hingegen sind ein echter Hingucker. … und keine Panik, das Getränk „versandet“  auch nicht. Auf das die nächste „coole“ Party kommt. ', '36944b76d6e583fe2.12734046', '2006-07-20 12:22:30', 0, 0);
INSERT INTO `oxreviews` VALUES ('92044c0dc2dae7f13.60198888', 0, '2041', 'oxarticle', 'Die Pantoffel sind richtig klasse! So weich und praktisch...', '92044c0db9220e842.85595739', '2006-07-21 15:52:45', 0, 0);
INSERT INTO `oxreviews` VALUES ('92044c0dc7498d770.51209637', 0, 'a7c44be4a5ddee114.67356237', 'oxarticle', 'Ein richtiger Knaller!!! Und für eine tolle Party ein MUSS!!!', '92044c0db9220e842.85595739', '2006-07-21 15:53:56', 0, 0);
INSERT INTO `oxreviews` VALUES ('59144bf9d8199c636.44695617', 0, '1651', 'oxarticle', 'Ich war positiv überrascht, wie einfach es war mein erstes eigenes Bier zu brauen. Ohne Vorkenntnisse war es kein Problem der guten Anleitung zufolgen und jeden Schritt wie beschrieben auszuführen. Freunde die zur ultimativen Bier Verköstigung eingeladen waren taten sich schwer mein Bier von den üblichen Kaufbieren zu unterscheiden. Fazit: Ich werde in Zukunft noch das ein oder andere Bier brauen und vielleicht mit unterschiedlicher Rezeptur noch bessere Ergebnisse erzielen.', 'oxdefaultadmin', '2006-07-20 17:13:05', 0, 0);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxrolefields`
-- 

DROP TABLE IF EXISTS `oxrolefields`;
CREATE TABLE IF NOT EXISTS `oxrolefields` (
  `OXID` char(32) collate latin1_general_ci NOT NULL,
  `OXNAME` char(255) collate latin1_general_ci NOT NULL,
  `OXPARAM` varchar(255) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`OXID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxrolefields`
-- 

INSERT INTO `oxrolefields` VALUES ('42b44bc9934bdb406.85935627', 'TOBASKET', 'tobasket;basket');
INSERT INTO `oxrolefields` VALUES ('42b44bc9941a46fd3.13180499', 'SHOWLONGDESCRIPTION', '');
INSERT INTO `oxrolefields` VALUES ('42b44bc99488c66b1.94059993', 'SHOWARTICLEPRICE', '');
INSERT INTO `oxrolefields` VALUES ('42b44bc9950334951.12393781', 'SHOWSHORTDESCRIPTION', '');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxroles`
-- 

DROP TABLE IF EXISTS `oxroles`;
CREATE TABLE IF NOT EXISTS `oxroles` (
  `OXID` char(32) collate latin1_general_ci NOT NULL,
  `OXTITLE` char(255) collate latin1_general_ci NOT NULL,
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXACTIVE` int(1) NOT NULL default '0',
  `OXAREA` int(1) NOT NULL,
  PRIMARY KEY  (`OXID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxroles`
-- 

INSERT INTO `oxroles` VALUES ('38c44b637c40361a5.19114394', 'Management', 1, 1, 0);
INSERT INTO `oxroles` VALUES ('38c44b643ca8c1434.78110631', 'Produktmangement', 1, 1, 0);
INSERT INTO `oxroles` VALUES ('38c44b64462a30409.68943490', 'Redaktion', 1, 1, 0);
INSERT INTO `oxroles` VALUES ('78e44b758c022a272.51251423', 'Bildredaktion', 1, 1, 0);
INSERT INTO `oxroles` VALUES ('78e44b7594125ee20.14450974', 'Buchhaltung', 1, 1, 0);
INSERT INTO `oxroles` VALUES ('78e44b759b7090603.28752953', 'Praktikant', 1, 1, 0);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxselectlist`
-- 

DROP TABLE IF EXISTS `oxselectlist`;
CREATE TABLE IF NOT EXISTS `oxselectlist` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXSHOPINCL` bigint(20) unsigned NOT NULL default '0',
  `OXSHOPEXCL` bigint(20) unsigned NOT NULL default '0',
  `OXTITLE` varchar(254) collate latin1_general_ci NOT NULL default '',
  `OXIDENT` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXVALDESC` text collate latin1_general_ci NOT NULL,
  `OXTITLE_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXVALDESC_1` text collate latin1_general_ci NOT NULL,
  `OXTITLE_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXVALDESC_2` text collate latin1_general_ci NOT NULL,
  `OXTITLE_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXVALDESC_3` text collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`OXID`),
  KEY `OXSHOPID` (`OXSHOPID`),
  KEY `mainidx` (`OXSHOPINCL`,`OXSHOPEXCL`,`OXTITLE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxselectlist`
-- 

INSERT INTO `oxselectlist` VALUES ('d94686238045ec4d510a0c9f82994db2', 1, 1, 0, 'labas', '', 'hu!P!15__@@huhu!P!16__@@trys!P!17__@@', '', '', '', '', '', '');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxseo`
-- 

DROP TABLE IF EXISTS `oxseo`;
CREATE TABLE IF NOT EXISTS `oxseo` (
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXIDENT` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXLANG` int(2) NOT NULL default '0',
  `OXSTDURL` text collate latin1_general_ci NOT NULL,
  `OXSEOURL` text collate latin1_general_ci NOT NULL,
  `OXTYPE` enum('static','oxarticle','oxcategory','oxvendor','oxcontent','dynamic') collate latin1_general_ci NOT NULL,
  `OXFIXED` tinyint(1) NOT NULL default '0',
  `OXKEYWORDS` text collate latin1_general_ci NOT NULL,
  `OXDESCRIPTION` text collate latin1_general_ci NOT NULL,
  `OXEXPIRED` tinyint(1) NOT NULL default '0',
  `OXPARAMS` char(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`OXIDENT`,`OXSHOPID`,`OXLANG`),
  UNIQUE KEY `search` (`OXTYPE`,`OXOBJECTID`,`OXSHOPID`,`OXLANG`,`OXPARAMS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxseo`
-- 

INSERT INTO `oxseo` VALUES ('c8edd7319fdc59a0f28db056f72b4d17', '023abc17c853f9bccc201c5afd549a92', 1, 1, 'index.php?cl=account_wishlist', 'my-gift-registry/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('c4f6f0cf46e0c61c19a34ab58b6d62fc', '0361774676321abf3204a44e167ffe40', 1, 1, 'index.php?cl=help&amp;page=info&amp;tpl=security_info.tpl', 'help/data-protection/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('ada21f25e0cbf52157ea31d5bd5e4699', '0469752d03d80da379a679aaef4c0546', 1, 1, 'index.php?cl=suggest', 'recommend/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('f52b25bb4e58480a2df8c06b65b4901c', '063c82502d9dd528ce2cc40ceb76ade7', 1, 1, 'index.php?cl=compare', 'my-product-comparison/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('cf0882010906253a9bd504ad9ad0434b', '0aaaa47d75da6581736b76eb4b4e62a3', 1, 0, 'index.php?cl=help&amp;page=review', 'hilfe/bewertungen/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('970e8f4f3b2f21a586a18d97320f5bbb', '0f454924e8a9e54d99df911b3c8202ce', 1, 1, 'index.php?cl=help&amp;page=account_order', 'help/order-history/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('970e8f4f3b2f21a586a18d97320f5bbb', '116b37d6d0aa3bc10d40c0972e46dc17', 1, 0, 'index.php?cl=help&amp;page=account_order', 'hilfe/bestellhistorie/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('8854fb64f8934f8d399eac52cca4136f', '1368f5e45468ca1e1c7c84f174785c35', 1, 1, 'index.php?cl=account_noticelist', 'my-wish-list/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('d6251e3ae8c4ad5a5f4c0af5fdb8c17a', '13fa69b27f1eb104d5664b68af4b2b13', 1, 1, 'index.php?cl=help&amp;page=info&amp;tpl=impressum.tpl', 'help/about-us/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('e3662674e2703722bd87a2fe87f86174', '1701ec08c0928b603e5290078f8ab724', 1, 1, 'index.php?cl=help&amp;page=details', 'help/product-details/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('6d60cc19a6f9ae587ff40bde86f27e75', '192ce04536d8c1ea3d530825bc06bff9', 1, 0, 'index.php?cl=help&amp;page=account_wishlist', 'hilfe/mein-wunschzettel/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('c8edd7319fdc59a0f28db056f72b4d17', '1f30ae9b1c78b7dc89d3e5fe9eb0de59', 1, 0, 'index.php?cl=account_wishlist', 'mein-wunschzettel/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('974896b8722121f5a339585ddeeb74b7', '281a927fd36ff57e9d5cd21a6ad83145', 1, 0, 'index.php?cl=help&amp;page=help', 'hilfe/hilfe/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('e90457afd08297f1f2c66d6023b0c089', '310a5b38352aecfde5a28d30ecaf2cb2', 1, 0, 'index.php?cl=help&amp;page=compare', 'hilfe/mein-produktvergleich/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('e80ec1388c204f1f4133a9c6f811263a', '34191c32cedbe8832d6aebb58b4555b3', 1, 1, 'index.php?cl=info&amp;tpl=delivery_info.tpl', 'shipping-and-charges/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('f41fdc9d234527d959c9d4c412c8cca7', '347333f119c147545287d02ff8954b8e', 1, 1, 'index.php?cl=recommlist', 'Recomendation-Lists/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('7458b270d9a298fe2cd120bc50b196e0', '352dd404dd24e284e60006ce1da9a3ae', 1, 0, 'index.php?cl=help&amp;page=vendorlist', 'hilfe/nach-hersteller/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('9d66239439849792b6f598f1943b44f3', '36152357000b7b33d50feadcd8838e05', 1, 0, 'index.php?cl=info&amp;tpl=security_info.tpl', 'datenschutz/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('cf0882010906253a9bd504ad9ad0434b', '367a5b40fadd01331bb3a12e5cb0bef9', 1, 1, 'index.php?cl=help&amp;page=review', 'help/product-review/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('a9d28c6f1eae708a031d930117fc3740', '3a41965fb36fb45df7f4f9a4377f6364', 1, 1, 'index.php?cl=newsletter', 'newsletter/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('5abe5ca9e2a5166fb64f0eb76f45edac', '3bdd64bd8073d044d8fd60334ed9b725', 1, 1, 'index.php?cl=start', 'home/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('42a5bdea464de1a795904ae7af31b1ad', '3c8229b33f16cfe0fc5db6c8177c18bb', 1, 0, 'index.php?cl=help&amp;page=account_noticelist', 'hilfe/mein-merkzettel/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('6bd66fb3583cddfd812e9eda895a9de7', '3ce579b1eb8d9b7387e93de042f0630e', 1, 1, 'index.php?cl=help&amp;page=info&amp;tpl=customer_right_of_withdrawal.tpl', 'help/right-of-withdrawal/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('798dcdfffd6b65277d279255c11e4bd3', '3e2a46c6550d9f8ec5a7f3216d023db2', 1, 1, 'index.php?cl=info&amp;tpl=impressum.tpl', 'about-us/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('5abe5ca9e2a5166fb64f0eb76f45edac', '43e0a1f539e00dcfa1a6bc4d4fee4fc2', 1, 0, 'index.php?cl=start', 'home/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('6bd66fb3583cddfd812e9eda895a9de7', '44f621e49831ece86b22ea69dde82f2a', 1, 0, 'index.php?cl=help&amp;page=info&amp;tpl=customer_right_of_withdrawal.tpl', 'hilfe/widerrufsrecht/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('84584e73d1e0dbae7b9b7480fc8a5b9a', '44fec8ed8396c63e0d958ae78996d1e4', 1, 1, 'index.php?cl=help&amp;page=account', 'help/my-account/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('9c08d8934d13b2af47383f5a24fedb5c', '4a70a4cd11d63fdce96fbe4ba8e714e6', 1, 1, 'index.php?cnid=oxmore&amp;cl=alist', 'more/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('974896b8722121f5a339585ddeeb74b7', '4ac8d6f8819076dd8fac958a264e04ff', 1, 1, 'index.php?cl=help&amp;page=help', 'help/help/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('7648c15ba232b8af39605af9bb6f2bee', '4baf9bd95ca982018c1ec6527669aef7', 1, 1, 'index.php?cl=help&amp;page=basket', 'help/cart/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('72535abf87122d1756319e5a3a84aec8', '4cbe8290a912fa8241167a13b5ac0b46', 1, 0, 'index.php?cl=help&amp;page=info&amp;tpl=order_info.tpl', 'hilfe/wie-bestellen/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('9c08d8934d13b2af47383f5a24fedb5c', '4d3d4d70b09b5d2bd992991361374c67', 1, 0, 'index.php?cnid=oxmore&amp;cl=alist', 'mehr/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('21eddcf0e16b9fbdb044f4d9678b55c6', '510fef34e5d9b86f6a77af949d15950e', 1, 1, 'index.php?cl=account', 'my-account/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('3d429016f2fbe4bc162dd06a451067ab', '565b2583b94e45b25a722fb58bce5e82', 1, 0, 'index.php?cl=help&amp;page=wishlist', 'hilfe/wunschzettel/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('9d0f22a4f43ea825f9cd3ebf5a7bde23', '5668048844927ca2767140c219e04efc', 1, 1, 'index.php?cl=account_user', 'my-address/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('e7f616d4119f1b7e073d74ff40efa453', '585f263995b6a8216d1d49c10bdea22f', 1, 0, 'index.php?cl=help&amp;page=contact', 'hilfe/kontakt/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('6e068bfe34fbd8e270e4aeb998cb1832', '5a0b0a570076f900c44f160a797832ef', 1, 1, 'index.php?cl=help&amp;page=account_newsletter', 'help/newsletter-settings/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('3ebbaef4dd461b3c12020f8a076f0212', '5cc081514a72b0ce3d7eec4fb1e6f1dd', 1, 1, 'index.php?cl=forgotpwd', 'forgot-password/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('c4b506be468a1f71f2eb6e7bbceb0c57', '5d752e9e8302eeb21df24d1aee573234', 1, 0, 'index.php?cl=wishlist', 'wunschzettel/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('a071f3836b279b98bc2c9548cc44d875', '5e82443daf55ddc38b24aefe8ec0daa5', 1, 1, 'index.php?cl=help&amp;page=newsletter', 'help/newsletter/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('70cc13db1bda9cdb8403879a11032e5a', '5eb126725ba500e6bbf1aecaa876dc48', 1, 1, 'index.php?cl=review', 'product-review/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('cdf0ef22f535c79194943194d4a53342', '5f58b1965cb91c573ecd3d34c784c2e4', 1, 0, 'index.php?cl=help&amp;page=account_user', 'hilfe/rechnungs-und-liefereinstellungen/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('638dc8bac6db75758f0b5772562fe7d6', '6203915d115d00aacaa2a9ea3bc67cda', 1, 1, 'index.php?cl=help&amp;page=register', 'help/open-account/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('0d672684c2f988e3214780a568793978', '669be6da2be5edc1da4ece61b2dc72c2', 1, 0, 'index.php?cl=help&amp;page=start', 'hilfe/home/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('cdf0ef22f535c79194943194d4a53342', '670524bc5a2b2334c83839396da5b10b', 1, 1, 'index.php?cl=help&amp;page=account_user', 'help/billings-and-shipping-settings/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('42a5bdea464de1a795904ae7af31b1ad', '6a1a92c6e19cb0923edc299fd7d0c19b', 1, 1, 'index.php?cl=help&amp;page=account_noticelist', 'help/my-wish-list/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('0b1c46ce2b6d34d1a25e1719809f9f8d', '6b30b01fe01b80894efc0f29610e5215', 1, 0, 'index.php?cl=account_password', 'mein-passwort/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('e311feb6dac04c7cad25a487dd0059f5', '6c3658516be12443e6778f253d9a6945', 1, 0, 'index.php?cl=help&amp;page=alist', 'hilfe/kategorien/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('2f0efd241b52794989637f6176c05619', '6c573bd394bfe2aae1a4dd9b0b65cef9', 1, 0, 'index.php?cl=help&amp;page=info&amp;tpl=delivery_info.tpl', 'hilfe/versand-und-kosten/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('0b1c46ce2b6d34d1a25e1719809f9f8d', '6c890ac1255a99f8d1eb46f1193843d6', 1, 1, 'index.php?cl=account_password', 'my-password/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('7458b270d9a298fe2cd120bc50b196e0', '6d01ef2701d240d4b80250d176cc6ffa', 1, 1, 'index.php?cl=help&amp;page=vendorlist', 'help/by-manufacturer/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('c80cb6107b3481a49ec29e668c9a885f', '74a7a5557c373f3a9b8268714abfd89c', 1, 1, 'index.php?cl=help&amp;page=account_password', 'help/my-password/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('9d66239439849792b6f598f1943b44f3', '74e1551c34749343e6d17d302cea3f73', 1, 1, 'index.php?cl=info&amp;tpl=security_info.tpl', 'data-protection/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('e2af574a8e963c354d4555159e54a516', '7685924d3f3fb7e9bda421c57f665af4', 1, 1, 'index.php?cl=contact', 'contact/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('4e9bbc59ba801d5174e961f7a6656721', '7c8aa72aa16b7d4a859b22d8b8328412', 1, 0, 'index.php?cl=guestbook', 'gaestebuch/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('6e068bfe34fbd8e270e4aeb998cb1832', '7ea6f0334b42ae9efcf7272cc6c5d8bd', 1, 0, 'index.php?cl=help&amp;page=account_newsletter', 'hilfe/newslettereinstellungen/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('ada21f25e0cbf52157ea31d5bd5e4699', '82dd672d68d8f6c943f98ccdaecda691', 1, 0, 'index.php?cl=suggest', 'empfehlen/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('0d672684c2f988e3214780a568793978', '8480daf667f0c1fe8dd5c4dd66955e10', 1, 1, 'index.php?cl=help&amp;page=start', 'help/home/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('84584e73d1e0dbae7b9b7480fc8a5b9a', '878b29f193adb05133109d82eb4d9a88', 1, 0, 'index.php?cl=help&amp;page=account', 'hilfe/mein-konto/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('e3662674e2703722bd87a2fe87f86174', '878fb0ccc48bca3194436cc19c3200e1', 1, 0, 'index.php?cl=help&amp;page=details', 'hilfe/produktdetails/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('21eddcf0e16b9fbdb044f4d9678b55c6', '89c5e6bf1b5441599c4815281debe8df', 1, 0, 'index.php?cl=account', 'mein-konto/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('7648c15ba232b8af39605af9bb6f2bee', '8db8366788784126550dfc537f794190', 1, 0, 'index.php?cl=help&amp;page=basket', 'hilfe/warenkorb/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('67a55f21d85ee47a3431b8292758a7a1', '8e7ebaebb0a810576453082e1f8f2fa3', 1, 1, 'index.php?cl=account_recommlist', 'my-listmania-list/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('d6251e3ae8c4ad5a5f4c0af5fdb8c17a', '9382a6c9f0c47028b6037adbfcf4138d', 1, 0, 'index.php?cl=help&amp;page=info&amp;tpl=impressum.tpl', 'hilfe/impressum/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('7ec4cddc7e3fe3bcf0410569355ff84e', '9508bb0d70121d49e4d4554c5b1af81d', 1, 0, 'index.php?cl=links', 'links/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('286b3395eae67e6e58322f1731078e71', '968c80a5b47daa4a4c7e5f1ac7c1925a', 1, 0, 'index.php?cl=help&amp;page=account_recommlist', 'hilfe/meine-lieblingslisten/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('e80ec1388c204f1f4133a9c6f811263a', '9876fe6d7ae54b3eb7c6085b26ad4980', 1, 0, 'index.php?cl=info&amp;tpl=delivery_info.tpl', 'versand-und-kosten/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('e90457afd08297f1f2c66d6023b0c089', '9fc9811fd88eaf807b1036e07dbfa85c', 1, 1, 'index.php?cl=help&amp;page=compare', 'help/my-product-comparison/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('bb8c75b6c8a3932f504250014529b78b', '9ff5c21cbc84dbfe815013236e132baf', 1, 1, 'index.php?cl=account_order', 'order-history/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('638dc8bac6db75758f0b5772562fe7d6', 'a1322f6c88d2e16960433bbeb1c6c3da', 1, 0, 'index.php?cl=help&amp;page=register', 'hilfe/konto-eroeffnen/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('2b3cb8ed3e86f31772f1ac6ac83315db', 'a1b330b85c6f51fd9b50b1eb19707d84', 1, 1, 'index.php?cl=register', 'open-account/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('8854fb64f8934f8d399eac52cca4136f', 'a24b03f1a3f73c325a7647e6039e2359', 1, 0, 'index.php?cl=account_noticelist', 'mein-merkzettel/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('f41fdc9d234527d959c9d4c412c8cca7', 'a4e5995182ade3cf039800c0ec2d512d', 1, 0, 'index.php?cl=recommlist', 'Empfehlungslisten/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('f2bdc87e06279b69a7f2c7a4bff9f5f7', 'a626f6f9942488da7ab0939c3585e58b', 1, 0, 'index.php?cl=help&amp;page=guestbook', 'hilfe/gaestebuch/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('9d0f22a4f43ea825f9cd3ebf5a7bde23', 'a7d5ab5a4e87693998c5aec066dda6e6', 1, 0, 'index.php?cl=account_user', 'meine-adressen/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('3ebbaef4dd461b3c12020f8a076f0212', 'a9afb500184c584fb5ab2ad9b4162e96', 1, 0, 'index.php?cl=forgotpwd', 'passwort-vergessen/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('2b3cb8ed3e86f31772f1ac6ac83315db', 'acddcfef9c25bcae3b96eb00669541ff', 1, 0, 'index.php?cl=register', 'konto-eroeffnen/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('2100bf24ca5c4444971dcfc290d9fff4', 'af3d70b061ae02da3d6ce248c497dc32', 1, 0, 'index.php?cl=help&amp;page=links', 'hilfe/links/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('a071f3836b279b98bc2c9548cc44d875', 'b61bd555494657d24f309799e30827ec', 1, 0, 'index.php?cl=help&amp;page=newsletter', 'hilfe/newsletter/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('e96d6916a18db28877e113151e26fd08', 'b914c7bc2a782ad879f09eb654122cf3', 1, 0, 'index.php?cl=info&amp;tpl=customer_right_of_withdrawal.tpl', 'widerrufsrecht/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('c4b506be468a1f71f2eb6e7bbceb0c57', 'b93b703d313e89662773cffaab750f1d', 1, 1, 'index.php?cl=wishlist', 'gift-registry/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('67a55f21d85ee47a3431b8292758a7a1', 'baa3b653a618696b06c70a6dda95ebde', 1, 0, 'index.php?cl=account_recommlist', 'meine-lieblingslisten/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('ab15412c5593f9d3c3a8895810cad387', 'c06f5fa58d5afc3db7e54996528e8bdc', 1, 0, 'index.php?cl=info&amp;tpl=order_info.tpl', 'wie-bestellen/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('95b50832f42965842866a41d363d55e1', 'c0e5670e15fe3235dd7fd9b6e343a074', 1, 0, 'index.php?cl=info&amp;tpl=agb.tpl', 'agb/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('ab15412c5593f9d3c3a8895810cad387', 'c1298d664559e5c887e3e18c7cda5133', 1, 1, 'index.php?cl=info&amp;tpl=order_info.tpl', 'how-to-order/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('3d429016f2fbe4bc162dd06a451067ab', 'c2d486a828d484a863b69e53078de31f', 1, 1, 'index.php?cl=help&amp;page=wishlist', 'help/gift-registry/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('95b50832f42965842866a41d363d55e1', 'c7f0defa518f67f01b85b8474f1a43ea', 1, 1, 'index.php?cl=info&amp;tpl=agb.tpl', 'terms/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('70cc13db1bda9cdb8403879a11032e5a', 'cc28156a4f728c1b33e7e02fd846628e', 1, 0, 'index.php?cl=review', 'bewertungen/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('798dcdfffd6b65277d279255c11e4bd3', 'd3df023041bb144df4fd756a27d01d44', 1, 0, 'index.php?cl=info&amp;tpl=impressum.tpl', 'impressum/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('3fee1f391e4b4b019ead6ea2302562ea', 'd41f984132c321d4e06ad1f2a72d5882', 1, 1, 'index.php?cl=help&amp;page=info&amp;tpl=agb.tpl', 'help/terms/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('e311feb6dac04c7cad25a487dd0059f5', 'd7abe1fb6fb1e9e6003b45844b0c0f09', 1, 1, 'index.php?cl=help&amp;page=alist', 'help/categories/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('2b4649a4ca9c0f2a9770a21eba3253c8', 'da3c1a52ac30056f0e020469a5d35d99', 1, 0, 'index.php?cl=help&amp;page=forgotpwd', 'hilfe/passwort-vergessen/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('4ac3c7edbf7fcafa7f8da6166134e3bc', 'da6c5523f7c91d108cadb0be7757c27f', 1, 1, 'index.php?cl=tags', 'tags/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('286b3395eae67e6e58322f1731078e71', 'dd78cb9b34d9cd30f8a848005c402ba6', 1, 1, 'index.php?cl=help&amp;page=account_recommlist', 'help/my-listmania-list/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('4e9bbc59ba801d5174e961f7a6656721', 'ded4f3786c6f4d6d14e3034834ebdcaf', 1, 1, 'index.php?cl=guestbook', 'guestbook/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('097981309922c61aabba3f13cf716810', 'e098f2c231bce2c60473c04f4cded5dd', 1, 1, 'index.php?cl=help&amp;page=suggest', 'help/recommend/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('f52b25bb4e58480a2df8c06b65b4901c', 'e0dd29a75947539da6b1924d31c9849f', 1, 0, 'index.php?cl=compare', 'mein-produktvergleich/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('3fee1f391e4b4b019ead6ea2302562ea', 'e1f3096e6be9f09d19a7b5416cf75ffd', 1, 0, 'index.php?cl=help&amp;page=info&amp;tpl=agb.tpl', 'hilfe/agb/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('a9d28c6f1eae708a031d930117fc3740', 'e604233c5a2804d21ec0252a445e93d3', 1, 0, 'index.php?cl=newsletter', 'newsletter/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('8be5f76ba0ed85f4c2fd9e57cd137a05', 'e6331d115f5323610c639ef2f0369f8a', 1, 0, 'index.php?cl=basket', 'warenkorb/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('c80cb6107b3481a49ec29e668c9a885f', 'e6c20bf0d1d929f570f919f35a25bff1', 1, 0, 'index.php?cl=help&amp;page=account_password', 'hilfe/mein-passwort/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('2b4649a4ca9c0f2a9770a21eba3253c8', 'e7d3640dc365932ea39a5845017451f1', 1, 1, 'index.php?cl=help&amp;page=forgotpwd', 'help/forgot-password/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('2f0efd241b52794989637f6176c05619', 'e8cccc9bd869610593e416da1a066e19', 1, 1, 'index.php?cl=help&amp;page=info&amp;tpl=delivery_info.tpl', 'help/shipping-and-charges/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('e96d6916a18db28877e113151e26fd08', 'e91d3f4809b713664045f30d900b789a', 1, 1, 'index.php?cl=info&amp;tpl=customer_right_of_withdrawal.tpl', 'right-of-withdrawal/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('6d60cc19a6f9ae587ff40bde86f27e75', 'e9c2c9ccc91911acd7e4e399c2c8838d', 1, 1, 'index.php?cl=help&amp;page=account_wishlist', 'help/my-gift-registry/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('bb8c75b6c8a3932f504250014529b78b', 'eb692d07ec8608d943db0a3bca29c4ce', 1, 0, 'index.php?cl=account_order', 'bestellhistorie/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('8be5f76ba0ed85f4c2fd9e57cd137a05', 'ecaf0240f9f46bbee5ffc6dd73d0b7f0', 1, 1, 'index.php?cl=basket', 'cart/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('097981309922c61aabba3f13cf716810', 'ed33aefc08d7a8b31ad3dcb61ba5d1b5', 1, 0, 'index.php?cl=help&amp;page=suggest', 'hilfe/empfehlen/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('e7f616d4119f1b7e073d74ff40efa453', 'efbdcce791ae8fecc0a45ff7e1c92ca6', 1, 1, 'index.php?cl=help&amp;page=contact', 'help/contact/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('4ac3c7edbf7fcafa7f8da6166134e3bc', 'f409502ee6998d6b48588958fde3cd6f', 1, 0, 'index.php?cl=tags', 'tags/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('72535abf87122d1756319e5a3a84aec8', 'f460d530b15e5dfba1194eb4a32b87c5', 1, 1, 'index.php?cl=help&amp;page=info&amp;tpl=order_info.tpl', 'help/how-to-order/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('7ec4cddc7e3fe3bcf0410569355ff84e', 'f80ace8f87e1d7f446ab1fa58f275f4c', 1, 1, 'index.php?cl=links', 'links/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('f2bdc87e06279b69a7f2c7a4bff9f5f7', 'f8e48035979bf62e5bbc15504f9d81fa', 1, 1, 'index.php?cl=help&amp;page=guestbook', 'help/guestbook/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('e2af574a8e963c354d4555159e54a516', 'f9d1a02ab749dc360c4e21f21de1beaf', 1, 0, 'index.php?cl=contact', 'kontakt/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('c4f6f0cf46e0c61c19a34ab58b6d62fc', 'fda981a292e074f1b8ed3aa0937938b8', 1, 0, 'index.php?cl=help&amp;page=info&amp;tpl=security_info.tpl', 'hilfe/datenschutz/', 'static', 0, '', '', 0, '');
INSERT INTO `oxseo` VALUES ('2100bf24ca5c4444971dcfc290d9fff4', 'ffd0f3c469cdb59bb32a4e647152dca7', 1, 1, 'index.php?cl=help&amp;page=links', 'help/links/', 'static', 0, '', '', 0, '');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxseohistory`
-- 

DROP TABLE IF EXISTS `oxseohistory`;
CREATE TABLE IF NOT EXISTS `oxseohistory` (
  `OXOBJECTID` char(32) collate latin1_general_ci NOT NULL,
  `OXIDENT` char(32) collate latin1_general_ci NOT NULL,
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXLANG` int(2) NOT NULL default '0',
  `OXHITS` bigint(20) NOT NULL default '0',
  `OXINSERT` timestamp NULL default NULL,
  `OXTIMESTAMP` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`OXIDENT`,`OXSHOPID`,`OXLANG`),
  KEY `search` (`OXOBJECTID`,`OXSHOPID`,`OXLANG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxseohistory`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxseologs`
-- 

DROP TABLE IF EXISTS `oxseologs`;
CREATE TABLE IF NOT EXISTS `oxseologs` (
  `OXSTDURL` text collate latin1_general_ci NOT NULL,
  `OXIDENT` char(32) collate latin1_general_ci NOT NULL,
  `OXSHOPID` int(11) NOT NULL,
  `OXLANG` int(11) NOT NULL,
  `OXTIMESTAMP` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`OXIDENT`,`OXSHOPID`,`OXLANG`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxseologs`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxshops`
-- 

DROP TABLE IF EXISTS `oxshops`;
CREATE TABLE IF NOT EXISTS `oxshops` (
  `OXID` int(11) NOT NULL default '1',
  `OXPARENTID` int(11) NOT NULL default '0',
  `OXACTIVE` tinyint(1) NOT NULL default '1',
  `OXACTIVE_1` tinyint(1) NOT NULL default '1',
  `OXACTIVE_2` tinyint(1) NOT NULL default '1',
  `OXACTIVE_3` tinyint(1) NOT NULL default '1',
  `OXISINHERITED` int(11) NOT NULL default '0',
  `OXISMULTISHOP` int(11) NOT NULL default '0',
  `OXISSUPERSHOP` int(11) NOT NULL default '0',
  `OXPRODUCTIVE` tinyint(1) NOT NULL default '0',
  `OXDEFCURRENCY` char(32) collate latin1_general_ci NOT NULL default '',
  `OXDEFLANGUAGE` int(11) NOT NULL default '0',
  `OXNAME` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLEPREFIX` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLEPREFIX_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLEPREFIX_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLEPREFIX_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLESUFFIX` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLESUFFIX_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLESUFFIX_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLESUFFIX_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSTARTTITLE` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSTARTTITLE_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSTARTTITLE_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSTARTTITLE_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXINFOEMAIL` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXORDEREMAIL` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXOWNEREMAIL` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXORDERSUBJECT` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXREGISTERSUBJECT` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXFORGOTPWDSUBJECT` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSENDEDNOWSUBJECT` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXORDERSUBJECT_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXREGISTERSUBJECT_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXFORGOTPWDSUBJECT_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSENDEDNOWSUBJECT_1` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXORDERSUBJECT_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXREGISTERSUBJECT_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXFORGOTPWDSUBJECT_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSENDEDNOWSUBJECT_2` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXORDERSUBJECT_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXREGISTERSUBJECT_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXFORGOTPWDSUBJECT_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSENDEDNOWSUBJECT_3` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSMTP` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSMTPUSER` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXSMTPPWD` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXSERIAL` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXCOMPANY` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXSTREET` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXZIP` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXCITY` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXCOUNTRY` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXBANKNAME` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXBANKNUMBER` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXBANKCODE` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXVATNUMBER` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXBICCODE` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXIBANNUMBER` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXFNAME` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXLNAME` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTELEFON` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXTELEFAX` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXURL` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXDEFCAT` char(32) collate latin1_general_ci NOT NULL default '',
  `OXHRBNR` varchar(64) collate latin1_general_ci NOT NULL default '',
  `OXCOURT` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXADBUTLERID` varchar(64) collate latin1_general_ci NOT NULL default '',
  `OXAFFILINETID` varchar(64) collate latin1_general_ci NOT NULL default '',
  `OXSUPERCLICKSID` varchar(64) collate latin1_general_ci NOT NULL default '',
  `OXAFFILIWELTID` varchar(64) collate latin1_general_ci NOT NULL default '',
  `OXAFFILI24ID` varchar(64) collate latin1_general_ci NOT NULL default '',
  `OXEDITION` char(2) collate latin1_general_ci NOT NULL,
  `OXVERSION` char(16) collate latin1_general_ci NOT NULL,
  `OXSEOACTIVE` tinyint(1) NOT NULL default '1',
  `OXSEOACTIVE_1` tinyint(1) NOT NULL default '1',
  `OXSEOACTIVE_2` tinyint(1) NOT NULL default '1',
  `OXSEOACTIVE_3` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`OXID`),
  KEY `OXACTIVE` (`OXACTIVE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxshops`
-- 

INSERT INTO `oxshops` VALUES (1, 0, 1, 1, 1, 1, 0, 0, 1, 0, '', 0, 'OXID eShop EE 4', 'OXID Geschenke Shop', 'OXID Gift Shop', '', '', 'online kaufen', 'buy online', '', '', 'Originelle, witzige Geschenkideen - Lifestyle, Trends, Accessoires', 'Original, Funny Presents - Lifestyle, Trends, Accessories', '', '', 'Ihre Info e-Mail Adresse', 'Ihre Bestell Reply e-Mail Adresse', 'Ihre Bestell e-Mail Adresse', 'Ihre Bestellung bei OXID eSales', 'Vielen Dank für Ihre Registrierung im OXID eShop', 'Ihr Passwort im OXID eShop', 'Ihre OXID eSales Bestellung wurde versandt', 'Your order from OXID eShop', 'Thank you for your registration in OXID eShop', 'Your OXID eShop password', 'Your OXID eSales Order has been shipped', '', '', '', '', '', '', '', '', 'Tragen Sie bitte hier Ihren SMTP Server ein', '', '', 'EF7FV-B9TA8-3R3SD-MZNU4-7NWM3-AN7AU', 'Ihr Firmenname', 'Musterstr. 10', '79098', 'Musterstadt', 'Deutschland', 'Volksbank Musterstadt', '1234567890', '900 1234567', '', '', '', 'Hans', 'Mustermann', '0800 1234567', '0800 1234567', 'www.meineshopurl.com', '', '', '', '', '', '', '', '', 'EE', '4.0.0.0', 1, 1, 0, 0);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxuser`
-- 

DROP TABLE IF EXISTS `oxuser`;
CREATE TABLE IF NOT EXISTS `oxuser` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXACTIVE` tinyint(1) NOT NULL default '1',
  `OXRIGHTS` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXUSERNAME` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXPASSWORD` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXCUSTNR` int(11) NOT NULL default '0',
  `OXUSTID` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXUSTIDSTATUS` tinyint(1) NOT NULL default '0',
  `OXCOMPANY` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXFNAME` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXLNAME` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSTREET` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSTREETNR` varchar(16) collate latin1_general_ci NOT NULL default '',
  `OXADDINFO` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXCITY` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXCOUNTRYID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXZIP` varchar(16) collate latin1_general_ci NOT NULL default '',
  `OXFON` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXFAX` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXSAL` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXBONI` int(11) NOT NULL default '0',
  `OXCREATE` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXREGISTER` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXPRIVFON` varchar(64) collate latin1_general_ci NOT NULL default '',
  `OXMOBFON` varchar(64) collate latin1_general_ci NOT NULL default '',
  `OXBIRTHDATE` date NOT NULL default '0000-00-00',
  `OXURL` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXDISABLEAUTOGRP` tinyint(1) NOT NULL default '0',
  `OXLDAPKEY` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXWRONGLOGINS` int(11) NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  UNIQUE KEY `OXUSERNAME` (`OXUSERNAME`,`OXSHOPID`),
  KEY `OXPASSWORD` (`OXPASSWORD`),
  KEY `OXSHOPID` (`OXSHOPID`,`OXUSERNAME`),
  KEY `OXLNAME` (`OXLNAME`),
  KEY `OXACTIVE` (`OXACTIVE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxuser`
-- 

INSERT INTO `oxuser` VALUES ('oxdefaultadmin', 1, 'malladmin', 1, 'admin', 'ox_BBpaRCslUU8u', 1, '', 1, 'Ihr Firmenname', 'Hans', 'Mustermann', 'Musterstr.', '10', '', 'Musterstadt', 'a7c40f631fc920687.20179984', '79098', '0800 1234567', '0800 1234567', 'Herr', 1000, '2003-01-01 00:00:00', '2003-01-01 00:00:00', '', '', '0000-00-00', '', 0, '', 0);
INSERT INTO `oxuser` VALUES ('36944b76cc9604c53.04579642', 1, 'malladmin', 1, 'management', 'ox_BBpOWzA9REslFBAeDkE!', 2, '', 0, '', 'Max', 'Manager', 'Testalleee', '11', '', 'Freiburg', 'a7c40f631fc920687.20179984', '56565', '0145654', '', 'Herr', 0, '2006-07-14 12:07:05', '2006-07-14 12:07:05', '', '', '1955-11-11', '', 0, '', 0);
INSERT INTO `oxuser` VALUES ('36944b76d203d4a35.41417835', 1, 'malladmin', 1, 'redaktion', 'ox_BBpRRyA9SF4pBBAPCQ!!', 3, '', 0, '', 'Lisa', 'Leser', 'Testalleee', '33', '', 'Freiburg', 'a7c40f631fc920687.20179984', '78787', '', '', 'Frau', 0, '2006-07-14 12:08:32', '2006-07-14 12:08:32', '', '', '0000-00-00', '', 0, '', 0);
INSERT INTO `oxuser` VALUES ('36944b76d6e583fe2.12734046', 1, 'malladmin', 1, 'bild', 'ox_BBpbQygiRkg!', 4, '', 0, '', 'Theresa', 'Bild', '', '', '', 'Freiburg', 'a7c40f631fc920687.20179984', '98989', '', '', 'Frau', 0, '2006-07-14 12:09:50', '2006-07-14 12:09:50', '', '', '0000-00-00', '', 0, '', 0);
INSERT INTO `oxuser` VALUES ('36944b76dae9ef333.88219217', 1, 'malladmin', 1, 'buchhaltung', 'ox_BBpbXSEmRVcmARkYDEZI', 5, '', 0, '', 'Franz', 'Zahlendreher', '', '', '', 'Freiburg', 'a7c40f631fc920687.20179984', '66565', '', '', 'Herr', 0, '2006-07-14 12:10:54', '2006-07-14 12:10:54', '', '', '0000-00-00', '', 0, '', 0);
INSERT INTO `oxuser` VALUES ('36944b76e717de855.40215733', 1, 'malladmin', 1, 'produkt', 'ox_BBpXUDMiWEE4EAA!', 6, '', 0, '', 'Peter', 'Produktmanager', '', '', '', '', 'a7c40f631fc920687.20179984', '', '', '', 'Herr', 0, '2006-07-14 12:14:09', '2006-07-14 12:14:09', '', '', '0000-00-00', '', 0, '', 0);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxuserbasketitems`
-- 

DROP TABLE IF EXISTS `oxuserbasketitems`;
CREATE TABLE IF NOT EXISTS `oxuserbasketitems` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXBASKETID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXARTID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXAMOUNT` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSELLIST` varchar(255) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`OXID`),
  KEY `OXBASKETID` (`OXBASKETID`),
  KEY `OXARTID` (`OXARTID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxuserbasketitems`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxuserbaskets`
-- 

DROP TABLE IF EXISTS `oxuserbaskets`;
CREATE TABLE IF NOT EXISTS `oxuserbaskets` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXUSERID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXTITLE` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXCREATE` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `OXPUBLIC` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`OXID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxuserbaskets`
-- 

INSERT INTO `oxuserbaskets` VALUES ('da8c3d82360f8d90bca2aa3dcd042a26', 'oxdefaultadmin', 'noticelist', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxuserpayments`
-- 

DROP TABLE IF EXISTS `oxuserpayments`;
CREATE TABLE IF NOT EXISTS `oxuserpayments` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXUSERID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXPAYMENTSID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXVALUE` blob NOT NULL,
  PRIMARY KEY  (`OXID`),
  KEY `OXUSERID` (`OXUSERID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxuserpayments`
-- 

INSERT INTO `oxuserpayments` VALUES ('0a55f66c57b25febb5acdda76dd4a4fb', 'oxdefaultadmin', 'oxempty', '');

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxvendor`
-- 

DROP TABLE IF EXISTS `oxvendor`;
CREATE TABLE IF NOT EXISTS `oxvendor` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXSHOPINCL` bigint(20) unsigned NOT NULL default '0',
  `OXSHOPEXCL` bigint(20) unsigned NOT NULL default '0',
  `OXACTIVE` tinyint(1) NOT NULL default '1',
  `OXICON` char(128) collate latin1_general_ci NOT NULL default '',
  `OXTITLE` char(255) collate latin1_general_ci NOT NULL default '',
  `OXSHORTDESC` char(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_1` char(255) collate latin1_general_ci NOT NULL default '',
  `OXSHORTDESC_1` char(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_2` char(255) collate latin1_general_ci NOT NULL default '',
  `OXSHORTDESC_2` char(255) collate latin1_general_ci NOT NULL default '',
  `OXTITLE_3` char(255) collate latin1_general_ci NOT NULL default '',
  `OXSHORTDESC_3` char(255) collate latin1_general_ci NOT NULL default '',
  `OXSHOWSUFFIX` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`OXID`),
  KEY `OXSHOPID` (`OXSHOPID`),
  KEY `OXSHOPINCL` (`OXSHOPINCL`),
  KEY `OXSHOPEXCL` (`OXSHOPEXCL`),
  KEY `OXACTIVE` (`OXACTIVE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxvendor`
-- 

INSERT INTO `oxvendor` VALUES ('d2e44d9b31fcce448.08890330', 1, 1, 0, 1, '', 'Hersteller 1', '', 'Manufacturer 1', '', '', '', '', '', 1);
INSERT INTO `oxvendor` VALUES ('d2e44d9b32fd2c224.65443178', 1, 1, 0, 1, '', 'Hersteller 2', '', 'Manufacturer 2', '', '', '', '', '', 1);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxvouchers`
-- 

DROP TABLE IF EXISTS `oxvouchers`;
CREATE TABLE IF NOT EXISTS `oxvouchers` (
  `OXDATEUSED` date default NULL,
  `OXORDERID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXUSERID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXRESERVED` int(11) NOT NULL default '0',
  `OXVOUCHERNR` char(255) collate latin1_general_ci NOT NULL default '',
  `OXVOUCHERSERIEID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXDISCOUNT` float(9,2) default NULL,
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`OXID`),
  KEY `OXVOUCHERSERIEID` (`OXVOUCHERSERIEID`),
  KEY `OXORDERID` (`OXORDERID`),
  KEY `OXUSERID` (`OXUSERID`),
  KEY `OXVOUCHERNR` (`OXVOUCHERNR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxvouchers`
-- 


-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxvoucherseries`
-- 

DROP TABLE IF EXISTS `oxvoucherseries`;
CREATE TABLE IF NOT EXISTS `oxvoucherseries` (
  `OXID` char(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXSHOPINCL` bigint(20) unsigned NOT NULL default '0',
  `OXSHOPEXCL` bigint(20) unsigned NOT NULL default '0',
  `OXSERIENR` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXSERIEDESCRIPTION` varchar(255) collate latin1_general_ci NOT NULL default '',
  `OXDISCOUNT` float(9,2) NOT NULL default '0.00',
  `OXDISCOUNTTYPE` enum('percent','absolute') collate latin1_general_ci NOT NULL default 'absolute',
  `OXSTARTDATE` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXRELEASEDATE` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXBEGINDATE` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXENDDATE` datetime NOT NULL default '0000-00-00 00:00:00',
  `OXALLOWSAMESERIES` tinyint(1) NOT NULL default '0',
  `OXALLOWOTHERSERIES` tinyint(1) NOT NULL default '0',
  `OXALLOWUSEANOTHER` tinyint(1) NOT NULL default '0',
  `OXMINIMUMVALUE` float(9,2) NOT NULL default '0.00',
  PRIMARY KEY  (`OXID`),
  KEY `OXSERIENR` (`OXSERIENR`),
  KEY `OXSHOPID` (`OXSHOPID`),
  KEY `OXSHOPINCL` (`OXSHOPINCL`),
  KEY `OXSHOPEXCL` (`OXSHOPEXCL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxvoucherseries`
-- 


-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxarticles_1`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxarticles_1` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXPARENTID` char(32)
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXARTNUM` varchar(255)
,`OXEAN` varchar(13)
,`OXDISTEAN` varchar(13)
,`OXTITLE` varchar(255)
,`OXSHORTDESC` varchar(255)
,`OXPRICE` double
,`OXBLFIXEDPRICE` tinyint(1)
,`OXPRICEA` double
,`OXPRICEB` double
,`OXPRICEC` double
,`OXBPRICE` double
,`OXTPRICE` double
,`OXUNITNAME` varchar(32)
,`OXUNITQUANTITY` double
,`OXEXTURL` varchar(255)
,`OXURLDESC` varchar(255)
,`OXURLIMG` varchar(128)
,`OXVAT` float
,`OXTHUMB` varchar(128)
,`OXICON` varchar(128)
,`OXPIC1` varchar(128)
,`OXPIC2` varchar(128)
,`OXPIC3` varchar(128)
,`OXPIC4` varchar(128)
,`OXPIC5` varchar(128)
,`OXPIC6` varchar(128)
,`OXPIC7` varchar(128)
,`OXPIC8` varchar(128)
,`OXPIC9` varchar(128)
,`OXPIC10` varchar(128)
,`OXPIC11` varchar(128)
,`OXPIC12` varchar(128)
,`OXZOOM1` varchar(128)
,`OXZOOM2` varchar(128)
,`OXZOOM3` varchar(128)
,`OXZOOM4` varchar(128)
,`OXWEIGHT` double
,`OXSTOCK` double
,`OXSTOCKFLAG` tinyint(1)
,`OXSTOCKTEXT` varchar(255)
,`OXNOSTOCKTEXT` varchar(255)
,`OXDELIVERY` date
,`OXINSERT` date
,`OXTIMESTAMP` timestamp
,`OXLENGTH` double
,`OXWIDTH` double
,`OXHEIGHT` double
,`OXFILE` varchar(128)
,`OXSEARCHKEYS` varchar(255)
,`OXTEMPLATE` varchar(128)
,`OXQUESTIONEMAIL` varchar(255)
,`OXISSEARCH` tinyint(1)
,`OXVARNAME` varchar(32)
,`OXVARSTOCK` int(5)
,`OXVARCOUNT` int(1)
,`OXVARSELECT` varchar(32)
,`OXVARMINPRICE` double
,`OXVARNAME_1` varchar(32)
,`OXVARSELECT_1` varchar(32)
,`OXVARNAME_2` varchar(32)
,`OXVARSELECT_2` varchar(32)
,`OXVARNAME_3` varchar(32)
,`OXVARSELECT_3` varchar(32)
,`OXTITLE_1` varchar(255)
,`OXSHORTDESC_1` varchar(255)
,`OXURLDESC_1` varchar(255)
,`OXSEARCHKEYS_1` varchar(255)
,`OXTITLE_2` varchar(255)
,`OXSHORTDESC_2` varchar(255)
,`OXURLDESC_2` varchar(255)
,`OXSEARCHKEYS_2` varchar(255)
,`OXTITLE_3` varchar(255)
,`OXSHORTDESC_3` varchar(255)
,`OXURLDESC_3` varchar(255)
,`OXSEARCHKEYS_3` varchar(255)
,`OXFOLDER` varchar(32)
,`OXSUBCLASS` varchar(32)
,`OXSTOCKTEXT_1` varchar(255)
,`OXSTOCKTEXT_2` varchar(255)
,`OXSTOCKTEXT_3` varchar(255)
,`OXNOSTOCKTEXT_1` varchar(255)
,`OXNOSTOCKTEXT_2` varchar(255)
,`OXNOSTOCKTEXT_3` varchar(255)
,`OXSORT` int(5)
,`OXSOLDAMOUNT` double
,`OXNONMATERIAL` int(1)
,`OXFREESHIPPING` int(1)
,`OXREMINDACTIV` int(1)
,`OXREMINDAMOUNT` double
,`OXAMITEMID` varchar(32)
,`OXAMTASKID` varchar(16)
,`OXVENDORID` char(32)
,`OXSKIPDISCOUNTS` tinyint(1)
,`OXORDERINFO` varchar(255)
,`OXPIXIEXPORT` tinyint(1)
,`OXPIXIEXPORTED` timestamp
,`OXVPE` int(11)
,`OXRATING` double
,`OXRATINGCNT` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxarticles_2`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxarticles_2` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXPARENTID` char(32)
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXARTNUM` varchar(255)
,`OXEAN` varchar(13)
,`OXDISTEAN` varchar(13)
,`OXTITLE` varchar(255)
,`OXSHORTDESC` varchar(255)
,`OXPRICE` double
,`OXBLFIXEDPRICE` tinyint(1)
,`OXPRICEA` double
,`OXPRICEB` double
,`OXPRICEC` double
,`OXBPRICE` double
,`OXTPRICE` double
,`OXUNITNAME` varchar(32)
,`OXUNITQUANTITY` double
,`OXEXTURL` varchar(255)
,`OXURLDESC` varchar(255)
,`OXURLIMG` varchar(128)
,`OXVAT` float
,`OXTHUMB` varchar(128)
,`OXICON` varchar(128)
,`OXPIC1` varchar(128)
,`OXPIC2` varchar(128)
,`OXPIC3` varchar(128)
,`OXPIC4` varchar(128)
,`OXPIC5` varchar(128)
,`OXPIC6` varchar(128)
,`OXPIC7` varchar(128)
,`OXPIC8` varchar(128)
,`OXPIC9` varchar(128)
,`OXPIC10` varchar(128)
,`OXPIC11` varchar(128)
,`OXPIC12` varchar(128)
,`OXZOOM1` varchar(128)
,`OXZOOM2` varchar(128)
,`OXZOOM3` varchar(128)
,`OXZOOM4` varchar(128)
,`OXWEIGHT` double
,`OXSTOCK` double
,`OXSTOCKFLAG` tinyint(1)
,`OXSTOCKTEXT` varchar(255)
,`OXNOSTOCKTEXT` varchar(255)
,`OXDELIVERY` date
,`OXINSERT` date
,`OXTIMESTAMP` timestamp
,`OXLENGTH` double
,`OXWIDTH` double
,`OXHEIGHT` double
,`OXFILE` varchar(128)
,`OXSEARCHKEYS` varchar(255)
,`OXTEMPLATE` varchar(128)
,`OXQUESTIONEMAIL` varchar(255)
,`OXISSEARCH` tinyint(1)
,`OXVARNAME` varchar(32)
,`OXVARSTOCK` int(5)
,`OXVARCOUNT` int(1)
,`OXVARSELECT` varchar(32)
,`OXVARMINPRICE` double
,`OXVARNAME_1` varchar(32)
,`OXVARSELECT_1` varchar(32)
,`OXVARNAME_2` varchar(32)
,`OXVARSELECT_2` varchar(32)
,`OXVARNAME_3` varchar(32)
,`OXVARSELECT_3` varchar(32)
,`OXTITLE_1` varchar(255)
,`OXSHORTDESC_1` varchar(255)
,`OXURLDESC_1` varchar(255)
,`OXSEARCHKEYS_1` varchar(255)
,`OXTITLE_2` varchar(255)
,`OXSHORTDESC_2` varchar(255)
,`OXURLDESC_2` varchar(255)
,`OXSEARCHKEYS_2` varchar(255)
,`OXTITLE_3` varchar(255)
,`OXSHORTDESC_3` varchar(255)
,`OXURLDESC_3` varchar(255)
,`OXSEARCHKEYS_3` varchar(255)
,`OXFOLDER` varchar(32)
,`OXSUBCLASS` varchar(32)
,`OXSTOCKTEXT_1` varchar(255)
,`OXSTOCKTEXT_2` varchar(255)
,`OXSTOCKTEXT_3` varchar(255)
,`OXNOSTOCKTEXT_1` varchar(255)
,`OXNOSTOCKTEXT_2` varchar(255)
,`OXNOSTOCKTEXT_3` varchar(255)
,`OXSORT` int(5)
,`OXSOLDAMOUNT` double
,`OXNONMATERIAL` int(1)
,`OXFREESHIPPING` int(1)
,`OXREMINDACTIV` int(1)
,`OXREMINDAMOUNT` double
,`OXAMITEMID` varchar(32)
,`OXAMTASKID` varchar(16)
,`OXVENDORID` char(32)
,`OXSKIPDISCOUNTS` tinyint(1)
,`OXORDERINFO` varchar(255)
,`OXPIXIEXPORT` tinyint(1)
,`OXPIXIEXPORTED` timestamp
,`OXVPE` int(11)
,`OXRATING` double
,`OXRATINGCNT` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxarticles_3`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxarticles_3` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXPARENTID` char(32)
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXARTNUM` varchar(255)
,`OXEAN` varchar(13)
,`OXDISTEAN` varchar(13)
,`OXTITLE` varchar(255)
,`OXSHORTDESC` varchar(255)
,`OXPRICE` double
,`OXBLFIXEDPRICE` tinyint(1)
,`OXPRICEA` double
,`OXPRICEB` double
,`OXPRICEC` double
,`OXBPRICE` double
,`OXTPRICE` double
,`OXUNITNAME` varchar(32)
,`OXUNITQUANTITY` double
,`OXEXTURL` varchar(255)
,`OXURLDESC` varchar(255)
,`OXURLIMG` varchar(128)
,`OXVAT` float
,`OXTHUMB` varchar(128)
,`OXICON` varchar(128)
,`OXPIC1` varchar(128)
,`OXPIC2` varchar(128)
,`OXPIC3` varchar(128)
,`OXPIC4` varchar(128)
,`OXPIC5` varchar(128)
,`OXPIC6` varchar(128)
,`OXPIC7` varchar(128)
,`OXPIC8` varchar(128)
,`OXPIC9` varchar(128)
,`OXPIC10` varchar(128)
,`OXPIC11` varchar(128)
,`OXPIC12` varchar(128)
,`OXZOOM1` varchar(128)
,`OXZOOM2` varchar(128)
,`OXZOOM3` varchar(128)
,`OXZOOM4` varchar(128)
,`OXWEIGHT` double
,`OXSTOCK` double
,`OXSTOCKFLAG` tinyint(1)
,`OXSTOCKTEXT` varchar(255)
,`OXNOSTOCKTEXT` varchar(255)
,`OXDELIVERY` date
,`OXINSERT` date
,`OXTIMESTAMP` timestamp
,`OXLENGTH` double
,`OXWIDTH` double
,`OXHEIGHT` double
,`OXFILE` varchar(128)
,`OXSEARCHKEYS` varchar(255)
,`OXTEMPLATE` varchar(128)
,`OXQUESTIONEMAIL` varchar(255)
,`OXISSEARCH` tinyint(1)
,`OXVARNAME` varchar(32)
,`OXVARSTOCK` int(5)
,`OXVARCOUNT` int(1)
,`OXVARSELECT` varchar(32)
,`OXVARMINPRICE` double
,`OXVARNAME_1` varchar(32)
,`OXVARSELECT_1` varchar(32)
,`OXVARNAME_2` varchar(32)
,`OXVARSELECT_2` varchar(32)
,`OXVARNAME_3` varchar(32)
,`OXVARSELECT_3` varchar(32)
,`OXTITLE_1` varchar(255)
,`OXSHORTDESC_1` varchar(255)
,`OXURLDESC_1` varchar(255)
,`OXSEARCHKEYS_1` varchar(255)
,`OXTITLE_2` varchar(255)
,`OXSHORTDESC_2` varchar(255)
,`OXURLDESC_2` varchar(255)
,`OXSEARCHKEYS_2` varchar(255)
,`OXTITLE_3` varchar(255)
,`OXSHORTDESC_3` varchar(255)
,`OXURLDESC_3` varchar(255)
,`OXSEARCHKEYS_3` varchar(255)
,`OXFOLDER` varchar(32)
,`OXSUBCLASS` varchar(32)
,`OXSTOCKTEXT_1` varchar(255)
,`OXSTOCKTEXT_2` varchar(255)
,`OXSTOCKTEXT_3` varchar(255)
,`OXNOSTOCKTEXT_1` varchar(255)
,`OXNOSTOCKTEXT_2` varchar(255)
,`OXNOSTOCKTEXT_3` varchar(255)
,`OXSORT` int(5)
,`OXSOLDAMOUNT` double
,`OXNONMATERIAL` int(1)
,`OXFREESHIPPING` int(1)
,`OXREMINDACTIV` int(1)
,`OXREMINDAMOUNT` double
,`OXAMITEMID` varchar(32)
,`OXAMTASKID` varchar(16)
,`OXVENDORID` char(32)
,`OXSKIPDISCOUNTS` tinyint(1)
,`OXORDERINFO` varchar(255)
,`OXPIXIEXPORT` tinyint(1)
,`OXPIXIEXPORTED` timestamp
,`OXVPE` int(11)
,`OXRATING` double
,`OXRATINGCNT` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxarticles_4`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxarticles_4` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXPARENTID` char(32)
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXARTNUM` varchar(255)
,`OXEAN` varchar(13)
,`OXDISTEAN` varchar(13)
,`OXTITLE` varchar(255)
,`OXSHORTDESC` varchar(255)
,`OXPRICE` double
,`OXBLFIXEDPRICE` tinyint(1)
,`OXPRICEA` double
,`OXPRICEB` double
,`OXPRICEC` double
,`OXBPRICE` double
,`OXTPRICE` double
,`OXUNITNAME` varchar(32)
,`OXUNITQUANTITY` double
,`OXEXTURL` varchar(255)
,`OXURLDESC` varchar(255)
,`OXURLIMG` varchar(128)
,`OXVAT` float
,`OXTHUMB` varchar(128)
,`OXICON` varchar(128)
,`OXPIC1` varchar(128)
,`OXPIC2` varchar(128)
,`OXPIC3` varchar(128)
,`OXPIC4` varchar(128)
,`OXPIC5` varchar(128)
,`OXPIC6` varchar(128)
,`OXPIC7` varchar(128)
,`OXPIC8` varchar(128)
,`OXPIC9` varchar(128)
,`OXPIC10` varchar(128)
,`OXPIC11` varchar(128)
,`OXPIC12` varchar(128)
,`OXZOOM1` varchar(128)
,`OXZOOM2` varchar(128)
,`OXZOOM3` varchar(128)
,`OXZOOM4` varchar(128)
,`OXWEIGHT` double
,`OXSTOCK` double
,`OXSTOCKFLAG` tinyint(1)
,`OXSTOCKTEXT` varchar(255)
,`OXNOSTOCKTEXT` varchar(255)
,`OXDELIVERY` date
,`OXINSERT` date
,`OXTIMESTAMP` timestamp
,`OXLENGTH` double
,`OXWIDTH` double
,`OXHEIGHT` double
,`OXFILE` varchar(128)
,`OXSEARCHKEYS` varchar(255)
,`OXTEMPLATE` varchar(128)
,`OXQUESTIONEMAIL` varchar(255)
,`OXISSEARCH` tinyint(1)
,`OXVARNAME` varchar(32)
,`OXVARSTOCK` int(5)
,`OXVARCOUNT` int(1)
,`OXVARSELECT` varchar(32)
,`OXVARNAME_1` varchar(32)
,`OXVARSELECT_1` varchar(32)
,`OXVARNAME_2` varchar(32)
,`OXVARSELECT_2` varchar(32)
,`OXVARNAME_3` varchar(32)
,`OXVARSELECT_3` varchar(32)
,`OXTITLE_1` varchar(255)
,`OXSHORTDESC_1` varchar(255)
,`OXURLDESC_1` varchar(255)
,`OXSEARCHKEYS_1` varchar(255)
,`OXTITLE_2` varchar(255)
,`OXSHORTDESC_2` varchar(255)
,`OXURLDESC_2` varchar(255)
,`OXSEARCHKEYS_2` varchar(255)
,`OXTITLE_3` varchar(255)
,`OXSHORTDESC_3` varchar(255)
,`OXURLDESC_3` varchar(255)
,`OXSEARCHKEYS_3` varchar(255)
,`OXFOLDER` varchar(32)
,`OXSUBCLASS` varchar(32)
,`OXSTOCKTEXT_1` varchar(255)
,`OXSTOCKTEXT_2` varchar(255)
,`OXSTOCKTEXT_3` varchar(255)
,`OXNOSTOCKTEXT_1` varchar(255)
,`OXNOSTOCKTEXT_2` varchar(255)
,`OXNOSTOCKTEXT_3` varchar(255)
,`OXSORT` int(5)
,`OXSOLDAMOUNT` double
,`OXNONMATERIAL` int(1)
,`OXFREESHIPPING` int(1)
,`OXREMINDACTIV` int(1)
,`OXREMINDAMOUNT` double
,`OXAMITEMID` varchar(32)
,`OXAMTASKID` varchar(16)
,`OXVENDORID` char(32)
,`OXSKIPDISCOUNTS` tinyint(1)
,`OXORDERINFO` varchar(255)
,`OXPIXIEXPORT` tinyint(1)
,`OXPIXIEXPORTED` timestamp
,`OXVPE` int(11)
,`OXRATING` double
,`OXRATINGCNT` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxarticles_5`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxarticles_5` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXPARENTID` char(32)
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXARTNUM` varchar(255)
,`OXEAN` varchar(13)
,`OXDISTEAN` varchar(13)
,`OXTITLE` varchar(255)
,`OXSHORTDESC` varchar(255)
,`OXPRICE` double
,`OXBLFIXEDPRICE` tinyint(1)
,`OXPRICEA` double
,`OXPRICEB` double
,`OXPRICEC` double
,`OXBPRICE` double
,`OXTPRICE` double
,`OXUNITNAME` varchar(32)
,`OXUNITQUANTITY` double
,`OXEXTURL` varchar(255)
,`OXURLDESC` varchar(255)
,`OXURLIMG` varchar(128)
,`OXVAT` float
,`OXTHUMB` varchar(128)
,`OXICON` varchar(128)
,`OXPIC1` varchar(128)
,`OXPIC2` varchar(128)
,`OXPIC3` varchar(128)
,`OXPIC4` varchar(128)
,`OXPIC5` varchar(128)
,`OXPIC6` varchar(128)
,`OXPIC7` varchar(128)
,`OXPIC8` varchar(128)
,`OXPIC9` varchar(128)
,`OXPIC10` varchar(128)
,`OXPIC11` varchar(128)
,`OXPIC12` varchar(128)
,`OXZOOM1` varchar(128)
,`OXZOOM2` varchar(128)
,`OXZOOM3` varchar(128)
,`OXZOOM4` varchar(128)
,`OXWEIGHT` double
,`OXSTOCK` double
,`OXSTOCKFLAG` tinyint(1)
,`OXSTOCKTEXT` varchar(255)
,`OXNOSTOCKTEXT` varchar(255)
,`OXDELIVERY` date
,`OXINSERT` date
,`OXTIMESTAMP` timestamp
,`OXLENGTH` double
,`OXWIDTH` double
,`OXHEIGHT` double
,`OXFILE` varchar(128)
,`OXSEARCHKEYS` varchar(255)
,`OXTEMPLATE` varchar(128)
,`OXQUESTIONEMAIL` varchar(255)
,`OXISSEARCH` tinyint(1)
,`OXVARNAME` varchar(32)
,`OXVARSTOCK` int(5)
,`OXVARCOUNT` int(1)
,`OXVARSELECT` varchar(32)
,`OXVARNAME_1` varchar(32)
,`OXVARSELECT_1` varchar(32)
,`OXVARNAME_2` varchar(32)
,`OXVARSELECT_2` varchar(32)
,`OXVARNAME_3` varchar(32)
,`OXVARSELECT_3` varchar(32)
,`OXTITLE_1` varchar(255)
,`OXSHORTDESC_1` varchar(255)
,`OXURLDESC_1` varchar(255)
,`OXSEARCHKEYS_1` varchar(255)
,`OXTITLE_2` varchar(255)
,`OXSHORTDESC_2` varchar(255)
,`OXURLDESC_2` varchar(255)
,`OXSEARCHKEYS_2` varchar(255)
,`OXTITLE_3` varchar(255)
,`OXSHORTDESC_3` varchar(255)
,`OXURLDESC_3` varchar(255)
,`OXSEARCHKEYS_3` varchar(255)
,`OXFOLDER` varchar(32)
,`OXSUBCLASS` varchar(32)
,`OXSTOCKTEXT_1` varchar(255)
,`OXSTOCKTEXT_2` varchar(255)
,`OXSTOCKTEXT_3` varchar(255)
,`OXNOSTOCKTEXT_1` varchar(255)
,`OXNOSTOCKTEXT_2` varchar(255)
,`OXNOSTOCKTEXT_3` varchar(255)
,`OXSORT` int(5)
,`OXSOLDAMOUNT` double
,`OXNONMATERIAL` int(1)
,`OXFREESHIPPING` int(1)
,`OXREMINDACTIV` int(1)
,`OXREMINDAMOUNT` double
,`OXAMITEMID` varchar(32)
,`OXAMTASKID` varchar(16)
,`OXVENDORID` char(32)
,`OXSKIPDISCOUNTS` tinyint(1)
,`OXORDERINFO` varchar(255)
,`OXPIXIEXPORT` tinyint(1)
,`OXPIXIEXPORTED` timestamp
,`OXVPE` int(11)
,`OXRATING` double
,`OXRATINGCNT` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxarticles_6`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxarticles_6` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXPARENTID` char(32)
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXARTNUM` varchar(255)
,`OXEAN` varchar(13)
,`OXDISTEAN` varchar(13)
,`OXTITLE` varchar(255)
,`OXSHORTDESC` varchar(255)
,`OXPRICE` double
,`OXBLFIXEDPRICE` tinyint(1)
,`OXPRICEA` double
,`OXPRICEB` double
,`OXPRICEC` double
,`OXBPRICE` double
,`OXTPRICE` double
,`OXUNITNAME` varchar(32)
,`OXUNITQUANTITY` double
,`OXEXTURL` varchar(255)
,`OXURLDESC` varchar(255)
,`OXURLIMG` varchar(128)
,`OXVAT` float
,`OXTHUMB` varchar(128)
,`OXICON` varchar(128)
,`OXPIC1` varchar(128)
,`OXPIC2` varchar(128)
,`OXPIC3` varchar(128)
,`OXPIC4` varchar(128)
,`OXPIC5` varchar(128)
,`OXPIC6` varchar(128)
,`OXPIC7` varchar(128)
,`OXPIC8` varchar(128)
,`OXPIC9` varchar(128)
,`OXPIC10` varchar(128)
,`OXPIC11` varchar(128)
,`OXPIC12` varchar(128)
,`OXZOOM1` varchar(128)
,`OXZOOM2` varchar(128)
,`OXZOOM3` varchar(128)
,`OXZOOM4` varchar(128)
,`OXWEIGHT` double
,`OXSTOCK` double
,`OXSTOCKFLAG` tinyint(1)
,`OXSTOCKTEXT` varchar(255)
,`OXNOSTOCKTEXT` varchar(255)
,`OXDELIVERY` date
,`OXINSERT` date
,`OXTIMESTAMP` timestamp
,`OXLENGTH` double
,`OXWIDTH` double
,`OXHEIGHT` double
,`OXFILE` varchar(128)
,`OXSEARCHKEYS` varchar(255)
,`OXTEMPLATE` varchar(128)
,`OXQUESTIONEMAIL` varchar(255)
,`OXISSEARCH` tinyint(1)
,`OXVARNAME` varchar(32)
,`OXVARSTOCK` int(5)
,`OXVARCOUNT` int(1)
,`OXVARSELECT` varchar(32)
,`OXVARNAME_1` varchar(32)
,`OXVARSELECT_1` varchar(32)
,`OXVARNAME_2` varchar(32)
,`OXVARSELECT_2` varchar(32)
,`OXVARNAME_3` varchar(32)
,`OXVARSELECT_3` varchar(32)
,`OXTITLE_1` varchar(255)
,`OXSHORTDESC_1` varchar(255)
,`OXURLDESC_1` varchar(255)
,`OXSEARCHKEYS_1` varchar(255)
,`OXTITLE_2` varchar(255)
,`OXSHORTDESC_2` varchar(255)
,`OXURLDESC_2` varchar(255)
,`OXSEARCHKEYS_2` varchar(255)
,`OXTITLE_3` varchar(255)
,`OXSHORTDESC_3` varchar(255)
,`OXURLDESC_3` varchar(255)
,`OXSEARCHKEYS_3` varchar(255)
,`OXFOLDER` varchar(32)
,`OXSUBCLASS` varchar(32)
,`OXSTOCKTEXT_1` varchar(255)
,`OXSTOCKTEXT_2` varchar(255)
,`OXSTOCKTEXT_3` varchar(255)
,`OXNOSTOCKTEXT_1` varchar(255)
,`OXNOSTOCKTEXT_2` varchar(255)
,`OXNOSTOCKTEXT_3` varchar(255)
,`OXSORT` int(5)
,`OXSOLDAMOUNT` double
,`OXNONMATERIAL` int(1)
,`OXFREESHIPPING` int(1)
,`OXREMINDACTIV` int(1)
,`OXREMINDAMOUNT` double
,`OXAMITEMID` varchar(32)
,`OXAMTASKID` varchar(16)
,`OXVENDORID` char(32)
,`OXSKIPDISCOUNTS` tinyint(1)
,`OXORDERINFO` varchar(255)
,`OXPIXIEXPORT` tinyint(1)
,`OXPIXIEXPORTED` timestamp
,`OXVPE` int(11)
,`OXRATING` double
,`OXRATINGCNT` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxattribute_1`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxattribute_1` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXPOS` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxattribute_2`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxattribute_2` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXPOS` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxattribute_3`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxattribute_3` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXPOS` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxattribute_4`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxattribute_4` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXPOS` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxattribute_5`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxattribute_5` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXPOS` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxattribute_6`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxattribute_6` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXPOS` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxcategories_1`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxcategories_1` (
`OXID` varchar(32)
,`OXPARENTID` varchar(32)
,`OXLEFT` int(11)
,`OXRIGHT` int(11)
,`OXROOTID` varchar(32)
,`OXSORT` int(11)
,`OXACTIVE` tinyint(1)
,`OXHIDDEN` tinyint(1)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` varchar(254)
,`OXDESC` varchar(255)
,`OXLONGDESC` text
,`OXTHUMB` varchar(128)
,`OXEXTLINK` varchar(255)
,`OXTEMPLATE` varchar(128)
,`OXDEFSORT` varchar(64)
,`OXDEFSORTMODE` tinyint(1)
,`OXPRICEFROM` double
,`OXPRICETO` double
,`OXACTIVE_1` tinyint(1)
,`OXTITLE_1` varchar(255)
,`OXDESC_1` varchar(255)
,`OXLONGDESC_1` text
,`OXACTIVE_2` tinyint(1)
,`OXTITLE_2` varchar(255)
,`OXDESC_2` varchar(255)
,`OXLONGDESC_2` text
,`OXACTIVE_3` tinyint(1)
,`OXTITLE_3` varchar(255)
,`OXDESC_3` varchar(255)
,`OXLONGDESC_3` text
,`OXICON` varchar(128)
,`OXVAT` float
,`OXSKIPDISCOUNTS` tinyint(1)
,`OXSHOWSUFFIX` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxcategories_2`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxcategories_2` (
`OXID` varchar(32)
,`OXPARENTID` varchar(32)
,`OXLEFT` int(11)
,`OXRIGHT` int(11)
,`OXROOTID` varchar(32)
,`OXSORT` int(11)
,`OXACTIVE` tinyint(1)
,`OXHIDDEN` tinyint(1)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` varchar(254)
,`OXDESC` varchar(255)
,`OXLONGDESC` text
,`OXTHUMB` varchar(128)
,`OXEXTLINK` varchar(255)
,`OXTEMPLATE` varchar(128)
,`OXDEFSORT` varchar(64)
,`OXDEFSORTMODE` tinyint(1)
,`OXPRICEFROM` double
,`OXPRICETO` double
,`OXACTIVE_1` tinyint(1)
,`OXTITLE_1` varchar(255)
,`OXDESC_1` varchar(255)
,`OXLONGDESC_1` text
,`OXACTIVE_2` tinyint(1)
,`OXTITLE_2` varchar(255)
,`OXDESC_2` varchar(255)
,`OXLONGDESC_2` text
,`OXACTIVE_3` tinyint(1)
,`OXTITLE_3` varchar(255)
,`OXDESC_3` varchar(255)
,`OXLONGDESC_3` text
,`OXICON` varchar(128)
,`OXVAT` float
,`OXSKIPDISCOUNTS` tinyint(1)
,`OXSHOWSUFFIX` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxcategories_3`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxcategories_3` (
`OXID` varchar(32)
,`OXPARENTID` varchar(32)
,`OXLEFT` int(11)
,`OXRIGHT` int(11)
,`OXROOTID` varchar(32)
,`OXSORT` int(11)
,`OXACTIVE` tinyint(1)
,`OXHIDDEN` tinyint(1)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` varchar(254)
,`OXDESC` varchar(255)
,`OXLONGDESC` text
,`OXTHUMB` varchar(128)
,`OXEXTLINK` varchar(255)
,`OXTEMPLATE` varchar(128)
,`OXDEFSORT` varchar(64)
,`OXDEFSORTMODE` tinyint(1)
,`OXPRICEFROM` double
,`OXPRICETO` double
,`OXACTIVE_1` tinyint(1)
,`OXTITLE_1` varchar(255)
,`OXDESC_1` varchar(255)
,`OXLONGDESC_1` text
,`OXACTIVE_2` tinyint(1)
,`OXTITLE_2` varchar(255)
,`OXDESC_2` varchar(255)
,`OXLONGDESC_2` text
,`OXACTIVE_3` tinyint(1)
,`OXTITLE_3` varchar(255)
,`OXDESC_3` varchar(255)
,`OXLONGDESC_3` text
,`OXICON` varchar(128)
,`OXVAT` float
,`OXSKIPDISCOUNTS` tinyint(1)
,`OXSHOWSUFFIX` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxcategories_4`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxcategories_4` (
`OXID` varchar(32)
,`OXPARENTID` varchar(32)
,`OXLEFT` int(11)
,`OXRIGHT` int(11)
,`OXROOTID` varchar(32)
,`OXSORT` int(11)
,`OXACTIVE` tinyint(1)
,`OXHIDDEN` tinyint(1)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` varchar(254)
,`OXDESC` varchar(255)
,`OXLONGDESC` text
,`OXTHUMB` varchar(128)
,`OXEXTLINK` varchar(255)
,`OXTEMPLATE` varchar(128)
,`OXDEFSORT` varchar(64)
,`OXDEFSORTMODE` tinyint(1)
,`OXPRICEFROM` double
,`OXPRICETO` double
,`OXACTIVE_1` tinyint(1)
,`OXTITLE_1` varchar(255)
,`OXDESC_1` varchar(255)
,`OXLONGDESC_1` text
,`OXACTIVE_2` tinyint(1)
,`OXTITLE_2` varchar(255)
,`OXDESC_2` varchar(255)
,`OXLONGDESC_2` text
,`OXACTIVE_3` tinyint(1)
,`OXTITLE_3` varchar(255)
,`OXDESC_3` varchar(255)
,`OXLONGDESC_3` text
,`OXICON` varchar(128)
,`OXVAT` float
,`OXSKIPDISCOUNTS` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxcategories_5`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxcategories_5` (
`OXID` varchar(32)
,`OXPARENTID` varchar(32)
,`OXLEFT` int(11)
,`OXRIGHT` int(11)
,`OXROOTID` varchar(32)
,`OXSORT` int(11)
,`OXACTIVE` tinyint(1)
,`OXHIDDEN` tinyint(1)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` varchar(254)
,`OXDESC` varchar(255)
,`OXLONGDESC` text
,`OXTHUMB` varchar(128)
,`OXEXTLINK` varchar(255)
,`OXTEMPLATE` varchar(128)
,`OXDEFSORT` varchar(64)
,`OXDEFSORTMODE` tinyint(1)
,`OXPRICEFROM` double
,`OXPRICETO` double
,`OXACTIVE_1` tinyint(1)
,`OXTITLE_1` varchar(255)
,`OXDESC_1` varchar(255)
,`OXLONGDESC_1` text
,`OXACTIVE_2` tinyint(1)
,`OXTITLE_2` varchar(255)
,`OXDESC_2` varchar(255)
,`OXLONGDESC_2` text
,`OXACTIVE_3` tinyint(1)
,`OXTITLE_3` varchar(255)
,`OXDESC_3` varchar(255)
,`OXLONGDESC_3` text
,`OXICON` varchar(128)
,`OXVAT` float
,`OXSKIPDISCOUNTS` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxcategories_6`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxcategories_6` (
`OXID` varchar(32)
,`OXPARENTID` varchar(32)
,`OXLEFT` int(11)
,`OXRIGHT` int(11)
,`OXROOTID` varchar(32)
,`OXSORT` int(11)
,`OXACTIVE` tinyint(1)
,`OXHIDDEN` tinyint(1)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` varchar(254)
,`OXDESC` varchar(255)
,`OXLONGDESC` text
,`OXTHUMB` varchar(128)
,`OXEXTLINK` varchar(255)
,`OXTEMPLATE` varchar(128)
,`OXDEFSORT` varchar(64)
,`OXDEFSORTMODE` tinyint(1)
,`OXPRICEFROM` double
,`OXPRICETO` double
,`OXACTIVE_1` tinyint(1)
,`OXTITLE_1` varchar(255)
,`OXDESC_1` varchar(255)
,`OXLONGDESC_1` text
,`OXACTIVE_2` tinyint(1)
,`OXTITLE_2` varchar(255)
,`OXDESC_2` varchar(255)
,`OXLONGDESC_2` text
,`OXACTIVE_3` tinyint(1)
,`OXTITLE_3` varchar(255)
,`OXDESC_3` varchar(255)
,`OXLONGDESC_3` text
,`OXICON` varchar(128)
,`OXVAT` float
,`OXSKIPDISCOUNTS` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdeliveryset_1`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdeliveryset_1` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXPOS` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdeliveryset_2`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdeliveryset_2` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXPOS` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdeliveryset_3`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdeliveryset_3` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXPOS` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdeliveryset_4`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdeliveryset_4` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXPOS` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdeliveryset_5`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdeliveryset_5` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXPOS` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdeliveryset_6`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdeliveryset_6` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXPOS` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdelivery_1`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdelivery_1` (
`OXID` varchar(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` varchar(128)
,`OXTITLE_1` varchar(255)
,`OXTITLE_2` varchar(255)
,`OXTITLE_3` varchar(255)
,`OXADDSUMTYPE` enum('%','abs')
,`OXADDSUM` double
,`OXDELTYPE` enum('a','s','w','p')
,`OXPARAM` double
,`OXPARAMEND` double
,`OXFIXED` tinyint(1)
,`OXSORT` int(11)
,`OXFINALIZE` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdelivery_2`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdelivery_2` (
`OXID` varchar(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` varchar(128)
,`OXTITLE_1` varchar(255)
,`OXTITLE_2` varchar(255)
,`OXTITLE_3` varchar(255)
,`OXADDSUMTYPE` enum('%','abs')
,`OXADDSUM` double
,`OXDELTYPE` enum('a','s','w','p')
,`OXPARAM` double
,`OXPARAMEND` double
,`OXFIXED` tinyint(1)
,`OXSORT` int(11)
,`OXFINALIZE` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdelivery_3`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdelivery_3` (
`OXID` varchar(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` varchar(128)
,`OXTITLE_1` varchar(255)
,`OXTITLE_2` varchar(255)
,`OXTITLE_3` varchar(255)
,`OXADDSUMTYPE` enum('%','abs')
,`OXADDSUM` double
,`OXDELTYPE` enum('a','s','w','p')
,`OXPARAM` double
,`OXPARAMEND` double
,`OXFIXED` tinyint(1)
,`OXSORT` int(11)
,`OXFINALIZE` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdelivery_4`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdelivery_4` (
`OXID` varchar(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` varchar(128)
,`OXTITLE_1` varchar(255)
,`OXTITLE_2` varchar(255)
,`OXTITLE_3` varchar(255)
,`OXADDSUMTYPE` enum('%','abs')
,`OXADDSUM` double
,`OXDELTYPE` enum('a','s','w','p')
,`OXPARAM` double
,`OXPARAMEND` double
,`OXFIXED` tinyint(1)
,`OXSORT` int(11)
,`OXFINALIZE` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdelivery_5`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdelivery_5` (
`OXID` varchar(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` varchar(128)
,`OXTITLE_1` varchar(255)
,`OXTITLE_2` varchar(255)
,`OXTITLE_3` varchar(255)
,`OXADDSUMTYPE` enum('%','abs')
,`OXADDSUM` double
,`OXDELTYPE` enum('a','s','w','p')
,`OXPARAM` double
,`OXPARAMEND` double
,`OXFIXED` tinyint(1)
,`OXSORT` int(11)
,`OXFINALIZE` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdelivery_6`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdelivery_6` (
`OXID` varchar(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` varchar(128)
,`OXTITLE_1` varchar(255)
,`OXTITLE_2` varchar(255)
,`OXTITLE_3` varchar(255)
,`OXADDSUMTYPE` enum('%','abs')
,`OXADDSUM` double
,`OXDELTYPE` enum('a','s','w','p')
,`OXPARAM` double
,`OXPARAMEND` double
,`OXFIXED` tinyint(1)
,`OXSORT` int(11)
,`OXFINALIZE` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdiscount_1`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdiscount_1` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXAMOUNT` double
,`OXAMOUNTTO` double
,`OXPRICETO` double
,`OXPRICE` double
,`OXADDSUMTYPE` enum('%','abs','itm')
,`OXADDSUM` double
,`OXITMARTID` char(32)
,`OXITMAMOUNT` double
,`OXITMMULTIPLE` int(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdiscount_2`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdiscount_2` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXAMOUNT` double
,`OXAMOUNTTO` double
,`OXPRICETO` double
,`OXPRICE` double
,`OXADDSUMTYPE` enum('%','abs','itm')
,`OXADDSUM` double
,`OXITMARTID` char(32)
,`OXITMAMOUNT` double
,`OXITMMULTIPLE` int(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdiscount_3`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdiscount_3` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXAMOUNT` double
,`OXAMOUNTTO` double
,`OXPRICETO` double
,`OXPRICE` double
,`OXADDSUMTYPE` enum('%','abs','itm')
,`OXADDSUM` double
,`OXITMARTID` char(32)
,`OXITMAMOUNT` double
,`OXITMMULTIPLE` int(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdiscount_4`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdiscount_4` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXAMOUNT` double
,`OXAMOUNTTO` double
,`OXPRICETO` double
,`OXPRICE` double
,`OXADDSUMTYPE` enum('%','abs','itm')
,`OXADDSUM` double
,`OXITMARTID` char(32)
,`OXITMAMOUNT` double
,`OXITMMULTIPLE` int(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdiscount_5`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdiscount_5` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXAMOUNT` double
,`OXAMOUNTTO` double
,`OXPRICETO` double
,`OXPRICE` double
,`OXADDSUMTYPE` enum('%','abs','itm')
,`OXADDSUM` double
,`OXITMARTID` char(32)
,`OXITMAMOUNT` double
,`OXITMMULTIPLE` int(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxdiscount_6`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxdiscount_6` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXTITLE` char(128)
,`OXTITLE_1` char(128)
,`OXTITLE_2` char(128)
,`OXTITLE_3` char(128)
,`OXAMOUNT` double
,`OXAMOUNTTO` double
,`OXPRICETO` double
,`OXPRICE` double
,`OXADDSUMTYPE` enum('%','abs','itm')
,`OXADDSUM` double
,`OXITMARTID` char(32)
,`OXITMAMOUNT` double
,`OXITMMULTIPLE` int(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxlinks_1`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxlinks_1` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXURL` varchar(255)
,`OXURLDESC` text
,`OXURLDESC_1` text
,`OXURLDESC_2` text
,`OXURLDESC_3` text
,`OXURLDESC_4` text
,`OXINSERT` datetime
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxlinks_2`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxlinks_2` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXURL` varchar(255)
,`OXURLDESC` text
,`OXURLDESC_1` text
,`OXURLDESC_2` text
,`OXURLDESC_3` text
,`OXURLDESC_4` text
,`OXINSERT` datetime
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxlinks_3`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxlinks_3` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXURL` varchar(255)
,`OXURLDESC` text
,`OXURLDESC_1` text
,`OXURLDESC_2` text
,`OXURLDESC_3` text
,`OXURLDESC_4` text
,`OXINSERT` datetime
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxlinks_4`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxlinks_4` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXURL` varchar(255)
,`OXURLDESC` text
,`OXURLDESC_1` text
,`OXURLDESC_2` text
,`OXURLDESC_3` text
,`OXURLDESC_4` text
,`OXINSERT` datetime
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxlinks_5`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxlinks_5` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXURL` varchar(255)
,`OXURLDESC` text
,`OXURLDESC_1` text
,`OXURLDESC_2` text
,`OXURLDESC_3` text
,`OXURLDESC_4` text
,`OXINSERT` datetime
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxlinks_6`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxlinks_6` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXURL` varchar(255)
,`OXURLDESC` text
,`OXURLDESC_1` text
,`OXURLDESC_2` text
,`OXURLDESC_3` text
,`OXURLDESC_4` text
,`OXINSERT` datetime
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxnews_1`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxnews_1` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXDATE` date
,`OXSHORTDESC` varchar(255)
,`OXLONGDESC` text
,`OXACTIVE_1` tinyint(1)
,`OXSHORTDESC_1` varchar(255)
,`OXLONGDESC_1` text
,`OXACTIVE_2` tinyint(1)
,`OXSHORTDESC_2` varchar(255)
,`OXLONGDESC_2` text
,`OXACTIVE_3` tinyint(1)
,`OXSHORTDESC_3` varchar(255)
,`OXLONGDESC_3` text
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxnews_2`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxnews_2` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXDATE` date
,`OXSHORTDESC` varchar(255)
,`OXLONGDESC` text
,`OXACTIVE_1` tinyint(1)
,`OXSHORTDESC_1` varchar(255)
,`OXLONGDESC_1` text
,`OXACTIVE_2` tinyint(1)
,`OXSHORTDESC_2` varchar(255)
,`OXLONGDESC_2` text
,`OXACTIVE_3` tinyint(1)
,`OXSHORTDESC_3` varchar(255)
,`OXLONGDESC_3` text
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxnews_3`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxnews_3` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXDATE` date
,`OXSHORTDESC` varchar(255)
,`OXLONGDESC` text
,`OXACTIVE_1` tinyint(1)
,`OXSHORTDESC_1` varchar(255)
,`OXLONGDESC_1` text
,`OXACTIVE_2` tinyint(1)
,`OXSHORTDESC_2` varchar(255)
,`OXLONGDESC_2` text
,`OXACTIVE_3` tinyint(1)
,`OXSHORTDESC_3` varchar(255)
,`OXLONGDESC_3` text
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxnews_4`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxnews_4` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXDATE` date
,`OXSHORTDESC` varchar(255)
,`OXLONGDESC` text
,`OXACTIVE_1` tinyint(1)
,`OXSHORTDESC_1` varchar(255)
,`OXLONGDESC_1` text
,`OXACTIVE_2` tinyint(1)
,`OXSHORTDESC_2` varchar(255)
,`OXLONGDESC_2` text
,`OXACTIVE_3` tinyint(1)
,`OXSHORTDESC_3` varchar(255)
,`OXLONGDESC_3` text
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxnews_5`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxnews_5` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXDATE` date
,`OXSHORTDESC` varchar(255)
,`OXLONGDESC` text
,`OXACTIVE_1` tinyint(1)
,`OXSHORTDESC_1` varchar(255)
,`OXLONGDESC_1` text
,`OXACTIVE_2` tinyint(1)
,`OXSHORTDESC_2` varchar(255)
,`OXLONGDESC_2` text
,`OXACTIVE_3` tinyint(1)
,`OXSHORTDESC_3` varchar(255)
,`OXLONGDESC_3` text
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxnews_6`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxnews_6` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVEFROM` datetime
,`OXACTIVETO` datetime
,`OXDATE` date
,`OXSHORTDESC` varchar(255)
,`OXLONGDESC` text
,`OXACTIVE_1` tinyint(1)
,`OXSHORTDESC_1` varchar(255)
,`OXLONGDESC_1` text
,`OXACTIVE_2` tinyint(1)
,`OXSHORTDESC_2` varchar(255)
,`OXLONGDESC_2` text
,`OXACTIVE_3` tinyint(1)
,`OXSHORTDESC_3` varchar(255)
,`OXLONGDESC_3` text
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxobject2category_1`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxobject2category_1` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXOBJECTID` char(32)
,`OXCATNID` char(32)
,`OXPOS` int(11)
,`OXTIME` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxobject2category_2`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxobject2category_2` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXOBJECTID` char(32)
,`OXCATNID` char(32)
,`OXPOS` int(11)
,`OXTIME` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxobject2category_3`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxobject2category_3` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXOBJECTID` char(32)
,`OXCATNID` char(32)
,`OXPOS` int(11)
,`OXTIME` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxobject2category_4`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxobject2category_4` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXOBJECTID` char(32)
,`OXCATNID` char(32)
,`OXPOS` int(11)
,`OXTIME` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxobject2category_5`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxobject2category_5` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXOBJECTID` char(32)
,`OXCATNID` char(32)
,`OXPOS` int(11)
,`OXTIME` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxobject2category_6`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxobject2category_6` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXOBJECTID` char(32)
,`OXCATNID` char(32)
,`OXPOS` int(11)
,`OXTIME` int(11)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxselectlist_1`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxselectlist_1` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` varchar(254)
,`OXIDENT` varchar(255)
,`OXVALDESC` text
,`OXTITLE_1` varchar(255)
,`OXVALDESC_1` text
,`OXTITLE_2` varchar(255)
,`OXVALDESC_2` text
,`OXTITLE_3` varchar(255)
,`OXVALDESC_3` text
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxselectlist_2`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxselectlist_2` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` varchar(254)
,`OXIDENT` varchar(255)
,`OXVALDESC` text
,`OXTITLE_1` varchar(255)
,`OXVALDESC_1` text
,`OXTITLE_2` varchar(255)
,`OXVALDESC_2` text
,`OXTITLE_3` varchar(255)
,`OXVALDESC_3` text
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxselectlist_3`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxselectlist_3` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` varchar(254)
,`OXIDENT` varchar(255)
,`OXVALDESC` text
,`OXTITLE_1` varchar(255)
,`OXVALDESC_1` text
,`OXTITLE_2` varchar(255)
,`OXVALDESC_2` text
,`OXTITLE_3` varchar(255)
,`OXVALDESC_3` text
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxselectlist_4`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxselectlist_4` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` varchar(254)
,`OXIDENT` varchar(255)
,`OXVALDESC` text
,`OXTITLE_1` varchar(255)
,`OXVALDESC_1` text
,`OXTITLE_2` varchar(255)
,`OXVALDESC_2` text
,`OXTITLE_3` varchar(255)
,`OXVALDESC_3` text
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxselectlist_5`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxselectlist_5` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` varchar(254)
,`OXIDENT` varchar(255)
,`OXVALDESC` text
,`OXTITLE_1` varchar(255)
,`OXVALDESC_1` text
,`OXTITLE_2` varchar(255)
,`OXVALDESC_2` text
,`OXTITLE_3` varchar(255)
,`OXVALDESC_3` text
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxselectlist_6`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxselectlist_6` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXTITLE` varchar(254)
,`OXIDENT` varchar(255)
,`OXVALDESC` text
,`OXTITLE_1` varchar(255)
,`OXVALDESC_1` text
,`OXTITLE_2` varchar(255)
,`OXVALDESC_2` text
,`OXTITLE_3` varchar(255)
,`OXVALDESC_3` text
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxvendor_1`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxvendor_1` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXICON` char(128)
,`OXTITLE` char(255)
,`OXSHORTDESC` char(255)
,`OXTITLE_1` char(255)
,`OXSHORTDESC_1` char(255)
,`OXTITLE_2` char(255)
,`OXSHORTDESC_2` char(255)
,`OXTITLE_3` char(255)
,`OXSHORTDESC_3` char(255)
,`OXSHOWSUFFIX` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxvendor_2`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxvendor_2` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXICON` char(128)
,`OXTITLE` char(255)
,`OXSHORTDESC` char(255)
,`OXTITLE_1` char(255)
,`OXSHORTDESC_1` char(255)
,`OXTITLE_2` char(255)
,`OXSHORTDESC_2` char(255)
,`OXTITLE_3` char(255)
,`OXSHORTDESC_3` char(255)
,`OXSHOWSUFFIX` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxvendor_3`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxvendor_3` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXICON` char(128)
,`OXTITLE` char(255)
,`OXSHORTDESC` char(255)
,`OXTITLE_1` char(255)
,`OXSHORTDESC_1` char(255)
,`OXTITLE_2` char(255)
,`OXSHORTDESC_2` char(255)
,`OXTITLE_3` char(255)
,`OXSHORTDESC_3` char(255)
,`OXSHOWSUFFIX` tinyint(1)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxvendor_4`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxvendor_4` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXICON` char(128)
,`OXTITLE` char(255)
,`OXSHORTDESC` char(255)
,`OXTITLE_1` char(255)
,`OXSHORTDESC_1` char(255)
,`OXTITLE_2` char(255)
,`OXSHORTDESC_2` char(255)
,`OXTITLE_3` char(255)
,`OXSHORTDESC_3` char(255)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxvendor_5`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxvendor_5` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXICON` char(128)
,`OXTITLE` char(255)
,`OXSHORTDESC` char(255)
,`OXTITLE_1` char(255)
,`OXSHORTDESC_1` char(255)
,`OXTITLE_2` char(255)
,`OXSHORTDESC_2` char(255)
,`OXTITLE_3` char(255)
,`OXSHORTDESC_3` char(255)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxvendor_6`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxvendor_6` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXICON` char(128)
,`OXTITLE` char(255)
,`OXSHORTDESC` char(255)
,`OXTITLE_1` char(255)
,`OXSHORTDESC_1` char(255)
,`OXTITLE_2` char(255)
,`OXSHORTDESC_2` char(255)
,`OXTITLE_3` char(255)
,`OXSHORTDESC_3` char(255)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxvoucherseries_1`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxvoucherseries_1` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXSERIENR` varchar(255)
,`OXSERIEDESCRIPTION` varchar(255)
,`OXDISCOUNT` float(9,2)
,`OXDISCOUNTTYPE` enum('percent','absolute')
,`OXSTARTDATE` datetime
,`OXRELEASEDATE` datetime
,`OXBEGINDATE` datetime
,`OXENDDATE` datetime
,`OXALLOWSAMESERIES` tinyint(1)
,`OXALLOWOTHERSERIES` tinyint(1)
,`OXALLOWUSEANOTHER` tinyint(1)
,`OXMINIMUMVALUE` float(9,2)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxvoucherseries_2`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxvoucherseries_2` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXSERIENR` varchar(255)
,`OXSERIEDESCRIPTION` varchar(255)
,`OXDISCOUNT` float(9,2)
,`OXDISCOUNTTYPE` enum('percent','absolute')
,`OXSTARTDATE` datetime
,`OXRELEASEDATE` datetime
,`OXBEGINDATE` datetime
,`OXENDDATE` datetime
,`OXALLOWSAMESERIES` tinyint(1)
,`OXALLOWOTHERSERIES` tinyint(1)
,`OXALLOWUSEANOTHER` tinyint(1)
,`OXMINIMUMVALUE` float(9,2)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxvoucherseries_3`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxvoucherseries_3` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXSERIENR` varchar(255)
,`OXSERIEDESCRIPTION` varchar(255)
,`OXDISCOUNT` float(9,2)
,`OXDISCOUNTTYPE` enum('percent','absolute')
,`OXSTARTDATE` datetime
,`OXRELEASEDATE` datetime
,`OXBEGINDATE` datetime
,`OXENDDATE` datetime
,`OXALLOWSAMESERIES` tinyint(1)
,`OXALLOWOTHERSERIES` tinyint(1)
,`OXALLOWUSEANOTHER` tinyint(1)
,`OXMINIMUMVALUE` float(9,2)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxvoucherseries_4`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxvoucherseries_4` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXSERIENR` varchar(255)
,`OXSERIEDESCRIPTION` varchar(255)
,`OXDISCOUNT` float(9,2)
,`OXDISCOUNTTYPE` enum('percent','absolute')
,`OXSTARTDATE` datetime
,`OXRELEASEDATE` datetime
,`OXBEGINDATE` datetime
,`OXENDDATE` datetime
,`OXALLOWSAMESERIES` tinyint(1)
,`OXALLOWOTHERSERIES` tinyint(1)
,`OXALLOWUSEANOTHER` tinyint(1)
,`OXMINIMUMVALUE` float(9,2)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxvoucherseries_5`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxvoucherseries_5` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXSERIENR` varchar(255)
,`OXSERIEDESCRIPTION` varchar(255)
,`OXDISCOUNT` float(9,2)
,`OXDISCOUNTTYPE` enum('percent','absolute')
,`OXSTARTDATE` datetime
,`OXRELEASEDATE` datetime
,`OXBEGINDATE` datetime
,`OXENDDATE` datetime
,`OXALLOWSAMESERIES` tinyint(1)
,`OXALLOWOTHERSERIES` tinyint(1)
,`OXALLOWUSEANOTHER` tinyint(1)
,`OXMINIMUMVALUE` float(9,2)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxvoucherseries_6`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxvoucherseries_6` (
`OXID` char(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXSERIENR` varchar(255)
,`OXSERIEDESCRIPTION` varchar(255)
,`OXDISCOUNT` float(9,2)
,`OXDISCOUNTTYPE` enum('percent','absolute')
,`OXSTARTDATE` datetime
,`OXRELEASEDATE` datetime
,`OXBEGINDATE` datetime
,`OXENDDATE` datetime
,`OXALLOWSAMESERIES` tinyint(1)
,`OXALLOWOTHERSERIES` tinyint(1)
,`OXALLOWUSEANOTHER` tinyint(1)
,`OXMINIMUMVALUE` float(9,2)
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxwrapping_1`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxwrapping_1` (
`OXID` varchar(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVE_1` tinyint(1)
,`OXACTIVE_2` tinyint(1)
,`OXACTIVE_3` tinyint(1)
,`OXTYPE` varchar(4)
,`OXNAME` varchar(128)
,`OXNAME_1` varchar(128)
,`OXNAME_2` varchar(128)
,`OXNAME_3` varchar(128)
,`OXPIC` varchar(128)
,`OXPRICE` double
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxwrapping_2`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxwrapping_2` (
`OXID` varchar(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVE_1` tinyint(1)
,`OXACTIVE_2` tinyint(1)
,`OXACTIVE_3` tinyint(1)
,`OXTYPE` varchar(4)
,`OXNAME` varchar(128)
,`OXNAME_1` varchar(128)
,`OXNAME_2` varchar(128)
,`OXNAME_3` varchar(128)
,`OXPIC` varchar(128)
,`OXPRICE` double
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxwrapping_3`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxwrapping_3` (
`OXID` varchar(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVE_1` tinyint(1)
,`OXACTIVE_2` tinyint(1)
,`OXACTIVE_3` tinyint(1)
,`OXTYPE` varchar(4)
,`OXNAME` varchar(128)
,`OXNAME_1` varchar(128)
,`OXNAME_2` varchar(128)
,`OXNAME_3` varchar(128)
,`OXPIC` varchar(128)
,`OXPRICE` double
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxwrapping_4`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxwrapping_4` (
`OXID` varchar(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVE_1` tinyint(1)
,`OXACTIVE_2` tinyint(1)
,`OXACTIVE_3` tinyint(1)
,`OXTYPE` varchar(4)
,`OXNAME` varchar(128)
,`OXNAME_1` varchar(128)
,`OXNAME_2` varchar(128)
,`OXNAME_3` varchar(128)
,`OXPIC` varchar(128)
,`OXPRICE` double
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxwrapping_5`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxwrapping_5` (
`OXID` varchar(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVE_1` tinyint(1)
,`OXACTIVE_2` tinyint(1)
,`OXACTIVE_3` tinyint(1)
,`OXTYPE` varchar(4)
,`OXNAME` varchar(128)
,`OXNAME_1` varchar(128)
,`OXNAME_2` varchar(128)
,`OXNAME_3` varchar(128)
,`OXPIC` varchar(128)
,`OXPRICE` double
);
-- --------------------------------------------------------

-- 
-- Stand-in structure for view `oxv_oxwrapping_6`
-- 
CREATE TABLE IF NOT EXISTS `oxv_oxwrapping_6` (
`OXID` varchar(32)
,`OXSHOPID` int(11)
,`OXSHOPINCL` bigint(20) unsigned
,`OXSHOPEXCL` bigint(20) unsigned
,`OXACTIVE` tinyint(1)
,`OXACTIVE_1` tinyint(1)
,`OXACTIVE_2` tinyint(1)
,`OXACTIVE_3` tinyint(1)
,`OXTYPE` varchar(4)
,`OXNAME` varchar(128)
,`OXNAME_1` varchar(128)
,`OXNAME_2` varchar(128)
,`OXNAME_3` varchar(128)
,`OXPIC` varchar(128)
,`OXPRICE` double
);
-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `oxwrapping`
-- 

DROP TABLE IF EXISTS `oxwrapping`;
CREATE TABLE IF NOT EXISTS `oxwrapping` (
  `OXID` varchar(32) collate latin1_general_ci NOT NULL default '',
  `OXSHOPID` int(11) NOT NULL default '1',
  `OXSHOPINCL` bigint(20) unsigned NOT NULL default '0',
  `OXSHOPEXCL` bigint(20) unsigned NOT NULL default '0',
  `OXACTIVE` tinyint(1) NOT NULL default '1',
  `OXACTIVE_1` tinyint(1) NOT NULL default '1',
  `OXACTIVE_2` tinyint(1) NOT NULL default '1',
  `OXACTIVE_3` tinyint(1) NOT NULL default '1',
  `OXTYPE` varchar(4) collate latin1_general_ci NOT NULL default 'WRAP',
  `OXNAME` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXNAME_1` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXNAME_2` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXNAME_3` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPIC` varchar(128) collate latin1_general_ci NOT NULL default '',
  `OXPRICE` double NOT NULL default '0',
  PRIMARY KEY  (`OXID`),
  KEY `OXSHOPID` (`OXSHOPID`),
  KEY `OXSHOPINCL` (`OXSHOPINCL`),
  KEY `OXSHOPEXCL` (`OXSHOPEXCL`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Sukurta duomenų kopija lentelei `oxwrapping`
-- 

INSERT INTO `oxwrapping` VALUES ('a6840cc0ec80b3991.74884864', 1, 1, 0, 1, 1, 1, 1, 'WRAP', 'Rote Sterne', 'Red stars', '', '', 'img_geschenkpapier_1_wp.gif', 2.95);
INSERT INTO `oxwrapping` VALUES ('81b40cf076351c229.14252649', 1, 1, 0, 1, 1, 1, 1, 'CARD', 'Die Bombe', 'The bomb', '', '', 'desaster_wp.gif', 2.5);
INSERT INTO `oxwrapping` VALUES ('81b40cf0cd383d3a9.70988998', 1, 1, 0, 1, 1, 1, 1, 'CARD', 'Haifisch', 'Shark', '', '', 'img_ecard_03_wp.jpg', 3);
INSERT INTO `oxwrapping` VALUES ('81b40cf210343d625.49755120', 1, 1, 0, 1, 1, 1, 1, 'WRAP', 'Gelbe Sterne', 'Yellow stars', '', '', 'img_geschenkpapier_1_gelb_wp.gif', 2.95);

-- --------------------------------------------------------

-- 
-- Sukurta duomenų struktūra lentelei `test`
-- 

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id` int(11) NOT NULL auto_increment,
  `value` char(252) collate latin1_general_ci NOT NULL,
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `value` (`value`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

-- 
-- Sukurta duomenų kopija lentelei `test`
-- 

INSERT INTO `test` VALUES (1, '%2B%2A-5 labas;vakaras');
INSERT INTO `test` VALUES (2, '+5 -5  +-5  %2B%2A-5');
INSERT INTO `test` VALUES (3, 'labas vakaras');
INSERT INTO `test` VALUES (4, 'huhuhu cia yra full textas boom labas vakaras');
INSERT INTO `test` VALUES (5, '%2B%2A-5 labas;vakaras full text vakaras');
INSERT INTO `test` VALUES (6, 'labas labas labas');

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxarticles_1`
-- 
DROP TABLE IF EXISTS `oxv_oxarticles_1`;

DROP VIEW IF EXISTS `oxv_oxarticles_1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxarticles_1` AS select `eshop_ee`.`oxarticles`.`OXID` AS `OXID`,`eshop_ee`.`oxarticles`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxarticles`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxarticles`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxarticles`.`OXPARENTID` AS `OXPARENTID`,`eshop_ee`.`oxarticles`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxarticles`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxarticles`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxarticles`.`OXARTNUM` AS `OXARTNUM`,`eshop_ee`.`oxarticles`.`OXEAN` AS `OXEAN`,`eshop_ee`.`oxarticles`.`OXDISTEAN` AS `OXDISTEAN`,`eshop_ee`.`oxarticles`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxarticles`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxarticles`.`OXPRICE` AS `OXPRICE`,`eshop_ee`.`oxarticles`.`OXBLFIXEDPRICE` AS `OXBLFIXEDPRICE`,`eshop_ee`.`oxarticles`.`OXPRICEA` AS `OXPRICEA`,`eshop_ee`.`oxarticles`.`OXPRICEB` AS `OXPRICEB`,`eshop_ee`.`oxarticles`.`OXPRICEC` AS `OXPRICEC`,`eshop_ee`.`oxarticles`.`OXBPRICE` AS `OXBPRICE`,`eshop_ee`.`oxarticles`.`OXTPRICE` AS `OXTPRICE`,`eshop_ee`.`oxarticles`.`OXUNITNAME` AS `OXUNITNAME`,`eshop_ee`.`oxarticles`.`OXUNITQUANTITY` AS `OXUNITQUANTITY`,`eshop_ee`.`oxarticles`.`OXEXTURL` AS `OXEXTURL`,`eshop_ee`.`oxarticles`.`OXURLDESC` AS `OXURLDESC`,`eshop_ee`.`oxarticles`.`OXURLIMG` AS `OXURLIMG`,`eshop_ee`.`oxarticles`.`OXVAT` AS `OXVAT`,`eshop_ee`.`oxarticles`.`OXTHUMB` AS `OXTHUMB`,`eshop_ee`.`oxarticles`.`OXICON` AS `OXICON`,`eshop_ee`.`oxarticles`.`OXPIC1` AS `OXPIC1`,`eshop_ee`.`oxarticles`.`OXPIC2` AS `OXPIC2`,`eshop_ee`.`oxarticles`.`OXPIC3` AS `OXPIC3`,`eshop_ee`.`oxarticles`.`OXPIC4` AS `OXPIC4`,`eshop_ee`.`oxarticles`.`OXPIC5` AS `OXPIC5`,`eshop_ee`.`oxarticles`.`OXPIC6` AS `OXPIC6`,`eshop_ee`.`oxarticles`.`OXPIC7` AS `OXPIC7`,`eshop_ee`.`oxarticles`.`OXPIC8` AS `OXPIC8`,`eshop_ee`.`oxarticles`.`OXPIC9` AS `OXPIC9`,`eshop_ee`.`oxarticles`.`OXPIC10` AS `OXPIC10`,`eshop_ee`.`oxarticles`.`OXPIC11` AS `OXPIC11`,`eshop_ee`.`oxarticles`.`OXPIC12` AS `OXPIC12`,`eshop_ee`.`oxarticles`.`OXZOOM1` AS `OXZOOM1`,`eshop_ee`.`oxarticles`.`OXZOOM2` AS `OXZOOM2`,`eshop_ee`.`oxarticles`.`OXZOOM3` AS `OXZOOM3`,`eshop_ee`.`oxarticles`.`OXZOOM4` AS `OXZOOM4`,`eshop_ee`.`oxarticles`.`OXWEIGHT` AS `OXWEIGHT`,`eshop_ee`.`oxarticles`.`OXSTOCK` AS `OXSTOCK`,`eshop_ee`.`oxarticles`.`OXSTOCKFLAG` AS `OXSTOCKFLAG`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT` AS `OXSTOCKTEXT`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT` AS `OXNOSTOCKTEXT`,`eshop_ee`.`oxarticles`.`OXDELIVERY` AS `OXDELIVERY`,`eshop_ee`.`oxarticles`.`OXINSERT` AS `OXINSERT`,`eshop_ee`.`oxarticles`.`OXTIMESTAMP` AS `OXTIMESTAMP`,`eshop_ee`.`oxarticles`.`OXLENGTH` AS `OXLENGTH`,`eshop_ee`.`oxarticles`.`OXWIDTH` AS `OXWIDTH`,`eshop_ee`.`oxarticles`.`OXHEIGHT` AS `OXHEIGHT`,`eshop_ee`.`oxarticles`.`OXFILE` AS `OXFILE`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS` AS `OXSEARCHKEYS`,`eshop_ee`.`oxarticles`.`OXTEMPLATE` AS `OXTEMPLATE`,`eshop_ee`.`oxarticles`.`OXQUESTIONEMAIL` AS `OXQUESTIONEMAIL`,`eshop_ee`.`oxarticles`.`OXISSEARCH` AS `OXISSEARCH`,`eshop_ee`.`oxarticles`.`OXVARNAME` AS `OXVARNAME`,`eshop_ee`.`oxarticles`.`OXVARSTOCK` AS `OXVARSTOCK`,`eshop_ee`.`oxarticles`.`OXVARCOUNT` AS `OXVARCOUNT`,`eshop_ee`.`oxarticles`.`OXVARSELECT` AS `OXVARSELECT`,`eshop_ee`.`oxarticles`.`OXVARMINPRICE` AS `OXVARMINPRICE`,`eshop_ee`.`oxarticles`.`OXVARNAME_1` AS `OXVARNAME_1`,`eshop_ee`.`oxarticles`.`OXVARSELECT_1` AS `OXVARSELECT_1`,`eshop_ee`.`oxarticles`.`OXVARNAME_2` AS `OXVARNAME_2`,`eshop_ee`.`oxarticles`.`OXVARSELECT_2` AS `OXVARSELECT_2`,`eshop_ee`.`oxarticles`.`OXVARNAME_3` AS `OXVARNAME_3`,`eshop_ee`.`oxarticles`.`OXVARSELECT_3` AS `OXVARSELECT_3`,`eshop_ee`.`oxarticles`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxarticles`.`OXURLDESC_1` AS `OXURLDESC_1`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_1` AS `OXSEARCHKEYS_1`,`eshop_ee`.`oxarticles`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxarticles`.`OXURLDESC_2` AS `OXURLDESC_2`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_2` AS `OXSEARCHKEYS_2`,`eshop_ee`.`oxarticles`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxarticles`.`OXURLDESC_3` AS `OXURLDESC_3`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_3` AS `OXSEARCHKEYS_3`,`eshop_ee`.`oxarticles`.`OXFOLDER` AS `OXFOLDER`,`eshop_ee`.`oxarticles`.`OXSUBCLASS` AS `OXSUBCLASS`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_1` AS `OXSTOCKTEXT_1`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_2` AS `OXSTOCKTEXT_2`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_3` AS `OXSTOCKTEXT_3`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_1` AS `OXNOSTOCKTEXT_1`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_2` AS `OXNOSTOCKTEXT_2`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_3` AS `OXNOSTOCKTEXT_3`,`eshop_ee`.`oxarticles`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxarticles`.`OXSOLDAMOUNT` AS `OXSOLDAMOUNT`,`eshop_ee`.`oxarticles`.`OXNONMATERIAL` AS `OXNONMATERIAL`,`eshop_ee`.`oxarticles`.`OXFREESHIPPING` AS `OXFREESHIPPING`,`eshop_ee`.`oxarticles`.`OXREMINDACTIV` AS `OXREMINDACTIV`,`eshop_ee`.`oxarticles`.`OXREMINDAMOUNT` AS `OXREMINDAMOUNT`,`eshop_ee`.`oxarticles`.`OXAMITEMID` AS `OXAMITEMID`,`eshop_ee`.`oxarticles`.`OXAMTASKID` AS `OXAMTASKID`,`eshop_ee`.`oxarticles`.`OXVENDORID` AS `OXVENDORID`,`eshop_ee`.`oxarticles`.`OXSKIPDISCOUNTS` AS `OXSKIPDISCOUNTS`,`eshop_ee`.`oxarticles`.`OXORDERINFO` AS `OXORDERINFO`,`eshop_ee`.`oxarticles`.`OXPIXIEXPORT` AS `OXPIXIEXPORT`,`eshop_ee`.`oxarticles`.`OXPIXIEXPORTED` AS `OXPIXIEXPORTED`,`eshop_ee`.`oxarticles`.`OXVPE` AS `OXVPE`,`eshop_ee`.`oxarticles`.`OXRATING` AS `OXRATING`,`eshop_ee`.`oxarticles`.`OXRATINGCNT` AS `OXRATINGCNT` from `eshop_ee`.`oxarticles` where (((`eshop_ee`.`oxarticles`.`OXSHOPINCL` & 1) > 0) and ((`eshop_ee`.`oxarticles`.`OXSHOPEXCL` & 1) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxarticles_2`
-- 
DROP TABLE IF EXISTS `oxv_oxarticles_2`;

DROP VIEW IF EXISTS `oxv_oxarticles_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxarticles_2` AS select `eshop_ee`.`oxarticles`.`OXID` AS `OXID`,`eshop_ee`.`oxarticles`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxarticles`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxarticles`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxarticles`.`OXPARENTID` AS `OXPARENTID`,`eshop_ee`.`oxarticles`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxarticles`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxarticles`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxarticles`.`OXARTNUM` AS `OXARTNUM`,`eshop_ee`.`oxarticles`.`OXEAN` AS `OXEAN`,`eshop_ee`.`oxarticles`.`OXDISTEAN` AS `OXDISTEAN`,`eshop_ee`.`oxarticles`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxarticles`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxarticles`.`OXPRICE` AS `OXPRICE`,`eshop_ee`.`oxarticles`.`OXBLFIXEDPRICE` AS `OXBLFIXEDPRICE`,`eshop_ee`.`oxarticles`.`OXPRICEA` AS `OXPRICEA`,`eshop_ee`.`oxarticles`.`OXPRICEB` AS `OXPRICEB`,`eshop_ee`.`oxarticles`.`OXPRICEC` AS `OXPRICEC`,`eshop_ee`.`oxarticles`.`OXBPRICE` AS `OXBPRICE`,`eshop_ee`.`oxarticles`.`OXTPRICE` AS `OXTPRICE`,`eshop_ee`.`oxarticles`.`OXUNITNAME` AS `OXUNITNAME`,`eshop_ee`.`oxarticles`.`OXUNITQUANTITY` AS `OXUNITQUANTITY`,`eshop_ee`.`oxarticles`.`OXEXTURL` AS `OXEXTURL`,`eshop_ee`.`oxarticles`.`OXURLDESC` AS `OXURLDESC`,`eshop_ee`.`oxarticles`.`OXURLIMG` AS `OXURLIMG`,`eshop_ee`.`oxarticles`.`OXVAT` AS `OXVAT`,`eshop_ee`.`oxarticles`.`OXTHUMB` AS `OXTHUMB`,`eshop_ee`.`oxarticles`.`OXICON` AS `OXICON`,`eshop_ee`.`oxarticles`.`OXPIC1` AS `OXPIC1`,`eshop_ee`.`oxarticles`.`OXPIC2` AS `OXPIC2`,`eshop_ee`.`oxarticles`.`OXPIC3` AS `OXPIC3`,`eshop_ee`.`oxarticles`.`OXPIC4` AS `OXPIC4`,`eshop_ee`.`oxarticles`.`OXPIC5` AS `OXPIC5`,`eshop_ee`.`oxarticles`.`OXPIC6` AS `OXPIC6`,`eshop_ee`.`oxarticles`.`OXPIC7` AS `OXPIC7`,`eshop_ee`.`oxarticles`.`OXPIC8` AS `OXPIC8`,`eshop_ee`.`oxarticles`.`OXPIC9` AS `OXPIC9`,`eshop_ee`.`oxarticles`.`OXPIC10` AS `OXPIC10`,`eshop_ee`.`oxarticles`.`OXPIC11` AS `OXPIC11`,`eshop_ee`.`oxarticles`.`OXPIC12` AS `OXPIC12`,`eshop_ee`.`oxarticles`.`OXZOOM1` AS `OXZOOM1`,`eshop_ee`.`oxarticles`.`OXZOOM2` AS `OXZOOM2`,`eshop_ee`.`oxarticles`.`OXZOOM3` AS `OXZOOM3`,`eshop_ee`.`oxarticles`.`OXZOOM4` AS `OXZOOM4`,`eshop_ee`.`oxarticles`.`OXWEIGHT` AS `OXWEIGHT`,`eshop_ee`.`oxarticles`.`OXSTOCK` AS `OXSTOCK`,`eshop_ee`.`oxarticles`.`OXSTOCKFLAG` AS `OXSTOCKFLAG`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT` AS `OXSTOCKTEXT`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT` AS `OXNOSTOCKTEXT`,`eshop_ee`.`oxarticles`.`OXDELIVERY` AS `OXDELIVERY`,`eshop_ee`.`oxarticles`.`OXINSERT` AS `OXINSERT`,`eshop_ee`.`oxarticles`.`OXTIMESTAMP` AS `OXTIMESTAMP`,`eshop_ee`.`oxarticles`.`OXLENGTH` AS `OXLENGTH`,`eshop_ee`.`oxarticles`.`OXWIDTH` AS `OXWIDTH`,`eshop_ee`.`oxarticles`.`OXHEIGHT` AS `OXHEIGHT`,`eshop_ee`.`oxarticles`.`OXFILE` AS `OXFILE`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS` AS `OXSEARCHKEYS`,`eshop_ee`.`oxarticles`.`OXTEMPLATE` AS `OXTEMPLATE`,`eshop_ee`.`oxarticles`.`OXQUESTIONEMAIL` AS `OXQUESTIONEMAIL`,`eshop_ee`.`oxarticles`.`OXISSEARCH` AS `OXISSEARCH`,`eshop_ee`.`oxarticles`.`OXVARNAME` AS `OXVARNAME`,`eshop_ee`.`oxarticles`.`OXVARSTOCK` AS `OXVARSTOCK`,`eshop_ee`.`oxarticles`.`OXVARCOUNT` AS `OXVARCOUNT`,`eshop_ee`.`oxarticles`.`OXVARSELECT` AS `OXVARSELECT`,`eshop_ee`.`oxarticles`.`OXVARMINPRICE` AS `OXVARMINPRICE`,`eshop_ee`.`oxarticles`.`OXVARNAME_1` AS `OXVARNAME_1`,`eshop_ee`.`oxarticles`.`OXVARSELECT_1` AS `OXVARSELECT_1`,`eshop_ee`.`oxarticles`.`OXVARNAME_2` AS `OXVARNAME_2`,`eshop_ee`.`oxarticles`.`OXVARSELECT_2` AS `OXVARSELECT_2`,`eshop_ee`.`oxarticles`.`OXVARNAME_3` AS `OXVARNAME_3`,`eshop_ee`.`oxarticles`.`OXVARSELECT_3` AS `OXVARSELECT_3`,`eshop_ee`.`oxarticles`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxarticles`.`OXURLDESC_1` AS `OXURLDESC_1`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_1` AS `OXSEARCHKEYS_1`,`eshop_ee`.`oxarticles`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxarticles`.`OXURLDESC_2` AS `OXURLDESC_2`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_2` AS `OXSEARCHKEYS_2`,`eshop_ee`.`oxarticles`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxarticles`.`OXURLDESC_3` AS `OXURLDESC_3`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_3` AS `OXSEARCHKEYS_3`,`eshop_ee`.`oxarticles`.`OXFOLDER` AS `OXFOLDER`,`eshop_ee`.`oxarticles`.`OXSUBCLASS` AS `OXSUBCLASS`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_1` AS `OXSTOCKTEXT_1`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_2` AS `OXSTOCKTEXT_2`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_3` AS `OXSTOCKTEXT_3`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_1` AS `OXNOSTOCKTEXT_1`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_2` AS `OXNOSTOCKTEXT_2`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_3` AS `OXNOSTOCKTEXT_3`,`eshop_ee`.`oxarticles`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxarticles`.`OXSOLDAMOUNT` AS `OXSOLDAMOUNT`,`eshop_ee`.`oxarticles`.`OXNONMATERIAL` AS `OXNONMATERIAL`,`eshop_ee`.`oxarticles`.`OXFREESHIPPING` AS `OXFREESHIPPING`,`eshop_ee`.`oxarticles`.`OXREMINDACTIV` AS `OXREMINDACTIV`,`eshop_ee`.`oxarticles`.`OXREMINDAMOUNT` AS `OXREMINDAMOUNT`,`eshop_ee`.`oxarticles`.`OXAMITEMID` AS `OXAMITEMID`,`eshop_ee`.`oxarticles`.`OXAMTASKID` AS `OXAMTASKID`,`eshop_ee`.`oxarticles`.`OXVENDORID` AS `OXVENDORID`,`eshop_ee`.`oxarticles`.`OXSKIPDISCOUNTS` AS `OXSKIPDISCOUNTS`,`eshop_ee`.`oxarticles`.`OXORDERINFO` AS `OXORDERINFO`,`eshop_ee`.`oxarticles`.`OXPIXIEXPORT` AS `OXPIXIEXPORT`,`eshop_ee`.`oxarticles`.`OXPIXIEXPORTED` AS `OXPIXIEXPORTED`,`eshop_ee`.`oxarticles`.`OXVPE` AS `OXVPE`,`eshop_ee`.`oxarticles`.`OXRATING` AS `OXRATING`,`eshop_ee`.`oxarticles`.`OXRATINGCNT` AS `OXRATINGCNT` from `eshop_ee`.`oxarticles` where (((`eshop_ee`.`oxarticles`.`OXSHOPINCL` & 2) > 0) and ((`eshop_ee`.`oxarticles`.`OXSHOPEXCL` & 2) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxarticles_3`
-- 
DROP TABLE IF EXISTS `oxv_oxarticles_3`;

DROP VIEW IF EXISTS `oxv_oxarticles_3`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxarticles_3` AS select `eshop_ee`.`oxarticles`.`OXID` AS `OXID`,`eshop_ee`.`oxarticles`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxarticles`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxarticles`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxarticles`.`OXPARENTID` AS `OXPARENTID`,`eshop_ee`.`oxarticles`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxarticles`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxarticles`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxarticles`.`OXARTNUM` AS `OXARTNUM`,`eshop_ee`.`oxarticles`.`OXEAN` AS `OXEAN`,`eshop_ee`.`oxarticles`.`OXDISTEAN` AS `OXDISTEAN`,`eshop_ee`.`oxarticles`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxarticles`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxarticles`.`OXPRICE` AS `OXPRICE`,`eshop_ee`.`oxarticles`.`OXBLFIXEDPRICE` AS `OXBLFIXEDPRICE`,`eshop_ee`.`oxarticles`.`OXPRICEA` AS `OXPRICEA`,`eshop_ee`.`oxarticles`.`OXPRICEB` AS `OXPRICEB`,`eshop_ee`.`oxarticles`.`OXPRICEC` AS `OXPRICEC`,`eshop_ee`.`oxarticles`.`OXBPRICE` AS `OXBPRICE`,`eshop_ee`.`oxarticles`.`OXTPRICE` AS `OXTPRICE`,`eshop_ee`.`oxarticles`.`OXUNITNAME` AS `OXUNITNAME`,`eshop_ee`.`oxarticles`.`OXUNITQUANTITY` AS `OXUNITQUANTITY`,`eshop_ee`.`oxarticles`.`OXEXTURL` AS `OXEXTURL`,`eshop_ee`.`oxarticles`.`OXURLDESC` AS `OXURLDESC`,`eshop_ee`.`oxarticles`.`OXURLIMG` AS `OXURLIMG`,`eshop_ee`.`oxarticles`.`OXVAT` AS `OXVAT`,`eshop_ee`.`oxarticles`.`OXTHUMB` AS `OXTHUMB`,`eshop_ee`.`oxarticles`.`OXICON` AS `OXICON`,`eshop_ee`.`oxarticles`.`OXPIC1` AS `OXPIC1`,`eshop_ee`.`oxarticles`.`OXPIC2` AS `OXPIC2`,`eshop_ee`.`oxarticles`.`OXPIC3` AS `OXPIC3`,`eshop_ee`.`oxarticles`.`OXPIC4` AS `OXPIC4`,`eshop_ee`.`oxarticles`.`OXPIC5` AS `OXPIC5`,`eshop_ee`.`oxarticles`.`OXPIC6` AS `OXPIC6`,`eshop_ee`.`oxarticles`.`OXPIC7` AS `OXPIC7`,`eshop_ee`.`oxarticles`.`OXPIC8` AS `OXPIC8`,`eshop_ee`.`oxarticles`.`OXPIC9` AS `OXPIC9`,`eshop_ee`.`oxarticles`.`OXPIC10` AS `OXPIC10`,`eshop_ee`.`oxarticles`.`OXPIC11` AS `OXPIC11`,`eshop_ee`.`oxarticles`.`OXPIC12` AS `OXPIC12`,`eshop_ee`.`oxarticles`.`OXZOOM1` AS `OXZOOM1`,`eshop_ee`.`oxarticles`.`OXZOOM2` AS `OXZOOM2`,`eshop_ee`.`oxarticles`.`OXZOOM3` AS `OXZOOM3`,`eshop_ee`.`oxarticles`.`OXZOOM4` AS `OXZOOM4`,`eshop_ee`.`oxarticles`.`OXWEIGHT` AS `OXWEIGHT`,`eshop_ee`.`oxarticles`.`OXSTOCK` AS `OXSTOCK`,`eshop_ee`.`oxarticles`.`OXSTOCKFLAG` AS `OXSTOCKFLAG`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT` AS `OXSTOCKTEXT`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT` AS `OXNOSTOCKTEXT`,`eshop_ee`.`oxarticles`.`OXDELIVERY` AS `OXDELIVERY`,`eshop_ee`.`oxarticles`.`OXINSERT` AS `OXINSERT`,`eshop_ee`.`oxarticles`.`OXTIMESTAMP` AS `OXTIMESTAMP`,`eshop_ee`.`oxarticles`.`OXLENGTH` AS `OXLENGTH`,`eshop_ee`.`oxarticles`.`OXWIDTH` AS `OXWIDTH`,`eshop_ee`.`oxarticles`.`OXHEIGHT` AS `OXHEIGHT`,`eshop_ee`.`oxarticles`.`OXFILE` AS `OXFILE`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS` AS `OXSEARCHKEYS`,`eshop_ee`.`oxarticles`.`OXTEMPLATE` AS `OXTEMPLATE`,`eshop_ee`.`oxarticles`.`OXQUESTIONEMAIL` AS `OXQUESTIONEMAIL`,`eshop_ee`.`oxarticles`.`OXISSEARCH` AS `OXISSEARCH`,`eshop_ee`.`oxarticles`.`OXVARNAME` AS `OXVARNAME`,`eshop_ee`.`oxarticles`.`OXVARSTOCK` AS `OXVARSTOCK`,`eshop_ee`.`oxarticles`.`OXVARCOUNT` AS `OXVARCOUNT`,`eshop_ee`.`oxarticles`.`OXVARSELECT` AS `OXVARSELECT`,`eshop_ee`.`oxarticles`.`OXVARMINPRICE` AS `OXVARMINPRICE`,`eshop_ee`.`oxarticles`.`OXVARNAME_1` AS `OXVARNAME_1`,`eshop_ee`.`oxarticles`.`OXVARSELECT_1` AS `OXVARSELECT_1`,`eshop_ee`.`oxarticles`.`OXVARNAME_2` AS `OXVARNAME_2`,`eshop_ee`.`oxarticles`.`OXVARSELECT_2` AS `OXVARSELECT_2`,`eshop_ee`.`oxarticles`.`OXVARNAME_3` AS `OXVARNAME_3`,`eshop_ee`.`oxarticles`.`OXVARSELECT_3` AS `OXVARSELECT_3`,`eshop_ee`.`oxarticles`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxarticles`.`OXURLDESC_1` AS `OXURLDESC_1`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_1` AS `OXSEARCHKEYS_1`,`eshop_ee`.`oxarticles`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxarticles`.`OXURLDESC_2` AS `OXURLDESC_2`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_2` AS `OXSEARCHKEYS_2`,`eshop_ee`.`oxarticles`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxarticles`.`OXURLDESC_3` AS `OXURLDESC_3`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_3` AS `OXSEARCHKEYS_3`,`eshop_ee`.`oxarticles`.`OXFOLDER` AS `OXFOLDER`,`eshop_ee`.`oxarticles`.`OXSUBCLASS` AS `OXSUBCLASS`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_1` AS `OXSTOCKTEXT_1`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_2` AS `OXSTOCKTEXT_2`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_3` AS `OXSTOCKTEXT_3`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_1` AS `OXNOSTOCKTEXT_1`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_2` AS `OXNOSTOCKTEXT_2`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_3` AS `OXNOSTOCKTEXT_3`,`eshop_ee`.`oxarticles`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxarticles`.`OXSOLDAMOUNT` AS `OXSOLDAMOUNT`,`eshop_ee`.`oxarticles`.`OXNONMATERIAL` AS `OXNONMATERIAL`,`eshop_ee`.`oxarticles`.`OXFREESHIPPING` AS `OXFREESHIPPING`,`eshop_ee`.`oxarticles`.`OXREMINDACTIV` AS `OXREMINDACTIV`,`eshop_ee`.`oxarticles`.`OXREMINDAMOUNT` AS `OXREMINDAMOUNT`,`eshop_ee`.`oxarticles`.`OXAMITEMID` AS `OXAMITEMID`,`eshop_ee`.`oxarticles`.`OXAMTASKID` AS `OXAMTASKID`,`eshop_ee`.`oxarticles`.`OXVENDORID` AS `OXVENDORID`,`eshop_ee`.`oxarticles`.`OXSKIPDISCOUNTS` AS `OXSKIPDISCOUNTS`,`eshop_ee`.`oxarticles`.`OXORDERINFO` AS `OXORDERINFO`,`eshop_ee`.`oxarticles`.`OXPIXIEXPORT` AS `OXPIXIEXPORT`,`eshop_ee`.`oxarticles`.`OXPIXIEXPORTED` AS `OXPIXIEXPORTED`,`eshop_ee`.`oxarticles`.`OXVPE` AS `OXVPE`,`eshop_ee`.`oxarticles`.`OXRATING` AS `OXRATING`,`eshop_ee`.`oxarticles`.`OXRATINGCNT` AS `OXRATINGCNT` from `eshop_ee`.`oxarticles` where (((`eshop_ee`.`oxarticles`.`OXSHOPINCL` & 5) > 0) and ((`eshop_ee`.`oxarticles`.`OXSHOPEXCL` & 4) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxarticles_4`
-- 
DROP TABLE IF EXISTS `oxv_oxarticles_4`;

DROP VIEW IF EXISTS `oxv_oxarticles_4`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxarticles_4` AS select `eshop_ee`.`oxarticles`.`OXID` AS `OXID`,`eshop_ee`.`oxarticles`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxarticles`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxarticles`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxarticles`.`OXPARENTID` AS `OXPARENTID`,`eshop_ee`.`oxarticles`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxarticles`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxarticles`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxarticles`.`OXARTNUM` AS `OXARTNUM`,`eshop_ee`.`oxarticles`.`OXEAN` AS `OXEAN`,`eshop_ee`.`oxarticles`.`OXDISTEAN` AS `OXDISTEAN`,`eshop_ee`.`oxarticles`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxarticles`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxarticles`.`OXPRICE` AS `OXPRICE`,`eshop_ee`.`oxarticles`.`OXBLFIXEDPRICE` AS `OXBLFIXEDPRICE`,`eshop_ee`.`oxarticles`.`OXPRICEA` AS `OXPRICEA`,`eshop_ee`.`oxarticles`.`OXPRICEB` AS `OXPRICEB`,`eshop_ee`.`oxarticles`.`OXPRICEC` AS `OXPRICEC`,`eshop_ee`.`oxarticles`.`OXBPRICE` AS `OXBPRICE`,`eshop_ee`.`oxarticles`.`OXTPRICE` AS `OXTPRICE`,`eshop_ee`.`oxarticles`.`OXUNITNAME` AS `OXUNITNAME`,`eshop_ee`.`oxarticles`.`OXUNITQUANTITY` AS `OXUNITQUANTITY`,`eshop_ee`.`oxarticles`.`OXEXTURL` AS `OXEXTURL`,`eshop_ee`.`oxarticles`.`OXURLDESC` AS `OXURLDESC`,`eshop_ee`.`oxarticles`.`OXURLIMG` AS `OXURLIMG`,`eshop_ee`.`oxarticles`.`OXVAT` AS `OXVAT`,`eshop_ee`.`oxarticles`.`OXTHUMB` AS `OXTHUMB`,`eshop_ee`.`oxarticles`.`OXICON` AS `OXICON`,`eshop_ee`.`oxarticles`.`OXPIC1` AS `OXPIC1`,`eshop_ee`.`oxarticles`.`OXPIC2` AS `OXPIC2`,`eshop_ee`.`oxarticles`.`OXPIC3` AS `OXPIC3`,`eshop_ee`.`oxarticles`.`OXPIC4` AS `OXPIC4`,`eshop_ee`.`oxarticles`.`OXPIC5` AS `OXPIC5`,`eshop_ee`.`oxarticles`.`OXPIC6` AS `OXPIC6`,`eshop_ee`.`oxarticles`.`OXPIC7` AS `OXPIC7`,`eshop_ee`.`oxarticles`.`OXPIC8` AS `OXPIC8`,`eshop_ee`.`oxarticles`.`OXPIC9` AS `OXPIC9`,`eshop_ee`.`oxarticles`.`OXPIC10` AS `OXPIC10`,`eshop_ee`.`oxarticles`.`OXPIC11` AS `OXPIC11`,`eshop_ee`.`oxarticles`.`OXPIC12` AS `OXPIC12`,`eshop_ee`.`oxarticles`.`OXZOOM1` AS `OXZOOM1`,`eshop_ee`.`oxarticles`.`OXZOOM2` AS `OXZOOM2`,`eshop_ee`.`oxarticles`.`OXZOOM3` AS `OXZOOM3`,`eshop_ee`.`oxarticles`.`OXZOOM4` AS `OXZOOM4`,`eshop_ee`.`oxarticles`.`OXWEIGHT` AS `OXWEIGHT`,`eshop_ee`.`oxarticles`.`OXSTOCK` AS `OXSTOCK`,`eshop_ee`.`oxarticles`.`OXSTOCKFLAG` AS `OXSTOCKFLAG`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT` AS `OXSTOCKTEXT`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT` AS `OXNOSTOCKTEXT`,`eshop_ee`.`oxarticles`.`OXDELIVERY` AS `OXDELIVERY`,`eshop_ee`.`oxarticles`.`OXINSERT` AS `OXINSERT`,`eshop_ee`.`oxarticles`.`OXTIMESTAMP` AS `OXTIMESTAMP`,`eshop_ee`.`oxarticles`.`OXLENGTH` AS `OXLENGTH`,`eshop_ee`.`oxarticles`.`OXWIDTH` AS `OXWIDTH`,`eshop_ee`.`oxarticles`.`OXHEIGHT` AS `OXHEIGHT`,`eshop_ee`.`oxarticles`.`OXFILE` AS `OXFILE`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS` AS `OXSEARCHKEYS`,`eshop_ee`.`oxarticles`.`OXTEMPLATE` AS `OXTEMPLATE`,`eshop_ee`.`oxarticles`.`OXQUESTIONEMAIL` AS `OXQUESTIONEMAIL`,`eshop_ee`.`oxarticles`.`OXISSEARCH` AS `OXISSEARCH`,`eshop_ee`.`oxarticles`.`OXVARNAME` AS `OXVARNAME`,`eshop_ee`.`oxarticles`.`OXVARSTOCK` AS `OXVARSTOCK`,`eshop_ee`.`oxarticles`.`OXVARCOUNT` AS `OXVARCOUNT`,`eshop_ee`.`oxarticles`.`OXVARSELECT` AS `OXVARSELECT`,`eshop_ee`.`oxarticles`.`OXVARNAME_1` AS `OXVARNAME_1`,`eshop_ee`.`oxarticles`.`OXVARSELECT_1` AS `OXVARSELECT_1`,`eshop_ee`.`oxarticles`.`OXVARNAME_2` AS `OXVARNAME_2`,`eshop_ee`.`oxarticles`.`OXVARSELECT_2` AS `OXVARSELECT_2`,`eshop_ee`.`oxarticles`.`OXVARNAME_3` AS `OXVARNAME_3`,`eshop_ee`.`oxarticles`.`OXVARSELECT_3` AS `OXVARSELECT_3`,`eshop_ee`.`oxarticles`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxarticles`.`OXURLDESC_1` AS `OXURLDESC_1`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_1` AS `OXSEARCHKEYS_1`,`eshop_ee`.`oxarticles`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxarticles`.`OXURLDESC_2` AS `OXURLDESC_2`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_2` AS `OXSEARCHKEYS_2`,`eshop_ee`.`oxarticles`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxarticles`.`OXURLDESC_3` AS `OXURLDESC_3`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_3` AS `OXSEARCHKEYS_3`,`eshop_ee`.`oxarticles`.`OXFOLDER` AS `OXFOLDER`,`eshop_ee`.`oxarticles`.`OXSUBCLASS` AS `OXSUBCLASS`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_1` AS `OXSTOCKTEXT_1`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_2` AS `OXSTOCKTEXT_2`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_3` AS `OXSTOCKTEXT_3`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_1` AS `OXNOSTOCKTEXT_1`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_2` AS `OXNOSTOCKTEXT_2`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_3` AS `OXNOSTOCKTEXT_3`,`eshop_ee`.`oxarticles`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxarticles`.`OXSOLDAMOUNT` AS `OXSOLDAMOUNT`,`eshop_ee`.`oxarticles`.`OXNONMATERIAL` AS `OXNONMATERIAL`,`eshop_ee`.`oxarticles`.`OXFREESHIPPING` AS `OXFREESHIPPING`,`eshop_ee`.`oxarticles`.`OXREMINDACTIV` AS `OXREMINDACTIV`,`eshop_ee`.`oxarticles`.`OXREMINDAMOUNT` AS `OXREMINDAMOUNT`,`eshop_ee`.`oxarticles`.`OXAMITEMID` AS `OXAMITEMID`,`eshop_ee`.`oxarticles`.`OXAMTASKID` AS `OXAMTASKID`,`eshop_ee`.`oxarticles`.`OXVENDORID` AS `OXVENDORID`,`eshop_ee`.`oxarticles`.`OXSKIPDISCOUNTS` AS `OXSKIPDISCOUNTS`,`eshop_ee`.`oxarticles`.`OXORDERINFO` AS `OXORDERINFO`,`eshop_ee`.`oxarticles`.`OXPIXIEXPORT` AS `OXPIXIEXPORT`,`eshop_ee`.`oxarticles`.`OXPIXIEXPORTED` AS `OXPIXIEXPORTED`,`eshop_ee`.`oxarticles`.`OXVPE` AS `OXVPE`,`eshop_ee`.`oxarticles`.`OXRATING` AS `OXRATING`,`eshop_ee`.`oxarticles`.`OXRATINGCNT` AS `OXRATINGCNT` from `eshop_ee`.`oxarticles` where (((`eshop_ee`.`oxarticles`.`OXSHOPINCL` & 8) > 0) and ((`eshop_ee`.`oxarticles`.`OXSHOPEXCL` & 8) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxarticles_5`
-- 
DROP TABLE IF EXISTS `oxv_oxarticles_5`;

DROP VIEW IF EXISTS `oxv_oxarticles_5`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxarticles_5` AS select `eshop_ee`.`oxarticles`.`OXID` AS `OXID`,`eshop_ee`.`oxarticles`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxarticles`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxarticles`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxarticles`.`OXPARENTID` AS `OXPARENTID`,`eshop_ee`.`oxarticles`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxarticles`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxarticles`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxarticles`.`OXARTNUM` AS `OXARTNUM`,`eshop_ee`.`oxarticles`.`OXEAN` AS `OXEAN`,`eshop_ee`.`oxarticles`.`OXDISTEAN` AS `OXDISTEAN`,`eshop_ee`.`oxarticles`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxarticles`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxarticles`.`OXPRICE` AS `OXPRICE`,`eshop_ee`.`oxarticles`.`OXBLFIXEDPRICE` AS `OXBLFIXEDPRICE`,`eshop_ee`.`oxarticles`.`OXPRICEA` AS `OXPRICEA`,`eshop_ee`.`oxarticles`.`OXPRICEB` AS `OXPRICEB`,`eshop_ee`.`oxarticles`.`OXPRICEC` AS `OXPRICEC`,`eshop_ee`.`oxarticles`.`OXBPRICE` AS `OXBPRICE`,`eshop_ee`.`oxarticles`.`OXTPRICE` AS `OXTPRICE`,`eshop_ee`.`oxarticles`.`OXUNITNAME` AS `OXUNITNAME`,`eshop_ee`.`oxarticles`.`OXUNITQUANTITY` AS `OXUNITQUANTITY`,`eshop_ee`.`oxarticles`.`OXEXTURL` AS `OXEXTURL`,`eshop_ee`.`oxarticles`.`OXURLDESC` AS `OXURLDESC`,`eshop_ee`.`oxarticles`.`OXURLIMG` AS `OXURLIMG`,`eshop_ee`.`oxarticles`.`OXVAT` AS `OXVAT`,`eshop_ee`.`oxarticles`.`OXTHUMB` AS `OXTHUMB`,`eshop_ee`.`oxarticles`.`OXICON` AS `OXICON`,`eshop_ee`.`oxarticles`.`OXPIC1` AS `OXPIC1`,`eshop_ee`.`oxarticles`.`OXPIC2` AS `OXPIC2`,`eshop_ee`.`oxarticles`.`OXPIC3` AS `OXPIC3`,`eshop_ee`.`oxarticles`.`OXPIC4` AS `OXPIC4`,`eshop_ee`.`oxarticles`.`OXPIC5` AS `OXPIC5`,`eshop_ee`.`oxarticles`.`OXPIC6` AS `OXPIC6`,`eshop_ee`.`oxarticles`.`OXPIC7` AS `OXPIC7`,`eshop_ee`.`oxarticles`.`OXPIC8` AS `OXPIC8`,`eshop_ee`.`oxarticles`.`OXPIC9` AS `OXPIC9`,`eshop_ee`.`oxarticles`.`OXPIC10` AS `OXPIC10`,`eshop_ee`.`oxarticles`.`OXPIC11` AS `OXPIC11`,`eshop_ee`.`oxarticles`.`OXPIC12` AS `OXPIC12`,`eshop_ee`.`oxarticles`.`OXZOOM1` AS `OXZOOM1`,`eshop_ee`.`oxarticles`.`OXZOOM2` AS `OXZOOM2`,`eshop_ee`.`oxarticles`.`OXZOOM3` AS `OXZOOM3`,`eshop_ee`.`oxarticles`.`OXZOOM4` AS `OXZOOM4`,`eshop_ee`.`oxarticles`.`OXWEIGHT` AS `OXWEIGHT`,`eshop_ee`.`oxarticles`.`OXSTOCK` AS `OXSTOCK`,`eshop_ee`.`oxarticles`.`OXSTOCKFLAG` AS `OXSTOCKFLAG`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT` AS `OXSTOCKTEXT`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT` AS `OXNOSTOCKTEXT`,`eshop_ee`.`oxarticles`.`OXDELIVERY` AS `OXDELIVERY`,`eshop_ee`.`oxarticles`.`OXINSERT` AS `OXINSERT`,`eshop_ee`.`oxarticles`.`OXTIMESTAMP` AS `OXTIMESTAMP`,`eshop_ee`.`oxarticles`.`OXLENGTH` AS `OXLENGTH`,`eshop_ee`.`oxarticles`.`OXWIDTH` AS `OXWIDTH`,`eshop_ee`.`oxarticles`.`OXHEIGHT` AS `OXHEIGHT`,`eshop_ee`.`oxarticles`.`OXFILE` AS `OXFILE`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS` AS `OXSEARCHKEYS`,`eshop_ee`.`oxarticles`.`OXTEMPLATE` AS `OXTEMPLATE`,`eshop_ee`.`oxarticles`.`OXQUESTIONEMAIL` AS `OXQUESTIONEMAIL`,`eshop_ee`.`oxarticles`.`OXISSEARCH` AS `OXISSEARCH`,`eshop_ee`.`oxarticles`.`OXVARNAME` AS `OXVARNAME`,`eshop_ee`.`oxarticles`.`OXVARSTOCK` AS `OXVARSTOCK`,`eshop_ee`.`oxarticles`.`OXVARCOUNT` AS `OXVARCOUNT`,`eshop_ee`.`oxarticles`.`OXVARSELECT` AS `OXVARSELECT`,`eshop_ee`.`oxarticles`.`OXVARNAME_1` AS `OXVARNAME_1`,`eshop_ee`.`oxarticles`.`OXVARSELECT_1` AS `OXVARSELECT_1`,`eshop_ee`.`oxarticles`.`OXVARNAME_2` AS `OXVARNAME_2`,`eshop_ee`.`oxarticles`.`OXVARSELECT_2` AS `OXVARSELECT_2`,`eshop_ee`.`oxarticles`.`OXVARNAME_3` AS `OXVARNAME_3`,`eshop_ee`.`oxarticles`.`OXVARSELECT_3` AS `OXVARSELECT_3`,`eshop_ee`.`oxarticles`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxarticles`.`OXURLDESC_1` AS `OXURLDESC_1`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_1` AS `OXSEARCHKEYS_1`,`eshop_ee`.`oxarticles`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxarticles`.`OXURLDESC_2` AS `OXURLDESC_2`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_2` AS `OXSEARCHKEYS_2`,`eshop_ee`.`oxarticles`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxarticles`.`OXURLDESC_3` AS `OXURLDESC_3`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_3` AS `OXSEARCHKEYS_3`,`eshop_ee`.`oxarticles`.`OXFOLDER` AS `OXFOLDER`,`eshop_ee`.`oxarticles`.`OXSUBCLASS` AS `OXSUBCLASS`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_1` AS `OXSTOCKTEXT_1`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_2` AS `OXSTOCKTEXT_2`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_3` AS `OXSTOCKTEXT_3`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_1` AS `OXNOSTOCKTEXT_1`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_2` AS `OXNOSTOCKTEXT_2`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_3` AS `OXNOSTOCKTEXT_3`,`eshop_ee`.`oxarticles`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxarticles`.`OXSOLDAMOUNT` AS `OXSOLDAMOUNT`,`eshop_ee`.`oxarticles`.`OXNONMATERIAL` AS `OXNONMATERIAL`,`eshop_ee`.`oxarticles`.`OXFREESHIPPING` AS `OXFREESHIPPING`,`eshop_ee`.`oxarticles`.`OXREMINDACTIV` AS `OXREMINDACTIV`,`eshop_ee`.`oxarticles`.`OXREMINDAMOUNT` AS `OXREMINDAMOUNT`,`eshop_ee`.`oxarticles`.`OXAMITEMID` AS `OXAMITEMID`,`eshop_ee`.`oxarticles`.`OXAMTASKID` AS `OXAMTASKID`,`eshop_ee`.`oxarticles`.`OXVENDORID` AS `OXVENDORID`,`eshop_ee`.`oxarticles`.`OXSKIPDISCOUNTS` AS `OXSKIPDISCOUNTS`,`eshop_ee`.`oxarticles`.`OXORDERINFO` AS `OXORDERINFO`,`eshop_ee`.`oxarticles`.`OXPIXIEXPORT` AS `OXPIXIEXPORT`,`eshop_ee`.`oxarticles`.`OXPIXIEXPORTED` AS `OXPIXIEXPORTED`,`eshop_ee`.`oxarticles`.`OXVPE` AS `OXVPE`,`eshop_ee`.`oxarticles`.`OXRATING` AS `OXRATING`,`eshop_ee`.`oxarticles`.`OXRATINGCNT` AS `OXRATINGCNT` from `eshop_ee`.`oxarticles` where (((`eshop_ee`.`oxarticles`.`OXSHOPINCL` & 16) > 0) and ((`eshop_ee`.`oxarticles`.`OXSHOPEXCL` & 16) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxarticles_6`
-- 
DROP TABLE IF EXISTS `oxv_oxarticles_6`;

DROP VIEW IF EXISTS `oxv_oxarticles_6`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxarticles_6` AS select `eshop_ee`.`oxarticles`.`OXID` AS `OXID`,`eshop_ee`.`oxarticles`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxarticles`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxarticles`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxarticles`.`OXPARENTID` AS `OXPARENTID`,`eshop_ee`.`oxarticles`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxarticles`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxarticles`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxarticles`.`OXARTNUM` AS `OXARTNUM`,`eshop_ee`.`oxarticles`.`OXEAN` AS `OXEAN`,`eshop_ee`.`oxarticles`.`OXDISTEAN` AS `OXDISTEAN`,`eshop_ee`.`oxarticles`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxarticles`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxarticles`.`OXPRICE` AS `OXPRICE`,`eshop_ee`.`oxarticles`.`OXBLFIXEDPRICE` AS `OXBLFIXEDPRICE`,`eshop_ee`.`oxarticles`.`OXPRICEA` AS `OXPRICEA`,`eshop_ee`.`oxarticles`.`OXPRICEB` AS `OXPRICEB`,`eshop_ee`.`oxarticles`.`OXPRICEC` AS `OXPRICEC`,`eshop_ee`.`oxarticles`.`OXBPRICE` AS `OXBPRICE`,`eshop_ee`.`oxarticles`.`OXTPRICE` AS `OXTPRICE`,`eshop_ee`.`oxarticles`.`OXUNITNAME` AS `OXUNITNAME`,`eshop_ee`.`oxarticles`.`OXUNITQUANTITY` AS `OXUNITQUANTITY`,`eshop_ee`.`oxarticles`.`OXEXTURL` AS `OXEXTURL`,`eshop_ee`.`oxarticles`.`OXURLDESC` AS `OXURLDESC`,`eshop_ee`.`oxarticles`.`OXURLIMG` AS `OXURLIMG`,`eshop_ee`.`oxarticles`.`OXVAT` AS `OXVAT`,`eshop_ee`.`oxarticles`.`OXTHUMB` AS `OXTHUMB`,`eshop_ee`.`oxarticles`.`OXICON` AS `OXICON`,`eshop_ee`.`oxarticles`.`OXPIC1` AS `OXPIC1`,`eshop_ee`.`oxarticles`.`OXPIC2` AS `OXPIC2`,`eshop_ee`.`oxarticles`.`OXPIC3` AS `OXPIC3`,`eshop_ee`.`oxarticles`.`OXPIC4` AS `OXPIC4`,`eshop_ee`.`oxarticles`.`OXPIC5` AS `OXPIC5`,`eshop_ee`.`oxarticles`.`OXPIC6` AS `OXPIC6`,`eshop_ee`.`oxarticles`.`OXPIC7` AS `OXPIC7`,`eshop_ee`.`oxarticles`.`OXPIC8` AS `OXPIC8`,`eshop_ee`.`oxarticles`.`OXPIC9` AS `OXPIC9`,`eshop_ee`.`oxarticles`.`OXPIC10` AS `OXPIC10`,`eshop_ee`.`oxarticles`.`OXPIC11` AS `OXPIC11`,`eshop_ee`.`oxarticles`.`OXPIC12` AS `OXPIC12`,`eshop_ee`.`oxarticles`.`OXZOOM1` AS `OXZOOM1`,`eshop_ee`.`oxarticles`.`OXZOOM2` AS `OXZOOM2`,`eshop_ee`.`oxarticles`.`OXZOOM3` AS `OXZOOM3`,`eshop_ee`.`oxarticles`.`OXZOOM4` AS `OXZOOM4`,`eshop_ee`.`oxarticles`.`OXWEIGHT` AS `OXWEIGHT`,`eshop_ee`.`oxarticles`.`OXSTOCK` AS `OXSTOCK`,`eshop_ee`.`oxarticles`.`OXSTOCKFLAG` AS `OXSTOCKFLAG`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT` AS `OXSTOCKTEXT`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT` AS `OXNOSTOCKTEXT`,`eshop_ee`.`oxarticles`.`OXDELIVERY` AS `OXDELIVERY`,`eshop_ee`.`oxarticles`.`OXINSERT` AS `OXINSERT`,`eshop_ee`.`oxarticles`.`OXTIMESTAMP` AS `OXTIMESTAMP`,`eshop_ee`.`oxarticles`.`OXLENGTH` AS `OXLENGTH`,`eshop_ee`.`oxarticles`.`OXWIDTH` AS `OXWIDTH`,`eshop_ee`.`oxarticles`.`OXHEIGHT` AS `OXHEIGHT`,`eshop_ee`.`oxarticles`.`OXFILE` AS `OXFILE`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS` AS `OXSEARCHKEYS`,`eshop_ee`.`oxarticles`.`OXTEMPLATE` AS `OXTEMPLATE`,`eshop_ee`.`oxarticles`.`OXQUESTIONEMAIL` AS `OXQUESTIONEMAIL`,`eshop_ee`.`oxarticles`.`OXISSEARCH` AS `OXISSEARCH`,`eshop_ee`.`oxarticles`.`OXVARNAME` AS `OXVARNAME`,`eshop_ee`.`oxarticles`.`OXVARSTOCK` AS `OXVARSTOCK`,`eshop_ee`.`oxarticles`.`OXVARCOUNT` AS `OXVARCOUNT`,`eshop_ee`.`oxarticles`.`OXVARSELECT` AS `OXVARSELECT`,`eshop_ee`.`oxarticles`.`OXVARNAME_1` AS `OXVARNAME_1`,`eshop_ee`.`oxarticles`.`OXVARSELECT_1` AS `OXVARSELECT_1`,`eshop_ee`.`oxarticles`.`OXVARNAME_2` AS `OXVARNAME_2`,`eshop_ee`.`oxarticles`.`OXVARSELECT_2` AS `OXVARSELECT_2`,`eshop_ee`.`oxarticles`.`OXVARNAME_3` AS `OXVARNAME_3`,`eshop_ee`.`oxarticles`.`OXVARSELECT_3` AS `OXVARSELECT_3`,`eshop_ee`.`oxarticles`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxarticles`.`OXURLDESC_1` AS `OXURLDESC_1`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_1` AS `OXSEARCHKEYS_1`,`eshop_ee`.`oxarticles`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxarticles`.`OXURLDESC_2` AS `OXURLDESC_2`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_2` AS `OXSEARCHKEYS_2`,`eshop_ee`.`oxarticles`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxarticles`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxarticles`.`OXURLDESC_3` AS `OXURLDESC_3`,`eshop_ee`.`oxarticles`.`OXSEARCHKEYS_3` AS `OXSEARCHKEYS_3`,`eshop_ee`.`oxarticles`.`OXFOLDER` AS `OXFOLDER`,`eshop_ee`.`oxarticles`.`OXSUBCLASS` AS `OXSUBCLASS`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_1` AS `OXSTOCKTEXT_1`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_2` AS `OXSTOCKTEXT_2`,`eshop_ee`.`oxarticles`.`OXSTOCKTEXT_3` AS `OXSTOCKTEXT_3`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_1` AS `OXNOSTOCKTEXT_1`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_2` AS `OXNOSTOCKTEXT_2`,`eshop_ee`.`oxarticles`.`OXNOSTOCKTEXT_3` AS `OXNOSTOCKTEXT_3`,`eshop_ee`.`oxarticles`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxarticles`.`OXSOLDAMOUNT` AS `OXSOLDAMOUNT`,`eshop_ee`.`oxarticles`.`OXNONMATERIAL` AS `OXNONMATERIAL`,`eshop_ee`.`oxarticles`.`OXFREESHIPPING` AS `OXFREESHIPPING`,`eshop_ee`.`oxarticles`.`OXREMINDACTIV` AS `OXREMINDACTIV`,`eshop_ee`.`oxarticles`.`OXREMINDAMOUNT` AS `OXREMINDAMOUNT`,`eshop_ee`.`oxarticles`.`OXAMITEMID` AS `OXAMITEMID`,`eshop_ee`.`oxarticles`.`OXAMTASKID` AS `OXAMTASKID`,`eshop_ee`.`oxarticles`.`OXVENDORID` AS `OXVENDORID`,`eshop_ee`.`oxarticles`.`OXSKIPDISCOUNTS` AS `OXSKIPDISCOUNTS`,`eshop_ee`.`oxarticles`.`OXORDERINFO` AS `OXORDERINFO`,`eshop_ee`.`oxarticles`.`OXPIXIEXPORT` AS `OXPIXIEXPORT`,`eshop_ee`.`oxarticles`.`OXPIXIEXPORTED` AS `OXPIXIEXPORTED`,`eshop_ee`.`oxarticles`.`OXVPE` AS `OXVPE`,`eshop_ee`.`oxarticles`.`OXRATING` AS `OXRATING`,`eshop_ee`.`oxarticles`.`OXRATINGCNT` AS `OXRATINGCNT` from `eshop_ee`.`oxarticles` where (((`eshop_ee`.`oxarticles`.`OXSHOPINCL` & 32) > 0) and ((`eshop_ee`.`oxarticles`.`OXSHOPEXCL` & 32) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxattribute_1`
-- 
DROP TABLE IF EXISTS `oxv_oxattribute_1`;

DROP VIEW IF EXISTS `oxv_oxattribute_1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxattribute_1` AS select `eshop_ee`.`oxattribute`.`OXID` AS `OXID`,`eshop_ee`.`oxattribute`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxattribute`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxattribute`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxattribute`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxattribute`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxattribute`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxattribute`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxattribute`.`OXPOS` AS `OXPOS` from `eshop_ee`.`oxattribute` where (((`eshop_ee`.`oxattribute`.`OXSHOPINCL` & 1) > 0) and ((`eshop_ee`.`oxattribute`.`OXSHOPEXCL` & 1) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxattribute_2`
-- 
DROP TABLE IF EXISTS `oxv_oxattribute_2`;

DROP VIEW IF EXISTS `oxv_oxattribute_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxattribute_2` AS select `eshop_ee`.`oxattribute`.`OXID` AS `OXID`,`eshop_ee`.`oxattribute`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxattribute`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxattribute`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxattribute`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxattribute`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxattribute`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxattribute`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxattribute`.`OXPOS` AS `OXPOS` from `eshop_ee`.`oxattribute` where (((`eshop_ee`.`oxattribute`.`OXSHOPINCL` & 2) > 0) and ((`eshop_ee`.`oxattribute`.`OXSHOPEXCL` & 2) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxattribute_3`
-- 
DROP TABLE IF EXISTS `oxv_oxattribute_3`;

DROP VIEW IF EXISTS `oxv_oxattribute_3`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxattribute_3` AS select `eshop_ee`.`oxattribute`.`OXID` AS `OXID`,`eshop_ee`.`oxattribute`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxattribute`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxattribute`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxattribute`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxattribute`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxattribute`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxattribute`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxattribute`.`OXPOS` AS `OXPOS` from `eshop_ee`.`oxattribute` where (((`eshop_ee`.`oxattribute`.`OXSHOPINCL` & 5) > 0) and ((`eshop_ee`.`oxattribute`.`OXSHOPEXCL` & 4) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxattribute_4`
-- 
DROP TABLE IF EXISTS `oxv_oxattribute_4`;

DROP VIEW IF EXISTS `oxv_oxattribute_4`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxattribute_4` AS select `eshop_ee`.`oxattribute`.`OXID` AS `OXID`,`eshop_ee`.`oxattribute`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxattribute`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxattribute`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxattribute`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxattribute`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxattribute`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxattribute`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxattribute`.`OXPOS` AS `OXPOS` from `eshop_ee`.`oxattribute` where (((`eshop_ee`.`oxattribute`.`OXSHOPINCL` & 8) > 0) and ((`eshop_ee`.`oxattribute`.`OXSHOPEXCL` & 8) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxattribute_5`
-- 
DROP TABLE IF EXISTS `oxv_oxattribute_5`;

DROP VIEW IF EXISTS `oxv_oxattribute_5`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxattribute_5` AS select `eshop_ee`.`oxattribute`.`OXID` AS `OXID`,`eshop_ee`.`oxattribute`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxattribute`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxattribute`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxattribute`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxattribute`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxattribute`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxattribute`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxattribute`.`OXPOS` AS `OXPOS` from `eshop_ee`.`oxattribute` where (((`eshop_ee`.`oxattribute`.`OXSHOPINCL` & 16) > 0) and ((`eshop_ee`.`oxattribute`.`OXSHOPEXCL` & 16) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxattribute_6`
-- 
DROP TABLE IF EXISTS `oxv_oxattribute_6`;

DROP VIEW IF EXISTS `oxv_oxattribute_6`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxattribute_6` AS select `eshop_ee`.`oxattribute`.`OXID` AS `OXID`,`eshop_ee`.`oxattribute`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxattribute`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxattribute`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxattribute`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxattribute`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxattribute`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxattribute`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxattribute`.`OXPOS` AS `OXPOS` from `eshop_ee`.`oxattribute` where (((`eshop_ee`.`oxattribute`.`OXSHOPINCL` & 32) > 0) and ((`eshop_ee`.`oxattribute`.`OXSHOPEXCL` & 32) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxcategories_1`
-- 
DROP TABLE IF EXISTS `oxv_oxcategories_1`;

DROP VIEW IF EXISTS `oxv_oxcategories_1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxcategories_1` AS select `eshop_ee`.`oxcategories`.`OXID` AS `OXID`,`eshop_ee`.`oxcategories`.`OXPARENTID` AS `OXPARENTID`,`eshop_ee`.`oxcategories`.`OXLEFT` AS `OXLEFT`,`eshop_ee`.`oxcategories`.`OXRIGHT` AS `OXRIGHT`,`eshop_ee`.`oxcategories`.`OXROOTID` AS `OXROOTID`,`eshop_ee`.`oxcategories`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxcategories`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxcategories`.`OXHIDDEN` AS `OXHIDDEN`,`eshop_ee`.`oxcategories`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxcategories`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxcategories`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxcategories`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxcategories`.`OXDESC` AS `OXDESC`,`eshop_ee`.`oxcategories`.`OXLONGDESC` AS `OXLONGDESC`,`eshop_ee`.`oxcategories`.`OXTHUMB` AS `OXTHUMB`,`eshop_ee`.`oxcategories`.`OXEXTLINK` AS `OXEXTLINK`,`eshop_ee`.`oxcategories`.`OXTEMPLATE` AS `OXTEMPLATE`,`eshop_ee`.`oxcategories`.`OXDEFSORT` AS `OXDEFSORT`,`eshop_ee`.`oxcategories`.`OXDEFSORTMODE` AS `OXDEFSORTMODE`,`eshop_ee`.`oxcategories`.`OXPRICEFROM` AS `OXPRICEFROM`,`eshop_ee`.`oxcategories`.`OXPRICETO` AS `OXPRICETO`,`eshop_ee`.`oxcategories`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxcategories`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxcategories`.`OXDESC_1` AS `OXDESC_1`,`eshop_ee`.`oxcategories`.`OXLONGDESC_1` AS `OXLONGDESC_1`,`eshop_ee`.`oxcategories`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxcategories`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxcategories`.`OXDESC_2` AS `OXDESC_2`,`eshop_ee`.`oxcategories`.`OXLONGDESC_2` AS `OXLONGDESC_2`,`eshop_ee`.`oxcategories`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxcategories`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxcategories`.`OXDESC_3` AS `OXDESC_3`,`eshop_ee`.`oxcategories`.`OXLONGDESC_3` AS `OXLONGDESC_3`,`eshop_ee`.`oxcategories`.`OXICON` AS `OXICON`,`eshop_ee`.`oxcategories`.`OXVAT` AS `OXVAT`,`eshop_ee`.`oxcategories`.`OXSKIPDISCOUNTS` AS `OXSKIPDISCOUNTS`,`eshop_ee`.`oxcategories`.`OXSHOWSUFFIX` AS `OXSHOWSUFFIX` from `eshop_ee`.`oxcategories` where (((`eshop_ee`.`oxcategories`.`OXSHOPINCL` & 1) > 0) and ((`eshop_ee`.`oxcategories`.`OXSHOPEXCL` & 1) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxcategories_2`
-- 
DROP TABLE IF EXISTS `oxv_oxcategories_2`;

DROP VIEW IF EXISTS `oxv_oxcategories_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxcategories_2` AS select `eshop_ee`.`oxcategories`.`OXID` AS `OXID`,`eshop_ee`.`oxcategories`.`OXPARENTID` AS `OXPARENTID`,`eshop_ee`.`oxcategories`.`OXLEFT` AS `OXLEFT`,`eshop_ee`.`oxcategories`.`OXRIGHT` AS `OXRIGHT`,`eshop_ee`.`oxcategories`.`OXROOTID` AS `OXROOTID`,`eshop_ee`.`oxcategories`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxcategories`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxcategories`.`OXHIDDEN` AS `OXHIDDEN`,`eshop_ee`.`oxcategories`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxcategories`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxcategories`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxcategories`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxcategories`.`OXDESC` AS `OXDESC`,`eshop_ee`.`oxcategories`.`OXLONGDESC` AS `OXLONGDESC`,`eshop_ee`.`oxcategories`.`OXTHUMB` AS `OXTHUMB`,`eshop_ee`.`oxcategories`.`OXEXTLINK` AS `OXEXTLINK`,`eshop_ee`.`oxcategories`.`OXTEMPLATE` AS `OXTEMPLATE`,`eshop_ee`.`oxcategories`.`OXDEFSORT` AS `OXDEFSORT`,`eshop_ee`.`oxcategories`.`OXDEFSORTMODE` AS `OXDEFSORTMODE`,`eshop_ee`.`oxcategories`.`OXPRICEFROM` AS `OXPRICEFROM`,`eshop_ee`.`oxcategories`.`OXPRICETO` AS `OXPRICETO`,`eshop_ee`.`oxcategories`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxcategories`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxcategories`.`OXDESC_1` AS `OXDESC_1`,`eshop_ee`.`oxcategories`.`OXLONGDESC_1` AS `OXLONGDESC_1`,`eshop_ee`.`oxcategories`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxcategories`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxcategories`.`OXDESC_2` AS `OXDESC_2`,`eshop_ee`.`oxcategories`.`OXLONGDESC_2` AS `OXLONGDESC_2`,`eshop_ee`.`oxcategories`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxcategories`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxcategories`.`OXDESC_3` AS `OXDESC_3`,`eshop_ee`.`oxcategories`.`OXLONGDESC_3` AS `OXLONGDESC_3`,`eshop_ee`.`oxcategories`.`OXICON` AS `OXICON`,`eshop_ee`.`oxcategories`.`OXVAT` AS `OXVAT`,`eshop_ee`.`oxcategories`.`OXSKIPDISCOUNTS` AS `OXSKIPDISCOUNTS`,`eshop_ee`.`oxcategories`.`OXSHOWSUFFIX` AS `OXSHOWSUFFIX` from `eshop_ee`.`oxcategories` where (((`eshop_ee`.`oxcategories`.`OXSHOPINCL` & 2) > 0) and ((`eshop_ee`.`oxcategories`.`OXSHOPEXCL` & 2) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxcategories_3`
-- 
DROP TABLE IF EXISTS `oxv_oxcategories_3`;

DROP VIEW IF EXISTS `oxv_oxcategories_3`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxcategories_3` AS select `eshop_ee`.`oxcategories`.`OXID` AS `OXID`,`eshop_ee`.`oxcategories`.`OXPARENTID` AS `OXPARENTID`,`eshop_ee`.`oxcategories`.`OXLEFT` AS `OXLEFT`,`eshop_ee`.`oxcategories`.`OXRIGHT` AS `OXRIGHT`,`eshop_ee`.`oxcategories`.`OXROOTID` AS `OXROOTID`,`eshop_ee`.`oxcategories`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxcategories`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxcategories`.`OXHIDDEN` AS `OXHIDDEN`,`eshop_ee`.`oxcategories`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxcategories`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxcategories`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxcategories`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxcategories`.`OXDESC` AS `OXDESC`,`eshop_ee`.`oxcategories`.`OXLONGDESC` AS `OXLONGDESC`,`eshop_ee`.`oxcategories`.`OXTHUMB` AS `OXTHUMB`,`eshop_ee`.`oxcategories`.`OXEXTLINK` AS `OXEXTLINK`,`eshop_ee`.`oxcategories`.`OXTEMPLATE` AS `OXTEMPLATE`,`eshop_ee`.`oxcategories`.`OXDEFSORT` AS `OXDEFSORT`,`eshop_ee`.`oxcategories`.`OXDEFSORTMODE` AS `OXDEFSORTMODE`,`eshop_ee`.`oxcategories`.`OXPRICEFROM` AS `OXPRICEFROM`,`eshop_ee`.`oxcategories`.`OXPRICETO` AS `OXPRICETO`,`eshop_ee`.`oxcategories`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxcategories`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxcategories`.`OXDESC_1` AS `OXDESC_1`,`eshop_ee`.`oxcategories`.`OXLONGDESC_1` AS `OXLONGDESC_1`,`eshop_ee`.`oxcategories`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxcategories`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxcategories`.`OXDESC_2` AS `OXDESC_2`,`eshop_ee`.`oxcategories`.`OXLONGDESC_2` AS `OXLONGDESC_2`,`eshop_ee`.`oxcategories`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxcategories`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxcategories`.`OXDESC_3` AS `OXDESC_3`,`eshop_ee`.`oxcategories`.`OXLONGDESC_3` AS `OXLONGDESC_3`,`eshop_ee`.`oxcategories`.`OXICON` AS `OXICON`,`eshop_ee`.`oxcategories`.`OXVAT` AS `OXVAT`,`eshop_ee`.`oxcategories`.`OXSKIPDISCOUNTS` AS `OXSKIPDISCOUNTS`,`eshop_ee`.`oxcategories`.`OXSHOWSUFFIX` AS `OXSHOWSUFFIX` from `eshop_ee`.`oxcategories` where (((`eshop_ee`.`oxcategories`.`OXSHOPINCL` & 4) > 0) and ((`eshop_ee`.`oxcategories`.`OXSHOPEXCL` & 4) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxcategories_4`
-- 
DROP TABLE IF EXISTS `oxv_oxcategories_4`;

DROP VIEW IF EXISTS `oxv_oxcategories_4`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxcategories_4` AS select `eshop_ee`.`oxcategories`.`OXID` AS `OXID`,`eshop_ee`.`oxcategories`.`OXPARENTID` AS `OXPARENTID`,`eshop_ee`.`oxcategories`.`OXLEFT` AS `OXLEFT`,`eshop_ee`.`oxcategories`.`OXRIGHT` AS `OXRIGHT`,`eshop_ee`.`oxcategories`.`OXROOTID` AS `OXROOTID`,`eshop_ee`.`oxcategories`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxcategories`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxcategories`.`OXHIDDEN` AS `OXHIDDEN`,`eshop_ee`.`oxcategories`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxcategories`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxcategories`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxcategories`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxcategories`.`OXDESC` AS `OXDESC`,`eshop_ee`.`oxcategories`.`OXLONGDESC` AS `OXLONGDESC`,`eshop_ee`.`oxcategories`.`OXTHUMB` AS `OXTHUMB`,`eshop_ee`.`oxcategories`.`OXEXTLINK` AS `OXEXTLINK`,`eshop_ee`.`oxcategories`.`OXTEMPLATE` AS `OXTEMPLATE`,`eshop_ee`.`oxcategories`.`OXDEFSORT` AS `OXDEFSORT`,`eshop_ee`.`oxcategories`.`OXDEFSORTMODE` AS `OXDEFSORTMODE`,`eshop_ee`.`oxcategories`.`OXPRICEFROM` AS `OXPRICEFROM`,`eshop_ee`.`oxcategories`.`OXPRICETO` AS `OXPRICETO`,`eshop_ee`.`oxcategories`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxcategories`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxcategories`.`OXDESC_1` AS `OXDESC_1`,`eshop_ee`.`oxcategories`.`OXLONGDESC_1` AS `OXLONGDESC_1`,`eshop_ee`.`oxcategories`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxcategories`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxcategories`.`OXDESC_2` AS `OXDESC_2`,`eshop_ee`.`oxcategories`.`OXLONGDESC_2` AS `OXLONGDESC_2`,`eshop_ee`.`oxcategories`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxcategories`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxcategories`.`OXDESC_3` AS `OXDESC_3`,`eshop_ee`.`oxcategories`.`OXLONGDESC_3` AS `OXLONGDESC_3`,`eshop_ee`.`oxcategories`.`OXICON` AS `OXICON`,`eshop_ee`.`oxcategories`.`OXVAT` AS `OXVAT`,`eshop_ee`.`oxcategories`.`OXSKIPDISCOUNTS` AS `OXSKIPDISCOUNTS` from `eshop_ee`.`oxcategories` where (((`eshop_ee`.`oxcategories`.`OXSHOPINCL` & 8) > 0) and ((`eshop_ee`.`oxcategories`.`OXSHOPEXCL` & 8) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxcategories_5`
-- 
DROP TABLE IF EXISTS `oxv_oxcategories_5`;

DROP VIEW IF EXISTS `oxv_oxcategories_5`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxcategories_5` AS select `eshop_ee`.`oxcategories`.`OXID` AS `OXID`,`eshop_ee`.`oxcategories`.`OXPARENTID` AS `OXPARENTID`,`eshop_ee`.`oxcategories`.`OXLEFT` AS `OXLEFT`,`eshop_ee`.`oxcategories`.`OXRIGHT` AS `OXRIGHT`,`eshop_ee`.`oxcategories`.`OXROOTID` AS `OXROOTID`,`eshop_ee`.`oxcategories`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxcategories`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxcategories`.`OXHIDDEN` AS `OXHIDDEN`,`eshop_ee`.`oxcategories`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxcategories`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxcategories`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxcategories`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxcategories`.`OXDESC` AS `OXDESC`,`eshop_ee`.`oxcategories`.`OXLONGDESC` AS `OXLONGDESC`,`eshop_ee`.`oxcategories`.`OXTHUMB` AS `OXTHUMB`,`eshop_ee`.`oxcategories`.`OXEXTLINK` AS `OXEXTLINK`,`eshop_ee`.`oxcategories`.`OXTEMPLATE` AS `OXTEMPLATE`,`eshop_ee`.`oxcategories`.`OXDEFSORT` AS `OXDEFSORT`,`eshop_ee`.`oxcategories`.`OXDEFSORTMODE` AS `OXDEFSORTMODE`,`eshop_ee`.`oxcategories`.`OXPRICEFROM` AS `OXPRICEFROM`,`eshop_ee`.`oxcategories`.`OXPRICETO` AS `OXPRICETO`,`eshop_ee`.`oxcategories`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxcategories`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxcategories`.`OXDESC_1` AS `OXDESC_1`,`eshop_ee`.`oxcategories`.`OXLONGDESC_1` AS `OXLONGDESC_1`,`eshop_ee`.`oxcategories`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxcategories`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxcategories`.`OXDESC_2` AS `OXDESC_2`,`eshop_ee`.`oxcategories`.`OXLONGDESC_2` AS `OXLONGDESC_2`,`eshop_ee`.`oxcategories`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxcategories`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxcategories`.`OXDESC_3` AS `OXDESC_3`,`eshop_ee`.`oxcategories`.`OXLONGDESC_3` AS `OXLONGDESC_3`,`eshop_ee`.`oxcategories`.`OXICON` AS `OXICON`,`eshop_ee`.`oxcategories`.`OXVAT` AS `OXVAT`,`eshop_ee`.`oxcategories`.`OXSKIPDISCOUNTS` AS `OXSKIPDISCOUNTS` from `eshop_ee`.`oxcategories` where (((`eshop_ee`.`oxcategories`.`OXSHOPINCL` & 16) > 0) and ((`eshop_ee`.`oxcategories`.`OXSHOPEXCL` & 16) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxcategories_6`
-- 
DROP TABLE IF EXISTS `oxv_oxcategories_6`;

DROP VIEW IF EXISTS `oxv_oxcategories_6`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxcategories_6` AS select `eshop_ee`.`oxcategories`.`OXID` AS `OXID`,`eshop_ee`.`oxcategories`.`OXPARENTID` AS `OXPARENTID`,`eshop_ee`.`oxcategories`.`OXLEFT` AS `OXLEFT`,`eshop_ee`.`oxcategories`.`OXRIGHT` AS `OXRIGHT`,`eshop_ee`.`oxcategories`.`OXROOTID` AS `OXROOTID`,`eshop_ee`.`oxcategories`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxcategories`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxcategories`.`OXHIDDEN` AS `OXHIDDEN`,`eshop_ee`.`oxcategories`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxcategories`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxcategories`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxcategories`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxcategories`.`OXDESC` AS `OXDESC`,`eshop_ee`.`oxcategories`.`OXLONGDESC` AS `OXLONGDESC`,`eshop_ee`.`oxcategories`.`OXTHUMB` AS `OXTHUMB`,`eshop_ee`.`oxcategories`.`OXEXTLINK` AS `OXEXTLINK`,`eshop_ee`.`oxcategories`.`OXTEMPLATE` AS `OXTEMPLATE`,`eshop_ee`.`oxcategories`.`OXDEFSORT` AS `OXDEFSORT`,`eshop_ee`.`oxcategories`.`OXDEFSORTMODE` AS `OXDEFSORTMODE`,`eshop_ee`.`oxcategories`.`OXPRICEFROM` AS `OXPRICEFROM`,`eshop_ee`.`oxcategories`.`OXPRICETO` AS `OXPRICETO`,`eshop_ee`.`oxcategories`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxcategories`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxcategories`.`OXDESC_1` AS `OXDESC_1`,`eshop_ee`.`oxcategories`.`OXLONGDESC_1` AS `OXLONGDESC_1`,`eshop_ee`.`oxcategories`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxcategories`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxcategories`.`OXDESC_2` AS `OXDESC_2`,`eshop_ee`.`oxcategories`.`OXLONGDESC_2` AS `OXLONGDESC_2`,`eshop_ee`.`oxcategories`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxcategories`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxcategories`.`OXDESC_3` AS `OXDESC_3`,`eshop_ee`.`oxcategories`.`OXLONGDESC_3` AS `OXLONGDESC_3`,`eshop_ee`.`oxcategories`.`OXICON` AS `OXICON`,`eshop_ee`.`oxcategories`.`OXVAT` AS `OXVAT`,`eshop_ee`.`oxcategories`.`OXSKIPDISCOUNTS` AS `OXSKIPDISCOUNTS` from `eshop_ee`.`oxcategories` where (((`eshop_ee`.`oxcategories`.`OXSHOPINCL` & 32) > 0) and ((`eshop_ee`.`oxcategories`.`OXSHOPEXCL` & 32) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdeliveryset_1`
-- 
DROP TABLE IF EXISTS `oxv_oxdeliveryset_1`;

DROP VIEW IF EXISTS `oxv_oxdeliveryset_1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdeliveryset_1` AS select `eshop_ee`.`oxdeliveryset`.`OXID` AS `OXID`,`eshop_ee`.`oxdeliveryset`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdeliveryset`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdeliveryset`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdeliveryset`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdeliveryset`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdeliveryset`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdeliveryset`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdeliveryset`.`OXPOS` AS `OXPOS` from `eshop_ee`.`oxdeliveryset` where (((`eshop_ee`.`oxdeliveryset`.`OXSHOPINCL` & 1) > 0) and ((`eshop_ee`.`oxdeliveryset`.`OXSHOPEXCL` & 1) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdeliveryset_2`
-- 
DROP TABLE IF EXISTS `oxv_oxdeliveryset_2`;

DROP VIEW IF EXISTS `oxv_oxdeliveryset_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdeliveryset_2` AS select `eshop_ee`.`oxdeliveryset`.`OXID` AS `OXID`,`eshop_ee`.`oxdeliveryset`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdeliveryset`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdeliveryset`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdeliveryset`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdeliveryset`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdeliveryset`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdeliveryset`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdeliveryset`.`OXPOS` AS `OXPOS` from `eshop_ee`.`oxdeliveryset` where (((`eshop_ee`.`oxdeliveryset`.`OXSHOPINCL` & 2) > 0) and ((`eshop_ee`.`oxdeliveryset`.`OXSHOPEXCL` & 2) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdeliveryset_3`
-- 
DROP TABLE IF EXISTS `oxv_oxdeliveryset_3`;

DROP VIEW IF EXISTS `oxv_oxdeliveryset_3`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdeliveryset_3` AS select `eshop_ee`.`oxdeliveryset`.`OXID` AS `OXID`,`eshop_ee`.`oxdeliveryset`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdeliveryset`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdeliveryset`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdeliveryset`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdeliveryset`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdeliveryset`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdeliveryset`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdeliveryset`.`OXPOS` AS `OXPOS` from `eshop_ee`.`oxdeliveryset` where (((`eshop_ee`.`oxdeliveryset`.`OXSHOPINCL` & 5) > 0) and ((`eshop_ee`.`oxdeliveryset`.`OXSHOPEXCL` & 4) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdeliveryset_4`
-- 
DROP TABLE IF EXISTS `oxv_oxdeliveryset_4`;

DROP VIEW IF EXISTS `oxv_oxdeliveryset_4`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdeliveryset_4` AS select `eshop_ee`.`oxdeliveryset`.`OXID` AS `OXID`,`eshop_ee`.`oxdeliveryset`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdeliveryset`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdeliveryset`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdeliveryset`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdeliveryset`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdeliveryset`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdeliveryset`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdeliveryset`.`OXPOS` AS `OXPOS` from `eshop_ee`.`oxdeliveryset` where (((`eshop_ee`.`oxdeliveryset`.`OXSHOPINCL` & 8) > 0) and ((`eshop_ee`.`oxdeliveryset`.`OXSHOPEXCL` & 8) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdeliveryset_5`
-- 
DROP TABLE IF EXISTS `oxv_oxdeliveryset_5`;

DROP VIEW IF EXISTS `oxv_oxdeliveryset_5`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdeliveryset_5` AS select `eshop_ee`.`oxdeliveryset`.`OXID` AS `OXID`,`eshop_ee`.`oxdeliveryset`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdeliveryset`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdeliveryset`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdeliveryset`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdeliveryset`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdeliveryset`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdeliveryset`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdeliveryset`.`OXPOS` AS `OXPOS` from `eshop_ee`.`oxdeliveryset` where (((`eshop_ee`.`oxdeliveryset`.`OXSHOPINCL` & 16) > 0) and ((`eshop_ee`.`oxdeliveryset`.`OXSHOPEXCL` & 16) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdeliveryset_6`
-- 
DROP TABLE IF EXISTS `oxv_oxdeliveryset_6`;

DROP VIEW IF EXISTS `oxv_oxdeliveryset_6`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdeliveryset_6` AS select `eshop_ee`.`oxdeliveryset`.`OXID` AS `OXID`,`eshop_ee`.`oxdeliveryset`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdeliveryset`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdeliveryset`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdeliveryset`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdeliveryset`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdeliveryset`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdeliveryset`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdeliveryset`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdeliveryset`.`OXPOS` AS `OXPOS` from `eshop_ee`.`oxdeliveryset` where (((`eshop_ee`.`oxdeliveryset`.`OXSHOPINCL` & 32) > 0) and ((`eshop_ee`.`oxdeliveryset`.`OXSHOPEXCL` & 32) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdelivery_1`
-- 
DROP TABLE IF EXISTS `oxv_oxdelivery_1`;

DROP VIEW IF EXISTS `oxv_oxdelivery_1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdelivery_1` AS select `eshop_ee`.`oxdelivery`.`OXID` AS `OXID`,`eshop_ee`.`oxdelivery`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdelivery`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdelivery`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdelivery`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdelivery`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdelivery`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdelivery`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdelivery`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdelivery`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdelivery`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdelivery`.`OXADDSUMTYPE` AS `OXADDSUMTYPE`,`eshop_ee`.`oxdelivery`.`OXADDSUM` AS `OXADDSUM`,`eshop_ee`.`oxdelivery`.`OXDELTYPE` AS `OXDELTYPE`,`eshop_ee`.`oxdelivery`.`OXPARAM` AS `OXPARAM`,`eshop_ee`.`oxdelivery`.`OXPARAMEND` AS `OXPARAMEND`,`eshop_ee`.`oxdelivery`.`OXFIXED` AS `OXFIXED`,`eshop_ee`.`oxdelivery`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxdelivery`.`OXFINALIZE` AS `OXFINALIZE` from `eshop_ee`.`oxdelivery` where (((`eshop_ee`.`oxdelivery`.`OXSHOPINCL` & 1) > 0) and ((`eshop_ee`.`oxdelivery`.`OXSHOPEXCL` & 1) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdelivery_2`
-- 
DROP TABLE IF EXISTS `oxv_oxdelivery_2`;

DROP VIEW IF EXISTS `oxv_oxdelivery_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdelivery_2` AS select `eshop_ee`.`oxdelivery`.`OXID` AS `OXID`,`eshop_ee`.`oxdelivery`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdelivery`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdelivery`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdelivery`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdelivery`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdelivery`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdelivery`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdelivery`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdelivery`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdelivery`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdelivery`.`OXADDSUMTYPE` AS `OXADDSUMTYPE`,`eshop_ee`.`oxdelivery`.`OXADDSUM` AS `OXADDSUM`,`eshop_ee`.`oxdelivery`.`OXDELTYPE` AS `OXDELTYPE`,`eshop_ee`.`oxdelivery`.`OXPARAM` AS `OXPARAM`,`eshop_ee`.`oxdelivery`.`OXPARAMEND` AS `OXPARAMEND`,`eshop_ee`.`oxdelivery`.`OXFIXED` AS `OXFIXED`,`eshop_ee`.`oxdelivery`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxdelivery`.`OXFINALIZE` AS `OXFINALIZE` from `eshop_ee`.`oxdelivery` where (((`eshop_ee`.`oxdelivery`.`OXSHOPINCL` & 2) > 0) and ((`eshop_ee`.`oxdelivery`.`OXSHOPEXCL` & 2) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdelivery_3`
-- 
DROP TABLE IF EXISTS `oxv_oxdelivery_3`;

DROP VIEW IF EXISTS `oxv_oxdelivery_3`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdelivery_3` AS select `eshop_ee`.`oxdelivery`.`OXID` AS `OXID`,`eshop_ee`.`oxdelivery`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdelivery`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdelivery`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdelivery`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdelivery`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdelivery`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdelivery`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdelivery`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdelivery`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdelivery`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdelivery`.`OXADDSUMTYPE` AS `OXADDSUMTYPE`,`eshop_ee`.`oxdelivery`.`OXADDSUM` AS `OXADDSUM`,`eshop_ee`.`oxdelivery`.`OXDELTYPE` AS `OXDELTYPE`,`eshop_ee`.`oxdelivery`.`OXPARAM` AS `OXPARAM`,`eshop_ee`.`oxdelivery`.`OXPARAMEND` AS `OXPARAMEND`,`eshop_ee`.`oxdelivery`.`OXFIXED` AS `OXFIXED`,`eshop_ee`.`oxdelivery`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxdelivery`.`OXFINALIZE` AS `OXFINALIZE` from `eshop_ee`.`oxdelivery` where (((`eshop_ee`.`oxdelivery`.`OXSHOPINCL` & 5) > 0) and ((`eshop_ee`.`oxdelivery`.`OXSHOPEXCL` & 4) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdelivery_4`
-- 
DROP TABLE IF EXISTS `oxv_oxdelivery_4`;

DROP VIEW IF EXISTS `oxv_oxdelivery_4`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdelivery_4` AS select `eshop_ee`.`oxdelivery`.`OXID` AS `OXID`,`eshop_ee`.`oxdelivery`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdelivery`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdelivery`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdelivery`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdelivery`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdelivery`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdelivery`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdelivery`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdelivery`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdelivery`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdelivery`.`OXADDSUMTYPE` AS `OXADDSUMTYPE`,`eshop_ee`.`oxdelivery`.`OXADDSUM` AS `OXADDSUM`,`eshop_ee`.`oxdelivery`.`OXDELTYPE` AS `OXDELTYPE`,`eshop_ee`.`oxdelivery`.`OXPARAM` AS `OXPARAM`,`eshop_ee`.`oxdelivery`.`OXPARAMEND` AS `OXPARAMEND`,`eshop_ee`.`oxdelivery`.`OXFIXED` AS `OXFIXED`,`eshop_ee`.`oxdelivery`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxdelivery`.`OXFINALIZE` AS `OXFINALIZE` from `eshop_ee`.`oxdelivery` where (((`eshop_ee`.`oxdelivery`.`OXSHOPINCL` & 8) > 0) and ((`eshop_ee`.`oxdelivery`.`OXSHOPEXCL` & 8) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdelivery_5`
-- 
DROP TABLE IF EXISTS `oxv_oxdelivery_5`;

DROP VIEW IF EXISTS `oxv_oxdelivery_5`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdelivery_5` AS select `eshop_ee`.`oxdelivery`.`OXID` AS `OXID`,`eshop_ee`.`oxdelivery`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdelivery`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdelivery`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdelivery`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdelivery`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdelivery`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdelivery`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdelivery`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdelivery`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdelivery`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdelivery`.`OXADDSUMTYPE` AS `OXADDSUMTYPE`,`eshop_ee`.`oxdelivery`.`OXADDSUM` AS `OXADDSUM`,`eshop_ee`.`oxdelivery`.`OXDELTYPE` AS `OXDELTYPE`,`eshop_ee`.`oxdelivery`.`OXPARAM` AS `OXPARAM`,`eshop_ee`.`oxdelivery`.`OXPARAMEND` AS `OXPARAMEND`,`eshop_ee`.`oxdelivery`.`OXFIXED` AS `OXFIXED`,`eshop_ee`.`oxdelivery`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxdelivery`.`OXFINALIZE` AS `OXFINALIZE` from `eshop_ee`.`oxdelivery` where (((`eshop_ee`.`oxdelivery`.`OXSHOPINCL` & 16) > 0) and ((`eshop_ee`.`oxdelivery`.`OXSHOPEXCL` & 16) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdelivery_6`
-- 
DROP TABLE IF EXISTS `oxv_oxdelivery_6`;

DROP VIEW IF EXISTS `oxv_oxdelivery_6`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdelivery_6` AS select `eshop_ee`.`oxdelivery`.`OXID` AS `OXID`,`eshop_ee`.`oxdelivery`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdelivery`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdelivery`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdelivery`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdelivery`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdelivery`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdelivery`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdelivery`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdelivery`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdelivery`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdelivery`.`OXADDSUMTYPE` AS `OXADDSUMTYPE`,`eshop_ee`.`oxdelivery`.`OXADDSUM` AS `OXADDSUM`,`eshop_ee`.`oxdelivery`.`OXDELTYPE` AS `OXDELTYPE`,`eshop_ee`.`oxdelivery`.`OXPARAM` AS `OXPARAM`,`eshop_ee`.`oxdelivery`.`OXPARAMEND` AS `OXPARAMEND`,`eshop_ee`.`oxdelivery`.`OXFIXED` AS `OXFIXED`,`eshop_ee`.`oxdelivery`.`OXSORT` AS `OXSORT`,`eshop_ee`.`oxdelivery`.`OXFINALIZE` AS `OXFINALIZE` from `eshop_ee`.`oxdelivery` where (((`eshop_ee`.`oxdelivery`.`OXSHOPINCL` & 32) > 0) and ((`eshop_ee`.`oxdelivery`.`OXSHOPEXCL` & 32) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdiscount_1`
-- 
DROP TABLE IF EXISTS `oxv_oxdiscount_1`;

DROP VIEW IF EXISTS `oxv_oxdiscount_1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdiscount_1` AS select `eshop_ee`.`oxdiscount`.`OXID` AS `OXID`,`eshop_ee`.`oxdiscount`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdiscount`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdiscount`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdiscount`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdiscount`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdiscount`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdiscount`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdiscount`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdiscount`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdiscount`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdiscount`.`OXAMOUNT` AS `OXAMOUNT`,`eshop_ee`.`oxdiscount`.`OXAMOUNTTO` AS `OXAMOUNTTO`,`eshop_ee`.`oxdiscount`.`OXPRICETO` AS `OXPRICETO`,`eshop_ee`.`oxdiscount`.`OXPRICE` AS `OXPRICE`,`eshop_ee`.`oxdiscount`.`OXADDSUMTYPE` AS `OXADDSUMTYPE`,`eshop_ee`.`oxdiscount`.`OXADDSUM` AS `OXADDSUM`,`eshop_ee`.`oxdiscount`.`OXITMARTID` AS `OXITMARTID`,`eshop_ee`.`oxdiscount`.`OXITMAMOUNT` AS `OXITMAMOUNT`,`eshop_ee`.`oxdiscount`.`OXITMMULTIPLE` AS `OXITMMULTIPLE` from `eshop_ee`.`oxdiscount` where (((`eshop_ee`.`oxdiscount`.`OXSHOPINCL` & 1) > 0) and ((`eshop_ee`.`oxdiscount`.`OXSHOPEXCL` & 1) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdiscount_2`
-- 
DROP TABLE IF EXISTS `oxv_oxdiscount_2`;

DROP VIEW IF EXISTS `oxv_oxdiscount_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdiscount_2` AS select `eshop_ee`.`oxdiscount`.`OXID` AS `OXID`,`eshop_ee`.`oxdiscount`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdiscount`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdiscount`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdiscount`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdiscount`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdiscount`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdiscount`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdiscount`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdiscount`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdiscount`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdiscount`.`OXAMOUNT` AS `OXAMOUNT`,`eshop_ee`.`oxdiscount`.`OXAMOUNTTO` AS `OXAMOUNTTO`,`eshop_ee`.`oxdiscount`.`OXPRICETO` AS `OXPRICETO`,`eshop_ee`.`oxdiscount`.`OXPRICE` AS `OXPRICE`,`eshop_ee`.`oxdiscount`.`OXADDSUMTYPE` AS `OXADDSUMTYPE`,`eshop_ee`.`oxdiscount`.`OXADDSUM` AS `OXADDSUM`,`eshop_ee`.`oxdiscount`.`OXITMARTID` AS `OXITMARTID`,`eshop_ee`.`oxdiscount`.`OXITMAMOUNT` AS `OXITMAMOUNT`,`eshop_ee`.`oxdiscount`.`OXITMMULTIPLE` AS `OXITMMULTIPLE` from `eshop_ee`.`oxdiscount` where (((`eshop_ee`.`oxdiscount`.`OXSHOPINCL` & 2) > 0) and ((`eshop_ee`.`oxdiscount`.`OXSHOPEXCL` & 2) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdiscount_3`
-- 
DROP TABLE IF EXISTS `oxv_oxdiscount_3`;

DROP VIEW IF EXISTS `oxv_oxdiscount_3`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdiscount_3` AS select `eshop_ee`.`oxdiscount`.`OXID` AS `OXID`,`eshop_ee`.`oxdiscount`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdiscount`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdiscount`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdiscount`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdiscount`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdiscount`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdiscount`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdiscount`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdiscount`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdiscount`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdiscount`.`OXAMOUNT` AS `OXAMOUNT`,`eshop_ee`.`oxdiscount`.`OXAMOUNTTO` AS `OXAMOUNTTO`,`eshop_ee`.`oxdiscount`.`OXPRICETO` AS `OXPRICETO`,`eshop_ee`.`oxdiscount`.`OXPRICE` AS `OXPRICE`,`eshop_ee`.`oxdiscount`.`OXADDSUMTYPE` AS `OXADDSUMTYPE`,`eshop_ee`.`oxdiscount`.`OXADDSUM` AS `OXADDSUM`,`eshop_ee`.`oxdiscount`.`OXITMARTID` AS `OXITMARTID`,`eshop_ee`.`oxdiscount`.`OXITMAMOUNT` AS `OXITMAMOUNT`,`eshop_ee`.`oxdiscount`.`OXITMMULTIPLE` AS `OXITMMULTIPLE` from `eshop_ee`.`oxdiscount` where (((`eshop_ee`.`oxdiscount`.`OXSHOPINCL` & 5) > 0) and ((`eshop_ee`.`oxdiscount`.`OXSHOPEXCL` & 4) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdiscount_4`
-- 
DROP TABLE IF EXISTS `oxv_oxdiscount_4`;

DROP VIEW IF EXISTS `oxv_oxdiscount_4`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdiscount_4` AS select `eshop_ee`.`oxdiscount`.`OXID` AS `OXID`,`eshop_ee`.`oxdiscount`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdiscount`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdiscount`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdiscount`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdiscount`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdiscount`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdiscount`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdiscount`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdiscount`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdiscount`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdiscount`.`OXAMOUNT` AS `OXAMOUNT`,`eshop_ee`.`oxdiscount`.`OXAMOUNTTO` AS `OXAMOUNTTO`,`eshop_ee`.`oxdiscount`.`OXPRICETO` AS `OXPRICETO`,`eshop_ee`.`oxdiscount`.`OXPRICE` AS `OXPRICE`,`eshop_ee`.`oxdiscount`.`OXADDSUMTYPE` AS `OXADDSUMTYPE`,`eshop_ee`.`oxdiscount`.`OXADDSUM` AS `OXADDSUM`,`eshop_ee`.`oxdiscount`.`OXITMARTID` AS `OXITMARTID`,`eshop_ee`.`oxdiscount`.`OXITMAMOUNT` AS `OXITMAMOUNT`,`eshop_ee`.`oxdiscount`.`OXITMMULTIPLE` AS `OXITMMULTIPLE` from `eshop_ee`.`oxdiscount` where (((`eshop_ee`.`oxdiscount`.`OXSHOPINCL` & 8) > 0) and ((`eshop_ee`.`oxdiscount`.`OXSHOPEXCL` & 8) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdiscount_5`
-- 
DROP TABLE IF EXISTS `oxv_oxdiscount_5`;

DROP VIEW IF EXISTS `oxv_oxdiscount_5`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdiscount_5` AS select `eshop_ee`.`oxdiscount`.`OXID` AS `OXID`,`eshop_ee`.`oxdiscount`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdiscount`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdiscount`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdiscount`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdiscount`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdiscount`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdiscount`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdiscount`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdiscount`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdiscount`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdiscount`.`OXAMOUNT` AS `OXAMOUNT`,`eshop_ee`.`oxdiscount`.`OXAMOUNTTO` AS `OXAMOUNTTO`,`eshop_ee`.`oxdiscount`.`OXPRICETO` AS `OXPRICETO`,`eshop_ee`.`oxdiscount`.`OXPRICE` AS `OXPRICE`,`eshop_ee`.`oxdiscount`.`OXADDSUMTYPE` AS `OXADDSUMTYPE`,`eshop_ee`.`oxdiscount`.`OXADDSUM` AS `OXADDSUM`,`eshop_ee`.`oxdiscount`.`OXITMARTID` AS `OXITMARTID`,`eshop_ee`.`oxdiscount`.`OXITMAMOUNT` AS `OXITMAMOUNT`,`eshop_ee`.`oxdiscount`.`OXITMMULTIPLE` AS `OXITMMULTIPLE` from `eshop_ee`.`oxdiscount` where (((`eshop_ee`.`oxdiscount`.`OXSHOPINCL` & 16) > 0) and ((`eshop_ee`.`oxdiscount`.`OXSHOPEXCL` & 16) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxdiscount_6`
-- 
DROP TABLE IF EXISTS `oxv_oxdiscount_6`;

DROP VIEW IF EXISTS `oxv_oxdiscount_6`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxdiscount_6` AS select `eshop_ee`.`oxdiscount`.`OXID` AS `OXID`,`eshop_ee`.`oxdiscount`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxdiscount`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxdiscount`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxdiscount`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxdiscount`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxdiscount`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxdiscount`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxdiscount`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxdiscount`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxdiscount`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxdiscount`.`OXAMOUNT` AS `OXAMOUNT`,`eshop_ee`.`oxdiscount`.`OXAMOUNTTO` AS `OXAMOUNTTO`,`eshop_ee`.`oxdiscount`.`OXPRICETO` AS `OXPRICETO`,`eshop_ee`.`oxdiscount`.`OXPRICE` AS `OXPRICE`,`eshop_ee`.`oxdiscount`.`OXADDSUMTYPE` AS `OXADDSUMTYPE`,`eshop_ee`.`oxdiscount`.`OXADDSUM` AS `OXADDSUM`,`eshop_ee`.`oxdiscount`.`OXITMARTID` AS `OXITMARTID`,`eshop_ee`.`oxdiscount`.`OXITMAMOUNT` AS `OXITMAMOUNT`,`eshop_ee`.`oxdiscount`.`OXITMMULTIPLE` AS `OXITMMULTIPLE` from `eshop_ee`.`oxdiscount` where (((`eshop_ee`.`oxdiscount`.`OXSHOPINCL` & 32) > 0) and ((`eshop_ee`.`oxdiscount`.`OXSHOPEXCL` & 32) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxlinks_1`
-- 
DROP TABLE IF EXISTS `oxv_oxlinks_1`;

DROP VIEW IF EXISTS `oxv_oxlinks_1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxlinks_1` AS select `eshop_ee`.`oxlinks`.`OXID` AS `OXID`,`eshop_ee`.`oxlinks`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxlinks`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxlinks`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxlinks`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxlinks`.`OXURL` AS `OXURL`,`eshop_ee`.`oxlinks`.`OXURLDESC` AS `OXURLDESC`,`eshop_ee`.`oxlinks`.`OXURLDESC_1` AS `OXURLDESC_1`,`eshop_ee`.`oxlinks`.`OXURLDESC_2` AS `OXURLDESC_2`,`eshop_ee`.`oxlinks`.`OXURLDESC_3` AS `OXURLDESC_3`,`eshop_ee`.`oxlinks`.`OXURLDESC_4` AS `OXURLDESC_4`,`eshop_ee`.`oxlinks`.`OXINSERT` AS `OXINSERT` from `eshop_ee`.`oxlinks` where (((`eshop_ee`.`oxlinks`.`OXSHOPINCL` & 1) > 0) and ((`eshop_ee`.`oxlinks`.`OXSHOPEXCL` & 1) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxlinks_2`
-- 
DROP TABLE IF EXISTS `oxv_oxlinks_2`;

DROP VIEW IF EXISTS `oxv_oxlinks_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxlinks_2` AS select `eshop_ee`.`oxlinks`.`OXID` AS `OXID`,`eshop_ee`.`oxlinks`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxlinks`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxlinks`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxlinks`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxlinks`.`OXURL` AS `OXURL`,`eshop_ee`.`oxlinks`.`OXURLDESC` AS `OXURLDESC`,`eshop_ee`.`oxlinks`.`OXURLDESC_1` AS `OXURLDESC_1`,`eshop_ee`.`oxlinks`.`OXURLDESC_2` AS `OXURLDESC_2`,`eshop_ee`.`oxlinks`.`OXURLDESC_3` AS `OXURLDESC_3`,`eshop_ee`.`oxlinks`.`OXURLDESC_4` AS `OXURLDESC_4`,`eshop_ee`.`oxlinks`.`OXINSERT` AS `OXINSERT` from `eshop_ee`.`oxlinks` where (((`eshop_ee`.`oxlinks`.`OXSHOPINCL` & 2) > 0) and ((`eshop_ee`.`oxlinks`.`OXSHOPEXCL` & 2) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxlinks_3`
-- 
DROP TABLE IF EXISTS `oxv_oxlinks_3`;

DROP VIEW IF EXISTS `oxv_oxlinks_3`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxlinks_3` AS select `eshop_ee`.`oxlinks`.`OXID` AS `OXID`,`eshop_ee`.`oxlinks`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxlinks`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxlinks`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxlinks`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxlinks`.`OXURL` AS `OXURL`,`eshop_ee`.`oxlinks`.`OXURLDESC` AS `OXURLDESC`,`eshop_ee`.`oxlinks`.`OXURLDESC_1` AS `OXURLDESC_1`,`eshop_ee`.`oxlinks`.`OXURLDESC_2` AS `OXURLDESC_2`,`eshop_ee`.`oxlinks`.`OXURLDESC_3` AS `OXURLDESC_3`,`eshop_ee`.`oxlinks`.`OXURLDESC_4` AS `OXURLDESC_4`,`eshop_ee`.`oxlinks`.`OXINSERT` AS `OXINSERT` from `eshop_ee`.`oxlinks` where (((`eshop_ee`.`oxlinks`.`OXSHOPINCL` & 5) > 0) and ((`eshop_ee`.`oxlinks`.`OXSHOPEXCL` & 4) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxlinks_4`
-- 
DROP TABLE IF EXISTS `oxv_oxlinks_4`;

DROP VIEW IF EXISTS `oxv_oxlinks_4`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxlinks_4` AS select `eshop_ee`.`oxlinks`.`OXID` AS `OXID`,`eshop_ee`.`oxlinks`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxlinks`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxlinks`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxlinks`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxlinks`.`OXURL` AS `OXURL`,`eshop_ee`.`oxlinks`.`OXURLDESC` AS `OXURLDESC`,`eshop_ee`.`oxlinks`.`OXURLDESC_1` AS `OXURLDESC_1`,`eshop_ee`.`oxlinks`.`OXURLDESC_2` AS `OXURLDESC_2`,`eshop_ee`.`oxlinks`.`OXURLDESC_3` AS `OXURLDESC_3`,`eshop_ee`.`oxlinks`.`OXURLDESC_4` AS `OXURLDESC_4`,`eshop_ee`.`oxlinks`.`OXINSERT` AS `OXINSERT` from `eshop_ee`.`oxlinks` where (((`eshop_ee`.`oxlinks`.`OXSHOPINCL` & 8) > 0) and ((`eshop_ee`.`oxlinks`.`OXSHOPEXCL` & 8) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxlinks_5`
-- 
DROP TABLE IF EXISTS `oxv_oxlinks_5`;

DROP VIEW IF EXISTS `oxv_oxlinks_5`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxlinks_5` AS select `eshop_ee`.`oxlinks`.`OXID` AS `OXID`,`eshop_ee`.`oxlinks`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxlinks`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxlinks`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxlinks`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxlinks`.`OXURL` AS `OXURL`,`eshop_ee`.`oxlinks`.`OXURLDESC` AS `OXURLDESC`,`eshop_ee`.`oxlinks`.`OXURLDESC_1` AS `OXURLDESC_1`,`eshop_ee`.`oxlinks`.`OXURLDESC_2` AS `OXURLDESC_2`,`eshop_ee`.`oxlinks`.`OXURLDESC_3` AS `OXURLDESC_3`,`eshop_ee`.`oxlinks`.`OXURLDESC_4` AS `OXURLDESC_4`,`eshop_ee`.`oxlinks`.`OXINSERT` AS `OXINSERT` from `eshop_ee`.`oxlinks` where (((`eshop_ee`.`oxlinks`.`OXSHOPINCL` & 16) > 0) and ((`eshop_ee`.`oxlinks`.`OXSHOPEXCL` & 16) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxlinks_6`
-- 
DROP TABLE IF EXISTS `oxv_oxlinks_6`;

DROP VIEW IF EXISTS `oxv_oxlinks_6`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxlinks_6` AS select `eshop_ee`.`oxlinks`.`OXID` AS `OXID`,`eshop_ee`.`oxlinks`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxlinks`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxlinks`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxlinks`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxlinks`.`OXURL` AS `OXURL`,`eshop_ee`.`oxlinks`.`OXURLDESC` AS `OXURLDESC`,`eshop_ee`.`oxlinks`.`OXURLDESC_1` AS `OXURLDESC_1`,`eshop_ee`.`oxlinks`.`OXURLDESC_2` AS `OXURLDESC_2`,`eshop_ee`.`oxlinks`.`OXURLDESC_3` AS `OXURLDESC_3`,`eshop_ee`.`oxlinks`.`OXURLDESC_4` AS `OXURLDESC_4`,`eshop_ee`.`oxlinks`.`OXINSERT` AS `OXINSERT` from `eshop_ee`.`oxlinks` where (((`eshop_ee`.`oxlinks`.`OXSHOPINCL` & 32) > 0) and ((`eshop_ee`.`oxlinks`.`OXSHOPEXCL` & 32) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxnews_1`
-- 
DROP TABLE IF EXISTS `oxv_oxnews_1`;

DROP VIEW IF EXISTS `oxv_oxnews_1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxnews_1` AS select `eshop_ee`.`oxnews`.`OXID` AS `OXID`,`eshop_ee`.`oxnews`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxnews`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxnews`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxnews`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxnews`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxnews`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxnews`.`OXDATE` AS `OXDATE`,`eshop_ee`.`oxnews`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxnews`.`OXLONGDESC` AS `OXLONGDESC`,`eshop_ee`.`oxnews`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxnews`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxnews`.`OXLONGDESC_1` AS `OXLONGDESC_1`,`eshop_ee`.`oxnews`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxnews`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxnews`.`OXLONGDESC_2` AS `OXLONGDESC_2`,`eshop_ee`.`oxnews`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxnews`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxnews`.`OXLONGDESC_3` AS `OXLONGDESC_3` from `eshop_ee`.`oxnews` where (((`eshop_ee`.`oxnews`.`OXSHOPINCL` & 1) > 0) and ((`eshop_ee`.`oxnews`.`OXSHOPEXCL` & 1) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxnews_2`
-- 
DROP TABLE IF EXISTS `oxv_oxnews_2`;

DROP VIEW IF EXISTS `oxv_oxnews_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxnews_2` AS select `eshop_ee`.`oxnews`.`OXID` AS `OXID`,`eshop_ee`.`oxnews`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxnews`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxnews`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxnews`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxnews`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxnews`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxnews`.`OXDATE` AS `OXDATE`,`eshop_ee`.`oxnews`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxnews`.`OXLONGDESC` AS `OXLONGDESC`,`eshop_ee`.`oxnews`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxnews`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxnews`.`OXLONGDESC_1` AS `OXLONGDESC_1`,`eshop_ee`.`oxnews`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxnews`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxnews`.`OXLONGDESC_2` AS `OXLONGDESC_2`,`eshop_ee`.`oxnews`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxnews`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxnews`.`OXLONGDESC_3` AS `OXLONGDESC_3` from `eshop_ee`.`oxnews` where (((`eshop_ee`.`oxnews`.`OXSHOPINCL` & 2) > 0) and ((`eshop_ee`.`oxnews`.`OXSHOPEXCL` & 2) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxnews_3`
-- 
DROP TABLE IF EXISTS `oxv_oxnews_3`;

DROP VIEW IF EXISTS `oxv_oxnews_3`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxnews_3` AS select `eshop_ee`.`oxnews`.`OXID` AS `OXID`,`eshop_ee`.`oxnews`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxnews`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxnews`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxnews`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxnews`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxnews`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxnews`.`OXDATE` AS `OXDATE`,`eshop_ee`.`oxnews`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxnews`.`OXLONGDESC` AS `OXLONGDESC`,`eshop_ee`.`oxnews`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxnews`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxnews`.`OXLONGDESC_1` AS `OXLONGDESC_1`,`eshop_ee`.`oxnews`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxnews`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxnews`.`OXLONGDESC_2` AS `OXLONGDESC_2`,`eshop_ee`.`oxnews`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxnews`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxnews`.`OXLONGDESC_3` AS `OXLONGDESC_3` from `eshop_ee`.`oxnews` where (((`eshop_ee`.`oxnews`.`OXSHOPINCL` & 5) > 0) and ((`eshop_ee`.`oxnews`.`OXSHOPEXCL` & 4) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxnews_4`
-- 
DROP TABLE IF EXISTS `oxv_oxnews_4`;

DROP VIEW IF EXISTS `oxv_oxnews_4`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxnews_4` AS select `eshop_ee`.`oxnews`.`OXID` AS `OXID`,`eshop_ee`.`oxnews`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxnews`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxnews`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxnews`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxnews`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxnews`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxnews`.`OXDATE` AS `OXDATE`,`eshop_ee`.`oxnews`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxnews`.`OXLONGDESC` AS `OXLONGDESC`,`eshop_ee`.`oxnews`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxnews`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxnews`.`OXLONGDESC_1` AS `OXLONGDESC_1`,`eshop_ee`.`oxnews`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxnews`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxnews`.`OXLONGDESC_2` AS `OXLONGDESC_2`,`eshop_ee`.`oxnews`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxnews`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxnews`.`OXLONGDESC_3` AS `OXLONGDESC_3` from `eshop_ee`.`oxnews` where (((`eshop_ee`.`oxnews`.`OXSHOPINCL` & 8) > 0) and ((`eshop_ee`.`oxnews`.`OXSHOPEXCL` & 8) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxnews_5`
-- 
DROP TABLE IF EXISTS `oxv_oxnews_5`;

DROP VIEW IF EXISTS `oxv_oxnews_5`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxnews_5` AS select `eshop_ee`.`oxnews`.`OXID` AS `OXID`,`eshop_ee`.`oxnews`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxnews`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxnews`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxnews`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxnews`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxnews`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxnews`.`OXDATE` AS `OXDATE`,`eshop_ee`.`oxnews`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxnews`.`OXLONGDESC` AS `OXLONGDESC`,`eshop_ee`.`oxnews`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxnews`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxnews`.`OXLONGDESC_1` AS `OXLONGDESC_1`,`eshop_ee`.`oxnews`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxnews`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxnews`.`OXLONGDESC_2` AS `OXLONGDESC_2`,`eshop_ee`.`oxnews`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxnews`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxnews`.`OXLONGDESC_3` AS `OXLONGDESC_3` from `eshop_ee`.`oxnews` where (((`eshop_ee`.`oxnews`.`OXSHOPINCL` & 16) > 0) and ((`eshop_ee`.`oxnews`.`OXSHOPEXCL` & 16) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxnews_6`
-- 
DROP TABLE IF EXISTS `oxv_oxnews_6`;

DROP VIEW IF EXISTS `oxv_oxnews_6`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxnews_6` AS select `eshop_ee`.`oxnews`.`OXID` AS `OXID`,`eshop_ee`.`oxnews`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxnews`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxnews`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxnews`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxnews`.`OXACTIVEFROM` AS `OXACTIVEFROM`,`eshop_ee`.`oxnews`.`OXACTIVETO` AS `OXACTIVETO`,`eshop_ee`.`oxnews`.`OXDATE` AS `OXDATE`,`eshop_ee`.`oxnews`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxnews`.`OXLONGDESC` AS `OXLONGDESC`,`eshop_ee`.`oxnews`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxnews`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxnews`.`OXLONGDESC_1` AS `OXLONGDESC_1`,`eshop_ee`.`oxnews`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxnews`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxnews`.`OXLONGDESC_2` AS `OXLONGDESC_2`,`eshop_ee`.`oxnews`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxnews`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxnews`.`OXLONGDESC_3` AS `OXLONGDESC_3` from `eshop_ee`.`oxnews` where (((`eshop_ee`.`oxnews`.`OXSHOPINCL` & 32) > 0) and ((`eshop_ee`.`oxnews`.`OXSHOPEXCL` & 32) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxobject2category_1`
-- 
DROP TABLE IF EXISTS `oxv_oxobject2category_1`;

DROP VIEW IF EXISTS `oxv_oxobject2category_1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxobject2category_1` AS select `eshop_ee`.`oxobject2category`.`OXID` AS `OXID`,`eshop_ee`.`oxobject2category`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxobject2category`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxobject2category`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxobject2category`.`OXOBJECTID` AS `OXOBJECTID`,`eshop_ee`.`oxobject2category`.`OXCATNID` AS `OXCATNID`,`eshop_ee`.`oxobject2category`.`OXPOS` AS `OXPOS`,`eshop_ee`.`oxobject2category`.`OXTIME` AS `OXTIME` from `eshop_ee`.`oxobject2category` where (((`eshop_ee`.`oxobject2category`.`OXSHOPINCL` & 1) = 1) and ((`eshop_ee`.`oxobject2category`.`OXSHOPEXCL` & 1) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxobject2category_2`
-- 
DROP TABLE IF EXISTS `oxv_oxobject2category_2`;

DROP VIEW IF EXISTS `oxv_oxobject2category_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxobject2category_2` AS select `eshop_ee`.`oxobject2category`.`OXID` AS `OXID`,`eshop_ee`.`oxobject2category`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxobject2category`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxobject2category`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxobject2category`.`OXOBJECTID` AS `OXOBJECTID`,`eshop_ee`.`oxobject2category`.`OXCATNID` AS `OXCATNID`,`eshop_ee`.`oxobject2category`.`OXPOS` AS `OXPOS`,`eshop_ee`.`oxobject2category`.`OXTIME` AS `OXTIME` from `eshop_ee`.`oxobject2category` where (((`eshop_ee`.`oxobject2category`.`OXSHOPINCL` & 2) > 0) and ((`eshop_ee`.`oxobject2category`.`OXSHOPEXCL` & 2) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxobject2category_3`
-- 
DROP TABLE IF EXISTS `oxv_oxobject2category_3`;

DROP VIEW IF EXISTS `oxv_oxobject2category_3`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxobject2category_3` AS select `eshop_ee`.`oxobject2category`.`OXID` AS `OXID`,`eshop_ee`.`oxobject2category`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxobject2category`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxobject2category`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxobject2category`.`OXOBJECTID` AS `OXOBJECTID`,`eshop_ee`.`oxobject2category`.`OXCATNID` AS `OXCATNID`,`eshop_ee`.`oxobject2category`.`OXPOS` AS `OXPOS`,`eshop_ee`.`oxobject2category`.`OXTIME` AS `OXTIME` from `eshop_ee`.`oxobject2category` where (((`eshop_ee`.`oxobject2category`.`OXSHOPINCL` & 5) > 0) and ((`eshop_ee`.`oxobject2category`.`OXSHOPEXCL` & 4) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxobject2category_4`
-- 
DROP TABLE IF EXISTS `oxv_oxobject2category_4`;

DROP VIEW IF EXISTS `oxv_oxobject2category_4`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxobject2category_4` AS select `eshop_ee`.`oxobject2category`.`OXID` AS `OXID`,`eshop_ee`.`oxobject2category`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxobject2category`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxobject2category`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxobject2category`.`OXOBJECTID` AS `OXOBJECTID`,`eshop_ee`.`oxobject2category`.`OXCATNID` AS `OXCATNID`,`eshop_ee`.`oxobject2category`.`OXPOS` AS `OXPOS`,`eshop_ee`.`oxobject2category`.`OXTIME` AS `OXTIME` from `eshop_ee`.`oxobject2category` where (((`eshop_ee`.`oxobject2category`.`OXSHOPINCL` & 8) > 0) and ((`eshop_ee`.`oxobject2category`.`OXSHOPEXCL` & 8) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxobject2category_5`
-- 
DROP TABLE IF EXISTS `oxv_oxobject2category_5`;

DROP VIEW IF EXISTS `oxv_oxobject2category_5`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxobject2category_5` AS select `eshop_ee`.`oxobject2category`.`OXID` AS `OXID`,`eshop_ee`.`oxobject2category`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxobject2category`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxobject2category`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxobject2category`.`OXOBJECTID` AS `OXOBJECTID`,`eshop_ee`.`oxobject2category`.`OXCATNID` AS `OXCATNID`,`eshop_ee`.`oxobject2category`.`OXPOS` AS `OXPOS`,`eshop_ee`.`oxobject2category`.`OXTIME` AS `OXTIME` from `eshop_ee`.`oxobject2category` where (((`eshop_ee`.`oxobject2category`.`OXSHOPINCL` & 16) > 0) and ((`eshop_ee`.`oxobject2category`.`OXSHOPEXCL` & 16) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxobject2category_6`
-- 
DROP TABLE IF EXISTS `oxv_oxobject2category_6`;

DROP VIEW IF EXISTS `oxv_oxobject2category_6`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxobject2category_6` AS select `eshop_ee`.`oxobject2category`.`OXID` AS `OXID`,`eshop_ee`.`oxobject2category`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxobject2category`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxobject2category`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxobject2category`.`OXOBJECTID` AS `OXOBJECTID`,`eshop_ee`.`oxobject2category`.`OXCATNID` AS `OXCATNID`,`eshop_ee`.`oxobject2category`.`OXPOS` AS `OXPOS`,`eshop_ee`.`oxobject2category`.`OXTIME` AS `OXTIME` from `eshop_ee`.`oxobject2category` where (((`eshop_ee`.`oxobject2category`.`OXSHOPINCL` & 32) > 0) and ((`eshop_ee`.`oxobject2category`.`OXSHOPEXCL` & 32) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxselectlist_1`
-- 
DROP TABLE IF EXISTS `oxv_oxselectlist_1`;

DROP VIEW IF EXISTS `oxv_oxselectlist_1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxselectlist_1` AS select `eshop_ee`.`oxselectlist`.`OXID` AS `OXID`,`eshop_ee`.`oxselectlist`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxselectlist`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxselectlist`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxselectlist`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxselectlist`.`OXIDENT` AS `OXIDENT`,`eshop_ee`.`oxselectlist`.`OXVALDESC` AS `OXVALDESC`,`eshop_ee`.`oxselectlist`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxselectlist`.`OXVALDESC_1` AS `OXVALDESC_1`,`eshop_ee`.`oxselectlist`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxselectlist`.`OXVALDESC_2` AS `OXVALDESC_2`,`eshop_ee`.`oxselectlist`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxselectlist`.`OXVALDESC_3` AS `OXVALDESC_3` from `eshop_ee`.`oxselectlist` where (((`eshop_ee`.`oxselectlist`.`OXSHOPINCL` & 1) > 0) and ((`eshop_ee`.`oxselectlist`.`OXSHOPEXCL` & 1) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxselectlist_2`
-- 
DROP TABLE IF EXISTS `oxv_oxselectlist_2`;

DROP VIEW IF EXISTS `oxv_oxselectlist_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxselectlist_2` AS select `eshop_ee`.`oxselectlist`.`OXID` AS `OXID`,`eshop_ee`.`oxselectlist`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxselectlist`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxselectlist`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxselectlist`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxselectlist`.`OXIDENT` AS `OXIDENT`,`eshop_ee`.`oxselectlist`.`OXVALDESC` AS `OXVALDESC`,`eshop_ee`.`oxselectlist`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxselectlist`.`OXVALDESC_1` AS `OXVALDESC_1`,`eshop_ee`.`oxselectlist`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxselectlist`.`OXVALDESC_2` AS `OXVALDESC_2`,`eshop_ee`.`oxselectlist`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxselectlist`.`OXVALDESC_3` AS `OXVALDESC_3` from `eshop_ee`.`oxselectlist` where (((`eshop_ee`.`oxselectlist`.`OXSHOPINCL` & 2) > 0) and ((`eshop_ee`.`oxselectlist`.`OXSHOPEXCL` & 2) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxselectlist_3`
-- 
DROP TABLE IF EXISTS `oxv_oxselectlist_3`;

DROP VIEW IF EXISTS `oxv_oxselectlist_3`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxselectlist_3` AS select `eshop_ee`.`oxselectlist`.`OXID` AS `OXID`,`eshop_ee`.`oxselectlist`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxselectlist`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxselectlist`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxselectlist`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxselectlist`.`OXIDENT` AS `OXIDENT`,`eshop_ee`.`oxselectlist`.`OXVALDESC` AS `OXVALDESC`,`eshop_ee`.`oxselectlist`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxselectlist`.`OXVALDESC_1` AS `OXVALDESC_1`,`eshop_ee`.`oxselectlist`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxselectlist`.`OXVALDESC_2` AS `OXVALDESC_2`,`eshop_ee`.`oxselectlist`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxselectlist`.`OXVALDESC_3` AS `OXVALDESC_3` from `eshop_ee`.`oxselectlist` where (((`eshop_ee`.`oxselectlist`.`OXSHOPINCL` & 5) > 0) and ((`eshop_ee`.`oxselectlist`.`OXSHOPEXCL` & 4) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxselectlist_4`
-- 
DROP TABLE IF EXISTS `oxv_oxselectlist_4`;

DROP VIEW IF EXISTS `oxv_oxselectlist_4`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxselectlist_4` AS select `eshop_ee`.`oxselectlist`.`OXID` AS `OXID`,`eshop_ee`.`oxselectlist`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxselectlist`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxselectlist`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxselectlist`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxselectlist`.`OXIDENT` AS `OXIDENT`,`eshop_ee`.`oxselectlist`.`OXVALDESC` AS `OXVALDESC`,`eshop_ee`.`oxselectlist`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxselectlist`.`OXVALDESC_1` AS `OXVALDESC_1`,`eshop_ee`.`oxselectlist`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxselectlist`.`OXVALDESC_2` AS `OXVALDESC_2`,`eshop_ee`.`oxselectlist`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxselectlist`.`OXVALDESC_3` AS `OXVALDESC_3` from `eshop_ee`.`oxselectlist` where (((`eshop_ee`.`oxselectlist`.`OXSHOPINCL` & 8) > 0) and ((`eshop_ee`.`oxselectlist`.`OXSHOPEXCL` & 8) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxselectlist_5`
-- 
DROP TABLE IF EXISTS `oxv_oxselectlist_5`;

DROP VIEW IF EXISTS `oxv_oxselectlist_5`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxselectlist_5` AS select `eshop_ee`.`oxselectlist`.`OXID` AS `OXID`,`eshop_ee`.`oxselectlist`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxselectlist`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxselectlist`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxselectlist`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxselectlist`.`OXIDENT` AS `OXIDENT`,`eshop_ee`.`oxselectlist`.`OXVALDESC` AS `OXVALDESC`,`eshop_ee`.`oxselectlist`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxselectlist`.`OXVALDESC_1` AS `OXVALDESC_1`,`eshop_ee`.`oxselectlist`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxselectlist`.`OXVALDESC_2` AS `OXVALDESC_2`,`eshop_ee`.`oxselectlist`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxselectlist`.`OXVALDESC_3` AS `OXVALDESC_3` from `eshop_ee`.`oxselectlist` where (((`eshop_ee`.`oxselectlist`.`OXSHOPINCL` & 16) > 0) and ((`eshop_ee`.`oxselectlist`.`OXSHOPEXCL` & 16) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxselectlist_6`
-- 
DROP TABLE IF EXISTS `oxv_oxselectlist_6`;

DROP VIEW IF EXISTS `oxv_oxselectlist_6`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxselectlist_6` AS select `eshop_ee`.`oxselectlist`.`OXID` AS `OXID`,`eshop_ee`.`oxselectlist`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxselectlist`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxselectlist`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxselectlist`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxselectlist`.`OXIDENT` AS `OXIDENT`,`eshop_ee`.`oxselectlist`.`OXVALDESC` AS `OXVALDESC`,`eshop_ee`.`oxselectlist`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxselectlist`.`OXVALDESC_1` AS `OXVALDESC_1`,`eshop_ee`.`oxselectlist`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxselectlist`.`OXVALDESC_2` AS `OXVALDESC_2`,`eshop_ee`.`oxselectlist`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxselectlist`.`OXVALDESC_3` AS `OXVALDESC_3` from `eshop_ee`.`oxselectlist` where (((`eshop_ee`.`oxselectlist`.`OXSHOPINCL` & 32) > 0) and ((`eshop_ee`.`oxselectlist`.`OXSHOPEXCL` & 32) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxvendor_1`
-- 
DROP TABLE IF EXISTS `oxv_oxvendor_1`;

DROP VIEW IF EXISTS `oxv_oxvendor_1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxvendor_1` AS select `eshop_ee`.`oxvendor`.`OXID` AS `OXID`,`eshop_ee`.`oxvendor`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxvendor`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxvendor`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxvendor`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxvendor`.`OXICON` AS `OXICON`,`eshop_ee`.`oxvendor`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxvendor`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxvendor`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxvendor`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxvendor`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxvendor`.`OXSHOWSUFFIX` AS `OXSHOWSUFFIX` from `eshop_ee`.`oxvendor` where (((`eshop_ee`.`oxvendor`.`OXSHOPINCL` & 1) > 0) and ((`eshop_ee`.`oxvendor`.`OXSHOPEXCL` & 1) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxvendor_2`
-- 
DROP TABLE IF EXISTS `oxv_oxvendor_2`;

DROP VIEW IF EXISTS `oxv_oxvendor_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxvendor_2` AS select `eshop_ee`.`oxvendor`.`OXID` AS `OXID`,`eshop_ee`.`oxvendor`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxvendor`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxvendor`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxvendor`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxvendor`.`OXICON` AS `OXICON`,`eshop_ee`.`oxvendor`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxvendor`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxvendor`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxvendor`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxvendor`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxvendor`.`OXSHOWSUFFIX` AS `OXSHOWSUFFIX` from `eshop_ee`.`oxvendor` where (((`eshop_ee`.`oxvendor`.`OXSHOPINCL` & 2) > 0) and ((`eshop_ee`.`oxvendor`.`OXSHOPEXCL` & 2) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxvendor_3`
-- 
DROP TABLE IF EXISTS `oxv_oxvendor_3`;

DROP VIEW IF EXISTS `oxv_oxvendor_3`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxvendor_3` AS select `eshop_ee`.`oxvendor`.`OXID` AS `OXID`,`eshop_ee`.`oxvendor`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxvendor`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxvendor`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxvendor`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxvendor`.`OXICON` AS `OXICON`,`eshop_ee`.`oxvendor`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxvendor`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxvendor`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxvendor`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxvendor`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_3` AS `OXSHORTDESC_3`,`eshop_ee`.`oxvendor`.`OXSHOWSUFFIX` AS `OXSHOWSUFFIX` from `eshop_ee`.`oxvendor` where (((`eshop_ee`.`oxvendor`.`OXSHOPINCL` & 5) > 0) and ((`eshop_ee`.`oxvendor`.`OXSHOPEXCL` & 4) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxvendor_4`
-- 
DROP TABLE IF EXISTS `oxv_oxvendor_4`;

DROP VIEW IF EXISTS `oxv_oxvendor_4`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxvendor_4` AS select `eshop_ee`.`oxvendor`.`OXID` AS `OXID`,`eshop_ee`.`oxvendor`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxvendor`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxvendor`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxvendor`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxvendor`.`OXICON` AS `OXICON`,`eshop_ee`.`oxvendor`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxvendor`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxvendor`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxvendor`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxvendor`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_3` AS `OXSHORTDESC_3` from `eshop_ee`.`oxvendor` where (((`eshop_ee`.`oxvendor`.`OXSHOPINCL` & 8) > 0) and ((`eshop_ee`.`oxvendor`.`OXSHOPEXCL` & 8) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxvendor_5`
-- 
DROP TABLE IF EXISTS `oxv_oxvendor_5`;

DROP VIEW IF EXISTS `oxv_oxvendor_5`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxvendor_5` AS select `eshop_ee`.`oxvendor`.`OXID` AS `OXID`,`eshop_ee`.`oxvendor`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxvendor`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxvendor`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxvendor`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxvendor`.`OXICON` AS `OXICON`,`eshop_ee`.`oxvendor`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxvendor`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxvendor`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxvendor`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxvendor`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_3` AS `OXSHORTDESC_3` from `eshop_ee`.`oxvendor` where (((`eshop_ee`.`oxvendor`.`OXSHOPINCL` & 16) > 0) and ((`eshop_ee`.`oxvendor`.`OXSHOPEXCL` & 16) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxvendor_6`
-- 
DROP TABLE IF EXISTS `oxv_oxvendor_6`;

DROP VIEW IF EXISTS `oxv_oxvendor_6`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxvendor_6` AS select `eshop_ee`.`oxvendor`.`OXID` AS `OXID`,`eshop_ee`.`oxvendor`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxvendor`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxvendor`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxvendor`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxvendor`.`OXICON` AS `OXICON`,`eshop_ee`.`oxvendor`.`OXTITLE` AS `OXTITLE`,`eshop_ee`.`oxvendor`.`OXSHORTDESC` AS `OXSHORTDESC`,`eshop_ee`.`oxvendor`.`OXTITLE_1` AS `OXTITLE_1`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_1` AS `OXSHORTDESC_1`,`eshop_ee`.`oxvendor`.`OXTITLE_2` AS `OXTITLE_2`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_2` AS `OXSHORTDESC_2`,`eshop_ee`.`oxvendor`.`OXTITLE_3` AS `OXTITLE_3`,`eshop_ee`.`oxvendor`.`OXSHORTDESC_3` AS `OXSHORTDESC_3` from `eshop_ee`.`oxvendor` where (((`eshop_ee`.`oxvendor`.`OXSHOPINCL` & 32) > 0) and ((`eshop_ee`.`oxvendor`.`OXSHOPEXCL` & 32) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxvoucherseries_1`
-- 
DROP TABLE IF EXISTS `oxv_oxvoucherseries_1`;

DROP VIEW IF EXISTS `oxv_oxvoucherseries_1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxvoucherseries_1` AS select `eshop_ee`.`oxvoucherseries`.`OXID` AS `OXID`,`eshop_ee`.`oxvoucherseries`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxvoucherseries`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxvoucherseries`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxvoucherseries`.`OXSERIENR` AS `OXSERIENR`,`eshop_ee`.`oxvoucherseries`.`OXSERIEDESCRIPTION` AS `OXSERIEDESCRIPTION`,`eshop_ee`.`oxvoucherseries`.`OXDISCOUNT` AS `OXDISCOUNT`,`eshop_ee`.`oxvoucherseries`.`OXDISCOUNTTYPE` AS `OXDISCOUNTTYPE`,`eshop_ee`.`oxvoucherseries`.`OXSTARTDATE` AS `OXSTARTDATE`,`eshop_ee`.`oxvoucherseries`.`OXRELEASEDATE` AS `OXRELEASEDATE`,`eshop_ee`.`oxvoucherseries`.`OXBEGINDATE` AS `OXBEGINDATE`,`eshop_ee`.`oxvoucherseries`.`OXENDDATE` AS `OXENDDATE`,`eshop_ee`.`oxvoucherseries`.`OXALLOWSAMESERIES` AS `OXALLOWSAMESERIES`,`eshop_ee`.`oxvoucherseries`.`OXALLOWOTHERSERIES` AS `OXALLOWOTHERSERIES`,`eshop_ee`.`oxvoucherseries`.`OXALLOWUSEANOTHER` AS `OXALLOWUSEANOTHER`,`eshop_ee`.`oxvoucherseries`.`OXMINIMUMVALUE` AS `OXMINIMUMVALUE` from `eshop_ee`.`oxvoucherseries` where (((`eshop_ee`.`oxvoucherseries`.`OXSHOPINCL` & 1) > 0) and ((`eshop_ee`.`oxvoucherseries`.`OXSHOPEXCL` & 1) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxvoucherseries_2`
-- 
DROP TABLE IF EXISTS `oxv_oxvoucherseries_2`;

DROP VIEW IF EXISTS `oxv_oxvoucherseries_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxvoucherseries_2` AS select `eshop_ee`.`oxvoucherseries`.`OXID` AS `OXID`,`eshop_ee`.`oxvoucherseries`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxvoucherseries`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxvoucherseries`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxvoucherseries`.`OXSERIENR` AS `OXSERIENR`,`eshop_ee`.`oxvoucherseries`.`OXSERIEDESCRIPTION` AS `OXSERIEDESCRIPTION`,`eshop_ee`.`oxvoucherseries`.`OXDISCOUNT` AS `OXDISCOUNT`,`eshop_ee`.`oxvoucherseries`.`OXDISCOUNTTYPE` AS `OXDISCOUNTTYPE`,`eshop_ee`.`oxvoucherseries`.`OXSTARTDATE` AS `OXSTARTDATE`,`eshop_ee`.`oxvoucherseries`.`OXRELEASEDATE` AS `OXRELEASEDATE`,`eshop_ee`.`oxvoucherseries`.`OXBEGINDATE` AS `OXBEGINDATE`,`eshop_ee`.`oxvoucherseries`.`OXENDDATE` AS `OXENDDATE`,`eshop_ee`.`oxvoucherseries`.`OXALLOWSAMESERIES` AS `OXALLOWSAMESERIES`,`eshop_ee`.`oxvoucherseries`.`OXALLOWOTHERSERIES` AS `OXALLOWOTHERSERIES`,`eshop_ee`.`oxvoucherseries`.`OXALLOWUSEANOTHER` AS `OXALLOWUSEANOTHER`,`eshop_ee`.`oxvoucherseries`.`OXMINIMUMVALUE` AS `OXMINIMUMVALUE` from `eshop_ee`.`oxvoucherseries` where (((`eshop_ee`.`oxvoucherseries`.`OXSHOPINCL` & 2) > 0) and ((`eshop_ee`.`oxvoucherseries`.`OXSHOPEXCL` & 2) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxvoucherseries_3`
-- 
DROP TABLE IF EXISTS `oxv_oxvoucherseries_3`;

DROP VIEW IF EXISTS `oxv_oxvoucherseries_3`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxvoucherseries_3` AS select `eshop_ee`.`oxvoucherseries`.`OXID` AS `OXID`,`eshop_ee`.`oxvoucherseries`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxvoucherseries`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxvoucherseries`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxvoucherseries`.`OXSERIENR` AS `OXSERIENR`,`eshop_ee`.`oxvoucherseries`.`OXSERIEDESCRIPTION` AS `OXSERIEDESCRIPTION`,`eshop_ee`.`oxvoucherseries`.`OXDISCOUNT` AS `OXDISCOUNT`,`eshop_ee`.`oxvoucherseries`.`OXDISCOUNTTYPE` AS `OXDISCOUNTTYPE`,`eshop_ee`.`oxvoucherseries`.`OXSTARTDATE` AS `OXSTARTDATE`,`eshop_ee`.`oxvoucherseries`.`OXRELEASEDATE` AS `OXRELEASEDATE`,`eshop_ee`.`oxvoucherseries`.`OXBEGINDATE` AS `OXBEGINDATE`,`eshop_ee`.`oxvoucherseries`.`OXENDDATE` AS `OXENDDATE`,`eshop_ee`.`oxvoucherseries`.`OXALLOWSAMESERIES` AS `OXALLOWSAMESERIES`,`eshop_ee`.`oxvoucherseries`.`OXALLOWOTHERSERIES` AS `OXALLOWOTHERSERIES`,`eshop_ee`.`oxvoucherseries`.`OXALLOWUSEANOTHER` AS `OXALLOWUSEANOTHER`,`eshop_ee`.`oxvoucherseries`.`OXMINIMUMVALUE` AS `OXMINIMUMVALUE` from `eshop_ee`.`oxvoucherseries` where (((`eshop_ee`.`oxvoucherseries`.`OXSHOPINCL` & 5) > 0) and ((`eshop_ee`.`oxvoucherseries`.`OXSHOPEXCL` & 4) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxvoucherseries_4`
-- 
DROP TABLE IF EXISTS `oxv_oxvoucherseries_4`;

DROP VIEW IF EXISTS `oxv_oxvoucherseries_4`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxvoucherseries_4` AS select `eshop_ee`.`oxvoucherseries`.`OXID` AS `OXID`,`eshop_ee`.`oxvoucherseries`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxvoucherseries`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxvoucherseries`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxvoucherseries`.`OXSERIENR` AS `OXSERIENR`,`eshop_ee`.`oxvoucherseries`.`OXSERIEDESCRIPTION` AS `OXSERIEDESCRIPTION`,`eshop_ee`.`oxvoucherseries`.`OXDISCOUNT` AS `OXDISCOUNT`,`eshop_ee`.`oxvoucherseries`.`OXDISCOUNTTYPE` AS `OXDISCOUNTTYPE`,`eshop_ee`.`oxvoucherseries`.`OXSTARTDATE` AS `OXSTARTDATE`,`eshop_ee`.`oxvoucherseries`.`OXRELEASEDATE` AS `OXRELEASEDATE`,`eshop_ee`.`oxvoucherseries`.`OXBEGINDATE` AS `OXBEGINDATE`,`eshop_ee`.`oxvoucherseries`.`OXENDDATE` AS `OXENDDATE`,`eshop_ee`.`oxvoucherseries`.`OXALLOWSAMESERIES` AS `OXALLOWSAMESERIES`,`eshop_ee`.`oxvoucherseries`.`OXALLOWOTHERSERIES` AS `OXALLOWOTHERSERIES`,`eshop_ee`.`oxvoucherseries`.`OXALLOWUSEANOTHER` AS `OXALLOWUSEANOTHER`,`eshop_ee`.`oxvoucherseries`.`OXMINIMUMVALUE` AS `OXMINIMUMVALUE` from `eshop_ee`.`oxvoucherseries` where (((`eshop_ee`.`oxvoucherseries`.`OXSHOPINCL` & 8) > 0) and ((`eshop_ee`.`oxvoucherseries`.`OXSHOPEXCL` & 8) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxvoucherseries_5`
-- 
DROP TABLE IF EXISTS `oxv_oxvoucherseries_5`;

DROP VIEW IF EXISTS `oxv_oxvoucherseries_5`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxvoucherseries_5` AS select `eshop_ee`.`oxvoucherseries`.`OXID` AS `OXID`,`eshop_ee`.`oxvoucherseries`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxvoucherseries`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxvoucherseries`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxvoucherseries`.`OXSERIENR` AS `OXSERIENR`,`eshop_ee`.`oxvoucherseries`.`OXSERIEDESCRIPTION` AS `OXSERIEDESCRIPTION`,`eshop_ee`.`oxvoucherseries`.`OXDISCOUNT` AS `OXDISCOUNT`,`eshop_ee`.`oxvoucherseries`.`OXDISCOUNTTYPE` AS `OXDISCOUNTTYPE`,`eshop_ee`.`oxvoucherseries`.`OXSTARTDATE` AS `OXSTARTDATE`,`eshop_ee`.`oxvoucherseries`.`OXRELEASEDATE` AS `OXRELEASEDATE`,`eshop_ee`.`oxvoucherseries`.`OXBEGINDATE` AS `OXBEGINDATE`,`eshop_ee`.`oxvoucherseries`.`OXENDDATE` AS `OXENDDATE`,`eshop_ee`.`oxvoucherseries`.`OXALLOWSAMESERIES` AS `OXALLOWSAMESERIES`,`eshop_ee`.`oxvoucherseries`.`OXALLOWOTHERSERIES` AS `OXALLOWOTHERSERIES`,`eshop_ee`.`oxvoucherseries`.`OXALLOWUSEANOTHER` AS `OXALLOWUSEANOTHER`,`eshop_ee`.`oxvoucherseries`.`OXMINIMUMVALUE` AS `OXMINIMUMVALUE` from `eshop_ee`.`oxvoucherseries` where (((`eshop_ee`.`oxvoucherseries`.`OXSHOPINCL` & 16) > 0) and ((`eshop_ee`.`oxvoucherseries`.`OXSHOPEXCL` & 16) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxvoucherseries_6`
-- 
DROP TABLE IF EXISTS `oxv_oxvoucherseries_6`;

DROP VIEW IF EXISTS `oxv_oxvoucherseries_6`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxvoucherseries_6` AS select `eshop_ee`.`oxvoucherseries`.`OXID` AS `OXID`,`eshop_ee`.`oxvoucherseries`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxvoucherseries`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxvoucherseries`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxvoucherseries`.`OXSERIENR` AS `OXSERIENR`,`eshop_ee`.`oxvoucherseries`.`OXSERIEDESCRIPTION` AS `OXSERIEDESCRIPTION`,`eshop_ee`.`oxvoucherseries`.`OXDISCOUNT` AS `OXDISCOUNT`,`eshop_ee`.`oxvoucherseries`.`OXDISCOUNTTYPE` AS `OXDISCOUNTTYPE`,`eshop_ee`.`oxvoucherseries`.`OXSTARTDATE` AS `OXSTARTDATE`,`eshop_ee`.`oxvoucherseries`.`OXRELEASEDATE` AS `OXRELEASEDATE`,`eshop_ee`.`oxvoucherseries`.`OXBEGINDATE` AS `OXBEGINDATE`,`eshop_ee`.`oxvoucherseries`.`OXENDDATE` AS `OXENDDATE`,`eshop_ee`.`oxvoucherseries`.`OXALLOWSAMESERIES` AS `OXALLOWSAMESERIES`,`eshop_ee`.`oxvoucherseries`.`OXALLOWOTHERSERIES` AS `OXALLOWOTHERSERIES`,`eshop_ee`.`oxvoucherseries`.`OXALLOWUSEANOTHER` AS `OXALLOWUSEANOTHER`,`eshop_ee`.`oxvoucherseries`.`OXMINIMUMVALUE` AS `OXMINIMUMVALUE` from `eshop_ee`.`oxvoucherseries` where (((`eshop_ee`.`oxvoucherseries`.`OXSHOPINCL` & 32) > 0) and ((`eshop_ee`.`oxvoucherseries`.`OXSHOPEXCL` & 32) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxwrapping_1`
-- 
DROP TABLE IF EXISTS `oxv_oxwrapping_1`;

DROP VIEW IF EXISTS `oxv_oxwrapping_1`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxwrapping_1` AS select `eshop_ee`.`oxwrapping`.`OXID` AS `OXID`,`eshop_ee`.`oxwrapping`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxwrapping`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxwrapping`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxwrapping`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxwrapping`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxwrapping`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxwrapping`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxwrapping`.`OXTYPE` AS `OXTYPE`,`eshop_ee`.`oxwrapping`.`OXNAME` AS `OXNAME`,`eshop_ee`.`oxwrapping`.`OXNAME_1` AS `OXNAME_1`,`eshop_ee`.`oxwrapping`.`OXNAME_2` AS `OXNAME_2`,`eshop_ee`.`oxwrapping`.`OXNAME_3` AS `OXNAME_3`,`eshop_ee`.`oxwrapping`.`OXPIC` AS `OXPIC`,`eshop_ee`.`oxwrapping`.`OXPRICE` AS `OXPRICE` from `eshop_ee`.`oxwrapping` where (((`eshop_ee`.`oxwrapping`.`OXSHOPINCL` & 1) > 0) and ((`eshop_ee`.`oxwrapping`.`OXSHOPEXCL` & 1) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxwrapping_2`
-- 
DROP TABLE IF EXISTS `oxv_oxwrapping_2`;

DROP VIEW IF EXISTS `oxv_oxwrapping_2`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxwrapping_2` AS select `eshop_ee`.`oxwrapping`.`OXID` AS `OXID`,`eshop_ee`.`oxwrapping`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxwrapping`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxwrapping`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxwrapping`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxwrapping`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxwrapping`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxwrapping`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxwrapping`.`OXTYPE` AS `OXTYPE`,`eshop_ee`.`oxwrapping`.`OXNAME` AS `OXNAME`,`eshop_ee`.`oxwrapping`.`OXNAME_1` AS `OXNAME_1`,`eshop_ee`.`oxwrapping`.`OXNAME_2` AS `OXNAME_2`,`eshop_ee`.`oxwrapping`.`OXNAME_3` AS `OXNAME_3`,`eshop_ee`.`oxwrapping`.`OXPIC` AS `OXPIC`,`eshop_ee`.`oxwrapping`.`OXPRICE` AS `OXPRICE` from `eshop_ee`.`oxwrapping` where (((`eshop_ee`.`oxwrapping`.`OXSHOPINCL` & 2) > 0) and ((`eshop_ee`.`oxwrapping`.`OXSHOPEXCL` & 2) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxwrapping_3`
-- 
DROP TABLE IF EXISTS `oxv_oxwrapping_3`;

DROP VIEW IF EXISTS `oxv_oxwrapping_3`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxwrapping_3` AS select `eshop_ee`.`oxwrapping`.`OXID` AS `OXID`,`eshop_ee`.`oxwrapping`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxwrapping`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxwrapping`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxwrapping`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxwrapping`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxwrapping`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxwrapping`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxwrapping`.`OXTYPE` AS `OXTYPE`,`eshop_ee`.`oxwrapping`.`OXNAME` AS `OXNAME`,`eshop_ee`.`oxwrapping`.`OXNAME_1` AS `OXNAME_1`,`eshop_ee`.`oxwrapping`.`OXNAME_2` AS `OXNAME_2`,`eshop_ee`.`oxwrapping`.`OXNAME_3` AS `OXNAME_3`,`eshop_ee`.`oxwrapping`.`OXPIC` AS `OXPIC`,`eshop_ee`.`oxwrapping`.`OXPRICE` AS `OXPRICE` from `eshop_ee`.`oxwrapping` where (((`eshop_ee`.`oxwrapping`.`OXSHOPINCL` & 5) > 0) and ((`eshop_ee`.`oxwrapping`.`OXSHOPEXCL` & 4) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxwrapping_4`
-- 
DROP TABLE IF EXISTS `oxv_oxwrapping_4`;

DROP VIEW IF EXISTS `oxv_oxwrapping_4`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxwrapping_4` AS select `eshop_ee`.`oxwrapping`.`OXID` AS `OXID`,`eshop_ee`.`oxwrapping`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxwrapping`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxwrapping`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxwrapping`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxwrapping`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxwrapping`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxwrapping`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxwrapping`.`OXTYPE` AS `OXTYPE`,`eshop_ee`.`oxwrapping`.`OXNAME` AS `OXNAME`,`eshop_ee`.`oxwrapping`.`OXNAME_1` AS `OXNAME_1`,`eshop_ee`.`oxwrapping`.`OXNAME_2` AS `OXNAME_2`,`eshop_ee`.`oxwrapping`.`OXNAME_3` AS `OXNAME_3`,`eshop_ee`.`oxwrapping`.`OXPIC` AS `OXPIC`,`eshop_ee`.`oxwrapping`.`OXPRICE` AS `OXPRICE` from `eshop_ee`.`oxwrapping` where (((`eshop_ee`.`oxwrapping`.`OXSHOPINCL` & 8) > 0) and ((`eshop_ee`.`oxwrapping`.`OXSHOPEXCL` & 8) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxwrapping_5`
-- 
DROP TABLE IF EXISTS `oxv_oxwrapping_5`;

DROP VIEW IF EXISTS `oxv_oxwrapping_5`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxwrapping_5` AS select `eshop_ee`.`oxwrapping`.`OXID` AS `OXID`,`eshop_ee`.`oxwrapping`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxwrapping`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxwrapping`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxwrapping`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxwrapping`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxwrapping`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxwrapping`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxwrapping`.`OXTYPE` AS `OXTYPE`,`eshop_ee`.`oxwrapping`.`OXNAME` AS `OXNAME`,`eshop_ee`.`oxwrapping`.`OXNAME_1` AS `OXNAME_1`,`eshop_ee`.`oxwrapping`.`OXNAME_2` AS `OXNAME_2`,`eshop_ee`.`oxwrapping`.`OXNAME_3` AS `OXNAME_3`,`eshop_ee`.`oxwrapping`.`OXPIC` AS `OXPIC`,`eshop_ee`.`oxwrapping`.`OXPRICE` AS `OXPRICE` from `eshop_ee`.`oxwrapping` where (((`eshop_ee`.`oxwrapping`.`OXSHOPINCL` & 16) > 0) and ((`eshop_ee`.`oxwrapping`.`OXSHOPEXCL` & 16) = 0));

-- --------------------------------------------------------

-- 
-- Structure for view `oxv_oxwrapping_6`
-- 
DROP TABLE IF EXISTS `oxv_oxwrapping_6`;

DROP VIEW IF EXISTS `oxv_oxwrapping_6`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `eshop_ee`.`oxv_oxwrapping_6` AS select `eshop_ee`.`oxwrapping`.`OXID` AS `OXID`,`eshop_ee`.`oxwrapping`.`OXSHOPID` AS `OXSHOPID`,`eshop_ee`.`oxwrapping`.`OXSHOPINCL` AS `OXSHOPINCL`,`eshop_ee`.`oxwrapping`.`OXSHOPEXCL` AS `OXSHOPEXCL`,`eshop_ee`.`oxwrapping`.`OXACTIVE` AS `OXACTIVE`,`eshop_ee`.`oxwrapping`.`OXACTIVE_1` AS `OXACTIVE_1`,`eshop_ee`.`oxwrapping`.`OXACTIVE_2` AS `OXACTIVE_2`,`eshop_ee`.`oxwrapping`.`OXACTIVE_3` AS `OXACTIVE_3`,`eshop_ee`.`oxwrapping`.`OXTYPE` AS `OXTYPE`,`eshop_ee`.`oxwrapping`.`OXNAME` AS `OXNAME`,`eshop_ee`.`oxwrapping`.`OXNAME_1` AS `OXNAME_1`,`eshop_ee`.`oxwrapping`.`OXNAME_2` AS `OXNAME_2`,`eshop_ee`.`oxwrapping`.`OXNAME_3` AS `OXNAME_3`,`eshop_ee`.`oxwrapping`.`OXPIC` AS `OXPIC`,`eshop_ee`.`oxwrapping`.`OXPRICE` AS `OXPRICE` from `eshop_ee`.`oxwrapping` where (((`eshop_ee`.`oxwrapping`.`OXSHOPINCL` & 32) > 0) and ((`eshop_ee`.`oxwrapping`.`OXSHOPEXCL` & 32) = 0));

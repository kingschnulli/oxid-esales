<?
//------------------------------------------------------------------------------
//	$RCSfile: etracker.inc.php,v $
//
//	$Revision: 11875 $
//	last change: $Author: arvydas $ $Date: 2008-09-05 14:49:07 +0300 (Fri, 05 Sep 2008) $
//
//	Copyright (c) 2000 etracker GmbH. All Rights Reserved.
//
// This material may not be reproduced, displayed, modified or distributed
// without the express prior written permission of the copyright holder.
//------------------------------------------------------------------------------

function getTargetParam( $targets, $tval, $tsale, $tonr )
{
	$tsale = $tsale? 1 : 0;
	$targets = rawurlencode( $targets );

	$code = "<!-- etracker TARGET PARAMETER 2.0.1 -->\n";
	$code .= "<script type=\"text/javascript\">\n";
	$code .= "var et_target = \"$targets\";\n";
	$code .= "var et_tval = \"$tval\";\n";
	$code .= "var et_tsale = $tsale;\n";
	$code .= "var et_tonr = \"$tonr\";\n";
	$code .= "</script>\n";
	$code .= "<!-- etracker TARGET PARAMETER END -->\n\n";

	return $code;
}

function getCampaignParam( $lpage, $trigger )
{
	$code .= "<!-- etracker CAMPAIGN PARAMETER 2.0.2 -->\n";
	$code .= "<script type=\"text/javascript\">\n";
	$code .= "var et_lpage = \"$lpage\";\n";
	$code .= "var et_trig = \"$trigger\";\n";
	$code .= "</script>\n";
	$code .= "<!-- etracker CAMPAIGN PARAMETER END -->\n\n";

	return $code;
}

function getBaseCode( $crypt_id, $easy = false, $ssl = false, $pagename = "",
		$areas = "", $ilevel = 0, $targets = "", $tval = "", $tsale = false,
		$tonr = 0, $lpage = 0, $trigger = 0, $free = false )
{
	global $cfgServername;
	if( !$cfgServername ) $cfgServername = "www.etracker.de";

	$script = $free? "fcnt" : "cnt";
	$easy = $easy? 1 : 0;
	$ssl = $ssl? 1 : 0;

	$pagename = rawurlencode( $pagename );
	$areas = rawurlencode( $areas );
	$targets = rawurlencode( $targets );

	$code .= "<!-- etracker PARAMETER 2.0.1 -->\n";
	$code .= "<script type=\"text/javascript\">\n";
	$code .= "var et_easy = $easy;\n";
	$code .= "var et_ssl = $ssl;\n";
	$code .= "var et_pagename = \"$pagename\";\n";
	$code .= "var et_areas = \"$areas\";\n";
	$code .= "var et_ilevel = $ilevel;\n";
	$code .= "</script>\n";
	$code .= "<!-- etracker PARAMETER END -->\n\n";

	$code .= "<!-- etracker CODE 2.0.6 -->\n";
	$code .= "<script type=\"text/javascript\">\n";
	$code .= "var et_server=\"http://$cfgServername\";\n";
	$code .= "var et_sslserver=\"https://$cfgServername\";\n";
	$code .= "var et_referer=et_server+\"/soverview.php?c=1&amp;et=\";\n";
	$code .= "var et_sw,et_sc=\"na\";var et_pl,tmp,cex=\"\";if(navigator.appName==\n";
	$code .= "'Netscape'||navigator.appName=='Opera'){for(i=0;i<navigator.plugins.length;++i)\n";
	$code .= "et_pl+=navigator.plugins[i].name+';';et_pl=escape(et_pl);}function et_pQ(param)\n";
	$code .= "{var ll,fl;var qS,pV,rS;qS=document.location.search;pV=\"\";if(qS.length>1){qS=qS.\n";
	$code .= "substr(1);fl=qS.indexOf(param);if(fl!=-1){fl+=param.length+1;ll=qS.indexOf('&',\n";
	$code .= "fl);if(ll==-1) ll=qS.length;pV=qS.substring(fl,ll);rS=new RegExp(\" \",\"g\");pV=\n";
	$code .= "pV.replace(rS,\"+\");f1=pV.indexOf('=',0);pV=pV.substring(f1+1);}} return pV;}\n";
	$code .= "function et_eC(param){var et_a='',et_t='',et_p='';var et_ref=escape(document.\n";
	$code .= "referrer);if(typeof(top.document)==\"object\")et_ref=escape(top.document.referrer);\n";
	$code .= "if(et_ref!=\"\")et_ref=\"&amp;ref=\"+et_ref;et_sw=\"&amp;swidth=\"+et_sw;et_sc=\n";
	$code .= "\"&amp;scolor=\"+et_sc;if(et_easy)et_easy=\"&amp;et_easy=1\";else et_easy=\"\";if(\n";
	$code .= "et_pl!=\"\")et_pl=\"&amp;p=\"+et_pl;if(et_areas!=\"\")et_a=\"&amp;et_areas=\"+\n";
	$code .= "escape(et_areas);if(typeof(et_target)==\"undefined\"||typeof(et_target)==\n";
	$code .= "\"unknown\"){et_target=\"\";et_tval=\"0\";et_tonr=\"0\";et_tsale=0;}if(typeof(\n";
	$code .= "et_lpage)==\"undefined\"||typeof(et_lpage)==\"unknown\")et_lpage=\"\";else\n";
	$code .= "et_lpage=\"&amp;et_lpage=\"+et_lpage;if(typeof(et_trig)==\"undefined\"||typeof(\n";
	$code .= "et_trig)==\"unknown\")et_trig=\"\";if(et_trig!=\"\")cex=\"&amp;et_trig=\"+\n";
	$code .= "et_trig;if((tc=et_pQ(\"et_cid\"))&&(tl=et_pQ(\"et_lid\")))cex=cex+\"&amp;et_cid=\"+\n";
	$code .= "tc+\"&amp;et_lid=\"+tl;if(tmp=et_pQ(\"et_target\")||et_target!=\"\"){tv=et_pQ\n";
	$code .= "(\"et_tval\");to=et_pQ(\"et_tonr\");ts=et_pQ(\"et_tsale\");et_t=\"&amp;et_target=\"+\n";
	$code .= "escape(tmp.length?tmp:et_target)+\",\"+(tv?tv:et_tval)+\",\"+(to?to:et_tonr)+\n";
	$code .= "\",\"+(ts?ts:et_tsale);}if(et_pagename!=\"\")et_p=\"&amp;et_pagename=\"+escape(\n";
	$code .= "et_pagename);tc=new Date();document.write(\"<a target='_blank' href='\"+et_referer+\n";
	$code .= "param+\"'><img border='0' alt='' src='\"+(et_ssl==1?et_sslserver:et_server)+\n";
	$code .= "\"/$script.php?java=y&amp;tc=\"+tc.getTime()+\"&amp;et=\"+param+\"&amp;et_ilevel=\"+\n";
	$code .= "et_ilevel+et_easy+et_p+et_a+cex+et_t+et_lpage+et_sw+et_sc+et_ref+et_pl+\"'/>\"+\n";
	$code .= "\"<\\/a>\");}</script><script type=\"text/javascript1.2\">et_sw=screen.width;et_sc=\n";
	$code .= "navigator.appName!='Netscape'?screen.colorDepth:screen.pixelDepth;</script>\n";
	$code .= "<script type=\"text/javascript\">et_eC('$crypt_id');</script>\n";
	$code .= "\n";
	$code .= "<!-- etracker CODE NOSCRIPT -->\n";
	$code .= "<noscript>\n";
	$code .= "<a target=\"_blank\" href=\"http://$cfgServername/soverview.php?c=1&amp;et=$crypt_id\">\n";
	$code .= "<img border=\"0\" alt=\"\" src=\"";
	if($ssl==1) $code .= "https"; else $code .= "http";
	$code .= "://$cfgServername/$script.php?et=$crypt_id&amp;java=n&amp;\n";
	$code .= "et_easy=$easy&amp;et_pagename=$pagename&amp;et_areas=$areas&amp;et_ilevel=$ilevel&amp;\n";
	$code .= "et_target=$targets,$tval,$tonr,$tsale&amp;et_lpage=$lpage&amp;et_trig=$trigger\"/></a>\n";
	$code .= "</noscript>\n";
	$code .= "<!-- etracker CODE END -->\n";

	return $code;
}

function getCode( $crypt_id,
						$easy = true,
						$ssl = false,
						$pagename = "",
						$areas = "",
						$ilevel = 0,
						$targets = "",
						$tval = "",
						$tsale = false,
						$tonr = 0,
						$lpage = 0,
						$trigger = 0 )
{
	$code  = getTargetParam( $targets, $tval, $tsale, $tonr );
	$code .= getCampaignParam( $lpage, $trigger );
	$code .= getBaseCode( $crypt_id, $easy, $ssl, $pagename, $areas, $ilevel,
								 $targets, $tval, $tsale, $tonr, $lpage, $trigger );
	return $code;
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
  <title>[{ $title }]</title>
  <meta http-equiv="Content-Type" content="text/html; charset=[{$charset}]">
  [{if isset($meta_refresh_sec,$meta_refresh_url) }]
  <meta http-equiv=Refresh content="[{$meta_refresh_sec}];URL=[{$meta_refresh_url}]">
  [{/if}]
  <link rel="shortcut icon" href="[{ $oViewConf->getBaseDir() }]favicon.ico">
  <link rel="stylesheet" href="[{$shop->basetpldir}]main.css">
  <link rel="stylesheet" href="[{$shop->basetpldir}]colors.css">
  [{include file="tooltips.tpl"}]

  <script type="text/javascript">
  <!--
    var ajaxpopup = null;
    function showDialog( sParams )
    {
        ajaxpopup = window.open('[{ $shop->selflink }]'+sParams, 'ajaxpopup', 'width=600,height=680,scrollbars=yes,resizable=yes');
    }

    function focusPopup()
    {
        if ( ajaxpopup )ajaxpopup.focus();
    }

    window.onclick = focusPopup;

    function cleanupLongDesc( sValue )
    {
        if ( sValue == '<br>' || sValue == '<br />' ) {
            return '';
        }
    }

    function copyLongDesc( sIdent )
    {
        var textVal = null;
        try {
            if ( WPro.editors[sIdent] != null ) {
               WPro.editors[sIdent].prepareSubmission();
               textVal = cleanupLongDesc( WPro.editors[sIdent].getValue() );
            }
        } catch(err) {}

        if (textVal == null) {
            var varName = 'editor_'+sIdent;
            var varEl = document.getElementById(varName);
            if (varEl != null) {
                textVal = cleanupLongDesc( varEl.value );
            }
        }

        if (textVal != null) {
            var oTarget = document.getElementsByName( 'editval['+ sIdent + ']' );
            if ( oTarget != null && ( oField = oTarget.item( 0 ) ) != null ) {
                oField.value = textVal;
            }
        }
    }
  -->
  </script>

</head>
<body [{if $sOnLoadFnc}]onload="[{ $sOnLoadFnc }]();"[{/if}]>
<div id="oxajax_data"></div>
<div class="[{$box|default:'box'}]">
[{include file="inc_error.tpl" Errorlist=$Errors.default}]

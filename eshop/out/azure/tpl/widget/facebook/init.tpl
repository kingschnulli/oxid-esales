    [{if $oViewConf->getFbAppId()}]
        <div id="fb-root"></div>

        [{oxscript include="js/widgets/oxfacebook.js"}]

        [{capture name="facebookInit"}]
        oxFacebook.fbInit("[{$oViewConf->getFbAppId()}]", "[{oxmultilang ident="FACEBOOK_LOCALE"}]", "[{$oView->getLink()|oxaddparams:"fblogin=1"}]", "[{$oViewConf->getLogoutLink()}]");
        [{/capture}]

        [{oxscript add="`$smarty.capture.facebookInit`"}]
    [{/if}]

    [{if $oViewConf->getFbAppKey()}]
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({appId: '[{$oViewConf->getFbAppKey()}]', status: true, cookie: true, xfbml: true});
      };

      (function() {
        var e = document.createElement('script');
        e.type = 'text/javascript';
        e.src = document.location.protocol + '//connect.facebook.net/[{ oxmultilang ident="FACEBOOK_LOCALE" }]/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());

    </script>
    [{/if}]

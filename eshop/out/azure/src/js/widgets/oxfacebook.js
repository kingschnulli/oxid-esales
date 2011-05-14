    /* 
     * Facebook related scripts
     */

    oxFacebook = {
        
            /*
             * Initing Facebook API
             * 
             */
            fbInit: function ( sFbAppId, sLocale, sLoginUrl, sLogoutUrl ) {
                
                var options = self.options;
                
                window.fbAsyncInit = function() {
                    FB.init({appId: sFbAppId, status: true, cookie: true, xfbml: true});

                    FB.Event.subscribe('auth.login', function(response) {
                        // redirecting after successfull login
                        self._redirectPage( sLoginUrl );

                        if ( FB.XFBML.Host.parseDomTree )
                              setTimeout( FB.XFBML.Host.parseDomTree, 0 );
                    });

                    FB.Event.subscribe('auth.logout', function(response) {
                        // redirecting after logout
                        self._redirectPage( sLogoutUrl );
                    });
                };
                
                // loading FB script file
                var e   = document.createElement('script');
                e.type  = 'text/javascript';
                e.src   = document.location.protocol + '//connect.facebook.net/' + sLocale + '/all.js';
                e.async = true;
                $('#fb-root').appendChild(e);
            },
        
        /*
         * Redicrecting page to given url
         */
        _redirectPage: function ( sUrl ) {
            
           sUrl = sUrl.toString().replace(/&amp;/g,"&");
           document.location.href = sUrl;
        }
    };

    $.widget("ui.oxFacebook", oxFacebook );



/**
 * #PHPHEADER_OXID_LICENSE_INFORMATION#
 *
 * @link      http://www.oxid-esales.com
 * @package   views
 * @copyright (c) OXID eSales AG 2003-#OXID_VERSION_YEAR#
 * @version   SVN: $Id: account_newsletter.php 26071 2010-02-25 15:12:55Z sarunas $
 */
( function( $ ) {

    oxLoadArticleVariant = {
            options: {
                selectClass : 'md_select_variant',
                blockClass     : 'variants'
            },

            _create: function() {

                var self     = this;
                var options  = self.options;
                var el       = self.element;
                var loadUrl;

                el.change( function(){

                    loadUrl =  mdRealVariantsLinks[ el.val() ];

                    if ( loadUrl == undefined ) {
                        var oLastSelect = self.getLastVariantSelect( $( '#' + options.blockClass ), options.selectClass );
                        loadUrl = mdRealVariantsLinks[self.getFirstValue( oLastSelect )]
                    }

                    if ( loadUrl != undefined ) {
                        window.location = loadUrl;
                    }

                });
            },

            getLastVariantSelect: function ( oVariantsBlock, sSelectClass){

                return $( '.' + sSelectClass + ':visible:last ', oVariantsBlock );
            },

            getFirstValue: function( oSelect ){

                return oSelect.children( 'option:first' ).val();

            }
    };

    $.widget( "ui.oxLoadArticleVariant", oxLoadArticleVariant );



} )( jQuery );
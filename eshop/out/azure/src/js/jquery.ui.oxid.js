/**
 * #PHPHEADER_OXID_LICENSE_INFORMATION#
 *
 * @link      http://www.oxid-esales.com
 * @package   views
 * @copyright (c) OXID eSales AG 2003-#OXID_VERSION_YEAR#
 * @version   SVN: $Id: account_newsletter.php 26071 2010-02-25 15:12:55Z sarunas $
 */
( function( $ ) {
    /**
     * Form Items validator
     */
    oxInputValidator = {
            options: {
                classValid            : "oxValid",
                classInValid          : "oxInValid",
                errorParagraf         : "p.oxValidateError",
                errorMessageNotEmpty  : "oxError_notEmpty",
                errorMessageNotEmail  : "oxError_email",
                errorMessageShort     : "oxError_length",
                errorMessageNotEqual  : "oxError_match",
                metodValidate         : "oxValidate",
                metodValidateEmail    : "oxValidate_email",
                metodValidateNotEmpty : "oxValidate_notEmpty",
                metodValidateLength   : "oxValidate_length",
                metodValidateMatch    : "oxValidate_match",
                idPasswordLength      : "#passwordLength",
                listItem              : "li",
                list                  : "ul",
                paragraf              : "p",
                span                  : "span",
                form                  : "form",
                visible               : ":visible",

                //
                metodEnterPasswd      : "oxValidate_enterPass"
            },

            _create: function() {

                var self    = this,
                    options = self.options,
                    el      = self.element;

                el.delegate("."+options.metodValidate, "blur", function() {
                    if ( $( this ).is(options.visible) ) {
                        self.inputValidation(this, true);
                    }
                });

                self._bindSpecialListener( el );
                el.bind( "submit", function() {
                    return self.submitValidation(this);
                });
            },

            /**
             * Binds special listeners to given input field
             *
             * @return null
             */
            _bindSpecialListener: function( oInput )
            {
                var oOptions = this.options;
                var self     = this;
                var oInput   = $( oInput );

                if ( oInput.hasClass( oOptions.metodEnterPasswd ) ) {
                    oInput.bind ( "keyup", function() {
                        self.showInput( oInput, oInput.val() != oInput.attr( "defaultValue" ), oOptions.metodEnterPasswd );
                    });
                }
            },

            /**
             * Shows/hides given element
             */
            showInput: function( oSource, blShow, sClass )
            {
                var oRegexp  = new RegExp( sClass + "Target\\[(.+)\\]", "g" );
                var sClasses = oRegexp.exec( oSource.attr( "class" ) );
                if ( sClasses && sClasses.length ) {
                    var aClasses = sClasses[1].split(",");

                    for (var i = 0; i < aClasses.length; i++) {
                        if (blShow) {
                            $("." + aClasses[i]).show();
                        }
                        else {
                            $("." + aClasses[i]).hide();
                        }
                    }
                }
            },

            /**
             * Validate form element, return forms true - valid, false - not valid
             *
             * @return boolean
             */
            inputValidation: function(oInput, blCanSetDefaultState)
            {
                var oOptions = this.options;
                var self = this;
                var blValidInput = true;

                    if ( $( oInput ).hasClass( oOptions.metodValidateNotEmpty ) && blValidInput ) {
                        self.manageErrorMessage(oInput, $( oInput ).val() , oOptions.errorMessageNotEmpty);
                        blValidInput = $( oInput ).val() ? true : false;
                    }

                    if ( $( oInput ).hasClass( oOptions.metodValidateEmail ) && blValidInput ) {

                        if( $( oInput ).val() ) {
                            self.manageErrorMessage(oInput, self.isEmail( $( oInput ).val() ), oOptions.errorMessageNotEmail);
                            blValidInput = blValidInput && self.isEmail( $( oInput ).val() );
                        }
                    }

                    if ( $( oInput ).hasClass( oOptions.metodValidateLength ) && blValidInput ) {

                        var iLength = self.getLength( $( oInput ).parent(oOptions.listItem).parent(oOptions.list).parent(oOptions.form ));

                        if( $( oInput ).val() ) {
                            self.manageErrorMessage(oInput, self.hasLength( $( oInput ).val(), iLength), oOptions.errorMessageShort);
                            blValidInput = blValidInput && self.hasLength( $( oInput ).val(), iLength);
                        }
                    }

                    if ( $( oInput ).hasClass( oOptions.metodValidateMatch ) && blValidInput ) {

                        var inputs = new Array();

                        var oForm = $( oInput ).parent(oOptions.listItem).parent(oOptions.list).parent(oOptions.form);

                        $( "." + oOptions.metodValidateMatch, oForm).each( function(index) {
                            inputs[index] = this;
                        });

                        if( $(inputs[0]).val() && $(inputs[1]).val() ) {
                            self.manageErrorMessage(inputs[0], self.isEqual($(inputs[0]).val(), $(inputs[1]).val()), oOptions.errorMessageNotEqual);
                            self.manageErrorMessage(inputs[1], self.isEqual($(inputs[0]).val(), $(inputs[1]).val()), oOptions.errorMessageNotEqual);
                            blValidInput = blValidInput && self.isEqual($(inputs[0]).val(), $(inputs[1]).val());
                        }
                    }

                    if ( $( oInput ).hasClass( oOptions.metodValidate ) && blCanSetDefaultState) {

                        if( !$( oInput ).val()){
                            self.setDefaultState( oInput );
                            return true;
                        }
                    }

                return blValidInput;
            },

            /**
             * On submit validate requared form elements,
             * return true - if all filled correctly, false - if not
             *
             * @return boolean
             */
            submitValidation: function(oForm)
            {
                var blValid = true;
                var oFirstNotValidElement = null;
                var self = this;
                var oOptions = this.options;

                $( "." + oOptions.metodValidate, oForm).each(    function(index) {

                    if ( $( this ).is(oOptions.visible) ) {
                        if(! self.inputValidation(this, false)){
                            blValid = false;
                            if( oFirstNotValidElement == null ) {
                                oFirstNotValidElement = this;
                            }
                        }
                    }

                });

                if( oFirstNotValidElement != null ) {
                    $( oFirstNotValidElement ).focus();
                }

                return blValid;
            },


            /**
             * Manage error messages show / hide
             *
             * @return object
             */
            manageErrorMessage: function ( oObject, isValid, messageType )
            {
                if ( isValid ) {
                     return this.hideErrorMessage(oObject, messageType);
                } else {
                    return this.showErrorMessage(oObject, messageType);
                }
            },

            /**
             * Show error messages
             *
             * @return object
             */
            showErrorMessage: function ( oObject, messageType )
            {
                var oObject =  $( oObject).parent();

                oObject.removeClass(this.options.classValid);
                oObject.addClass(this.options.classInValid);
                oObject.children(this.options.errorParagraf).children( this.options.span + "." + messageType ).show();
                oObject.children(this.options.errorParagraf).show();

                return oObject;
            },

            /**
             * Hide error messages
             *
             * @return object
             */
            hideErrorMessage: function ( oObject, messageType )
            {
                var oObject = $( oObject).parent();

                oObject.removeClass(this.options.classInValid);
                oObject.addClass(this.options.classValid);
                oObject.children(this.options.errorParagraf).children( this.options.span + "." + messageType ).hide();
                oObject.children(this.options.errorParagraf).hide();

                return oObject;
            },

            /**
             * Set dafault look of form list element
             *
             * @return object
             */
            setDefaultState: function ( oObject )
            {
                var oObject = $( oObject ).parent();

                oObject.removeClass(this.options.classInValid);
                oObject.removeClass(this.options.classValid);
                oObject.children(this.options.errorParagraf).hide();

                oOptions = this.options;

                $( this.options.span, oObject.children( this.options.errorParagraf ) ).each( function(index) {
                    oObject.children( oOptions.errorParagraf ).children( oOptions.span ).hide();
                });

                return oObject;
            },

            /**
             * gets requared length from form
             *
             * @return boolean
             */
            getLength: function(oObject){

                oOptions = this.options;

                return $( oOptions.idPasswordLength , oObject).val();
            },

            /**
             * Checks length
             *
             * @return boolean
             */
            hasLength: function( stValue, length )
            {
                stValue = jQuery.trim( stValue );

                if( stValue.length >= length ) {
                    return true;
                }

                return false;
            },

            /**
             * Checks mails validation
             *
             * @return boolean
             */
            isEmail: function( email )
            {
                email = jQuery.trim(email);

                var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                //var reg = /^([-!#\$%&'*+.\/0-9=?A-Z^_`a-z{|}~\177])+@([-!#\$%&'*+\/0-9=?A-Z^_`a-z{|}~\177]+\\.)+[a-zA-Z]{2,6}\$/i;

                if(reg.test(email) == false) {
                    return false;
                }

                return true;
            },

            /**
             * Checks is string equal
             *
             * @return boolean
             */
            isEqual: function( stValue1, stValue2 )
            {
                stValue1 = jQuery.trim(stValue1);
                stValue2 = jQuery.trim(stValue2);

                if (stValue1 == stValue2){
                    return true;
                }

                return false;
            }
        };

    /**
     * Form Items validator
     */
    $.widget("ui.oxInputValidator", oxInputValidator );





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
















 // selectors..

    $( ".oxValidate" ).oxInputValidator();


} )( jQuery );
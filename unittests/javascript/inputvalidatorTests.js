module('Inline form validation');

test('isEqual()', function() {
    equals(oxInputValidator.isEqual("aa", "aa" ), true, "equal: aa -> aa");
    equals(oxInputValidator.isEqual("aa", "AA"), false, "not equal case sensitive: aa -> AA");
    equals(oxInputValidator.isEqual("abc", "ab"), false, "not equal: abc -> ab");
    equals(oxInputValidator.isEqual(" abb ", "abb"), true, "equal, but with spaces: ' abb ' -> 'abb'");
});

test('isEmail()', function() {
    equals(oxInputValidator.isEmail( "name@surname.com" ), true, "name@surname.com");
    equals(oxInputValidator.isEmail( "name surname.com" ), false, "name surname.com");
    equals(oxInputValidator.isEmail( "name@s urname.com" ), false, "name@s urname.com");
    equals(oxInputValidator.isEmail( "na me@surname.com" ), false, "na me@surname.com");
    equals(oxInputValidator.isEmail( "name.surname@surname.com" ), true, "name.surname@surname.com");
    equals(oxInputValidator.isEmail( "na.me@sur/name.com" ), false, "na.me@sur/name.com");
    equals(oxInputValidator.isEmail( "na/me@surname.com" ), false, "na.me@sur/name.com");
    equals(oxInputValidator.isEmail( "name@surname" ), false, "name@surname");
    equals(oxInputValidator.isEmail( "@surname.com" ), false, "@surname.com");
    equals(oxInputValidator.isEmail( "surname.com" ), false, "surname.com");
    equals(oxInputValidator.isEmail( "name.surname.com" ), false, "name.surname.com");
    equals(oxInputValidator.isEmail( "name_123@surname.com" ), true, "name_123@surname.com");
    equals(oxInputValidator.isEmail( "name@_123@surname.com" ), false, "name@_123@surname.com");
    equals(oxInputValidator.isEmail( "name_123.uk@surname.co.uk" ), true, "name_123.uk@surname.co.uk");

});

test('hasLength()', function() {
    equals(oxInputValidator.hasLength( "aabaa", 5 ), true, "length 5: aabaa");
    equals(oxInputValidator.hasLength( " abaa", 5 ), false, "length 4 with space: ' abaa'");
    equals(oxInputValidator.hasLength( "abc aa", 5), true, "lenght more 5: 'abc aa'");
    equals(oxInputValidator.hasLength( "abb", 5), false, "less 5: 'abb'");
    equals(oxInputValidator.hasLength( "abc aa asdas ", 5), true, "lenght more 5: 'abc aa asdas '");
});

test('manageErrorMessage()', function() {

    var sHTMLelement =
            '<li class="oxValid">' +
                        '<label>label 1 </label>' +
                        '<input type="text" class="oxValidate oxValidate_notEmpty">' +
                        '<p class="oxValidateError" style="display: none;">' +
                            '<span class="oxError_notEmpty" style="display: none;"> not empty error message </span>' +
                            '<span class="oxError_email" style="display: none;"> bad email error message </span>' +
                        '</p>' +
                    '</li>';

    var oFormElement = $( sHTMLelement );

    oFormElement = oxInputValidator.manageErrorMessage( oFormElement.children("input"), true, 'oxError_email');
    equals(oFormElement.hasClass( "oxValid" ), true, "List element hide error");

    oErrorParagraf = oFormElement.children("p.oxValidateError");
    equals(oErrorParagraf.css( "display" ) == "none", true, "Hide error paragraf");

    oFormElement = oxInputValidator.manageErrorMessage( oFormElement.children("input"), false, 'oxError_email');
    equals(oFormElement.hasClass( "oxInValid" ), true, "List element show error");

    oErrorParagraf = oFormElement.children("p.oxValidateError");
    equals(oErrorParagraf.css( "display" ) == "block" || oErrorParagraf.css( "display" ) == "", true, "Show error paragraf");

});

test('showErrorMessage()', function() {

    var sHTMLelement =
            '<li class="oxValid">' +
                        '<label>label 1 </label>' +
                        '<input type="text" class="oxValidate oxValidate_notEmpty">' +
                        '<p class="oxValidateError" style="display: none;">' +
                            '<span class="oxError_notEmpty" style="display: none;"> not empty error message </span>' +
                            '<span class="oxError_email" style="display: none;"> bad email error message </span>' +
                        '</p>' +
                    '</li>';

    var oFormElement = $( sHTMLelement );

    oFormElement = oxInputValidator.showErrorMessage( oFormElement.children("input"), 'oxError_email');
    equals(oFormElement.hasClass( "oxInValid" ), true, "List element shows error");

    oErrorParagraf = oFormElement.children("p.oxValidateError");
    equals(oErrorParagraf.css( "display" ) == "block" || oErrorParagraf.css( "display" ) == ""  , true, "Show error paragraf");

    oNotEmailErrorSpan = oErrorParagraf.children( "span.oxError_email" );
    equals(oNotEmailErrorSpan.css( "display" ) == "inline" || oNotEmailErrorSpan.css( "display" ) == "" , true, "Show bad email error");

    oNotEmptyErrorSpan = oErrorParagraf.children("span.oxError_notEmpty");
    equals(oNotEmptyErrorSpan.css( "display" ), "none", "Not empty error still hidden");

});

test('hideErrorMessage()', function() {

    var sHTMLelement =
            '<li class="oxInValid">' +
                        '<label>label 1 </label>' +
                        '<input type="text" class="oxValidate oxValidate_notEmpty">' +
                        '<p class="oxValidateError" style="display: block;">' +
                            '<span class="oxError_notEmpty" style="display: none;"> not empty error message </span>' +
                            '<span class="oxError_email" style="display: inline;"> bad email error message </span>' +
                        '</p>' +
                    '</li>';

    var oFormElement = $( sHTMLelement );

    oFormElement = oxInputValidator.hideErrorMessage( oFormElement.children("input"), 'oxError_email');
    equals(oFormElement.hasClass( "oxValid" ), true, "List element don't shows errors");

    oErrorParagraf = oFormElement.children("p.oxValidateError");
    equals(oErrorParagraf.css( "display" ), "none", "Don't Show error paragraf");

    oNotEmailErrorSpan = oErrorParagraf.children( "span.oxError_email" );
    equals(oNotEmailErrorSpan.css( "display" ), "none", "Bad email error hidden");

    oNotEmptyErrorSpan = oErrorParagraf.children("span.oxError_notEmpty");
    equals(oNotEmptyErrorSpan.css( "display" ), "none", "Not empty error still hidden");

});

test('setDefaultState()', function() {

    var sHTMLelement =
            '<li class="oxInValid">' +
                        '<label>label 1 </label>' +
                        '<input type="text" class="oxValidate oxValidate_notEmpty">' +
                        '<p class="oxValidateError" style="display: block;">' +
                            '<span class="oxError_notEmpty" style="display: inline;"> not empty error message </span>' +
                            '<span class="oxError_email" style="display: inline;"> bad email error message </span>' +
                        '</p>' +
                    '</li>';

    var oFormElement = $( sHTMLelement );

    oFormElement = oxInputValidator.setDefaultState( oFormElement.children("input"));
    equals(!oFormElement.hasClass( "oxValid" ) && !oFormElement.hasClass( "oxInValid" ) , true, "List element has default state");

    oErrorParagraf = oFormElement.children("p.oxValidateError");
    equals(oErrorParagraf.css( "display" ), "none", "Don't Show error paragraf");

    oNotEmailErrorSpan = oErrorParagraf.children( "span.oxError_email" );
    equals(oNotEmailErrorSpan.css( "display" ), "none", "Bad email error hidden");

    oNotEmptyErrorSpan = oErrorParagraf.children("span.oxError_notEmpty");
    equals(oNotEmptyErrorSpan.css( "display" ), "none", "Not empty error still hidden");

});

test('inputValidation()', function() {
    var sHTMLelement =
            '<li class="oxInValid">' +
                        '<label>label 1 </label>' +
                        '<input type="text" class="js-oxValidate js-oxValidate_notEmpty js-oxValidate_email">' +
                        '<p class="oxValidateError" style="display: block;">' +
                            '<span class="oxError_notEmpty" style="display: inline;"> not empty error message </span>' +
                            '<span class="oxError_email" style="display: inline;"> bad email error message </span>' +
                        '</p>' +
                    '</li>';

    var oFormElement = $( sHTMLelement );
    var oInput = oFormElement.children("input");

    equals( oxInputValidator.inputValidation( oInput ) , false, "Not valid element: empty");

    oInput.val('aaa');
    equals( oxInputValidator.inputValidation( oInput ) , false, "Not valid element: not empty but not email");

    oInput.val('aaa@aaa.lt');
    equals( oxInputValidator.inputValidation( oInput ) , true, "Valid element");

});

test('submitValidation()', function() {

    var sElement =
        '<form>' +
            '<ul>' +
                '<li>' +
                        '<label> label 1 </label>' +
                        '<input id="first" type="text" class="oxValidate oxValidate_notEmpty>' +
                        '<p class="oxValidateError" style="display: block;">' +
                            '<span class="oxError_notEmpty" style="display: inline;"> not empty error message </span>' +
                        '</p>' +
                    '</li>'+
                    '<li>' +
                            '<label> label 2 </label>' +
                            '<input type="text">' +
                        '</li>'+
                        '<li>' +
                            '<label> label 3 </label>' +
                            '<input type="text" class="oxValidate oxValidate_notEmpty oxValidate_email">' +
                            '<p class="oxValidateError" style="display: block;">' +
                                '<span class="oxError_notEmpty" style="display: inline;"> not empty error message </span>' +
                                '<span class="oxError_email" style="display: inline;"> bad email error message </span>' +
                            '</p>' +
                        '</li>' +
            '</ul>' +
        '</form>';

    var oForm = $( sElement );

    //equals( oxInputValidator.submitValidation( oForm ) , false, "has empty inputs");

    $( "input", oForm ).each(	function(index) {
        $( this ).val('aaa@aaa.lt');
    });


    equals( oxInputValidator.submitValidation( oForm ) , true, "all inputs filed ok");

});


test('getLength()', function() {

    var sElement =
        '<form>' +
            '<input id="passwordLength" type="hidden" value="5">' +
            '<ul>' +
                '<li>' +
                        '<label> label 1 </label>' +
                        '<input id="first" type="text" class="oxValidate oxValidate_notEmpty>' +
                        '<p class="oxValidateError" style="display: block;">' +
                            '<span class="oxError_notEmpty" style="display: inline;"> not empty error message </span>' +
                        '</p>' +
                    '</li>'+
                '<li>' +
                            '<label> label 2 </label>' +
                            '<input type="text">' +
                        '</li>'+
                        '<li>' +
                            '<label> label 3 </label>' +
                            '<input type="text" class="oxValidate oxValidate_notEmpty oxValidate_email">' +
                            '<p class="oxValidateError" style="display: block;">' +
                                '<span class="oxError_notEmpty" style="display: inline;"> not empty error message </span>' +
                                '<span class="oxError_email" style="display: inline;"> bad email error message </span>' +
                            '</p>' +
                        '</li>' +
            '</ul>' +
        '</form>';

    var oForm = $( sElement );

    equals( oxInputValidator.getLength( oForm ), 5, "password length correct");

    var sElement =
        '<form>' +
            '<ul>' +
                '<li>' +
                        '<label> label 1 </label>' +
                        '<input id="first" type="text" class="oxValidate oxValidate_notEmpty>' +
                        '<p class="oxValidateError" style="display: block;">' +
                            '<span class="oxError_notEmpty" style="display: inline;"> not empty error message </span>' +
                        '</p>' +
                    '</li>'+
                '<li>' +
                            '<label> label 2 </label>' +
                            '<input type="text">' +
                        '</li>'+
                        '<li>' +
                            '<label> label 3 </label>' +
                            '<input type="text" class="oxValidate oxValidate_notEmpty oxValidate_email">' +
                            '<p class="oxValidateError" style="display: block;">' +
                                '<span class="oxError_notEmpty" style="display: inline;"> not empty error message </span>' +
                                '<span class="oxError_email" style="display: inline;"> bad email error message </span>' +
                            '</p>' +
                        '</li>' +
            '</ul>' +
        '</form>';

    var oForm = $( sElement );

    equals( oxInputValidator.getLength( oForm ), undefined, "form hasn't hidden value");

});



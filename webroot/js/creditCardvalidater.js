/*
 * Credit Card Validator jQuery
 * Author: CodexWorld
 * URL: https://www.codexworld.com
 * License: https://www.codexworld.com/license/
 */

(function () {
    var $,
        __indexOf = [].indexOf || function (item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };

    $ = jQuery;

    $.fn.validateCreditCard = function (callback, options) {
        var bind, card, card_type, card_types, get_card_type, is_valid_length, is_valid_luhn, normalize, validate, validate_number, _i, _len, _ref;
        card_types = [
            {
                name: 'Amex',
                pattern: /^3[47]/,
                valid_length: [15]
            }, {
                name: 'diners_club_carte_blanche',
                pattern: /^30[0-5]/,
                valid_length: [14]
            }, {
                name: 'diners_club_international',
                pattern: /^36/,
                valid_length: [14]
            }, {
                name: 'jcb',
                pattern: /^35(2[89]|[3-8][0-9])/,
                valid_length: [16]
            }, {
                name: 'laser',
                pattern: /^(6304|670[69]|6771)/,
                valid_length: [16, 17, 18, 19]
            }, {
                name: 'visa_electron',
                pattern: /^(4026|417500|4508|4844|491(3|7))/,
                valid_length: [16]
            }, {
                name: 'Visa',
                pattern: /^4/,
                valid_length: [16]
            }, {
                name: 'MasterCard',
                pattern: /^5[1-5]/,
                valid_length: [16]
            }, {
                name: 'Maestro',
                pattern: /^(5018|5020|5038|6304|6759|676[1-3])/,
                valid_length: [12, 13, 14, 15, 16, 17, 18, 19]
            }, {
                name: 'Discover',
                pattern: /^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)/,
                valid_length: [16]
            }
        ];
        bind = false;
        if (callback) {
            if (typeof callback === 'object') {
                options = callback;
                bind = false;
                callback = null;
            } else if (typeof callback === 'function') {
                bind = true;
            }
        }
        if (options == null) {
            options = {};
        }
        if (options.accept == null) {
            options.accept = (function () {
                var _i, _len, _results;
                _results = [];
                for (_i = 0, _len = card_types.length; _i < _len; _i++) {
                    card = card_types[_i];
                    _results.push(card.name);
                }
                return _results;
            })();
        }
        _ref = options.accept;
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            card_type = _ref[_i];
            if (__indexOf.call((function () {
                var _j, _len1, _results;
                _results = [];
                for (_j = 0, _len1 = card_types.length; _j < _len1; _j++) {
                    card = card_types[_j];
                    _results.push(card.name);
                }
                return _results;
            })(), card_type) < 0) {
                throw "Credit card type '" + card_type + "' is not supported";
            }
        }
        get_card_type = function (number) {
            var _j, _len1, _ref1;
            _ref1 = (function () {
                var _k, _len1, _ref1, _results;
                _results = [];
                for (_k = 0, _len1 = card_types.length; _k < _len1; _k++) {
                    card = card_types[_k];
                    if (_ref1 = card.name, __indexOf.call(options.accept, _ref1) >= 0) {
                        _results.push(card);
                    }
                }
                return _results;
            })();
            for (_j = 0, _len1 = _ref1.length; _j < _len1; _j++) {
                card_type = _ref1[_j];
                if (number.match(card_type.pattern)) {
                    return card_type;
                }
            }
            return null;
        };
        is_valid_luhn = function (number) {
            var digit, n, sum, _j, _len1, _ref1;
            sum = 0;
            _ref1 = number.split('').reverse();
            for (n = _j = 0, _len1 = _ref1.length; _j < _len1; n = ++_j) {
                digit = _ref1[n];
                digit = +digit;
                if (n % 2) {
                    digit *= 2;
                    if (digit < 10) {
                        sum += digit;
                    } else {
                        sum += digit - 9;
                    }
                } else {
                    sum += digit;
                }
            }
            return sum % 10 === 0;
        };
        is_valid_length = function (number, card_type) {
            var _ref1;
            return _ref1 = number.length, __indexOf.call(card_type.valid_length, _ref1) >= 0;
        };
        validate_number = (function (_this) {
            return function (number) {
                var length_valid, luhn_valid;
                card_type = get_card_type(number);
                luhn_valid = false;
                length_valid = false;
                if (card_type != null) {
                    luhn_valid = is_valid_luhn(number);
                    length_valid = is_valid_length(number, card_type);
                }
                return {
                    card_type: card_type,
                    valid: luhn_valid && length_valid,
                    luhn_valid: luhn_valid,
                    length_valid: length_valid
                };
            };
        })(this);
        validate = (function (_this) {
            return function () {
                var number;
                number = normalize($(_this).val());
                return validate_number(number);
            };
        })(this);
        normalize = function (number) {
            return number.replace(/[ -]/g, '');
        };
        if (!bind) {
            return validate();
        }
        this.on('input.jccv', (function (_this) {
            return function () {
                $(_this).off('keyup.jccv');
                return callback.call(_this, validate());
            };
        })(this));
        this.on('keyup.jccv', (function (_this) {
            return function () {
                return callback.call(_this, validate());
            };
        })(this));
        callback.call(this, validate());
        return this;
    };

}).call(this);



// form validation
function cardFormValidate() {
    var cardValid = 0;

    //card number validation
    $('#card_number').validateCreditCard(function (result) {
        var cardType = (result.card_type == null) ? '' : result.card_type.name;
        if (cardType == 'Visa') {
            var backPosition = result.valid ? '2px -163px, 260px -87px' : '2px -163px, 260px -61px';
        } else if (cardType == 'visa_electron') {
            var backPosition = result.valid ? '2px -205px, 260px -87px' : '2px -163px, 260px -61px';
        } else if (cardType == 'MasterCard') {
            var backPosition = result.valid ? '2px -247px, 260px -87px' : '2px -247px, 260px -61px';
        } else if (cardType == 'Maestro') {
            var backPosition = result.valid ? '2px -289px, 260px -87px' : '2px -289px, 260px -61px';
        } else if (cardType == 'Discover') {
            var backPosition = result.valid ? '2px -331px, 260px -87px' : '2px -331px, 260px -61px';
        } else if (cardType == 'Amex') {
            var backPosition = result.valid ? '2px -121px, 260px -87px' : '2px -121px, 260px -61px';
        } else {
            var backPosition = result.valid ? '2px -121px, 260px -87px' : '2px -121px, 260px -61px';
        }
        $('#card_number').css("background-position", backPosition);
        if (result.valid) {
            $("#card_type").val(cardType);
            $("#card_number").removeClass('required');
            cardValid = 1;
        } else {
            $("#card_type").val('');
            $("#card_number").addClass('required');
            cardValid = 0;
        }
    });


    //card details validation
    var cardName = $("#name_on_card").val();
    var expMonth = $("#expiry_month").val();
    var expYear = $("#expiry_year").val();
    var cvv = $("#cvv").val();
    var regName = /^[a-z ,.'-]+$/i;
    var regMonth = /^01|02|03|04|05|06|07|08|09|10|11|12$/;
    // var regYear = /^2017|2018|2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
    var regYear = /^17|18|19|20|21|22|23|24|25|26|27|28|29|30|31$/;
    var regCVV = /^[0-9]{3,3}$/;
    if (cardValid == 0) {
        $("#card_number").focus();
        $("#card_number").addClass('required');
        return false;
    } else if (!regMonth.test(expMonth)) {
        $("#expiry_month").focus();
        $("#card_number").removeClass('required');
        $("#expiry_month").addClass('required');
        return false;
    } else if (!regYear.test(expYear)) {
        $("#expiry_year").focus();
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").addClass('required');
        return false;
    } else if (!regCVV.test(cvv)) {
        $("#cvv").focus();
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").addClass('required');
        return false;
    } else if (!regName.test(cardName)) {
        $("#name_on_card").focus();
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").removeClass('required');
        $("#name_on_card").addClass('required');
        return false;
    } else {
        $("#name_on_card").removeClass('required');
        $("#card_number").removeClass('required');
        $("#expiry_month").removeClass('required');
        $("#expiry_year").removeClass('required');
        $("#cvv").removeClass('required');
        $("#cardSubmitBtn").removeAttr('disabled');
        return true;
    }
}

$(document).ready(function () {
    // $("#cardSubmitBtn").attr('disabled', true);
    //Demo card numbers
    // $('.payment div li').wrapInner('<a href="javascript:void(0);"></a>').click(function (e) {
    //     e.preventDefault();
    //     $('.payment div').slideUp(100);
    //     cardFormValidate();
    //     return $('#card_number').val($(this).text()).trigger('input');
    // });
    // $('body').click(function () {
    //     return $('.payment div').slideUp(100);
    // });
    // $('#sample-numbers-trigger').click(function (e) {
    //     e.preventDefault();
    //     e.stopPropagation();
    //     return $('.payment div').slideDown(100);
    // });

    //Card form validation on input fields
    $('#paymentForm input[type=text]').on('keyup', function () {
        cardFormValidate();
    });

    //Submit card form
    // $("#cardSubmitBtn").on('click', function() {
    //   if (cardFormValidate()) {
    //     var card_number = $('#card_number').val();
    //     var valid_thru = $('#expiry_month').val() + '/' + $('#expiry_year').val();
    //     var cvv = $('#cvv').val();
    //     var card_name = $('#name_on_card').val();
    //     var cardInfo = '<p>Card Number: <span>' + card_number + '</span></p><p>Valid Thru: <span>' + valid_thru + '</span></p><p>CVV: <span>' + cvv + '</span></p><p>Name on Card: <span>' + card_name + '</span></p><p>Status: <span>VALID</span></p>';
    //     $('.cardInfo').slideDown('slow');
    //     $('.cardInfo').html(cardInfo);
    //   } else {
    //     $('.cardInfo').slideDown('slow');
    //     $('.cardInfo').html('<p>Wrong card details given, please try again.</p>');
    //     // return false;
    //   }
    // });
});
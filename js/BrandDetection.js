BrandDetection = function() {};

BrandDetection.prototype.option =
{
    'minlength': 6
};

BrandDetection.prototype.creditcard =
{
    'carte-bleue' : {
        'pattern': /^(415006|497|407497|513)/,
        'cardlength': [13, 16],
        'luhn': false,
        'cvc': [3]
    },
    'carta-si': {
        'pattern': /^(45399[78]|432913|5255)/,
        'cardlength': [16],
        'luhn': false,
        'cvc': [3]
    },
    'dankort' : {
        'pattern': /^(4571|5019)/,
        'cardlength': [16],
        'luhn': false,
        'cvc': [3]
    },
    'china-unionpay' : {
        'pattern': /^(62|88)/,
        'cardlength': [16, 17, 18, 19],
        'luhn': false,
        'cvc': [3]
    },
    'discover': {
        'pattern': /^6(011|5)/,
        'cardlength': [16],
        'luhn': false,
        'cvc': [3]
    },
    'diners-club' : {
        'pattern': /^3(0[0-5]|[68])/,
        'cardlength': [14],
        'luhn': false,
        'cvc': [3]
    },
    'maestro' : {
        'pattern': /^(5018|5020|5038|5893|6304|6759|6761|6762|6763|0604|6390)/,
        'cardlength': [12, 13, 14, 15, 16, 17, 18, 19],
        'luhn': false,
        'cvc': [0, 3, 4]
    },
    'jcb' : {
        'pattern': /^(2131|1800|35)/,
        'cardlength': [16],
        'luhn': false,
        'cvc': [3]
    },
    'amex' : {
        'pattern': /^(3[47])/,
        'cardlength': [15],
        'luhn': false,
        'cvc': [3, 4]
    },
    'mastercard' : {
        'pattern': /^(5[1-5])/,
        'cardlength': [16],
        'luhn': false,
        'cvc': [3]
    },
    'visa' : {
        'pattern': /^(4)/,
        'cardlength': [13, 16],
        'luhn': false,
        'cvc': [3]
    }
};

BrandDetection.prototype.detect = function(cardnumber)
{
    var brand = 'unknown';
    if (cardnumber.length >= this.option.minlength) {
        for (var cardinfo in this.creditcard) {
            if (this.creditcard[cardinfo].pattern.test(cardnumber)) {
                brand = cardinfo;
                break;
            }
        }
    }
    return brand;
};

BrandDetection.prototype.validate = function(cardnumber)
{
    return this.creditcard[this.detect(cardnumber)].cardlength.indexOf(cardnumber.length)  !== -1;
};

BrandDetection.prototype.luhn = function(cardnumber)
{
    //todo
};
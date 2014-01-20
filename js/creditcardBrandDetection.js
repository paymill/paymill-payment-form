function detectCreditcardBranding(creditcardNumber) {
    var brand = 'unknown';
    if (creditcardNumber.match(/^\d{6}/)) {
        switch (true) {
            case /^(415006|497|407497|513)/.test(creditcardNumber):
                brand = "carte bleue";
                break;
            case /^(45399[78]|432913|5255)/.test(creditcardNumber):
                brand = "carta si";
                break;
            case /^(4571|5019)/.test(creditcardNumber):
                brand = "dankort";
                break;
            case /^(62|88)/.test(creditcardNumber):
                brand = "china unionpay";
                break;
            case /^6(011|5)/.test(creditcardNumber):
                brand = "discover";
                break;
            case /^3(0[0-5]|[68])/.test(creditcardNumber):
                brand = "diners club";
                break;
            case /^(5018|5020|5038|5893|6304|6759|6761|6762|6763|0604|6390)/.test(creditcardNumber):
                brand = "maestro";
                break;
            case /^(2131|1800|35)/.test(creditcardNumber):
                brand = "jcb";
                break;
            case /^(3[47])/.test(creditcardNumber):
                brand = "amex";
                break;
            case /^(5[1-5])/.test(creditcardNumber):
                brand = "mastercard";
                break;
            case /^(4)/.test(creditcardNumber):
                brand = "visa";
                break;
        }
    }
    return brand;
}

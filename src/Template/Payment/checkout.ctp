<script>
    function cardFormValidate() {
        var cardValid = 0;

        //card number validation
        $('#card_number').validateCreditCard(function(result) {
            if (result.valid) {
                $("#card_number").removeClass('required');
                cardValid = 1;
            } else {
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
        var regYear = /^2017|2018|2019|2020|2021|2022|2023|2024|2025|2026|2027|2028|2029|2030|2031$/;
        var regCVV = /^[0-9]{3,3}$/;
        if (cardValid == 0) {
            $("#card_number").addClass('required');
            $("#card_number").focus();
            return false;
        } else if (!regMonth.test(expMonth)) {
            $("#card_number").removeClass('required');
            $("#expiry_month").addClass('required');
            $("#expiry_month").focus();
            return false;
        } else if (!regYear.test(expYear)) {
            $("#card_number").removeClass('required');
            $("#expiry_month").removeClass('required');
            $("#expiry_year").addClass('required');
            $("#expiry_year").focus();
            return false;
        } else if (!regCVV.test(cvv)) {
            $("#card_number").removeClass('required');
            $("#expiry_month").removeClass('required');
            $("#expiry_year").removeClass('required');
            $("#cvv").addClass('required');
            $("#cvv").focus();
            return false;
        } else if (!regName.test(cardName)) {
            $("#card_number").removeClass('required');
            $("#expiry_month").removeClass('required');
            $("#expiry_year").removeClass('required');
            $("#cvv").removeClass('required');
            $("#name_on_card").addClass('required');
            $("#name_on_card").focus();
            return false;
        } else {
            $("#card_number").removeClass('required');
            $("#expiry_month").removeClass('required');
            $("#expiry_year").removeClass('required');
            $("#cvv").removeClass('required');
            $("#name_on_card").removeClass('required');
            return true;
        }
    }
    $(document).ready(function() {
        //card validation on input fields
        $('#paymentForm input[type=text]').on('keyup', function() {
            cardFormValidate();
        });
    });
</script>

<style>
    .card-payment {
        height: 476px;
        margin: 0 auto;
        position: relative;
        width: 100%;
    }

    h3 {
        font-size: 30px;
        line-height: 50px;
        margin: 0 0 28px;
        text-align: center;
    }

    ul {
        list-style: outside none none;
    }

    ul,
    h4 {
        border: 0 none;
        font: inherit;
        margin: 0;
        padding: 0;
        vertical-align: baseline;
    }

    form {
        float: none;
    }

    form,
    .cardInfo {
        background-color: #f9f9f7;
        border: 1px solid #fff;
        border-radius: 5px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        left: 0;
        margin: 0 auto;
        padding: 10px 10px;
        max-width: 320px;
    }

    form li {
        margin: 8px 0;
    }

    form label {
        color: #555;
        display: block;
        font-size: 14px;
        font-weight: 400;
    }

    form #card_number {
        background-image: url("<?php echo SITE_URL; ?>images/creditcardimages.png"), url("<?php echo SITE_URL; ?>images/creditcardimages.png");
        background-position: 2px -121px, 260px -61px;
        background-repeat: no-repeat;
        background-size: 120px 361px, 120px 361px;
        padding-left: 54px;
        width: 225px;
    }

    form input {
        background-color: #fff;
        border: 1px solid #e5e5e5;
        box-sizing: content-box;
        color: #333;
        display: block;
        font-size: 18px;
        height: 32px;
        padding: 0 5px;
        width: 275px;
        outline: none;
    }

    form input::-moz-placeholder {
        color: #ddd;
        opacity: 1;
    }

    .payment-btn {
        width: 100%;
        height: 34px;
        padding: 0;
        font-weight: bold;
        color: white;
        text-align: center;
        cursor: pointer;
        text-shadow: 0 -1px 1px rgba(0, 0, 0, 0.2);
        border: 1px solid;
        border-color: #005fb3;
        background: #0092d1;
        border-radius: 4px;
    }

    form li .help {
        color: #aaa;
        display: block;
        font-size: 11px;
        font-weight: 400;
        line-height: 14px;
        padding-top: 14px;
    }

    .vertical {
        overflow: hidden;
    }

    .vertical li {
        float: left;
        width: 95px;
    }

    .vertical input {
        width: 68px;
    }

    .list {
        color: #767670;
        font-size: 16px;
        list-style: outside none disc;
        margin-bottom: 28px;
        margin-left: 25px;
    }

    .card-payment .numbers {
        background-color: #fff;
        border: 1px solid #bbc;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        margin-bottom: 28px;
        padding: 14px 20px;
        z-index: 10;
    }

    .card-payment .numbers p {
        margin-bottom: 0;
        margin-top: 0;
    }

    .card-payment .numbers .list {
        margin-bottom: 0;
        margin-left: 0px;
    }

    .required {
        border: 1px solid #EA4335;
    }

    .cardInfo p span {
        color: #FB4314;
    }
</style>
<div class="col-md-9">

    <form method="post" id="paymentForm">
        <p>
            <label>Card number</label>
            <input type="text" placeholder="1234 5678 9012 3456" id="card_number">
        </p>
        <p>
            <label>Expiry month</label>
            <input type="text" placeholder="MM" maxlength="5" id="expiry_month">
        </p>
        <p>
            <label>Expiry year</label>
            <input type="text" placeholder="YYYY" maxlength="5" id="expiry_year">
        </p>
        <p>
            <label>CVV</label>
            <input type="text" placeholder="123" maxlength="3" id="cvv">
        </p>
        <p>
            <label>Name on card</label>
            <input type="text" placeholder="Codex World" id="name_on_card">
        </p>
    </form>
</div>
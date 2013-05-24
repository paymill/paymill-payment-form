<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type"
              content="text/html; charset=utf-8"/>
        <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/css/bootstrap-combined.min.css" rel="stylesheet">
        <?php
        //
        // Please download the Paymill PHP Wrapper at
        // https://github.com/Paymill/Paymill-PHP
        // and put the containing "lib" folder into your project
        //

        define('PAYMILL_API_HOST', 'https://api.paymill.com/v2/');
        define('PAYMILL_API_KEY', '98842d23994110d6986339436349b0fe');
        set_include_path(
                implode(PATH_SEPARATOR, array(
                    realpath(realpath(dirname(__FILE__)) . '/lib'),
                    get_include_path())
                )
        );

        if (isset($_POST['paymillToken'])) {
            require "Services/Paymill/Transactions.php";
            require "Services/Paymill/Clients.php";
            require "Services/Paymill/Payments.php";

            $transactionsObject = new Services_Paymill_Transactions(PAYMILL_API_KEY, PAYMILL_API_HOST);
            $clientObject = new Services_Paymill_Clients(PAYMILL_API_KEY, PAYMILL_API_HOST);
            $paymentObject = new Services_Paymill_Payments(PAYMILL_API_KEY, PAYMILL_API_HOST);

            $clientParam = array(
                'email' => 'Some Testemail',
                'description' => 'This is a Testuser.'
            );
            $client = $clientObject->create($clientParam);

            $paymentParam = array(
                'token' => $_POST['paymillToken'],
                'client' => $client['id']
            );
            $payment = $paymentObject->create($paymentParam);

            $transactionparams = array(
                'payment' => $payment['id'],
                'amount' => $_POST['amount'] * 100,
                'currency' => $_POST['currency'],
                'description' => 'Test Transaction'
            );
            $transaction = $transactionsObject->create($transactionparams);
        }
        ?>
    </head>
    <body>
        <div class="container">
            <h1>We appreciate your purchase!</h1>

            <h4>Transaction:</h4>
            <pre>
                <?php print_r($transaction); ?>
            </pre>
        </div>
        <script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/js/bootstrap.min.js"></script>
    </body>
</html>
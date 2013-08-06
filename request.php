<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type"
              content="text/html; charset=utf-8"/>
       <?php
        //
        // Please download the Paymill PHP Wrapper at
        // https://github.com/Paymill/Paymill-PHP
        // and put the containing "lib" folder into your project
        //

        define('PAYMILL_API_HOST', 'https://api.paymill.com/v2/');
        define('PAYMILL_API_KEY', 'YOUR_API_KEY');
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
            $clientsObject = new Services_Paymill_Clients(PAYMILL_API_KEY, PAYMILL_API_HOST);
            $paymentsObject = new Services_Paymill_Payments(PAYMILL_API_KEY, PAYMILL_API_HOST);

            $clientsParam = array(
                'email' => 'Some Testemail',
                'description' => 'This is a Testuser.'
            );
            $client = $clientsObject->create($clientsParam);

            $paymentsParam = array(
                'token' => $_POST['paymillToken'],
                'client' => $client['id']
            );
            $payment = $paymentsObject->create($paymentsParam);

            $transactionsParam = array(
                'payment' => $payment['id'],
                'amount' => $_POST['amount'] * 100,
                'currency' => $_POST['currency'],
                'description' => 'Test Transaction'
            );
            $transaction = $transactionsObject->create($transactionsParam);
        }
        ?>
    </head>
    <body>
        <div>
            <h1>We appreciate your purchase!</h1>

            <h4>Transaction:</h4>
            <pre>
                <?php print_r($transaction); ?>
            </pre>
        </div>
    </body>
</html>

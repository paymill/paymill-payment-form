<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type"
              content="text/html; charset=utf-8"/>
       <?php
        //
        // Please download the Paymill PHP Wrapper using composer.
        // If you don't already use Composer,
        // then you probably should read the installation guide http://getcomposer.org/download/.
        //

        //Change the following constants
        define('PAYMILL_API_KEY', 'YOUR_API_KEY');
        define('CUSTOMER_EMAIL', 'SOME_TEST_EMAIL');
        require 'vendor/autoload.php';

       if (isset($_POST['paymillToken'])) {
            $service = new Paymill\Request(PAYMILL_API_KEY);
            $client = new Paymill\Models\Request\Client();
            $payment = new Paymill\Models\Request\Payment();
            $offer = new Paymill\Models\Request\Offer();
            $subscription = new Paymill\Models\Request\Subscription();

            try{
                $client->setEmail(CUSTOMER_EMAIL);
                $client->setDescription('This is a Testuser.');
                $clientResponse = $service->create($client);

                $payment->setClient($clientResponse->getId());
                $payment->setToken($_POST['paymillToken']);
                $paymentResponse = $service->create($payment);

                $offer->setAmount($_POST['amount'])->setCurrency($_POST['currency'])->setInterval($_POST['interval'])->setName($_POST['offer-name']);
                $offerResponse = $service->create($offer);

                $subscription->setClient($clientResponse->getId());
                $subscription->setPayment($paymentResponse->getId());
                $subscription->setOffer($offerResponse->getId());
                $subscriptionResponse = $service->create($subscription);

                $title = "<h1>We appreciate your order!</h1>";
                $result = print_r($subscriptionResponse, true);

            } catch (\Paymill\Services\PaymillException $e){
                $title = "<h1>An error has occoured!</h1>";
                $result = print_r($e->getResponseCode(), true) ." <br />" . print_r($e->getResponseCode(), true) ." <br />" .print_r($e->getErrorMessage(), true);
            }

        }
        ?>
    </head>
    <body>
        <div>
            <?php echo $title ?>

            <h4>Subscription:</h4>
            <pre>
                <?php echo $result ?>
            </pre>
        </div>
    </body>
</html>

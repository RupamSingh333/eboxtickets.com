<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use App\Controller\AppController;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Event\Event;
use Cake\View\CommanHelper;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Cake\Datasource\ConnectionManager;

include(ROOT . DS . "vendor" . DS  . "phpqrcode" . DS . "qrlib.php");
include(ROOT . DS . "vendor" . DS  . "PHPMailer/" . DS . "PHPMailerAutoload.php");

class PaymentController extends AppController
{

    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['processingauth', 'paymentresponse', 'paymentcheck', 'cartdelete', 'finalcheckout', 'prosecond', 'processingcapture', 'processingvoid', 'processingriskmgmt', 'processingpayment', 'processingtokenization', 'processingsale', 'checkout']);
    }
    function createGUID()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {

            mt_srand((float)microtime() * 10000);
            //optional for php 4.2.0 and up.
            $set_charid = strtoupper(md5(uniqid(rand(), true)));
            $set_hyphen = chr(45);
            $set_uuid = substr($set_charid, 0, 8) . $set_hyphen . substr($set_charid, 8, 4) . $set_hyphen . substr($set_charid, 12, 4) . $set_hyphen . substr($set_charid, 16, 4) . $set_hyphen . substr($set_charid, 20, 12);
            return $set_uuid;
        }
    }

    public function processingauth()
    {
        $PowerTranzId = '88804629';
        $PowerTranzPassword  = 'm1hI1pXpZaoZ1eIp9kj71Uzy7blYHoqnGkvnn1mmYAggUryXmqRFcM';
        // $card_pan_data =   $this->request->data['MerchantResponseUrl'];

        $header = [
            'Accept:application/json',
            'PowerTranz-PowerTranzId:' . $PowerTranzId,
            'PowerTranz-PowerTranzPassword:' . $PowerTranzPassword,
            'Content-Type:application/json'
        ];

        $PowerTranzId = '88804629';
        $PowerTranzPassword  = 'm1hI1pXpZaoZ1eIp9kj71Uzy7blYHoqnGkvnn1mmYAggUryXmqRFcM';

        $guid  =  $this->createGUID();

        // Auth transaction
        $transaction_identifier  =   $guid;
        $total_amount = 1;
        $currency_code = 780;
        $threedsecure = true;

        $this->set('transaction_identifier', $transaction_identifier);
        $this->set('total_amount', $total_amount);
        $this->set('currency_code', $currency_code);
        $this->set('threedsecure', $threedsecure);


        // Card Detail
        $cardpan  =  '5115010000000018';
        $CardCvv  =  '323';
        $CardExpiration  =  '2310';
        $CardholderName  =  'John Doe';
        $this->set('cardpan', $cardpan);
        $this->set('CardCvv', $CardCvv);
        $this->set('CardExpiration', $CardExpiration);
        $this->set('CardholderName', $CardholderName);


        //Order identifier
        $OrderIdentifier  =  $guid;
        $this->set('OrderIdentifier', $OrderIdentifier);


        //Billing Address
        $firstname  =   "John";
        $lastname  =  "Smith";
        $line1  =  "1200 Whitewall Blvd.";
        $line2  =  "Unit 15";
        $city  =  "Boston";
        $state  =  "NY";
        $postal_code  =  "200341";
        $country_code = "840";
        $email_address =  "john.smith@gmail.com";
        $phonenumber = "211-345-6790";
        $this->set('firstname', $firstname);
        $this->set('lastname', $lastname);
        $this->set('line1', $line1);
        $this->set('line2', $line2);
        $this->set('city', $city);
        $this->set('state', $state);
        $this->set('postal_code', $postal_code);
        $this->set('country_code', $country_code);
        $this->set('email_address', $email_address);
        $this->set('phonenumber', $phonenumber);

        //addressmatch
        $address_match = false;
        $challenge_window_size = "04";
        $challenge_indictor = "02";
        $merchant_response_url = SITE_URL . "payment/paymentresponse";
        $this->set('address_match', $address_match);
        $this->set('challenge_window_size', $challenge_window_size);
        $this->set('challenge_indictor', $challenge_indictor);
        $this->set('merchant_response_url', $merchant_response_url);
        if ($this->request->is('post')) {

            // pr($this->request->data); die;
            $request_data = [
                "TransactionIdentifier" => $this->request->data['transaction_identifier'],
                "TotalAmount" => $this->request->data['total_amount'],
                "CurrencyCode" => $this->request->data['currency_code'],
                "ThreeDSecure" => $this->request->data['threedsecure'],
                "Source" => [
                    "CardPan" => $this->request->data['cardpan'],
                    "CardCvv" => $this->request->data['CardCvv'],
                    "CardExpiration" => $this->request->data['CardExpiration'],
                    "CardholderName" => $this->request->data['CardholderName']
                ],
                "OrderIdentifier" => $this->request->data['OrderIdentifier'],
                "BillingAddress" => [
                    "FirstName" => $this->request->data['firstname'],
                    "LastName" => $this->request->data['lastname'],
                    "Line1" => $this->request->data['line1'],
                    "Line2" => $this->request->data['line2'],
                    "City" => $this->request->data['city'],
                    "State" => $this->request->data['state'],
                    "PostalCode" => $this->request->data['postal_code'],
                    "CountryCode" => $this->request->data['country_code'],
                    "EmailAddress" => $this->request->data['email_address'],
                    "PhoneNumber" => $this->request->data['phonenumber']
                ],
                "AddressMatch" => $this->request->data['address_match'],
                "ExtendedData" => [
                    "ThreeDSecure" => [
                        "ChallengeWindowSize" => $this->request->data['challenge_window_size'],
                        "ChallengeIndicator" => $this->request->data['challenge_indictor']
                    ],
                    "MerchantResponseUrl" => $this->request->data['merchant_response_url']
                ]
            ];

            $request_json_data =   json_encode($request_data); //die;
            //  echo $request_json_data; die;
            $url = "https://staging.ptranz.com/api/spi/auth";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => 0,
                CURLOPT_ENCODING => "",
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 40,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $request_json_data,
                CURLOPT_HTTPHEADER => $header
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            pr($response);
            die;
        }
    }


    public function processingcapture()
    {

        //echo date('d-m-y h:i:s'); die;
        $PowerTranzId = '88804629';
        $PowerTranzPassword  = 'm1hI1pXpZaoZ1eIp9kj71Uzy7blYHoqnGkvnn1mmYAggUryXmqRFcM';
        // $card_pan_data =   $this->request->data['MerchantResponseUrl'];

        $total_amount = 1;
        $this->set('total_amount', $total_amount);

        $header = [
            'Accept:application/json',
            'PowerTranz-PowerTranzId:' . $PowerTranzId,
            'PowerTranz-PowerTranzPassword:' . $PowerTranzPassword,
            'Content-Type:application/json'
        ];
        if ($this->request->is('post')) {
            //  pr($this->request->data); die;
            $request_data = [
                "TransactionIdentifier" => $this->request->data['transaction_identifier'],
                "TotalAmount" => $this->request->data['total_amount'],
                "ExternalIdentifier" => null,
            ];

            $request_json_data =   json_encode($request_data); //die;
            //echo $request_json_data; die;

            $url = "https://staging.ptranz.com/api/capture";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => 0,
                CURLOPT_ENCODING => "",
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 40,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $request_json_data,
                CURLOPT_HTTPHEADER => $header
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            pr($response);
            die;
        }
    }

    public function processingvoid()
    {
        $PowerTranzId = '88804629';
        $PowerTranzPassword  = 'm1hI1pXpZaoZ1eIp9kj71Uzy7blYHoqnGkvnn1mmYAggUryXmqRFcM';
        $header = [
            'Accept:application/json',
            'PowerTranz-PowerTranzId:' . $PowerTranzId,
            'PowerTranz-PowerTranzPassword:' . $PowerTranzPassword,
            'Content-Type:application/json'
        ];
        if ($this->request->is('post')) {
            //pr($this->request->data); die;
            $request_data = [
                "TransactionIdentifier" => $this->request->data['transaction_identifier'],
                "ExternalIdentifier" => null,
                "TerminalCode" => "",
                "TerminalSerialNumber" => "",
                "AutoReversal" => false
            ];

            $request_json_data =   json_encode($request_data); //die;
            // echo $request_json_data; die;

            $url = "https://staging.ptranz.com/api/void";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => 0,
                CURLOPT_ENCODING => "",
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 40,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $request_json_data,
                CURLOPT_HTTPHEADER => $header
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            pr($response);
            die;
        }
    }

    public function processingriskmgmt()
    {
        $PowerTranzId = '88804629';
        $PowerTranzPassword  = 'm1hI1pXpZaoZ1eIp9kj71Uzy7blYHoqnGkvnn1mmYAggUryXmqRFcM';
        // $card_pan_data =   $this->request->data['MerchantResponseUrl'];

        $header = [
            'Accept:application/json',
            'PowerTranz-PowerTranzId:' . $PowerTranzId,
            'PowerTranz-PowerTranzPassword:' . $PowerTranzPassword,
            'Content-Type:application/json'
        ];

        $PowerTranzId = '88804629';
        $PowerTranzPassword  = 'm1hI1pXpZaoZ1eIp9kj71Uzy7blYHoqnGkvnn1mmYAggUryXmqRFcM';

        $guid  =  $this->createGUID();

        // Auth transaction
        $transaction_identifier  =   $guid;
        $total_amount = 1;
        $currency_code = 780;
        $threedsecure = true;

        $this->set('transaction_identifier', $transaction_identifier);
        $this->set('total_amount', $total_amount);
        $this->set('currency_code', $currency_code);
        $this->set('threedsecure', $threedsecure);


        // Card Detail
        $cardpan  =  '5115010000000018';
        $CardCvv  =  '323';
        $CardExpiration  =  '2310';
        $CardholderName  =  'John Doe';
        $this->set('cardpan', $cardpan);
        $this->set('CardCvv', $CardCvv);
        $this->set('CardExpiration', $CardExpiration);
        $this->set('CardholderName', $CardholderName);


        //Order identifier
        $OrderIdentifier  =  $guid;
        $this->set('OrderIdentifier', $OrderIdentifier);


        //Billing Address
        $firstname  =   "John";
        $lastname  =  "Smith";
        $line1  =  "1200 Whitewall Blvd.";
        $line2  =  "Unit 15";
        $city  =  "Boston";
        $state  =  "NY";
        $postal_code  =  "200341";
        $country_code = "840";
        $email_address =  "john.smith@gmail.com";
        $phonenumber = "211-345-6790";
        $this->set('firstname', $firstname);
        $this->set('lastname', $lastname);
        $this->set('line1', $line1);
        $this->set('line2', $line2);
        $this->set('city', $city);
        $this->set('state', $state);
        $this->set('postal_code', $postal_code);
        $this->set('country_code', $country_code);
        $this->set('email_address', $email_address);
        $this->set('phonenumber', $phonenumber);

        //addressmatch
        $address_match = false;
        $challenge_window_size = "04";
        $challenge_indictor = "02";
        $merchant_response_url = SITE_URL . "payment/paymentresponse";
        $this->set('address_match', $address_match);
        $this->set('challenge_window_size', $challenge_window_size);
        $this->set('challenge_indictor', $challenge_indictor);
        $this->set('merchant_response_url', $merchant_response_url);
        if ($this->request->is('post')) {

            // pr($this->request->data); die;
            $request_data = [
                "TransactionIdentifier" => $this->request->data['transaction_identifier'],
                "TotalAmount" => $this->request->data['total_amount'],
                "CurrencyCode" => $this->request->data['currency_code'],
                "ThreeDSecure" => $this->request->data['threedsecure'],
                "Tokenize" => $this->request->data['tokenize'],
                "Source" => [
                    "CardPan" => $this->request->data['cardpan'],
                    "CardCvv" => $this->request->data['CardCvv'],
                    "CardExpiration" => $this->request->data['CardExpiration'],
                    "CardholderName" => $this->request->data['CardholderName']
                ],
                "OrderIdentifier" => $this->request->data['OrderIdentifier'],
                "BillingAddress" => [
                    "FirstName" => $this->request->data['firstname'],
                    "LastName" => $this->request->data['lastname'],
                    "Line1" => $this->request->data['line1'],
                    "Line2" => $this->request->data['line2'],
                    "City" => $this->request->data['city'],
                    "State" => $this->request->data['state'],
                    "PostalCode" => $this->request->data['postal_code'],
                    "CountryCode" => $this->request->data['country_code'],
                    "EmailAddress" => $this->request->data['email_address'],
                    "PhoneNumber" => $this->request->data['phonenumber']
                ],
                "AddressMatch" => $this->request->data['address_match'],
                "ExtendedData" => [
                    "ThreeDSecure" => [
                        "ChallengeWindowSize" => $this->request->data['challenge_window_size'],
                        "ChallengeIndicator" => $this->request->data['challenge_indictor']
                    ],
                    "MerchantResponseUrl" => $this->request->data['merchant_response_url']
                ]
            ];

            $request_json_data =   json_encode($request_data); //die;
            // echo $request_json_data; die;
            $url = "https://staging.ptranz.com/api/spi/riskmgmt";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => 0,
                CURLOPT_ENCODING => "",
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 40,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $request_json_data,
                CURLOPT_HTTPHEADER => $header
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            pr($response);
            die;
        }
    }

    public function processingpayment()
    {
        $header = [
            'Content-Type:application/json'
        ];
        $spi_token = $this->request->data['spi_token'];
        if ($this->request->is('post')) {
            $request_data = $spi_token;
            $request_json_data =   json_encode($request_data); //die;
            //echo $request_json_data; die;

            $url = "https://staging.ptranz.com/Api/spi/payment";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => 0,
                CURLOPT_ENCODING => "",
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 40,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $request_json_data,
                CURLOPT_HTTPHEADER => $header
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            pr($response);
            die;
        }
    }

    public function processingtokenization()
    {
        $PowerTranzId = '88804629';
        $PowerTranzPassword  = 'm1hI1pXpZaoZ1eIp9kj71Uzy7blYHoqnGkvnn1mmYAggUryXmqRFcM';

        $currency_code = 780;
        $this->set('currency_code', $currency_code);


        // Card Detail
        $cardpresent  =  false;
        $Debit  =  false;
        $cardpan  =  '5115010000000018';
        $CardCvv  =  '323';
        $CardExpiration  =  '2310';
        $CardholderName  =  'John Doe';
        $this->set('cardpan', $cardpan);
        $this->set('CardCvv', $CardCvv);
        $this->set('CardExpiration', $CardExpiration);
        $this->set('CardholderName', $CardholderName);


        $header = [
            'Content-Type:application/json',
            'PowerTranz-PowerTranzId:' . $PowerTranzId,
            'PowerTranz-PowerTranzPassword:' . $PowerTranzPassword,
        ];
        if ($this->request->is('post')) {
            // pr($this->request->data); die;
            $request_data = [
                "Tokenize" => $this->request->data['Tokenize'],
                "CurrencyCode" => $this->request->data['currency_code'],
                "Source" => [
                    "CardPresent" => $this->request->data['cardpresent'],
                    "Debit" => $this->request->data['debit'],
                    "CardPan" => $this->request->data['cardpan'],
                    "CardCvv" => $this->request->data['CardCvv'],
                    "CardExpiration" => $this->request->data['CardExpiration']
                ],
                "ExternalIdentifier" => $this->request->data['external_identifier'],
                "OrderIdentifier" => $this->request->data['order_identifier']

            ];

            $request_json_data =   json_encode($request_data); //die;
            $url = "https://staging.ptranz.com/api/riskmgmt";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => 0,
                CURLOPT_ENCODING => "",
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 40,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $request_json_data,
                CURLOPT_HTTPHEADER => $header
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            pr($response);
            die;
        }
    }

    public function processingsale()
    {
        $PowerTranzId = '88804629';
        $PowerTranzPassword  = 'm1hI1pXpZaoZ1eIp9kj71Uzy7blYHoqnGkvnn1mmYAggUryXmqRFcM';
        // $card_pan_data =   $this->request->data['MerchantResponseUrl'];

        $header = [
            'Accept:application/json',
            'PowerTranz-PowerTranzId:' . $PowerTranzId,
            'PowerTranz-PowerTranzPassword:' . $PowerTranzPassword,
            'Content-Type:application/json'
        ];

        $PowerTranzId = '88804629';
        $PowerTranzPassword  = 'm1hI1pXpZaoZ1eIp9kj71Uzy7blYHoqnGkvnn1mmYAggUryXmqRFcM';

        $guid  =  $this->createGUID();

        // Auth transaction
        $transaction_identifier  =   $guid;
        $total_amount = 1;
        $currency_code = 780;
        $threedsecure = true;

        $this->set('transaction_identifier', $transaction_identifier);
        $this->set('total_amount', $total_amount);
        $this->set('currency_code', $currency_code);
        $this->set('threedsecure', $threedsecure);


        // Card Detail
        $cardpan  =  '5115010000000018';
        $CardCvv  =  '323';
        $CardExpiration  =  '2310';
        $CardholderName  =  'John Doe';
        $this->set('cardpan', $cardpan);
        $this->set('CardCvv', $CardCvv);
        $this->set('CardExpiration', $CardExpiration);
        $this->set('CardholderName', $CardholderName);


        //Order identifier
        $OrderIdentifier  =  $guid;
        $this->set('OrderIdentifier', $OrderIdentifier);


        //Billing Address
        $firstname  =   "John";
        $lastname  =  "Smith";
        $line1  =  "1200 Whitewall Blvd.";
        $line2  =  "Unit 15";
        $city  =  "Boston";
        $state  =  "NY";
        $postal_code  =  "200341";
        $country_code = "840";
        $email_address =  "john.smith@gmail.com";
        $phonenumber = "211-345-6790";
        $this->set('firstname', $firstname);
        $this->set('lastname', $lastname);
        $this->set('line1', $line1);
        $this->set('line2', $line2);
        $this->set('city', $city);
        $this->set('state', $state);
        $this->set('postal_code', $postal_code);
        $this->set('country_code', $country_code);
        $this->set('email_address', $email_address);
        $this->set('phonenumber', $phonenumber);

        //addressmatch
        $address_match = false;
        $challenge_window_size = "04";
        $challenge_indictor = "02";
        $merchant_response_url = SITE_URL . "payment/paymentresponse";
        $this->set('address_match', $address_match);
        $this->set('challenge_window_size', $challenge_window_size);
        $this->set('challenge_indictor', $challenge_indictor);
        $this->set('merchant_response_url', $merchant_response_url);
        if ($this->request->is('post')) {

            // pr($this->request->data); die;
            $request_data = [
                "TransactionIdentifier" => $this->request->data['transaction_identifier'],
                "TotalAmount" => $this->request->data['total_amount'],
                "CurrencyCode" => $this->request->data['currency_code'],
                "ThreeDSecure" => $this->request->data['threedsecure'],
                "Source" => [
                    "CardPan" => $this->request->data['cardpan'],
                    "CardCvv" => $this->request->data['CardCvv'],
                    "CardExpiration" => $this->request->data['CardExpiration'],
                    "CardholderName" => $this->request->data['CardholderName']
                ],
                "OrderIdentifier" => $this->request->data['OrderIdentifier'],
                "BillingAddress" => [
                    "FirstName" => $this->request->data['firstname'],
                    "LastName" => $this->request->data['lastname'],
                    "Line1" => $this->request->data['line1'],
                    "Line2" => $this->request->data['line2'],
                    "City" => $this->request->data['city'],
                    "State" => $this->request->data['state'],
                    "PostalCode" => $this->request->data['postal_code'],
                    "CountryCode" => $this->request->data['country_code'],
                    "EmailAddress" => $this->request->data['email_address'],
                    "PhoneNumber" => $this->request->data['phonenumber']
                ],
                "AddressMatch" => $this->request->data['address_match'],
                "ExtendedData" => [
                    "ThreeDSecure" => [
                        "ChallengeWindowSize" => $this->request->data['challenge_window_size'],
                        "ChallengeIndicator" => $this->request->data['challenge_indictor']
                    ],
                    "MerchantResponseUrl" => $this->request->data['merchant_response_url']
                ]
            ];

            $request_json_data =   json_encode($request_data); //die;
            //echo $request_json_data; die;
            $url = "https://staging.ptranz.com/Api/spi/Sale";
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => 0,
                CURLOPT_ENCODING => "",
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 40,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $request_json_data,
                CURLOPT_HTTPHEADER => $header
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            pr($response);
            die;
        }
    }

    public function checkout()
    {
    }
    public function paymentresponse()
    {
        pr($this->request->data);
        die;
    }
}

<?php

namespace Modules\Paymethod\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use Firebase\JWT\JWT;
use Modules\Paymethod\Libraries\SSLCommerz;
use Modules\Paymethod\Models\FlutterWave;
use Modules\Paymethod\Models\PaymentGatewayModel;
use Modules\Paymethod\Models\PaypalModel;
use Modules\Paymethod\Models\PaystackModel;
use Modules\Paymethod\Models\RazorModel;
use Modules\Paymethod\Models\SslCommerzModel;
use Modules\Paymethod\Models\StripeModel;
use Modules\Paymethod\Models\MpesaModel;
use Modules\Paymethod\Libraries\Mpesa\Mpesa;
use Modules\Website\Models\SmsModel;
use Modules\Website\Libraries\SmsLibrary;
use \stdClass;

class Paymentgateway extends BaseController
{
    use ResponseTrait;

    protected $paymentGatewayModel;
    protected $razorModel;
    protected $payStackModel;
    protected $stripeModel;
    protected $paypalModel;
    protected $sslModel;
    protected $flutterWaveModel;
    protected $MpesaModel;
    protected $db;
    protected $smsLibrary;
    protected $smsModel;  

    public function __construct()
    {
        $this->paymentGatewayModel = new PaymentGatewayModel();
        $this->razorModel = new RazorModel();
        $this->payStackModel = new PaystackModel();
        $this->stripeModel = new StripeModel();
        $this->paypalModel = new PaypalModel();
        $this->sslModel = new SslCommerzModel;
        $this->flutterWaveModel = new FlutterWave;
        $this->MpesaModel = new MpesaModel;
        $this->smsLibrary = new SmsLibrary();
        $this->smsModel = new SmsModel();

        $this->db = \Config\Database::connect();
    }

    public function paymentGateway()
    {
        $paymentGateway = $this->paymentGatewayModel->where('status', 1)->findAll();

        if (!empty($paymentGateway)) {

            $data = [
                'status' => "success",
                'response' => 200,
                'data' => $paymentGateway,
            ];

            return $this->response->setJSON($data);
        } else {

            $data = [
                'message' => "No not found.",
                'status' => "failed",
                'response' => 204,
            ];

            return $this->response->setJSON($data);
        }
    }

    public function paypal()
    {
        $paypaldata = new stdClass();
        $paymentGatewayStatus = $this->paymentGatewayModel->where('status', 1)->find(1);

        if (!empty($paymentGatewayStatus)) {

            $paypal = $this->paypalModel->first();

            if (!empty($paypal)) {

                if ($paypal->environment == 1) {
                    $paypaldata->secrate_id = $paypal->live_s_kye;
                    $paypaldata->client_id = $paypal->live_c_kye;
                    $paypaldata->email = $paypal->email;
                    $paypaldata->merchantid = $paypal->marchantid;
                    $paypaldata->environment = "live";

                    $data = [
                        'status' => "success",
                        'response' => 200,
                        'data' => $paypaldata,
                    ];

                    return $this->response->setJSON($data);
                } else {

                    $paypaldata->secrate_id = $paypal->test_s_kye;
                    $paypaldata->client_id = $paypal->test_c_kye;
                    $paypaldata->email = $paypal->email;
                    $paypaldata->merchantid = $paypal->marchantid;
                    $paypaldata->environment = "Test";

                    $data = [
                        'status' => "success",
                        'response' => 200,
                        'data' => $paypaldata,
                    ];

                    return $this->response->setJSON($data);
                }
            } else {
                $data = [
                    'message' => "No Credential found for Paypal",
                    'status' => "failed",
                    'response' => 204,
                ];

                return $this->response->setJSON($data);
            }
        } else {

            $data = [
                'message' => "Paypal is Disable in System",
                'status' => "failed",
                'response' => 204,
            ];

            return $this->response->setJSON($data);
        }
    }


    public function paystack()
    {
        $paydata = new stdClass();
        $paymentGatewayStatus = $this->paymentGatewayModel->where('status', 1)->find(2);

        if (!empty($paymentGatewayStatus)) {

            $getPayData = $this->payStackModel->first();

            if (!empty($getPayData)) {

                if ($getPayData->environment == 1) {
                    $paydata->secrate_key = $getPayData->live_s_kye;
                    $paydata->private_key = $getPayData->live_p_kye;
                    $paydata->environment = "live";

                    $data = [
                        'status' => "success",
                        'response' => 200,
                        'data' => $paydata,
                    ];

                    return $this->response->setJSON($data);
                } else {

                    $paydata->secrate_key = $getPayData->test_s_kye;
                    $paydata->private_key = $getPayData->test_p_kye;
                    $paydata->environment = "Test";

                    $data = [
                        'status' => "success",
                        'response' => 200,
                        'data' => $paydata,
                    ];

                    return $this->response->setJSON($data);
                }
            } else {
                $data = [
                    'message' => "No Credential found for Paystack",
                    'status' => "failed",
                    'response' => 204,
                ];

                return $this->response->setJSON($data);
            }
        } else {

            $data = [
                'message' => "Paystack is Disable in System",
                'status' => "failed",
                'response' => 204,
            ];

            return $this->response->setJSON($data);
        }
    }


    public function stripe()
    {
        $paydata = new stdClass();
        $paymentGatewayStatus = $this->paymentGatewayModel->where('status', 1)->find(3);

        if (!empty($paymentGatewayStatus)) {

            $getPayData = $this->stripeModel->first();

            if (!empty($getPayData)) {

                if ($getPayData->environment == 1) {
                    $paydata->secrate_key = $getPayData->live_s_kye;
                    $paydata->private_key = $getPayData->live_p_kye;
                    $paydata->environment = "live";

                    $data = [
                        'status' => "success",
                        'response' => 200,
                        'data' => $paydata,
                    ];

                    return $this->response->setJSON($data);
                } else {

                    $paydata->secrate_key = $getPayData->test_s_kye;
                    $paydata->private_key = $getPayData->test_p_kye;
                    $paydata->environment = "Test";

                    $data = [
                        'status' => "success",
                        'response' => 200,
                        'data' => $paydata,
                    ];

                    return $this->response->setJSON($data);
                }
            } else {
                $data = [
                    'message' => "No Credential found for Stripe",
                    'status' => "failed",
                    'response' => 204,
                ];

                return $this->response->setJSON($data);
            }
        } else {

            $data = [
                'message' => "Stripe is Disable in System",
                'status' => "failed",
                'response' => 204,
            ];

            return $this->response->setJSON($data);
        }
    }

    public function razor()
    {
        $paydata = new stdClass();
        $paymentGatewayStatus = $this->paymentGatewayModel->where('status', 1)->find(4);

        if (!empty($paymentGatewayStatus)) {

            $getPayData = $this->razorModel->first();

            if (!empty($getPayData)) {

                if ($getPayData->environment == 1) {
                    $paydata->secrate_key = $getPayData->live_s_kye;

                    $paydata->environment = "live";

                    $data = [
                        'status' => "success",
                        'response' => 200,
                        'data' => $paydata,
                    ];

                    return $this->response->setJSON($data);
                } else {

                    $paydata->secrate_key = $getPayData->test_s_kye;

                    $paydata->environment = "Test";

                    $data = [
                        'status' => "success",
                        'response' => 200,
                        'data' => $paydata,
                    ];

                    return $this->response->setJSON($data);
                }
            } else {
                $data = [
                    'message' => "No Credential found for RazorPay",
                    'status' => "failed",
                    'response' => 204,
                ];

                return $this->response->setJSON($data);
            }
        } else {

            $data = [
                'message' => "RazorPay is Disable in System",
                'status' => "failed",
                'response' => 204,
            ];

            return $this->response->setJSON($data);
        }
    }

    public function flutterWave()
    {
        $paymentGatewayStatus = $this->paymentGatewayModel->where('status', 1)->find(6);

        if (!empty($paymentGatewayStatus)) {

            $getPayData = $this->flutterWaveModel->first();

            if (!empty($getPayData)) {

                if ($getPayData->environment == 1) {

                    $data = [
                        'status' => "success",
                        'response' => 200,
                        'data' => [
                            'public_key' => $getPayData->live_public_key,
                            'secret_key' => $getPayData->live_secret_key,
                            'encryption_key' => $getPayData->live_encryption_key,
                            'environment' => "Live"
                        ],
                    ];

                    return $this->response->setJSON($data);
                } else {

                    $data = [
                        'status' => "success",
                        'response' => 200,
                        'data' => [
                            'public_key' => $getPayData->test_public_key,
                            'secret_key' => $getPayData->test_secret_key,
                            'encryption_key' => $getPayData->test_encryption_key,
                            'environment' => "Test"
                        ],
                    ];

                    return $this->response->setJSON($data);
                }
            } else {
                $data = [
                    'message' => "No Credential found for Flutterwave",
                    'status' => "failed",
                    'response' => 204,
                ];

                return $this->response->setJSON($data);
            }
        } else {

            $data = [
                'message' => "Flutterwave is Disable in System",
                'status' => "failed",
                'response' => 204,
            ];

            return $this->response->setJSON($data);
        }
    }

    public function mpesa()
    {
        $paymentGatewayStatus = $this->paymentGatewayModel->where('status', 1)->find(7);

        if (!empty($paymentGatewayStatus)) {

            $getPayData = $this->MpesaModel->first();

            if (!empty($getPayData)) {

                if ($getPayData->environment == 1) {

                    $data = [
                        'status' => "success",
                        'response' => 200,
                        'data' => [
                            'live_consumer_key' => $getPayData->live_consumer_key,
                            'live_consumer_secret' => $getPayData->live_consumer_secret,
                            'live_shortcode' => $getPayData->live_shortcode,
                            'environment' => "Live"
                        ],
                    ];

                    return $this->response->setJSON($data);
                } else {

                    $data = [
                        'status' => "success",
                        'response' => 200,
                        'data' => [
                            'test_consumer_key' => $getPayData->test_consumer_key,
                            'test_consumer_secret' => $getPayData->test_consumer_secret,
                            'test_shortcode' => $getPayData->test_shortcode,
                            'environment' => "Test"
                        ],
                    ];

                    return $this->response->setJSON($data);
                }
            } else {
                $data = [
                    'message' => "No Credential found for Mpesa",
                    'status' => "failed",
                    'response' => 204,
                ];

                return $this->response->setJSON($data);
            }
        } else {

            $data = [
                'message' => "Mpesa is Disable in System",
                'status' => "failed",
                'response' => 204,
            ];

            return $this->response->setJSON($data);
        }
    }
    public function mpesa_pay(){
        $paymentGatewayStatus = $this->paymentGatewayModel->where('status', 1)->find(7);

        $phone  = $this->request->getVar('phone');
        $amount  = $this->request->getVar('amount');
        // initialize Mpesa Settings
        if (!empty($paymentGatewayStatus)) {

            $getPayData = $this->MpesaModel->first();

            if (!empty($getPayData)) {

                if ($getPayData->environment == 1) {
                    $pesa = new Mpesa($getPayData->live_consumer_key, $getPayData->live_consumer_secret, $getPayData->live_shortcode,$getPayData->live_passkey,$getPayData->live_callback_url,$phone,$amount);
                } else {
                    $pesa = new Mpesa($getPayData->test_consumer_key, $getPayData->test_consumer_secret, $getPayData->test_shortcode,$getPayData->test_passkey,$getPayData->test_callback_url,$phone,$amount);
                }
                $ResponseCode=$pesa->stk_push();
                
                if($ResponseCode['status']==1){
                    $data = [
                        'message' => 'Please Enter your Mpesa Pin Number.',
                        'status' => "Success",
                        'checkout_request_id'=>$ResponseCode['checkout_request_id'],
                        'transection_id'=>$ResponseCode['transection_id'],
                        'response' => 200,
                    ];
                
                
                }else{
                    $data = [
                        'message' => $ResponseCode['status'],
                        'status' => "failed",
                        'response' => 204,
                    ]; 
                }
            }
        }
        return $this->response->setJSON($data);
    }
    public function mpesa_validate(){
        

        // $authorizationHeader  = $this->request->getHeader('Authorization');
        // if ($authorizationHeader !== null) {
        //     // Extract the token without 'Bearer' prefix and any white spaces
        //     //$token = trim(str_replace('Bearer', '', $authorizationHeader));
        //     $parts = explode(' ', $authorizationHeader);

        //     // Get the token (the second part)
        //     $token = trim($parts[2] ?? '');
        // } 
        $CheckoutRequestID  = $this->request->getVar('checkout_request_id');
        $transection_id  = $this->request->getVar('transection_id');
        
        $getPayData = $this->MpesaModel->first();
        // $data['tokken'] = $token;
        //  $data['CheckoutRequestID'] = $CheckoutRequestID;
        //  $data['shortCode'] = $getPayData->test_shortcode;
        //  $data['password'] = base64_encode($getPayData->test_shortcode . $getPayData->test_passkey . date('YmdHis'));
        //  print_r($data);exit;
   
        // build Mpesa environment
        // initialize Mpesa Settings
        date_default_timezone_set('Africa/Nairobi');
        $query_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
        $BusinessShortCode = $getPayData->test_shortcode;
        $Timestamp = date('YmdHis');
        $passkey = $getPayData->test_passkey;
        // ENCRIPT  DATA TO GET PASSWORD
        $Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
        //THIS IS THE UNIQUE ID THAT WAS GENERATED WHEN STK REQUEST INITIATED SUCCESSFULLY
        //$CheckoutRequestID = $this->stk_push();
        $queryheader = ['Content-Type:application/json', 'Authorization:Bearer ' .  $transection_id];
        # initiating the transaction
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $query_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $queryheader); //setting custom header
        $curl_post_data = array(
        'BusinessShortCode' => $BusinessShortCode,
        'Password' => $Password,
        'Timestamp' => $Timestamp,
        'CheckoutRequestID' => $CheckoutRequestID
        );
        //print_r($curl_post_data);exit;                       
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        $data_to = json_decode($curl_response);
        $massage =$data_to;
        if (isset($data_to->ResultCode)) {
            $ResultCode = $data_to->ResultCode;
            if ($ResultCode == '1037') {
                $massage = "Timeout in completing transaction";
            } elseif ($ResultCode == '1032') {
                $massage = "Transaction  has cancelled by user";
            } elseif ($ResultCode == '1') {
                $massage = "The balance is insufficient for the transaction";
            } elseif ($ResultCode == '0') {
                $massage = '1';
            }
        }
                
        if($massage=='1'){
            $data = [
                'message' => 'Payment Successfully',
                'status' => "Success",
                'response' => 200,
            ];
        
        }else{
            $data = [
                'message' => $massage,
                'status' => "failed",
                'response' => 204,
            ]; 
        }
            
        
        return $this->response->setJSON($data);
    }
    
    public function mpesa_callback(){
       //dd('dsadasdsad');
        header("Content-Type: application/json");
        $stkCallbackResponse = file_get_contents('php://input');
        $data = json_decode($stkCallbackResponse);

        $MerchantRequestID = $data->Body->stkCallback->MerchantRequestID;
        $CheckoutRequestID = $data->Body->stkCallback->CheckoutRequestID;
        $ResultCode = $data->Body->stkCallback->ResultCode;
        $ResultDesc = $data->Body->stkCallback->ResultDesc;
        $Amount = $data->Body->stkCallback->CallbackMetadata->Item[0]->Value;
        $TransactionId = $data->Body->stkCallback->CallbackMetadata->Item[1]->Value;
        $UserPhoneNumber = $data->Body->stkCallback->CallbackMetadata->Item[4]->Value;
        if ($ResultCode == 0) {
            $this->db      = db_connect();
            $data=array(
                'MerchantRequestID'=>$MerchantRequestID,
                'CheckoutRequestID'=>$CheckoutRequestID,
                'ResultCode'=>$ResultCode,
                'Amount'=>$Amount,
                'MpesaReceiptNumber'=>$TransactionId,
                'PhoneNumber'=>$UserPhoneNumber
            );
            $this->db->table('transactions')->insert($data);
            // $sms_settings = $this->smsModel->first();
            // $body = 'Payment Amount: '.$Amount. 'Transection id: '.$TransactionId;
            // $this->smsLibrary->send_sms($sms_settings->url,$sms_settings->email,$sms_settings->sender_id,$UserPhoneNumber,$body,$sms_settings->api_key);
            
            $data = [
                'message' => 'Payment Successfully',
                'status' => "Success",
                'response' => 200,
            ];
            return $this->response->setJSON($data);
        }else{
            $this->db      = db_connect();
            $data=array(
                'MerchantRequestID'=>$MerchantRequestID,
                'CheckoutRequestID'=>$CheckoutRequestID,
                'ResultCode'=>$ResultCode,
            );
            $this->db->table('transactions')->insert($data);
            $data = [
                'message' => $ResultDesc,
                'status' => "failed",
                'response' => 204,
            ];
            return $this->response->setJSON($data);
        }

       
       
    }
    public function sslCommerz()
    {
        $paymentGatewayStatus = $this->paymentGatewayModel->where('status', 1)->find(5);

        if (!empty($paymentGatewayStatus)) {
            $getPayData = $this->sslModel->first();

            if (!empty($getPayData)) {
                // Collect credintial from model
                $sslStoreId = $getPayData->ssl_store_id;
                $sslStorePassword = $getPayData->ssl_store_password;
                $sslPaymentEnvironment = $getPayData->environment;

                // initialize sslcommerz instance
                $ssl = new SSLCommerz($sslStoreId, $sslStorePassword, !$sslPaymentEnvironment);

                // build checkout data
                $postedData = $this->request->getPost();

                if (!isset($postedData['callback_url'])) {
                    return $this->response->setJSON(['status' => "failed", 'response' => 204, 'message' => 'Callback url missing']);
                }

                $postedData['success_url'] = base_url(route_to('ssl-payment-callback'));
                $postedData['fail_url']    = base_url(route_to('ssl-payment-callback'));
                $postedData['cancel_url']  = base_url(route_to('ssl-payment-callback'));
                $postedData['value_a']     = $postedData['callback_url'];

                $paydata = $ssl->easyCheckout($postedData);

                if (!empty($ssl->error)) {
                    return $this->response->setJSON(['status' => "failed", 'response' => 204, 'message' => $ssl->error]);
                }

                return $this->response->setJSON(['status' => "success", 'response' => 200, 'data' => $paydata]);
            } else {
                $data = [
                    'message' => "No Credential found for ssl commerz",
                    'status' => "failed",
                    'response' => 204,
                ];

                return $this->response->setJSON($data);
            }
        } else {
            $data = [
                'message' => "SSL Commerz is Disable in System",
                'status' => "failed",
                'response' => 204,
            ];

            return $this->response->setJSON($data);
        }
    }

    public function sslCommerzValidate()
    {
        $paymentGatewayStatus = $this->paymentGatewayModel->where('status', 1)->find(5);

        if (!empty($paymentGatewayStatus)) {
            $getPayData = $this->sslModel->first();

            if (!empty($getPayData)) {
                // Collect credintial from model
                $sslStoreId = $getPayData->ssl_store_id;
                $sslStorePassword = $getPayData->ssl_store_password;
                $sslPaymentEnvironment = $getPayData->environment;

                // initialize sslcommerz instance
                $ssl = new SSLCommerz($sslStoreId, $sslStorePassword, !$sslPaymentEnvironment);

                // build validation data
                $postedData = $this->request->getPost();

                if (!isset($postedData['data'])) {
                    // invalid posted data
                    return $this->response->setJSON(['status' => "failed", 'response' => 204, 'message' => 'data not found']);
                }

                try {
                    // parse jwt token
                    $validatedData = JWT::decode($postedData['data'], getenv('TOKEN_SECRET'), ["HS256"]);
                    $paydata = $ssl->validateResponse((array) $validatedData);
                } catch (\Exception $e) {
                    return $this->response->setJSON(['status' => "failed", 'response' => 204, 'message' => $e->getMessage()]);
                }

                if ($paydata === false) {
                    return $this->response->setJSON(['status' => "failed", 'response' => 204, 'message' => $ssl->error]);
                }

                return $this->response->setJSON(['status' => "success", 'response' => 200, 'valid' => true, 'data' => $ssl->getGatewayResponse()]);
            } else {
                $data = [
                    'message' => "No Credential found for ssl commerz",
                    'status' => "failed",
                    'response' => 204,
                ];

                return $this->response->setJSON($data);
            }
        } else {
            $data = [
                'message' => "SSL Commerz is Disable in System",
                'status' => "failed",
                'response' => 204,
            ];

            return $this->response->setJSON($data);
        }
    }

    public function sslCommerzCallback()
    {
        // collect posted data
        $postedData = $this->request->getPost();

        if (!isset($postedData) || !isset($postedData['value_a'])) {
            // invalid posted data
            return "Invalid data parsed";
        }

        // build query parameter
        $param['session'] = uniqid() . uniqid();

        // build base url
        $base = $postedData['value_a'];

        // build default payment data
        $paymentData = ['status' => 'failed', 'val_id' => null, 'amount' => null, 'currency' => null];

        if (isset($postedData['val_id']) && isset($postedData['amount']) && isset($postedData['currency'])) {
            $paymentData = array(
                'status' => $postedData['status'],
                'val_id' => $postedData['val_id'],
                'amount' => $postedData['amount'],
                'currency' => $postedData['currency']
            );
        }

        $param['data'] = JWT::encode($paymentData, getenv('TOKEN_SECRET'));
        $redirectUrl = $base . '?' .  http_build_query($param);
        return redirect()->to($redirectUrl);
    }

}

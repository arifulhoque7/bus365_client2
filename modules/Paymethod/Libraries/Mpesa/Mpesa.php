<?php

namespace Modules\Paymethod\Libraries\Mpesa;

class Mpesa
{

    protected $consumerKey;
    protected $consumerSecret;
    protected $shortCode;
    protected $passkey;
    protected $callback_url;
    protected $phone;
    protected $amount;
    
    public function __construct(string $consumerKey, string $consumerSecret, string $shortCode,string $passkey,string $callback_url,string $phone,string $amount)
    {
        // $data['consumerKey'] = $consumerKey;
        // $data['consumerSecret'] = $consumerSecret;
        // $data['shortCode'] = $shortCode;
        // $data['passkey'] = $passkey;
        // $data['callback_url'] = $callback_url;
        // $data['phone'] = $phone;
        // $data['amount'] = $amount;
        // print_r($data);exit;
        // build Mpesa environment
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->shortCode = $shortCode;
        $this->passkey = $passkey;
        $this->callback_url = $callback_url;
        $this->phone = $phone;
        $this->amount = $amount;
    }
    // this token use for all apis
    public function accessToken(){        
        try{
            $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
            $headers = ['Content-Type:application/json; charset=utf8'];
            $curl = curl_init($access_token_url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_HEADER, FALSE);
            curl_setopt($curl, CURLOPT_USERPWD, $this->consumerKey . ':' . $this->consumerSecret);
            $result = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            $result = json_decode($result);
            
            $access_token = $result->access_token;
            curl_close($curl);
            // print_r($access_token);exit;
            return $access_token;
        }catch(\Exception $e){
            print_r($e->getMessage());exit;
            //return $e->getMessage();
        }
        
    }

    //Mpesa express start
    public function stk_push(){
        // print_r($this->accessToken());exit;
        if($this->accessToken()!=''){
            date_default_timezone_set('Africa/Nairobi');
            $processrequestUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
            $callbackurl = $this->callback_url;
            $passkey = $this->passkey;
            $BusinessShortCode = $this->shortCode;
            $Timestamp = date('YmdHis');
            // ENCRIPT  DATA TO GET PASSWORD
            $Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
            $phone = $this->phone;//phone number to receive the stk push
            $money = $this->amount;
            $PartyA = $phone;
            $AccountReference = 'Bus365 Software';
            $TransactionDesc = 'Ticket Booking';
            $Amount = $money;
            $stkpushheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $this->accessToken()];
            //INITIATE CURL
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $processrequestUrl);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader); //setting custom header
            $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => $Password,
            'Timestamp' => $Timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $BusinessShortCode,
            'PhoneNumber' => $PartyA,
            'CallBackURL' => $callbackurl,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc
            );

            $data_string = json_encode($curl_post_data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
            $curl_response = curl_exec($curl);
            //ECHO  RESPONSE
            $data = json_decode($curl_response);
            $ResponseCode = $data->ResponseCode??'';
            
            if ($ResponseCode == "0") {
                //return "The CheckoutRequestID for this transaction is : " . $CheckoutRequestID;
                // $CheckoutRequestID = $data->CheckoutRequestID;
                // sleep(5);
                // $msg=$this->quary($CheckoutRequestID);
                $data2=[
                    'status'=>1,
                    'checkout_request_id'=>$data->CheckoutRequestID,
                    'transection_id'=>$this->accessToken()
                ];
                return $data2;
            }else{
                $data2=['status'=>$data->errorMessage];
                return $data2;
            }
        }else{
            $data2=[
                'status'=>'Token Not Generated',
                'checkout_request_id'=>'',
                'transection_id'=>''
            ];
            return $data2;
        }
        
    }
    public function quary($CheckoutRequestID){
        //print_r($this->stk_push());exit;
        date_default_timezone_set('Africa/Nairobi');
        $query_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
        $BusinessShortCode = $this->shortCode;
        $Timestamp = date('YmdHis');
        $passkey = $this->passkey;
        // ENCRIPT  DATA TO GET PASSWORD
        $Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
        //THIS IS THE UNIQUE ID THAT WAS GENERATED WHEN STK REQUEST INITIATED SUCCESSFULLY
        //$CheckoutRequestID = $this->stk_push();
        $queryheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $this->accessToken()];
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
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        echo $curl_response = curl_exec($curl);
        $data_to = json_decode($curl_response);
        if (isset($data_to->ResultCode)) {
            $ResultCode = $data_to->ResultCode;
            if ($ResultCode == '1037') {
                $massage = "Timeout in completing transaction";
            } elseif ($ResultCode == '1032') {
                $massage = "Transaction  has cancelled by user";
            } elseif ($ResultCode == '1') {
                $massage = "The balance is insufficient for the transaction";
            } elseif ($ResultCode == '0') {
                $massage = 1;
            }
        }

        return $massage;
    }

    //end Mpesa express
}
?>
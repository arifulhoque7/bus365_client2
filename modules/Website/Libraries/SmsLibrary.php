<?php

namespace Modules\Website\Libraries;

class SmsLibrary
{
    function send_sms($url,$email,$sender_id,$sender_contact, $message_sender,$api_key) {

        // Set the payload data
        $data = array(
            'email' => $email,
            'sender' => $sender_id,
            'schedule' => date('Y-m-d H:i:s'),
            'sms' => array(
                array(
                    'msisdn' => (string) $sender_contact,
                    'message' => $message_sender,
                    'requestid' => (string) preg_replace("/[^a-zA-Z0-9]+/", "",$sender_id)
                )
            )
        );
       
        // Convert the data to JSON format
        $data_json = json_encode($data);
         //print_r($data_json);exit;
        // Set the cURL options
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "api_key: $api_key",
            "Content-Type: application/json"
        ));

    

    // Send the request and get the response
    $response = curl_exec($ch);
    curl_close($ch); // close the cURL session
    
    return $response;
    }
}
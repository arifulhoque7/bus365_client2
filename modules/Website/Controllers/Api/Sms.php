<?php

namespace Modules\Website\Controllers\Api;

use App\Controllers\BaseController;
use Modules\Website\Models\SmsModel;
use Modules\Website\Libraries\SmsLibrary;
use CodeIgniter\API\ResponseTrait;
class Sms extends BaseController
{

    use ResponseTrait;
	protected $smsModel;  
    protected $smsLibrary; 

    public function __construct()
    {

		$this->smsModel = new SmsModel();
        $this->smsLibrary = new SmsLibrary();

    }

    public function send_sms()
	{
        $sms_settings = $this->smsModel->first();
        $mobile = $this->request->getVar('mobile');
        $body = $this->request->getVar('body');
        $status = $this->smsLibrary->send_sms($sms_settings->url,$sms_settings->email,$sms_settings->sender_id,$mobile,$body,$sms_settings->api_key);
			
        if ($status) {

            $data = [

                'status' => "success",
                'response' => 200,
                'message' =>$status
            ];

            return $this->response->setJSON($data);
            
        }

        else {

            $data = [

                'status' => "fail",
                'response' => 201,
                'message' => "Error in sms sending",
            ];

            return $this->response->setJSON($data);
            
        }
    }
}
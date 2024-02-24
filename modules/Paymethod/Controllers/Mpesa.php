<?php

namespace Modules\Paymethod\Controllers;

use App\Controllers\BaseController;
use Modules\Paymethod\Models\MpesaModel;
use Modules\Paymethod\Config\PaymethodValidation;
class Mpesa extends BaseController
{
	protected $Viewpath;
	protected $mpesaModel;
	
	public function __construct()
    {
        // Init Paymethod validation
        $authValidationConfig = new PaymethodValidation();
        $this->validation = \Config\Services::validation($authValidationConfig);
        $this->Viewpath = "Modules\Paymethod\Views";
		$this->mpesaModel = new MpesaModel();
		
      
    }
	public function new()
	{
		$data['module'] =    lang("Localize.payment_gateway") ; 
		$data['title']  =    lang("Localize.mpesa") ; 

		$data['pageheading'] = lang("Localize.mpesa");

		$data['mpesa'] = $this->mpesaModel->first();
		if (!empty($data['mpesa'])) {
			echo view($this->Viewpath.'\mpesa/edit',$data);
		}
		else
		{
			echo view($this->Viewpath.'\mpesa/new',$data);
		}
		
	}


	public function create()
	{
		
		
		$data= array(
			"live_consumer_key"=> $this->request->getVar('live_consumer_key'),	
			"live_consumer_secret"=> $this->request->getVar('live_consumer_secret'),	
			"live_shortcode"=> $this->request->getVar('live_shortcode'),
			"live_passkey"=> $this->request->getVar('live_passkey'),
			"live_callback_url"=> $this->request->getVar('live_callback_url'),
			"test_consumer_key"=> $this->request->getVar('test_consumer_key'),	
			"test_consumer_secret"=> $this->request->getVar('test_consumer_secret'),	
			"test_shortcode"=> $this->request->getVar('test_shortcode'),
			"test_passkey"=> $this->request->getVar('test_passkey'),
			"test_callback_url"=> $this->request->getVar('test_callback_url'),
			"environment"=> $this->request->getVar('environment'),
		);

		if($this->validation->run($data, 'mpesa'))
		{
			$this->mpesaModel->insert($data);
			return redirect()->route('new-mpesa')->with("success","Data Save");
			
		}
		
		
		else
		{
			$data['validation'] = $this->validation;

			$data['module'] =    lang("Localize.payment_gateway") ; 
			$data['title']  =    lang("Localize.mpesa") ; 
			$data['pageheading'] = lang("Localize.mpesa");
			echo view($this->Viewpath.'\mpesa/new',$data);

		}
		
	}

	public function update($id)
	{
		
		$validdata= array(
			"live_consumer_key"=> $this->request->getVar('live_consumer_key'),	
			"live_consumer_secret"=> $this->request->getVar('live_consumer_secret'),	
			"live_shortcode"=> $this->request->getVar('live_shortcode'),
			"live_passkey"=> $this->request->getVar('live_passkey'),
			"live_callback_url"=> $this->request->getVar('live_callback_url'),
			"test_consumer_key"=> $this->request->getVar('test_consumer_key'),	
			"test_consumer_secret"=> $this->request->getVar('test_consumer_secret'),	
			"test_shortcode"=> $this->request->getVar('test_shortcode'),
			"test_passkey"=> $this->request->getVar('test_passkey'),
			"test_callback_url"=> $this->request->getVar('test_callback_url'),
			"environment"=> $this->request->getVar('environment'),
		);
		$data= array(
			"id"=> $id,
			"live_consumer_key"=> $this->request->getVar('live_consumer_key'),	
			"live_consumer_secret"=> $this->request->getVar('live_consumer_secret'),	
			"live_shortcode"=> $this->request->getVar('live_shortcode'),
			"live_passkey"=> $this->request->getVar('live_passkey'),
			"live_callback_url"=> $this->request->getVar('live_callback_url'),
			"test_consumer_key"=> $this->request->getVar('test_consumer_key'),	
			"test_consumer_secret"=> $this->request->getVar('test_consumer_secret'),	
			"test_shortcode"=> $this->request->getVar('test_shortcode'),
			"test_passkey"=> $this->request->getVar('test_passkey'),
			"test_callback_url"=> $this->request->getVar('test_callback_url'),
			"environment"=> $this->request->getVar('environment'),
		);

		if($this->validation->run($validdata, 'mpesa'))
		{
			$this->mpesaModel->save($data);
			return redirect()->route('new-mpesa')->with("success","Data Update");
		}
		
		
		else
		{
			$data['module'] =    lang("Localize.payment_gateway") ; 
			$data['title']  =    lang("Localize.mpesa") ; 
			$data['pageheading'] = lang("Localize.mpesa");
			$data['validation'] = $this->validation;
			$data['mpesa'] = $this->mpesaModel->find($id);
			echo view($this->Viewpath.'\mpesa/edit',$data);

		}
	}
}

<?php

namespace Modules\Website\Controllers;

use App\Controllers\BaseController;
use Modules\Website\Models\SmsModel;
use App\Libraries\Rolepermission;

class Sms extends BaseController
{

	protected $Viewpath;
	protected $smsModel;  
	protected $db;
	
	public function __construct()
    {

        $this->Viewpath = "Modules\Website\Views";
		$this->smsModel = new SmsModel();
		$this->db      = \Config\Database::connect();
      
    }


	public function new()
	{
		$data['sms']  = $this->smsModel->first();

		$data['module'] =    lang("Localize.website_setting") ; 
		$data['title']  =    lang("Localize.sms_gateway_settings") ;
		$data['pageheading'] = lang("Localize.sms_gateway_settings");

		if (!empty($data['sms'])) {
			echo view($this->Viewpath.'\sms/edit',$data);
		} else {
			echo view($this->Viewpath.'\sms/new',$data);
		}
	}


	public function create()
	{

		$validatedata= array(
			"url"=> $this->request->getVar('url'),
			"email"=> $this->request->getVar('email'),
			"sender_id"=> $this->request->getVar('sender_id'),
			"api_key"=> $this->request->getVar('api_key'),
		);

		
		if($this->validation->run($validatedata, 'sms'))
		{
			
			$this->smsModel->insert($validatedata);
			return redirect()->route('new-sms')->with("success","Data Save");
		}
		
		
		else
		{
			$data['validation'] = $this->validation;

			$data['module'] =    lang("Localize.website_setting") ; 
			$data['title']  =    lang("Localize.sms") ;

			$data['pageheading'] = lang("Localize.sms");

			echo view($this->Viewpath.'\sms/new',$data);

		}
	}

	public function update($id)
	{

		$validatedata= array(
			"url"=> $this->request->getVar('url'),
			"email"=> $this->request->getVar('email'),
			"sender_id"=> $this->request->getVar('sender_id'),
			"api_key"=> $this->request->getVar('api_key'),
		);
		$data= array(

			"id"=> $id,
			"url"=> $this->request->getVar('url'),
			"email"=> $this->request->getVar('email'),
			"sender_id"=> $this->request->getVar('sender_id'),
			"api_key"=> $this->request->getVar('api_key'),
		);

		
		if($this->validation->run($validatedata, 'sms'))
		{
			
			$this->smsModel->save($data);
			return redirect()->route('new-sms')->with("success","Data Save");
		}
		
		
		else
		{
			$data['validation'] = $this->validation;

			$data['module'] =    lang("Localize.website_setting") ; 
			$data['title']  =    lang("Localize.sms") ;

			$heading = lang("Localize.edit").' '.lang("Localize.sms");
			$data['pageheading'] = $heading;

			echo view($this->Viewpath.'\sms/new',$data);

		}
	}

}

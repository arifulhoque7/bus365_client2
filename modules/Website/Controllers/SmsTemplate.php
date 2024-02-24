<?php

namespace Modules\Website\Controllers;

use App\Controllers\BaseController;
use Modules\Website\Models\SmsTemplateModel;
use Modules\Website\Models\SmsModel;
use Modules\Website\Libraries\SmsLibrary;
use Modules\Website\Libraries\SmsTemplateGenerate;
use App\Libraries\Rolepermission;

class SmsTemplate extends BaseController
{

    protected $Viewpath;
    protected $sms_templateModel;
    protected $smsModel;  
    protected $smsLibrary;
    protected $smsTemplateGenerate;
    protected $db;

    public function __construct()
    {
        $this->Viewpath = "Modules\Website\Views";
        $this->sms_templateModel = new SmsTemplateModel();
        $this->smsModel = new SmsModel();
        $this->smsLibrary = new SmsLibrary();

    }

    public function index()
    {
        $data['sms_template'] = $this->sms_templateModel->orderBy('id', 'DESC')->findAll();

        $data['module'] =    lang("Localize.sms_template");
        $data['title']  =    lang("Localize.sms_template_list");

        $data['pageheading'] = lang("Localize.sms_template_list");

        $rolepermissionLibrary = new Rolepermission();
        $add_data = "sms_template";
        $list_data = "sms_template";

        $data['add_data'] = $rolepermissionLibrary->create($add_data);
        $data['edit_data'] = $rolepermissionLibrary->edit($list_data);
        $data['delete_data'] = $rolepermissionLibrary->delete($list_data);


        echo view($this->Viewpath . '\sms_template/index', $data);
    }

    public function new()
    {
        $data['module'] =    lang("Localize.sms_template");
        $data['title']  =    lang("Localize.add_sms_template");

        $data['pageheading'] = lang("Localize.add_sms_template");

        echo view($this->Viewpath . '\sms_template/new', $data);
    }



    public function create()
    {

        $validdata = array(
            "title" => $this->request->getVar('title'),
            "description" => $this->request->getVar('description')
        );

        $data = array(
            "title" => $this->request->getVar('title'),
            "description" => $this->request->getVar('description')
        );

        if ($this->validation->run($validdata, 'sms_template')) {
            $this->sms_templateModel->insert($data);
            return redirect()->route('index-smstemplate')->with("success", "Data Save");
        }

        return redirect()->back()->withInput()->with('fail', $this->validation->listErrors());
    }


    public function edit($id)
    {
        $data['sms_template'] = $this->sms_templateModel->find($id);

        $heading = lang("Localize.edit") . ' ' . lang("Localize.sms_template");
        $data['pageheading'] = $heading;

        echo view($this->Viewpath . '\sms_template/edit', $data);
    }

    public function update($id)
    {
        $data = array(
            "id" => $id,
            //"title" => $this->request->getVar('title'),
            "description" => $this->request->getVar('description'),
        );
        $validdata = array(
            //"title" => $this->request->getVar('title'),
            "description" => $this->request->getVar('description'),
        );

        if ($this->validation->run($validdata, 'sms_template')) {
            $this->sms_templateModel->save($data);
            return redirect()->route('index-smstemplate')->with("success", "Data Save");
        } else {
            $data['module'] =    lang("Localize.sms_template");
            $data['title']  =    lang("Localize.sms_template_list");

            $heading = lang("Localize.edit") . ' ' . lang("Localize.sms_template");
            $data['pageheading'] = $heading;

            $data['sms_template'] = $this->sms_templateModel->find($id);
            echo view($this->Viewpath . '\sms_template/edit', $data);
        }
    }


    public function delete($id)
    {
        $this->sms_templateModel->delete($id);
        return redirect()->route('index-smstemplate')->with("fail", "Data Deleted");
    }

    public function send_sms_view()
    {
        $data['module'] =    lang("Localize.send_sms");
        $data['title']  =    lang("Localize.send_sms");

        $data['pageheading'] = lang("Localize.send_sms");
        $data['sms_template'] = $this->sms_templateModel->orderBy('id', 'DESC')->findAll();
        echo view($this->Viewpath . '\sms_template/send_sms', $data);
    }


    public function sms_send(){
        $sms_settings = $this->smsModel->first();
        
            $dynamic_value=array(
            'merchant_id' =>$sms_settings->sender_id,
            'transection_id' =>'66RRh022',
            'amount' => 1000
            );
        $mobile = $this->request->getVar('mobile');
        
        $validdata = array(
            "mobile" => $this->request->getVar('mobile'),
            "template_id" => $this->request->getVar('template_id'),
        );

        if ($this->validation->run($validdata, 'send_sms')) {
            $template_sms =$this->sms_templateModel->find($this->request->getVar('template_id'));
            $message= $template_sms->description;
            $SendSMS  = new SmsTemplateGenerate($message, $dynamic_value);
            $body=$SendSMS->sms_msg_generate();
            //return $this->response->setJSON($body);
            $this->smsLibrary->send_sms($sms_settings->url,$sms_settings->email,$sms_settings->sender_id,$mobile,$body,$sms_settings->api_key);
            //if ($status) {
            return redirect()->route('index-smstemplate')->with("success", 'Succesfully Sent');  
        } else {
            return redirect()->back()->withInput()->with('fail', $this->validation->listErrors());
        }
    }
}

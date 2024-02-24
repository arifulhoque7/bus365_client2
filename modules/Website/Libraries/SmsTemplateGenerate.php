<?php

namespace Modules\Website\Libraries;

class SmsTemplateGenerate
{
    protected $message;
    protected $message_data=[];
    
    
    public function __construct($message,$message_data)
    {
        // build SMS environment
        $this->message = $message;
        $this->message_data = $message_data;

    }
    public function sms_msg_generate(){
       
        if (is_array($this->message_data) && sizeof($this->message_data) > 0){
            $message = $this->_template($this->message, $this->message_data);
        }
        $data['message']  = $message;
        return $data;
    
      }
    private function _template($template = null, $data = array())
    {
        $newStr = $template;
        foreach ($data as $key => $value) {
            $newStr = str_replace("%$key%", $value, $newStr);
        } 
        return $newStr; 
    }
}
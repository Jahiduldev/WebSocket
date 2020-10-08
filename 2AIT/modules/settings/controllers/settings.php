<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CZ_Controller{

	/**
         * 
         * @copyright	Copyright (c) 2015 CoreZ IT.
         * @author      Tanveer Agmed Ivan
         * @version 	1.0.1
         * 
	 */
        function __construct()
	{
		parent::__construct();
                if(!$this->ion_auth->logged_in())
                {
                        //redirect them to the login page
                        redirect('user/login', 'refresh');
                }
        }
        function index(){
            $this->form_validation->set_rules('mail_footer', 'Mail Footer', 'required');
            if ($this->form_validation->run() == true)
            {
                $values = array(
                    'mail_footer'   => $this->input->post('mail_footer')
                );
                
                $where['id'] = 1;
                $this->CoreZ_IT->update('site',$values,$where);
                $this->session->set_flashdata('message','Your Settings has been updated.');
                redirect('settings', 'refresh');
            }
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Settings';
            $this->CoreZ_IT->_render_backend('index', $data);
        }
        
}
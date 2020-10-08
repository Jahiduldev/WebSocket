<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends CZ_Controller{
	/**
         * 
         * @copyright	Copyright (c) 2016 CoreZ IT.
         * @author      Tanveer Agmed Ivan
         * 
         * @version 	1.0.1
         * 
	 */
     
       function index(){    
            $this->form_validation->set_rules('contact_name', 'Name', 'required');
            $this->form_validation->set_rules('contact_email', 'Email', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('contact_phone', 'Company', 'required');
            $this->form_validation->set_rules('contact_website', 'Website', 'required');
            $this->form_validation->set_rules('contact_message', 'Message', 'required');
            if($this->form_validation->run() == true)
            {
                $url = $this->CoreZ_IT->url_check($this->CoreZ_IT->random_string(10), 'contact');
                $values = array(   
                    'url'       => $url,
                    'name'      => $this->input->post('contact_name'), 
                    'email'     => $this->input->post('contact_email'),
                    'company'     => $this->input->post('contact_phone'),
                    'website'     => $this->input->post('contact_website'),
                    'message'   => $this->input->post('contact_message')  
                );
                $this->CoreZ_IT->insert('contact',$values);
                $this->session->set_flashdata('message','Message  has been sent Successfully.');
                redirect('contact', 'refresh');
            }
           
            $data['name'] = array(
                'class' => 'form-control',
                'name'  => 'contact_name',
                'id'=>'contact_name',
                'type'  => 'text',
                'placeholder'=>"First name",
                'value' => $this->form_validation->set_value('contact_name')
            );
             
             $data['email'] = array(
                'class' => 'form-control',
                'name'  => 'contact_email',
                'type'  => 'email',
                'id'=>'contact_email',
                'placeholder'=>"Email address",
                'value' => $this->form_validation->set_value('contact_email')
            );
            $data['phone'] = array(
              'class' => 'form-control',
              'name'  => 'contact_phone',
              'type'  => 'text',
              'id'=>'contact_phone',
              'placeholder'=>"Phone",
              'value' => $this->form_validation->set_value('contact_phone')
          );
        
             $data['website'] = array(
              'class' => 'form-control',
              'name'  => 'contact_website',
              'id'=>'contact_website',
              'type'  => 'text',
              'placeholder'=>"Your website",
              'value' => $this->form_validation->set_value('contact_website')
          );
            
          $data['form_message'] = array(
                'class' => 'form-control',
                'class'=>"mt-30 form-control",
                'placeholder'=>"Write message",
                'rows'=>"10",
                'name'  => 'contact_message', 
                'id'    => 'contact_message',
                'value' => $this->form_validation->set_value('contact_message')
            );
           
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Contact';
            $data['site'] = $this->CoreZ_IT->get('site')->result();  
            $this->CoreZ_IT->_render_frontend('index', $data);
        }
        
        
          function all(){ 
             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Contact';
            $data['contacts'] = $this->CoreZ_IT->get('contact')->result();  
            $this->CoreZ_IT->_render_backend('all', $data);
            
            
        }
        
         
         function delete($url = NULL){
           if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            if(empty($url)){
                redirect('contact/all', 'refresh');
            }
            $where = array(
                'url'   => $url
            );
           
            $this->CoreZ_IT->delete('contact', $where);
            $this->session->set_flashdata('message','Contact has been  Successfully  deleted.');
            redirect('contact/all', 'refresh');
            
            
        }





    public function addClientData() 
    {

             $this->form_validation->set_rules('contact_email', 'Email', 'trim|required|valid_email|xss_clean');
             $this->form_validation->set_rules('contact_message', 'Message', 'required');
             if($this->form_validation->run() == true)
            {
              $this->load->library('email');

              $name = stripslashes($this->input->post('contact_name'));
              $email_from = stripslashes($this->input->post('contact_email'));
              $contact_subject = stripslashes($this->input->post('contact_subject'));
              $contact_phone = stripslashes($this->input->post('contact_phone'));
              $message = stripslashes($this->input->post('contact_message'));
              $email_to = 'kzis1987@gmail.com';//replace with your email
              
            $body = 'Name: ' . $name . "\n\n" .'Subject:'.$contact_subject. "\n\n" . 'From: ' . $email_from . "\n\n" . 'Phone: ' . $contact_phone . "\n\n" . 'Message: ' . $message;
           
            $this->email->from($email_from, $name);
            $this->email->to($email_to);

            $this->email->subject($contact_subject);
            $this->email->message($body);
            $this->email->send();
            //echo $this->email->print_debugger();
            if($this->email->send())
            {
              $this->session->set_flashdata('message','Message  has been sent Successfully.');
               redirect('contact', 'refresh');
            }else{
               redirect('contact', 'refresh');

            }
         
    }
        
       
        
        
        
        
        
}


}
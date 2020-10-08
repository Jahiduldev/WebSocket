<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apply extends CZ_Controller{
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
       
        
        
        



      public function addClientData() {
         // if (in_array($this->session->userdata('role_id'), array(1, 2))):

         //    $data['base_url'] = $this->config->item('base_url');
            
            $name = mysql_real_escape_string($this->input->post('name'));
            $fother_name = mysql_real_escape_string($this->input->post('fother_name'));
            $birth_date = mysql_real_escape_string($this->input->post('date'));
            $nation_id = mysql_real_escape_string($this->input->post('nation_id'));
            $mobile = mysql_real_escape_string($this->input->post('mobile'));
            $course = mysql_real_escape_string($this->input->post('course'));
            $address = mysql_real_escape_string($this->input->post('address'));
            $education = mysql_real_escape_string($this->input->post('education'));

           
            $date = date('Y-m-d');



            $data_department = array(
                'name' => $name,
                'father_name' => $fother_name,
                'birth_date' => $birth_date,
                'nation_id' => $nation_id,
                'mobile' => $mobile,
                'course' => $course,
                'address' => $address,
                'education' => $education,
                'date' => $date,

            );


            $insert_result = $this->CoreZ_IT->insert('apply',$data_department);

            if ($insert_result):
                $this->session->set_userdata('msg_title', 'Success');
                $this->session->set_userdata('msg_body', 'Successfull');

            else:
                $this->session->set_userdata('msg_title', 'Error');
                $this->session->set_userdata('msg_body', 'Failed');
            endif;
            redirect('apply');
        // else:
        //     redirect('home');
        // endif;
    }
        
        
}

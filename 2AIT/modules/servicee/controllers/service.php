<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Service extends CZ_Controller{
	/**
         * 
         * @copyright	Copyright (c) 2016 CoreZ IT.
         * @author      Tanveer Agmed Ivan
         * @version 	1.0.1
         * 
	 */
       function index(){
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Home';
            $data['site'] = $this->CoreZ_IT->get('site')->row();
            $data['services'] = $this->CoreZ_IT->get('service')->result();
            $this->CoreZ_IT->_render_frontend('index', $data);
        }
     
        
          function all(){  

             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            //$data['event'] = $this->CoreZ_IT->get('event')->result();
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = $this->session->flashdata('message_error');
            $data['page_title'] = 'All product';
            $data['abouts'] = $this->CoreZ_IT->get('service')->result();
            $this->CoreZ_IT->_render_backend('all', $data);
         }  
           function add(){

             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            $this->load->library('upload');
            if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
           
            $this->form_validation->set_rules('title', 'name', 'required');
            //$this->form_validation->set_rules('location', 'Location', 'required');
            //$this->form_validation->set_rules('des', 'Description', 'required');
            //$this->form_validation->set_rules('short_des', 'Short Description', 'required');
           
              if($this->form_validation->run() == true){
                $url = $this->CoreZ_IT->url_check($this->input->post('title'), 'about');
                $values = array(
                    // 'url'                       => strtolower($url),     
                    'image'                     => $this->input->post('image'),
                    'title'                     => $this->input->post('title'),
                    'designation'               => $this->input->post('designation'),
                   
                   
                );                
                $config['upload_path']      = './uploads/event/';
                $config['allowed_types']    = 'jpg|png';
                $config['max_size']         = '2048';
                $config['overwrite']        = FALSE;
                $config['encrypt_name']     = TRUE;
                $this->upload->initialize($config);
                if($this->upload->do_upload('image')){
                    $upload_data = $this->upload->data();
                    $values['image'] = $upload_data['file_name'];
                    $this->CoreZ_IT->insert('service',$values);
                    $this->session->set_flashdata('message','service Successfully Added.');
                    redirect('service/all', 'refresh');
                }
               
                $this->CoreZ_IT->insert('service',$values);
                $this->session->set_flashdata('message','service has been successfully added.');
                redirect('service/all', 'refresh');
            }
               
            $data['title'] = array(
                'class' => 'form-control',
                'name'  => 'title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('title'),
            );
             $data['designation'] = array(
                'class' => 'form-control',
                'name'  => 'designation',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('designation'),
            );
           

           
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Add Clients';
            $this->CoreZ_IT->_render_backend('add', $data);
        }
        

        function edit($url=NULL){
             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            $this->load->library('upload');
            if(empty($url)){
                $this->session->set_flashdata('message','Event not found.');
                redirect('service/all', 'refresh');
            }
            $where = array(
                'url'   => $url
            );
            $data['service'] = $this->CoreZ_IT->get_where('service', $where)->row();
            if(empty($data['service'])){
                $this->session->set_flashdata->message('message_error' , 'Events Not Found.');
                redirect('service/all', 'refresh');
            }
            if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            $this->form_validation->set_rules('title', 'Title', 'required');
              if($this->form_validation->run() == true){
                $url = $this->CoreZ_IT->url_check($this->input->post('title'), 'event');
                $values = array(
                    'title'                     => $this->input->post('title'),
                    'url'                       => $url ,
                    'location'                  => $this->input->post('loacation'),
                    'time'                      => $this->input->post('time'),
                    'short_des'                 => $this->input->post('short_des'),    
                    'details'                   => $this->input->post('details'),
                    'phone'                     => $this->input->post('phone'),
                    'email'                     => $this->input->post('email'),
                    'image'                     => $this->input->post('image')
                );    
                $config['upload_path']      = './uploads/event/';
                $config['allowed_types']    = 'jpg|png';
                $config['max_size']         = '2048';
                $config['overwrite']        = FALSE;
                $config['encrypt_name']     = TRUE;
                $this->upload->initialize($config);
                if($this->upload->do_upload('image')){
                    $upload_data = $this->upload->data();
                    $values['image'] = $upload_data['file_name'];
                    $this->CoreZ_IT->update('service',$values,$where);
                    $this->session->set_flashdata('message','Staffs Successfully Added.');
                }
                $this->CoreZ_IT->update('service',$values,$where);
                $this->session->set_flashdata('message','About page has been successfully updated.');
                $data['message'] = $this->session->flashdata('message');
                $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
                redirect('service/all', 'refresh');
            }
            $data['title'] = array(
                'class' => 'form-control',
                'name'  => 'title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('title',$data['service']->title)
            );
            $data['designation'] = array(
                'class' => 'form-control',
                'name'  => 'designation',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('designation',$data['service']->title)
            );

              
        
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Edit about';
            $this->CoreZ_IT->_render_backend('edit', $data);
        }
          function delete($url = NULL){

             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            if(empty($url)){
                    redirect('service/all', 'refresh');
     
            }
            $where = array(
                'id'   => $url
            );
            $this->CoreZ_IT->delete('service', $where);
            $this->session->set_flashdata('message','Sercice  Successfully  deleted.');
            redirect('service/all', 'refresh');
        }
        
       
        
}

        
        
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

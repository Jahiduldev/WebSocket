<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CZ_Controller{
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
            $data['sliders'] = $this->CoreZ_IT->get('slider')->result();
            $data['logos'] = $this->CoreZ_IT->get('logo')->result();
            $data['services'] = $this->CoreZ_IT->get('service')->result();
            $data['gallery_cats'] = $this->CoreZ_IT->get('gallery_cat')->result();
            $data['homes'] = $this->CoreZ_IT->get('home')->result();
            $data['news'] = $this->CoreZ_IT->get('news_cat')->result();
            $this->CoreZ_IT->_render_frontend('index', $data);
        }
     
        
          function all(){  
             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            //$data['event'] = $this->CoreZ_IT->get('event')->result();
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = $this->session->flashdata('message_error');
            $data['page_title'] = 'Marquee';
            $data['home'] = $this->CoreZ_IT->get('home')->result();
            $this->CoreZ_IT->_render_backend('all', $data);
         }  
          

        function edit($url=NULL){
             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }

            if(empty($url)){
                $this->session->set_flashdata('message','Event not found.');
                redirect('home/all', 'refresh');
            }
            $where = array(
                'url'   => $url
            );
            $data['home'] = $this->CoreZ_IT->get_where('home', $where)->row();
            if(empty($data['home'])){
                // $this->session->set_flashdata->message('message_error' , 'Data Not Found.');
                redirect('home/all', 'refresh');
            }
            if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            $this->form_validation->set_rules('title', 'Title', 'required');
              if($this->form_validation->run() == true){
                //$url = $this->CoreZ_IT->url_check($this->input->post('title'), 'event');
                $values = array(
                    'title'                     => $this->input->post('title'),
                    // 'url'                       => $url ,
                    'word'                  => $this->input->post('word'),
                    
                );    
              
               
                $this->CoreZ_IT->update('home',$values,$where);
                $this->session->set_flashdata('message','Marquee has been successfully updated.');
                $data['message'] = $this->session->flashdata('message');
                $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
                redirect('home/all', 'refresh');
            }
            $data['title'] = array(
                'class' => 'form-control',
                'name'  => 'title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('title',$data['home']->title)
            );
            $data['word'] = array(
                'class' => 'form-control',
                'name'  => 'word',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('word',$data['home']->word)
            );
            // $data['message'] = $this->session->flashdata('message');
            // $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Edit Marquee';
            $this->CoreZ_IT->_render_backend('edit', $data);
        }
          function delete($url = NULL){
             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            if(empty($url)){
                redirect('home/all', 'refresh');
            }
            $where = array(
                'url'   => $url
            );
            $this->CoreZ_IT->delete('logo', $where);
            $this->session->set_flashdata('message','logo  Successfully  deleted.');
            redirect('home/all_logo', 'refresh');
        }
        
        
        
        
        
}

        
        
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

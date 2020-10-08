<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CZ_Controller{
	
        function __construct()
	{
		parent::__construct();
        }
        function index(){ 
           
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Gallery';
            $data['products'] = $this->CoreZ_IT->get('gallery')->result();
            $this->CoreZ_IT->_render_frontend('index', $data);
        }
        
         
         function all(){  
             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            $data['product'] = $this->CoreZ_IT->get('gallery')->result();
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = $this->session->flashdata('message_error');
            $data['page_title'] = 'All gallery';
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
            $this->form_validation->set_rules('title', 'Title', 'required');
              if($this->form_validation->run() == true){
                $url = $this->CoreZ_IT->url_check($this->input->post('title'), 'gallery');
                $values = array(
                    'title'                     => $this->input->post('title'),
                    'url'                       => $url ,
                );                
                $config['upload_path']      = './uploads/gallery/';
                $config['allowed_types']    = 'jpg|png';
                $config['max_size']         = '2048';
                $config['overwrite']        = FALSE;
                $config['encrypt_name']     = TRUE;
                $this->upload->initialize($config);
                if($this->upload->do_upload('product_image')){
                    $upload_data = $this->upload->data();
                    $values['image'] = $upload_data['file_name']; 
                }
                $this->CoreZ_IT->insert('gallery',$values);
                $this->session->set_flashdata('message','Gallery has been successfully added.');
                redirect('gallery/all', 'refresh');
            }
               
            $data['tile'] = array(
                'class' => 'form-control',
                'name'  => 'title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('title'),
            );
            
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Add gallery';
            $this->CoreZ_IT->_render_backend('add', $data);
        }
        
        
       
         
        function edit($url=NULL){
             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            $this->load->library('upload');
            if(empty($url)){
                $this->session->set_flashdata('message','Gallery not found.');
                redirect('gallery/all', 'refresh');
            }
            $where = array(
                'url'   => $url
            );
            $data['product'] = $this->CoreZ_IT->get_where('gallery', $where)->row();
            if(empty($data['product'])){
                $this->set_flashdata->message('message_error' , 'Gallery Not Found.');
                redirect('gallery/all', 'refresh');
            }
            
            $this->form_validation->set_rules('title', 'Title', 'required');
           
            if($this->form_validation->run() == true){
                $values = array(
                    'title' => $this->input->post('title'),                 
                );                
                $config['upload_path']      = './uploads/gallery/';
                $config['allowed_types']    = 'jpg|png';
                $config['max_size']         = '2048';
                $config['overwrite']        = FALSE;
                $config['encrypt_name']     = TRUE;
                $this->upload->initialize($config);
               
                if ($this->upload->do_upload('product_image')){
                    $upload_data = $this->upload->data();
                    $values['image'] = $upload_data['file_name'];   
                    
                }
                $this->CoreZ_IT->update('gallery',$values,$where);
                $this->session->set_flashdata('message','Gallery has been successfully updated.');
                redirect('gallery/all', 'refresh');
            }
               
            $data['title'] = array(
                'class' => 'form-control',
                'name'  => 'title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('title', $data['product']->title),
            );
            
              
         
           
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Add product';
            $this->CoreZ_IT->_render_backend('edit', $data);
        }
        
        
        
          function delete($url = NULL){
             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            if(empty($url)){
                redirect('gallery/all', 'refresh');
            }
            $where = array(
                'url'   => $url
            );
           
            $this->CoreZ_IT->delete('gallery', $where);
            $this->session->set_flashdata('message','Gallery has been successfully  deleted.');
            redirect('gallery/all', 'refresh');
            
        }
        
     


    }

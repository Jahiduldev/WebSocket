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


            // $id= $this->uri->segment(3);
            // $where =  array(
            //     'course_cat_id' =>  $id, 
            // );
    
            // $data['courses'] = $this->CoreZ_IT->get_where('course',$where)->result();
            $data['gallerys'] = $this->CoreZ_IT->get('gallery')->result();
            $data['gallery_cats'] = $this->CoreZ_IT->get('gallery_cat')->result();
            $data['logos'] = $this->CoreZ_IT->get('logo')->result();
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
            $this->load->library('upload');
            if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            $this->form_validation->set_rules('title', 'Title', 'required');
              if($this->form_validation->run() == true){
                $url = $this->CoreZ_IT->url_check($this->input->post('title'), 'gallery');
                $values = array(
                    'gal_cat_id'            => $this->input->post('gallery_cat'),
                    'title'                 => $this->input->post('title'),
                    'url'                   => $url ,
                );                
                $config['upload_path']      = './uploads/gallery/';
                $config['allowed_types']    = 'jpg|png|jpeg';
                $config['max_size']         = '2048';
                $config['overwrite']        = FALSE;
                $config['encrypt_name']     = TRUE;
                $this->upload->initialize($config);
                if($this->upload->do_upload('product_image')){
                    $upload_data = $this->upload->data();
                    $values['image'] = $upload_data['file_name']; 
                }
                $this->CoreZ_IT->insert('gallery',$values);

                    $configrez2['source_image'] = './uploads/slider/'.$upload_data['file_name'];
                    $configrez2['new_image'] = './uploads/slider/'.$upload_data['file_name'];
                    $configrez2['maintain_ratio'] = FALSE;
                    $configrez2['width'] = "640";
                    $configrez2['height'] = "426";

                    $this->image_lib->initialize($configrez2);
                    $this->image_lib->resize();

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


        // start gallert cat
         function all_cat(){  
             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            $data['gallery_cats'] = $this->CoreZ_IT->get('gallery_cat')->result();
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = $this->session->flashdata('message_error');
            $data['page_title'] = 'All gallery category';
            $this->CoreZ_IT->_render_backend('all_cat', $data);
        }      
        function add_cat(){
             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            $this->load->library('upload');
            $this->form_validation->set_rules('title', 'Title', 'required');
            // $this->form_validation->set_rules('subtitle', 'Sub Title', '');
            if($this->form_validation->run() == true)
            {
                $url = $this->CoreZ_IT->url_check($this->input->post('title'), 'gallery_cat');

                $values = array(
                    'title'             => $this->input->post('title'),
                    'url'               => $url,
                    // 'sub_title'         => $this->input->post('subtitle')
                       
                );

                $config['upload_path']      = './uploads/gallery/';
                $config['allowed_types']    = 'jpeg|png|jpg';
                $config['max_size']         = '4048';
                $config['overwrite']        = FALSE;
                $config['encrypt_name']     = TRUE;

                $this->upload->initialize($config);

                if($this->upload->do_upload('product_image')){
                    
                    $upload_data = $this->upload->data();
                    $values['image'] = $upload_data['file_name'];   
                    $this->CoreZ_IT->insert('gallery_cat',$values);
                    
                    $configrez2['source_image'] = './uploads/slider/'.$upload_data['file_name'];
                    $configrez2['new_image'] = './uploads/slider/'.$upload_data['file_name'];
                    $configrez2['maintain_ratio'] = FALSE;
                    $configrez2['width'] = "640";
                    $configrez2['height'] = "426";

                    $this->image_lib->initialize($configrez2);
                    $this->image_lib->resize();
                    $this->session->set_flashdata('message','Gallery category Successfully Added.');
                    redirect('gallery/all_cat', 'refresh');
                }
                
            }               
            $data['title'] = array(
                'class' => 'form-control',
                'name'  => 'title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('title'),
            );
             $data['subtitle'] = array(
                'class' => 'form-control',
                'name'  => 'subtitle',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('subtitle'),
            );
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : ($this->upload->display_errors() ? $this->upload->display_errors() : $this->session->flashdata('message_error'));
            $data['page_title'] = 'Add gallery cat';
            $this->CoreZ_IT->_render_backend('add_cat', $data);
        }
       
         function delete_cat($url = NULL){
             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            if(empty($url)){
                redirect('gallery/all_cat', 'refresh');
            }
            $where = array(
                'url'   => $url
            );
            $data= $this->CoreZ_IT->get_where('gallery_cat',$where)->result();
            foreach($data as $delete){
               $del_image = $delete->image;
            }
           if(file_exists($del_image)){ unlink("/uploads/gallery/$del_image"); }
            $this->CoreZ_IT->delete('gallery_cat', $where);
            $this->session->set_flashdata('message','gallery category has been successfully  deleted.');
            redirect('gallery/all_cat', 'refresh');
            
        }



    }




















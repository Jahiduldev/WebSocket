<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CZ_Controller{
	
        function __construct()
	    {
		    parent::__construct(); 

        }

        function index(){ 
           
           
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Gallery';

            $array = array(1,2);
            if(in_array($this->uri->segment(3), $array))
            {
                $where =  array(
                    'about_id' => $this->uri->segment(3) 
                );
                $data['abouts'] = $this->CoreZ_IT->get_where('about_us', $where)->result();
            }
            else
            {
                $data['abouts'] = $this->CoreZ_IT->get('about_us')->result(); 

            }

            $this->CoreZ_IT->_render_frontend('index', $data);
        }
        

        function details(){ 


            $id= $this->uri->segment(3);
            $where =  array(
                'about_id' =>  $id, 
            );
            $data['abouts'] = $this->CoreZ_IT->get_where('about_us', $where)->result();

            $this->CoreZ_IT->_render_frontend('index',$data);
        }
         
        
         function course(){

             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            $this->load->library('upload');
            $this->form_validation->set_rules('title', 'Title', 'required');

            if($this->form_validation->run() == true)
            {
                $url = $this->CoreZ_IT->url_check($this->input->post('title'), 'about_us');
                $values = array(
                    'about_id'        => $this->input->post('course_cat'),       
                    'title'           => $this->input->post('title'),
                    'url'             => $url,
                    'sub_title'     => $this->input->post('description')


                       
                );
                $config['upload_path']      = './uploads/slider/';
                $config['allowed_types']    = 'jpeg|png|jpg';
                $config['max_size']         = '2048';
                $config['overwrite']        = FALSE;
                $config['encrypt_name']     = TRUE;
                $this->upload->initialize($config);
                if($this->upload->do_upload('slider_image')){
                    $upload_data = $this->upload->data();
                    $values['image'] = $upload_data['file_name'];   
                    $this->CoreZ_IT->insert('about_us',$values);
                    $this->session->set_flashdata('message','package title Successfully Added.');
                    redirect('about/all', 'refresh');
                }
                
            }               
            $data['title'] = array(
                'class' => 'form-control',
                'name'  => 'title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('title'),
            );
            
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : ($this->upload->display_errors() ? $this->upload->display_errors() : $this->session->flashdata('message_error'));
            $data['page_title'] = 'Add package title';
            $this->CoreZ_IT->_render_backend('course', $data);
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
                $url = $this->CoreZ_IT->url_check($this->input->post('title'), 'course_cat');

                $values = array(
                    'title'             => $this->input->post('title'),
                    'url'               => $url,     
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
                    $this->CoreZ_IT->insert('course_cat',$values);
                    $this->session->set_flashdata('message','Gallery category Successfully Added.');
                    redirect('package/all_cat', 'refresh');
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
        
        
        

        
     


    }























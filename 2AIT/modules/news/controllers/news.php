<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CZ_Controller{
	
        function __construct()
	    {
		    parent::__construct(); 

        }

        function index(){ 
           
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Gallery';
			
			
			$id= $this->uri->segment(3);
            $where =  array(
                'news_cat_id' =>  $id, 
            );

            $data['news_cat'] = $this->CoreZ_IT->get('news_cat')->result();
            $data['news'] = $this->CoreZ_IT->get_where('news',$where)->result();
            if($id==6){$view = 'accreditation.php';}
            elseif($id==7){$view = 'devepp_partners.php';}
            elseif($id==8){$view = 'employers.php';}
            else{$view = 'index.php';}
            $this->CoreZ_IT->_render_frontend($view, $data);
        }
        
         
         function all(){ 
             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            } 
            $data['courses'] = $this->CoreZ_IT->get('news')->result();
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = $this->session->flashdata('message_error');
            $data['page_title'] = 'All gallery';
            $this->CoreZ_IT->_render_backend('all', $data);
        }
          function all_cat(){ 

            if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            } 
            $data['course_cats'] = $this->CoreZ_IT->get('news_cat')->result();
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = $this->session->flashdata('message_error');
            $data['page_title'] = 'All Category';
            $this->CoreZ_IT->_render_backend('all_cat', $data);
        }    
       
        function add(){

            if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            $this->load->library('upload');

            $data['package_title'] = $this->CoreZ_IT->get('news_title')->result(); 

            $this->form_validation->set_rules('package_id', 'Package title', 'required');
            if($this->form_validation->run() == true):

                $values = array(
                    'id' => '',
                    'package_id' => $this->input->post('package_id'),
                    'texteditor' => $this->input->post('package_description'),
                );


                    $insert_result = $this->CoreZ_IT->insert('news',$values);

                    if($insert_result):
                    // $this->session->set_userdata('message', 'Success');
                    // $this->session->set_userdata('msg_body', 'Successfull');
                      $this->session->set_flashdata('message','Package Successfully Added.');
                    else:
                        // $this->session->set_userdata('msg_title', 'Error');
                        // $this->session->set_userdata('msg_body', 'Failed');
                      $this->session->set_flashdata('message','Error.');
                    endif;

                    $data['message'] = $this->session->flashdata('message');
                   $this->CoreZ_IT->_render_backend('add',$data);
            else:
                $data['message_error'] = (validation_errors()) ? validation_errors() : ($this->upload->display_errors() ? $this->upload->display_errors() : $this->session->flashdata('message_error'));
                
                $this->CoreZ_IT->_render_backend('add' ,$data);
            endif;
            
        }


         function course(){
             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            $this->load->library('upload');
            $this->form_validation->set_rules('title', 'Title', 'required');

            if($this->form_validation->run() == true)
            {
                $url = $this->CoreZ_IT->url_check($this->input->post('title'), 'news');
                $values = array(
                    'news_cat_id'         => $this->input->post('course_cat'),
                    'title'             => $this->input->post('title'),
                    'url'               => $url,
                    'description'         => $this->input->post('description')


                       
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
                    $this->CoreZ_IT->insert('news',$values);
                    $this->session->set_flashdata('message','package title Successfully Added.');
                    redirect('news/all', 'refresh');
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
                $url = $this->CoreZ_IT->url_check($this->input->post('title'), 'news_cat');

                $values = array(
                    'title'             => $this->input->post('title'),
                    'description'             => $this->input->post('description'),
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
                    $this->CoreZ_IT->insert('news_cat',$values);
                    $this->session->set_flashdata('message','Gallery category Successfully Added.');
                    redirect('news/all_cat', 'refresh');
                }
                
            }               
            $data['title'] = array(
                'class' => 'form-control',
                'name'  => 'title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('title'),
            );

             $data['description'] = array(
                'class' => 'form-control',
                'name'  => 'description',
                'type'  => 'textarea',
                'rows'  => 8,
                'value' => $this->form_validation->set_value('description'),
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
       


          function package_details($x){

            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Gallery';
            //$data['package_titles'] = $this->CoreZ_IT->get('package_title')->result();
            $this->CoreZ_IT->_render_frontend('package_details', $data);
     

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


        function delete_cat($url = NULL){


            if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            if(empty($url)){
                redirect('package/all_cat', 'refresh');
            }
            $where = array(
                'url'   => $url
            );
           
            $this->CoreZ_IT->delete('course_cat', $where);
            $this->session->set_flashdata('message','Course category has been successfully  deleted.');
            redirect('package/all_cat', 'refresh');
            
        }




          function notice_board()
          { 
           
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Gallery';
            $data['courses'] = $this->CoreZ_IT->get('course')->result();
            $this->CoreZ_IT->_render_frontend('notice', $data);
          }
        
        
     


    }






























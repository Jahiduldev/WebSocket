<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class project extends CZ_Controller{
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
           
         
            $data['projects'] = $this->CoreZ_IT->get('project')->result();
           
             $id= $this->uri->segment(3);
            $where =  array(
                'project_id' =>  $id, 
            );
            $data['services'] = $this->CoreZ_IT->get_where('service', $where)->result();

            $this->CoreZ_IT->_render_frontend('index', $data);
        } 


      function  service(){


           $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Home';
            $data['site'] = $this->CoreZ_IT->get('site')->row();
           
         
            $data['project'] = $this->CoreZ_IT->get('project')->result();
           
           
             $id= $this->uri->segment(3);
            $where =  array(
                'project_id' =>  $id, 
            );
            $data['services'] = $this->CoreZ_IT->get_where('service', $where)->result();

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
            $data['applys'] = $this->CoreZ_IT->get('apply')->result();
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
            //$this->form_validation->set_rules('location', 'Location', 'required');
            //$this->form_validation->set_rules('des', 'Description', 'required');
            //$this->form_validation->set_rules('short_des', 'Short Description', 'required');
           
              if($this->form_validation->run() == true){
                $url = $this->CoreZ_IT->url_check($this->input->post('title'), 'service');
                $values = array(
                    'url'                       => strtolower($url),     
                    'image'                     => $this->input->post('image'),
                    'title'                     => $this->input->post('title'),
                    'project_id'                => $this->input->post('project_id'),
                    'designation'               => $this->input->post('designation'),
                    'word'               => $this->input->post('word')
                   
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
                    redirect('project/all', 'refresh');
                }
               
                $this->CoreZ_IT->insert('service',$values);
                $this->session->set_flashdata('message','service has been successfully added.');
                redirect('project/all', 'refresh');
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
           
              $data['word'] = array(
                'class' => 'form-control',
                'name'  => 'word',
                'type'  => 'textarea',
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
                redirect('about/all', 'refresh');
            }
            $where = array(
                'url'   => $url
            );
            $data['abouts'] = $this->CoreZ_IT->get_where('project', $where)->row();
            if(empty($data['abouts'])){
                $this->session->set_flashdata->message('message_error' , 'Events Not Found.');
                redirect('project/all', 'refresh');
            }
            if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            $this->form_validation->set_rules('title', 'Title', 'required');
              if($this->form_validation->run() == true){
                //$url = $this->CoreZ_IT->url_check($this->input->post('title'), 'event');
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
                    //$this->CoreZ_IT->update('event',$values,$where);
                    $this->session->set_flashdata('message','Staffs Successfully Added.');
                }
                $this->CoreZ_IT->update('event',$values,$where);
                $this->session->set_flashdata('message','About page has been successfully updated.');
                $data['message'] = $this->session->flashdata('message');
                $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
                redirect('about/all', 'refresh');
            }
            $data['title'] = array(
                'class' => 'form-control',
                'name'  => 'title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('title',$data['abouts']->title)
            );
            $data['designation'] = array(
                'class' => 'form-control',
                'name'  => 'designation',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('title',$data['abouts']->title)
            );
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Edit about';
            $this->CoreZ_IT->_render_backend('edit', $data);
        }
          function delete($id = NULL){
             if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
            }
            if(empty($id)){
                redirect('apply/all', 'refresh');
            }
            $where = array(
                'id'   => $id
            );
            $this->CoreZ_IT->delete('apply', $where);
            $this->session->set_flashdata('message','Service  Successfully  deleted.');
            redirect('project/all', 'refresh');
        }
        
        
        function our_storey(){
            if(!$this->ion_auth->logged_in())
            {
                    //redirect them to the login page
                    redirect('user/login', 'refresh');
            }
           $this->form_validation->set_rules('description', 'History Footer', '');
            $site = $this->CoreZ_IT->get('site')->row();
            if ($this->form_validation->run() == true)
            {
                $values = array(
                    'our_storey'   => $this->input->post('our_history'),
                    'our_team'   => $this->input->post('our_team')
                );
                $where['id'] = 1;
                $this->CoreZ_IT->update('site',$values,$where);
                $this->session->set_flashdata('message','About page has  has been updated.');
                redirect('about/edit', 'refresh');
            }
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'About Us';
            $this->CoreZ_IT->_render_backend('our_storey', $data);
        }
   
       
        
        
        //$delete_id=$_GET['del'];
	
	//$querry1="select * from table_name where id='$delete_id'";
	//$run=mysql_query($querry1);
	//while($row=mysql_fetch_array($run))
	//{
	//	$del_image=$row['image'];
	//	unlink("img/$del_image");
	//}
        
        
        
        
}

        
        
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

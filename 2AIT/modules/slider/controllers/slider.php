<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slider extends CZ_Controller{
    /**
         * 
         * @copyright   Copyright (c) 2016 CoreZ IT.
         * @author      Tanveer Agmed Ivan
         * @version     1.0.1
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
        function all(){  
            $data['sliders'] = $this->CoreZ_IT->get('slider')->result();
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = $this->session->flashdata('message_error');
            $data['page_title'] = 'All Slider';
            $this->CoreZ_IT->_render_backend('all', $data);
        }      
        function add(){
            $this->load->library('upload');
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('subtitle', 'Sub Title', '');
            if($this->form_validation->run() == true)
            {
                $url = $this->CoreZ_IT->url_check($this->input->post('title'), 'slider');
                $values = array(
                    'title'             => $this->input->post('title'),
                    'url'               => $url,
                    'sub_title'         => $this->input->post('subtitle')
                       
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
                    $this->CoreZ_IT->insert('slider',$values);


                    $configrez2['source_image'] = './uploads/slider/'.$upload_data['file_name'];
                    $configrez2['new_image'] = './uploads/slider/'.$upload_data['file_name'];
                    $configrez2['maintain_ratio'] = FALSE;
                    $configrez2['width'] = "1600";
                    $configrez2['height'] = "800";

                    $this->image_lib->initialize($configrez2);
                    $this->image_lib->resize();

                    $this->session->set_flashdata('message','Slider Successfully Added.');
                    redirect('slider/all', 'refresh');
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
            $data['page_title'] = 'Add Slider';
            $this->CoreZ_IT->_render_backend('add', $data);
        }
        function edit($url = NULL){
            if(empty($url)){
                $this->session->set_flashdata('message','slider not found.');
                redirect('slider/all', 'refresh');
            }
            $where = array(
                'url'   => $url
            );
            $data['slider'] = $this->CoreZ_IT->get_where('slider', $where)->row();
            if(empty($data['slider'])){
                $this->set_flashdata->message('message_error' , 'Slider Not Found.');
                redirect('slider/all', 'refresh');
            }
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('subtitle', 'Sub Title', '');
            if($this->form_validation->run() == true)
            {
                $values = array(
                    'title'             => $this->input->post('title'),
                    'sub_title'         => $this->input->post('subtitle')
                       
                );
                $config['upload_path']      = './uploads/slider/';
                $config['allowed_types']    = 'jpg|png';
                $config['max_size']         = '2048';
                $config['overwrite']        = FALSE;
                $config['encrypt_name']     = TRUE;
                $this->load->library('upload', $config);
                if($this->upload->do_upload('image')){
                    $upload_data = $this->upload->data();
                    $values['image'] = $upload_data['file_name'];
                    
                }
                $this->CoreZ_IT->update('slider',$values, $where);
                if ($this->upload->data()) {
                    # code...
                
                    $configrez2['source_image'] = './uploads/slider/'.$upload_data['file_name'];
                    $configrez2['new_image'] = './uploads/slider/'.$upload_data['file_name'];
                    $configrez2['maintain_ratio'] = FALSE;
                    $configrez2['width'] = "100";
                    $configrez2['height'] = "100";

                    $this->image_lib->initialize($configrez2);
                    $this->image_lib->resize();    
                  }
                $this->session->set_flashdata('message','Slider Successfully edited.');
                redirect('slider/all', 'refresh');
            }               
            $data['title'] = array(
                'class' => 'form-control',
                'name'  => 'title',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('title', $data['slider']->title),
            );
            $data['subtitle'] = array(
                'class' => 'form-control',
                'name'  => 'subtitle',
                'type'  => 'text',
                'value' => $this->form_validation->set_value('subtitle', $data['slider']->sub_title),
            );
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Edit Slider';
            $this->CoreZ_IT->_render_backend('edit', $data);
        }
        
         function delete($url = NULL){
            if(empty($url)){
                redirect('slider/all', 'refresh');
            }
            $where = array(
                'url'   => $url
            );
            $data= $this->CoreZ_IT->get_where('slider',$where)->result();
            foreach($data as $delete){
               $del_image = $delete->image;
            }
           if(file_exists($del_image)){ unlink("/uploads/slider/$del_image"); }
            $this->CoreZ_IT->delete('slider', $where);
            $this->session->set_flashdata('message','slider has been successfully  deleted.');
            redirect('slider/all', 'refresh');
            
        }
        
        
        
    //$delete_id=$_GET['del'];
    
    //$querry1="select * from table_name where id='$delete_id'";
    //$run=mysql_query($querry1);
    //while($row=mysql_fetch_array($run))
    //{
    //  $del_image=$row['image'];
    //  unlink("img/$del_image");
    //}
        
        
        
        
}











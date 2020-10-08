<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gall extends CZ_Controller
{
	
        function __construct()
	    {
		      parent::__construct();
        }


        function index()
        { 
           
            $data['message'] = $this->session->flashdata('message');
            $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
            $data['page_title'] = 'Gallery';
			
			
			$id= $this->uri->segment(3);
            $where =  array(
                'gal_cat_id' =>  $id, 
            );
			
            $data['gallerys'] = $this->CoreZ_IT->get_where('gallery',$where)->result();
            $data['gallery_cats'] = $this->CoreZ_IT->get('gallery_cat')->result();
            $data['logos'] = $this->CoreZ_IT->get('logo')->result();
            $this->CoreZ_IT->_render_frontend('index', $data);
        }


    }

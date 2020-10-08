<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package_details extends CZ_Controller{
	
        function __construct()
	    {
		    parent::__construct(); 
            $this->load->helper('url');


        }


        function details(){ 
            $id= $this->uri->segment(3);
            $where =  array(
                'package_id' =>  $id, 
            );
            $data['package_titles'] = $this->CoreZ_IT->get_where('package', $where)->result();

            $this->CoreZ_IT->_render_frontend('index',$data);
        }
        
         
        

    }























<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CZ_Controller{
    
        /**
         * 
         * @copyright	Copyright (c) 2015 CoreZ IT.
         * @author      Tanveer Agmed Ivan
         * @version 	1.0.1
         * 
	 */
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}
        function index(){
            redirect('user/all', 'refresh');
        }
	// redirect if needed, otherwise display the user list
	function all($ofset = NULL)
	{

		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('user/login', 'refresh');
		}
		elseif (!$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
		else
		{
			// set the flash data error message if there is one
			$data['message'] = $this->session->flashdata('message');
                        $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
			
			//list the users
			$data['users'] = $this->ion_auth->users()->result();
                        
                        
                        
			foreach ($data['users'] as $k => $user)
			{
				$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
			}
                        $data['page_title'] = 'All Users';
			$this->CoreZ_IT->_render_backend('all', $data);
		}
	}

	// log the user in
	function login()
	{
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('/dashboard', 'refresh');
			}
			else
			{
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message_error', $this->ion_auth->errors());
				redirect('user/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$data['message'] = $this->session->flashdata('message');
                        $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
			
			$data['identity'] = array('name' => 'identity',
                                'class'         => 'form-control form-control-solid placeholder-no-fix',
                                'autocomplete'  => 'off',
				'type'          => 'text',
                                'placeholder'   => 'Username',
				'value'         => $this->form_validation->set_value('identity'),
			);
			$data['password'] = array('name' => 'password',
                                'class'         => 'form-control form-control-solid placeholder-no-fix',
                                'placeholder'   => 'Password',
				'type'          => 'password',
			);
                        $data['page_title'] = "Login";
                        $data['site'] = $this->CoreZ_IT->get('site')->row();
			$this->load->view('login', $data);
		}
	}

	// log the user out
	function logout()
	{
		$data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('user/login', 'refresh');
	}

	// change password
	function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('user/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			// display the form
			// set the flash data error message if there is one
			
			$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$data['old_password'] = array(
				'name' => 'old',
				'class' => 'form-control',
				'type' => 'password',
			);
			$data['new_password'] = array(
				'name'    => 'new',
				'class' => 'form-control',
				'type'    => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
			);
			$data['new_password_confirm'] = array(
				'name'    => 'new_confirm',
				'class' => 'form-control',
				'type'    => 'password',
				'pattern' => '^.{'.$data['min_password_length'].'}.*$',
			);
			$data['user_id'] = array(
				'name'  => 'user_id',
				'class' => 'form-control',
				'type'  => 'hidden',
				'value' => $user->id,
			);
                        $data['message'] = $this->session->flashdata('message');
                        $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
			$data['page_title'] = 'Login';
			// render
			$this->CoreZ_IT->_render_backend('change_password', $data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message_error', $this->ion_auth->errors());
				redirect('user/change_password', 'refresh');
			}
		}
	}

	// forgot password
	function forgot_password()
	{
		// setting validation rules by checking wheather identity is username or email
		if($this->config->item('identity', 'ion_auth') != 'email' )
		{
		   $this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		}
		else
		{
		   $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() == false)
		{
			// setup the input
			$data['email'] = array('name' => 'email',
				'id' => 'email',
			);

			if ( $this->config->item('identity', 'ion_auth') != 'email' ){
				$data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			}
			else
			{
				$data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}
                        $data['identity'] = array('name' => 'identity',
                                'class'         => 'form-control form-control-solid placeholder-no-fix',
                                'autocomplete'  => 'off',
				'type'          => 'text',
                                'placeholder'   => 'Username',
				'value'         => $this->form_validation->set_value('identity'),
			);
			$data['password'] = array('name' => 'password',
                                'class'         => 'form-control form-control-solid placeholder-no-fix',
                                'placeholder'   => 'Password',
				'type'          => 'password',
			);

			// set any errors and display the form
			$data['message'] = $this->session->flashdata('message');
                        $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
			$data['page_title'] = 'Forget Password';
                        $this->session->set_flashdata('message_error', $data['message']);
		}
		else
		{
			$identity_column = $this->config->item('identity','ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('email'))->users()->row();

			if(empty($identity)) {

	            		if($this->config->item('identity', 'ion_auth') != 'email')
		            	{
		            		$this->ion_auth->set_error('forgot_password_identity_not_found');
		            	}
		            	else
		            	{
		            	   $this->ion_auth->set_error('forgot_password_email_not_found');
		            	}

		                $this->session->set_flashdata('message', $this->ion_auth->errors());
                		redirect("user/forgot_password", 'refresh');
            		}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten){
                            //if there were no errors
                            $this->session->set_flashdata('message', $this->ion_auth->messages());
                        }else{
                                $this->session->set_flashdata('message_error', $this->ion_auth->errors());
                        }

                }
                redirect("user/login", 'refresh');
	}

	// reset password - final step for forgotten password
	public function reset_password($code = NULL)
	{
		if (!$code)
		{
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user)
		{
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() == false)
			{
				// display the form

				// set the flash data error message if there is one
                                $data['message'] = $this->session->flashdata('message');
                                $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
                                $data['page_title'] = 'Reset Password';
				$data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$data['new_password'] = array(
					'name'          => 'new',
					'class'         => 'form-control',
					'type'          => 'password',
                                        'placeholder'   => 'New Password',
					'pattern'       => '^.{'.$data['min_password_length'].'}.*$',
				);
				$data['new_password_confirm'] = array(
					'name'          => 'new_confirm',
					'class'         => 'form-control',
					'type'          => 'password',
                                        'placeholder'   => 'Re-Type Password',
					'pattern'       => '^.{'.$data['min_password_length'].'}.*$',
				);
				$data['username'] = array(
					'name'  => 'username',
					'class' => 'form-control',
					'type'  => 'hidden',
					'value' => $user->username,
				);
				$data['csrf'] = $this->_get_csrf_nonce();
				$data['code'] = $code;
                                $data['site'] = $this->CoreZ_IT->get('site')->row();
				// render
				$this->load->view('reset_password', $data);
			}
			else
			{
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->username != $this->input->post('username'))
				{

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));

				}
				else
				{
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change)
					{
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("user/login", 'refresh');
					}
					else
					{
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('user/reset_password/' . $code, 'refresh');
					}
				}
			}
		}
		else
		{
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message_error', $this->ion_auth->errors());
			redirect("user/login", 'refresh');
		}
	}


	// activate the user
	function activate($username, $code=false)
	{       
                $user = $this->CoreZ_IT->get_where('users',array('username' => $username))->row();
		if ($code !== false)
		{
			$activation = $this->ion_auth->activate($user->id, $code);
		}
		else if ($this->ion_auth->is_admin())
		{
			$activation = $this->ion_auth->activate($user->id);
		}

		if ($activation)
		{
			// redirect them to the auth page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("user/all", 'refresh');
		}
		else
		{
			// redirect them to the forgot password page
			$this->session->set_flashdata('message_error', $this->ion_auth->errors());
			redirect("user/forgot_password", 'refresh');
		}
	}

	// deactivate the user
	function deactivate($username = NULL)
	{
		if(!$this->ion_auth->logged_in()){
                    redirect('user/login', 'refresh');
                }
		if (!$this->ion_auth->is_admin())
		{
			//redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}
                $user = $this->CoreZ_IT->get_where('users',array('username' => $username))->row();
                if(!empty($user)){
                    
                    $this->ion_auth->deactivate($user->id);
                }
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->session->set_flashdata('message_error', $this->ion_auth->errors());
                redirect('user/all', 'refresh');
	}

        // create a new user
        function create()
        {
            $data['title'] = "Create User";

            if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
            {
                redirect('user/all', 'refresh');
            }

            $tables = $this->config->item('tables','ion_auth');
            $identity_column = $this->config->item('identity','ion_auth');
            $data['identity_column'] = $identity_column;

            // validate form input
            $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
            $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
            if($identity_column!=='email')
            {
                $this->form_validation->set_rules('identity',$this->lang->line('create_user_validation_identity_label'),'required|is_unique['.$tables['users'].'.'.$identity_column.']');
                $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email');
            }
            else
            {
                $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
            }
            $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'trim');
            $this->form_validation->set_rules('designation', 'Designation', 'trim');
            $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
            $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

            if ($this->form_validation->run() == true)
            {
                $email    = strtolower($this->input->post('email'));
                $identity = ($identity_column==='email') ? $email : $this->input->post('identity');
                $password = $this->input->post('password');

                $additional_data = array(
                    'first_name'    => $this->input->post('first_name'),
                    'last_name'     => $this->input->post('last_name'),
                    'designation'   => $this->input->post('designation'),
                    'phone'         => $this->input->post('phone'),
                    'username'      => $this->check_username($this->input->post('first_name').$this->input->post('last_name'))
                );
            }
            if ($this->form_validation->run() == true && $this->ion_auth->register($identity, $password, $email, $additional_data))
            {
                // check to see if we are creating the user
                // redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("user/all", 'refresh');
            }
            else
            {
                // display the create user form
                // set the flash data error message if there is one
                $data['message'] = $this->session->flashdata('message');
                $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');

                $data['first_name'] = array(
                    'class' => 'form-control',
                    'name'  => 'first_name',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('first_name'),
                );
                $data['last_name'] = array(
                    'class' => 'form-control',
                    'name'  => 'last_name',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('last_name'),
                );
                $data['identity'] = array(
                    'class' => 'form-control',
                    'name'  => 'identity',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('identity'),
                );
                $data['email'] = array(
                    'class' => 'form-control',
                    'name'  => 'email',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('email'),
                );
                $data['designation'] = array(
                    'class' => 'form-control',
                    'name'  => 'designation',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('designation'),
                );
                $data['phone'] = array(
                    'class' => 'form-control',
                    'name'  => 'phone',
                    'type'  => 'text',
                    'value' => $this->form_validation->set_value('phone'),
                );
                $data['password'] = array(
                    'name'  => 'password',
                    'class' => 'form-control',
                    'type'  => 'password',
                    'value' => $this->form_validation->set_value('password'),
                );
                $data['password_confirm'] = array(
                    'name'  => 'password_confirm',
                    'class' => 'form-control',
                    'type'  => 'password',
                    'value' => $this->form_validation->set_value('password_confirm'),
                );
                
                $data['page_title'] = 'Create User';
                $this->CoreZ_IT->_render_backend('create', $data);
            }
        }

	// edit a user
	function edit($username)
	{
		$data['title'] = "Edit User";

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->username == $username)))
		{
			redirect('user/all', 'refresh');
		}

		$user = $this->CoreZ_IT->get_where('users',array('username' => $username))->row();
		$groups=$this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($user->id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
		$this->form_validation->set_rules('designation', 'Designation', 'required');

		if (isset($_POST) && !empty($_POST))
		{
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $username != $this->input->post('username'))
			{
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('password'))
			{
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE)
			{
				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name'  => $this->input->post('last_name'),
					'designation'    => $this->input->post('designation'),
					'phone'      => $this->input->post('phone'),
				);

				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$data['password'] = $this->input->post('password');
				}



				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin())
				{
					//Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $user->id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $user->id);
						}

					}
				}

			// check to see if we are updating the user
			   if($this->ion_auth->update($user->id, $data))
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->messages() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('user/all', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }
			    else
			    {
			    	// redirect them back to the admin page if admin, or to the base url if non admin
				    $this->session->set_flashdata('message', $this->ion_auth->errors() );
				    if ($this->ion_auth->is_admin())
					{
						redirect('user/all', 'refresh');
					}
					else
					{
						redirect('/', 'refresh');
					}

			    }

			}
		}

		// display the edit user form
		$data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$data['message'] = $this->session->flashdata('message');
                $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
		
		// pass the user to the view
		$data['edit_user'] = $user;
		$data['groups'] = $groups;
		$data['currentGroups'] = $currentGroups;

		$data['first_name'] = array(
                        'class' => 'form-control',
			'name'  => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		);
		$data['last_name'] = array(
			'name'  => 'last_name',
                        'class' => 'form-control',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		);
		$data['designation'] = array(
                        'class' => 'form-control',
			'name'  => 'designation',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('designation', $user->designation),
		);
		$data['phone'] = array(
                        'class' => 'form-control',
			'name'  => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		);
		$data['password'] = array(
                        'class' => 'form-control',
			'name' => 'password',
			'type' => 'password'
		);
		$data['password_confirm'] = array(
                        'class' => 'form-control',
			'name' => 'password_confirm',
			'type' => 'password'
		);
                $data['page_title'] = 'Edit User';
		$this->CoreZ_IT->_render_backend('edit', $data);
	}

	// create a new group
	function create_group()
	{
		$data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('user/all', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

		if ($this->form_validation->run() == TRUE)
		{
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if($new_group_id)
			{
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("user/all", 'refresh');
			}
		}
		else
		{
			// display the create group form
			// set the flash data error message if there is one
			$data['message'] = $this->session->flashdata('message');
                        $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
		
			$data['group_name'] = array(
				'name'  => 'group_name',
                                'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$data['description'] = array(
				'name'  => 'description',
				'class' => 'form-control',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);
                        $data['page_title'] = 'Create Group';
			$this->CoreZ_IT->_render_backend('create_group', $data);
		}
	}

	// edit a group
	function edit_group($id)
	{
		// bail if no group id given
		if(!$id || empty($id))
		{
			redirect('user/all', 'refresh');
		}

		$data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
		{
			redirect('user/all', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST))
		{
			if ($this->form_validation->run() === TRUE)
			{
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if($group_update)
				{
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				}
				else
				{
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("user/all", 'refresh');
			}
		}

		// set the flash data error message if there is one
		$data['message'] = $this->session->flashdata('message');
                $data['message_error'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message_error');
		
		// pass the user to the view
		$data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$data['group_name'] = array(
			'name'    => 'group_name',
			'class' => 'form-control',
			'type'    => 'text',
			'value'   => $this->form_validation->set_value('group_name', $group->name),
			$readonly => $readonly,
		);
		$data['group_description'] = array(
			'name'  => 'group_description',
			'class' => 'form-control',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);
                $data['page_title'] = 'Edit Group';
                $this->CoreZ_IT->_render_backend('edit_group', $data);
	}


	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function change_avatar(){
            if (!$this->ion_auth->logged_in())
            {
                    //redirect them to the login page
                    redirect('user/login', 'refresh');
            }
            $this->form_validation->set_rules('submit', 'Submit', 'required');
            if($this->form_validation->run() == true){  
                
                $config['upload_path']      = './uploads/users/';
                $config['allowed_types']    = 'jpg|png';
                $config['max_size']         = '1024';
                $config['overwrite']        = FALSE;
                $config['encrypt_name']     = TRUE;
                $this->load->library('upload', $config);
                
                if ($this->upload->do_upload()){
                    
                    $user = $this->ion_auth->user()->row();
                    
                    $path_to_file = 'uploads/users/'.$user->avatar;
                    
                    $upload_data = $this->upload->data();
                    $values['avatar'] = $upload_data['file_name'];
                    $where['id'] = $user->id;
                    $this->CoreZ_IT->update('users',$values,$where);
                    
                    if(!empty($user->avatar) && file_exists($path_to_file))unlink($path_to_file);
                    
                    $this->session->set_flashdata('message','Your file was successfully uploaded!');
                    redirect('user/change_avatar', 'refresh');
                        
                }else{
                    $this->session->set_flashdata('message_error',$this->upload->display_errors());
                    redirect('user/change_avatar', 'refresh');
                }
            }
            $data['message'] =  $this->session->flashdata('message');
            $data['message_error'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message_error'));  
            $data['page_title'] = 'Change Avatar';
            $this->CoreZ_IT->_render_backend('change_avatar', $data);
            
        }
        private function check_username($username){
            $username = $this->CoreZ_IT->getUrlFriendlyString($username);
            $original_url = $username;
            for($i = 1; $this->db->where('username', $username)->count_all_results('users') > 0; $i++)$username = $original_url.'-'. $i;
            return $username;
        }
}

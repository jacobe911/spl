<?php
class Profile extends Auth_Controller {

		public function __construct()
        {
            parent::__construct();

        }

        public function index()
        {
			
        	$data['user_data'] = $this->current_user;	

			$this->load->view($this->template.'header');
			$this->load->view('profile/index',$data);
			$this->load->view('public_footer');
			
        }

        public function edit($username) 
        {

			$this->load->library(array('form_validation'));
			$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
			
			if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->username == $username)))
			{
				redirect('','refresh');
			}
			
			// validate form input
			$this->form_validation->set_rules('screen_name', 'Screen Name', 'required');
			$this->form_validation->set_rules('first_name', 'First Name', 'required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'required');
			$this->form_validation->set_rules('email', 'Email Address', 'required');
			
			if (isset($_POST) && !empty($_POST))
			{
				
				// update the password if it was posted
				if ($this->input->post('password'))
				{
					$this->form_validation->set_rules('password', 'password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
					$this->form_validation->set_rules('password_confirm', 'confirm password', 'required');
				}

				if ($this->form_validation->run() === TRUE)
				{
					$data = array(
						'screen_name' => $this->input->post('screen_name'),
						'first_name' => $this->input->post('first_name'),
						'last_name'  => $this->input->post('last_name'),
						'email'  => $this->input->post('email'),
					);

					// update the password if it was posted
					if ($this->input->post('password'))
					{
						$data['password'] = $this->input->post('password');
					}
					
					if($this->ion_auth->update($this->current_user->id, $data))
					{
						// redirect them back to the profile page
						$this->session->set_flashdata('message', $this->ion_auth->messages() );
						redirect('profile', 'refresh');
					}
					else
					{
						// show errors
						$this->session->set_flashdata('message', $this->ion_auth->errors() );
						if ($this->ion_auth->is_admin());
						//redirect('profile/edit/'.$this->current_user->username, 'refresh');
					}
					
				}
				
			}
			
			// display the edit user form

			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			// pass the user to the view
			$this->data['user'] = $this->current_user;

			$this->data['screen_name'] = array(
				'name'  => 'screen_name',
				'id'    => 'screen_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('first_name', $this->current_user->screen_name),
			);
			$this->data['first_name'] = array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('first_name', $this->current_user->first_name),
			);
			$this->data['last_name'] = array(
				'name'  => 'last_name',
				'id'    => 'last_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('last_name', $this->current_user->last_name),
			);
			$this->data['email'] = array(
				'name'  => 'email',
				'id'    => 'email',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('email', $this->current_user->email),
			);
			$this->data['password'] = array(
				'name' => 'password',
				'id'   => 'password',
				'type' => 'password'
			);
			$this->data['password_confirm'] = array(
				'name' => 'password_confirm',
				'id'   => 'password_confirm',
				'type' => 'password'
			);
		
        	$this->load->view($this->template.'header');
			$this->load->view('profile/edit',$this->data);
			$this->load->view('public_footer');

        }
		
}


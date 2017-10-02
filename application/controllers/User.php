<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    function __construct()
    {
        parent::__construct();
    }

    public function login()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
		$redirecturl = $this->input->post('redirecturl');
        if ($this->form_validation->run() === FALSE)
        {
            $this->load->helper('form');
            $this->redict($redirecturl);
        }
        else
        {
            $remember = (bool) $this->input->post('remember');
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if ($this->ion_auth->login($username, $password, $remember))
            {
                $this->load->library('rat');
                $this->rat->log('User logged in',1);
                redirect($redirecturl);
            }
            else
            {
                $_SESSION['auth_message'] = $this->ion_auth->errors();
                $this->session->mark_as_flash('auth_message');
                redirect($redirecturl);
            }
        }
    }

    /* public function forgot()
    {
        $this->data['title'] = "Forgot email";
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        if($this->form_validation->run() === FALSE)
        {
            $this->render('user/forgot_view');
        }
        else
        {
            $username = $this->input->post('username');

            if($this->ion_auth->forgotten_password($username))
            {
                $_SESSION['auth_message'] = 'A reset link has been sent to your email';
            }
            else
            {
                $_SESSION['auth_message'] = $this->ion_auth->errors();
            }
            $this->session->mark_as_flash('auth_message');
            redirect('user/login');
        }
    } */

    public function logout()
    {
        $this->load->library('rat');
        $this->rat->log('User logged out',2);
        $this->ion_auth->logout();
        redirect();
    }
}
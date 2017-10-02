<?php
class Contact extends CI_Controller {

		public function __construct()
        {
            parent::__construct();
            $this->load->model('results_model');
        }

        public function send_message()
        {

            if($_POST) {

                $username = $this->input->post('username');
                $message = $this->input->post('message');
                $redirect_url = $this->input->post('redirect_url');

                if($this->results_model->check_user($username)) {

                    $this->results_model->new_message($username,$message);

                    $this->load->library('rat');
                    $this->rat->log('New Message',3);

                    $this->session->set_flashdata('message_success','Thank you for the Message, we will attend to it as soon as we can.');
                
                } else {
                
                    $this->session->set_flashdata('message_error', 'An error occured and your message wasn\'t sent, please try again.');
                
                }

                redirect($redirect_url,'refresh');
            }
			
        }
}
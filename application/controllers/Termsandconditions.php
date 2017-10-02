<?php
class Termsandconditions extends MY_Controller {

		public function __construct()
        {
            parent::__construct();
            $this->load->model('results_model');
        }

        public function index()
        {
			
        	$data['page_content'] = $this->results_model->get_page_info('tsandcs');

			$this->load->view($this->template.'header');
			$this->load->view('termsandconditions', $data);
			$this->load->view('public_footer');
			
        }
}
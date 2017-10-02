<?php
class About extends MY_Controller {

		public function __construct()
        {
            parent::__construct();
            $this->load->model('results_model');
        }

        public function index()
        {

            $data['page_content'] = $this->results_model->get_page_info('about');

			$this->load->view($this->template.'header');
			$this->load->view('about', $data);
			$this->load->view('public_footer');
			
        }
}
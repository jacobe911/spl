<?php
class Home extends MY_Controller {

		public function __construct()
        {
            parent::__construct();
			$this->load->model('results_model');
        }

        public function index()
        {
			
			$data['results'] = $this->results_model->get_recent_results();
			
			$this->load->view($this->template.'header');
			$this->load->view('home',$data);
			$this->load->view('public_footer');
			
        }
		
}
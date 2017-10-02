<?php
class Standings extends MY_Controller {

		public function __construct()
        {
            parent::__construct();
            $this->load->model('results_model');
            
        }

        public function index()
        {

			$data['standings'] = $this->results_model->get_standings();

            $this->load->view($this->template.'header');
			$this->load->view('standings',$data);
			$this->load->view('public_footer');
			
        }
}
<?php
class Predictions extends Auth_Controller {

		public function __construct()
        {
            parent::__construct();
            $this->load->model('results_model');

        }

        public function index()
        {
			
        	$data['results'] = $this->results_model->get_results();
        	$data['predictions'] = $this->results_model->get_predictions($this->current_user->username);	

			$this->load->view($this->template.'header');
			$this->load->view('predictions',$data);
			$this->load->view('public_footer');
			
        }

        public function update_predictions() 
        {

        	if($this->input->post('ajax')) {

        		$matchscore = $this->input->post('matchscore');
				$newscore = $this->input->post('newscore');
				$username = $this->current_user->username;

				if($this->results_model->update_score($matchscore,$newscore,$username)) 
				{

					echo "1";
				
				} 

        	}

        }
		
}
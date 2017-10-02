<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Results_model extends CI_Model {

	public function __construct()
	
        {
			
            parent::__construct();
			$this->load->database();
			
        }

        public function get_results()
		
        {
			
			return $this->db->query('SELECT * FROM results ORDER BY kick_off ASC');
						
        }

        public function get_recent_results()
		
        {
			
			return $this->db->query('SELECT * FROM results WHERE hometeamscore IS NOT NULL ORDER BY kick_off DESC');
						
        }

        public function get_predictions($username) 
        {

        	$query = $this->db->query("SELECT * FROM predictions WHERE username = '".$username."'");
        	return $query->row_array();

        }

        public function update_score($matchscore,$newscore,$username) {

        	$this->db->query("UPDATE predictions SET ".$matchscore." = ".$newscore." WHERE username = '".$username."'");
        	return $this->db->affected_rows();

        }

        public function get_standings() {

        	return $this->db->query('SELECT users.username, users.screen_name, total_points.total_points FROM users JOIN total_points ON users.username=total_points.username ORDER BY total_points DESC');

        }

        // these should be moved to a user_model

        public function new_message($username,$message) {

        	return $this->db->query("INSERT INTO contact_messages (username, message) VALUES ('".$username."','".$message."')");

        }

        public function check_user ($username) {

        	$this->db->query("SELECT * FROM users WHERE username = '".$username."'");

        	return $this->db->affected_rows();

        }
		
		public function new_account($username) {
			
			$this->db->query("INSERT INTO predictions (username) VALUES ('".$username."')");
			$this->db->query("INSERT INTO individual_points (username) VALUES ('".$username."')");
			$this->db->query("INSERT INTO total_points (username) VALUES ('".$username."')");
			
		}

        // this should be moved to a general site_model

        public function get_page_info($page) {

            $query = $this->db->query("SELECT `info` FROM `information_pages` WHERE `page` = '".$page."'");
            return $query->row_array();

        }
}

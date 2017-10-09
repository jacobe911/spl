<?php
class Updateresultscronscript extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->database();
    }

    public function index()
    {
		
    	//get the spl fixturesand results from footballwebpages API in json format and convert to associative array

		$results = json_decode(file_get_contents('https://www.footballwebpages.co.uk/fixtures-results.json?comp=17'),true);
		
		//go deeper into the results array to make it easier to work with

		$matchresults = $results['matchesCompetition']['match'];
		
		//count the number of matches to loop through

		$x = count($matchresults);
		
		//delete all data from table if data was returned from the API

		if ($x > 0) {

			$this->db->empty_table('results');
		
		}

		$i = 0;
		
		while($i < $x){
			
			//if the match hasn't been played, set the scores to NULL

			if (!array_key_exists('homeTeamScore', $matchresults[$i])) {
				$matchresults[$i]['homeTeamScore'] = NULL;
				$matchresults[$i]['awayTeamScore'] = NULL;
			};
			
			//change the kick off time to a unix timestamp

			$timestamp = $matchresults[$i]['date'];
			$timestamp .= ' ';
			$timestamp .= $matchresults[$i]['time'];				
		
			//assign data to be inseted into database

			$data = array(
			
				'match_id' => $matchresults[$i]['id'],
				'kick_off' => strtotime($timestamp),
				'status' => $matchresults[$i]['status'],
				'hometeam' => $matchresults[$i]['homeTeamName'],
				'hometeamscore' => $matchresults[$i]['homeTeamScore'],
				'awayteam' => $matchresults[$i]['awayTeamName'],
				'awayteamscore' => $matchresults[$i]['awayTeamScore'],
			
			);
			
			//insert each fixture/results into the table

			$this->db->insert('results', $data);

			//add columns to the points and predictions table for new fixtures

			if( ! $this->db->simple_query("SELECT `mi".$matchresults[$i]['id']."` FROM individual_points")) {

				$this->db->query("ALTER TABLE `predictions` ADD COLUMN `".$matchresults[$i]['id']."h` INT DEFAULT NULL, ADD COLUMN `".$matchresults[$i]['id']."a` INT DEFAULT NULL");

				$this->db->query("ALTER TABLE `individual_points` ADD COLUMN `mi".$matchresults[$i]['id']."` INT(2) DEFAULT NULL");

			}
			
			$i++;
		}

		redirect('updateresultscronscript/update_points');

    }

    public function update_points() 
    {

    	//loop through each row in the results table
    	//I should change this to get results where score != NULL

    	$results = $this->db->get('results');

    	foreach ($results->result() as $row) {

    		//get every users predictions and loop through them and compare to the actual results to calculate the points

        	if($predictions = $this->db->query("SELECT username, `".$row->match_id."h`, `".$row->match_id."a` FROM predictions")) {

        		foreach ($predictions->result() as $predict) {

		        	$awayid = $row->match_id.'a';
		        	$homeid = $row->match_id.'h';

		        	//change objects to integer variables so comparison can be done

        			$homeresult = intval($row->hometeamscore);
        			$awayresult = intval($row->awayteamscore);
        			$homeguess = intval($predict->$homeid);
        			$awayguess = intval($predict->$awayid);

        			$points = 0;

        			//calculate each users points for each match

        			if(($row->hometeamscore !== null) && ($predict->$homeid !== null)) {

	        			if (($homeresult > $awayresult) && ($homeguess > $awayguess)) {

	        				$points = 1;

	        			} elseif (($homeresult < $awayresult) && ($homeguess < $awayguess)) {

	        				$points = 2;

	        			} elseif (($homeresult == $awayresult) && ($homeguess == $awayguess)) {

	        				$points = 3;

	        			} else {

	        				$points = 0;

	        			}

	        			if (($homeresult == $homeguess) && ($awayresult == $awayguess)) {

	        				$points += 5;

	        			}
	        		}

	        		//uppdate the points for each match for each user into the individual points table

        			$this->db->query("UPDATE individual_points SET `mi".$row->match_id."` = ".$points." WHERE username = '".$predict->username."'");

        		}
        	}
        }

        redirect('updateresultscronscript/total_points');

    }

    public function total_points() 
    {

    	$points = $this->db->query("SELECT * FROM individual_points");

    	//get each users individual points for each match and loop through them and add up the total

    	foreach ($points->result() as $row) {

    		$total_points = 0;

    		foreach ($row as $key => $value) {

    			$total_points += $value;

    		}

    		//update each users total points in the database

    		$this->db->query("UPDATE total_points SET `total_points` = ".$total_points." WHERE username = '".$row->username."'");

    	}

    	redirect('');

    }
    
}


/*

Add new column to results table 'in_API' make it boolean

change empty table to set 'in_API' to FALSE

loop through each JSON object and check if the match_id is in the results table.

if it is then update the scores in the results table from the JSON, set 'in_API' to true.

else if match_id not found in table then insert it into the table, set 'in_API' to true.

change the home/recent results view to only display rows where 'in_API' is true.

create a linking table beteeen match_id and game_week, create a view in the admin dash to manually edit this.

*/



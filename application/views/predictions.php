
<div class='container'>

<h1 class="infobox">Predictions</h1>

<table>

	<tr>
		<th>Date</th>
		<th>Home Team</th>
		<th>Home Score</th>
		<th>Away Score</th>
		<th>Away Team</th>
	</tr>
	
	<?php foreach ($results->result() as $row) { 
	
		$homeid = $row->match_id.'h';
		$awayid = $row->match_id.'a'; ?>

		<tr>
			<td><?php echo date('d/m/y', $row->kick_off); ?></td>
			<td><?php echo $row->hometeam; ?></td>
			<td><input type="text" class="form-control guessinput" name="<?php echo $homeid; ?>" value="<?php echo $predictions[$homeid]; ?>" <?php if(time() > $row->kick_off) { echo 'disabled'; } ?> oninput="datest(this);"></td>
			<td><input type="text" class="form-control guessinput" name="<?php echo $awayid; ?>" value="<?php echo $predictions[$awayid]; ?>" <?php if(time() > $row->kick_off) { echo 'disabled'; } ?> oninput="datest(this);"></td>
			<td><?php echo $row->awayteam; ?></td>
		</tr>

	<?php } ?>

</table>

</div>


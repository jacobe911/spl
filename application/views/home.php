
<div class='container'>

<h1 class="infobox" >Recent Results</h1>

<table>

	<tr>
		<th>Date</th>
		<th>Home Team</th>
		<th>Home Score</th>
		<th>Away Score</th>
		<th>Away Team</th>
	</tr>
	
	<?php foreach ($results->result() as $row) { ?>
	
			<tr>
				<td><?php echo date('d/m/y', $row->kick_off); ?></td>
				<td><?php echo $row->hometeam; ?></td>
				<td><?php echo $row->hometeamscore ?></td>
				<td><?php echo $row->awayteamscore ?></td>
				<td><?php echo $row->awayteam; ?></td>
			</tr>
	
		<?php } ?>
		
</table>

</div>
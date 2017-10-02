
<div class='container'>

<table>
	<tr>
		<th>User</th>
		<th>Total Points</th>

	</tr>
	
	<?php foreach ($standings->result() as $row) { ?>
	
			<tr <?php if (isset($_SESSION['username']) && $_SESSION['username'] == $row->username) { echo 'style="font-weight:bold;color:red"'; } ?>>

				<td><?php echo $row->screen_name; ?></td>
				<td><?php echo $row->total_points; ?></td>

			</tr>
	
		<?php } ?>

</table>

</div>
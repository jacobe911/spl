
<div class='container infobox'>

<h1>Edit Details</h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open(uri_string());?>

      <p>
            <?php echo form_label('Screen Name:', 'screen_name');?> <br />
            <?php echo form_input($screen_name);?>
      </p>
	  
	  <p>
            <?php echo form_label('First Name:', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            <?php echo form_label('Last Name:', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </p>
	  
	  <p>
            <?php echo form_label('Email Address:', 'email');?> <br />
            <?php echo form_input($email);?>
      </p>

      <p>
            <?php echo form_label('New Password: (if you want to)', 'password');?> <br />
            <?php echo form_input($password);?>
      </p>

      <p>
            <?php echo form_label('Confirm Password: (if you want to)', 'password_confirm');?><br />
            <?php echo form_input($password_confirm);?>
      </p>

      <?php echo form_hidden('username', $user->username);?>

      <p><?php echo form_submit('submit', 'Submit');?></p>

<?php echo form_close();?>

</div>

</div>


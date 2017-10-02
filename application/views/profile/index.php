
<div class='container infobox'>

<h1>Profile</h1>

<div id="infoMessage"><strong><?php echo isset($_SESSION['message']) ? $_SESSION['message'] : '' ;?></strong></div>

<p>Logged in as Username: <?php echo $user_data->username; ?>.</p>

<p>Screen Name: <?php echo $user_data->screen_name; ?>.</p>

<p>First name: <?php echo $user_data->first_name; ?>.</p>

<p>Last Name:  <?php echo $user_data->last_name; ?>.</p>

<p>Email Address: <?php echo $user_data->email; ?>.</p>

<p>Member since: <?php echo date('d/m/Y H:i:s',$user_data->created_on); ?>.</p>

<p>Last online: <?php echo date('d/m/Y H:i:s',$user_data->last_login); ?>.</p>

<a href="<?php echo site_url('profile/edit/'.$user_data->username); ?>"><strong>Edit your details.</strong></a>

</div>


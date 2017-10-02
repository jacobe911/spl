<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo site_url('assets/styles.css'); ?>">
	<style>

		body {
			background:url("<?php echo site_url('assets/images/stadium.jpg');?>") no-repeat center fixed;
		}

	</style>
  </head>
  <body>
	<nav class="navbar fixed-top navbar-expand-md navbar-light bg-faded" style="background-color:#e3f2fd;">
	  <a class="navbar-brand" href="<?php echo site_url(); ?>">Home</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarText">
		<ul class="navbar-nav mr-auto">
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('standings'); ?>">Standings</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?php echo site_url('rules'); ?>">Rules</a>
		  </li>
		</ul>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalLoginForm">Login</button>
	  </div>
	</nav>
	
	<?php if ($this->session->flashdata('message_success')) {echo '<div class="alert alert-success alert-dismissible message-alert" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$this->session->flashdata('message_success').'</div>'; } ?>

  	<?php if ($this->session->flashdata('message_error')) {echo '<div class="alert alert-danger alert-dismissible message-alert" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$this->session->flashdata('message_error').'</div>'; } ?>


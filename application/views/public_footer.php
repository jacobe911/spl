	
	
	<footer class="footer-distributed">

		<div class="footer-left">

			<h3>Company<span>logo</span></h3>

			<p class="footer-links">
				<a href="<?php echo site_url(); ?>">Home</a>
				·
				<a href="<?php echo site_url('standings'); ?>">Standings</a>
				·
				<a href="<?php echo site_url('rules'); ?>">Rules</a>
				·
				<a href="<?php echo site_url('about'); ?>">About</a>
				·
				<a href="<?php echo site_url('faqs'); ?>">FAQs</a>
				·
				<a href="<?php echo site_url('termsandconditions'); ?>">Terms and Conditions</a>
			</p>

			<p class="footer-company-name">Company Name &copy; <?php echo date("Y"); ?></p>

		</div>

		<div class="footer-right">

			<p>Contact Us</p>

			<form action="<?php echo site_url('contact/send_message'); ?>" method="post">

				<input type="text" name="username" placeholder="Username" />
				<textarea name="message" placeholder="Message"></textarea>
				<input type="hidden" name="redirect_url" value="<?php echo current_url(); ?>">
				<button>Send</button>

			</form>

		</div>

	</footer>

	<!-- Modal -->
	<div id="ModalLoginForm" class="modal fade">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title" id="loginModalTitle">Login</h1>
				</div>
				<div class="modal-body">
					<form role="form" method="POST" action="user/login" id="needs-validation" novalidate>
					<input type="hidden" id="loginActive" name="loginActive" value="1">
					<input type="hidden" id="redirecturl" name="redirecturl" value="<?php echo current_url(); ?>">
						<input type="hidden" name="_token" value="">
						<div class="form-group" id="username">
							<label class="control-label">Username</label>
							<div>
								<input type="text" class="form-control input-lg" name="username" value="" required>
							</div>
						</div>
						<div class="form-group" id="email" style="display:none">
							<label class="control-label">Email</label>
							<div>
								<input type="email" class="form-control input-lg" id="email" name="email" value="">
							</div>
						</div>						
						<div class="form-group" id="password">
							<label class="control-label">Password</label>
							<div>
								<input type="password" class="form-control input-lg" name="password" required>
							</div>
						</div>					
						<div class="form-group" id="rememberMe">
							<div>
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div>
								<button type="submit" id="loginSignupButton" class="btn btn-success">Login</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<!-- <a id="forgotPassword" class="btn btn-link">Forgot Your Password?</a> -->
							</div>
						</div>
					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal --> 
	

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
	<script src="<?php echo site_url('assets/main.js'); ?>"></script>
	
  </body>
</html>
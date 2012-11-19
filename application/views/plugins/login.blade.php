<div class="modal hide" id="login_modal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h3>Login or Register</h3>
	</div>
	<div class="modal-body">
		<form class="well" method="POST" action="{{ URL::to('user/authenticate') }}" id="login_modal_form">
			<label for="email">Email</label>
			<input type="email" placeholder="Your Email Address" name="email" id="email" />
			<label for="password">Password</label>
			<input type="password" placeholder="Your Password" name="password" id="password" />
			<label class="checkbox" for="new_user">
				<input type="checkbox" name="new_user" id="new_user" checked="checked"> I am a new user
			</label>
		</form>
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">Cancel</a>
		<button type="button" onclick="$('#login_modal_form').submit();" class="btn btn-primary">Login or Register</a>
	</div>
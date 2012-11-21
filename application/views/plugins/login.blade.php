<div class="modal hide" id="login_modal">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h3>Login or Register</h3>
	</div>
	<div class="modal-body">
		<div class="tabbable">
		  <ul class="nav nav-tabs">
		    <li class="active"><a href="#pane1" data-toggle="tab">Login</a></li>
		    <li><a href="#pane2" data-toggle="tab">Register</a></li>
		  </ul>
		  <div class="tab-content">
		    <div id="pane1" class="tab-pane active">
		      	<form class="well modal-form" method="POST" action="{{ URL::to('user/authenticate') }}" id="login_modal_form">
					<label for="email">Email</label>
					<input type="email" placeholder="Your Email Address" name="email" id="email" />
					<label for="password">Password</label>
					<input type="password" placeholder="Your Password" name="password" id="password" />
				</form>
		    </div>
		    <div id="pane2" class="tab-pane">
		    	<form class="well modal-form" method="POST" action="{{ URL::to('user/authenticate') }}" id="register_modal_form">
					<label for="username">User Name</label>
					<input type="text" placeholder="Your Chose Username" name="username" id="username" />
					<label for="display_name">Display Name</label>
					<input type="text" placeholder="Your Display Name" name="display_name" id="display_name" />
					<label for="email">Email</label>
					<input type="email" placeholder="Your Email Address" name="email" id="email" />
					<label for="password">Password</label>
					<input type="password" placeholder="Your Password" name="password" id="password" />
					<input type="hidden" name="new_user" id="new_user" value="on">
				</form>
		    </div>
		  </div><!-- /.tab-content -->
		</div><!-- /.tabbable -->
	</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal">Cancel</a>
		<button type="button" onclick="$('div.tab-pane.active form.modal-form').submit();" class="btn btn-primary">Login or Register</a>
	</div>
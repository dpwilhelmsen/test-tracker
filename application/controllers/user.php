<?php
class User_Controller extends Base_Controller
{
	public function action_authenticate()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		$new_user = Input::get('new_user', 'off');
		if( $new_user == 'on' ) {
			try {
				$username = Input::get('username');
				$display_name = Input::get('display_name');
				$user = new User();
				$user->email = $email;
				$user->password = Hash::make($password);
				$user->username = trim($username);
				$user->name = $display_name;
				$user->save();
				Auth::login($user);
				echo json_encode(array('status'=>'success'));
			}  catch( Exception $e ) {
				echo json_encode(array('status'=>'error', 'message'=>'Failed to create new user!'));
			}
			die();
		} else {
			$credentials = array(
					'username' => $email,
					'password' => $password
				);
			if( Auth::attempt($credentials)) {
				echo json_encode(array('status'=>'success'));
			} else {
				echo json_encode(array('status'=>'error', 'message'=>'Failed to login!'));
			}
		}
	}
}
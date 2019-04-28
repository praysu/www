<?php
class Page {
	public static function Home()
	{
		echo 
		'<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center">
			<h1>Welcome to Praysu!</h1>
		</div>';
	}
	
	public static function NavBar() {
		echo
		'<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		  <a class="navbar-brand" href="/Home"><img src="'. MIRROR .'/img/vatican.png" height="60px" width="60"/> Praysu</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">';
			if(isset($_SESSION['user']))
			{
			$user = Session::Get('user');
			echo'
			  <li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="'. AVATAR .'/'. $user->id .'" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Dropdown
				</a>
				<div class="dropdown-menu" aria-labelledby="navbarDropdown">
				  <a class="dropdown-item" href="/u/'. $user->name .'">Profile</a>
				  <a class="dropdown-item" href="#">Settings</a>
				  <div class="dropdown-divider"></div>
				  <a class="dropdown-item" href="/submit/Logout.php">Log Out</a>
				</div>
			  </li>';
			}
			echo '
			  <li class="nav-item">
				<a class="nav-link" href="/Home">Home</a>
			  </li>';
			  
			  
			if(isset($_SESSION['user'])) {
			  echo '
				  <li class="nav-item">
					<a class="nav-link" href="/Invite">Invite</a>
				  </li>';
			}
			else {
				echo '
				  <li class="nav-item">
					<a class="nav-link" href="/Register">Register</a>
				  </li>
				  
				  <li class="nav-item">
					<a class="nav-link" href="/Login">Login</a>
				  </li>';
			}
		  echo '
			  <li class="nav-item">
				<a class="nav-link disabled" href="#">Disabled</a>
			  </li>
			</ul>
			<div class="form-inline my-2 my-lg-0">
			  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			</div>
		  </div>
		</nav>';
	}
	
	public static function Login()
	{
		_log('Starting Login page...');
		
		// Set the back location (where you land after submission)
		Location('/Login');
		
		echo
		'<div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
			<div class="wrapper wrapper--w780">
				<div class="card card-3">
					<div class="card-heading"></div>
					<div class="card-body">
						<h2 class="title">Please enter your Credentials</h2>
						<form method="POST" action="/submit/Login.php">
						
							<div class="input-group">
								<input id="username" class="input--style-3 valid" type="text" placeholder="Username" name="name">							
							</div>
							
							
							<div class="input-group">
								<input id="password" class="input--style-3 js-datepicker valid" type="password" placeholder="Password" name="password">
							</div>
							
							<div class="p-t-10">
								<button class="btn btn--pill btn--green" type="submit">Submit</button>
							</div>
							
							<div class="form-check">
								<label class="form-check-label" for="remember">Stay logged in</label>
								<input id="remember" type="checkbox" class="form-check-input" name="remember"/>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>';
	}
	
	public static function Register()
	{
		_log('Starting Register page...');
		
		// Set the back location (where you land after submission)
		Location('/Register');
		
		echo
		'<div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registration Info</h2>
                    <form method="POST" action="/submit/Register.php">
					
                        <small>Username must be longer than 3 characters!</small>
						<div class="input-group">
                            <input id="username" class="input--style-3 valid" type="text" placeholder="Username" name="name">							
                        </div>
						
						
                        <div class="input-group">
                            <input id="password1" class="input--style-3 js-datepicker valid" type="password" placeholder="Password" name="password1">
                        </div>
                        
						<div class="input-group">
                            <input id="password2" class="input--style-3 js-datepicker valid" type="password" placeholder="Verify your password" name="password2">
                        </div>
						
						<small>You need a invitation-key in order to pray on praysu</small>
						<div class="input-group">
                            <input id="key" class="input--style-3 valid" type="text valid" placeholder="Invitation key" value="'. $_GET['invite'] .'" name="key">
                        </div>
						
						<small>Your discord tag is both, your name and the number!</small>
                        <div class="input-group">
                            <input id="discord" class="input--style-3 valid" type="text" placeholder="YoloSwaggerHD#0000" name="discord">
                        </div>
						
                        <div class="p-t-10">
                            <button class="btn btn--pill btn--green" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>';
	}
	
	public static function Invite() {
		$user = Session::Get('user');
		echo 
		'<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center">
			<h2>Invite</h2>
			<p>
				In order to play on Praysu you need an invitation by another user.<br>
				Users who invited others get access to osu!Direct!
			</p>
			
			<table class="table table-dark">
			  <tbody>
				<tr>
				  <th scope="row">Key</th>
				  <td><input value="'. $user->key .'"</td>
				</tr>
				<tr>
				  <th scope="row">Invite Link</th>
				  <td><input value="'. WEB . '/Register/'. $user->key .'"</td>				  
				</tr>
				<tr>
				  <td>Invites Left: '. $user->invites .'</td>
				  <td>Successful Invites: '. $user->invite_success .'</td>				  
				</tr>
			  </tbody>
			</table>
		</div>';
	}
}
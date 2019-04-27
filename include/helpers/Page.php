<?php
class Page {
	public static function Home()
	{
		echo 
		'<div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
			<h1>Welcome to Praysu!</h1>
		</div>';
	}
	
	public static function Register()
	{
		_log('Starting Register page...');
		
		
		
		echo
		'<div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">
        <div class="wrapper wrapper--w780">
            <div class="card card-3">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registration Info</h2>
                    <form method="POST">
					
                        <small>Username must be longer than 3 characters!</small>
						<div class="input-group">
                            <input id="username" class="input--style-3" type="text" placeholder="Username" name="name">							
                        </div>
						
						
                        <div class="input-group">
                            <input id="password1" class="input--style-3 js-datepicker" type="text" placeholder="Password" name="password1">
                        </div>
                        
						<div class="input-group">
                            <input id="password2" class="input--style-3 js-datepicker" type="text" placeholder="Verify your password" name="password2">
                        </div>
						
						<div class="input-group">
                            <input id="key" class="input--style-3" type="text" placeholder="Invitation key" value="'. $_GET['invite'] .'" name="key">
                        </div>
						
                        <div class="input-group">
                            <input id="discord" class="input--style-3" type="text" placeholder="Discord" name="discord">
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
}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slide Navbar</title>
    <link rel="stylesheet" type="text/css" href="assets/css/loginreg.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
			<div class="signup">
				<form>
					<label for="chk" aria-hidden="true">Sign up</label>
                    <div class="flex-container">
                        <div class="flex-item-left">
                            <input type="text" name="txt" placeholder="username" required="">
                        </div>
                        <div class="flex-item-right">
                            <input type="password" name="pswd" placeholder="Password" required="">
                        </div>
                        <div class="flex-item-left">
                            <input type="text" name="fullname" placeholder="Fullname" required="">
                        </div>
                        <div class="flex-item-right">
                            <input type="email" name="email" placeholder="Email" required="">
                        </div>
                        <div class="flex-item-left">
                            <input type="number" name="phone" placeholder="Phone" required="">
                        </div>
                        <div class="flex-item-right">
                            <input type="text" name="occupation" placeholder="Occupation" required="">
                        </div>
                    </div>
                    <input type="date" name="dob" placeholder="Date of birth " required="">
					<button>Sign up</button>
				</form>
			</div>

			<div class="login">
				<form>
					<label for="chk" aria-hidden="true">Login</label>
                    <i class="fa fa-user-circle-o" style="font-size: 100px; justify-content: center; display: flex;"></i>
                    <input type="text" name="txt" placeholder="username" required="">
					<input type="password" name="pswd" placeholder="Password" required="">
					<button>Login</button>
				</form>
			</div>
	</div>
</body>
</html>
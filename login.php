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
    <script src="assets/js/customlog.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
</head>
<body>
    <div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
			<div class="signup">
				<form name="signupfor" action="connector/signup" method="post">
					<label for="chk" aria-hidden="true">Sign up as Volunteer</label>
                    <div class="flex-container">
                        <div class="flex-item-left">
                            <input type="text" name="username" placeholder="username" required="">
                        </div>
                        <div class="flex-item-right">
                            <input type="password" name="password" placeholder="Password" required="">
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
                    <input type="date" name="dob" placeholder="Date of birth" required="">
					<button onclick="return validateSignUpForm()">Sign up</button>
				</form>
			</div>

			<div class="login">
				<form name="logform" action="connector/signin" method="post">
					<label for="chk" aria-hidden="true">Login</label>
                    <i class="fa fa-user-circle-o" style="font-size: 100px; justify-content: center; display: flex; color: #425F57;"></i>
                    <input type="text" name="username" placeholder="Username" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button onclick="return validateForm()">Login</button>
				</form>
			</div>
	</div>
    <script>
        function validateSignUpForm() {
        const data = [];
        data[0] = document.forms["signupfor"]["username"];
        data[1] = document.forms["signupfor"]["password"];
        data[2] = document.forms["signupfor"]["fullname"];
        data[3] = document.forms["signupfor"]["email"];
        data[4] = document.forms["signupfor"]["phone"];
        data[5] = document.forms["signupfor"]["occupation"];
        data[6] = document.forms["signupfor"]["dob"];
        
        for (let indexdata = 0; indexdata < data.length; indexdata++) {
            if (data[indexdata].value == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data[indexdata].placeholder +' must be filled out!'
                })
                return false;
            }  
        }
        }

        function validateForm() {
        const data = [];
        data[0] = document.forms["logform"]["username"];
        data[1] = document.forms["logform"]["password"];
        for (let indexdata = 0; indexdata < data.length; indexdata++) {
            if (data[indexdata].value == "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data[indexdata].placeholder +' must be filled out!'
                })
                return false;
            }  
        }
        }
    </script>
       
</body>
</html>
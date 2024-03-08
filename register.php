<?php
// Database connection parameters
$host = 'localhost'; // Change this if your MySQL server is hosted elsewhere
$username = 'root';
$password = '';
$database = 'webprogruba_db';

// Establish a connection to the database
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if(isset($_POST["submit"])){
    // Retrieve form data and sanitize inputs
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST["repeatpassword"];
    $address_lotblk = $_POST['lotblk'];
    $address_street = $_POST['street'];
    $address_village = $_POST['phasesub'];
    $address_barangay = $_POST['barangay'];
    $address_country = $_POST['country'];
    $address_state = $_POST['state'];
    $address_city = $_POST['city'];
    $phone_number = $_POST['phone'];
    $errors = array();

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // validate if all fields are empty
    if (empty($last_name) || empty($first_name) || empty($email) || empty($password) || empty($repeat_password) || empty($address_lotblk) || empty($address_street) || empty($address_barangay) || empty($address_country) || empty($address_state) || empty($address_city) || empty($phone_number)) {
        array_push($errors,"All fields are required");
    }
    // validate if the email is not validated
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
        array_push($errors,"Email is not valid");
    }
    // password should not be less than 8
    if (strlen($password)<8) {
        array_push($errors,"Password must be at least 8 characters long");
    }
    // check if password is the same
    if($password != $repeat_password){
        array_push($errors,"Password does not match");           
    }

    $sql = "SELECT * FROM registration_tbl WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);
    if ($rowCount>0){
        array_push($errors, "Email already exists!");
    }

    if (count($errors) > 0){
        foreach($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        $sql ="INSERT INTO registration_tbl (last_name, first_name, email, password, address_lotblk, address_street, address_village, address_barangay, address_country, address_state, address_city, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $preparestmt = mysqli_stmt_prepare($stmt, $sql);
        if ($preparestmt) {
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $last_name, $first_name, $email, $passwordHash, $address_lotblk, $address_street, $address_village, $address_barangay, $address_country, $address_state, $address_city, $phone_number);
            mysqli_stmt_execute($stmt);
            echo "<div class = 'alert alert-success'> You are Registered Successfully! </div>";
			// Redirect to login page after 3 seconds
			echo "<script>setTimeout(function() {
				window.location.href = 'login.php';
			}, 2000);</script>";
        } else {
            die("Something went wrong!");
        }
    }
}

// Close the database connection
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Muhamad Nauval Azhar">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="This is a login page template based on Bootstrap 5">
	<title>REGISTER</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" href="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="//g.tutorialjinni.com/mojoaxel/bootstrap-select-country/dist/css/bootstrap-select-country.min.css" />
	<link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.19/css/intlTelInput.css"/>
	<link rel="stylesheet" href="design/style.css"/>

</head>

<body style="background-color: #c08081;">
    
	<section class="h-100">
		<div class="container-fluid h-100 mt-4"> <!-- Change container to container-fluid for full-width -->
			<div class="row justify-content-center align-items-center h-100"> <!-- Center content vertically and horizontally -->
				<div class="col-xl-8 col-lg-10 col-md-10 col-sm-12"> <!-- Adjust column widths for responsiveness -->
					<div class="card shadow-lg">
						<div class="card-body p-5">
							<h1 class="fs-4 card-title fw-bold mb-4">REGISTER</h1>
							<form method="POST" class="needs-validation" novalidate="" autocomplete="off">
								<div class="mb-3">
									<b><label class="mb-2 text-muted" for="name">Name</label></b>
									<input id="last_name" type="text" class="form-control" name="last_name" value="Last Name" required autofocus>

									<br>
									<input id="first_name" type="text" class="form-control" name="first_name" value="First Name" required autofocus>
									<div class="invalid-feedback">
										Name is required	
									</div>
								</div>

								<div class="mb-3">
									<b><label class="mb-2 text-muted" for="email">E-Mail Address</label></b>
									<input id="email" type="email" class="form-control" name="email" value="" required>
									<div class="invalid-feedback">
										Email is invalid
									</div>
								</div>

								<div class="mb-3">
									<b><label class="mb-2 text-muted" for="password">Password</label></b>
									<input id="password" type="password" class="form-control" name="password" required>
								    <div class="invalid-feedback">
								    	Password is required
							    	</div>
							    	<br>
									<div class="mb-3">
										<b><label class="mb-2 text-muted" for="password"> Repeat Password</label></b>
										<input id="repeatpassword" type="password" class="form-control" name="repeatpassword" required>
										<div class="invalid-feedback">
											Password does not match
										</div>
										<br>

								
  <div class="select_option">
    <b><label class="mb-2 text-muted" for="address">Address</label></b>
	<br>
	<input id="lotblk" type="text" class="form-control" name="lotblk" value="Lot/Blk" required>
	<br>
	<input id="street" type="text" class="form-control" name="street" value="Street" required>
	<br>
	<input id="phasesub" type="text" class="form-control" name="phasesub" value="Phase/Subdivision/Village" required>
    <br><!-- Apply Bootstrap classes and attributes -->
	<input id="barangay" type="text" class="form-control" name="barangay" value="Barangay" required>
	<br>
	<select id="country" class="form-select country form-control" name="country" onchange="loadStates(); loadBarangays()" style="width: 100%; height: 50%;">
                <option selected>Select Country </option>
        </select><br>
    <select id="state" class="form-select state form-control" name="state" onchange="loadCities()" style="width: 100%; height: 50%;">
                <option selected>Select State</option>
        </select><br>
    <select id="city" class="form-select city form-control" name="city" aria-label="Default select example" style="width: 100%; height: 50%;">
            <option selected>Select City</option>
        </select><br>
</div>
<div class="mb-3">
    <b><label class="mb-2 text-muted" for="phone">Phone Number</label></b>
		<br>
    <!-- Apply Bootstrap classes and attributes -->

        <input type="text" class="form-control" id="phone" name="phone" aria-label="Phone Number" style="width: 100%;">
    </div>
</div>

		

								<p class="form-text text-muted mb-3">
									By registering you agree with our terms and condition.
								</p>

								<div class="align-items-center d-flex">
									<button type="submit" class="btn btn-primary ms-auto" name="submit" style="background-color: #c08081;">
										Register	
									</button>
								</div>
							</form>
						</div>
						<div class="card-footer py-3 border-0">
							<div class="text-center">
								Already have an account? <a href="login.php" style="color: #c08081;">LOGIN HERE</a>
							</div>
						</div>
					</div>
					<div class="text-center mt-5 text-muted">
 
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<script src="js/app.js"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	<script src="js/login.js"></script>
	<script src="//cdn.tutorialjinni.com/jquery/3.6.1/jquery.min.js"></script>
<script src="//cdn.tutorialjinni.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="//cdn.tutorialjinni.com/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
<script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.19/js/intlTelInput.min.js"></script>
<script>
    var input = document.querySelector("#phone");
            window.intlTelInput(input, {
                separateDialCode: true,
                excludeCountries: ["in", "il"],
                preferredCountries: ["ph"]
            });
</script>

</script>
</body>
</html>

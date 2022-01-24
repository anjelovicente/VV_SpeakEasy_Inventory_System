<html>
<style>
    body {
        background-image: url('projecticon.png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position-x: center;
        background-position-y: top;
    }
</style>
<body>
<br><br><br><br><br><br>
<h2 align="center">V&V Speakeasy Employee Login</h2>
<head>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>

<?php
	// define variables and set to empty values
	$lNameError=$fNameError = $employeeIDError = $pWordError = $pWordMatchError = $ageError="";
	$lastName=$firstName = $employeeID = $password = $cPassword = $age ="";
	$checker=true;
	
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		if (empty($_POST["lastName"])){
			$lNameError = " Last Name is required";
			$checker = false;
		}
		if (empty($_POST["firstName"])){
			$fNameError = " First Name is required";
			$checker = false;
		}
		if (empty($_POST["employeeID"])){
			$employeeIDError = " EmployeeID is required";
			$checker = false;
		}
		if (empty($_POST["password"])){
			$pWordError = " Password is required";
			$checker = false;
		}
		if ($_POST["cPassword"] =! $_POST["password"]) {
			$pWordMatchError = " Password does not match";
			$checker = false;
		}
		if (empty($_POST["age"])){
			$ageError = " Age is required";
			$checker = false;
		}
		if($checker){
			$sqlConnect = mysqli_connect("localhost","root","");
			if(!$sqlConnect){
				die("Error connecting to sql");
			}
			$selectDb = mysqli_select_db($sqlConnect,'projectLogin');
			if(!$selectDb){
				die("Error connection to database");
			}
			mysqli_query($sqlConnect,"INSERT INTO `employeedetails`(`employeeID`,`password`, `LastName`, `FirstName`, `age`) 
			VALUES('".$_POST['employeeID']."','".$_POST['password']."','".$_POST['lastName']."','".$_POST['firstName']."','".$_POST['age']."')");
			mysqli_close($sqlConnect);
            header('location: http://localhost:80/Project_Login.html');
		}
	}
?>

<form method = "POST" align = "center" action = "<?php echo
	htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<h2>Register: </h2>
	Employee ID: <input type = "text" name = "employeeID" />
	<span class="error">* <?php echo $employeeIDError;?></span>
	<br><br>
	
	Last Name: <input type = "text" name = "lastName" />
	<span class="error">* <?php echo $lNameError;?></span>
	<br><br>
	
	First Name: <input type = "text" name = "firstName" />
	<span class="error">* <?php echo $fNameError;?></span>
	<br><br>
	
	
	Password: <input type = "Password" name = "password" />
	<span class="error">* <?php echo $pWordError;?></span>
	<br><br>
	
	Confirm Password: <input type = "Password" name = "cPassword" />
	<span class="error">* <?php echo $pWordMatchError;?></span>
	<br><br>
	
	Age: <input type = "text" name = "age" />
	<span class="error">* <?php echo $ageError;?></span>
	<br><br><br>
	
	<input type = "submit" value="Register"/>
</form>
<form action = "Project_Login.html" align="center">
    <input type = "submit" value="Back"/>
</form>
</body>
</html>

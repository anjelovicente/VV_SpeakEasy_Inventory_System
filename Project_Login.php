<html>

<head>
    <link rel="icon" href="projecticon.png">
    <title>
        Log In
    </title>
</head>
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
<body>

<?php
$employeeIDInput=$_POST['employeeIDInput'];
$pwInput=$_POST['pwInput'];
$employeeID="";
$password="";
$lastName="";
$firstName="";
$age="";
$sqlConnect=mysqli_connect("localhost","root","");
	
if(!$sqlConnect){
	die();
}
	
$selectDb=mysqli_select_db($sqlConnect,'projectLogin');
	
if(!$selectDb){
	die("Can't find the database!".mysqli_error());
}

if ($employeeIDInput == '' || $pwInput ==''){?>
        <form method ="POST" align="center" action="Project_Login.html">
            Invalid Username/Password input. <br>
            Try Again: <input type="submit" value="Retry"/>
        </form>
<?php
}
else{
        $table = mysqli_query($sqlConnect,"select * from employeedetails where employeeID='".$employeeIDInput."'");

        while($sr=mysqli_fetch_array($table)) {
            $employeeID=$sr['employeeID'];
            $password=$sr['password'];
            $lastName=$sr['LastName'];
            $firstName=$sr['FirstName'];
            $age=$sr['age'];
        }

        if($pwInput==$password) {
            header('location: http://localhost:80/Inventory.php');
        }

        else {
            ?>
            <form method ="POST" align="center" action="Project_Login.html">
                Username/Password do not match. <br>
                Try Again: <input type="submit" value="Retry"/>
            </form>
            <?php
        }
}
?>

</body>
</html>
<html>
<head>
    <link rel="icon" href="projecticon.png">
    <title>
        SADT - Inventory Main Page
    </title>
</head>
<style>
    body {
        background-image: url('projectlogo.png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position-x: center;
        background-position-y: top;
    }
</style>
<body>
<h2 align="center">Speakeasy Accounting Database Terminal (SADT)</h2>
<br><br><br><br><br><br><br><br><br><br><br><br>
<p align="center">All Information:</p>
<?php
//open the connection
$sqlConnect = mysqli_connect("localhost","root","");
if(!$sqlConnect) {
    die();
}

//choose the database
$selectDB = mysqli_select_db($sqlConnect,'SADT');
if(!$selectDB) {
    die("Can't find the database!".mysqli_error());
}

$query = "select * from inventoryinfo";
$result_out = mysqli_query($sqlConnect, $query);
?>
<form align="center" action="Sort.php" method="POST">
    <input value="Sort" type="submit">
    <select  name="sortby">
        <option value="a">Name</option>
        <option value="b">ID</option>
        <option value="c">Stocks</option>
        <option value="d">Price</option>
    </select>
</form>

<table border="2" align="center">
    <tr>
        <h2><td>Product Name</td>
        <td>Product ID</td>
        <td>Product Price</td>
            <td>Stocks Left</td>
        </h2>
    </tr>
    <?php
    while ($VD = mysqli_fetch_array($result_out)) {
        $drinkName = $VD["drinkName"];
        $id = $VD["id"];
        $price = $VD["price"];
        $stocks = $VD["stocks"];
        ?>
    <tr>
        <td><?php echo  $drinkName;?></td>
        <td align="right"><?php echo  $id;?></td>
        <td align="right"><?php echo  $price;?></td>
        <td align="right"><?php echo  $stocks;?></td>
    </tr>
    <?php
    } ?>
</table>

<form action="Search.php" method="POST">
    <table align="center">
        <td> <input name="Search" type="text"></td>
        <td> <input type="submit" value="Search"></td>
    </table>
</form>

<br><br>
<p align="center">Options:</p>
<table align="center">
    <td>
        <form id="form" action="Update.html" method="POST">
            <input type="submit"  value="Update">
        </form>
    </td>
    <td>
        <form id="form" action="Delete.html" method="POST">
            <input type="submit"  value="Delete">
        </form>
    </td>
    <td>
        <form id="form" action="Project_Login.html" method="POST">
            <input type="submit"  value="Log Out">
        </form>
    </td>
</table>

</body>
</html>
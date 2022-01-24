<html>
<head>
    <link rel="icon" href="projecticon.png">
    <title>
        SADT - Update
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
<p align="center">Update Information:</p>
<?php
//open the connection
$check = 1;
$sqlConnect = mysqli_connect("localhost","root","");
if(!$sqlConnect) {
    die();
}

//choose the database
$selectDB = mysqli_select_db($sqlConnect,'SADT');
if(!$selectDB) {
    die("Can't find the database!".mysqli_error());
}

if ($_REQUEST['drinkName'] =='' || $_REQUEST['id'] ==''|| $_REQUEST['price'] ==''|| $_REQUEST['stocks'] ==''){
?>
    <form id="form" action="Update.php" method="POST" align="center">
        <br>
        <table border="1" align="center">
            <tr>
                <td>Product Name</td>
                <td>Product ID</td>
                <td>Product Price</td>
                <td>Stocks Left</td>
            </tr>
            <tr>
                <td><input name="drinkName" type="text" id="drinkName"></td>
                <td><input name="id" type="number" id="id"></td>
                <td><input name="price" type="number" id="price"></td>
                <td><input name="stocks" type="number" id="stocks"></td>
            </tr>
        </table><br><br>
        <p align="center">Incomplete Input!<br>
        <input type="submit" value="Update" onclick="getValid()">

    </form>
    <form action="Inventory.php" align="center">
        <input type="submit" value="Go Back to Inventory">
    </form>
<?php
}
else{
    $drink = mysqli_real_escape_string($sqlConnect,$_REQUEST["drinkName"]);

    $query = "select * from inventoryinfo where drinkName='$drink'";
    $result_out = mysqli_query($sqlConnect, $query);

    while ($VD = mysqli_fetch_array($result_out)) {
        $drinkName = $VD["drinkName"];
        $id = $VD["id"];
        $price = $VD["price"];
        $stocks = $VD["stocks"];
        if ($drinkName == $drink){
            $sql = "update inventoryinfo set id='$_POST[id]', price='$_POST[price]', 
        stocks='$_POST[stocks]' where drinkName='$drink'";
            mysqli_query($sqlConnect, $sql);
            ?><p align="center">--Inventory Updated--<br>
            <?php
            $check=0;
            break;
        }
    }
    if ($check == 1 && $_REQUEST["drinkName"] != ''){
        $sql = "insert into inventoryinfo(drinkName, id, price, stocks)
	    values('$_POST[drinkName]','$_POST[id]', '$_POST[price]', '$_POST[stocks]')";
        mysqli_query($sqlConnect, $sql);
        ?><p align="center">--New Inventory Item Added--<br>
        <?php
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
                <td>Product Name</td>
                <td>Product ID</td>
                <td>Product Price</td>
                <td>Stocks Left</td>
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
                    <td  align="right"><?php echo  $id;?></td>
                    <td  align="right"><?php echo  $price;?></td>
                    <td  align="right"><?php echo  $stocks;?></td>
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
    <?php
    }
?>

</body>
</html>
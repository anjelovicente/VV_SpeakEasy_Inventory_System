<html>
<head>
    <link rel="icon" href="projecticon.png">
    <title>
        SADT - Delete
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
<p align="center">Delete Information:</p>
<?php
//open the connection
$check = 0;
$sqlConnect = mysqli_connect("localhost","root","");
if(!$sqlConnect) {
    die();
}

//choose the database
$selectDB = mysqli_select_db($sqlConnect,'SADT');
if(!$selectDB) {
    die("Can't find the database!".mysqli_error());
}

if ($_REQUEST['drinkName'] =='' || $_REQUEST['id'] ==''){
?>
    <form id="form" action="Delete.php" method="POST" align="center">
        <br>
        <table border="1" align="center">
            <tr>
                <td>Product Name</td>
                <td>Product ID</td>
            </tr>
            <tr>
                <td><input name="drinkName" type="text" ></td>
                <td><input name="id" type="number" ></td>
            </tr>
        </table><br><br>
        <p align="center">Incomplete Input!<br>
        <input type="submit" value="Delete">
    </form>
    <form action="Inventory.php" align="center">
        <input type="submit" value="Go Back to Inventory">
    </form>
    <?php
}
else {
    $drink = $_REQUEST["drinkName"];
    $id = $_REQUEST["id"];

    $query = "select * from inventoryinfo where drinkName='$drink' and id='$id'";
    $result_out = mysqli_query($sqlConnect, $query);

    while ($VD = mysqli_fetch_array($result_out)) {
        $drinkName = $VD["drinkName"];
        $id = $VD["id"];
        if ($drinkName == $drink) {
            $sql = "delete from inventoryinfo where id='$_POST[id]'";
            mysqli_query($sqlConnect, $sql);
            ?><p align="center">--Inventory Item Deleted--<br>
            <?php
            $check =1;
            break;
        }

    }
    if($check == 0){
        ?><p align="center">--Item Not Found--<br>
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
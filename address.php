<?php

session_start();

include "hidden/conn.php";

if(!isset($_SESSION['usr'])){
	header("Location: login.php");
	exit;
}

$id = $_SESSION['id'];

$sql = "SELECT * FROM address WHERE id='$id'";
$sql = mysqli_query($conn, $sql);
if(mysqli_num_rows($sql) > 0){
	while($row = mysqli_fetch_assoc($sql)){
		$city = $row['city'];
		$area = $row['area'];
		$street = $row['street'];
		$building = $row['building'];
		$phone = $row['phone'];
	}
} else {
	$city = "";
	$area = "";
	$street = "";
	$building = "";
	$phone = "";
}

$sql = "SELECT * FROM orders WHERE account='$id'";
$sql = mysqli_query($conn, $sql);
if(mysqli_num_rows($sql) > 0){
	while($row = mysqli_fetch_assoc($sql)){
		$table = '
<tr>
	<td>'.$row['id'].'</td>
	<td>'.$row['products'].'</td>
	<td>'.$row['price'].' JD</td>
	<td>'.$row['date'].'</td>
	<td>'.$row['status'].'</td>
</tr>';
	}
} else {
	$table = "No orders found, go to <a href='stock.php' style='color: #2196F3'>stock page?</a>";
}

?>
<head>
<style>

@import url(https://fonts.googleapis.com/css?family=Open+Sans:300);

.header {
    width: 100%;
    position: fixed;
    z-index: 1000;
    top: 0;
    left: 0;
    height: 85px;
    border: none;
    background-color: rgba(255,255,255,1);
    box-shadow: 0px 3px 2px 0px rgba(50, 50, 50, 0.2);
}

* {
	font-family: 'Open Sans', Helvetica, Arial, sans-serif;
}

body{
	background: #282828;
}

nav {
    margin: 1em;
}

ul {
    overflow: auto;
    list-style-type: none;
    text-align: center;
}

li {
    height: 20px;
    margin-right: 0px;
    border-right: 1px solid #1976D2;
    padding: 0 20px;
    display: inline;
}

li:last-child {
    border-right: none;
}

li a {
    text-decoration: none;
    color: #BBDEFB;
    font-size: 20px;
    text-transform: uppercase;
    transition: all 0.5s ease;
    display: inline-block;
}

li.active a, li a:hover {
    color: #2196F3;
}

.logo:hover{
	color: #2196F3;
	transition: 0.2s ease;
}

.form{
	background: white;
	border-radius: 20px;
	overflow: auto;
	max-width: 800px;
	
}

.input{
	background: lightgrey;
	border: none;
	padding: 10px;
	text-align: center;
}

.input::-webkit-input-placeholder{
	color: white;
	text-align: center;
}

.submit{
	color: white;
	background: grey;
	border: none;
	padding: 10px;
}

table{
	color: white;
	background: lightgrey;
}

th:hover{
	background: #1d84d6;
	transition: 0.2s ease;
}

th{
	background: #2196F3;
}

th, td{
	padding: 25px;
	border: 1px solid white;
}
</style>
<title>Settings</title>
</head>

<header class="header" style="overflow: hidden;" role="banner">
	<div class="logo"><h1 style="float: left; padding-left: 2em;">ZUJAJ</h1></div>
    <nav style="float: right;  padding-right: 2em;">
        <ul>
            <li><a href="index.php">Home</a>
            </li>
            <li><a href="#">About</a>
            </li>
            <li><a href="#">Stock</a>
            </li>
            <li><a href="#">Contact</a>
            </li>
			<?php if(isset($_SESSION['usr'])){echo '<li class="active"><a href="address.php">Settings</a><li><a href="hidden/logout.php">Logout</a>';
			}else{echo '<li><a href="login.php">Login</a>'; }
			?>
            </li>
        </ul>
    </nav>
</header>
<body>
<center>
<br><br><br><br><br>
<form class="form" action="hidden/address.php" method="POST">
<br>
Orders
<br><br>
<table>
<tr>
	<th>ID</th>
	<th>Products</th>
	<th>Price</th>
	<th>Date</th>
	<th>Status</th>
</tr>
<?php echo $table; ?>
</table>
<br>
<hr>
Update Address
<br><br>
<label for="city">City:<br></label>
<input class="input" type="text" name="city" value="amman" readonly />
<br><br>
<label for="area">Area:<br></label>
<input class="input" type="text" name="area" value="<?php echo $area; ?>" placeholder="abdoun" required />
<br><br>
<label for="street">Street:<br></label>
<input class="input" type="text" name="street" value="<?php echo $street; ?>" placeholder="hashim al sakkaf" required />
<br><br>
<label for="building">Building #:<br></label>
<input class="input" type="text" name="building" value="<?php echo $building; ?>" placeholder="15" required />
<br><br>
<label for="phone">Phone:<br></label>
<input class="input" type="text" name="phone" value="<?php echo $phone; ?>" placeholder="079-431-3124" required />
<br><br>
<input class="submit" type="submit" name="submit" value="Update Address" />
<br><br>
</form>

<?php

if(isset($_GET['say'])){
	if($_GET['say'] == "done"){ echo "<script>alert('Updated address successfully');</script>";}
	elseif($_GET['say'] == "empty"){ echo "<script>alert('Missing field(s)');</script>";}
}
	?>
<?php

session_start();

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

</style>
<title>Login</title>
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
            <li class="active"><a href="login.php">Login</a>
            </li>
        </ul>
    </nav>
</header>

<body>
<center>
<br><br><br><br><br>
<form class="form" action="#" method="POST">
<br>
Login
<br><br>
<input class="input" type="text" name="usr" placeholder="username" required />
<br><br>
<input class="input" type="password" name="pwd" placeholder="password" required />
<br><br>
<input class="submit" type="submit" name="submit" />
<br><br>
</form>
<a href="register.php"><button class="submit">Register</button></a>
</body>
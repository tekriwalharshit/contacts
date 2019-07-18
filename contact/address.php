<!DOCTYPE html>
<html>
 	<head>
 		<title>Address Book</title>
 		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="address.css">
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
		<script src="https://use.fontawesome.com/ea4f0fc5ab.js"></script>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        
        </head>
 	<body>

    <nav class="navbar navbar-toggleable-md navbar-light bg-faded nav">
   	<div class="container">
   <a class="navb" href="address.php" style="text-decoration:none;color:white;">Contacts</a>

  <div class="Searchbar">
      <form class="form-inline" action="form.php" method="POST">
      <input class="form-control mr-sm-2" id="term" type="text" placeholder="Search" size="60" name="search">
      <button class="btn  my-2 my-sm-0" type="submit" name="submit-search"><i class="material-icons">search</i></button>
    </form>
  
  </div>
  </div>
</nav>



<?php

 
    $servername = "localhost";
	$username = "username";
	$password = "password";
    $dbname = "contact";

 $conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}



if(isset($_GET['mode']))
	$mode = $_GET['mode'];
else
	$mode = "";


if(isset($_GET['name']))
	$name = $_GET['name'];
else
	$name = "";


if(isset($_GET['phone']))
	$phone = $_GET['phone'];
else
	$phone = "";


if(isset($_GET['email']))
	$email = $_GET['email'];
else
	$email = "";


if(isset($_GET['id']))
	$id = $_GET['id'];
else
	$id = "";

if(isset($_SERVER['PHP_SELF']))
	$self = $_SERVER['PHP_SELF'];
else
	$self = "";

if ( $mode=="add") 
 {
 Print '<div class="container"><h2>Add Contact</h2>
 <p> 
 <form action=';
 echo $self; 
 Print '
 method=GET> 
 <table class="table">
 <tr><td>Name:</td><td><input type="text" name="name" /></td></tr> 
 <tr><td>Phone:</td><td><input type="text" name="phone" /></td></tr> 
 <tr><td>Email:</td><td><input type="text" name="email" /></td></tr> 
 <tr><td colspan="2" align="center" ><input class="submit" type="submit" /></td></tr> 
 <input type=hidden name=mode value=added>
 </table> 
 </form> <p></div>';
 } 
 
 if ( $mode=="added") 
 {
 mysqli_query ($conn,"INSERT INTO address (name, phone, email) VALUES ('$name', '$phone', '$email')");
 }

 if ( $mode=="edit")
 { 
 Print '<div class="container"><h2>Edit Contact</h2> 
 <p> 
 <form action=';
 echo $self; 
 Print '
 method=GET> 
 <table class="table"> 
 <tr><td>Name:</td><td><input type="text" value="'; 
 Print $name; 
 print '" name="name" /></td></tr> 
 <tr><td>Phone:</td><td><input type="text" value="'; 
 Print $phone; 
 print '" name="phone" /></td></tr> 
 <tr><td>Email:</td><td><input type="text" value="'; 
 Print $email; 
 print '" name="email" /></td></tr> 
 <tr><td align="center"><input  class="submit" type="submit" /></td></tr> 
 <input type=hidden name=mode value=edited> 
 <input type=hidden name=id value='; 
 Print $id; 
 print '> 
 </table> 
 </form> <p></div>'; 
 } 
 
 if ($mode=="edited") 
 { 
 mysqli_query ($conn,"UPDATE address SET name = '$name', phone = '$phone', email = '$email' WHERE id = $id"); 
 Print "<div class='container'>Data Updated!</div><p>"; 
 } 

if ($mode=="remove") 
 {
 mysqli_query ($conn,"DELETE FROM address where id=$id");
 Print "<div class='container'>Entry has been removed </div><p>";
 }
 

 $data = mysqli_query($conn,"SELECT * FROM address ORDER BY name ASC")or die(mysqli_error()); 
 Print '<div class="container tab"><p>'; 
 Print "<table class='table table-hover'>"; 
 Print "<tr><th width=200>Name</th><th width=100 colspan='2'>Phone</th><th width=100 colspan='2'>Email</th><th width=100  colspan='2'></th></tr>"; 
 Print "<button class='rbutton'><a href=" .$_SERVER['PHP_SELF']. "?mode=add>&plus;</a></button>";

 while($info = mysqli_fetch_array( $data )) 
 { 
 Print "<tr class='b1'><td>".$info['name'] . "</td>"; 
 Print "<td colspan='2'>".$info['phone'] . "</td> "; 
 Print "<td colspan='2'> <a class='emai' href=mailto:".$info['email'] . ">" .$info['email'] . "</a></td>"; 
 Print "<td><a class='b2' href=" .$_SERVER['PHP_SELF']. "?id=" . $info['id'] ."&name=" . $info['name'] . "&phone=" . $info['phone'] ."&email=" . $info['email'] . "&mode=edit><i class='material-icons'>mode edit</i></a></td>"; Print "<td><a class='b2' href=" .$_SERVER['PHP_SELF']. "?id=" . $info['id'] ."&mode=remove><i class='material-icons'>delete</i></a></td></tr>"; 
 } 
 Print "</table></div>"; 
 ?> 

<p>

 </body> 
 </html> 

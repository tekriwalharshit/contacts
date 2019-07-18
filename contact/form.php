<!DOCTYPE html>
<html>
<head>
    <title>Search Result</title>
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
$conn = mysqli_connect('localhost','username','password','contact');
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}
if(isset($_POST['submit-search']))
{
     $search = mysqli_real_escape_string($conn,$_POST['search']);
     $sql = "SELECT * FROM address WHERE name LIKE '%$search%'";

     $result =  mysqli_query($conn , $sql);
     $queryResult = mysqli_num_rows($result); 

     Print '<div class="container tab"><p>'; 
     Print "<table class='table table-hover'>"; 
     Print "<tr><th width=200>Name</th><th width=100 colspan='2'>Phone</th><th width=100>Email</th><th width=100  colspan='2'></th></tr>"; 

     if ($queryResult > 0) 
     {
        while($row = mysqli_fetch_array($result))
        {
           Print "<tr class='b1'><td>".$row['name']."</td>"; 
           Print "<td colspan='2'>".$row['phone']."</td> "; 
           Print "<td colspan='2'> <a class='emai' href=mailto:".$row['email'].">".$row['email']."</a></td>"; 

        }
    }
     else 
        {
            echo"There are no results matching your search!";
        }
     
 }
mysqli_close($conn);
?>
</body>
</html>
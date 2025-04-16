<?php


$conn = pg_connect("host=127.0.0.1 dbname=makemytrip user=postgres");
if ($conn) {
    echo "Connected";
}

    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM users WHERE email = '$email' AND password ='$password'";  
    $result = pg_query($conn,$query);
   
/*if($result)
	echo "Result Have Data";
	echo "<table border ='1'>";
while($row=pg_fetch_assoc($result)) 
{
	echo"<tr><td>";
	echo $row['id'];
	echo "</td><td>";
	echo $row['email'];
	echo "</td><td>";
	echo $row['passwd'];
	echo "</td><tr>";
	echo "<br>";
}
echo "</table>";

*/
if(pg_num_rows($result)>0)
{	   
	   echo"<script>alert('Login Successful');
	   window.location.href='index.html';</script>";
	   
}
/*if else{
	   echo"<script>alert('Invalid Information');
	   window.location.href='login.html';</script>";
           exit();

}*/
else{
           echo"<script>alert('User Not Found Please Register !!');
	   window.history.back();
</script>";
          
}

pg_close($conn);
?>

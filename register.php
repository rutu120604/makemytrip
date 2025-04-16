<?php

//session_start();
$conn = pg_connect("host=127.0.0.1 dbname=makemytrip user=postgres");
if ($conn) {
    echo "Connected ";
}

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phoneno = $_POST['phoneno'];
    $email = $_POST['email'];
    $city = $_POST['city'];
    $password = $_POST['passwd'];

    $query1="select * from users where email='$email'";
    $result1=pg_query($conn,$query1);
    if(pg_num_rows($result1)>0){
	    echo"<script>
		    alert('Email already exists');
                    window.location.href='login.html';
                    </script>";
    }
    else{
	    $query = "insert into users(firstname,lastname,phoneno,email,city,password) VALUES ('$firstname','$lastname','$phoneno','$email','$city','$password')"; 
   	    $result = pg_query($conn,$query); 
   if($result){
	   echo "<script>
	   alert('signup successful! ');
	   window.location.href='login.html';
	   </script>";
   }
   else{
	   echo"<script>
		   alert('failed try again');
                   window.history.back();
</script>";
   }
    }

pg_close($conn);
?>

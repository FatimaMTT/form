<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Form</title>
    <meta name="description" content="Form">
    <meta name="author" content="Fatima Malo Torres Trueba">
	<link rel="stylesheet" type="text/css" href="style/global.css?random.number" />
</head>

<body>
    <?php
    //echo "<pre>", print_r($_POST, true), "</pre>";
    
    if (isset($_POST['signup'])) {
        $username = filter_var($_POST[username], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST[password], FILTER_SANITIZE_STRING);
        $firstname = filter_var($_POST[firstname], FILTER_SANITIZE_STRING);
        $lastname = filter_var($_POST[lastname], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST[email], FILTER_SANITIZE_STRING);
        
        $to = 'f_malotorrestrueba@emerson.edu';
        $subject = 'Thanks for Signing Up!';
        $message = "You have been succesfully been signed up to Fatima's form.\n\n"
            ."Name:=$firstname $lastname\n";
            
        $result = mail($to, $subject, $message);
        
        //Connect to Database
        $dbhostname = 'localhost';
        $dbusername = 'fatimamt_Fatima';
        $dbpassword = 'fatimaspassword';
        $dbdatabase = 'fatimamt_userform';
        
        $mysqli = new mysqli($dbhostname, $dbusername, $dbpassword, $dbdatabase);
        
        if ($mysqli->connect_errno) {
            echo "<p>MySQL Error" .$mysqli->error;
        }else{
            echo 'database connection success!';
        }
        
        $firstname = $mysqli->real_escape_string($firstname);
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $query = "INSERT INTO `account` (`accountid`, `username`, `password`, `firstname`, `lastname`, `email`) VALUES (NULL, '$username', '$password', '$firstname', '$lastname', '$email')";
            
        if ($mysqli->query($query)) {
            echo 'Insert data sucess!';
        }else{
            echo "<p>Insert Error".$mysqli->error . "</p>";
        }
    }
    ?>
    
    <form id="grid-container" method="post">
        <h1 id="item1">Sign up to Fatima's form:</h1>
        <p id="item2">Username</p><input id="item3" type="text" name="username">
        <p id="item4">Password</p><input id="item5" type="password" name="password">
        <p id="item6">First Name</p><input id="item7" type="text" name="firstname">
        <p id="item8">Last Name</p><input id="item9" type="text" name="lastname">
        <p id="item10">Email</p><input id="item11" type="text" name="email">
        <input id="signupbutton" type="submit" name="signup" value="Sign Up">        
    </form> 
    
</body>
</html>
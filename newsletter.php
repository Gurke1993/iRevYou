<!--
This code is written by Moritz Pfeiffer
All rights reserved.
Do not distribute.
-->

<html> 

<head> 

<title>Register</title> 
</head> 

<body> 


<?php 

//Load config
$ini = parse_ini_file("config/irevyou.ini.php");

// Connect to database. Do not publish credentials!
try {
	$user = $ini['db_newsletter_username'];
	$pass = $ini['db_newsletter_password'];
	$name = $ini['db_newsletter_dbname'];
    $dbh = new PDO('mysql:host=localhost;dbname='.$name, $user, $pass);
	$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//Write new mail into database
	$address = $_GET["address"]; 
	$preparedStatement = $dbh->prepare('INSERT INTO `NEWS_APPLICANT` (`EMAIL_ADDRESS`) VALUES ( :address)');
	$preparedStatement->execute(array('address' => $address));
    $dbh = null;
	echo 	"<b>You successfully registered\"<u>$address</u>\" for the IRevYou-Newsletter!</b><br /><br />", 
			"<a href='http://www.irevyou.com'>Back!</a>"; 
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}        
?>  



</body>
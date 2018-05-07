<html>
<head>
  <meta content="text/html; charset=ISO-8859-1"  http-equiv="content-type">
  <title>Verwijderen van een opdracht</title>
  <link rel="stylesheet" type="text/css"  href="default.css">
</head>
<body>


<?php
$conn=mysqli_connect('127.0.0.1', 'pi', NULL, 'baaskarrendb') or die (mysql_error());



$Opdracht =$_GET["ID"];
// echo $Opdracht;
//$result = mysql_query("SELECT orderid FROM opdrachten WHERE orderid='".$DB_line."' ");
$conn->query("DELETE FROM opdrachten WHERE orderid='".$Opdracht."'");

?>
  <script type="text/javascript">
   alert("Opdracht verwijderd");
   // history.back();
  </script>
<?php 
 header('Refresh: 0; url=overview.php');
 
 
 
    
//}

//else {
//   	
//	global $MeldingDelete;
//	echo $MeldingDelete;
//	header('Refresh: 0; url=overview.php');
//}
?>
<html>
<head>
  <meta content="text/html; charset=ISO-8859-1"  http-equiv="content-type">
  <title>Verwijderen van een opdracht</title>
  <link rel="stylesheet" type="text/css"  href="default.css">
</head>
<body>


<?php
/*
 * @script: DelOpdracht.php
 * @description: delete all data from DB
 * @modified: 9-5-2018
 * @history:
 * 			09-05-2018 add table opdrachten_norm for delete of data
 * 			30-04-2018 change sql to mysqli_connect
 *
 */

$conn=mysqli_connect('127.0.0.1', 'pi', NULL, 'baaskarrendb') or die (mysql_error());

$Opdracht =$_GET["ID"];
// echo $Opdracht;
//$result = mysql_query("SELECT orderid FROM opdrachten WHERE orderid='".$DB_line."' ");
$conn->query("DELETE FROM opdrachten WHERE orderid='".$Opdracht."'");
$conn->query("delete from opdrachten_norm where oridid='".$Opdracht."'");
$conn->close();
?>
  <script type="text/javascript">
   alert("Opdracht verwijderd");
   // history.back();
  </script>
<?php 
 header('Refresh: 0; url=overview.php');

?>
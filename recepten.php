<html>
    <head>
          <meta content="text/html; charset=ISO-8859-1"  http-equiv="content-type">
          <title>Recepten</title>
          <link rel="stylesheet" type="text/css" href="default.css">
          <form method="post" action="aanpassen.php">
    </head>
<body>

<div style="text-align: center;"><img
 style="width: 125px; height: 12tpx;" alt="Raspberrypi"
 src="baaslogo.jpg"></div>
<br>

<table style="text-align:left; margin-left:auto; margin-right:auto;">
<form method="post" action="submit.php">


<?php
$conn=mysqli_connect('127.0.0.1', 'pi',NULL, 'baaskarrendb') or die (mysql_error());
//$conn->mysql_select_db('baaskarrendb') or die (mysql_error());

$result = $conn->query("SELECT * from Recepten");

//text-align:left; margin-left:auto; margin-right:auto;
echo " <table style= text-align:left; margin-left:'auto'; margin-right:'auto';' border='2' cellpadding='10' cellspacing='1'>";
echo "<tr><td style='text-align: left;'  rowspan='1''><a href='index.php'>home</a></td>"; // home knop 
echo "<tr>
<th align='center'>Bewerking</th>

<th>Recept Naam</th>
</tr>";

while($row = $result->fetch_array()){
   echo "<tr>";
   //echo "recept id ", $row['ReceptID']; 
   echo "<td><input type='submit' name='Receptladen".$row['ReceptID']."' value='Recept laden'/>";
   echo "<input type='submit' name='Receptverwijderen".$row['ReceptID']."' value='Verwijderen'/>";
   echo " <td>" . $row['ReceptNaam'] . " </td> "; 
    
}
    






?>

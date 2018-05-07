<html>
<head>
  <meta content="text/html; charset=ISO-8859-1"  http-equiv="content-type">
  <title>Opdrachten bekijken</title>
  <link rel="stylesheet" type="text/css" href="default.css">
  <form method="post" action="aanpassen.php">
  
    
</head>
<body>

<div style="text-align: center;"><img
 style="width: 125px; height: 12tpx;" alt="Raspberrypi"
 src="baaslogo.jpg"></div>
<br>


<?php
//Connect to MySQL
$conn=mysqli_connect('127.0.0.1', 'pi',NULL, 'baaskarrendb') or die (mysql_error());
//Select database
//mysql_select_db('baaskarrendb') or die (mysql_error());
$result = $conn->query("SELECT * from opdrachten");
//Table starting tag and header cells
echo " <table style='width: 100%; text-align:left; margin-left:'10'; margin-right:'1';' border='1' cellpadding='10' cellspacing='1'>
<tr>
<th align='center'>Bewerking</th>
<th colspan='2' align='center'>Volgorde "; echo " <input type='submit' name='VolgordeOpslaan".$row['orderid']."' value='Opslaan'/>  "; echo"</th>
<th align='center'>Status</th>
<th>Opdracht commentaar</th>
<th>Order Nummer</th>
<th>Verwerkt</th>
<th>Aantal karren</th>
<th>Label gebruik</th>
</tr>";



while($row = $result->fetch_array()){
   //Display the results in different cells
   	if ($row['status'] == 1) 
			{
			 $orderstatus="<p style=color:Grey;>Is klaar</p>";
			} 
	elseif ($row['status'] == 2) 
			{
			 	$orderstatus="<p style=color:Green;>Is bezig</p>";
               //echo "<td> hallo verweken </tf>";
			}
	elseif ($row['status'] == 3)
			{	
				$orderstatus="<p style=color:Orange;>Nog te doen</p>";
			}
    elseif ($row['status'] == 4)
			{	
				$orderstatus="<p style=color:red;>Prioriteit</p>"; //<p style="color: red; font-size:60pt; text-align: center"> Geen opdrachten </p>
			}
    elseif ($row['status'] == 5) // opdracht pauzeren
			{	
				$orderstatus="<p style=color:blue;>Gepauzeerd</p>"; //<p style="color: red; font-size:60pt; text-align: center"> Geen opdrachten </p>
			}
    
    
    if ($row['label'] == 1) 
			{
			 $labelstat="<p style=color:red;>CC-RFID</p>";
			} 
            
   elseif($row['label'] == 0)
	         {
			 $labelstat="<p style=color:black;>DC</p>";
            }
    elseif($row['label'] == 2)
	         {
			 $labelstat="<p style=color:gray;>EC</p>";
            }
   
   
   
   //echo "".$row['orderid'].""; 
   echo "<tr>";
	//echo "<td> <a href=aanpassen.php?ID=".$row['orderid']."> ".$row['orderid']. "</a></td>"; 
    //echo "<td><select name='Bewerking'>"; 
    //echo " <option value ='1'>Start</option>"; 
    //echo " <option value ='2'>Pauze</option>"; 
    //echo " <option value ='3'>Klaar</option></select>";
    echo "<td><input type='submit' name='Start".$row['orderid']."' value='Start'/>";
    echo "<input type='submit' name='Pauze".$row['orderid']."' value='Pauze'/>";
    echo "<input type='submit' name='Klaar".$row['orderid']."' value='Klaar'/>";
    echo "<input type='submit' name='Verwijderen".$row['orderid']."' value='Verwijderen'/>";
    echo "<input type='submit' name='Bewerken".$row['orderid']."' value='Bewerken'/></td>";
    echo "<td>".$row['volgorder']."</td> "; 
    echo "<td> <input name='NieuweVolgorde".$row['orderid']."' size='2'></td>"; //value=".$volgorder.">
    //&nbsp;&nbsp;&nbsp;<input type='submit' name='VolgordeOpslaan".$row['orderid']."' value='Opslaan'/>  // opslaan achter het invoerveld
    
    
    //echo " <a href=aanpassen.php?ID=".$row['orderid']."?Bewerking=".$row['orderid'].">updaten </a></td>";
    //echo " <td><input name=".$row['volgorder']."></td>"; 
    echo " <td>" . $orderstatus. "</td> "; 
    echo " <td>" . $row['OpdrComm'] . " </td> "; 
    echo " <td>" . $row['klantorder'] . " </td>";
    echo " <td>" . $row['verwerkt'] . " </td> "; 
    echo " <td>" . $row['orderaantal'] . "</td>"; 
    echo " <td>" .$labelstat. " </td> ";
    echo " </tr>";
        
     $count = ++$count;
}
//echo "aantal keer doorlopen", $count;
//Table closing tag
echo "</table>";

//print $count; 
$meldinglegendb = "raadzaam om de database te legen!!";
if ($count >= 40) { //resetten van de autoincrement
?>
  <script type="text/javascript">
    window.alert("Het wordt tijd om de database te legen.");
    
  //  history.back();
  </script>
<?php 


  //global $meldinglegendb;
  //echo $meldinglegendb; 
    
}



$a="hallo gebruiker";

function hello()
{
 global $a;
 echo $a;
 }



?>

<script>
function test() 
{
 alert("<?php hello(); ?>");
}
</script>
<!--<button onclick="test()">zeg hallo tegen mij</button>-->

<!-- hieronder een stukje toegevoegd om de website om de 10 seconden te herladen-->
<meta http-equiv="refresh" content="10" > 

<br />
<tr>
<td> <a href="index.php">&nbsp;Terug&nbsp; </a> </td>
<td style="text-align: left;" colspan="1" rowspan="1"><a href="DelOldDB.php">&nbsp;Delete verwerkte opdrachten &nbsp; </a></td>
<td style="text-align: left;" colspan="1" rowspan="1"><a href="DeleteDB.php">&nbsp;Database leegmaken &nbsp; </a> </td>
<td style="text-align: left;" colspan="1" rowspan="1"><a href="view.php">&nbsp;TV weergave &nbsp;</a></td>
<tr>

</form>
</td>
</tr>


</tr>
</body>
</html>



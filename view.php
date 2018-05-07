<html>
<head>
  <meta content="text/html; charset=ISO-8859-1"  http-equiv="content-type">
  <title>Weergave op tv</title>
  <link rel="stylesheet" type="text/css"  href="default.css">
</head>
<body>
<div style="text-align: center;"><img
 style="width: 125px; height: 12tpx;" alt="Raspberrypi"
 src="baaslogo.jpg"></div>
<br>


<?php
//Connect to MySQL

// voor uitlezen gpio
//require 'vendor/autoload.php';
//require_once 'src/autoload.php';

$verbinding = mysqli_connect('127.0.0.1', 'pi',NULL, 'baaskarrendb') or die (mysqli_error());
if ($verbinding == False) // geen verbinding 
{
	echo "kan geen verbinding met de database maken"; 
} 






//Select database
//mysql_select_db('baaskarrendb') or die (mysql_error());

// alles selecteren waar status x is 
$result = $verbinding->query("SELECT * from opdrachten WHERE status='2' ORDER BY volgorder LIMIT 1 "); //
// het order id ophalen om vervolgens het commentaar uit de volgende db te halen. 
$opdrachtID = $verbinding->query("SELECT orderid FROM opdrachten WHERE status='2'  LIMIT 1")->fetch_array();
// casten van string naar int. 
$opdrachtint =(int)$opdrachtID['orderid'];
 
$minuten = date("i");
//echo $minuten;

// alle kleuren selecteren en omzetten naar een array. 
    $resultKleur =$verbinding->query("SELECT * FROM Kleuren ");
    $aantal_rijen_in_DB = $resultKleur->num_rows;
    for ($i =1 ; $i <$aantal_rijen_in_DB +1; $i++ )
    {
       $resultaat[$i] = $verbinding->query("SELECT * FROM Kleuren WHERE KleurID ='".$i."' ");
       $fetch_result[$i]= $resultaat[$i]->fetch_array();
       //$Kleuren1[$i] = $fetch_result[$i]['kleur1'];
      // $Kleuren2[$i] = $fetch_result[$i]['kleur2'];
       $KleurNaam[$i] = $fetch_result[$i]['KleurNaam'];
       $KleurNaamB[$i] = $fetch_result[$i]['KleurNaam'];
       
    }


// alle Producten selecteren en omzetten naar een array. 
    $resultproduct =$verbinding->query("SELECT * FROM Producten ");
    $aantal_rijen_in_DB = $resultproduct->num_rows;
    for ($i =1 ; $i <$aantal_rijen_in_DB +1; $i++ )
    {
       $resultaat[$i] = $verbinding->query("SELECT * FROM Producten WHERE ProductID ='".$i."' ");
       $fetch_result[$i]= $resultaat[$i]->fetch_array();
       $ProductNaam[$i] = $fetch_result[$i]['ProductNaam'];
       $ProductNaamB[$i] = $fetch_result[$i]['ProductNaam'];
    }






while($row = $result->fetch_array())
{ 
    if ($row['label'] == 0) 
			{
			 $labelstatus="<p style=color:red;>DC</p>";
			} 
            
   elseif($row['label'] == 1)
	         {
			 $labelstatus="<p style=color:black;>CC-RFID</p>";
            }
    elseif($row['label'] == 2)
	         {
			 $labelstatus="<p style=color:gray;>EC</p>";
            }
    
    
    
 // 15-03-13 bijgemaakt voor het gemiddelde van het aantal karren in het uur.   
    //echo $opdrachtint =(int)$row['orderid'] ; 
  
    $KarrenVerwerkt = (int)$row['verwerkt'];
    $vorigGemiddelde= (int)$row['gemiddelde']; 
    $runonce = (int)$row['runonce']; 
    $vorigaantalkarren = (int)$row['prevkarren'];
    if (($minuten == 0) || ($minuten == 6)|| ($minuten == 12)||($minuten == 18)||($minuten == 24)||($minuten == 30)|| ($minuten == 36)|| ($minuten == 42) || ($minuten ==48 )||($minuten == 54)) 
    {
        if ($runonce ==0) 
        {
			if ($vorigaantalkarren >=1)
			{ 
				$gemiddelde = (( $KarrenVerwerkt- $vorigaantalkarren)*10);
			}
            else 
			{
				$gemiddelde =  ($KarrenVerwerkt*10);
			}
		 $runonce=1;
         $verbinding->query("UPDATE opdrachten SET prevkarren='".$KarrenVerwerkt."', gemiddelde='".$gemiddelde."',runonce='".$runonce."'  WHERE orderid='".$row['orderid']."' ");   
         //echo $gemiddelde; 
         }
    }
    else{
        $runonce =0; 
         $verbinding->query("UPDATE opdrachten SET runonce='".$runonce."' WHERE orderid='".$row['orderid']."' ");   
        //print ("komt hier");
    }
        
    $timestamp= date("H:i"); 
 

echo"<table style='width: 100%; font-size:30pt; text-align:left' margin-left=1 margin-right=1 cellpadding=4 cellspacing='5' >";

 echo "
     <tr><td colspan=2>Klant Order " .$row['klantorder']." </td ><td>".$timestamp." </td></tr>
     <tr><td colspan=2>".$row['OpdrComm']." </td><td>".$labelstatus."</td></tr>
     <tr bgcolor='#dcdcdc'><td>Lg</td> <td>St</td> <td colspan=2 ><center>Artikel</center></td> <td colspan=2><center>Kleur</center></td> ";  
     
  $opdrachtint =(int)$row['orderid'];
   
for($i=11; $i >=1; $i--)
   {
    echo "<tr><td >".$i."</td > <td> ".$row["VullenLaag".$i.""]." </td > "; 
    for ($l=1; $l<=count($ProductNaam); $l++)// productnaam doorlopen totdat er een match is 
    { 
        if ($l == $row['ProductLaag'.$i.''] )
        {
            
            echo "<td>".$ProductNaam[$l]."</td>";
        } 
        
     }

     for ($l=1; $l<=count($ProductNaam); $l++)// productnaam doorlopen totdat er een match is
     {
     	if ($l == $row['ProductLaag'.$i.'B'] )
     	{
     
     		echo "<td>".$ProductNaamB[$l]."</td>";
     	}
     
     }     
     
     for ($k=1; $k<=count($KleurNaam); $k++)
            {
                if ($k == $row['KleurLaag'.$i.''] )
                {
                    echo "<td class='Kleur".$k."';>".$KleurNaam[$k]."</td>";
                }
            }
            for ($k=1; $k<=count($KleurNaam); $k++)
            {
            	if ($k == $row['KleurLaag'.$i.'B'] )
            	{
            		echo "<td class='Kleur".$k."';>".$KleurNaamB[$k]."</td>";
            	}
            }   
    
    echo "</tr>";
}
echo "<tr><td colspan=4>".$row['gemiddelde']." karren per uur </td></tr>";
echo "<tr><td colspan=4><strong>".$intVerwerkt = (int)$row['verwerkt']."</strong> van de <strong> " .$intAantal=(int)$row['orderaantal']."</strong>verwerkt </td></tr>";
  
    
}
echo "</table>";


if ($opdrachtint == 0)
{
   echo '<p style="color: red; font-size:60pt; text-align: center"> Geen opdrachten </p>';
}

?>

<!-- hieronder een stukje toegevoegd om de website om de 5 seconden te herladen-->
<meta http-equiv="refresh" content="5" >  
<br>
<a href="index.php">Terug</a>

</body>
</html>


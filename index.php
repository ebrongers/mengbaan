<html>
<head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
<title>Opdrachten toevoegen</title>
<link rel="stylesheet" type="text/css" href="default.css">
</head>
<body>
<br>
<div style="text-align: center;"><img style=" height: 200px;" alt="Rpi" src="baaslogo.jpg"><br></div>
<br>




<!--begin tabel -->
<form method="post" action="submit.php">
<table style="text-align:left; margin-left:auto; margin-right:auto;">

<tbody>

<?php 
/*
 * @script: index.php
 * @description: laat scherm zien met invoer mogelijkheden.
 * @modified: 9-5-2018
 * @history:
 * 			09-05-2018 	add table opdrachten_norm for delete of data. vrije invoervelden.
 * 			30-04-2018 	2e product op een plaat mogelijk gemaakt
 * 						mysql_select_db overgezet naar mysqli_connect
 *
 */
$verbinding = mysqli_connect('127.0.0.1', 'pi',NULL,'baaskarrendb') or die (mysqli_error($verbinding));
//mysql_select_db('baaskarrendb') or die (mysql_error());
    if ($verbinding == false) // geen verbinding 
    {
    	echo "kan geen verbinding met de database maken"; 
    } 
$station[0] ="nog niet toegewezen"; 
$station[1] ="Station 1";
$station[2] ="Station 2";
$station[3] ="Station 3";
$station[4] ="Station 4";
$station[5] ="Station 5";
$station[6] ="Station 6";
$station[7] ="Station 7";
$station[8] ="Station 8";
$station[9] ="Station 9";
$station[10] ="Station 10";
$station[11] ="Station 11";

$labelgebruik[0]= "DC"; 
$labelgebruik[1]= "CC-RFID";
$labelgebruik[2]= "EC";


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

    }


// alle Producten selecteren en omzetten naar een array. 
    $resultproduct =$verbinding->query("SELECT * FROM Producten ");
    $aantal_rijen_in_DB =$resultproduct->num_rows;
    for ($i =1 ; $i <$aantal_rijen_in_DB +1; $i++ )
    {
       $resultaat[$i] = $verbinding->query("SELECT * FROM Producten WHERE ProductID ='".$i."' ");
       $fetch_result[$i]= $resultaat[$i]->fetch_array();
       $ProductNaam[$i] = $fetch_result[$i]['ProductNaam'];
    }
 
$Opdracht =$_GET["ID"];

if (($Opdracht >= 1) and ($Opdracht <= 1000)) 
{   //echo "komt in opdracht";
    $recept = false;
    $Gegevensladen =  true;
    $bewerking=1; 
    $ResultOpdracht = $verbinding->query("SELECT * from opdrachten WHERE orderid='".$Opdracht."'");
    $row = $ResultOpdracht->fetch_array();
    $Klantorder=(int)$row['klantorder'];
}
elseif ( $Opdracht >=1001){ // recepten laden
    //echo"komt in recept";
    $Gegevensladen = true;
    $recept = true;
    $Opdracht = $Opdracht-1000;
    $ResultOpdracht = $verbinding->query("SELECT * from Recepten WHERE ReceptID='".$Opdracht."'");
    $row = $ResultOpdracht->fetch_array();



    //$Klantorder=(int)$row['klantorder'];
}

else
{
    $Gegevensladen = false; 
    $bewerking=3; 
    $UpdateKleur = false; 
    $recept = false;   
}

echo "<tr>";
 echo "<td><input type='hidden' name='DB_Line' value='".$Opdracht."'></td>";

if (($Gegevensladen == true) or ($recept == true)) {
    echo "<tr><td style='text-align: left;'  rowspan='1''><a href='index.php'>home</a></td>"; // home knop
    if (($Gegevensladen == true) and ($recept == false))
    {
    echo "<td colspan='2'><H2> Opdracht bewerken </H2></td></tr>";
    }
    else {
      echo "<td colspan='2'><H2> Recept Laden</H2> </td></tr>";
    }
}



echo "<tr><td></td><td><b>Order Nummer</b> <br> <td><b>Klant</b></td> </tr>\r\n";

echo "<tr><td></td>"; 
echo "<td><input name='OrderNr' value='".$row['klantorder']."'  size='18'><br>"; // hier het laden van een waarde. 
echo "<td><input name='KlantCommentaar' value='".$row['OpdrComm']."' size='14'></td>";
if ($Gegevensladen == false)
{
  echo "<td><input type='submit' name='Recepten' value='Recept selecteren'/></td>";   
}

echo "</td></tr>";

echo "<tr><td>Label</td>";
echo "<td><select name='Label'>";
for ($j=0; $j<=(count($labelgebruik)-1); $j++) 
    {   
        if ($row['label'] == $j )
        { 
            echo "<option selected value=".$j.">".$labelgebruik[$j]." </option>";
        }
                
        else 
        {  
            echo "<option value=".$j.">".$labelgebruik[$j]." </option>";
        }
                 
    }

echo "</select><br></td></tr>"; 


///////////////////////////////////////////////////////////////////////////////////BEGIN TABEL//////////////////////////

echo "<tr> </tr><td></td><td colspan='2'>Product</td><td colspan='2'>Kleur</td> <td>Station</td></tr>\r\n"; 
//Projecteren van het tabel laag 1 tm 11
echo "<tr>";
for ($j=11; $j >=1; $j--)
{   
// het printen van de laag met nummer x en hierbij de juiste kleur
    if(  $Gegevensladen == true ){
        for ($a=1; $a<=count($KleurNaam); $a++){
            if ($a == $row['KleurLaag'.$j.''] ){
                echo "<td><div class='Kleur".$a."'>Laag".$j." </div></td>\r\n";
            }
        }
    } 
    else {
        echo "<td>Laag".$j." </td>\r\n";
    }
    
    echo "<td><select name='ProductNaam[]' >\r\n"; 
    
    for ($l=1; $l<=count($ProductNaam); $l++) // dropdown menu opmaken 
    {
        if (($Gegevensladen==true) and ($l == $row['ProductLaag'.$j.''] ))
        {
           echo "<option selected value=".$l.">".$ProductNaam[$l]."</option>\r\n"; 
        }
        else 
        {
            echo "<option value=".$l.">".$ProductNaam[$l]."</option>\r\n";
        }
       
    }
    echo "</select>";
    // toevoeging van "anders" overschrijft de selectie als deze is ingevuld
    ?>
    <input name="anders_productnaam[]" placeholder="anders"  style="width:100px" />
    <?php 
   	echo "</td>\r\n";
   	
   	echo "<td><select name='ProductNaamB[]' >\r\n";
   	
   	for ($l=1; $l<=count($ProductNaam); $l++) // dropdown menu opmaken
   	{
   		if (($Gegevensladen==true) and ($l == $row['ProductLaagB'.$j.''] ))
   		{
   			echo "<option selected value=".$l.">".$ProductNaam[$l]."</option>\r\n";
   		}
   		else
   		{
   			echo "<option value=".$l.">".$ProductNaam[$l]."</option>\r\n";
   		}
   		 
   	}
   	echo "</select>";
   	// toevoeging van "anders" overschrijft de selectie als deze is ingevuld
   	?>
   	    <input name="anders_productnaamB[]" placeholder="anders"  style="width:100px" />
   	    <?php    	
   	echo "</td>\r\n";   	
   	
    echo "<td><select name='KleurID[]' onchange='updateText()'>\r\n"; 
    for ($i=1; $i<=count($KleurNaam); $i++)
    {
        if (($Gegevensladen==true) and ($i == $row['KleurLaag'.$j.''] ))
        {
            echo "<option class='Kleur".$i."' selected value=".$i.">".$KleurNaam[$i]."</option>\r\n"; 
        }
        else {
           echo "<option class='Kleur".$i."' value=".$i.">".$KleurNaam[$i]."</option>\r\n";  
        }
      
    }
  

 	echo "</select>";
 	// toevoeging van "anders" overschrijft de selectie als deze is ingevuld
 	?>
 	    <input name="anders_kleur[]" placeholder="anders" style="width:100px" />
 	    <?php   
 	echo "<td><select name='KleurIDB[]' onchange='updateText()'>\r\n";
 	for ($i=1; $i<=count($KleurNaam); $i++)
 	{
 		if (($Gegevensladen==true) and ($i == $row['KleurLaag'.$j.''] ))
 		{
 			echo "<option class='Kleur".$i."' selected value=".$i.">".$KleurNaam[$i]."</option>\r\n";
 		}
 		else {
 			echo "<option class='Kleur".$i."' value=".$i.">".$KleurNaam[$i]."</option>\r\n";
 		}
 	
 	}
 	
 	
 	echo "</select>";  
 	// toevoeging van "anders" overschrijft de selectie als deze is ingevuld
 	?>
 	    <input name="anders_kleurB[]" placeholder="anders" style="width:100px" />
 	    <?php  	
 	
// hier de stations toevoeging
     echo "<td><select name='Station[]'>"; 
     //echo "<option value =2 >".$station[1]."</option>";
     
     for ($k=0; $k<count($station); $k++)  
     {    
        if (($Gegevensladen==true) and ($k == $row['VullenLaag'.$j.''] ))
        {
            echo "<option selected value =".$k.">".$station[$k]."</option>";  
        }
        elseif (($k==0 ) and ($Gegevensladen==false))
        {
            echo "<option selected value ='0'>".$station[0]."</option>";  
        }
        else 
        {
            echo "<option value =".$k.">".$station[$k]."</option>\r\n";
        } 
     } 
     echo "</select>";
    echo "</td>";
    echo "</tr>";
   
   //echo "<option selected value ='1'>$bewerkingstekst[1] </option>";
   
}
$status ="3"; 

echo "<tr><td>Aantal karren </td><td><input name='orderaantal' value='".$row['orderaantal']."' size='18'><br>"; 
    echo "<td align='right'><input type='submit' name='Toevoegen' value='Toevoegen'/></td>";


if (($Gegevensladen==true) and ($recept == false)) // alleen gegevens 
{
   echo "<td align='right'><input type='submit' name='Updaten' value='Opslaan'/></td>";
}
elseif  (($Gegevensladen==true) and ($recept == true)) // alleen recept
{
    echo "<tr><td>Recept Naam </td><td><input name='ReceptNaam' value='".$row['ReceptNaam']."' size='18'><br>";
    echo "<td align='right'><input type='submit' name='ReceptOpslaan' value='Recept Opslaan'/></td>"; 
} 
else
{   
    echo "<tr><td>Recept Naam </td><td><input name='ReceptNaam' size='18'><br>"; 
    echo "<td align='right'><input type='submit' name='ReceptToevoegen' value='Recept toevoegen'/></td>";
}
   

?>

</tr>

<tr>
<td style="text-align: left;" colspan="2" rowspan="1"><a href="overview.php">Opdrachten bekijken</a></td>
<td style="text-align: left;" colspan="2" rowspan="1"><a href="view.php">TV weergave</a></td>

</tr>
</tbody>

</table>
</form>

<br>
</body>
</html>
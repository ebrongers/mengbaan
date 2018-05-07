<html>
<head>
<meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
<title>Opdrachten toevoegen</title>
<link rel="stylesheet" type="text/css" href="default.css">
</head>
<body>
<br>
<!--<div style="text-align: center;"><img style="width: 200px; height: 200px;" alt="Rpi" src="baaslogo.jpg"><br></div>-->
<br>

<table style="text-align: left; margin-left: auto; margin-right: auto;">
<form method="post" action="submit.php">
<form method="post" action="DelOpdracht.php"
<tbody>

<?php
/**
 * @author jeroen 
 * @copyright 2013
 */
$conn=mysqli_connect('127.0.0.1', 'pi', NULL, 'baaskarrendb') or die (mysql_error());
//mysql_select_db('baaskarrendb') or die (mysql_error());
 
// $test1 =$_GET["ID"];
// echo $test1;
 
//$DB_line =(int)$_GET["ID"];


// hier kijken of dit id wel overeen komt in de database. 
//$result = mysql_query("SELECT orderid FROM opdrachten WHERE orderid='".$DB_line."' ");


//$allresult = mysql_query("SELECT * from opdrachten WHERE orderid='".$DB_line."' ");
//$row = mysql_fetch_array($allresult);

//echo $row['klantorder'];


// ophalen hoeveel resultaten er zijn in de database. 
$resultlines =$conn->query("SELECT * FROM opdrachten ");
$aantal_rijen_in_DB = $resultlines->num_rows;
echo "zoveel rijen zjjn er in de database",$aantal_rijen_in_DB ;
$resultlinesmax =$conn->query("SELECT MAX(orderid) As max FROM opdrachten");
$resultlinesmin =$conn->query("SELECT MIN(orderid) As min FROM opdrachten");
$rowmax = $resultlinesmax->fetch_array();
$rowmin = $resultlinesmin->fetch_array();
$hoogsteIDinDB=(int)$rowmax['max']; 
$laagsteIDinDB=(int)$rowmin['min']; 

$receptmax     = $conn->query("SELECT MAX(ReceptID) As max FROM Recepten");
$receptmin     = $conn->query("SELECT MIN(ReceptID) As min FROM Recepten");
$rowreceptmax  = $receptmax->fetch_array();
$rowreceptmin  = $receptmin->fetch_array();
$receptmaxinDB = (int)$rowreceptmax['max']; 
$recetpmininDB = (int)$rowreceptmin['min']; 


if ($receptmaxinDB >=$hoogsteIDinDB )
{
   $tellentot= $receptmaxinDB;
}
else {
    $tellentot=$hoogsteIDinDB;
}

if ($recetpmininDB <=$laagsteIDinDB ){
    $tellenvanaf=$recetpmininDB;
}
else {
    $tellenvanaf=$laagsteIDinDB;
}


for ($i=$tellenvanaf; $i<=$tellentot; $i++ )
{   
// het starten van een opdracht 
    $compare ="Start".$i.""; 
    //echo $compare; 
    if (isset($_POST["Start".$i.""])) 
    {
        $conn->query("UPDATE opdrachten SET status='2' WHERE orderid='".$i."' ");
        header('Refresh: 0; url=overview.php');
    }
// Het pauzeren van een opdracht. 
    elseif (isset($_POST["Pauze".$i.""])) 
    {
       $conn->query("UPDATE opdrachten SET status='3' WHERE orderid='".$i."' ");
       header('Refresh: 0; url=overview.php');
    }
// Het stoppen / gereed maken van een opdracht. 
    elseif (isset($_POST["Klaar".$i.""])) 
    {
       $conn->query("UPDATE opdrachten SET status='1' WHERE orderid='".$i."' ");
       header('Refresh: 0; url=overview.php');
    }

// Het verwijderen van een opdracht
    elseif (isset($_POST["Verwijderen".$i.""])) 
    {
       //echo " Verwijderen-button " , $i,"is gedrukt";
       $DB_line = $i;
       header('Refresh: 0; url=DelOpdracht.php?ID='.$DB_line );
       //header('Refresh: 0; url=overview.php');
    }
// Het aanpassen van een opdracht. 
    elseif (isset($_POST["Bewerken".$i.""])) 
    {
       //echo " Bewerken-button " , $i,"is gedrukt";
       $DB_line = $i;
       header('Refresh: 0; url=index.php?ID='.$DB_line );
    }
    
// voor het laden van de recepten. 
elseif (isset($_POST["Receptladen".$i.""])) 
    {
       //echo " recept laden" , $i,"is gedrukt";
       $DB_line = $i+1000;
       header('Refresh: 0; url=index.php?ID='.$DB_line );
    }    
    
elseif (isset($_POST["Receptverwijderen".$i.""])) 
    {
       //echo " recept verwijderen" , $i,"is gedrukt";
       //$DB_line = $i+1000;
       //header('Refresh: 0; url=index.php?ID='.$DB_line );
       $conn->query("DELETE FROM Recepten WHERE ReceptID='".$i."'");
       ?>
          <script type="text/javascript">
            alert("Recept verwijderd");
            //history.back();
          </script>
        <?php
        header('Refresh: 0; url=recepten.php');
       
       
    }     
    
    
    
    
    
    elseif (isset($_POST["VolgordeOpslaan"]))  
    {
      for ($j=$laagsteIDinDB; $j<=$hoogsteIDinDB; $j++ )
      {
        $NieuweVolgorde=$_REQUEST["NieuweVolgorde".$j.""];
        if (!$NieuweVolgorde == NULL){
            $conn->query("UPDATE opdrachten SET volgorder='".$NieuweVolgorde."' WHERE orderid='".$j."' ");
        }
        
      } 
      header('Refresh: 0; url=overview.php');
      break; 
    } 
            
}
        
# status 1 = verwerkt
# status 2 = bezig met verwerken. 
# status 3 = nog te verwerken. 
# status 4 = prioriteit 
    
    

// header('Refresh: 0; url=overview.php');
//echo "database line gedrukt is ", $DB_line;

//<option value="1" selected='selected'>Standard</option>

  
?>

<!--<tr>
<td>status</td>
//<td>
//<select name="status"><option>0</option><option>1</option><option>2</option></select>
//<br>
</td>
</tr>
<tr>
<td>Database regel</td>
<td><input name="DatabaseRegel" value="<?= $DB_line ?>">  <br>
</td>
</tr>


<tr>
<td>Order Nummer</td>
<td><input name="OrderNr" value="<?= $row['klantorder'] ?>">  <br>
<td><input name="OpdrComm" value="<?= $row['OpdrComm'] ?>">  <br>
</td>
</tr>




<style type="text/css">
.css3gradient{width:418px;height:100px;
 background-color:#e61c36;
 filter:progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr=#e61c36, endColorstr=#181c1f);
 background-image:-moz-linear-gradient(right top, #e61c36 23%, #181c1f 100%);
 background-image:-webkit-linear-gradient(right top, #e61c36 23%, #181c1f 100%);
 background-image:-ms-linear-gradient(right top, #e61c36 23%, #181c1f 100%);
 background-image:linear-gradient(right top, #e61c36 23%, #181c1f 100%);
 background-image:-o-linear-gradient(right top, #e61c36 23%, #181c1f 100%);
 background-image:-webkit-gradient(linear, right top, left bottom, color-stop(23%,#e61c36), color-stop(100%,#181c1f));}

.css3gradient2{width:418px;height:100px;
 background-color:#24292b;
 filter:progid:DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr=#24292b, endColorstr=#052afc);
 background-image:-moz-linear-gradient(left bottom, #24292b 0%, #052afc 100%);
 background-image:-webkit-linear-gradient(left bottom, #24292b 0%, #052afc 100%);
 background-image:-ms-linear-gradient(left bottom, #24292b 0%, #052afc 100%);
 background-image:linear-gradient(left bottom, #24292b 0%, #052afc 100%);
 background-image:-o-linear-gradient(left bottom, #24292b 0%, #052afc 100%);
 background-image:-webkit-gradient(linear, left bottom, right top, color-stop(0%,#24292b), color-stop(100%,#052afc));}
</style>

<div class="css3gradient"><b>Het resultaat van het faden</b></div>
<div class="css3gradient2"><b>Het resultaat van het faden2</b></div>
-->

<?


?>





</form>
</table>
<br>
</body>
</html>



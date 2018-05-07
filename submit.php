<html>
<head>
  <meta content="text/html; charset=ISO-8859-1"  http-equiv="content-type">
  <title>Opdrachten toegevoegd</title>
  <link rel="stylesheet" type="text/css"  href="default.css">
</head>
<body>
<?php
//the example of inserting data with variable from HTML form
//input.php
$verbinding=mysqli_connect('127.0.0.1', 'pi',NULL, 'baaskarrendb') or die (mysql_error());
#mysql_select_db('baaskarrendb') or die (mysql_error());


$status = 3; //$_REQUEST['status'];

$opdrcomm= $_REQUEST ['KlantCommentaar'];
$verwerkt =0;
$label = $_REQUEST['Label'];
$ordernr= $_REQUEST['OrderNr'];
$DB_line= $_REQUEST['DB_Line'];

$i =1;
foreach($_REQUEST['KleurID'] as $key => $KleurID[$i]) 
    { //echo $KleurID[$i];
        $i++;
    }
    
$i =1;
foreach($_REQUEST['KleurIDB'] as $key => $KleurIDB[$i])
    { //echo $KleurID[$i];
    $i++;
    }
        
$j =1;
foreach($_REQUEST['ProductNaam'] as $key => $ProductNaam[$j]) 
    { //echo $ProductNaam[$j];
        $j++;
    }
    
$j =1;
foreach($_REQUEST['ProductNaamB'] as $key => $ProductNaamB[$j])
    { //echo $ProductNaam[$j];
    	$j++;
    }    

$k =1;
foreach($_REQUEST['Station'] as $key => $Station[$k]) 
    { //echo $Station[$k];
        $k++;
    }


$verwerkt=$_REQUEST['verwerkt'];
$orderaantal=$_REQUEST['orderaantal']; 
$bewerking= $_REQUEST['bewerking']; //  1 = updaten, 2 = vewijderen, 3 opnieuw toevoegen. 
//$DatabaseLijn= $_REQUEST['DatabaseRegel'];
//echo $DB_line; 

/**
 * elseif ($bewerking == 2 ){ // verwijderen
 *     echo "komt hier met verwijderen";
 *  	header('Refresh: 0; url=DelOpdracht.php?ID='.$DatabaseLijn ) ;
 * }
 */
 
 
// Hoogste lijn uit de database halen. 
#$resultlines =
$row = $verbinding->query("SELECT MAX(orderid) As max FROM opdrachten")->fetch_array();
#$row = mysql_fetch_array( $resultlines );
$hoogsteIDinDB=(int)$row['max']; 

 

if (isset($_POST["Toevoegen"]))     
{ // opnieuw toevoegen 
    if ($orderaantal ==0)
    {     
        ?>
          <script type="text/javascript">
            alert("Het aantal karren mag niet nul zijn ");
            history.back();
          </script>
        <?php  
    }
    
    else 
    {
        $verbinding->query("
        		INSERT INTO opdrachten
        		(
        		klantorder,
        		status,
        		OpdrComm,
        		label,
        		verwerkt,
        		orderaantal,
        		ProductLaag1,
        		ProductLaag2,
        		ProductLaag3,
        		ProductLaag4,
        		ProductLaag5,
        		ProductLaag6,
        		ProductLaag7,
        		ProductLaag8,
        		ProductLaag9,
        		ProductLaag10,
        		ProductLaag11,
        		ProductLaag1B,
        		ProductLaag2B,
        		ProductLaag3B,
        		ProductLaag4B,
        		ProductLaag5B,
        		ProductLaag6B,
        		ProductLaag7B,
        		ProductLaag8B,
        		ProductLaag9B,
        		ProductLaag10B,
        		ProductLaag11B,        		
        		KleurLaag1,
        		KleurLaag2,
        		KleurLaag3,
        		KleurLaag4,
        		KleurLaag5,
        		KleurLaag6,
        		KleurLaag7,
        		KleurLaag8,
        		KleurLaag9,
        		KleurLaag10,
        		KleurLaag11,
        		KleurLaag1B,
        		KleurLaag2B,
        		KleurLaag3B,
        		KleurLaag4B,
        		KleurLaag5B,
        		KleurLaag6B,
        		KleurLaag7B,
        		KleurLaag8B,
        		KleurLaag9B,
        		KleurLaag10B,
        		KleurLaag11B       		
        		)
        VALUES('".$ordernr.
        		"','".$status.
        		"','".$opdrcomm.
        		"','".$label.
        		"','".$verwerkt.
        		"','".$orderaantal.
        		"','".$ProductNaam[11].
        		"','".$ProductNaam[10].
        		"','".$ProductNaam[9].
        		"','".$ProductNaam[8].
        		"','".$ProductNaam[7].
        		"','".$ProductNaam[6].
        		"','".$ProductNaam[5].
        		"','".$ProductNaam[4].
        		"','".$ProductNaam[3].
        		"','".$ProductNaam[2].
        		"','".$ProductNaam[1].
        		"','".$ProductNaamB[11].
        		"','".$ProductNaamB[10].
        		"','".$ProductNaamB[9].
        		"','".$ProductNaamB[8].
        		"','".$ProductNaamB[7].
        		"','".$ProductNaamB[6].
        		"','".$ProductNaamB[5].
        		"','".$ProductNaamB[4].
        		"','".$ProductNaamB[3].
        		"','".$ProductNaamB[2].
        		"','".$ProductNaamB[1].        		
        		"','".$KleurID[11].
        		"','".$KleurID[10].
        		"','".$KleurID[9].
        		"','".$KleurID[8].
        		"','".$KleurID[7].
        		"','".$KleurID[6].
        		"','".$KleurID[5].
        		"','".$KleurID[4].
        		"','".$KleurID[3].
        		"','".$KleurID[2].
        		"','".$KleurID[1].
        		"','".$KleurIDB[11].
        		"','".$KleurIDB[10].
        		"','".$KleurIDB[9].
        		"','".$KleurIDB[8].
        		"','".$KleurIDB[7].
        		"','".$KleurIDB[6].
        		"','".$KleurIDB[5].
        		"','".$KleurIDB[4].
        		"','".$KleurIDB[3].
        		"','".$KleurIDB[2].
        		"','".$KleurIDB[1].        		
        		"')");
         
// kijken naar het hoogste volgorder om hier een bij te doen en deze te updaten naar de DB
        $rowSQL = $verbinding->query("SELECT MAX(volgorder) AS max FROM opdrachten");
        $row = $rowSQL->fetch_array( );
        $resultmaxbewerking =(int) $row['max'];
        //echo "resultaat max bewerking", $resultmaxbewerking;
        
       // if  ($resultmaxbewerking == 0 ) 
       // {   
       //     $resultmaxbewerking=1;
       // }
       // else {
       //     $resultmaxbewerking ++;
       // }
       $resultmaxbewerking=0;
        // Hoogste lijn uit de database halen. 
        $resultlines =$verbinding->query("SELECT MAX(orderid) As max FROM opdrachten");
        $row = $resultlines->fetch_array( );
        $hoogsteIDinDB=(int)$row['max'];       
        //$aantal_rijen_in_DB = mysql_num_rows($resultlines);
        //echo "hoogste id in database ", $hoogsteIDinDB;
        $verbinding->query("UPDATE opdrachten SET VullenLaag1='".$Station[11]."', VullenLaag2='".$Station[10]."',VullenLaag3='".$Station[9]."',VullenLaag4='".$Station[8]."',VullenLaag5='".$Station[7]."',VullenLaag6='".$Station[6]."',VullenLaag7='".$Station[5]."',VullenLaag8='".$Station[4]."',VullenLaag9='".$Station[3]."',VullenLaag10='".$Station[2]."',VullenLaag11='".$Station[1]."',volgorder='".$resultmaxbewerking."' WHERE orderid='".$hoogsteIDinDB."' ");
        ?>
          <script type="text/javascript">
            alert("Opdracht is toegevoegd");
            history.back();
          </script>
        <?php 
    }
}

elseif (isset($_POST["Updaten"]))
{ 
    //echo "lijn in db is ",$DB_line;
    if ($orderaantal == 0)
    {
     ?>
          <script type="text/javascript">
            alert("Het aantal karren mag niet nul zijn ");
            history.back();
          </script>
     <?php   
    }
    else 
    {
        $verbinding->query("UPDATE opdrachten SET 
        		KleurLaag1B='".$KleurIDB[11]."',
        		KleurLaag2B='".$KleurIDB[10]."',
        		KleurLaag3B='".$KleurIDB[9]."',
        		KleurLaag4B='".$KleurIDB[8]."',
        		KleurLaag5B='".$KleurIDB[7]."',
        		KleurLaag6B='".$KleurIDB[6]."',
        		KleurLaag7B='".$KleurIDB[5]."',
        		KleurLaag8B='".$KleurIDB[4]."',
        		KleurLaag9B='".$KleurIDB[3]."',
        		KleurLaag10B='".$KleurIDB[2]."',
        		KleurLaag11B='".$KleurIDB[1]."', 
         		KleurLaag1='".$KleurID[11]."',
        		KleurLaag2='".$KleurID[10]."',
        		KleurLaag3='".$KleurID[9]."',
        		KleurLaag4='".$KleurID[8]."',
        		KleurLaag5='".$KleurID[7]."',
        		KleurLaag6='".$KleurID[6]."',
        		KleurLaag7='".$KleurID[5]."',
        		KleurLaag8='".$KleurID[4]."',
        		KleurLaag9='".$KleurID[3]."',
        		KleurLaag10='".$KleurID[2]."',
        		KleurLaag11='".$KleurID[1]."'        		
        		
        		WHERE orderid='".$DB_line."' ");
        $verbinding->query("UPDATE opdrachten SET 
        		klantorder='".$ordernr."',
        		status='".$status."',
        		OpdrComm='".$opdrcomm."',
        		label='".$label."',
        		verwerkt='".$verwerkt."',
        		orderaantal='".$orderaantal."',
        		ProductLaag1='".$ProductNaam[11]."',
        		ProductLaag2='".$ProductNaam[10]."',
        		ProductLaag3='".$ProductNaam[9]."',
        		ProductLaag4='".$ProductNaam[8]."',
        		ProductLaag5='".$ProductNaam[7]."',
        		ProductLaag6='".$ProductNaam[6]."',
        		ProductLaag7='".$ProductNaam[5]."',
        		ProductLaag8='".$ProductNaam[4]."',
        		ProductLaag9='".$ProductNaam[3]."',
        		ProductLaag10='".$ProductNaam[2]."',
        		ProductLaag11='".$ProductNaam[1]."' WHERE orderid='".$DB_line."' ");
        $verbinding->query("UPDATE opdrachten SET VullenLaag1='".$Station[11]."', VullenLaag2='".$Station[10]."',VullenLaag3='".$Station[9]."',VullenLaag4='".$Station[8]."',VullenLaag5='".$Station[7]."',VullenLaag6='".$Station[6]."',VullenLaag7='".$Station[5]."',VullenLaag8='".$Station[4]."',VullenLaag9='".$Station[3]."',VullenLaag10='".$Station[2]."',VullenLaag11='".$Station[1]."' WHERE orderid='".$DB_line."' ");
        ?>
          <script type="text/javascript">
            alert("Opdracht is bijgewerkt");
            //history.back();
          </script>
        <?php
            header('Refresh: 0; url=overview.php');
    }  
} 


elseif (isset($_POST["ReceptToevoegen"]))
{ 
    //echo "komt hiet in recept opslaan";
   $ReceptNaam= $_REQUEST['ReceptNaam'];
   if ($ReceptNaam ==null) 
   {
        ?>
          <script type="text/javascript">
            alert("Recept naam is niet ingevoerd");
            history.back();
          </script>
        <?php
   }
   else 
   {
        mysql_query("INSERT INTO Recepten(ReceptNaam,ProductLaag1,ProductLaag2,ProductLaag3,ProductLaag4,ProductLaag5,ProductLaag6,ProductLaag7,ProductLaag8,ProductLaag9,ProductLaag10,ProductLaag11,KleurLaag1,KleurLaag2,KleurLaag3,KleurLaag4,KleurLaag5,KleurLaag6,KleurLaag7,KleurLaag8,KleurLaag9,KleurLaag10,KleurLaag11)
        VALUES('".$ReceptNaam."','".$ProductNaam[11]."','".$ProductNaam[10]."','".$ProductNaam[9]."','".$ProductNaam[8]."','".$ProductNaam[7]."','".$ProductNaam[6]."','".$ProductNaam[5]."','".$ProductNaam[4]."','".$ProductNaam[3]."','".$ProductNaam[2]."','".$ProductNaam[1]."','".$KleurID[11]."','".$KleurID[10]."','".$KleurID[9]."','".$KleurID[8]."','".$KleurID[7]."','".$KleurID[6]."','".$KleurID[5]."','".$KleurID[4]."','".$KleurID[3]."','".$KleurID[2]."','".$KleurID[1]."')");
        ?>
          <script type="text/javascript">
            alert("Recept toegevoegd");
            history.back();
          </script>
        <?php
   }
   
   // header('Refresh: 0; url=recepten.php');
} 


//ReceptOpslaan
elseif (isset($_POST["ReceptOpslaan"]))
{ 
    //echo "komt hiet in recept opslaan";
   $ReceptNaam= $_REQUEST['ReceptNaam'];
   if ($ReceptNaam ==null) 
   {
        ?>
          <script type="text/javascript">
            alert("Recept naam is niet ingevoerd");
            history.back();
          </script>
        <?php
   }
  
   else
   { 
        //echo "database regel ",$DB_line ; 
        $verbinding->query("UPDATE Recepten SET KleurLaag1='".$KleurID[11]."',KleurLaag2='".$KleurID[10]."',KleurLaag3='".$KleurID[9]."',KleurLaag4='".$KleurID[8]."',KleurLaag5='".$KleurID[7]."',KleurLaag6='".$KleurID[6]."',KleurLaag7='".$KleurID[5]."',KleurLaag8='".$KleurID[4]."',KleurLaag9='".$KleurID[3]."',KleurLaag10='".$KleurID[2]."',KleurLaag11='".$KleurID[1]."' WHERE ReceptID='".$DB_line."' ");
        $verbinding->query("UPDATE Recepten SET ReceptNaam='".$ReceptNaam."',ProductLaag1='".$ProductNaam[11]."',ProductLaag2='".$ProductNaam[10]."',ProductLaag3='".$ProductNaam[9]."',ProductLaag4='".$ProductNaam[8]."',ProductLaag5='".$ProductNaam[7]."',ProductLaag6='".$ProductNaam[6]."',ProductLaag7='".$ProductNaam[5]."',ProductLaag8='".$ProductNaam[4]."',ProductLaag9='".$ProductNaam[3]."',ProductLaag10='".$ProductNaam[2]."',ProductLaag11='".$ProductNaam[1]."' WHERE ReceptID='".$DB_line."' ");
        ?>
         <script type="text/javascript">
            alert("Recept opgeslagen");
            history.back();
          </script>
        <?php
    }

}

elseif (isset($_POST["Recepten"]))
{ 
    header('Refresh: 0; url=recepten.php');
}



////KleurLaag1,KleurLaag2,KleurLaag3,KleurLaag4,KleurLaag5,KleurLaag6,KleurLaag7,KleurLaag8,KleurLaag9,KleurLaag10,KleurLaag11,VullenLaag1,VullenLaag2,VullenLaag3,VullenLaag4,VullenLaag5,VullenLaag6,VullenLaag7,VullenLaag8,VullenLaag9,VullenLaag10,VullenLaag11)
//'".$ProductNaam[1]."','".$ProductNaam[2]."','".$ProductNaam[3]."','".$ProductNaam[4]."','".$ProductNaam[5]."','".$ProductNaam[6]."','".$ProductNaam[7]."','".$ProductNaam[8]."','".$ProductNaam[9]."','".$ProductNaam[10]."','".$ProductNaam[11]."','".$KleurID[1]."','".$KleurID[2]."','".$KleurID[3]."','".$KleurID[4]."','".$KleurID[5]."','".$KleurID[6]."','".$KleurID[7]."','".$KleurID[8]."','".$KleurID[9]."','".$KleurID[10]."','".$KleurID[11]."','".$Station[1]."','".$Station[2].",".$Station[3]."','".$Station[4]."','".$Station[5]."','".$Station[6]."','".$Station[7]."','".$Station[8]."','".$Station[9]."','".$Station[10]."','".$Station[11]."'

?>


</body>
</html>
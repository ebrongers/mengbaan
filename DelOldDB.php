<html>
<head>
  <meta content="text/html; charset=ISO-8859-1"  http-equiv="content-type">
  <title>Opdrachten toegevoegd</title>
  <link rel="stylesheet" type="text/css"  href="default.css">
</head>
<body>

<?php
/*
 * @script: deletedb
 * @description: delete all data from DB
 * @modified: 30-04-2018
 * @history:
 * 			30-04-2018 change sql to mysqli_connect
 *
 */
$conn=mysqli_connect('127.0.0.1', 'pi', NULL, 'baaskarrendb') or die (mysql_error());
$conn->query("DELETE FROM opdrachten WHERE status=1");
?>
  <script type="text/javascript">
    alert("Verwerkte opdrachten zijn verwijderd");
    
  </script>
<?php 	
    header('Refresh: 0; url=overview.php');
    

?>
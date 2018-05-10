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
 * @modified: 9-5-2018
 * @history:
 * 			09-05-2018 add table opdrachten_norm for delete of data
 * 			30-04-2018 change sql to mysqli_connect
 * 			
 */
$conn=mysqli_connect('127.0.0.1', 'pi', NULL, 'baaskarrendb') or die (mysql_error());




$conn->query("TRUNCATE TABLE opdrachten");
$conn->query("truncate table opdrachten_norm");
?>
  <script type="text/javascript">
    window.alert("Database is leeggemaakt.");
    history.back();
  </script>
<html>
<head>
  <meta content="text/html; charset=ISO-8859-1"  http-equiv="content-type">
  <title>Opdrachten toegevoegd</title>
  <link rel="stylesheet" type="text/css"  href="default.css">
</head>
<body>

<?php
$conn=mysqli_connect('127.0.0.1', 'pi', NULL, 'baaskarrendb') or die (mysql_error());




	$conn->query("TRUNCATE TABLE opdrachten");
?>
  <script type="text/javascript">
    window.alert("Database is leeggemaakt.");
    history.back();
  </script>
<?php 
    

//	header('Refresh: 0; url=overview.php');

?>
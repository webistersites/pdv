<?php 
header('Content-type: text/html; charset=ISO-8859-1');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Update Stock Manager Advance</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-cosmo.css"/>
    <link href="css/custom.css" rel="stylesheet" type="text/css" />
    <link href="css/font-awesome.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        html{ height: 100%; }
        body { padding-bottom:40px; height:auto; background:url("img/bg2.png"); }
        form { margin:0; }
    </style>
</head>
<body>
   <div id="install-header">
    <img src="img/logo.png" />
</div>
<div class="install">
  <?php 
  require("update.php");
  ?>
</div>
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/validation.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $('form').form();
      $('.tip').tooltip();
  });
</script>      
</body>
</html>
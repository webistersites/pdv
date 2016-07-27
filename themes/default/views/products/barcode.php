<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo "Barcode of ".$product_details->name; ?></title>
<style type="text/css">
body { margin:0; padding:0; font-family:Tahoma, Geneva, sans-serif; font-size: 12px; }
#bwrapper { width: 348px; height: 198px; padding: 10px; border: 1px solid #666; background-color: #FFF; margin-top: 25px; margin-left: 25px; text-align:center; }
#barcode_wrapper img { margin:auto; } 
</style>
</head>

<body>
<div id="bwrapper">
<h1><?php echo $product_details->name; ?></h1>
<?php echo $img; ?>
</div>
</body>
</html>

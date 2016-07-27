<!DOCTYPE HTML>
<html>
<head>
    <title><?php echo $heading;?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style type="text/css">
        body {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            background: rgba(73,155,234,1);
            background: -moz-radial-gradient(center, ellipse cover, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(73,155,234,1)), color-stop(100%, rgba(32,124,229,1)));
            background: -webkit-radial-gradient(center, ellipse cover, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
            background: -o-radial-gradient(center, ellipse cover, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
            background: -ms-radial-gradient(center, ellipse cover, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
            background: radial-gradient(ellipse at center, rgba(73,155,234,1) 0%, rgba(32,124,229,1) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#499bea', endColorstr='#207ce5', GradientType=1 );
            margin: 0; 
            padding: 0;
        }
        h3 {
            font-size:2em;
            text-align:center;
            padding:20px;
            font-weight: bold;
        }
        h1 {
            font-size:2.5em;
            color: rgba(255,255,255,0.9);
            text-transform:uppercase;
            font-weight: bolder;
            padding-top: 0;
            margin-top: 15px;

        }
        p {
            font-size:1em;
            line-height:1.5em;
            font-weight: normal;
        }
        .wrap {
            width: 90%;
            max-width: 1000px;
            margin: 0 auto;  
        }
        .main {
            text-align:center;
            color:#333;
            margin-top:100px;
            -webkit-border-radius:10px;
            -moz-border-radius:10px;
            border-radius:10px;
            padding: 20px;
        }
        .msg {
            background: rgba(255,255,255,1);
            background: -moz-radial-gradient(center, ellipse cover, rgba(255,255,255,1) 0%, rgba(246,246,246,0.95) 47%, rgba(237,237,237,0.9) 100%);
            background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, rgba(255,255,255,1)), color-stop(47%, rgba(246,246,246,0.95)), color-stop(100%, rgba(237,237,237,0.9)));
            background: -webkit-radial-gradient(center, ellipse cover, rgba(255,255,255,1) 0%, rgba(246,246,246,0.95) 47%, rgba(237,237,237,0.9) 100%);
            background: -o-radial-gradient(center, ellipse cover, rgba(255,255,255,1) 0%, rgba(246,246,246,0.95) 47%, rgba(237,237,237,0.9) 100%);
            background: -ms-radial-gradient(center, ellipse cover, rgba(255,255,255,1) 0%, rgba(246,246,246,0.95) 47%, rgba(237,237,237,0.9) 100%);
            background: radial-gradient(ellipse at center, rgba(255,255,255,1) 0%, rgba(246,246,246,0.95) 47%, rgba(237,237,237,0.9) 100%);
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed', GradientType=1 );
            -webkit-box-shadow: 0px 10px 5px 0px rgba(32,124,229,1);
            -moz-box-shadow: 0px 10px 5px 0px rgba(32,124,229,1);
            box-shadow: 0px 10px 5px 0px rgba(32,124,229,1);
            padding: 0.5em;
            border-radius: 1em;
        }
        .msg p:nth-child(3) {
            font-family:monospace;
            padding: 20px; 
            line-height: 1.5em; 
            color:#428BCA;
        }
        .btn {
            -webkit-border-radius: 28;
            -moz-border-radius: 28;
            border-radius: 28px;
            color: #ffffff;
            font-size: 1.5em;
            width: 120px;
            background: rgba(73,155,234,1);
            padding: 10px 20px 10px 20px;
            text-decoration: none;
            margin: 1em;
            display: inline-block;
            font-weight: bolder;
        }
        .btn:hover {
            background: rgba(32,124,229,1);
            text-decoration: none;
        }
        .btn-large { width: 80%; display: block; margin: 15px auto; }
        .clear {
            clear: both;
        }
        .footer {
            text-align:right;
            padding-top:10px;
        }
        .footer p {
            font-size:12px;
            color:#DDD;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="main">
            <?php 
            $find = "Unable to connect to your database server using the provided settings.";
            $pos = strpos($message, $find);
            if ($pos !== false) {
                header("Location: install/index.php");
                die();
            } else { 
                ?>
                <h1><?php echo $heading; ?></h1>
                <div class="msg"><?php echo $message; ?></div>
                <a class="btn" href="javascript:history.go(-1)">&laquo; Back</a>
                <a class="btn" href="<?php echo config_item('base_url'); ?>">Home &raquo;</a>
                <?php 
            } 
            ?>
        </div>
    </div>
</body>
</html>
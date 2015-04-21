<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Codeigniter CRUD</title>
        <!-- custom style -->
        <link rel="stylesheet" href=" <?php echo base_url() ?>css/style.css">

        <!-- Data Tables -->
       

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script>
              var site_url='<?php echo base_url() ?>';
        </script>
    </head>
    <body>      
        <div class="container">
         
            <?php $this->load->view('layouts/elements/header'); ?> 
            <?php //echo $authUser['username'] ?>
            <?php $this->load->view($main); ?>	
            <?php $this->load->view('layouts/elements/footer'); ?>   
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        

        <!-- Apps Script -->
        <script src=" <?php echo base_url() ?>js/apps.js"></script>
    </body>
</html>
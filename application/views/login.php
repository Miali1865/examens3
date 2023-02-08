<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="Start your development with Steller landing page.">
   <meta name="author" content="Devcrud">
   <title>Steller | Components</title>
   <!-- font icons -->
   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/themify-icons/css/themify-icons.css">
   <!-- Bootstrap + Steller  -->
   <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/steller.css">
   <style>
      body{
         padding: 20px;
      }
   </style>
</head>
<body>
   <!-- main content -->
   <div class="container">
   <?php if( $title == 'Login' ){ ?> 
         <h3>Connexion</h3>
   <?php } else {
      ?>
         <h3>Inscription</h3>
      <?php
   } ?>
      <hr>
      <div class="row mt-5">
         <form class="col-md-6" action="<?php echo $action; ?>" method="post">
         <?php if( isset($error)   ) { if( strlen($error) != 0 ){ ?> <h6 class="section-secondary-title">Error :<?php  echo $error; }}?> </h6>    
            <div class="form-group">
               <input type="text" class="form-control" name="nom" id="exampleFormControlInput1" placeholder="Entrer votre nom" value="Rakoto">
            </div>
            <div class="form-group">
               <input type="password" class="form-control" name="mdp" id="exampleFormControlInput1" placeholder="Entrer votre mot de passe" value="12345">
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-primary btn-block rounded w-lg">Connexion</button>
            </div>
         </form>

         <?php if( $title == 'Login' ){ ?>  <a href="inscription">S'inscrire</a> <?php } ?>
    <!-- End of page footer -->
   
   <!-- core  -->
    <script src="<?php echo base_url(); ?>assets/vendors/jquery/jquery-3.4.1.js"></script>
   <script src="<?php echo base_url(); ?>assets/vendors/bootstrap/bootstrap.bundle.js"></script>

    <!-- steller js -->
    <script src="<?php echo base_url(); ?>assets/js/steller.js"></script>

</body>
</html>

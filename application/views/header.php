<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with Steller landing page.">
    <meta name="author" content="Devcrud">
    <title>Steller Landing page | Free Bootstrap 4.1 landing page</title>
    <!-- font icons -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/vendors/themify-icons/css/themify-icons.css">
    <!-- Bootstrap + Steller main styles -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/steller.css">

    <?php
        if( isset( $cssLink ) ){
            echo '<link rel="stylesheet" href="'. $cssLink .'">';
        }

    ?>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40" id="home">

    <!-- Page navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" data-spy="affix" data-offset-top="0">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="<?php echo base_url();?>assets/imgs/logo.svg" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();  ?>home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();  ?>search">Rechercher Objet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();  ?>home/pageinsertobject">Insertion objet</a>
                    </li>                   
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>inscription">Inscription</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();  ?>home/listcateg">Liste des Objets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url();  ?>home/myObjectInteresse">Proposition Echange</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#blog">Liste de mes Objets</a>
                    </li>
                    <li class="nav-item">
                </ul>
            </div>
        </div>          
    </nav>
    <!-- End of page navibation -->
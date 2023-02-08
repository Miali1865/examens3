    <!-- Page Header -->
    <header class="header" id="home">
        <div class="container">
            <div class="infos">
                <h6 class="subtitle">Bonjour,</h6>
                <h6 class="title">bienvenue sur notre site</h6>

                <div class="buttons pt-3">
                    <a class="btn btn-primary rounded" href="<?php echo base_url();  ?>search">Rechercher Objet</a>
                    <?php if(isset($_SESSION['user']['idutilisateur'])) {
                        if($_SESSION['user']['idutilisateur'] == 1) {
                    ?>
                    <a class="btn btn-dark rounded" href="<?php echo base_url();  ?>search">Gestion Catégorie</button>
                    <?php } }?>
                </div>      

                <div class="socials mt-4">
                    <a class="social-item" href="javascript:void(0)"><i class="ti-facebook"></i></a>
                    <a class="social-item" href="javascript:void(0)"><i class="ti-google"></i></a>
                    <a class="social-item" href="javascript:void(0)"><i class="ti-github"></i></a>
                    <a class="social-item" href="javascript:void(0)"><i class="ti-twitter"></i></a>
                </div>
            </div>              
            <div class="img-holder">
                <img src="<?php echo base_url();?>assets/imgs/man.svg" alt="">
            </div>      
        </div>  

        <!-- Header-widget -->
        <?php if(isset($_SESSION['user']['idutilisateur'])) {
            if($_SESSION['user']['idutilisateur'] == 1) {
            ?>
            <div class="widget">
                <div class="widget-item">
                    <h2><?php  echo $nbrUser; ?></h2>
                    <p>Nombre d'utilisateurs</p>
                </div>
                <div class="widget-item">
                    <h2><?php echo $nbrEchange; ?></h2>
                    <p>Nombre d'échange</p>
                </div>
            </div>
        <?php } } ?>
    </header>
    <!-- End of Page Header -->

    <!-- End of Sectoin -->

    <!-- End of Skills sections -->

    <!-- End of portfolio section -->


    <!-- End of testmonial section -->

    <!-- Blog Section -->
    <?php if( isset($listObjet)){ ?>
            <section id="blog" class="section">
                <div class="container text-center">
                    <h6 class="section-title mb-4">Liste de mes Objets</h6>
                    <div class="row text-left">
                        <?php  for( $i = 0 ; $i != count($listObjet) ; $i++ ){  ?>
                            <div class="col-md-4">
                                <div class="card border mb-4">
                                        <?php if( count($listObjet[$i]['photo']) == 0 ){ ?>
                                            <img style="width: 200px;height: 300px;object-fit:cover;" src="<?php echo base_url();?>assets/imgs/image.png" alt="" class="card-img-top w-100">
                                        <?php } else{
                                            ?>
                                            <img style="width: 200px;height: 300px;object-fit:cover;" src="<?php echo base_url();?>assets/imgs/<?php echo $listObjet[$i]['photo'][count($listObjet[$i]['photo']) - 1]['nom']; ?>" alt="" class="card-img-top w-100">
                                        <?php
                                        } ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo  $listObjet[$i]['titre'] ; ?></h5>
                                        <p>prix : <?php echo $listObjet[$i]['prixEstimatif']; ?> Ar </p>
                                        <?php 
                                        if( $listObjet[$i]['etatobjet'] == 0 ){
                                        ?>
                                            <p><a href="<?php echo base_url();?>home/listcateg?objetoffrant=<?php echo $listObjet[$i]['idobjet']?>&offrant=<?php echo $listObjet[$i]['idutilisateur']?>"><?php echo $listObjet[$i]['etatObjHtml'] ; ?></a></p>
                                        <?php 
                                        } else if( $listObjet[$i]['etatobjet'] == 1 ){
                                        ?>
                                        <p><?php echo $listObjet[$i]['etatObjHtml'] ; ?></p>

                                        <?php
                                        } else {
                                        ?>
                                        <p><?php echo $listObjet[$i]['etatObjHtml']; ?></p> 
                                        <?php
                                        }
                                        ?>
                                        <p><a href="<?php echo base_url();?>home/redirectDetailPhoto?idobjet=<?php echo $listObjet[$i]['idobjet']?>">Voir détail photo</a></p>
                                        <p>
                                            <a href="<?php echo base_url();?>taux/listEchange?idobjet=<?php echo $listObjet[$i]['idobjet']?>&&taux=10">-/+10%</a>
                                            <a href="<?php echo base_url();?>taux/listEchange?idobjet=<?php echo $listObjet[$i]['idobjet']?>&&taux=20">-/+20%</a>
                                        </p>
                                        <div class="form-group">
                                            <?php echo form_open_multipart('home/do_upload');?>
                                            <input type="file" name="userfile" size="1000000" />
                                            <input type="hidden" name="idobjet" value="<?php echo $listObjet[$i]['idobjet'];?>">
                                        </div>
                                        <input type="submit" name="envoyer" value="Rajouter la photo" class="btn btn-primary btn-block rounded w-lg">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        <?php } ?>

    <!-- Hire me section -->
    <section class="bg-gray p-0 section">
        <div class="container">
            <div class="card bg-primary">
                <div class="card-body text-light">
                    <div class="row align-items-center">
                        <div class="col-sm-9 text-center text-sm-left">
                            <h5 class="mt-3">Hire Me For Your Project</h5>
                            <p class="mb-3">Accusantium labore nostrum similique quisquam.</p>
                        </div>
                        <div class="col-sm-3 text-center text-sm-right">
                            <button class="btn btn-light rounded">Hire Me!</button>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>      
    <!-- End od Hire me section. -->

    <!-- Contact Section -->
    <section id="contact" class="position-relative section">
        <div class="container text-center">
            <h6 class="subtitle">Contact</h6>
            <h6 class="section-title mb-4">Get In Touch With Me</h6>
            <p class="mb-5 pb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. In alias dignissimos. <br> rerum commodi corrupti, temporibus non quam.</p>

            <div class="contact text-left">
                <div class="form">
                    <h6 class="subtitle">Available 24/7</h6>
                    <h6 class="section-title mb-4">Get In Touch</h6>
                    <form>
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <textarea name="contact-message" id="" cols="30" rows="5" class="form-control" placeholder="Message"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block rounded w-lg">Send Message</button>
                    </form>
                </div>
                <div class="contact-infos">
                    <div class="item">
                        <i class="ti-location-pin"></i>
                        <div class="">
                            <h5>Location</h5>
                            <p> 12345 Fake ST NoWhere AB Country</p>
                        </div>                          
                    </div>
                    <div class="item">
                        <i class="ti-mobile"></i>
                        <div>
                            <h5>Phone Number</h5>
                            <p>(123) 456-7890</p>
                        </div>                          
                    </div>
                    <div class="item">
                        <i class="ti-email"></i>
                        <div class="mb-0">
                            <h5>Email Address</h5>
                            <p>info@website.com</p>
                        </div>
                    </div>
                </div>                  
            </div>
        </div>  
        <div id="map">
            <iframe src="https://snazzymaps.com/embed/61257"></iframe>
        </div>      
    </section>
    <!-- End of Contact Section -->

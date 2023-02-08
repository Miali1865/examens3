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
                                        <p>prix : <?php echo $listObjet[$i]['prixEstimatif']; ?> Ar ( <?php echo $listObjet[$i]['difference'] ?> ) </p>
                                        <p><a href="<?php echo base_url();?>taux/echange?offrant=<?php echo $_SESSION['user']['idutilisateur']; ?>&&objoffrant=<?php echo $_SESSION['objetEchange']['idObjet'] ?>&&objpropose=<?php echo $listObjet[$i]['idObjet']; ?>&&propose=<?php echo $listObjet[$i]['idutilisateur']; ?>">Échanger</a></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </section>
        <?php } ?>
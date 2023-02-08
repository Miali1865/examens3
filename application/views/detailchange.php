<!-- Blog Section -->
<section id="blog" class="section">
        <div class="container text-center">
            <h6 class="section-title mb-4">Liste propositions &eacute;changes objets</h6>

            <div class="row text-left">
                
                <?php  foreach($objet as $obj) { ?>
                    <div class="col-md-4">
                        <div class="card border mb-4">
                        <?php if( count($obj['image']) == 0 ){ ?>
                                            <img style="width: 200px;height: 300px;object-fit:cover;" src="<?php echo base_url();?>assets/imgs/blog-1.jpg" alt="" class="card-img-top w-100">
                                        <?php } else{
                                            ?>
                                            <img style="width: 200px;height: 300px;object-fit:cover;" src="<?php echo base_url();?>assets/imgs/<?php echo $obj['image'][count($obj['image']) - 1]['nom']; ?>" alt="" class="card-img-top w-100">
                                        <?php
                                }    
                                ?>

                            <div class="card-body">
                                <h5 class="card-title">Propri&eacute;taire : <?php echo $obj['nomoffrant'];?></h5>
                                <h5 class="card-title">Nom objet : <?php echo $obj['nomobjetOffrant'];?></h5>
                                <p>Prix &eacute;stimatif : <?php echo $obj['prixOffrant'];?></p>
                                <a href="<?php echo base_url()  ?>user/accepter?offrant=<?php echo $obj['offrant']; ?>&&propose=<?php echo $obj['proposeuser']; ?>&&objetOffrant=<?php echo $obj['objetOffrant']; ?>&&objetpropose=<?php echo $obj['objetpropose']; ?>">Accepter</a> 


                                <a href="<?php echo base_url()  ?>user/refuser?offrant=<?php echo $obj['offrant']; ?>&&propose=<?php echo $obj['proposeuser']; ?>&&objetOffrant=<?php echo $obj['objetOffrant']; ?>&&objetpropose=<?php echo $obj['objetpropose']; ?>">Refuser</a>                            
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
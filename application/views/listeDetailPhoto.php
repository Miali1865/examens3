    <!-- Portfolio section -->
    <section id="portfolio" class="section">
        <div class="container text-center">
            <h6 class="section-title mb-4">Détail Photo</h6>
            <?php foreach($detailobjet as $detail) {?>
                <h6 class="subtitle">Propriétaire : <?php echo $detail['titre'];?></h6>
                <h6 class="subtitle">Prix éstimatif : <?php echo $detail['prixEstimatif'];?></h6>
            <?php } ?>

            <div class="row">
                <?php foreach($detailphotoobjet as $photo) { ?>
                    <div class="col-sm-4">
                            <div class="img-wrapper">
                                <img src="<?php echo base_url();?>assets/imgs/<?php echo $photo['nom'];?>" alt="">
                                <div class="overlay">
                                    <div class="overlay-infos">
                                        <h5>Project Title</h5>
                                        <a href="javascript:void(0)"><i class="ti-zoom-in"></i></a>
                                        <a href="javascript:void(0)"><i class="ti-link"></i></a>
                                    </div>  
                                </div>
                            </div>                
                    </div>
                <?php  } ?>
            </div>

        </div>
    </section>
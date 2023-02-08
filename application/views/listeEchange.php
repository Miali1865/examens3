<!-- Blog Section -->
<section id="blog" class="section">
        <div class="container text-center">
            <h6 class="section-title mb-4">Liste propositions &eacute;changes objets</h6>

            <div class="row text-left">
                <?php foreach($objet as $obj) { ?>
                    <div class="col-md-4">
                        <div class="card border mb-4">
                            <?php if(isset($obj['image'])) { ?>
                                <img src="<?php echo base_url();?>assets/imgs/<?php echo $obj['image'];?>" alt="" class="card-img-top w-100">
                            <?php } else { ?>
                                <img src="<?php echo base_url();?>assets/imgs/blog-1.jpg" alt="" class="card-img-top w-100">
                            <?php } ?>
                            <div class="card-body">
                                <h5 class="card-title">Propri&eacute;taire : <?php echo $obj['propose'];?></h5>
                                <h5 class="card-title">Nom objet a offrir : <?php echo $obj['objetpropose'];?></h5>
                                <a href="<?php echo base_url();?>home/detailChangeObjet?idobjet=<?php echo $obj['objetvolu'];?>">Read More..</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
</section>
<section id="service" class="section">
        <div class="container text-center">
            <h6 class="subtitle">Admin</h6>
            <h6 class="section-title mb-4">Changer categorie</h6>

            <div class="row">
                <?php foreach($admin as $categ) { ?>
                <a href="<?php echo $base_url();?>home/modifcateg?id=<?php echo $categ['idcategorie'];?>" class="col-sm-6 col-md-3 mb-4">
                    <div class="custom-card card border">
                        <div class="card-body">
                            <i class="<?php echo $categ['icone']; ?>"></i>
                            <h5><?php echo $categ['nom'];?></h5>
                        </div>
                    </div>
                </a>
                <?php  } ?>
            </div>
        </div>
    </section>
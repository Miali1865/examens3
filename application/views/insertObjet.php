<!-- Contact Section -->
<section id="contact" class="position-relative section">
        <div class="container text-center">
            <h6 class="section-title mb-4">Insert Objet</h6>

            <div class="contact text-left">
                <div class="form">
                    <h6 class="section-title mb-4">D&eacute;tail objet</h6>
                    <form action="<?php echo base_url(); ?>home/insertionObjet" method="get">
                        <div class="form-group">
                            Nom objet : <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="titre">
                        </div>
                        <div class="form-group">
                            Prix &eacute;stimatif : <input type="number" class="form-control" id="exampleInputPassword1" name="prix">
                        </div>
                        <div class="form-group">
                        Catégorie :
                            <?php foreach($admin as $ad) {?>
                                    <label for=""><?php echo $ad['nom'];?></label>
                                    <input type="checkbox" name="<?php echo $ad['idcategorie'];?>-categ" id="">    
                            <?php } ?>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block rounded w-lg">Valider</button>
                    </form>
                </div>                  
            </div>
        </div>       
    </section>
    <!-- End of Contact Section -->
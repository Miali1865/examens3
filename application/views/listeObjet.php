<!-- Contact Section -->
<section id="contact" class="position-relative section">
        <div class="container text-center">
            <h6 class="section-title mb-4">Liste des objets</h6>

            <div class="contact text-left">
                <div class="form">
                    <form action="<?php echo base_url();  ?>home/listeObject" method="get">
                        <div class="form-group">
                            <select name="idcategorie">
                                <?php foreach($admin as $ad) {?>
                                    <option value="<?php echo $ad['idcategorie'];?>"><?php echo $ad['nom'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block rounded w-lg">Valider</button>
                    </form>
                </div>               
            </div>


            <?php if(isset($searchobjet)) { ?>
                <!-- Blog Section -->
                
                <section id="blog" class="section">

                    <div class="container text-center">

                        <div class="row text-left">
                        <?php foreach($searchobjet as $objet) { ?>
                            <div class="col-md-4">
                                <div class="card border mb-4">
                                    <img src="<?php echo base_url();?>assets/imgs/blog-1.jpg" alt="" class="card-img-top w-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Propri&eacute;taire : <?php echo $objet['nom'];?></h5>
                                        <h5 class="card-title">Nom objet : <?php echo $objet['titre'];?></h5>
                                        <h5 class="card-title">Prix estimatif : <?php echo $objet['prixEstimatif'];?></h5>
                                        <form action="<?php echo base_url();?>home/insertIntoProposition">
                                            <input type="hidden" value="<?php echo $objet['idutilisateur']; ?>" name="propose">
                                            <input type="hidden" value="<?php echo $objet['idObjet']; ?>" name="objetpropose">
                                            <h5><input type="submit" value="Echanger"></h5>
                                        </form>                                        
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>
            <?php } ?>
        </div>     
    </section>
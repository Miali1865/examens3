<!-- Contact Section -->
<section id="contact" class="position-relative section">
        <div class="container text-center">
            <h6 class="section-title mb-4">Modifier cat&eacute;gorie</h6>

            <?php 
                if(isset($erreur)) {
                    echo $erreur;
                }
            ?>
            <div class="contact text-left">
                <div class="form">
                    <h6 class="section-title mb-4">Nouveau cat&eacute;gorie</h6>
                    <form action="updatecateg" method="get">
                        <input type="hidden" name="id" value="<?php echo $admin['idcategorie']?>">
                        <div class="form-group">
                            Nom <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $admin['nom']?>" name="nom">
                        </div>
                        <div class="form-group">
                            Icon <input type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $admin['icone']?>" name="icone">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block rounded w-lg">Modifier</button>
                    </form>
                </div>                  
            </div>
        </div>      
    </section>
<?php
  include"Trait&tool\bdd.inc.php";
 ?>

<div id="patho" style='display: none;'>
<!-- Gestion des patients -->
<div class='col-sm-6'>
 <fieldset>
  <legend>Patient</legend>
  <div class="form-group">
   <form method='POST' action='#'>
      <label for="patient">Chercher un patient :</label>
      <?php
          $sql = "SELECT id_patient, nom_patient FROM patient WHERE valide = 'o'";
          $req = $conn -> prepare($sql);
          $req -> execute();
       ?>
      <select id="patient" class="form-control" name='patient'>
        <?php while($res = $req -> fetch())
          { ?>
        <option value="<?php echo $res['id_patient']; ?>"><?php echo $res['nom_patient']; ?></option>
      <?php } ?>
      </select>
    </div>
      <button type='submit'  class='btn btn-default' name='rechercher_patient'><span class='glyphicon glyphicon-search'></span>Chercher</button>
    </form>
<?php
  //-------------------------------------------------------------------------------
  //TRAITEMENT RECHERCHER PATIENT
  //-------------------------------------------------------------------------------
  if(isset($_POST['rechercher_patient']))
  {
    $id = $_POST['patient'];
    $sql = "SELECT * FROM patient WHERE id_patient = '$id'";
    $req = $conn -> prepare($sql);
    $req -> execute();
    $res = $req -> fetch();
    ?>
    <script>
      patho();
    </script>
    <form method='POST'  action='Trait&tool\creation.trait.php'>
        <div class="form-group">
          <label for="name_patient">Nom Patient</label>
          <input id='name_patient' class="form-control" type='text' name='name_patient' value="<?php echo $res['nom_patient']; ?>">
        </div>
        <div class="form-group">
          <label for="prenom_patient">Prénom Patient</label>
          <input id='prenom_patient' class="form-control" type='text' name='prenom_patient' value="<?php echo $res['prenom_patient']; ?>">
        </div>
        <div class="form-group">
          <label for="adresse">Adresse Patient</label>
          <input id="adresse" class="form-control" type='text' name='rue_adresse' value="<?php echo $res['rue_patient']; ?>" placeholder="Rue, Avenue,...">
          <div class="row">
            <div class="col-xs-3">
              <input id="adresse" class="form-control" type='text' name='code_adresse' value="<?php echo $res['code_postal_patient']; ?>" placeholder="Code Postal">
            </div>
            <div class="col-xs-3">
              <input id="adresse" class="form-control" type='text' name='ville_adresse' value="<?php echo $res['ville_patient']; ?>" placeholder="Ville">
            </div>
          </div>
        </div>
        <div class="form-group">
          <input type='hidden' name='id' value ="<?php echo $res['id_patient'];?>">
          <div class='btn-group'>
          <input type='submit' class='btn btn-default' name='envoie_mod_patient' value="Modifier">
          <button type="button" class="btn btn-default" data-toggle="modal" data-target="#supr_patient">Supprimer</button>
        </div>
        </div>
    </form>
    <!--Modal confimer supr-->
     <div id="supr_patient" class="modal fade" role="dialog">
       <div class="modal-dialog">

         <!-- Modal content-->
         <div class="modal-content">
           <div class='modal-head'>
             <p class='lead'>Veuillez confirmer la suppresion</p>
           </div>
           <div class="modal-body">
            <form method='POST' action='Trait&tool\creation.trait.php'>
              <div class='form-group'>
                <div class="btn-group">
                  <button class='btn btn-default' data-dismiss="modal">Annuler</button>
                  <input type='hidden' name='id' value='<?php echo $res['id_patient'];?>'>
                  <button class='btn btn-default' type='submit' class='btn btn-default' name='envoie_supr_patient'>Confirmer</button>
                </div>
              </div>
            </form>
            </div>
         </div>

       </div>
     </div>
    </fieldset>
<?php
  }
  else {
    ?>
    <div class="form-group">
    <form method='POST' action='Trait&tool\creation.trait.php'>
      <div class="form-group">
        <label for="name_patient">Nom Patient</label>
        <input id='name_patient' class="form-control" type='text' name='name_patient'>
      </div>
      <div class="form-group">
        <label for="prenom_patient">Prénom Patient</label>
        <input id='prenom_patient' class="form-control" type='text' name='prenom_patient'>
      </div>
      <div class="form-group">
        <label for="adresse">Adresse Patient</label>
        <input id="adresse" class="form-control" type='text' name='rue_adresse'  placeholder="Rue, Avenue,...">
        <div class="row">
          <div class="col-xs-3">
            <input id="adresse" class="form-control" type='text' name='code_adresse' placeholder="Code Postal">
          </div>
          <div class="col-xs-3">
            <input id="adresse" class="form-control" type='text' name='ville_adresse'  placeholder="Ville">
          </div>
        </div>
      </div>
      <div class="form-group">
        <input type='submit' class='btn btn-default' name='envoie_crea_patient' value="Créer">
      </div>
    </form>
    </fieldset>
<?php } ?>
  </div>

<!-- Gestion de pathologie -->
<div class="col-sm-6">
  <fieldset><legend>Pathologie</legend>
    <div class="form-group">
  <form method='POST' action='#'>
     <label for="pathologie">Chercher une pathologie :</label><br>
     <?php
         $sql = "SELECT id_pathologie, nom_pathologie FROM pathologie WHERE valide_patho = 'o'";
         $req = $conn -> prepare($sql);
         $req -> execute();
      ?>
     <select class="form-control" id="pathologie" name='pathologie'>
       <?php while($res = $req -> fetch())
         { ?>
       <option value="<?php echo $res['id_pathologie']; ?>"><?php echo $res['nom_pathologie']; ?></option>
     <?php } ?>
     </select>
   </div>
     <button type='submit' class='btn btn-default' name='rechercher_patho'><span class='glyphicon glyphicon-search'></span>Chercher</button>
   </form>
   <?php
   //-------------------------------------------------------------------------------
   //TRAITEMENT RECHERCHER PATHOLOGIE
   //-------------------------------------------------------------------------------
   if (isset($_POST['rechercher_patho']))
    {
      $id = $_POST['pathologie'];
      $sql = "SELECT * FROM pathologie WHERE id_pathologie = '$id'";
      $req = $conn -> prepare($sql);
      $req -> execute();
      $res = $req -> fetch();
      ?>
      <script>
        patho();
      </script>
      <form method = 'POST' action = 'Trait&tool\creation.trait.php'>
        <div class="form-group">
          <label for="nom_patho">Nom </label>
          <input id="nom_patho" class="form-control" type='text' name='nom_patho' value = "<?php echo $res['nom_pathologie']; ?>">
        </div>
        <div class="form-group">
          <label for="descri_patho">Description </label>
          <textarea class="form-control" id="descri_patho" name="descri_patho"><?php echo $res['symptome_pathologie']; ?></textarea>
        </div>
        <div class="form-group">
          <input type='hidden' name='id_patho' value = "<?php echo $res['id_pathologie']; ?>">
          <div class="btn-group">
            <input type='submit' name='mod_patho' class='btn btn-default' value='Modifier'>
            <button type='button' data-toggle="modal" data-target="#supri_patho" class='btn btn-default'>Supprimer</button>
          </div>
        </div>
        </fieldset>
        </form>
        <!--Modal confimer supr-->
         <div id="supri_patho" class="modal fade" role="dialog">
           <div class="modal-dialog">
             <!-- Modal content-->
             <div class="modal-content">
               <div class="modal-head">
                 <p class='lead'>Veuillez confirmer la suppresion</p>
               </div>
               <div class="modal-body">
                <form method='POST' action='Trait&tool\creation.trait.php'>
                <div class='form-group'>
                <div class="btn-group">
                  <button class='btn btn-default' data-dismiss="modal">Annuler</button>
                  <input type='hidden' name='id_patho' value='<?php echo $res['id_pathologie']; ?>'>
                  <button type='submit' class='btn btn-default' name='supr_patho'>Confirmer</button>
                </div>
                </div>
                </form>
              </div>
             </div>
           </div>
         </div>
      <?php
    }
    else {
      ?>
    <form method = 'POST' action = 'creation.trait.php'>
      <div class="form-group">
        <label for="nom_patho">Nom </label>
        <input id="nom_patho" class="form-control" type='text' name='nom_patho' value = "<?php echo $res['nom_pathologie']; ?>">
      </div>
      <div class="form-group">
        <label for="descri_patho">Description </label>
        <textarea class="form-control" id="descri_patho" name="descri_patho"><?php echo $res['symptome_pathologie']; ?></textarea>
      </div>
        <input type='submit' class='btn btn-default' name='ajout_patho' value='Créer'>
        </form>
      </fieldset>
    <?php }
  ?>
  </div>
</div>

<?php
  include"Trait&tool\bdd.inc.php";
  $sql = "SELECT * FROM patient WHERE valide = 'o'";
  $sql2 = "SELECT * FROM pathologie WHERE valide_patho = 'o'";
  $req = $conn -> prepare($sql);
  $req2 = $conn -> prepare($sql2);
  $req -> execute();
  $req2 -> execute();
  $res = $req -> fetch();
  $res2 = $req2 -> fetch();
?>
 <!-- Créer Consultation -->
 <div id='consult' style="display : none;">
 <fieldset><legend>Consultation</legend>
   <div class="col-sm-3">
   <form method='POST' action='#'>
    <div class="form-group">
        <label for="nbr_acte"> Nombre d'acte :</label>
         <input type='text' id="nbr_acte" class="form-control" name='nbr_acte'>
    </div>
    <input class="btn btn-default" type='submit' value="Ajout" name='envoie_nbr'>
  </form>
 </div>
   <?php
    if (isset($_POST['envoie_nbr']))
    {
      $nbra = $_POST['nbr_acte'];
      echo "<script>
              consult()
            </script>";
    }
    else {
      $nbra = 1;
    }
    ?>
 <form method='POST' action='Trait&tool\consultation.trait.php'>
   <div class="col-sm-5">
        <div class="form-group">
          <label for="patient">Patient :</label>
         <select class="form-control" id="patient" name='patient'>
           <?php
              $sql = "SELECT * FROM Patient WHERE valide = 'o'";
              $req2 = $conn -> prepare($sql);
              $req2 -> execute();
              while($res2 = $req2 -> fetch()) { ?>
              <option value = "<?php echo $res2['id_patient']; ?>"><?php echo $res2['nom_patient']; ?></option> <?php } ?>
          </select>
        </div>
        <div class="row">
          <fieldset>
          <legend>Pathologie :</legend>
            <div class="col-md-4">
            <div class="form-group">
            <select multiple name='patho' id='patho' class="form-control">
              <?php
              $sql = "SELECT * FROM Pathologie WHERE valide_patho = 'o'";
              $req = $conn -> prepare($sql);
              $req -> execute();
              while($res = $req -> fetch())
                { ?>
                 <option value = "<?php echo $res['id_pathologie']; ?>"><?php echo $res['nom_pathologie']; ?></option>
               <?php } ?>
               </select>
             </div>
            </div>
           </fieldset>
             </div>
          <div class="col-md">
            <div class="form-group">
               <label for="description">Description :</label>
               <textarea placeholder="Décrire Consultation" id="description" class="form-control" name='description'></textarea>
             </div>
             <div class="col-xs">
             <div class="form-group">
               <label for="date">Date :</label>
               <input type='date' class="form-control" id="date" name='date'>
             </div>
           </div>
         </div>
         <div class="row">
         <?php
          for ($i=0; $i < $nbra ; $i++) {
            ?>
        <div class="col-sm-3">
            <div class="form-group">
              <label for="acte">Acte Medical-<?php echo $i+1; ?>:</label>
            <textarea id='acte' class="form-control" placeholder="Libellé" name='<?php echo "descri_acte".$i; ?>'></textarea>
            <input type ='text' placeholder="Prix" class="form-control" name='<?php echo "price".$i; ?>'>
          </div>
        </div>
            <?php
          }
          ?>
        </div>
          <input type='hidden' name='nbra' value='<?php echo $nbra; ?>'>
          <input class='btn btn-default' type='submit' name='creation_consult' value='Créer'>
 </form>
</div>
 </fieldset>
</div>
</html>

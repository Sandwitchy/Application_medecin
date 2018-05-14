<?php
  $sql = 'SELECT * FROM consultation';
  $req = $conn -> prepare($sql);
  $req -> execute();
 ?>
 <div id='affconsult' style="display: none;">
   <div class='row'>
   <div class='col-xs-3'  style='margin-left: 10px;'>
     <form method="POST" action='#'>
       <div class='form-group'>
         <label for='patient'>Nom Patient</label>
         <select name='patient' id='patient' class="form-control">
           <?php
           $sql = "SELECT * FROM Patient WHERE valide = 'o'";
           $req2 = $conn -> prepare($sql);
           $req2 -> execute();
           while($res2 = $req2 -> fetch()) { ?>
           <option value = "<?php echo $res2['id_patient']; ?>"><?php echo $res2['nom_patient']; ?></option> <?php } ?>
       </select>
       </div>
       <button type="submit" class='btn btn-default' name='searchpatient'><span class='glyphicon glyphicon-search'></span>Chercher</button>
     </form>
   </div>
   <?php
      if (isset($_POST['searchpatient']))
      {
        $idpatient = $_POST['patient'];
        ?>
        <script>
          affconsult()
        </script>
        <div class="col-xs-3">
          <form method="POST" action="#">
            <div class='form-group'>
              <label for='consultation'>Consultation</label>
              <select name='consult' id='consultation' class="form-control">
                <?php
                $sql = "SELECT * FROM consultation WHERE id_patient = '$idpatient'";
                $req2 = $conn -> prepare($sql);
                $req2 -> execute();
                while($res2 = $req2 -> fetch()) {
                  $date = $res2['date_consultation'];
                  $date = datetoFR($date); ?>
                <option value = "<?php echo $res2['id_consultation']; ?>"><?php echo $date; ?></option> <?php } ?>
            </select>
            </div>
            <input type='hidden' name='id_patient' value="<?php echo $idpatient; ?>">
            <input type="submit" class='btn btn-default' name='search' value='Valider'>
          </form>
        </div>
        <?php
      }
      ?></div><?php
      if (isset($_POST['search']))
      {
        $idconsult = $_POST['consult'];
        $sql = "SELECT * FROM consultation WHERE id_consultation = '$idconsult'";
        $res = envoieSQL($sql,'reception');
        $idpatient = $res['id_patient'];
        $result = envoieSQL("SELECT * FROM patient WHERE id_patient = '$idpatient'",'reception');
        $patient = $result['nom_patient'];
        $prenom = $result['prenom_patient'];
        $date = $res['date_consultation'];
        $date = datetoFR($date);
        ?>
        <div class='container' style='margin-left: 10px;'>
          <script>
            affconsult()
          </script>
            <fieldset>
              <legend>Consultation de <?php echo $patient.' '.$prenom; ?> le <?php echo $date; ?></legend>
              <div class='row'>
              <div class='col-md-4'>
                  <p class='lead'>Description :</p>
                  <textarea class="form-control"><?php echo $res['des_consultation']; ?></textarea>
              </div>
            <div class='col-md-4'>
              <p class='lead'>Pathologie :<p>
                <table class='table table-striped table-bordered'>
                  <thead  style='width:400px;'>
                    <tr>
                      <th>Nom:</th>
                      <th>Symptome:</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $idconsu = $res['id_consultation'];
                  affiche_patho($idconsu);
                  ?>
                </tbody>
                </table>
              </div>
              <div class="col-md-4">
                <p class='lead'>Acte Médicaux</p>
                <?php
                $sql = "SELECT * FROM acte_medical WHERE id_consultation = '$idconsult'";
                $res = envoieSQL($sql,'envoie');
                if (($test = $res -> rowCount())== NULL)//si la requete ne retourne aucun resultat
                {
                  ?>
                  <p> Aucun acte médical enregistré</p>
                  <?php
                }
                else{
                 ?>
                <table class='table table-striped table-bordered'>
                  <thead>
                    <tr>
                      <th>Description</th>
                      <th>Honoraire</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php
                $somme = 0;
                while ($result = $res -> fetch())
                {
                  echo "<tr>
                        <td>".$result['desc_acte']."</td>
                        <td>".$result['honoraire']."€</td>
                        </tr>";
                  $somme = $somme+$result['honoraire'];
                }
                echo "<tr>
                      <th>Prix Total :</th>
                      <th>".$somme."€</th>";
                ?>
                  </tbody>
                </table>
              <?php } ?>
              </div>
            </div>
            </fieldset>
        </div>
        <?php
        }
    ?>
 </div>

<?php
  include"Trait&tool\head.inc.php";
  include"Trait&tool\bdd.inc.php";
  include"gestionpatient_patho.php";
  include"gestionconsultation.php";
  include"afficheconsult.php";
 ?>
   <!--Fin de barre de navigation -->
   <div id="ca" style='display :none;'>
     <div class='col-lg-6'>
       <form method='POST' action='#'>
     <table class='table table-hover table-bordered'>
       <thead>
         <tr>
           <th>Date
            <button class='btn btn-default' name='date-up'><span class="glyphicon glyphicon-chevron-up"><span class="glyphicon glyphicon-time"></span></button>
            <button class='btn btn-default' name='date-down'><span class="glyphicon glyphicon-chevron-down"><span class="glyphicon glyphicon-time"></span></button></th>
           <th>Chiffre d'affaire <button class='btn btn-default' name='price-up'><span class="glyphicon glyphicon-chevron-up"></span><span class="glyphicon glyphicon-euro"></span></button>
           <button class='btn btn-default' name='price-down'><span class="glyphicon glyphicon-chevron-down"></span><span class="glyphicon glyphicon-euro"></span></button></th>
         </tr>
        </form>
       </thead>
       <tbody>
         <?php
         if((isset($_POST['date-up']))||((isset($_POST['price-up'])==NULL)&&(isset($_POST['price-up'])==NULL)&&(isset($_POST['price-down'])==NULL)&&(isset($_POST['date-down'])==NULL)))
         {
           if(isset($_POST['date-up']))
           {
           echo "<script>ca()</script>";
            }
            $sql = "SELECT * FROM consultation";
            $data = envoieSQL($sql,'envoie');
            $datepost = 0;
            $j = 0;
            //recupération des données et encapsulation dans matrice
            while ($CA = $data -> fetch())
            {
              $id_consult = $CA['id_consultation'];
              $date = $CA['date_consultation'];

              $temp[1][$j] = $date;

              $sql = "SELECT * FROM acte_medical WHERE id_consultation ='$id_consult'";
              $ah = envoieSQL($sql,'envoie');
              $somme = 0;
              while ($result = $ah ->fetch())
              {
                $somme = $result['honoraire'] + $somme;
              }

              $temp[2][$j] = $somme;
              $j++;
            }
            //tri de la  (check si plusieurs date dentique existe)
            for ($i=0; $i < $j ; $i++)
            {
              for ($k=1; $k < $j ; $k++)
              {
                if (($temp[1][$i] == $temp[1][$k])&&($temp[2][$k] != NULL)&&($i != $k))
                {
                  $temp[2][$i] = $temp[2][$i] + $temp[2][$k];
                  $temp[2][$i] = NULL;
                }
              }
            }
            //tri les dates
            for ($i=0; $i < $j ; $i++) {
              for ($k=0; $k < $j; $k++) {
                if ((date($temp[1][$i]) > date($temp[1][$k]))&&($temp[2][$i] != NULL))
                {
                  $tempo[1] = $temp[1][$i];
                  $tempo[2] = $temp[2][$i];
                  $temp[1][$i] = $temp[1][$k];
                  $temp[2][$i] = $temp[2][$k];
                  $temp[1][$k] = $tempo[1];
                  $temp[2][$k] = $tempo[2];
                }
              }
            }
            //affichage donnée
            for ($i=0; $i < $j ; $i++) {
              if ($temp[2][$i] != NULL)
              {
                $temp[1][$i] = datetoFR($temp[1][$i]);
                echo "<tr><td>".$temp[1][$i]."</td><td>".$temp[2][$i]."<span class='glyphicon glyphicon-euro'></span></td></tr>";
              }
            }
          }
          if(isset($_POST['date-down']))
          {
            echo "<script>ca()</script>";
             $sql = "SELECT * FROM consultation";
             $data = envoieSQL($sql,'envoie');
             $datepost = 0;
             $j = 0;
             //recupération des données et encapsulation dans matrice
             while ($CA = $data -> fetch())
             {
               $id_consult = $CA['id_consultation'];
               $date = $CA['date_consultation'];

               $temp[1][$j] = $date;

               $sql = "SELECT * FROM acte_medical WHERE id_consultation ='$id_consult'";
               $ah = envoieSQL($sql,'envoie');
               $somme = 0;
               while ($result = $ah ->fetch())
               {
                 $somme = $result['honoraire'] + $somme;
               }

               $temp[2][$j] = $somme;
               $j++;
             }
             //tri de la  (check si plusieurs date dentique existe)
             for ($i=0; $i < $j ; $i++)
             {
               for ($k=1; $k < $j ; $k++)
               {
                 if (($temp[1][$i] == $temp[1][$k])&&($temp[2][$k] != NULL)&&($i != $k))
                 {
                   $temp[2][$i] = $temp[2][$i] + $temp[2][$k];
                   $temp[2][$i] = NULL;
                 }
               }
             }
             //tri les dates
             for ($i=0; $i < $j ; $i++) {
               for ($k=0; $k < $j; $k++) {
                 if ((date($temp[1][$i]) < date($temp[1][$k]))&&($temp[2][$i] != NULL))
                 {
                   $tempo[1] = $temp[1][$i];
                   $tempo[2] = $temp[2][$i];
                   $temp[1][$i] = $temp[1][$k];
                   $temp[2][$i] = $temp[2][$k];
                   $temp[1][$k] = $tempo[1];
                   $temp[2][$k] = $tempo[2];
                 }
               }
             }
             //affichage donnée
             for ($i=0; $i < $j ; $i++) {
               if ($temp[2][$i] != NULL)
               {
                 $temp[1][$i] = datetoFR($temp[1][$i]);
                 echo "<tr><td>".$temp[1][$i]."</td><td>".$temp[2][$i]."<span class='glyphicon glyphicon-euro'></span></td></tr>";
               }
             }
           }
          if(isset($_POST['price-up']))
          {
            echo "<script>ca()</script>";
             $sql = "SELECT * FROM consultation";
             $data = envoieSQL($sql,'envoie');
             $datepost = 0;
             $j = 0;
             //recupération des données et encapsulation dans matrice
             while ($CA = $data -> fetch())
             {
               $id_consult = $CA['id_consultation'];
               $date = $CA['date_consultation'];

               $temp[1][$j] = $date;

               $sql = "SELECT * FROM acte_medical WHERE id_consultation ='$id_consult'";
               $ah = envoieSQL($sql,'envoie');
               $somme = 0;
               while ($result = $ah ->fetch())
               {
                 $somme = $result['honoraire'] + $somme;
               }

               $temp[2][$j] = $somme;
               $j++;
             }
             //tri de la  (check si plusieurs date dentique existe)
             for ($i=0; $i < $j ; $i++)
             {
               for ($k=1; $k < $j ; $k++)
               {
                 if (($temp[1][$i] == $temp[1][$k])&&($temp[2][$k] != NULL)&&($i != $k))
                 {
                   $temp[2][$i] = $temp[2][$i] + $temp[2][$k];
                   $temp[2][$i] = NULL;
                 }
               }
             }
             //tri les prix du + haut au + bas
             for ($i=0; $i < $j ; $i++) {
               for ($k=0; $k < $j; $k++) {
                 if (($temp[2][$i] > $temp[2][$k])&&($temp[2][$i] != NULL))
                 {
                   $tempo[1] = $temp[1][$i];
                   $tempo[2] = $temp[2][$i];
                   $temp[1][$i] = $temp[1][$k];
                   $temp[2][$i] = $temp[2][$k];
                   $temp[1][$k] = $tempo[1];
                   $temp[2][$k] = $tempo[2];
                 }
               }
             }
             //affichage donnée
             for ($i=0; $i < $j ; $i++) {
               if ($temp[2][$i] != NULL)
               {
                 $temp[1][$i] = datetoFR($temp[1][$i]);
                 echo "<tr><td>".$temp[1][$i]."</td><td>".$temp[2][$i]."<span class='glyphicon glyphicon-euro'></span></td></tr>";
               }
             }
          }
          if (isset($_POST['price-down'])) {
            echo "<script>ca()</script>";
             $sql = "SELECT * FROM consultation";
             $data = envoieSQL($sql,'envoie');
             $datepost = 0;
             $j = 0;
             //recupération des données et encapsulation dans matrice
             while ($CA = $data -> fetch())
             {
               $id_consult = $CA['id_consultation'];
               $date = $CA['date_consultation'];

               $temp[1][$j] = $date;

               $sql = "SELECT * FROM acte_medical WHERE id_consultation ='$id_consult'";
               $ah = envoieSQL($sql,'envoie');
               $somme = 0;
               while ($result = $ah ->fetch())
               {
                 $somme = $result['honoraire'] + $somme;
               }

               $temp[2][$j] = $somme;
               $j++;
             }
             //tri de la  (check si plusieurs date dentique existe)
             for ($i=0; $i < $j ; $i++)
             {
               for ($k=1; $k < $j ; $k++)
               {
                 if (($temp[1][$i] == $temp[1][$k])&&($temp[2][$k] != NULL)&&($i != $k))
                 {
                   $temp[2][$i] = $temp[2][$i] + $temp[2][$k];
                   $temp[2][$i] = NULL;
                 }
               }
             }
             //tri les prix du + haut au + bas
             for ($i=0; $i < $j ; $i++) {
               for ($k=0; $k < $j; $k++) {
                 if (($temp[2][$i] < $temp[2][$k])&&($temp[2][$i] != NULL))
                 {
                   $tempo[1] = $temp[1][$i];
                   $tempo[2] = $temp[2][$i];
                   $temp[1][$i] = $temp[1][$k];
                   $temp[2][$i] = $temp[2][$k];
                   $temp[1][$k] = $tempo[1];
                   $temp[2][$k] = $tempo[2];
                 }
               }
             }
             //affichage donnée
             for ($i=0; $i < $j ; $i++) {
               if ($temp[2][$i] != NULL)
               {
                 $temp[1][$i] = datetoFR($temp[1][$i]);
                 echo "<tr><td>".$temp[1][$i]."</td><td>".$temp[2][$i]."<span class='glyphicon glyphicon-euro'></span></td></tr>";
               }
             }
          }
          ?>
       </tbody>
     </table>
     </div>
     <div class='col-lg-6'>
       <form method= 'POST' action='#'>
         <div class='form-group'>
           <select name='mois' class='form-control-md input-sm'>
             <option value='01'>Janvier</option>
             <option value='02'>Février</option>
             <option value='03'>Mars</option>
             <option value='04'>Avril</option>
             <option value='05'>Mai</option>
             <option value='06'>Juin</option>
             <option value='07'>Juillet</option>
             <option value='08'>Aout</option>
             <option value='09'>Septembre</option>
             <option value='10'>Octobre</option>
             <option value='11'>Novembre</option>
             <option value='12'>Decembre</option>
           </select>
           <button name='submitmoi' class='btn btn-default'>Chercher</button>
         </div>
       </form>
       <table class='table table-hover table-bordered'>
         <thead>
           <tr>
             <th>date</th>
             <th>Chiffre d'affaire</th>
           </tr>
         </thead>
         <tbody>
           <?php
              if(isset($_POST['submitmoi']))
              {
                echo "<script>ca()</script>";
                $date = $_POST['mois'];
                $nom = mois($date);
                echo "<p class='lead'>".$nom."</p>";
                $date = "2018-".$date."%";
                $sql = "SELECT * FROM consultation WHERE date_consultation  LIKE '$date'";
                $res = envoieSQL($sql,'envoie');

                  $j = 0;
                  while ($CA = $res -> fetch())
                  {
                    $id_consult = $CA['id_consultation'];
                    $date = $CA['date_consultation'];

                    $temp1[1][$j] = $date;

                    $sql = "SELECT * FROM acte_medical WHERE id_consultation ='$id_consult'";
                    $ah = envoieSQL($sql,'envoie');
                    $somme = 0;
                    while ($result = $ah ->fetch())
                    {
                      $somme = $result['honoraire'] + $somme;
                    }

                    $temp1[2][$j] = $somme;
                    $j++;
                  }
                  //tri de la  (check si plusieurs date identique existe)
                  for ($i=0; $i < $j ; $i++)
                  {
                    for ($k=1; $k < $j ; $k++)
                    {
                      if (($temp1[1][$i] == $temp1[1][$k])&&($temp1[2][$k] != NULL)&&($i != $k))
                      {
                        $temp1[2][$i] = $temp1[2][$i] + $temp1[2][$k];
                        $temp1[2][$i] = NULL;
                      }
                    }
                  }
                  //tri les dates
                  for ($i=0; $i < $j ; $i++) {
                    for ($k=0; $k < $j; $k++) {
                      if ((date($temp1[1][$i]) < date($temp1[1][$k]))&&($temp1[2][$i] != NULL))
                      {
                        $tempo[1] = $temp1[1][$i];
                        $tempo[2] = $temp1[2][$i];
                        $temp1[1][$i] = $temp1[1][$k];
                        $temp1[2][$i] = $temp1[2][$k];
                        $temp1[1][$k] = $tempo[1];
                        $temp1[2][$k] = $tempo[2];
                      }
                    }
                  }
                  //affichage donnée
                  $somme = 0;
                  for ($i=0; $i < $j ; $i++) {
                    if ($temp1[2][$i] != NULL)
                    {
                      $somme = $somme + $temp1[2][$i];
                      $temp1[1][$i] = datetoFR($temp1[1][$i]);
                      echo "<tr><td>".$temp1[1][$i]."</td><td>".$temp1[2][$i]."<span class='glyphicon glyphicon-euro'></span></td></tr>";
                    }
                  }
                  echo "<tr><th>Total :</th><td>".$somme."<span class='glyphicon glyphicon-euro'></span></td><tr>";
              }
              else {
                ?>
                  <tr>
                    <td colspan='2'>Veuillez choisir une Période</td>
                  </tr>
                <?php
              }

            ?>
         </tbody>
       </table>
     </div>
    </div>
   </body>

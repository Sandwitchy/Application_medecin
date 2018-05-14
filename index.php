<html>
<?php
  include'Trait&tool\function.tool.php';
 ?>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
<?php
  if (isset($_POST['login']))
  {
    $user = $_POST['user'];
    $mdp = $_POST['mdp'];
    $sql = "SELECT * FROM login WHERE  user = '$user'";
    $res = envoieSQL($sql,'reception');
    if (($res['user'] == $user)&&($res['mdp'] == $mdp))
    {
      header('location:home.php');
    }
    else
    {
      ?>
      <div class="alert alert-danger">
        <strong>Un Probléme est survenue</strong> Le mot de passe ou le nom d'utilisateur est incorrect
      </div>
      <?php
    }
  }
 ?>
 <div class="col-lg" style= "margin: 0 auto;
                             margin-top: 0 auto;
                             width: 500px;">
   <form method="POST" action="#">
     <div class='form-group' style="width : 300px;">
       <label for='user'>Utilisateur</label>
       <input type='text' name="user" id='user' class="form-control">
     </div>
     <div class="form-group" style="width : 300px;">
       <label for='mdp'>Mot de Passe</label>
       <input type='password' name="mdp" id='mdp' class="form-control">
     </div>
     <input type='submit' name='login' value='Se Connecter' class="btn btn-default">
   </form>
 </div>
</body>
</html>

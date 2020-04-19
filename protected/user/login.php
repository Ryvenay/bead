<?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
      $postData = [
          'email' => $_POST['email'],
          'password' => $_POST['password']
      ];

      if(empty($postData['email']) || empty($postData['password'])) {
          echo "hiányzó adatok";
      }
      else if (!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
          echo "hibás email";
      }
      else if(!userLogin($postData['email'], $postData['password'])) {
          echo "hibás email vagy jelszó";
      }
  }
?>

<h2>Bejelentkezés</h2>
<form method="post">
  <div class="form-row justify-content-md-center">
    <div class="form-group col-md-4">
      <label for="loginEmail">Email cím</label>
      <input type="email" class="form-control" id="loginEmail" aria-describedby="emailHelp" name="email" value="<?= isset($postData) ? $postData['email'] : '';?>" required>
      <small id="emailHelp" class="form-text text-muted"></small>
    </div>
  </div>
  <div class="form-row justify-content-md-center">
    <div class="form-group col-md-4">
      <label for="loginPassword">Jelszó</label>
      <input type="password" class="form-control" id="loginPassword" name="password" value="" required>
    </div>
  </div>
  <div class="row justify-content-md-center">
    <div class="col-md-auto">
      <button type="submit" class="btn btn-primary" name="login">Login</button>
    </div>
  </div>
  <div class="row justify-content-md-center">
    <div class="col-md-auto">
      <a href="<?='index.php?P=forgottenPassword' ?>" >Elfelejtett jelszó</a>
    </div>
  </div>
</form>
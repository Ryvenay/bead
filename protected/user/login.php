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


<form method="post">
  <div class="form-group">
    <label for="loginEmail">Email cím</label>
    <input type="email" class="form-control" id="loginEmail" aria-describedby="emailHelp" name="email" value="<?= isset($postData) ? $postData['email'] : '';?>">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-group">
    <label for="loginPassword">Jelszó</label>
    <input type="password" class="form-control" id="loginPassword" name="password" value="">
  </div>
  <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>
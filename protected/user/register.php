<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
        $postData = [
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'address' => $_POST['address'],
            'zip' => $_POST['zip'],
            'city' => $_POST['city'],
            'country' => $_POST['country'],
            'email' => $_POST['email'],
            'email1' => $_POST['email1'],
            'password' => $_POST['password'],
            'password1' => $_POST['password1']
        ];

        if(empty($postData['first_name']) || empty($postData['last_name']) || empty($postData['address']) || empty($postData['zip']) || empty($postData['city']) || empty($postData['country']) || empty($postData['email']) || empty($postData['email1']) || empty($postData['password']) || empty($postData['password1'])) {
            echo "Hiányzó adat(ok)!";
        } else if($postData['email'] != $postData['email1']) {
            echo "Az email címek nem egyeznek!";
        } else if(!filter_var($postData['email'], FILTER_VALIDATE_EMAIL)) {
            echo "Hibás email formátum!";
        } else if ($postData['password'] != $postData['password1']) {
            echo "A jelszavak nem egyeznek!";
        } else if(strlen($postData['password']) < 6) {
            echo "A jelszó túl rövid! Legalább 6 karakter hosszúnak kell lennie!";
        } else if(!UserRegister($postData['email'], $postData['password'], $postData['first_name'], $postData['last_name'], $postData['address'], $postData['zip'], $postData['city'], $postData['country'])) {
            echo "Sikertelen regisztráció!";
        }

        $postData['password'] = $postData['password1'] = "";
    }
?>

<form method="post">
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="registerFirstName">Keresztnév</label>
			<input type="text" class="form-control" id="registerFirstName" name="first_name" value="<?=isset($postData) ? $postData['first_name'] : "";?>" required>
		</div>
		<div class="form-group col-md-6">
			<label for="registerLastName">Vezetéknév</label>
			<input type="text" class="form-control" id="registerLastName" name="last_name" value="<?=isset($postData) ? $postData['last_name'] : "";?>" required>
		</div>
	</div>
    <div class="form-row">
		<div class="form-group col-md-12">
			<label for="registerAddress">Utca, házszám</label>
			<input type="text" class="form-control" id="registerAddress" name="address" value="<?=isset($postData) ? $postData['address'] : "";?>" required>
		</div>

	</div>

    <div class="form-row">

        <div class="form-group col-md-2">
			<label for="registerZip">Irányítószám</label>
			<input type="number" class="form-control" id="registerZip" name="zip" min="0" value="<?=isset($postData) ? $postData['postal'] : "";?>" required>
		</div>
		<div class="form-group col-md-4">
			<label for="registerCity">Település</label>
			<input type="text" class="form-control" id="registerCity" name="city" value="<?=isset($postData) ? $postData['city'] : "";?>" required>
		</div>
        <div class="form-group col-md-6">
            <label for="registerCountry">Ország</label>
            <select class="form-control" id="registerCountry" name="country" required>
                <option value="<?=isset($postData) ? $postData['country'] : "";?>" disabled selected>Válassz</option>
                <option value="Hungary">Magyarország</option>
                <option value="Kyrgyzstan">Kirgizisztán</option>
                <option value="Afghanistan">Afganisztán</option>
                <option value="Sudan">Szudán</option>
                <option value="Cambodia">Kambodzsa</option>
            </select>
        </div>
    </div>

	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="registerEmail">Email</label>
			<input type="email" class="form-control" id="registerEmail" name="email" value="<?=isset($postData) ? $postData['email'] : "";?>" required>
		</div>
		<div class="form-group col-md-6">
			<label for="registerEmail1">Email megerősítés</label>
			<input type="email" class="form-control" id="registerEmail1" name="email1" value="<?=isset($postData) ? $postData['email1'] : "";?>" required>
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="registerPassword">Jelszó</label>
			<input type="password" class="form-control" id="registerPassword" name="password" value="" required>
		</div>
		<div class="form-group col-md-6">
			<label for="registerPassword1">Jelszó megerősítés</label>
			<input type="password" class="form-control" id="registerPassword1" name="password1" value="" required>
		</div>
	</div>

	<button type="submit" class="btn btn-primary" name="register">Register</button>
</form>
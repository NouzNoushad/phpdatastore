<?php

	//connect to database
	include('./config/db.php');

	//validation
	$name = $email = $profession = $company = $hobbies = '';
	$errors = ['name' => '', 'email' => '', 'profession' => '', 'company' => '', 'hobbies' => ''];
	if(isset($_POST['submit'])){
		if(empty($_POST['name'])){
			$errors['name'] = 'Please fill name field';
		}else{
			$name = $_POST['name'];
			if(!preg_match('/^[a-zA-Z0-9\s]+$/', $name)){
				$errors['name'] = 'Name should not have special characters';
			}
		}
		if(empty($_POST['email'])){
			$errors['email'] = 'Please fill email field';
		}else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Please provide proper email';
			}
		}
		if(empty($_POST['profession'])){
			$errors['profession'] = 'Please fill profession field';
		}else{
			$profession = $_POST['profession'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $profession)){
				$errors['profession'] = 'Profession should not have numbers and special characters';
			}
		}
		if(empty($_POST['company'])){
			$errors['company'] = 'Please fill company field';
		}else{
			$company = $_POST['company'];
			if(!preg_match('/^[a-zA-Z0-9\s]+$/', $company)){
				$errors['company'] = 'Company should not have special characters';
			}
		}
		if(empty($_POST['hobbies'])){
			$errors['hobbies'] = 'Please fill hobbies field';
		}else{
			$hobbies = $_POST['hobbies'];
			if(!preg_match('/^([a-zA-Z0-9\s]*)(,\s*[a-zA-Z0-9\s]*)*$/', $hobbies)){
				$errors['hobbies'] = 'Hobbies should be comma seperated. not allow other special chars';
			}
		}

		//errors
		if(array_filter($errors)){
			echo 'there is an error';
		}else{
	
			$name = mysqli_real_escape_string($conn, $_POST['name']);
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$profession = mysqli_real_escape_string($conn, $_POST['profession']);
			$company = mysqli_real_escape_string($conn, $_POST['company']);
			$hobbies = mysqli_real_escape_string($conn, $_POST['hobbies']);

			// write query to add details
			$sql = "INSERT INTO details(name, email, profession, company, hobbies) VALUES('$name', '$email', '$profession', '$company', '$hobbies')";
			// call query and save it
			if(mysqli_query($conn, $sql)){
				header('Location: main.php');
			}else{
				echo 'Query error' . mysqli_error($conn);
			}
		}
	}

?>

<!DOCTYPE html>
<html lang="en">
	<?php include('./templates/header.php')?>
	<div class="container">
	<div class="row my-5">
		<div class="col-md-7 m-auto">
			<div class="card card-body my-5">
				<form action="form.php" method="POST">
					<div class="row justify-content-center mt-5">
						<div class="col-sm-9">
							<input type="text" name="name" id="name" class="form-control" placeholder="Name" value="<?= htmlspecialchars($name)?>">
							<small class="text-danger"><?= $errors['name']?></small>
						</div>
					</div>
					<div class="row justify-content-center mt-3">
						<div class="col-sm-9">
							<input type="email" name="email" id="email" class="form-control" placeholder="Email" value="<?= htmlspecialchars($email)?>">
							<small class="text-danger"><?= $errors['email']?></small>
						</div>
					</div>
					<div class="row justify-content-center mt-3">
						<div class="col-sm-9">
							<input type="text" name="profession" id="profession" class="form-control" placeholder="Profession" value="<?= htmlspecialchars($profession)?>">
							<small class="text-danger"><?= $errors['profession']?></small>
						</div>
					</div>
					<div class="row justify-content-center mt-3">
						<div class="col-sm-9">
							<input type="text" name="company" id="company" class="form-control" placeholder="Company" value="<?= htmlspecialchars($company)?>">
							<small class="text-danger"><?= $errors['company']?></small>
						</div>
					</div>
					<div class="row justify-content-center mt-3">
						<div class="col-sm-9">
							<input type="text" name="hobbies" id="hobbies" class="form-control" placeholder="Hobbies" value="<?= htmlspecialchars($hobbies)?>">
							<small class="text-danger"><?= $errors['hobbies']?></small>
						</div>
					</div>
					<div class="row justify-content-center mt-4 mb-5">
						<div class="col-sm-9">
							<button type="submit" name="submit" id="submit" class="btn btn-primary form-control">Submit</button>
							<a href="main.php" class="btn btn-secondary form-control mt-2">Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	</div>
	<?php include('./templates/footer.php')?>
</html>
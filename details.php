<?php

// connect to database
include('./config/db.php');

if(isset($_POST['delete'])){

	$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
	// create query to delete data
	$sql = "DELETE FROM details WHERE id = $id_to_delete";
	// call query
	if(mysqli_query($conn, $sql)){
		header('Location: main.php');
	}else{
		echo 'Query error' . mysqli_error($conn);
	}
}

if(isset($_GET['id'])){

	$id = mysqli_real_escape_string($conn, $_GET['id']);
	// create query 
	$sql = "SELECT * FROM details WHERE id = $id";
	// call query
	$result = mysqli_query($conn, $sql);
	// fetch row into array
	$detail = mysqli_fetch_assoc($result);
	// free result memory
	mysqli_free_result($result);
	// close connection
	mysqli_close($conn);

}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('./templates/header.php');?>
<div class="container">
		<div class="row my-5 py-5">
			<div class="col-md-6 m-auto">
				<div class="card card-body">
					<div class="col">
						<div class="card border-primary" >
						<div class="card-body">
							<h3 class="card-title"><?= htmlspecialchars($detail['name'])?></h3>
							<div class="row">
								<label class="col-sm-4 col-form-label">Email</label>
								<div class="col-sm-5 mt-2">
									:	<?= htmlspecialchars($detail['email'])?>
								</div>
							</div>
							<div class="row">
								<label class="col-sm-4 col-form-label">Profession</label>
								<div class="col-sm-5 mt-2">
									:	<?= htmlspecialchars($detail['profession'])?>
								</div>
							</div>
							<div class="row">
								<label class="col-sm-4 col-form-label">Company</label>
								<div class="col-sm-5 mt-2">
									:	<?= htmlspecialchars($detail['company'])?>
								</div>
							</div>
							<div class="row">
								<label class="col-sm-4 col-form-label">hobbies</label>
								<div class="col-sm-5 mt-2">
									:	<?= htmlspecialchars($detail['hobbies'])?>
								</div>
							</div>
						</div>
						</div>
					</div>
					<div class="d-grid justify-content-end">
						<form action="details.php" method="POST">
							<input type="hidden" name="id_to_delete" value="<?= htmlspecialchars($detail['id'])?>">
							<input type="submit" name="delete" class="btn btn-outline-danger mt-2" value="Delete Data">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include('./templates/footer.php');?>

</html>
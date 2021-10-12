<?php

include('./config/db.php');
// write query to connect database
$sql = "SELECT name, email, profession, company, hobbies, id, created_at FROM details ORDER BY created_at";
// get query 
$result = mysqli_query($conn, $sql);
// fetch resulting row into array
$details = mysqli_fetch_all($result, MYSQLI_ASSOC);
// free result memory
mysqli_free_result($result);
// close connection
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
	<?php include('./templates/header.php')?>
	<div class="container">
		<div class="row my-5 py-5">
			<div class="col-md-10 m-auto">
				<div class="card-body">
					<div class="row row-cols-1 row-cols-md-3 g-4">
					<?php foreach($details as $detail): ?>
						<div class="col">
							<div class="card border-primary" >
							<div class="card-body">
								<h3 class="card-title"><?= htmlspecialchars($detail['name'])?></h3>
								<h6 class="card-subtitle mb-2 text-muted"><?= date($detail['created_at'])?></h6>
								<h6 class="card-text"><?= htmlspecialchars($detail['profession'])?></h6>
								<a href="details.php?id=<?= htmlspecialchars($detail['id'])?>" class="card-link">More Info</a>
							</div>
							</div>
						</div>
					<?php endforeach ?>
					</div>
				</div>
				<div class="d-grid justify-content-center">
				<a href="form.php" class="btn btn-outline-primary mt-2 ">Add New Data</a>
				</div>
			</div>
		</div>
	</div>
	<?php include('./templates/footer.php')?>
</html>
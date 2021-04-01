<?php $usernameValue = isset($username) ? 'value="' . $username . '"' : ""; ?>
<main>

	<div class="row justify-content-center">
		<div class="col-md-6">
			<div class="card">
				<header class="card-header">
					
					<h4 class="card-title mt-2">Create Job</h4>
				</header>
				<article class="card-body">
					<form method="post">
						<div class="form-row">
							<div class="form-group">
							<label>Created By  </label>
								<input type="text" name="CreatedBy" class="form-control" placeholder="">
							</div> <!-- form-group end.// -->
							<div class="form-group">
								<label>Job Details  </label>
								<input type="text" name="jobDetails" class="form-control" placeholder="">
							</div> <!-- form-group end.// -->
							<div class="col form-group">
								<label>Job Status</label>
								<input type="text" name="JobStatus" class="form-control" placeholder=" ">
				
						<div class="form-group">
							<label>Equipment Required </label>
							<input name="EquipmentRequired" type="text" class="form-control" placeholder="">

							<div class="form-group">
							<label>Duration Estimate </label>
							<input name="DurationEstimate" type="text" class="form-control" placeholder="">

							<div class="form-group">
							<label>Willing to Pay </label>
							<input name="JobPrice" type="text" class="form-control" placeholder="">

							<div class="form-group">
							<label>Date Created </label>
							<input name="DateCreated" type="text" class="form-control" placeholder="">

														
						
					
						
							<div class="form-group col-md-6">
								<label>County</label>
								<input name="County" type="text" class="form-control">
					
										
						<div class="form-group">
							<button name="CreateButton" type="submit" class="btn btn-primary btn-block"> Create Job </button>
						</div> <!-- form-group// -->
					
					</form>
				



	</div>
	<?php if (!empty($errors)) : ?>
		<div class="alert alert-danger">
			<?php foreach ($errors as $field => $error) : ?>
				<p><?= $error ?></p>
			<?php endforeach ?>
		</div>
	<?php endif ?>
	<!--container end.//-->
</main>
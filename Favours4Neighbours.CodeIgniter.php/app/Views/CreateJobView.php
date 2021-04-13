<?php helper(["form"]); ?>
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
								<input name="Username" name="CreatedBy" class="form-control" placeholder="">
							</div> <!-- form-group end.// -->
							


							<div class="form-group col-md-6">
								<label>JobCategory</label>
								<?= form_dropdown('Category', $jobcategoryDataSource, set_value("Category"), 'class="form-control"'); ?>
								</div> <!-- form-row.// -->

							<div class="form-group">
								<label>Job Details  </label>
								<input type="text" name="JobDetails" class="form-control" placeholder="Enter job description here 200 characters max">
							</div> <!-- form-group end.// -->
				
						<div class="form-group">
							<label>Equipment Required </label>
							<input name="EquipmentRequired" type="text" class="form-control" placeholder="Enter deials of the equipment the applicant should bring">

							<div class="form-group">
							<label>Duration Estimate </label>
							<input name="DurationEstimate" type="text" class="form-control" placeholder="Indicate the estimate of time required">

							<div class="form-group">
							<label>Willing to Pay </label>
							<input name="JobPrice" type="text" class="form-control" placeholder="specify amount willing to pay here in Euro">

							

														
							<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">County
    <span class="caret"></span></button>
    <ul class="dropdown-menu">
      <li><a href="#">Gardening</a></li>
      <li><a href="#">CSS</a></li>
      <li><a href="#">JavaScript</a></li>
    </ul>
  </div>
					
						
						
					
										
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
<?php helper(["form"]); ?>
<div class="row justify-content-center">
	<div class="col-md-6">
		<div class="card">
			<header class="card-header">
				<h4 class="card-title mt-2">Enter Job Details</h4>
			</header>
			<article class="card-body">
				<form method="post">
					<div class="form-row">
						<div class="form-group col-md-6">
							<label>Category</label>
							<?= form_dropdown('JobCategory', $jobCategoryDataSource, set_value("JobCategory"), 'class="form-control"'); ?>
						</div> <!-- Category form-group.// -->

						<div class="form-group">
							<label>Details</label>
							<input type="text" name="JobDetails" class="form-control" placeholder="Enter job description here 200 characters max", value="<?= set_value("JobDetails") ?>">
						</div> <!-- Details form-group end.// -->

						<div class="form-group">
							<label>Equipment Required </label>
							<input name="EquipmentRequired" type="text" class="form-control" placeholder="Enter deials of the equipment the applicant should bring", value="<?= set_value("EquipmentRequired") ?>">
						</div> <!-- Equipment form-group end.// -->

						<div class="form-group">
							<label>Duration Estimate </label>
							<input name="DurationEstimate" type="text" class="form-control" placeholder="Indicate the estimate of time required", value="<?= set_value("DurationEstimate") ?>">
						</div> <!-- DurationEstimate form-group end.// -->

						<div class="form-group">
							<label>Willing to Pay </label>
							<input name="JobPrice" type="text" class="form-control" placeholder="specify amount willing to pay here in Euro", value="<?= set_value("JobPrice") ?>">
						</div> <!-- JobPrice form-group end.// -->


						<div class="form-group col-md-6">
							<label>County</label>
							<?= form_dropdown("JobCounty", $jobCountyDataSource, set_value("JobCounty"), 'class="form-control"'); ?>
						</div> <!-- County form-group.// -->



						<div class="form-group">
							<button name="CreateButton" type="submit" class="btn btn-primary btn-block"> Create Job </button>
						</div> <!-- form-group// -->
				</form>
			</article>
		</div>
		<?php if (!empty($errors)) : ?>
			<div class="alert alert-danger">
				<?php foreach ($errors as $field => $error) : ?>
					<p><?= $error ?></p>
				<?php endforeach ?>
			</div>
		<?php endif ?>
	</div>
</div>
<!--container end.//-->
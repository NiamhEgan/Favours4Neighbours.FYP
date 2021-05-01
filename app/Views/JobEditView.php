<?php if (isset($message)) : ?>
	<?= $message; ?>
<?php endif ?>
<?php helper(["form"]); ?>
<div class="row justify-content-center">
	<div class="col-md-6">
		<div class="card">
			<header class="card-header">
				<h4 class="card-title mt-2">Edit Job Details</h4>
			</header>
			<article class="card-body">
				<form method="post">
					<div class="form-col">
						<div class="form-group">
							<label>Assigned To:</label>
							<?= form_dropdown('AssignedTo', $asssignedToDataSource, set_value("AssignedTo", $job["AssignedTo"]), 'class="form-control"'); ?>
						</div> <!-- AssignedTo form-group.// -->
						<div class="form-group">
							<label>Category</label>
							<?= form_dropdown('JobCategory', $jobCategoryDataSource, set_value("JobCategory", $job["JobCategory"]), 'class="form-control"'); ?>
						</div> <!-- Category form-group.// -->

						<div class="form-group">
							<label>Details</label>
							<input type="text" name="JobDetails" class="form-control" placeholder="Enter job description here 200 characters max" , value="<?= set_value("JobDetails", $job["JobDetails"]) ?>" ;>
						</div> <!-- Details form-group end.// -->

						<div class="form-group">
							<label>Equipment Required </label>
							<input name="EquipmentRequired" type="text" class="form-control" placeholder="Enter deials of the equipment the applicant should bring" value="<?= set_value("EquipmentRequired", $job["EquipmentRequired"]) ?>" ;>
						</div> <!-- Equipment form-group end.// -->

						<div class="form-group">
							<label>Duration Estimate </label>
							<input name="DurationEstimate" type="text" class="form-control" placeholder="Indicate the estimate of time required" value="<?= set_value("DurationEstimate", $job["DurationEstimate"]) ?>" ;>
						</div> <!-- DurationEstimate form-group end.// -->

						<div class="form-group">
							<label>Willing to Pay </label>
							<input name="JobPrice" type="text" class="form-control" placeholder="specify amount willing to pay here in Euro" value="<?= set_value("JobPrice", $job["JobPrice"]) ?>" ;>
						</div> <!-- JobPrice form-group end.// -->


						<div class="form-group">
							<label>County</label>
							<?= form_dropdown("JobCounty", $jobCountyDataSource, set_value("JobCounty", $job["JobCounty"]), 'class="form-control"'); ?>
						</div> <!-- County form-group.// -->

						<div class="form-group">
							<label>Status</label>
							<?= form_dropdown("JobStatus", $jobStatusDataSource, set_value("JobStatus", $job["JobStatus"]), 'class="form-control"'); ?>
						</div> <!-- County form-group.// -->


						<div class="form-group">
							<button name="SaveButton" type="submit" class="btn btn-primary btn-block">Save</button>
						</div>
				</form>
			</article>
		</div>
		<?php if (!empty($errors)) : ?>
			<div class="alert alert-danger">
					<p><?= $errors ?></p>
			</div>
		<?php endif ?>
	</div>
</div>
<!--container end.//-->
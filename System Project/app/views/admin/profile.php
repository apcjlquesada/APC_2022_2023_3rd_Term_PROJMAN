<?php require APPROOT . "/views/templates/adminHeader.php"; ?>
	
	<!------------------- Start - Customer's Information ----------------->
	<section class="card container p-2 my-3">
		<div>
			<h1 class="card-title">
				Personal Information:
				<a class="btn btn-primary float-end me-1" href="<?php echo URLROOT."/admin";?>">
					<i class="fa fa-angle-double-left"></i> Back
				</a>
				<a href="<?php echo URLROOT."/admin/profile/updateProfile/"; ?>" class="btn btn-primary float-end me-1">
					<i class="fa fa-pencil"></i> Update
				</a>
			</h1>
		</div>
		<div class="card card-body m-3">
			<div>
				<h4>
					Customer's name: <?php echo $data["admin_info"]->fname . " " . $data["admin_info"]->lname; ?>
				</h4>
				<b>Customer ID:</b> <?php echo $data["admin_info"]->id; ?> <br/>
				<b>Contact Number:</b> <?php echo $data["admin_info"]->contactNumber; ?> <br/>
				<b>Email Address:</b> <?php echo $data["admin_info"]->email; ?> <br/>
				<b>Address:</b> <?php echo $data["admin_info"]->streetAddress .", ". $data["admin_info"]->city .", ". $data["admin_info"]->province .", ". $data["admin_info"]->postalCode; ?> <br/>
				<b>Profile Created On:</b> <?php echo $data["admin_info"]->createdOn; ?> <br/>
			</div>
		</div>
	</section>
	<!------------------- End - Customer's Information ----------------->


<?php require APPROOT . "/views/templates/footer.php"; ?>
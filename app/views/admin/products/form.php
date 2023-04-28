<?php require APPROOT . "/views/templates/adminHeader.php"; ?>

<div class="card card-body bg-light mt-3">
	<h1>
		<?php echo ($data["action"]=="add") ? "Add Product" : "Update Product Information"  ?>
	</h1>
	<p>Input the product details by using the form below</p>
	<form action="<?php echo URLROOT."/admin/products/".($data["action"]=="edit" ? "edit/".$data["id"] : "add"); ?>" method="post" enctype="multipart/form-data">
		<div class="form-group mb-3">
			<label for="id">Product ID: <sup>*</sup></label>
			<input type="text" name="id" class="form-control form-control-lg" value="<?php echo $data["id"]; ?>" readonly>
			
			<label for="product_name">Product Name: <sup>*</sup></label>
			<input type="text" name="product_name" class="form-control form-control-lg <?php echo (isset($data["error"]["product_name_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["product_name"]; ?>" required>
			<span class="invalid-feedback"><?php echo (isset($data["error"]["product_name_err"]) ? $data["error"]["product_name_err"] : "") ?></span>

            <label for="category">Category: <sup>*</sup></label>
            <input type="text" name="category" class="form-control form-control-lg <?php echo (isset($data["error"]["category_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["category"]; ?>" required>
            <span class="invalid-feedback"><?php echo (isset($data["error"]["category_err"]) ? $data["error"]["category_err"] : "") ?></span>
			
			<label for="details">Details: <sup>*</sup></label>
			<textarea type="text" name="details" class="form-control form-control-lg <?php echo (isset($data["error"]["details_err"])) ? "is-invalid" : ""; ?>" required><?php echo $data["details"]; ?></textarea>
			<span class="invalid-feedback"><?php echo (isset($data["error"]["details_err"]) ? $data["error"]["details_err"] : "") ?></span> <br/>
            
            <?php if($data["action"] == "add") { ?>
                <label for="img">Upload an image: <p class="text-muted my-0">(advisable to use PNG image)</p></label><br/>
                <input type="file" name="img" id="img" value="">
                <span class="invalid-feedback"><?php echo (isset($data["error"]["img_err"]) ? $data["error"]["img_err"] : "") ?></span><br/><br/>
            
            <?php } else { ?>
                <label for="img">Change image: (<?php echo $data["img"]?>)<p class="text-muted my-0">(advisable to use PNG image)</p></label><br/>
                <input type="file" name="img" id="img" value="<?php echo $data["img"] ?>">
                <span class="invalid-feedback"><?php echo (isset($data["error"]["img_err"]) ? $data["error"]["img_err"] : "") ?></span><br/><br/>
            
            <?php } ?>
		</div>
		<input type="submit" class="btn btn-success" value="Submit">
		<a class="btn btn-primary" href="<?php echo REFERER;?>">
			<i class="fa fa-angle-double-left"></i> Back
		</a>
	</form>
</div>

<?php require APPROOT . "/views/templates/footer.php"; ?>

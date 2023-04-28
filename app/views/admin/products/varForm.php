<?php require APPROOT . "/views/templates/adminHeader.php"; ?>

<div class="card card-body bg-light mt-3">
    <h1>
		<?php echo ($data["action"]=="add") ? "Add Variation" : "Update Variation"  ?>
    </h1>
    <p>Input the product variation details by using the form below</p>
    <form action = "<?php echo URLROOT."/admin/products/".($data["action"]=="edit" ? "editVar/".$data["id"] : "addVar/".$data["productId"]); ?>" method="post" enctype="multipart/form-data">
        <div class="form-group mb-3">
            <label for="productId" class="col-form-label">Product ID: <sup>*</sup></label>
            <input type="text" name="productId" class="form-control form-control-lg" value="<?php echo $data["productId"]; ?>" id="productId" readonly>

            <label for="product_name">Product Name: <sup>*</sup></label>
            <input type="text" name="product_name" class="form-control form-control-lg" value="<?php echo $data["product_name"]; ?>" id="product_name" readonly>

            <label for="color">Color: <sup>*</sup></label>
            <input type="text" name="color" class="form-control form-control-lg <?php echo (isset($data["error"]["color_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["color"]; ?>" required>
            <span class="invalid-feedback"><?php echo (isset($data["error"]["color_err"])) ? $data["error"]["color_err"] : ""; ?></span>

            <label for="size">Size: <sup>*</sup></label>
            <input type="text" name="size" class="form-control form-control-lg <?php echo (isset($data["error"]["size_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["size"]; ?>" required>
            <span class="invalid-feedback"><?php echo (isset($data["error"]["size_err"])) ? $data["error"]["size_err"] : ""; ?></span>

            <label for="stock">Stock: <sup>*</sup></label>
            <input type="number" name="stock" min="0" class="form-control form-control-lg <?php echo (isset($data["error"]["stock_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["stock"]; ?>" required>
            <span class="invalid-feedback"><?php echo (isset($data["error"]["stock_err"])) ? $data["error"]["stock_err"] : ""; ?></span>

            <label for="price">Price: <sup>*</sup></label>
            <input type="number" name="price" min="0" class="form-control form-control-lg <?php echo (isset($data["error"]["price_err"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["price"]; ?>" required>
            <span class="invalid-feedback"><?php echo (isset($data["error"]["price_err"])) ? $data["error"]["price_err"] : ""; ?></span> <br/>
            
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
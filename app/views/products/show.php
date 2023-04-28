<?php require APPROOT . "/views/templates/header.php"; ?>
<div class="container mt-3">
	<?php if(!$data['product']){
		echo "<div class='card card-body mb-3 text-center'><b>Not able to get any data! Please Contact Support.</b></div>";}
	
	else{ ?>
        <form action="<?php echo URLROOT.'/transactions/addToCart'?>" method="post" style="display: inline">
            <div class="row">
                <div class="row row-cols-lg-2 row-cols-md-2 row-cols-1">
                    <div class="col-lg-4 col-md-4 col p-0 border">
                        <div class="card h-100 m-auto" style="min-height: 600px">
                            <div class="carousel carousel-main js-flickity mb-5" data-flickity-options='{ "wrapAround": true, "autoPlay": true }' id="showProductCarousel">
								<?php if($data["product"]->img != DEFAULTIMAGE) { ?>
                                    <div class="carousel-cell" style="background: rgba(239, 239, 240, 80%);">
                                        <img src="<?php echo URLROOT."/img/products/".$data["product"]->img ?>" class="h-100 d-block w-100" alt="<?php echo $data["product"]->img; ?>">
                                    </div>
								<?php } ?>
								<?php foreach($data['productVars'] as $productVar) : ?>
									<?php if($productVar->varImg != DEFAULTIMAGE) { ?>
                                        <div class="carousel-cell" style="background: rgba(239, 239, 240, 80%);">
                                            <img src="<?php echo URLROOT."/img/products/".$productVar->varImg ?>" class="h-100 d-block w-100" alt="<?php echo $data["product"]->varImg; ?>">
                                            <div class="carousel-caption d-none d-md-block text-wrap mx-auto" >
                                                <h5><?php echo $productVar->color ?></h5>
                                                <p><?php echo $productVar->size ?></p>
                                            </div>
                                        </div>
									<?php } ?>
								<?php endforeach; ?>
                            </div>
                            <div>
								<?php foreach($data['productVars'] as $productVar) : ?>
                                    <input type="radio" name="varId" class="btn-check var-selector" id="<?php echo $productVar->id; ?>" autocomplete="off" value="<?php echo $productVar->id; ?>" priceValue="<?php echo $productVar->price; ?>" quantityValue="<?php echo $productVar->stock; ?>">
                                    <label class="btn btn-outline-primary" for="<?php echo $productVar->id; ?>">
										<?php echo $productVar->color." ".$productVar->size ?>
                                    </label>
								<?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col border card h-100 p-0">
                        <div class="container mt-4">
                            <div class="card-body">
                                <a class="btn btn-primary float-end me-1" href="<?php echo URLROOT;?>/products">
                                    <i class="fa fa-angle-double-left"></i> Back
                                </a>
                                <p class="h3">
                                    <b>Product Name: </b> <?php echo $data['product']->product_name; ?>
                                </p>
                                <p class="h5">
                                    <b>Category: </b> <?php echo $data['product']->category; ?>
                                </p>
                                <p class="h5">
                                    <b>Details: </b> <?php echo $data['product']->details; ?>
                                </p>
                                <p class="h5">
                                    <b>Price: </b><span id='price'></span>
                                </p>
                                <p class="h5">
                                    <b>Stock: </b><span id='stock'></span>
                                </p>
                                <p class="h5">
                                    <b>Quantity: </b>
                                    
                                    <input id="quantity" type="number" name="quantity" min="0" class="form-control form-control-lg" required>
                                    <p class="text-muted">Please choose within the stock:</p>
                                </p>
                                <p class="text-muted">Choose a variety at the left to see price and stocks available.</p>
                            </div>
                            <script>
                                let rows = document.querySelectorAll(".var-selector");
                                let outputPrice = document.getElementById('price');
                                let outputStock = document.getElementById('stock');
                                
                                rows.forEach(row => {
                                    row.addEventListener('click', function() {
                                        var doc = document.getElementById(this.value);
                                        var priceValue = doc.getAttribute("priceValue");
                                        var quantityValue = doc.getAttribute("quantityValue");
                                        outputPrice.textContent = priceValue+"php";
                                        outputStock.textContent = quantityValue;
                                    });
                                })
                            </script>
                            <span class="position-absolute bottom-0 end-0 m-4">
                                <input type="submit" value="Add to Cart" class="btn btn-primary float-end me-1">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
	<?php } ?>
</div>
<?php require APPROOT . "/views/templates/footer.php"; ?>

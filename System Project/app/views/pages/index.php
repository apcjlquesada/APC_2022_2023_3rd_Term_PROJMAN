<?php require APPROOT . '/views/templates/header.php'; ?>
    <div class="container">
        <div class="carousel js-flickity mb-5" data-flickity-options='{ "wrapAround": true, "autoPlay": true }'>
            <?php foreach($data["featuredProducts"] as $product) : ; ?>
                <div class="carousel-cell" style="background: rgba(239, 239, 240, 80%);">
                    <img src="<?php echo URLROOT."/img/products/".$product->varImg ?>" class="h-100 d-block w-50" alt="<?php echo $product->product_name; ?>">
                    <div class="carousel-caption d-none d-md-block text-wrap mx-auto" >
                        <h5><?php echo $product->product_name ?></h5>
                        <p><?php echo $product->color ?></p>
                        <p><?php echo $product->size ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    
        <div class="container-fluid">
            <h1 class="display-5">
                <?php echo $data['title']; ?>
            </h1>
            <div class="row m-2">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <?php foreach($data["featuredProducts"] as $product) : ?>
                        <div class="col px-5">
                            <div class="card h-100">
                                <div class="m-auto h-100">
                                    <img src="<?php echo URLROOT."/img/products/".($product->varImg == DEFAULTIMAGE ? $product->productImg : $product->varImg); ?>" class=" img-thumbnail card-img-top rounded h-100" alt="<?php echo URLROOT."/img/products/".($product->varImg == DEFAULTIMAGE ? $product->productImg : $product->varImg); ?>" style="max-height: 300px">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $product->product_name; ?></h5>
                                    <p class="card-text"><?php echo $product->color ?></p>
                                    <p class="card-text"><?php echo $product->size ?></p>
                                    <p class="card-text"><?php echo $product->details ?></p>
                                    <p class="card-text"><?php echo $product->price."php" ?></p>
                                    <a href="<?php echo URLROOT."/products/show/".$product->productId ?>" class="btn btn-primary stretched-link">See Details</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/templates/footer.php'; ?>
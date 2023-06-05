<?php require APPROOT . '/views/templates/header.php'; ?>
<!--<div class="container">-->
    <div class="row row-cols-sm-1 mx-3 mt-2">
        <div class="dropdown col-sm-1">
            <button class="btn dropdown-toggle" type="button" id="category" data-bs-toggle="dropdown" aria-expanded="false">
                Category
            </button>
            <ul class="dropdown-menu" aria-labelledby="category"> <!--- Filter not working yet --->
                <?php foreach($data['categories'] as $category) : ?>
                    <li><a class="dropdown-item" href="#"><?php echo $category->category; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="dropdown col-sm-1">
            <button class="btn dropdown-toggle" type="button" id="category" data-bs-toggle="dropdown" aria-expanded="false">
                Color
            </button>
            <ul class="dropdown-menu" aria-labelledby="category"> <!--- Filter not working yet --->
				<?php foreach($data['colors'] as $color) : ?>
                    <li><a class="dropdown-item" href="#"><?php echo $color->color; ?></a></li>
				<?php endforeach; ?>
            </ul>
        </div>
        <div class="dropdown col-sm-1">
            <button class="btn dropdown-toggle" type="button" id="category" data-bs-toggle="dropdown" aria-expanded="false">
                Price Range
            </button>
            <ul class="dropdown-menu" aria-labelledby="category"> <!--- Filter not working yet --->
				<?php foreach($data['price_range'] as $price_range) : ?>
                    <li><a class="dropdown-item" href="#"><?php echo $price_range->price_range; ?></a></li>
				<?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="row m-2">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach($data['activeProducts'] as $product) : ?>
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
                            <p class="card-text"><?php echo $product->price ?>php</p>
                            <a href="<?php echo URLROOT."/products/show/".$product->productId ?>" class="btn btn-primary">See Details</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

<?php require APPROOT . '/views/templates/footer.php'; ?>
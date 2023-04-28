<?php require APPROOT . "/views/templates/adminHeader.php"; ?>
    <div class="row row-cols-md-2 row-cols-1">
        <div class="col container-fluid m-auto">
            <a href="<?php echo URLROOT; ?>/admin/products/add" class="btn btn-primary float-end w-100">
                <i class="fa fa-plus"></i> Add Product
            </a>
        </div>
        <div class="col container-fluid m-auto">
            <form class = "d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            </form>
        </div>
    </div>
    
    <!------------------------------ Start Tabs ----------------------------->
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-all" aria-selected="true">
                All
            </button>
            <button class="nav-link" id="nav-active-tab" data-bs-toggle="tab" data-bs-target="#nav-active" type="button" role="tab" aria-controls="nav-active" aria-selected="false">
                Active
            </button>
            <button class="nav-link" id="nav-archived-tab" data-bs-toggle="tab" data-bs-target="#nav-archived" type="button" role="tab" aria-controls="nav-archived" aria-selected="false">
                Archived
            </button>
        </div>
    </nav>
    <!------------------------------ End Tabs ----------------------------->
    
    <!------------------------- START TAB CONTENTS ---------------------------->
    <div class="tab-content" id="nav-tabContent">
        <!-------------- ALL PRODUCTS ---- Showing NO Variations on top --------------->
        <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-all-tab">
            <div class="container my-3">
                <div class="col-md-6">
                    <h2 id="allPage">All Products</h2>
                </div>
				<?php foreach($data["products"] as $product) : ?>
                    <div class="card card-body mb-3">
                        <h4 class="card-title">
                            Product's Name: <?php echo $product->product_name; ?>
                            <form action="<?php echo URLROOT."/admin/products/".(($product->active) ? "archive" : "enable")."/".$product->id; ?>" method="post" style="display: inline">
                                <input type="submit" value="<?php echo (($product->active) ? "Archive" : "Enable")?>" class="btn float-end me-1 <?php echo ($product->active ? "btn-danger" : "btn-success") ?> " <?php echo (!$product->varId ? "disabled" : "") ?> >
                            </form>
                            <a href="<?php echo URLROOT."/admin/products/edit/".$product->id; ?>" class="btn btn-primary float-end me-1">
                                <i class="fa fa-pencil"></i> Update
                            </a>
                            <a class="btn btn-primary float-end me-1" href="<?php echo URLROOT."/admin/products/show/".$product->id; ?>">
                                <i class="fa fa-eye"></i> View
                            </a>
                        </h4>
						<?php echo (!isset($product->varId) ? "<i class='fa fa-exclamation-triangle' style='font-size:20px;color:red'>No Variations Detected</i>" : "" ) ?>
                    </div>
	
				<?php endforeach; ?>
            </div>
        </div>

        <!-------------------------- ACTIVE PRODUCTS ------------------------------->
        <div class="tab-pane fade" id="nav-active" role="tabpanel" aria-labelledby="nav-active-tab">
            <div class="container my-3" id="activeProducts">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h2 id="activePage">Active Products</h2>
                    </div>
                </div>
				<?php foreach($data["activeProducts"] as $product) : ?>
                    <div class="card card-body mb-3">
                        <h4 class="card-title">
                            Product's Name: <?php echo $product->product_name; ?>
                            <form action="<?php echo URLROOT."/admin/products/".(($product->active) ? "archive" : "enable")."/".$product->id; ?>" method="post" style="display: inline">
                                <input type="submit" value="<?php echo (($product->active) ? "Archive" : "Enable")?>" class="btn float-end me-1 <?php echo ($product->active ? "btn-danger" : "btn-success") ?> " <?php echo (!$product->varId ? "disabled" : "") ?> >
                            </form>
                            <a href="<?php echo URLROOT."/admin/products/edit/".$product->id; ?>" class="btn btn-primary float-end me-1">
                                <i class="fa fa-pencil"></i> Update
                            </a>
                            <a class="btn btn-primary float-end me-1" href="<?php echo URLROOT."/admin/products/show/".$product->id; ?>">
                                <i class="fa fa-eye"></i> View
                            </a>
                        </h4>
						<?php echo (!isset($product->varId) ? "<i class='fa fa-exclamation-triangle' style='font-size:20px;color:red'>No Variations Detected</i>" : "" ) ?>
                    </div>
		
				<?php endforeach; ?>
            </div>
        </div>

        <!-------------------------- ARCHIVED PRODUCTS ------------------------------->
        <div class="tab-pane fade" id="nav-archived" role="tabpanel" aria-labelledby="nav-archived-tab">
            <div class="container my-3" id="archivedProducts">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h2 id="archivedPage">Archived Products</h2>
                    </div>
                </div>
				<?php foreach($data["archivedProducts"] as $product) : ?>
                    <div class="card card-body mb-3">
                        <h4 class="card-title">
                            Product's Name: <?php echo $product->product_name; ?>
                            <form action="<?php echo URLROOT."/admin/products/".(($product->active) ? "archive" : "enable")."/".$product->id; ?>" method="post" style="display: inline">
                                <input type="submit" value="<?php echo (($product->active) ? "Archive" : "Enable")?>" class="btn float-end me-1 <?php echo ($product->active ? "btn-danger" : "btn-success") ?> " <?php echo (!$product->varId ? "disabled" : "") ?> >
                            </form>
                            <a href="<?php echo URLROOT; ?>/admin/products/edit/<?php echo $product->id; ?>" class="btn btn-primary float-end me-1">
                                <i class="fa fa-pencil"></i> Update
                            </a>
                            <a class="btn btn-primary float-end me-1" href="<?php echo URLROOT; ?>/admin/products/show/<?php echo $product->id; ?>">
                                <i class="fa fa-eye"></i> View
                            </a>
                        </h4>
						<?php echo (!isset($product->varId) ? "<i class='fa fa-exclamation-triangle' style='font-size:20px;color:red'>No Variations Detected</i>" : "" ) ?>
                    </div>
				<?php endforeach; ?>
            </div>
        </div>
    </div>
    <!------------------------- END TAB CONTENTS ---------------------------->

<?php require APPROOT . "/views/templates/footer.php"; ?>
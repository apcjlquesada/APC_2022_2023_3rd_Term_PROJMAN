<?php require APPROOT . "/views/templates/adminHeader.php"; ?>

<?php if(!$data["product"]){
	echo "<div class='card card-body mb-3 text-center'><b>Not able to get any data! Please Contact Support.</b></div>";}

else{ ?>
	<h1>
		Product Details:
	</h1>
	<div class="card card-body mb-3">
		<h4 class="card-title">
			Product name: <?php echo $data["product"]->product_name; ?>

            <form action="<?php echo URLROOT."/admin/products/".(($data["product"]->active) ? "archive" : "enable")."/".$data["product"]->id; ?>" method="post" style="display: inline">
                <input type="submit" value="<?php echo (($data["product"]->active) ? "Archive" : "Enable")?>" class="btn float-end me-1 <?php echo ($data["product"]->active ? "btn-danger" : "btn-success") ?>" <?php echo (empty($data["productVars"]) ? "disabled" : "") ?>>
            </form>
			<a class="btn btn-primary float-end me-1" href="<?php echo URLROOT."/admin/products"?>">
				<i class="fa fa-angle-double-left"></i> Back
			</a>
			<a href="<?php echo URLROOT."/admin/products/edit/".$data["product"]->id; ?>" class="btn btn-primary float-end me-1">
				<i class="fa fa-pencil"></i> Update
			</a>
		</h4>
		<div class="bg-light p-2 mb-3">
            <div class="col-3 float-end">
                <b>Image: </b><?php echo $data["product"]->img ?>
                <img class="img-thumbnail" src="<?php echo URLROOT ."/img/products/".$data["product"]->img; ?>" style="max-height: 400px">
            </div>
            <div class="col-9">
                <b>Product ID:</b> <?php echo $data["product"]->id; ?> <br/>
                <b>Category:</b> <?php echo $data["product"]->category; ?> <br/>
                <b>Is Active?:</b> <?php echo ($data["product"]->active ? "Yes" : "No"); ?> <br/>
                <b>Details:</b> <?php echo $data["product"]->details; ?> <br/>
            </div>
		</div>
	</div>
    
    <!------------------------------- To show Variations ----------------------------->
    <div class="card card-body mb-3">
        <h4 class="card-title">Product Variations</h4>
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Color</th>
                    <th scope="col">Size</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Price</th>
                    <th scope="col">Is Featured?</th>
                    <th scope="col">Img</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <?php foreach($data["productVars"] as $key => $productVar) : ?>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $key + 1; ?></th>
                    <td><?php echo $productVar->color; ?></td>
                    <td><?php echo $productVar->size; ?></td>
                    <td><?php echo $productVar->stock; ?></td>
                    <td><?php echo $productVar->price; ?></td>
                    <td><?php echo ($productVar->featured ? "Yes" : "No"); ?></td>
                    <td>
                        <?php echo $productVar->varImg; ?><br/>
                        <img class="img-thumbnail" src="<?php echo URLROOT ."/img/products/".$productVar->varImg; ?>" style="max-height: 150px">
                    </td>
                    <td class="col-4">
                        <div class="float-end">
                            <a href="<?php echo URLROOT."/admin/products/editVar/".$productVar->id ?>" class="btn btn-primary">
                                <i class="fa fa-pencil"></i> Update Variation
                            </a>
                            <form action="<?php echo URLROOT."/admin/products/".(($productVar->featured) ? "unFeature" : "feature")."/".$productVar->id; ?>" method="post" style="display: inline">
                                <input type="submit" value="<?php echo (($productVar->featured) ? "Unfeature" : "Feature"); ?>" class="btn <?php echo (($productVar->featured) ? "btn-danger" : "btn-success")?>" <?php echo ($data["product"]->active ? "" : "disabled"); ?> >
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
            <?php endforeach; ?>
        </table>
        <span class="invalid-feedback" style="display: block"><?php echo (empty($data["productVars"]) ? "No product variations detected! Please add by clicking on the <i>Add Variation</i>." : "") ?></span>
    </div>
    <a href="<?php echo URLROOT."/admin/products/addVar/".$data["product"]->id ?>" class="btn btn-primary">
        <i class="fa fa-plus"></i> Add Variation
    </a> <br/> <br/>
    
	<h3>Product Reviews</h3>
	<p>Under Construction</p>

<?php } ?>

<?php require APPROOT . "/views/templates/footer.php"; ?>

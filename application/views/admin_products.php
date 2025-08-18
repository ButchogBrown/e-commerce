<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <script src="../assets/js/vendor/jquery.min.js"></script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/vendor/bootstrap-select.min.js"></script>
	<script src="../assets/js/vendor/jquery.validate.js"></script>
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap-select.min.css">

    <link rel="stylesheet" href="../assets/css/custom/admin_global.css">
	<link rel="stylesheet" href="<?= base_url('../assets/css/custom/admin_products.css') ?>">
    <script src="../assets/js/global/admin_products.js"></script>
	<script src="../assets/js/main/admin_product.js"></script>

</head>

<body> 
    <div class="wrapper">
        <header>
            <h1>Let’s provide fresh items for everyone.</h1>
            <h2>Products</h2>
            <div>
                <a class="switch" href=" <?= base_url('catalogue') ?> ">Switch to Shop View</a>
                <button class="profile">
                    <img src="../assets/images/profile.png" alt="#">
                </button>
            </div>
            <div class="dropdown show">
                <a class="btn btn-secondary dropdown-toggle profile_dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <div class="dropdown-menu admin_dropdown" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
                </div>
            </div>
        </header>
        <aside>
            <a href="#"><img src="../assets/images/organi_shop_logo_dark.svg" alt="Organic Shop"></a>
            <ul>
                <li><a href="<?= base_url('admin_login') ?>">Orders</a></li>
                <li class="active"><a href="#">Products</a></li>
            </ul>
        </aside>
        <section>
			<?php echo form_open('', ['class' => 'search_form']) ?>
            <!-- <form action="process.php" method="post" class="search_form"> -->
                <input type="text" name="search" placeholder="Search Products">
            </form>
            <button class="add_product" data-toggle="modal" data-target="#add_product_modal">Add Product</button>
            <?php echo form_open('admin_category', ['class' => 'status_form']) ?>
			<!-- <form action="process.php" method="post" class="status_form"> -->
                <h3>Categories</h3>
                <ul>
                    <li>
                        <button type="submit" class="active" name="category_type" value="0">
                            <span> <?= $allProducts ?> </span><img src="<?= base_url('../assets/images/all_products.png') ?>" alt="#"><h4>All Products</h4>
                        </button>
                    </li>
                    <li>
                        <button type="submit" name="category_type" value="1">
                            <span> <?= $category_count[0]['category_count'] ?? 0  ?> </span><img src="<?= base_url('../assets/images/Vegetables.png') ?>" alt="#"><h4>Vegetabales</h4>
                        </button>
                    </li>
                    <li>
                        <button type="submit" name="category_type" value="2">
                            <span> <?= $category_count[1]['category_count'] ?? 0 ?> </span><img src="<?= base_url('../assets/images/fruits.png') ?>" alt="#"><h4>Fruits</h4>
                        </button>
                    </li>
                    <li>
                        <button type="submit" name="category_type" value="3">
                            <span> <?= $category_count[2]['category_count'] ?? 0 ?> </span><img src="<?= base_url('../assets/images/pork.png') ?>" alt="#"><h4>Pork</h4>
                        </button>
                    </li>
                    <li>
                        <button type="submit" name="category_type" value="4">
                            <span> <?= $category_count[3]['category_count'] ?? 0 ?> </span><img src="<?= base_url('../assets/images/beef.png') ?>" alt="#"><h4>Beef</h4>
                        </button>
                    </li>
					<li>
                        <button type="submit" name="category_type" value="5">
                            <span> <?= !empty($category_count[4]['category_count']) ? $category_count[3]['category_count'] : 0  ?> </span><img src="<?= base_url('../assets/images/chicken.png') ?>" alt="#"><h4>Chicken</h4>
                        </button>
                    </li>
                </ul>
            </form>
            <div>
                <table class="products_table">
                    <thead>
                        <tr>
                            <th><h3>All Products</h3></th>
                            <th>ID #</th>
                            <th>Price</th>
                            <th>Caregory</th>
                            <th>Inventory</th>
                            <th>Sold</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach($product_data as $data): ?>
                        <tr>
                            <td>
                                <span>
                                    <img src="../assets/images/food.png" alt="#">
                                    <?= $data['product_name'] ?>
                                </span>
                            </td>
                            <td><span> <?= $data['product_id']?> </span></td>
                            <td><span>$ <?= $data['price'] ?> </span></td>
                            <td><span> <?= $data['product'] ?> </span></td>
                            <td><span> <?= $data['stock'] ?> </span></td>
                            <td><span> <?= $data['sold'] ?> </span></td>
                            <td>
                                <span>
                                    <button class="edit_product">Edit</button>
                                    <button class="delete_product">X</button>
                                </span>
								<?php echo form_open('delete_product', ['class' => 'delete_product_form']) ?>
                                <!-- <form class="delete_product_form" action="process.php" method="post"> -->
                                    <p>Are you sure you want to remove this item?</p>
									<input type="hidden" name="product_id" value="<?= $data['product_id'] ?>">
                                    <button type="button" class="cancel_remove">Cancel</button>
                                    <button type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <div class="modal fade form_modal" id="add_product_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button data-dismiss="modal" aria-label="Close" class="close_modal"></button>
					<?php echo form_open_multipart('', ['class' => 'add_product_form']) ?>
                    <!-- <form class="delete_product_form" action="process.php" method="post"> -->
                        <h2>Add a Product</h2>
                        <ul>
                            <li>
                                <input type="text" name="product_name" >
                                <label>Product Name</label>
								<p class="error_message"></p>
                            </li>
                            <li>
                                <textarea name="description" ></textarea>
                                <label>Description</label>
								<p class="error_message"></p>
                            </li>
                            <li>
                                <label>Category</label>
                                <select class="selectpicker" name="selectpicker">
                                    <option>Vegetables</option>
                                    <option>Fruits</option>
                                    <option>Pork</option>
                                    <option>Beef</option>
                                    <option>Chicken</option>
                                </select>
								<p class="error_message"></p>
                            </li>
                            <li>
                                <input type="number" name="price" value="1" >
                                <label>Price</label>
								<p class="error_message"></p>
                            </li>
                            <li>
                                <input type="number" name="inventory" value="1" >
                                <label>Inventory</label>
								<p class="error_message"></p>
                            </li>
                            <li>
                                <label>Upload Images (5 Max)</label>
                                <ul>
                                    <li><button type="button" class="upload_image"></button></li>
                                </ul>
                                <input type="file" name="image[]" accept="image/*" class="image_input" multiple>
								<p class="error_message"></p>
                            </li>
                        </ul>
                        <button type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="popover_overlay"></div>
</body>
</html>

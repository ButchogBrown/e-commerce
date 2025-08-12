<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <link rel="shortcut icon" href="<?= base_url('../assets/images/organic_shop_fav.ico') ?>" type="image/x-icon">

    <script src="<?= base_url('../assets/js/vendor/jquery.min.js') ?>"></script>
    <script src="<?= base_url('../assets/js/vendor/popper.min.js') ?>"></script>
    <script src="<?= base_url('../assets/js/vendor/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('../assets/js/vendor/bootstrap-select.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap-select.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/product_dashboard.css') ?>">
	<script src="<?= base_url("assets/js/vendor/toastr.min.js")?>"></script>
	<script src="<?= base_url("assets/js/main/catalogue.js")?>"></script>
	<link rel="stylesheet" href="<?=  base_url('../assets/css/vendor/toastr.min.css') ?>">
</head>


<body> 
	<?php if($this->session->flashdata('success')): ?>
		<script>
				toastr.success("<?= $this->session->flashdata('success'); ?>");
		</script>
		
	<?php endif; ?>
    <div class="wrapper">
        <header>
            <h1>Let’s order fresh items for you.</h1>
            <div>
                <a class="signup_btn" href="signup.html">Signup</a>
                <a class="login_btn" href="<?= base_url('logout') ?>">Logout</a>
            </div>
        </header>
        <aside>
            <a href="products_dashboard.html"><img src="<?= base_url('../assets/images/organic_shop_logo.svg') ?>" alt="Organic Shop"></a>
            <!-- <ul>
                <li class="active"><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul> -->
        </aside>
        <section >
			<?php echo form_open('search', ['class' => 'search_form']) ?>
            <!-- <form action="process.php" method="post" class="search_form"> -->
                <input type="text" name="search" placeholder="Search Products">
            </form>
            <a class="show_cart" href="cart.html">Cart (0)</a>
			<?php echo form_open('category', ['class' => 'categories_form']) ?>
                <h3>Categories</h3>
                <ul id="category">
                    <li>
                        <button type="submit" class="active" name="category_type" value="0">
                            <span><?= $allProducts ?></span><img src="<?= base_url('../assets/images/apple.png') ?>" alt="#"><h4>All Products</h4>
                        </button>
                    </li>
					<?php foreach($category_count as $category): ?>
                    <li>
                        <button type="submit" name="category_type" value="<?= $category['category_id']?>">
                            <span><?= $category['category_count'] ?></span><img src="<?=base_url($category['icon']) ?>" alt="#"><h4><?= $category['product'] ?></h4>
                        </button>
                    </li>
					<?php endforeach; ?>
                 
                </ul>
            </form>
            <div>
                <h3>All Products(<?= $allProducts ?>)</h3>
                <ul>
					<?php foreach($product_data as $product): ?>
                    <li>
                        <a href="<?= base_url('product/'. $product['product_id'])?>">
                            <img src="<?= base_url('../assets/images/food.png') ?>" alt="#">
                            <h3><?= $product['product_name']?></h3>
                            <ul class="rating">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <span>36 Rating</span>
                            <span class="price">$ <?= $product['price'] ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>
                    
                </ul>
            </div>
        </section>
    </div>
</body>
</html>

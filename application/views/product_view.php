<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <script src="<?= base_url('../assets/js/vendor/jquery.min.js') ?>"></script>
    <script src="<?= base_url('../assets/js/vendor/popper.min.js') ?>"></script>
    <script src="<?= base_url('../assets/js/vendor/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('../assets/js/vendor/bootstrap-select.min.js')?> "></script>
    <script src="<?= base_url('../assets/js/global/product_view.js')?> "></script>
	<script src="<?= base_url('../assets/js/main/product_view.js')?> "></script>
	<script src="<?= base_url("assets/js/vendor/toastr.min.js")?>"></script>
	<link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap-select.min.css') ?>">
	<link rel="stylesheet" href="<?=  base_url('../assets/css/vendor/toastr.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/product_view.css') ?>">
	<script src="<?= base_url('../assets/js/main/product.js')?> "></script>
</head>

<script>
    // $(document).ready(function() {
    //     $("#add_to_cart").click(function(){
    //         $("<span class='added_to_cart'>Added to cart succesfully!</span>")
    //         .insertAfter(this)
    //         .fadeIn()
    //         .delay(1000)
    //         .fadeOut(function() {
    //             $(this).remove();
    //         });
    //        return false;
	// });
    // })
</script>
<body>
	<?php if($this->session->flashdata('success')): ?>
		<script>
				toastr.success("Item(s) added to cart!");
				toastr.warning("<?= $this->session->flashdata('success'); ?>");
		</script>
	<?php endif; ?>
	<?php if($this->session->flashdata('error')): ?>
		<script>
			toastr.error("<?= $this->session->flashdata('error') ?>")
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
            <a href="<?= base_url('catalogue')?>"><img src="<?= base_url('../assets/images/organic_shop_logo.svg') ?>" alt="Organic Shop"></a>
            <!-- <ul>
                <li class="active"><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul> -->
        </aside>
        <section >
            <form action="process.php" method="post" class="search_form">
                <input type="text" name="search" placeholder="Search Products" class="search">
            </form>
            <a class="show_cart" href="<?= base_url('cart') ?>">Cart (<?= $cart_count ?>)</a>
            <a href="<?= base_url('catalogue') ?>">Go Back</a>
            <ul>
                <li>
                    <img src="<?= base_url($images[0]['image_path']) ?>" alt="food">
                    <ul>
                        <li class="active"><button class="show_image"><img src="<?= base_url($images[0]['image_path']) ?>" alt="food"></button></li>
                        <?php for($i = 1; $i < count($images); $i++): ?>
							<li><button class="show_image"><img src="<?= base_url($images[$i]['image_path']) ?>" alt="food"></button></li>
						<?php endfor; ?>
						
                    </ul>
                </li>
                <li>
                    <h2><?= $product_data['product_name'] ?></h2>
                    <ul class="rating">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <span>36 Rating</span>
                    <span class="amount" id="price" data-price="<?= $product_data['price'] ?>">$ <?= $product_data['price'] ?></span>
                    <p><?= $product_data['description'] ?></p>
					<?php echo form_open('cart/' . $product_data['product_id'], ['class' => 'add_to_cart_form'])?>
                    <!-- <form action="" method="post" id="add_to_cart_form"> -->
						<input type="hidden" id="stock" value="<?= $product_data['stock'] ?>">
                        <ul>
                            <li>
								
                                <label>Quantity</label>
                                <input type="text" min-value="1" value="1" id="quantity" name="quantity">
                                <ul>
                                    <li><button type="button" class="increase_decrease_quantity" data-quantity-ctrl="1"></button></li>
                                    <li><button type="button" class="increase_decrease_quantity" data-quantity-ctrl="0"></button></li>
                                </ul>
                            </li>
                            <li>
                                <label>Total Amount</label>
                                <span class="total_amount" id="total_amount">$ 10</span>
                            </li>
                            <li><button type="submit" id="add_to_cart">Add to Cart</button></li>
                        </ul>
                    </form>
                </li>
            </ul>
            <section>
                <h3>Similar Items</h3>
                <ul> 
					<?php foreach($category as $product): ?>
                    <li>
                        <a href="<?= base_url('product/' .$product['product_id']) ?>">
                            <img src="<?= base_url($image_category[$product['product_id']][0]['image_path'])?>" alt="#">
                            <h3><?= $product['product_name'] ?></h3>
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
            </section>
        </section>
    </div>
</body>
</html>

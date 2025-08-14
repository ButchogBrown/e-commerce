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
    <script src="<?= base_url('../assets/js/vendor/bootstrap-select.min.js') ?>"></script>

    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap-select.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/cart.css') ?>">
    <script src="<?= base_url('../assets/js/global/cart.js') ?>"></script>
	<script src="<?= base_url('../assets/js/main/cart.js') ?>"></script>
</head>

<body> 
    <div class="wrapper">
        <header>
            <h1>Let’s order fresh items for you.</h1>
            <div>
                <a class="signup_btn" data-toggle="modal" data-target="#signup_modal">Signup</a>
				<a href="<?= base_url('logout') ?>" class="login_btn">Logout</a>
                <!-- <a href="<?= base_url('logout') ?>" class="login_btn" data-toggle="modal" data-target="#login_modal">Logout</a> -->
            </div>
        </header>
        <aside>
            <a href="<?= base_url('catalogue') ?>"><img src="<?= base_url('../assets/images/organic_shop_logo.svg') ?>" alt="Organic Shop"></a>
            <!-- <ul>
                <li class="active"><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul> -->
        </aside>
        <section >
            <form class="search_form">
                <input type="text" name="search" placeholder="Search Products">
            </form>
            <button class="show_cart">Cart (<?= $cart_count ?>)</button>
            <section>
				<?php echo form_open('cart/remove/', ['class' => 'cart_items_form ']) ?>
                <!-- <form class="cart_items_form"> -->
                    <ul>
						<?php foreach($cart_items as $item): ?>
                        <li>
                            <img src="<?= base_url('../assets/images/burger.png') ?>" alt="">
                            <h3><?= $item['product_name'] ?></h3>
                            <span>$ <?= $item['price'] ?></span>
                            <ul>
                                <li>
                                    <label>Quantity</label>
                                    <input type="text" name="quantity" id="quantity" min-value="1" value="<?= $item['quantity'] ?>" data-price="<?= $item['price'] ?>" data-stock="<?= $item['stock'] ?>">
                                    <ul>
                                        <li><button type="button" class="increase_decrease_quantity" data-quantity-ctrl="1"></button></li>
                                        <li><button type="button" class="increase_decrease_quantity" data-quantity-ctrl="0"></button></li>
                                    </ul>
                                </li>
                                <li>
                                    <label>Total Amount</label>
                                    <span class="total_amount">$ <?= $item['total_amount'] ?></span>
                                </li>
                                <li>
                                    <button type="button" class="remove_item"></button>
                                </li>
                            </ul>
                            <div>
                                <p>Are you sure you want to remove this item?</p>
                                <button type="button" class="cancel_remove" >Cancel</button>
                                <button type="button" class="remove" data-cart="<?= $item['cart_id']?>">Remove</button>
                            </div>
                        </li>

                        <?php endforeach ?>
                    </ul>
                <!-- </form> -->
                <!-- <form class="checkout_form"> -->
					<ul class="checkout_form" id="checkout_form">
                    <h3>Shipping Information</h3>
                    <ul>
                        <li>
                            <input type="text" name="first_name" required>
                            <label>First Name</label>
                        </li>
                        <li>
                            <input type="text" name="last_name" required>
                            <label>Last Name</label>
                        </li>
                        <li>
                            <input type="text" name="address_1" required>
                            <label>Address 1</label>
                        </li>
                        <li>
                            <input type="text" name="address_2" required>
                            <label>Address 2</label>
                        </li>
                        <li>
                            <input type="text" name="city" required>
                            <label>City</label>
                        </li>
                        <li>
                            <input type="text" name="state" required>
                            <label>State</label>
                        </li>
                        <li>
                            <input type="text" name="zip_code" required>
                            <label>Zip Code</label>
                        </li>
                    </ul>
                    <h3>Order Summary</h3>
                    <h4>Items <span>$ 40</span></h4>
                    <h4>Shipping Fee <span>$ 5</span></h4>
                    <h4 class="total_amount">Total Amount <span>$ 45</span></h4>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#card_details_modal">Proceed to Checkout</button>
                </ul>
				</form>
            </section>
        </section>
        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#card_details_modal">
            Launch demo modal
        </button> -->
        <div class="modal fade form_modal" id="card_details_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button data-dismiss="modal" aria-label="Close" class="close_modal"></button>
                    <form action="process.php" method="post">
                        <h2>Card Details</h2>
                        <ul>
                            <li>
                                <input type="text" name="card_name" required>
                                <label>Card Name</label>
                            </li>
                            <li>
                                <input type="number" name="card_number" required>
                                <label>Card Number</label>
                            </li>
                            <li>
                                <input type="month" name="expiration" required>
                                <label>Exp Date</label>
                            </li>
                            <li>
                                <input type="number" name="cvc" required>
                                <label>CVC</label>
                            </li>
                        </ul>
                        <h3>Total Amount <span>$ 45</span></h3>
                        <button type="button">Pay</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade form_modal" id="login_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button data-dismiss="modal" aria-label="Close" class="close_modal"></button>
                    <form action="process.php" method="post">
                        <h2>Login to order.</h2>
                        <button type="button" class="switch_to_signup">New Member? Register here.</button>
                        <ul>
                            <li>
                                <input type="text" name="email" required>
                                <label>Email</label>
                            </li>
                            <li>
                                <input type="password" name="password" required>
                                <label>Password</label>
                            </li>
                        </ul>
                        <button type="button">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade form_modal" id="signup_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button data-dismiss="modal" aria-label="Close" class="close_modal"></button>
                    <form action="process.php" method="post">
                        <h2>Signup to order.</h2>
                        <button type="button" class="switch_to_signup">Already a member? Login here.</button>
                        <ul>
                            <li>
                                <input type="text" name="email" required>
                                <label>Email</label>
                            </li>
                            <li>
                                <input type="password" name="password" required>
                                <label>Password</label>
                            </li>
                            <li>
                                <input type="password" name="password" required>
                                <label>Password</label>
                            </li>
                            <li>
                                <input type="password" name="password" required>
                                <label>Password</label>
                            </li>
                            <li>
                                <input type="password" name="password" required>
                                <label>Password</label>
                            </li>
                        </ul>
                        <button type="button">Signup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="popover_overlay"></div>
</body>
</html>

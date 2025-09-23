<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <script src="<?= base_url('../assets/js/vendor/jquery.min.js') ?>"></script>
    <script src="<?= base_url('../assets/js/vendor/popper.min.js') ?>"></script>
    <script src="<?= base_url('../assets/js/vendor/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('../assets/js/vendor/bootstrap-select.min.js')?>"></script>
    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap-select.min.css') ?>">
	<link rel="stylesheet" href="<?=  base_url('../assets/css/vendor/toastr.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/admin_global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/admin_orders.css') ?>">
	<link rel="stylesheet" href="<?= base_url('../assets/css/custom/login.css') ?>">
    <script src="<?= base_url('../assets/js/global/admin_orders.js') ?>"></script>
	<script src="<?= base_url("assets/js/vendor/toastr.min.js")?>"></script>
	<script src="<?= base_url("assets/js/main/order.js")?>"></script>
</head>
<!-- <script>
     $(document).ready(function() {
        $('.profile_dropdown').on('click', function() {
            let newTop = $(this).offset().top + $(this).outerHeight();
            let newLeft = $(this).offset().left;
            
            $('.admin_dropdown').css({
                'top': newTop + 'px',
                'left': newLeft + 'px'
            });
        });
    });
</script> -->
<body>
	<?php if($this->session->flashdata('error')):?>
		<script>
			toastr.error("<?= $this->session->flashdata('error'); ?>")
		</script>
	<?php endif; ?>
    <div class="wrapper">
        <header>
            <h1>Let’s provide fresh items for everyone.</h1>
            <h2>Orders</h2>
            <div>
                <a class="switch" href="<?= base_url('catalogue') ?>">Switch to Shop View</a>
                <button class="profile">
                    <img src="<?= base_url('../assets/images/profile.png') ?>" alt="#">
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
            <a href="#"><img src="<?= base_url('../assets/images/organi_shop_logo_dark.svg') ?>" alt="Organic Shop"></a>
            <ul>
                <li class="active"><a href="#">Orders</a></li>
                <li><a href="<?= base_url('products') ?>">Products</a></li>
            </ul>
        </aside>
        <section>
            <form action="process.php" method="post" class="search_form">
                <input type="text" name="search" placeholder="Search Orders">
            </form>
			<?php echo form_open('select_status', ['class' => 'status_form']) ?>
            <!-- <form action="<?= base_url('select_status') ?>" method="post" class="status_form"> -->
                <h3>Status</h3> 
                <ul>
                    <li>
							<button type="submit" class="active" name="status" value="5">
								<span><?= $total_number_of_order ?></span><img src="<?= base_url('../assets/images/all_orders_icon.svg') ?>" alt="#"><h4>All Products</h4>
							</button>
                    </li>
                    <li>
                        <button type="submit" name="status" value="1">
                            <span id="pending"><?= $category_details[0]['status_count'] ?? 0 ?></span><img src="<?= base_url('../assets/images/pending_icon.svg') ?>" alt="#"><h4>Pending</h4>
                        </button>
                    </li>
                    <li>
                        <button type="submit" name="status" value="2">
                            <span id="on_process"><?= $category_details[1]['status_count'] ?? 0 ?></span><img src="<?= base_url('../assets/images/on_process_icon.svg') ?>" alt="#"><h4>On-Process</h4>
                        </button>
                    </li>
                    <li>
                        <button type="submit" name="status" value="3">
                            <span id="shipping"><?= $category_details[2]['status_count'] ?? 0 ?></span><img src="<?= base_url('../assets/images/shipped_icon.svg') ?>" alt="#"><h4>Shipped</h4>
                        </button>
                    </li>
                    <li>
                        <button type="submit" name="status" value="4">
                            <span id="delivered"><?= $category_details[3]['status_count'] ?? 0 ?></span><img src="<?= base_url('../assets/images/delivered_icon.svg') ?>" alt="#"><h4>Delivered</h4>
                        </button>
                    </li>
                </ul>
            </form>
            <div>
                <h3>All Orders (36)</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID #</th>
                            <th>Order Date</th>
                            <th>Receiver</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="order_lsit">
						<?php foreach($order_data as $order): ?>
                        <tr>
                            <td><span><a href="#"><?= $order['order_id'] ?></a></span></td>
                            <td><span><?= $order['created_at'] ?></span></td>
                            <td><span><?= $order['first_name']. " " . $order['last_name'] ?><span><?= $order['zip']. ', ' . $order['city'] . ', ' . $order['state']?></span></span></td>
                            <td><span>$ <?= $order['total_amount'] ?></span></td>
                            <td>
								<?php echo form_open('change_status', ['class' => 'change_status_form']) ?>
                                <!-- <form action="process.php" method="post" name="status" class="change_status"> -->
                                    <select class="selectpicker" name="change_status" >
                                        <option value="1" <?= ($order['status_id'] ==1) ? 'selected': '' ?>>Pending</option>
                                        <option value="2" <?= ($order['status_id'] == 2) ? 'selected': '' ?> >On-Process</option>
                                        <option value="3"  <?= ($order['status_id'] == 3) ? 'selected': '' ?> >Shipped</option>
                                        <option value="4"  <?= ($order['status_id'] == 4) ? 'selected': '' ?> >Delivered</option>
                                      </select>
									  <input type="hidden" value="<?= $order['order_id'] ?>" name="order_id">
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
</html>

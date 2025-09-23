 <?php foreach($cart_items as $item): ?>
					
                    <input type="hidden" name="carts_id[]" value="<?= $item['cart_id'] ?>">
                    <li>
                        <img src="<?= base_url($images[$item['product_id']][0]['image_path']) ?>" alt="">
                        <h3><?= $item['product_name'] ?></h3>
                        <span>$ <?= $item['price'] ?></span>
                        <ul>
                            <li>
                                <label>Quantity</label>
                                <input type="text" name="quantity[]" id="quantity" min-value="1"
                                    value="<?= $item['quantity'] ?>" data-price="<?= $item['price'] ?>"
                                    data-stock="<?= $item['stock'] ?>">
                                <ul>
                                    <li><button type="button" class="increase_decrease_quantity"
                                            data-quantity-ctrl="1"></button></li>
                                    <li><button type="button" class="increase_decrease_quantity"
                                            data-quantity-ctrl="0"></button></li>
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
                            <button type="button" class="cancel_remove">Cancel</button>
                            <button type="button" class="remove" data-cart="<?= $item['cart_id'] ?>">Remove</button>
                        </div>
                    </li>

                    <?php endforeach ?>

<?php foreach($product_data as $product): ?>
                    <li>
                        <a href="<?= base_url('product/'. $product['product_id'])?>">
                            <img src="<?= base_url($images[$product['product_id']][0]['image_path']) ?>" alt="#">
							<p><?= $product['product_id'] ?></p>
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

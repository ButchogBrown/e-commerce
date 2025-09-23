
<?php foreach($product_data as $data): ?>
                        <tr>
                            <td>
                                <span>
                                    <img src="<?= base_url($images[$data['product_id']][0]['image_path'] ) ?>" alt="#">
                                    <?= $data['product_name'] ?>
                                </span>
                            </td>
                            <td><span class="target"> <?= $data['product_id']?> </span></td>
                            <td><span class="price">$ <?= $data['price'] ?> </span></td>
                            <td><span data-value="<?= $data['category_id'] ?>"> <?= $data['product'] ?> </span></td>
                            <td><span> <?= $data['stock'] ?> </span></td>
                            <td><span> <?= $data['sold'] ?> </span></td>
                            <td>
                                <span>
									<input type="hidden" name="edit_description" value="<?= $data['description'] ?>">
									<input type="hidden" name="product_name" value="<?= $data['product_name']?>" class="product_name">
                                    <button class="edit_product" value=" <?= $data['product_id']?> ">Edit</button>
                                    <button class="delete_product">X</button>
                                </span>
								<?php echo form_open('delete_product', ['class' => 'delete_product_form']) ?>
                                <!-- <form class="delete_product_form" action="process.php" method="post"> -->
                                    <p>Are you sure you want to remove this item?</p>
									<input type="hidden" name="product_id" value="<?= $data['product_id'] ?>" > 
                                    <button type="button" class="cancel_remove">Cancel</button>
                                    <button type="submit" name="remove">Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>

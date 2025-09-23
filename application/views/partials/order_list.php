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

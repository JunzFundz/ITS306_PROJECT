<?php
session_start();
$id = $_SESSION['user_id'];

include("../../class/Users.php");
$data = new Users();
$result = $data->viewOrders($id);
?>
<h1>Booking system</h1>

<table>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Status</th>
        <th>Date ordered</th>
        <th>Action</th>
    </tr>
    <?php foreach ($result as $raw) { ?>
        <tr>
            <td><?php echo $raw['food_name'] ?></td>
            <td>₱ <?php echo number_format($raw['price'], 2) ?></td>
            <td> <span ><?php echo $raw['status'] ?></span>

            </td>
            <td><?php echo $raw['order_date'] ?></td>
            <td>
                <?php if ($raw['status'] == 'Pending') { ?>
                    <button class="btn-cancel" data-id="<?php echo $raw['order_id'] ?>">Cancel</button>
                <?php } else { ?>
                    <button disabled style="cursor: not-allowed;" class="btn-cancel" data-id="<?php echo $raw['order_id'] ?>">Cancel</button>
                <?php } ?>

                <?php if ($raw['status'] == 'Received') { ?>
                    <button style="color: green;" class="btn-receive" data-id="<?php echo $raw['order_id'] ?>">Received</button>

                <?php } else if ($raw['status'] == 'Pending') { ?>
                    <button disabled style="color:blue" class="btn-receive" data-id="<?php echo $raw['order_id'] ?>">Pending</button>
                <?php } else { ?>
                    <button disabled style="color:red" class="btn-receive" data-id="<?php echo $raw['order_id'] ?>">Cancelled</button>
                <?php } ?>

                <button class="btn-delete" data-id="<?php echo $raw['order_id'] ?>">Delete</button>
                <button>View</button>
            </td>
        </tr>
    <?php } ?>
</table>

<script src="../../assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $('.btn-delete').on('click', function(e) {
            e.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                url: '../../Controller/cancel.php',
                method: 'Post',
                data: {
                    'delete': true,
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.success + " Updated")
                    } else {
                        alert(response.error)
                    }
                },
                error: function() {

                }
            })
        })

        $('.btn-cancel').on('click', function(e) {
            e.preventDefault();

            let id = $(this).data('id');

            $.ajax({
                url: '../../Controller/cancel.php',
                method: 'Post',
                data: {
                    'cancel': true,
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.success + " Updated")
                    } else {
                        alert(response.error)
                    }
                },
                error: function() {

                }
            })
        })

        $('.btn-receive').on('click', function(){

        })

    })
</script>
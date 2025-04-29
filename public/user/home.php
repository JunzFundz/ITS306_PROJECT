<?php
session_start();
$_SESSION['user_id'];

include("../../class/Users.php");
$data = new Users();
$result = $data->viewRooms();


?>
<h1>Booking system</h1>

<table>
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Action</th>
    </tr>
    <?php foreach ($result as $raw) { ?>
        <tr>
            <td><?php echo $raw['i_name'] ?></td>
            <td>₱ <?php echo number_format($raw['i_price'], 2) ?></td>
            <td><?php echo $raw['i_quantity'] ?></td>
            <td>
                <button>Delete</button>
                <button>Update</button>
                <button>View</button>
            </td>
        </tr>
    <?php } ?>
</table>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<h1>This is landing page</h1>
    <form action="../Controller/registration.php" method="post">
        <input type="text" name="username">
        <input type="text" name="password">

        <button type="submit" name="register">Submit</button>
    </form>

    <a href="login.php">Go to log in</a>

</body>

</html>

<?php
include("../class/Admin.php");

$data = new Admin();
$users = $data->view();
?>

</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<body>

    <h2>Users</h2>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">USERNAME</th>
                <th scope="col">DATE</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']) ?></td>
                    <td><?php echo htmlspecialchars($row['username']) ?></td>
                    <td><?php echo htmlspecialchars($row['date_created']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>


</body>

</html>
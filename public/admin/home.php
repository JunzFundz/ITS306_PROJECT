<?php
session_start();
if (!$_SESSION['user_id'] > 0) {
    header('location: ../../Controller/logout.php');
}

include("../../class/Users.php");
$data = new Users();
$result = $data->getAppointment();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Admin dashboard</title>
</head>

<body>

    <div class="navbar bg-base-100 shadow-sm">
        <div class="flex-1">
            <a class="btn btn-ghost text-xl">Booking System: Lag-it Resort</a>
        </div>
        <div class="flex-none">
            <ul class="menu menu-horizontal px-1">
                <li><a>Home</a></li>
                <li>
                    <details>
                        <summary>Options</summary>
                        <ul class="bg-base-100 rounded-t-none p-2">
                            <li><a>Account settings</a></li>
                            <li><a>Sign out</a></li>
                        </ul>
                    </details>
                </li>
            </ul>
        </div>
    </div>

    <div class="breadcrumbs text-sm ml-10 mt-5">
        <ul>
            <li><a>Rooms</a></li>
            <li onclick="my_modal_3.showModal()"><a>Add rooms</a></li>
        </ul>
    </div>

    <dialog id="my_modal_3" class="modal">
        <div class="modal-box">
            <form method="dialog">
                <button class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</button>
            </form>
            <h3 class="text-lg font-bold">Add rooms</h3>
            <center>
                <label class="input mb-3 mt-5">
                    <input type="text" class="grow" id="rname" placeholder="Room name" />
                </label>
                <label class="input mb-3">
                    <input type="text" class="grow" id="rnumber" placeholder="Room number" />
                </label>
                <label class="input mb-3">
                    <input type="number" class="grow" id="quantity" placeholder="Quantity" />
                </label>
                <label class="input mb-3">
                    <input type="number" class="grow" id="price" placeholder="Price" />
                </label>
                <label class="">
                    <input type="file" class="file-input" id="file_input" accept=".jpg, .jpeg, .png" multiple />
                </label>
                <legend class="fieldset-legend" id="description">Description</legend>
                <textarea class="textarea h-24" placeholder="Bio"></textarea>
                <br>
                <button class="btn btn-soft btn-primary mt-5 submit_form" id="submit_form">Submit</button>
            </center>
        </div>
    </dialog>

    <div class="overflow-x-auto" style="height: 75vh;">
        <table class="table table-zebra">
            <!-- head -->
            <thead>
                <tr>
                    <th>ORDER ID</th>
                    <th>PRICE</th>
                    <th>ITEM</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) { ?>
                    <tr>
                        <th><?= $row['order_id'] ?></th>
                        <td><?= $row['price'] ?></td>
                        <td><?= $row['food_name'] ?></td>
                        <td>
                            <?php if ($row['status'] == 'Cancelled') { ?>
                                <button disabled class="btn btn-soft btn-error btn-cancel--" data-id="<?php echo $row['order_id'] ?>">Cancelled</button>
                            <?php } else { ?>
                                <button class="btn btn-soft btn-error btn-cancel--" data-id="<?php echo $row['order_id'] ?>">Cancel</button>
                            <?php } ?>
                            <button class="btn btn-soft btn-secondary">Delivered</button>
                            <a href="view.php?id=<?= $row['order_id'] ?>" class="btn btn-soft btn-accent">View</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <footer class="footer sm:footer-horizontal bg-neutral text-neutral-content items-center p-4">
        <aside class="grid-flow-col items-center">
            <svg
                width="36"
                height="36"
                viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg"
                fill-rule="evenodd"
                clip-rule="evenodd"
                class="fill-current">
                <path
                    d="M22.672 15.226l-2.432.811.841 2.515c.33 1.019-.209 2.127-1.23 2.456-1.15.325-2.148-.321-2.463-1.226l-.84-2.518-5.013 1.677.84 2.517c.391 1.203-.434 2.542-1.831 2.542-.88 0-1.601-.564-1.86-1.314l-.842-2.516-2.431.809c-1.135.328-2.145-.317-2.463-1.229-.329-1.018.211-2.127 1.231-2.456l2.432-.809-1.621-4.823-2.432.808c-1.355.384-2.558-.59-2.558-1.839 0-.817.509-1.582 1.327-1.846l2.433-.809-.842-2.515c-.33-1.02.211-2.129 1.232-2.458 1.02-.329 2.13.209 2.461 1.229l.842 2.515 5.011-1.677-.839-2.517c-.403-1.238.484-2.553 1.843-2.553.819 0 1.585.509 1.85 1.326l.841 2.517 2.431-.81c1.02-.33 2.131.211 2.461 1.229.332 1.018-.21 2.126-1.23 2.456l-2.433.809 1.622 4.823 2.433-.809c1.242-.401 2.557.484 2.557 1.838 0 .819-.51 1.583-1.328 1.847m-8.992-6.428l-5.01 1.675 1.619 4.828 5.011-1.674-1.62-4.829z"></path>
            </svg>
            <p>Copyright © {new Date().getFullYear()} - All right reserved</p>
        </aside>
        <nav class="grid-flow-col gap-4 md:place-self-center md:justify-self-end">
            <a>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    class="fill-current">
                    <path
                        d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"></path>
                </svg>
            </a>
            <a>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    class="fill-current">
                    <path
                        d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"></path>
                </svg>
            </a>
            <a>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    class="fill-current">
                    <path
                        d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"></path>
                </svg>
            </a>
        </nav>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $('.submit_form').on('click', function(e) {
            e.preventDefault();

            const rname = $('#rname').val();
            const rnumber = $('#rnumber').val();
            const quantity = $('#quantity').val();
            const price = $('#price').val();
            const description = $('#description').val();
            const idnumber = $('#idnumber').val();

            const fileInput = document.getElementById('file_input');
            const files = fileInput.files;

            let formData = new FormData();
            formData.append('add_room', true);
            formData.append('rname', rname);
            formData.append('rnumber', rnumber);
            formData.append('quantity', quantity);
            formData.append('price', price);
            formData.append('description', description);
            formData.append('description', description);

            for (let i = 0; i < files.length; i++) {
                formData.append('images[]', files[i]);
            }

            for (let pair of formData.entries()) {
                console.log(pair[0], pair[1]);
            }

            $.ajax({
                url: '../../Controller/add.php',
                method: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: response.success,
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.reload();
                            }
                        });
                    } else {
                        Swal.fire({
                            title: response.error,
                            icon: "error",
                            confirmButtonText: "OK"
                        })
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });


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
                        console.log(response.success + " Updated")
                    } else {
                        console.log(response.error)
                    }
                },
                error: function() {

                }
            })
        })

        $('.btn-cancel--').on('click', function(e) {
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
    })
</script>

</html>
<?php

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
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
                    <input type="file" class="file-input" id="file_input" accept=".jpg, .jpeg, .png" multiple/>
                </label>
                <legend class="fieldset-legend" id="description">Description</legend>
                <textarea class="textarea h-24" placeholder="Bio"></textarea>
                <br>
                <button class="btn btn-soft btn-primary mt-5 add-room">Submit</button>
            </center>
        </div>
    </dialog>

</body>
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $('.add-room').on('click', function(e) {
            e.preventDefault();

            const rname = $('#rname').val();
            const rnumber = $('#rnumber').val();
            const quantity = $('#quantity').val();
            const price = $('#price').val();
            const description = $('#description').text();

            const fileInput = document.getElementById('file_input');
            const files = fileInput.files;

            let formData = new FormData();
            formData.append('add_room', true);
            formData.append('rname', rname);
            formData.append('rnumber', rnumber);
            formData.append('quantity', quantity);
            formData.append('price', price);
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
    })
</script>

</html>
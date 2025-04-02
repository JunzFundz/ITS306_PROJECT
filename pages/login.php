

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Log in</title>
</head>

<body>

    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content flex-col lg:flex-row-reverse">
            <div class="text-center lg:text-left">
                <h1 class="text-5xl font-bold">Login now!</h1>
                <p class="py-6">
                    Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem
                    quasi. In deleniti eaque aut repudiandae et a id nisi.
                </p>
            </div>
            <div class="card bg-base-100 w-full max-w-sm shrink-0 shadow-2xl">
                <div class="card-body">
                    <fieldset class="fieldset">
                        <label class="fieldset-label">Username</label>
                        <input type="email" class="input" id="username" placeholder="Email" />

                        <label class="fieldset-label">Password</label>
                        <input type="password" class="input" id="password" placeholder="Password" />

                        <div><a class="link link-hover">Forgot password?</a></div>
                        <button type="button" class="btn btn-neutral mt-4 loginuser" id="loginuser">Login</button>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
    
</body>
<script src="../assets/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {

        $('.loginuser').on('click', function(e) {
            e.preventDefault();

            const username = $('#username').val();
            const password = $('#password').val();

            console.log(username, password);
            $.ajax({
                url: "../Controller/login.php",
                method: 'post',
                data: {
                    'login': true,
                    username: username,
                    password: password
                },
                dataType: 'json',
                success: function(response) {
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        Swal.fire({
                            title: response.error,
                            icon: "error",
                            draggable: true
                        });
                    }
                },
                error: function() {}
            })
        })

    })
</script>

</html>
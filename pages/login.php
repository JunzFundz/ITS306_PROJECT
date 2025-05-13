<?php include('header.php') ?>

<title>Login</title>

<!-- Body -->
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
<!-- end of body tag -->

<?php include('footer.php') ?>
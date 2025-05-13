</body>
<script src="../assets/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loginuser').on('click', function(e) {
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
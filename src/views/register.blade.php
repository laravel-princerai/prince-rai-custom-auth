<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>
<body>
<div class="container mt-5">
    <h2>Register</h2>
    <form id="registerForm">
        @csrf
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required minlength="3">
        </div>
        <div class="mb-3">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Password:</label>
            <input type="password" name="password" class="form-control" required minlength="6">
        </div>
        <div class="mb-3">
            <label>Confirm Password:</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('#registerForm').validate({
            rules: {
                name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },
                password_confirmation: {
                    required: true,
                    equalTo: "[name='password']"
                }
            },
            messages: {
                name: {
                    required: "Name is required",
                    minlength: "Name must be at least 3 characters"
                },
                email: {
                    required: "Email is required",
                    email: "Enter a valid email address"
                },
                password: {
                    required: "Password is required",
                    minlength: "Password must be at least 6 characters"
                },
                password_confirmation: {
                    required: "Confirm your password",
                    equalTo: "Passwords do not match"
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    url: "{{ route('custom.register') }}",
                    type: "POST",
                    data: $(form).serialize(),
                    success: function (response) {
                        if (response.status) {
                            toastr.success(response.message);
                            setTimeout(() => {
                                window.location.href = response.redirect;
                            }, 2000);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function () {
                        toastr.error("Something went wrong.");
                    }
                });
            }
        });
    });
</script>
</body>
</html>

<!DOCTYPE html>
<html>

<head>
    <title>Thêm tài khoản</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Thư viện Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Thêm tài khoản</h2>

                <!-- Form thêm tài khoản -->
                <form action="{{ route('account.store') }}" method="POST">
                    @csrf
                    <!-- Trường 'username' -->
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>

                    <!-- Trường 'fullname' -->
                    <div class="form-group">
                        <label for="fullname">Họ và tên</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>

                    <!-- Trường 'email' -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <!-- Trường 'phone' -->
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>

                    <!-- Trường 'birthday' -->
                    <div class="form-group">
                        <label for="birthday">Ngày sinh</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" required>
                    </div>

                    <!-- Trường 'gender' -->
                    <div class="form-group">
                        <label for="gender">Giới tính</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="0">Nam</option>
                            <option value="1">Nữ</option>
                        </select>
                    </div>

                    <!-- Trường 'avatar' -->
                    {{-- <div class="form-group">
                        <label for="avatar">Ảnh đại diện</label>
                        <input type="file" class="form-control-file" id="avatar" name="avatar">
                    </div> --}}

                    <!-- Trường 'address' -->
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
                    </div>

                    <!-- Trường 'password' -->
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" required>
                            <div class="input-group-append">
                                <span class="input-group-text">
                                    <i class="fa fa-eye-slash" id="toggle-password"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Trường 'roles' -->
                    <div class="form-group">
                        <label for="roles">Vai trò</label>
                        <select class="form-control" id="roles" name="roles" required>
                            <option value="1">Người dùng</option>
                            <option value="2">Quản trị viên</option>
                        </select>
                    </div>

                    <!-- Nút submit -->
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Thư viện jQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

    <!-- Thư viện Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <!-- Thư viện Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
            const passwordField = document.getElementById('password');
    const togglePasswordButton = document.getElementById('toggle-password');
    let passwordShown = false;

    togglePasswordButton.addEventListener('click', function() {
        if (passwordShown) {
            // Ẩn mật khẩu
            passwordField.type = 'password';
            togglePasswordButton.classList.remove('fa-eye');
            togglePasswordButton.classList.add('fa-eye-slash');
        } else {
            // Hiện mật khẩu
            passwordField.type = 'text';
            togglePasswordButton.classList.remove('fa-eye-slash');
            togglePasswordButton.classList.add('fa-eye');
        }
        passwordShown = !passwordShown;
    });
    </script>
</body>

</html>

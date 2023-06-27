<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Account</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
    table#user_datatable,
    table#user_datatable th {
        border: 1px solid #ddd;
    }

    /* table#user_datatable tr:hover {
        background-color: #ddd;
    } */
</style>

<body>
    <div class="container" style="padding-bottom: 50px;">
        <div class="row">
            <div class="col-12 table-responsive">
                <br />
                <h3 align="center">QUẢN LÝ TÀI KHOẢN</h3>
                <br />
                <div align="right">
                    <button type="button" name="create_record" id="create_record" class="btn btn-success"> <i
                            class="bi bi-plus-square"></i><a href="account/create"
                            style="color: #fff; text-decoration: none;"> Thêm tài khoản</a></button>
                </div>
                <br />
                <table id="user_datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên tài khoản</th>
                            <th>Họ và tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Giới tính</th>
                            <th>Ngày sinh</th>
                            <th>Ảnh đại diện</th>
                            <th>Địa chỉ</th>
                            <th>Vai trò</th>
                            <th width="180px">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // hien thi danh sach
        var table = $('#user_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('account.index') }}",
            columns: [{
                    data: 'id',
                    name: 'id',
                },
                {
                    data: 'username',
                    name: 'username',
                },
                {
                    data: 'fullname',
                    name: 'fullname',
                },
                {
                    data: 'email',
                    name: 'email',
                },
                {
                    data: 'phone',
                    name: 'phone',
                },
                {
                    data: 'gender',
                    name: 'gender',
                    render: function(data, type, row, meta) {
                        if (row.gender == 0) {
                            return "Nam";
                        } else if (row.gender == 1) {
                            return "Nữ";
                        } else {
                            return "Khác";
                        }
                    }
                },
                {
                    data: 'birthday',
                    name: 'birthday',
                    render: function(data) {
                        var date = new Date(data);
                        var day = date.getDate();
                        var month = date.getMonth() + 1;
                        var year = date.getFullYear();
                        if (day < 10) {
                            day = "0" + day;
                        }
                        if (month < 10) {
                            month = "0" + month;
                        }
                        return day + "-" + month + "-" + year;
                    }
                },
                {
                    data: 'avatar',
                    name: 'avatar',
                    // hiển thị ảnh
                    render: function(data, type, full, meta) {
                        var avatarUrl = '{{ asset('assets/images') }}/' + data;
                        return '<img src="' + avatarUrl + '" width=100" />';
                    }
                },
                {
                    data: 'address',
                    name: 'address',
                },
                {
                    data: 'roles',
                    name: 'roles',
                    render: function(data, type, row, meta) {
                        if (row.roles == 1) {
                            return "Người dùng";
                        } else if (row.roles == 2) {
                            return "Quản trị viên";
                        } else {
                            return "Quản trị viên cấp cao";
                        }
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
</script>

</html>

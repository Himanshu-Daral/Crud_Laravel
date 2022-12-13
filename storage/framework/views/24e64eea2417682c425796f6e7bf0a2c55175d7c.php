<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            width: 100% !important;
            background-image: url('/image/background.jpg');
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        tbody {
            display: block;
            max-height: 300px;
            overflow: scroll;
        }


        /* tbody {
            display: block;
            height: 200px;
            overflow: auto;
        } */

        thead,
        tbody tr {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        ::-webkit-scrollbar {
            width: 0px;
        }

        ::-webkit-scrollbar-track {
            background-color: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #d6dee1;
            border-radius: 20px;
            border: 6px solid transparent;
            background-clip: content-box;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: #a8bbbf;
        }
    </style>

</head>

<body>

    <!-- Add Employee Modal -->
    <div class="modal fade" id="AddEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Developer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="AddEmployeeForm" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">
                        <ul class="alert alert-warning d-none" id="save_errorList"></ul>
                        <div class="form-group mb-3">
                            <input type="text" name="firstname" class="form-control" placeholder="First Name" value="<?php echo e(old('firstname')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="<?php echo e(old('lastname')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo e(old('email')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="mobile" class="form-control" placeholder="Mobile" value="<?php echo e(old('mobile')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <select name="usertype" id="usert" class="form-control">
                                <option value="">--Select User Type--</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Employee Modal -->

    <div class="modal fade" id="EditEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Developer Info</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="UpdateEmployeeForm" method="POST" enctype="multipart/form-data">

                    <div class="modal-body">
                        <input type="hidden" name="emp_id" id="emp_id">

                        <div class="form-group mb-3">
                            <input type="text" name="firstname" id="edit_firstname" class="form-control" placeholder="First Name" value="<?php echo e(old('firstname')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="lastname" id="edit_lastname" class="form-control" placeholder="Last Name" value="<?php echo e(old('lastname')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="email" id="edit_email" class="form-control" placeholder="Email" value="<?php echo e(old('email')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name="mobile" id="edit_mobile" class="form-control" placeholder="Mobile" value="<?php echo e(old('mobile')); ?>">
                        </div>
                        <div class="form-group mb-3">
                            <select name="usertype" id="edit_usert" class="form-control">
                                <option value="">--Select User Type--</option>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    </div>
    <div class="container-xxl position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0 let">
            <a href="<?php echo e(url('registration')); ?>" class="navbar-brand p-0">
                <h1 class="text-primary m-0"><img src="/image/logo.png" alt=""></h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0 pe-4">
                    <a href="<?php echo e(url('adminHome')); ?>" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-hover="dropdown"><i class="fa fa-user me-3"></i><?php echo e(session()->get('firstname')); ?> <?php echo e(session()->get('lastname')); ?></a>
                        <div class="dropdown-menu m-0">
                            <a href="<?php echo e(url('/')); ?>" class="dropdown-item">LOGOUT</a>
                            <!-- <a href="logout" class="dropdown-item">requests</a> -->

                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Developer
                            <a href="#" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#AddEmployeeModal">Add Developer</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-secondary table-striped table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>User Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    <!-- <td><button type="button" value="'+item.id+'" delete_btn btn btn-danger btn-sm float-end>Delete</button></td> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            fetchEmployee();

            function fetchEmployee() {
                $.ajax({
                    type: "GET",
                    url: "/fetch-employee",
                    dataType: "json",
                    success: function(response) {
                        // console.log(response.employee);
                        $('#tbody').html("");
                        $.each(response.employee, function(key, item) {
                            $('#tbody').append('<tr>\
                             <td>' + item.firstname + ' ' + item.lastname + '</td>\
                             <td>' + item.email + '</td>\
                             <td>' + item.mobile + '</td>\
                             <td>' + item.usertype + '</td>\
                             <td><button type="button" value="' + item.id + '" class="edit btn btn-success btn-sm"><i class="fas fa-user-edit fa-lg"></i></button> <button type="button" value="' + item.id + '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt fa-lg"></i></button></td>\
                             </tr>\
                             ');

                        });
                    }
                });
            }

            $(document).on('click', '.edit', function(e) {
                e.preventDefault();

                var emp_id = $(this).val();
                // alert(emp_id);
                $('#EditEmployeeModal').modal('show');

                $.ajax({
                    type: "GET",
                    url: "/edit-employee/" + emp_id,
                    success: function(response) {
                        if (response.status == 404) {
                            alert(response.message);
                            $('#EditEmployeeModal').modal('hide');

                        } else if (response.status == 200) {
                            $('#edit_firstname').val(response.employee.firstname);
                            $('#edit_lastname').val(response.employee.lastname);
                            $('#edit_email').val(response.employee.email);
                            $('#edit_mobile').val(response.employee.mobile);
                            $('#edit_usert').val(response.employee.usert);
                            $('#emp_id').val(emp_id);
                        }
                    }
                });
            });

            $(document).on('submit', '#UpdateEmployeeForm', function(e) {
                e.preventDefault();

                var id = $('#emp_id').val();
                let EditformData = new FormData($('#UpdateEmployeeForm')[0]);

                $.ajax({
                    type: "POST",
                    url: "/update-employee/" + id,
                    data: EditformData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 400) {
                            $('#update_errorList').html("");
                            $('#update_errorList').removeClass('d-none');

                            $.each(response.errors, function(key, err_value) {
                                $('#update_errorList').append('<li>' + err_value + '</li>');
                            });
                        } else if (response.status == 404) {

                            alert(response.message);

                        } else if (response.status == 200) {
                            $('#update_errorList').html("");
                            $('#update_errorList').addClass('d-none');


                            $('#EditEmployeeModal').modal('hide');

                            fetchEmployee();
                        }
                    }
                });
            });

            $(document).on('click', '.delete', function() {
                var emp_id = $(this).val();
                if (confirm("Are you sure you want to Delete this data?")) {
                    $.ajax({

                        mehtod: "get",
                        url: "delete-employee/" + emp_id,
                        data: {
                            "id": emp_id
                        },
                        success: function(des) {
                            fetchEmployee();

                        }
                    })
                } else {
                    return false;
                }

            });

            $(document).on('submit', '#AddEmployeeForm', function(e) {
                e.preventDefault();

                let formData = new FormData($('#AddEmployeeForm')[0]);

                $.ajax({
                    type: "POST",
                    url: "registration",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status == 400) {
                            $('#save_errorList').html("");
                            $('#save_errorList').removeClass('d-none');
                            $.each(response.errors, function(key, err_value) {
                                $('#save_errorList').append('<li>' + err_value + '</li>');
                            });
                        } else if (response.status == 200) {
                            $('#save_errorList').html("");
                            $('#save_errorList').addClass('d-none');


                            $('#AddEmployeeForm').find('input').val('');
                            $('#AddEmployeeModal').modal('hide');

                            fetchEmployee();
                        }
                    }
                });

            });
        });
    </script>
</body>

</html><?php /**PATH C:\xampp\htdocs\Himanshu\laravel\crud\resources\views/registration.blade.php ENDPATH**/ ?>
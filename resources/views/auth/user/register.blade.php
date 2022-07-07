<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{asset('assets/images/logo-icon.png')}}" type="image/png" />
    <!-- loader-->
    <link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset('assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
    <title>Sign Up - Smart Parking</title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <div class="wrapper">
        <div class="section-authentication-sigup d-flex align-items-center justify-content-center my-5">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <img src="{{asset('assets/images/logo-img.png')}}" width="180" alt="" />
                        </div>
                        @include('components.flash')
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Sign Up</h3>
                                    </div>
                                    <div class="form-body" >
                                        <form class="row g-3" action="{{route('user.register.store')}}" method="POST">
                                            @csrf
                                            <div class="col-12">
                                                <label for="inputFullName" class="form-label">Enter Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    id="inputFullName" placeholder="Mr. Lorem">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Enter Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    id="inputEmailAddress" placeholder="unknown@example.net">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputUsername" class="form-label">Enter Username</label>
                                                <input type="text" name="username" class="form-control"
                                                    id="inputUsername" placeholder="Username">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputPhone" class="form-label">Enter Phone</label>
                                                <input type="text" name="phone" class="form-control"
                                                    id="inputPhone" placeholder="+62">
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Enter
                                                    Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" name="password"
                                                        class="form-control border-end-0" id="inputChoosePassword"
                                                        placeholder="Enter Password"> <a
                                                        href="javascript:;" class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputSelectRole" class="form-label">Select Role</label>
                                                <select class="form-control" id="inputSelectRole" placeholder="" name="user_role_id">
                                                    @foreach ($userRole as $id => $name)
                                                        <option value="{{ $id }}" @if (@$value == $id) selected @endif>{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="bx bx-box"></i>Sign Up</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <a class="btn btn-success" href="{{route('user.login.index')}}"><i class="bx bxs-lock-open"></i>Sign In</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
    <!--end wrapper-->

    <!--plugins-->
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
</body>

</html>

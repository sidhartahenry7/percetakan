<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <link
        href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900"
        rel="stylesheet"
    />

    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            background: #ecf0f3;
            
        }

        .wrapper {
            max-width: 700px;
            margin: 50px auto;
            padding: 40px 30px 30px 30px;
            background-color: #FFC300;
            border-radius: 15px;
            /* box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff; */
        }

        .wrapper .name {
            font-weight: 600;
            font-size: 1.4rem;
            letter-spacing: 1.3px;
            padding-left: 10px;
            color: #555;
        }

        .wrapper .form-field input {
            width: 100%;
            display: block;
            border: none;
            outline: none;
            background: none;
            font-size: 1.2rem;
            color: #666;
            padding: 10px 15px 10px 10px;
        }

        .wrapper .form-field {
            padding-left: 10px;
            margin-bottom: 20px;
            border-radius: 20px;
            box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
        }

        .wrapper .form-field .fas {
            color: #555;
        }

        .wrapper .btn {
            box-shadow: none;
            /* width: 100%;
            height: 40px; */
            background-color: #29a4da;
            color: white;
            border-radius: 25px;
            /* box-shadow: 3px 3px 3px #b1b1b1,
                -3px -3px 3px #fff; */
            letter-spacing: 1.3px;
        }

        .wrapper .btn:hover {
            background-color: #039BE5;
        }

        .wrapper .btnz {
            box-shadow: none;
            width: 100%;
            height: 40px;
            background-color: skyblue;
            color: white;
            border-radius: 25px;
            box-shadow: 3px 3px 3px #b1b1b1,
                -3px -3px 3px #fff;
            letter-spacing: 1.3px;
        }

        @media(max-width: 380px) {
            .wrapper {
                margin: 30px 20px;
                padding: 40px 15px 15px 15px;
            }
        }

        label {
            color: black;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('loginError') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="iq-header-title text-center">
            {{-- <img src="{{ asset('/images/Logo-Cassa.png') }}" width="200" height="100" style="object-fit: scale-down;"/> --}}
            <img src="{{ asset('/images/Logo-Soerabaja45.png') }}" width="50%" height="100" style="object-fit: scale-down;">
            <h4 style="font-weight: bold;" class="card-title">Login</h4>
        </div>
        <hr style="height: 10px;">
        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="form-group row">
                <label for="email" class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
                    @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-3 col-form-label">Password</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password" placeholder="password">
                    <input type="checkbox" onclick="myFunction()"> <label>Show Password</label>
                    @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn">Login</button>
                </div>
            </div>
            <div class="text-center fs-6">
                <label class="text-center">Not Registered? <a href="/register">Register Now!</a></label>
            </div>
        </form>
    </div>
</body>

<script>
    function myFunction() {
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
    }
    </script>

</html>
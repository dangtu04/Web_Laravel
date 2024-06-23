<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-mXUn8K6o2UyyUNPM3BHDO8qc7MX+17bwPm5zLu1XfWcx08DWCgQMgKaWeNxWA8yrx5V3SavPvMR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Đăng nhập</title>
    <style>
        .khung
        {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(to top, #a18cd1 0%, #fbc2eb 100%);
        }
        .boxlogin
        {
            max-width: 600px;
            min-width: 400px;
            background: white;
            display: block;
            padding: 20px;
            border-radius: 17px;
        }
    </style>
</head>
<body>
    <div class="khung">
        <div class="boxlogin">
            <h1 class="text-center text-success">ĐĂNG NHẬP</h1>
            <form action="{{ route('website.dologin') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="username">
                        <strong>Tên đăng nhập</strong>
                    </label>
                    <input type="text" id="username" class="form-control" placeholder="Tên đăng nhập hoặc email" name="username">
                </div>
                <div class="mb-3">
                    <label for="password">
                        <strong>Mật khẩu</strong>
                    </label>
                    <input type="password" id="password" class="form-control" placeholder="Mật khẩu" name="password">
                </div>
                <button type="submit" class="btn btn-success">Đăng nhập</button>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha512-vKMVj9WR8HqJAMF10I4ZW4cqlAT5o+2GMzGJ3lwu6RZ1WPeM5DtfiQbPDDPIjg9UYB/fNo/oxmCkLb97snCtHQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if (session()->has('message'))
    <script>
        toastr.options = {
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "closeButton": true
        }
        toastr.error('{{ session()->get('message') }}');
    </script>
@endif

    
</body>
</html>
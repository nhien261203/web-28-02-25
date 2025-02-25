<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="col-md-4 offset-md-4 mt-4">
            <form action="" method="POST" role="form">
                @csrf
                <legend class="text-center fw-bold ">Form Login User</legend>

                <div class="form-group mb-3">
                    <label for="email" class="fw-bold mb-2">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="input email">
                    @error('email')
                        <small>{{ $message }}</small>

                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="password" class="fw-bold mb-2">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="input password">

                </div>

                <button type="submit" class="btn btn-primary offset-md-4"  >Login now</button>
                <a href="{{ route('admin.register') }}">Dang ky</a>
            </form>

            <div class="d-flex justify-content-center mt-2">
                <a href="{{ route('login-by-google') }}"><button class="btn btn-primary">Login with gg</button></a>

            </div>
        </div>

    </div>
</body>
</html>

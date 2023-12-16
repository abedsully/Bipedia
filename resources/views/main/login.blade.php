<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | Bipedia</title>
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
</head>

<body class="mt-5 py-5 d-flex justify-content-center flex-column align-items-center">


    @if (session('success'))
        <div class="alert alert-success text-center d-flex align-items-center justify-content-center gap-2">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h1 class="mb-5">Login</h1>




    <div style="width: max-content; background-color: bisque;" class="rounded">
        <div class="d-flex justify-content-center gap-5 p-5">
            <form action="/login" method="POST">
                @if (session('loginError'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="text" placeholder="Enter Your Email" name="email"
                        class="form-control rounded-top @error('email') is-invalid @enderror" autofocus />
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" placeholder="Enter Your Password" name="password"
                        class="form-control rounded-top @error('password') is-invalid @enderror" autofocus />
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <p class="mt-3">Don't have an account yet? <a href="/register">Register</a> here!</p>
            </form>
            <a href="/" class="mt-5 pt-1"><img src="{{ asset('assets/logo.png') }}" alt="logo"></a>
        </div>
    </div>
</body>





{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>

</html>

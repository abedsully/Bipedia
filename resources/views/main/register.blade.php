<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register | Bipedia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
</head>

<body>

    <a href="/"><img src="{{ asset('assets/logo.png') }}" alt="" style="width: 10rem;"
        class="mt-3 mx-5"></a>

    <h1 class="text-center mt-5">Register</h1>

    <div class="px-5 mt-3">
        <form method="POST" class="mx-5" action="/register">
            @csrf
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" placeholder="Enter Your Full Name" name="name"
                    class="form-control rounded-top @error('name') is-invalid @enderror" value="{{ old('name') }}"
                    autofocus />
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" placeholder="Enter Your Full Name" name="username"
                    class="form-control rounded-top @error('username') is-invalid @enderror"
                    value="{{ old('username') }}" autofocus />
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" placeholder="Enter Your Phone Number" name="phone"
                    class="form-control rounded-top @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                    autofocus />
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Gender</label>
                <div class="form-check rounded-top @error('gender') is-invalid @enderror">
                    <input class="form-check-input" type="radio" name="gender" value="male">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" value="female">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Female
                    </label>
                </div>
                @error('gender')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" placeholder="Enter Your Address" name="address"
                    class="form-control rounded-top @error('address') is-invalid @enderror" value="{{ old('address') }}"
                    autofocus />
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Date of Birth</label>
                <input type="date" name="birthday"
                    class="form-control rounded-top @error('birthday') is-invalid @enderror"
                    value="{{ old('birthday') }}" autofocus />
                @error('birthday')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="text" placeholder="Enter Your Email" name="email"
                    class="form-control rounded-top @error('email') is-invalid @enderror" value="{{ old('email') }}"
                    autofocus />
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" placeholder="Enter Your Password" name="password"
                    class="form-control rounded-top @error('password') is-invalid @enderror"
                    value="{{ old('password') }}" autofocus />
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" placeholder="Confirm Your Password" name="confirm"
                    class="form-control rounded-top @error('confirm') is-invalid @enderror"
                    value="{{ old('password') }}" autofocus />
                @error('confirm')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <p class="mt-3">Already have an account? <a href="/login">Login</a></p>

        </form>
    </div>

</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile | Bipedia</title>
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" rel="stylesheet"
        type='text/css'>
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
</head>

<body>

    <div class="d-flex justify-content-between align-items-center px-5 py-3">
        <a href="/dashboard"><img src="{{ asset('assets/logo.png') }}" alt="" style="width: 10rem;"
                class="mt-3"></a>

        <div class="btn-group">
            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                @if (auth()->user()->profile_picture)
                    <img src="{{ asset('storage/profile/' . auth()->user()->profile_picture) }}" alt="avatar"
                        style="width: 3rem; height: 3rem;" class="rounded-circle">
                @elseif (auth()->user()->gender == 'male')
                    <img src="{{ asset('assets/male.webp') }}" alt="avatar" style="width: 3rem; height: 3rem;"
                        class="rounded-circle">
                @elseif (auth()->user()->gender == 'female')
                    <img src="{{ asset('assets/female.svg') }}" alt="avatar" style="width: 3rem; height: 3rem;"
                        class="rounded-circle">
                @endif
            </button>
            <div class="dropdown-menu dropdown-menu-right">
                <form action="/my-profile/{{ auth()->user()->id }}" method="GET">
                    @csrf
                    <button class="dropdown-item" type="submit"><i class="fa fa-user"></i> &nbsp View Profile</button>
                </form>

                <form action="/my-article/{{ auth()->user()->id }}" method="GET">
                    @csrf
                    <button class="dropdown-item" type="submit"><i class="fa fa-book"></i> &nbsp My Article</button>
                </form>

                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="fa fa-arrow-right"></i> &nbsp Logout</button>
                </form>
            </div>
        </div>
    </div>


    <h1 class="text-center">Edit Profile</h1>

    <div class="p-5">
        <form method="POST" class="mx-5" action="/update-profile/{{ $user->id }}">
            @csrf
            @method('patch')
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" placeholder="Enter Your Full Name" name="name"
                    class="form-control rounded-top @error('name') is-invalid @enderror" value="{{ $user->name }}"
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
                    value="{{ $user->username }}" autofocus />
                @error('username')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" placeholder="Enter Your Phone Number" name="phone"
                    class="form-control rounded-top @error('phone') is-invalid @enderror" value="{{ $user->phone }}"
                    autofocus />
                @error('phone')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" placeholder="Enter Your Address" name="address"
                    class="form-control rounded-top @error('address') is-invalid @enderror"
                    value="{{ $user->address }}" autofocus />
                @error('address')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="text" placeholder="Enter Your Email" name="email"
                    class="form-control rounded-top @error('email') is-invalid @enderror" value="{{ $user->email }}"
                    autofocus />
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

<footer class="bg-dark text-light py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h5>Bipedia</h5>
                <p>IT Divison Binus Software Engineering Project</p>
                <p>Created with &#9829; by Kelompok 5</p>
            </div>
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li>1. Alexander Christian Gandasurya</li>
                    <li>2. Elroy Hans Anggada</li>
                    <li>3. Nathan Alexius Tannos</li> 
                    <li>4. Peter Louis Anderson</li>
                    <li>5. Stefanus Albert Wilson</li>
                </ul>
            </div>
        </div>
    </div>
</footer>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</html>

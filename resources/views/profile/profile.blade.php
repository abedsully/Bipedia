<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Profile | Bipedia</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
                    <img src="{{ asset('assets/male.webp') }}" alt="avatar" style="width: 3rem; height: 3rem;" class="rounded-circle">
                @elseif (auth()->user()->gender == 'female')
                    <img src="{{ asset('assets/female.svg') }}" alt="avatar" style="width: 3rem; height: 3rem;" class="rounded-circle">
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

    @if (session('success'))
        <div class="alert alert-success text-center d-flex align-items-center justify-content-center gap-2">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))8
        <div class="alert alert-danger text-center d-flex align-items-center justify-content-center gap-2"
            role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <section class="d-flex justify-content-around align-items-center mt-5">
        <div class="row">
            <div class="col-lg-10 mx-5 mt-3">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        @if ($user->profile_picture)
                            <img src="{{ asset('storage/profile/' . $user->profile_picture) }}" alt="avatar" style="width: 180px; height: 180px; border-radius: 90%;">
                        @elseif ($user->gender == 'male')
                            <img src="{{ asset('assets/male.webp') }}" alt="avatar" style="width: 180px; height: 180px; border-radius: 90%;">
                        @elseif ($user->gender == 'female')
                            <img src="{{ asset('assets/female.svg') }}" alt="avatar" style="width: 180px; height: 180px; border-radius: 90%;">
                        @endif
                            <h5 class="my-3"></h5>
                            <p class="text-muted mb-1">{{ $user->username }}</p>


                            @if (auth()->user()->id === $user->id)
                                <div class="d-flex justify-content-center mb-2">
                                    <form action="/add-picture/{{ auth()->user()->id }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')

                                        <div class="profile-content d-flex align-items-center gap-2 flex-column">
                                            <label for="file-upload" class="change-profile-picture">
                                                Change Profile Photo
                                            </label>

                                            <input id="file-upload" type="file" name="profile_picture"
                                                class="form-control @error('profile_picture') is-invalid @enderror">
                                            @error('profile_picture')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <button type="submit" class="btn btn-success btn-sm">Confirm Photo</button>
                                        </div>
                                    </form>


                                </div>
                            @endif



                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Full Name</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ ucwords($user->name) }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Username</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->username }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Gender</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ ucwords($user->gender) }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->email }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Phone</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->phone }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Address</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->address }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Date of Birth</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $user->birthday }}</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Articles</p>
                        </div>
                        <div class="col-sm-9">
                            <a href="/my-article/{{ $user->id }}" class="text-primary mb-0">View Articles</a>
                        </div>
                    </div>

                </div>
            </div>
            @if (auth()->user()->id === $user->id)
            <div class="mt-3 d-flex justify-content-center">
                <a href="/edit-profile/{{$user->id}}" class="btn btn-secondary btn-sm">
                    <i class="fa fa-edit bg-secondary p-1 text-white"></i> Edit Profile
                </a>
            </div>
            @endif
        </div>
    </section>
</body>

<footer class="bg-dark text-light py-4 mt-5">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

</html>

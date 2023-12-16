<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Lists | Bipedia</title>
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

    <div class="container mt-3">
        <div class="row">
            <h2 class="text-center mb-5">User Lists</h2>

            @if (session('success'))
                <div class="alert alert-success text-center d-flex align-items-center justify-content-center gap-2 mt-2">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @foreach ($users as $user)
                <div class="col-lg-4 mb-5">
                    <div class="card">
                        <div class="card-body text-center">
                            @if ($user->profile_picture)
                                <img src="{{ asset('storage/profile/' . $user->profile_picture) }}" alt="avatar"
                                    style="width: 180px; height: 180px; border-radius: 90%;">
                            @elseif ($user->gender == 'male')
                                <img src="{{ asset('assets/male.webp') }}" alt="avatar"
                                    style="width: 180px; height: 180px; border-radius: 90%;">
                            @elseif ($user->gender == 'female')
                                <img src="{{ asset('assets/female.svg') }}" alt="avatar"
                                    style="width: 180px; height: 180px; border-radius: 90%;">
                            @endif
                            <h5 class="my-3"></h5>
                            @if (auth()->user()->id !== $user->id)
                                <p class="text-muted mb-1">{{ ucwords($user->name) }}</p>
                            @else
                                <p class="text-muted mb-1">Me</p>
                            @endif

                            <div class="d-flex justify-content-center mb-2">
                                <form action="/delete-user/{{ $user->id }}" method="POST"
                                    id="deleteForm{{ $user->id }}">
                                    @csrf
                                    @method('delete')

                                    <div class="profile-content d-flex align-items-center gap-2 mt-3">
                                        <a href="/view-profile/{{ $user->id }}" class="btn btn-primary btn-sm"><i
                                                class="fa fa-eye bg-primary p-1 text-white"></i> View Details</a>
                                        @if (auth()->user()->id !== $user->id)
                                            <button type="button" onclick="confirmDelete({{ $user->id }})"
                                                class="btn btn-danger btn-sm"><i
                                                    class="fa fa-trash bg-danger p-1 text-white"></i> Delete
                                                User</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

<footer class="bg-dark text-light py-4 mt-4">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js"
    integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- Alert Delete --}}
<script>
    function confirmDelete(userId) {
        var confirmation = confirm("Do you really wish to delete this user?");
        if (confirmation) {
            document.getElementById('deleteForm' + userId).submit();
        } else {
            return false;
        }
    }
</script>

</html>

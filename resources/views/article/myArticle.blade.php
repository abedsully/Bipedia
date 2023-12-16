<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Article | Bipedia</title>
    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}" type="image/x-icon">
    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/shared.css') }}">

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

    <div class="d-flex justify-content-center">
        <div class="col-md-3">
            <form action="/dashboard" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search" name="search"
                        aria-describedby="button-addon2">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </div>
            </form>
        </div>
    </div>



    <section class="main-content px-5 pt-3 d-flex justify-content-center">
        <h3>Article published by <a href="">{{ $user->username }}</a></h3>
    </section>

    @if (session('success'))
        <div class="alert alert-success text-center d-flex align-items-center justify-content-center gap-2 mt-2">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <main class="flex-grow-1">
        <section class="p-5 d-flex flex-column gap-3">
            @if ($articles->count() > 0)
                @foreach ($articles as $article)
                    <div class="card">
                        <div class="card-header d-flex flex-column">
                            <p>{{ $article->title }}</p>
                            <footer class="blockquote-footer">Published by: <cite title="Source Title"><a
                                        href="">{{ $article->user->username }}</a></cite></footer>
                            <p style="font-size: 12px;">Date Published: {{ $article->date }}</p>
                        </div>
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p style="font-size: 12px;">{{ Str::limit($article->content, 300, '...') }}</p>

                                <div class="d-flex gap-2 align-items-center">
                                    @if (auth()->user()->id === $article->user->id)
                                        <a href="/edit-article/{{ $article->id }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit bg-primary p-1 text-white"></i> Edit Article
                                        </a>
                                        <form action="/delete-article/{{ $article->id }}" method="POST"
                                            id="deleteForm{{ $article->id }}">
                                            @csrf
                                            @method('delete')
                                            <button type="button" onclick="confirmDelete({{ $article->id }})"
                                                class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash bg-danger p-1 text-white"></i> Delete Article
                                            </button>
                                        </form>
                                    @else
                                        <a href="/article-details/{{ $article->id }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-eye bg-primary p-1 text-white"></i> View Details
                                        </a>
                                    @endif
                                </div>

                            </blockquote>
                        </div>
                    </div>
                @endforeach
            @else
                <h4 class="text-secondary text-center">No Articles Yet</h4>
            @endif
        </section>
    </main>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js"
    integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- Alert Delete --}}
<script>
    function confirmDelete(articleId) {
        var confirmation = confirm("Do you really wish to delete this article?");
        if (confirmation) {
            document.getElementById('deleteForm' + articleId).submit();
        } else {
            return false;
        }
    }
</script>

</html>

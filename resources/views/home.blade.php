<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbar">
                <ul class="navbar-nav">
                    @if(auth()->check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}" dusk="dashboard_menu_link">{{ __('Dashboard') }}</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}" dusk="login_menu_link">{{ __('Login') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}" dusk="register_menu_link">{{ __('Register') }}</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-12 col-xs-12 col-md-8 mx-auto">
                @forelse($posts as $post)
                <div class="post mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h1>{{ $post->title }}</h1>
                            <p>
                                {{ __('By') }} <strong>{{ $post->user->name }}</strong> / {{ $post->published_at->toDayDateTimeString() }}
                            </p>
                            <p>{{ $post->description }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="post mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h1>{{ __('No post found!') }}</h1>
                        </div>
                    </div>
                </div>
                @endforelse

                <div class="mt-4" style="padding-bottom: 100px;">
                    {!! $posts->links() !!}
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>
@extends ("layouts.app")

@section('title', $title)

@section('content')
    <div class="col-md-9">
        {{-- <div class="row">
        <h1>{{ $title }}</h1>
    </div> --}}
        @include('goback')
        <article class="card mb-4">
            <header class="card-header text-center">
                <h1 class="card-title">{{ $title }}</h1>
            </header>
            <a href="post-image.html">
                <img class="card-img" src="/storage/images/{{ $image }}" alt="">
            </a>
            <div class="card-body">
                {{ $body }}
            </div>
        </article>
    </div>
@endsection

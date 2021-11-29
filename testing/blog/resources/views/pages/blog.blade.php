@extends ("layouts.app")

@section('title', 'Blog Posts')

@section('content')
    <div class="col-md-9">
        <div class="row">

            <div class="col-md-6">
                @for ($i = 0; $i < count($posts); $i += 2)
                    <?php $post = $posts[$i]; ?>
                    <article class="card mb-4">
                        <header class="card-header">
                            <div class="card-meta">{{ $post['created_at'] }}</div>
                            <a href="{{ route('viewPost', ['slug' => $post['slug']]) }}">{{ $post['title'] }}</a>
                        </header>
                        <a href="{{ route('viewPost', ['slug' => $post['slug']]) }}">
                            <img class="card-img" src="/storage/images/{{ $post['image'] }}" />
                        </a>
                        <div class="card-body">
                            {{ $post['body'] }}
                        </div>
                    </article>
                @endfor
            </div>
            <div class="col-md-6">
                @for ($i = 1; $i < count($posts); $i += 2)
                    <?php $post = $posts[$i]; ?>
                    <article class="card mb-4">
                        <header class="card-header">
                            <div class="card-meta">{{ $post['created_at'] }}</div>
                            <a href="{{ route('viewPost', ['slug' => $post['slug']]) }}">{{ $post['title'] }}</a>
                        </header>
                        <a href="{{ route('viewPost', ['slug' => $post['slug']]) }}">
                            <img class="card-img" src="/storage/images/{{ $post['image'] }}" />
                        </a>
                        <div class="card-body">
                            {{ $post['body'] }}
                        </div>
                    </article>
                @endfor
            </div>

        </div>
    </div>

    {{-- @php
    $range = [1, 100];
    echo $range[1];
    @endphp

    @if (is_array($range))
        Range is array.
    @else
        Range is not an array.
    @endif --}}

@endsection


@section('pagination')


    <div class="d-flex justify-content-center col-md-12">
        {{ $posts->links('util.pagination') }}

    </div>

@endsection

@extends ("layouts.app")

@section('title', 'Blog Posts')

@section('content')
    <div class="col-md-9">
        @if ($msg = Session::get('success'))
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="liveToast" class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header">
                        <strong class="me-auto"><i class="bi-globe"></i> Success!</strong>
                        <small>Now</small>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"></button>
                    </div>
                    <div class="toast-body">
                        {{ $msg }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('posts.create') }}" class="btn btn-primary mb-2">Create new post</a>
            </div>
            <div class="col-md-6">
                @for ($i = 0; $i < count($posts); $i += 2)
                    <?php $post = $posts[$i]; ?>
                    <article class="card mb-4">
                        <header class="card-header">
                            <div class="card-meta">{{ $post['created_at'] }}</div>
                            <a href="{{ route('posts.show', ['slug' => $post['slug']]) }}">{{ $post['title'] }}</a>
                            <a href="{{ route('posts.edit', ['slug' => $post['slug']]) }}"
                                class="btn btn-success mb-2">Edit</a>
                            <form action="{{ route('posts.destroy', $post->slug) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger mb-2">Delete</button>
                            </form>
                        </header>
                        <a href="{{ route('posts.show', ['slug' => $post['slug']]) }}">
                            <img class="card-img" src="/storage/images/{{ $post['image'] }}" alt="" />
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
                            <a href="{{ route('posts.show', ['slug' => $post['slug']]) }}">{{ $post['title'] }}</a>
                            <a href="{{ route('posts.edit', ['slug' => $post['slug']]) }}"
                                class="btn btn-success mb-2">Edit</a>
                            <form action="{{ route('posts.destroy', $post->slug) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-danger mb-2">Delete</button>
                            </form>
                        </header>
                        <a href="{{ route('posts.show', ['slug' => $post['slug']]) }}">
                            <img class="card-img" src="/storage/images/{{ $post['image'] }}" alt="" />
                        </a>
                        <div class="card-body">
                            {{ $post['body'] }}
                        </div>
                    </article>
                @endfor
            </div>

        </div>
    </div>

    <style>
        form {
            display: inline;
        }

    </style>

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

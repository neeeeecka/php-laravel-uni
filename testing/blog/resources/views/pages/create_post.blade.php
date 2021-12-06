@extends ("layouts.app")

@section('title', 'Create new post')

@section('content')
    <div class="col-md-9">
        <h1>Creating</h1>

        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="titleInput" class="form-label">Title</label>
                <input name="title" type="text" class="form-control" id="titleInput" placeholder="Title">
                <div id="emailHelp" class="form-text">Your post's title publicly visible to everyone.</div>

                <input style="display: none;" name="author" value="TODO" />
                <input style="display: none;" name="category" value="TODO" />
                <input style="display: none;" name="image" value="TODO" />


            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1">Content</label>
                <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="10"
                    placeholder="Write your post here"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Post blog</button>



        </form>
    </div>
@endsection

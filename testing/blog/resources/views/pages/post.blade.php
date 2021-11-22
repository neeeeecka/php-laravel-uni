@extends ("layouts.app")

@section('title', $title)

@section('content')
    {{-- <div class="row">
        <h1>{{ $title }}</h1>
    </div> --}}
    @include('goback')
    <article class="card mb-4">
        <header class="card-header text-center">
            <h1 class="card-title">{{ $title }}</h1>
        </header>
        <a href="post-image.html">
            <img class="card-img" src="img/articles/1.jpg" alt="">
        </a>
        <div class="card-body">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea quas eaque harum modi velit error! Ipsam quae
            accusamus dolores delectus harum ratione repudiandae quam laborum eum distinctio fugit optio, magnam suscipit
            vero corrupti fugiat quasi libero praesentium. Deserunt assumenda modi adipisci quis suscipit qui, sunt
            accusamus maiores quod harum odit facere ipsa ratione voluptas nulla cumque unde, pariatur dolorem nobis est
            alias magni laudantium fuga. Illo voluptate vel commodi mollitia aliquid deserunt quasi quod odit dignissimos.
            Eos, enim in est tempora totam, quasi ut accusamus ad iste tempore, expedita sunt dolores iusto excepturi sit
            nulla veniam eveniet. Sequi, distinctio officiis!
        </div>
    </article>
@endsection

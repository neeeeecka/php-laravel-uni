@extends ("layouts.app")

@section('title', 'Blog Posts')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <article class="card mb-4">
                <header class="card-header">
                    <div class="card-meta">1 day ago</div>
                    <a href="{{ route('viewPost', ['slug' => 'cats-vs-dogs']) }}">Cats vs dogs</a>
                </header>
                <a href="{{ route('viewPost', ['slug' => 'cats-vs-dogs']) }}">
                    <img class="card-img"
                        src="https://resources.stuff.co.nz/content/dam/images/4/y/m/d/w/l/image.related.StuffLandscapeSixteenByNine.1420x800.20d7m8.png/1589916991300.jpg" />
                </a>
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores ad dignissimos quia maiores
                    quos laudantium vitae mollitia totam a vero!
                </div>
            </article>
            <article class="card mb-4">
                <header class="card-header">
                    <div class="card-meta">1 day ago</div>
                    <a href="{{ route('viewPost', ['slug' => 'travelling-abroad']) }}">Travelling abroad</a>
                </header>
                <a href="{{ route('viewPost', ['slug' => 'travelling-abroad']) }}">
                    <img class="card-img"
                        src="https://res.cloudinary.com/worldpackers/image/upload/c_limit,f_auto,q_auto,w_1140/kd4rv0bium4jvq0uibg3" />
                </a>
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores ad dignissimos quia maiores
                    quos laudantium vitae mollitia totam a vero!
                </div>
            </article>
        </div>
        <div class="col-md-6">
            <article class="card mb-4">
                <header class="card-header">
                    <div class="card-meta">1 day ago</div>
                    <a href="{{ route('viewPost', ['slug' => 'is-nature-good']) }}">Is Nature good?</a>
                </header>
                <a href="{{ route('viewPost', ['slug' => 'is-nature-good']) }}">
                    <img class="card-img"
                        src="https://rukminim1.flixcart.com/image/416/416/j7usl8w0/poster/5/c/h/medium-beautiful-nature-wallpapers-poster-png6n7po1154-original-imaexz5rzfmqkkv8.jpeg?q=70" />
                </a>
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores ad dignissimos quia maiores
                    quos laudantium vitae mollitia totam a vero!
                </div>
            </article>
            <article class="card mb-4">
                <header class="card-header">
                    <div class="card-meta">1 day ago</div>
                    <a href="{{ route('viewPost', ['slug' => 'horses-in-africa']) }}">Horses in africa</a>
                </header>
                <a href="{{ route('viewPost', ['slug' => 'horses-in-africa']) }}">
                    <img class="card-img"
                        src="https://www.10wallpaper.com/wallpaper/1920x1200/1212/Zebras_Kenya-National_Geographic_photography_wallpaper_1920x1200.jpg" />
                </a>
                <div class="card-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores ad dignissimos quia maiores
                    quos laudantium vitae mollitia totam a vero!
                </div>
            </article>
        </div>
    </div>

    @php
    $range = [1, 100];
    echo $range[1];
    @endphp

    @if (is_array($range))
        Range is array.
    @else
        Range is not an array.
    @endif
@endsection

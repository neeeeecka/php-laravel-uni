<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Document</title>
</head>

<body class="">
    <div class="todos">
        <div class="todos__row">
            <input type="text" value="" class="todos__input" placeholder="ახალი დავალება" />
            <button class="button todos__addbutton" disabled>+
                დავალების
                დამატება</button>
        </div>
        <div class="todos__container">
            @include("components.todo")
        </div>
        <div class="todos__row todos__row--last">
            <button class="button todos__deleteButton">შესრულებული დავალების წაშლა</button>
        </div>
    </div>

</body>

</html>

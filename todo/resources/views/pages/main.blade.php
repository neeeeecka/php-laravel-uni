<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/vue@next"></script>

    <title>Document</title>
</head>

<body class="">
    <div class="todos" id="app">

        <div class="todos__row">
            <input type="text" value="" class="todos__input" placeholder="ახალი დავალება" ref="inputRef"
                v-model="inputValue" />
            <button class="button todos__add-button" :disabled="isAdding" v-on:click="onAdd">+
                დავალების
                დამატება</button>
        </div>
        <div class="todos__container">
            @include("components.todo", $todos)
        </div>
        <div class="todos__row todos__row--last">
            <button class="button todos__delete-button" v-on:click="onDelete">
                <i class="fas fa-trash button__icon"></i>
                <span class="button__text">შესრულებული დავალების წაშლა</span>
            </button>
        </div>

    </div>

</body>

<script>
    const {
        onMounted,
        ref,
    } = Vue;
    const app = Vue.createApp({
        setup() {
            const addButtonRef = ref(null);
            const inputValue = ref("");
            const todos = ref(Array({{ '1' }}).fill(null));
            const isAdding = ref(false);

            //LARAVEL CSRF TOKEN INSERTED FROM SERVER
            const CSRF_TOKENREF = ref("{{ csrf_token() }}");
            //----------------------------------------

            const addTodoRef = (index, el) => {
                todos.value[index] = el;
            };

            const onDelete = () => {
                console.log("Ondelete")
            };
            const onAdd = async () => {
                console.log("On add");
                isAdding.value = true;
                const result = await fetch("todos", {
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        _token: CSRF_TOKENREF.value,
                        text: inputValue.value,
                    }),
                });
                if (result.ok) {
                    inputValue.value = "";
                }
                isAdding.value = false;

            };
            const onTaskDone = (itemId) => {
                console.log("On task done", itemId)
            };

            onMounted(() => {
                console.log("Mounted");
            });

            return {
                addButtonRef,
                addTodoRef,
                onDelete,
                onAdd,
                onTaskDone,
                todos,
                inputValue,
                CSRF_TOKENREF,
                isAdding
            };
        }
    });
    app.mount("#app");
</script>

</html>

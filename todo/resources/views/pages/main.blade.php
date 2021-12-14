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

            @include("components.todo", [
            "id" => -1,
            "text" => "",
            "noref" => true
            ])

            @for ($i = 0; $i < count($todos); $i++)
                @php
                    $todo = $todos[$i];
                @endphp
                @include("components.todo", $todo)
            @endfor
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
        computed,
    } = Vue;
    const app = Vue.createApp({
        setup() {
            const addButtonRef = ref(null);
            const inputValue = ref("");
            // const todos = ref({});
            const length = ref({{ count($todos) }});

            const tempTodos = ref({});
            const localTodos = ref({});

            const isAdding = ref(false);

            //LARAVEL CSRF TOKEN INSERTED FROM SERVER
            const CSRF_TOKENREF = ref("{{ csrf_token() }}");
            //----------------------------------------

            const makeTodo = (id, text, is_done, el) => {
                return {
                    id,
                    text,
                    is_done,
                    el
                };
            };


            const addTodo = (todo, where) => {

                where.value[todo.id] = todo;
            }

            const initTodoRef = (id, text, is_done, el) => {
                if (tempTodos.value[id] == undefined) {
                    const todo = makeTodo(id, text, is_done, el);
                    addTodo(todo, tempTodos);
                } else {
                    // console.log("Tried to add existing");
                }
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

                    const response = await result.json();
                    addTodo(response, localTodos);

                    inputValue.value = "";
                }
                isAdding.value = false;

            };
            const onTaskDone = (itemId) => {
                if (localTodos.value[itemId]) {
                    localTodos.value[itemId].is_done = !localTodos.value[itemId].is_done;
                } else {
                    console.log(itemId, !tempTodos.value[itemId].is_done);
                    tempTodos.value[itemId].is_done = !tempTodos.value[itemId].is_done;
                }

            };

            onMounted(() => {
                console.log("Mounted");
            });

            const todos = computed(() => {
                const newArr = Object.keys(localTodos.value).map((key) => localTodos.value[key]).sort((
                    a,
                    b) => b.id - a.id);
                return newArr;
            });


            return {
                addButtonRef,
                initTodoRef,
                onDelete,
                onAdd,
                onTaskDone,
                todos,
                tempTodos,
                inputValue,
                CSRF_TOKENREF,
                isAdding,

            };
        }
    });
    app.mount("#app");
</script>

</html>

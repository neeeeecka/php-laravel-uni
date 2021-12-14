@for ($i = 0; $i < count($todos); $i++)
    @php
        $todo = $todos[$i];
        $id = $todo['id'];
    @endphp
    <div class="todos__item" v-bind:ref="(ref)=>addTodoRef({{ $id }}, ref)"
        v-on:click="onTaskDone({{ $id }})">
        <span class="todos__item__text">
            {{ $todo['text'] }}
        </span>
        <span class="checkbox">
            <span class="checkbox__inner">
                <i class="fas fa-check checkbox__inner__mark"></i>
            </span>
        </span>
    </div>
@endfor

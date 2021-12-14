@if (isset($noref))
    <div class="todos__item" v-for="todo in localTodos" v-bind:ref="(ref)=>addTodoRef(todo.id, ref)"
        v-on:click="onTaskDone(todo.id)">
        <span class="todos__item__text">
            <?php
            echo '{{todo.text}}';
            ?>
        </span>
        <span class="checkbox">
            <span class="checkbox__inner">
                <i class="fas fa-check checkbox__inner__mark"></i>
            </span>
        </span>
    </div>
@else
    <div class="todos__item" v-bind:ref="(ref)=>addTodoRef({{ $id }}, ref)"
        v-on:click="onTaskDone({{ $id }})">
        <span class="todos__item__text">
            {{ $text }}
        </span>
        <span class="checkbox">
            <span class="checkbox__inner">
                <i class="fas fa-check checkbox__inner__mark"></i>
            </span>
        </span>
    </div>
@endif

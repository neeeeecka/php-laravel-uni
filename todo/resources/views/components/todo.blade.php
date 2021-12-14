@if (isset($noref))
    <div v-bind:class="{
        'todos__item': true,
        'todos__item--done': todo.is_done,
    }"
        v-for="todo in todos" v-on:click="onTaskDone(todo.id)">
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
    <?php
    
    ?>
    <div v-bind:class="{
        'todos__item': true,
        'todos__item--done': tempTodos['{{ $id }}'] ? tempTodos['{{ $id }}'].is_done : false,
    }"
        v-bind:ref="(ref)=>initTodoRef({{ $id }}, '{{ $text }}', {{ $is_done }}, ref)"
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

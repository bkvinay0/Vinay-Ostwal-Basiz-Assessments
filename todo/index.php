<?php
require_once "../layout/header.php";
?>

<h1>Task 2 - Todo App</h1>

<div class="todo-container">

    <div class="todo-input-area">
        <input
            type="text"
            id="todoInput"
            placeholder="Enter a todo"
        >

        <button type="button" id="addTodoButton">
            Add Todo
        </button>
    </div>

    <div id="todoList" class="todo-list"></div>

</div>

<style>

    h1 {
        margin-bottom: 25px;
    }

    .todo-container {
        max-width: 700px;
    }

    .todo-input-area {
        display: flex;
        gap: 10px;
        margin-bottom: 25px;
    }

    .todo-input-area input {
        flex: 1;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    .todo-input-area button {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        background-color: #1f2937;
        color: #ffffff;
        cursor: pointer;
    }

    .todo-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .todo-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #ffffff;
    }

    .todo-content {
        flex: 1;
        word-break: break-word;
    }

    .todo-item.completed .todo-content {
        text-decoration: line-through;
        color: #888;
    }

    .todo-actions {
        display: flex;
        gap: 6px;
    }

    .todo-actions button {
        padding: 7px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        color: #ffffff;
    }

    .complete-button {
        background-color: #28a745;
    }

    .edit-button {
        background-color: #007bff;
    }

    .delete-button {
        background-color: #dc3545;
    }

    .empty-message {
        color: #777;
        padding: 15px 0;
    }

</style>

<script src="script.js"></script>

</main>
</div>

</body>
</html>
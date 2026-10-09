document.addEventListener("DOMContentLoaded", function () {

    const todoInput = document.getElementById("todoInput");
    const addTodoButton = document.getElementById("addTodoButton");
    const todoList = document.getElementById("todoList");

    // Load saved todos from the browser.
    let todos = JSON.parse(localStorage.getItem("basizTodos")) || [];

    addTodoButton.addEventListener("click", function () {
        addTodo();
    });

    todoInput.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            addTodo();
        }
    });

    function addTodo() {

        const todoText = todoInput.value.trim();

        if (todoText === "") {
            return;
        }

        todos.push({
            text: todoText,
            completed: false
        });

        saveTodos();

        todoInput.value = "";

        renderTodos();
    }

    // Show all todos on the page.
    function renderTodos() {

        todoList.innerHTML = "";

        if (todos.length === 0) {
            const emptyMessage = document.createElement("div");

            emptyMessage.className = "empty-message";
            emptyMessage.textContent = "No todos added.";

            todoList.appendChild(emptyMessage);

            return;
        }

        todos.forEach(function (todo, index) {

            const todoItem = document.createElement("div");

            todoItem.className = "todo-item";

            if (todo.completed) {
                todoItem.classList.add("completed");
            }

            const todoContent = document.createElement("div");

            todoContent.className = "todo-content";
            todoContent.textContent = todo.text;

            const todoActions = document.createElement("div");

            todoActions.className = "todo-actions";

            const completeButton =
                document.createElement("button");

            completeButton.className = "complete-button";
            completeButton.textContent =
                todo.completed ? "Undo" : "Complete";

            completeButton.addEventListener("click", function () {
                toggleTodo(index);
            });

            const editButton =
                document.createElement("button");

            editButton.className = "edit-button";
            editButton.textContent = "Edit";

            editButton.addEventListener("click", function () {
                editTodo(index);
            });

            const deleteButton =
                document.createElement("button");

            deleteButton.className = "delete-button";
            deleteButton.textContent = "Delete";

            deleteButton.addEventListener("click", function () {
                deleteTodo(index);
            });

            todoActions.appendChild(completeButton);
            todoActions.appendChild(editButton);
            todoActions.appendChild(deleteButton);

            todoItem.appendChild(todoContent);
            todoItem.appendChild(todoActions);

            todoList.appendChild(todoItem);
        });
    }

    function toggleTodo(index) {

        todos[index].completed =
            !todos[index].completed;

        saveTodos();

        renderTodos();
    }

    function editTodo(index) {

        const updatedText = prompt(
            "Edit todo:",
            todos[index].text
        );

        if (updatedText === null) {
            return;
        }

        const trimmedText = updatedText.trim();

        if (trimmedText === "") {
            return;
        }

        todos[index].text = trimmedText;

        saveTodos();

        renderTodos();
    }

    function deleteTodo(index) {

        todos.splice(index, 1);

        saveTodos();

        renderTodos();
    }

    // Save todos in the browser.
    function saveTodos() {
        localStorage.setItem(
            "basizTodos",
            JSON.stringify(todos)
        );
    }

    renderTodos();

});
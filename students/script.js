document.addEventListener("DOMContentLoaded", function () {
    const studentForm = document.getElementById("studentForm");
    const dateOfBirth = document.getElementById("dateOfBirth");
    const age = document.getElementById("age");
    const fatherMobile = document.getElementById("fatherMobile");
    const email = document.getElementById("email");
    const toastContainer = document.getElementById("toastContainer");

    // Calculate age from the date of birth.
    dateOfBirth.addEventListener("change", function () {
        clearFieldError(dateOfBirth);

        if (!dateOfBirth.value) {
            age.value = "";
            return;
        }

        const birthDate = new Date(dateOfBirth.value);
        const today = new Date();

        let calculatedAge =
            today.getFullYear() - birthDate.getFullYear();

        const monthDifference =
            today.getMonth() - birthDate.getMonth();

        if (
            monthDifference < 0 ||
            (
                monthDifference === 0 &&
                today.getDate() < birthDate.getDate()
            )
        ) {
            calculatedAge--;
        }

        age.value = calculatedAge;

        clearFieldError(age);
    });

    fatherMobile.addEventListener("input", function () {
        fatherMobile.value = fatherMobile.value
            .replace(/\D/g, "")
            .slice(0, 10);

        clearFieldError(fatherMobile);
    });

    document.getElementById("name").addEventListener("input", function () {
        clearFieldError(this);
    });

    document.getElementById("standard").addEventListener("input", function () {
        clearFieldError(this);
    });

    email.addEventListener("input", function () {
        clearFieldError(email);
    });

    // Check the form details before saving.
    studentForm.addEventListener("submit", function (event) {
        event.preventDefault();

        clearAllFieldErrors();

        const formData = new FormData(studentForm);

        const name = formData.get("name").trim();
        const standard = formData.get("standard").trim();
        const dateOfBirthValue = formData.get("dateOfBirth");
        const ageValue = formData.get("age");
        const mobile = formData.get("fatherMobile").trim();
        const emailValue = formData.get("email").trim();

        const clientErrors = [];

        if (name === "") {
            clientErrors.push("Name is mandatory.");
            markFieldError("name");
        }

        if (standard === "") {
            clientErrors.push("Standard is mandatory.");
            markFieldError("standard");
        }

        if (dateOfBirthValue === "") {
            clientErrors.push("Date of birth is mandatory.");
            markFieldError("dateOfBirth");
        }

        if (ageValue === "") {
            clientErrors.push("Age is mandatory.");
            markFieldError("age");
        }

        if (!/^\d{10}$/.test(mobile)) {
            clientErrors.push(
                "Mobile number must contain exactly 10 digits."
            );
            markFieldError("fatherMobile");
        }

        if (emailValue === "") {
            clientErrors.push("Email is mandatory.");
            markFieldError("email");
        } else {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(emailValue)) {
                clientErrors.push("Please enter a valid email address.");
                markFieldError("email");
            }
        }

        fetch("save student.php", {
            method: "POST",
            body: formData
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {

                const displayedErrors = [];

                clientErrors.forEach(function (error) {
                    if (!displayedErrors.includes(error)) {
                        displayedErrors.push(error);
                    }
                });

                if (data.errors && data.errors.length > 0) {
                    data.errors.forEach(function (error) {
                        if (!displayedErrors.includes(error)) {
                            displayedErrors.push(error);
                        }

                        if (
                            error ===
                            "This email address is already registered."
                        ) {
                            markFieldError("email");
                        }
                    });
                }

                if (displayedErrors.length > 0) {
                    displayedErrors.forEach(function (error) {
                        showToast(error, "error");
                    });

                    return;
                }

                if (!data.success) {
                    showToast(data.message, "error");
                    return;
                }

                showToast(data.message, "success");

                studentForm.reset();
                age.value = "";

                clearAllFieldErrors();

                loadStudents();
            })
            .catch(function () {
                showToast(
                    "Something went wrong while saving the student.",
                    "error"
                );
            });
    });

    // Load the student list from the database.
    function loadStudents() {
        fetch("get students.php")
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                const tableBody =
                    document.getElementById("studentsTableBody");

                tableBody.innerHTML = "";

                data.forEach(function (student) {
                    const row = document.createElement("tr");

                    const values = [
                        student.name,
                        student.gender,
                        student.standard,
                        student.date_of_birth,
                        student.age,
                        student.father_name,
                        student.father_mobile,
                        student.email
                    ];

                    values.forEach(function (value) {
                        const cell = document.createElement("td");
                        cell.textContent = value || "";
                        row.appendChild(cell);
                    });

                    tableBody.appendChild(row);
                });
            })
            .catch(function () {
                showToast("Unable to load students.", "error");
            });
    }

    function markFieldError(fieldId) {
        const field = document.getElementById(fieldId);

        if (field) {
            field.classList.add("danger");
        }
    }

    function clearFieldError(field) {
        field.classList.remove("danger");
    }

    function clearAllFieldErrors() {
        const fields = studentForm.querySelectorAll(
            "input.danger, select.danger"
        );

        fields.forEach(function (field) {
            field.classList.remove("danger");
        });
    }

    // Show success or error messages.
    function showToast(message, type) {
        const toast = document.createElement("div");

        toast.className = "toast " + type;

        const messageElement = document.createElement("span");
        messageElement.textContent = message;

        const closeButton = document.createElement("button");

        closeButton.className = "toast-close";
        closeButton.type = "button";
        closeButton.innerHTML = "&times;";

        closeButton.addEventListener("click", function () {
            toast.remove();
        });

        toast.appendChild(messageElement);
        toast.appendChild(closeButton);

        toastContainer.appendChild(toast);

        setTimeout(function () {
            if (toast.parentNode) {
                toast.remove();
            }
        }, 5000);
    }

    loadStudents();
});

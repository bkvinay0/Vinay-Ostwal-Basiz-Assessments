<?php
require_once "../layout/header.php";
?>

<h1>Student Details</h1>

<div class="form-container">

    <form id="studentForm">

        <div class="form-group">
            <label for="name">Name *</label>
            <input type="text" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select id="gender" name="gender">
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="standard">Standard *</label>
            <input type="text" id="standard" name="standard">
        </div>

        <div class="form-group">
            <label for="dateOfBirth">Date of Birth *</label>
            <input type="date" id="dateOfBirth" name="dateOfBirth">
        </div>

        <div class="form-group">
            <label for="age">Age *</label>
            <input type="number" id="age" name="age" readonly>
        </div>

        <div class="form-group">
            <label for="fatherName">Father Name</label>
            <input type="text" id="fatherName" name="fatherName">
        </div>

        <div class="form-group">
            <label for="fatherMobile">Father Mobile Number *</label>
            <input
                type="text"
                id="fatherMobile"
                name="fatherMobile"
                maxlength="10"
            >
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email">
        </div>

        <button type="submit">Add Student</button>

    </form>

</div>

<h2>Students List</h2>

<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Gender</th>
            <th>Standard</th>
            <th>Date of Birth</th>
            <th>Age</th>
            <th>Father Name</th>
            <th>Father Mobile</th>
            <th>Email</th>
        </tr>
    </thead>

    <tbody id="studentsTableBody"></tbody>
</table>

<div id="toastContainer" class="toast-container"></div>

<style>

    h1 {
        margin-bottom: 25px;
    }

    .form-container {
        max-width: 700px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
    }

    input,
    select {
        width: 100%;
        padding: 9px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input.danger,
    select.danger {
        border: 2px solid #dc3545;
        outline: none;
    }

    button {
        padding: 10px 20px;
        cursor: pointer;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 35px;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        z-index: 9999;
    }

    .toast {
        min-width: 300px;
        max-width: 400px;
        padding: 14px 40px 14px 16px;
        border-radius: 5px;
        color: #ffffff;
        position: relative;
        box-sizing: border-box;
    }

    .toast.success {
        background-color: #28a745;
    }

    .toast.error {
        background-color: #dc3545;
    }

    .toast-close {
        position: absolute;
        top: 8px;
        right: 10px;
        border: none;
        background: transparent;
        color: #ffffff;
        font-size: 20px;
        line-height: 1;
        padding: 0;
        cursor: pointer;
    }

</style>

<script src="script.js"></script>

</main>
</div>

</body>
</html>
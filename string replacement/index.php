<?php

$template = "Hello @Name@, your email is @email@ and your mobile number is @mobile@. You are working as @designation@.";

$name = "";
$email = "";
$mobile = "";
$designation = "";
$result = "";

// Get the values entered by the user.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $mobile = trim($_POST["mobile"] ?? "");
    $designation = trim($_POST["designation"] ?? "");

    // Replace the placeholders with the entered values.
$result = str_replace(
        [
            "@Name@",
            "@email@",
            "@mobile@",
            "@designation@"
        ],
        [
            $name,
            $email,
            $mobile,
            $designation
        ],
        $template
    );
}

require_once "../layout/header.php";
?>

<h1>Task 3 - String Replacement</h1>

<div class="replacement-container">

    <form method="POST">

        <div class="form-group">
            <label for="name">Name</label>

            <input
                type="text"
                id="name"
                name="name"
                value="<?php echo htmlspecialchars($name); ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                value="<?php echo htmlspecialchars($email); ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="mobile">Mobile</label>

            <input
                type="text"
                id="mobile"
                name="mobile"
                value="<?php echo htmlspecialchars($mobile); ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="designation">Designation</label>

            <input
                type="text"
                id="designation"
                name="designation"
                value="<?php echo htmlspecialchars($designation); ?>"
                required
            >
        </div>

        <button type="submit">
            Replace Values
        </button>

        <br><br>

    </form>

    <?php if ($result !== ""): ?>

        <div class="result-box">

            <h3>Result</h3>

            <p>
                <?php echo htmlspecialchars($result); ?>
            </p>

        </div>

    <?php endif; ?>

</div>

<style>

    h1 {
        margin-bottom: 25px;
    }

    .replacement-container {
        max-width: 800px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 9px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        background-color: #1f2937;
        color: #ffffff;
        cursor: pointer;
    }

    .result-box {
        padding: 18px;
        border: 1px solid #ddd;
        border-radius: 6px;
        background-color: #ffffff;
    }

    .result-box h3 {
        margin-top: 0;
    }

    .result-box p {
        line-height: 1.6;
        word-break: break-word;
    }

</style>

</main>
</div>

</body>
</html>
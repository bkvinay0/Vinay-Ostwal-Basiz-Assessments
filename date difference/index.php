<?php

$startDate = "";
$endDate = "";
$numberOfDays = "";
$numberInWords = "";
$error = "";

// Convert the number of days into words.
function numberToWords($number)
{
    $ones = [
        "",
        "one",
        "two",
        "three",
        "four",
        "five",
        "six",
        "seven",
        "eight",
        "nine",
        "ten",
        "eleven",
        "twelve",
        "thirteen",
        "fourteen",
        "fifteen",
        "sixteen",
        "seventeen",
        "eighteen",
        "nineteen"
    ];

    $tens = [
        "",
        "",
        "twenty",
        "thirty",
        "forty",
        "fifty",
        "sixty",
        "seventy",
        "eighty",
        "ninety"
    ];

    if ($number === 0) {
        return "zero";
    }

    if ($number < 20) {
        return $ones[$number];
    }

    if ($number < 100) {
        return $tens[intdiv($number, 10)] .
            ($number % 10 !== 0
                ? " " . $ones[$number % 10]
                : "");
    }

    if ($number < 1000) {
        return $ones[intdiv($number, 100)] .
            " hundred" .
            ($number % 100 !== 0
                ? " " . numberToWords($number % 100)
                : "");
    }

    if ($number < 1000000) {
        return numberToWords(intdiv($number, 1000)) .
            " thousand" .
            ($number % 1000 !== 0
                ? " " . numberToWords($number % 1000)
                : "");
    }

    return (string) $number;
}

// Get the dates entered by the user.
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $startDate = $_POST["startDate"] ?? "";
    $endDate = $_POST["endDate"] ?? "";

    // Checking date entered and the end date is later.
    if ($startDate === "" || $endDate === "") {

        $error = "Both dates are required.";

    } elseif ($endDate <= $startDate) {

        $error = "To Date must be after From Date.";

    } else {

        $firstDate = new DateTime($startDate);
        $secondDate = new DateTime($endDate);

        $difference = $firstDate->diff($secondDate);

        $numberOfDays = $difference->days;

        // Show the number of days in words.
        $numberInWords = numberToWords($numberOfDays) . " Days";
    }
}

require_once "../layout/header.php";
?>

<h1>Date Difference</h1>

<div class="date-container">

    <form method="POST" id="dateForm">

        <div class="form-group">
            <label for="startDate">From Date</label>

            <input
                type="date"
                id="startDate"
                name="startDate"
                value="<?php echo htmlspecialchars($startDate); ?>"
                class="<?php echo $error !== "" ? "danger" : ""; ?>"
                required
            >
        </div>

        <div class="form-group">
            <label for="endDate">To Date</label>

            <input
                type="date"
                id="endDate"
                name="endDate"
                value="<?php echo htmlspecialchars($endDate); ?>"
                class="<?php echo $error !== "" ? "danger" : ""; ?>"
                required
            >
        </div>

        <button type="submit">
            Calculate
        </button>

        <br><br>

    </form>

    <?php if ($numberOfDays !== ""): ?>

        <div class="result-box">

            <h3>Result</h3>

            <p>
                Number of Days:
                <strong>
                    <?php echo $numberOfDays; ?>
                </strong>
            </p>

            <p>
                In Words:
                <strong>
                    <?php echo htmlspecialchars($numberInWords); ?>
                </strong>
            </p>

        </div>

    <?php endif; ?>

</div>

<?php if ($error !== ""): ?>

    <div id="toastContainer" class="toast-container"></div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const toastContainer =
                document.getElementById("toastContainer");

            const toast = document.createElement("div");

            toast.className = "toast error";

            const message = document.createElement("span");

            message.textContent =
                <?php echo json_encode($error); ?>;

            const closeButton =
                document.createElement("button");

            closeButton.className = "toast-close";
            closeButton.type = "button";
            closeButton.innerHTML = "&times;";

            closeButton.addEventListener("click", function () {
                toast.remove();
            });

            toast.appendChild(message);
            toast.appendChild(closeButton);

            toastContainer.appendChild(toast);

            setTimeout(function () {
                if (toast.parentNode) {
                    toast.remove();
                }
            }, 5000);
        });
    </script>

<?php endif; ?>

<style>

    h1 {
        margin-bottom: 25px;
    }

    .date-container {
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

    input {
        width: 100%;
        padding: 9px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input.danger {
        border: 2px solid #dc3545;
        outline: none;
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
    }

    .toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
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

</main>
</div>

</body>
</html>
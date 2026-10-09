<?php

$triplet = [];
$result = null;
$error = "";

$arrayInput = "";
$valueInput = "";

// Check the entered array and target value.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $arrayInput = trim($_POST["array"] ?? "");
    $valueInput = trim($_POST["value"] ?? "");

    if ($arrayInput === "" || $valueInput === "") {
        $error = "Please enter the array and target value.";
    } elseif (!is_numeric($valueInput)) {
        $error = "Please enter a valid target value.";
    } else {
        $numbers = explode(",", $arrayInput);

        foreach ($numbers as $number) {
            if (trim($number) === "" || !is_numeric(trim($number))) {
                $error = "Please enter valid comma-separated numbers.";
                break;
            }
        }

        if ($error === "") {
            $a = array_map("intval", $numbers);
            $val = (int) $valueInput;
            $count = count($a);

            // Find three numbers whose sum matches the target
            for ($i = 0; $i < $count - 2; $i++) {
                for ($j = $i + 1; $j < $count - 1; $j++) {
                    for ($k = $j + 1; $k < $count; $k++) {
                        if ($a[$i] + $a[$j] + $a[$k] === $val) {
                            $triplet = [$a[$i], $a[$j], $a[$k]];
                            break 3;
                        }
                    }
                }
            }

            // Check whether a matching triplet was found.
            $result = !empty($triplet);
        }
    }
}

require_once "../layout/header.php";
?>

<h1>Triplet Sum</h1>

<form method="POST">
    <div class="form-group">
        <label for="array">Array (comma-separated numbers)</label>
        <input
            type="text"
            id="array"
            name="array"
            value="<?php echo htmlspecialchars($arrayInput, ENT_QUOTES, "UTF-8"); ?>"
            placeholder="Enter numbers separated by commas"
            required
        >
    </div>

    <div class="form-group">
        <label for="value">Target Value</label>
        <input
            type="number"
            id="value"
            name="value"
            value="<?php echo htmlspecialchars($valueInput, ENT_QUOTES, "UTF-8"); ?>"
            placeholder="Enter target value"
            required
        >
    </div>

    <button type="submit">Find Triplet</button>
</form>

<?php if ($error !== ""): ?>
    <p style="color: red;">
        <?php echo htmlspecialchars($error, ENT_QUOTES, "UTF-8"); ?>
    </p>
<?php elseif ($result !== null): ?>
    <h3>Result</h3>

    <?php if ($result): ?>
        <p>Triplet: {<?php echo implode(", ", $triplet); ?>}</p>
        <p>Result: true</p>
    <?php else: ?>
        <p>Result: false</p>
    <?php endif; ?>
<?php endif; ?>

<style>
    h1 {
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 15px;
        max-width: 600px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        background-color: #1f2937;
        color: white;
        cursor: pointer;
    }
</style>

</main>
</div>
</body>
</html>
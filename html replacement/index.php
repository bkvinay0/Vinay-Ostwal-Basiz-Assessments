<?php

$htmlContent = '<p align="justify" style="orphans: 0; widows: 0; margin-left: 0.39cm; margin-bottom: 0cm; border: none; padding: 0cm"><b>PARTY</b>2NAME<i>, </i>a company incorporated under the laws of ROC2LAW having its Registered Office at P1OFFICEADD. which expression, shall unless it be repugnant to the context or meaning thereof, mean and include its successors and assigns (hereinafter referred to as ‘‘ Service Provider’) of the ONE PART</p>';

$findName = "PARTY2NAME";
$replaceName = "Abc india pvt. Ltd.";

$findAddress = "P1OFFICEADD.";
$replaceAddress = "Mount Road,chennai-60014.";

$result = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $htmlContent = $_POST["htmlContent"] ?? "";
    $findName = $_POST["findName"] ?? "";
    $replaceName = $_POST["replaceName"] ?? "";
    $findAddress = $_POST["findAddress"] ?? "";
    $replaceAddress = $_POST["replaceAddress"] ?? "";

    // Replace the company name and address in the HTML. 
    $htmlContent = str_replace(
        ["<b>PARTY</b>2NAME", $findName],
        [$replaceName, $replaceName],
        $htmlContent
    );

    // Replace the address with the entered value.
    $htmlContent = str_replace(
        $findAddress,
        $replaceAddress,
        $htmlContent
    );

    // Show the result after replacing the text.
    $result = $htmlContent;
}

require_once "../layout/header.php";
?>

<h1>HTML Find & Replace</h1>

<form method="POST">

    <div class="form-group">
        <label for="htmlContent">HTML Content</label>
        <textarea id="htmlContent" name="htmlContent" rows="8" required><?php
            echo htmlspecialchars($htmlContent, ENT_QUOTES, "UTF-8");
        ?></textarea>
    </div>

    <div class="form-group">
        <label for="findName">Text to Find</label>
        <input type="text" id="findName" name="findName"
               value="<?php echo htmlspecialchars($findName, ENT_QUOTES, "UTF-8"); ?>" required>
    </div>

    <div class="form-group">
        <label for="replaceName">Text to Replace</label>
        <input type="text" id="replaceName" name="replaceName"
               value="<?php echo htmlspecialchars($replaceName, ENT_QUOTES, "UTF-8"); ?>" required>
    </div>

    <div class="form-group">
        <label for="findAddress">Text to Find</label>
        <input type="text" id="findAddress" name="findAddress"
               value="<?php echo htmlspecialchars($findAddress, ENT_QUOTES, "UTF-8"); ?>" required>
    </div>

    <div class="form-group">
        <label for="replaceAddress">Text to Replace</label>
        <input type="text" id="replaceAddress" name="replaceAddress"
               value="<?php echo htmlspecialchars($replaceAddress, ENT_QUOTES, "UTF-8"); ?>" required>
    </div>

    <button type="submit">Find & Replace</button>

</form>

<?php if ($result !== ""): ?>
    <br>

    <h3>Result</h3>

    <pre><?php echo htmlspecialchars($result, ENT_QUOTES, "UTF-8"); ?></pre>
<?php endif; ?>

<style>
    h1 {
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 15px;
        max-width: 900px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
    }

    input,
    textarea {
        width: 100%;
        padding: 10px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-family: Arial, sans-serif;
    }

    textarea {
        resize: vertical;
    }

    button {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        background-color: #1f2937;
        color: white;
        cursor: pointer;
    }

    pre {
        max-width: 900px;
        padding: 15px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 4px;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
    }
</style>

</main>
</div>

</body>
</html>

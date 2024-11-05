<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loop Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            text-align: center; /* Center text for the heading */
        }
        h1 {
            background-color:#31b0d5;
            text-align: center;
            color: white;           
            font-weight: bold;      
            padding: 10px;
            margin: 20px;         
            text-shadow: #f8f8f8; 
            border-radius: 50px;     
            margin-bottom: 20px;    
        }
        .container {
            width: 42%;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            display: inline-block; /* Keep containers inline */
            vertical-align: top;   /* Align containers to the top */
        }
        h3 {
            text-align: center;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"], .refresh {
            background-color: #5bc0de;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover, .refresh:hover {
            background-color: #31b0d5;
        }
        .output {
            background-color: white;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            min-height: 200px;
            margin-top: 10px;
            text-align: center;
            overflow-y: auto;
        }
    </style>
</head>
<body>

    <h1>Play with Counting Application</h1>

    <div class="container">
        <h3>Count Up</h3>
        <form method="post" action="">
            <input type="text" name="counter" placeholder="Enter a number" required>
            <input type="submit" value="Count">
        </form>
        <div class="output">
            <?php
            session_start();
            // Display count up output
            if (isset($_SESSION["count_output"]) && $_SESSION["count_output"] !== "") {
                echo $_SESSION["count_output"];
            }
            ?>
        </div>
        <form method="post" action="">
            <input type="submit" class="refresh" name="refresh_count_up" value="Refresh Count Up">
        </form>
    </div>

    <div class="container">
        <h3>Count Down</h3>
        <form method="post" action="">
            <input type="text" name="counterdown" placeholder="Enter a number" required>
            <input type="submit" value="Count Down">
        </form>
        <div class="output">
            <?php
            // Display count down output
            if (isset($_SESSION["count_down_output"]) && $_SESSION["count_down_output"] !== "") {
                echo $_SESSION["count_down_output"];
            }
            ?>
        </div>
        <form method="post" action="">
            <input type="submit" class="refresh" name="refresh_count_down" value="Refresh Count Down">
        </form>
    </div>

    <?php
    // Handle form submissions
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process counting up
        if (isset($_POST["counter"]) && is_numeric($_POST["counter"])) {
            $counter = intval($_POST["counter"]);
            $_SESSION["count_output"] = ""; // Clear previous output
            for ($k = 0; $k <= $counter; $k++) {
                $_SESSION["count_output"] .= $k . "<br>";
            }

            // Redirect to avoid needing to click again
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

        // Process counting down
        if (isset($_POST["counterdown"]) && is_numeric($_POST["counterdown"])) {
            $counterdown = intval($_POST["counterdown"]);
            $_SESSION["count_down_output"] = ""; // Clear previous output
            if ($counterdown > 0) {
                for ($i = $counterdown; $i > 0; $i--) {
                    $_SESSION["count_down_output"] .= $i . "<br>";
                }
            } else {
                $_SESSION["count_down_output"] = "Please enter a positive number to count down.";
            }

            // Redirect to avoid needing to click again
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

        // Handling refresh requests
        if (isset($_POST["refresh_count_up"])) {
            // Clear output for Count Up
            $_SESSION["count_output"] = "";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }

        if (isset($_POST["refresh_count_down"])) {
            // Clear output for Count Down
            $_SESSION["count_down_output"] = "";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
    ?>

</body>
</html>
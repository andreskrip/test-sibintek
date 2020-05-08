<?php
require __DIR__ . '/functions.php';
?>
<!doctype html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/styles/default.min.css">

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <title>Test-Sibintek</title>
    <style>
        body {
            height: 100vh;
            background-color: aliceblue;
        }

        span {
            margin-right: 5px;
        }

        pre {
            background-color: #ffffff;
            padding-left: 15px;
        }

        .view {
            width: 40vw;
        }

        .code {
            width: 60vw;
        }

        .view {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .header, .result {
            margin-bottom: 15px;
            font-family: monospace;
            font-size: 24px;
        }

        form {
            text-align: center;
        }

        input[type=submit] {
            margin-top: 5px;
            padding: 10px 20px;
            font-size: 18px;
        }

        .add_field_button {
            margin-bottom: 5px;
        }

        .interval {
            display: table;
        }
    </style>
</head>
<body style="display: flex">
<div class="view">
    <div class="header">
        Type interval values
    </div>
    <form method="post">
        <div class="input_fields_wrap">
            <button class="add_field_button">Add interval</button>
            <div class="interval">
                <input type="number" name="interval1[0]" placeholder="Start point">
                <input type="number" name="interval1[1]" placeholder="End point">
            </div>
        </div>
        <input type="submit" value="Count">
    </form>
    <p>
        <?php
        if (!empty($_POST)) {
            echo 'Intervals: ';
            foreach ($_POST as $item) {
                echo '[' . $item[0] . ',' . $item[1] . '] ';
            }
        }
        ?>
    </p>
    <p class="result">Sum of the interval lengths: <?= $result ?></p>
</div>
<div class="code" style="overflow: scroll; overflow-x: hidden">
    <div class="header" style="text-align: center">
        The code:
    </div>
    <pre>
        <code>
<?= htmlspecialchars(file_get_contents('functions.php')) ?>
        </code>
    </pre>
</div>

<script>
    $(document).ready(function () {
        var max_fields = 9; //maximum input boxes allowed
        var wrapper = $(".input_fields_wrap"); //Fields wrapper
        var add_button = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(wrapper).append('' +
                    '<div class="interval"> ' +
                    '<input type="number" name="interval' + x + '[0]" placeholder="Начальная точка"> ' +
                    '<input type="number" name="interval' + x + '[1]" placeholder="Конечная точка"> ' +
                    '<a href="#" class="remove_field">✖</a> ' +
                    '</div>'); // add input boxes.
            }
        });

        $(wrapper).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.18.1/highlight.min.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
</body>
</html>
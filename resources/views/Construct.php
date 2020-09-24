<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Construtor API</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>

<body>
    <table>
        <tr>
            <td>
                Model
            </td>
            <td>
                Controller
            </td>
            <td>
                Router
            </td>
        </tr>
        <?php

        foreach ($data as $key => $value) {
            echo "
                <tr>
                    <td>
                    $key
                    </td>
                    <td>
                        <input type='checkbox'>
                    </td>
                    <td>
                        <input type='checkbox'>
                    </td>
                </tr>
            ";
        }
        ?>
    </table>
</body>

</html>

<style>
    table{
        border: 2px;
        border-color: forestgreen;
    }
</style>
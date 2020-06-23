<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Интеграция с AmoCRM</title>

    <style>
        form {
            margin: 0 auto;
            width: 350px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: stretch;
        }
    </style>

</head>
<body>
    <form action="<?= $config->URL_ROOT ?>" method="post">
        <label for="AUTHORIZATION_CODE">Код авторизации (действителен 20 минут):</label>
        <input type="text" name="AUTHORIZATION_CODE">

        <button type="submit" name="submit" value="SUBMIT">Отправить</button>
    </form>
</body>
</html>
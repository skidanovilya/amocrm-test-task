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
    <form action="<?= $config->URL_ROOT . $_SERVER["REQUEST_URI"] ?>" method="post">
        <label for="AUTHORIZATION_CODE">Код авторизации (действителен 20 минут):</label>
        <input type="text" name="AUTHORIZATION_CODE">

        <label for="name">Название сделки:</label>
        <input type="text" name="name">

        <label for="Company">Company:</label>
        <input type="text" name="Company">

        <label for="Oferta">Oferta:</label>
        <input type="checkbox" name="Oferta">

        <label for="Имя-контакта">Имя контакта:</label>
        <input type="text" name="Имя-контакта">

        <label for="Телефон">Телефон:</label>
        <input type="tel" name="Телефон">

        <label for="MailAgree">Согласен ли пользователь получать наши письма:</label>
        <input type="checkbox" name="MailAgree">

        <label for="FormID">Идентификатор формы, чтобы понимать источник поступления сделки:</label>
        <input type="text" name="FormID">

        <button type="submit" name="submit" value="SUBMIT">Отправить</button>
    </form>
</body>
</html>
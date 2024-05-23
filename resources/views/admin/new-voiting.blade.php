<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>newVoiting</title>
</head>
<body>
    <form action="#" name="newvoiting" method="post">
        @csrf
        <label for="voiting-date">Дата окончания голосования:</label>
        <input type="date" name="voiting-date" id="voiting-date">
        <br><br>
        <input type="submit" value="Отправить">
    </form>
    <br>
    <a href="/admin">Назад</a>
</body>
</html>
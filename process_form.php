<?php
// Проверка, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Данные для подключения к базе данных
    $host = 'localhost'; // Хост базы данных
    $username = 'user'; // Имя пользователя базы данных
    $password = 'userpass'; // Пароль базы данных
    $database = 'college'; // Имя базы данных

    // Подключение к базе данных
    $connection = mysqli_connect($host, $username, $password, $database);

    // Проверка на ошибку подключения
    if (!$connection) {
        die("Ошибка подключения: " . mysqli_connect_error());
    }

    // Получение данных из формы
    $fId = $_POST["fId"];
    $fTitle = $_POST["fTitle"];
    $fDean = $_POST["fDean"];

    $gId = $_POST["gId"];
    $gTitle = $_POST["gTitle"];

    $studentId = $_POST["studentId"];
    $studentName = $_POST["studentName"];
    $studentSurname = $_POST["studentSurname"];

    // Подготовка SQL-запроса для добавления записи
    $sql = "INSERT INTO faculty (fId, fTitle, fDean) VALUES ('$fId', '$fTitle', '$fDean'); INSERT INTO class (gId, gTitle) VALUES ('$gId', '$gTitle'); INSERT INTO students (studentId, studentName, studentSurname) VALUES ('$studentId', '$studentName', '$studentSurname');";    
    // Выполнение запроса
    if (mysqli_multi_query($connection, $sql)) {
	    echo "<p>Новая запись успешно добавлена в таблицу.</p>";
	    echo '<a href="view_faculty.php">View faculty records</a>';
	    echo '<a href="view_class.php">View classes records</a>';
	    echo '<a href="view_students.php">View students records</a>"';

    } else {
        echo "Ошибка при добавлении записи: " . mysqli_error($connection);
    }

    // Закрытие соединения с базой данных
    mysqli_close($connection);
} else {
    // Если форма не была отправлена, перенаправьте пользователя на страницу с формой
    header("Location: index2.html");
    exit;
}
?>

<?php
if (!isset($_GET['page'])) {
	$page = 1;
} else {
	$page = $_GET['page'];
}
require 'connect.php';

$numberOfResults = mysqli_num_rows(mysqli_query($dbConnect, "SELECT * FROM `customers`"));
$resultsPerPage = 5;
$numberOfPages = ceil($numberOfResults / $resultsPerPage);
$thisPageFirstResult = ($page - 1) * $resultsPerPage;

$customresTable = mysqli_query($dbConnect, "SELECT * FROM `customers` LIMIT " . $thisPageFirstResult . ',' . $resultsPerPage);
while (
	$customresList = mysqli_fetch_array($customresTable, MYSQLI_ASSOC)
) {
	$users[] = $customresList;
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/animared_bg.css">
	<title>Таблица пользователей</title>
</head>
<body style="background-color: black">
	<div class="container">
		<h1>Список пользователей</h1>
		<ul class="pagination pagination-sm justify-content-center">
			
		<?php
			for ($page = 1; $page <= $numberOfPages; $page++) {
				echo('<li class="page-item">
				<a class="page-link" href="../php/table.php?page=' . $page . '">' . $page . '</a>
				</li>');
			}
		?>
		</ul>

		<table class="table">
			<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Имя</th>
				<th scope="col">Email</th>
				<th scope="col">Ответ</th>
				<th scope="col">Цвет</th>
				<th scope="col">Сообщение</th>
				<th scope="col">Путь к файлу</th>

			</tr>
			</thead>
			<tbody>
<?php foreach ($users as $user): ?>
			<tr>
				<th scope="row">
					<?php echo $user['id']; ?>
				</th>
				<td>
					<?php echo $user['customer_name']; ?>

				</td>
				<td>
					<?php echo $user['customer_email']; ?>
				</td>
				<td>
					<?php
if ($user['main_answer'] === '2') {
	echo ('Верный');
} else {
	echo ('Неверный');
}
?>

				</td>
				<td>
					<?php echo $user['peel_color']; ?>

				</td>
				<td>
					<?php echo $user['customer_message'];?>
				</td>
				<td>
					<?php echo $user['file_path'];?>
				</td>

			</tr>
<?php endforeach;?>
<php endfor;?>
			</tbody>
		</table>
		<div class="mb-3 btn-box">
			<a href="reg_back.php" class="btn btn-outline-primary">К форме регистрации</a>
			
		</div>

	</div>
	<div class='light x1'></div>
	<div class='light x2'></div>
	<div class='light x3'></div>
	<div class='light x4'></div>
	<div class='light x5'></div>
	<div class='light x6'></div>
	<div class='light x7'></div>
	<div class='light x8'></div>
	<div class='light x9'></div>

</body>
</html>
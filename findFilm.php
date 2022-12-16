<!DOCTYPE html>
<html>
 
<head>
    <title>Insert Page page</title>
</head>
 
<body>
    <center>
        <?php
function db_connect() {

static $connection;

if (!isset($connection)){
$config= parse_ini_file('../../hw_config.ini');

$connection= mysqli_connect(
 $config['host'],
 $config['username'],
 $config['password'],
 $config['dbname']
);
if ($connection === false) {
echo 'При попытке подключения к БД водникла ошибка, обратитесь к администратору';
return false;
}
}
return $connection;
}
        
$film_name =  $_REQUEST['film_name'];
$sql = "select name as film_name, author from film where name = '$film_name'";
$connection=db_connect();
$result = mysqli_query($connection, $sql);
 
if($result){
	echo "<table>";
	echo "<thead>
			<tr>
            <th>Наименование фильма</th>
			<th>Автор</th>
        </tr>
    </thead>";

	while($row = mysqli_fetch_assoc($result))
		{
			echo "<tr><td>" . 
			htmlspecialchars($row['film_name']) . 
			"</td><td>" . 
			htmlspecialchars($row['author']) .  
			"</td></tr>";
		}
		}
else { echo "Фильмы не найдены!"; }
?>
    </center>
</body>
 
</html>
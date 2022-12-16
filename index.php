<!DOCTYPE html>
<html lang="en">
<head>
<title>Моя лабораторная работа</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="laba5.css">
 <meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>
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
?>

<!--ОСНОВНОЙ КОНТЕНТ--> 

  <table 
  font color="white"
  style="width:100%;  border-radius:5px;">  
    <tr>	
      <td 
	  rowspan="2" 
	  style="width:80%"> 
	   <h2>О сайте</h2>	 
<div class="filters">
    <div class="filter-group">
        <div class="button-group" data-filter-group="color">
            <button class="filter-button is-checked" data-filter="">Все</button>
            <?php
$connection=db_connect();
if ($connection !== false){
$query= 'SELECT * FROM genre;';
$result = mysqli_query ($connection, $query);

if ($result){
while ($row = mysqli_fetch_assoc($result)){
echo '<a href="?genreid='. $row ['genre_id'].'"><button class="filter-button">'. $row['genre_name']. '</a></button>';
}
}
}

$query = "SELECT f.name as film_name, f.author, g.genre_name, c.name as country_name FROM film f
join genre g on f.genre_id = g.genre_id
join country c on c.country_id = f.produce_country_id";
$result = mysqli_query($connection, $query);

echo "<table>";
echo "<thead>
        <tr>
            <th>Наименование фильма</th>
			<th>Автор</th>
			<th>Жанр</th>
			<th>Страна</th>
        </tr>
    </thead>";

while($row = mysqli_fetch_assoc($result)){
	echo "<tr><td>" . htmlspecialchars($row['film_name']) . "</td><td>" . htmlspecialchars($row['author']) .  "</td><td>" . htmlspecialchars($row['genre_name']) .  "</td><td>" . htmlspecialchars($row['country_name']) . "</td></tr>";
}

echo "</table>"; 

echo "<br>

Выбор редакции сегодня - Российский фильмы:
";

$query = "SELECT distinct f.name from film f join country c on c.country_id = f.produce_country_id and c.country_id = 1 order by f.name;";
$result2 = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($result2)){
	echo "<b>" . htmlspecialchars($row['name'] . "") . " </b>";
}

echo "<br>";
echo "<br>";
$query = "SELECT max(birthdate) as birthdate, d.director_full_name as name from director d" ;
$result3 = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($result3)){
	echo "Интересный факт, самый молодой режиссер это - " . htmlspecialchars($row['name']) . " его день рождения - " . htmlspecialchars($row['birthdate']);}

echo "<br>";
$query = "select count(*) as cnt from test.film" ;
$result3 = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($result3)){
	echo "Всего на нашем сайте представлено: " . htmlspecialchars($row['cnt']) . " фильмов!";}
?>
<div>
	<form action="findFilm.php" method="post">
		<p>
			<label for="filmName">Поиск по наименованию фильма:</label>
			<input type="text" name="film_name" id="filmName">
		</p>
	<input type="submit" value="Submit">
	</form>
</div>    

<p>
		Тут можно ознакомиться с кинопремьерами и старой доброй классикой. Выбрать то,  <br> что тебе по душе и насладиться просмотром!</p>
<div>
<img id='photo'src='https://phonoteka.org/uploads/posts/2021-06/1622844709_21-phonoteka_org-p-tekstura-plenki-krasivo-26.jpg'>
  <h6> АВАТАР 1 </h6>
 <p>По сюжету ресурсодобывающая корпорация угрожает существованию местного племени человекоподобных разумных существ — на’ви. Название фильма — название генетически спроектированных тел, гибридов на’ви и людей, используемых командой исследователей для изучения планеты и взаимодействия с туземными жителями Пандоры... </p> 
      </div>
<div>
<img id='photo'src='https://phonoteka.org/uploads/posts/2021-06/1622844709_21-phonoteka_org-p-tekstura-plenki-krasivo-26.jpg'>
<h6> АВАТАР 2 </h6>
 <p>По сюжету ресурсодобывающая корпорация угрожает существованию местного племени человекоподобных разумных существ — на’ви. Название фильма — название генетически спроектированных тел, гибридов на’ви и людей, используемых командой исследователей для изучения планеты и взаимодействия с туземными жителями Пандоры... </p> 
      </div>


            


      </td>
 
<!--САЙДБАР-->
 
      <td>
         
       <h3> Меню</h3>	   
         <p>		 
		 <a href="">
		 <img src="https://www.clipartmax.com/png/full/323-3235519_thenounproject-book.png">Страница</span></a>
		 </p> 
         <p>
		 <a href="">
		 <img src="https://www.clipartmax.com/png/full/323-3235519_thenounproject-book.png">
		 <span style="margin-left:5px;">Cтраница 1</span;></a>
		 </p> 
         <p>
		 <a href="">
		 <img src="https://www.clipartmax.com/png/full/323-3235519_thenounproject-book.png">
		 <span style="margin-left:5px;">Страница 2</span></a>
		 </p>		 
      </td> 
    </tr>	
    <tr>	
      <td>
       <h3> Дополнительная информация</h3> 
         <p>Текст дополнительной информации</p>		 
      </td>
    </tr>
  </table>
	
<!--ПОДВАЛ-->

  <table 
  
   height="100" 
   cellpadding="10" 
   style="width:100%; border-radius:5px;">   
    <tr>
      <th> 
       <h3>Подвал</h3>	   
      </th> 
    </tr> 
  </table>  
      </td>       
    </tr>  
  </table>
</body>
</html>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>text geo API</title>
</head>
<body>

	<h2>
		OpenStreetMap Nominatim API + IP ipinfo
	</h2>

	<pre>

<?php

$ipAddress = $_SERVER['REMOTE_ADDR'];

// Получение координат по IP через IPinfo.io
$ipinfoUrl = "http://ipinfo.io/{$ipAddress}/json";
$ipinfoResponse = file_get_contents($ipinfoUrl);
$ipinfoData = json_decode($ipinfoResponse, true);
print_r($ipinfoData);
// Если удалось получить координаты
if ($ipinfoData && isset($ipinfoData['loc'])) {
    // Разбиваем координаты на широту и долготу
    list($latitude, $longitude) = explode(",", $ipinfoData['loc']);

    // URL для запроса к Nominatim API
    $nominatimUrl = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$latitude}&lon={$longitude}";

    // Отправка запроса к Nominatim API
    $nominatimResponse = file_get_contents($nominatimUrl);

    // Декодирование JSON-ответа
    $nominatimResult = json_decode($nominatimResponse, true);

    // Вывести страну
    if ($nominatimResult) {
        print_r($nominatimResult);
    } else {
        echo "openstreetmap.org - Страна не определена.";
    }
} else {
    echo "ipinfo.io - Не удалось получить координаты по IP.";
}



// URL сервиса, предоставляющего информацию о местоположении по IP
$serviceUrl = "https://example.com/api/location?ip={$ipAddress}";

// Настройка запроса cURL
$ch = curl_init($serviceUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Выполнение запроса
$response = curl_exec($ch);

// Закрытие cURL сеанса
curl_close($ch);

// Декодирование JSON-ответа
$result = json_decode($response, true);

// Вывести страну
if ($result ) {
   print_r($result);
} else {
    echo "example.com - Страна не определена.";
}
?>

	</pre>

	<hr>

	<h2>
		IP Geolocation API <a href="https://ipinfo.io/products/ip-geolocation-api" target="_blank">ipinfo.io</a>
	</h2>

	<pre>

<?php

	$token = 'b647ec6f49e3c7';
	$ip = $_SERVER['REMOTE_ADDR'];

	$url = "https://ipinfo.io/{$ip}?token={$token}";

	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($ch);

	if (curl_errno($ch)) {
		echo 'Curl error: ' . curl_error($ch);
	} else {
		echo $response;
	}

	curl_close($ch);

?>

	<h3>Язык браузера</h3>
<?php

// Получение языков из заголовка "Accept-Language"
$acceptLanguage = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : '';

// Разбивка строки на языки
$languages = explode(',', $acceptLanguage);

// Получение первого языка (наиболее предпочтительного)
$preferredLanguage = isset($languages[0]) ? $languages[0] : '';

// Вывод предпочтительного языка
echo  $preferredLanguage;
?>

	</pre>
<?php
    $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    $acceptLang = ['fr', 'it', 'en'];
    $lang = in_array($lang, $acceptLang) ? $lang : 'en';
 //   require_once "index_{$lang}.php";


/*
Как автоматически переслать посетителя нужную языковую версию сайта PHP?
// Создаем массив с адресами для каждого языкового кода
    $sites = array(
    "ru" => "http://mysite.com/",
    "en" => "http://en.mysite.com/",
    "es" => "http://es.mysite.com/",
    "fr" => "http://fr.mysite.com/",
);

// получаем язык
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); // вырезаем первые две буквы

// проверяем язык
if (!in_array($lang, array_keys($sites))){
    $lang = 'ru';
}

// перенаправление на субдомен
header('Location: ' . $sites[$lang]);
*/
?>
</body>
</html>
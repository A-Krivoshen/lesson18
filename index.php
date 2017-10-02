<?php

require_once 'src/Address.php';

if (!empty($_GET['find'])) {

    $geo = new \Address;
    $result = $geo->findCoords($_GET['find']);

    foreach ($result as $key => $item) {
        $array[$key]['address'] = $item->getAddress();
        $array[$key]['pos'] = $item->getLatitude() . ' ' . $item->getLongitude();
    }
}

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
    <title>5.1</title>
</head>
<body>
<div class="container">
    <form method="get" class="container">
        <div>
            <div>
                <div>
                  <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">Найти</button>
                  </span>
                    <input type="text" class="form-control" placeholder="Введите адрес..." name="find">
                </div>
            </div>
        </div>
    </form>

    <?php if (!empty($array)): ?>
        <div>
            <?php foreach ($array as $item): ?>
                <a href="<?php echo 'index.php?find=' . urlencode($_GET['find']) . '&result=' . urlencode($item['pos']); ?>"
                   >
                    <h4><?php echo $item['pos'] ?></h4>
                    <p><?php echo $item['address'] ?></p>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

</body>
</html>

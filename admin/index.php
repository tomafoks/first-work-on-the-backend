<?php
require_once "php/class.admin.session.php";
include_once "php/class.admin.panel.php";
$shop = new Admin();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!$shop->addItem()) {
        echo 'Заполните все поля!';
    }
}
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if ($_GET['id'])
        $shop->delItem($_GET['id']);
    elseif ($_GET['delUser'])
        $shop->delUser($_GET['delUser']);
    elseif ($_GET['restoreUser'])
        $shop->restoreUser($_GET['restoreUser']);
    elseif ($_GET['perf'])
        $shop->perfOrder($_GET['perf']);
    elseif ($_GET['cancel'])
        $shop->canselOrder($_GET['cancel']);
    elseif ($_GET['stage'])
        $shop->stageOrder($_GET['stage']);
}
$items = $shop->getItems();
$orders = $shop->getOrders();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <!-- <link rel="stylesheet" href="../templates/moloko/design/colors/_none/styles/styles.css" />
    <link rel="stylesheet" type="text/css" href="../combine/main_without_designba2b.css" /> -->
    <title>Adminka</title>
</head>

<body>
    <form enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        Название товара:<br />
        <input type="text" name="name" /><br />
        Выберите категорию:<br />
        <select name="category">
            <option value="1">Молочные продукты</option>
            <option value="2">Мясные продукты</option>
        </select>
        <br />
        Описание товара:<br />
        <textarea name="description" cols="50" rows="5" value=" "></textarea><br />
        Цена:<br />
        <input type="number" name="price" placeholder="55.90" /><br />
        <br />
        <input type="number" name="quantity" placeholder="количество" /><br />
        <br />
        <input type="file" name="images" alt="">
        <br />
        <input type="submit" value="Добавить!" />
    </form>

    <h3>Продукция:</h3>
    <div class="table">
        <table>
            <tr>
                <th>Название</th>
                <th>Категориa</th>
                <th>Описание товара</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Фото</th>
                <th>Дата</th>
                <th>id</th>
                <th>Удалить</th>
            </tr>
            <?php
            foreach ($items as $key => $value) {
            ?>
                <tr>
                    <?php
                    foreach ($value as $k => $i) {
                        echo "<td>";
                        if ($k == 'img_name') {
                            echo "<img src='/pictures/product/$i' width='100' height='111' alt=''>";
                            continue;
                        }
                        echo $i;
                        echo "</td>";
                    }
                    ?>
                    <td>
                        <button>
                            <a href="index.php?id=<?= $value['id'] ?>">Удалить</a>
                        </button>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <h3>Заказы:</h3>
    <div class="table">
        <table>
            <tr>
                <th>id</th>
                <th>email</th>
                <th>basket</th>
                <th>Дата</th>
                <th>Состояние</th>
            </tr>
            <?php
            foreach ($orders as $key => $value) {
            ?>
                <tr>
                    <?php
                    foreach ($value as $k => $v) {
                        echo "<td>";
                        if ($k == 'basket') {
                            $arr = unserialize(base64_decode($v));
                            print_r($arr);
                            continue;
                        }
                        echo $v;
                        echo "</td>";
                    }
                    ?>
                    <td>
                        <button>
                            <a href="index.php?perf=<?= $value['id'] ?>">Исполнить</a>
                        </button>
                    </td>
                    <td>
                        <button>
                            <a href="index.php?cancel=<?= $value['id'] ?>">Отменить</a>
                        </button>
                    </td>
                    <td>
                        <button>
                            <a href="index.php?stage=<?= $value['id'] ?>">В процессе</a>
                        </button>
                    </td>
                </tr>

            <?php
            }
            ?>
        </table>
    </div>

    <h3>Юзеры:</h3>
    <div class="table">
        <table>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Маил</th>
                <th>Телефон</th>
                <th>Пароль</th>
                <th>Дата</th>
                <th>Удалить</th>
            </tr>
            <?php
            foreach ($shop->getUsers() as $key => $value) {
            ?>
                <tr>
                    <td><?= $value['first_name'] ?></td>
                    <td><?= $value['last_name'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <td><?= $value['phone'] ?></td>
                    <td><?= $value['password'] ?></td>
                    <td><?= $value['datetime'] ?></td>
                    <td><?= $value['status'] ?></td>
                    <td>
                        <button>
                            <a href="index.php?delUser=<?= $value['id'] ?>">Удалить</a>
                        </button>
                        <button>
                            <a href="index.php?restoreUser=<?= $value['id'] ?>">Востановить</a>
                        </button>
                    </td>
                </tr>

            <?php
            }
            ?>
        </table>
    </div>
</body>
<?php
// phpinfo()
?>

</html>
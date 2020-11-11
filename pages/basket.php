<?php
require_once "php/class.basket.php";
$basket = new Basket();
$products = $basket->showProducts();
$count = 0;
$price = 0;
?>
<div class="row">
    <div class="col-xs col-p-v root-staticPage-custom">
        <div class="stretch-container">
            <h1>Ваша корзина</h1>
            <table border="1" cellpadding="5" cellspacing="0" width="100%">
                <tr>
                    <th>id</th>
                    <th>Название</th>
                    <th>описание</th>
                    <th>Колличество на складе</th>
                    <th>Колличество в корзине</th>
                    <th>изменить</th>
                    <th>цена</th>
                    <th>Удалить</th>
                </tr>
                <?php
                if ($products != false) {
                    foreach ($products as $key => $value) {
                        $count += $basket->basket[$value['id']];
                        $price += $value['price'] * $basket->basket[$value['id']];
                ?>
                        <tr>
                            <td><?= $value['id'] ?></td>
                            <td><a href="http://localhost/index.php?id=card&key=<?=$value['id']?>"><?=$value['name']?></a></td>
                            <td><?= $value['description'] ?></td>
                            <td><?= $value['quantity'] ?></td>
                            <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                                <td><input type="number" name="new_price" value="<?= $basket->basket[$value['id']] ?>"></td>
                                <input type="hidden" name="i" value="<?=$value['id']?>">
                                <td><button type="submit">изменить</button></td>
                            </form>
                            <td><?= $value['price'] ?></td>
                            <td><a href="?id=basket&del=<?= $value['id'] ?>"><button>Удалить</button></a></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>

            <p>Всего товаров в корзине на сумму: <?= $price ?> руб.</p>

            <div align="center">
                <a href="?id=order"><button type="button">Заказать!</button></a>
            </div>
        </div>
    </div>
</div>
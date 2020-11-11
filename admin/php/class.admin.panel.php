<?php
class Admin
{
    const DB_NAME = "../db/database.db";
    const DB_ORDERS = "../db/orders.db";
    const DB_USERS = "../db/datauseregistation.db";
    private $_db = null;
    private $_dbOrders = null;
    private $_dbUsers = null;

    //автоматическое создание таблицы коталога для товаров
    function __construct()
    {
        $this->_db = new SQLite3(self::DB_NAME);
        $this->_dbOrders = new SQLite3(self::DB_ORDERS);
        $this->_dbUsers = new SQLite3(self::DB_USERS);

        if (filesize(self::DB_NAME) == 0) {
            try {
                $sql = "CREATE TABLE Shop
                (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name TEXT,
                    category INTEGER,
                    description TEXT,
                    quantity INTEGER,
                    price INTEGER,
                    img_name TEXT,
                    datetime INTEGER
                )";
                if (!$this->_db->exec($sql))
                    throw new Exception("Ошибка в создании базы данных", 1);
            } catch (Exception $e) {
                echo $e->getLine();
                echo "</br>";
                echo $e->getMessage();
            }
        }
    }
    function __destruct()
    {
        $this->_db->close();
        unset($this->_db);
        $this->_dbOrders->close();
        unset($this->_dbOrders);
        $this->_dbUsers->close();
        unset($this->_dbUsers);
    }

    //добавление товара в каталог
    function addItem()
    {
        $this->saveImg();
        $time = time();
        $n = $_POST['name'];
        $c = $_POST['category'];
        $p = $_POST['price'];
        $q = $_POST['quantity'];
        $i = $this->_db->escapeString($_FILES['images']['name']);
        $d = $this->_db->escapeString($_POST['description']);
        if ($n == '' or $p == '' or $q == '')
            return false;
        $sql = "INSERT INTO Shop (
                    name,
                    category,
                    description,
                    quantity,
                    price,
                    img_name,
                    datetime
                ) VALUES (
                    '$n', $c, '$d', $q, $p, '$i' ,$time
                )";
        $this->_db->exec($sql);
        return true;
    }

    //сохранение фото товара
    function saveImg()
    {
        if (is_uploaded_file($_FILES['images']['tmp_name'])) {
            $upload_dir = '../pictures/product';
            $tmp_name = $_FILES['images']['tmp_name'];
            $name = basename($_FILES['images']['name']);
            move_uploaded_file($tmp_name, "$upload_dir/$name");
        }
    }

    //вывести все товары
    function getItems()
    {
        if (filesize(self::DB_NAME) == 0)
            return false;
        $sql = "SELECT
                        name,
                        category,
                        description,
                        quantity,
                        price,
                        img_name,
                        datetime,
                        id
                FROM Shop";
        $result = $this->_db->query($sql);
        if (!$result) return false;
        $arr = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($row['datetime']) {
                $row['datetime'] = date("дата: d.m.Y, время: H:i:s +2", $row['datetime']);
            };
            $arr[] = $row;
        }
        return $arr;
    }

    //удаление товара
    function delItem($id)
    {
        $sql = "DELETE FROM shop
                WHERE shop.id = $id";
        return $this->_db->exec($sql);
    }

    //Показать список ордеров заказов
    function getOrders()
    {
        if (filesize(self::DB_ORDERS) == 0)
            return false;
        $sql = "SELECT *
                FROM Orders";
        $result = $this->_dbOrders->query($sql);
        if (!$result) return false;
        $arr = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            if ($row['datetime']) {
                $row['datetime'] = date("дата: d.m.Y, время: H:i:s +2", $row['datetime']);
            };
            $arr[] = $row;
        }
        return $arr;
    }

    function perfOrder($order)
    {
        $sql = "UPDATE Orders
                SET performed='Исполнено'
                WHERE id = $order";
        return $this->_dbOrders->exec($sql);
    }

    function canselOrder($cancel)
    {
        $sql = "UPDATE Orders
        SET performed='Отменено'
        WHERE id = $cancel";
        return $this->_dbOrders->exec($sql);
    }

    function stageOrder($stage) {
        $sql = "UPDATE Orders
        SET performed='В процессе'
        WHERE id = $stage";
        return $this->_dbOrders->exec($sql);
    }

    //Расшифровывает карзину покупателя
    function unserializeBasket($basket)
    {
        $a = unserialize(base64_decode($basket));
        return $a;
    }

    //показ юзеров
    function getUsers()
    {
        $sql = "SELECT * FROM User";
        $result = $this->_dbUsers->query($sql);
        if (!$result) return false;
        $arr = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $arr[] = $row;
        }
        return $arr;
    }

    //удаление юзера
    function delUser($id)
    {
        $sql = "UPDATE User
        SET status='удален'
        WHERE id = $id";
        return $this->_dbUsers->exec($sql);
    }
    //востановление юзера
    function restoreUser($id)
    {
        $sql = "UPDATE User
        SET status='Действующий'
        WHERE id = $id";
        return $this->_dbUsers->exec($sql);
    }
}

<?php
require_once "php/class.addToBasket.php";

class Basket extends AddToBasket
{
    const DB_NAME = "db/database.db";
    const DB_ORDERS = "db/orders.db";
    private $_db = null;
    private $_dbOrders = null;

    function __construct()
    {
        $this->_db = new SQLite3(self::DB_NAME);
        $this->_dbOrders = new SQLite3(self::DB_ORDERS);
        if (filesize(self::DB_ORDERS) == 0) {
            try {
                $sql = "CREATE TABLE Orders
                (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    email TEXT,
                    basket TEXT,
                    datetime INTEGER,
                    performed TEXT
                )";
                if (!$this->_dbOrders->exec($sql))
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
    }

    function showProducts()
    {
        $this->basketInit();
        $goods = array_keys($this->basket);
        array_shift($goods);
        if (!$goods)
            return false;
        $ids = implode(",", $goods);
        $sql = "SELECT name,
                        quantity,
                        price,
                        description,
                        id 
                FROM Shop 
                WHERE id IN ($ids)";
        $result = $this->_db->query($sql);
        $arr = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $arr[] = $row;
        };
        return $arr;
    }

    function sendBasket($email, $basket)
    {
        $data = time();
        $e = $this->_dbOrders->escapeString($email);
        $sql = "INSERT INTO Orders (email, basket, datetime, performed)
                    VALUES ('$e', '$basket', $data, 'В процессе')";
        $this->_dbOrders->exec($sql);
        return true;
    }

    function swichSend()
    {
        if (isset($_SESSION['email'])) {
            $this->sendBasket($_SESSION['email'], $_COOKIE['basket']);
        } else {
            echo "ERROR";
        }
    }
}

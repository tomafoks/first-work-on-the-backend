<?php
class AddToBasket
{
    public $basket = [];

    function saveBasket()
    {
        $basket = base64_encode(serialize($this->basket));
        setcookie('basket', $basket, 0x7FFFFFFF);
    }

    function basketInit()
    {
        if (!isset($_COOKIE['basket'])) {
            $this->basket = ['orderid' => uniqid()];
            $this->saveBasket();
        } else {
            $this->basket = unserialize(base64_decode($_COOKIE['basket']));
        }
    }

    function dellProducts($id)
    {
        unset($this->basket[$id]);
        $this->saveBasket();
        header("Location: http://localhost/index.php?id=basket");
    }

    function add2Basket($id, $q)
    {
        $this->basket[$id] = $q;
        $this->saveBasket();
    }

    function refrech() {
        header("Location: http://localhost/index.php?id=basket");
    }
}
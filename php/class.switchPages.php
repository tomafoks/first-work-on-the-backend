<?php
class SwitchPages
{
    function switch($id)
    {
        switch ($id) {
            case 'about':
                require_once "pages/about.php";
                break;
            case 'catalog':
                require_once "pages/catalog.php";
                break;
            case 'payment':
                require_once "pages/payment.php";
                break;
            case 'shipping':
                require_once "pages/shipping.php";
                break;
            case 'basket':
                require_once "pages/basket.php";
                break;
            case 'orderform':
                require_once "pages/orderform.php";
                break;
            case 'reg':
                require_once "pages/registration.php";
                break;
            case 'order':
                require_once "pages/orderform.php";
                break;
            case 'card':
                require_once "pages/card.php";
                break;
            default:
                require_once "pages/home.php";
                break;
        }
    }
}

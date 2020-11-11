<?php
require_once "php/class.addToBasket.php";
require_once "php/class.login.user.php";
require_once "php/class.switchPages.php";
require_once "php/class.catalog.php";
require_once "php/class.basket.php";

$basket = new Basket();

$loginUser = new LoginUser();
$add2basket = new AddToBasket();
$switch = new SwitchPages();

if (isset($_SESSION['email'])) {
  //отправка заказа
  $basket->swichSend();
  
  $styleInput = 'none';
  $styleOutput = '';
} else {
  $styleInput = '';
  $styleOutput = 'none';
}

if (isset($_COOKIE['PHPSESSID'])) {
  $add2basket->basketInit();
}

if (isset($_GET['exit'])) {
  $loginUser->logout();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  if (isset($_POST['catalog-id']) and isset($_POST['numberOf'])) {
    $id = $_POST['catalog-id'];
    $q = $_POST['numberOf'];
    if ($q >= 1) {
      $add2basket->add2Basket($id, $q);
    }
  }
}

if (isset($_REQUEST['new_price'])) {
  $add2basket->add2Basket($_REQUEST['i'], $_REQUEST['new_price']);
  $add2basket->refrech();
}

if (isset($_GET['del'])) {
  $add2basket->dellProducts($_GET['del']);
}
?>
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
  <meta charset="utf-8">
  <meta name="format-detection" content="telePhone=no">
  <title>Moloko</title>
  <base />
  <link rel="stylesheet" href="../templates/moloko/design/colors/_none/styles/styles.css" />
  <link rel="stylesheet" type="text/css" href="../combine/main_without_designba2b.css" />
</head>

<body class="cs-t-1 text-floating toolbar-bottom-enabled">
  <div class="stretch-container">
    <header class="site-head">
      <div class="toolbar-top">
        <div class="container container-fluid">
          <aside class="row between-xs">
            <div class="container_phone">
            </div>
            <div class="toolbar-top-item" style="display: <?= $styleOutput ?>">
              <a class="cs-l-1 toolbar-top-link-alt toolbar-top-link-alt-bold toolbar-top-link-alt-splitter ico-user-male-before" href="#"><?= $_SESSION['email'] ?></a>
              <a class="cs-l-1 toolbar-top-link-alt toolbar-top-link-alt-bold toolbar-top-link-alt-splitter" href="http://localhost/index.php?exit">Выход</a>
            </div>
            <div class="toolbar-top-item" style="display: <?= $styleInput ?>">
              <a class="cs-l-1 toolbar-top-link-alt toolbar-top-link-alt-bold toolbar-top-link-alt-splitter ico-user-male-before" href="http://localhost/login.php">Войти</a>
              <a class="cs-l-1 toolbar-top-link-alt" href="http://localhost/index.php?id=reg">Регистрация</a>
              <a class="cs-l-1 toolbar-top-link-alt" href="http://localhost/admin/">Администрирование</a>
            </div>
          </aside>
        </div>
      </div>
      <div class="site-head-inner container container-fluid">
        <div class="row middle-xs">
          <div class="col-xs-3 site-head-phone-col">
            <a href=../index.php class="site-head-logo-link logo-generator-link">
              <div>
                <logo-generator-preview class="logo-generator-preview">
                  <img id="logo" src="../pictures/logo_20180219155119.png" alt="Moloko" class="site-head-logo-picture" />
                </logo-generator-preview>
              </div>
            </a>
          </div>
          <div class="site-head-logo-block site-head-logo col-xs">
            <ul class="menu-header clear">
              <li class="menu-header-item">
                <a class="cs-l-2 menu-header-link" href="http://localhost/index.php?id=about">О магазине</a>
              </li>
              <li class="menu-header-item">
                <a class="cs-l-2 menu-header-link" href="http://localhost/index.php?id=payment">Оплата</a>
              </li>
              <li class="menu-header-item">
                <a class="cs-l-2 menu-header-link" href="http://localhost/index.php?id=shipping">Доставка</a>
              </li>
            </ul>
          </div>
          <div class="col-xs-3 site-head-menu-col">
            <div class="static-block">
              <div style="width:100%; text-align:right;">
                <span style="font-size: 12px;font-family: Neris Thin;">
                  БЕЗ ВЫХОДНЫХ
                </span>
              </div>
            </div>
            <div class="site-head-phone">8 951 000 00 00</div>
          </div>
        </div>
      </div>
    </header>
    <main class="stretch-middle site-body">
      <div class="container container-fluid site-body-inner js-site-body-inner cs-bg-7">
        <!-- Меню -->
        <div id="menu-custom" class="rel big-z menu-block default">
          <div class="site-body-aside">
            <div class="site-menu-row cs-g-1 js-menu-general-block-orientation cs-bg-12">
              <div class="container">
                <div class="row">
                  <div class="menu-general cs-bg-i-12 harmonica harmonica-initialized col-xs-3">
                    <nav class="menu-dropdown menu-dropdown-modern menu-dropdown-compact">
                      <a class="menu-dropdown-root ico-menu-before ico-down-open-big-after" href="?id=catalog">
                        <span class="menu-dropdown-root-text">Все товары</span>
                      </a>
                      <div class="menu-dropdown-list cs-br-1">
                        <div class="menu-dropdown-item cs-br-1 submenu-modern">
                          <div class="menu-dropdown-link-wrap cs-bg-i-7 ">
                            <a class="menu-dropdown-link" href="?id=catalog&i=1">
                              <span class="menu-dropdown-link-text text-floating">
                                Молочные продукты
                              </span>
                            </a>
                          </div>
                        </div>
                        <div class="menu-dropdown-item cs-br-1 submenu-modern">
                          <div class="menu-dropdown-link-wrap cs-bg-i-7 ">
                            <a class="menu-dropdown-link" href="?id=catalog&i=2">
                              <span class="menu-dropdown-link-text text-floating">
                                Мясные продукты
                              </span>
                            </a>
                          </div>
                        </div>
                      </div>
                    </nav>
                  </div>
                  <!-- Поиск -->
                  <div class="col-xs-6 main-menu-search">
                    <div class=" search-block-topmenu">
                      <form name="searchHeaderForm" class="site-head-search-form">
                        <div class="site-head-search-input-wrap">
                          <div class="site-head-site-head-search">
                            <input class="input-big site-head-search-input" type="search" autocomplete="off" placeholder="ПОИСК ТОВАРОВ" name="q" />
                          </div>
                        </div>
                        <div class="site-head-search-btn-wrap">
                          <div class="site-head-search-col">
                            <a href="#" class="btn btn-big btn-expander site-head-search-btn" id="searchHeaderSubmit">
                              <span class="icon-search-block ico-search-before cs-t-1"></span>
                            </a>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- Поиск -->
                  <!-- Корзина -->
                  <div class="col-xs-3 main-menu-cart" style="display: <?= $styleOutput ?>">
                    <div class="site-head-cart">
                      <div class="cart-mini" style="display:inline-block">
                        <a href="?id=basket" class="cart-mini-main-link">
                          <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                          <span class="cart-mini-link-text"> Корзина</span><br /> <span class="cart-mini-link-count">В корзине: <?= count($add2basket->basket) - 1 ?></span>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- Корзина -->
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Меню -->
        <!-- основной контент -->
        <?php
        if (!isset($_GET['id'])) {
          require_once "pages/home.php";
        } else {
          $switch->switch($_GET['id']);
        }
        ?>
        <!-- основной контент -->
      </div>
  </div>
  </main>
  <div class="site-footer-wrap">
    <footer class="site-footer cs-bg-12">
      <div class="site-footer-top-level">
        <div class="container container-fluid site-footer-top-level-wrap site-footer-top-level-inner">
          <div class="row">
            <div class="col-xs-3 footer-menu">
              <div class="footer-menu-head">
                О нас
              </div>
              <ul class="footer-menu-list">
                <li class="footer-menu-item">
                  <a class="footer-menu-link cs-l-2" href="pages/about.html">
                    <span class="footer-menu-text">О магазине</span>
                  </a>
                </li>
                <li class="footer-menu-item">
                  <a class="footer-menu-link cs-l-2" href="#">
                    <span class="footer-menu-text">Новости магазина</span>
                  </a>
                </li>
                <li class="footer-menu-item">
                  <a class="footer-menu-link cs-l-2" href="#">
                    <span class="footer-menu-text">Контактная информация</span>
                  </a>
                </li>
                <li class="footer-menu-item">
                  <a class="footer-menu-link cs-l-2" href="#">
                    <span class="footer-menu-text">Адрес магазина</span>
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-xs-3 footer-menu">
              <div class="footer-menu-head">
                Помощь
              </div>
              <ul class="footer-menu-list">
                <li class="footer-menu-item">
                  <a class="footer-menu-link cs-l-2" href="pages/contacts.html">
                    <span class="footer-menu-text">Как сделать заказ на сайте</span>
                  </a>
                </li>
                <li class="footer-menu-item">
                  <a class="footer-menu-link cs-l-2" href="#">
                    <span class="footer-menu-text">Обратная связь</span>
                  </a>
                </li>
                <li class="footer-menu-item">
                  <a class="footer-menu-link cs-l-2" href="pages/payment.php">
                    <span class="footer-menu-text">Оплата</span>
                  </a>
                </li>
                <li class="footer-menu-item">
                  <a class="footer-menu-link cs-l-2" href="pages/shipping.php">
                    <span class="footer-menu-text">Доставка</span>
                  </a>
                </li>
              </ul>
            </div>
            <div class="col-xs-3">
              <div class="static-block">
                <div class="footer-column footer-column-last">
                  <p class="footer-column-title">Есть вопросы? Звоните!</p>
                  <div class="footer-phone"><a class="footer-phone-number" href="tel:8 951 000 00 00">8 951 000 00 00</a>
                    <p class="footer-phone-text">Для звонков по Уралу</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  </div>

  <link rel="stylesheet" type="text/css" href="combine/alldf00.css" />

</body>

</html>
<!-- <?php
      phpinfo()
      ?> -->
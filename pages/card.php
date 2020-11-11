<?php
require_once "php/class.card.php";
$card = new Card();
$q = $card->getCard($_GET['key']);

?>

<main class="stretch-middle site-body">
    <div class="container container-fluid site-body-inner js-site-body-inner cs-bg-7">
        <?php
        $category = '';
        $presence = 'Есть в наличии';
        foreach ($q as $key => $value) {
            if($value['category'] == 1) $category = 'молочные продукты';
            else $category = 'мясные продукты';
        ?>
        <div class="breads cs-br-1">
            <div class="breads-item icon-right-open-after cs-t-3">
                <a href="../index.php" class="breads-item-link cs-l-3"><span >Главная</span></a>—
            </div>
            <div class="breads-item icon-right-open-after cs-t-3">
                <a href="http://localhost/index.php?id=catalog&i=<?=$value['category']?>" class="breads-item-link cs-l-3"><span ><?=$category?></span></a>—
            </div>
            <div class="breads-item"><span class="breads-item-current cs-t-1"><?=$value['name']?></span></div>
        </div>
        <div class="col-p-v">
            <div class="page-title-row details-title-row">
                <h1 class="details-title page-title cs-t-9"><?=$value['name']?></h1>
            </div>
            <div class="details-sku">
                <div class="details-param-name">Артикул:</div>
                <div class="details-param-value inplace-offset"></div>
            </div>
            <!-- <div class="details-rating">
                <ul class="rating">
                    <li class="rating-item icon-star-before"></li>
                    <li class="rating-item icon-star-before"></li>
                    <li class="rating-item icon-star-before"></li>
                    <li class="rating-item icon-star-before"></li>
                    <li class="rating-item icon-star-before"></li>
                </ul>
            </div> -->
            <div class="details-meta">
                <div class="products-view-meta">
                    <ul class="products-view-meta-list">
                        <li class="products-view-meta-item cs-br-1 details-reviews">
                            <a href="#">
                                0 отзывов
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="details-block">
                <div class="row">
                    <div class="col-xs-5">
                        <div class="gallery-block">
                            <figure class="gallery-picture text-static">
                                <a class="gallery-picture-link link-text-decoration-none" href="http://localhost/pictures/product/<?=$value['img_name']?>" style="max-height: 700px;">
                                    <img class="gallery-picture-obj" src="http://localhost/pictures/product/<?=$value['img_name']?>" alt=""/>
                                </a>
                                <span class="gallery-picture-labels">
                                    <div class="products-view-label"><span class="products-view-label-inner products-view-label-new">НОВИНКА</span></div>
                                </span>
                            </figure>
                            <div class="details-additional-graphics">
                                <div class="cs-bg-12">
                                    <a href="#" class="gallery-zoom ico-eye-before-abs cs-l-9 link-dotted">Кликните на картинку для расширенного просмотра</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-7">
                        <div class="details-block-info">
                            <div class="" style="width:100%;padding:20px 0 0;">
                                <div class="details-row details-payment">
                                    <div class="row middle-xs">
                                        <div class="col-xs">
                                            <div class="details-payment-price">
                                                <div class="price">
                                                    <div>
                                                        <div>
                                                            <div class="price-current cs-t-1">
                                                                <div class="price-number"><?=$value['price']?></div>
                                                                <div class="price-currency"> руб.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="details-row details-availability">
                                            <div class="availability available">
                                                <div>Есть в наличии</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="details-row details-amount">
                                            <div class="details-param-name">
                                                Количество на складе:
                                                <div class="ng-hide availability not-available">
                                                    <span><?=$value['quantity']?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="" style="width:100%;">
                                <div class="details-payment-cell payment-btns row">
                                    <div class=" col-xs-6">
                                        <a href="#" class="btn btn-middle btn-confirm">Купить</a>
                                    </div>
                                </div>
                                <div class="static-block">
                                    <br>
                                </div>
                                <aside class="details-aside cs-bg-4">
                                    <div class="block-exuding">
                                        <div class="block-exuding-row">
                                            <label class="wishlist-control cs-l-2">
                                                <input type="checkbox" class="custom-input-native wishlist-checkbox"/>
                                            </label>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="tabs tabs-horizontal details-tabs">
                        <ul class="tabs-headers clear">
                            <li id="tabDescription" class="tabs-header-item">
                                <a href="#" class="tabs-header-item-link">
                                    Описание
                                </a>
                            </li>
                            <li id="tabReviews" class="tabs-header-item">
                                <a href="#" class="tabs-header-item-link">
                                    Отзывы
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="details-row">
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</main>
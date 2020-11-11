<!-- основной контент -->
<?php
$catalog = new Catalog();
$name = 'все продукты';
$products = $catalog->getProducts(null);
if(isset($_GET['i'])){
  $products = $catalog->getProducts($_GET['i']);
  if($_GET['i']==1)
    $name = 'молочные продукты';
  else
    $name = 'мясные продукты';
}
?>
<div class="row">
  <div class="col-xs-3 site-body-aside">
    <nav class="menu-dropdown menu-dropdown-modern menu-dropdown-expanded">
      <div class="menu-dropdown-list cs-br-1" data-submenu-container="{'type': 'modern'}">

        <div class="menu-dropdown-item cs-br-1 submenu-modern " data-submenu-parent>
          <div class="menu-dropdown-link-wrap cs-bg-i-7 ">
            <a class="menu-dropdown-link" href="?id=catalog&i=1">
              <span class="menu-dropdown-link-text text-floating">Молочные продукты</span>
            </a>
          </div>
        </div>
        <div class="menu-dropdown-item cs-br-1 submenu-modern " data-submenu-parent>
          <div class="menu-dropdown-link-wrap cs-bg-i-7 ">
            <a class="menu-dropdown-link" href="?id=catalog&i=2">
              <span class="menu-dropdown-link-text text-floating">Мясные продукты</span>
            </a>
          </div>
        </div>
      </div>
    </nav>
  </div>

  <div class="col-xs-9 site-body-main">
    <!-- название категории -->
    <div class="page-title-row catalog-title-row border-bottom-spliter cs-br-3 row">
      <h1 class="catalog-title page-title cs-t-9">
        <?= $name ?>
      </h1>
    </div>
    <!-- название категории -->

    <div class="row products-view products-view-table">

      <!-- товар -->
      <?php
      foreach ($products as $key => $value) {
      ?>
        <div class="products-view-block cs-br-1 js-products-view-block">
          <div class="products-view-item text-static cs-br-1 js-products-view-item">
            <figure class="products-view-pictures" style="width: 354px;">
              <a class="products-view-picture-link" href="?id=card&key=<?=$value['id']?>">
                <img src="pictures/product/<?= $value['img_name'] ?>" title="" class="products-view-picture">
              </a>
            </figure>
            <div class="products-view-info">
              <div class="products-view-name products-view-name-default">
                <a href="?id=card&key=<?=$value['id']?>" class="products-view-name-link" title=""><?= $value['name'] ?></a>
              </div>
              <div class="products-view-meta products-view-tile-element-hidden">
                <div class="products-view-meta-item products-view-tile-element-hidden cs-br-1">колличесво на складе: <?= $value['quantity'] ?></div>
              </div>
              <div class="products-view-colors-empty products-view-list-element-hidden products-view-table-element-hidden" style="height: 11px"></div>
            </div>

            <!-- подпись продукта "акция" или "хит" -->
            <!-- <div class="products-view-labels">
              <div class="products-view-label"><span class="products-view-label-inner products-view-label-best"> ХИТ </span></div>
            </div> -->
            <!-- подпись продукта "акция" или "хит" -->

            <div class="products-view-price-block products-view-price-inner">
              <!-- Цена -->
              <div class="products-view-price">
                <div class="price">
                  <div class="price-current cs-t-1">
                    <div class="price-number"><?= $value['price'] ?></div>
                    <div class="price-currency"> руб.</div>
                  </div>
                </div>
              </div>
              <!-- Цена -->
              <!-- кнопка корзина -->
              <div class="products-view-buttons-cell">
                <form action="" class="products-view-buttons" method="POST">
                  <button type="submit" class="btn btn-buy products-view-buy">
                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                  </button>
                  <input type="hidden" name="catalog-id" id="" value="<?= $value['id'] ?>">
                  <input type="number" name="numberOf" id="input1" placeholder="кол-во товара">
                </form>
              </div>
              <!-- кнопка корзина -->
            </div>
          </div>
        </div>
      <?php } ?>
      <!-- товар -->
    </div>
  </div>
</div>
<!-- основной контент -->
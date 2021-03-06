<?php
    $catalog = new Catalog();
    if(isset($_GET['i']))
      $products = $catalog->getProducts($_GET['i']);
?>
<div class="row body-content">
  <div class="col-xs-12 site-body-main">
    <div class="products-specials-container">
      <!-- свежий товар -->
      <article class="products-specials-block products-specials-best cs-br-1">
        <header class="products-specials-header">
          <div class="h2 h-inline products-specials-discount-h">Свежий привоз!</div>
          <a href="#" class="products-specials-more">
            Весь свежий товар
          </a>
        </header>
        <div class="row products-view products-view-tile row">
          <div class="products-view-block cs-br-1 js-products-view-block" style="-webkit-flex-basis: 25%; -ms-flex-preferred-size: 25%; flex-basis: 25%; max-width: 25%;">
            
          <div class="products-view-item text-static cs-br-1 js-products-view-item" style="padding-left:354px; min-height:215px;">
              <figure class="products-view-pictures" style="width: 354px;">
                <a class="products-view-picture-link" href="products/tvorog.php" style="height: 215px;">
                  <img src="pictures/product/small/4020_small.jpg" class="products-view-picture">
                </a>
              </figure>
              <div class="products-view-info">
                <div class="products-view-name products-view-name-default">
                  <a href="products/tvorog.php" class="products-view-name-link">Молоко</a>
                </div>
              </div>
              <div class="products-view-labels">
                <!-- <div class="products-view-label">
                  <span class="products-view-label-inner products-view-label-best">
                    ХИТ
                  </span>
                </div> -->
              </div>
              <div class="products-view-price-block products-view-price-inner">
                <div class="products-view-price">
                  <div class="price">
                    <div class="price-current cs-t-1">
                      <div class="price-number">75</div>
                      <div class="price-currency"> руб.</div>
                    </div>
                  </div>
                </div>
                <div class="products-view-buttons-cell">
                  <div class="products-view-buttons">
                    <a href="products/tvorog.php" data-ng-href="{{productViewItem.getUrl('products/zhurnalnyi-stolik.html')}}" data-cart-add data-offer-id="0" data-product-id="1650" data-amount="0" class="btn btn-buy products-view-buy">
                      <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </article>
      <!-- свежий товар -->

      <!-- товар со скидкой -->
      <!-- <article class="products-specials-block products-specials-discount cs-br-1">
        <header class="products-specials-header">
          <div class="h2 h-inline products-specials-discount-h">Скидка!</div><a href="productlist/sale.html" class="products-specials-more">Все товары со
            скидкой</a>
        </header>
        <div class="row products-view products-view-tile">

          <div class="products-view-block cs-br-1 js-products-view-block" style="-webkit-flex-basis: 25%; -ms-flex-preferred-size: 25%; flex-basis: 25%; max-width: 25%;">
            <div data-hreff="http://moloko.promo-z.ru/products/relax" class="products-view-item text-static cs-br-1 js-products-view-item" style="padding-left:354px; min-height:215px;" data-product-view-item data-offer-id="12442" data-product-id="1636">
              <figure class="products-view-pictures" style="width: 354px;">
                <a class="products-view-picture-link" href="products/relax.html" data-ng-href="{{productViewItem.getUrl('products/relax.html')}}" style="height: 215px;">
                  <img src="pictures/product/small/4006_small.jpg" data-ng-src="{{productViewItem.picture.PathSmall}}" data-qazy="true" alt="Relax" title="Relax" class="products-view-picture">
                </a>
              </figure>
              <div class="products-view-info">
                <div class="products-view-name products-view-name-default">
                  <a href="products/relax.html" data-ng-href="{{productViewItem.getUrl('products/relax.html')}}" class="products-view-name-link" title="Relax">Relax</a>
                </div>
                <div class="products-view-meta products-view-tile-element-hidden">
                  <div class="products-view-meta-item cs-br-1"><span class="products-view-tile-element-hidden">Артикул:
                    </span>1636</div>
                  <div class="products-view-meta-item products-view-tile-element-hidden cs-br-1">
                    0 отзывов</div>
                </div>
                <div class="products-view-colors-empty products-view-list-element-hidden products-view-table-element-hidden" style="height: 11px"></div>
              </div>
              <div class="products-view-labels">
                <div class="products-view-label">
                  <span class="products-view-label-inner products-view-label-discount">
                    АКЦИЯ 10%
                  </span>
                </div>
              </div>
              <div class="products-view-price-block products-view-price-inner">
                <div class="products-view-price">
                  <div class="price">
                    <div class="price-old cs-t-3">
                      <div class="price-number">50 000</div>
                      <div class="price-currency"> руб.</div>
                    </div>
                    <div class="price-new cs-t-1">
                      <div class="price-number">45 000</div>
                      <div class="price-currency"> руб.</div>
                    </div>
                    <div class="price-discount">выгода <div class="price-new-discount">5 000 руб.</div> или <div class="price-discount-percent-wrap">
                        <div class="price-discount-percent"> 10%</div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="products-view-buttons-cell">
                  <div class="products-view-buttons">
                    <a href="products/relax.html" data-ng-href="{{productViewItem.getUrl('products/relax.html')}}" data-cart-add data-offer-id="0" data-product-id="1636" data-amount="0" class="btn btn-buy products-view-buy">
                      <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </article> -->
      <!-- товар со скидкой -->
    </div>
  </div>
</div>
<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2020
 */

$enc = $this->encoder();

$target = $this->config( 'client/html/catalog/lists/url/target' );
$cntl = $this->config( 'client/html/catalog/lists/url/controller', 'catalog' );
$action = $this->config( 'client/html/catalog/lists/url/action', 'list' );
$config = $this->config( 'client/html/catalog/lists/url/config', [] );

$optTarget = $this->config( 'client/jsonapi/url/target' );
$optCntl = $this->config( 'client/jsonapi/url/controller', 'jsonapi' );
$optAction = $this->config( 'client/jsonapi/url/action', 'options' );
$optConfig = $this->config( 'client/jsonapi/url/config', [] );

$textTypes = $this->config( 'client/html/catalog/lists/head/text-types', array( 'short', 'long' ) );
$catalog_lists = $this->get( 'catalog_lists', map() );
?>
<?php if($catalog_lists){ ?>
    <?php foreach($catalog_lists as $code => $catalog_list){?>
        <?php if(sardes_option('show_'.$code.'_products') && $catalog_list['listProductItems']){?>  
        <section class="aimeos catalog-list swordbros <?=$code?>">
                <div class="product-area ">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="section-title">
                                    <h3><?=$this->translate( 'client', $catalog_list['label'].' Products' )?></h3>
                                    <div class="product-arrow"><span><a href="<?= $catalog_list['list_link']?>"><?=$this->translate( 'client', 'View All' )?></a></span></div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="shop-product-wrap grid gridview-3 row">

                                <?= $this->partial(
                                    $this->config( 'client/html/common/partials/products', 'common/partials/products-mini-standard' ),
                                    array(
                                        'require-stock' => (int) $this->config( 'client/html/basket/require-stock', true ),
                                        'basket-add' => $this->config( 'client/html/catalog/lists/basket-add', false ),
                                        'productItems' => map() ,
                                        'products' =>  $catalog_list['listProductItems'] ,
                                        'position' => $this->get( 'itemPosition' ),
                                    )
                                ); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <?php }?>  
    <?php }?>
<?php }?>


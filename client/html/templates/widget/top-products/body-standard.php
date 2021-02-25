<?php


$enc = $this->encoder();



$products = sardes_top_products();


$textTypes = $this->config( 'client/html/catalog/lists/head/text-types', array( 'short', 'long' ) );


?>
<section class="aimeos catalog-list swordbros featured">
        <div class="product-area ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h3><?=$this->translate( 'client', 'Featured Products' )?></h3>
                            <div class="product-arrow"><span><a href=""><?=$this->translate( 'client', 'View All' )?></a></span></div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="shop-product-wrap grid gridview-3 row">

                        <?php foreach($products  as $product ){ 
		echo $this->partial( $this->config( 'client/html/common/partials/product', 'common/partials/product-standard' ),
			array(
				'require-stock' => (bool) $this->config( 'client/html/basket/require-stock', true ),
				'basket-add' => $this->config( 'client/html/catalog/product/basket-add', false ),
				'product' => $product,
			)
		);			  
}?>  

                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>







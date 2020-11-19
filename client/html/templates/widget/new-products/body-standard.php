<?php
$enc = $this->encoder();
$products = frigian_new_products();
?>
<!-- ::::::  Start  Product Style - Default Section  ::::::  -->
<div class="product m-t-100">
  <div class="container">
    <div class="row">
      <div class="col-12"> 
        <!-- Start Section Title -->
        <div class="section-content section-content--border m-b-35">
          <h5 class="section-content__title"><?= $this->translate( 'client', 'New Products' ); ?></h5>
          <a href="shop-sidebar-grid-left.html" class="btn btn--icon-left btn--small btn--radius btn--transparent btn--border-green btn--border-green-hover-green font--regular text-capitalize"><?= $this->translate( 'client', 'More Products' ); ?><i class="fal fa-angle-right"></i></a> </div>
        <!-- End Section Title --> 
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="default-slider default-slider--hover-bg-red product-default-slider">
          <div class="product-default-slider-4grid-1rows gap__col--30 gap__row--40"> 
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
</div>
<!-- ::::::  End  Product Style - Default Section  ::::::  --> 


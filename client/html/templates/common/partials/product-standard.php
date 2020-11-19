<?php
$enc = $this->encoder();
$position = $this->get( 'position' );

$detailTarget = $this->config( 'client/html/catalog/detail/url/target' );
$detailController = $this->config( 'client/html/catalog/detail/url/controller', 'catalog' );
$detailAction = $this->config( 'client/html/catalog/detail/url/action', 'detail' );
$detailConfig = $this->config( 'client/html/catalog/detail/url/config', [] );
$detailFilter = array_flip( $this->config( 'client/html/catalog/detail/url/filter', ['d_prodid'] ) );

$productItem = $this->get('product');

if($productItem ){
	$params = array_diff_key( ['d_name' => $productItem->getName( 'url' ), 'd_prodid' => $productItem->getId(), 'd_pos' => $position !== null ? $position++ : ''], $detailFilter ); 
?>
<!-- Start Single Default Product -->
<div class="product__box product__default--single text-center"> 
	
  <!-- Start Product Image -->
  <div class="product__img-box  pos-relative"> <a href="<?= $enc->attr( $this->url( ( $productItem->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig ) ); ?>" class="product__img--link"> 
	  <?php if( ( $mediaItem = $productItem->getRefItems( 'media', 'default', 'default' )->first() ) !== null ) : ?>
	  <div class="product__img img-fluid" style=" background-image: url(<?= $enc->attr( $this->content( $mediaItem->getPreview() ) ); ?>);" alt="<?= $enc->attr( $mediaItem->getName() ); ?>" alt=""></div>
	  <?php else: ?>
	  <img class="product__img img-fluid" src="<?=frigian_url('assets/img/product/size-normal/product-home-1-img-1.jpg') ?>" alt="">  
	  <?php endif; ?>
    </a><!-- End Product Image --> 
    
    <!-- Start Product Action Link-->
    <ul class="product__action--link pos-absolute">
      <li><a href="#modalAddCart" data-toggle="modal"><i class="icon-shopping-cart"></i></a></li>
      <li><a href="compare.html"><i class="icon-sliders"></i></a></li>
      <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
      <li><a href="#modalQuickView" data-toggle="modal"><i class="icon-eye"></i></a></li>
    </ul>
    <!-- End Product Action Link --> 
  </div>
   
  
  <!-- Start Product Content -->
  <div class="product__content m-t-20">
    <ul class="product__review">
<!-- <?php if( $productItem->getRating() > 0 ) : ?>-->
		<?= str_repeat( '<li class="product__review--fill"><i class="icon-star"></i></li>', (int) round( $productItem->getRating() ) ) ?>
<!--<?php endif ?> --> 
		
    </ul>
    <a href="<?= $enc->attr( $this->url( ( $productItem->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig ) ); ?>" class="product__link"><?=$productItem->get('product.label')?></a>
        <?= $this->partial(
            $this->config( 'client/html/common/partials/price', 'common/partials/price-standard' ),
            ['prices' => $productItem->getRefItems( 'price', null, 'default' )]
        ); ?>
	  
    
  </div>
  <!-- End Product Content --> 
</div>
<!-- End Single Default Product --> 
<?php 
}
?>
<?php
$enc = $this->encoder();
$position = $this->get( 'position' );

$detailTarget = $this->config( 'client/html/catalog/detail/url/target' );
$detailController = $this->config( 'client/html/catalog/detail/url/controller', 'catalog' );
$detailAction = $this->config( 'client/html/catalog/detail/url/action', 'detail' );
$detailConfig = $this->config( 'client/html/catalog/detail/url/config', [] );
$detailFilter = array_flip( $this->config( 'client/html/catalog/detail/url/filter', ['d_prodid'] ) );

$watchTarget = $this->config( 'client/html/account/watch/url/target' );
$watchController = $this->config( 'client/html/account/watch/url/controller', 'account' );
$watchAction = $this->config( 'client/html/account/watch/url/action', 'watch' );
$watchConfig = $this->config( 'client/html/account/watch/url/config', [] );

$pinTarget = $this->config( 'client/html/catalog/session/pinned/url/target' );
$pinController = $this->config( 'client/html/catalog/session/pinned/url/controller', 'catalog' );
$pinAction = $this->config( 'client/html/catalog/session/pinned/url/action', 'detail' );
$pinConfig = $this->config( 'client/html/catalog/session/pinned/url/config', [] );

$favTarget = $this->config( 'client/html/account/favorite/url/target' );
$favController = $this->config( 'client/html/account/favorite/url/controller', 'account' );
$favAction = $this->config( 'client/html/account/favorite/url/action', 'favorite' );
$favConfig = $this->config( 'client/html/account/favorite/url/config', [] );

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
    <?php	$urls = array(
	'pin' => $this->url( $pinTarget, $pinController, $pinAction, ['pin_action' => 'add', 'pin_id' => $productItem->getId(), 'd_name' => $productItem->getName( 'url' )], $pinConfig ),

'watch' => $this->url( $watchTarget, $watchController, $watchAction, ['wat_action' => 'add', 'wat_id' => $productItem->getId(), 'd_name' => $productItem->getName( 'url' )], $watchConfig ),
'favorite' => $this->url( $favTarget, $favController, $favAction, ['fav_action' => 'add', 'fav_id' => $productItem->getId(), 'd_name' => $productItem->getName( 'url' )], $favConfig ),
);
?>
    <ul class="product__action--link pos-absolute">
    <li><a href="compare.html"><i class="icon-sliders"></i></a></li>
    <?php 



	$icons = array('pin'=>'fa-map-pin','watch'=>'fa-eye','favorite'=>'fa-heart');



	 foreach( $this->config( 'client/html/catalog/actions/list', [ 'pin', 'favorite', 'watch'] ) as $entry ) : ?>

		<?php if( isset( $urls[$entry] ) ) : ?>

			<li><a class="btn btn--round btn--round-size-small btn--green btn--green-hover-black" href="<?= $enc->attr( $urls[$entry] );  ?> " title="<?= $enc->attr( $this->translate( 'client/code', $entry ) ); ?>" data-toggle="tooltip" target="_blank" title="" data-original-title="<?= $enc->attr( $entry ); ?>">

                   <i class="fa <?= @$icons[$enc->attr( $entry )]; ?>"></i>

                </a>

			</li>

		<?php endif; ?>
	  <?php endforeach; ?>
     
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
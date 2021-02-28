<?php

$enc = $this->encoder();
$position = $this->get( 'position' );
$detailTarget = $this->config( 'client/html/catalog/detail/url/target' );
$detailController = $this->config( 'client/html/catalog/detail/url/controller', 'catalog' );
$detailAction = $this->config( 'client/html/catalog/detail/url/action', 'detail' );
$detailConfig = $this->config( 'client/html/catalog/detail/url/config', [] );
$detailFilter = array_flip( $this->config( 'client/html/catalog/detail/url/filter', ['d_prodid', 'language'] ) );
?>

<?php foreach( $this->get( 'products', [] ) as $id => $productItem ) : ?>
		<?php $params = array_diff_key( [
    'd_name' => $productItem->getName( 'url' ), 
    'd_prodid' => $productItem->getId(), 
    'd_pos' => $position !== null ? $position++ : '' ], 
    $detailFilter ); ?>
    <div class="col-lg-3 col-md-3 col-sm-6">
        <div class="product-item">
            <div class="single-product">
                <div class="product-img">
                    <a href="<?= $enc->attr( $this->url( ( $productItem->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig ) ); ?>">
                        <?php $mediaItems = $productItem->getRefItems( 'media', 'default', 'default' ); ?>
                        <?php if($mediaItems){ 
                        $i = 0;
                        foreach($mediaItems as $mediaItem){
                        $i++;
                        if($i==1){
                        $imageclass = 'primary';
                        } else if($i==2){
                        $imageclass = 'secondary';
                        } 
                        ?>
        
                        <img class="<?=$imageclass ?>-img" src="<?= $enc->attr( $this->content( $mediaItem->getPreview() ) ); ?>">
                        <?php if($i>=2) break; } } ?>
														
											
                    </a>

                    <div class="price-box-discount">

                        <?= $this->partial(
                        $this->config( 'client/html/common/partials/price', 'common/partials/price-standard' ), ['prices' => $productItem->getRefItems( 'price', null, 'default' )]); ?>

                    </div>
                </div>
                <div class="product-content">
                    <div class="product-desc_info">
                        <h3 class="product-name"><a href="<?= $enc->attr( $this->url( ( $productItem->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig ) ); ?>"><?= $enc->html( $productItem->getName(), $enc::TRUST ); ?></a></h3>
  
                        <div class="price-box">

                            <?= $this->partial(
                            $this->config( 'client/html/common/partials/price', 'common/partials/price-standard' ), ['prices' => $productItem->getRefItems( 'price', null, 'default' )]); ?>

                        </div>
                  
                    </div>
                </div>
            </div>
        </div>
    </div>

	<?php endforeach; ?>

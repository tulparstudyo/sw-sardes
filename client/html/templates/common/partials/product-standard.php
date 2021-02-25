<?php

$enc = $this->encoder();
$position = $this->get( 'position' );
$detailTarget = $this->config( 'client/html/catalog/detail/url/target' );
$detailController = $this->config( 'client/html/catalog/detail/url/controller', 'catalog' );
$detailAction = $this->config( 'client/html/catalog/detail/url/action', 'detail' );
$detailConfig = $this->config( 'client/html/catalog/detail/url/config', [] );
$detailFilter = array_flip( $this->config( 'client/html/catalog/detail/url/filter', ['d_prodid', 'language'] ) );


$watchTarget = $this->config( 'client/html/account/watch/url/target' );
$watchController = $this->config( 'client/html/account/watch/url/controller', 'account' );
$watchAction = $this->config( 'client/html/account/watch/url/action', 'watch' );
$watchConfig = $this->config( 'client/html/account/watch/url/config', [] );

?>

<?php foreach( $this->get( 'products', [] ) as $id => $productItem ) : ?>
		<?php $params = array_diff_key( [
    'd_name' => $productItem->getName( 'url' ), 
    'd_prodid' => $productItem->getId(), 
    'd_pos' => $position !== null ? $position++ : '' ], 
    $detailFilter ); ?>
    <div class="col-lg-3 col-md-3 col-sm-6 ***">
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
                    <?php	$urls = array('watch' => $this->url( $watchTarget, $watchController, $watchAction, ['wat_action' => 'add', 'wat_id' => $productItem->getId(), 'd_name' => $productItem->getName( 'url' )], $watchConfig ),



                    );?>

                    <div class="add-actions">
                        <ul>
                        <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="<?= $enc->attr( $this->url( $detailTarget, $detailController, $detailAction, $params, [], $detailConfig ) ); ?>" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?=$this->translate( 'client', 'Quick view' )?>"><i class="fa fa-search"></i></a>
                        </li>
                   												
						<?php foreach( $this->config( 'client/html/catalog/actions/list', ['watch'] ) as $entry ) : ?>

		                    <?php if( isset( $urls[$entry] ) ) : ?>

			                <li><a href="<?= $enc->attr( $urls[$entry] );  ?> " data-toggle="tooltip" data-placement="right" title="<?=$this->translate( 'client', 'Watch' )?>">

                                <i  class="fa fa-eye"></i>

                                </a>

			                </li>



		                    <?php endif; ?>

	                    <?php endforeach; ?>

                        </ul>
                    </div>
						           

                </div>
                <div class="product-content">
                    <div class="product-desc_info">
                        <h3 class="product-name"><a href="<?= $enc->attr( $this->url( ( $productItem->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig ) ); ?>"><?= $enc->html( $productItem->getName(), $enc::TRUST ); ?></a></h3>
  
                        <div class="price-box">

                            <?= $this->partial(
                            $this->config( 'client/html/common/partials/price', 'common/partials/price-standard' ), ['prices' => $productItem->getRefItems( 'price', null, 'default' )]); ?>

                        </div>

                        <?php if( $productItem->getRating() > 0 ) : ?>
						<div class="rating" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
							<span class="stars"><?= str_repeat( '★', (int) round( $productItem->getRating() ) ) ?></span>
							
							<?php /*<span class="ratings" itemprop="reviewCount"><?= (int) $this->detailProductItem->getRatings() ?></span>*/?>
                        </div>
                        
                        <?php else :?>
						<div class="rating-empty" itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
							<span class="stars"><?= str_repeat( '<i class="ion-ios-star-outline"></i>', 5 ) ?></span>
							
						</div>
				
					<?php endif ?>
               
                    </div>
                </div>
            </div>

            
            
        </div>

        <div class="list-product_item">

            <div class="single-product">

				<div class="product-img">
                    <a href="<?= $enc->attr( $this->url( ( $productItem->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig ) ); ?>">

						<?php 
						    $imageStep = 0;

						    foreach( $productItem->getRefItems( 'media', 'default', 'default' ) as $k => $mediaItem ) : ?>
						    <?php $imageType = 'secondary-img';
						    if($imageStep==0){$imageType="primary-img";}
						    if($imageStep > 1){break;}
							$imageStep++;
							?>

						    <img class="<?= $imageType?> <?=$k?>" src="<?= $enc->attr( $this->content( $mediaItem->getPreview() ) ); ?>" alt="<?= $enc->html( $productItem->getName(), $enc::TRUST ); ?>" style="max-height: 200px; width: auto;">
											
						<?php endforeach; ?>
						              
					</a>

                </div> 

                <div class="product-content">

                <div class="product-desc_info">
					                <div class="price-box">
					                    <?= $this->partial(
												$this->config( 'client/html/common/partials/price', 'common/partials/price-standard' ),
												array( 'prices' => $productItem->getRefItems( 'price', null, 'default' )->first() ?: map() )
											); ?>
					                </div>
					                <h6 class="product-name"><a href="<?= $enc->attr( $this->url( ( $productItem->getTarget() ?: $detailTarget ), $detailController, $detailAction, $params, [], $detailConfig ) ); ?>"><?= $enc->html( $productItem->getName(), $enc::TRUST ); ?></a></h6>
							
					                <div class="product-short_desc">
					                	<?php foreach( $productItem->getRefItems( 'text', 'short', 'default' ) as $textItem ) : ?>

											<p>
												<?= $enc->html( $textItem->getContent(), $enc::TRUST ); ?>
											</p>

										<?php endforeach; ?>
					                   
					                </div>
				</div>

                <div class="add-actions">
					                <ul>
					                    <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="<?= $enc->attr( $this->url( $detailTarget, $detailController, $detailAction, $params, [], $detailConfig ) ); ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$this->translate( 'client', 'Quick view' )?>"><i class="fa fa-search"></i></a>
                                        </li>
                                        <?php /*<li><a href="#" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?=$this->translate( 'client', 'Add To Wishlist' )?>"><i class="fa fa-heart"></i></a>
                                        </li> */?>
													
										<?php foreach( $this->config( 'client/html/catalog/actions/list', ['watch'] ) as $entry ) : ?>

											<?php if( isset( $urls[$entry] ) ) : ?>

											<li><a href="<?= $enc->attr( $urls[$entry] );  ?> "
				   								data-toggle="tooltip" data-placement="top" title="<?=$this->translate( 'client', 'Watch' )?>">

                                                <i  class="fa fa-eye"></i>

                                            </a>

											</li>
											<?php endif; ?>
										<?php endforeach; ?>

					                </ul>
				</div>

                </div> 


            </div> 
        </div>


        
    </div>

	<?php endforeach; ?>

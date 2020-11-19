<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2020
 */

/* Available data:
 * - detailProductItem : Product item incl. referenced items
 */

$enc = $this->encoder();

$optTarget = $this->config( 'client/jsonapi/url/target' );
$optCntl = $this->config( 'client/jsonapi/url/controller', 'jsonapi' );
$optAction = $this->config( 'client/jsonapi/url/action', 'options' );
$optConfig = $this->config( 'client/jsonapi/url/config', [] );

$basketTarget = $this->config( 'client/html/basket/standard/url/target' );
$basketController = $this->config( 'client/html/basket/standard/url/controller', 'basket' );
$basketAction = $this->config( 'client/html/basket/standard/url/action', 'index' );
$basketConfig = $this->config( 'client/html/basket/standard/url/config', [] );
$basketSite = $this->config( 'client/html/basket/standard/url/site' );


/** client/html/basket/require-stock
 * Customers can order products only if there are enough products in stock
 *
 * Checks that the requested product quantity is in stock before
 * the customer can add them to his basket and order them. If there
 * are not enough products available, the customer will get a notice.
 *
 * @param boolean True if products must be in stock, false if products can be sold without stock
 * @since 2014.03
 * @category Developer
 * @category User
 */
$reqstock = (int) $this->config( 'client/html/basket/require-stock', true );


?>
    <!-- :::::: Start Main Container Wrapper :::::: -->
    <main id="main-container" class="main-container">
    <section class="aimeos catalog-detail" itemscope="" itemtype="http://schema.org/Product" data-jsonurl="<?= $enc->attr( $this->url( $optTarget, $optCntl, $optAction, [], [], $optConfig ) ); ?>">
    
	<?php if( isset( $this->detailErrorList ) ) : ?>
		<ul class="error-list">
			<?php foreach( (array) $this->detailErrorList as $errmsg ) : ?>
				<li class="error-item"><?= $enc->html( $errmsg ); ?></li>
			<?php endforeach; ?>
		</ul>
    <?php endif; ?>
    <?php if( isset( $this->detailProductItem ) ) : ?>
        <!-- Start Product Details Gallery -->
        <div class="product-details">
            <div class="container">
                <div class="row ">
                    <div class="col-md-5">
                        <div class="product-gallery-box product-gallery-box--default m-b-60">
                            <div class="product-image--large product-image--large-horizontal">
                                <img class="img-fluid" id="img-zoom" src="assets/img/product/gallery/gallery-large/product-gallery-large-1.jpg" data-zoom-image="assets/img/product/gallery/gallery-large/product-gallery-large-1.jpg" alt="">
                            </div>
                            <div id="gallery-zoom" class="product-image--thumb product-image--thumb-horizontal pos-relative">
                                <a class="zoom-active" data-image="assets/img/product/gallery/gallery-large/product-gallery-large-1.jpg" data-zoom-image="assets/img/product/gallery/gallery-large/product-gallery-large-1.jpg">
                                    <img class="img-fluid" src="assets/img/product/gallery/gallery-large/product-gallery-large-1.jpg" alt="">
                                </a>
                                <a data-image="assets/img/product/gallery/gallery-large/product-gallery-large-2.jpg" data-zoom-image="assets/img/product/gallery/gallery-large/product-gallery-large-2.jpg">
                                    <img class="img-fluid" src="assets/img/product/gallery/gallery-large/product-gallery-large-2.jpg" alt="">
                                </a>
                                <a data-image="assets/img/product/gallery/gallery-large/product-gallery-large-3.jpg" data-zoom-image="assets/img/product/gallery/gallery-large/product-gallery-large-3.jpg">
                                    <img class="img-fluid" src="assets/img/product/gallery/gallery-large/product-gallery-large-3.jpg" alt="">
                                </a>
                                <a data-image="assets/img/product/gallery/gallery-large/product-gallery-large-4.jpg" data-zoom-image="assets/img/product/gallery/gallery-large/product-gallery-large-4.jpg">
                                    <img class="img-fluid" src="assets/img/product/gallery/gallery-large/product-gallery-large-4.jpg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="product-details-box m-b-60">
                            <h4 class="font--regular m-b-20"><?= $enc->html( $this->detailProductItem->getName(), $enc::TRUST ); ?></h4>
                            
                            <ul class="product__review">
                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                <li class="product__review--blank"><i class="icon-star"></i></li>
                            </ul>
                            <div class="product__price m-t-5">
                                <span class="product__price product__price--large">$19.00 <del>$29.00</del></span>
                                <span class="product__tag m-l-15 btn--tiny btn--green">-34%</span>
                            </div>
                            <?php endif; ?>
                            <div class="product__desc m-t-25 m-b-30">
                            <?php foreach( $this->detailProductItem->getRefItems( 'text', 'short', 'default' ) as $textItem ) : ?>
						<p class="short" itemprop="description"><?= $enc->html( $textItem->getContent(), $enc::TRUST ); ?></p>
					<?php endforeach; ?>
                            </div>
                            <?= $this->block()->get( 'catalog/detail/service' ); ?>


					<form method="POST" action="<?= $enc->attr( $this->url( $basketTarget, $basketController, $basketAction, ( $basketSite ? ['site' => $basketSite] : [] ), [], $basketConfig ) ); ?>">
						<!-- catalog.detail.csrf -->
						<?= $this->csrf()->formfield(); ?>
						<!-- catalog.detail.csrf -->

						<?php if( $basketSite ) : ?>
							<input type="hidden" name="<?= $this->formparam( 'site' ) ?>" value="<?= $enc->attr( $basketSite ) ?>" />
						<?php endif ?>

						<?php if( $this->detailProductItem->getType() === 'select' ) : ?>

							<div class="catalog-detail-basket-selection">

								<?= $this->partial(
									/** client/html/common/partials/selection
									 * Relative path to the variant attribute partial template file
									 *
									 * Partials are templates which are reused in other templates and generate
									 * reoccuring blocks filled with data from the assigned values. The selection
									 * partial creates an HTML block for a list of variant product attributes
									 * assigned to a selection product a customer must select from.
									 *
									 * The partial template files are usually stored in the templates/partials/ folder
									 * of the core or the extensions. The configured path to the partial file must
									 * be relative to the templates/ folder, e.g. "partials/selection-standard.php".
									 *
									 * @param string Relative path to the template file
									 * @since 2015.04
									 * @category Developer
									 * @see client/html/common/partials/attribute
									 */
									$this->config( 'client/html/common/partials/selection', 'common/partials/selection-standard' ),
									['productItems' => $this->detailProductItem->getRefItems( 'product', 'default', 'default' )]
								); ?>

							</div>

						<?php endif; ?>

						<div class="catalog-detail-basket-attribute">

							<?= $this->partial(
								/** client/html/common/partials/attribute
								 * Relative path to the product attribute partial template file
								 *
								 * Partials are templates which are reused in other templates and generate
								 * reoccuring blocks filled with data from the assigned values. The attribute
								 * partial creates an HTML block for a list of optional product attributes a
								 * customer can select from.
								 *
								 * The partial template files are usually stored in the templates/partials/ folder
								 * of the core or the extensions. The configured path to the partial file must
								 * be relative to the templates/ folder, e.g. "partials/attribute-standard.php".
								 *
								 * @param string Relative path to the template file
								 * @since 2016.01
								 * @category Developer
								 * @see client/html/common/partials/selection
								 */
								$this->config( 'client/html/common/partials/attribute', 'common/partials/attribute-standard' ),
								['productItem' => $this->detailProductItem]
							); ?>

						</div>


						<div class="stock-list">
							<div class="articleitem stock-actual"
								data-prodid="<?= $enc->attr( $this->detailProductItem->getId() ); ?>"
								data-prodcode="<?= $enc->attr( $this->detailProductItem->getCode() ); ?>">
							</div>

							<?php foreach( $this->detailProductItem->getRefItems( 'product', null, 'default' ) as $articleId => $articleItem ) : ?>

								<div class="articleitem"
									data-prodid="<?= $enc->attr( $articleId ); ?>"
									data-prodcode="<?= $enc->attr( $articleItem->getCode() ); ?>">
								</div>

							<?php endforeach; ?>

                        </div>
                        <div class="product-var p-tb-30">
                                <div class="product__stock m-b-20">
                                    <span class="product__stock--in"><i class="fas fa-check-circle"></i> 199 IN STOCK</span>
                                </div>
                                <div class="product-quantity product-var__item">
                                    <ul class="product-modal-group">
                                        <li><a href="#modalSizeGuide" data-toggle="modal"  class="link--gray link--icon-left"><i class="fal fa-money-check-edit"></i>Size Guide</a></li>
                                        <li><a href="#modalShippinginfo" data-toggle="modal"  class="link--gray link--icon-left"><i class="fal fa-truck-container"></i>Shipping</a></li>
                                        <li><a href="#modalProductAsk" data-toggle="modal"  class="link--gray link--icon-left"><i class="fal fa-envelope"></i>Ask About This product</a></li>
                                    </ul>
                                </div>
                                </div>

						<?php if( !$this->detailProductItem->getRefItems( 'price', 'default', 'default' )->empty() ) : ?>
							<div class="addbasket">
								<div class="input-group">
									<input type="hidden" value="add" name="<?= $enc->attr( $this->formparam( 'b_action' ) ); ?>" />
									<input type="hidden"
										name="<?= $enc->attr( $this->formparam( ['b_prod', 0, 'prodid'] ) ); ?>"
										value="<?= $enc->attr( $this->detailProductItem->getId() ); ?>"
									/>
									<div class="product-var p-tb-30"> <div class="product-quantity product-var__item d-flex align-items-center">
                                    <span class="product-var__text">Quantity: </span>	<form class="quantity-scale m-l-20">
                                        <div class="value-button" id="decrease" onclick="decreaseValue()">-</div>
                                        <input type="number" <?= !$this->detailProductItem->isAvailable() ? 'disabled' : '' ?>
										name="<?= $enc->attr( $this->formparam( ['b_prod', 0, 'quantity'] ) ); ?>"
										min="<?= $this->detailProductItem->getScale() ?>" max="2147483647"
										step="<?= $this->detailProductItem->getScale() ?>" maxlength="10"
										value="<?= $this->detailProductItem->getScale() ?>" required="required" id="number" value="1" />
                                        <div class="value-button" id="increase" onclick="increaseValue()">+</div>
									<button class="btn btn-primary btn-lg" type="submit" value="" <?= !$this->detailProductItem->isAvailable() ? 'disabled' : '' ?> >
										<?= $enc->html( $this->translate( 'client', 'Add to basket' ), $enc::TRUST ); ?>
									</button>
								</div>
							</div>
						<?php endif ?>
					</form>
                    <?= $this->partial(
					/** client/html/catalog/partials/actions
					 * Relative path to the catalog actions partial template file
					 *
					 * Partials are templates which are reused in other templates and generate
					 * reoccuring blocks filled with data from the assigned values. The actions
					 * partial creates an HTML block for the product actions (pin, like and watch
					 * products).
					 *
					 * @param string Relative path to the template file
					 * @since 2017.04
					 * @category Developer
					 */
					$this->config( 'client/html/catalog/partials/actions', 'catalog/actions-partial-standard' ),
					['productItem' => $this->detailProductItem]
				); ?>


				<?= $this->partial(
					/** client/html/catalog/partials/social
					 * Relative path to the social partial template file
					 *
					 * Partials are templates which are reused in other templates and generate
					 * reoccuring blocks filled with data from the assigned values. The social
					 * partial creates an HTML block for links to social platforms in the
					 * catalog components.
					 *
					 * @param string Relative path to the template file
					 * @since 2017.04
					 * @category Developer
					 */
					$this->config( 'client/html/catalog/partials/social', 'catalog/social-partial-standard' ),
					['productItem' => $this->detailProductItem]
				); ?>

			</div>
                                  
							</div>
                  
                        
                                </div>
                                <div class="product-var__item">
                                    <a href="#modalAddCart" data-toggle="modal" data-dismiss="modal" class="btn btn--long btn--radius-tiny btn--green btn--green-hover-black btn--uppercase btn--weight m-r-20">Add to cart</a>
                                    <a href="wishlist.html" class="btn btn--round btn--round-size-small btn--green btn--green-hover-black"><i class="fas fa-heart"></i></a>
                                </div>
                                <div class="product-var__item">
                                    <div class="dynmiac_checkout--button">
                                        <input type="checkbox" id="buy-now-check" value="1" class="p-r-30">
                                        <label for="buy-now-check" class="m-b-20">I agree with the terms and condition</label>
                                        <a href="cart.html" class="btn btn--block btn--long btn--radius-tiny btn--green btn--green-hover-black text-uppercase m-r-35">Buy It Now</a>
                                    </div>
                                </div>
                                <div class="product-var__item">
                                    <span class="product-var__text">Guaranteed safe checkout </span>
                                    <ul class="payment-icon m-t-5">
                                        <li><img src="assets/img/icon/payment/paypal.svg" alt=""></li>
                                        <li><img src="assets/img/icon/payment/amex.svg" alt=""></li>
                                        <li><img src="assets/img/icon/payment/ipay.svg" alt=""></li>
                                        <li><img src="assets/img/icon/payment/visa.svg" alt=""></li>
                                        <li><img src="assets/img/icon/payment/shoify.svg" alt=""></li>
                                        <li><img src="assets/img/icon/payment/mastercard.svg" alt=""></li>
                                        <li><img src="assets/img/icon/payment/gpay.svg" alt=""></li>
                                    </ul>
                                </div>
                                
                                <div class="product-var__item d-flex align-items-center">
                                    <span class="product-var__text">Share: </span>
                                    <ul class="product-social m-l-20">
                                        <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fab fa-pinterest-p"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Product Details Gallery -->

        <!-- Start Product Details Tab -->
        <div class="product-details-tab-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="product-details-content">
                            <ul class="tablist tablist--style-black tablist--style-title tablist--style-gap-30 nav">
                                <li><a class="nav-link active" data-toggle="tab" href="#product-desc"><?= $enc->html( $this->translate( 'client', 'Description' ), $enc::TRUST ); ?></a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#product-dis">Product Details</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#product-review"><?= $enc->html( $this->translate( 'client', 'Reviews' ), $enc::TRUST ) ?></a></li>
                            </ul>
                            <div class="product-details-tab-box">
                                <div class="tab-content">
                                    <!-- Start Tab - Product Description -->
                                    <div class="tab-pane show active" id="product-desc">
                                        <div class="para__content">
                                        <?php if( !( $textItems = $this->detailProductItem->getRefItems( 'text', 'long' ) )->isEmpty() ) : ?>
                                            <?php foreach( $textItems as $textItem ) : ?>
                                            <div class="long item">
                                             <?= $enc->html( $textItem->getContent(), $enc::TRUST ); ?></div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        </div>    
                                    </div>
                                  
                                    <!-- End Tab - Product Description -->

                                    <!-- Start Tab - Product Details -->
                                    <?php if( !$this->get( 'detailAttributeMap', map() )->isEmpty() || !$this->get( 'detailPropertyMap', map() )->isEmpty() ) : ?>
                                    <div class="tab-pane" id="product-dis">
                                        <div class="product-dis__content">
                                            
                                            <div class="table-responsive-md">
                                                <table class="product-dis__list table table-bordered">
                                                    <tbody>
                                                    <?php foreach( $this->get( 'detailAttributeMap', map() ) as $type => $attrItems ) : ?>
											        <?php foreach( $attrItems as $attrItem ) : ?>

												    <tr class="item <?= ( $id = $attrItem->get( 'parent' ) ) ? 'subproduct subproduct-' . $id : '' ?>">
                                                    <td class="product-dis__title"><?= $enc->html( $this->translate( 'client/code', $type ), $enc::TRUST ); ?></td>
                                                    <td class="product-dis__text">
														<div class="media-list">

															<?php foreach( $attrItem->getListItems( 'media', 'icon' ) as $listItem ) : ?>
																<?php if( ( $refitem = $listItem->getRefItem() ) !== null ) : ?>
																	<?= $this->partial(
																		$this->config( 'client/html/common/partials/media', 'common/partials/media-standard' ),
																		['item' => $refitem, 'boxAttributes' => ['class' => 'media-item']]
																	); ?>
																<?php endif; ?>
															<?php endforeach; ?>

														</div><!--
														--><span class="attr-name"><?= $enc->html( $attrItem->getName() ); ?></span>

														<?php foreach( $attrItem->getRefItems( 'text', 'short' ) as $textItem ) : ?>
															<div class="attr-short"><?= $enc->html( $textItem->getContent() ); ?></div>
														<?php endforeach ?>

														<?php foreach( $attrItem->getRefItems( 'text', 'long' ) as $textItem ) : ?>
															<div class="attr-long"><?= $enc->html( $textItem->getContent() ); ?></div>
														<?php endforeach ?>

													</td>
                                                    <?php endforeach; ?>
										            <?php endforeach; ?>
                                                     
                                                    <?php foreach( $this->get( 'detailPropertyMap', map() ) as $type => $propItems ) : ?>
											        <?php foreach( $propItems as $propItem ) : ?>

												        <tr class="item <?= ( $id = $propItem->get( 'parent' ) ) ? 'subproduct subproduct-' . $id : '' ?>">
													        <td class="name"><?= $enc->html( $this->translate( 'client/code', $propItem->getType() ), $enc::TRUST ); ?></td>
													        <td class="value"><?= $enc->html( $propItem->getValue() ); ?></td>
												        </tr>

											        <?php endforeach; ?>
										            <?php endforeach; ?>
    
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        
					                <?php endif; ?>
                                    </div>  <!-- End Tab - Product Details -->
                                    <?php if( !( $mediaItems = $this->detailProductItem->getRefItems( 'media', 'download' ) )->isEmpty() ) : ?>

<div class="additional-box">
    <h2 class="header downloads"><?= $enc->html( $this->translate( 'client', 'Downloads' ), $enc::TRUST ); ?></h2>
    <ul class="content downloads">

        <?php foreach( $mediaItems as $id => $item ) : ?>

            <li class="item">
                <a href="<?= $this->content( $item->getUrl() ); ?>" title="<?= $enc->attr( $item->getName() ); ?>">
                    <img class="media-image"
                        src="<?= $this->content( $item->getPreview() ); ?>"
                        alt="<?= $enc->attr( $item->getName() ); ?>"
                    />
                    <span class="media-name"><?= $enc->html( $item->getName() ); ?></span>
                </a>
            </li>

        <?php endforeach; ?>

    </ul>
</div>

<?php endif; ?>
                                    <!-- Start Tab - Product Review -->
                                    <div class="tab-pane " id="product-review">
                                        <!-- Start - Review Comment -->
                                        <ul class="comment">
                                            <!-- Start - Review Comment list-->
                                            <li class="comment__list">
                                                <div class="comment__wrapper">
                                                    <div class="comment__img">
                                                        <img src="assets/img/user/image-1.png" alt=""> 
                                                    </div>
                                                    <div class="comment__content">
                                                        <div class="comment__content-top">
                                                            <div class="comment__content-left">
                                                                <h6 class="comment__name">Kaedyn Fraser</h6>
                                                                <ul class="product__review">
                                                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                                                <li class="product__review--blank"><i class="icon-star"></i></li>
                                                            </ul>
                                                            </div>   
                                                            <div class="comment__content-right">
                                                                <a href="#" class="link--gray link--icon-left m-b-5"><i class="fas fa-reply"></i>Reply</a>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="para__content">
                                                            <p class="para__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Start - Review Comment Reply-->
                                                <ul class="comment__reply">
                                                    <li class="comment__reply-list">
                                                        <div class="comment__wrapper">
                                                            <div class="comment__img">
                                                                <img src="assets/img/user/image-2.png" alt=""> 
                                                            </div>
                                                            <div class="comment__content">
                                                                <div class="comment__content-top">
                                                                    <div class="comment__content-left">
                                                                        <h6 class="comment__name">Oaklee Odom</h6>
                                                                    </div>   
                                                                    <div class="comment__content-right">
                                                                        <a href="#" class="link--gray link--icon-left m-b-5"><i class="fas fa-reply"></i>Reply</a>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="para__content">
                                                                    <p class="para__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat. </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul> <!-- End - Review Comment Reply-->
                                            </li> <!-- End - Review Comment list-->
                                            <!-- Start - Review Comment list-->
                                            <li class="comment__list">
                                                <div class="comment__wrapper">
                                                    <div class="comment__img">
                                                        <img src="assets/img/user/image-3.png" alt=""> 
                                                    </div>
                                                    <div class="comment__content">
                                                        <div class="comment__content-top">
                                                            <div class="comment__content-left">
                                                                <h6 class="comment__name">Jaydin Jones</h6>
                                                                <ul class="product__review">
                                                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                                                <li class="product__review--blank"><i class="icon-star"></i></li>
                                                            </ul>
                                                            </div>   
                                                            <div class="comment__content-right">
                                                                <a href="#" class="link--gray link--icon-left m-b-5"><i class="fas fa-reply"></i>Reply</a>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="para__content">
                                                            <p class="para__text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora inventore dolorem a unde modi iste odio amet, fugit fuga aliquam, voluptatem maiores animi dolor nulla magnam ea! Dignissimos aspernatur cumque nam quod sint provident modi alias culpa, inventore deserunt accusantium amet earum soluta consequatur quasi eum eius laboriosam, maiores praesentium explicabo enim dolores quaerat! Voluptas ad ullam quia odio sint sunt. Ipsam officia, saepe repellat. </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> <!-- End - Review Comment list-->
                                        </ul>  <!-- End - Review Comment -->

                                        <!-- Start Add Review Form-->
                                        <div class="review-form m-t-40">
                                            <div class="section-content">
                                                <h6 class="font--bold text-uppercase">ADD A REVIEW</h6>
                                                <p class="section-content__desc">Your email address will not be published. Required fields are marked *</p>
                                            </div>
                                            <form class="form-box" action="#" method="post">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-box__single-group">
                                                            <label for="form-name">Your Rating*</label>
                                                            <ul class="product__review">
                                                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                                                <li class="product__review--fill"><i class="icon-star"></i></li>
                                                                <li class="product__review--blank"><i class="icon-star"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-box__single-group">
                                                            <label for="form-name">Your Name*</label>
                                                            <input type="text" id="form-name" placeholder="Enter your name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-box__single-group">
                                                            <label for="form-email">Your Email*</label>
                                                            <input type="email" id="form-email" placeholder="Enter your email" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-box__single-group">
                                                            <label for="form-review">Your review*</label>
                                                            <textarea id="form-review" rows="8" placeholder="Write a review"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button class="btn btn--box btn--small btn--black btn--black-hover-green btn--uppercase font--bold m-t-30" type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div> <!-- End Add Review Form- -->
                                    </div>  <!-- Start Tab - Product Review -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  <!-- End Product Details Tab -->

        <!-- ::::::  Start  Product Style - Default Section  ::::::  -->
        <div class="product m-t-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                         <!-- Start Section Title -->
                        <div class="section-content section-content--border m-b-35">
                            <h5 class="section-content__title">Related Product
                            </h5>

                            <a href="shop-sidebar-grid-left.html" class="btn btn--icon-left btn--small btn--radius btn--transparent btn--border-green btn--border-green-hover-green font--regular text-capitalize">More Products<i class="fal fa-angle-right"></i></a>
                        </div>  <!-- End Section Title -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="default-slider default-slider--hover-bg-red product-default-slider">
                            <div class="product-default-slider-4grid-1rows gap__col--30 gap__row--40">

                                <!-- Start Single Default Product -->
                                <div class="product__box product__default--single text-center">
                                    <!-- Start Product Image -->
                                    <div class="product__img-box  pos-relative">
                                        <a href="product-single-default.html" class="product__img--link">
                                            <img class="product__img img-fluid" src="assets/img/product/size-normal/product-home-1-img-1.jpg" alt="">
                                        </a>
                                        <!-- Start Procuct Label -->
                                        <span class="product__label product__label--sale-dis">-34%</span>
                                        <!-- End Procuct Label -->
                                        <!-- Start Product Action Link-->
                                        <ul class="product__action--link pos-absolute">
                                            <li><a href="#modalAddCart" data-toggle="modal"><i class="icon-shopping-cart"></i></a></li>
                                            <li><a href="compare.html"><i class="icon-sliders"></i></a></li>
                                            <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                            <li><a href="#modalQuickView" data-toggle="modal"><i class="icon-eye"></i></a></li>
                                        </ul> <!-- End Product Action Link -->
                                    </div> <!-- End Product Image -->
                                    <!-- Start Product Content -->
                                    <div class="product__content m-t-20">
                                        <ul class="product__review">
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--blank"><i class="icon-star"></i></li>
                                        </ul>
                                        <a href="product-single-default.html" class="product__link">Fresh green vegetable</a>
                                        <div class="product__price m-t-5">
                                            <span class="product__price">$19.00 <del>$29.00</del></span>
                                        </div>
                                    </div> <!-- End Product Content -->
                                </div> <!-- End Single Default Product -->
                                
                                <!-- Start Single Default Product -->
                                <div class="product__box product__default--single text-center">
                                    <!-- Start Product Image -->
                                    <div class="product__img-box  pos-relative">
                                        <a href="product-single-default.html" class="product__img--link">
                                            <img class="product__img img-fluid" src="assets/img/product/size-normal/product-home-1-img-2.jpg" alt="">
                                        </a>
                                        <!-- Start Product Action Link-->
                                        <ul class="product__action--link pos-absolute">
                                            <li><a href="#modalAddCart" data-toggle="modal"><i class="icon-shopping-cart"></i></a></li>
                                            <li><a href="compare.html"><i class="icon-sliders"></i></a></li>
                                            <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                            <li><a href="#modalQuickView" data-toggle="modal"><i class="icon-eye"></i></a></li>
                                        </ul> <!-- End Product Action Link -->
                                    </div> <!-- End Product Image -->
                                    <!-- Start Product Content -->
                                    <div class="product__content m-t-20">
                                        <ul class="product__review">
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--blank"><i class="icon-star"></i></li>
                                        </ul>
                                        <a href="product-single-default.html" class="product__link">Fresh river fish</a>
                                        <div class="product__price m-t-5">
                                            <span class="product__price">$25.00</span>
                                        </div>
                                    </div> <!-- End Product Content -->
                                </div> <!-- End Single Default Product -->
                                
                                <!-- Start Single Default Product -->
                                <div class="product__box product__default--single text-center">
                                    <!-- Start Product Image -->
                                    <div class="product__img-box  pos-relative">
                                        <a href="product-single-default.html" class="product__img--link">
                                            <img class="product__img img-fluid" src="assets/img/product/size-normal/product-home-1-img-3.jpg" alt="">
                                        </a>
                                        <!-- Start Procuct Label -->
                                        <span class="product__label product__label--sale-dis">-10%</span>
                                        <!-- End Procuct Label -->
                                        <!-- Start Product Countdown -->
                                        <div class="product__counter-box">
                                            <div class="product__counter-item" data-countdown="2023/09/27"></div>
                                        </div> <!-- End Product Countdown -->
                                        <!-- Start Product Action Link-->
                                        <ul class="product__action--link pos-absolute">
                                            <li><a href="#modalAddCart" data-toggle="modal"><i class="icon-shopping-cart"></i></a></li>
                                            <li><a href="compare.html"><i class="icon-sliders"></i></a></li>
                                            <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                            <li><a href="#modalQuickView" data-toggle="modal"><i class="icon-eye"></i></a></li>
                                        </ul> <!-- End Product Action Link -->
                                    </div> <!-- End Product Image -->
                                    <!-- Start Product Content -->
                                    <div class="product__content m-t-20">
                                        <ul class="product__review">
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--blank"><i class="icon-star"></i></li>
                                        </ul>
                                        <a href="product-single-default.html" class="product__link">Fresh pomegranate</a>
                                        <div class="product__price m-t-5">
                                            <span class="product__price">$19.00 <del>$21.00</del></span>
                                        </div>
                                    </div> <!-- End Product Content -->
                                </div> <!-- End Single Default Product -->
                                
                                <!-- Start Single Default Product -->
                                <div class="product__box product__default--single text-center">
                                    <!-- Start Product Image -->
                                    <div class="product__img-box  pos-relative">
                                        <a href="product-single-default.html" class="product__img--link">
                                            <img class="product__img img-fluid" src="assets/img/product/size-normal/product-home-1-img-4.jpg" alt="">
                                        </a>
                                        <!-- Start Product Action Link-->
                                        <ul class="product__action--link pos-absolute">
                                            <li><a href="#modalAddCart" data-toggle="modal"><i class="icon-shopping-cart"></i></a></li>
                                            <li><a href="compare.html"><i class="icon-sliders"></i></a></li>
                                            <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                            <li><a href="#modalQuickView" data-toggle="modal"><i class="icon-eye"></i></a></li>
                                        </ul> <!-- End Product Action Link -->
                                    </div> <!-- End Product Image -->
                                    <!-- Start Product Content -->
                                    <div class="product__content m-t-20">
                                        <ul class="product__review">
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--blank"><i class="icon-star"></i></li>
                                        </ul>
                                        <a href="product-single-default.html" class="product__link">Cabbage vegetables</a>
                                        <div class="product__price m-t-5">
                                            <span class="product__price">$50.00</span>
                                        </div>
                                    </div> <!-- End Product Content -->
                                </div> <!-- End Single Default Product -->
                                
                                <!-- Start Single Default Product -->
                                <div class="product__box product__default--single text-center">
                                    <!-- Start Product Image -->
                                    <div class="product__img-box  pos-relative">
                                        <a href="product-single-default.html" class="product__img--link">
                                            <img class="product__img img-fluid" src="assets/img/product/size-normal/product-home-1-img-5.jpg" alt="">
                                        </a>
                                        <!-- Start Procuct Label -->
                                        <span class="product__label product__label--sale-dis">-31%</span>
                                        <!-- End Procuct Label -->
                                        <!-- Start Product Action Link-->
                                        <ul class="product__action--link pos-absolute">
                                            <li><a href="#modalAddCart" data-toggle="modal"><i class="icon-shopping-cart"></i></a></li>
                                            <li><a href="compare.html"><i class="icon-sliders"></i></a></li>
                                            <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                            <li><a href="#modalQuickView" data-toggle="modal"><i class="icon-eye"></i></a></li>
                                        </ul> <!-- End Product Action Link -->
                                    </div> <!-- End Product Image -->
                                    <!-- Start Product Content -->
                                    <div class="product__content m-t-20">
                                        <ul class="product__review">
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--blank"><i class="icon-star"></i></li>
                                        </ul>
                                        <a href="product-single-default.html" class="product__link">Best red meat</a>
                                        <div class="product__price m-t-5">
                                            <span class="product__price">$55.00 <del>$80.00</del></span>
                                        </div>
                                    </div> <!-- End Product Content -->
                                </div> <!-- End Single Default Product -->
                                
                                <!-- Start Single Default Product -->
                                <div class="product__box product__default--single text-center">
                                    <!-- Start Product Image -->
                                    <div class="product__img-box  pos-relative">
                                        <a href="product-single-default.html" class="product__img--link">
                                            <img class="product__img img-fluid" src="assets/img/product/size-normal/product-home-1-img-6.jpg" alt="">
                                        </a>
                                        <!-- Start Procuct Label -->
                                        <span class="product__label product__label--sale-dis">-34%</span>
                                        <!-- End Procuct Label -->
                                        <!-- Start Product Action Link-->
                                        <ul class="product__action--link pos-absolute">
                                            <li><a href="#modalAddCart" data-toggle="modal"><i class="icon-shopping-cart"></i></a></li>
                                            <li><a href="compare.html"><i class="icon-sliders"></i></a></li>
                                            <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                            <li><a href="#modalQuickView" data-toggle="modal"><i class="icon-eye"></i></a></li>
                                        </ul> <!-- End Product Action Link -->
                                    </div> <!-- End Product Image -->
                                    <!-- Start Product Content -->
                                    <div class="product__content m-t-20">
                                        <ul class="product__review">
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--blank"><i class="icon-star"></i></li>
                                        </ul>
                                        <a href="product-single-default.html" class="product__link">Fresh green apple</a>
                                        <div class="product__price m-t-5">
                                            <span class="product__price">$19.00 <del>$29.00</del></span>
                                        </div>
                                    </div> <!-- End Product Content -->
                                </div> <!-- End Single Default Product -->
                                
                                <!-- Start Single Default Product -->
                                <div class="product__box product__default--single text-center">
                                    <!-- Start Product Image -->
                                    <div class="product__img-box  pos-relative">
                                        <a href="product-single-default.html" class="product__img--link">
                                            <img class="product__img img-fluid" src="assets/img/product/size-normal/product-home-1-img-7.jpg" alt="">
                                        </a>
                                        <!-- Start Procuct Label -->
                                        <span class="product__label product__label--sale-dis">-34%</span>
                                        <!-- End Procuct Label -->
                                        <!-- Start Product Action Link-->
                                        <ul class="product__action--link pos-absolute">
                                            <li><a href="#modalAddCart" data-toggle="modal"><i class="icon-shopping-cart"></i></a></li>
                                            <li><a href="compare.html"><i class="icon-sliders"></i></a></li>
                                            <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                            <li><a href="#modalQuickView" data-toggle="modal"><i class="icon-eye"></i></a></li>
                                        </ul> <!-- End Product Action Link -->
                                    </div> <!-- End Product Image -->
                                    <!-- Start Product Content -->
                                    <div class="product__content m-t-20">
                                        <ul class="product__review">
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--blank"><i class="icon-star"></i></li>
                                        </ul>
                                        <a href="product-single-default.html" class="product__link">Juice fresh orange</a>
                                        <div class="product__price m-t-5">
                                            <span class="product__price">$19.00 <del>$29.00</del></span>
                                        </div>
                                    </div> <!-- End Product Content -->
                                </div> <!-- End Single Default Product -->
                                
                                <!-- Start Single Default Product -->
                                <div class="product__box product__default--single text-center">
                                    <!-- Start Product Image -->
                                    <div class="product__img-box  pos-relative">
                                        <a href="product-single-default.html" class="product__img--link">
                                            <img class="product__img img-fluid" src="assets/img/product/size-normal/product-home-1-img-8.jpg" alt="">
                                        </a>
                                        <!-- Start Procuct Label -->
                                        <span class="product__label product__label--sale-dis">-35%</span>
                                        <!-- End Procuct Label -->
                                        <!-- Start Product Countdown -->
                                        <div class="product__counter-box">
                                            <div class="product__counter-item" data-countdown="2021/03/01"></div>
                                        </div> <!-- End Product Countdown -->
                                        <!-- Start Product Action Link-->
                                        <ul class="product__action--link pos-absolute">
                                            <li><a href="#modalAddCart" data-toggle="modal"><i class="icon-shopping-cart"></i></a></li>
                                            <li><a href="compare.html"><i class="icon-sliders"></i></a></li>
                                            <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                            <li><a href="#modalQuickView" data-toggle="modal"><i class="icon-eye"></i></a></li>
                                        </ul> <!-- End Product Action Link -->
                                    </div> <!-- End Product Image -->
                                    <!-- Start Product Content -->
                                    <div class="product__content m-t-20">
                                        <ul class="product__review">
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--blank"><i class="icon-star"></i></li>
                                        </ul>
                                        <a href="product-single-default.html" class="product__link">Best ripe grapes</a>
                                        <div class="product__price m-t-5">
                                            <span class="product__price">$39.00 <del>$60.00</del></span>
                                        </div>
                                    </div> <!-- End Product Content -->
                                </div> <!-- End Single Default Product -->

                                <!-- Start Single Default Product -->
                                <div class="product__box product__default--single text-center">
                                    <!-- Start Product Image -->
                                    <div class="product__img-box  pos-relative">
                                        <a href="product-single-default.html" class="product__img--link">
                                            <img class="product__img img-fluid" src="assets/img/product/size-normal/product-home-1-img-9.jpg" alt="">
                                        </a>
                                        <!-- Start Procuct Label -->
                                        <span class="product__label product__label--sale-out">Soldout</span>
                                        <!-- End Procuct Label -->
                                        <!-- Start Product Action Link-->
                                        <ul class="product__action--link pos-absolute">
                                            <li><a href="#modalAddCart" data-toggle="modal"><i class="icon-shopping-cart"></i></a></li>
                                            <li><a href="compare.html"><i class="icon-sliders"></i></a></li>
                                            <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                            <li><a href="#modalQuickView" data-toggle="modal"><i class="icon-eye"></i></a></li>
                                        </ul> <!-- End Product Action Link -->
                                    </div> <!-- End Product Image -->
                                    <!-- Start Product Content -->
                                    <div class="product__content m-t-20">
                                        <ul class="product__review">
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--blank"><i class="icon-star"></i></li>
                                        </ul>
                                        <a href="product-single-default.html" class="product__link">Cow fresh milk</a>
                                        <div class="product__price m-t-5">
                                            <span class="product__price">$55.00 <del>$75.00</del></span>
                                        </div>
                                    </div> <!-- End Product Content -->
                                </div> <!-- End Single Default Product -->
                                
                                <!-- Start Single Default Product -->
                                <div class="product__box product__default--single text-center">
                                    <!-- Start Product Image -->
                                    <div class="product__img-box  pos-relative">
                                        <a href="product-single-default.html" class="product__img--link">
                                            <img class="product__img img-fluid" src="assets/img/product/size-normal/product-home-1-img-10.jpg" alt="">
                                        </a>
                                        <!-- Start Procuct Label -->
                                        <span class="product__label product__label--sale-out">Soldout</span>
                                        <!-- End Procuct Label -->
                                        <!-- Start Product Action Link-->
                                        <ul class="product__action--link pos-absolute">
                                            <li><a href="#modalAddCart" data-toggle="modal"><i class="icon-shopping-cart"></i></a></li>
                                            <li><a href="compare.html"><i class="icon-sliders"></i></a></li>
                                            <li><a href="wishlist.html"><i class="icon-heart"></i></a></li>
                                            <li><a href="#modalQuickView" data-toggle="modal"><i class="icon-eye"></i></a></li>
                                        </ul> <!-- End Product Action Link -->
                                    </div> <!-- End Product Image -->
                                    <!-- Start Product Content -->
                                    <div class="product__content m-t-20">
                                        <ul class="product__review">
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--fill"><i class="icon-star"></i></li>
                                            <li class="product__review--blank"><i class="icon-star"></i></li>
                                        </ul>
                                        <a href="product-single-default.html" class="product__link">Fresh Red Tomato</a>
                                        <div class="product__price m-t-5">
                                            <span class="product__price">$10.00</span>
                                        </div>
                                    </div> <!-- End Product Content -->
                                </div> <!-- End Single Default Product -->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- ::::::  End  Product Style - Default Section  ::::::  -->

        <!-- ::::::  Start  Company Logo Section  ::::::  -->
        <div class="company-logo m-t-100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="company-logo__area default-slider">
                            <!-- Start Single Company Logo Item -->
                            <div class="company-logo__item">
                                <a href="#" class="company-logo__link">
                                    <img src="assets/img/company-logo/company-logo-1.png" alt="" class="company-logo__img">
                                </a>
                            </div> <!-- End Single Company Logo Item -->
                            <!-- Start Single Company Logo Item -->
                            <div class="company-logo__item">
                                <a href="#" class="company-logo__link">
                                    <img src="assets/img/company-logo/company-logo-2.png" alt="" class="company-logo__img">
                                </a>
                            </div> <!-- End Single Company Logo Item -->
                            <!-- Start Single Company Logo Item -->
                            <div class="company-logo__item">
                                <a href="#" class="company-logo__link">
                                    <img src="assets/img/company-logo/company-logo-3.png" alt="" class="company-logo__img">
                                </a>
                            </div> <!-- End Single Company Logo Item -->
                            <!-- Start Single Company Logo Item -->
                            <div class="company-logo__item">
                                <a href="#" class="company-logo__link">
                                    <img src="assets/img/company-logo/company-logo-4.png" alt="" class="company-logo__img">
                                </a>
                            </div> <!-- End Single Company Logo Item -->
                            <!-- Start Single Company Logo Item -->
                            <div class="company-logo__item">
                                <a href="#" class="company-logo__link">
                                    <img src="assets/img/company-logo/company-logo-5.png" alt="" class="company-logo__img">
                                </a>
                            </div> <!-- End Single Company Logo Item -->
                            <!-- Start Single Company Logo Item -->
                            <div class="company-logo__item">
                                <a href="#" class="company-logo__link">
                                    <img src="assets/img/company-logo/company-logo-6.png" alt="" class="company-logo__img">
                                </a>
                            </div> <!-- End Single Company Logo Item -->
                            <!-- Start Single Company Logo Item -->
                            <div class="company-logo__item">
                                <a href="#" class="company-logo__link">
                                    <img src="assets/img/company-logo/company-logo-7.png" alt="" class="company-logo__img">
                                </a>
                            </div> <!-- End Single Company Logo Item -->
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- ::::::  End  Company Logo Section  ::::::  -->
        
    </main>  <!-- :::::: End MainContainer Wrapper :::::: -->


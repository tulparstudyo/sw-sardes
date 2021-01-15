<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2016-2020
 */

$enc = $this->encoder();


?>
<?php $this->block()->start( 'catalog/detail/service' ); ?>

<div class="row">
                            <div class="col-12">
                                <ul class="shipping-info-list m-tb-30">
                                    <li><strong>Shipping</strong></li>
									<?php foreach( $this->get( 'serviceItems', [] ) as $item ) : ?>
									<li>
										<span class="service-name"><?= $enc->html( $item->getName() ); ?></span>
									 <?= $this->partial(
									$this->config( 'client/html/common/partials/price', 'common/partials/price-standard' ),
									array( 'prices' => $item->getRefItems( 'price', null, 'default' ), 'costsItem' => false )
									); ?> 
					
					
									<?php foreach( $item->getRefItems( 'text', 'short', 'default' ) as $textItem ) : ?>
									<span class="service-short"><?= $enc->html( $textItem->getContent() ); ?></span>
									<?php endforeach; ?>
									</li
									><?php endforeach; ?>
                                    
                                </ul>
                                <ul class="shipping-info-list">
                                    <li><strong>Returns And Exchanges</strong></li>
                                    <li>Easy and complimentary, within 14 days</li>
                                    <li>See conditions and procedure in our return FAQs</li>
                                </ul>
                            </div>
                        </div>
<?php $this->block()->stop(); ?>


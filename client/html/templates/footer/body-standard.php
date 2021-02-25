<?php
$enc = $this->encoder();
?>
</div><div class="kenne-footer_area bg-white_color">
    <div class="footer-top_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row footer-widgets_wrap">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-widgets_title">
                                <h4>
                                    <?=$this->translate( 'client', 'Shopping' )?>
                                </h4>
                            </div>
                            <div class="footer-widgets">
                                <ul>
                                    <li><a href="<?= $enc->attr( $this->url( 'about-us', null, null,[], []) ); ?>">
                                        <?=$this->translate( 'client', 'About Us' )?>
                                        </a></li>
                                    <li><a href="#" class="b24-web-form-popup-btn-3">
                                        <?=$this->translate( 'client', 'Contact Us' )?>
                                        </a></li>
                                        <li><a href="<?=$enc->attr( $this->url( 'blog', null, 'null', [  'blog_code'=>'terms-conditions'], [], [] ) )?>" > <?=$this->translate( 'client', 'Terms & Conditions' )?></a></li>
                                    <li><a href="<?=$enc->attr( $this->url( 'blog', null, 'null', [ 'blog_code'=>'privacy-policy'], [], [] ) )?>">
                                        <?=$this->translate( 'client', 'Privacy & Policy' )?>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-widgets_title">
                                <h4>
                                    <?=$this->translate( 'client', 'Account' )?>
                                </h4>
                            </div>
                            <div class="footer-widgets">
                                <ul>
                                    <li><a href="<?=$enc->attr( $this->url( 'login', null, 'null', ['locale'=> \Route::current()->parameter('locale','ru'), 'currency'=> \Route::current()->parameter('currency','RUB')], [], [] ) )?>">
                                             <?=$this->translate( 'client', 'Login' )?>
                                        </a></li>
                                    <li><a href="<?=$enc->attr( $this->url( 'login', null, 'null', ['locale'=> \Route::current()->parameter('locale','ru'), 'currency'=> \Route::current()->parameter('currency','RUB')], [], [] ) )?>">
                                        <?=$this->translate( 'client', 'Register' )?>
                                        </a></li>
                                        <li><a href="<?=$enc->attr( $this->url( 'blog', null, 'null', [ 'blog_code'=>'help'], [], [] ) )?>">
                                        <?=$this->translate( 'client', 'Help' )?>
                                        </a></li>
                                    <li><a href="<?=$enc->attr( $this->url( 'blog', null, 'null', [ 'blog_code'=>'support'], [], [] ) )?>">
                                        <?=$this->translate( 'client', 'Support' )?>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="footer-widgets_title">
                                <h4>
                                    <?=$this->translate( 'client', 'Categories' )?>
                                </h4>
                            </div>
                            <div class="footer-widgets">
                                <?php echo  sardes_top_categories(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6"><?php echo sardes_widget('mailchimp'); ?></div>
                <?php echo sardes_widget('bitrix24'); ?>
            </div>
        </div>
    </div>
    <div class="footer-bottom_area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="copyright"> <span><?php /*SwH::storeInfo('copyright');*/?></span></div>
                </div>
                <div class="col-md-6">
                    <div class="payment"> <img src="
						<?=sardes_url('/assets/img/footer/payment/1.png')?>" alt="Kenne's Payment Method"> </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Kenne's Footer Area End Here --> 
<!-- Scroll To Top Start --> 
<a class="scroll-to-top" href=""><i class="ion-chevron-up"></i></a> 
<!-- Scroll To Top End --> 


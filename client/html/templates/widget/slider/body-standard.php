<?php
$enc = $this->encoder();
$data = \Aimeos\Shop\Facades\Shop::get('swordbros/slider')->addData($this);
?>
<!-- ::::::  Start Hero Section  ::::::  -->
<div class="hero slider-dot-fix slider-dot slider-dot-fix slider-dot--center slider-dot-size--medium slider-dot-circle  slider-dot-style--fill slider-dot-style--fill-white-active-green dot-gap__X--10"> 
	<?php foreach($data->items as $item){ ?>
  <!-- Start Single Hero Slide -->
  <div class="hero-slider"> <img src="<?=$item['image_url']?>" alt="">
    <div class="hero__content">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-8">
            <div class="hero__content--inner">
              <h4 class="title__hero title__hero--small font--regular"><?=$item['content']?></h4>
              <a href="/<?=$item['url']?>" class="btn btn--large btn--radius btn--black btn--black-hover-green font--bold text-uppercase"><?= $this->translate( 'client', 'Shop now'); ?></a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Single Hero Slide -->
	<?php } ?>
</div>
<!-- ::::::  End Hero Section  ::::::  --> 
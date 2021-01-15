<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2020
 */

$enc = $this->encoder();
$pos = 0;
sardes_options();
?>
<!-- :::::: Start Main Container Wrapper :::::: -->
<main id="main-container" class="main-container">
<?php 
	if(sardes_option('show_slider')){
		echo sardes_widget('slider');
	}
?>
<?php echo sardes_widget('top-banner');?>

<?php if(sardes_option('show_top_categories')){
		echo sardes_widget('top-categories');
	}?>
<?php if(sardes_option('show_top_products')){
		echo sardes_widget('top-products');
	} ?>
<?php echo sardes_widget('special-discount');?>
<?php if(sardes_option('show_new_products')){
		echo sardes_widget('new-products');
	} ?>
<?php if(sardes_option('show_client_says')){
		echo sardes_widget('testimonials');
	} ?>
<?php if(sardes_option('show_latest_news')){
		echo sardes_widget('latest-news');
	} ?>
<?php if(sardes_option('show_subscribe_form')){
		echo sardes_widget('newsletter');
	}  ?>
<?php if(sardes_option('show_logo_slider')){
		echo sardes_widget('logo-slider');
	}?>
</main>  
<!-- :::::: End MainContainer Wrapper :::::: -->

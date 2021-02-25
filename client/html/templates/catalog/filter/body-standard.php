<?php
/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Metaways Infosystems GmbH, 2012
 * @copyright Aimeos (aimeos.org), 2015-2020
 */
$enc = $this->encoder();

$listTarget = $this->config( 'client/html/catalog/lists/url/target' );
$listController = $this->config( 'client/html/catalog/lists/url/controller', 'catalog' );
$listAction = $this->config( 'client/html/catalog/lists/url/action', 'list' );
$listConfig = $this->config( 'client/html/catalog/lists/url/config', [] );

$optTarget = $this->config( 'client/jsonapi/url/target' );
$optCntl = $this->config( 'client/jsonapi/url/controller', 'jsonapi' );
$optAction = $this->config( 'client/jsonapi/url/action', 'options' );
$optConfig = $this->config( 'client/jsonapi/url/config', [] );
?>
<div id="catalog-filter" class="aimeos catalog-filter kenne-sidebar-catagories_area" data-jsonurl="<?= $enc->attr( $this->url( $optTarget, $optCntl, $optAction, [], [], $optConfig ) ); ?>">
	<?php if( isset( $this->filterErrorList ) ) : ?>
		<ul class="error-list">
			<?php foreach( (array) $this->filterErrorList as $errmsg ) : ?>
				<li class="error-item"><?= $enc->html( $errmsg ); ?></li>
			<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	<!-- <nav> -->

				
    <h5 class="widget-title line-bottom" style="display: none;"><?= $enc->html( $this->translate( 'client', 'Filter' ), $enc::TRUST ); ?></h5>
     
    <form method="GET" action="<?= $enc->attr( $this->url( $listTarget, $listController, $listAction, $this->get( 'filterParams', [] ), $listConfig ) ); ?>">
		<?= $this->block()->get( 'catalog/filter/search' ); ?>
		<?php $this->block()->get( 'catalog/filter/tree' ); ?>	
		<?php if ($this->param('f_catid')) : ?>
		<input type="hidden" name="f_catid" value="<?=$this->param('f_catid')?>" >
		<?php endif; ?>

	       	<div class="product-view-mode mobile" style="font-size: 25px">
                <a class="type-item type-grid grid-3 active" data-target="gridview-3" data-toggle="tooltip" data-placement="top" title="<?=$this->translate( 'client', 'Grid View' )?>"><i class="fa fa-th"></i></a>
                <a class="type-item type-list list" data-target="listview" data-toggle="tooltip" data-placement="top" title="<?=$this->translate( 'client', 'List View' )?> "><i class="fa fa-th-list"></i></a>
   	    		<button  type="button" class="buttonfilter"  data-target="catalog-filter" data-toggle="tooltip" 
	    		data-placement="top" title="Filter" ><i class="fa fa-filter" style="font-size: 27px"></i></button>
			<script type="text/javascript">
    			$('.buttonfilter').on('click', function(){
       			// $('.catalog-filter-attribute').toggleClass('show-mobile');
		 		$( ".catalog-filter-attribute , .catalog-filter-price" ).toggle( "blind", {}, 500 );
    		});
			</script>
            </div>
				<?= $this->block()->get( 'catalog/filter/price' ); ?>
				<?= $this->block()->get( 'catalog/filter/attribute' ); ?>
		</form>
</div>

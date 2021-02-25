@extends('shop::base')

@section('aimeos_scripts')
	@parent
    <script type="text/javascript" src="<?php echo asset( 'packages/aimeos/shop/themes/aimeos-detail.js' ); ?>"></script>
@stop

@section('aimeos_header')
    <?= $aiheader['locale/select'] ?? '' ?>
  
    <?= $aiheader['catalog/stage'] ?? '' ?>
    <?= $aiheader['catalog/detail'] ?? '' ?>

    <?= $aiheader['catalog/session'] ?? '' ?>
@stop

@section('locale_selector_module')
   <?= $aibody['locale/select'] ?> 
@stop


@section('top_search_module')
    <?= $aibody['catalog/search'] ?>
@stop

@section('aimeos_stage')
    <?= $aibody['catalog/stage'] ?? '' ?>
@stop
@section('basket_module')
    <?= $aibody['basket/mini'] ?>
    
@stop

@section('aimeos_body')
<?= $aibody['catalog/stage'] ?? '' ?>
    <?= $aibody['catalog/detail'] ?? '' ?>
  
@stop

@section('aimeos_aside')
    <?= $aibody['catalog/session'] ?? '' ?>
@stop

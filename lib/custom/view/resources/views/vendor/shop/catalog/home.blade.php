@extends('shop::base')

@section('aimeos_header')
    <?= $aiheader['locale/select'] ?? '' ?>  
 
@stop

@section('aimeos_head')
    <?= $aibody['locale/select'] ?? '' ?>
    <?= $aibody['basket/mini'] ?? '' ?>
@stop

@section('top_search_module')
    <?= $aibody['catalog/search'] ?>
@stop
@section('locale_selector_module')
   <?= $aibody['locale/select'] ?>
@stop

@section('basket_module')
    <?= $aibody['basket/mini'] ?>
    
@stop

@section('aimeos_body')
<?php  echo \Aimeos\Shop\Facades\Shop::get('swordbros/slider')->getBody(); ?>

<?php echo sardes_widget('quadruple'); ?>
    <?= $aibody['swordbros/featured'] ?>
    <?= $aibody['swordbros/recomended'] ?>
 <?= $aibody['swordbros/services'] ?> 
@endsection
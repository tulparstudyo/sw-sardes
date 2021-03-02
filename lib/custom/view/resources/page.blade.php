@extends('shop::base')


@section('aimeos_header')

    <?= $aiheader['locale/select'] ?>
@stop

@section('basket_module')
    <?= $aibody['basket/mini'] ?>  
@stop

@section('top_search_module')
    <?= $aibody['catalog/search'] ?>
@stop

@section('locale_selector_module')
   <?= $aibody['locale/select'] ?>
@stop

@section('aimeos_body')
   <?= $aiheader['swordbros/page'] ?>
   <?= $aibody['swordbros/page'] ?>

@endsection







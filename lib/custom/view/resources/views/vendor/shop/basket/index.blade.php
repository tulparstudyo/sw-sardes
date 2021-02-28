@extends('shop::base')

@section('aimeos_header')
  
    <?= $aiheader['basket/standard'] ?>

@stop


@section('top_search_module')
    <?= $aibody['catalog/search'] ?>
@stop
@section('locale_selector_module')
   <?= $aibody['locale/select'] ?>
@stop

@section('aimeos_body')
  <div class="kenne-cart-area">
            <div class="container">
                <div class="row">
                    <div class="col-12">

         
    <?= $aibody['basket/standard'] ?? '' ?>



                    </div>
                  </div>
                </div>
              </div>

@stop

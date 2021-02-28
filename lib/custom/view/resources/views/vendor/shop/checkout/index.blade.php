@extends('shop::base')

@section('aimeos_header')
     <?= $aiheader['checkout/standard'] ?>
@stop



@section('top_search_module')
    <?= $aibody['catalog/search'] ?>
@stop 

@section('locale_selector_module')
   <?= $aibody['locale/select'] ?>
@stop
@section('basket_module')
    <?= $aibody['basket/mini'] ?>
    <?= $aiheader['catalog/session'] ?>
@stop

@section('aimeos_body')
        <div class="checkout-area">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <?= $aibody['checkout/standard'] ?>
              </div>
            </div>
          </div>
        </div>
@stop





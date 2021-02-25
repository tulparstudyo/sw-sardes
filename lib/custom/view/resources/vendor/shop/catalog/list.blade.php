@extends('shop::base')

@section('aimeos_header')
    <?= $aiheader['basket/mini'] ?>
    <?= $aiheader['catalog/filter'] ?>
    <?= $aiheader['catalog/stage'] ?>
    <?= $aiheader['catalog/lists'] ?>
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
<?= $aibody['catalog/stage'] ?>

<div class="kenne-content_wrapper">
  <div class="container">
     <div class="row">
                    <div class="col-lg-3 order-1 order-lg-1">

                      
                        <div class="kenne-sidebar-catagories_area">
                          <?= $aibody['catalog/filter'] ?>
                           
                        </div>
                    </div>
                    <div class="col-lg-9 order-2 order-lg-2">

                      <?= $aibody['catalog/lists'] ?>
                       
                    </div>
                </div>
  </div>
</div>
@stop




@extends('shop::base')

@section('aimeos_header')
    <?= $aiheader['basket/mini'] ?>
    <?= $aiheader['account/profile'] ?>
    <?= $aiheader['account/subscription'] ?>
    <?= $aiheader['account/history'] ?>

    <?= $aiheader['account/favorite'] ?>
    <?= $aiheader['account/watch'] ?>
    <?= $aiheader['catalog/session'] ?>
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

@section('aimeos_styles')
<!--<link type="text/css" rel="stylesheet" href="{{asset('swordbros/aimeos/shop/themes/elegance/aimeos.css')}}">-->
@stop

@section('aimeos_head')
    <?= $aibody['basket/mini'] ?>
@stop


@section('aimeos_aside')
    <?= $aibody['catalog/session'] ?>
@stop

@section('aimeos_body')

 <main class="page-content">

    <div class="account-page-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                            <ul class="nav myaccount-tab-trigger" id="account-page-tab" role="tablist">
                                <li class="nav-item"> @php  $lang = \Request::input('locale', 'ru');  \App::setLocale($lang); @endphp
                                    <a class="nav-link active" id="account-dashboard-tab" data-toggle="tab" a href="#account-dashboard" role="tab" aria-controls="account-dashboard" aria-selected="true" > 
										{{__('pagination.Dashboard')}}</a>
                                </li>
                                <li class="nav-item"> @php  $lang = \Request::input('locale', 'ru');  \App::setLocale($lang); @endphp
                                    <a class="nav-link" id="account-orders-tab" data-toggle="tab" href="#account-orders" role="tab" aria-controls="account-orders" aria-selected="false">{{__('pagination.Orders')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-address-tab" data-toggle="tab" href="#account-address" role="tab" aria-controls="account-address" aria-selected="false">{{__('pagination.Address')}}</a>
                                </li>
                              <!--   <li class="nav-item">
                                    <a class="nav-link" id="account-subscription-tab" data-toggle="tab" href="#account-subscription" role="tab" aria-controls="account-subscription" aria-selected="false">Subscription</a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" id="account-review-tab" data-toggle="tab" href="#account-review" role="tab" aria-controls="account-review" aria-selected="false">{{__('pagination.Review')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-favourite-tab" data-toggle="tab" href="#account-favourite" role="tab" aria-controls="account-favourite" aria-selected="false">{{__('pagination.Favourite Products')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-watchlist-tab" data-toggle="tab" href="#account-watchlist" role="tab" aria-controls="account-watchlist" aria-selected="false">{{__('pagination.Watch List')}}</a>
                                </li> 
                                <li class="nav-item">
                                    <a class="nav-link" id="account-details-tab" data-toggle="tab" href="#account-details" role="tab" aria-controls="account-details" aria-selected="false">{{__('pagination.Account Details')}}</a>
                                </li>
                                <li class="nav-item">
                                    <form id="logout" action="/logout" method="POST">{{csrf_field()}}</form><a class="nav-link" id="account-logout-tab" href="javascript: document.getElementById('logout').submit();" role="tab" aria-selected="false">{{__('pagination.Logout')}}</a>
                                   
                                </li>
                            </ul>
                </div>
                <div class="col-lg-9">
            
                    <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                        <div class="tab-pane fade show active" id="account-dashboard" role="tabpanel" aria-labelledby="account-dashboard-tab">
                             <div class="myaccount-dashboard">
                                        <p>{{__('pagination.Hello')}} <b>{{Auth::user()->firstname }}</b> ( {{ Auth::user()->email }}? <a href="javascript: document.getElementById('logout').submit();">{{__('pagination.Logout')}}</a>)</p>
                                        <p>{{__('pagination.From your account dashboard you can view your recent orders, manage your shipping and billing addresses and edit your password and account details.')}}</p>
                                    </div>
                        </div>

                        <div class="tab-pane fade" id="account-orders" role="tabpanel" aria-labelledby="account-orders-tab">
                            <?= $aibody['account/history'] ?>
                        </div>

                        <div class="tab-pane fade" id="account-address" role="tabpanel" aria-labelledby="account-address-tab">

                            <?= $aibody['account/profile'] ?>

                        </div>
                        <div class="tab-pane fade" id="account-review" role="tabpanel" aria-labelledby="account-review-tab">

                            <?= $aibody['account/review'] ?>

                        </div>


                        <?php /*<div class="tab-pane fade" id="account-subscription" role="tabpanel" aria-labelledby="account-subscription-tab">

                             <?= $aibody['account/subscription'] ?>

                        </div>*/ ?>

                        <div class="tab-pane fade" id="account-favourite" role="tabpanel" aria-labelledby="account-favourite-tab">

                             <?= $aibody['account/favorite'] ?>

                        </div>

                        <div class="tab-pane fade" id="account-watchlist" role="tabpanel" aria-labelledby="account-watchlist-tab">

                             <?= $aibody['account/watch'] ?>

                        </div>

                        <div class="tab-pane fade" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">

                           
                                   <div class="myaccount-details">
                                        <form action="?tab=%23account-details-tab" class="kenne-form" method="post" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div class="kenne-form-inner">
                                                <div class="single-input single-input-half">
                                                   <label for="account-details-firstname">{{__('auth.Name')}}*</label>
                                                    <input type="text" id="account-details-firstname" name="address[payment][customer.firstname]" value="{{ Auth::user()->firstname }}" required>
                                                </div>
                                                <div class="single-input single-input-half">
                                                    <label for="account-details-lastname">{{__('auth.Surname')}}*</label>
                                                    <input type="text" id="account-details-lastname"  name="address[payment][customer.lastname]" value="{{ Auth::user()->lastname}}" required>
                                                </div>
												
                                                <div class="single-input">
                                                    <label for="account-details-email">{{__('Email')}}*</label>
                                                    <input type="email" id="account-details-email" value="{{ Auth::user()->email }}" required>
                                                </div>
                                              
                                                <div class="single-input">
                                                    <button class="kenne-btn kenne-btn_dark" value="1" name="address[save]">{{__('auth.Save')}}</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="panel-body">



<form class="kenne-form form-horizontal" method="POST" id ="form1" name="formdeneme" action="/profile">
{{ csrf_field() }}

<div class="row kenne-form-inner">
<div class="col-md-12">
                    <div class="form-box__single-group">
                        <h5 class="title">Password change</h5>
                    </div>
            </div> 

            @if (session('error'))
<div class="alert alert-danger" style="margin-left: 15px;">
{{ session('error') }}
</div>
@endif
@if (session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

            <div class="col-md-12">
<div class="single-input form-box__single-group form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
<label for="account-details-oldpass" class="col-md-4 control-label">Current Password</label>


<input placeholder="Current Password" id="account-details-oldpass" type="password" class="form-control" name="current-password" required>

@if ($errors->has('current-password'))
<span class="help-block">
    <strong>{{ $errors->first('current-password') }}</strong>
</span>
@endif

</div>
</div>




            <div class="col-md-6">
<div class="single-input form-box__single-group form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
<label for="new-password" class="col-md-4 control-label">New Password</label>


<input placeholder="New Password" id="new-password" type="password" class="form-control" name="new-password" required>

@if ($errors->has('new-password'))
<span class="help-block">
    <strong>{{ $errors->first('new-password') }}</strong>
</span>
@endif

</div>
</div>


            

<div class="col-md-6">
<div class="single-input form-box__single-group form-group">
<label for="new-password-confirm" class=" control-label">Confirm New Password</label>


<input placeholder="Confirm Password" id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
</div>
</div>




<div class="form-group">
<div class="col-md-6 col-md-offset-4">
<button type="submit" class="kenne-btn kenne-btn_dark btn btn--box btn--radius btn--small btn--black btn--black-hover-green btn--uppercase font--bold ">
Change Password
</button>
</div>
</div>
</div>
</form>
</div>
</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

 </main>

 <script type="text/javascript">
   var url =  $(location).attr('href');
   if(url.indexOf('profile/watch') > 0)
   {
    $('#account-watchlist-tab').click();
   }
   else if(url.indexOf('profile/favorite') > 0)
   {
    $('#account-favourite-tab').click();
   }
   else if(url.indexOf('profile?his_action=order') > 0)
   {
    $('#account-orders-tab').click();
   }
      <?php if(isset($_GET['tab'])){ ?>
          $('<?=$_GET['tab']?>').click();
      <?php } ?>

    // console.log();
</script>

@stop



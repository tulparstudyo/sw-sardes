@extends('shop::base')
@section('locale_selector_module')
  <?php  echo \Aimeos\Shop\Facades\Shop::get('locale/select')->getBody() ?>
@stop
@section('aimeos_body')

<div class="kenne-login-register_area">
	
      <div class="container">
		  
		  
		  <div id="login-register">
      @php  $lang = \Request::input('locale', 'ru');  \App::setLocale($lang); @endphp
			  
			  <div class="tab">
        
  <button class="tablinks login" onclick="openTabs( 'login')">{{__('auth.Login')}}</button>
  <button class="tablinks register" onclick="openTabs( 'register')">{{__('auth.Register')}}</button>

</div>
			  
			  <div id="login" class="tabcontent">
  <div class ="">
            <div class="login-form">
            <h4 class="login-title">    {{__('auth.Login')}} </h4>
            
              <form name="login-form" class="clearfix" action="{{ route('login',['locale'=>Route::current()->parameter('locale','ru'),'currency'=>Route::current()->parameter('currency','RUB'), 'tab'=>'login']) }}" method="post">
                  @csrf
              <div class="row">
                <div class=" col-md-12">
                  <label for="email"> {{__('auth.Username/Email')}}  </label>
                   <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{__('auth.Username/Email')}}">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              </div>
              <div class="row">
                <div class=" col-md-12">
                  <label for="password">{{__('auth.Password')}} </label>
                  <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{__('auth.Password')}}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
              </div>
		
               <div class=" row mb-0">
                            <div class="col-md-8">
                                <button type="submit" class="kenne-login_btn mt-0">
                                  {{__('auth.Loginbutton')}}
                                </button>
															
							</div>
				   <div class="col-md-4" >
				     <div class="forgot-password"  style="">
                               @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request',['locale'=>Route::current()->parameter('locale','ru'),'currency'=>Route::current()->parameter('currency','RUB')]) }}">
                                     {{__('auth.Forgot Your Password?')}}
                                    </a>
                                @endif
			
                              </div>   
				   </div>
                            
				  </div>
				  		<div class="social-text">{{ __('auth.Or you can login with:')}}</div>
				   
				    <div class=" row mb-0">
						
						<div class="col-md-4" ><div class="social-login-button " >

            <div class="flex items-center justify-end " style="float: left">
              						 
                           <img src="<?=sardes_url('assets/img/social/google.png')?>" style="max-width: 35px;margin-top: 3px;" >
                       
               </div>
             <div class="flex flex-column"><div class="social-test" ></div><div>     <?php App\Http\Controllers\SocialLoginBase::button('google')?>
             </div>
            </div>
        
				  </div>
			
                              </div>
				        <div class="col-md-4" ><div class="social-login-button " >
                <div class="flex items-center justify-end " style="float: left">
              						 
                           <img src="<?=sardes_url('assets/img/social/fb.png')?>" style="max-width: 35px;margin-top: 3px;" >
                       
               </div>
             <div class="flex flex-column"><div class="social-test" ></div><div>    
             <?php App\Http\Controllers\SocialLoginBase::button('facebook')?>
             </div>
            </div>
               
				  </div>
			
                              </div>
				        <div class="col-md-4" ><div class="social-login-button " >
                <div class="flex items-center justify-end " style="float: left">
              						 
                           <img src="<?=sardes_url('assets/img/social/vk.png')?>" style="max-width: 35px;margin-top: 3px;" >
                       
               </div>
             <div class="flex flex-column"><div class="social-test" ></div><div>    
             <?php App\Http\Controllers\SocialLoginBase::button('vkontakte')?>
             </div>
            </div>
            
				  </div>
			
                              </div>

			
                            </div>
				  		  	
				
                                      </div>
		
                    
				  
				  
				  
                        </div>
              
            </form>
				  </div>
			  
			  


<div id="register" class="tabcontent">
  			<div class ="">
		            <div class="login-form">
               <h4 class="login-title">  {{__('auth.Register')}}   </h4>
             <form  method="POST" action="{{ route('register',['locale'=>Route::current()->parameter('locale','ru'),'currency'=>Route::current()->parameter('currency','RUB'), 'tab'=>'register']) }}">
                        @csrf
              <div class="row">
                <div class="col-md-6">
                  <label for="name">{{__('auth.Name')}}*</label>
                   <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{__('auth.Name')}}" maxlength="50">
@error('name')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
@enderror
                </div>
           
				 
				
                <div class="col-md-6">
                  <label for="lastname">{{__('auth.Lastname')}}*</label>
                   <input id="lastname" type="text" class=" @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus placeholder="{{__('auth.Lastname')}}" maxlength="50">
@error('Lastname')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
@enderror
                </div>
              </div>
				 
				  <!--<div class="row">
                <div class="col-md-12">
                  <label for="title">{{__('Title')}}</label>
                   <input id="title" type="text" class=" @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus placeholder="{{__('Title')}}">
@error('title')
    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
@enderror
                </div>
              </div>-->
              <div class="row">
                <div class="col-md-12">
                  <label for="email">{{ __('auth.E-Mail Address') }}*</label>
                     <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('auth.E-Mail Address') }}">
                               @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                </div>
              </div>
               <div class="row">
                <div class="col-md-12">
                            <label for="password" class="col-form-label">{{ __('auth.Password') }}*</label>
                                <input id="password" type="password" class=" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('auth.Password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                 <div class="row">
                    <div class="col-md-12">
                            <label for="password-confirm" class="col-form-label">{{ __('auth.Confirm Password') }}*</label>
                            
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('auth.Confirm Password') }}">
                            </div>
                        </div>
	<!--<label class="container" style="display: inline-block"> <input type="checkbox" checked="checked">
				 <label for="option-terms-accept"option-terms-accept >
			
					I accept the <a href="%1$s" target="_blank" title="terms and conditions" alt="terms and conditions" class="sw_popup">terms and conditions</a>, <a href="%2$s" target="_blank" title="privacy policy" alt="privacy policy" class="sw_popup">privacy policy</a> and <a href="%3$s" target="_blank" title="cancellation policy" alt="cancellation policy" class="sw_popup">cancellation policy</a></label>
 
  
</label>
		-->		<div class="login-check"><input type="checkbox" value="Yes" name="MMERGE7" id="mce-MMERGE7-0" class="required" required="" aria-required="true"><label >
 {{ __('auth.I accept the') }}<a href="https://paltoru2.tulparstudyo.net/en/RUB/blog/privacy-policy"> <u>
 {{ __('auth.Privacy &amp; Policy') }}</u></a> </label></div>
				<div class="login-check sign-in" style=" margin-bottom: 10px;"><label style=" padding-left:0;" >
 {{ __('auth.Already registered?') }}<a href="{{ route('login',['locale'=>Route::current()->parameter('locale','ru'),'currency'=>Route::current()->parameter('currency','RUB')]) }}"> <u>
 {{ __('auth.Sign in to your account.') }}</u></a> </label></div>	
                 <div class="row mb-0">
					 <div class="col-md-8" >
                            <div class="register-button">
						<input type="hidden" name="siteid" value="1.">
                                <button type="submit" class="kenne-register_btn mt-0"  style="width: 160px;">
                                            {{ __('auth.Registerbutton') }}
                                </button>
					
                            </div>
					 </div>
			
                        </div>
				 
				 	  		<div class="social-text">{{ __('auth.Or you can login with:')}}</div>
				   
				    <div class=" row mb-0">
						
						<div class="col-md-4" ><div class="social-login-button " >

            <div class="flex items-center justify-end " style="float: left">
              						 
                           <img src="<?=sardes_url('assets/img/social/google.png')?>" style="max-width: 35px;margin-top: 3px;" >
                       
               </div>
             <div class="flex flex-column"><div class="social-test" ></div><div>    
             <?php App\Http\Controllers\SocialLoginBase::button('google')?>
             </div>
            </div>

				  </div>
			
                              </div>
				        <div class="col-md-4" ><div class="social-login-button " >
                <div class="flex items-center justify-end " style="float: left">
              						 
                           <img src="<?=sardes_url('assets/img/social/fb.png')?>" style="max-width: 35px;margin-top: 3px;" >
                       
               </div>
             <div class="flex flex-column"><div class="social-test" ></div><div>    
             <?php App\Http\Controllers\SocialLoginBase::button('facebook')?>
             </div>
            </div>

					
				  </div>
			
                              </div>
				        <div class="col-md-4" ><div class="social-login-button " >
                <div class="flex items-center justify-end " style="float: left">
              						 
                           <img src="<?=sardes_url('assets/img/social/vk.png')?>" style="max-width: 35px;margin-top: 3px;" >
                       
               </div>
             <div class="flex flex-column"><div class="social-test" ></div><div>    
          
             <?php App\Http\Controllers\SocialLoginBase::button('vkontakte')?>
             </div>
            </div>

				  </div>
			
                              </div>
				<!--   
				<a href="{{route('vk.auth')}}">vk</a>  
				<a href="{{ url('auth/fb') }}">fb</a>
				  -->
			
                            </div>
				 
				 
 
				 
                
               
            </form>
          </div>
			  
			  
			  
          </div>
			  </div>
		  
		  </div>
        
      </div>
	
</div>

<script>
function openTabs( tabName) {
	$('.tablinks').removeClass('active');
	$('.tablinks.'+tabName).addClass('active');
	$('.tabcontent').hide();
	$('#'+tabName).show();
	document.cookie = "tab="+tabName;
/*
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
*/
}
$('.tablinks.' + getCookie('tab')).click();
function getCookie(name) {
  const value = `; ${document.cookie}`;
  const parts = value.split(`; ${name}=`);
  if (parts.length === 2) return parts.pop().split(';').shift();
}
</script>


@endsection

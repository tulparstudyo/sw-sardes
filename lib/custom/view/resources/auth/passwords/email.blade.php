@extends('shop::base')



@section('aimeos_body')



<section>

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6 col-md-push-3">

            <div class="card">

                <div class="card-header"><a style="font-size: 16px;font-weight: 700;">  @php $locale = \Request::input('locale'); \App::setLocale($locale); @endphp  {{__('auth.Reset Password')}}</a></div>



                <div class="card-body">

                    @if (session('status'))

                        <div class="alert alert-success" role="alert">

                            {{ session('status') }}

                        </div>

                    @endif



                    <form method="POST" action="{{ route('password.email',['locale'=>\Request::input('locale'),'currency'=>Route::current()->parameter('currency','RUB')]) }}">

                        @csrf



                        <div class="form-group row">
							<a style="margin-left: 16px;
    padding-bottom: 10px;width: 100%;">@php $locale = \Request::input('locale'); \App::setLocale($locale); @endphp {{ __('auth.Enter the e-mail to which the account was registered.') }}</a>

                            <label for="email" class="col-md-3 col-form-label">@php $locale = \Request::input('locale'); \App::setLocale($locale); @endphp {{ __('auth.E-Mail Address') }}</label>



                            <div class="col-md-6">

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>



                                @error('email')

                                    <span class="invalid-feedback" role="alert">

                                        <strong>{{ $message }}</strong>

                                    </span>

                                @enderror

                            </div>

                        </div>



                        <div class="form-group row mb-0">

                            <div class="reset">

                                <button type="submit" class="btn btn-primary">

                                    {{ __('auth.Send') }}

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</section>

@endsection


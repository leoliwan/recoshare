@extends('layouts.welcome_app')
@section('title','Main Homepage')
@section('content')

  <!-- HOME SECTION -->
  <header id="home-section">
    <div class="dark-overlay">
      <div class="home-inner">
        <div class="container text-white">
          <div class="row">
            <div class="col-lg-8 d-none d-lg-block">
              <h1 class="display-4">Number One <strong style="color:#30CFC0; font-weight:800;">Stock Reco</strong> sharing <strong>in the Philippines</strong></h1>
              <div class="d-flex flex-row">
                <div class="p-4 align-self-start">
                  <i class="fa fa-check"></i>
                </div>
                <div class="p-4 align-self-end">
                  <p class="mb-0" style="font-size:18px">The number one Stock Reco Sharing Community in the Philippines that allows you to post your best reco for learners and newbie traders.</p>
                </div>
              </div>

            
              <div class="d-flex flex-row">
                <div class="p-4 align-self-start">
                  <i class="fa fa-check"></i>
                </div>
                <div class="p-4 align-self-end">
                    <p class="mb-0" style="font-size:18px">Whether you are a Rechosharer or a just a learner, you'll gain access to hundreds or best recos that you can learn from and help you out with your own trades.</p>
                </div>
              </div>

              <div class="d-flex flex-row">
                <div class="p-4 align-self-start">
                  <i class="fa fa-check"></i>
                </div>
                <div class="p-4 align-self-end">
                    <p class="mb-0" style="font-size:18px">With your consistent recos with positive results, you will have the chance to receive supports from users who made profits using your stock recos.</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card bg--default card-form">
                <div class="card-body py-3">
                  <h3 class=" text-center">Sign Up. It's Free</h3>
                  <p class=" text-center">Please fill out this form to register</p>
                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label class="mb-0" for="name">Name</label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                        
                        @if ($errors->has('name'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="mb-0" for="name">E-mail Address</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        
                        @if ($errors->has('email'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="mb-0" for="name">Password</label>
                      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                      
                      @if ($errors->has('password'))
                          <span class="invalid-feedback">
                              <strong>{{ $errors->first('password') }}</strong>
                          </span>
                      @endif
                    </div>
                    <div class="form-group">
                        <label class="mb-0" for="name">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <small>By clicking the Submit Button, you agree to the <span><a href="{{route('termsandconditions')}}">terms and condition</a></span></small>
                    <input type="submit" class="btn btn-outline-info btn-block text-white" value="Register">
                    
                    <p class="mb-0 mt-3">Already have an account?<span><a href="{{ route('login') }}"><strong> Login</strong></a></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

<!-- EXPLORE HEAD -->
<div class="container">
  <div class="row">
    <div class="col text-center">
      <div class="py-4">
        <h2 class="display-4">Two in One</h2>
        <p class="lead">Are you good at analyzing stocks and your trading system works? Why not share and earn from it. You earn from trading and your earn from reco sharing</p>
        <a href="{{ route('register') }}" class="btn btn--default text-white">Register Now. It's Free</a>
      </div>
    </div>
  </div>
</div>

<!-- Q and A and Guide -->
<div class="bg-white py-4">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-6 mx-auto">
        <div class="text-center">
          <i class="fa fa-question-circle" style="font-size:60px; color:#30CFC0; margin:20px 0;"></i>
          <h3>Frequently Asked Questions</h3>
          <div style="border-bottom: 2px solid #30CFC0; margin: 0 20%;"></div>
        </div>
        <div class="q-and-a mx-5 py-4">
          <h5>What is the purpose of RecoShare?</h5>
        <p>RecoShare is an online stock reco sharing platform for Filipino stock traders and investors. It provides useful trading guides, techniques and tips from traders/investors who are willing to share their stock analysis as well as their recommendation. Please read our <span><a href="{{route('disclaimer')}}">Disclaimer</a></span></p>
          <hr>
          <h5>Is it FREE to join?</h5>
          <p>Yes! 100% FREE. Whether you are a RecoSharer or a Learner, our platform is FREE.</p>
          <hr>
          <h5>Can I share my stock analysis/reco?</h5>
          <p>Yes. You can share any of your favourite stock analysis or recos as long as you provide sound and relevant advice that benefit the readers. RecoShare does not allow anybody who use our platform to hype a certain stock.</p>
          <hr>
          <h5>How many stock recos can I share?</h5>
          <p>You can share as many stock as you want as long as the stock has not been shared by somebody. If the stock has been shared already, please share others good stocks listed in the PSE</p>
          <hr>
          <h5>How can I receive support from my stock analysis/recos?</h5>
          <p>The purpose of our platform is to enable you to improve your own stock analysis/recos. If your recos are doing good and hitting many likes and good rating, it means readers are learning from you and probably use your recos as guide in buying and selling their own stock. <br><br>
          Busy stock traders/investors who don't have time to study and analyze individual stocks but want to engage the market can use your recos as guide. 
          <br><br>
          If you can build trust and provide valuable stock analysis/reco to your readers, then your readers can opt to share monetary blessings they gained from the stock market as a way to say thanks and support you. </p>
          <hr>
          <h5>I want to support a RecoSharer. How can I donate?</h5>
          <p>There are two ways to support. You can donate a small amount direct thru bank account or thru paypal. See instruction<span><a href="{{route('termsandconditions')}}"> Here</a></span></p></p>
          <hr>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection
@extends('index')
@section('content')
<style>
    .form-floating {
  position: relative;
  margin-bottom: 1.5rem;
}

.form-floating input {
  width: 100%;
  padding: 1rem 0.75rem 0.25rem;
  font-size: 1rem;
  border: 1px solid #ccc !important;
  border-radius: 5px !important;
 
}



.form-floating input:focus + label,
.form-floating input:not(:placeholder-shown) + label {
  top: -0.5rem;
  left: 0.6rem;
  
}
</style>
 <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{ asset('assets/front/img/bg_1.jpg') }}');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <div class="mb-4">
              <h3>Sign in</h3>
              @if(session('error'))
                  <div class="alert alert-danger">{{ session('error') }}</div>
              @endif
              <p class="mb-4">Access your account .</p>
            </div>
            <form id="loginUpForm"  onsubmit="return false;" action="{{ route('user.account-login') }}" method="post">
                @csrf
      
                <div class="form-floating">
                    
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email address">
                    <label for="email">Email Address</label>
                    @if('email')
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif
                    <span class="text-danger"></span>
                </div>
                <div class="form-floating">
                   
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    <label for="password">Password</label>
                    @if('password')
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                     <span class="text-danger"></span>
                </div>
             
              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked"/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"> <a href="#" class="forgot-pass">Forgot Password</a> </span> 
              </div>

              <input type="submit" value="Sign in" class="btn btn-block btn-danger">

              <span class="d-block text-center my-4 text-muted">&mdash; or &mdash;</span>
              
              <div class="social-login">
              
                <a href="{{ url('signup')}}" class="google btn d-flex justify-content-center align-items-center">
                  <span class="icon-google mr-3"></span> Sign up 
                </a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>    
  </div>

<script>
    $(document).ready(function() {
        $('#loginUpForm').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                   
                }
            },
            messages: {
                email: "Please enter a valid email address",
                password: "Please enter a password"
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.closest('.form-floating').find('span'));
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
@endsection
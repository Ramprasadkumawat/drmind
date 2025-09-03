@extends('index')
@section('content')

@if(isset($homepage) && $homepage->content)
<div class="section">
    <div class="container">
        {!! $homepage->content !!}
    </div>
</div>
@else
{{-- Default static content if no dynamic homepage or content --}}
<div class="section bannersection">
    <div class="container">
        <div class="row">
            <div class="col">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="container">
                                <div class="row">
                                    <div class="col  align-items-start justify-content-center d-flex flex-column">
                                        <h1>Real Life Education</h1>
                                    </div>
                                    <div class="col align-items-center d-flex">
                                        <img class="bannerimgg"
                                            src="{{ asset('assets/front/img/Screenshot 2025-05-05 125209.png') }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 pb-5 d-flex flex-column">
                <h6 class="text-center text-dark 100">Welcome to Dr. Mind</h6>
                <h2 class="text-center">Popular Category</h2>
            </div>
        </div>
    </div>
</div>
@endif

<div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 pb-5 d-flex flex-column">
          <h6 class="text-center text-dark 100">Our Testimonials</h6>
          <h2 class="text-center">What Patient Say</h2>
        </div>
        <div class="container">
          <div id="owl-demo1" class="owl-carousel">

            <div class="allitem">
              <div class="blog-allof">
                <div class="img-date">
                  <img src="{{ asset('assets/front/img/imgg (8).png') }}">
                </div>
                <div class="discretion-blog">
                  <p>Reduce operational costs with no compromise on how you run your business.</p>
                  <h3>Shruti Singh</h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
   <script>
      $(".seemore").click(function() {
        window.location.href = "products";
      });
   </script>
    @endsection
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dr Mind{{ isset($title) ? '-'.$title : '' }}</title>
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lexend:wght@100..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4Assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

   <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/684bae0c4b5a53190afc6524/1itjpvoos';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>

</head>

<body>
  <div class="loader-overlay" style="display: none;">
      <div class="payment-loader">
        <div class="pad">
        <div class="chip"></div>
        <div class="line line1"></div>
        <div class="line line2"></div>
      </div>
      <div class="loader-text">
        Please wait while payment is loading
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg bg-red ">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQNhoXisDruJMDAq3Ltd-wuaMW2lGxck9wAKw&s"
          alt="Bootstrap" width="30" height="24">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse  justify-content-end " id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active text-light" aria-current="page" href="{{ route('home.index') }}">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('home.about.us') }}">DrMind Misson</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="{{ url('category/afc-drs-food') }}">AFC Dr`s Food</a>
          </li>
           <li class="nav-item">
            <a class="nav-link text-light" href="{{ url('category/herbal-remedies') }}">Herbal Remedies</a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('user.view.subscription') }}">Life Education</a>
          </li>
           {{-- <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('home.broadcast')}}">Broadcast</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('home.blogs')}}">News & Inspiration</a>
          </li>
           <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('testimonials-view')}}">Testimonials</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('home.contact') }}">Contact Us</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link text-light" href="{{ route('home.faq') }}">FAQ</a>
          </li> --}}
          <li class="nav-item dropdown">
            @if(auth()->check())
              <a class="nav-link dropdown-toggle text-light" href="#" id="navbarAccount" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Account
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarAccount">
                <li>
                  <a class="dropdown-item" href="{{ route('user-dashboard') }}">Dashboard</a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('cart.show') }}">Cart Item</a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                </li>
                <!-- Add more account-related links here if needed -->
              </ul>
            @else
              <a class="nav-link text-light" href="{{ url('user-login') }}">Sign In/Sign Up</a>
            @endif
          </li>
        </ul>
      </div>
    </div>
  </nav>
  
  @yield('content')
  <div class="bg-dark">
    <div class="container">
      <footer class="pt-5">
        <div class="row">
          <div class="col-6 col-md-2 mb-3">
            <h5>Section</h5>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Home</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Features</a></li>
              <li class="nav-item mb-2"><a href="{{ route('home.broadcast')}}" class="nav-link p-0 text-light">Broadcast</a></li>
              <li class="nav-item mb-2"><a href="{{ route('home.faq') }}" class="nav-link p-0 text-light">FAQs</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">About</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-2 mb-3">
            <h5>Section</h5>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Home</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Features</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Pricing</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">FAQs</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">About</a></li>
            </ul>
          </div>
          <div class="col-6 col-md-2 mb-3">
            <h5>Section</h5>
            <ul class="nav flex-column">
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Home</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Features</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">Pricing</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">FAQs</a></li>
              <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-light">About</a></li>
            </ul>
          </div>
    
       
    
          <div class="col-md-5 offset-md-1 mb-3">
            <form>
              <h5>Subscribe to our newsletter</h5>
              <p>Monthly digest of what's new and exciting from us.</p>
              <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                <label for="newsletter1" class="visually-hidden">Email address</label>
                <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                <button class="btn btn-primary" type="button">Subscribe</button>
              </div>
            </form>
          </div>
        </div>
    
        <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
          <p>© 2022 Company, Inc. All rights reserved.</p>
          <ul class="list-unstyled d-flex">
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"></use></svg></a></li>
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"></use></svg></a></li>
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"></use></svg></a></li>
          </ul>
        </div>
      </footer>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js"
      integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous">
    </script>
   
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
      $(document).ready(function() {
        var owl = $("#owl-demo1");
        owl.owlCarousel({
          loop: true,
          margin: 40,
          nav: true,
          autoplay: true,
          dots: false,
          items: 3, //10 items above 1000px browser width
          responsiveClass: true,
          responsive: {
            0: {
              items: 1,
              nav: false,
            },
            600: {
              items: 2,
              nav: false,
            },
            1000: {
              items: 3,
              nav: false,
              loop: true,
            }
          }
        })
      });
    </script>
</body>

</html>
@extends('index')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<div class="section bannersection">
         @if(!empty($broadcast))
 
  <div class="section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-12 pb-5 d-flex flex-column">
          <h6 class="text-center text-dark 100">Explore a variety of exciting broadcasts waiting for you.</h6>
          <h2 class="text-center">Broadcast Channel</h2>
        </div>
      
           @foreach($broadcast as $product)
          <div class="col-sm-6	col-md-4	col-lg-4	col-xl-4 mt-4	col-xxl-4 d-flex flex-column Product-card gap-3 pb-4">
            <a href="javascript:;" class="text-decoration-none text-dark">
                 
                        @php
                            $imagePath = public_path($product->image);
                        @endphp

            <img  src="{{ asset(file_exists($imagePath) ? $product->image : env('IMAGE_NOT_FOUND')) }}" 
                width="100%" 
                alt="">
               
          

            <h5 class="text-dark">{{ $product->title }} </h5>
            <div>
            
              <small class="text-dark opacity-50">@php echo $product->message @endphp </small>
            </div>
            </a>
            @php
              $broadcastUrl = route('broadcast.show', $product->id);
              $shareText = $product->title . ' - ' . $product->message;
          @endphp

          <div class="d-flex gap-2 mt-2"> <!-- Buttons line mein laane ke liye -->
    {{-- Facebook Share --}}
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($broadcastUrl) }}"
        target="_blank" class="btn btn-primary d-flex align-items-center justify-content-center" title="Share on Facebook">
        <i class="fab fa-facebook-f"></i>
    </a>

    {{-- X (Twitter) Share --}}
    {{-- WeChat (Note: WeChat does not provide a direct web share URL, so this is just an icon for display) --}}
    <a href="javascript:void(0);" class="btn btn-success d-flex align-items-center justify-content-center" title="Share on WeChat" style="background-color: #7bb32e; border-color: #7bb32e;">
      <i class="fab fa-weixin"></i>
    </a>

    {{-- Instagram (Instagram does not support direct web sharing, so this is just an icon for display) --}}
    <a href="https://www.instagram.com/" target="_blank" class="btn btn-danger d-flex align-items-center justify-content-center" title="Share on Instagram" style="background-color: #E1306C; border-color: #E1306C;">
      <i class="fab fa-instagram"></i>
    </a>


    {{-- WhatsApp Share --}}
    <a href="https://wa.me/?text={{ urlencode($shareText . ' ' . $broadcastUrl) }}"
      target="_blank" class="btn btn-success d-flex align-items-center justify-content-center" title="Share on WhatsApp" style="background-color: #25D366; border-color: #25D366;">
      <i class="fab fa-whatsapp"></i>
        </a>

        {{-- TikTok (TikTok does not support direct web sharing, so this is just an icon for display) --}}
        <a href="https://www.tiktok.com/" target="_blank" class="btn btn-dark d-flex align-items-center justify-content-center" title="Share on TikTok" style="background-color: #010101; border-color: #010101;">
      <i class="fab fa-tiktok"></i>
        </a>

        {{-- YouTube (YouTube does not support direct web sharing, so this is just an icon for display) --}}
        <a href="https://www.youtube.com/" target="_blank" class="btn btn-danger d-flex align-items-center justify-content-center" title="Share on YouTube" style="background-color: #FF0000; border-color: #FF0000;">
      <i class="fab fa-youtube"></i>
        </a>
    </a>
</div>
          </div>
          @endforeach
      
      </div>
    </div>
  </div>

  @endif
</div>
@endsection
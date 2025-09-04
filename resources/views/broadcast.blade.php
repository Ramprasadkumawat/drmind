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
           @php
           $broadcastUrl = route('broadcast.show', $product->id);
           $shareText = $product->title . ' - ' . $product->message;
         @endphp
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
            
              <small class="text-dark opacity-50">{!! $product->message !!}</small>
            </div>
            </a> {{-- Correctly closes the main product link --}}

            {{-- Moved @php block outside the a tag --}}
            

{{-- Start: Only show social media icons if user is logged in --}}
@auth
          <div class="d-flex gap-2 mt-2"> <!-- Buttons line mein laane ke liye -->
    {{-- Facebook Share --}}
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($broadcastUrl) }}"
    target="_blank" class="btn btn-primary d-flex align-items-center justify-content-center social-share-link" title="Share on Facebook" data-platform="facebook" data-broadcast-id="{{ $product->id }}">
        <i class="fab fa-facebook-f"></i>
    </a>

    {{-- X (Twitter) Share --}}
    {{-- WeChat (Note: WeChat does not provide a direct web share URL, so this is just an icon for display) --}}
    <a href="javascript:void(0);" class="btn btn-success d-flex align-items-center justify-content-center social-share-link" title="Share on WeChat" style="background-color: #7bb32e; border-color: #7bb32e;" data-platform="wechat" data-broadcast-id="{{ $product->id }}">
      <i class="fab fa-weixin"></i>
    </a>

    {{-- Instagram (Instagram does not support direct web sharing, so this is just an icon for display) --}}
    <a href="https://www.instagram.com/" target="_blank" class="btn btn-danger d-flex align-items-center justify-content-center social-share-link" title="Share on Instagram" style="background-color: #E1306C; border-color: #E1306C;" data-platform="instagram" data-broadcast-id="{{ $product->id }}">
      <i class="fab fa-instagram"></i>
    </a>


    {{-- WhatsApp Share --}}
    <a href="https://wa.me/?text={{ urlencode($shareText . ' ' . $broadcastUrl) }}"
      target="_blank" class="btn btn-success d-flex align-items-center justify-content-center social-share-link" title="Share on WhatsApp" style="background-color: #25D366; border-color: #25D366;" data-platform="whatsapp" data-broadcast-id="{{ $product->id }}">
      <i class="fab fa-whatsapp"></i>
        </a>

        {{-- TikTok (TikTok does not support direct web sharing, so this is just an icon for display) --}}
        <a href="https://www.tiktok.com/" target="_blank" class="btn btn-dark d-flex align-items-center justify-content-center social-share-link" title="Share on TikTok" style="background-color: #010101; border-color: #010101;" data-platform="tiktok" data-broadcast-id="{{ $product->id }}">
      <i class="fab fa-tiktok"></i>
        </a>

        {{-- YouTube (YouTube does not support direct web sharing, so this is just an icon for display) --}}
        <a href="https://www.youtube.com/" target="_blank" class="btn btn-danger d-flex align-items-center justify-content-center social-share-link" title="Share on YouTube" style="background-color: #FF0000; border-color: #FF0000;" data-platform="youtube" data-broadcast-id="{{ $product->id }}">
      <i class="fab fa-youtube"></i>
        </a>
    
</div>
{{-- End: Only show social media icons if user is logged in --}}
@endauth
          </div>
          @endforeach
      
      </div>
    </div>
  </div>

  @endif
</div>
@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.social-share-link').forEach(link => {
        link.addEventListener('click', function(event) {
            const platform = this.dataset.platform;
            const broadcastId = this.dataset.broadcastId;
            if (platform && broadcastId) {
                fetch('/track-social-click', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ platform: platform, broadcast_id: broadcastId })
                })
                .then(response => response.json())
                .then(data => console.log('Click tracked:', data))
                .catch((error) => console.error('Error:', error));
            }
        });
    });
});
</script>
@endpush
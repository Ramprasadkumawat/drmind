@extends('index')
@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100" style="margin-top: 60px;">
    <div class="testimonial text-center">
        @if($testimonial)
            <h2 class="mb-3">{{ $testimonial->title }}</h2>
            @if($testimonial->image)
            <img src="{{ $testimonial->image }}" alt="{{ $testimonial->title }}" class="img-fluid mb-3" style="max-width:100%; height:auto;">
            @endif
            <div>
                @php echo $testimonial->description; @endphp
            </div>
        @else
        <h2 class="mb-3"> No Data found!</h2>
        @endif
    </div>
</div>
@endsection
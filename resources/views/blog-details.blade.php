@extends('index')
@section('content')
<!-- Heading Section -->
<div class="section text-center">
    
        <h1 class="blog-title">{{ $detail->title }}</h1>
  
</div>

<!-- Full Width Image -->
<div class="blog-image-section" style="width:100%; overflow:hidden;">
    <img src="{{ asset($detail->image) }}" alt="Blog Image" style="width:100%; height:auto;">
</div>

<!-- Author Details -->
<div class="container mt-4 mb-3">
    <div class="d-flex align-items-center">
        <div class="author-avatar" style="width:48px; height:48px; border-radius:50%; overflow:hidden; margin-right:15px;">
            <img src="{{ asset($detail->image) }}" alt="Author" style="width:100%; height:100%; object-fit:cover;">
        </div>
        <div>
            <div class="author-name font-weight-bold">Author : DrMind</div>
            <div class="blog-date text-muted" style="font-size: 0.9em;">Created on {{ $detail->created_at }}</div>
        </div>
    </div>
</div>

<!-- Blog Description -->
<div class="container mb-5">
    <div class="blog-description">
       @php echo $detail->message @endphp
        <!-- Add more content as needed -->
    </div>
</div>

@endsection
<head>
    <title>{{ $meta['title'] ?? 'Default Title' }}</title>
    
    @if($meta['platform'] === 'og')
        <!-- Open Graph (Facebook + LinkedIn) -->
        <meta property="og:type" content="{{ $meta['type'] }}">
        <meta property="og:url" content="{{ $meta['url'] }}">
        <meta property="og:title" content="{{ $meta['title'] }}">
        <meta property="og:description" content="{{ $meta['description'] }}">
        <meta property="og:image" content="{{ $meta['image'] }}">
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <meta name="description" content="{{ $meta['description'] }}"> {{-- For general SEO --}}
    @elseif($meta['platform'] === 'twitter')
        <!-- Twitter Card -->
        <meta name="twitter:card" content="{{ $meta['type'] ?? 'summary_large_image' }}">
        <meta name="twitter:url" content="{{ $meta['url'] }}">
        <meta name="twitter:title" content="{{ $meta['title'] }}">
        <meta name="twitter:description" content="{{ $meta['description'] }}">
        <meta name="twitter:image" content="{{ $meta['image'] }}">
        <meta name="description" content="{{ $meta['description'] }}"> {{-- For general SEO --}}
    @endif
</head>

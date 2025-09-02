@extends('admin.layout.template')

@section('content')
@push('styles')
    <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">
    <link href="https://unpkg.com/grapesjs-preset-webpage/dist/grapesjs-preset-webpage.min.css" rel="stylesheet">
@endpush
<div class="container">
    <h1>Edit Page: {{ $page->name }}</h1>
    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $page->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Page Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $page->name) }}" required>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $page->slug) }}">
            @error('slug')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="editor" class="form-label">Page Content</label>
            <div id="gjs" class="page-content-editor">{!! old('content', $page->content ?? '') !!}</div>
            <input type="hidden" name="content" id="grapesjs-output">
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">Upload New Images (optional)</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
            @error('images.*_paths')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @if ($page->image_paths)
            <div class="mb-3">
                <label class="form-label">Current Images:</label>
                <div class="row">
                    @foreach (json_decode($page->image_paths) as $imagePath)
                        <div class="col-md-3 mb-2">
                            <img src="{{ asset('storage/' . $imagePath) }}" alt="Page Image" class="img-thumbnail">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $imagePath }}" id="deleteImage{{ $loop->index }}">
                                <label class="form-check-label" for="deleteImage{{ $loop->index }}">
                                    Delete
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Homepage Settings --}}
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Homepage Settings (Optional)</h5>
            </div>
            <div class="card-body">
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="is_homepage" name="is_homepage" value="1" {{ old('is_homepage', $page->is_homepage) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_homepage">Set as Homepage</label>
                    @error('is_homepage')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slider_text" class="form-label">Homepage Slider Text</label>
                    <textarea class="form-control" id="slider_text" name="slider_text" rows="3">{{ old('slider_text', $page->slider_text) }}</textarea>
                    @error('slider_text')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="slider_image" class="form-label">Homepage Slider Image</label>
                    <input type="file" class="form-control" id="slider_image" name="slider_image" accept="image/*">
                    @error('slider_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @if ($page->slider_image_path)
                        <div class="mt-2">
                            <img src="{{ Str::startsWith($page->slider_image_path, 'http') ? $page->slider_image_path : asset('storage/' . $page->slider_image_path) }}" alt="Slider Image" style="max-width: 150px; height: auto;">
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" name="delete_slider_image" value="1" id="delete_slider_image">
                                <label class="form-check-label" for="delete_slider_image">Delete Current Slider Image</label>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="main_paragraph_content" class="form-label">Homepage Main Paragraph Content</label>
                    <textarea class="form-control" id="main_paragraph_content" name="main_paragraph_content" rows="5">{{ old('main_paragraph_content', $page->main_paragraph_content) }}</textarea>
                    @error('main_paragraph_content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="extr-images" class="form-label">Homepage Extra Images</label>
                    <input type="file" class="form-control" id="extr-images" name="extr-images[]" multiple accept="image/*">
                    @error('extr-images.*')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                    @if ($page->{'extr-image_paths'})
                        @php
                            $extraImages = json_decode($page->{'extr-image_paths'}, true);
                        @endphp
                        @if(!empty($extraImages))
                            <div class="mt-2">
                                <label class="form-label">Current Extra Images:</label>
                                <div class="row">
                                    @foreach ($extraImages as $extrImagePath)
                                        <div class="col-md-3 mb-2">
                                            <img src="{{ Str::startsWith($extrImagePath, 'http') ? $extrImagePath : asset('storage/' . $extrImagePath) }}" alt="Extra Image" class="img-thumbnail">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="delete_extr_images[]" value="{{ $extrImagePath }}" id="deleteExtrImage{{ $loop->index }}">
                                                <label class="form-check-label" for="deleteExtrImage{{ $loop->index }}">Delete</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update Page</button>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>

@push('scripts')
    <script src="https://unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editor = grapesjs.init({
                container: '#gjs',
                fromElement: true,
                width: 'auto',
                storageManager: false, // We will handle saving manually
                plugins: ['gjs-preset-webpage'],
                pluginsOpts: {
                    'gjs-preset-webpage': {
                        modalTitle: 'Select Image',
                        previewOpts: {
                            default: {
                                scripts: [
                                    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js'
                                ]
                            }
                        }
                    }
                }
            });

            const form = document.querySelector('form');
            form.addEventListener('submit', function() {
                document.getElementById('grapesjs-output').value = editor.getHtml() + '<style>' + editor.getCss() + '</style>';
            });
        });
    </script>
@endpush
@endsection

@extends('admin.layout.template')

@section('content')
<div class="container">
    <h1>Edit Page: {{ $page->name }}</h1>
    <form action="{{ route('admin.pages.update', $page->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="settings_order" id="settings_order">
        <div id="draggable-form-fields">
            <div class="draggable-item" data-id="category">
                <div class="card mb-3">
                    <div class="card-header"><h6>Category</h6></div>
                    <div class="card-body">
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
                    </div>
                </div>
            </div>

            <div class="draggable-item" data-id="name">
                <div class="card mb-3">
                    <div class="card-header"><h6>Page Name</h6></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Page Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $page->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="draggable-item" data-id="slug">
                <div class="card mb-3">
                    <div class="card-header"><h6>Slug</h6></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $page->slug) }}">
                            @error('slug')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="draggable-item" data-id="content">
                <div class="card mb-3">
                    <div class="card-header"><h6>Page Content</h6></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="content" class="form-label">Page Content</label>
                            <textarea class="form-control" id="content" name="content" rows="10">{{ old('content', $page->content) }}</textarea>
                            @error('content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="draggable-item" data-id="images">
                <div class="card mb-3">
                    <div class="card-header"><h6>Images</h6></div>
                    <div class="card-body">
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
                    </div>
                </div>
            </div>

            <div class="draggable-item" data-id="homepage-settings">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">Homepage Settings (Optional)</h5>
                    </div>
                    <div class="card-body">
                        <div id="homepage-settings-container">
                            <div class="homepage-setting-item card mb-3" data-id="slider">
                                <div class="card-header">
                                    <h6 class="mb-0">Slider</h6>
                                </div>
                                <div class="card-body">
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
                                </div>
                            </div>

                            <div class="homepage-setting-item card mb-3" data-id="main_paragraph">
                                <div class="card-header">
                                    <h6 class="mb-0">Main Paragraph</h6>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="main_paragraph_content" class="form-label">Homepage Main Paragraph Content</label>
                                        <textarea class="form-control" id="main_paragraph_content" name="main_paragraph_content" rows="5">{{ old('main_paragraph_content', $page->main_paragraph_content) }}</textarea>
                                        @error('main_paragraph_content')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="homepage-setting-item card mb-3" data-id="extra_images">
                                <div class="card-header">
                                    <h6 class="mb-0">Extra Images</h6>
                                </div>
                                <div class="card-body">
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
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="is_homepage" name="is_homepage" value="1" {{ old('is_homepage', $page->is_homepage) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_homepage">Set as Homepage</label>
                            @error('is_homepage')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Update Page</button>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var el = document.getElementById('draggable-form-fields');
        if (el) {
            var sortable = Sortable.create(el, {
                animation: 150,
                handle: '.card-header',
                onEnd: function () {
                    var order = [];
                    var items = el.querySelectorAll('.draggable-item');
                    items.forEach(function (item) {
                        order.push(item.dataset.id);
                    });
                    document.getElementById('settings_order').value = JSON.stringify(order);
                }
            });

            var initialOrder = {!! $page->settings_order ?? '[]' !!};
            if (initialOrder.length > 0) {
                var container = document.getElementById('draggable-form-fields');
                initialOrder.forEach(function(id) {
                    var item = container.querySelector('.draggable-item[data-id="' + id + '"]');
                    if (item) {
                        container.appendChild(item);
                    }
                });
            }
        }
    });
</script>
@endpush

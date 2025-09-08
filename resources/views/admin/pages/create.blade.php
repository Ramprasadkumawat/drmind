@extends('admin.layout.template')

@section('content')
<div class="container">
    <h1>Create New Page</h1>
    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="settings_order" id="settings_order">
        <div id="draggable-form-fields">
            <div class="draggable-item" data-id="category">
                <div class="card mb-3">
                    <div class="card-header"><h6>Category</h6></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="category_ids" class="form-label">Categories</label>
                            <select class="form-control" id="category_ids" name="category_ids[]" multiple="multiple" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ (is_array(old('category_ids')) && in_array($category->id, old('category_ids'))) ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_ids')
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
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
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
                            <label for="slug" class="form-label">Slug (Optional - will be generated if empty)</label>
                            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
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
                            <textarea class="form-control" id="content" name="content" rows="10">{{ old('content') }}</textarea>
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
                            <label for="images" class="form-label">Upload Images</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                            @error('images.*_paths')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="draggable-item" data-id="slider">
                <div class="card mb-3">
                     <div class="card-header d-flex justify-content-between align-items-center">
                        <h6>Slider (Optional)</h6>
                        <button type="button" class="btn btn-primary btn-sm" id="add-slider-btn">
                            <i class="fas fa-plus"></i> Add Slider
                        </button>
                    </div>
                    <div class="card-body" id="sliders-container">
                        {{-- Slider items will be dynamically added here --}}
                        @if(old('sliders'))
                            @foreach(old('sliders') as $key => $slider)
                                @include('admin.pages.partials.slider_item', ['key' => $key, 'slider' => $slider])
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="draggable-item" data-id="main_paragraph">
                <div class="card mb-3">
                    <div class="card-header"><h6>Main Paragraph (Optional)</h6></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="main_paragraph_content" class="form-label">Main Paragraph Content</label>
                            <textarea class="form-control" id="main_paragraph_content" name="main_paragraph_content" rows="5">{{ old('main_paragraph_content') }}</textarea>
                            @error('main_paragraph_content')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="draggable-item" data-id="extra_images">
                <div class="card mb-3">
                    <div class="card-header"><h6>Extra Images (Optional)</h6></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="extr-images" class="form-label">Extra Images</label>
                            <input type="file" class="form-control" id="extr-images" name="extr-images[]" multiple accept="image/*">
                            @error('extr-images.*')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="draggable-item" data-id="page_settings">
                <div class="card mb-3">
                    <div class="card-header"><h6>Page Settings</h6></div>
                    <div class="card-body">
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="is_homepage" name="is_homepage" value="1" {{ old('is_homepage') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_homepage">Set as Homepage</label>
                            @error('is_homepage')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Create Page</button>
        <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    #draggable-form-fields .card-header {
        cursor: move;
    }
    .select2-container--default .select2-selection--multiple {
        border: 1px solid #ced4da;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let sliderIndex = {{ old('sliders') ? count(old('sliders')) : 0 }};

        document.getElementById('add-slider-btn').addEventListener('click', function() {
            var sliderTemplate = `
                @include('admin.pages.partials.slider_item', ['key' => 'REPLACE_KEY', 'slider' => null])
            `;
            var newSliderHtml = sliderTemplate.replace(/REPLACE_KEY/g, sliderIndex);
            
            var tempDiv = document.createElement('div');
            tempDiv.innerHTML = newSliderHtml;
            document.getElementById('sliders-container').appendChild(tempDiv.firstElementChild);
            sliderIndex++;
        });

        document.getElementById('sliders-container').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-slider-btn')) {
                e.target.closest('.slider-item').remove();
            }
        });
    });

    $(document).ready(function() {
        $('#category_ids').select2({
            placeholder: "Select one or more categories",
            allowClear: true
        });
    });

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

            var initialOrder = {!! json_encode(old('settings_order')) ?? '[]' !!};
            if (initialOrder && initialOrder.length > 0) {
                var container = document.getElementById('draggable-form-fields');
                JSON.parse(initialOrder).forEach(function(id) {
                    var item = container.querySelector('.draggable-item[data-id="' + id + '"]');
                    if (item) {
                        container.appendChild(item);
                    }
                });
            } else {
                 // Set initial order on page load
                var order = [];
                var items = el.querySelectorAll('.draggable-item');
                items.forEach(function (item) {
                    order.push(item.dataset.id);
                });
                document.getElementById('settings_order').value = JSON.stringify(order);
            }
        }
    });
</script>
@endpush

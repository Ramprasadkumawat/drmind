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
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option value="">Select a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                    <div class="card-header"><h6>Slider (Optional)</h6></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="slider_text" class="form-label">Slider Text</label>
                            <textarea class="form-control" id="slider_text" name="slider_text" rows="3">{{ old('slider_text') }}</textarea>
                            @error('slider_text')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="slider_image" class="form-label">Slider Image</label>
                            <input type="file" class="form-control" id="slider_image" name="slider_image" accept="image/*">
                            @error('slider_image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
<style>
    #draggable-form-fields .card-header {
        cursor: move;
    }
</style>
@endpush

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

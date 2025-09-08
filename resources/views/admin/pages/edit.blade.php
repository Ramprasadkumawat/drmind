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
                            <label for="category_ids" class="form-label">Categories</label>
                            <select class="form-control" id="category_ids" name="category_ids[]" multiple="multiple" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ in_array($category->id, $page->category_ids ?? []) ? 'selected' : '' }}>{{ $category->name }}</option>
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
                        @elseif($page->sliders)
                             @foreach($page->sliders as $key => $slider)
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
                            <textarea class="form-control" id="main_paragraph_content" name="main_paragraph_content" rows="5">{{ old('main_paragraph_content', $page->main_paragraph_content) }}</textarea>
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
            
            <div class="draggable-item" data-id="page_settings">
                <div class="card mb-3">
                    <div class="card-header"><h6>Page Settings</h6></div>
                    <div class="card-body">
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
        let sliderIndex = {{ $page->sliders ? count($page->sliders) : (old('sliders') ? count(old('sliders')) : 0) }};

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
        var container = document.getElementById('draggable-form-fields');
        if (container) {
            // Function to update the hidden input with the current order
            function updateOrderInput() {
                var order = [];
                var items = container.querySelectorAll('.draggable-item');
                items.forEach(function (item) {
                    order.push(item.dataset.id);
                });
                document.getElementById('settings_order').value = JSON.stringify(order);
            }

            // Initialize SortableJS
            var sortable = Sortable.create(container, {
                animation: 150,
                handle: '.card-header',
                onEnd: updateOrderInput // Update the input whenever an item is dropped
            });

            // Get the order saved in the database
            var savedOrder = {!! $page->settings_order ?? '[]' !!};
            // Get all possible draggable items from the page HTML
            var allPossibleItems = Array.from(container.querySelectorAll('.draggable-item')).map(item => item.dataset.id);

            // Create a new, complete order. Start with the saved order,
            // then append any new items that have been added to the form since the last save.
            var newOrder = [];
            if (savedOrder.length > 0) {
                newOrder = [...savedOrder];
                allPossibleItems.forEach(id => {
                    if (!newOrder.includes(id)) {
                        newOrder.push(id); // Add new items to the end
                    }
                });
            } else {
                newOrder = allPossibleItems;
            }

            // Reorder the elements on the page to match the new, complete order
            newOrder.forEach(function(id) {
                var item = container.querySelector('.draggable-item[data-id="' + id + '"]');
                if (item) {
                    container.appendChild(item);
                }
            });
            
            // IMPORTANT: Set the initial value of the hidden input on page load.
            // This fixes the bug where the order was being wiped on save.
            updateOrderInput();
        }
    });
</script>
@endpush

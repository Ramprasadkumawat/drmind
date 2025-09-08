<div class="slider-item border rounded p-3 mb-3" data-index="{{ $key }}">
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-danger btn-sm remove-slider-btn">
            <i class="fas fa-minus"></i> Remove
        </button>
    </div>
    <div class="mb-3">
        <label for="sliders_{{ $key }}_title" class="form-label">Slider Title</label>
        <input type="text" class="form-control" id="sliders_{{ $key }}_title" name="sliders[{{ $key }}][title]" value="{{ $slider['title'] ?? '' }}">
    </div>
    <div class="mb-3">
        <label for="sliders_{{ $key }}_description" class="form-label">Slider Description</label>
        <textarea class="form-control" id="sliders_{{ $key }}_description" name="sliders[{{ $key }}][description]" rows="3">{{ $slider['description'] ?? '' }}</textarea>
    </div>
    <div class="mb-3">
        <label for="sliders_{{ $key }}_image" class="form-label">Slider Image</label>
        <input type="file" class="form-control" id="sliders_{{ $key }}_image" name="sliders[{{ $key }}][image]" accept="image/*">
        
        @if(isset($slider['image_path']))
            <div class="mt-2">
                <img src="{{ asset('storage/' . $slider['image_path']) }}" alt="Slider Image" style="max-width: 150px; height: auto;">
                <input type="hidden" name="sliders[{{ $key }}][image_path]" value="{{ $slider['image_path'] }}">
                <div class="form-check mt-1">
                    <input class="form-check-input" type="checkbox" name="sliders[{{ $key }}][delete_image]" value="1" id="delete_slider_image_{{ $key }}">
                    <label class="form-check-label" for="delete_slider_image_{{ $key }}">Delete Current Image</label>
                </div>
            </div>
        @endif
    </div>
</div>

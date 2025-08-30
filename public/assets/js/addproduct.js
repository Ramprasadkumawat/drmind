$(document).ready(function () {
    $('#product_category').on('change', function () {
      var categoryId = $(this).val();
  
      if (categoryId) {
        $.ajax({
          url: '/add-product/getsubcategory/' + categoryId,
          type: 'GET',
          dataType: 'json',
          success: function (data) {
            $('#product_subcategory').empty();
            $('#product_subcategory').append('<option value="">Select sub-category</option>');
            $.each(data, function (key, value) {
              $('#product_subcategory').append('<option value="' + value.id + '">' + value.name + '</option>');
            });
          }
        });
      } else {
        $('#product_subcategory').empty().append('<option value="">Select sub-category</option>');
      }
   
    });
    let price;
    let discountedPrice;
    
    // On discount type change
    $('#product_discount').on('change', function () {
      var discountType = $(this).val();
      var discountValue = parseFloat($("#discount_value").val());
      var basePrice = parseFloat($("#base_price").val());
    
      $("#showProductPricediv").hide();
    
      if (discountType != 'none') {
        $("#showProductPricediv").show();
      }
    
      // If "none", reset price
      if (discountType == 'none') {
        if (!isNaN(basePrice)) {
          $('#product_price').val(basePrice.toFixed(2));
        } else {
          $('#product_price').val('');
        }
      } else {
        // Recalculate price on discount type switch
        if (!isNaN(discountValue) && !isNaN(basePrice)) {
          if (discountType == "percentage") {
            discountedPrice = basePrice - (basePrice * discountValue / 100);
          } else if (discountType == "fixed") {
            discountedPrice = basePrice - discountValue;
          }
          $("#product_price").val(discountedPrice.toFixed(2));
        }
      }
    });
    
    // On base price change
    $('#base_price').on('input', function () {
      price = parseFloat($(this).val());
    
      if (!isNaN(price)) {
        $('#product_price').val(price.toFixed(2));
        $('#product_price').attr('readonly', false);
    
        // Recalculate if discount already selected
        $('#discount_value').trigger('input');
      } else {
        $('#product_price').val('');
      }
    });
    
    // On discount value change
    $("#discount_value").on('input', function () {
      var discountValue = parseFloat($(this).val());
      var basePrice = parseFloat($("#base_price").val());
      var discountType = $("#product_discount").val();
    
      if (isNaN(basePrice)) return;
    
      if (discountType == "percentage" && !isNaN(discountValue)) {
        discountedPrice = basePrice - (basePrice * discountValue / 100);
        $("#product_price").val(discountedPrice.toFixed(2));
      } else if (discountType == "fixed" && !isNaN(discountValue)) {
        discountedPrice = basePrice - discountValue;
        $("#product_price").val(discountedPrice.toFixed(2));
      } else {
        $("#product_price").val(basePrice.toFixed(2));
      }
    });
    

    document.getElementById('addSpecification').addEventListener('click', function (e) {
        e.preventDefault();
      
        const label = document.getElementById('specification-label').value.trim();
        const property = document.getElementById('specification-property').value.trim();
      
        if (label === '' || property === '') {
          alert('Please enter both label and property.');
          return;
        }
      
        const specContainer = document.createElement('div');
        specContainer.className = 'row gx-2 flex-between-center mb-3 specification-item';
      
        specContainer.innerHTML = `
          <div class="col-sm-3">
            <h6 class="mb-0 text-600">${label}</h6>
          </div>
          <div class="col-sm-9">
            <div class="d-flex flex-between-center">
              <h6 class="mb-0 text-700">${property}</h6>
              <a class="btn btn-sm btn-link text-danger remove-spec" href="#!" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove">
                <span class="fs-10 fas fa-trash-alt"></span>
              </a>
            </div>
          </div>
        `;
      
        // Insert before input row
        const list = document.getElementById('specificationList');
        list.insertBefore(specContainer, list.lastElementChild);
      
        // Clear inputs
        document.getElementById('specification-label').value = '';
        document.getElementById('specification-property').value = '';
      });
      
      // Remove functionality using event delegation
      document.getElementById('specificationList').addEventListener('click', function (e) {
        if (e.target.closest('.remove-spec')) {
          e.preventDefault();
          e.target.closest('.specification-item').remove();
        }
      });
      


      let editorDescription, editorShortDesc;

      ClassicEditor
      .create(document.querySelector('#editor'))
      .then(editor => {
        editorDescription = editor;
      });
  
    ClassicEditor
      .create(document.querySelector('#editor1'))
      .then(editor => {
        editorShortDesc = editor;
      });

      $.validator.addMethod("ckeditorRequired", function (value, element, params) {
        let editorInstance = params();
        return editorInstance && editorInstance.getData().trim().length > 0;
      }, "This field is required.");
      // Add event listener for the "Add Product" button

      $('#dropzoneMultipleFileUpload').validate({
        rules: {
          product_name: {
            required: true
          },
          manufacturar_name: {
            required: true
          },
          product_identification_no: {
            required: true
          },
          product_sku: {
            required: true
          },
          product_status: {
            required: true
          },
          publish_date: {
            required: true,
          },
          product_stock: {
            required: true,
            digits: true
          },
          level_one: {
            required: true,
            digits: true
          },
          level_two: {
            required: true,
            digits: true
          },
          level_three: {
            required: true,
            digits: true
          },
          earning_point: {
            required: true,
            digits: true
          },
          product_category: {
            required: true
          },
         
          tags: {
            required: true
          },
          description: {
            ckeditorRequired: function () {
              return editorDescription;
            }
          },
          short_description: {
            ckeditorRequired: function () {
              return editorShortDesc;
            }
          },
        
          base_price:{
            required: true,
            number: true
          },
          "file[]": {
            required: true,
            extension: "jpg|jpeg|png|gif|bmp",
            filesize: 2048
          }
        },
        messages: {
          product_name: "Please enter the product name.",
          manufacturar_name: "Please enter the manufacturer name.",
          product_identification_no: "Please enter the product identification number.",
          product_sku: "Please enter the product SKU.",
          product_status: "Please select the product status.",
          publish_date: "Please select the publish date.",
          product_stock: "Please enter a valid stock number.",
          level_one: "Please enter a valid number for level one.",
          level_two: "Please enter a valid number for level two.",
          level_three: "Please enter a valid number for level three.",
          earning_point: "Please enter a valid earning point.",
          product_category: "Please select the product category.",
          //product_subcategory: "Please select the product subcategory.",
            base_price: "Please enter a valid base price.",
          tags: "Please enter some tags for the product.",
          editor: "Please provide a description for the product.",
          short_description: "Please provide a short description for the product.",
          'file[]': {
            required: "Please upload at least one image.",
            extension: "Only image files are allowed.",
            filesize: "File size must be less than 2 MB."
          }
        },
        errorPlacement: function (error, element) {
            if (element.attr("name") === "file[]") {
                console.log('suhder', error);
                error.appendTo('#product-image-error');
                $('#product-image-error').show();
            } else {
                error.insertAfter(element);
            }
        },
        errorClass: "text-danger",
        highlight: function(element) {
          $(element).addClass("is-invalid");
        },
        unhighlight: function(element) {
          $(element).removeClass("is-invalid");
        },
        submitHandler: function(form) {
          form.submit(); // Submit the form if it's valid
        }
      });
    
      // Custom file size validation method
      $.validator.addMethod("filesize", function(value, element, param) {
        if (element.files && element.files[0]) {
          var fileSize = element.files[0].size / 1024 / 1024; // in MB
          return fileSize <= param;
        }
        return true;
      }, "File size must be less than 2 MB.");
});
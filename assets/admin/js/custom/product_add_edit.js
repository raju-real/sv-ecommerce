(function ($) {
    "use strict";
    let base_url = $('meta[name="base-url"]').attr('base_url');

    let config = {
            toolbar: [
                ['Bold', 'Italic', 'Strike', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'NumberedList', 'BulletedList'],
            ]
        };

        CKEDITOR.config.allowedContent = true;
        CKEDITOR.replace('product_details', config);

    const subCategorySelector = $('#subcategory');
    const subSubcategorySelector = $('#sub_subcategory');

    const category_id = $('#category').val();
    if (category_id) {
        appendSubCategory(category_id);
    }

    $(document).on('change', '#category', function () {
        subCategorySelector.empty().append('<option value="">Select Subcategory</option>');
        subSubcategorySelector.empty().append('<option value="">Select Sub Subcategory</option>');
        const category_id = $(this).val();
        appendSubCategory(category_id);
    });

    $(document).on('change', '#subcategory', function () {
        const sub_category_id = $(this).val();
        $.ajax({
            url: base_url + "/api/subcategory-wise-sub-subcategories/" + sub_category_id,
            success: function (response) {
                $.each(response, function (i, sub_subcategory) {
                    subSubcategorySelector.append($('<option>', {
                        value: sub_subcategory.id,
                        text: sub_subcategory.name
                    }));
                });
            }
        });
    });

    function appendSubCategory(category_id) {
        $.ajax({
            url: base_url + "/api/category-wise-subcategories/" + category_id,
            success: function (response) {
                $.each(response, function (i, subcategory) {
                    const option = $('<option>', {
                        value: subcategory.id,
                        text: subcategory.name
                    });

                    const oldSelectedValue = subCategorySelector.data('old-value');
                    if (oldSelectedValue !== undefined && oldSelectedValue !== null && oldSelectedValue === subcategory.id) {
                        option.attr('selected', 'selected');
                    }

                    subCategorySelector.append(option);
                });
            }
        });
    }

    $(document).on('click', '.brand-add-button', function (event) {
        event.preventDefault();
        const formData = new FormData($('#brand-add-form')[0]);

        $.ajax({
            url: base_url + '/brands',
            method: 'POST',
            data: formData,
            contentType: false, // Set content type to false for FormData
            processData: false, // Prevent jQuery from processing the data
            dataType: 'json',
            success: function (response) {
                $('.brand-form-control').removeClass('border-danger');
                $('.brand-error-message').empty();
                const brandSelector = $('#brand');
                const newBrand = response; // or use response.value if available

                if ($('#brand option[value="' + newBrand + '"]').length === 0) {
                    const option = $('<option>', {
                        value: newBrand.id,
                        text: newBrand.name
                    });
                    option.attr('selected', 'selected');
                    brandSelector.append(option);
                }

                $('#brand-add-form').trigger('reset');
                $('#brand-add-modal').modal('hide');
            },
            error: function (error) {
                if (error.status === 422) {
                    let errors = error.responseJSON.errors;
                    $('.brand-form-control').removeClass('border-danger');
                    $('.brand-error-message').empty();
                    $.each(errors, function (field, messages) {
                        $('.brand-' + field + '-input').addClass('border-danger');
                        $('#brand_' + field + '_error').empty().text(messages[0]);
                    });
                }
            }
        });
    });

    $(document).on('click', '.unit-add-button', function (event) {
        event.preventDefault();
        $.ajax({
            url: base_url + '/units',
            method: 'POST',
            data: $('#unit-add-form').serialize(),
            dataType: 'json',
            success: function (response) {
                $('.unit-form-input').removeClass('is-invalid');
                $('#unit_name_error').empty();
                const unitSelector = $('#unit');
                const newUnit = response.data; // or use response.value if available

                if ($('#unit option[value="' + newUnit + '"]').length === 0) {
                    const option = $('<option>', {
                        value: newUnit,
                        text: newUnit
                    });
                    option.attr('selected', 'selected');
                    unitSelector.append(option);
                }

                $('#unit-add-form').trigger('reset');
                $('#unit-add-modal').modal('hide');
            },
            error: function (error) {
                if (error.status === 422) {
                    let errors = error.responseJSON.errors;
                    $('.unit-form-input').removeClass('is-invalid');
                    $.each(errors, function (field, messages) {
                        $('.unit-form-input').addClass('is-invalid');
                        $('#unit_name_error').empty().text(messages[0]);
                    });
                }
            }
        });
    });

    $(document).on('click', '.size-add-button', function (event) {
        event.preventDefault();
        $.ajax({
            url: base_url + '/sizes',
            method: 'POST',
            data: $('#size-add-form').serialize(),
            dataType: 'json',
            success: function (response) {
                $('.size-form-input').removeClass('is-invalid');
                $('#size_name_error').empty();
                const sizeSelector = $('#size');
                const newSize = response.data; // or use response.value if available

                if ($('#size option[value="' + newSize + '"]').length === 0) {
                    sizeSelector.append($('<option>', {
                        value: newSize,
                        text: newSize
                    }));
                }

                sizeSelector.val(sizeSelector.val().concat(newSize)); // Select the newly added option
                sizeSelector.trigger('change');
                $('#size-add-form').trigger('reset');
                $('#size-add-modal').modal('hide');
            },
            error: function (error) {
                if (error.status === 422) {
                    let errors = error.responseJSON.errors;
                    $('.size-form-input').removeClass('is-invalid');
                    $.each(errors, function (field, messages) {
                        $('.size-form-input').addClass('is-invalid');
                        $('#size_name_error').empty().text(messages[0]);
                    });
                }
            }
        });
    });

    $(document).on('click', '.color-add-button', function (event) {
        event.preventDefault();
        $.ajax({
            url: base_url + '/colors',
            method: 'POST',
            data: $('#color-add-form').serialize(),
            dataType: 'json',
            success: function (response) {
                $('.color-form-input').removeClass('is-invalid');
                $('#color_name_error').empty();
                const colorSelector = $('#color');
                const newColor = response.data; // or use response.value if available

                if ($('#color option[value="' + newColor + '"]').length === 0) {
                    colorSelector.append($('<option>', {
                        value: newColor,
                        text: newColor
                    }));
                }

                colorSelector.val(colorSelector.val().concat(newColor)); // Select the newly added option
                colorSelector.trigger('change');
                $('#color-add-form').trigger('reset');
                $('#color-add-modal').modal('hide');
            },
            error: function (error) {
                if (error.status === 422) {
                    let errors = error.responseJSON.errors;
                    $('.color-form-input').removeClass('is-invalid');
                    $.each(errors, function (field, messages) {
                        $('.color-form-input').addClass('is-invalid');
                        $('#color_name_error').empty().text(messages[0]);
                    });
                }
            }
        });
    });

    $(document).on('click', '.tag-add-button', function (event) {
        event.preventDefault();
        $.ajax({
            url: base_url + '/tags',
            method: 'POST',
            data: $('#tag-add-form').serialize(),
            dataType: 'json',
            success: function (response) {
                $('.tag-form-input').removeClass('is-invalid');
                $('#tag_name_error').empty();
                const tagSelector = $('#tag');
                const newTag = response.data; // or use response.value if available

                if ($('#tag option[value="' + newTag + '"]').length === 0) {
                    tagSelector.append($('<option>', {
                        value: newTag,
                        text: newTag
                    }));
                }

                tagSelector.val(tagSelector.val().concat(newTag)); // Select the newly added option
                tagSelector.trigger('change');
                $('#tag-add-form').trigger('reset');
                $('#tag-add-modal').modal('hide');
            },
            error: function (error) {
                if (error.status === 422) {
                    let errors = error.responseJSON.errors;
                    $('.tag-form-input').removeClass('is-invalid');
                    $.each(errors, function (field, messages) {
                        $('.tag-form-input').addClass('is-invalid');
                        $('#tag_name_error').empty().text(messages[0]);
                    });
                }
            }
        });
    });

    $(document).on('click', '#add_image', function() {
        let file_div = `<tr>
            <td class="w-90">
                <input type="file" name="images[]" class="form-control" accept=".jpg,.jpeg,.png">
            </td>
            <td class="w-10 pull-right">
                <button type="button" class="btn btn-md btn-danger text-right remove_image">
                <i class="fa fa-trash"></i>
            </button>
            </td>
        </tr>`;

        $('#image_table').find('tbody').append(file_div);
    });

    $(document).on('click', '.remove_image', function(){
        let event = this;
        $(event).parent().parent().remove();
    });

    $(document).on('click', '#product-submit', function (event) {
        event.preventDefault();

        const formData = new FormData($('#product-form')[0]);

        const productDetails = CKEDITOR.instances["product_details"].getData();
        formData.append('product_details', productDetails);

        $.ajax({
            url: base_url + '/products',
            method: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false, // Set content type to false for FormData
            processData: false, // Prevent jQuery from processing the data
            success: function (response) {
                // Reset form styling and error messages
                $('.form-control').removeClass('border-danger');
                $('.product-error-message').empty();

                if (response.status === "success") {
                    Swal.fire({
                        text: response.message,
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#6495ed",
                        confirmButtonText: "Go to product lists",
                        cancelButtonText: "Add More"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = base_url + '/products';
                        } else {
                            window.location.href = base_url + '/products/create';
                        }
                    });
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: response.message
                    });
                }
            },
            error: function (error) {
                if (error.status === 422) {
                    let errors = error.responseJSON.errors;
                    $('.product-input-control').removeClass('border-danger');
                    $('.product-error-message').empty();

                    $.each(errors, function (field, messages) {
                        $('.product_' + field).addClass('border-danger');
                        $('#product_' + field + '_error').empty().text(messages[0]);

                        if (field.startsWith('sizes')) {
                            let errorMessage = 'Sizes must be valid and not exceed 50 characters each and the total length must not exceed 450 characters.';
                            $('.product_sizes').addClass('border-danger');
                            $('#product_sizes_error').text(errorMessage);
                        }
                        if (field.startsWith('colors')) {
                            let errorMessage = 'Colors must be valid and not exceed 50 characters each and the total length must not exceed 450 characters.';
                            $('.product_colors').addClass('border-danger');
                            $('#product_colors_error').text(errorMessage);
                        }
                        if (field.startsWith('tags')) {
                            let errorMessage = 'Tags must be valid and not exceed 50 characters each and the total length must not exceed 450 characters.';
                            $('.product_tags').addClass('border-danger');
                            $('#product_tags_error').text(errorMessage);
                        }
                        if (field.startsWith('images')) {
                            let errorMessage = 'Please upload valid image files type of (jpg, jpeg or png) up to 1MB each.';
                            $('#product_images_error').text(errorMessage);
                        }
                    });
                }
            }
        });
    });

})(jQuery);

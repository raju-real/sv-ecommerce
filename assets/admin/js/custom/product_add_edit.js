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

    const category_id = $('#category').val();
    if (category_id) {
        appendSubCategory(category_id);
    }

    $(document).on('change', '#category', function () {
        const category_id = $(this).val();
        appendSubCategory(category_id);
    });

    function appendSubCategory(category_id) {
        subCategorySelector.empty().append('<option value="">Select Subcategory</option>');
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

    $(document).on('click', '#add_image', function() {
        let file_div = `<tr>
            <td class="w-90">
                <input type="file" name="images[]" class="form-control">
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

})(jQuery);

(function ($) {
    "use strict";
    let base_url = $('meta[name="base-url"]').attr('base_url');
    const subCategorySelector = $('#subcategory');

    const category_id = $('#category').val();
    if (category_id) {
        appendSubCategory(category_id);
    }

    $(document).on('change', '#category', function () {
        const category_id = $(this).val();
        if(category_id) {
            appendSubCategory(category_id);
        } else {
            subCategorySelector.empty().append('<option value="">Select Subcategory</option>');
        }
    });

    function appendSubCategory(category_id) {
        subCategorySelector.empty().append('<option value="">Select Subcategory</option>');
        $.ajax({
            url: base_url + "/api/category-wise-subcategories/" + category_id,
            success: function (response) {
                const appendValueKey = response.append_value || 'id';
                $.each(response.subcategories, function (i, subcategory) {
                    const optionValue = appendValueKey === 'id' ? subcategory.id : subcategory.slug;
                    const option = $('<option>', {
                        value: optionValue,
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

})(jQuery);

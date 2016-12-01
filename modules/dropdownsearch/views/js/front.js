function dropdownsearch_getModels(val) {
    //clear other options
    $('#dropdownsearch_model option[value!=""], #dropdownsearch_type option[value!=""]').each(function() {
        $(this).remove();
    });
    $('#dropdownsearch_model').prop('disabled', 'disabled');
    $('#dropdownsearch_type').prop('disabled', 'disabled');
    //if something is chosen create avail options
    if (val) {
        $.ajax({
            type: "POST",
            url: baseDir + 'modules/dropdownsearch/ajax/getmodels.php',
            data: 'dropdownsearch_make=' + val,
            dataType: "json",
            success: function(data) {
                if (data.length === 0) {
                    return;
                }
                $.each(data, function(i, item) {
                    $('#dropdownsearch_model').append($('<option>', {
                        value: item.id_attribute,
                        text: item.name
                    }));
                });
                $('#dropdownsearch_model').prop('disabled', false);
            }
        });
    }
}


function dropdownsearch_getTypes(val) {
    //clear other options
    $('#dropdownsearch_type option[value!=""]').each(function() {
        $(this).remove();
    });
    $('#dropdownsearch_type').prop('disabled', 'disabled');
    //if something is chosen create avail options
    if (val) {
        $.ajax({
            type: "POST",
            url: baseDir + 'modules/dropdownsearch/ajax/gettypes.php',
            data: 'dropdownsearch_type=' + val,
            dataType: "json",
            success: function(data) {
                if (data.length === 0) {
                    return;
                }
                $.each(data, function(i, item) {
                    $('#dropdownsearch_type').append($('<option>', {
                        value: item.id_attribute,
                        text: item.name
                    }));
                });
                $('#dropdownsearch_type').prop('disabled', false);
            }
        });
    }
}


function dropdownsearch_submitSearch() {
    $.ajax({
        type: "POST",
        url: baseDir + 'modules/dropdownsearch/ajax/createsearchlink.php',
        data: $('form#dropdownsearch_form').serialize(),
        success: function(data) {
            window.location.replace(baseDir + "search?controller=search&orderby=position&orderway=desc&search_query=" + data);
        }
    });
}

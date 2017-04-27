$('.autocomplete').each(function () {
    var model = $(this).data('model');
    var display_attribute = $(this).data('display');
    // constructs the suggestion engine
    var dataset = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace(display_attribute),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        identify: function (obj) {
            return obj.id
        },
        prefetch: {
            url: '/list/' + model + '.json',
            cache: false
        }
    });

    $(this).typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: model,
            source: dataset,
            display: display_attribute
        }).bind('typeahead:select', function (ev, suggestion) {
        $('#' + model + '_id').val(suggestion.id);
    });
});
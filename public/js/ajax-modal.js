function getDataById(hyperlink, modalName) {
    $('#form')[0].reset(); // Reset form on modals.

    // AJAX load data from url.
    $.ajax({
        url      : hyperlink,
        type     : 'GET',
        dataType : 'JSON',
        success  : function(data) {
            $('[name="id"]').val(data.id);

            // Trigger modal.
            $('#' + modalName).modal('show'); // Show bootstrap modal when complete loaded.
        },
        error    : function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');

            // console.log(jqXHR);
            // console.log(textStatus);
            // console.log(errorThrown);
        }
    });
}
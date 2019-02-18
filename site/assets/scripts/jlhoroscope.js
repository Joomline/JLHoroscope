
jQuery( document ).ready(function() {
    var url = '/index.php?option=com_jlhoroscope&view=horoscopes&task=horoscopes.update_horo';
    jQuery.ajax({
        type: "GET",
        cache: false,
        dataType: "text",
        url: url

    }).success(
        function (data) {
            // console.log('update_horo: success '+data);
        });
});
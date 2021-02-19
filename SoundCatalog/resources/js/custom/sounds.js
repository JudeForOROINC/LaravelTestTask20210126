// данный код является экспериментальным

// экспериментально
if( window.location.pathname == '/sound' ) {

    $(document).ready(function () {
        $('form[name="searchForm"]').submit(function (e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function (data) {
                    $('#table_sounds tbody').empty().html(data);
                }
            });
        });
    });


}

// данный код является экспериментальным

// экспериментально
if( window.location.pathname.substr(0, '/sound/group_by_categories'.length) == '/sound/group_by_categories' ){

    $(document).ready(function () {
        $('form[name="searchForm"]').submit(function(e){
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(data) {
                    $('#table_sounds').empty().html(data);
                }
            });
        });
    });


}

@extends('base')


@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Instructions</h1>

            <script>
                $(function() {
                    $('form[name="searchForm"]').submit(function(e){
                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('instructions.ajax.search')}}',
                            data: $(this).serialize(),
                            success: function(data) {
                                //$("#msg").html(data.msg);

                                let section = $('#ajax_section');
                                section.html(data);
                            }
                        });
                    });
                });
            </script>

            <form name="searchForm" action="{{ route('instructions.search')}}" method="post">
                @csrf
                <input type="text" name="searchString" />
                <button class="btn btn-primary" type="submit">Search</button>
            </form>

            <div id="msg"></div>
            <br>

            @if (Auth::guest())
                Only registred users can be use this function.
            @else
                <a href="{{ route('instructions.create') }}" class="mb-3 btn btn-primary">Add instruction</a>
            @endif

            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Description</td>
                    <td>Status</td>
                    <td colspan=2>Actions</td>
                </tr>
                </thead>
                <tbody id="ajax_section">
                    @yield('table_instructions')

                </tbody>
            </table>
            <div>
            </div>
@endsection

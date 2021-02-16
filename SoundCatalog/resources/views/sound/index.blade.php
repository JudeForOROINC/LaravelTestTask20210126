@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">All Sounds</h1>

            <div class="row">
                <div class="col">
                    <a href="{{ route('sound.create') }}" class="mb-3 btn btn-primary">Add Sound</a>
                </div>
                <div class="col">
                    <div class="float-right">
                        <script>
                            $(function() {
                                $('form[name="searchForm"]').submit(function(e){
                                    e.preventDefault();

                                    $.ajax({
                                        type: 'POST',
                                        url: $(this).attr('action'),
                                        data: $(this).serialize(),
                                        success: function(data) {
                                            $('#table_sounds tbody').html('').html(data);
                                        }
                                    });
                                });
                            });
                        </script>

                        <form name="searchForm" action="{{ route('sound.search.ajax') }}" method="post">
                            @csrf
                            <input type="text" name="searchString" />
                            <button class="btn btn-primary" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </div>


            <table class="table table-striped" id="table_sounds">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Title</td>
                    <td colspan="3">Actions</td>
                </tr>
                </thead>
                <tbody>
                    @include('sound.parts._items')
                </tbody>
            </table>
            <div>

            </div>
        </div>


@endsection

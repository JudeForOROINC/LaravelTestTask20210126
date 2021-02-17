@extends('base')

@section('main')


{{-- рабочий вариант, но неправильный --}}

{{--    <ul>--}}
{{--    @foreach($soundCategories as $soundCategory)--}}
{{--        <li>--}}
{{--            <h4>{{ $soundCategory->title }}</h4>--}}
{{--            <table>--}}
{{--                <tbody>--}}
{{--                @foreach($sounds as $sound)--}}
{{--                    @if($sound->category_id == $soundCategory->id)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $sound->title }}</td>--}}
{{--                        </tr>--}}
{{--                    @endif--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--            </table>--}}
{{--        </li>--}}
{{--    @endforeach--}}
{{--    </ul>--}}


<div class="row">
    <div class="col-12">
        <h1 class="display-3">Sounds Grouped by Categories</h1>

        <div class="row">
            <div class="col">
                <div class="float-right">
                    <form id="searchForm" name="searchForm" action="{{ route('sound.search.ajax.groupbycategory') }}" method="post">
                        @csrf
                        <input type="text" name="searchString" placeholder="category name" />
                        <button class="btn btn-primary" type="submit">Search</button>
                    </form>

                    <script type="text/javascript">
                        $(document).ready(function () {
                            $('form[name="searchForm"]').submit(function(e){
                                e.preventDefault();

                                $.ajax({
                                    type: 'POST',
                                    url: $(this).attr('action'),
                                    data: $(this).serialize(),
                                    success: function(data) {
                                        $('#table_sounds').empty().html(data); // не tbody
                                    }
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>

        <ul id="table_sounds" class="list-group">
            @include('sound.parts._itemsGroupByCategories')
        </ul>

@endsection

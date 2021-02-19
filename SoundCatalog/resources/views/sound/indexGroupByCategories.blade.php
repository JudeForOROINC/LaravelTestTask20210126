@extends('base')

@section('main')

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
                </div>
            </div>
        </div>

        <ul id="table_sounds" class="list-group">
            @include('sound.parts._itemsGroupByCategories')
        </ul>

    </div>
</div>

@endsection

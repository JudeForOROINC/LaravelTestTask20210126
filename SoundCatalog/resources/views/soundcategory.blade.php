@extends('base')

@section('main')

    <div class="row">
        <div class="col-12">
            <h1 class="display-3">Sound Categories</h1>

            <a href="{{ route('soundcategory.create') }}" class="mb-3 btn btn-primary">Add Sound Category</a>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Title</td>
                        <td colspan="3">Actions</td>
                    </tr>
                </thead>
                <tbody id="table_soundcategory">
                @foreach($soundcategory as $soundcategory_item)
                    <tr>
                        <td>{{$soundcategory_item->id}}</td>
                        <td>{{$soundcategory_item->title}}</td>
                        <td>
                            @if( Auth::user() && (Auth::user()->id == $soundcategory_item->authorId || Auth::user()->hasRole('Admin') ) )
                                <a href="{{ route('soundcategory.edit',$soundcategory_item->id)}}" class="btn btn-primary">Edit</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('soundcategory.show',$soundcategory_item->id)}}" class="btn btn-primary">View</a>
                        </td>
                        <td>
                            @if( Auth::user() && (Auth::user()->id == $soundcategory_item->authorId || Auth::user()->hasRole('Admin') ) )
                                <form action="{{ route('soundcategory.destroy', $soundcategory_item->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>

        </div>
    </div>


@endsection

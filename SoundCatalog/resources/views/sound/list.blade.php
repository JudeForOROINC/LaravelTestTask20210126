@extends('base')

@section('main')
    <div class="row">
        <div class="col-12">
            <h1 class="display-3">All Sounds</h1>

            <a href="{{ route('sound.create') }}" class="mb-3 btn btn-primary">Add Sound</a>

            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>Title</td>
                    <td colspan="3">Actions</td>
                </tr>
                </thead>
                <tbody id="table_soundcategory">
                @foreach($sound as $sound_item)
                    <tr>
                        <td>{{$sound_item->id}}</td>
                        <td>{{$sound_item->title}}</td>
                        <td>
                            <a href="{{ route('sound.edit',$sound_item->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <a href="{{ route('sound.show',$sound_item->id)}}" class="btn btn-primary">View</a>
                        </td>
                        <td>
{{--                            @if( Auth::user() && Auth::user()->id == $sound_item->authorId )--}}
                                <form action="{{ route('sound.destroy', $sound_item->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
{{--                            @endif--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>

            </div>
        </div>


@endsection

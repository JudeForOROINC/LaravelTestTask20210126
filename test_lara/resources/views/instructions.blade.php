@extends('base')


@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Instructions</h1>

            <form action="{{ route('instructions.search')}}" method="post">
                @csrf
                <input type="text" name="searchString" />
                <button class="btn btn-primary" type="submit">Search</button>
            </form>

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
                <tbody>

                @foreach($instructions as $instruction)
                    <tr>
                        <td>{{$instruction->id}}</td>
                        <td>{{$instruction->name}}</td>
                        <td>{{$instruction->description}}</td>
                        <td>{{$instruction->status}}</td>
                        <td>
                            @if( Auth::user() && Auth::user()->id == $instruction->authorId )
                                <a href="{{ route('instructions.edit',$instruction->id)}}" class="btn btn-primary">Edit</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('instructions.show',$instruction->id)}}" class="btn btn-primary">View</a>
                        </td>
                        <td>
                            @if( Auth::user() && Auth::user()->id == $instruction->authorId )
                                <form action="{{ route('instructions.destroy', $instruction->id)}}" method="post">
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
@endsection

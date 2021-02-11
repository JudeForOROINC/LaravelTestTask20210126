@extends('base')


@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Complaints</h1>
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
                <tbody >
                @foreach($complaints as $complaint)
                    <tr>
                        <td>{{$instruction->user}}</td>
                        <td>{{$instruction->sound}}</td>
                        <td>{{$instruction->description}}</td>
                        <td>{{$instruction->soundсomplaint_statuses_id}}</td>
                        <td>

                                <a href="{{ route('instructions.edit',$instruction->id)}}" class="btn btn-primary">Edit</a>

                        </td>
                        <td>
                            <a href="{{ route('instructions.show',$instruction->id)}}" class="btn btn-primary">View</a>
                        </td>
                        <td>

                                <form action="{{ route('instructions.destroy', $instruction->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>

                        </td>
                    </tr>
                @endforeach


                </tbody>
            </table>
            <div>
            </div>
@endsection

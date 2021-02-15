@extends('base')


@section('main')
    <div class="row">
        <div class="col-sm-12">
            <h1 class="display-3">Complaints</h1>
            <br>

            @if (Auth::guest())
                Only registred users can be use this function.
            @else
                <a href="{{ route('complaints.create') }}" class="mb-3 btn btn-primary">Add complaint</a>
            @endif

            <table class="table table-striped">
                <thead>
                <tr>
                    <td>ID</td>
                    <td>User</td>
                    <td>Sound</td>
                    <td>Description</td>
                    <td>Status</td>
                    <td colspan=2>Actions</td>
                </tr>
                </thead>
                <tbody >
{{--                {{dd($complaints)}}--}}
                @foreach($complaints as $complaint)
                    <tr>
                        <td>{{$complaint->id}}</td>
                        <td>{{$complaint->name}}</td>
                        <td>{{$complaint->sound_id}}</td>
                        <td>{{ substr($complaint->description, 0, 20) }} {{ ( strlen($complaint->description) > 20 ? "..." : "")  }}</td>
                        <td>{{$complaint->tittle}}</td>

                                    @if ($role =='Admin')
                            <td>
                                <form action="{{ route('complaints.destroy', $complaint->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Reject</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('complaints.update', $complaint->id)}}" method="post">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success" type="submit">Accept</button>
                                </form>
                            </td>
                                    @endif


                        <td>
                            <a href="{{ route('complaints.show',$complaint->id)}}" class="btn btn-primary">View</a>
                        </td>

                    </tr>
                @endforeach


                </tbody>
            </table>
            <div>
            </div>
@endsection

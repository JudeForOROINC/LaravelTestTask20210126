@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">Add a Complaint</h1>
            <div>
{{--                @if ($errors->any())--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        <ul>--}}
{{--                            @foreach ($errors->all() as $error)--}}
{{--                                <li>{{ $error }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div><br/>--}}
{{--                @endif--}}
                <form enctype="multipart/form-data" method="post" action="{{ route('complaints.store') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Description:</label>
                        <input type="text" class="form-control" name="description"/>
{{--                        <input type="hidden" class="form-control" value="1" name="user_id"/>--}}
                        <input type="hidden" class="form-control" value="1" name="sound_id"/>
                        <input type="hidden" class="form-control" value="1" name="soundсomplaint_statuses_id"/>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Complaint</button>
                </form>
            </div>
        </div>
    </div>
@endsection

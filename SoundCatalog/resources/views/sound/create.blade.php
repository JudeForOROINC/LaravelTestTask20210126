@extends('base')

@section('main')
    <div class="row">
        <div class="col-6 offset-3">
            <h1 class="display-3">Add a Sound</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br/>
                @endif

                <form enctype="multipart/form-data" method="post" action="{{ route('sound.store') }}">
                    @csrf
                    <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" name="title"/>
                    </div>

                    <div class="form-group">
                        <label for="file">File:</label>
                        <input type="file" class="form-control" name="file"/>
                        <small class="form-text text-muted">Maximum file size 10 MB</small>
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="category_id" id="category_id">
                        @foreach($soundCategories as $soundCategory)
                            <option value="{{ $soundCategory->id }}">{{ $soundCategory->title }}</option>
                        @endforeach
                        </select>
                    </div>
{{--                    <div class="form-group">--}}
{{--                        <select name="soundstatusid" id="soundstatusid">--}}

{{--                        </select>--}}
{{--                    </div>--}}

{{--                    <input type="text" class="form-control" name="soundstatusid" value=""/>--}}

                    <button type="submit" class="btn btn-primary">Add Sound</button>
                </form>
            </div>
        </div>
    </div>
@endsection

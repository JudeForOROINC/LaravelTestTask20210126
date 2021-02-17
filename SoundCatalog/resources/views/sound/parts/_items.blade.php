@foreach($sounds as $sound)
    <tr>
        <td>{{ $sound->id }}</td>
        <td>{{ $sound->title }}</td>
        <td>{{ $sound->status }}</td>
        <td>
            {{--       @if( Auth::user() && Auth::user()->id == $sound->author_id )--}}
            <a href="{{ route('sound.edit', $sound->id) }}" class="btn btn-primary">Edit</a>
            {{--       @endif--}}
        </td>
        <td>
            <a href="{{ route('sound.show', $sound->id) }}" class="btn btn-primary">View</a>
        </td>
        <td>
            <a href="{{ route('complaints.soundComplaints', $sound->id )}}" class="btn btn-primary">Complaints</a>
        </td>
        <td>
            @if( Auth::user() && Auth::user()->id == $sound->author_id )
                <form action="{{ route('sound.destroy', $sound->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            @endif
        </td>
    </tr>
@endforeach

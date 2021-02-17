@foreach($items as $item)
    <li class="list-group-item" data-id="{{ $item['category_id'] }}">
        <h4 class="card-title">{{ $item['category_name'] }}</h4>
        <h6 class="card-subtitle mb-2 text-muted">Count sounds: {{ count($item['sounds']) }}</h6>

        <div class="row">
            <div class="col-12">
                 <table class="table table-striped" style=" table-layout: fixed; word-wrap: break-word; ">
                     <tbody>
                     @foreach($item['sounds'] as $sound)
                                 <tr class>
                                     <td>{{ $sound->id }}</td>
                                     <td>{{ $sound->title }}</td>
                                     <td>
                                         <a href="{{ route('sound.show', $sound->id) }}" class="btn btn-primary btn-sm" target="_blank">View</a>
                                     </td>
                                 </tr>
                     @endforeach
                     </tbody>
                 </table>
            </div>
        </div>
    </li>
@endforeach

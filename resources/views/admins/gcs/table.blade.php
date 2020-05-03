@foreach($gcs as $gc)
    <tr>
        <td>{!! $gc->id_guarantee !!}</td>
        <td>{!! $gc->information->name !!}</td>
        <td><a href="{{ route('gcs.edit',$gc->id) }}" class="btn btn-info">Sửa</a></td>
    </tr>
@endforeach

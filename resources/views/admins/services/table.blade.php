@foreach($services as $service)
    <tr>
        <td>{!! $service->name !!}</td>
        <td><a href="{{ route('services.edit',$service->id) }}" class="btn btn-info">Sửa</a></td>
    </tr>
@endforeach

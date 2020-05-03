@foreach($doctors as $doctor)
    <tr>
        <td>{!! $doctor->name !!}</td>
        <td><a href="{{ route('doctors.edit',$doctor->id) }}" class="btn btn-info">Sửa</a>
            <a href="{{ route('doctors.destroy',$doctor->id) }}" class="btn btn-danger"
               onclick="event.preventDefault();
                        document.getElementById('destroy-form').submit();"
            >Xoá</a>
            <form id="destroy-form" action="{{ route('doctors.destroy',$doctor->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </td>
    </tr>
@endforeach

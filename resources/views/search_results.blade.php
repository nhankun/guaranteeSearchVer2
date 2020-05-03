
<table class="table table-bordered"  width="100%" >
    <thead>
    <tr>
        <th>Mã bảo hiểm</th>
        <th>Tên khách hàng</th>
        <th>Hành động</th>
    </tr>
    </thead>
    <tbody >
    @foreach($results as $gc)
        <tr>
            <td>{!! $gc->id_guarantee !!}</td>
            <td>{!! $gc->information->name !!}</td>
            <td></td>
        </tr>
    @endforeach
    </tbody>
</table>

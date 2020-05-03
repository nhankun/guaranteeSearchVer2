@extends('admins.layouts.masters')

@section('content_main')

    <div class="container-fluid">
        <h1 class="mt-4">Quản lý dịch vụ</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
            <li class="breadcrumb-item active">Quản lý dịch vụ</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('services.update',$service->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" name="name" value="{{ $service->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" id="name">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn_add_user">Xác nhận</button>
                    <a href="{{ route('services.index') }}" class="btn btn-danger" data-dismiss="modal">Đóng</a>

                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection

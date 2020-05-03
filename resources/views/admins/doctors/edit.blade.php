@extends('admins.layouts.masters')

@section('content_main')

    <div class="container-fluid">
        <h1 class="mt-4">Bác sỹ</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
            <li class="breadcrumb-item active">Bác sỹ</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('doctors.update',$doctor->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Tên:</label>
                        <input type="text" name="name" value="{{ $doctor->name }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" id="name">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn_add_user">Xác nhận</button>
                    <a href="{{ route('doctors.index') }}" class="btn btn-danger">Đóng</a>

                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection

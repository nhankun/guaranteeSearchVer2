@extends('admins.layouts.masters')

@section('content_main')

    <div class="container-fluid">
        <h1 class="mt-4">Phiếu bảo hành</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
            <li class="breadcrumb-item active">Phiếu bảo hành</li>
        </ol>
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ route('gcs.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <fieldset class="form-group">
                            <legend class="">Thông tin khách hàng</legend>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="name">Tên:</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" id="name">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phone">Số điện thoại:</label>
                                    <input type="number" name="phone" value="{{ old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone" id="phone">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="date_of_birth">Ngày sinh:</label>
                                    <input type="text" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control @error('date_of_birth') is-invalid @enderror datetimepickers" placeholder="Ngày sinh" id="date_of_birth">
                                    @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="identity_card">Số CMND:</label>
                                    <input type="text" name="identity_card" value="{{ old('identity_card') }}" class="form-control @error('identity_card') is-invalid @enderror" placeholder="Cmnd" id="identity_card">
                                    @error('identity_card')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Địa chỉ:</label>
                                    <input type="text" name="address" value="{{ old('address') }}" class="form-control @error('address') is-invalid @enderror" placeholder="Địa chỉ" id="address">
                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gender">Giới tính:</label>
                                    <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="gender">
                                        <option value="male">Nam</option>
                                        <option value="female">Nữ</option>
                                    </select>
                                    @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <legend>Thông tin bảo hành</legend>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="id_guarantee">Mã bảo hành:</label>
                                <input type="text" name="id_guarantee" value="{{ old('id_guarantee') }}" class="form-control @error('id_guarantee') is-invalid @enderror" placeholder="Mã bảo hành" id="id_guarantee">
                                @error('id_guarantee')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="date_guarantee">Ngày bắt đầu:</label>
                                <input type="text" name="date_guarantee" value="{{ old('date_guarantee') }}" class="form-control @error('date_guarantee') is-invalid @enderror datetimepickers" placeholder="Ngày bảo hành" id="date_guarantee">
                                @error('date_guarantee')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="date_finish">Ngày kết thúc:</label>
                                <input type="text" name="date_finish" value="{{ old('date_finish') }}" class="form-control @error('date_finish') is-invalid @enderror datetimepickers" placeholder="Ngày kết thúc" id="date_finish">
                                @error('date_finish')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="service_id">Dịch vụ:</label>
                                <select name="service_id" class="form-control @error('service_id') is-invalid @enderror" id="service_id">
                                    @foreach($services as $sevice)
                                        <option value="{{ $sevice->id }}">{{ $sevice->name }}</option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
{{--                            <div class="form-group">--}}
{{--                                <label for="doctor_id">Bác sỹ:</label>--}}
{{--                                <select name="doctor_id" class="form-control @error('doctor_id') is-invalid @enderror" id="doctor_id">--}}
{{--                                    @foreach($doctors as $doctor)--}}
{{--                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('doctor_id')--}}
{{--                                <div class="invalid-feedback">{{ $message }}</div>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
                            <div class="form-group">
                                <label for="name_doctor">Bác sỹ thực hiện:</label>
                                <input type="text" name="name_doctor" value="{{ old('name_doctor') }}" class="form-control @error('name_doctor') is-invalid @enderror" placeholder="Tên bác sỹ" id="name_doctor">
                                @error('name_doctor')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="unit_tooth">Đơn vị răng:</label>
                                <input type="number" name="unit_tooth" value="{{ old('unit_tooth') }}" class="form-control @error('unit_tooth') is-invalid @enderror" placeholder="Đơn vị răng" id="unit_tooth">
                                @error('unit_tooth')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="note">Ghi chú:</label>
                                <input type="text" name="note" value="{{ old('note') }}" class="form-control @error('note') is-invalid @enderror" placeholder="Enter note" id="note">
                                @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </fieldset>
                    <fieldset class="form-group">
                        <legend>Hình ảnh</legend>
                        <div class="form-group">
                            <div class="form-group">
                                <label for="image_before">Hình ảnh trước:</label>

                                <div class="row">
                                    <div class="gallery col-md-4" style="{{empty($content->avatar) ? 'display:none' : ''}}" id="image_before_div">
                                        <img src="{{isset($content) ? asset(config('app.s3.link').$content->avatar) : ''}}"  id="image_before_place" style='height:200px;width:100%;border:1px solid grey'>
                                    </div>
                                    <div class="col-md-4" style="margin-left: 0">
                                        <div  style="height:200px;border:1px solid grey; ">
                                            <label  for="image_before" class="clone" style="width:100%;position: relative;height:100%" >
                                                <img src="{{ asset('/images/addimage2.png') }}" alt="upload photo" class="image_rounded imgId collapsed" id="gallery-photo-add" width="48px" style="margin-top:-8px;left: 43%; top: 40%;position: absolute;">
                                            </label>
                                            <input type="file" name="image_before" id="image_before" style="display:none" onchange="imagesPreview(this,'image_before_place','image_before_div')" accept="image/x-png, image/jpeg" class="form-control @error('image_before') is-invalid @enderror">
                                        </div>
                                        @error('image_before')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="image_doing">Hình ảnh đang:</label>

                                <div class="row">
                                    <div class="gallery col-md-4" style="{{empty($content->avatar) ? 'display:none' : ''}}" id="image_doing_div">
                                        <img src="{{isset($content) ? asset(config('app.s3.link').$content->avatar) : ''}}"  id="image_doing_place" style='height:200px;width:100%;border:1px solid grey'>
                                    </div>
                                    <div class="col-md-4" style="margin-left: 0">
                                        <div  style="height:200px;border:1px solid grey; ">
                                            <label  for="image_doing" class="clone" style="width:100%;position: relative;height:100%" >
                                                <img src="{{ asset('/images/addimage2.png') }}" alt="upload photo" class="image_rounded imgId collapsed" id="gallery-photo-add" width="48px" style="margin-top:-8px;left: 43%; top: 40%;position: absolute;">
                                            </label>
                                            <input type="file" name="image_doing" id="image_doing" style="display:none" onchange="imagesPreview(this,'image_doing_place','image_doing_div')" accept="image/x-png, image/jpeg" class="form-control @error('image_doing') is-invalid @enderror">
                                        </div>
                                        @error('image_doing')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="image_finish">Hình ảnh trước:</label>

                                <div class="row">
                                    <div class="gallery col-md-4" style="{{empty($content->avatar) ? 'display:none' : ''}}" id="image_finish_div">
                                        <img src="{{isset($content) ? asset(config('app.s3.link').$content->avatar) : ''}}"  id="image_finish_place" style='height:200px;width:100%;border:1px solid grey'>
                                    </div>
                                    <div class="col-md-4" style="margin-left: 0">
                                        <div  style="height:200px;border:1px solid grey; ">
                                            <label  for="image_finish" class="clone" style="width:100%;position: relative;height:100%" >
                                                  <img src="{{ asset('/images/addimage2.png') }}" alt="upload photo" class="image_rounded imgId collapsed" id="gallery-photo-add" width="48px" style="margin-top:-8px;left: 43%; top: 40%;position: absolute;">
                                            </label>
                                            <input type="file" name="image_finish" id="image_finish" style="display:none" onchange="imagesPreview(this,'image_finish_place','image_finish_div')" accept="image/x-png, image/jpeg" class="form-control @error('image_finish') is-invalid @enderror">
                                        </div>
                                        @error('image_finish')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </fieldset>



                    <button type="submit" class="btn btn-primary btn_add_user">Xác nhận</button>
                    <a href="{{ route('gcs.index') }}" class="btn btn-danger" data-dismiss="modal">Đóng</a>

                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script !src="">
        function imagesPreview(input, placeToInsertImagePreview,divContent) {
            var validExtensions = ['jpg','png','jpeg']; //array of valid extensions
            if(input.files){
                var file= input.files[0];
                var name = input.files[0].name;
                var fileNameExt = name.substr(name.lastIndexOf('.') + 1);
                var FileSize = input.files[0].size / 1024 / 1024; // in MB
                if (FileSize > 10) {
                    Swal.fire(error_image);
                    return false;
                }
                if ($.inArray(fileNameExt, validExtensions) == -1) {
                    Swal.fire(image_ext+validExtensions.join(', '));
                    return false;
                }
                var reader = new FileReader();
                reader.onload = function (e)
                {
                    $("#"+placeToInsertImagePreview).attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
                document.getElementById(divContent).style.display="block";
            }
        }
    </script>
@endsection

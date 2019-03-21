@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Khách Hàng
                                <small>{{$khachhang->name}}</small>
                            </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                        <div class="col-lg-7" style="padding-bottom:120px">
                            <form action="admin/khachhang/sua/{{$khachhang->id}}" method="POST" >
                                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                                
                                @if(count($errors) > 0)
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $err)
                                            {{$err}}<br>
                                        @endforeach
                                    </div>
                                @endif

                                @if(session('thongbao'))
                                    <div class="alert alert-success">
                                        {{session('thongbao')}}
                                    </div>
                                @endif

                                @if(session('loi'))
                                    <div class="alert alert-danger">
                                        {{session('loi')}}
                                    </div>
                                @endif

                            <div class="form-group">
                                <label>Tên </label>
                                <input class="form-control" name="name" placeholder="Nhập tên" value="{{$khachhang->name}}" />
                            </div>

                            <div class="form-group">
                                <label>Giới Tính</label>
                                <label class="radio-inline">
                                    <input name="gender" value="nam" 
                                        @if($khachhang->gender == "nam")
                                            {{"checked"}}
                                        @endif
                                    type="radio">Nam
                                </label>
                                <label class="radio-inline">
                                    <input name="gender" value="nu" 
                                        @if($khachhang->gender == "nu")
                                            {{"checked"}}
                                        @endif
                                    type="radio">Nữ
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Email </label>
                                <input class="form-control" name="email" placeholder="Nhập email" value="{{$khachhang->email}}" />
                            </div>

                            <div class="form-group">
                                <label>Địa Chỉ </label>
                                <input class="form-control" name="address" placeholder="Nhập địa chỉ" value="{{$khachhang->address}}" />
                            </div>

                            <div class="form-group">
                                <label>Số Điện Thoại </label>
                                <input class="form-control" name="phone_number" placeholder="Nhập số điện thoại" value="{{$khachhang->phone_number}}" />
                            </div>

                            <div class="form-group">
                                <label>Ghi Chú</label>
                                <textarea id="demo" class="form-control ckeditor" rows="5" name="note">{{$khachhang->note}}</textarea>
                            </div>


                                <button type="submit" class="btn btn-default">Sửa</button>
                                <button type="reset" class="btn btn-default">Reset</button>
                            <form>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
@endsection
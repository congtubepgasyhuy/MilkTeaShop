@extends('admin.layout.index')

@section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>{{$user->name}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger ">
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
                        <form action="admin/user/sua/{{$user->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label>Họ Tên</label>
                                <input class="form-control" name="name" placeholder="Nhập tên người dùng" value="{{$user->full_name}}" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Nhập email người dùng" value="{{$user->email}}" readonly="" />
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="changePassword" id="changePassword"/>
                                <label>Đổi Mật Khẩu</label>
                                <input type="password" class="form-control password" name="password" placeholder="Nhập mật khẩu" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Xác nhận mật khẩu</label>
                                <input type="password" class="form-control password" name="passwordAgain" placeholder="Xác nhận mật khẩu" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Quyền Người Dùng</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1"
                                    @if($user->quyen == 1)
                                        {{"checked"}}
                                    @endif
                                    type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0"
                                    @if($user->quyen == 0)
                                        {{"checked"}}
                                    @endif
                                    type="radio">Thường
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Điện Thoại</label>
                                <input class="form-control" name="phone" placeholder="Nhập số điện thoại" value="{{$user->phone}}" />
                            </div>
                            <div class="form-group">
                                <label>Địa Chỉ</label>
                                <input class="form-control" name="address" placeholder="Nhập địa chỉ" value="{{$user->address}}" />
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
        <!-- /#page-wrapper -->
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#changePassword").change(function(){
                if($(this).is(":checked"))
                {
                    $(".password").removeAttr('disabled');
                }
                else
                {
                    $(".password").attr('disabled','');
                }
            });
        });
    </script>
@endsection
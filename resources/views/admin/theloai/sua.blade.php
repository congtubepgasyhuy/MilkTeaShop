@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Thể Loại
                                <small>{{$theloai->name}}</small>
                            </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                        <div class="col-lg-7" style="padding-bottom:120px">
                            <form action="admin/theloai/sua/{{$theloai->id}}" method="POST" enctype="multipart/form-data">
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
                                    <label>Tên Thể Loại</label>
                                    <input class="form-control" name="name" placeholder="Điền tên thể loại" value="{{$theloai->name}}" />
                                </div>

                                <div class="form-group">
                                <label>Mô Tả</label>
                                <textarea id="demo" class="form-control ckeditor" rows="5" name="description">{{$theloai->description}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Hình Ảnh</label>
                                    <p>
                                    <img width="400px" src="source/image/product/{{$theloai->image}}" />
                                    </p>
                                    <input type="file" name="Hinh" class="form-control" />
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
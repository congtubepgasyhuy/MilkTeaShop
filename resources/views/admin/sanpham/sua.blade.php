@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản Phẩm
                            <small>{{$sanpham->name}}</small>
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

                        <form action="admin/sanpham/sua/{{$sanpham->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />

                            <div class="form-group">
                                <label>Thể Loại</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    @foreach($theloai as $tl)
                                        <option 
                                            @if($sanpham->productType->id == $tl->id)
                                                {{"selected"}}
                                            @endif
                                        value="{{$tl->id}}">{{$tl->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input class="form-control" name="name" placeholder="Nhập tên sản phẩm" value="{{$sanpham->name}}" />
                            </div>

                            <div class="form-group">
                                <label>Giá Gốc</label>
                                <input type="number" class="form-control" name="unit_price" placeholder="Nhập giá gốc" value="{{$sanpham->unit_price}}" />
                            </div>

                            <div class="form-group">
                                <label>Giá Khuyến Mãi</label>
                                <input type="number" class="form-control" name="promotion_price" placeholder="Nhập giá khuyến mãi" value="{{$sanpham->promotion_price}}" />
                            </div>

                            <div class="form-group">
                                <label>Mô Tả</label>
                                <textarea id="demo" class="form-control ckeditor" rows="5" name="description">{{$sanpham->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <p>
                                <img width="400px" src="source/image/product/{{$sanpham->image}}" />
                                </p>
                                <input type="file" name="Hinh" class="form-control" />
                            </div>

                            <div class="form-group">
                                <label>Mới</label>
                                <label class="radio-inline">
                                    <input name="new" value="0" 
                                        @if($sanpham->new == 0)
                                            {{"checked"}}
                                        @endif
                                    type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="new" value="1" 
                                        @if($sanpham->new == 1)
                                            {{"checked"}}
                                        @endif
                                    type="radio">Có
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
@endsection

@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chi Tiết Hóa Đơn
                            <small>{{$chitiet->id}}</small>
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

                        <form action="admin/chitiet/sua/{{$chitiet->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />

                            <div class="form-group">
                                <label>Sản Phẩm</label>
                                <select class="form-control" name="SanPham">
                                    @foreach($sanpham as $sp)
                                        <option 
                                            @if($chitiet->id_product == $sp->id)
                                                {{"selected"}}
                                            @endif
                                        value="{{$sp->id}}">{{$sp->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Hóa Đơn</label>
                                <select class="form-control" name="HoaDon">
                                    @foreach($hoadon as $hd)
                                        <option 
                                            @if($chitiet->id_bill == $hd->id)
                                                {{"selected"}}
                                            @endif
                                        value="{{$hd->id}}">{{$hd->id}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Số Lượng</label>
                                <input class="form-control" name="quantity" placeholder="Nhập số lượng" value="{{$chitiet->quantity}}" />
                            </div>

                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
@endsection

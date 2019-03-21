@extends('admin.layout.index')

@section('content')
    <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hóa Đơn
                            <small>{{$hoadon->id}}</small>
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
                        <form action="admin/hoadon/sua/{{$hoadon->id}}" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label>Khách Hàng</label>
                                <select class="form-control" name="khachhang">
                                    @foreach($khachhang as $kh)
                                        <option 
                                            @if($hoadon->customer->id == $kh->id)
                                                {{"selected"}}
                                            @endif
                                        value="{{$kh->id}}">ID: {{$kh->id}} - {{$kh->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Ngày Đặt Hàng</label>
                                <input type="date" class="form-control" name="date_order" placeholder="Điền ngày đặt hàng" value="{{$hoadon->date_order}}" />
                            </div>

                            <div class="form-group">
                                <label>Tổng Tiền</label>
                                <input type="number" class="form-control" name="total" placeholder="Điền tổng tiền"  value="{{$hoadon->total}}" />
                            </div>

                            <div class="form-group">
                                <label>Hình Thức Thanh Toán</label>
                                <label class="radio-inline">
                                    <input name="payment" value="COD" 
                                        @if($hoadon->payment == "COD")
                                            {{"checked"}}
                                        @endif
                                    type="radio">COD
                                </label>
                                <label class="radio-inline">
                                    <input name="payment" value="ATM" 
                                        @if($hoadon->payment == "ATM")
                                            {{"checked"}}
                                        @endif
                                    type="radio">ATM
                                </label>
                            </div>

                            <div class="form-group">
                                <label>Ghi Chú</label>
                                <textarea id="demo" class="form-control ckeditor" rows="5" name="note">{{$hoadon->note}}</textarea>
                            </div>

                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
@endsection
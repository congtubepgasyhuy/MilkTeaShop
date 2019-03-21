@extends('admin.layout.index')

@section('content')
	 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Chi Tiết
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên Sản Phẩm</th>
                                <th>Hóa Đơn</th>
                                <th>Số Lượng</th>
                                <th>Giá Gốc</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chitiet as $ct)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$ct->id}}</td>
                                    <td>{{$ct->product->name}}</td>
                                    <td>{{$ct->id_bill}}</td>
                                    <td>{{$ct->quantity}}</td>
                                    <td>{{$ct->unit_price}}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/chitiet/xoa/{{$ct->id}}"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/chitiet/sua/{{$ct->id}}">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection
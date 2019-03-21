@extends('admin.layout.index')

@section('content')
	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Hóa Đơn
                            <small>Danh sách</small>
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
                                <th>Khách Hàng</th>
                                <th>Ngày đặt hàng</th>
                                <th>Tổng Tiền</th>
                                <th>Hình Thức Thanh Toán</th>
                                <th>Ghi Chú</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($hoadon as $hd)
                            <tr class="odd gradeX" align="center">
                                <td>{{$hd->id}}</td>
                                <td>{{$hd->customer->name}}</td>
                                <td>{{$hd->date_order}}</td>
                                <td>{{$hd->total}}</td>
                                <td>{{$hd->payment}}</td>
                                <td>{!!$hd->note!!}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/hoadon/xoa/{{$hd->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/hoadon/sua/{{$hd->id}}">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection
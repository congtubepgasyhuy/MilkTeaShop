@extends('admin.layout.index')

@section('content')
	<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Khách Hàng
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
                                <th>Tên</th>
                                <th>Giới Tính</th>
                                <th>Email</th>
                                <th>Địa Chỉ</th>
                                <th>Số Điện Thoại</th>
                                <th>Ghi Chú</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($khachhang as $kh)
                            <tr class="odd gradeX" align="center">
                                <td>{{$kh->id}}</td>
                                <td>{{$kh->name}}</td>
                                <td>{{$kh->gender}}</td>
                                <td>{{$kh->email}}</td>
                                <td>{{$kh->address}}</td>
                                <td>{{$kh->phone_number}}</td>
                                <td>{!!$kh->note!!}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/khachhang/xoa/{{$kh->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/khachhang/sua/{{$kh->id}}">Edit</a></td>
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
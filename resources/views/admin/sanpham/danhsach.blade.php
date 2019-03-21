@extends('admin.layout.index')

@section('content')
	 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Sản Phẩm
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
                                <th>Tên</th>
                                <th>Thể Loại</th>
                                <th>Mô Tả</th>
                                <th>Giá Gốc</th>
                                <th>Giá Khuyến Mãi</th>
                                <th>Sản Phẩm Mới</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sanpham as $sp)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$sp->id}}</td>
                                    <td>
                                        <img width="100px" src="source/image/product/{{$sp->image}}"/>
                                        <p>{{$sp->name}}</p>
                                    </td>
                                    <td>{{$sp->productType->name}}</td>
                                    <td>{!!$sp->description!!}</td>
                                    <td>{{$sp->unit_price}}</td>
                                    <td>{{$sp->promotion_price}}</td>
                                    <td>
                                        @if($sp->new == 0)
                                            {{"Không"}}
                                        @else
                                            {{"Có"}}
                                        @endif
                                    </td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/sanpham/xoa/{{$sp->id}}"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/sanpham/sua/{{$sp->id}}">Edit</a></td>
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
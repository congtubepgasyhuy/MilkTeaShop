<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BillDetail;
use App\Bill;
use App\Product;

class ChiTietConTroller extends Controller
{
    //

    public function getDanhSach() {
        $chitiet = BillDetail::get();
    	return view('admin.chitiet.danhsach', ['chitiet'=>$chitiet]);
    }

    public function getThem() {
    	$sanpham = Product::all();
   		$hoadon = Bill::all();
    	return view('admin.chitiet.them', ['sanpham'=>$sanpham, 'hoadon'=>$hoadon]);
    }

    public function postThem(Request $request) {
        $this->validate($request,
            [
                'SanPham'=>'required',
                'HoaDon'=>'required',
                'quantity'=>'required',
            ],
            [
                'SanPham.required'=>'Bạn chưa chọn san phẩm.',
                'HoaDon.required'=>'Bạn chưa chọn hóa đơn.',
                'quantity.required'=>'Bạn chưa nhập số lượng.',
            ]);

        $chitiet = new BillDetail();
        $chitiet->id_product = $request->SanPham;
        $chitiet->id_bill = $request->HoaDon;
        $chitiet->quantity = $request->quantity;
        $sp = Product::find($request->SanPham);
        $chitiet->unit_price = $request->quantity * $sp->unit_price;

        $chitiet->save();

        $hoadon = $chitiet->bill;
        $hoadon->total = 0;
        foreach ($hoadon->billDetail as $ct) {
         	$hoadon->total = $hoadon->total + $ct->unit_price;
        } 
        $hoadon->save();

        return redirect('admin/chitiet/them')->with('thongbao', 'Thêm thành công');
    }

    public function getSua($id) {
    	$sanpham = Product::all();
    	$hoadon = Bill::all();
    	$chitiet = BillDetail::find($id);
        return view('admin.chitiet.sua', ['sanpham'=>$sanpham, 'hoadon'=>$hoadon, 'chitiet'=>$chitiet]);
    }

    public function postSua(Request $request, $id) {
        $chitiet = BillDetail::find($id);

        $this->validate($request,
            [
                'SanPham'=>'required',
                'HoaDon'=>'required',
                'quantity'=>'required',
            ],
            [
                'SanPham.required'=>'Bạn chưa chọn san phẩm.',
                'HoaDon.required'=>'Bạn chưa chọn hóa đơn.',
                'quantity.required'=>'Bạn chưa nhập số lượng.',
            ]);

       	$chitiet->id_product = $request->SanPham;
        $chitiet->id_bill = $request->HoaDon;
        $chitiet->quantity = $request->quantity;
        $sp = Product::find($request->SanPham);
        $chitiet->unit_price = $request->quantity * $sp->unit_price;

        $chitiet->save();

        $hoadon = $chitiet->bill;
        $hoadon->total = 0;
        foreach ($hoadon->billDetail as $ct) {
         	$hoadon->total = $hoadon->total + $ct->unit_price;
        } 
        $hoadon->save();

        return redirect('admin/chitiet/sua/'.$id)->with('thongbao','Sửa thành công.');
    }

    public function getXoa($id) {
        $chitiet = BillDetail::find($id);

        $hoadon = $chitiet->bill;

        $chitiet->delete();

        $hoadon->total = 0;
        foreach ($hoadon->billDetail as $ct) {
         	$hoadon->total = $hoadon->total + $ct->unit_price;
        } 
        $hoadon->save();
        
        return redirect('admin/chitiet/danhsach')->with('thongbao', 'Xóa thành công.');
    }

}

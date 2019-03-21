<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Customer;

class HoaDonController extends Controller
{
    //

    public function getDanhSach() {
        $hoadon = Bill::get();
    	return view('admin.hoadon.danhsach', ['hoadon'=>$hoadon]);
    }

    public function getThem() {
    	$khachhang = Customer::get();
    	return view('admin.hoadon.them', ['khachhang'=>$khachhang]);
    }

    public function postThem(Request $request) {
        $this->validate($request,
            [
                'khachhang'=>'required',
                'date_order'=>'required',
                'total'=>'required',
            ],
            [
                'khachhang.required'=>'Bạn chưa chọn khách hàng.',
                'date_order.required'=>'Bạn chưa nhập ngày đặt hàng.',
                'total.required'=>'Bạn chưa nhập tổng tiền.',
            ]);

        $hoadon = new Bill();
        $hoadon->id_customer = $request->khachhang;
        $hoadon->date_order = $request->date_order;
        $hoadon->total = $request->total;
        $hoadon->payment = $request->payment;
        $hoadon->note = $request->note;

        $hoadon->save();

        return redirect('admin/hoadon/them')->with('thongbao', 'Thêm thành công');
    }

    public function getSua($id) {
    	$khachhang = Customer::get();
    	$hoadon = Bill::find($id);
        return view('admin.hoadon.sua', ['khachhang'=>$khachhang, 'hoadon'=>$hoadon]);
    }

    public function postSua(Request $request, $id) {
        $hoadon = Bill::find($id);

        $this->validate($request,
            [
                'khachhang'=>'required',
                'date_order'=>'required',
                'total'=>'required',
            ],
            [
                'khachhang.required'=>'Bạn chưa chọn khách hàng.',
                'date_order.required'=>'Bạn chưa nhập ngày đặt hàng.',
                'total.required'=>'Bạn chưa nhập tổng tiền.',
            ]);

       	$hoadon->id_customer = $request->khachhang;
        $hoadon->date_order = $request->date_order;
        $hoadon->total = $request->total;
        $hoadon->payment = $request->payment;
        $hoadon->note = $request->note;

        $hoadon->save();

        return redirect('admin/hoadon/sua/'.$id)->with('thongbao','Sửa thành công.');
    }

    public function getXoa($id) {
        $hoadon = Bill::find($id);

        if($hoadon->billDetail){
        	foreach ($hoadon->billDetail as $ct) {
                $ct->delete();
        	}
        	$hoadon->delete();
        	
        }
        else{
        	$hoadon->delete();
        }
        
        return redirect('admin/hoadon/danhsach')->with('thongbao', 'Xóa thành công.');
    }
}

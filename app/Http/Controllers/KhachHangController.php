<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Bill;
use App\BillDetail;

class KhachHangController extends Controller
{
    //

    public function getDanhSach() {
        $khachhang = Customer::get();
    	return view('admin.khachhang.danhsach', ['khachhang'=>$khachhang]);
    }

    public function getThem() {
    	return view('admin.khachhang.them');
    }

    public function postThem(Request $request) {
        $this->validate($request,
            [
                'name'=>'required',
                'email'=>'required',
                'address'=>'required',
                'phone_number'=>'required',
                'note'=>'required',
            ],
            [
                'name.required'=>'Bạn chưa điền tên.',
                'email.required'=>'Bạn chưa điền email.',
                'address.required'=>'Bạn chưa điền địa chỉ.',
                'phone_number.required'=>'Bạn chưa ghi số điện thoại.',
                'note.required'=>'Bạn chưa có ghi chú.',
            ]);

        $khachhang = new Customer();
        $khachhang->name = $request->name;
        $khachhang->gender = $request->gender;
        $khachhang->email = $request->email;
        $khachhang->address = $request->address;
        $khachhang->phone_number = $request->phone_number;
        $khachhang->note = $request->note;

        $khachhang->save();

        return redirect('admin/khachhang/them')->with('thongbao', 'Thêm thành công');
    }

    public function getSua($id) {
    	$khachhang = Customer::find($id);
        return view('admin.khachhang.sua', ['khachhang'=>$khachhang]);
    }

    public function postSua(Request $request, $id) {
        $khachhang = Customer::find($id);
        $this->validate($request,
            [
                'name'=>'required',
                'email'=>'required',
                'address'=>'required',
                'phone_number'=>'required',
                'note'=>'required',
            ],
            [
                'name.required'=>'Bạn chưa điền tên.',
                'email.required'=>'Bạn chưa điền email.',
                'address.required'=>'Bạn chưa điền địa chỉ.',
                'phone_number.required'=>'Bạn chưa ghi số điện thoại.',
                'note.required'=>'Bạn chưa có ghi chú.',
            ]);

        $khachhang->name = $request->name;
        $khachhang->gender = $request->gender;
        $khachhang->email = $request->email;
        $khachhang->address = $request->address;
        $khachhang->phone_number = $request->phone_number;
        $khachhang->note = $request->note;

        $khachhang->save();

        return redirect('admin/khachhang/sua/'.$id)->with('thongbao','Sửa thành công.');
    }

    public function getXoa($id) {
        $khachhang = Customer::find($id);

        if($khachhang->bill){
        	foreach ($khachhang->bill as $hd) {
                if($hd->billDetail)
                {
                    $chitiet = $hd->billDetail;
                    foreach ($chitiet as $ct) {
                        $ct->delete();
                    }
                    $hd->delete();
                }
                else
                    $hd->delete();
        	}
        	$khachhang->delete();
        	
        }
        else{
        	$khachhang->delete();
        }
        
        return redirect('admin/khachhang/danhsach')->with('thongbao', 'Xóa thành công.');
    }
}

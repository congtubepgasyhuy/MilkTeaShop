<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;
use App\Product;
use App\BillDetail;

class TheLoaiController extends Controller
{
    //

    public function getDanhSach() {
        $theloai = ProductType::get();
    	return view('admin.theloai.danhsach', ['theloai'=>$theloai]);
    }

    public function getThem() {
    	return view('admin.theloai.them');
    }

    public function postThem(Request $request) {
        $this->validate($request,
            [
                'name'=>'required|unique:type_products,name|min:3|max:100',
                'description'=>'required',
            ],
            [
                'name.required'=>'Bạn chưa nhập tên thể loại.',
                'name.unique'=>'Tên thể loại đã tồn tại.',
                'name.min'=>'Tên thể loại phải nhập có độ dài từ 3 đến 100 kí tự.',
                'name.max'=>'Tên thể loại phải nhập có độ dài từ 3 đến 100 kí tự.',
                'description.required'=>'Chưa điền mô tả thể loại.'
            ]);

        $theloai = new ProductType();
        $theloai->name = $request->name;
        $theloai->description = $request->description;

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
               return redirect('admin/theloai/them')->with('loi', 'Chỉ được chọn file jpg, png, jpeg'); 
            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("source/image/product/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move('source/image/product', $Hinh);
            $theloai->image = $Hinh;
        }
        else{
            $theloai->image = "";
        }

        $theloai->save();

        return redirect('admin/theloai/them')->with('thongbao', 'Thêm thành công');
    }

    public function getSua($id) {
    	$theloai = ProductType::find($id);
        return view('admin.theloai.sua', ['theloai'=>$theloai]);
    }

    public function postSua(Request $request, $id) {
        $theloai = ProductType::find($id);
         $this->validate($request,
            [
                'name'=>'required|min:3|max:100|unique:type_products,name,'.$id,
                'description'=>'required',
            ],
            [
                'name.required'=>'Bạn chưa nhập tên thể loại.',
                'name.unique'=>'Tên thể loại đã tồn tại.',
                'name.min'=>'Tên thể loại phải nhập có độ dài từ 3 đến 100 kí tự.',
                'name.max'=>'Tên thể loại phải nhập có độ dài từ 3 đến 100 kí tự.',
                'description.required'=>'Chưa điền mô tả thể loại.'
            ]);

        $theloai->name = $request->name;
        $theloai->description = $request->description;

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' && $duoi != 'bmp'){
               return redirect('admin/theloai/sua/'.$id)->with('loi', 'Chỉ được chọn file jpg, png, jpeg, bmp'); 
            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("source/image/product/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move('source/image/product', $Hinh);
            
            if($theloai->image != "") 
                unlink("source/image/product/".$theloai->image);

            $theloai->image = $Hinh;
        }

        $theloai->save();

        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thành công.');
    }

    public function getXoa($id) {
        $theloai = ProductType::find($id);

        if($theloai->product){
        	foreach ($theloai->product as $sp) {
                if($sp->billDetail)
                {
                    $chitiet = $sp->billDetail;
                    foreach ($chitiet as $ct) {
                        $ct->delete();
                    }
                    $sp->delete();
                }
                else
                    $sp->delete();
        	}
        	$theloai->delete();
        	
        }
        else{
        	$theloai->delete();
        }
        
        return redirect('admin/theloai/danhsach')->with('thongbao', 'Xóa thành công.');
    }
}

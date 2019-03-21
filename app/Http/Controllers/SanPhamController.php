<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductType;

class SanPhamController extends Controller
{
    //

     public function getDanhSach() {
        $sanpham = Product::get();
    	return view('admin.sanpham.danhsach', ['sanpham'=>$sanpham]);
    }

    public function getThem() {
    	$theloai = ProductType::all();
    	return view('admin.sanpham.them', ['theloai'=>$theloai]);
    }

    public function postThem(Request $request) {
        $this->validate($request,
            [
                'name'=>'required|unique:products,name|min:3|max:100',
                'description'=>'required',
                'unit_price'=>'required',
                'TheLoai'=>'required',
            ],
            [
                'name.required'=>'Bạn chưa nhập tên sản phẩm.',
                'name.unique'=>'Tên sản phẩm đã tồn tại.',
                'name.min'=>'Tên sản phẩm phải nhập có độ dài từ 3 đến 100 kí tự.',
                'name.max'=>'Tên sản phẩm phải nhập có độ dài từ 3 đến 100 kí tự.',
                'description.required'=>'Chưa điền mô tả sản phẩm.',
                'unit_price.required'=>'Chưa nhập giá gốc của sản phẩm.',
                'TheLoai'=>'Chưa chọn thể loại.',
            ]);

        $sanpham = new Product();
        $sanpham->name = $request->name;
        $sanpham->unit_price = (float)$request->unit_price;
        $sanpham->promotion_price = (float)$request->promotion_price;
        $sanpham->description = $request->description;
        $sanpham->id_type = $request->TheLoai;
        $sanpham->new = $request->new;

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
               return redirect('admin/sanpham/them')->with('loi', 'Chỉ được chọn file jpg, png, jpeg'); 
            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("source/image/product/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move('source/image/product', $Hinh);
            $sanpham->image = $Hinh;
        }
        else{
            $sanpham->image = "";
        }

        $sanpham->save();

        return redirect('admin/sanpham/them')->with('thongbao', 'Thêm thành công');
    }

    public function getSua($id) {
    	$theloai = ProductType::all();
    	$sanpham = Product::find($id);
        return view('admin.sanpham.sua', ['sanpham'=>$sanpham, 'theloai'=>$theloai]);
    }

    public function postSua(Request $request, $id) {
        $sanpham = Product::find($id);
        $this->validate($request,
            [
                'name'=>'required|min:3|max:100|unique:products,name,'.$id,
                'description'=>'required',
                'unit_price'=>'required',
                'TheLoai'=>'required',
            ],
            [
                'name.required'=>'Bạn chưa nhập tên sản phẩm.',
                'name.unique'=>'Tên sản phẩm đã tồn tại.',
                'name.min'=>'Tên sản phẩm phải nhập có độ dài từ 3 đến 100 kí tự.',
                'name.max'=>'Tên sản phẩm phải nhập có độ dài từ 3 đến 100 kí tự.',
                'description.required'=>'Chưa điền mô tả sản phẩm.',
                'unit_price.required'=>'Chưa nhập giá gốc của sản phẩm.',
                'TheLoai'=>'Chưa chọn thể loại.',
            ]);

        $sanpham->name = $request->name;
        $sanpham->unit_price = (float)$request->unit_price;
        $sanpham->promotion_price = (float)$request->promotion_price;
        $sanpham->description = $request->description;
        $sanpham->id_type = $request->TheLoai;
        $sanpham->new = $request->new;
        

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');

            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg' && $duoi != 'bmp'){
               return redirect('admin/sanpham/sua/'.$id)->with('loi', 'Chỉ được chọn file jpg, png, jpeg, bmp'); 
            }

            $name = $file->getClientOriginalName();
            $Hinh = str_random(4)."_".$name;
            while (file_exists("source/image/product/".$Hinh)) {
                $Hinh = str_random(4)."_".$name;
            }
            $file->move('source/image/product', $Hinh);
            
            if($sanpham->image != "") 
                unlink("source/image/product/".$sanpham->image);

            $sanpham->image = $Hinh;
        }

        $sanpham->save();

        return redirect('admin/sanpham/sua/'.$id)->with('thongbao','Sửa thành công.');
    }

    public function getXoa($id) {
        $sanpham = Product::find($id);
        if($sanpham->billDetail)
        {
        	foreach ($sanpham->billDetail as $ct) {
        		$ct->delete();
        	}
        	$sanpham->delete();
        }
        else{
        	$sanpham->delete();
        }
        	
        
        return redirect('admin/sanpham/danhsach')->with('thongbao', 'Xóa thành công.');
    }

}

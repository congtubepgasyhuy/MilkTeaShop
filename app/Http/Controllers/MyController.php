<?php

namespace App\Http\Controllers;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use Session;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Hash;
use Auth;

use Illuminate\Http\Request;

class MyController extends Controller
{
    public function getIndex(){
    	$slide = Slide::all();
    	$newPro = Product::where('new', 1)->paginate(8);
        $promPro = Product::where('promotion_price', '>', '0')->paginate(8);
    	//dd($newPro);
    	return view('pages.homepage', compact('slide', 'newPro', 'promPro'));
    }

    public function getProductType($type){
        $argTypePro = Product::where('id_type', $type)->get();
        $otherPro = Product::where('id_type', '<>', $type)->paginate(4);
        $nameType = ProductType::where('id', $type)->first();
        $typePro = ProductType::all();
    	return view('pages.type_product', compact('argTypePro', 'otherPro', 'nameType', 'typePro'));
    }

    public function getProductDetail(Request $req){
        $product = Product::where('id', $req->idPro)->first();
        $relatedPro = Product::where('id_type', $product->id_type)->paginate(4);
    	return view('pages.detail_product', compact('product', 'relatedPro'));
    }

    public function getContact(){
    	return view('pages.contact');
    }

    public function getAbout(){
    	return view('pages.about');
    }

    public function getAddToCart(Request $req, $id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $req->session()->put('cart', $cart);
        return redirect()->back();
    }

    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items > 0)){
            Session::put('cart', $cart);
        }
        else{
            Session::forget('get');
        }
        return redirect()->back();
    }

    public function getCheckout(){
        return view('pages.checkout');
    }

    public function postCheckout(Request $req){
        $cart = Session::get('cart');

        $customer = new Customer();
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        if($req->notes)            
            $customer->note = $req->notes;
        else
            $customer->note = "";
        $customer->save();

        $bill = new Bill();
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment_method;
        $bill->note = $req->notes;
        $bill->save();

        foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = ($value['price']/$value['qty']);
            $bill_detail->save();
        }
        Session::forget('cart');

        return redirect()->back()->with('success','Đặt hàng thành công!');
    }

    public function getLogin(){
        return view('pages.login');
    }

    public function postLogin(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email Không đúng định dạng',
                'password.required'=>'Bạn chưa nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự'
            ]
        );

        $credentials = array('email'=>$req->email, 'password'=>$req->password);
        if(Auth::attempt($credentials)){
            return redirect()->back()->with(['flag'=>'success', 'message'=>'Đăng nhập thành công!']);
        }
        else{
            return redirect()->back()->with(['flag'=>'danger', 'message'=>'Đăng nhập thất bại!']);
        }
    }

    public function getSignup(){
        return view('pages.signup');
    }

    public function postSignup(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6',
                'fullname'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email Không đúng định dạng',
                'email.unique'=>'Email đã được sử dụng',
                'password.required'=>'Bạn chưa nhập mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự'
            ]
        );

        $user = new User();
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save();

        return redirect()->back()->with('success', 'Đăng ký thành công!');
    }

    public function getLogout(){
        Auth::logout();
        return redirect()->route('home-page');
    }

    public function getSearch(Request $req){
        $product = Product::where('name', 'like', '%'.$req->key.'%')
                            ->orWhere('unit_price', $req->key)
                            ->get();
        return view('pages.search', compact('product'));
    }
}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    
});
//chay ngon ma
Route::get('index', ['as'=>'home-page', 'uses'=>'MyController@getIndex']);

Route::get('product-type/{type}', ['as'=>'productType', 'uses'=>'MyController@getProductType']);

Route::get('product-detail/{idPro}', ['as'=>'productDetail', 'uses'=>'MyController@getProductDetail']);

Route::get('contact', ['as'=>'contact', 'uses'=>'MyController@getContact']);

Route::get('about', ['as'=>'about', 'uses'=>'MyController@getAbout']);

Route::get('add-to-cart/{id}', ['as'=>'add-to-cart', 'uses'=>'MyController@getAddToCart']);

Route::get('del-cart/{id}', ['as'=>'del-cart', 'uses'=>'MyController@getDelItemCart']);

Route::get('checkout',['as'=>'checkout', 'uses'=>'MyController@getCheckout']);

Route::post('checkout',['as'=>'checkout', 'uses'=>'MyController@postCheckout']);

Route::get('login', ['as'=>'login', 'uses'=>'MyController@getLogin']);

Route::post('login', ['as'=>'login', 'uses'=>'MyController@postLogin']);

Route::get('signup', ['as'=>'signup', 'uses'=>'MyController@getSignup']);

Route::post('signup', ['as'=>'signup', 'uses'=>'MyController@postSignup']);

Route::get('logout', ['as'=>'logout', 'uses'=>'MyController@getLogout']);

Route::get('search', ['as'=>'search', 'uses'=>'MyController@getSearch']);

//trang admin

Route::get('admin/dangnhap','UserController@getDangNhapAdmin');
Route::post('admin/dangnhap','UserController@postDangNhapAdmin');
Route::get('admin/logout', 'UserController@getDangXuatAdmin');

Route:: group(['prefix'=>'admin', 'middleware'=>'adminLogin'], function() {
	
	Route::group(['prefix'=>'theloai'], function() {
		Route::get('danhsach', 'TheLoaiController@getDanhSach');

		Route::get('them', 'TheLoaiController@getThem');

		Route::post('them', 'TheLoaiController@postThem');

		Route::get('sua/{id}', 'TheLoaiController@getSua');

		Route::post('sua/{id}', 'TheLoaiController@postSua');

		Route::get('xoa/{id}', 'TheLoaiController@getXoa');

	});

	Route::group(['prefix'=>'sanpham'], function() {
		Route::get('danhsach', 'SanPhamController@getDanhSach');

		Route::get('them', 'SanPhamController@getThem');

		Route::post('them', 'SanPhamController@postThem');

		Route::get('sua/{id}', 'SanPhamController@getSua');

		Route::post('sua/{id}', 'SanPhamController@postSua');

		Route::get('xoa/{id}', 'SanPhamController@getXoa');

	});

	Route::group(['prefix'=>'hoadon'], function() {
		Route::get('danhsach', 'HoaDonController@getDanhSach');

		Route::get('them', 'HoaDonController@getThem');

		Route::post('them', 'HoaDonController@postThem');

		Route::get('sua/{id}', 'HoaDonController@getSua');

		Route::post('sua/{id}', 'HoaDonController@postSua');

		Route::get('xoa/{id}', 'HoaDonController@getXoa');

	});

	Route::group(['prefix'=>'khachhang'], function() {
		Route::get('danhsach', 'KhachHangController@getDanhSach');

		Route::get('them', 'KhachHangController@getThem');

		Route::post('them', 'KhachHangController@postThem');

		Route::get('sua/{id}', 'KhachHangController@getSua');

		Route::post('sua/{id}', 'KhachHangController@postSua');

		Route::get('xoa/{id}', 'KhachHangController@getXoa');

	});

	Route::group(['prefix'=>'chitiet'], function() {
		Route::get('danhsach', 'ChiTietController@getDanhSach');

		Route::get('them', 'ChiTietController@getThem');

		Route::post('them', 'ChiTietController@postThem');

		Route::get('sua/{id}', 'ChiTietController@getSua');

		Route::post('sua/{id}', 'ChiTietController@postSua');

		Route::get('xoa/{id}', 'ChiTietController@getXoa');

	});

	Route::group(['prefix'=>'slide'], function() {
		Route::get('danhsach', 'SlideController@getDanhSach');

		Route::get('them', 'SlideController@getThem');

		Route::post('them', 'SlideController@postThem');

		Route::get('sua/{id}', 'SlideController@getSua');

		Route::post('sua/{id}', 'SlideController@postSua');

		Route::get('xoa/{id}', 'SlideController@getXoa');

	});

	Route::group(['prefix'=>'user'], function() {
		Route::get('danhsach', 'UserController@getDanhSach');

		Route::get('them', 'UserController@getThem');

		Route::post('them', 'UserController@postThem');

		Route::get('sua/{id}', 'UserController@getSua');

		Route::post('sua/{id}', 'UserController@postSua');

		Route::get('xoa/{id}', 'UserController@getXoa');

	});
});

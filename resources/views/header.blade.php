<div id="header">
	<div class="header-top">
		<div class="container">
			<div class="pull-left auto-width-left">
				<ul class="top-menu menu-beta l-inline">
					<li><a href="{{route('home-page')}}" style="font-size: 120%"><b><i class="fa fa-home" style="font-size: 120%;"></i> Thiên Đường Trà Sữa VPB </b></a></li>
					<li><a style="font-size: 120%; color: magenta"><i class="fa fa-phone" style="font-size: 120%;"></i> 01234.567.890 </a></li>
				</ul>
			</div>
			<div class="pull-right auto-width-right">
				<ul class="top-details menu-beta l-inline">
					<!--<li><a href="#"><i class="fa fa-user"></i>Tài khoản</a></li>-->
				@if(Auth::check())
					<li><a><b style="color: blue; font-size: 120%">Chào bạn <i style="color: red; font-size: 100%">{{Auth::user()->full_name}}</i></b></a></li>
					<li><a href="{{route('logout')}}"><b style="color: blue; font-size: 115%">Đăng xuất</b></a></li>
				@else
					<li><a href="{{route('signup')}}"><b style="color: blue; font-size: 115%">Đăng ký</b></a></li>
					<li><a href="{{route('login')}}"><b style="color: blue; font-size: 115%">Đăng nhập</b></a></li>
				@endif
				</ul>
			</div>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .header-top -->
	<div class="header-body">
		<div class="container beta-relative">
			<div class="pull-left">
				<a href="{{route('home-page')}}" id="logo"><img src="source/image/logo/logo.png" width="200px" alt=""></a>
			</div>
			<div class="pull-right beta-components space-left ov">
				<div class="space10">&nbsp;</div>
				<div class="beta-comp">
					<form role="search" method="get" id="searchform" action="{{route('search')}}">
				        <b style="font-size: 115%; color: red" ><input type="text" value="" name="key" id="s" placeholder="Nhập từ khóa..." /></b>
				        <button class="fa fa-search" type="submit" id="searchsubmit"></button>
					</form>
				</div>

				<div class="beta-comp">
					<div class="cart">
						<div class="beta-select"><b <b style="color: green; font-size: 115%"><i class="fa fa-shopping-cart"></i> Giỏ hàng (
							@if(Session::has('cart')){{Session('cart')->totalQty}}
							@else Trống
							@endif) <i class="fa fa-chevron-down"></i></b></div>

						<div class="beta-dropdown cart-body">	
						@if(Session::has('cart'))
							@foreach($product_cart as $product)
								<div class="cart-item">
									<a class="cart-item-delete" href="{{route('del-cart', $product['item']['id'])}}"><i class="fa fa-times"></i></a>
									<div class="media">
										<a class="pull-left" href="#"><img src="source/image/product/{{$product['item']['image']}}" alt=""></a>
										<div class="media-body">
											<span class="cart-item-title">{{$product['item']['name']}}</span>
											<span class="cart-item-amount">{{$product['qty']}} * <span>
												@if($product['item']['promotion_price'] == 0){{$product['item']['unit_price']}}
												@else {{$product['item']['promotion_price']}}
												@endif</span>
											</span>
										</div>
									</div>
								</div>
							@endforeach

							<div class="cart-caption">
								<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{number_format(Session('cart')->totalPrice)}}</span></div>
								<div class="clearfix"></div>

								<div class="center">
									<div class="space10">&nbsp;</div>
									<a href="{{route('checkout')}}" class="beta-btn primary text-center">Đặt hàng <i class="fa fa-chevron-right"></i></a>
								</div>
							</div>
						@endif
						</div>
					</div> <!-- .cart -->
				</div>
			</div>
			<div class="clearfix"></div>
		</div> <!-- .container -->
	</div> <!-- .header-body -->
	<div class="header-bottom" style="background-color: #0277b8;">
		<div class="container">
			<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
			<div class="visible-xs clearfix"></div>
			<nav class="main-menu">
				<ul class="l-inline ov">
					<li><a href="{{route('home-page')}}">Trang chủ</a></li>
					<li><a>Loại sản phẩm</a>
						<ul class="sub-menu">
							@foreach($typePro as $type)
							<li><a href="{{route('productType', $type->id)}}"><b style="color: black">{{$type->name}}</b></a></li>
							@endforeach
						</ul>
					</li>
					<li><a href="{{route('about')}}">Giới thiệu</a></li>
					<li><a href="{{route('contact')}}">Liên hệ</a></li>
				</ul>
				<div class="clearfix"></div>
			</nav>
		</div> <!-- .container -->
	</div> <!-- .header-bottom -->
</div> <!-- #header -->
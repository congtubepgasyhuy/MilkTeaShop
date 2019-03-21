@extends('master')
@section('content')
<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h5 class="inner-title">Sản phẩm {{$nameType->name}}</h5>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{route('home-page')}}">Home</a> / <span>Loại sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
							@foreach($typePro as $type)
							<li><a href="{{route('productType', $type->id)}}"><b style="color: green; font-size: 125%"">{{$type->name}}</b></a></li>
							@endforeach
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>Các sản phẩm {{$nameType->name}}</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy {{count($argTypePro)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($argTypePro as $pro)
									<div class="col-sm-4" style="margin-top: 20px;">
									<div class="single-item">
										@if($pro->promotion_price !=0)
											<div class="ribbon-wrapper">
												<div class="ribbon sale">Sale</div>
											</div>
										@endif
										<div class="single-item-header">
											<a href="{{route('productDetail', $pro->id)}}"><img src="source/image/product/{{$pro->image}}" alt="" height="350px"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title"><b style="color: red; font-size: 125%"><i>{{$pro->name}}</i></b></p>
											<p class="single-item-price">
												@if($pro->promotion_price !=0)
													<span class="flash-del">{{$pro->unit_price}}đ</span>
													<span class="flash-sale">{{$pro->promotion_price}}đ</span>
												@else
													<span class="flash-sale">{{$pro->unit_price}}đ</span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{route('add-to-cart', $pro->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('productDetail', $pro->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
									</div>
								@endforeach
							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Sản phẩm khác</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy {{count($otherPro)}} sản phẩm</p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
								@foreach($otherPro as $other)
									<div class="col-sm-4" style="margin-top: 20px;">
									<div class="single-item">
										@if($other->promotion_price !=0)
											<div class="ribbon-wrapper">
												<div class="ribbon sale">Sale</div>
											</div>
										@endif
										<div class="single-item-header">
											<a href="{{route('productDetail', $other->id)}}"><img src="source/image/product/{{$other->image}}" alt="" height="350px"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title"><b style="color: red; font-size: 125%"><i>{{$other->name}}</i></b></p>
											<p class="single-item-price">
												@if($other->promotion_price !=0)
													<span class="flash-del">{{$other->unit_price}}đ</span>
													<span class="flash-sale">{{$other->promotion_price}}đ</span>
												@else
													<span class="flash-sale">{{$other->unit_price}}đ</span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="{{route('add-to-cart', $other->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('productDetail', $other->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
									</div>
								@endforeach
							</div>
							<div class="row">{{$otherPro->links()}}</div>
							<div class="space40">&nbsp;</div>
							
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
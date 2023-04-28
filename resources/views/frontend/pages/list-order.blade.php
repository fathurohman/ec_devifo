@extends('frontend.layouts.master')
@section('title','List Order')
@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{('home')}}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="">List Order</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
                                <th>NO</th>
								<th>ORDER NUMBER</th>
								<th class="text-center">PAYMENT STATUS</th>
                                <th class="text-center">TOTAL AMOUNT</th>
								<th class="text-center">ACTION</th>
							</tr>
						</thead>
						<tbody id="cart_item_list">
                            @if($cekorder > 0)
                                @foreach ($order as $index=>$item)
                                <tr>
                                    <td data-title="No">{{$index+1}}</td>
                                    <td data-title="Order Number" class="text-center">{{$item->order_number}}</td>
                                    <td data-title="Payment Status" class="text-center">

                                        <span style="font-size:15px" @if ($item->payment_status == 'unpaid') class="badge badge-danger"
                                            @else class="badge badge-success" @endif>{{$item->payment_status}}</span>
                                    </td>
                                    <td data-title="Total Amount" class="text-center">Rp. {{number_format($item->total_amount)}}</td>
                                    <td data-title="Action" class="action" data-title="Remove">
                                        @if ($item->payment_status == 'unpaid')
                                            <a class="btn" href="{{route('order.pay', $item->id)}}">pay</a>
                                            <a class="btn" href="{{route('delete.order',$item->id)}}">Remove</a>
                                        @else
                                            <a class="btn" href="{{$item->fr_url}}"> Print</a>
                                        @endif


                                    </td>

                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td class="text-center">
                                    There are no any order available. <a href="{{route('product-grids')}}" style="color:blue;">Continue shopping</a>

                                </td>
                            </tr>
                            @endif


						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>

		</div>
	</div>
	<!--/ End Shopping Cart -->


@endsection
@push('styles')
	<style>
		li.shipping{
			display: inline-flex;
			width: 100%;
			font-size: 14px;
		}
		li.shipping .input-group-icon {
			width: 100%;
			margin-left: 10px;
		}
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
		.form-select {
			height: 30px;
			width: 100%;
		}
		.form-select .nice-select {
			border: none;
			border-radius: 0px;
			height: 40px;
			background: #f6f6f6 !important;
			padding-left: 45px;
			padding-right: 40px;
			width: 100%;
		}
		.list li{
			margin-bottom:0 !important;
		}
		.list li:hover{
			background:#F7941D !important;
			color:white !important;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
	</style>
@endpush
@push('scripts')

	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
	<script>
		$(document).ready(function(){
			$('.shipping select[name=shipping]').change(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') );
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0;
				// alert(coupon);
				$('#order_total_price span').text('$'+(subtotal + cost-coupon).toFixed(2));
			});

		});

	</script>

@endpush

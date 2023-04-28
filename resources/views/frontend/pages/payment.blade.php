@extends('frontend.layouts.master')

@section('title','Payment page')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">Payment</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
            <div class="col-lg-12 col-12">
                <div class="order-details">
                    <!-- Order Widget -->
                    <div class="single-widget">
                        <h2>CART  TOTALS</h2>
                        <div class="content">
                            <ul>
                                <li class="order_subtotal" >Cart Subtotal<span>Rp. {{number_format($order->total_amount)}}</span></li>


                            </ul>
                        </div>
                    </div>

                    <div class="single-widget get-button">
                        <div class="content">
                            <div class="button">
                                {{-- <button type="submit" class="btn">proceed to checkout</button> --}}
                                <button id="pay-button" class="btn">pay ! </button>

                            </div>
                        </div>
                    </div>
                    <!--/ End Button Widget -->
                </div>
            </div>

        </div>
    </section>
    <!--/ End Checkout -->
    <form action="{{route('cart.order_update')}}" method="POST" id="submitform">
        @csrf
        <input type="hidden" name="id" value="{{$order->id}}" >
        <input type="hidden" name="json" id="json_callback">

    </form>
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
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{env('MIDTRANS_CLIENT_KEY')}}"></script>
   <script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function (e) {
        e.preventDefault();
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      snap.pay('{{$snaptoken}}', {
        onSuccess: function(result){
          /* You may add your own implementation here */
          alert("payment success!"); console.log(result);
          send_response_to(result);

        },
        onPending: function(result){
          /* You may add your own implementation here */
          alert("wating your payment!"); console.log(result);
        //   send_response_to(result);
        },
        onError: function(result){
          /* You may add your own implementation here */
          alert("payment failed!"); console.log(result);
        //   send_response_to(result);
        },
        onClose: function(){
          /* You may add your own implementation here */
          alert('you closed the popup without finishing the payment');
        }
      })
    });

    function send_response_to(result) {
        document.getElementById('json_callback').value = JSON.stringify(result);
        // alert(document.getElementById('json_callback').value);
        $('#submitform').submit();
    }

  </script>

	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
	<script>
		function showMe(box){
			var checkbox=document.getElementById('shipping').style.display;
			// alert(checkbox);
			var vis= 'none';
			if(checkbox=="none"){
				vis='block';
			}
			if(checkbox=="block"){
				vis="none";
			}
			document.getElementById(box).style.display=vis;
		}
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

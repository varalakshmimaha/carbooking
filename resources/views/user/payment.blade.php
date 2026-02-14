@extends('layouts.frontend')

@section('title', 'Complete Payment')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12">
    <div class="bg-white p-8 rounded-2xl shadow-xl max-w-md w-full text-center">
        <div class="mb-6">
            <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Complete Payment</h2>
            <p class="text-gray-600">Booking #{{ $booking->id }}</p>
        </div>

        <div class="bg-gray-50 p-4 rounded-xl mb-8">
            <p class="text-sm text-gray-500 mb-1">Total Amount</p>
            <p class="text-3xl font-bold text-indigo-600">₹{{ number_format($amount, 2) }}</p>
        </div>
        
        <button id="rzp-button1" class="w-full bg-indigo-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-indigo-700 transition-shadow shadow-lg hover:shadow-xl mb-4">
            Pay Now
        </button>

        @auth
            <a href="{{ route('user.dashboard') }}" class="text-sm text-gray-500 hover:text-gray-700 underline">Cancel and Pay Later</a>
        @else
            <a href="{{ url('/') }}" class="text-sm text-gray-500 hover:text-gray-700 underline">Cancel / Back to Home</a>
        @endauth
        
        <form action="{{ route('user.booking.payment.verify') }}" method="POST" id="payment-form">
            @csrf
            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
            <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
            <input type="hidden" name="razorpay_signature" id="razorpay_signature">
            <input type="hidden" name="booking_id" value="{{ $booking->id }}">
        </form>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    @if(isset($isTestMode) && $isTestMode)
        // Test Mode Logic
        console.log("Test Mode Active: Simulating Payment");
        document.getElementById('rzp-button1').innerText = "Simulate Successful Payment (Test Mode)";
        document.getElementById('rzp-button1').classList.remove('bg-indigo-600', 'hover:bg-indigo-700');
        document.getElementById('rzp-button1').classList.add('bg-green-600', 'hover:bg-green-700');
        
        document.getElementById('rzp-button1').onclick = function(e){
            e.preventDefault();
            // Simulate success
            var mockPaymentId = 'pay_mock_' + Math.random().toString(36).substr(2, 9);
            var mockSignature = 'sig_mock_' + Math.random().toString(36).substr(2, 9);
            
            document.getElementById('razorpay_payment_id').value = mockPaymentId;
            document.getElementById('razorpay_order_id').value = "{{ $order->id }}";
            document.getElementById('razorpay_signature').value = mockSignature;
            document.getElementById('payment-form').submit();
        }
    @else
        // Real Razorpay Logic
        var options = {
            "key": "{{ config('services.razorpay.key') }}",
            "amount": "{{ $order->amount }}",
            "currency": "INR",
            "name": "Car Booking",
            "description": "Booking #{{ $booking->id }} Payment",
            "order_id": "{{ $order->id }}", 
            "handler": function (response){
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.getElementById('payment-form').submit();
            },
            "prefill": {
                "name": "{{ $booking->customer->name }}",
                "email": "{{ $booking->customer->email }}",
                "contact": "{{ $booking->customer->phone }}"
            },
            "theme": {
                "color": "#4F46E5"
            },
            "modal": {
                "ondismiss": function(){
                    // Optional handling
                }
            }
        };

        var rzp1 = new Razorpay(options);

        document.getElementById('rzp-button1').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }

        // Auto open on load
        window.onload = function() {
            rzp1.open();
        };
    @endif
</script>
@endsection

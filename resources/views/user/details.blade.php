@extends('user.layout.style')

@section('content')
  <div class="row mt-5 d-flex justify-content-center">

    <div class="col-4 ">
      <img src="{{ asset('uploads/' . $pizza->image) }}" class="img-thumbnail" width="100%"> <br>
      <a href="{{ route('user#order') }}" class="btn btn-primary float-end mt-2 col-12"><i
          class="fas fa-shopping-cart"></i> Order</a>
      <button onclick="goBack()" class="btn bg-dark text-white" style="margin-top: 20px;">
        <i class="fas fa-arrow-left"></i> Back
      </button>
    </div>
    <div class="col-6">
      <h6>Name</h6>
      <small>{{ $pizza->pizza_name }}</small>
      <hr>
      <h6>Price</h6>
      <small>{{ $pizza->price }}</small> Kyats
      <hr>
      <h6>Discount Price</h6>
      <small>{{ $pizza->discount_price }}</small> Kyats
      <hr>
      <h6>Buy 1 Get 1</h6>
      <small>
        @if ($pizza->buy_one_get_one_status == '0')
          Not Have
        @else
          Have
        @endif
      </small>
      <hr>
      <h6>Waiting Time</h6>
      <small>{{ $pizza->waiting_time }}</small>
      <hr>
      <h6>Description</h6>
      <small>{{ $pizza->description }}</small>
      <hr>
      <h6 class="text-danger">Total Price</h6>
      <small>{{ $pizza->price - $pizza->discount_price }}</small> Kyats
    </div>
  </div>
@endsection

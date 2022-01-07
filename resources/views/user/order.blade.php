@extends('user.layout.style')

@section('content')
  <div class="row mt-5 d-flex justify-content-center">
    Order Page
    <div class="col-4 ">
      <img src="{{ asset('uploads/' . $pizza->image) }}" class="img-thumbnail" width="100%"> <br>

      <a href="{{ route('user#index') }}" class="btn bg-dark text-white" style="margin-top: 20px;">
        <i class="fas fa-arrow-left"></i> Back
      </a>
    </div>
    <div class="col-6">
      @if (Session::has('orderSuccess') && Session::has('time'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ Session::get('orderSuccess') }} Please Wait {{ Session::get('time') }} Minutes...
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      <h6>Name</h6>
      <small>{{ $pizza->pizza_name }}</small>
      <hr>
      <h6>Price</h6>
      <small>{{ $pizza->price - $pizza->discount_price }}</small> Kyats
      <hr>
      <h6>Waiting Time</h6>
      <small>{{ $pizza->waiting_time }}</small>
      <hr>
      <form action="{{ route('user#order') }}" method="post">
        @csrf
        <h6>Pizza Count</h6>
        <input type="number" name="pizzaCount" placeholder="Number of pizza you want" class="form-control">
        @if ($errors->has('pizzaCount'))
          <small class="text-danger">{{ $errors->first('pizzaCount') }}</small>
        @endif
        <br>
        <hr>
        <h6>Payment Type</h6>
        <div class="form-check form-check-inline">
          <input type="radio" name="paymentType" id="creditCard" class="form-check-input" value="1">
          <label for="creditCard" class="form-check-label">Credit Card</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" name="paymentType" id="cash" class="form-check-input" value="2">
          <label for="cash" class="form-check-label">Cash</label>
        </div>
        <br>
        @if ($errors->has('paymentType'))
          <small class="text-danger">{{ $errors->first('paymentType') }}</small>
        @endif
        <button type="submit" class="btn btn-primary mt-3"><i class="fas fa-shopping-cart"></i>
          Place Order</button>
      </form>

    </div>
  </div>
@endsection

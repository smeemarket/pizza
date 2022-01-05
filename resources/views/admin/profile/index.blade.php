@extends('admin.layout.app')

@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <legend class="text-center">User Profile</legend>
                </div>
                <div class="card-body">
                  @if (Session::has('updateSuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ Session::get('updateSuccess') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
                  @if (Session::has('passwordErrors'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ Session::get('passwordErrors') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form action="{{ route('admin#updateProfile', $user->id) }}" method="POST"
                        class="form-horizontal">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" placeholder="Name"
                              value="{{ old('name', $user->name) }}">
                            @if ($errors->has('name'))
                              <small class="text-danger">{{ $errors->first('name') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                          <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" placeholder="Email"
                              value="{{ old('email', $user->email) }}">
                            @if ($errors->has('email'))
                              <small class="text-danger">{{ $errors->first('email') }}</small>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputPhone" class="col-sm-3 col-form-label">Phone</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" name="phone" placeholder="Phone"
                              value="{{ old('phone', $user->phone) }}">
                            @if ($errors->has('phone'))
                              <small class="text-danger">{{ $errors->first('phone') }}</small>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputAddress" class="col-sm-3 col-form-label">Address</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="address" placeholder="Address"
                              value="{{ old('address', $user->address) }}">
                            @if ($errors->has('address'))
                              <small class="text-danger">{{ $errors->first('address') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-3 col-sm-9">
                            <a href="{{ route('admin#changePasswordPage') }}">Change password</a>
                            <button type="submit" class="btn btn-sm bg-dark text-white float-end">Update</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@extends('admin.layout.app')

@section('content')

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
              <a href="{{ route('admin#pizza') }}" class="btn btn-sm btn-dark">
                <i class="fas fa-arrow-left"></i>
                Back
              </a>
              <div class="card mt-3">
                <div class="card-header p-2">
                  <legend class="text-center">Add Pizza</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form method="POST" action="{{ route('admin#createPizza') }}" class="form-horizontal"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" placeholder="Enter pizza name"
                              name="name">
                            @if ($errors->has('name'))
                              <small class="text-danger">{{ $errors->first('name') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Image</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" name="image">
                            @if ($errors->has('image'))
                              <small class="text-danger">{{ $errors->first('image') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Price</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="Enter pizza price" name="price">
                            @if ($errors->has('price'))
                              <small class="text-danger">{{ $errors->first('price') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Publish Status</label>
                          <div class="col-sm-10">
                            <select name="publish" id="" class="form-control">
                              <option value="1">Publish</option>
                              <option value="0">Unpublish</option>
                            </select>
                            @if ($errors->has('publish'))
                              <small class="text-danger">{{ $errors->first('publish') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Category</label>
                          <div class="col-sm-10">
                            <select name="category" class="form-control">
                              @foreach ($category as $item)
                                <option value="{{ $item->category_id }}">{{ $item->category_name }}</option>
                              @endforeach
                            </select>
                            @if ($errors->has('category'))
                              <small class="text-danger">{{ $errors->first('category') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Discount</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" placeholder="Enter discount price"
                              name="discount">
                            @if ($errors->has('discount'))
                              <small class="text-danger">{{ $errors->first('discount') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Buy 1 Get 1</label>
                          <div class="col-sm-10">
                            <input type="radio" name="buyOneGetOne" id="yes" class="form-input-check" value="1"> <label
                              for="yes">Yes</label>
                            <input type="radio" name="buyOneGetOne" id="no" class="form-input-check" value="0"> <label
                              for="no">No</label><br>
                            @if ($errors->has('buyOneGetOne'))
                              <small class="text-danger">{{ $errors->first('buyOneGetOne') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Waiting Time</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" name="waitingTime"
                              placeholder="Enter waiting time">
                            @if ($errors->has('waitingTime'))
                              <small class="text-danger">{{ $errors->first('waitingTime') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-sm-2 col-form-label">Description</label>
                          <div class="col-sm-10">
                            <textarea name="description" id="" rows="3" class="form-control"
                              placeholder="Enter description"></textarea>
                            @if ($errors->has('description'))
                              <small class="text-danger">{{ $errors->first('description') }}</small>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white">Add</button>
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

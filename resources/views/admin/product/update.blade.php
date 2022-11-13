@extends('admin.Layouts.master')

@section('title', 'Additional Setting')

@section('header')
    <h3>Upadate Product Page</h3>
@endsection

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-4 offset-8">
                        <a href="{{ route('product#detailPage',$data->id) }}"><button class="btn bg-dark text-white mb-3"><i
                                    class="fa-solid fa-left-long me-2"></i>Back to Detail Page</button></a>
                    </div>
                </div>
                <div class="col-lg-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Update Product Details Form</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#updateProduct') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-7">
                                        <input id="cc-pament" value="{{ old('name',$data->id) }}" name="id" type="hidden" class="form-control" aria-required="true" aria-invalid="false" >
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Name</label>
                                            <input id="cc-pament" value="{{ old('name',$data->name) }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Name...">
                                            @error('name')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Category</label>
                                            <select id="cc-pament" name="category" type='text' class="form-control @error('category') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                                <option value="">Choose Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if($data->category_id == $category->id) selected @endif >{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Price</label>
                                            <input id="cc-pament" value="{{ old('price',$data->price) }}" name="price" type="number" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product price...">
                                            @error('price')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                            <input id="cc-pament" value="{{ old('waitingTime',$data->waiting_time) }}" name="waitingTime" type="text" class="form-control @error('waitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Waiting Time...">
                                            @error('waitingTime')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="cc-payment" class="control-label mb-1">Description</label>
                                            <textarea id="cc-pament" name="description" type="text" class="form-control @error('description') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Entr Description...">{{ old('description',$data->description) }}</textarea>
                                            @error('description')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="ms-5 mt-2 rounded">
                                            <div>
                                                <img src="{{ asset('storage/'.$data->image) }}"  class="img-thumbnail shadow"
                                                style="width:100%" alt="">
                                            </div>
                                            <div class="form-group">
                                                <input id="cc-pament" name="image" type="file"
                                                    class="form-control shadow @error('image') is-invalid @enderror"  value="{{ asset('storage/'.$data->image) }}"
                                                    aria-required="true" aria-invalid="false">
                                                @error('image')
                                                    <small class="invalid-feedback">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="ms-5 mt-4 form-group">
                                            <input id="cc-pament" name="viewCount" type="text"
                                                value="View Count - {{ $data->view_count }}"
                                                class="form-control @error('viewCount') is-invalid @enderror"
                                                aria-required="true" aria-invalid="false" disabled>
                                        </div>
                                        <div class="ms-5 mt-4">
                                            <button id="payment-button" type="submit"
                                                class="btn btn-lg btn-info btn-block shadow">
                                                <span id="payment-button-amount">Save</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection

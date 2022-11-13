@extends('admin.Layouts.master')

@section('title','Category Create Page')

@section('header')
    <h3>Create Products</h3>
@endsection

@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('product#listPage') }}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>
                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Product Form</h3>
                            </div>
                            <hr>
                            <form action="{{ route('product#createProduct') }}" method="post" novalidate="novalidate" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" value="{{ old('name') }}" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Name...">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">Category</label>
                                    <select id="cc-pament" name="category" type='text' class="form-control @error('category') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                        <option value="">Choose Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" >{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">Price</label>
                                    <input id="cc-pament" value="{{ old('price') }}" name="price" type="number" class="form-control @error('price') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product price...">
                                    @error('price')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">Image</label>
                                    <input id="cc-pament" value="{{ old('image') }}" name="image" type="file" class="form-control @error('image') is-invalid @enderror" aria-required="true" aria-invalid="false">
                                    @error('image')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">Waiting Time</label>
                                    <input id="cc-pament" value="{{ old('waitingTime') }}" name="waitingTime" type="text" class="form-control @error('waitingTime') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Enter Product Waiting Time...">
                                    @error('waitingTime')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="cc-payment" class="control-label mb-1">Description</label>
                                    <textarea id="cc-pament" name="description" type="text" class="form-control @error('description') is-invalid @enderror" aria-required="true" aria-invalid="false" placeholder="Entr Description...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-info col-12 my-2">
                                        <span id="payment-button-amount">Create</span>
                                        <i class="fa-solid fa-circle-right"></i>
                                    </button>
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

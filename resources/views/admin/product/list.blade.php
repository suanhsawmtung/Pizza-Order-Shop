@extends('admin.Layouts.master')

@section('title', 'Product List Page')

@section('header')

    <form class="form-header" action="{{ route('product#listPage') }}" method="GET">
        @csrf
        <input class="au-input au-input--xl" value="{{ request('search') }}" type="text" name="search"
            placeholder="Search for datas &amp; reports..." />
        <button class="au-btn--submit" type="submit">
            <i class="zmdi zmdi-search"></i>
        </button>
    </form>

@endsection


@section('content')

    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <div class="overview-wrap">
                                <h2 class="title-1">Product List</h2>

                            </div>
                        </div>
                        <div class="col-3 offset-1 ">
                            <h3>Total - ( {{ $products->total() }} )</h3>
                        </div>
                        <div class="table-data__tool-right">
                            <a href="{{ route('product#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add Product
                                </button>
                            </a>
                            <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                CSV download
                            </button>
                        </div>
                    </div>
                    @if (session('deleteSuccess'))
                        <div class="alert alert-danger alert-dismissible fade show " role="alert">
                            <span>{{ session('deleteSuccess') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('createSuccess'))
                        <div class="alert alert-success alert-dismissible fade show " role="alert">
                            <span>{{ session('createSuccess') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (count($products) != 0)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>View_count</th>
                                        <th>CRUD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr class="tr-shadow">
                                            <td class="desc col-3 text-center"><img src="{{ asset('storage/'.$product->image) }}" class="img-thumbnail shadow" style="width: 150px" alt=""></td>
                                            <td class="col-2">{{ $product->name }}</td>
                                            <td class="col-2">{{ $product->category_name }}</td>
                                            <td class="col-2">{{ $product->price}}</td>
                                            <td class="col-1">{{ $product->view_count }}</td>
                                            <td class="col-2">
                                                <div class="table-data-feature">
                                                    <button class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Send">
                                                        <i class="zmdi zmdi-mail-send"></i>
                                                    </button>
                                                    <a href="{{ route('product#updatePage',$product->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Edit">
                                                            <i class="zmdi zmdi-edit"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#deletePage',$product->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="Delete">
                                                            <i class="zmdi zmdi-delete"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{ route('product#detailPage',$product->id) }}">
                                                        <button class="item" data-toggle="tooltip" data-placement="top"
                                                            title="More">
                                                            <i class="zmdi zmdi-more"></i>
                                                    </button>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="spacer"></tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h3 class="mt-5 text-center text-muted">There is no product here.</h3>
                    @endif
                    {{ $products->links() }}
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
    <!-- END MAIN CONTENT-->

@endsection

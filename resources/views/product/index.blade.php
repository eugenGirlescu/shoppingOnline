@extends('layouts.app')

@section('content')
<h2 class="text-center">Products</h2>
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb my-5">
            <div class="card mb-4 border-0" style="width: 10.5em;margin:0 auto;">
                <button class="btn btn-success" onclick="addProduct();">Add product</button>
            </div>
            <div id="add-product"></div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ session()->get('success') }} </p>
            </div>
            @endif
            <div class="card" style="width: 55.5em;margin:0 auto;">
                <div class="card-body">
                    <table class="table table-striped table-hover table-white table-responsive-lg ">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Category</th>
                                <th scope="col">Expire date</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="listing_products">
                            @foreach($products as $product)
                            @include('product.tableItems')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
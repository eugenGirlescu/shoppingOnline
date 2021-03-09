@extends('layouts.app')

@section('content')


<div class="row">
    <h4 class="text-center">Categories</h4>
    <div class="col-lg-12 margin-tb my-5">
        <div class="card mb-4 border-0" style="width: 10.5em;margin:0 auto;">
            <button class="btn btn-success" onclick="addCategory();">Add category</button>
        </div>
        <div id="add_category"></div>
        <div class="card" style="width: 55.5em;margin:0 auto;">
            <div class="card-body">
                <table class="table table-striped table-hover table-white table-responsive-lg ">
                    <thead>
                        <tr>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        @include('category.tableItems')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@endsection
<tr id="item_prod_{{ $product->id }}">
    <td>{{ $product->name }}</td>
    <td>{{  $product->category->name }}</td>
    <td>{{ $product->expire_date }}</td>
    <td>
        <form action="/add-order-items" method="post" class="mr-2">
            @csrf
            <select class="custom-select" id="quantity" name="quantity">

            </select>
    </td>
    <td>
        <input type="hidden" name="product_id" class="form-control" value="{{$product->id}}">
        <button type="submit" class="btn btn-success">
            Add to cart
        </button>
        </form>
        <a class="btn btn-primary btn-md" onclick="editProduct({{ $product->id }});">Edit</a>

        <button class="btn btn-danger btn-md" data-toggle="modal" data-target="#categoryModal"
            data-id="{{ $product->id }}">
            Delete
        </button>
    </td>
</tr>

<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Delete product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Do you want to delete product {{$product->name}} ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <form action="{{ route(('products.destroy'), $product->id) }}" method="post" style="display:inline;">
                    {{csrf_field()}}
                    {{ method_field('DELETE') }}
                    <button class="btn btn-danger btn-sm" type="submit">Yes
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {
    $("#categoryModal").on("show.bs.modal");
});

$(function() {
    var select = '';
    for (i = 1; i <= 15; i++) {
        select += '<option val=' + i + '>' + i + '</option>';
    }
    $('.custom-select').html(select);
});
</script>
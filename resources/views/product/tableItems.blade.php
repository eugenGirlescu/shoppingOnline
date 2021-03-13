<tr id="item_prod_{{$product->id}}">
    <td>{{ $product->name }}</td>
    <td>{{  $product->category->name }}</td>
    <td>{{ $product->expire_date }}</td>
    <td>
        <a class="btn btn-primary" onclick="editProduct({{ $product->id }});">Edit</a>

        <a class="btn btn-danger">Delete</a>
    </td>
</tr>
<tr id="edit-item_{{$product->id}}">
    <td>
        <input type="text" class="form-control" name="name" id="product-name_{{$product->id}}"
            value="{{$product->name}}" onkeydown="removeEditError('product-name_{{$product->id}}');" />
        <span id="prod-error" class="text-danger"></span>
    </td>
    <td>
        <select id="category_id" class="form-control" name="category_id">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <input type="date" class="form-control" name="expire_date" id="expire-date_{{ $product->id }}"
            value="{{ $product->expire_date }}" onchange="removeEditError('expire-date_{{ $product->id }}')" ; />
        <span id="date-error" class="text-danger"></span>
    </td>
    <td>
        <button type="button" class="btn btn-success btn-md" onclick="updateProduct({{ $product->id }});">Update
            product</button>
        <a href="{{ route('products.index') }}" class="btn btn-success">Back</a>
    </td>
</tr>
<tr id="edit-item_{{$product->id}}">
    <td>
        <input type="text" name="name" id="product-name_{{$product->id}}" value="{{$product->name}}" />
    </td>
    <td>
        <select id="category_id" name="category_id">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <input type="date" name="expire_date" id="expire-date_{{ $product->id }}" value="{{ $product->expire_date }}" />
    </td>
    <td>
        <button type="button" class="btn btn-success btn-sm-md" onclick="updateCategory({{ $product->id }});">Update
            product</button>
    </td>
</tr>
<tr id="edit-item_{{$category->id}}">
    <td>
        <input type="text" name="name" id="category-name_{{$category->id}}" placeholder="Edit category.."
            value="{{$category->name}}" />
            <span id="categ-update" class="alert-danger"></span>
    </td>
    <td>
        <button type="button" class="btn btn-success btn-sm-md" onclick="updateCategory({{$category->id}});">Update
            category</button>
    </td>
</tr>
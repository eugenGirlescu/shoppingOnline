<tr id="item_{{$category->id}}">
    <td>{{ $category->name }}</td>
    <td>
        <a class="btn btn-primary" onclick="editCategory({{ $category->id }});">Edit</a>

        <a class="btn btn-danger">Delete</a>
    </td>
</tr>
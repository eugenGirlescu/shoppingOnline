<form class="row justify-content-center pb-3 pt-3 border text-center" id="product-form">
    <div class="col-sm-3 text-center form-group">
        <input type="text" name="name" id="add-prod" placeholder='Enter product here...' autocomplete="off"
            onkeydown="removeError();" />
        <span id="prod-error" class="text-danger"></span>
    </div>
    <div class="col-sm-3  text-center form-group">
        <input type="date" name="expire_date" id="add-date" onchange="removeError();" />
        <span id="date-error" class="text-danger"></span>
    </div>
    <div class="col-sm-3  text-center form-group">
        <select id="category_id" name="category_id">
            @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

    </div>
    <div class="col-sm-3 form-group">
        <button type="button" class="btn btn-success" onclick="saveProduct();">Create product</button>
    </div>

</form>
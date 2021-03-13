<form class="row justify-content-center pb-3 pt-3 border text-center" id="category_form">
    <div class="col-sm-6  text-center form-group">
        <input type="text" name="name" id="add-categ" placeholder='Enter category here...' autocomplete="off" onkeydown="removeError();"/>
        <span id="error"></span>
    </div>
    <div class="col-sm-6 form-group">
        <button type="button" class="btn btn-success" onclick="saveCategory();">Create category</button>
    </div>

</form>
$( document ).ready(function() {

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

});

function addCategory()
{
    $.get('categories/create', {} , function(data) {
        $('#add_category').html(data);
    })
}

function saveCategory() 
{
    var data = $('#category_form').serializeArray();
    var categInput = $('#add-categ').val();
    var isEmpty = 1;

    if(categInput == "")
    {
        $('#error').text('category required');
        isEmpty = 0;
    }

    if(isEmpty == 1)
    {
        $.post('categories', data , function(response) {
            $('#listing_categories').append(response)
            $('#category_form').remove()
        });
    }
}

function removeError()
    {
        $('#error').text('');
    }

    function editCategory(id) {
        $.get('categories/' + id + '/edit', {} , function(response) {
            $('#item_' + id).replaceWith(response)
        })
    }

    function updateCategory(id) {
        let categName = $('#category-name_' + id).val();

        let data = {
            categName : categName
        };

        $.ajax({
            url: '/categories/' + id,
            type: 'PUT',
            data: data,
            success: function (result) {
              
                $("#edit-item_" + id).replaceWith(result);
            }
    
        });
    }

    ///////////////////////////////////////////////////////////

    function addProduct() {
        $.get('products/create', {} , function(response) {
            $('#add-product').html(response)
        })
    }

    function saveProduct() {
        let data = $('#product-form').serializeArray();
        let productName = $('#add-prod').val();
        let dateName = $('#add-date').val();

        let isEmpty = 1;

        if(productName == "") {
            $('#prod-error').text('product name required')
            isEmpty = 0;
        }

        if(dateName =="") {
            $('#date-error').text('date required')
            isEmpty = 0;
        }

        if(isEmpty == 1) {
            $.post('products', data , function(response) {
                $('#listing_products').append(response)
                $('#product-form').remove();
            })
        }
    }

    function removeError(input) {
        if(input == 'add-prod') {
            $('#prod-error').text('')
        }

        if(input == 'expire-date') {
            $('#date-error').text('')
        }
    }

    function editProduct(id) {
        $.get('/products/' + id + '/edit', {} , function(response) {
            $('#item_prod_' + id).replaceWith(response)
        })
    }

    function updateCategory(id) {
        let prodName = $('#product-name_' + id).val();
        let dateName = $('#expire-date_' + id).val();
        let categName = $('#category_id').val();

        let data = {
            prodName : prodName,
            categName : categName,
            dateName : dateName
        }

        $.ajax({
            url: '/products/' + id,
            type: 'PUT',
            data: data,
            success: function (result) {
              
                $("#edit-item_" + id).replaceWith(result);
            }
    
        });
    }
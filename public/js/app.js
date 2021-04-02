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
        $.get('check-exist/' + categInput, {} , function(result) {
            if(result == 'notExist') {
                $.post('categories', data , function(response) {
                    $('#listing_categories').append(response)
                    $('#category_form').remove()
                });
            }else {
                $('#error').text('category already exist')
            }
        })
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
        let isEmpty = 1;

        let data = {
            categName : categName
        };

        if(categName == "") {
            $('#categ-update').text('category required');
            isEmpty = 0;
        }

       if(isEmpty == 1) {

        $.get('check-exist-update/' +id + '/' + categName, {} , function(resp) {
            if(resp == 'notExist') {
                $.ajax({
                    url: '/categories/' + id,
                    type: 'PUT',
                    data: data,
                    success: function (result) {
                      
                        $("#edit-item_" + id).replaceWith(result);
                    }
                });
            }
        })
       }
    }

    ///////////////////////////////////////////////////////////

    function addProduct() {
        $.get('products/create', {} , function(response) {
            $('#add-product').html(response)
        })
    }

    function saveProduct() {
        let data = $('#product-form').serializeArray();
        let categId = $('#category_id').val();
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
            $.get('check-prod/' + productName + '/' + categId, {} , function(res) {
               
                if(res == 'notExist') {
                    $.post('products', data , function(response) {
                        $('#listing_products').append(response)
                        $('#product-form').remove();
                    })
                }else {
                    $('#prod-error').text('product already exist in this category')
                }
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

    function updateProduct(id) {
        let prodName = $('#product-name_' + id).val();
        let dateName = $('#expire-date_' + id).val();
        let categName = $('#category_id').val();
        let isEmpty = 1;

        if(prodName == "") {
            $('#prod-error').text('name required');
            isEmpty = 0;
        }

        if(dateName == "") {
            $('#date-error').text('date required');
            isEmpty = 0;
        }

        if(isEmpty == 1) {

            let data = {
                prodName : prodName,
                categName : categName,
                dateName : dateName
            }
            
            $.get('check-prod-update/' + id + '/' + prodName + '/' + categName, {} , function(res) {
                if(res == 'not exist') {
                    $.ajax({
                        url: '/products/' + id,
                        type: 'PUT',
                        data: data,
                        success: function (result) {
                          
                            $("#edit-item_" + id).replaceWith(result);
                        }
                    });
                } else {
                    $('#prod-error').text('product already exist in this category!')
                }
            })
        }
    }

    function removeEditError() {
        $('#prod-error').text('');
    }

    function placeOrder() {
        let delivery = $('#delivery_type').val();
        let hour = $('#hour').val();
        let status = $('#status').val();
        let totalPrice = $('#total').val();

        if(hour == "") {
            alert('Please select hour');
            
            return false;
        }

        const data = {
            'delivery': delivery,
            'hour': hour,
            'status': status,
            'totalPrice': totalPrice
        }

        $.post('update-order-status', data , function(resp) {
            $('#myCart').replaceWith(resp);
        });
    }

    function updateStatus(id) {
        let status = $('#status_' + id).val();

        const data = {
            'status': status,
            'id': id
        }

        $.post('update-order-status', data , function(response) {
            alert('Status has been updated!')
            location.reload()
        })
    }


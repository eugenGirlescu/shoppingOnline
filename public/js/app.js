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
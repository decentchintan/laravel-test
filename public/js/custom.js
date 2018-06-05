
$('#inventory-form').on('submit', function(e){
    if($('#product-name').val() == '' || $('#quantity-in-stock').val() == '' || $('#price-per-item').val() == ''){
        alert('Please fill all required fields');
        return false;
    }
    e.preventDefault();
    $.ajax({
        url: uri, 
        data: {
            _token:token,
            product_name:$('#product-name').val(), 
            quantity_in_stock:$('#quantity-in-stock').val(),
            price_per_item:$('#price-per-item').val(),
        },
        type:'POST',
        success: function(response){

            if(response.result){
                $(".show-inventory-here").html(response.data);
                $('#product-name').val('');
                $('#quantity-in-stock').val('');
                $('#price-per-item').val('');
                $('.errors').empty();
                alert('Product has been added successfully.');
            }else{
                var errors = '<li>Please correct the below errors</li>';
                for (var key in response.errors) {
                    errors += "<li>" + key + ':' + response.errors[key][0] + "</li>";
                }
                $('.errors').html(errors);

            }
        }});
});


$(document).ready(function(){


    $('#myForm').validate({
        rules: {

            product_name: {
                required: true,
                lettersonly: true
            },

            price: {
                required: true,
                number: true
            },
            
            special_price: {
                required: true,
                number: true
            },

            quantity: {
                required: true,
                number: true
            },

            uploadedimage: {
                required: true,
                extension: "jpg,png",


            },
            category_select: {
                required: true
            }
        },

        messages: {
            uploadFile: {
                required: "You must insert an image",
                extension: "Only .jpg and .png images allowed"

            },
            category_select: {
                required: "Please select an option"

            }
        }
    });

    $('#myCoupon').validate({
        rules: {

            code: {
                required: true,
                alphanumeric:true
            },

            percentage_off: {
                required: true,
                number: true
            },

            quantity: {
                required: true,
                number: true
            },


            status: {
                required: true
            }
        },

    });



});

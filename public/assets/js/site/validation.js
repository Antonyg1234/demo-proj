$(document).ready(function(){


    $('#siteForm').validate({
        rules: {

            firstname: {
                required: true,
                lettersonly: true
            },

            lastname: {
                required: true,
                lettersonly: true
            },
            
            email: {
                required: true,
                email: true
            },

            password: {
                required: true,
                alphanumeric: true,
                rangelength: [8, 12]
            },

            password_confirm: {
                required: true,
        
            },
            
        },

    });

   


});

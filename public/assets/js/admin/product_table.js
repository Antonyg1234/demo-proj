$(document).ready(function() {

    $('#productTable').DataTable( {
        "paging": true,
        "ordering": true,
        "info": true,
        "pageLength": 5,
        "order": [[1, "asc"]],
        "processing": true,
        "serverSide": true,
        ajax: {
            "url": datatable_url,
            "type": "POST"
        },
        columns: [
            /*{
             className:      'details-control',
             orderable:      false,
             data:           null,
             defaultContent: ''
             },*/
            //{ data: "index"},
            {data: "id"},
            {data: "name"},
            {data: "image_name"},
            {data: "price"},
            {data: "special_price" },
            {data: "quantity"},
            {data: "status"},
            {data: "id"},

        ],
        "rowCallback": function( row, data, index ) {
            $('td:eq(0)', row).html( index+1);
            $('td:eq(2)', row).html('<img src="'+image_url+''+data.image_name+'" alt="" style="width:80px; height:auto;">');
            $('td:eq(7)', row).html( '<a class="fa fa-trash" onclick="deleteProduct('+data.id+')"></a> <a class="fa fa-edit" href="'+edit_url+''+data.id+'"></a>');
        },
        order: [[0, 'asc']]
    });

});




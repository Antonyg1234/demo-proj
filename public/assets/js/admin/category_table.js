$(document).ready(function() {

    $('#categoryTable').DataTable( {
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
            { data: "id"},
            { data: "name"},
            { data: "parent_name"},
            { data: "id"}

        ],
        "rowCallback": function( row, data,index ) {
            $('td:eq(0)', row).html(index+1);
            $('td:eq(3)', row).html( '<a class="fa fa-trash" onclick="deleteCategory('+data.id+')"></a> <a class="fa fa-edit" href="'+edit_url+''+data.id+'"></a>');
        },
        order: [[0, 'asc']]
    });

});


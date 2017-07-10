$(document).ready(function() {

    $('#templateTable').DataTable( {
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
            { data: "title"},
            { data: "subject"},
            { data: "id"},

        ],
           "rowCallback": function( row, data,index ){
            $('td:eq(0)', row).html(index+1);
            $('td:eq(3)', row).html('<a class="fa fa-trash" style="cursor:pointer;" onclick="deleteSystem('+data.id+')"></a> <a class="fa fa-edit" style="cursor: pointer;" href="'+edit_url+''+data.id+'"></a>');
        },
        order: [[0, 'asc']]
    });

});

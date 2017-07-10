$(document).ready(function() {

    $('#couponTable').DataTable( {
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
            { data: "created_date"},
            { data: "code"},
            { data: "order_id"},
            { data: "firstname"},
            { data: "email"},
            
            //{ data: "id"},

        ],
           "rowCallback": function( row, data,index ) {
            $('td:eq(0)', row).html(index+1);
            $('td:eq(4)', row).html(data.firstname+' '+data.lastname);
            //$('td:eq(4)', row).html('<a class="fa fa-trash" style="cursor:pointer;" onclick="deleteBanner('+data.id+')"></a> <a class="fa fa-edit" style="cursor: pointer;" href="'+edit_url+''+data.id+'"></a>');
        },
        order: [[0, 'asc']]
    });

});

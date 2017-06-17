$(document).ready(function() {

    $('#myTable').DataTable( {
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
            {data:"id"},
            { data: "firstname"},
            { data: "lastname"},
            { data: "email" },
            { data: "role" },
            {data:"id"},

        ],
        "rowCallback": function( row, data, index ) {
           // console.log(data.id);
            $('td:eq(0)', row).html( index+1);
            $('td:eq(5)', row).html( '<a class="fa fa-trash" onclick="deleteFunction('+data.id+')"></a> <a class="fa fa-edit" href="'+edit_url+''+data.id+'"></a>');
        },
        order: [[0, 'asc']]
    });
   
});



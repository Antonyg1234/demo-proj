var table = $('#myTable').DataTable( {
    //ajax: datatable_url,
    columns: [
        {
            className:      'details-control',
            orderable:      false,
            data:           null,
            defaultContent: ''
        },
        { data: "First name" },
        { data: "Last name" },
        { data: "Email" },
        { data: "role" }
    ],
    order: [[0, 'asc']]
} );


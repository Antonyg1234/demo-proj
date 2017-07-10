$(document).ready(function() {

    $('#orderTable').DataTable({
        "paging": true,
        "ordering": true,
        "info": true,
        "pageLength": 5,
        "order": [[1, "asc"]],
        "processing": true,
        "serverSide": true,
        ajax: {
            "url": datatable_url,
            "type": "POST",
        },
        columns: [
            /*{
             className:      'details-control',
             orderable:      false,
             data:           null,
             defaultContent: ''
             },*/
            { data: "id"},
            {data: "order_id"},
            { data: "firstname"},
            { data: "email"},
            { data: "contact_no"},
            { data: "billing_address_1"},
            { data: "id"},


        ],
        "rowCallback": function( row, data,index ){
            $('td:eq(0)', row).html(index+1);
            $('td:eq(2)', row).html(data.firstname+' '+data.lastname);
            $('td:eq(5)', row).html(data.billing_address_1+',<br>'+data.billing_address_2+',<br>'+data.billing_city+'-'+data.billing_zipcode+',<br>'+data.statename+',<br>'+data.countryname);
            $('td:eq(6)', row).html('<button type="button" class="btn btn-info btn-sm order_product" data-id="'+data.id+'" data-toggle="modal" data-target="#myModal">View</button>'
            );
        },
        order: [[0, 'asc']]
    });

    $(document).on('click', ".order_product", function (){
         var id = $(this).data('id');
         //console.log(view_url+id);
          $("#modal-placeholder").load(view_url+id);
          
      });
    
});

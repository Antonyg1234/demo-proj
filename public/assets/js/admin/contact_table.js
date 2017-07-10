$(document).ready(function(){

    $('#contactTable').DataTable( {
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
            { data: "name"},
            { data: "email"},
            { data: "contact_no"},
            { data: "id"},


        ],
        "rowCallback": function( row, data,index ){
            $('td:eq(0)', row).html(index+1);
            $('td:eq(4)', row).html('<button type="button" class="btn btn-info btn-sm msg" id="msg" data-id="'+data.id+'" data-toggle="modal" data-target="#myModal">View</button> <button type="button" class="btn btn-info btn-sm reply reply_button" id="reply" data-id="'+data.id+'" '+data.flag+' data-toggle="modal" data-target="#myReply">'+data.reply+'</button>'
            );
        },
        order: [[0, 'asc']]
       // console.log(data.flag);
    });

$(document).on('click', ".msg", function (){
         var id = $(this).data('id');
          //alert(id);
          console.log(id);

          $.ajax({
              url: view_url,
              async: false,
              type: "POST",
              data: {"id":id,
                     },
              success: function(data) {
                  
                  if (!(data)){   
                      alert('Empty array');
                  }
                  else{
                     $("#message").text(data);
                  }

              }
          });
      });

$(document).on('click', ".reply", function (){
         var id = $(this).data('id');
         //console.log(view_url+id);
          $("#modal-placeholder").load(reply_url+id);
          
      });

// var flag = $(.msg).data('flag');
// console.log(data.flag);

});

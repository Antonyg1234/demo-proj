$(document).ready(function(){

    $('.add_cart').on('click',function(){
    $('.disabled').click(function(e){
        e.preventDefault();
    });
    });

    $('.add_wishlist').on('click',function(){
    $('.disabled').click(function(e){
        e.preventDefault();
    });
    });

    $(document).on('click', ".add_wishlist", function (){
       var _this = $(this);
       var id = $(this).data('id');
       var row = $(this).data('row');
       $.ajax({
              url: wish_url,
              async: false,
              type: "POST",
              data: {"id":id},

              success: function(data) {
                  if (!(data)){   
                     var notifywish = alertify.error('User not logged in, Kindly login to add to wishlist', 'success', 5, function(){ window.location.replace(login_url); });
                    //alert('User not logged in, Kindly login to add to wishlist');
                    //window.location.replace(login_url);
                  }else{
                     _this.attr("disabled","true");
                     _this.addClass("added_wishlist");
                     _this.text('Added to wishlist');
                     $('#wish').html('<i class="fa fa-star"></i>Wishlist('+data+')');
                        alertify.notify('Added to Wishlist', 'success', 5);
                  }

              }

        });
    });

    $(document).on('click', ".add_wishlist_product", function (){
        var _this = $(this);
        var id = $(this).data('id');
        var row = $(this).data('row');
        // if(_this.attr("disabled"));
        $.ajax({
               url: wish_url,
               async: false,
               type: "POST",
               data: {"id":id},

               success: function(data){
                    if (!(data)){   
                          alertify.notify('User not logged in, Kindly login to add to wishlist', 'error', 5);
                          //alert('User not logged in, Kindly login to add to wishlist');
                          //window.location.replace(login_url);
                    }else{
                       _this.attr("disabled","true");
                       _this.css('color', 'red');
                       $('#wish').html('<i class="fa fa-star"></i>Wishlist('+data+')');
                       alertify.notify('Added to Wishlist', 'success', 5);
                    }

                }

        });
    });


    $(document).on('click', ".add_cart", function (){
          var _this = $(this);
          var id = $(this).data('id');
          var price = $(this).data('price');
          var name = $(this).data('name');
          var image_name = $(this).data('image');
          var quantity= $(this).data('quantity');
          console.log(quantity);

          if(quantity>0){
             $.ajax({
                   url: cart_url,
                   async: false,
                   type: "POST",
                   data: {"id":id,
                          "price":price,
                          "name":name,
                          "image_name":image_name,
                   },

              dataType: "json",
              success: function(data) {
                  //console.log(data);
                  var cart = data.cart;
                  var html = "";

                  if (!(data)){   
                    alert('empty data/error');
                  }
                  else{
                    //console.log(data.rows);
                    _this.attr("disabled","true");
                    _this.html('<i class="fa fa-shopping-cart"></i>Added To Cart');
                    _this.removeClass('add_cart');
                  } 

                  $('#ajaxCart').html('<i class="fa fa-shopping-cart"></i>Cart('+data.rows+')');  
                  alertify.notify('Added to Cart', 'success', 5);  
              }

              });
          }else{
              alertify.notify('Out of Stock', 'error', 5);
          }
    });


    var url = window.location;
    $('ul.nav li a').filter(function (){
    return this.href == url;
    }).addClass('active');


    $('.category').on('click',function(){
          var id = $(this).data('id');
          //alert(id);
          // console.log(id);
          $.ajax({
               url: js_url,
               async: false,
               type: "POST",
               data: {"id":id},
               dataType: "json",
               success: function(data) {
               	//	console.log(data);
              		 var html = "";
          				 if (!(data)){   
          				    alert('empty data/ error');
          				  }else{   
          				        html= data;
                    }
          				  console.log(html);
          				  $('#ajaxCategory').html(html);
                }
          })
      });


      
    $('.category').click(function(){
    $('li').removeClass('active');
    $(this).addClass('active');
    });

      

      $('.cart_update').on('click',function(){
          var id = $(this).data('id'); 
          var rowid = $(this).data('rowid'); 
          var row_id = $(this).data('row');
          var price = $(this).data('price');
          var qty = $("#qty"+row_id).val();
          qty++;
      //console.log(id);
          $.ajax({
                  url: update_url,
                  async: false,
                  type: "POST",
                  data: {"id":id,
                         "qty":qty,
                         "rowid":rowid,
                         "price":price,       
                        },

                  success: function(data) {
                      //console.log(data);
                      var html = "";
                      if (!(data)){   
                          //alert('You cannot add more quantity. Quantity Exceed !');
                          alertify.notify('You cannot add more quantity. Quantity Exceed !', 'error', 5);
                      }else{
                         $("#qty"+row_id).val(qty);
                         $("#total"+row_id).text("$"+data);
                      }

                  }
              })
      
     
      }); 


      $('.cart_decrease').on('click',function(){
          var id = $(this).data('id'); 
          var rowid = $(this).data('rowid'); 
          var row_id = $(this).data('row');
          var price = $(this).data('price');
          var qty = $("#qty"+row_id).val();
          if(qty==1){
             alertify.notify('Minimum 1 quantity should be selected', 'error', 3);
            //alert('Minimum 1 quantity should be selected');
          }else{
          qty--;
         // console.log(price);
               $.ajax({
                    url: decrease_url,
                    async: false,
                    type: "POST",
                    data: {"id":id,
                           "qty":qty,
                           "rowid":rowid,
                           "price":price,       
                          },
                  //dataType: "json",
                  success: function(data){
                     // console.log(data);
                        if (!(data)){   
                           //alert('Minimum 1 quantity should be selected');
                           alertify.notify('Minimum 1 quantity should be selected', 'error', 5);
                        }else{
                            //var total=qty*price;   
                            $("#qty"+row_id).val(qty);
                            $("#total"+row_id).text("$"+data);
                        }

                  }
                })
            }
       }); 


      $('.delete_cart').on('click',function(){
          var id = $(this).data('id');
          var rowid = $(this).data('rowid'); 
          var row_id = $(this).data('row');
          var price = $(this).data('price');
          var qty_add = $("#qty"+row_id).val();
          
         // alert(rowid);
          console.log(qty_add);
          $.ajax({
                  url: remove_url,
                  async: false,
                  type: "POST",
                  data: {
                         "id":id,
                         "qty_add":qty_add,
                         "rowid":rowid,
                         "price":price,       
                        },
                  
                  success: function(data) {
                      console.log(data);
                      if (!(data)){   
                          alert('empty data/ error');
                      }
                      else{
                         if(data == 0){
                             html = '<h3 style="text-align:center;color:#fe980f;">! No items in the Cart !</h3>';
                             $("#no_cart").html(html);
                             $("#replace_nocart").remove(); 
                             $('#ajaxCart').html('<i class="fa fa-shopping-cart"></i>Cart');
                             alertify.set('notifier','position', 'top-right');
                             alertify.notify('No items in cart', 'error', 5);
                             
                         }else{
                         $("#row"+row_id).remove();
                         
                         $('#ajaxCart').html('<i class="fa fa-shopping-cart"></i>Cart('+data+')');
                         alertify.set('notifier','position', 'top-right');
                         alertify.notify('Removed from Cart', 'success', 3);
                         }
                       }

                  }
              })
          
     
      }); 

      


    
      $(document).on('click', ".multi_cart", function (){
          var _this = $(this);
          var id = $(this).data('id');
          var price = $(this).data('price');
          var name = $(this).data('name');
          var image_name = $(this).data('image');
          var quantity = $(this).data('quantity');
          var qty = $("#qty"+id).val();
          
          if(quantity<qty){
          // alert('You cannot add more quantity. Quantity Exceed !');
              alertify.notify('You cannot add more quantity. Quantity Exceed !', 'error', 5);
          }else{
               console.log(qty);
               $.ajax({
                   url: multi_url,
                   async: false,
                   type: "POST",
                   data: {"id":id,
                          "qty":qty,
                          "price":price,
                          "name":name,
                          "image_name":image_name,
                         },
                   dataType: "json",
                   success: function(data) {
                   //console.log(data);
                       var cart = data.cart;
                       var html = "";
                  
                       if (!(data)){   
                           alert('empty data/error');
                       }else{
                    
                           _this.attr("disabled","true");
                           _this.text('Added To Cart');
                           alertify.notify('Added To Cart', 'success', 5);
                       } 
                  
                $('#ajaxCart').html('<i class="fa fa-shopping-cart"></i>cart('+data.rows+')');  
                  
                }

              });
           }
      });

    
     $('.delete_wishlist').on('click',function(){
            var id = $(this).data('id');
            var row_id = $(this).data('row');
              //console.log(qty);
            $.ajax({
                  url: delete_url,
                  async: false,
                  type: "POST",
                  data: {"id":id,},
                      
                  success: function(data) {
                      //console.log(data);
                      if (!(data)){   
                            alert('empty data/ error');
                       }else{
                            if(data == 0){
                                html = '<h3 style="text-align:center;color:#fe980f;">! No items in Wishlist !</h3>';
                                $("#no_cart_wish").html(html);
                                $('#wish').html('<i class="fa fa-star"></i>Wishlist');  
                                alertify.notify('No Items in Wishlist', 'error', 3);
                             }else{
                         
                                  $("#row"+row_id).remove();
                                  $('#wish').html('<i class="fa fa-star"></i>Wishlist('+data+')');
                                  alertify.notify('Removed from Wishlist', 'success', 3);
                             }
                       }

                  }
              })
      }); 


      $("select.country").change(function(){
              var selectedCountry = $(".country option:selected").val();
              
              $.ajax({
                    type: "POST",
                    url: country_url,
                    data: { "country_id" : selectedCountry },
                    dataType: "json",
                    
                    success: function(data) {
                          //debugger;
                          if (!(data)){   
                              alert('empty data/ error');
                          }else{
                              html=data;
                          } 
                         
                          $("#state").html(html);
                    }

              });
       });

       $('.coupon_check').on('click',function(){
              var total = $(this).data('total');
              var code = $("#coupon").val();
              
              $.ajax({
                      url: coupon_url,
                      async: false,
                      type: "POST",
                      data: {"total":total,
                             "code":code,},
                      dataType: "json",

                      success: function(data){
                          //console.log(data);
                          if (!(data)){   
                              alert('Not a valid Code');
                              $("#coupon").val("");
                          
                          }else{
                              html=data;
                              $("#total_cal").html(html);
                              $("#coupon").attr("disabled","true");
                              $("#change_link").show();
                              $("#coupon_hid").val(code);

                          }
                        
                       }
               })
         });  

        $('#change_code').on('click',function(){
            var code = $("#coupon").val();
            var total = $(this).data('total');
            var grtotal = $(this).data('grtotal');
            //alert(total);

               $.ajax({
                      url: changecoupon_url,
                      async: false,
                      type: "POST",
                      data: {"code":code,},
                      
                      success: function(data){
                          console.log(data);
                          if (!(data)){   
                              alert('empty data/ error');
                          
                          }else{
                                $("#coupon").val("");
                                $("#coupon").removeAttr("disabled");
                                $("#total").text("$"+total);
                                $("#discount").text("0.00%");
                                $("#discount_amt").text("$0.00");
                                $("#gr_total").text("$"+grtotal);
                          }
                      }
                })

          }); 

}); 
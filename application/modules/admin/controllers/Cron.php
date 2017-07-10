<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Category controller contain category related functions
 * @package    CI
 * @subpackage Controller
 * @author  Antony
 */


class Cron extends Admin_Controller{

    function __construct(){
        // Call the Model constructor
        parent::__construct();
        $this->load->model('admin/cron_model');
        $this->load->model('site/email_model');

        }
    

    /*
     * function name :index
     * To email every day
     *
     * @author	Antony
     * @access	public
     * @param :
     * @return : none
     */

     public function index(){
        $d=strtotime("-1 days");
        $yesterday_date=date("Y-m-d ", $d);
        $data=$this->cron_model->get_order_ondate($yesterday_date);

        $table_head="";
        $table_body="";
        $table_end="";
        $table_file.= '<head>'. 
                      '<link href="'. base_url().'public/assets/css/bootstrap.min.css" rel="stylesheet">'.
                      '<link href="'.base_url().'public/assets/css/responsive.css" rel="stylesheet">'.
                      '</head>';
        $table_head.='<div class="container">'.
                  '<table class="table table-condensed">'.
                  '<thead>'.
                     '<tr class="cart_menu">'.
                     '<td class="image">OrderID</td>'.
                     '<td class="description">Name</td>'.
                     '<td class="price">Email</td>'.
                     '<td class="quantity">Grand Total</td>'.
                     '<td class="total">Order Status</td>'.
                     '</tr>'.
                  '</thead>'.
                  '<tbody>';
        
        $cnt=0;
        foreach($data as $items){
          $order_id_display=order_id_display($data[$cnt]->id);
          $order_status=is_status($data[$cnt]->order_status);
          $table_body.= 
                 '<tr>'.
                    '<td class="cart_product">'.
                    '<p>'. $order_id_display .'</p>'.
                    '</td>'.
                    '<td class="cart_description">'.
                    '<h4>'. $items->firstname .' '. $items->lastname .'</h4>'.
                    '</td>'.
                    '<td class="cart_price">'.
                    '<p>$'. $items->email .'</p>'.
                    '</td>'.
                    '<td class="cart_quantity">'.
                    '<p>'. $items->grand_total .'</p>'.
                    '</td>'.
                    '<td class="cart_total">'.
                    '<p class="cart_total_price" >'. $order_status .'</p>'.
                    '</td>'.
                 '</tr>';
                
         $cnt=$cnt+1;
        }
        $table_end.='</tbody>'.
                   '</table>'.
                   '</div>';
        $data1=array($table_file,$yesterday_date,$table_head,$table_body,$table_end);
        $arr1=array('{tfile}','{date}','{thead}','{tbody}','{tend}');

        $admin_login=$this->email_model->template('daily_order_detail');
        $subject=$admin_login->subject;
        $content=$admin_login->content;
        $var_content=str_replace($arr1,$data1,$content);
       
   // show($var_content);
         $order_email=array(
             'email'=>ADMIN,
             'subject'=>$subject,
             'content'=>$var_content,
              );
         
         $this->email_model->email($order_email);
     }
 
   public function wishlist_email(){
       $start_date = date("Y-m-d"); 
       $d=strtotime("-7 days");
       $end_date=date("Y-m-d ", $d);
       $data=$this->cron_model->get_wishlist($start_date,$end_date);
       // show($data);
       
        $table_body="";

        $table_file.= '<head>'. 
                      '<link href="'. base_url().'public/assets/css/bootstrap.min.css" rel="stylesheet">'.
                      '<link href="'.base_url().'public/assets/css/responsive.css" rel="stylesheet">'.
                      '</head>';
        
         $table_head.='<div class="container">'.
                  '<table class="table table-condensed">'.
                  '<thead>'.
                     '<tr class="cart_menu">'.
                     '<td class="image">Name</td>'.
                     '<td class="description">Email</td>'.
                     '<td class="price">Product Name</td>'.
                     '<td class="quantity">Price</td>'.
                     '</tr>'.
                  '</thead>'.
                  '<tbody>';
      
        foreach($data as $items){
          $table_body.= 
                 '<tr>'.
                    '<td >'.
                    '<h4>'. $items->firstname .' '. $items->lastname .'</h4>'.
                    '</td>'.
                    '<td>'.
                    '<p>$'. $items->email .'</p>'.
                    '</td>'.
                    '<td>'.
                    '<p>'. $items->name .'</p>'.
                    '</td>'.
                    '<td>'.
                    '<p>'. $items->price .'</p>'.
                    '</td>'.
                 '</tr>';
                
        
        }

         $table_end.='</tbody>'.
                   '</table>'.
                   '<div>';
        
        $data1=array($table_file,$end_date,$start_date,$table_head,$table_body,$table_end);
        $arr1=array('{tfile}','{startdate}','{enddate}','{thead}','{tbody}','{tend}');

        $admin_login=$this->email_model->template('wishlist_details');
        $subject=$admin_login->subject;
        $content=$admin_login->content;
        $var_content=str_replace($arr1,$data1,$content);
       

         $order_email=array(
             'email'=>ADMIN,
             'subject'=>$subject,
             'content'=>$var_content,
              );
         
         $this->email_model->email($order_email);
   }

 }


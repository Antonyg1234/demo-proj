<?php
/**
 * Cms model contain cms related functions
 * @package    CI
 * @subpackage Model
 * @author  Antony
 */ 


class Cms_model extends CI_Model{


	     /*
	     * function name :get_cms
	     * To get staic page content to display
	     *
	     * @author	Antony
	     * @access	public
	     * @param : number
	     * @return : array
	     */

	    public function get_cms($title){
	    	$this->db->select('meta_title,content');
	    	$this->db->where('title',$title);
	    	$result=$this->db->get('cms')->row();
	    	return $result;
	    }
}
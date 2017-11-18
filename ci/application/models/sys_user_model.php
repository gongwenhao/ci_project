<?php
class Sys_user_model extends CI_Model {

    private $table_name = "sys_user";
    
    function __construct(){
        parent::__construct();
        $this->system_db_obj = $this->load->database('default', TRUE);
    }
    /**
     * 统计复合条件的数据条数
     */
    function return_query_num( $where ){
        $query_obj = $this->_get_query_obj( $where );
        $result = $query_obj->num_rows();
        return $result;
    }

    function return_query_table( $where, $limit='', $offset='', $distinct=''){
        $query_obj = $this->_get_query_obj( $where, $limit, $offset, $distinct);
        $result = $query_obj->result_array();
        // echo $this->system_db_obj->last_query();
        return $result;
    }
    /**
     * 添加数据
     */
    function create( $data ){
        $result = $this->system_db_obj->insert( $this->table_name, $data ); 

        $result = $this->get_one( $where );
        return $result;
    }
    /**
     * 批量添加数据
     */
    function creates( $data ){
        $result = $this->system_db_obj->insert_batch( $this->table_name, $data );
        return $result;
    }

    function get_one( $where ){
        $query_obj = $this->_get_query_obj( $where );
        $query_one = $query_obj->row_array();
        // echo $this->system_db_obj->last_query();
        return $query_one;
    }
    function get_one_user( $where ){
        $this->system_db_obj->where( $where );
        $result = $this->system_db_obj->get( $this->table_name )->result_array();
        return $result;
    }
    /**
     * 删除数据
     */
    function delete($where){
        return $this->system_db_obj->delete( $this->table_name, $where );
    }
    /**
     * 修改数据
     */
    function updata($record, $where){
        $status = $this->system_db_obj->update($this->table_name,$record,$where); 
        return $status;
    }
    // 修改数据like
    function update_data( $datas, $where ){
        $this->system_db_obj->where( $where );
        $status = $this->system_db_obj->update( $this->table_name, $datas );
        return $status;
    }
    // 批量修改数据
    function updata_batch( $data, $where, $like ){
        $this->system_db_obj->like( $like );
        $status = $this->system_db_obj->update_batch( $this->table_name, $data, $where );
        // echo $this->system_db_obj->last_query();die;
        return $status;
    }

    function check_result( $result ){ 
        if( !$result ){
            return $result;
        }
        $CI =& get_instance();
        $CI->load->model("table/sys_bank_table_model");
        for( $i=0; $i<count($result); $i++ ){
            $sys_bank_disable_arr = get_my_config( 'sys_bank_disable_arr' );
            $result[$i]['dis_disable'] = $sys_bank_disable_arr[$result[$i]['disable']];
            $result[$i]['parent_name'] = $CI->sys_bank_table_model->select_row_bank_parent_name($result[$i]['parent_id']); 
        }
        return $result;
    }


    private function _get_query_obj( $where, $limit, $offset){

        $this->system_db_obj->select('*');

        $this->system_db_obj->from($this->table_name);
        // $this->system_db_obj->join('sys_bank', 'sys_bank.bank_id = annual_report_content.bank_id','left');
        // $this->system_db_obj->join('sys_department', 'sys_department.department_id = annual_report_content.department_id','left');
        

        $this->system_db_obj->where($where);
        if(!empty($limit)){
            $this->system_db_obj->limit($limit,$offset);
        }
        $this->system_db_obj->order_by('user_id', 'DESC');
        $query = $this->system_db_obj->get();
        // echo $this->system_db_obj->last_query();exit;
        return $query;
    }
    
}
?>

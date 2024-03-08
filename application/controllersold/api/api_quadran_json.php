<?php
require APPPATH . '/libraries/REST_Controller.php';
include_once("functions/string.func.php");
include_once("functions/date.func.php");
 
class api_quadran_json extends REST_Controller {
 
    function __construct() {
        parent::__construct();

        // $this->db->query("alter session set nls_date_format='DD-MM-YYYY'"); 
        
    }
 
    // show data entitas
    function index_get() {
        $this->load->model('base/Api');
        $nip = $this->input->get("nip");


        $set = new Api;
        // $sOrder = " ORDER BY COALESCE(X.NILAI_POTENSI,0) DESC, COALESCE(Y.NILAI_KOMPETENSI,0) DESC ";
        $aColumns = array("pegawai_id","nama","nip_baru","KODE_KUADRAN","NAMA_KUADRAN");
        if($nip==''){
            $this->response(array('status' => 'failed', 'message' => 'failed', 'code' => 0, 'count' => $total ,'result' => 'Isikan NIP Pegawai'));
        }
        $statement="and nip_baru='".$nip."'";
        // $statement.= " AND A.nip_baru = '".$nip."'";
        $set->selectByParamsApi(array(), -1, -1, $statement, $sOrder, $reqTahun);

        // echo $set->query; exit;
        $total = 0;
        $set->firstRow();
        $result[$total]['nama'] = $set->getField('nama');
        $result[$total]['nip'] = $set->getField('nip_baru');
        $result[$total]['pangkat'] = $set->getField('pangkat_kode');
        $result[$total]['jabatan'] = $set->getField('LAST_JABATAN');
        $result[$total]['eselon'] = $set->getField('eselon_nama');
        $result[$total]['kuadran'] = $set->getField('KODE_KUADRAN');
        $result[$total]['ket_kuadran'] = $set->getField('NAMA_KUADRAN');
        $result[$total]['potensi'] = $set->getField('NILAI_X');
        $result[$total]['kinerja'] = $set->getField('NILAI_Y');
        
        $this->response(array('status' => 'success', 'message' => 'success', 'code' => 200, 'count' => $total ,'result' => $result));


    }

    
    // insert new data to entitas
    function index_post() {
    }
 
    // update data entitas
    function index_put() {
    }
 
    // delete entitas
    function index_delete() {
    }
 
}
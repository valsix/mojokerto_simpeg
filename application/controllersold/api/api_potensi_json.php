<?php
require APPPATH . '/libraries/REST_Controller.php';
include_once("functions/string.func.php");
include_once("functions/date.func.php");
 
class api_potensi_json extends REST_Controller {
 
    function __construct() {
        parent::__construct();

        // $this->db->query("alter session set nls_date_format='DD-MM-YYYY'"); 
        
    }
 
    // show data entitas
    function index_get() {
        $this->load->model('base/Api');
        $nip = $this->input->get("nip");

        if($reqToken == '')
        {

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
            while($set->nextRow())
            {
                $result[$total]['nama'] = $set->getField('nama');
                $result[$total]['nip'] = $set->getField('nip_baru');
                $result[$total]['pangkat'] = $set->getField('pangkat_kode');
                $result[$total]['jabatan'] = $set->getField('LAST_JABATAN');
                $result[$total]['eselon'] = $set->getField('eselon_nama');
                $setPenilaian = new Api;
                $setPenilaian->selectspiderpotensikompetensi(array(), -1, -1, "and b.pegawai_id =".$set->getField('pegawai_id'));
                $totalPenilaian = 0;
                while($setPenilaian->nextRow())
                {  
                    if($setPenilaian->getField('aspek_id')=='1'){
                        $result[$total]['potensi'][$totalPenilaian]['categori'] = $setPenilaian->getField('nama');
                        $result[$total]['potensi'][$totalPenilaian]['nilai'] = $setPenilaian->getField('nilai');
                        $result[$total]['potensi'][$totalPenilaian]['nilai_standart'] = $setPenilaian->getField('nilai_standar');
                    }
                    $totalPenilaian++;
                }

                $total++;
            }
            
            if($total == 0)
            {
                for ( $i=0 ; $i<count($aColumns) ; $i++ )
                {
                    $row[trim($aColumns[$i])] = "";
                }
                $result[] = $row;
            }
            
            $this->response(array('status' => 'success', 'message' => 'success', 'code' => 200, 'count' => $total ,'result' => $result));
        }
        else
        {
            $this->response(array('status' => 'fail', 'message' => 'Sesi anda telah berakhir', 'code' => 502));
        }

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
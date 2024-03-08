<?php
require APPPATH . '/libraries/REST_Controller.php';
include_once("functions/string.func.php");
include_once("functions/date.func.php");
 
class api_pegawai_data_json extends REST_Controller {
 
    function __construct() {
        parent::__construct();
    
    }
 
    // show data entitas
    function index_get() {

        $this->load->model('base/Api');
        $this->load->model("base-data/FormulaPenilaian");
        $this->load->library('globalmenu');
        $nip = $this->input->get("nip");

        if($reqToken == '')
        {

            $set = new Api;
            // $sOrder = " ORDER BY COALESCE(X.NILAI_POTENSI,0) DESC, COALESCE(Y.NILAI_KOMPETENSI,0) DESC ";
            if($nip==''){
                $this->response(array('status' => 'failed', 'message' => 'failed', 'code' => 0, 'count' => $total ,'result' => 'Isikan NIP Pegawai'));
            }
            $statement="and nip_baru='".$nip."'";
            // $statement.= " AND A.nip_baru = '".$nip."'";
            $set->selectByParamsApi(array(), -1, -1, $statement, $sOrder, $reqTahun);
            $set->firstRow();
            $result[$total]['nama'] = $set->getField('nama');
            $result[$total]['nip'] = $set->getField('nip_baru');
            $result[$total]['pangkat'] = $set->getField('pangkat_kode');
            $result[$total]['jabatan'] = $set->getField('LAST_JABATAN');
            $result[$total]['eselon'] = $set->getField('eselon_nama');

            $statement= " and a.pegawai_id = ".$set->getField('pegawai_id')." and a.formula_penilaian_id = 1";
            $setRangkuman= new FormulaPenilaian();
            $setRangkuman->selectnilairangkuman(array(), -1,-1, $statement);
            $setRangkuman->firstRow();
            // echo $set->query;exit;
            $VPOTENSI= $setRangkuman->getField("VPOTENSI");
            $VKOMPETENSI= $setRangkuman->getField("VKOMPETENSI");
            $VPENDIDIKAN_FORMAL= $setRangkuman->getField("VPENDIDIKAN_FORMAL");
            $VPELATIHAN= $setRangkuman->getField("VPELATIHAN");
            $VJABATAN= $setRangkuman->getField("VJABATAN");
            $VKOMITMENORGANISASI= $setRangkuman->getField("VKOMITMENORGANISASI");
            $VPANGKAT= $setRangkuman->getField("VPANGKAT");
            $VSKP= $setRangkuman->getField("VSKP");

            $setIndikator= new FormulaPenilaian();
            $arrindikatorpenilaian= [];
            $setIndikator->selectbyindikatorpenilaian();
            // echo $set->query;exit;
            while($setIndikator->nextRow())
            {
                $vjenis= $setIndikator->getField("JENIS_SUBINDIKATOR");

                $vjenisnilai= 0;
                if($vjenis == "potensi")
                    $vjenisnilai= $VPOTENSI;
                else if($vjenis == "kompetensi")
                    $vjenisnilai= $VKOMPETENSI;
                else if($vjenis == "pendidikan_formal")
                    $vjenisnilai= $VPENDIDIKAN_FORMAL;
                else if($vjenis == "pelatihan")
                    $vjenisnilai= $VPELATIHAN;
                else if($vjenis == "jabatan")
                    $vjenisnilai= $VJABATAN;
                else if($vjenis == "komitmenorganisasi")
                    $vjenisnilai= $VKOMITMENORGANISASI;
                else if($vjenis == "pangkat")
                    $vjenisnilai= $VPANGKAT;
                else if($vjenis == "skp")
                    $vjenisnilai= $VSKP;

                $arrdata= [];
                $arrdata["id"]= $setIndikator->getField("INDIKATOR_PENILAIAN_ID");
                $arrdata["nama"]= $setIndikator->getField("NAMA");
                $arrdata["jenis"]= $vjenis;
                $arrdata["jenisnilai"]= $vjenisnilai;
                array_push($arrindikatorpenilaian, $arrdata);
            }


            $vfpeg= new globalmenu();
            $arrparam= [];
            $indikatorpenilaiansub= $vfpeg->indikatorpenilaiansub($arrparam);
            // print_r($indikatorpenilaiansub);exit;
    
            $setNilai= new FormulaPenilaian();
            $getformulapenilaianpendidikan= $setNilai->getformulapenilaianpendidikan(1,$set->getField('pegawai_id'));
            // echo $getformulapenilaianpendidikan; exit;
            $arrpendidikannilai= [];
            $setNilai= new FormulaPenilaian();
            $setNilai->selectstr($getformulapenilaianpendidikan);
            while($setNilai->nextRow())
            {
                $vindikatorpenilaianid= $setNilai->getField("INDIKATOR_PENILAIAN_ID");
                $vsubindikatorid= $setNilai->getField("PENDIDIKAN_ID");

                $arrdata= [];
                $arrdata["key"]= $vindikatorpenilaianid."-".$vsubindikatorid;
                $arrdata["id"]= $vindikatorpenilaianid;
                $arrdata["subindikatorid"]= $vsubindikatorid;
                $arrdata["nilai"]= $setNilai->getField("NILAI");
                array_push($arrpendidikannilai, $arrdata);
            }
            // print_r($arrpendidikannilai);exit;

            $setNilai= new FormulaPenilaian();
            $getformulapenilaianjabatan= $setNilai->getformulapenilaianjabatan(1,$set->getField('pegawai_id'));

            $arrjabatanilai= [];
            $setNilai= new FormulaPenilaian();
            $setNilai->selectstr($getformulapenilaianjabatan);
            while($setNilai->nextRow())
            {
                $vindikatorpenilaianid= $setNilai->getField("INDIKATOR_PENILAIAN_ID");
                $vsubindikatorid= $setNilai->getField("SUB_INDIKATOR_ID");

                $arrdata= [];
                $arrdata["key"]= $vindikatorpenilaianid."-".$vsubindikatorid;
                $arrdata["id"]= $vindikatorpenilaianid;
                $arrdata["subindikatorid"]= $vsubindikatorid;
                $arrdata["nilai"]= $setNilai->getField("NILAI");
                array_push($arrjabatanilai, $arrdata);
            }
            // print_r($arrjabatanilai);exit;

            $setNilai= new FormulaPenilaian();
            $getformulapendidikanpelatihan= $setNilai->getformulapendidikanpelatihan(1,$set->getField('pegawai_id'));

            $arrpendidikanpelatihan= [];
            $setNilai= new FormulaPenilaian();
            $setNilai->selectstr($getformulapendidikanpelatihan);
            while($setNilai->nextRow())
            {
                $vindikatorpenilaianid= $setNilai->getField("INDIKATOR_PENILAIAN_ID");
                $vsubindikatorid= $setNilai->getField("SUB_INDIKATOR_ID");

                $arrdata= [];
                $arrdata["key"]= $vindikatorpenilaianid."-".$vsubindikatorid;
                $arrdata["id"]= $vindikatorpenilaianid;
                $arrdata["subindikatorid"]= $vsubindikatorid;
                $arrdata["nilai"]= $setNilai->getField("NILAI");
                array_push($arrpendidikanpelatihan, $arrdata);
            }
            // print_r($arrpendidikanpelatihan);exit;

            $setNilai= new FormulaPenilaian();
            $getformulaketerlibatantim= $setNilai->getformulaketerlibatantim(1,$set->getField('pegawai_id'));

            $arrdalamtim= [];
            $setNilai= new FormulaPenilaian();
            $setNilai->selectstr($getformulaketerlibatantim);
            while($setNilai->nextRow())
            {
                $vindikatorpenilaianid= $setNilai->getField("INDIKATOR_PENILAIAN_ID");
                $vsubindikatorid= $setNilai->getField("SUB_INDIKATOR_ID");

                $arrdata= [];
                $arrdata["key"]= $vindikatorpenilaianid."-".$vsubindikatorid;
                $arrdata["id"]= $vindikatorpenilaianid;
                $arrdata["subindikatorid"]= $vsubindikatorid;
                $arrdata["nilai"]= $setNilai->getField("NILAI");
                array_push($arrdalamtim, $arrdata);
            }


            $statementNilai= " and a.pegawai_id = ".$set->getField('pegawai_id')." and a.formula_penilaian_id = 1";
            $setNilai= new FormulaPenilaian();
            $setNilai->selectnilairangkuman(array(), -1,-1, $statementNilai);
            $setNilai->firstRow();
            foreach($arrindikatorpenilaian as $key => $item)
            {
                $infodetilid= $item["id"];
                $infodetilnama= $item["nama"];
                $vjenis= $item["jenis"];
                $jenisnilai= $item["jenisnilai"];   
                $infocarikey= $infodetilid;
                $arrcheck= in_array_column($infocarikey, "INDIKATOR_PENILAIAN_ID", $indikatorpenilaiansub);
                $infosubindikatorid= $indikatorpenilaiansub[$arrcheck[0]]["SUB_INDIKATOR_ID"];
                if(!empty($arrkeynilai))
                {
                    // print_r($arrkeynilai);exit;
                    $reqNilai= $arrnilai[$arrkeynilai[0]]["nilai"];
                    $result[$total][$infodetilnama]= $reqNilai;
                
                }
                $i=0;
                foreach ($arrcheck as $keyindex => $vindex){
                    $infosubindikatornama= $indikatorpenilaiansub[$vindex]["NAMA"];
                    $infosubindikatorid= $indikatorpenilaiansub[$vindex]["SUB_INDIKATOR_ID"];
                                                
                    if($vjenis == "pendidikan_formal" || $vjenis == "jabatan" || $vjenis == "pelatihan" || $vjenis == "dalamtim")
                    {
                        $infocarikey= $infodetilid."-".$infosubindikatorid;
                        $arrcheckdetil= [];
                        if($vjenis == "pendidikan_formal")
                            $arrcheckdetil= in_array_column($infocarikey, "key", $arrpendidikannilai);
                        else if($vjenis == "jabatan")
                            $arrcheckdetil= in_array_column($infocarikey, "key", $arrjabatanilai);
                        else if($vjenis == "pelatihan")
                            $arrcheckdetil= in_array_column($infocarikey, "key", $arrpendidikanpelatihan);
                        else if($vjenis == "dalamtim")
                            $arrcheckdetil= in_array_column($infocarikey, "key", $arrdalamtim);

                        $jenisnilai= "-";
                        if(!empty($arrcheckdetil))
                        {
                            if($vjenis == "pendidikan_formal")
                                $jenisnilai= $arrpendidikannilai[$arrcheckdetil[0]]["nilai"];
                            else if($vjenis == "jabatan")
                                $jenisnilai= $arrjabatanilai[$arrcheckdetil[0]]["nilai"];
                            else if($vjenis == "pelatihan")
                                $jenisnilai= $arrpendidikanpelatihan[$arrcheckdetil[0]]["nilai"];
                            else if($vjenis == "dalamtim")
                                $jenisnilai= $arrdalamtim[$arrcheckdetil[0]]["nilai"];
                        }
                        $result[$total][$infodetilnama][$i]['categori']= $infosubindikatornama;
                        $result[$total][$infodetilnama][$i]['nilai']= $jenisnilai;
                    }
                    else if($vjenis == "pangkat")
                    {
                    }
                    else{
                        $result[$total][$infodetilnama]= $jenisnilai;
                    }
                    $i++;
                }
            
            }
            // $result[$total]['komitmen_organisasi']= $setNilai->getField("VKOMITMENORGANISASI");
            // $result[$total]['skp']= $setNilai->getField("VSKP");

            // $setPendidikan= new FormulaPenilaian();
            // $getformulapenilaianpendidikan= $setPendidikan->getformulapenilaianpendidikan(1, $set->getField('pegawai_id'));

            // $setPendidikan= new FormulaPenilaian();
            // $setPendidikan->selectstr($getformulapenilaianpendidikan);
            // $totalPendidikan=0;
            // while($setPendidikan->nextRow())
            // {
            //     $result[$total]['pendidikan_formal'][$totalPendidikan]= $setPendidikan->getField("NILAI");
            //     $totalPendidikan++;
            // }

            // $setPendidikan= new FormulaPenilaian();
            // $getformulapendidikanpelatihan= $setPendidikan->getformulapendidikanpelatihan(1, $set->getField('pegawai_id'));

            // $setPendidikan= new FormulaPenilaian();
            // $setPendidikan->selectstr($getformulapendidikanpelatihan);
            // $totalPendidikan=0;
            // while($setPendidikan->nextRow())
            // {
            //     $vindikatorpenilaianid= $setPendidikan->getField("INDIKATOR_PENILAIAN_ID");
            //     $vsubindikatorid= $setPendidikan->getField("SUB_INDIKATOR_ID");
            //     $arrdata["key"]= $vindikatorpenilaianid."-".$vsubindikatorid;
            //     $result[$total]['pendidikan_dan_pelatihan'][$totalPendidikan]= $setPendidikan->getField("NILAI");
            //     $totalPendidikan++;
            // }

            // $setPendidikan= new FormulaPenilaian();
            // $getformulapenilaianjabatan= $setPendidikan->getformulapenilaianjabatan(1, $set->getField('pegawai_id'));

            // $setPendidikan= new FormulaPenilaian();
            // $setPendidikan->selectstr($getformulapenilaianjabatan);
            // $totalPendidikan=0;
            // while($setPendidikan->nextRow())
            // {
            //     $result[$total]['pengalaman_dalam_jabatan'][$totalPendidikan]= $setPendidikan->getField("NILAI");
            //     $totalPendidikan++;
            // }

            // $setPendidikan= new FormulaPenilaian();
            // $getformulaketerlibatantim= $setPendidikan->getformulaketerlibatantim(1, $set->getField('pegawai_id'));

            // $setPendidikan= new FormulaPenilaian();
            // $setPendidikan->selectstr($getformulaketerlibatantim);
            // $totalPendidikan=0;
            // while($setPendidikan->nextRow())
            // {
            //     $result[$total]['keterlibatan_dalam_tim'][$totalPendidikan]= $setPendidikan->getField("NILAI");
            //     $totalPendidikan++;
            // }

            
            $this->response(array('status' => 'success', 'message' => 'success', 'code' => 200, 'count' => 1 ,'result' => $result));
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
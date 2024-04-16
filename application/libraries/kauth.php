<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once 'kloader.php';
include_once("libraries/nusoap-0.9.5/lib/nusoap.php");
include_once("functions/date.func.php");

class kauth {
    
    function __construct() {
        $CI =& get_instance();
        $CI->load->driver('session');
    }

    public function cekuserloginpersonal($username,$credential) {

        if(preg_match('/[\'^£$%&*()}{@#~?><>,|=+¬-]/', $username))
        {
            return "Username dan password salah.";
        }

        $CI =& get_instance();
        $configdata= $CI->config;
        $configvlxsessfolder= $configdata->config["vlxsessfolder"];

        $CI->load->model("base/Users");
        $users = new Users();
        $users->selectbyloginadmin($username, md5($credential));
        // echo $users->query;exit;
        // echo $users->query; exit;
        
        if($users->firstRow())
        {
            $CI->session->set_userdata("adminuserloginnama".$configvlxsessfolder, $users->getField("USER_LOGIN"));
            $CI->session->set_userdata("adminusernama".$configvlxsessfolder, $users->getField("NAMA"));
            $CI->session->set_userdata("adminusergroupid".$configvlxsessfolder, $users->getField("USER_GROUP_ID"));
            $CI->session->set_userdata("adminuserpegawaiid".$configvlxsessfolder, $users->getField("PEGAWAI_ID"));
            $vsatkerid= $users->getField("SATKER_ID");
            $CI->session->set_userdata("adminsatkerid".$configvlxsessfolder, $vsatkerid);

            $arrparam= ["satkerid"=>$vsatkerid];
            $CI->load->library('globalsatuankerja');
            $vgl= new globalsatuankerja();
            $arrtreesatuankerja= $vgl->getsatuankerjatree($arrparam);
            $arrdatasatuankerja= $vgl->getsatuankerjadata($arrparam);

            $CI->session->set_userdata('sesstree'.$configvlxsessfolder, $arrtreesatuankerja);
            $CI->session->set_userdata('sessdatatree'.$configvlxsessfolder, $arrdatasatuankerja);

            $CI->session->set_userdata("adminuserid".$configvlxsessfolder, $users->getField("USER_APP_ID"));
            $CI->session->set_userdata("adminuserPegawaiProses".$configvlxsessfolder, $users->getField("PEGAWAI_PROSES"));
            $CI->session->set_userdata("adminuserDUKProses".$configvlxsessfolder, $users->getField("DUK_PROSES"));
            $CI->session->set_userdata("adminuserKGBProses".$configvlxsessfolder, $users->getField("KGB_PROSES"));
            $CI->session->set_userdata("adminuserKPProses".$configvlxsessfolder, $users->getField("KP_PROSES"));
            $CI->session->set_userdata("adminuserPensiunProses".$configvlxsessfolder, $users->getField("PENSIUN_PROSES"));
            $CI->session->set_userdata("adminuserAnjabProses".$configvlxsessfolder, $users->getField("ANJAB_PROSES"));
            $CI->session->set_userdata("adminuserMutasiProses".$configvlxsessfolder, $users->getField("MUTASI_PROSES"));
            $CI->session->set_userdata("adminuserHukumanProses".$configvlxsessfolder, $users->getField("HUKUMAN_PROSES"));
            $CI->session->set_userdata("adminuserMasterProses".$configvlxsessfolder, $users->getField("MASTER_PROSES"));
            $CI->session->set_userdata("adminuserLihatProses".$configvlxsessfolder, $users->getField("LIHAT_PROSES"));
            $CI->session->set_userdata("adminuserBidangPembinaan".$configvlxsessfolder, $users->getField("BIDANG_PEMBINAAN"));
            $CI->session->set_userdata("adminuserBidangDokumentasi".$configvlxsessfolder, $users->getField("BIDANG_DOKUMENTASI"));
            $CI->session->set_userdata("adminuserBidangPendidikan".$configvlxsessfolder, $users->getField("BIDANG_PENDIDIKAN"));
            $CI->session->set_userdata("adminuserBidangMutasi".$configvlxsessfolder, $users->getField("BIDANG_MUTASI"));

            return "1";  
        }
        else
            return "Username atau password salah.";
    }

    public function unsetcekuserloginpersonal() {
        $CI =& get_instance();
        $configdata= $CI->config;
        $configvlxsessfolder= $configdata->config["vlxsessfolder"];
        
        $CI->session->unset_userdata("adminuserid".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserloginnama".$configvlxsessfolder);
        $CI->session->unset_userdata("adminusernama".$configvlxsessfolder);
        $CI->session->unset_userdata("adminusergroupid".$configvlxsessfolder);
        $CI->session->unset_userdata("adminsatkerid".$configvlxsessfolder);
        $CI->session->unset_userdata("sesstree".$configvlxsessfolder);
        $CI->session->unset_userdata("sessdatatree".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserPegawaiProses".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserDUKProses".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserKGBProses".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserKPProses".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserPensiunProses".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserAnjabProses".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserMutasiProses".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserHukumanProses".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserMasterProses".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserLihatProses".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserBidangPembinaan".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserBidangDokumentasi".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserBidangPendidikan".$configvlxsessfolder);
        $CI->session->unset_userdata("adminuserBidangMutasi".$configvlxsessfolder);
    }

}
?>
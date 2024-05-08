<? 
/* *******************************************************************************************************
MODUL NAME      : E LEARNING
FILE NAME       : 
AUTHOR        : 
VERSION       : 1.0
MODIFICATION DOC  :
DESCRIPTION     : 
***************************************************************************************************** */

  /***
  * Entity-base class untuk mengimplementasikan tabel KontakPegawai.
  * 
  ***/
  include_once(APPPATH.'/models/Entity.php');

  class Users extends Entity{ 

    var $query;
    function Users()
    {
      $this->Entity(); 
    }

    function insert(){
   
      /*Auto-generate primary key(s) by next max value (integer) */
      $this->setField("USER_APP_ID", $this->getNextId("USER_APP_ID","USER_APP"));
      $this->setField("USER_PASS", md5($this->getField("USER_PASS")));
      $str = "
      INSERT INTO USER_APP (
      USER_APP_ID, USER_GROUP_ID, USER_LOGIN, 
      USER_PASS, NAMA, ALAMAT, 
      EMAIL, TELEPON, PEGAWAI_ID, SATKER_ID, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER) 
      VALUES (
      '".$this->getField("USER_APP_ID")."',
      '".$this->getField("USER_GROUP_ID")."',
      '".$this->getField("USER_LOGIN")."',
      '".$this->getField("USER_PASS")."',
      '".$this->getField("NAMA")."',
      '".$this->getField("ALAMAT")."',
      '".$this->getField("EMAIL")."',
      '".$this->getField("TELEPON")."',
      ".$this->getField("PEGAWAI_ID").", 
      '".$this->getField("SATKER_ID")."',        
      '".$this->getField("LAST_CREATE_USER")."',
      ".$this->getField("LAST_CREATE_DATE").",
      '".$this->getField("LAST_CREATE_SATKER")."' 
    )"; 
    $this->query = $str;
    // echo $str;exit;
    return $this->execQuery($str);
      
    }

    function update_user(){

      $str = "
      UPDATE USER_APP
      SET    USER_GROUP_ID = '".$this->getField("USER_GROUP_ID")."',
      USER_LOGIN    = '".$this->getField("USER_LOGIN")."',
      NAMA          = '".$this->getField("NAMA")."',
      SATKER_ID   = '".$this->getField("SATKER_ID")."',
      LAST_UPDATE_USER  = '".$this->getField("LAST_UPDATE_USER")."',
      LAST_UPDATE_DATE  = ".$this->getField("LAST_UPDATE_DATE").",
      LAST_UPDATE_SATKER  = '".$this->getField("LAST_UPDATE_SATKER")."'            
      WHERE  USER_APP_ID   = '".$this->getField("USER_APP_ID")."'
      "; 
      $this->query = $str;
      //echo $str;
        return $this->execQuery($str);
      
    }


    function updatePassword()
    {
      $this->setField("USER_PASS", md5($this->getField("USER_PASS")));
      $str = "UPDATE USER_APP SET
      USER_PASS = '".$this->getField("USER_PASS")."',
      LAST_UPDATE_USER  = '".$this->getField("LAST_UPDATE_USER")."',
      LAST_UPDATE_DATE  = ".$this->getField("LAST_UPDATE_DATE").",
      LAST_UPDATE_SATKER  = '".$this->getField("LAST_UPDATE_SATKER")."'
      WHERE USER_APP_ID = '".$this->getField("USER_APP_ID")."'
      "; 
      $this->query = $str;
      return $this->execQuery($str);
    }

    function delete(){
      $str = "DELETE FROM USER_APP 
      WHERE 
      USER_APP_ID = '".$this->getField("USER_APP_ID")."'"; 
      return $this->execQuery($str);
      
    }

    function selectbyloginadmin($username,$passwd)
    {
      $statement= " AND A.USER_LOGIN = ".$this->db->escape($username)." AND A.USER_PASS = ".$this->db->escape($passwd);

      $str = "
      SELECT
      USER_APP_ID, A.USER_GROUP_ID, USER_LOGIN, USER_PASS, A.NAMA, ALAMAT, EMAIL, TELEPON, PEGAWAI_ID
      , SATKER_ID, PEGAWAI_PROSES, DUK_PROSES, KGB_PROSES, KP_PROSES
      , PENSIUN_PROSES, ANJAB_PROSES, MUTASI_PROSES, HUKUMAN_PROSES, MASTER_PROSES, LIHAT_PROSES
      , BIDANG_PEMBINAAN, BIDANG_DOKUMENTASI, BIDANG_PENDIDIKAN, BIDANG_MUTASI
      FROM USER_APP A, USER_GROUP B
      WHERE A.USER_GROUP_ID = B.USER_GROUP_ID
      ".$statement;

      $this->query = $str;
      // echo $str;exit;
      return $this->select($str);
    }

    function selectByParamsMonitor($paramsArray=array(),$limit=-1,$from=-1, $statement="", $sOrder="ORDER BY A.USER_LOGIN"){
     $str = "SELECT USER_APP_ID, NAMA, PEGAWAI_ID,USER_LOGIN,
                  (SELECT B.NAMA FROM SATKER B WHERE B.SATKER_ID = A.SATKER_ID) SATKER,
                (SELECT C.NAMA FROM USER_GROUP C WHERE C.USER_GROUP_ID = A.USER_GROUP_ID) USER_GROUP
                  FROM USER_APP A
                WHERE USER_LOGIN IS NOT NULL "; 
      while(list($key,$val)=each($paramsArray)){
        $str .= " AND $key = '$val' ";
      }
      $str .= " ".$sOrder;
      $this->query = $str;
      return $this->selectLimit($str,$limit,$from); 
    }

    function selectbyloginpegawai($username,$passwd)
    {
      // $statement= " 1 = 2";
      // if(md5($id_usr) == $passwd)
      //   $statement= " AND A.NIP_BARU = '".$id_usr."'";

      // $statement= " AND A.NIP_BARU = ".$this->db->escape($username)." AND A.LOGIN_PASS = ".$this->db->escape($passwd);
      $statement= " AND B.user_login = ".$this->db->escape($username)." AND B.user_pass = ".$this->db->escape($passwd);

      $str = "
      SELECT
        A.PEGAWAI_ID, A.NIP_BARU, A.NAMA
      FROM simpeg.pegawai A
      LEFT JOIN CAT.USER_APP B ON A.PEGAWAI_ID=B.PEGAWAI_ID
      WHERE 1 = 1
      ".$statement;

      $this->query = $str;
      // echo $str;exit;
      return $this->select($str);
    }

    function selectbyloginadminnew($loginadminid)
    {
      // $statement= " 1 = 2";
      // if(md5($id_usr) == $passwd)
      //   $statement= " AND A.NIP_BARU = '".$id_usr."'";
      $statement= " AND user_app_id = ".$this->db->escape($loginadminid);

      $str = "
      SELECT
      *
      FROM user_app 
      WHERE 1 = 1
      ".$statement;

      $this->query = $str;
      // echo $str;exit;
      return $this->select($str);
    }


    function selectByParamsMonitorRekap($paramsArray=array(),$limit=-1,$from=-1, $statement="", $sOrder=""){
     $str = "SELECT 
        A.USER_APP_ID, A.NAMA, A.PEGAWAI_ID, A.USER_LOGIN, C.NAMA SATKER, B.NAMA USER_GROUP, 
        COALESCE(ANJAB_JUMLAH_INSERT,0)+COALESCE(ANJAB_JUMLAH_UPDATE,0)+
        COALESCE(ANJAB_DETIL_JUMLAH_INSERT,0)+COALESCE(ANJAB_DETIL_JUMLAH_UPDATE,0)+
        COALESCE(DUK_JUMLAH_INSERT,0)+COALESCE(DUK_JUMLAH_UPDATE,0)+
        COALESCE(HUKUMAN_JUMLAH_INSERT,0)+COALESCE(HUKUMAN_JUMLAH_UPDATE,0)+
        COALESCE(KENAIKAN_PANGKAT_JUMLAH_INSERT,0)+COALESCE(KENAIKAN_PANGKAT_JUMLAH_UPDATE,0)+
        COALESCE(KGB_JUMLAH_INSERT,0)+COALESCE(KGB_JUMLAH_UPDATE,0)+
        COALESCE(KP_JUMLAH_INSERT,0)+COALESCE(KP_JUMLAH_UPDATE,0)+
        COALESCE(PERUBAHAN_DATA_JUMLAH_INSERT,0)+COALESCE(PERUBAHAN_DATA_JUMLAH_UPDATE,0)+
        COALESCE(USER_APP_JUMLAH_INSERT,0)+COALESCE(USER_APP_JUMLAH_UPDATE,0) JUMLAH_AKSI
        FROM USER_APP A
        INNER JOIN USER_GROUP B ON B.USER_GROUP_ID = A.USER_GROUP_ID
        LEFT JOIN SATKER C ON C.SATKER_ID = A.SATKER_ID
        LEFT JOIN(SELECT COUNT(1) ANJAB_JUMLAH_INSERT, LAST_CREATE_USER FROM ANJAB GROUP BY LAST_CREATE_USER) D ON D.LAST_CREATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) ANJAB_JUMLAH_UPDATE, LAST_UPDATE_USER FROM ANJAB GROUP BY LAST_UPDATE_USER) E ON E.LAST_UPDATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) ANJAB_DETIL_JUMLAH_INSERT, LAST_CREATE_USER FROM ANJAB_DETIL GROUP BY LAST_CREATE_USER) F ON F.LAST_CREATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) ANJAB_DETIL_JUMLAH_UPDATE, LAST_UPDATE_USER FROM ANJAB_DETIL GROUP BY LAST_UPDATE_USER) G ON G.LAST_UPDATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) DUK_JUMLAH_INSERT, LAST_CREATE_USER FROM DUK GROUP BY LAST_CREATE_USER) H ON H.LAST_CREATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) DUK_JUMLAH_UPDATE, LAST_UPDATE_USER FROM DUK GROUP BY LAST_UPDATE_USER) I ON I.LAST_UPDATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) HUKUMAN_JUMLAH_INSERT, LAST_CREATE_USER FROM HUKUMAN GROUP BY LAST_CREATE_USER) J ON J.LAST_CREATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) HUKUMAN_JUMLAH_UPDATE, LAST_UPDATE_USER FROM HUKUMAN GROUP BY LAST_UPDATE_USER) K ON K.LAST_UPDATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) KENAIKAN_PANGKAT_JUMLAH_INSERT, LAST_CREATE_USER FROM KENAIKAN_PANGKAT GROUP BY LAST_CREATE_USER) L ON L.LAST_CREATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) KENAIKAN_PANGKAT_JUMLAH_UPDATE, LAST_UPDATE_USER FROM KENAIKAN_PANGKAT GROUP BY LAST_UPDATE_USER) M ON M.LAST_UPDATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) KGB_JUMLAH_INSERT, LAST_CREATE_USER FROM KGB GROUP BY LAST_CREATE_USER) N ON N.LAST_CREATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) KGB_JUMLAH_UPDATE, LAST_UPDATE_USER FROM KGB GROUP BY LAST_UPDATE_USER) O ON O.LAST_UPDATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) KP_JUMLAH_INSERT, LAST_CREATE_USER FROM KP GROUP BY LAST_CREATE_USER) P ON P.LAST_CREATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) KP_JUMLAH_UPDATE, LAST_UPDATE_USER FROM KP GROUP BY LAST_UPDATE_USER) Q ON Q.LAST_UPDATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) PERUBAHAN_DATA_JUMLAH_INSERT, LAST_CREATE_USER FROM PERUBAHAN_DATA GROUP BY LAST_CREATE_USER) R ON R.LAST_CREATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) PERUBAHAN_DATA_JUMLAH_UPDATE, LAST_UPDATE_USER FROM PERUBAHAN_DATA GROUP BY LAST_UPDATE_USER) S ON S.LAST_UPDATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) USER_APP_JUMLAH_INSERT, LAST_CREATE_USER FROM USER_APP GROUP BY LAST_CREATE_USER) T ON T.LAST_CREATE_USER = A.USER_LOGIN
        LEFT JOIN(SELECT COUNT(1) USER_APP_JUMLAH_UPDATE, LAST_UPDATE_USER FROM USER_APP GROUP BY LAST_UPDATE_USER) U ON U.LAST_UPDATE_USER = A.USER_LOGIN
        WHERE 1=1 "; 
      while(list($key,$val)=each($paramsArray)){
        $str .= " AND $key = '$val' ";
      }
      $str .= $statement." ".$sOrder;
    $this->query = $str;
    //echo $str;
      return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1){
      $str = "
      SELECT 
      USER_APP_ID, USER_GROUP_ID, USER_LOGIN, USER_PASS, A.NAMA, A.ALAMAT, A.PEGAWAI_ID,
      A.EMAIL, A.TELEPON, A.PEGAWAI_ID,  A.SATKER_ID, B.NAMA SATKER, AMBIL_SATKER_NAMA(COALESCE(A.SATKER_ID,'0')) SATKER_DETIL
      FROM USER_APP A
      LEFT JOIN SATKER B ON A.SATKER_ID = B.SATKER_ID
      WHERE 1=1 "; 
      while(list($key,$val)=each($paramsArray)){
        $str .= " AND $key = '$val' ";
      }
      $str .= " ORDER BY USER_LOGIN";
    //echo $str;
      $this->query = $str;
      return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsMonitorLog($paramsArray=array(),$limit=-1,$from=-1, $user_login="", $statement="", $sOrder="ORDER BY TO_CHAR(TANGGAL, 'DD-MM-YYYY HH24:MI:SS') DESC"){
     $str = "
       SELECT * FROM (
      SELECT 'Menambah data Agama pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM AGAMA where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Agama pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM AGAMA where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Anak pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM ANAK where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Anak pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM ANAK where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Anjab pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM ANJAB where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Anjab pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM ANJAB where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Anjab Detil pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM ANJAB_DETIL where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Anjab Detil pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM ANJAB_DETIL where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Bahasa pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM BAHASA where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Bahasa Detil pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM BAHASA where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Bank pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM BANK where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Bank Detil pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM BANK where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Cuti pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM CUTI where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Cuti pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM CUTI where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Diklat Fungsional pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM DIKLAT_FUNGSIONAL where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Diklat Fungsional pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM DIKLAT_FUNGSIONAL where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Diklat Struktural pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM DIKLAT_STRUKTURAL where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Diklat Struktural pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM DIKLAT_STRUKTURAL where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Diklat Teknis pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM DIKLAT_TEKNIS where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Diklat Teknis pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM DIKLAT_TEKNIS where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Daftar Urutan Kepegawaian pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM DUK where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Daftar Urutan Kepegawaian pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM DUK where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Eselon pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM ESELON where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Eselon pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM ESELON where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Gaji Pegawai pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM GAJI_PEGAWAI where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Gaji Pegawai pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM GAJI_PEGAWAI where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Gaji Pokok pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM GAJI_POKOK where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Gaji Pokok pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM GAJI_POKOK where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Gaji Riwayat pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM GAJI_RIWAYAT where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Gaji Riwayat pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM GAJI_RIWAYAT where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Hukuman pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM HUKUMAN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Hukuman pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM HUKUMAN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Hutang SKPP pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM HUTANG_SKPP where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Hutang SKPP pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM HUTANG_SKPP where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Jabatan Fungsional pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM JABATAN_FUNGSIONAL where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Jabatan Fungsional pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM JABATAN_FUNGSIONAL where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Jabatan Riwayat pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM JABATAN_RIWAYAT where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Jabatan Riwayat pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM JABATAN_RIWAYAT where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Jenis Hukuman pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM JENIS_HUKUMAN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Jenis Hukuman pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM JENIS_HUKUMAN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Jenis Pegawai pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM JENIS_PEGAWAI where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Jenis Pegawai pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM JENIS_PEGAWAI where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Jurusan Pendidikan pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM JURUSAN_PENDIDIKAN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Jurusan Pendidikan pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM JURUSAN_PENDIDIKAN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Kabupaten pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM KABUPATEN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Kabupaten pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM KABUPATEN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Kecamatan pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM KECAMATAN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Kecamatan pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM KECAMATAN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Kedudukan pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM KEDUDUKAN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Kedudukan pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM KEDUDUKAN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Kelurahan pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM KELURAHAN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Kelurahan pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM KELURAHAN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Kenaikan Pangkat pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM KENAIKAN_PANGKAT where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Kenaikan Pangkat pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM KENAIKAN_PANGKAT where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Kenaikan Pangkat Detil pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM KENAIKAN_PANGKAT_DETIL where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Kenaikan Pangkat Detil pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM KENAIKAN_PANGKAT_DETIL where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Kenaikan Gaji Berkala pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM KGB where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Kenaikan Gaji Berkala pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM KGB where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Korpri pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM KORPRI where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Korpri pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM KORPRI where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Kenaikan Pangkat pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM KP where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Kenaikan Pangkat pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM KP where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Kenaikan Pangkat Usulan pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM KP_USULAN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Kenaikan Pangkat Usulan pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM KP_USULAN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Kursus pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM KURSUS where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Kursus pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM KURSUS where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Lencana pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM LENCANA where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Lencana pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM LENCANA where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Lencana Pegawai pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM LENCANA_PEGAWAI where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Lencana Pegawai pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM LENCANA_PEGAWAI where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Mertua pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM MERTUA where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Mertua pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM MERTUA where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Mutasi pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM MUTASI where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Mutasi pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM MUTASI where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Nikah Riwayat pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM NIKAH_RIWAYAT where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Nikah Riwayat pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM NIKAH_RIWAYAT where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Orang Tua pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM ORANG_TUA where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Orang Tua pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM ORANG_TUA where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Organisasi Riwayat pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM ORGANISASI_RIWAYAT where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Organisasi Riwayat pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM ORGANISASI_RIWAYAT where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Pangkat pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PANGKAT where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Pangkat pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PANGKAT where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Pangkat Riwayat pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PANGKAT_RIWAYAT where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Pangkat Riwayat pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PANGKAT_RIWAYAT where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Pejabat Penetap pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PEJABAT_PENETAP where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Pejabat Penetap pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PEJABAT_PENETAP where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Penataran pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PENATARAN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Penataran pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PENATARAN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Pendidikan pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PENDIDIKAN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Pendidikan pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PENDIDIKAN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Pendidikan Riwayat pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PENDIDIKAN_RIWAYAT where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Pendidikan Riwayat pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PENDIDIKAN_RIWAYAT where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Pengalaman pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PENGALAMAN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Pengalaman pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PENGALAMAN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Penghargaan pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PENGHARGAAN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Penghargaan pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PENGHARGAAN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Penilaian pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PENILAIAN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Penilaian pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PENILAIAN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Pensiun pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PENSIUN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Pensiun pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PENSIUN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Peraturan pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PERATURAN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Peraturan pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PERATURAN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Perubahan Data pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PERUBAHAN_DATA where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Perubahan Data pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PERUBAHAN_DATA where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Piagam pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PIAGAM where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Piagam pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PIAGAM where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Potensi Diri pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM POTENSI_DIRI where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Potensi Diri pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM POTENSI_DIRI where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Prestasi Kerja pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PRESTASI_KERJA where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Prestasi Kerja pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PRESTASI_KERJA where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Propinsi pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM PROPINSI where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Propinsi pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM PROPINSI where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Satuan Kerja pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM SATKER where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Satuan Kerja pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM SATKER where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Saudara pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM SAUDARA where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Saudara pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM SAUDARA where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Seminar pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM SEMINAR where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Seminar pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM SEMINAR where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data SK Cpns pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM SK_CPNS where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data SK Cpns pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM SK_CPNS where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data SK Pns pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM SK_PNS where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data SK Pns pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM SK_PNS where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Status Pegawai pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM STATUS_PEGAWAI where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Status Pegawai pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM STATUS_PEGAWAI where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Suami / Istri pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM SUAMI_ISTRI where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Suami / Istri pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM SUAMI_ISTRI where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Tambahan Masa Kerja pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM TAMBAHAN_MASA_KERJA where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Tambahan Masa Kerja pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM TAMBAHAN_MASA_KERJA where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Tingkat Hukuman pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM TINGKAT_HUKUMAN where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Tingkat Hukuman pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM TINGKAT_HUKUMAN where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Tipe Pegawai pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM TIPE_PEGAWAI where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Tipe Pegawai pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM TIPE_PEGAWAI where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Toefl pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM TOEFL where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Toefl pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM TOEFL where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Tugas pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM TUGAS where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Tugas pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM TUGAS where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Tugas Belajar pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM TUGAS_BELAJAR where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Tugas Belajar pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM TUGAS_BELAJAR where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Tunjangan Umum pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM TUNJANGAN_UMUM where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Tunjangan Umum pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM TUNJANGAN_UMUM where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data User Aplikasi pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM USER_APP where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data User Aplikasi pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM USER_APP where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data User Group Aplikasi pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM USER_GROUP where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data User Group Aplikasi pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM USER_GROUP where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data Visitor pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM VISITOR where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data Visitor pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM VISITOR where LAST_UPDATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Menambah data ZIS pada tanggal ' || TO_CHAR(LAST_CREATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_CREATE_DATE TANGGAL FROM ZIS where LAST_CREATE_USER = '".$user_login."'
      UNION ALL
      SELECT 'Mengubah data ZIS pada tanggal ' || TO_CHAR(LAST_UPDATE_DATE, 'DD-MM-YYYY HH24:MI:SS') AKSI, LAST_UPDATE_DATE TANGGAL FROM ZIS where LAST_UPDATE_USER = '".$user_login."'
      ) A WHERE 1=1
     "; 
      $str .= $statement." ".$sOrder;
    $this->query = $str;
    //echo $str;
      return $this->selectLimit($str,$limit,$from); 
    }

  } 
?>
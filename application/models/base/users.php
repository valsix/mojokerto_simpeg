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
      '".$this->getField("PEGAWAI_ID")."', 
      '".$this->getField("SATKER_ID")."',        
      '".$this->getField("LAST_CREATE_USER")."',
      ".$this->getField("LAST_CREATE_DATE").",
      '".$this->getField("LAST_CREATE_SATKER")."' 
    )"; 
    $this->query = $str;
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

  } 
?>
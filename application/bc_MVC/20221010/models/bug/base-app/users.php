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


    function insert()
    {
      $this->setField("USER_APP_ID", $this->getNextId("USER_APP_ID","USER_APP"));
      $this->setField("USER_PASS", md5($this->getField("USER_PASS")));
      $str = "
        INSERT INTO USER_APP (
        USER_APP_ID, USER_GROUP_ID, USER_LOGIN, 
        USER_PASS, NAMA, ALAMAT, 
        EMAIL, TELEPON, PEGAWAI_ID, SATKER_ID) 
        VALUES (
        ".$this->getField("USER_APP_ID").",
        ".$this->getField("USER_GROUP_ID").",
        '".$this->getField("USER_LOGIN")."',
        '".$this->getField("USER_PASS")."',
        '".$this->getField("NAMA")."',
        '".$this->getField("ALAMAT")."',
        '".$this->getField("EMAIL")."',
        '".$this->getField("TELEPON")."',
        ".$this->getField("PEGAWAI_ID").", 
        '".$this->getField("SATKER_ID")."'
      )"; 
      
      $this->id = $this->getField("USER_APP_ID");
      $this->query = $str;
      return $this->execQuery($str);
    }

    function update()
    {
      $str = "
      UPDATE USER_APP
      SET    USER_GROUP_ID = ".$this->getField("USER_GROUP_ID").",
      USER_LOGIN    = '".$this->getField("USER_LOGIN")."',
      NAMA          = '".$this->getField("NAMA")."',
      ALAMAT        = '".$this->getField("ALAMAT")."',
      EMAIL         = '".$this->getField("EMAIL")."',
      TELEPON       = '".$this->getField("TELEPON")."',
      PEGAWAI_ID    = ".$this->getField("PEGAWAI_ID").",
      SATKER_ID   = '".$this->getField("SATKER_ID")."'
      WHERE  USER_APP_ID   = ".$this->getField("USER_APP_ID")."
          "; 
      $this->query = $str;
      // echo $str;exit;
      
      return $this->execQuery($str);
    }

    function updatePassword()
    {
      $this->setField("USER_PASS", md5($this->getField("USER_PASS")));
      $str = "
      UPDATE USER_APP
      SET   
      USER_PASS    = '".$this->getField("USER_PASS")."'
      WHERE  USER_APP_ID   = ".$this->getField("USER_APP_ID")."
          "; 
      $this->query = $str;
      // echo $str;exit;
      
      return $this->execQuery($str);
    }

    function selectByAdminIdPassword($id_usr,$passwd)
    {
      $str = "
      SELECT
        USER_APP_ID, A.USER_GROUP_ID, USER_LOGIN, USER_PASS, A.NAMA, ALAMAT, B.NAMA GROUP_NAMA
        , EMAIL, TELEPON, PEGAWAI_ID, A.SATKER_ID, B.AKSES_APP_SIMPEG_ID
      FROM user_app A
      LEFT JOIN user_group B ON A.USER_GROUP_ID = B.USER_GROUP_ID
      WHERE 1=1 AND USER_LOGIN='".$id_usr."' AND USER_PASS='".$passwd."'";
      $this->query = $str;
      // echo $str;exit;
      return $this->select($str);
    }

    function selectByParamsMonitoring($paramsArray=array(),$limit=-1,$from=-1, $statement=''){
     $str = "SELECT USER_APP_ID, A.NAMA, A.PEGAWAI_ID,USER_LOGIN, A.SATKER_ID,
        B.NAMA SATKER, C.NAMA USER_GROUP,A.USER_GROUP_ID
        FROM USER_APP A
        LEFT JOIN SATKER B ON B.SATKER_ID = A.SATKER_ID
        LEFT JOIN USER_GROUP C ON C.USER_GROUP_ID = A.USER_GROUP_ID
        LEFT JOIN
        (
          SELECT USER_LOGIN USER_LOGIN_INFO, COUNT(1) JUMLAH_USER_LOGIN
          FROM USER_APP
          GROUP BY USER_LOGIN
        ) JML ON JML.USER_LOGIN_INFO = A.USER_LOGIN
        WHERE 1=1 
      "; 
      while(list($key,$val)=each($paramsArray)){
        $str .= " AND $key = '$val' ";
      }
      $str .= $statement." ORDER BY A.USER_LOGIN";
      $this->query = $str;
      return $this->selectLimit($str,$limit,$from); 
    }

    function delete()
    {
      $str = "DELETE FROM USER_APP
      WHERE 
      USER_APP_ID = ".$this->getField("USER_APP_ID").""; 
      
      $this->query = $str;
      return $this->execQuery($str);
    }

  } 
?>
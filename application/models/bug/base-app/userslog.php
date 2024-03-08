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

  class UsersLog extends Entity{ 

    var $query;
    function UsersLog()
    {
      $this->Entity(); 
    }

    function insert()
    {
      $this->setField("USER_APP_LOG_ID", $this->getNextId("USER_APP_LOG_ID","USER_APP_LOG")); 

      $str = "INSERT INTO USER_APP_LOG (
             USER_APP_LOG_ID, USER_APP_ID, KETERANGAN, LAST_CREATE_DATE)
          VALUES (
            ".$this->getField("USER_APP_LOG_ID").",
            ".$this->getField("USER_APP_ID").",
            '".$this->getField("KETERANGAN")."',
            NOW()
          )"; 
          
      $this->query = $str;
      return $this->execQuery($str);
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
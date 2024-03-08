<? 
  include_once(APPPATH.'/models/Entity.php');

  class Bank extends Entity{ 

    var $query;
    function Bank()
    {
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
    {
      $str = "SELECT TIPE_PEGAWAI_ID, TIPE_PEGAWAI_ID_PARENT, NAMA
      FROM TIPE_PEGAWAI WHERE TIPE_PEGAWAI_ID IS NOT NULL"; 

      while(list($key,$val) = each($paramsArray))
      {
        $str .= " AND $key = '$val' ";
      }

      $str .= $statement." ORDER BY TIPE_PEGAWAI_ID ASC";
      $this->query = $str;

      return $this->selectLimit($str,$limit,$from); 
    }

  } 
?>
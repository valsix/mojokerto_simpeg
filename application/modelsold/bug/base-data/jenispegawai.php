<? 
  include_once(APPPATH.'/models/Entity.php');

  class JenisPegawai extends Entity{ 

    var $query;
    function JenisPegawai()
    {
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
    {
      $str = "SELECT JENIS_PEGAWAI_ID, NAMA
      FROM JENIS_PEGAWAI WHERE JENIS_PEGAWAI_ID IS NOT NULL"; 
      
      while(list($key,$val) = each($paramsArray))
      {
        $str .= " AND $key = '$val' ";
      }
      
      $this->query = $str;
      $str .= $statement." ORDER BY NAMA ASC";
      
      return $this->selectLimit($str,$limit,$from); 
    }

  } 
?>
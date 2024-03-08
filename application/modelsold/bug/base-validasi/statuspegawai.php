<? 
  include_once(APPPATH.'/models/Entity.php');

  class StatusPegawai extends Entity{ 

    var $query;
    function StatusPegawai()
    {
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
    {
      $str = "SELECT STATUS_PEGAWAI_ID, NAMA
      FROM STATUS_PEGAWAI WHERE STATUS_PEGAWAI_ID IS NOT NULL"; 
      
      while(list($key,$val) = each($paramsArray))
      {
        $str .= " AND $key = '$val' ";
      }
      
      $this->query = $str;
      $str .= $statement." ORDER BY STATUS_PEGAWAI_ID ASC";
      
      return $this->selectLimit($str,$limit,$from); 
    }

  } 
?>
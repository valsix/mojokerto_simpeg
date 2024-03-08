<? 
  include_once(APPPATH.'/models/Entity.php');

  class JabatanStruktural extends Entity{ 

    var $query;
    function JabatanStruktural()
    {
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
    {
      $str = "
      SELECT
        A.*

      FROM JABATAN_STRUKTURAL_NEW A
      WHERE 1=1
      "; 

      while(list($key,$val) = each($paramsArray))
      {
        $str .= " AND $key = '$val' ";
      }

      $str .= $statement." ".$sOrder;
      $this->query = $str;

      return $this->selectLimit($str,$limit,$from); 
    }

    function getCountByParams($paramsArray=array(), $statement='')
    {
      $str = "
      SELECT COUNT(1) AS ROWCOUNT 
      FROM JABATAN_STRUKTURAL_NEW A
      WHERE 1 = 1 ".$statement;

      while(list($key,$val)=each($paramsArray))
      {
        $str .= " AND $key = '$val' ";
      }
      
      $this->query = $str;
      $this->select($str); 
      if($this->firstRow()) 
        return $this->getField("ROWCOUNT"); 
      else 
        return 0;  
    }

  } 
?>
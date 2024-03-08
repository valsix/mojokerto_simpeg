<? 
  include_once(APPPATH.'/models/Entity.php');

  class Kedudukan extends Entity{ 

    var $query;
    function Kedudukan()
    {
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='')
    {
      $str = "SELECT KEDUDUKAN_ID, NAMA
      FROM KEDUDUKAN WHERE KEDUDUKAN_ID IS NOT NULL"; 
      
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
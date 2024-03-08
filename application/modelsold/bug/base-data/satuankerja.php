<? 
  include_once(APPPATH.'/models/Entity.php');

  class SatuanKerja extends Entity{ 

    var $query;
    function SatuanKerja()
    {
      $this->Entity(); 
    }

    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
    {
      $str = "
      SELECT
        A.*
        , AMBIL_SATKER_NAMA(A.SATKER_ID) SATKER_DETIL_NAMA, B.NAMA ESELON_NAMA
      FROM SATKER A
      LEFT JOIN ESELON B ON A.ESELON_ID = B.ESELON_ID
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
      FROM SATKER A
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
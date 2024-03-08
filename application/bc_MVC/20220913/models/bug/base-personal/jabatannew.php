<? 
  include_once(APPPATH.'/models/Entity.php');

  class JabatanNew extends Entity{ 

	var $query;

    function JabatanNew()
	{
      $this->Entity(); 
    }

  function selectByParamsFungsional($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.TIPE_PEGAWAI_NEW_ID,B.JABATAN_FUNGSIONAL_NEW_ID,A.NAMA ,B.NAMA JABATAN_FUNGSIONAL,B.BUP 
		FROM TIPE_PEGAWAI_NEW A
		LEFT JOIN JABATAN_FUNGSIONAL_NEW B ON A.TIPE_PEGAWAI_NEW_ID = B.TIPE_PEGAWAI_NEW_ID
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

  function selectByParamsPelaksana($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT A.TIPE_PEGAWAI_NEW_ID,A.NAMA,C.JABATAN_PELAKSANA_NEW_ID,C.NAMA JABATAN_PELAKSANA,C.BUP,C.KELAS_JABATAN 
    FROM TIPE_PEGAWAI_NEW A
    LEFT JOIN JABATAN_PELAKSANA_NEW C ON A.TIPE_PEGAWAI_NEW_ID = C.TIPE_PEGAWAI_NEW_ID
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

    function getCountByParamsFungsional($paramsArray=array(), $statement='')
    {
      $str = "
      SELECT COUNT(1) AS ROWCOUNT 
      FROM TIPE_PEGAWAI_NEW A
      LEFT JOIN JABATAN_FUNGSIONAL_NEW B ON A.TIPE_PEGAWAI_NEW_ID = B.TIPE_PEGAWAI_NEW_ID
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

    function getCountByParamsPelaksana($paramsArray=array(), $statement='')
    {
      $str = "
      SELECT COUNT(1) AS ROWCOUNT 
      FROM TIPE_PEGAWAI_NEW A
	   LEFT JOIN JABATAN_PELAKSANA_NEW C ON A.TIPE_PEGAWAI_NEW_ID = C.TIPE_PEGAWAI_NEW_ID
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

    function selectByParamsStruktural($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
    {
      $str = "
       SELECT A.TIPE_PEGAWAI_NEW_ID,A.NAMA,B.JABATAN_STRUKTURAL_NEW_ID,COALESCE(B.NAMA, '') || ' - ' || COALESCE(B.UNOR_INDUK, '') JABATAN_STRUKTURAL, B.NAMA_UNOR,B.BUP,B.KELAS_JABATAN,B.ESELON_ID,C.NAMA ESELON_NAMA 
      FROM TIPE_PEGAWAI_NEW A
      LEFT JOIN JABATAN_STRUKTURAL_NEW B ON A.TIPE_PEGAWAI_NEW_ID = B.TIPE_PEGAWAI_NEW_ID
      LEFT JOIN ESELON C ON B.ESELON_ID = C.ESELON_ID
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
    function getCountByParamsStruktural($paramsArray=array(), $statement='')
    {
      $str = "
      SELECT COUNT(1) AS ROWCOUNT 
      FROM TIPE_PEGAWAI_NEW A
      LEFT JOIN JABATAN_STRUKTURAL_NEW B ON A.TIPE_PEGAWAI_NEW_ID = B.TIPE_PEGAWAI_NEW_ID
      LEFT JOIN ESELON C ON B.ESELON_ID = C.ESELON_ID
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
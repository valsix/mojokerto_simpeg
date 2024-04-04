<? 
  include_once(APPPATH.'/models/Entity.php');

  	class DbLog extends Entity{ 

	var $query;

    function DbLog()
	{
      $this->Entity(); 
    }

	function insert($infotable, $infoaksi, $query)
	 {
	    $query= str_replace('&', "'||chr(38)||'", $query);
	    $query= str_replace("'", "'||chr(39)||'", $query);


	    $strquery = "
	    INSERT INTO INFO_LOG
	    (
	      INFO_TABLE, INFO_AKSI, INFO_QUERY, LAST_USER, LAST_DATE
	    ) 
	    VALUES 
	    (
	      '".$infotable."'
	      , '".$infoaksi."'
	      , '".$query."'
	      , '".$this->sessionuser."'
	      , NOW()
	    )"
	    ;

	    // $this->query = $strquery;
	    // echo $strquery;exit;
	    $this->execQuery($strquery);
	 }

       
  } 
?>
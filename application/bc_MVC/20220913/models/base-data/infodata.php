<? 
include_once(APPPATH.'/models/Entity.php');

class InfoData extends Entity{ 

	var $query;

	function InfoData()
	{
		$this->Entity(); 
	}

	function selectbyformulapenilaian($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.formula_penilaian A
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

	function selectbyagama($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.agama A
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

	function selectbysatuankerja($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.satker A
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

	function selectbypangkat($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.pangkat A
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

	function selectbyeselon($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY A.ESELON_ID")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.eselon A
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

	function selectbytipepegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY A.TIPE_PEGAWAI_ID")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.tipe_pegawai A
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

	function selectbypendidikan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY A.PENDIDIKAN_ID")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.pendidikan A
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

	function selectbykampus($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY A.NAMA")
	{
		$str = "
		SELECT
		A.*, b.nama TINGKAT_PENDIDIKAN_NAMA, c.nama TINGKAT_PENDIDIKAN_NAMAs1, d.nama TINGKAT_PENDIDIKAN_NAMAs2, e.nama TINGKAT_PENDIDIKAN_NAMAs3
		FROM simpeg.kampus A
		left join simpeg.tingkat_pendidikan b on a.TINGKAT_PENDIDIKAN_ID = b. TINGKAT_PENDIDIKAN_ID 
		left join simpeg.tingkat_pendidikan c on a.s1 = c. TINGKAT_PENDIDIKAN_ID 
		left join simpeg.tingkat_pendidikan d on a.s2 = d. TINGKAT_PENDIDIKAN_ID 
		left join simpeg.tingkat_pendidikan e on a.s3 = e. TINGKAT_PENDIDIKAN_ID 
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

	function selectbyparamspegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
		A1.KODE PANGKAT_KODE, A1.NAMA PANGKAT_NAMA, A2.NAMA SATKER_NAMA, A3.NAMA ESELON_NAMA
		, A.*
		FROM simpeg.pegawai A
		LEFT JOIN simpeg.pangkat A1 ON A1.PANGKAT_ID = A.LAST_PANGKAT_ID
		LEFT JOIN simpeg.satker A2 ON A.SATKER_ID = A2.SATKER_ID
		LEFT JOIN simpeg.eselon A3 on A.LAST_ESELON_ID = A3.ESELON_ID
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

	function selectbyparamspangkat($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY COALESCE(A.TMT_PANGKAT, TO_DATE('1900-01-01', 'YYYY-MM-DD')) DESC")
	{
		$str = "
		SELECT
		A1.KODE PANGKAT_KODE, A1.NAMA PANGKAT_NAMA
		, A.*
		FROM simpeg.riwayat_pangkat A
		LEFT JOIN simpeg.pangkat A1 ON A1.PANGKAT_ID = A.PANGKAT_ID
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

	function selectbyparamsjabatan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY A.TMT_JABATAN DESC")
	{
		$str = "
		SELECT
		A1.NAMA ESELON_NAMA
		, A.*
		FROM simpeg.riwayat_jabatan A
		LEFT JOIN simpeg.eselon A1 ON A1.ESELON_ID = A.ESELON_ID
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

	function selectbyparamsjabatandata($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY COALESCE(A.TMT_JABATAN, TO_DATE('1900-01-01', 'YYYY-MM-DD')) DESC")
	{
		$str = "
		SELECT
		A1.NAMA ESELON_NAMA
		, A.*
		FROM data.riwayat_jabatan A
		LEFT JOIN simpeg.eselon A1 ON A1.ESELON_ID = A.ESELON_ID
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
		// echo $str;exit;
				
		return $this->selectLimit($str,$limit,$from); 
	}

	function selectbyparamspendidikan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY A.TAHUN::NUMERIC DESC")
	{
		$str = "
		SELECT
		A1.NAMA PENDIDIKAN_NAMA, A2.NAMA KAMPUS_NAMA
		, A.*
		FROM simpeg.riwayat_pendidikan A
		LEFT JOIN simpeg.pendidikan A1 ON A1.PENDIDIKAN_ID = A.PENDIDIKAN_ID
		LEFT JOIN simpeg.kampus A2 ON A2.KAMPUS_ID = A.KAMPUS_ID
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

	function selectbyparamspendidikandata($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY COALESCE(A.TANGGAL, TO_DATE('1900-01-01', 'YYYY-MM-DD')) DESC")
	{
		$str = "
		SELECT
		A1.NAMA PENDIDIKAN_NAMA, A2.NAMA KAMPUS_NAMA, A3.NAMA TINGKAT_PENDIDIKAN_NAMA, a4.NAMA_JURUSAN NAMA_JURUSAN
		, TO_CHAR(TANGGAL, 'YYYY') TAHUN
		, A.*
		FROM data.riwayat_pendidikan A
		LEFT JOIN simpeg.pendidikan A1 ON A1.PENDIDIKAN_ID = A.PENDIDIKAN_ID
		LEFT JOIN simpeg.kampus A2 ON A2.KAMPUS_ID = A.KAMPUS_ID
		LEFT JOIN simpeg.tingkat_pendidikan A3 ON A2.TINGKAT_PENDIDIKAN_ID = A3.TINGKAT_PENDIDIKAN_ID
		LEFT JOIN simpeg.JURUSAN A4 ON A4.JURUSAN_ID = A.KODE_JURUSAN
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

	function selectbyparamsdiklatstrukturaldata($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY COALESCE(A.TANGGAL_MULAI, TO_DATE('1900-01-01', 'YYYY-MM-DD')) DESC")
	{
		$str = "
		SELECT
		A.*
		FROM data.riwayat_diklat_struktural A
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
		// echo $str;exit;

		return $this->selectLimit($str,$limit,$from); 
	}

	function selectbyparamsdiklatfungsionaldata($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY COALESCE(A.TANGGAL_MULAI, TO_DATE('1900-01-01', 'YYYY-MM-DD')) DESC")
	{
		$str = "
		SELECT
		A.*
		FROM data.riwayat_diklat_fungsional A
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
		// echo $str;exit;

		return $this->selectLimit($str,$limit,$from); 
	}

	function selectbyparamsdiklatteknisdata($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY COALESCE(A.TANGGAL_MULAI, TO_DATE('1900-01-01', 'YYYY-MM-DD')) DESC")
	{
		$str = "
		SELECT
		A.*
		FROM data.riwayat_diklat_teknis A
		WHERE 1=1
		"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		$str .= $statement." ".$sOrder;
		$this->query = $str;
		// echo $str;exit;

		return $this->selectLimit($str,$limit,$from); 
	}

	function selectbyparamstingkatpendidikan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="ORDER BY A.tingkat_pendidikan_id asc")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.tingkat_pendidikan A
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

	function jabatanriwayatinsert()
	{
		$this->setField("RIWAYAT_JABATAN_ID", $this->getNextId("RIWAYAT_JABATAN_ID","data.RIWAYAT_JABATAN")); 

		$str = "
		INSERT INTO data.RIWAYAT_JABATAN
		(
			RIWAYAT_JABATAN_ID,
			PEGAWAI_ID,
			ESELON_ID,
			JABATAN,
			MASA_JAB_TAHUN,
			MASA_JAB_BULAN,
			TMT_JABATAN
		) 
		VALUES 
		(
			".$this->getField("RIWAYAT_JABATAN_ID")."
			,'".$this->getField("PEGAWAI_ID")."'
			, '".$this->getField("ESELON_ID")."'
			, '".$this->getField("JABATAN")."'
			, ".$this->getField("MASA_JAB_TAHUN")."
			, ".$this->getField("MASA_JAB_BULAN")."
			, ".$this->getField("TMT_JABATAN")."
		)
		";

		$this->id = $this->getField("RIWAYAT_JABATAN_ID");
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function jabatanriwayatupdate()
	{
		$str = "		
		UPDATE data.RIWAYAT_JABATAN
		SET    
		 	ESELON_ID= ".$this->getField("ESELON_ID").",
		 	JABATAN= '".$this->getField("JABATAN")."',
		 	MASA_JAB_TAHUN= ".$this->getField("MASA_JAB_TAHUN").",
		 	MASA_JAB_BULAN= ".$this->getField("MASA_JAB_BULAN").",
		 	TMT_JABATAN= ".$this->getField("TMT_JABATAN")."
		WHERE RIWAYAT_JABATAN_ID = ".$this->getField("RIWAYAT_JABATAN_ID")."
		"; 
		$this->query = $str;
		// echo "xxx-".$str;exit;
		return $this->execQuery($str);
    }

    function pendidikanriwayatinsert()
	{
		$this->setField("RIWAYAT_PENDIDIKAN_ID", $this->getNextId("RIWAYAT_PENDIDIKAN_ID","data.RIWAYAT_PENDIDIKAN")); 

		$str = "
		INSERT INTO data.RIWAYAT_PENDIDIKAN
		(
			RIWAYAT_PENDIDIKAN_ID,
			PENDIDIKAN_ID,
			PEGAWAI_ID,
			KAMPUS_ID,
			KODE_JURUSAN,
			TANGGAL
		) 
		VALUES 
		(
			".$this->getField("RIWAYAT_PENDIDIKAN_ID")."
			,".$this->getField("PENDIDIKAN_ID")."
			,".$this->getField("PEGAWAI_ID")."
			,".$this->getField("KAMPUS_ID")."
			,".$this->getField("KODE_JURUSAN")."
			,".$this->getField("TANGGAL")."
		)
		";

		$this->id = $this->getField("RIWAYAT_PENDIDIKAN_ID");
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function pendidikanriwayatupdate()
	{
		$str = "		
		UPDATE data.RIWAYAT_PENDIDIKAN
		SET    
		 	PENDIDIKAN_ID= ".$this->getField("PENDIDIKAN_ID").",
		 	KAMPUS_ID= ".$this->getField("KAMPUS_ID").",
		 	TANGGAL= ".$this->getField("TANGGAL")."
		WHERE RIWAYAT_PENDIDIKAN_ID = ".$this->getField("RIWAYAT_PENDIDIKAN_ID")."
		"; 
		$this->query = $str;
		// echo "xxx-".$str;exit;
		return $this->execQuery($str);
    }

    function diklatstrukturalriwayatinsert()
	{
		$this->setField("RIWAYAT_DIKLAT_STRUKTURAL_ID", $this->getNextId("RIWAYAT_DIKLAT_STRUKTURAL_ID","data.RIWAYAT_DIKLAT_STRUKTURAL")); 

		$str = "
		INSERT INTO data.RIWAYAT_DIKLAT_STRUKTURAL
		(
			RIWAYAT_DIKLAT_STRUKTURAL_ID,
			PEGAWAI_ID,
			NAMA,
			PENYELENGGARA,
			TANGGAL_MULAI,
			TANGGAL_AKHIR
		) 
		VALUES 
		(
			".$this->getField("RIWAYAT_DIKLAT_STRUKTURAL_ID")."
			,".$this->getField("PEGAWAI_ID")."
			,'".$this->getField("NAMA")."'
			,'".$this->getField("PENYELENGGARA")."'
			,".$this->getField("TANGGAL_MULAI")."
			,".$this->getField("TANGGAL_AKHIR")."
		)
		";

		$this->id = $this->getField("RIWAYAT_DIKLAT_STRUKTURAL_ID");
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function diklatstrukturalriwayatupdate()
	{
		$str = "		
		UPDATE data.RIWAYAT_DIKLAT_STRUKTURAL
		SET    
		 	RIWAYAT_DIKLAT_STRUKTURAL_ID= ".$this->getField("RIWAYAT_DIKLAT_STRUKTURAL_ID").",
		 	NAMA= '".$this->getField("NAMA")."',
		 	PENYELENGGARA= '".$this->getField("PENYELENGGARA")."',
		 	TANGGAL_MULAI= ".$this->getField("TANGGAL_MULAI").",
		 	TANGGAL_AKHIR= ".$this->getField("TANGGAL_AKHIR")."
		WHERE RIWAYAT_DIKLAT_STRUKTURAL_ID = ".$this->getField("RIWAYAT_DIKLAT_STRUKTURAL_ID")."
		"; 
		$this->query = $str;
		// echo "xxx-".$str;exit;
		return $this->execQuery($str);
    }

    function diklatfungsionalriwayatinsert()
	{
		$this->setField("RIWAYAT_DIKLAT_FUNGSIONAL_ID", $this->getNextId("RIWAYAT_DIKLAT_FUNGSIONAL_ID","data.RIWAYAT_DIKLAT_FUNGSIONAL")); 

		$str = "
		INSERT INTO data.RIWAYAT_DIKLAT_FUNGSIONAL
		(
			RIWAYAT_DIKLAT_FUNGSIONAL_ID,
			PEGAWAI_ID,
			NAMA,
			PENYELENGGARA,
			TANGGAL_MULAI,
			TANGGAL_AKHIR
		) 
		VALUES 
		(
			".$this->getField("RIWAYAT_DIKLAT_FUNGSIONAL_ID")."
			,".$this->getField("PEGAWAI_ID")."
			,'".$this->getField("NAMA")."'
			,'".$this->getField("PENYELENGGARA")."'
			,".$this->getField("TANGGAL_MULAI")."
			,".$this->getField("TANGGAL_AKHIR")."
		)
		";

		$this->id = $this->getField("RIWAYAT_DIKLAT_FUNGSIONAL_ID");
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function diklatfungsionalriwayatupdate()
	{
		$str = "		
		UPDATE data.RIWAYAT_DIKLAT_FUNGSIONAL
		SET    
		 	RIWAYAT_DIKLAT_FUNGSIONAL_ID= ".$this->getField("RIWAYAT_DIKLAT_FUNGSIONAL_ID").",
		 	NAMA= '".$this->getField("NAMA")."',
		 	PENYELENGGARA= '".$this->getField("PENYELENGGARA")."',
		 	TANGGAL_MULAI= ".$this->getField("TANGGAL_MULAI").",
		 	TANGGAL_AKHIR= ".$this->getField("TANGGAL_AKHIR")."
		WHERE RIWAYAT_DIKLAT_FUNGSIONAL_ID = ".$this->getField("RIWAYAT_DIKLAT_FUNGSIONAL_ID")."
		"; 
		$this->query = $str;
		// echo "xxx-".$str;exit;
		return $this->execQuery($str);
    }

    function diklatteknisriwayatinsert()
	{
		$this->setField("RIWAYAT_DIKLAT_TEKNIS_ID", $this->getNextId("RIWAYAT_DIKLAT_TEKNIS_ID","data.RIWAYAT_DIKLAT_TEKNIS")); 

		$str = "
		INSERT INTO data.RIWAYAT_DIKLAT_TEKNIS
		(
			RIWAYAT_DIKLAT_TEKNIS_ID,
			PEGAWAI_ID,
			NAMA,
			PENYELENGGARA,
			TANGGAL_MULAI,
			TANGGAL_AKHIR
		) 
		VALUES 
		(
			".$this->getField("RIWAYAT_DIKLAT_TEKNIS_ID")."
			,".$this->getField("PEGAWAI_ID")."
			,'".$this->getField("NAMA")."'
			,'".$this->getField("PENYELENGGARA")."'
			,".$this->getField("TANGGAL_MULAI")."
			,".$this->getField("TANGGAL_AKHIR")."
		)
		";

		$this->id = $this->getField("RIWAYAT_DIKLAT_TEKNIS_ID");
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

    function diklatteknisriwayatupdate()
	{
		$str = "		
		UPDATE data.RIWAYAT_DIKLAT_TEKNIS
		SET    
		 	RIWAYAT_DIKLAT_TEKNIS_ID= ".$this->getField("RIWAYAT_DIKLAT_TEKNIS_ID").",
		 	NAMA= '".$this->getField("NAMA")."',
		 	PENYELENGGARA= '".$this->getField("PENYELENGGARA")."',
		 	TANGGAL_MULAI= ".$this->getField("TANGGAL_MULAI").",
		 	TANGGAL_AKHIR= ".$this->getField("TANGGAL_AKHIR")."
		WHERE RIWAYAT_DIKLAT_TEKNIS_ID = ".$this->getField("RIWAYAT_DIKLAT_TEKNIS_ID")."
		"; 
		$this->query = $str;
		// echo "xxx-".$str;exit;
		return $this->execQuery($str);
    }

     function jabatanriwayatdelete()
	{
		$str = "		
		DELETE FROM data.RIWAYAT_JABATAN
		WHERE RIWAYAT_PANGKAT_ID = ".$this->getField("RIWAYAT_PANGKAT_ID")."
		"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

     function pendidikanriwayatdelete()
	{
		$str = "		
		DELETE FROM data.RIWAYAT_PENDIDIKAN
		WHERE RIWAYAT_PENDIDIKAN_ID = ".$this->getField("RIWAYAT_PENDIDIKAN_ID")."
		"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }
    
     function strukturalriwayatdelete()
	{
		$str = "		
		DELETE FROM data.RIWAYAT_DIKLAT_STRUKTURAL
		WHERE RIWAYAT_DIKLAT_STRUKTURAL_ID = ".$this->getField("RIWAYAT_DIKLAT_STRUKTURAL_ID")."
		"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }
    
     function fungsionalriwayatdelete()
	{
		$str = "		
		DELETE FROM data.RIWAYAT_DIKLAT_FUNGSIONAL
		WHERE RIWAYAT_DIKLAT_FUNGSIONAL_ID = ".$this->getField("RIWAYAT_DIKLAT_FUNGSIONAL_ID")."
		"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }
    
     function teknisriwayatdelete()
	{
		$str = "		
		DELETE FROM data.RIWAYAT_DIKLAT_TEKNIS
		WHERE RIWAYAT_DIKLAT_TEKNIS_ID = ".$this->getField("RIWAYAT_DIKLAT_TEKNIS_ID")."
		"; 
		$this->query = $str;
		// echo $str;exit;
		return $this->execQuery($str);
    }

   	function selectbyJurusan($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
	{
		$str = "
		SELECT
		A.*
		FROM simpeg.jurusan A
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
    
} 
?>
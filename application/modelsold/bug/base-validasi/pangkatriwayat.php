<? 
  include_once(APPPATH.'/models/Entity.php');

  class PangkatRiwayat extends Entity{ 

    var $query;
    function PangkatRiwayat()
    {
      $this->Entity(); 
    }

    function insert()
    {
      /*Auto-generate primary key(s) by next max value (integer) */
      $this->setField("TEMP_VALIDASI_ID", $this->getNextId("TEMP_VALIDASI_ID","validasi.PANGKAT_RIWAYAT")); 
      
      $str = "INSERT INTO validasi.PANGKAT_RIWAYAT (
             PANGKAT_RIWAYAT_ID, PEGAWAI_ID, PANGKAT_ID, 
             PEJABAT_PENETAP_ID, PEJABAT_PENETAP, STLUD, NO_STLUD, 
             TANGGAL_STLUD, NO_NOTA, TANGGAL_NOTA, 
             NO_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK,
             TANGGAL_SK, TMT_PANGKAT, KREDIT, JENIS_KP, KETERANGAN, TANGGAL_UPDATE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER, TEMP_VALIDASI_ID)
          VALUES (
            ".$this->getField("PANGKAT_RIWAYAT_ID").",
            '".$this->getField("PEGAWAI_ID")."',
            ".$this->getField("PANGKAT_ID").",
            ".$this->getField("PEJABAT_PENETAP_ID").",
            '".$this->getField("PEJABAT_PENETAP")."',
            '".$this->getField("STLUD")."',
            '".$this->getField("NO_STLUD")."',
            ".$this->getField("TANGGAL_STLUD").",
            '".$this->getField("NO_NOTA")."',
            ".$this->getField("TANGGAL_NOTA").",
            '".$this->getField("NO_SK")."',
            ".$this->getField("MASA_KERJA_TAHUN").",
            ".$this->getField("MASA_KERJA_BULAN").",
            ".$this->getField("GAJI_POKOK").",
            ".$this->getField("TANGGAL_SK").",
            ".$this->getField("TMT_PANGKAT").",
            ".$this->getField("KREDIT").",
            ".$this->getField("JENIS_KP").",
            '".$this->getField("KETERANGAN")."',
            NOW(),
            '".$this->getField("LAST_CREATE_USER")."',
            ".$this->getField("LAST_CREATE_DATE").",
            '".$this->getField("LAST_CREATE_SATKER")."',
            ".$this->getField("TEMP_VALIDASI_ID")."
          )"; 
      // echo $str;exit;
      $this->query = $str;
      $this->id = $this->getField("PANGKAT_RIWAYAT_ID");
      return $this->execQuery($str);
    }

    function update()
    {
      $str = "
      UPDATE validasi.PANGKAT_RIWAYAT
      SET    
      PANGKAT_ID    = ".$this->getField("PANGKAT_ID").",
      PEJABAT_PENETAP_ID             = ".$this->getField("PEJABAT_PENETAP_ID").",
      PEJABAT_PENETAP             = '".$this->getField("PEJABAT_PENETAP")."',
      STLUD     = '".$this->getField("STLUD")."',
      NO_STLUD    = '".$this->getField("NO_STLUD")."',
      TANGGAL_STLUD    = ".$this->getField("TANGGAL_STLUD").",
      NO_NOTA  = '".$this->getField("NO_NOTA")."',
      TANGGAL_NOTA = ".$this->getField("TANGGAL_NOTA").",
      NO_SK        = '".$this->getField("NO_SK")."',
      MASA_KERJA_TAHUN       = ".$this->getField("MASA_KERJA_TAHUN").",
      MASA_KERJA_BULAN      = ".$this->getField("MASA_KERJA_BULAN").",
      TANGGAL_SK   = ".$this->getField("TANGGAL_SK").",
      TMT_PANGKAT             = ".$this->getField("TMT_PANGKAT").",
      KREDIT             = ".$this->getField("KREDIT").",
      JENIS_KP             = ".$this->getField("JENIS_KP").",
      KETERANGAN             = '".$this->getField("KETERANGAN")."',
      TANGGAL_UPDATE             = NOW(),
      GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
      LAST_UPDATE_USER  = '".$this->getField("LAST_UPDATE_USER")."',
      LAST_UPDATE_DATE  = ".$this->getField("LAST_UPDATE_DATE").",
      LAST_UPDATE_SATKER  = '".$this->getField("LAST_UPDATE_SATKER")."'
      WHERE TEMP_VALIDASI_ID= ".$this->getField("TEMP_VALIDASI_ID")."
      "; 
        // echo $str;exit;
      $this->query = $str;
      return $this->execQuery($str);
    }

     function updateupload($nama,$link)
    {
      $str = "
      UPDATE PANGKAT_RIWAYAT_FILE
      SET    
      PANGKAT_RIWAYAT_FILE_ID= ".$this->getField("PANGKAT_RIWAYAT_FILE_ID").",
      ".$nama."= '".$this->getField($nama)."',
      ".$link."= '".$this->getField($link)."',
      TIPE_FILE= '".$this->getField("TIPE_FILE")."',
      LAST_UPDATE_USER= '".$this->getField("LAST_UPDATE_USER")."',
      LAST_UPDATE_DATE= ".$this->getField("LAST_UPDATE_DATE").",
      LAST_UPDATE_SATKER= '".$this->getField("LAST_UPDATE_SATKER")."'
      WHERE  PANGKAT_RIWAYAT_FILE_ID= '".$this->getField("PANGKAT_RIWAYAT_FILE_ID")."'
      "; 
      $this->query = $str;
      // echo $str;exit;
      return $this->execQuery($str);
    }


    function insertadmin()
    {
      /*Auto-generate primary key(s) by next max value (integer) */
      $this->setField("PANGKAT_RIWAYAT_ID", $this->getNextId("PANGKAT_RIWAYAT_ID","PANGKAT_RIWAYAT")); 
      
      $str = "INSERT INTO PANGKAT_RIWAYAT (
             PANGKAT_RIWAYAT_ID, PEGAWAI_ID, PANGKAT_ID, 
             PEJABAT_PENETAP_ID, PEJABAT_PENETAP, STLUD, NO_STLUD, 
             TANGGAL_STLUD, NO_NOTA, TANGGAL_NOTA, 
             NO_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, GAJI_POKOK,
             TANGGAL_SK, TMT_PANGKAT, KREDIT, JENIS_KP, KETERANGAN, TANGGAL_UPDATE, LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
          VALUES (
            ".$this->getField("PANGKAT_RIWAYAT_ID").",
            '".$this->getField("PEGAWAI_ID")."',
            ".$this->getField("PANGKAT_ID").",
            ".$this->getField("PEJABAT_PENETAP_ID").",
            '".$this->getField("PEJABAT_PENETAP")."',
            '".$this->getField("STLUD")."',
            '".$this->getField("NO_STLUD")."',
            ".$this->getField("TANGGAL_STLUD").",
            '".$this->getField("NO_NOTA")."',
            ".$this->getField("TANGGAL_NOTA").",
            '".$this->getField("NO_SK")."',
            ".$this->getField("MASA_KERJA_TAHUN").",
            ".$this->getField("MASA_KERJA_BULAN").",
            ".$this->getField("GAJI_POKOK").",
            ".$this->getField("TANGGAL_SK").",
            ".$this->getField("TMT_PANGKAT").",
            ".$this->getField("KREDIT").",
            ".$this->getField("JENIS_KP").",
            '".$this->getField("KETERANGAN")."',
            NOW(),
            '".$this->getField("LAST_CREATE_USER")."',
            ".$this->getField("LAST_CREATE_DATE").",
            '".$this->getField("LAST_CREATE_SATKER")."'
          )"; 
      // echo $str;exit;
      $this->query = $str;
      return $this->execQuery($str);
    }

     function insertupload()
    {
        $this->setField("PANGKAT_RIWAYAT_FILE_ID", $this->getNextId("PANGKAT_RIWAYAT_FILE_ID","PANGKAT_RIWAYAT_FILE")); 

        $str = "INSERT INTO PANGKAT_RIWAYAT_FILE(
        PANGKAT_RIWAYAT_FILE_ID,PANGKAT_RIWAYAT_ID, PEGAWAI_ID,  
        NAMA_FILE_SK,NAMA_FILE_STLUD, LINK_FILE_STLUD,LINK_FILE_SK,LAST_CREATE_USER, LAST_CREATE_DATE, LAST_CREATE_SATKER)
        VALUES (
        ".$this->getField("PANGKAT_RIWAYAT_FILE_ID").",
        ".$this->getField("PANGKAT_RIWAYAT_ID").",
        ".$this->getField("PEGAWAI_ID").",
        '".$this->getField("NAMA_FILE_SK")."',
        '".$this->getField("NAMA_FILE_STLUD")."',
        '".$this->getField("LINK_FILE_STLUD")."',
        '".$this->getField("LINK_FILE_SK")."',
        '".$this->getField("LAST_CREATE_USER")."',
        ".$this->getField("LAST_CREATE_DATE").",
        '".$this->getField("LAST_CREATE_SATKER")."'
      )"; 

      $this->query = $str;
      // echo $str;exit;
      return $this->execQuery($str);
    }

    function updateadmin()
    {
      $str = "
      UPDATE PANGKAT_RIWAYAT
      SET    
      PANGKAT_ID    = ".$this->getField("PANGKAT_ID").",
      PEJABAT_PENETAP_ID             = ".$this->getField("PEJABAT_PENETAP_ID").",
      PEJABAT_PENETAP             = '".$this->getField("PEJABAT_PENETAP")."',
      STLUD     = '".$this->getField("STLUD")."',
      NO_STLUD    = '".$this->getField("NO_STLUD")."',
      TANGGAL_STLUD    = ".$this->getField("TANGGAL_STLUD").",
      NO_NOTA  = '".$this->getField("NO_NOTA")."',
      TANGGAL_NOTA = ".$this->getField("TANGGAL_NOTA").",
      NO_SK        = '".$this->getField("NO_SK")."',
      MASA_KERJA_TAHUN       = ".$this->getField("MASA_KERJA_TAHUN").",
      MASA_KERJA_BULAN      = ".$this->getField("MASA_KERJA_BULAN").",
      TANGGAL_SK   = ".$this->getField("TANGGAL_SK").",
      TMT_PANGKAT             = ".$this->getField("TMT_PANGKAT").",
      KREDIT             = ".$this->getField("KREDIT").",
      JENIS_KP             = ".$this->getField("JENIS_KP").",
      KETERANGAN             = '".$this->getField("KETERANGAN")."',
      TANGGAL_UPDATE             = NOW(),
      GAJI_POKOK= ".$this->getField("GAJI_POKOK").",
      LAST_UPDATE_USER  = '".$this->getField("LAST_UPDATE_USER")."',
      LAST_UPDATE_DATE  = ".$this->getField("LAST_UPDATE_DATE").",
      LAST_UPDATE_SATKER  = '".$this->getField("LAST_UPDATE_SATKER")."'
      WHERE PANGKAT_RIWAYAT_ID= ".$this->getField("PANGKAT_RIWAYAT_ID")."
      "; 
        // echo $str;exit;
      $this->query = $str;
      return $this->execQuery($str);
    }

    function delete()
    {
      $str = "DELETE FROM validasi.PANGKAT_RIWAYAT
      WHERE 
      TEMP_VALIDASI_ID= '".$this->getField("TEMP_VALIDASI_ID")."'"; 

      $this->query = $str;
      // echo $str;exit;
      return $this->execQuery($str);
    }

    function deleteadmin()
    {
      $str = "DELETE FROM PANGKAT_RIWAYAT
      WHERE 
      PANGKAT_RIWAYAT_ID= '".$this->getField("PANGKAT_RIWAYAT_ID")."'"; 

      $this->query = $str;
      // echo $str;exit;
      return $this->execQuery($str);
    }

     function deletefile($reqNama,$reqLink,$reqTipe)
    {
      $str = "UPDATE PANGKAT_RIWAYAT_FILE
      SET
      ".$reqNama." = '', 
      ".$reqLink." = '',
      ".$reqTipe." = ''
      WHERE PANGKAT_RIWAYAT_FILE_ID= ".$this->getField("PANGKAT_RIWAYAT_FILE_ID")."
      AND PEGAWAI_ID= ".$this->getField("PEGAWAI_ID")."
      "; 

      $this->query = $str;
    // echo($str);exit;
      return $this->execQuery($str);
    }


    function selectByParams($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
    {
      $str = "
      SELECT 
        PANGKAT_RIWAYAT_ID, PEGAWAI_ID, TEMP_VALIDASI_HAPUS_ID, A.PANGKAT_ID, 
        CASE WHEN PEJABAT_PENETAP IS NULL OR PEJABAT_PENETAP = '' THEN (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID) ELSE PEJABAT_PENETAP END PEJABAT_PENETAP,
        (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
        STLUD, NO_STLUD, 
        TANGGAL_STLUD, NO_NOTA, TANGGAL_NOTA, A.GAJI_POKOK,
        NO_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, 
        TANGGAL_SK, TMT_PANGKAT, KREDIT, JENIS_KP, KETERANGAN,
        C.KODE NMPANGKAT,
        (CASE JENIS_KP WHEN 1 THEN 'Reguler' 
        WHEN 2 THEN 'Pilihan (Jabatan Struktural)'
        WHEN 3 THEN 'Pilihan (Jabatan Fungsional Tertentu)'
        WHEN 4 THEN 'Pilihan (Memperoleh Ijazah/KPPI)'
        WHEN 5 THEN 'Pilihan (Tugas Belajar)'
        WHEN 6 THEN 'Pilihan (Prestasi Luar Biasa)'
        WHEN 7 THEN 'Anumerta' 
        WHEN 8 THEN 'Pengabdian' 
        WHEN 9 THEN 'CPNS' 
        WHEN 10 THEN 'PNS' END) NMJENIS
        ,TEMP_VALIDASI_ID, VALIDASI, VALIDATOR, PERUBAHAN_DATA, TIPE_PERUBAHAN_DATA, TANGGAL_VALIDASI
      FROM validasi.validasi_pegawai_pangkat_riwayat A
      LEFT JOIN PEJABAT_PENETAP B ON A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID 
      LEFT JOIN PANGKAT C ON C.PANGKAT_ID = A.PANGKAT_ID
      WHERE 1 = 1
      "; 

      while(list($key,$val) = each($paramsArray))
      {
        $str .= " AND $key = '$val' ";
      }

      $str .= $statement." ".$sOrder;
      $this->query = $str;

      return $this->selectLimit($str,$limit,$from); 
    }

    function selectByParamsAdmin($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
    {
      $str = "
         SELECT 
        A.PANGKAT_RIWAYAT_ID, A.PEGAWAI_ID, A.PANGKAT_ID, 
        CASE WHEN PEJABAT_PENETAP IS NULL OR PEJABAT_PENETAP = '' THEN (SELECT JABATAN FROM PEJABAT_PENETAP X WHERE X.PEJABAT_PENETAP_ID = A.PEJABAT_PENETAP_ID) ELSE PEJABAT_PENETAP END PEJABAT_PENETAP,
        (CASE A.PEJABAT_PENETAP_ID WHEN NULL THEN (SELECT PEJABAT_PENETAP_ID FROM PEJABAT_PENETAP X WHERE X.JABATAN = PEJABAT_PENETAP) ELSE A.PEJABAT_PENETAP_ID END) PEJABAT_PENETAP_ID, 
        STLUD, NO_STLUD, 
        TANGGAL_STLUD, NO_NOTA, TANGGAL_NOTA, A.GAJI_POKOK,
        NO_SK, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, 
        TANGGAL_SK, TMT_PANGKAT, KREDIT, JENIS_KP, KETERANGAN,
        C.KODE NMPANGKAT,
        (CASE JENIS_KP WHEN 1 THEN 'Reguler' 
        WHEN 2 THEN 'Pilihan (Jabatan Struktural)'
        WHEN 3 THEN 'Pilihan (Jabatan Fungsional Tertentu)'
        WHEN 4 THEN 'Pilihan (Memperoleh Ijazah/KPPI)'
        WHEN 5 THEN 'Pilihan (Tugas Belajar)'
        WHEN 6 THEN 'Pilihan (Prestasi Luar Biasa)'
        WHEN 7 THEN 'Anumerta' 
        WHEN 8 THEN 'Pengabdian' 
        WHEN 9 THEN 'CPNS' 
        WHEN 10 THEN 'PNS' END) NMJENIS
        ,D.PANGKAT_RIWAYAT_FILE_ID
        ,D.LINK_FILE_SK
        ,D.LINK_FILE_STLUD
      FROM PANGKAT_RIWAYAT A
      LEFT JOIN PEJABAT_PENETAP B ON A.PEJABAT_PENETAP_ID = B.PEJABAT_PENETAP_ID 
      LEFT JOIN PANGKAT C ON C.PANGKAT_ID = A.PANGKAT_ID
      LEFT JOIN PANGKAT_RIWAYAT_FILE D ON D.PANGKAT_RIWAYAT_ID = A.PANGKAT_RIWAYAT_ID
      WHERE 1 = 1
      "; 

      while(list($key,$val) = each($paramsArray))
      {
        $str .= " AND $key = '$val' ";
      }

      $str .= $statement." ".$sOrder;
      $this->query = $str;

      return $this->selectLimit($str,$limit,$from); 
    }

     function selectByParamsCheckPegawai($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
    {
      $str = "
      SELECT A.PEGAWAI_ID,A.NIP_BARU 
      FROM PEGAWAI A
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

    function selectByParamsUpload($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY PANGKAT_RIWAYAT_FILE_ID")
    {
      $str = "
      SELECT A.PANGKAT_RIWAYAT_FILE_ID,A.PEGAWAI_ID, 
      A.NAMA_FILE_SK,A.NAMA_FILE_STLUD ,A.LINK_FILE_SK
      ,A.LINK_FILE_STLUD
      , A.TIPE_FILE
      FROM PANGKAT_RIWAYAT_FILE A
      INNER JOIN PANGKAT_RIWAYAT B ON A.PANGKAT_RIWAYAT_ID = B.PANGKAT_RIWAYAT_ID
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

    function selectByParamsServer($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder=" ORDER BY LINK_SERVER_ID")
    {
      $str = "
      SELECT LINK_SERVER_ID, LINK_SERVER, FOLDER, JENIS
      FROM LINK_SERVER
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
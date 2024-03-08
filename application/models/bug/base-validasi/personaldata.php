<? 
  include_once(APPPATH.'/models/Entity.php');

  class PersonalData extends Entity{ 

    var $query;
    function PersonalData()
    {
      $this->Entity(); 
    }

    function selectByParamsPangkat($paramsArray=array(),$limit=-1,$from=-1, $statement='', $sOrder="")
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

  } 
?>
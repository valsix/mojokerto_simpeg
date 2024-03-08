<? 
include_once(APPPATH.'/models/Entity.php');

class Pegawai extends Entity{ 

	var $query;

	function Pegawai()
	{
		$this->Entity(); 
	}

	function selectByParamsMonitoring2($paramsArray=array(),$limit=-1,$from=-1, $statement='', $orderby='')
	{
		/*TO_CHAR(B.TMT_PANGKAT, 'DD MON YYYY') TMT_PANGKAT,
		TO_CHAR(C.TMT_JABATAN, 'DD MON YYYY') TMT_JABATAN,
		TO_CHAR(TANGGAL_LAHIR, 'DD MON YYYY') TANGGAL_LAHIR, */
		$str = "
      SELECT
	  	HUKUMAN_STATUS(cast (A.PEGAWAI_ID as int)) HUKUMAN_STATUS_TERAKHIR,
	  	AMBIL_SATKER_NAMA_DELIMETER(cast (A.SATKER_ID as varchar), '<br>') SATKER_NAMA_MONITORING,
		AMBIL_SATKER_INDUK(A.SATKER_ID) SATKERINDUK,
	  	SUBSTRING(cast(C.ESELON_ID as varchar), 0,1) STATUS_ESELON, A.KARTU_PEGAWAI, A.TASPEN,
		CASE
			WHEN current_date <= G.TANGGAL_AKHIR AND current_date >= G.TANGGAL_MULAI
			THEN 1
			ELSE 0
		END STATUS_BERLAKU,  
		C.ESELON_ID, A.PEGAWAI_ID, NIP_LAMA, AMBIL_FORMAT_NIP_BARU(NIP_BARU) NIP_BARU, (CASE WHEN GELAR_DEPAN IS NULL THEN '' ELSE GELAR_DEPAN || '. ' END) || A.NAMA || (CASE WHEN GELAR_BELAKANG IS NULL THEN '' ELSE  ', ' || GELAR_BELAKANG END) NAMA, 
			  A.TIPE_PEGAWAI_ID, Y.USIA_TAHUN, NIP_BARU NIP_BARU_CARI, GELAR_DEPAN, GELAR_BELAKANG,
								TEMPAT_LAHIR, JENIS_KELAMIN, 
								(SELECT NAMA FROM STATUS_PEGAWAI X WHERE X.STATUS_PEGAWAI_ID = A.STATUS_PEGAWAI) STATUS_PEGAWAI,
								B.GOL_RUANG,
                                B.MASA_KERJA_TAHUN, B.MASA_KERJA_BULAN,
								B.KREDIT,
								CASE
                            WHEN B.PANGKAT_ID = 14 THEN (SELECT PG.KODE FROM PANGKAT PG WHERE PG.PANGKAT_ID = 21)
                            WHEN B.PANGKAT_ID = 24 THEN (SELECT PG.KODE FROM PANGKAT PG WHERE PG.PANGKAT_ID = 31)
                            WHEN B.PANGKAT_ID = 34 THEN (SELECT PG.KODE FROM PANGKAT PG WHERE PG.PANGKAT_ID = 41)
                            WHEN B.PANGKAT_ID = 45 THEN (SELECT PG.KODE FROM PANGKAT PG WHERE PG.PANGKAT_ID = 45)
                            ELSE (SELECT KODE FROM PANGKAT PG WHERE PG.PANGKAT_ID = B.PANGKAT_ID + 1)
                          END GOL_RUANG_BARU,
						  CASE
                            WHEN B.PANGKAT_ID = 14 THEN 21
                            WHEN B.PANGKAT_ID = 24 THEN 31
                            WHEN B.PANGKAT_ID = 34 THEN 41
                            WHEN B.PANGKAT_ID = 45 THEN 45
                            ELSE B.PANGKAT_ID + 1
                          END PANGKAT_ID_BARU,
								C.ESELON,
								C.JABATAN,
								F.PENDIDIKAN_RIWAYAT_ID,
								B.PANGKAT_RIWAYAT_ID,
								B.TMT_PANGKAT,
								C.TMT_JABATAN,
								C.TUNJANGAN, C.KREDIT KREDIT_JABATAN,
								TANGGAL_LAHIR, 
								D.NAMA AGAMA,
								A.TELEPON,
								A.ALAMAT,
								E.NAMA SATKER,
								CASE 
                                WHEN A.TIPE_PEGAWAI_ID = '11' AND ( SUBSTRING(cast (C.ESELON_ID as varchar),1,1) = '1' OR SUBSTRING(cast (C.ESELON_ID as varchar),1,1) = '2' ) THEN 
                                '01-' || TO_CHAR(ADD_MONTHS(TANGGAL_LAHIR, (60 * 12) + 1),  'MM-YYYY')
                                WHEN A.TIPE_PEGAWAI_ID = '21' OR ( A.TIPE_PEGAWAI_ID = '22' AND UPPER(C.JABATAN) LIKE '%DOKTER%' )  THEN 
                                '01-' || TO_CHAR(ADD_MONTHS(TANGGAL_LAHIR, (60 * 12) + 1),  'MM-YYYY')
                                ELSE
                                '01-' || TO_CHAR(ADD_MONTHS(TANGGAL_LAHIR, (58 * 12) + 1),  'MM-YYYY')
                                END TMT_PENSIUN,
								PENDIDIKAN, PENDIDIKAN_ID, NMJURUSAN, NO_STTB, NAMA_SEKOLAH, KEPALA, TEMPAT, TANGGAL_STTB,
								LULUS, CASE WHEN A.PEGAWAI_ID = E.PEGAWAI_ID THEN E.SATKER_ID ELSE 'A' END PEGAWAI_PEJABAT, A.SATKER_ID,Z.TMT_JABATAN_AKHIR,Z.JABATAN_TAMBAHAN_NAMA,A.TUGAS_TAMBAHAN_NEW,MP.NAMA JENIS_MAPEL
						FROM PEGAWAI A  
							 LEFT JOIN (SELECT PANGKAT_RIWAYAT_ID, MASA_KERJA_TAHUN, MASA_KERJA_BULAN, TMT_PANGKAT, GOL_RUANG, PEGAWAI_ID, PANGKAT_ID, KREDIT FROM PANGKAT_TERAKHIR) B ON A.PEGAWAI_ID = B.PEGAWAI_ID
							 LEFT JOIN (SELECT PEGAWAI_ID, TMT_JABATAN, ESELON, JABATAN, TUNJANGAN, KREDIT, coalesce(ESELON_ID, 99) ESELON_ID FROM JABATAN_TERAKHIR) C ON cast (A.PEGAWAI_ID as varchar) = C.PEGAWAI_ID
							 LEFT JOIN AGAMA D ON  A.AGAMA_ID = D.AGAMA_ID
							 LEFT JOIN JENIS_MAPEL MP ON  MP.JENIS_MAPEL_ID = A.JENIS_MAPEL_ID
							 LEFT JOIN (SELECT PEGAWAI_ID, TANGGAL_MULAI, TANGGAL_AKHIR FROM HUKUMAN_TERAKHIR X) G ON A.PEGAWAI_ID = G.PEGAWAI_ID
							 LEFT JOIN (SELECT COUNT(1) JUMLAH_HUKUMAN, PEGAWAI_ID FROM HUKUMAN GROUP BY PEGAWAI_ID) H ON A.PEGAWAI_ID = H.PEGAWAI_ID
							 LEFT JOIN 
                		     (   
                                    SELECT A.PEGAWAI_ID, A.NAMA JABATAN_TAMBAHAN_NAMA, TMT_JABATAN_AKHIR
                    				    FROM JABATAN_TAMBAHAN A        
                                    INNER JOIN 
                    			    (
                    				    SELECT A.PEGAWAI_ID, MAX (A.TMT_JABATAN) TMT_JABATAN_AKHIR
                    				    FROM JABATAN_TAMBAHAN A
                    				    GROUP BY A.PEGAWAI_ID
                    			    ) B ON B.PEGAWAI_ID  = A.PEGAWAI_ID AND A.TMT_JABATAN = B.TMT_JABATAN_AKHIR
                             ) Z ON Z.PEGAWAI_ID = A.PEGAWAI_ID  AND A.TUGAS_TAMBAHAN_NEW IS NOT NULL
							 LEFT JOIN (SELECT PENDIDIKAN_RIWAYAT_ID, PEGAWAI_ID, TAHUN LULUS, PENDIDIKAN, PENDIDIKAN_ID, NMJURUSAN, NO_STTB, NAMA_SEKOLAH, KEPALA, TEMPAT, TANGGAL_STTB FROM PENDIDIKAN_TERAKHIR X) F ON A.PEGAWAI_ID = F.PEGAWAI_ID,
							 SATKER E,
							 (
							 SELECT PEGAWAI_ID,
							 CASE WHEN ( cast(TO_CHAR(current_date, 'MM') as int)-cast(TO_CHAR(TANGGAL_LAHIR, 'MM') as int ))<0 THEN 
								cast(TO_CHAR(current_date, 'YYYY') as int )-cast(TO_CHAR(TANGGAL_LAHIR, 'YYYY')as int)-1
								ELSE cast(TO_CHAR(current_date, 'YYYY') as int)-cast(TO_CHAR(TANGGAL_LAHIR, 'YYYY') as int) END USIA_TAHUN
							 FROM PEGAWAI
							 ) Y
							 
						WHERE                     
							 A.SATKER_ID = E.SATKER_ID
							 AND A.PEGAWAI_ID = Y.PEGAWAI_ID
	 				"; 
		
		while(list($key,$val) = each($paramsArray))
		{
			$str .= " AND $key = '$val' ";
		}
		
		
		$str .= $statement." ".$orderby;
		$this->query = $str;
		//echo $str;
				
		return $this->selectLimit($str,$limit,$from); 
    }
} 
?>
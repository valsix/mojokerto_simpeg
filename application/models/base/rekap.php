<? 
include_once(APPPATH.'/models/Entity.php');

class Rekap extends Entity{ 

	var $query;

	function Rekap()
	{
		$this->Entity(); 
	}

	function selectByParamsBkppRekapGolongan($paramsArray=array(),$limit=-1,$from=-1, $statement='')
	{
		$str = "
				SELECT A.SATKER_ID, A.NAMA, TOTCPNS_11, TOTCPNS_12, TOTCPNS_13
                  , TOTCPNS_21, TOTCPNS_22, TOTCPNS_23
                  , TOTCPNS_31, TOTCPNS_32, TOTCPNS 
                  , TOT_11, TOT_12, TOT_13, TOT_14, TOT_GOL1
                  , TOT_21, TOT_22, TOT_23, TOT_24, TOT_GOL2
                  , TOT_31, TOT_32, TOT_33, TOT_34, TOT_GOL3
                  , TOT_41, TOT_42, TOT_43, TOT_44, TOT_GOL4,  TOT
				FROM
				(                  
						SELECT A.SATKER_ID, A.NAMA, COUNT(TOTCPNS_11.PEGAWAI_ID) AS TOTCPNS_11, COUNT(TOTCPNS_12.PEGAWAI_ID) AS TOTCPNS_12, COUNT(TOTCPNS_13.PEGAWAI_ID) AS TOTCPNS_13
								  , COUNT(TOTCPNS_21.PEGAWAI_ID) AS TOTCPNS_21, COUNT(TOTCPNS_22.PEGAWAI_ID) AS TOTCPNS_22, COUNT(TOTCPNS_23.PEGAWAI_ID) AS TOTCPNS_23
								  , COUNT(TOTCPNS_31.PEGAWAI_ID) AS TOTCPNS_31, COUNT(TOTCPNS_32.PEGAWAI_ID) AS TOTCPNS_32, COUNT(TOTCPNS.PEGAWAI_ID) AS TOTCPNS 
								  , COUNT(TOT_11.PEGAWAI_ID) AS TOT_11, COUNT(TOT_12.PEGAWAI_ID) AS TOT_12, COUNT(TOT_13.PEGAWAI_ID) AS TOT_13, COUNT(TOT_14.PEGAWAI_ID) AS TOT_14, COUNT(TOT_GOL1.PEGAWAI_ID) AS TOT_GOL1
								  , COUNT(TOT_21.PEGAWAI_ID) AS TOT_21, COUNT(TOT_22.PEGAWAI_ID) AS TOT_22, COUNT(TOT_23.PEGAWAI_ID) AS TOT_23, COUNT(TOT_24.PEGAWAI_ID) AS TOT_24, COUNT(TOT_GOL2.PEGAWAI_ID) AS TOT_GOL2
								  , COUNT(TOT_31.PEGAWAI_ID) AS TOT_31, COUNT(TOT_32.PEGAWAI_ID) AS TOT_32, COUNT(TOT_33.PEGAWAI_ID) AS TOT_33, COUNT(TOT_34.PEGAWAI_ID) AS TOT_34, COUNT(TOT_GOL3.PEGAWAI_ID) AS TOT_GOL3
								  , COUNT(TOT_41.PEGAWAI_ID) AS TOT_41, COUNT(TOT_42.PEGAWAI_ID) AS TOT_42, COUNT(TOT_43.PEGAWAI_ID) AS TOT_43, COUNT(TOT_44.PEGAWAI_ID) AS TOT_44, COUNT(TOT_GOL4.PEGAWAI_ID) AS TOT_GOL4,  COUNT(TOT.PEGAWAI_ID) AS TOT  
						FROM SATKER A 
						LEFT JOIN PEGAWAI B ON B.SATKER_ID LIKE A.SATKER_ID || '%'
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 11 AND X.STATUS_PEGAWAI = 1) TOTCPNS_11 ON TOTCPNS_11.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 12 AND X.STATUS_PEGAWAI = 1) TOTCPNS_12 ON TOTCPNS_12.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 13 AND X.STATUS_PEGAWAI = 1) TOTCPNS_13 ON TOTCPNS_13.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 21 AND X.STATUS_PEGAWAI = 1) TOTCPNS_21 ON TOTCPNS_21.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 22 AND X.STATUS_PEGAWAI = 1) TOTCPNS_22 ON TOTCPNS_22.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 23 AND X.STATUS_PEGAWAI = 1) TOTCPNS_23 ON TOTCPNS_23.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 31 AND X.STATUS_PEGAWAI = 1) TOTCPNS_31 ON TOTCPNS_31.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 32 AND X.STATUS_PEGAWAI = 1) TOTCPNS_32 ON TOTCPNS_32.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID >= 11 AND Y.PANGKAT_ID  <= 32  AND X.STATUS_PEGAWAI = 1) TOTCPNS ON TOTCPNS.PEGAWAI_ID = B.PEGAWAI_ID  
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 11 AND X.STATUS_PEGAWAI = 2) TOT_11 ON TOT_11.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 12 AND X.STATUS_PEGAWAI = 2) TOT_12 ON TOT_12.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 13 AND X.STATUS_PEGAWAI = 2) TOT_13 ON TOT_13.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 14 AND X.STATUS_PEGAWAI = 2) TOT_14 ON TOT_14.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID <= 14 AND X.STATUS_PEGAWAI = 2) TOT_GOL1 ON TOT_GOL1.PEGAWAI_ID = B.PEGAWAI_ID    
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 21 AND X.STATUS_PEGAWAI = 2) TOT_21 ON TOT_21.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 22 AND X.STATUS_PEGAWAI = 2) TOT_22 ON TOT_22.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 23 AND X.STATUS_PEGAWAI = 2) TOT_23 ON TOT_23.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 24 AND X.STATUS_PEGAWAI = 2) TOT_24 ON TOT_24.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID >= 21 AND Y.PANGKAT_ID <=24 AND X.STATUS_PEGAWAI = 2) TOT_GOL2 ON TOT_GOL2.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 31 AND X.STATUS_PEGAWAI = 2) TOT_31 ON TOT_31.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 32 AND X.STATUS_PEGAWAI = 2) TOT_32 ON TOT_32.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 33 AND X.STATUS_PEGAWAI = 2) TOT_33 ON TOT_33.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 34 AND X.STATUS_PEGAWAI = 2) TOT_34 ON TOT_34.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID >= 31 AND Y.PANGKAT_ID <=34  AND X.STATUS_PEGAWAI = 2) TOT_GOL3 ON TOT_GOL3.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 41 AND X.STATUS_PEGAWAI = 2) TOT_41 ON TOT_41.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 42 AND X.STATUS_PEGAWAI = 2) TOT_42 ON TOT_42.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 43 AND X.STATUS_PEGAWAI = 2) TOT_43 ON TOT_43.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 44 AND X.STATUS_PEGAWAI = 2) TOT_44 ON TOT_44.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID >= 41 AND Y.PANGKAT_ID <=44  AND X.STATUS_PEGAWAI = 2) TOT_GOL4 ON TOT_GOL4.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE  X.STATUS_PEGAWAI IN(1, 2)) TOT ON TOT.PEGAWAI_ID = B.PEGAWAI_ID
						WHERE 1=1 AND A.SATKER_ID = '01' AND LENGTH(B.SATKER_ID) <= 4
						GROUP BY A.SATKER_ID, A.NAMA
						UNION ALL
						SELECT A.SATKER_ID, A.NAMA, COUNT(TOTCPNS_11.PEGAWAI_ID) AS TOTCPNS_11, COUNT(TOTCPNS_12.PEGAWAI_ID) AS TOTCPNS_12, COUNT(TOTCPNS_13.PEGAWAI_ID) AS TOTCPNS_13
								  , COUNT(TOTCPNS_21.PEGAWAI_ID) AS TOTCPNS_21, COUNT(TOTCPNS_22.PEGAWAI_ID) AS TOTCPNS_22, COUNT(TOTCPNS_23.PEGAWAI_ID) AS TOTCPNS_23
								  , COUNT(TOTCPNS_31.PEGAWAI_ID) AS TOTCPNS_31, COUNT(TOTCPNS_32.PEGAWAI_ID) AS TOTCPNS_32, COUNT(TOTCPNS.PEGAWAI_ID) AS TOTCPNS 
								  , COUNT(TOT_11.PEGAWAI_ID) AS TOT_11, COUNT(TOT_12.PEGAWAI_ID) AS TOT_12, COUNT(TOT_13.PEGAWAI_ID) AS TOT_13, COUNT(TOT_14.PEGAWAI_ID) AS TOT_14, COUNT(TOT_GOL1.PEGAWAI_ID) AS TOT_GOL1
								  , COUNT(TOT_21.PEGAWAI_ID) AS TOT_21, COUNT(TOT_22.PEGAWAI_ID) AS TOT_22, COUNT(TOT_23.PEGAWAI_ID) AS TOT_23, COUNT(TOT_24.PEGAWAI_ID) AS TOT_24, COUNT(TOT_GOL2.PEGAWAI_ID) AS TOT_GOL2
								  , COUNT(TOT_31.PEGAWAI_ID) AS TOT_31, COUNT(TOT_32.PEGAWAI_ID) AS TOT_32, COUNT(TOT_33.PEGAWAI_ID) AS TOT_33, COUNT(TOT_34.PEGAWAI_ID) AS TOT_34, COUNT(TOT_GOL3.PEGAWAI_ID) AS TOT_GOL3
								  , COUNT(TOT_41.PEGAWAI_ID) AS TOT_41, COUNT(TOT_42.PEGAWAI_ID) AS TOT_42, COUNT(TOT_43.PEGAWAI_ID) AS TOT_43, COUNT(TOT_44.PEGAWAI_ID) AS TOT_44, COUNT(TOT_GOL4.PEGAWAI_ID) AS TOT_GOL4,  COUNT(TOT.PEGAWAI_ID) AS TOT  
						FROM SATKER A 
						LEFT JOIN PEGAWAI B ON B.SATKER_ID LIKE A.SATKER_ID || '%'
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 11 AND X.STATUS_PEGAWAI = 1) TOTCPNS_11 ON TOTCPNS_11.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 12 AND X.STATUS_PEGAWAI = 1) TOTCPNS_12 ON TOTCPNS_12.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 13 AND X.STATUS_PEGAWAI = 1) TOTCPNS_13 ON TOTCPNS_13.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 21 AND X.STATUS_PEGAWAI = 1) TOTCPNS_21 ON TOTCPNS_21.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 22 AND X.STATUS_PEGAWAI = 1) TOTCPNS_22 ON TOTCPNS_22.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 23 AND X.STATUS_PEGAWAI = 1) TOTCPNS_23 ON TOTCPNS_23.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 31 AND X.STATUS_PEGAWAI = 1) TOTCPNS_31 ON TOTCPNS_31.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 32 AND X.STATUS_PEGAWAI = 1) TOTCPNS_32 ON TOTCPNS_32.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID >= 11 AND Y.PANGKAT_ID  <= 32  AND X.STATUS_PEGAWAI = 1) TOTCPNS ON TOTCPNS.PEGAWAI_ID = B.PEGAWAI_ID  
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 11 AND X.STATUS_PEGAWAI = 2) TOT_11 ON TOT_11.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 12 AND X.STATUS_PEGAWAI = 2) TOT_12 ON TOT_12.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 13 AND X.STATUS_PEGAWAI = 2) TOT_13 ON TOT_13.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 14 AND X.STATUS_PEGAWAI = 2) TOT_14 ON TOT_14.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID <= 14 AND X.STATUS_PEGAWAI = 2) TOT_GOL1 ON TOT_GOL1.PEGAWAI_ID = B.PEGAWAI_ID    
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 21 AND X.STATUS_PEGAWAI = 2) TOT_21 ON TOT_21.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 22 AND X.STATUS_PEGAWAI = 2) TOT_22 ON TOT_22.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 23 AND X.STATUS_PEGAWAI = 2) TOT_23 ON TOT_23.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 24 AND X.STATUS_PEGAWAI = 2) TOT_24 ON TOT_24.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID >= 21 AND Y.PANGKAT_ID <=24 AND X.STATUS_PEGAWAI = 2) TOT_GOL2 ON TOT_GOL2.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 31 AND X.STATUS_PEGAWAI = 2) TOT_31 ON TOT_31.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 32 AND X.STATUS_PEGAWAI = 2) TOT_32 ON TOT_32.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 33 AND X.STATUS_PEGAWAI = 2) TOT_33 ON TOT_33.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 34 AND X.STATUS_PEGAWAI = 2) TOT_34 ON TOT_34.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID >= 31 AND Y.PANGKAT_ID <=34  AND X.STATUS_PEGAWAI = 2) TOT_GOL3 ON TOT_GOL3.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 41 AND X.STATUS_PEGAWAI = 2) TOT_41 ON TOT_41.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 42 AND X.STATUS_PEGAWAI = 2) TOT_42 ON TOT_42.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 43 AND X.STATUS_PEGAWAI = 2) TOT_43 ON TOT_43.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 44 AND X.STATUS_PEGAWAI = 2) TOT_44 ON TOT_44.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID >= 41 AND Y.PANGKAT_ID <=44  AND X.STATUS_PEGAWAI = 2) TOT_GOL4 ON TOT_GOL4.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE  X.STATUS_PEGAWAI IN(1, 2)) TOT ON TOT.PEGAWAI_ID = B.PEGAWAI_ID
						WHERE 1=1 AND B.STATUS_PEGAWAI IN(1, 2) AND A.SATKER_ID IN ('010101','010102','010103','010201','010202','010203','010301','010302','010303','010304')
						GROUP BY A.SATKER_ID, A.NAMA
						UNION ALL
						SELECT A.SATKER_ID, A.NAMA, COUNT(TOTCPNS_11.PEGAWAI_ID) AS TOTCPNS_11, COUNT(TOTCPNS_12.PEGAWAI_ID) AS TOTCPNS_12, COUNT(TOTCPNS_13.PEGAWAI_ID) AS TOTCPNS_13
								  , COUNT(TOTCPNS_21.PEGAWAI_ID) AS TOTCPNS_21, COUNT(TOTCPNS_22.PEGAWAI_ID) AS TOTCPNS_22, COUNT(TOTCPNS_23.PEGAWAI_ID) AS TOTCPNS_23
								  , COUNT(TOTCPNS_31.PEGAWAI_ID) AS TOTCPNS_31, COUNT(TOTCPNS_32.PEGAWAI_ID) AS TOTCPNS_32, COUNT(TOTCPNS.PEGAWAI_ID) AS TOTCPNS 
								  , COUNT(TOT_11.PEGAWAI_ID) AS TOT_11, COUNT(TOT_12.PEGAWAI_ID) AS TOT_12, COUNT(TOT_13.PEGAWAI_ID) AS TOT_13, COUNT(TOT_14.PEGAWAI_ID) AS TOT_14, COUNT(TOT_GOL1.PEGAWAI_ID) AS TOT_GOL1
								  , COUNT(TOT_21.PEGAWAI_ID) AS TOT_21, COUNT(TOT_22.PEGAWAI_ID) AS TOT_22, COUNT(TOT_23.PEGAWAI_ID) AS TOT_23, COUNT(TOT_24.PEGAWAI_ID) AS TOT_24, COUNT(TOT_GOL2.PEGAWAI_ID) AS TOT_GOL2
								  , COUNT(TOT_31.PEGAWAI_ID) AS TOT_31, COUNT(TOT_32.PEGAWAI_ID) AS TOT_32, COUNT(TOT_33.PEGAWAI_ID) AS TOT_33, COUNT(TOT_34.PEGAWAI_ID) AS TOT_34, COUNT(TOT_GOL3.PEGAWAI_ID) AS TOT_GOL3
								  , COUNT(TOT_41.PEGAWAI_ID) AS TOT_41, COUNT(TOT_42.PEGAWAI_ID) AS TOT_42, COUNT(TOT_43.PEGAWAI_ID) AS TOT_43, COUNT(TOT_44.PEGAWAI_ID) AS TOT_44, COUNT(TOT_GOL4.PEGAWAI_ID) AS TOT_GOL4,  COUNT(TOT.PEGAWAI_ID) AS TOT  
						FROM SATKER A 
						LEFT JOIN PEGAWAI B ON B.SATKER_ID LIKE A.SATKER_ID || '%'
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 11 AND X.STATUS_PEGAWAI = 1) TOTCPNS_11 ON TOTCPNS_11.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 12 AND X.STATUS_PEGAWAI = 1) TOTCPNS_12 ON TOTCPNS_12.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 13 AND X.STATUS_PEGAWAI = 1) TOTCPNS_13 ON TOTCPNS_13.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 21 AND X.STATUS_PEGAWAI = 1) TOTCPNS_21 ON TOTCPNS_21.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 22 AND X.STATUS_PEGAWAI = 1) TOTCPNS_22 ON TOTCPNS_22.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 23 AND X.STATUS_PEGAWAI = 1) TOTCPNS_23 ON TOTCPNS_23.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 31 AND X.STATUS_PEGAWAI = 1) TOTCPNS_31 ON TOTCPNS_31.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 32 AND X.STATUS_PEGAWAI = 1) TOTCPNS_32 ON TOTCPNS_32.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID >= 11 AND Y.PANGKAT_ID  <= 32  AND X.STATUS_PEGAWAI = 1) TOTCPNS ON TOTCPNS.PEGAWAI_ID = B.PEGAWAI_ID  
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 11 AND X.STATUS_PEGAWAI = 2) TOT_11 ON TOT_11.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 12 AND X.STATUS_PEGAWAI = 2) TOT_12 ON TOT_12.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 13 AND X.STATUS_PEGAWAI = 2) TOT_13 ON TOT_13.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 14 AND X.STATUS_PEGAWAI = 2) TOT_14 ON TOT_14.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID <= 14 AND X.STATUS_PEGAWAI = 2) TOT_GOL1 ON TOT_GOL1.PEGAWAI_ID = B.PEGAWAI_ID    
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 21 AND X.STATUS_PEGAWAI = 2) TOT_21 ON TOT_21.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 22 AND X.STATUS_PEGAWAI = 2) TOT_22 ON TOT_22.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 23 AND X.STATUS_PEGAWAI = 2) TOT_23 ON TOT_23.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 24 AND X.STATUS_PEGAWAI = 2) TOT_24 ON TOT_24.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID >= 21 AND Y.PANGKAT_ID <=24 AND X.STATUS_PEGAWAI = 2) TOT_GOL2 ON TOT_GOL2.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 31 AND X.STATUS_PEGAWAI = 2) TOT_31 ON TOT_31.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 32 AND X.STATUS_PEGAWAI = 2) TOT_32 ON TOT_32.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 33 AND X.STATUS_PEGAWAI = 2) TOT_33 ON TOT_33.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 34 AND X.STATUS_PEGAWAI = 2) TOT_34 ON TOT_34.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID >= 31 AND Y.PANGKAT_ID <=34  AND X.STATUS_PEGAWAI = 2) TOT_GOL3 ON TOT_GOL3.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 41 AND X.STATUS_PEGAWAI = 2) TOT_41 ON TOT_41.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 42 AND X.STATUS_PEGAWAI = 2) TOT_42 ON TOT_42.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 43 AND X.STATUS_PEGAWAI = 2) TOT_43 ON TOT_43.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID = 44 AND X.STATUS_PEGAWAI = 2) TOT_44 ON TOT_44.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X LEFT JOIN PANGKAT_TERAKHIR Y ON X.PEGAWAI_ID = Y.PEGAWAI_ID WHERE Y.PANGKAT_ID >= 41 AND Y.PANGKAT_ID <=44  AND X.STATUS_PEGAWAI = 2) TOT_GOL4 ON TOT_GOL4.PEGAWAI_ID = B.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE  X.STATUS_PEGAWAI IN(1, 2)) TOT ON TOT.PEGAWAI_ID = B.PEGAWAI_ID
						WHERE 1=1 AND B.STATUS_PEGAWAI IN(1, 2) AND A.SATKER_ID_PARENT = '0' AND A.SATKER_ID NOT IN ('01')           
						GROUP BY A.SATKER_ID, A.NAMA
				) A
				WHERE 1=1
		"; 
		$str .= $statement." ORDER BY A.SATKER_ID ";
		$this->query = $str;
		
		return $this->selectLimit($str,-1,-1); 
    }

    function selectByParamsReportTribulanAll($paramsArray=array(),$limit=-1,$from=-1,$statement_satker='', $statement='')
	{
		$str = "
		   		SELECT  PK.PANGKAT_ID, PK.KODE, COUNT(TOT_ALL.PEGAWAI_ID) TOTAL, COUNT(TOT_L.PEGAWAI_ID) AS TOTAL_LAKI, COUNT(TOT_P.PEGAWAI_ID) AS TOTAL_WANITA, COUNT(TOT_JK.PEGAWAI_ID) AS TOTAL_KELAMIN,
						 COUNT(TOT_SK.PEGAWAI_ID) AS SUDAH_KAWIN, COUNT(TOT_BK.PEGAWAI_ID) AS BELUM_KAWIN, COUNT(TOT_JD.PEGAWAI_ID) AS JANDA, COUNT(TOT_DD.PEGAWAI_ID) AS DUDA,  COUNT(TOT_KW.PEGAWAI_ID)  AS TOTAL_KAWIN,
							 COUNT(TOT_IS.PEGAWAI_ID) AS ISLAM, COUNT(TOT_KR.PEGAWAI_ID) AS KRISTEN, COUNT(TOT_KA.PEGAWAI_ID) AS KATOLIK, COUNT(TOT_HD.PEGAWAI_ID) AS HINDU,  COUNT(TOT_BD.PEGAWAI_ID)  AS BUDHA, COUNT(TOT_AG.PEGAWAI_ID)  AS AGAMA,
						 COUNT(TOT_SD.PEGAWAI_ID) AS SD, COUNT(TOT_SMP.PEGAWAI_ID) AS SMP, COUNT(TOT_SMA.PEGAWAI_ID) AS SMA, COUNT(TOT_D1.PEGAWAI_ID) AS D1, COUNT(TOT_D2.PEGAWAI_ID) AS D2, COUNT(TOT_D3.PEGAWAI_ID) AS D3, COUNT(TOT_D4.PEGAWAI_ID) AS D4, COUNT(TOT_S1.PEGAWAI_ID) AS S1, COUNT(TOT_S2.PEGAWAI_ID) AS S2, COUNT(TOT_S3.PEGAWAI_ID) AS S3, COUNT(TOT_DIK.PEGAWAI_ID) AS SEKOLAH
				FROM PANGKAT PK
					   LEFT JOIN PANGKAT_TERAKHIR B ON PK.PANGKAT_ID = B.PANGKAT_ID ".$statement."
						 LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_ALL ON B.PEGAWAI_ID = TOT_ALL.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE X.JENIS_KELAMIN = 'L' AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_L ON B.PEGAWAI_ID = TOT_L.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE X.JENIS_KELAMIN = 'P' AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_P ON B.PEGAWAI_ID = TOT_P.PEGAWAI_ID
						 LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE X.JENIS_KELAMIN IN( 'L','P') AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_JK ON B.PEGAWAI_ID = TOT_JK.PEGAWAI_ID
						 LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X  WHERE  X.STATUS_KAWIN = 1 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_BK ON B.PEGAWAI_ID = TOT_BK.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X  WHERE  X.STATUS_KAWIN = 2 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_SK ON B.PEGAWAI_ID = TOT_SK.PEGAWAI_ID 
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X  WHERE  X.STATUS_KAWIN = 3 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_JD ON B.PEGAWAI_ID = TOT_JD.PEGAWAI_ID  
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE  X.STATUS_KAWIN = 4 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_DD ON B.PEGAWAI_ID = TOT_DD.PEGAWAI_ID
						 LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE  X.STATUS_KAWIN <=4 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_KW ON B.PEGAWAI_ID = TOT_KW.PEGAWAI_ID        
						  LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE  X.AGAMA_ID = 1 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_IS ON B.PEGAWAI_ID = TOT_IS.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE  X.AGAMA_ID = 2 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_KR ON B.PEGAWAI_ID = TOT_KR.PEGAWAI_ID 
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE  X.AGAMA_ID = 3 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_KA ON B.PEGAWAI_ID = TOT_KA.PEGAWAI_ID  
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE  X.AGAMA_ID = 4 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_HD ON B.PEGAWAI_ID = TOT_HD.PEGAWAI_ID
						 LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE  X.AGAMA_ID = 5 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_BD ON B.PEGAWAI_ID = TOT_BD.PEGAWAI_ID   
						  LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PEGAWAI X WHERE  X.AGAMA_ID <= 5 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_AG ON B.PEGAWAI_ID = TOT_AG.PEGAWAI_ID 
						  LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PENDIDIKAN_TERAKHIR Y LEFT JOIN PEGAWAI X ON X.PEGAWAI_ID = Y.PEGAWAI_ID  WHERE  Y.PENDIDIKAN_ID = 1 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_SD ON B.PEGAWAI_ID = TOT_SD.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PENDIDIKAN_TERAKHIR Y LEFT JOIN PEGAWAI X ON X.PEGAWAI_ID = Y.PEGAWAI_ID  WHERE  Y.PENDIDIKAN_ID = 2 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_SMP ON B.PEGAWAI_ID = TOT_SMP.PEGAWAI_ID 
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PENDIDIKAN_TERAKHIR Y LEFT JOIN PEGAWAI X ON X.PEGAWAI_ID = Y.PEGAWAI_ID  WHERE  Y.PENDIDIKAN_ID = 4 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_SMA ON B.PEGAWAI_ID = TOT_SMA.PEGAWAI_ID  
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PENDIDIKAN_TERAKHIR Y LEFT JOIN PEGAWAI X ON X.PEGAWAI_ID = Y.PEGAWAI_ID  WHERE  Y.PENDIDIKAN_ID = 5 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_D1 ON B.PEGAWAI_ID = TOT_D1.PEGAWAI_ID
						 LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PENDIDIKAN_TERAKHIR Y LEFT JOIN PEGAWAI X ON X.PEGAWAI_ID = Y.PEGAWAI_ID  WHERE  Y.PENDIDIKAN_ID = 6 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_D2 ON B.PEGAWAI_ID = TOT_D2.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PENDIDIKAN_TERAKHIR Y LEFT JOIN PEGAWAI X ON X.PEGAWAI_ID = Y.PEGAWAI_ID  WHERE  Y.PENDIDIKAN_ID = 7 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_D3 ON B.PEGAWAI_ID = TOT_D3.PEGAWAI_ID 
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PENDIDIKAN_TERAKHIR Y LEFT JOIN PEGAWAI X ON X.PEGAWAI_ID = Y.PEGAWAI_ID  WHERE  Y.PENDIDIKAN_ID = 13 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_D4 ON B.PEGAWAI_ID = TOT_D4.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PENDIDIKAN_TERAKHIR Y LEFT JOIN PEGAWAI X ON X.PEGAWAI_ID = Y.PEGAWAI_ID  WHERE  Y.PENDIDIKAN_ID = 9 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_S1 ON B.PEGAWAI_ID = TOT_S1.PEGAWAI_ID
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PENDIDIKAN_TERAKHIR Y LEFT JOIN PEGAWAI X ON X.PEGAWAI_ID = Y.PEGAWAI_ID  WHERE  Y.PENDIDIKAN_ID = 10 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_S2 ON B.PEGAWAI_ID = TOT_S2.PEGAWAI_ID 
						LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PENDIDIKAN_TERAKHIR Y LEFT JOIN PEGAWAI X ON X.PEGAWAI_ID = Y.PEGAWAI_ID  WHERE  Y.PENDIDIKAN_ID = 11 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_S3 ON B.PEGAWAI_ID = TOT_S3.PEGAWAI_ID 
						 LEFT JOIN
						(SELECT X.PEGAWAI_ID FROM PENDIDIKAN_TERAKHIR Y LEFT JOIN PEGAWAI X ON X.PEGAWAI_ID = Y.PEGAWAI_ID  WHERE  Y.PENDIDIKAN_ID <= 13 AND X.STATUS_PEGAWAI = 2 ".$statement_satker.") TOT_DIK ON B.PEGAWAI_ID = TOT_DIK.PEGAWAI_ID 
						WHERE  1=1
				GROUP BY PK.PANGKAT_ID, PK.KODE
				ORDER BY PK.PANGKAT_ID DESC
			 
		"; 
		
		$this->query = $str;
		//echo $str;
		return $this->selectLimit($str,-1,-1); 
    }
	

   

}
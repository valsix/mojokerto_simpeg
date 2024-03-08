<?
include_once("functions/date.func.php");

$this->load->model("base-data/FormulaPenilaian");
$this->load->library('globalmenu');

$reqId= $this->input->get("reqId");

if(empty($reqId)){}
else
{
	$set= new FormulaPenilaian();
	$set->selectbyparamsformulapenilaian(array("A.FORMULA_PENILAIAN_ID"=>$reqId),-1,-1);
	// echo $set->query;exit;
	$set->firstRow();
	$reqNama= $set->getField('NAMA');
}

$statement= "";
// $statement= " AND A.INDIKATOR_PENILAIAN_ID = 5";
// $statement= " AND A.INDIKATOR_PENILAIAN_ID IN (5,6)";
$set= new FormulaPenilaian();
$arrindikatorpenilaian= [];
$set->selectbyindikatorpenilaian(array(), -1,-1, $statement);
// echo $set->query;exit;
while($set->nextRow())
{
	$arrdata= [];
	$arrdata["id"]= $set->getField("INDIKATOR_PENILAIAN_ID");
	$arrdata["nama"]= $set->getField("NAMA");
	$arrdata["jenis"]= $set->getField("JENIS_SUBINDIKATOR");
	array_push($arrindikatorpenilaian, $arrdata);
}
unset($set);
// print_r($arrindikatorpenilaian);exit;

$statement= " AND A.FORMULA_PENILAIAN_ID = ".$reqId;
$set= new FormulaPenilaian();
$arrnilai= [];
$set->selectbyparamsformulapenilaianvalue(array(), -1,-1, $statement);
// echo $set->query;exit;
while($set->nextRow())
{
	$vindikatorpenilaianid= $set->getField("INDIKATOR_PENILAIAN_ID");
	$vsubindikatorid= $set->getField("SUB_INDIKATOR_ID");
	$vsubindikatordetilid= $set->getField("SUB_INDIKATOR_DETIL_ID");

	$arrdata= [];
	$arrdata["key"]= $vindikatorpenilaianid."-".$vsubindikatorid."-".$vsubindikatordetilid;
	$arrdata["id"]= $vindikatorpenilaianid;
	$arrdata["subindikatorid"]= $vsubindikatorid;
	$arrdata["subindikatordetilid"]= $vsubindikatordetilid;
	$arrdata["nilai"]= $set->getField("NILAI");
	array_push($arrnilai, $arrdata);
}
unset($set);
// print_r($arrnilai);exit;

$vfpeg= new globalmenu();
$arrparam= [];
$indikatorpenilaiansub= $vfpeg->indikatorpenilaiansub($arrparam);
// print_r($indikatorpenilaiansub);exit;

$arrparam= [];
$indikatorpenilaianvalue= $vfpeg->indikatorpenilaianvalue($arrparam);
// print_r($indikatorpenilaianvalue);exit;
?>
<style type="text/css">
	   select[readonly].select2-hidden-accessible + .select2-container {
        pointer-events: none;
        touch-action: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
        background: #F3F6F9;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection__arrow, select[readonly].select2-hidden-accessible + .select2-container .select2-selection__clear {
        display: none;
    }

</style>

<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom">
        	<div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-notepad text-primary"></i>
                    </span>
                    <h3 class="card-label">Indikator Penilaian</h3>
                </div>
            </div>
            <form class="form" id="ktloginform" method="POST" enctype="multipart/form-data">
	        	<div class="card-body">
	        		<div class="table-responsive">
	        			<table class="table table-bordered">
	        				<thead>
	        					<tr>
	        						<th>Indikator</th>
	        						<th>Sub Indikator</th>
	        						<th>Penilaian</th>
	        						<th style="width: 10%">Nilai</th>
	        					</tr>
	        				</thead>
	        				<tbody>
	        					<?
	        					foreach($arrindikatorpenilaian as $key => $item)
	        					{
	        						$infodetilid= $item["id"];
	        						$infodetilnama= $item["nama"];

	        						$infocarikey= $infodetilid;
	        						$arrcheck= in_array_column($infocarikey, "INDIKATOR_PENILAIAN_ID", $indikatorpenilaiansub);
	        						$jumlahrow= count($arrcheck);

	        						foreach ($arrcheck as $keyindex => $vindex)
		        					{
		        						$infosubindikatorid= $indikatorpenilaiansub[$vindex]["SUB_INDIKATOR_ID"];
		        						$infosubindikatorkey= $infodetilid."-".$infosubindikatorid;
		        						$infosubindikatornama= $indikatorpenilaiansub[$vindex]["NAMA"];

		        						$infocarikey= $infosubindikatorkey;
		        						$arrkeyindikatorpenilaianvalue= in_array_column($infocarikey, "key", $indikatorpenilaianvalue);

		        						$vlabel= $infosubindikatordetilid= "";

		        						$infocarikey= $infodetilid;
		        						$jumlahdetilrow= count(in_array_column($infocarikey, "INDIKATOR_PENILAIAN_ID", $indikatorpenilaianvalue));
		        						// echo $jumlahpenilaian;exit;
		        						$jumlahpenilaian= count($arrkeyindikatorpenilaianvalue);

		        						foreach ($arrkeyindikatorpenilaianvalue as $keydetilindex => $vdetilindex)
		        						{

		        							$vlabel= $indikatorpenilaianvalue[$vdetilindex]["NAMA"];
		        							$infosubindikatordetilid= $indikatorpenilaianvalue[$vdetilindex]["SUB_INDIKATOR_DETIL_ID"];

			        						$infosubindikatordetilkey= $infosubindikatorkey."-".$infosubindikatordetilid;

			        						$infocarikey= $infosubindikatordetilkey;
			        						$arrkeynilai= in_array_column($infocarikey, "key", $arrnilai);
			        						$reqNilai= "";
			        						if(!empty($arrkeynilai))
			        						{
			        							$reqNilai= $arrnilai[$arrkeynilai[0]]["nilai"];
			        						}

			        						$vinfolabel= str_replace("vnilai", $reqNilai, $vlabel);
	        					?>
				        					<tr>
				        						<?
				        						if($keyindex == 0 && $keydetilindex == 0)
				        						{
				        						?>
				        						<th rowspan="<?=$jumlahdetilrow?>"><?=$infodetilnama?></th>
				        						<?
				        						}
				        						if($keydetilindex == 0)
				        						{
				        						?>
				        						<td rowspan="<?=$jumlahpenilaian?>"><?=$infosubindikatornama?></td>
				        						<?
				        						}
				        						?>
				        						<td>
				        							<label id="vlabel<?=$infosubindikatordetilkey?>"><?=$vinfolabel?></label>
				        							<input type="hidden" id="reqSubIndikatorDetilNama<?=$infosubindikatordetilkey?>" value="<?=$vlabel?>" />
				        							<input type="hidden" name="reqSubIndikatorDetilId[]" id="reqSubIndikatorDetilId<?=$infosubindikatordetilkey?>" value="<?=$infosubindikatordetilid?>" />
				        						</td>
				        						<td>
				        							<input type="text" class="form-control" name="reqNilai[]" id="reqNilai<?=$infosubindikatordetilkey?>" value="<?=$reqNilai?>" />
				        							<input type="hidden" name="reqIndikatorPenilaianId[]" id="reqIndikatorPenilaianId<?=$infosubindikatordetilkey?>" value="<?=$infodetilid?>" />
				        							<input type="hidden" name="reqSubIndikatorId[]" id="reqSubIndikatorId<?=$infosubindikatordetilkey?>" value="<?=$infosubindikatorid?>" />
				        						</td>
				        					</tr>
	        					<?
	        							}
	        						}
	        					}
	        					?>

	        				</tbody>
	        			</table>

	        	</div>

	        	<div class="card-footer">
	        		<div class="row">
	        			<div class="col-lg-9">
	        				<input type="hidden" name="reqId" value="<?=$reqId?>">
	        				<button type="submit" id="ktloginformsubmitbutton"  class="btn btn-primary font-weight-bold mr-2">Simpan</button>
	        			</div>
	        		</div>
	        	</div>
	        </form>
        </div>
    </div>
</div>

<script type="text/javascript">
	$('[id^="reqNilai"]').bind('keyup paste', function(){
		// this.value = this.value.replace(/[^0-9]/g, '');
		this.value = this.value.replace(/[^0-9\.]/g, '');
	});

	$('input[id^="reqNilai"]').keyup(function(e) {
		infoid= $(this).attr('id');
		infoval= $(this).val();
		infoid= infoid.replace("reqNilai", "");
		// console.log(infoid);

		reqSubIndikatorDetilNama= $("#reqSubIndikatorDetilNama"+infoid).val();
		vreturn= reqSubIndikatorDetilNama.replace("vnilai", infoval);
		$("#vlabel"+infoid).text(vreturn);
	});

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-data/info_admin_json/formulapenilaiannilai";
		var formSubmitButton = KTUtil.getById('ktloginformsubmitbutton');
		if (!form) {
			return;
		}
		FormValidation
		.formValidation(
			form,
			{
				fields: {
					reqNama: {
						validators: {
							notEmpty: {
								message: 'Nama is required'
							}
						}
					},
				},
				plugins: {
					trigger: new FormValidation.plugins.Trigger(),
					submitButton: new FormValidation.plugins.SubmitButton(),
					bootstrap: new FormValidation.plugins.Bootstrap()
				}
			}
			)
		.on('core.form.valid', function() {
				// Show loading state on button
				KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
				var formData = new FormData(document.querySelector('form'));
				$.ajax({
					cache: false,
					url: formSubmitUrl,
					data: formData,
					processData: false,
					contentType: false,
					type: 'POST',
					dataType: 'json',
					success: function (response) {
			        	// console.log(response); return false;

			        	inforesponse= response.message;
			        	inforesponsedata = inforesponse.split("-");

			        	inforesponseid= inforesponsedata[0];
			        	inforesponsepesan= inforesponsedata[1];

			        	// Swal.fire("Good job!", "You clicked the button!", "success");
			        	Swal.fire({
			        		text: inforesponsepesan,
			        		icon: "success",
			        		buttonsStyling: false,
			        		confirmButtonText: "Ok",
			        		customClass: {
			        			confirmButton: "btn font-weight-bold btn-light-primary"
			        		}
			        	}).then(function() {
			        		document.location.href = "admin/index/formula_penilaian_nilai?reqId=<?=$reqId?>";
			        	});
			        },
			        error: function(xhr, status, error) {
			        	var err = JSON.parse(xhr.responseText);
			        	Swal.fire("Error", err.message, "error");
			        },
			        complete: function () {
			        	KTUtil.btnRelease(formSubmitButton);
			        }
			    });
			})
		.on('core.form.invalid', function() {
			Swal.fire({
				text: "Sorry, looks like there are some errors detected, please try again.",
				icon: "error",
				buttonsStyling: false,
				confirmButtonText: "Ok, got it!",
				customClass: {
					confirmButton: "btn font-weight-bold btn-light-primary"
				}
			}).then(function() {
				KTUtil.scrollTop();
			});
		});
	});

</script>
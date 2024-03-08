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

$set= new FormulaPenilaian();
$arrindikatorpenilaian= [];
$set->selectbyindikatorpenilaian();
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
$set->selectbyparamsformulapenilaianbobot(array(), -1,-1, $statement);
// echo $set->query;exit;
while($set->nextRow())
{
	$vindikatorpenilaianid= $set->getField("INDIKATOR_PENILAIAN_ID");
	$vsubindikatorid= $set->getField("SUB_INDIKATOR_ID");

	$arrdata= [];
	$arrdata["key"]= $vindikatorpenilaianid."-".$vsubindikatorid;
	$arrdata["id"]= $vindikatorpenilaianid;
	$arrdata["subindikatorid"]= $vsubindikatorid;
	$arrdata["nilai"]= $set->getField("NILAI");
	array_push($arrnilai, $arrdata);
}
unset($set);
// print_r($arrnilai);exit;

$vfpeg= new globalmenu();
$arrparam= [];
$indikatorpenilaiansub= $vfpeg->indikatorpenilaiansub($arrparam);
// print_r($indikatorpenilaiansub);exit;
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
                    <h3 class="card-label">Indikator Bobot</h3>
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
	        						<th style="width: 10%">Bobot</th>
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

	        						$infosubindikatorid= $indikatorpenilaiansub[$arrcheck[0]]["SUB_INDIKATOR_ID"];
	        						$infosubindikatorkey= $infodetilid."-".$infosubindikatorid;
	        						$infosubindikatornama= $indikatorpenilaiansub[$arrcheck[0]]["NAMA"];

	        						$infocarikey= $infosubindikatorkey;
	        						$arrkeynilai= in_array_column($infocarikey, "key", $arrnilai);
	        						$reqNilai= "";
	        						if(!empty($arrkeynilai))
	        						{
	        							// print_r($arrkeynilai);exit;
	        							$reqNilai= $arrnilai[$arrkeynilai[0]]["nilai"];
	        						}
	        					?>
	        					<tr>
	        						<th rowspan="<?=$jumlahrow?>"><?=$infodetilnama?></th>
	        						<td><?=$infosubindikatornama?></td>
	        						<td>
	        							<input type="text" class="form-control" name="reqNilai[]" id="reqNilai<?=$infosubindikatorkey?>" value="<?=$reqNilai?>" />
	        							<input type="hidden" name="reqIndikatorPenilaianId[]" id="reqIndikatorPenilaianId<?=$infosubindikatorkey?>" value="<?=$infodetilid?>" />
	        							<input type="hidden" name="reqSubIndikatorId[]" id="reqSubIndikatorId<?=$infosubindikatorkey?>" value="<?=$infosubindikatorid?>" />
	        						</td>
	        					</tr>
	        					<?
	        						if($jumlahrow > 1)
		        					{
			        					foreach ($arrcheck as $keyindex => $vindex)
			        					{
			        						if($keyindex == 0)
			        							continue;

			        						$infosubindikatorid= $indikatorpenilaiansub[$vindex]["SUB_INDIKATOR_ID"];
			        						$infosubindikatorkey= $infodetilid."-".$infosubindikatorid;
			        						$infosubindikatornama= $indikatorpenilaiansub[$vindex]["NAMA"];

			        						$infocarikey= $infosubindikatorkey;
			        						$arrkeynilai= in_array_column($infocarikey, "key", $arrnilai);
			        						$reqNilai= "";
			        						if(!empty($arrkeynilai))
			        						{
			        							// print_r($arrkeynilai);exit;
			        							$reqNilai= $arrnilai[$arrkeynilai[0]]["nilai"];
			        						}
		        				?>
			        					<tr>
			        						<td><?=$infosubindikatornama?></td>
			        						<td>
			        							<input type="text" class="form-control" name="reqNilai[]" id="reqNilai<?=$infosubindikatorkey?>" value="<?=$reqNilai?>" />
			        							<input type="hidden" name="reqIndikatorPenilaianId[]" id="reqIndikatorPenilaianId<?=$infosubindikatorkey?>" value="<?=$infodetilid?>" />
			        							<input type="hidden" name="reqSubIndikatorId[]" id="reqSubIndikatorId<?=$infosubindikatorkey?>" value="<?=$infosubindikatorid?>" />
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

	var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
	jQuery(document).ready(function() {
		var form = KTUtil.getById('ktloginform');
		var formSubmitUrl = "json-data/info_admin_json/formulapenilaianbobot";
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
			        		document.location.href = "admin/index/formula_penilaian_bobot?reqId=<?=$reqId?>";
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
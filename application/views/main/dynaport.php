<?
$arrtabledata= array(
	array("label"=>"", "field"=> "NO_FIELD", "display"=>"", "width"=>"")
	, array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "PEGAWAI_ID", "display"=>"1", "width"=>"")
);

$arrtablehide= array(
	array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "PEGAWAI_ID", "display"=>"1", "width"=>"")
);

$this->load->library('globaldyna');
$vdyna= new globaldyna();
$arrfield= $vdyna->getinfofiled();
// print_r($arrfield);exit;
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

<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
	<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
		<div class="d-flex align-items-center flex-wrap mr-1">
			<div class="d-flex align-items-baseline flex-wrap mr-5">
				<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
					<li class="breadcrumb-item text-muted">
						<a href="app/index/pegawai">Data Pegawai</a>
					</li>
					<li class="breadcrumb-item text-muted">
						<a class="text-muted">Dynamic Report</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="d-flex flex-column-fluid">
    <div class="container">
        <div class="card card-custom">
        	<div class="card-header">
                <div class="card-title">
                    <span class="card-icon">
                        <i class="flaticon2-notepad text-primary"></i>
                    </span>
                    <h3 class="card-label">Dynamic Report</h3>
                </div>
            </div>
            
        	<div class="card-body">
        		<div class="row">
        			<div class="col-md-5">
        				<div class="area-dynaport appendfield appendme kursor" id="kursor">
							Silakan pilih field yang akan ditampilkan :
							<div class="item item-header">
								<div class="nama">Field</div>
								<div class="urutan">Urutan</div>
								<div class="aksi" >Aksi</div>
							</div>
							
							<!-- The custom context menu -->
							<div id="wrapper" class="menu">
								<ul id="menu">
									<?
									foreach ($arrfield as $k => $v)
									{
										$vgroup= $v["group"];
										$vgroupdata= $v["data"];

										if(count($vgroupdata) > 0)
										{
									?>
										<li>
											<a href="javascript:void(0)"><?=$vgroup?></a>
											<ul>
												<?
												foreach ($vgroupdata as $kd => $vd)
												{
													$vlabel= $vd["label"];
												?>
													<li><a class="fieldoption appendbtn"><?=$vlabel?></a></li>
												<?
												}
												?>
											</ul>
										</li>
									<?
										}
									}
									?>
								</ul>
							</div>
						</div>
        			</div>
        			<div class="col-md-7">
        				
            			<div class="area-dynaport appendoperasi appendme2 kursor" id="kursor2">
							Silakan pilih operasi yang akan ditampilkan :
							<div class="item item-operasi item-header">
								<div class="nama">Field</div>
								<div class="operasi">Operasi</div>
								<div class="isi">Isi</div>
								<div class="aksi">Aksi</div>
							</div>
							
							<!-- The custom context menu -->
							<div id="wrapper" class="menu2">
								<ul id="menu">
									<li><a class="option2 appendbtn">Tambah</a></li>
								</ul>
							</div>
						</div>
        			</div>
        		</div>
        		

				<script>
				    // select the menu element
				    const menu = document.querySelector(".menu"); 
				    // menu.style.display = "none"; 
				    var kursor =  document.getElementById("kursor");
				    // add an event listener for the right-click event on the document
				    kursor.addEventListener("contextmenu", (event) => {
						// prevent the default browser behavior
						event.preventDefault(); 
						// show the menu element
						menu.style.display = "block"; 
						// position the menu element near the cursor horizontally
						// menu.style.left = `${event.clientX}px`; 
						menu.style.left = `320px`; 
						// menu.style.left = event.pageX;

						// position the menu element near the cursor vertically
						// menu.style.top = `${event.clientY}px`; 
						menu.style.top = `40px`; 
						// menu.style.top = event.pageY; 

				    });

				    // add an event listener for the click event on the document
				    document.addEventListener("click", () => {
				    //   // hide the menu element
				      menu.style.display = "none"; 
				    });

				    // select all the option elements
				    const options = document.querySelectorAll(".option"); 
				</script>
				
				<script>
				    // select the menu element
				    const menu2 = document.querySelector(".menu2"); 
				    // menu.style.display = "none"; 
				    var kursor2 =  document.getElementById("kursor2");
				    // add an event listener for the right-click event on the document
				    kursor2.addEventListener("contextmenu", (event) => {
				    	// alert("haii");
						// prevent the default browser behavior
						event.preventDefault(); 
						// show the menu element
						menu2.style.display = "block"; 
						// position the menu element near the cursor horizontally
						// menu.style.left = `${event.clientX}px`; 
						menu2.style.left = `320px`; 
						// menu.style.left = event.pageX;

						// position the menu element near the cursor vertically
						// menu.style.top = `${event.clientY}px`; 
						menu2.style.top = `40px`; 
						// menu.style.top = event.pageY; 

				    });

				    // add an event listener for the click event on the document
				    document.addEventListener("click", () => {
				    //   // hide the menu element
				      menu2.style.display = "none"; 
				    });

				    // select all the option elements
				    const options2 = document.querySelectorAll(".option2"); 
				  </script>

        	</div>

        	<div class="card-body area-button">
        		<div class="row">
	        		<div class="col-md-12">
		        		<button id="caridyna" class="btn btn-light-primary">
		        			<i class="fa fa-search" aria-hidden="true"></i> Cari
		        		</button>
		        		<button class="btn btn-light-warning"><i class="fa fa-print" aria-hidden="true"></i> Cetak</button>
	        		</div>
	        	</div>
        	</div>

        	<div class="card-body">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                    <thead>
                        <tr>
                            <?php
                            foreach($arrtabledata as $valkey => $valitem) 
                            {
                                echo "<th>".$valitem["label"]."</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
</div>

<!-- DATATABLE -->
<a href="#" id="triggercari" style="display:none" title="triggercari">triggercari</a>
<!-- <input type="text" id="arrtablehide" /> -->

<script type="text/javascript">
var datanewtable;
var infotableid= "kt_datatable";
var carijenis= "";
var arrdata= <?php echo json_encode($arrtabledata); ?>;
// console.log(arrdata);
var indexfieldid= arrdata.length - 1;
var indexvalidasiid= arrdata.length - 3;
var indexvalidasihapusid= arrdata.length - 4;
var valinfoid = '';
var valinfovalidasiid = '';
var valinfovalidasihapusid = '';

var arrfield= <?php echo json_encode($arrfield); ?>;

$(function () {
	$("[rel=tooltip]").tooltip({ placement: 'right'});
	// $('[data-toggle="tooltip"]').tooltip()
})

$('#ktagamaid').select2({
	placeholder: "Pilih agama"
});

$('#ktsatuankerjad').select2({
	placeholder: "Pilih Satuan Kerja"
});

$('#ktjeniskelamin').select2({
	placeholder: "Pilih jenis kelamin"
});

arrows= {leftArrow: '<i class="la la-angle-left"></i>', rightArrow: '<i class="la la-angle-right"></i>'};
$('#kttanggallahir').datepicker({
	todayHighlight: true
	, autoclose: true
	, orientation: "bottom left"
	, clearBtn: true
	, format: 'dd-mm-yyyy'
	, templates: arrows
});

var formSubmitButton;
var vparam;
var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';
let arrtablehide;
let infonewdata;
// $("#arrtablehide").attr("value", <?php echo json_encode($arrtablehide); ?>); 

jQuery(document).ready(function() {

	$(".fieldoption").click(function() {
 		valueHtml= $(this).html();

 		vstr= ''
 		+'<div class="item">'
 			+'<div class="fieldnamaoption nama">'+valueHtml+'</div>'
	 		+'<div class="urutan">'
	 			+'<select class="fieldselectoption form-control">'
	 				+'<option value="Asc">Asc</option>'
	 				+'<option value="Desc">Desc</option>'
	 			+'</select>'
 			+'</div>'
 			+'<div class="aksi">'
 				+'<i class="fa fa-times-circle" aria-hidden="true" onclick="$(this).parent().parent().remove();"></i>'
 			+'</div>'
 		+'</div>';

 		$(".appendfield").append(vstr);
 	});

 	$(".option2").click(function() {
 		var valueHtml2 = $(this).html();
 		$(".appendoperasi").append('<div class="item item-operasi"><div class="nama"><select class=form-control><option>NIP</option><option>NIP Baru</option></select></div><div class="operasi"><select class=form-control><option>=</option><option>!=</option></select></div><div class="isi"><input class=form-control></div><div class="aksi"><i class="fa fa-times-circle" aria-hidden="true" onclick="$(this).parent().parent().remove();"></i></div></div>');
 	});

    var jsonurl= "json-main/dynaport_json/json";
    ajaxserverselectsingle.init(infotableid, jsonurl, arrdata);

    var infoid= [];
    $('#'+infotableid+' tbody').on( 'click', 'tr', function () {
        // untuk pilih satu data, kalau untuk multi comman saja
        $('#'+infotableid+' tbody tr').removeClass('selected');

        var el= $(this);
        el.addClass('selected');

        var dataselected= datanewtable.DataTable().row(this).data();
        // console.log(dataselected);
        // console.log(Object.keys(dataselected).length);
        fieldinfoid= arrdata[indexfieldid]["field"]
        fieldvalidasiid= arrdata[indexvalidasiid]["field"]
        valinfoid= dataselected[fieldinfoid];
        if (valinfovalidasiid == null)
        {
            valinfovalidasiid = '';
        }
    });

    $("#triggercari").on("click", function () {
        reqBulan= $("#reqBulan").val();
        reqTahun= $("#reqTahun").val();
        reqType= $("#reqType").val();
        reqSatkerId= $("#reqSatkerId").val();

        if(carijenis == "1")
        {
            pencarian= $('#'+infotableid+'_filter input').val();
            datanewtable.DataTable().search( pencarian ).draw();
        }
        else if(carijenis == "p")
        {
            jsonurl= "json-main/dynaport_json/json?param=";
            // +urlencode(vparam)
            datanewtable.DataTable().ajax.url(jsonurl).load();
        }
        else
        {
            jsonurl= "json-main/dynaport_json/json";
            datanewtable.DataTable().ajax.url(jsonurl).load();
        }
    });

    $("#caridyna").click(function() {
    	vtr= "<tr>";
    	voption= "";
    	infonewdata= [];
    	vasc= "";
    	$(".fieldnamaoption").each(function(){
    		voption= $(this).html();
    		vtr+= "<th>"+voption+"</th>";

    		// fieldselectoption

    		if(voption !== "")
    		{
	    		varrcheckdata= arrfield.flatMap(it => Object.values(it.data)).filter(item => item.label === voption);
		    	if(Array.isArray(varrcheckdata) && varrcheckdata.length)
		    	{
			    	// console.log(varrcheckdata);
			    	vfielddata= varrcheckdata[0]["field"];
			    	var infodetil= {};
			    	infodetil.label= varrcheckdata[0]["label"];
			    	infodetil.field= vfielddata;
			    	infodetil.width= varrcheckdata[0]["width"];
			    	infodetil.display= varrcheckdata[0]["display"];
			    	infonewdata.push(infodetil);

			    	vselectoption= $(this).closest('.item').find('.fieldselectoption').val();
			    	if(vasc == "")
			    	{
			    		vasc= vfielddata+";"+vselectoption;
			    	}
			    	else
			    	{
			    		vasc= vasc+"***"+vfielddata+";"+vselectoption;
			    	}
			    }
    		}

    	});
    	vtr+= "</tr>";
    	// console.log(infonewdata);

    	if(voption == "")
    	{
	    	Swal.fire({
	    		text: "Pilih salah satu data field yang akan di tempilkan terlebih dahulu.",
	    		icon: "error",
	    		buttonsStyling: false,
	    		confirmButtonText: "Ok",
	    		customClass: {
	    			confirmButton: "btn font-weight-bold btn-light-primary"
	    		}
	    	});
	    	return false;
    	}

    	// arrtablehide= $("#arrtablehide").val();
    	$.ajax({
		    url: "json-main/dynaport_json/setatribut",
		    method: "POST",
		    data: {
		        vasc: vasc
		    }
		    , beforeSend: function () {
		    	arrtablehide= <?php echo json_encode($arrtablehide); ?>;
		    	// console.log(arrtablehide);

		    	arrtablehide.forEach(function (item, index) {
		    		var infodetil= {};
		            infodetil.label= item["label"];
		            infodetil.field= item["field"];
		            infodetil.width= item["width"];
		            infodetil.display= item["display"];
		            infonewdata.push(infodetil);
		    	});
		    	console.log(infonewdata);
		    }
		    ,
		    success: function (response) {
		    	// console.log(response);return false;

		    	$('#'+infotableid).DataTable().destroy();
		    	$('#'+infotableid+' thead').empty();
		    	$('#'+infotableid+' thead').append(vtr);

		    	formSubmitButton= KTUtil.getById("caridyna");
		    	KTUtil.btnWait(formSubmitButton, _buttonSpinnerClasses, "Please wait");
		    	
		    	var jsonurl= "json-main/dynaport_json/json?m=1";
		    	ajaxserverselectsingle.init(infotableid, jsonurl, infonewdata);
		    },
		    error: function (response) {
		      // console.log(response);return false;
		    },
		    complete: function () {

		    },
		});
    });

});

function calltriggercari()
{
    $(document).ready( function () {
      $("#triggercari").click();      
    });
}

function afterreload()
{
    KTUtil.btnRelease(formSubmitButton);
}
</script>
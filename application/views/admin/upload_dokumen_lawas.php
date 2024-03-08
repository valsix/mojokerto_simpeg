<?php
$reqPegawaiId= $this->pegawaiId;
$reqIdOrganisasi = $this->input->get("reqIdOrganisasi"); 
$arrdata= array(
     array("label"=>"No ", "field"=> "NO", "display"=>"",  "width"=>"")
    , array("label"=>"Nama File", "field"=> "NAMA_FILE", "display"=>"",  "width"=>"")
    , array("label"=>"Tipe File", "field"=> "TIPE_FILE", "display"=>"",  "width"=>"")
    , array("label"=>"Keterangan", "field"=> "KETERANGAN", "display"=>"",  "width"=>"")
    // untuk dua ini kunci, data akhir id, data sebelum akhir untuk order
    , array("label"=>"sorderdefault", "field"=> "SORDERDEFAULT", "display"=>"1", "width"=>"")
    , array("label"=>"fieldid", "field"=> "RIWAYAT_KONTRAK_ID", "display"=>"1", "width"=>"")
);
?>
<!DOCTYPE html>
<html>
<head>
  <style>
      h3 {
        line-height: 30px;
        text-align: center;
    }

    #drop_file_area {
        height: 200px;
        border: 2px dashed #ccc;
        line-height: 200px;
        text-align: center;
        font-size: 20px;
        background: #f9f9f9;
        margin-bottom: 15px;
    }

    .drag_over {
        color: #000;
        border-color: #000;
    }

    .thumbnail {
        width: 100px;
        height: 100px;
        padding: 2px;
        margin: 2px;
        border: 2px solid lightgray;
        border-radius: 3px;
        float: left;
    }

    #upload_file {
        display: none;
    }
</style>
</head>

<body>

    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <div class="d-flex align-items-center flex-wrap mr-1">
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a class="text-muted">Upload Dokumen</a>
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
                        <h3 class="card-label">Upload Dokumen</h3>
                    </div>
                </div>

                <div class="card-body">
                    <div class="mb-15">
                        <div id="drop_file_area">
                          Drag dan Drop Files disini
                        </div>
                      <div id="uploaded_file"></div>
                    </div>
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable" style="margin-top: 13px !important">
                        <thead>
                            <tr>
                                <?php
                                foreach($arrdata as $valkey => $valitem) 
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
<a href="#" id="triggercari" style="display:none" title="triggercari">triggercari</a>

<script>
    var datanewtable;
    var infotableid= "kt_datatable";
    var carijenis= "";
    var arrdata= <?php echo json_encode($arrdata); ?>;
    var indexfieldid= arrdata.length - 1;
    var indexvalidasiid= arrdata.length - 3;
    var indexvalidasihapusid= arrdata.length - 4;
    var valinfoid = '';
    var valinfovalidasiid = '';
    var valinfovalidasihapusid = '';

    jQuery(document).ready(function() {
        var jsonurl= "json-admin/upload_json/jsonupload";
        ajaxserverselectsingle.init(infotableid, jsonurl, arrdata);

        var infoid= [];
        $('#'+infotableid+' tbody').on( 'click', 'tr', function () {
            $('#'+infotableid+' tbody tr').removeClass('selected');

            var el= $(this);
            el.addClass('selected');

            var dataselected= datanewtable.DataTable().row(this).data();

            fieldinfoid= arrdata[indexfieldid]["field"]
            fieldvalidasiid= arrdata[indexvalidasiid]["field"]
            fieldvalidasihapusid= arrdata[indexvalidasihapusid]["field"]
            valinfoid= dataselected[fieldinfoid];
            valinfovalidasiid= dataselected[fieldvalidasiid];
            valinfovalidasihapusid= dataselected[fieldvalidasihapusid];
            if (valinfovalidasiid == null)
            {
                valinfovalidasiid = '';
            }
            if (valinfoid == null)
            {
                valinfovalidasiid = '';
            }
        });
        $("#buttoncaridetil").on("click", function () {
            carijenis= "2";
            calltriggercari();
        });
        $("#triggercari").on("click", function () {

            if(carijenis == "1")
            {
                pencarian= $('#'+infotableid+'_filter input').val();
                datanewtable.DataTable().search( pencarian ).draw();
            }
            else
            {

            }
        });
    });


  $(document).ready(function () {
    $("html").on("dragover", function (e) {
      e.preventDefault();
      e.stopPropagation();
    });

    $("html").on("drop", function (e) {
      e.preventDefault();
      e.stopPropagation();
    });

    $('#drop_file_area').on('dragover', function () {
      $(this).addClass('drag_over');
      return false;
    });

    $('#drop_file_area').on('dragleave', function () {
      $(this).removeClass('drag_over');
      return false;
    });

    $('#drop_file_area').on('drop', function (e) {
      e.preventDefault();
      $(this).removeClass('drag_over');
      var formData = new FormData();
      var files = e.originalEvent.dataTransfer.files;
      for (var i = 0; i < files.length; i++) {
        formData.append('file[]', files[i]);
      }
      uploadFormData(formData);
    });

    var _buttonSpinnerClasses = 'spinner spinner-right spinner-white pr-15';

function uploadFormData(form_data) {
      $.ajax({
        url: "json-admin/upload_json/uploadmulti",
        method: "POST",
        data: form_data,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            swal.fire({
                title: 'Mohon tunggu sebentar..',
                text: 'File sedang dalam proses upload..',
                onOpen: function() {
                    swal.showLoading()
                }
            })
        },
        success: function (data) {
            Swal.fire({
                text: data.message,
                icon: "success",
                buttonsStyling: false,
                confirmButtonText: "Ok",
                customClass: {
                    confirmButton: "btn font-weight-bold btn-light-primary"
                }
            }).then(function() {
               document.location.href = "admin/index/upload_dokumen";
           });
        },
        complete: function() {
            swal.hideLoading();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            swal.hideLoading();
            var err = JSON.parse(jqXHR.responseText);
            Swal.fire("Error", err.message, "error");
        }
    });
  }
});

function btnDeleteFile (fileid,reqPegawaiId,reqRowId) {
    if(fileid !== "")
    {
        urlAjax= "json-admin/upload_json/uploaddeletefile?reqFileId="+fileid+"&reqPegawaiId="+reqPegawaiId+"&reqRowId="+reqRowId;
        swal.fire({
            title: 'Apakah anda yakin untuk hapus file?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes'
        }).then(function(result) { 
            if (result.value) {
                $.ajax({
                    url : urlAjax,
                    type : 'DELETE',
                    dataType:'json',
                    beforeSend: function() {
                        swal.fire({
                            title: 'Please Wait..!',
                            text: 'Is working..',
                            onOpen: function() {
                                swal.showLoading()
                            }
                        })
                    },
                    success : function(data) { 
                        swal.fire({
                            position: 'center',
                            icon: "success",
                            type: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function() {
                            location.reload();
                        });
                    },
                    complete: function() {
                        swal.hideLoading();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal.hideLoading();
                        var err = JSON.parse(jqXHR.responseText);
                        Swal.fire("Error", err.message, "error");
                    }
                });
            }
        });
    }
}

function calltriggercari()
{
    $(document).ready( function () {
      $("#triggercari").click();      
    });
}

</script>
    

</body>
 
</html>
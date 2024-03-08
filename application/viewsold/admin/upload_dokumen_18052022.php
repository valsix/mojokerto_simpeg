<html>
<head>
<link rel="stylesheet" type="text/css" href="lib/dropzone/dropzone.css">
<link rel="stylesheet" type="text/css" href="lib/dropzone/basic.css">
<script src="lib/dropzone/dropzone.js"></script>

<link href="lib/mbox/mbox.css" rel="stylesheet">
<script src="lib/mbox/mbox.js"></script>
<link href="lib/mbox/mbox-modif.css" rel="stylesheet">

<style>
    td, th {
        padding: 2px 4px !important;
    }
    
    .dropzone 
    {
        height: 150px;
        min-height: 0px !important;
        padding: 5px 5px !important;
    }


    
    .dropdown-content
    {
        max-height: 200px !important;
    }

    .dropdown-content li
    {
        min-height: 15px !important;
        line-height: 0.1rem !important;
    }
    .dropdown-content li > span
    {
        font-size: 14px;
        line-height: 12px !important;
    }

    .webnots-notification-box {
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
        color: #ffffff;
        font-family: verdana, 'open sans', sans-serif;
        margin-bottom: 25px;
        padding: 10px 14px 10px 1px;
        position: relative;
        box-shadow: 0px 1px 5px #999;
    }
    .webnots-information {
        background-color: #e74c3c;
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
                        <form action="json-admin/upload_json/uploadmulti/" class="dropzone" id="mydropzone"  method="post" enctype="multipart/form-data">
                        </form>
                        <div><ul>
                            <li>File Berhasil Di upload</li>
                        </ul></div>
                    </div>

                    <div class="webnots-information webnots-notification-box" >
                        <p style="padding-left: 20px">  Catatan :</p> 
                        <ul>
                            <li>Pastikan File yang akan di upload berformat PDF dan ukuran file tidak lebih dari 2 MB.</li>
                            <li>Pastikan nama File yang akan di upload, sudah sesuai dengan format nama yang sudah ada</li>
                        </ul>
                    </div>
                         
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        $(mydropzone).dropzone({
            dictDefaultMessage:"Drag dan Drop File disini",
            maxfiles: 12,
            maxFilesize: 2,
            // uploadMultiple:true, 
            // clickable: false,
            acceptedMimeTypes: "application/pdf",
            init: function () {
                this.on("success", function(file, responseText) {
                    data = responseText.split("-");
                    rowid= data[0];
                    infodata= data[1];
                        // console.log(responseText);return false;
                        // if(rowid == "xxx")
                        // {
                        //     mbox.alert('File gagal di upload. <br>'+infodata, {open_speed: 0});
                        // }
                        // else
                        // {
                        //     if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
                        //         mbox.alert(responseText, {open_speed: 500}, interval = window.setInterval(function() 

                        //         {
                        //             clearInterval(interval);
                        //             setreloaddokumen();
                        //             mbox.close();
                        //         }, 1000));
                        //         $(".mbox > .right-align").css({"display": "none"});

                        //     }
                        // }
                    });

                this.on('error', function(file, response) {
                     // console.log(response);return false;
                    $(file.previewElement).find('.dz-error-message').text(response);
                });


            }
        });
      

    </script>

    <script type="text/javascript">

        function setreloaddokumen()
        {

            document.location.href= "admin/index/upload_dokumen";
        }


    </script>


</body>
</html>
<?php 
   require_once 'Tamplate/Layout/Header.php';
 ?>

    <!-- Begin Page Content -->
<div class="container-fluid">

 
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Presensi</h1>
   <p class="mb-4"></p>

       <!-- DataTales Example -->
       <div class="card shadow mb-4">
           <div class="card-header py-3">
               <!-- <a href="#" class="btn btn-outline-primary">
                   <i class="fa fa-plus p-1"></i><strong>Tambah Data</strong>
               </a>&nbsp;&nbsp;
               <a href="#" class="btn btn-outline-success">
               <i class="fas fa-arrow-circle-left"></i> <strong>Import Data</strong>
               </a> -->
           </div>
           <div class="card-body">
            <video id="previewKamera" style="width: 300px;height: 300px;"></video>
                <br>
                <select id="pilihKamera" style="max-width:400px">
                </select>
                <br><br>
                <input type="text" id="hasilscan" style="width:33%">
                
                <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
                <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
            
                <script>
                    let selectedDeviceId = null;
                    const codeReader = new ZXing.BrowserMultiFormatReader();
                    const sourceSelect = $("#pilihKamera");
            
                    $(document).on('change','#pilihKamera',function(){
                        selectedDeviceId = $(this).val();
                        if(codeReader){
                            codeReader.reset()
                            initScanner()
                        }
                    })
            
                    function initScanner() {
                        codeReader
                        .listVideoInputDevices()
                        .then(videoInputDevices => {
                            videoInputDevices.forEach(device =>
                                console.log(`${device.label}, ${device.deviceId}`)
                            );
            
                            if(videoInputDevices.length > 0){
                                
                                if(selectedDeviceId == null){
                                    if(videoInputDevices.length > 1){
                                        selectedDeviceId = videoInputDevices[1].deviceId
                                    } else {
                                        selectedDeviceId = videoInputDevices[0].deviceId
                                    }
                                }
                                
                                
                                if (videoInputDevices.length >= 1) {
                                    sourceSelect.html('');
                                    videoInputDevices.forEach((element) => {
                                        const sourceOption = document.createElement('option')
                                        sourceOption.text = element.label
                                        sourceOption.value = element.deviceId
                                        if(element.deviceId == selectedDeviceId){
                                            sourceOption.selected = 'selected';
                                        }
                                        sourceSelect.append(sourceOption)
                                    })
                            
                                }
            
                                codeReader
                                    .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
                                    .then(result => {
            
                                            //hasil scan
                                            console.log(result.text)
                                            $("#hasilscan").val(result.text);
                                        
                                            if(codeReader){
                                                codeReader.reset()
                                            }
                                    })
                                    .catch(err => console.error(err));
                                
                            } else {
                                alert("Kamera tidak bisa diakses!")
                            }
                        })
                        .catch(err => console.error(err));
                    }
            
            
                    if (navigator.mediaDevices) {
                        
            
                        initScanner()
                        
            
                    } else {
                        alert('Cannot access camera.');
                    }
                
                </script>

            </div>
        </div>
    </div>

<?php  
     require_once 'Tamplate/Layout/Footer.php';  
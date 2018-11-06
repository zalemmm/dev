<?php
$nbcom = $_POST['orderid'];
if(isset($_POST['orderid'])){
    // File upload configuration
    $targetDir = (__DIR__).'/../../../uploaded/'.$nbcom.'-projects/';
    $allowTypes = array('jpg','png','jpeg','gif','pdf','tiff');
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    $images_arr = array();
    foreach($_FILES['images']['name'] as $key=>$val){
        $image_name = $_FILES['images']['name'][$key];
        $tmp_name   = $_FILES['images']['tmp_name'][$key];
        $size       = $_FILES['images']['size'][$key];
        $type       = $_FILES['images']['type'][$key];
        $error      = $_FILES['images']['error'][$key];

        // File upload path
        $fileName = basename($_FILES['images']['name'][$key]);
        $targetFilePath = $targetDir . $fileName;

        // Check whether file type is valid
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        if(in_array($fileType, $allowTypes)){
            // Store images on the server
            if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$targetFilePath)){
                $images_arr[] = $targetFilePath;
            }
        }
    }
}
?>


<script>
  jQuery(document).ready(function(){

    jQuery("#batUpload").on("submit", function(e){
      e.preventDefault();
      jQuery("#batUpbtn").html("<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i> loading...");
      jQuery.ajax({
        url: jQuery("#batUpload").attr("action"),
        type: "POST",
        data: new FormData(this),
        contentType: false,
        processData: false,

        success: function(){
          location.reload();
        }
      });
    });

  });
  </script>

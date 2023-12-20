

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <script>
    setTimeout(function(){
      $("#hidemsg").hide();
    },3000);
     </script>
 </head>
 <body>
    <h1>File Uploading</h1>
     <?php if(isset($validation)): ?>
         <div id='hidemsg'  style="color:red">  <?=$validation->listErrors() ?></div>
     <?php endif;  ?>

 <?= form_open_multipart(); ?>
  Upload Avatar: <input type='file' name='avatar'>
  <input type="submit" value="upload" >
  <a href='<?= base_url()."filecontroller/index/".$userdata['profile_pic']?>'>upload pic</a>

 <?= form_close(); ?>

    
 </body>
 </html>
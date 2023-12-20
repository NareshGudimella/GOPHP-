<?= $this->extend("layout/base"); ?>
<?= $this->section("page_title") ?>
<span>Welcome to <?=ucfirst( $userdata['username']);  ?></span>
<?= $this->endSection() ?>
<?= $this->section("content"); ?>
<div class="container">
    <div class="row">
        <div class='col-md-12'>
              <h3>Upload Avatar</h3>
              <?php if(isset($validation)): ?>
                    <div id='hidemsg' class="alert alert-danger">  <?=$validation->listErrors() ?></div>
               <?php endif;  ?>


                <?php if(session()->getTempdata("success")): ?>
                        <div id="hidemsg" class="alert alert-success"> <?= session()->getTempdata('success')  ?></div>
                 <?php endif;  ?>


                <?php if(session()->getTempdata("error")): ?>
                        <div id="hidemsg" class="alert alert-danger"> <?= session()->getTempdata('error')  ?></div>
                <?php endif;  ?>



              <?= form_open_multipart(); ?>
              <div class="form-group">
                <label> Upload Avatar </label>
                <input type='file' name='avatar' class='form-control'>
            </div>
            <div class='form-group'>
                <input type='submit' name='upload' value='Upload' class='btn btn-primary'>
              </div>
              <?=form_close(); ?>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->extend("layout/base") ?>
<?= $this->section("page_title") ?>
<span>Welcome to <?=ucfirst( $userdata['username']);  ?></span>
<?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Change Password</h3>
            <?= form_open(); ?>
            <?php if(isset($validation)): ?>
                    <div id='hidemsg' class="alert alert-danger">  <?=$validation->listErrors() ?></div>
               <?php endif;  ?>

               <?php if(session()->getTempdata("success")): ?>
                        <div id="hidemsg" class="alert alert-success"> <?= session()->getTempdata('success')  ?></div>
                 <?php endif;  ?>

                 <?php if(session()->getTempdata("error")): ?>
                        <div id="hidemsg" class="alert alert-danger"> <?= session()->getTempdata('success')  ?></div>
                 <?php endif;  ?>
                <div class='form-group'>
                    <lable>Enter Old Password</lable>
                    <input type='password' name='opwd' class='form-control'>

                </div>
                <div class='form-group'>
                    <lable>Enter New Password</lable>
                    <input type='password' name='npwd' class='form-control'>

                </div>
                <div class='form-group'>
                    <lable>Conform New Password</lable>
                    <input type='password' name='cnpwd' class='form-control'>

                </div>
                <div class='form-group'>
                    
                    <input type='submit' value="Update" class='btn btn-primary'>

                </div>

            <?= form_close(); ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
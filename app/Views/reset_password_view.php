<?=$this->extend("layout/base");    ?>
<?=$this->section("content");?>
<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-6" style="height: 520px;">
        <h1>Reset Password</h1>

        <?php if(isset($error)):  ?>
            <div class='alert alert-danger'><?=$error;?></div>
            <?php else: ?>

               <?=form_open();?>
               <?= $this->include('sections/sessions') ?>
               <?php if(isset($validation)): ?>
                       <div id='hidemsg' class='alert alert-danger'>  <?=$validation->listErrors() ?></div>
                <?php endif;  ?>
               <div class='form-group'>
                    <lable>Enter New Password</lable>
                    <input type='password' name='npwd' class='form-control'>

                </div>
                <div class='form-group'>
                    <lable>Conform New Password</lable>
                    <input type='password' name='cnpwd' class='form-control'>

                </div>
                <div class='form-group'>
                    
                    <input type='submit' value="Reset" class='btn btn-primary'>

                </div>
               <?=form_close();?>
          <?php endif; ?>

        </div>
    </div>
</div>
<?=$this->endSection();?>
<?= $this->extend("layout/base") ?>

<?= $this->section("content") ?>
<?php 
    $register_session=\CodeIgniter\Config\Services::session();  
?>
 <script>
    setTimeout(function(){
      $("#hidemsg").hide();
    },3000);
     </script>
<section>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <h1> REGISTER</h1>

                <?php if($register_session->getTempdata("sucess")): ?>
                <div id="hidemsg" class="alert alert-success"><?= $register_session->getTempdata("sucess"); ?></div>
                <?php endif; ?>

                <?php if($register_session->getTempdata("error")): ?>
                <div id="hidemsg" class="alert alert-danger"><?=$register_session->getTempdata("error"); ?></div>
                <?php endif; ?>

                <?= form_open(); ?>
                    <div class="form-group" >
                        <lable>Username</lable>
                        <input type="text" name="username"class="form-control" value="<?= set_value('username') ?>">
                        <span  class='text-danger'><?= display_error($validation,'username')  ?></span>
                    </div>
                    <div class="form-group" >
                        <lable>Email</lable>
                        <input type="text" name="email"class="form-control" value="<?= set_value('email') ?>">
                        <span  class='text-danger'><?= display_error($validation,'email')  ?></span>
                    </div>
                    <div class="form-group" >
                        <lable>Password</lable>
                        <input type="password" name="pwd"class="form-control" >
                        <span  class='text-danger'><?= display_error($validation,'pwd')  ?></span>
                    </div>
                    <div class="form-group" >
                        <lable>Conform Password</lable>
                        <input type="password" name="cpwd"class="form-control">
                        <span  class='text-danger'><?= display_error($validation,'cpwd')  ?></span>
                    </div>
                    <div class="form-group" >
                        <lable>Mobile</lable>
                        <input type="text" name="mobile"class="form-control" value="<?= set_value('mobile') ?>">
                        <span  class='text-danger'><?= display_error($validation,'mobile')  ?></span>
                    </div>
                    <div class="form-group" >
                        
                        <input type="submit" name="register" value="Register" class="btn btn-primary">
                    </div>
                <?= form_close(); ?>
            </div>
        </div>


    </div>
</section>



<?= $this->endSection() ?>
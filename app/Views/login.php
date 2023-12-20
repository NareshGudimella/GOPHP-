<?= $this->extend("layout/base") ?>


<?= $this->section("content") ?>
<script>
    setTimeout(function(){
      $("#hidemsg").hide();
    },3000);
     </script>
  
<section>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <h1> Login</h1>
                <?php if(isset($validation)): ?>
                       <div id='hidemsg' class='alert alert-danger'>  <?=$validation->listErrors() ?></div>

                <?php endif;  ?>

                <?=$this->include('sections/sessions') ?>
                <?php if(isset($error)): ?>
                    <div id='hidemsg' class='alert alert-danger'>  <?=$error ?></div>
                    <?php endif; ?>

                          <?= form_open(); ?>
                    <div class="form-group" >
                        <lable>Email</lable>
                        <input type="text" name="email"class="form-control" value='<?= set_value('email') ?>'>
                    </div>
                    
                    <div class="form-group" >
                        <lable>Password</lable>
                        <input type="password" name="pwd"class="form-control">
                    </div>
                   
                   
                    <div class="form-group" >
                        
                        <input type="submit" name="Login" value="Login" class="btn btn-primary">
                         <a href="<?= base_url('login/forgot_password') ?>">Forgot Password</a>
                    </div class="form-group">
                          <a href=''><img height='40' src='assets/images/gmailimage.jpeg'></a>
                    <div>
                        
                    </div class="form-group">
                          <a href=''><img height='40' width='242' src='assets/images/facebooklogin.png'></a>
                    <div>

                    </div>
                <?= form_close(); ?>
            </div>
        </div>


    </div>
</section>

<br><br><br><br>

<?= $this->endSection() ?>


<?= $this->extend("layout/base")?>
<?= $this->section("content") ?>



  
<section>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
                <h1> Forgot Password</h1>
                <?php if(isset($validation)): ?>
                       <div id='hidemsg' class='alert alert-danger'>  <?=$validation->listErrors() ?></div>
                <?php endif;  ?>
                <?=$this->include("sections/sessions")  ?>
                 <?= form_open(); ?>
                    <div class="form-group" >
                        <lable>Enter Your Email</lable>
                        <input type="text" name="email"class="form-control" value='<?= set_value('email') ?>'>
                    </div>
                    <div>
                        <input type="submit" class="btn btn-primary" value ="Verify">
                    </div>
                   
                <?= form_close(); ?>
            </div>
        </div>


    </div>
</section>

<br><br><br><br>

<?= $this->endSection() ?>


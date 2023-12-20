<?php 
    $page_session=\CodeIgniter\Config\Services::session();  
?>


<div  class="container">
    <div class='row' >
        <div class='col-md-12'>
            <h1>Contact Form</h1>

            <?php if($page_session->getTempdata("sucess")): ?>
                <div id="hidemsg" class="alert alert-success"><?= $page_session->getTempdata("sucess"); ?></div>
                <?php endif; ?>

                <?php if($page_session->getTempdata("error")): ?>
                <div id="hidemsg" class="alert alert-danger"><?= $page_session->getTempdata("error"); ?></div>
                <?php endif; ?>

            <?= form_open(); ?>

            <div class="form-group">
                <lable> Name </lable>
                <input type="text" name="uname" class='form-control' value='<?= set_value("uname") ?>' >
                <span  class='text-danger'><?= display_error($validation,'uname')  ?></span>
            </div>
            <div class="form-group">
                <lable> Email </lable>
                <input type="text" name="email" class='form-control' value='<?= set_value("email") ?>' >
                <span   class='text-danger'><?= display_error($validation,'email')  ?></span>
               
            </div>
            <div class="form-group">
                <lable> Mobile </lable>
                <input type="text" name="mobile" class='form-control' value='<?= set_value("mobile") ?>' >
                <span   class='text-danger'><?= display_error($validation,'mobile')  ?></span>
           
            </div>
            <div class="form-group">
                <lable> Message </lable>
                <textarea name="msg" class="form-control"><?= set_value("msg") ?></textarea>
                <span   class='text-danger'><?= display_error($validation,'msg')  ?></span>
            </div>
            <div class="form-group">
                
                <input type="submit" name="save" class='btn btn-primary' value='send' >
            </div>


            <?= form_close(); ?>
        </div>
    </div>
</div>
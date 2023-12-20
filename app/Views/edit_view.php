<?= $this->extend("layout/base") ?>
<?= $this->section("page_title") ?>
<span>Welcome to <?=ucfirst( $userdata['username']);  ?></span>
<?= $this->endSection() ?>
<?= $this->section("content") ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Edit Profile</h3>
            <?= form_open() ?>
            <?=$this->include("sections/sessions") ?>
            <div class="form-group" >
                        <lable>Username</lable>
                        <input type="text" name="username"class="form-control" value="<?= $userdata['username'] ?>">
                        <span  class='text-danger'><?= display_error($validation,'username')  ?></span>
                    </div>
                    <div class="form-group" >
                        <lable>Mobile</lable>
                        <input type="text" name="mobile"class="form-control" value="<?= $userdata['mobile'] ?>">
                        <span  class='text-danger'><?= display_error($validation,'mobile')  ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" vlaue="update">
                    </div>
            <?=form_close() ?>

        </div>
    </div>
</div>
<?= $this->endSection() ?>






<?= $this->extend("layout/base") ?>

<?= $this->section("page_title") ?>
<span>Welcome to <?=ucfirst( $userdata['username']);  ?></span>
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="container">
    <div class='col-md-12'>
            <div class='jumbotron'>
            <?= $this->include("sections/sessions") ?>
                <?php if($userdata['profile_pic'] !="") : ?>
                          <img src='<?= base_url($userdata['profile_pic'])?>'height='60'>
                    <?php else : ?>
                        <img src='assets/images/avatar.png' height="60">
                    <?php endif; ?>
                <h1>Welcome to <?=ucfirst( $userdata['username']);  ?>  </h1>
                <h4>Eamil: <?=ucfirst( $userdata['email']);  ?>  </h4>
                <h4>Mobile: <?=ucfirst( $userdata['mobile']);  ?>  </h4>
                <a href='<?= base_url()."dashboard/logout" ?>'>Logout</a>
            </div>
    </div>

</div>


<?= $this->endSection() ?>
<?= $this->extend("layout/base") ?>

<?= $this->section("page_title") ?>
<span>Welcome to <?=ucfirst( $userdata['username']);  ?></span>
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="container">
    <div class='col-md-12'>
            <div class='jumbotron'>
                <?php if($userdata['profile_pic'] !="") : ?>
                          <img src=''height='60'>
                    <?php else : ?>
                        <img src='<?=base_url("assets/images/avatar.png") ?>' height="60">
                    <?php endif; ?>
                <h1>Welcome to <?=ucfirst( $userdata['username']);  ?>  </h1>
                <h4>Eamil: <?=ucfirst( $userdata['email']);  ?>  </h4>
                <h4>Mobile: <?=ucfirst( $userdata['mobile']);  ?>  </h4>
                <a href='<?= base_url()."dashboard/logout" ?>'>Logout</a>
            </div>
            <h4>Login Activity </h4>
            <?php if(count($login_info) > 0) : ?>
                <table  class='table'>
                    <tr>
                    <th>Id</th>
                    <th>Login Time</th>
                    <th>Logout Time</th>
                    <th>User Agent</th>
                    <th>IP Address</th>
                   </tr>
                   <?php foreach($login_info as $info) : ?>
                    <tr>
                        <td><?= $info->id; ?></td>
                        <td><?= date("l d M Y h:i:s a",strtotime($info->login)); ?></td>
                        <td><?= date("l d M Y h:i:s a",strtotime($info->logout)) ?></td>
                        <td><?= $info->agent; ?></td>
                        <td><?= $info->ip; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php else : ?>
                    <h5> Sorry!! No information Found </h5>
            <?php endif;  ?>
    </div>

</div>


<?= $this->endSection() ?>
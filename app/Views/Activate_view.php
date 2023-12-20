<?= $this->extend("layout/base") ?>
<?= $this->section("content") ?>
<div class="container">
    <h1>Activation Process </h1>
   
    <?php if(isset($error)):?>
        <div class="alert alert-danger">
            <?=  $error;  ?>
            <?php endif;?>  
        </div>
        <?php if(isset($sucess)):?>
        <div class="alert alert-success">
            <?=  $sucess;  ?>
            <?php endif;?>  
        </div>


</div>

<?= $this->endSection() ?>
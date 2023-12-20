<?= $this->extend("layout/base") ?>


  <?= $this->section("content") ?>
  <script>
    setTimeout(function(){
      $("#hidemsg").hide();
    },3000);
     </script>
  
  <?= $this->include("widgets/contactform") ?>

  <?= $this->endSection() ?>



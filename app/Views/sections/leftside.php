
<section>
            <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      

      <!-- Sidebar Widgets Column -->
      <?= $this->include("widgets/sidebar") ?>
	  
        <!-- Search Widget -->
        
        <?= $this->include("widgets/search") ?>
        <!-- Categories Widget -->
        <?= $this->include("widgets/Categories") ?>
        <!-- Side Widget -->
        <?= $this->include("widgets/side") ?>
	<div class="col-lg-8">

        <!-- Content -->
        <?= $this->include("widgets/content") ?>
    </div>
    <!-- /.row -->

  </div>
        </section>
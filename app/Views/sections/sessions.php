<?php if(session()->getTempdata("success")): ?>
                        <div id="hidemsg" class="alert alert-success"> <?= session()->getTempdata('success')  ?></div>
                 <?php endif;  ?>

                 <?php if(session()->getTempdata("error")): ?>
                        <div id="hidemsg" class="alert alert-danger"> <?= session()->getTempdata('error')  ?></div>
                 <?php endif;  ?>
     <div class="container-short">
         <?php if (isset($_SESSION['success_message'])) : ?>
             <div class="alert alert-success" role="alert">
                 <?= $_SESSION['success_message'] ?>
             </div>
             <?php unset($_SESSION['success_message']); ?>
         <?php endif; ?>

         <?php if (isset($_SESSION['error_message'])) : ?>
             <div class="alert alert-danger" role="alert">
                 <?= $_SESSION['error_message'] ?>
             </div>
             <?php unset($_SESSION['error_message']); ?>
         <?php endif; ?>

         <form action="" method="POST" enctype="multipart/form-data">
             <?php if (isset($_SESSION['token'])) : ?>
                 <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
             <?php endif; ?>
             <div class="mb-3">
                 <label for="username" class="form-label">Username</label>
                 <input type="text" class="form-control" name="username" id="username">
             </div>
             <div class="mb-3">
                 <label for="email" class="form-label">Email</label>
                 <input type="email" class="form-control" name="email" id="email">
             </div>
             <div class="mb-3">
                 <label for="password" class="form-label">Password</label>
                 <input type="password" class="form-control" name="password" id="password">
             </div>
             <button type="submit" name="insert-user" class="btn btn-primary">Submit</button>
         </form>
     </div>
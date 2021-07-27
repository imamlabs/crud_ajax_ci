
<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/eksternal/login.css">

<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>

</style>
    <div class="container">
        
        <div class="card card-container">
        <h2 style="text-align:center">AMINISTRATOR CRUD</h2>
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="<?php echo base_url(); ?>assets/img/avatar.png" />
            <p id="profile-name" class="profile-name-card"></p>

            <form class="form-signin" action="<?php echo base_url('Auth/login'); ?>" method="post">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputEmail" class="form-control" placeholder="username" name="username" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
               
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Login</button>
            </form><!-- /form -->
         
     
      
      
      <?php
        echo show_err_msg($this->session->flashdata('error_msg'))."</div>";

  ?>
        </div><!-- /card-container -->

    </div><!-- /container -->
    <div class="login-box">
  <div class="login-logo">
    <img src="<?php echo base_url(); ?>assets/img/logo.png" class="prj-logo"/>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form class="form-horizontal" id="loginForm" role="form" action="<?php echo base_url(); ?>login/validate">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Please enter your user name" name='userName' autocomplete="off" required/>
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Please enter your password" name='password' autocomplete="off" required/>
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">    
                                      
            </div><!-- /.col -->
            <div class="col-xs-12 btn-center">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form> 
		
      
      <!-- /.social-auth-links -->

     
    </div>
    <!-- /.login-card-body -->
  </div>
  <div style="height:150px;">&nbsp;</div>
</div>
<!-- /.login-box -->


<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/login.js?id=<?php echo rand(5465465,6465431);?>" type="text/javascript"></script>

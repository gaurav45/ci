<!DOCTYPE html>
<html>
<head>
  <title>Slide Navbar</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
  <div class="main">    
     <?php 
      if(!empty($this->session->flashdata('msg-info'))){ ?>
        <span class="success"> <?php echo $this->session->flashdata('msg-info'); ?></span>
       <?php  }
     ?>
      <?php 
      if(!empty($this->session->flashdata('msg-danger'))){ ?>
        <span class="error"> <?php echo $this->session->flashdata('msg-danger'); ?></span>
       <?php  } ?> 
     
    <input type="checkbox" id="chk" aria-hidden="true">
    <div class="signup">
        <form method="post" action="<?php echo base_url('addUser') ?>">
          <label for="chk" aria-hidden="true">Sign up</label>
          <input type="text"  placeholder="Name" name="name">
          <span class="error"><?php echo form_error('name'); ?></span>
          <input type="email" placeholder="Email" name="email" >
           <span class="error"><?php echo form_error('email'); ?></span>
          <input type="password"  placeholder="Password" name="password" >
          <span class="error"><?php echo form_error('password'); ?></span>
          <button>Sign up</button>
        </form>
      </div>

      <div class="login">
        <form method="post" action="<?php echo base_url('checkLogin'); ?>">
          <label for="chk" aria-hidden="true">Login</label>
          <input type="email" name="lemail" placeholder="Email">
          <span class="error"><?php echo form_error('lemail'); ?></span>
          <input type="password" name="lpassword" placeholder="Password" required="">
          <span class="error"><?php echo form_error('lpassword'); ?></span>
          <button>Login</button>
        </form>
      </div>
  </div>
</body>
</html>
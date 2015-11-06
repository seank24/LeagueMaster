<?php include 'functions.php' ?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
   <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" href="index.php">The Western Seattle Pro-Am Bowling League</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav">
            <li>
               <a href="index.php"><?php echo makeHeader('home') ?></a>
            </li>
            <li>
               <a href="register.php"><?php echo makeHeader('reg') ?></a>
            </li>
            <li>
               <a href="standings.php"><?php echo makeHeader('stand') ?></a>
            </li>
            <li>
               <a href="contact.php"><?php echo makeHeader('con') ?></a>
            </li>
            <li>
               <?php echo getSessionInfo() ?>
            </li>
         </ul>
      </div>
      <!-- /.navbar-collapse -->
   </div>
   <!-- /.container -->
</nav>
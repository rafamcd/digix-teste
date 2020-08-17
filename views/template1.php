<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Digix</title>
  <link href="<?php echo BASE_URL; ?>digix/assets/css/template.css" rel="stylesheet">
  <link rel="stylesheet" href="http://code.jquery.com/qunit/qunit-1.11.0.css" type="text/css" media="all">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?php echo BASE_URL; ?>assets/template1/images/favicon-new.ico" type="image/ico" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/dist/css/skins/_all-skins.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/bower_components/select2/dist/css/select2.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>assets/template1/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    
  <?php 
                
                $nomeuser = $_SESSION['nomeuser'];
                $tipouser = $_SESSION['tipouser'];
                $imagemuser = $_SESSION['imagemuser'];
                
                
                $nomeabr = "";
                
   ?>

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo BASE_URL; ?>digix" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>D</b>ixig</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Digix</b>Tecnologia</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle Digix</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">          
          
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo BASE_URL; ?>digix/assets/images/usuarios/<?php echo $imagemuser; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo utf8_encode($nomeuser); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo BASE_URL; ?>digix/assets/images/usuarios/<?php echo $imagemuser; ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo utf8_encode($nomeuser); ?>
                  <small>Painel Administrativo - Digix</small>
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <?php if($tipouser < 3): ?>
                <div class="pull-left">
                  
                </div>
                <?php endif; ?>
                <div class="pull-right">
                    
                  <a href="<?php echo BASE_URL; ?>digix/login/logout" class="btn btn-danger btn-flat">Sair</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo BASE_URL; ?>digix/assets/images/usuarios/<?php echo $imagemuser; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">            
          <p><?php echo utf8_encode($nomeabr); ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Disponível</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
       <?php 
            $this->loadMenu();
       ?> 
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">        
      		<?php
             $this->loadViewInTemplate($viewName, $viewData);
	        ?>
        <div style="clear:both"></div>
        
      
    </section>
    <!-- /.content -->
    <div class="control-sidebar-bg"></div>
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versão</b> 1.0.1
    </div>
    <strong>Copyright &copy; 2020 <a href="http://www.digix.com.br/" target="_blank">Digix Tecnologia</a>.</strong> Todos direitos reservados.
  </footer>

  
  
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo BASE_URL; ?>assets/template1/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo BASE_URL; ?>assets/template1/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Select2 -->
<script src="<?php echo BASE_URL; ?>assets/template1/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo BASE_URL; ?>assets/template1/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo BASE_URL; ?>assets/template1/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo BASE_URL; ?>assets/template1/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo BASE_URL; ?>assets/template1/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo BASE_URL; ?>assets/template1/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/template1/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo BASE_URL; ?>assets/template1/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo BASE_URL; ?>assets/template1/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/template1/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo BASE_URL; ?>assets/template1/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo BASE_URL; ?>assets/template1/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo BASE_URL; ?>assets/template1/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo BASE_URL; ?>assets/template1/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo BASE_URL; ?>assets/template1/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo BASE_URL; ?>assets/template1/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo BASE_URL; ?>assets/template1/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo BASE_URL; ?>assets/template1/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo BASE_URL; ?>assets/template1/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo BASE_URL; ?>assets/template1/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo BASE_URL; ?>assets/template1/dist/js/demo.js"></script>
<script src="<?php echo BASE_URL; ?>digix/assets/js/script_valor.js" /></script>
<!-- Input Masks -->
<script src="<?php echo BASE_URL; ?>digix/assets/js/jquery.maskMoney.js" /></script>
<script src="<?php echo BASE_URL; ?>digix/assets/js/jquery.mask.js"></script>
<!-- Input Masks -->
<script src="<?php echo BASE_URL; ?>digix/assets/js/script.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
</body>
</html>

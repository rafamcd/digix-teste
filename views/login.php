<!doctype html>
<html class="fixed">
	<head>
        <!-- Basic -->
        <meta charset="UTF-8">

        <!-- Mobile Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

        <title>Área Restrita - Digix</title>
        <!-- Web Fonts  -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

        <!-- Vendor CSS -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>digix/assets/login/vendor/bootstrap/css/bootstrap.css" />

        <link rel="stylesheet" href="<?php echo BASE_URL; ?>digix/assets/login/vendor/font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>digix/assets/login/vendor/magnific-popup/magnific-popup.css" />
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>digix/assets/login/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css" />

        <!-- Theme CSS -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>digix/assets/login/stylesheets/theme.css" />

        <!-- Skin CSS -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>digix/assets/login/stylesheets/skins/default.css" />

        <!-- Theme Custom CSS -->
        <link rel="stylesheet" href="<?php echo BASE_URL; ?>digix/assets/login/stylesheets/theme-custom.css">

        <!-- Head Libs -->
        <script src="<?php echo BASE_URL; ?>digix/assets/login/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
            <!-- start: page -->
            <section class="body-sign">
                    <div class="center-sign">
                            <a href="/" class="logo pull-right">
                                    <img src="http://digix.com.br/wp-content/themes/_digix/img/logos/logo-orange.svg" height="65" width="100" alt="Inteco Tecnologia" />
                            </a>

                            <div class="panel panel-sign">
                                <div class="panel-title-sign mt-xl text-left">
                                        <h2 class="title text-uppercase text-weight-bold m-none"><i class="fa fa-user mr-xs"></i> Login</h2>
                                </div>
                                <div class="panel-body">
                                    <form method="post">
                                        <div class="form-group mb-lg">
                                            <label>Usuário</label>
                                            <div class="input-group input-group-icon">
                                                    <input name="usuario" type="text" class="form-control input-lg" />
                                                    <span class="input-group-addon">
                                                            <span class="icon icon-lg">
                                                                    <i class="fa fa-user"></i>
                                                            </span>
                                                    </span>
                                            </div>
                                        </div>

                                        <div class="form-group mb-lg">
                                            <div class="clearfix">
                                                    <label class="pull-left">Senha</label>									
                                            </div>
                                            <div class="input-group input-group-icon">
                                                    <input name="senha" type="password" class="form-control input-lg" />
                                                    <span class="input-group-addon">
                                                            <span class="icon icon-lg">
                                                                    <i class="fa fa-lock"></i>
                                                            </span>
                                                    </span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                    <button type="submit" class="btn btn-primary hidden-xs">Entrar</button>
                                                    <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Entrar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php if(!empty($aviso)): ?>
                                <div class="alert alert-warning alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> <?php echo $aviso; ?></h4>
                                </div>                                                            
                            <?php endif; ?>
                            <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2020. Todos direitos reservados.</p>
                    </div>
            </section>
		<!-- end: page -->

        <!-- Vendor -->
        <script src="<?php echo BASE_URL; ?>digix/assets/login/vendor/jquery/jquery.js"></script>
        <script src="<?php echo BASE_URL; ?>digix/assets/login/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
        <script src="<?php echo BASE_URL; ?>digix/assets/login/vendor/bootstrap/js/bootstrap.js"></script>
        <script src="<?php echo BASE_URL; ?>digix/assets/login/vendor/nanoscroller/nanoscroller.js"></script>
        <script src="<?php echo BASE_URL; ?>digix/assets/login/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="<?php echo BASE_URL; ?>digix/assets/login/vendor/magnific-popup/jquery.magnific-popup.js"></script>
        <script src="<?php echo BASE_URL; ?>digix/assets/login/vendor/jquery-placeholder/jquery-placeholder.js"></script>

        <!-- Theme Base, Components and Settings -->
        <script src="<?php echo BASE_URL; ?>digix/assets/login/javascripts/theme.js"></script>

        <!-- Theme Custom -->
        <script src="<?php echo BASE_URL; ?>digix/assets/login/javascripts/theme.custom.js"></script>

        <!-- Theme Initialization Files -->
        <script src="<?php echo BASE_URL; ?>digix/assets/login/javascripts/theme.init.js"></script>

	</body>
</html>
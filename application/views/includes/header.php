<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>
    <?php echo $pageTitle; ?>
  </title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.4 -->
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- FontAwesome 4.3.0 -->
  <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons 2.0.0 -->
  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <!-- Datatables style -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fc-3.2.4/fh-3.1.3/kt-2.3.2/r-2.2.1/rg-1.0.2/rr-1.2.3/sc-1.4.4/sl-1.2.5/datatables.min.css"
  />
  <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
  <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  <style>
    .error {
      color: red;
      font-weight: normal;
    }
  </style>
  <!-- jQuery 2.1.4 -->
  <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>
  <script type="text/javascript">
    var baseURL = "<?php echo base_url(); ?>";
  </script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo base_url(); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
          <b>BSE</b>U</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
          <b>QUALI</b>CAD</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown tasks-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                <i class="fa fa-history"></i>
              </a>
              <ul class="dropdown-menu">
                <li class="header"> Son Giriş :
                  <i class="fa fa-clock-o"></i>
                  <?= empty($last_login) ? "İlk Giriş" : $last_login; ?>
                </li>
              </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url(); ?>assets/dist/img/avatar2.png" class="user-image" alt="User Image" />
                <span class="hidden-xs">
                  <?php echo $name; ?>
                </span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo base_url(); ?>assets/dist/img/avatar2.png" class="img-circle" alt="User Image" />
                  <p>
                    <?php echo $name; ?>
                    <small>
                      <?php echo $role_text; ?>
                    </small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                <div class="pull-left">
                  <?php echo $this->session->userdata('nomeEmpresa');?>
                </div>
                <!--  <div class="pull-left">
                    <a href="<?php // echo base_url(); ?>userEdit" class="btn btn-default btn-flat">
                      <i class="fa fa-key"></i> Meus dados </a>
                  </div> -->
                  <div class="pull-right">
                    <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat">
                      <i class="fa fa-sign-out"></i> Sair</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">
          </li>
          <li class="treeview">
            <a href="<?php echo base_url(); ?>dashboard">
              <i class="fa fa-dashboard"></i>
              <span>Alterar a senha</span>
              </i>
            </a>
          </li>


            <?php
            // Rol definetion in application/config/constants.php
            // if($role == ROLE_ADMIN)
           //  {
            ?>
            <hr>
                <li class="treeview">
                  <a href="<?php echo base_url(); ?>cadastroUsuario/listar">
                    <i class="fa fa-th"></i>
                    <span>Usuário</span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="<?php echo base_url(); ?>cadastroEmpresa/listar">
                    <i class="fa fa-th"></i>
                    <span>Empresa</span>
                  </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>cadastroPerfil/listar">
                        <i class="fa fa-th"></i>
                        <span>Perfil</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>cadastroTelas/listar">
                        <i class="fa fa-th"></i>
                        <span>Telas</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>cadastroPermissao/listar">
                        <i class="fa fa-th"></i>
                        <span>Permissão</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>cadastroUsuarioEmpresa/listar">
                        <i class="fa fa-th"></i>
                        <span>Usuário/Empresa</span>
                    </a>
                </li>    

                <hr>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>principalConvenio/listar">
                        <i class="fa fa-th"></i>
                        <span>Convênio</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>principalPlano/listar">
                        <i class="fa fa-th"></i>
                        <span>Plano</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>principalFaturamento/listar">
                        <i class="fa fa-th"></i>
                        <span>Faturamento</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>principalFaturamentoItem/listar">
                        <i class="fa fa-th"></i>
                        <span>Faturamento Item</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>principalRegra/listar">
                        <i class="fa fa-th"></i>
                        <span>Regra</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>principalRegraGrupoPro/listar">
                        <i class="fa fa-th"></i>
                        <span>RegraGrupoPro</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>principalIndice/listar">
                        <i class="fa fa-th"></i>
                        <span>Índice</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>principalIndiceGrupoPro/listar">
                        <i class="fa fa-th"></i>
                        <span>ÍndiceGrupoPro</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>principalProibicao/listar">
                        <i class="fa fa-th"></i>
                        <span>Proibição</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>principalRegraProibicao/listar">
                        <i class="fa fa-th"></i>
                        <span>RegraProibição</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>principalFracaoSimproBra/listar">
                        <i class="fa fa-th"></i>
                        <span>FraçãoSimproBra</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>principalUnidade/listar">
                        <i class="fa fa-th"></i>
                        <span>Unidade</span>
                    </a>
                </li>

                <hr>

                <li class="treeview" data-toggle="collapse" data-target="#test" style="margin-bottom: 10px!important;cursor: pointer!important;">
                    <i class="fa fa-th" style="margin-left:18px;color:white"></i>
                    <span style="margin-left:5px;color:white">Importação</span>

                    <ul class="nav nav-list collapse" style="margin-top:10px" id="test">
                        <li class="treeview" style="margin-left:22px;">
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-upload"></i>
                                <span style="margin-left:5px">Produção</span>
                            </a>
                        </li>
                        <li class="treeview" style="margin-left:22px;">
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-upload"></i>
                                <span style="margin-left:5px">Produto</span>
                            </a>
                        </li>
                        <li class="treeview" style="margin-left:22px;">
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-upload"></i>
                                <span style="margin-left:5px">GrupoFaturamento</span>
                            </a>
                        </li>
                        <li class="treeview" style="margin-left:22px;">
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-upload"></i>
                                <span style="margin-left:5px">ProFat</span>
                            </a>
                        </li>
                        <li class="treeview" style="margin-left:22px;">
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-upload"></i>
                                <span style="margin-left:5px">TUSS</span>
                            </a>
                        </li>
                        <li class="treeview" style="margin-left:22px;">
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-upload"></i>
                                <span style="margin-left:5px">GrupoPro</span>
                            </a>
                        </li>
                        <li class="treeview" style="margin-left:22px;">
                            <a href="<?php echo base_url(); ?>">
                                <i class="fa fa-upload"></i>
                                <span style="margin-left:5px">SimproBrasindice</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>dadas">
                        <i class="fa fa-th"></i>
                        <span>Exportação</span>
                    </a>
                </li>
                <li class="treeview">
                    <a href="<?php echo base_url(); ?>dasdas">
                        <i class="fa fa-th"></i>
                        <span>Relatórios</span>
                    </a>
                </li>



                <?php

          //  }

            ?>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
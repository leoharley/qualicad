<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Cadastrar Usuário / Empresa
            <small>Associar</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Selecione os campos abaixo</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewUser" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="idusuario">Usuário</label>
                                        <select class="form-control required" id="idusuario" name="idusuario">
                                            <option value="1">USUARIO_1</option>
											<option value="2">USUARIO_2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="idempresa">Empresa</label>
                                        <select class="form-control required" id="idempresa" name="idempresa">
                                            <option value="1">EMPRESA_1</option>
											<option value="2">EMPRESA_2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="idpermissao">Tipo de permissão</label>
                                        <select class="form-control required" id="idpermissao" name="idpermissao">
                                            <option value="1">PERMISSAO_1</option>
											<option value="2">PERMISSAO_2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Salvar" />
                            <input type="reset" class="btn btn-default" value="Limpar" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                        </div>
                    </div>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>
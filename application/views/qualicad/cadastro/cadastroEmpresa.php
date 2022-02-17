<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Cadastro de Empresa
            <small>Adicionar</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Preencha os campos abaixos</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewUser" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nome_empresa">Nome</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('nome_empresa'); ?>" id="nome_empresa" name="nome_empresa" maxlength="128">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cnpj">CNPJ</label>
                                        <input type="text" class="form-control required cnpj" id="cnpj" value="<?php echo set_value('cnpj'); ?>" name="cnpj"
                                            maxlength="13">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cd_empresaerp">Código</label>
                                        <input type="text" class="form-control required cd_empresaerp" id="cd_empresaerp" value="<?php echo set_value('cd_empresaerp'); ?>" name="cd_empresaerp"
                                            maxlength="13">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cd_empresaerp">Endereço</label>
                                        <input type="text" class="form-control required cd_empresaerp" id="cd_empresaerp" value="<?php echo set_value('cd_empresaerp'); ?>" name="cd_empresaerp"
                                            maxlength="13">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nomecontato">Nome do contato</label>
                                        <input type="text" class="form-control required" id="nomecontato" value="<?php echo set_value('nomecontato'); ?>" name="nomecontato"
                                            maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telefone">Telefone</label>
                                        <input type="text" class="form-control required" id="telefone" value="<?php echo set_value('telefone'); ?>" name="telefone"
                                            maxlength="11">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control required" id="email" value="<?php echo set_value('email'); ?>" name="email"
                                            maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dtvalidacontrato">Data de validade do contrato</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('dtvalidacontrato'); ?>" id="dtvalidacontrato" name="dtvalidacontrato">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dtativo">Data de atividade</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('dtativo'); ?>" id="dtativo" name="dtativo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dtinativo">Data de inatividade</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('dtinativo'); ?>" id="dtinativo" name="dtinativo">
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
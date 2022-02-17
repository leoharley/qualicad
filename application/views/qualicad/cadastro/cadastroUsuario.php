<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Cadastro de Usuários
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

                                <!-- VARCHAR/INTEGER/FLOAT -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nome_usuario">Nome</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('nome_usuario'); ?>" id="nome_usuario" name="nome_usuario" maxlength="128">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpf_usuario">CPF</label>
                                        <input type="text" class="form-control required cpf_usuario" id="cpf_usuario" value="<?php echo set_value('cpf_usuario'); ?>" name="cpf_usuario"
                                            maxlength="11">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('email'); ?>" id="email" name="email" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tp_ativo">Usuário ativo?</label>
                                        <select class="form-control required" id="tp_ativo" name="tp_ativo">
                                            <option value="1">CAMPO_BD_TP_1</option>
											<option value="2">CAMPO_BD_TP_2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dt_ativo">Data ativo</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('dt_ativo'); ?>" id="dt_ativo" name="dt_ativo">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dt_inativo">Data inativo</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('dt_inativo'); ?>" id="dt_inativo" name="dt_inativo">
                                    </div>
                                </div>                         
                            </div>

                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="senha">Senha</label>
                                        <input type="password" class="form-control required" id="senha" name="senha" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="resenha">Redigite a senha</label>
                                        <input type="password" class="form-control required equalTo" id="resenha" name="resenha" maxlength="20">
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
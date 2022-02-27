<?php

$Id_CdPerfil  = '';
$Ds_Perfil = '';
$Tp_Ativo = '';

if ($this->uri->segment(2) == 'editar') {
if(!empty($infoPerfil))
{
    foreach ($infoPerfil as $r)
    {
        $Id_CdPerfil = $r->Id_CdPerfil;
        $Ds_Perfil = $r->Ds_Perfil;
        $Tp_Ativo = $r->Tp_Ativo;
    }
}
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Cadastrar Telas
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
                                        <label for="dsperfil">Perfil</label>
                                        <select class="form-control required" id="dsperfil" name="dsperfil">
                                            <option value="1">PERFIL_1</option>
											<option value="2">PERFIL_2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telaconvenio">Acessa tela de convênio?</label>
                                        <select class="form-control required" id="telaconvenio" name="telaconvenio">
                                            <option value="1">SIM</option>
											<option value="2">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telaplano">Acessa tela de plano?</label>
                                        <select class="form-control required" id="telaplano" name="telaplano">
                                            <option value="1">SIM</option>
											<option value="2">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telaindice">Acessa tela de índice?</label>
                                        <select class="form-control required" id="telaindice" name="telaindice">
                                            <option value="1">SIM</option>
											<option value="2">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telaregrafat">Acessa tela de regra de faturamento?</label>
                                        <select class="form-control required" id="telaregrafat" name="telaregrafat">
                                            <option value="1">SIM</option>
											<option value="2">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telausuario">Acessa tela de usuário?</label>
                                        <select class="form-control required" id="telausuario" name="telausuario">
                                            <option value="1">SIM</option>
											<option value="2">NÃO</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telaempresa">Acessa tela de empresa?</label>
                                        <select class="form-control required" id="telaempresa" name="telaempresa">
                                            <option value="1">SIM</option>
											<option value="2">NÃO</option>
                                        </select>
                                    </div>
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
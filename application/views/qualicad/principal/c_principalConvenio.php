<?php

$Id_Convenio = '';
$Ds_Convenio = '';
$CNPJ_Convenio = '';
$Cd_ConvenioERP = '';
$Tp_Convenio = '';
$Dt_InicioConvenio = '';
$Dt_VigenciaConvenio = '';
$Tp_Ativo = '';

if ($this->uri->segment(2) == 'editar') {
if(!empty($infoConvenio))
{
    foreach ($infoConvenio as $r)
    {
        $Id_Convenio = $r->Id_Convenio;
        $Ds_Convenio = $r->Ds_Convenio;
        $CNPJ_Convenio = $r->CNPJ_Convenio;
        $Cd_ConvenioERP = $r->Cd_ConvenioERP;
        $Tp_Convenio = $r->Tp_Convenio;
        $Dt_InicioConvenio = $r->Dt_InicioConvenio;
        $Dt_VigenciaConvenio = $r->Dt_VigenciaConvenio;
        $Tp_Ativo = $r->Tp_Ativo;
    }
}
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        <i class="fa fa-users"></i> <?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Cadastrar Convênio' : 'Editar Convênio' ; ?>
        <small><?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Adicionar' : 'Editar' ; ?></small>
    </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Selecione e preencha os campos abaixo</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addConvenio" action="<?php echo ($this->uri->segment(2) == 'cadastrar') ? base_url().'adicionaConvenio' : base_url().'editaConvenio'; ?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Ds_Convenio">Convênio (descrição)</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_Convenio') : $Ds_Convenio ; ?>" id="Ds_Convenio" name="Ds_Convenio" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="CNPJ_Convenio">CNPJ</label>
                                        <input type="text" data-inputmask="'mask': '99.999.999/9999-99'" class="form-control required cnpj" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('CNPJ_Convenio') : $CNPJ_Convenio ; ?>" id="CNPJ_Convenio" name="CNPJ_Convenio" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Cd_ConvenioERP">Código ERP</label>
                                        <input type="text" class="form-control required" id="Cd_ConvenioERP" value="<?php echo set_value('Cd_ConvenioERP'); ?>" name="Cd_ConvenioERP"
                                            maxlength="13">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_Convenio">Tipo</label>
                                        <select class="form-control required" id="Tp_Convenio" name="Tp_Convenio">
                                            <option value="1">Convênio</option>
                                            <option value="2">Filantrópico</option>
                                            <option value="3">Particular</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Dt_InicioConvenio">Data de ínicio</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('Dt_InicioConvenio'); ?>" id="Dt_InicioConvenio" name="Dt_InicioConvenio">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Dt_VigenciaConvenio">Data da vigência</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('Dt_VigenciaConvenio'); ?>" id="Dt_VigenciaConvenio" name="Dt_VigenciaConvenio">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_Ativo">Convênio ativo?</label>
                                        <select class="form-control required" id="Tp_Ativo" name="Tp_Ativo">
                                            <option value="S" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Ativo == 'S') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>Sim</option>
											<option value="N" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Ativo == 'N') { echo 'selected'; } ?>>Não</option>
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
<script src="<?php echo base_url(); ?>assets/js/addConvenio.js" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $(":input").inputmask();
});
</script>
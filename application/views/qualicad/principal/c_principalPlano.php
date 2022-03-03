<?php

$Id_Plano = '';
$TbConvenio_Id_Convenio = '';
$TbIndice_Id_Indice = '';
$TbRegra_Id_Regra = '';
$Ds_Plano = '';
$Cd_PlanoERP = '';
$Tp_AcomodacaoPadrao = '';
$Tp_Ativo = '';

if ($this->uri->segment(2) == 'editar') {
if(!empty($infoPlano))
{
    foreach ($infoPlano as $r)
    {
        $Id_Plano = $r->Id_Plano;
        $TbConvenio_Id_Convenio = $r->TbConvenio_Id_Convenio;
        $TbIndice_Id_Indice = $r->TbIndice_Id_Indice;
        $TbRegra_Id_Regra = $r->TbRegra_Id_Regra;
        $Ds_Plano = $r->Ds_Plano;
        $Cd_PlanoERP = $r->Cd_PlanoERP;
        $Tp_AcomodacaoPadrao = $r->Tp_AcomodacaoPadrao;
        $Tp_Ativo = $r->Tp_Ativo;
    }
}
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> <?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Cadastrar Plano' : 'Editar Plano' ; ?>
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
                    <form role="form" id="addPlano" action="<?php echo ($this->uri->segment(2) == 'cadastrar') ? base_url().'adicionaPlano' : base_url().'editaPlano'; ?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Id_Convenio">Convênio</label>
                                        <select class="form-control required" id="Id_Convenio" name="Id_Convenio">
                                            <?php
                                            if(!empty($infoConvenio))
                                            {
                                                foreach ($infoConvenio as $convenio)
                                                {
                                                    ?>
                                                <option value="<?php echo $convenio->Id_Convenio ?>">
                                                    <?php echo $convenio->Ds_Convenio ?>
                                                </option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Id_Indice">Índice</label>
                                        <select class="form-control required" id="Id_Indice" name="Id_Indice">
                                            <?php
                                            if(!empty($infoIndice))
                                            {
                                                foreach ($infoIndice as $indice)
                                                {
                                                    ?>
                                                <option value="<?php echo $indice->Id_Indice ?>">
                                                    <?php echo $indice->Ds_indice ?>
                                                </option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Id_Regra">Regra</label>
                                        <select class="form-control required" id="Id_Regra" name="Id_Regra">
                                            <?php
                                            if(!empty($infoRegra))
                                            {
                                                foreach ($infoRegra as $regra)
                                                {
                                                    ?>
                                                <option value="<?php echo $regra->Id_Regra ?>">
                                                    <?php echo $regra->Ds_Regra ?>
                                                </option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Ds_Plano">Descrição do plano</label>
                                        <input type="text" class="form-control required" id="Ds_Plano" value="<?php echo set_value('Ds_Plano'); ?>" name="Ds_Plano"
                                            maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Cd_PlanoERP">Código ERP</label>
                                        <input type="text" class="form-control required" id="Cd_PlanoERP" value="<?php echo set_value('Cd_PlanoERP'); ?>" name="Cd_PlanoERP"
                                            maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_AcomodacaoPadrao">Tipo de acomodação padrão</label>
                                        <select class="form-control required" id="Tp_AcomodacaoPadrao" name="Tp_AcomodacaoPadrao">
                                            <option value="1">Enfermaria</option>
                                            <option value="2">Apartamento</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_Ativo">Plano ativo?</label>
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
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>
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

                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php } ?>
                <?php  
                        $success = $this->session->flashdata('success');
                        if($success)
                        {
                    ?>
                <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>

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
                                        <label for="TbConvenio_Id_Convenio">Convênio</label>
                                        <select class="form-control required" id="TbConvenio_Id_Convenio" name="TbConvenio_Id_Convenio">
                                            <?php
                                            if(!empty($infoConvenio))
                                            {
                                                foreach ($infoConvenio as $convenio)
                                                {
                                                    ?>
                                                <option value="<?php echo $convenio->Id_Convenio ?>" <?php if ($this->uri->segment(2) == 'editar' && $convenio->Id_Convenio == $TbConvenio_Id_Convenio) { echo 'selected'; } ?>>
                                                    <?php echo $convenio->Ds_Convenio ?>
                                                </option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" value="<?php echo $Id_Plano; ?>" name="Id_Plano" id="Id_Plano" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="TbIndice_Id_Indice">Índice</label>
                                        <select class="form-control required" id="TbIndice_Id_Indice" name="TbIndice_Id_Indice">
                                            <?php
                                            if(!empty($infoIndice))
                                            {
                                                foreach ($infoIndice as $indice)
                                                {
                                                    ?>
                                                <option value="<?php echo $indice->Id_Indice ?>" <?php if ($this->uri->segment(2) == 'editar' && $indice->Id_Indice == $TbIndice_Id_Indice) { echo 'selected'; } ?>>
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
                                        <label for="TbRegra_Id_Regra">Regra</label>
                                        <select class="form-control required" id="TbRegra_Id_Regra" name="TbRegra_Id_Regra">
                                            <?php
                                            if(!empty($infoRegra))
                                            {
                                                foreach ($infoRegra as $regra)
                                                {
                                                    ?>
                                                <option value="<?php echo $regra->Id_Regra ?>" <?php if ($this->uri->segment(2) == 'editar' && $regra->Id_Regra == $TbRegra_Id_Regra) { echo 'selected'; } ?>>
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
                                        <input type="text" class="form-control required" id="Ds_Plano" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_Plano') : $Ds_Plano ; ?>" name="Ds_Plano"
                                            maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Cd_PlanoERP">Código ERP</label>
                                        <input type="text" class="form-control required" id="Cd_PlanoERP" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Cd_PlanoERP') : $Cd_PlanoERP ; ?>" name="Cd_PlanoERP"
                                            maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_AcomodacaoPadrao">Tipo de acomodação padrão</label>
                                        <select class="form-control required" id="Tp_AcomodacaoPadrao" name="Tp_AcomodacaoPadrao">
                                            <option value="1" <?php if ($this->uri->segment(2) == 'editar' && $Tp_AcomodacaoPadrao == '1') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>Enfermaria</option>
                                            <option value="2" <?php if ($this->uri->segment(2) == 'editar' && $Tp_AcomodacaoPadrao == '2') { echo 'selected'; } ?>>Apartamento</option>
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
                            <input type="submit" class="btn btn-primary" value="Salvar e ir para lista" name="salvarIrLista"/>
                            <input type="submit" class="btn btn-primary" value="Salvar e cadastrar outro plano" name="salvarMesmaTela" style="margin-left:30px;<?php if ($this->uri->segment(2) == 'editar') { echo 'display:none'; } ?>"/>
                            <input type="submit" class="btn btn-primary" value="Salvar e cadastrar convênio" name="salvarRetroceder" style="margin-left:30px;<?php if ($this->uri->segment(2) == 'editar') { echo 'display:none'; } ?>"/>
                        <!--    <input type="reset" class="btn btn-info" value="Limpar Campos" /> -->
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
<?php

$Id_ExcValores = '';
$CD_Convenio = '';
$Cd_TUSS = '';
$Cd_ProFat = '';
$Ds_ExcValores = '';
$ClasseEvento = '';
$Tp_ExcValores = '';
$Vl_ExcValores = '';
$Tp_Ativo = '';

if ($this->uri->segment(2) == 'editar') {
if(!empty($infoExcecaoValores))
{
    foreach ($infoExcecaoValores as $r)
    {
        $Id_ExcValores = $r->Id_ExcValores;
        $CD_Convenio = $r->CD_Convenio;
        $Cd_TUSS = $r->Cd_TUSS;
        $Cd_ProFat = $r->Cd_ProFat;
        $Ds_ExcValores = $r->Ds_ExcValores;
        $ClasseEvento = $r->ClasseEvento;
        $Tp_ExcValores = $r->Tp_ExcValores;
        $Vl_ExcValores = $r->Vl_ExcValores;
        $Tp_Ativo = $r->Tp_Ativo;
    }
}
}

?>

<style>
    table, th, td {
    border: 1px solid #c0c0c0;
    border-collapse: collapse;
    }
    table input {border:0!important;outline:0;}
    table input:focus {outline:none!important;}
    table select {border:0!important;outline:0;}
    table select:focus {outline:none!important;}

    table thead {
    position: sticky;
    top: 0;
    }

    table thead th {
    border: 1px solid #e4eff8;
    background: white;
    cursor: pointer;
    }

    table thead th.header-label {
    cursor: pointer;
    background: linear-gradient(0deg, #3c8dbc, #4578a2 5%, #e4eff8 150%);
    color: white;
    border: 1px solid white;
    }


</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        <i class="fa fa-users"></i> <?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Cadastrar Exceção Valores' : 'Editar Exceção Valores' ; ?>
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
                    <form role="form" id="addExcecaoValores" action="<?php echo ($this->uri->segment(2) == 'cadastrar') ? base_url().'adicionaExcecaoValores' : base_url().'editaExcecaoValores'; ?>" method="post" role="form">
                        <div class="box-body" style="padding-left:1rem;padding-right:1rem">
                            <div class="row">
                                <div class="col-md-2">
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
                                                    <?php echo $convenio->Id_Convenio.' - '.$convenio->Ds_Convenio ?>
                                                </option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" value="<?php echo $Id_ExcValores; ?>" name="Id_ExcValores" id="Id_ExcValores" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="TbTUSS_Id_Tuss">TUSS associada</label>
                                        <select class="form-control required" id="TbTUSS_Id_Tuss" name="TbTUSS_Id_Tuss">
                                            <?php
                                            if(!empty($infoTUSS))
                                            {
                                                foreach ($infoTUSS as $tuss)
                                                {
                                                    ?>
                                                <option value="<?php echo $tuss->Id_Tuss ?>" <?php if ($this->uri->segment(2) == 'editar' && $tuss->Id_Tuss == $TbTUSS_Id_Tuss) { echo 'selected'; } ?>>
                                                    <?php echo $tuss->Id_Tuss.' - '.$tuss->Ds_Tuss ?>
                                                </option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="TbProFat_Cd_ProFat">ProFat associado</label>
                                        <select class="form-control required" id="TbProFat_Cd_ProFat" name="TbProFat_Cd_ProFat">
                                            <?php
                                            if(!empty($infoProFat))
                                            {
                                                foreach ($infoProFat as $proFat)
                                                {
                                                    ?>
                                                <option value="<?php echo $proFat->Cd_ProFat ?>" <?php if ($this->uri->segment(2) == 'editar' && $proFat->Cd_ProFat == $TbProFat_Cd_ProFat) { echo 'selected'; } ?>>
                                                    <?php echo $proFat->Cd_ProFat.' - '.$proFat->Ds_ProFat ?>
                                                </option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" value="<?php echo $Id_FracaoSimproBra; ?>" name="Id_FracaoSimproBra" id="Id_FracaoSimproBra" />
                                    </div>
                                </div>
                       <!--    </div> -->
                        <!--    <div class="row"> -->
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="Ds_ExcValores">Descrição</label>
                                        <input type="text" class="form-control required" id="Ds_ExcValores" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_ExcValores') : $Ds_ExcValores ; ?>" name="Ds_ExcValores"
                                            maxlength="13">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="ClasseEvento">Classe Evento</label>
                                        <input type="text" class="form-control required" id="ClasseEvento" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('ClasseEvento') : $ClasseEvento ; ?>" name="ClasseEvento"
                                            maxlength="13">
                                    </div>
                                </div>
                        <!--    </div> -->
                        <!--    <div class="row"> -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Tp_ExcValores">Tipo</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Tp_ExcValores') : $Tp_ExcValores ; ?>" id="Tp_ExcValores" name="Tp_ExcValores">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Vl_ExcValores">Valor</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_ExcValores') : $Vl_ExcValores ; ?>" id="Vl_ExcValores" name="Vl_ExcValores">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="Tp_Ativo">Ativo?</label>
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
                            <input type="button" class="btn btn-primary" onclick="window.location='<?php echo base_url(); ?>principalConvenio/listar';" value="Lista (CTRL+L)" name="IrLista" id="IrLista"/>
                            <input type="submit" class="btn btn-primary" value="Salva e lista (CTRL+S)" name="salvarIrLista" id="salvarIrLista" style="margin-left:5px;"/>
                            <input type="submit" class="btn btn-primary" value="Salva e cadastra outra exceção (CTRL+A)" name="salvarMesmaTela" id="salvarMesmaTela" style="margin-left:5px;<?php if ($this->uri->segment(2) == 'editar') { echo 'display:none'; } ?>"/>
                        <!--    <input type="submit" class="btn btn-primary" value="Salva e cadastra plano (CTRL+P)" name="salvarAvancar" id="salvarAvancar" style="margin-left:5px;<?php //if ($this->uri->segment(2) == 'editar') { echo 'display:none'; } ?>"/> -->
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
<script src="<?php echo base_url(); ?>assets/js/addConvenio.js" type="text/javascript"></script>
<script>

    $(document).ready(function(){
        $(":input").inputmask();
    });
    shortcut.add("ctrl+l", function() {
    document.getElementById('IrLista').click();
    });   
    shortcut.add("ctrl+s", function() {
        document.getElementById('salvarIrLista').click();
    });
    shortcut.add("ctrl+a", function() {
        document.getElementById('salvarMesmaTela').click();
    });
    shortcut.add("ctrl+p", function() {
        document.getElementById('salvarPlano').click();
    });

</script>
<?php

$Id_Indice = '';
$Ds_indice = '';
$Dt_IniVigencia = '';
$Dt_FimVigencia = '';
$Vl_Indice = '';
$Vl_M2Filme = '';
$Vl_Honorário = '';
$Vl_UCO = '';
$Tp_Ativo = '';

if ($this->uri->segment(2) == 'editar') {
if(!empty($infoIndice))
{
    foreach ($infoIndice as $r)
    {
        $Id_Indice = $r->Id_Indice;
        $Ds_indice = $r->Ds_indice;
        $Dt_IniVigencia = $r->Dt_IniVigencia;
        $Dt_FimVigencia = $r->Dt_FimVigencia;
        $Vl_Indice = $r->Vl_Indice;
        $Vl_M2Filme = $r->Vl_M2Filme;
        $Vl_Honorário = $r->Vl_Honorário;
        $Vl_UCO = $r->Vl_UCO;
        $Tp_Ativo = $r->Tp_Ativo;
    }
}
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> <?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Cadastrar Índice' : 'Editar Índice' ; ?>
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
                    <form role="form" id="addIndice" action="<?php echo ($this->uri->segment(2) == 'cadastrar') ? base_url().'adicionaIndice' : base_url().'editaIndice'; ?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Ds_indice">Índice (descrição)</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_indice') : $Ds_indice ; ?>" id="Ds_indice" name="Ds_indice" maxlength="128">
                                        <input type="hidden" value="<?php echo $Id_Indice; ?>" name="Id_Indice" id="Id_Indice" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Dt_IniVigencia">Data de início da vigência</label>
                                        <input type="date" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Dt_IniVigencia') : $Dt_IniVigencia ; ?>" id="Dt_IniVigencia" name="Dt_IniVigencia">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Dt_FimVigencia">Data de fim da vigência</label>
                                        <input type="date" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Dt_FimVigencia') : $Dt_FimVigencia ; ?>" id="Dt_FimVigencia" name="Dt_FimVigencia">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Vl_Indice">Valor índice</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_Indice') : $Vl_Indice ; ?>" id="Vl_Indice" name="Vl_Indice">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Vl_M2Filme">Valor M2 Filme</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_M2Filme') : $Vl_M2Filme ; ?>" id="Vl_M2Filme" name="Vl_M2Filme"
                                        maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Vl_Honorário">Valor honorário</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_Honorário') : $Vl_Honorário ; ?>" id="Vl_Honorário" name="Vl_Honorário"
                                        maxlength="11">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Vl_UCO">Valor UCO</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_UCO') : $Vl_UCO ; ?>" id="Vl_UCO" name="Vl_UCO"
                                        maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_Ativo">Índice ativo?</label>
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
                            <input type="submit" class="btn btn-primary" value="Ir para Lista" name="IrLista"/>
                            <input type="submit" class="btn btn-primary" value="Salvar e ir para lista" name="salvarIrLista" style="margin-left:15px;"/>
                            <input type="submit" class="btn btn-primary" value="Salvar e cadastrar outro índice" name="salvarMesmaTela" style="margin-left:15px;<?php if ($this->uri->segment(2) == 'editar') { echo 'display:none'; } ?>"/>
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
<script>
$(document).ready(function(){
    $(":input").inputmask();
});
</script>
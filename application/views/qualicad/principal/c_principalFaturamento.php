<?php

$Id_Faturamento = '';
$Ds_Faturamento = '';
$Tp_Faturamento = '';
$Tp_Ativo = '';

if ($this->uri->segment(2) == 'editar') {
if(!empty($infoFaturamento))
{
    foreach ($infoFaturamento as $r)
    {
        $Id_Faturamento = $r->Id_Faturamento;
        $Ds_Faturamento = $r->Ds_Faturamento;
        $Tp_Faturamento = $r->Tp_Faturamento;
        $Tp_Ativo = $r->Tp_Ativo;
    }
}
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> <?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Cadastrar Faturamento' : 'Editar Faturamento' ; ?>
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
                    <form role="form" id="addFaturamento" action="<?php echo ($this->uri->segment(2) == 'cadastrar') ? base_url().'adicionaFaturamento' : base_url().'editaFaturamento'; ?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Ds_Faturamento">Faturamento (descrição)</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_Faturamento') : $Ds_Faturamento ; ?>" id="Ds_Faturamento" name="Ds_Faturamento" maxlength="128">
                                        <input type="hidden" value="<?php echo $Id_Faturamento; ?>" name="Id_Faturamento" id="Id_Faturamento" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_Faturamento">Tipo de faturamento</label>
                                        <select class="form-control required" id="Tp_Faturamento" name="Tp_Faturamento">
                                            <option value="1" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Faturamento == '1') { echo 'selected'; } ?>>Reais</option>
                                            <option value="2" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Faturamento == '2') { echo 'selected'; } ?>>CH</option>
                                            <option value="3" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Faturamento == '3') { echo 'selected'; } ?>>CBHPM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_Ativo">Faturamento ativo?</label>
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
                            <input type="submit" class="btn btn-primary" value="Salvar e cadastrar outro faturamento" name="salvarMesmaTela" style="margin-left:30px"/>
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
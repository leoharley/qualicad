<?php

$Id_RegraProibicao = '';
$TbFaturamento_Id_Faturamento = '';
$TbGrupoPro_CodGrupo  = '';
$TbPlano_Id_Plano  = '';

$Ds_RegraProibicao = '';
$Tp_RegraProibicao = '';
$Tp_Atendimento = '';
$Vl_RegraProibicao = '';
$Tp_Ativo = '';

if ($this->uri->segment(2) == 'editar') {
if(!empty($infoRegraProibicao))
{
    foreach ($infoRegraProibicao as $r)
    {
        $Id_RegraProibicao = $r->Id_RegraProibicao;
        $TbFaturamento_Id_Faturamento = $r->TbFaturamento_Id_Faturamento;
        $TbGrupoPro_CodGrupo = $r->TbGrupoPro_CodGrupo;
        $TbPlano_Id_Plano = $r->TbPlano_Id_Plano;
        $Ds_RegraProibicao = $r->Ds_RegraProibicao;
        $Tp_RegraProibicao = $r->Tp_RegraProibicao;
        $Tp_Atendimento = $r->Tp_Atendimento;
        $Vl_RegraProibicao = $r->Vl_RegraProibicao;
        $Tp_Ativo = $r->Tp_Ativo;
    }
}
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> <?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Cadastrar Regra Proibição' : 'Editar Regra Proibição' ; ?>
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
                    <form role="form" id="addRegraProibicao" action="<?php echo ($this->uri->segment(2) == 'cadastrar') ? base_url().'adicionaRegraProibicao' : base_url().'editaRegraProibicao'; ?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="TbFaturamento_Id_Faturamento">Faturamento associado</label>
                                        <select class="form-control required" id="TbFaturamento_Id_Faturamento" name="TbFaturamento_Id_Faturamento">
                                            <?php
                                            if(!empty($infoFaturamento))
                                            {
                                                foreach ($infoFaturamento as $faturamento)
                                                {
                                                    ?>
                                                <option value="<?php echo $faturamento->Id_Faturamento ?>" <?php if ($this->uri->segment(2) == 'editar' && $faturamento->Id_Faturamento == $TbFaturamento_Id_Faturamento) { echo 'selected'; } ?>>
                                                    <?php echo $faturamento->Id_Faturamento.' - '.$faturamento->Ds_Faturamento ?>
                                                </option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" value="<?php echo $Id_RegraProibicao; ?>" name="Id_RegraProibicao" id="Id_RegraProibicao" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="TbGrupoPro_CodGrupo">Grupo Pro associado</label>
                                        <select class="form-control required" id="TbGrupoPro_CodGrupo" name="TbGrupoPro_CodGrupo">
                                            <?php
                                            if(!empty($infoGrupoPro))
                                            {
                                                foreach ($infoGrupoPro as $grupoPro)
                                                {
                                                    ?>
                                                <option value="<?php echo $grupoPro->CodGrupo ?>" <?php if ($this->uri->segment(2) == 'editar' && $grupoPro->CodGrupo == $TbGrupoPro_CodGrupo) { echo 'selected'; } ?>>
                                                    <?php echo $grupoPro->CodGrupo.' - '.$grupoPro->Ds_GrupoPro ?>
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
                                        <label for="TbPlano_Id_Plano">Plano associado</label>
                                        <select class="form-control required" id="TbPlano_Id_Plano" name="TbPlano_Id_Plano">
                                            <?php
                                            if(!empty($infoPlano))
                                            {
                                                foreach ($infoPlano as $plano)
                                                {
                                                    ?>
                                                <option value="<?php echo $plano->Id_Plano ?>" <?php if ($this->uri->segment(2) == 'editar' && $plano->Id_Plano == $TbPlano_Id_Plano) { echo 'selected'; } ?>>
                                                    <?php echo $plano->Id_Plano.' - '.$plano->Ds_Plano ?>
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
                                        <label for="Ds_RegraProibicao">Descrição</label>
                                        <input type="text" class="form-control required email" id="Ds_RegraProibicao" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_RegraProibicao') : $Ds_RegraProibicao ; ?>" name="Ds_RegraProibicao"
                                            maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_RegraProibicao">Tipo de regra de proibição</label>
                                        <select class="form-control required" id="Tp_RegraProibicao" name="Tp_RegraProibicao">
                                            <option value="AG" <?php if ($this->uri->segment(2) == 'editar' && $Tp_RegraProibicao == 'AG') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>AG</option>
                                            <option value="FC" <?php if ($this->uri->segment(2) == 'editar' && $Tp_RegraProibicao == 'FC') { echo 'selected'; } ?>>FC</option>
                                            <option value="NA" <?php if ($this->uri->segment(2) == 'editar' && $Tp_RegraProibicao == 'NA') { echo 'selected'; } ?>>NA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_Atendimento">Tipo de atendimento</label>
                                        <select class="form-control required" id="Tp_Atendimento" name="Tp_Atendimento">
                                            <option value="T" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Atendimento == 'T') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>T</option>
                                            <option value="U" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Atendimento == 'U') { echo 'selected'; } ?>>U</option>
                                            <option value="I" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Atendimento == 'I') { echo 'selected'; } ?>>I</option>
                                            <option value="A" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Atendimento == 'A') { echo 'selected'; } ?>>A</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Vl_RegraProibicao">Valor da regra de proibição</label>
                                        <input type="text" class="form-control required valor" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_RegraProibicao') : $Vl_RegraProibicao ; ?>" id="Vl_RegraProibicao" name="Vl_RegraProibicao"
                                        maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_Ativo">Regra ativa?</label>
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
                            <input type="button" class="btn btn-primary" onclick="window.location='<?php echo base_url(); ?>principalRegraProibicao/listar';" value="Lista (CTRL+L)" name="IrLista" id="IrLista"/>
                            <input type="submit" class="btn btn-primary" value="Salva e lista (CTRL+S)" name="salvarIrLista" id="salvarIrLista" style="margin-left:5px;"/>
                            <input type="submit" class="btn btn-primary" value="Salva e cadastra novamente (CTRL+A)" name="salvarMesmaTela" id="salvarMesmaTela" style="margin-left:5px;<?php if ($this->uri->segment(2) == 'editar') { echo 'display:none'; } ?>"/>
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
        $('.valor').maskMoney();
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
</script>
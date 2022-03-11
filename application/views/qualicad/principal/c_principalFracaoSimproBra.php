<?php

$Id_FracaoSimproBra = '';
$TbProFat_Cd_ProFat = '';
$TbFaturamento_Id_Faturamento  = '';
$TbTUSS_Id_Tuss  = '';

$Ds_FracaoSimproBra = '';
$Ds_Laboratorio = '';
$Ds_Apresentacao = '';
$Tp_MatMed = '';
$Vl_FatorDivisao = '';
$Qt_Prod = '';
$Tp_Ativo = '';

if ($this->uri->segment(2) == 'editar') {
if(!empty($infoFracaoSimproBra))
{
    foreach ($infoFracaoSimproBra as $r)
    {
        $Id_FracaoSimproBra = $r->Id_FracaoSimproBra;
        $TbProFat_Cd_ProFat = $r->TbProFat_Cd_ProFat;
        $TbFaturamento_Id_Faturamento = $r->TbFaturamento_Id_Faturamento;
        $TbTUSS_Id_Tuss = $r->TbTUSS_Id_Tuss;
        $Ds_FracaoSimproBra = $r->Ds_FracaoSimproBra;
        $Ds_Laboratorio = $r->Ds_Laboratorio;
        $Ds_Apresentacao = $r->Ds_Apresentacao;
        $Tp_MatMed = $r->Tp_MatMed;
        $Vl_FatorDivisao = $r->Vl_FatorDivisao;
        $Qt_Prod = $r->Qt_Prod;
        $Tp_Ativo = $r->Tp_Ativo;
    }
}
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> <?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Cadastrar Fração Simpro Bra' : 'Editar Fração Simpro Bra' ; ?>
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
                    <form role="form" id="addFracaoSimproBra" action="<?php echo ($this->uri->segment(2) == 'cadastrar') ? base_url().'adicionaFracaoSimproBra' : base_url().'editaFracaoSimproBra'; ?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
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
                                                    <?php echo $proFat->Ds_ProFat ?>
                                                </option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" value="<?php echo $Id_FracaoSimproBra; ?>" name="Id_FracaoSimproBra" id="Id_FracaoSimproBra" />
                                    </div>
                                </div>
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
                                                <option value="<?php echo $faturamento->Id_Faturamento ?>" <?php if ($this->uri->segment(2) == 'editar' && $faturamento->Id_Faturamento  == $TbFaturamento_Id_Faturamento) { echo 'selected'; } ?>>
                                                    <?php echo $faturamento->Ds_Faturamento ?>
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
                                        <label for="TbTUSS_Id_Tuss">TUSS associada</label>
                                        <select class="form-control required" id="TbTUSS_Id_Tuss" name="TbTUSS_Id_Tuss">
                                            <?php
                                            if(!empty($infoTUSS))
                                            {
                                                foreach ($infoTUSS as $tuss)
                                                {
                                                    ?>
                                                <option value="<?php echo $tuss->Id_Tuss ?>" <?php if ($this->uri->segment(2) == 'editar' && $tuss->Id_Tuss == $TbTUSS_Id_Tuss) { echo 'selected'; } ?>>
                                                    <?php echo $tuss->Ds_Tuss ?>
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
                                        <label for="Ds_FracaoSimproBra">Descrição fração simpro bra</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_FracaoSimproBra') : $Ds_FracaoSimproBra ; ?>" id="Ds_FracaoSimproBra" name="Ds_FracaoSimproBra"
                                        maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Ds_Laboratorio">Descrição laboratório</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_Laboratorio') : $Ds_Laboratorio ; ?>" id="Ds_Laboratorio" name="Ds_Laboratorio"
                                        maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Ds_Apresentacao">Descrição apresentação</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_Apresentacao') : $Ds_Apresentacao ; ?>" id="Ds_Apresentacao" name="Ds_Apresentacao"
                                        maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_MatMed">Tipo MatMed</label>
                                        <select class="form-control required" id="Tp_MatMed" name="Tp_MatMed">
                                            <option value="MED" <?php if ($this->uri->segment(2) == 'editar' && $Tp_MatMed == 'MED') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>MED</option>
                                            <option value="MAT" <?php if ($this->uri->segment(2) == 'editar' && $Tp_MatMed == 'MAT') { echo 'selected'; } ?>>MAT</option>
                                            <option value="SOL" <?php if ($this->uri->segment(2) == 'editar' && $Tp_MatMed == 'SOL') { echo 'selected'; } ?>>SOL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Vl_FatorDivisao">Valor do fator de divisão</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_FatorDivisao') : $Vl_FatorDivisao ; ?>" id="Vl_FatorDivisao" name="Vl_FatorDivisao"
                                        maxlength="11">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Qt_Prod">Quantidade de produção</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Qt_Prod') : $Qt_Prod ; ?>" id="Qt_Prod" name="Qt_Prod"
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
<script src="<?php echo base_url(); ?>assets/js/addFracaoSimproBra.js" type="text/javascript"></script>
<?php

$Id_FatItem = '';
$TbFaturamento_Id_Faturamento  = '';

$Ds_FatItem = '';
$Dt_IniVigencia = '';
$Dt_FimVigencia = '';
$Vl_Honorário = '';
$Vl_Operacional = '';
$Vl_Total = '';
$Vl_Filme = '';
$Tp_Ativo = '';

if ($this->uri->segment(2) == 'editar') {
if(!empty($infoFaturamentoItem))
{
    foreach ($infoFaturamentoItem as $r)
    {
        $Id_FatItem = $r->Id_FatItem;
        $TbFaturamento_Id_Faturamento = $r->TbFaturamento_Id_Faturamento;

        $Ds_FatItem = $r->Ds_FatItem;
        $Dt_IniVigencia = $r->Dt_IniVigencia;
        $Dt_FimVigencia = $r->Dt_FimVigencia;
        $Vl_Honorário = $r->Vl_Honorário;
        $Vl_Operacional = $r->Vl_Operacional;
        $Vl_Total = $r->Vl_Total;
        $Vl_Filme = $r->Vl_Filme;
        $Tp_Ativo = $r->Tp_Ativo;
    }
}
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> <?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Cadastrar Faturamento Item' : 'Editar Faturamento Item' ; ?>
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
                    <form role="form" id="addFaturamentoItem" action="<?php echo ($this->uri->segment(2) == 'cadastrar') ? base_url().'adicionaFaturamentoItem' : base_url().'editaFaturamentoItem'; ?>" method="post" role="form">
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
                                                <option value="<?php echo $faturamento->Id_Faturamento ?>" <?php if ($this->uri->segment(2) == 'editar' && $faturamento->Id_Faturamento  == $TbFaturamento_Id_Faturamento) { echo 'selected'; } ?>>
                                                    <?php echo $faturamento->Ds_Faturamento ?>
                                                </option>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" value="<?php echo $Id_FatItem; ?>" name="Id_FatItem" id="Id_FatItem" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Ds_FatItem">Descrição</label>
                                        <input type="text" class="form-control required" id="Ds_FatItem" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_FatItem') : $Ds_FatItem ; ?>" name="Ds_FatItem"
                                            maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Dt_IniVigencia">Data de início da vigência</label>
                                        <input type="date" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Dt_IniVigencia') : $Dt_IniVigencia ; ?>" id="Dt_IniVigencia" name="Dt_IniVigencia">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Dt_FimVigencia">Data de fim da vigência</label>
                                        <input type="date" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Dt_FimVigencia') : $Dt_FimVigencia ; ?>" id="Dt_FimVigencia" name="Dt_FimVigencia">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Vl_Honorário">Valor do honorário</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_Honorário') : $Vl_Honorário ; ?>" id="Vl_Honorário" name="Vl_Honorário" 
                                        maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Vl_Operacional">Valor operacional</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_Operacional') : $Vl_Operacional ; ?>" id="Vl_Operacional" name="Vl_Operacional"
                                        maxlength="11">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Vl_Total">Valor total</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_Total') : $Vl_Total ; ?>" id="Vl_Total" name="Vl_Total"
                                        maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Vl_Filme">Valor filme</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_Filme') : $Vl_Filme ; ?>" id="Vl_Filme" name="Vl_Filme"
                                        maxlength="11">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_Ativo">Faturamento Item ativo?</label>
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
                            <input type="button" class="btn btn-primary" onclick="window.location='<?php echo base_url(); ?>principalFaturamentoItem/listar';" value="Lista (CTRL+L)" name="IrLista" id="IrLista"/>
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
<script src="<?php echo base_url(); ?>assets/js/addFaturamentoItem.js" type="text/javascript"></script>
<script>
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
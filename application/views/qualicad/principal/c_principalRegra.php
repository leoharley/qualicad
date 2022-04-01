<?php

$Id_Regra = '';
$Ds_Regra = '';
$Tp_Ativo = '';

if ($this->uri->segment(2) == 'editar') {
if(!empty($infoRegra))
{
    foreach ($infoRegra as $r)
    {
        $Id_Regra = $r->Id_Regra;
        $Ds_Regra = $r->Ds_Regra;
        $Tp_Ativo = $r->Tp_Ativo;
    }
}
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> <?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Cadastrar Regra' : 'Editar Regra' ; ?>
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
                    <form role="form" id="addRegra" action="<?php echo ($this->uri->segment(2) == 'cadastrar') ? base_url().'adicionaRegra' : base_url().'editaRegra'; ?>" method="post" role="form">
                        <div class="box-body" style="padding-left:1rem;padding-right:1rem">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Ds_Regra">Regra (descrição)</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_Regra') : $Ds_Regra ; ?>" id="Ds_Regra" name="Ds_Regra" maxlength="128">
                                        <input type="hidden" value="<?php echo $Id_Regra; ?>" name="Id_Regra" id="Id_Regra" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Tp_Ativo">Regra ativa?</label>
                                        <select class="form-control required" id="Tp_Ativo" name="Tp_Ativo">
                                            <option value="S" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Ativo == 'S') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>Sim</option>
											<option value="N" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Ativo == 'N') { echo 'selected'; } ?>>Não</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="display: inline-block;width: 100%;height: 100%;margin: 0.15rem;padding-top: 0.85rem;padding-left:1rem;padding-right:1rem;
                            background-color: #f5f5f5;">

                                <h4><strong>Regra Grupo</strong></h4>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="dsgrupopro">Grupo pro associado</label>
                                            <select class="form-control required" id="dsgrupopro" name="dsgrupopro">
                                                <option value="1">GRUPO_PRO_1</option>
                                                <option value="2">GRUPO_PRO_2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="dsregra">Regra associada</label>
                                            <select class="form-control required" id="dsregra" name="dsregra">
                                                <option value="1">REGRA_1</option>
                                                <option value="2">REGRA_2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="dsfaturamento">Faturamento associado</label>
                                            <select class="form-control required" id="dsfaturamento" name="dsfaturamento">
                                                <option value="1">FATURAMENTO_1</option>
                                                <option value="2">FATURAMENTO_2</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="percpago">Percentual pago</label>
                                            <input type="text" class="form-control required" value="<?php echo set_value('percpago'); ?>" id="percpago" name="percpago"
                                                   maxlength="11">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="dtinivigencia">Data de início da vigência</label>
                                            <input type="date" class="form-control required" value="<?php echo set_value('dtinivigencia'); ?>" id="dtinivigencia" name="dtinivigencia">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="dtfimvigencia">Data de fim da vigência</label>
                                            <input type="date" class="form-control required" value="<?php echo set_value('dtfimvigencia'); ?>" id="dtfimvigencia" name="dtfimvigencia">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="dtcriacao">Data criação</label>
                                            <input type="date" class="form-control required" value="<?php echo set_value('dtcriacao'); ?>" id="dtcriacao" name="dtcriacao">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="button" class="btn btn-primary" onclick="window.location='<?php echo base_url(); ?>principalRegra/listar';" value="Lista (CTRL+L)" name="IrLista" id="IrLista"/>
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
<script src="<?php echo base_url(); ?>assets/js/addRegra.js" type="text/javascript"></script>

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
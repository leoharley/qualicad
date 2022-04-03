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
                    <form role="form" id="addConvenio" action="<?php echo ($this->uri->segment(2) == 'cadastrar') ? base_url().'adicionaConvenio' : base_url().'editaConvenio'; ?>" method="post" role="form">
                        <div class="box-body" style="padding-left:1rem;padding-right:1rem">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Ds_Convenio">Convênio (descrição)</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_Convenio') : $Ds_Convenio ; ?>" id="Ds_Convenio" name="Ds_Convenio" maxlength="128">
                                        <input type="hidden" value="<?php echo $Id_Convenio; ?>" name="Id_Convenio" id="Id_Convenio" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="CNPJ_Convenio">CNPJ</label>
                                        <input type="text" data-inputmask="'mask': '99.999.999/9999-99'" class="form-control required cnpj" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('CNPJ_Convenio') : $CNPJ_Convenio ; ?>" id="CNPJ_Convenio" name="CNPJ_Convenio" maxlength="128">
                                    </div>
                                </div>
                       <!--    </div> -->
                        <!--    <div class="row"> -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Cd_ConvenioERP">Código ERP</label>
                                        <input type="text" class="form-control required" id="Cd_ConvenioERP" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Cd_ConvenioERP') : $Cd_ConvenioERP ; ?>" name="Cd_ConvenioERP"
                                            maxlength="13">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Tp_Convenio">Tipo</label>
                                        <select class="form-control required" id="Tp_Convenio" name="Tp_Convenio">
                                            <option value="1">Convênio</option>
                                            <option value="2">Filantrópico</option>
                                            <option value="3">Particular</option>
                                        </select>
                                    </div>
                                </div>
                        <!--    </div> -->
                        <!--    <div class="row"> -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Dt_InicioConvenio">Data de ínicio</label>
                                        <input type="date" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Dt_InicioConvenio') : $Dt_InicioConvenio ; ?>" id="Dt_InicioConvenio" name="Dt_InicioConvenio">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Dt_VigenciaConvenio">Data da vigência</label>
                                        <input type="date" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Dt_VigenciaConvenio') : $Dt_VigenciaConvenio ; ?>" id="Dt_VigenciaConvenio" name="Dt_VigenciaConvenio">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Tp_Ativo">Convênio ativo?</label>
                                        <select class="form-control required" id="Tp_Ativo" name="Tp_Ativo">
                                            <option value="S" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Ativo == 'S') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>Sim</option>
											<option value="N" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Ativo == 'N') { echo 'selected'; } ?>>Não</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row" style="display: inline-block;width: 100%;height: 100%;margin: 0.15rem;padding-top: 0.85rem;padding-left:1rem;padding-right:1rem;
                            background-color: #f5f5f5;">

                                <h4><strong>Plano</strong><input type="button" class="btn btn-primary" onclick="add()" value="+" name="add" id="add"/></h4>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="TbIndice_Id_Indice">Índice</label>
                                        <select class="form-control" id="TbIndice_Id_Indice" name="TbIndice_Id_Indice">
                                            <?php
                                            if(!empty($infoIndice))
                                            {
                                                foreach ($infoIndice as $indice)
                                                {
                                                    ?>
                                                    <option value="<?php echo $indice->Id_Indice ?>" <?php if ($this->uri->segment(2) == 'editar' && $indice->Id_Indice == $TbIndice_Id_Indice) { echo 'selected'; } ?>>
                                                        <?php echo $indice->Id_Indice.' - '.$indice->Ds_indice ?>
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
                                        <label for="TbRegra_Id_Regra">Regra</label>
                                        <select class="form-control" id="TbRegra_Id_Regra" name="TbRegra_Id_Regra">
                                            <?php
                                            if(!empty($infoRegra))
                                            {
                                                foreach ($infoRegra as $regra)
                                                {
                                                    ?>
                                                    <option value="<?php echo $regra->Id_Regra ?>" <?php if ($this->uri->segment(2) == 'editar' && $regra->Id_Regra == $TbRegra_Id_Regra) { echo 'selected'; } ?>>
                                                        <?php echo $regra->Id_Regra.' - '.$regra->Ds_Regra ?>
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
                                        <label for="Ds_Plano">Desc. do plano</label>
                                        <input type="text" class="form-control" id="Ds_Plano" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_Plano') : $Ds_Plano ; ?>" name="Ds_Plano"
                                               maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Cd_PlanoERP">Cod. ERP</label>
                                        <input type="text" class="form-control" id="Cd_PlanoERP" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Cd_PlanoERP') : $Cd_PlanoERP ; ?>" name="Cd_PlanoERP"
                                               maxlength="11">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Tp_AcomodacaoPadrao">Tp acomodação padrão</label>
                                        <select class="form-control" id="Tp_AcomodacaoPadrao" name="Tp_AcomodacaoPadrao">
                                            <option value="1" <?php if ($this->uri->segment(2) == 'editar' && $Tp_AcomodacaoPadrao == '1') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>Enfermaria</option>
                                            <option value="2" <?php if ($this->uri->segment(2) == 'editar' && $Tp_AcomodacaoPadrao == '2') { echo 'selected'; } ?>>Apartamento</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Tp_Ativo">Plano ativo?</label>
                                        <select class="form-control" id="Tp_Ativo" name="Tp_Ativo">
                                            <option value="S" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Ativo == 'S') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>Sim</option>
                                            <option value="N" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Ativo == 'N') { echo 'selected'; } ?>>Não</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="row1" style="display:none">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select class="form-control" id="TbIndice_Id_Indice" name="TbIndice_Id_Indice">
                                                <?php
                                                if(!empty($infoIndice))
                                                {
                                                    foreach ($infoIndice as $indice)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $indice->Id_Indice ?>" <?php if ($this->uri->segment(2) == 'editar' && $indice->Id_Indice == $TbIndice_Id_Indice) { echo 'selected'; } ?>>
                                                            <?php echo $indice->Id_Indice.' - '.$indice->Ds_indice ?>
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
                                            <select class="form-control" id="TbRegra_Id_Regra" name="TbRegra_Id_Regra">
                                                <?php
                                                if(!empty($infoRegra))
                                                {
                                                    foreach ($infoRegra as $regra)
                                                    {
                                                        ?>
                                                        <option value="<?php echo $regra->Id_Regra ?>" <?php if ($this->uri->segment(2) == 'editar' && $regra->Id_Regra == $TbRegra_Id_Regra) { echo 'selected'; } ?>>
                                                            <?php echo $regra->Id_Regra.' - '.$regra->Ds_Regra ?>
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
                                            <input type="text" class="form-control" id="Ds_Plano" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_Plano') : $Ds_Plano ; ?>" name="Ds_Plano"
                                                maxlength="128">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="Cd_PlanoERP" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Cd_PlanoERP') : $Cd_PlanoERP ; ?>" name="Cd_PlanoERP"
                                                maxlength="11">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select class="form-control" id="Tp_AcomodacaoPadrao" name="Tp_AcomodacaoPadrao">
                                                <option value="1" <?php if ($this->uri->segment(2) == 'editar' && $Tp_AcomodacaoPadrao == '1') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>Enfermaria</option>
                                                <option value="2" <?php if ($this->uri->segment(2) == 'editar' && $Tp_AcomodacaoPadrao == '2') { echo 'selected'; } ?>>Apartamento</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select class="form-control" id="Tp_Ativo" name="Tp_Ativo">
                                                <option value="S" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Ativo == 'S') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>Sim</option>
                                                <option value="N" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Ativo == 'N') { echo 'selected'; } ?>>Não</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                

                            </div>


                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="button" class="btn btn-primary" onclick="window.location='<?php echo base_url(); ?>principalConvenio/listar';" value="Lista (CTRL+L)" name="IrLista" id="IrLista"/>
                            <input type="submit" class="btn btn-primary" value="Salva e lista (CTRL+S)" name="salvarIrLista" id="salvarIrLista" style="margin-left:5px;"/>
                            <input type="submit" class="btn btn-primary" value="Salva e cadastra novamente (CTRL+A)" name="salvarMesmaTela" id="salvarMesmaTela" style="margin-left:5px;<?php if ($this->uri->segment(2) == 'editar') { echo 'display:none'; } ?>"/>
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
        document.getElementById('salvarAvancar').click();
    });

    function add()
    {
        $('#row1').css('display', 'inline');
    }
</script>
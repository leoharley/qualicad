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
            <i class="fa fa-users"></i> Cadastrar Plano
            <small>Associar / Adicionar</small>
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
                    <form role="form" id="addUser" action="<?php echo base_url() ?>addNewUser" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dsconvenio">Convênio associado</label>
                                        <select class="form-control required" id="dsconvenio" name="dsconvenio">
                                            <option value="1">CONVENIO_1</option>
											<option value="2">CONVENIO_2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dsindice">Índice associado</label>
                                        <select class="form-control required" id="dsindice" name="dsindice">
                                            <option value="1">INDICE_1</option>
											<option value="2">INDICE_2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dsregra">Regra associada</label>
                                        <select class="form-control required" id="dsregra" name="dsregra">
                                            <option value="1">REGRA_1</option>
											<option value="2">REGRA_2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dsplano">Descrição</label>
                                        <input type="text" class="form-control required" id="dsplano" value="<?php echo set_value('dsplano'); ?>" name="dsplano"
                                            maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cdplanoerp">Código</label>
                                        <input type="text" class="form-control required" id="cdplanoerp" value="<?php echo set_value('cdplanoerp'); ?>" name="cdplanoerp"
                                            maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tpacomodacaopadrao">Tipo de acomodação padrão</label>
                                        <select class="form-control required" id="tpacomodacaopadrao" name="tpacomodacaopadrao">
                                            <option value="1">ACOMODACAO_1</option>
											<option value="2">ACOMODACAO_2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dtativo">Data de atividade</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('dtativo'); ?>" id="dtativo" name="dtativo">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dtinativo">Data de inatividade</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('dtinativo'); ?>" id="dtinativo" name="dtinativo">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dtcriacao">Data de criação</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('dtcriacao'); ?>" id="dtcriacao" name="dtcriacao">
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
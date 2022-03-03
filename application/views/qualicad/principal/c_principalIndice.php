<?php

$Id_Indice = '';
$TbUsuEmp_Id_UsuEmp = '';
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
        $TbUsuEmp_Id_UsuEmp = $r->TbUsuEmp_Id_UsuEmp;
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
            <i class="fa fa-users"></i> Cadastrar Índice
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
                                        <label for="nomeempresa">Empresa associada</label>
                                        <select class="form-control required" id="nomeempresa" name="nomeempresa">
                                            <option value="1">EMPRESA_1</option>
											<option value="2">EMPRESA_2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dsindice">Descrição</label>
                                        <input type="text" class="form-control required email" id="dsindice" value="<?php echo set_value('dsindice'); ?>" name="dsindice"
                                            maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dtinivigencia">Data de início da vigência</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('dtinivigencia'); ?>" id="dtinivigencia" name="dtinivigencia">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dtfimvigencia">Data de fim da vigência</label>
                                        <input type="date" class="form-control required" value="<?php echo set_value('dtfimvigencia'); ?>" id="dtfimvigencia" name="dtfimvigencia">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vlindice">Valor do índice</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('vlindice'); ?>" id="vlindice" name="vlindice"
                                        maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vlm2filme">Valor m2 filme</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('vlm2filme'); ?>" id="vlm2filme" name="vlm2filme"
                                        maxlength="11">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vlhonorario">Valor honorário</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('vlhonorario'); ?>" id="vlhonorario" name="vlhonorario"
                                        maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vluco">Valor UCO</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('vluco'); ?>" id="vluco" name="vluco"
                                        maxlength="11">
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
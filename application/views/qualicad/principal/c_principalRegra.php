<?php

$Id_Regra = '';
$TbUsuEmp_Id_UsuEmp = '';
$Ds_Regra = '';
$Tp_Ativo = '';

if ($this->uri->segment(2) == 'editar') {
if(!empty($infoRegra))
{
    foreach ($infoRegra as $r)
    {
        $Id_Regra = $r->Id_Regra;
        $TbUsuEmp_Id_UsuEmp = $r->TbUsuEmp_Id_UsuEmp;
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
            <i class="fa fa-users"></i> Cadastrar Regra
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
                                        <label for="dsregra">Descrição</label>
                                        <input type="text" class="form-control required email" id="dsregra" value="<?php echo set_value('dsregra'); ?>" name="dsregra"
                                            maxlength="128">
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
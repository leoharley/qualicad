<?php

$Id_ExcValores = '';
$CD_Convenio = '';
$Cd_TUSS = '';
$Cd_ProFat = '';
$Ds_ExcValores = '';
$ClasseEvento = '';
$Tp_ExcValores = '';
$Vl_ExcValores = '';
$Tp_Ativo = '';

if ($this->uri->segment(2) == 'editar') {
if(!empty($infoExcecaoValores))
{
    foreach ($infoExcecaoValores as $r)
    {
        $Id_ExcValores = $r->Id_ExcValores;
        $CD_Convenio = $r->CD_Convenio;
        $Cd_TUSS = $r->Cd_TUSS;
        $Cd_ProFat = $r->Cd_ProFat;
        $Ds_ExcValores = $r->Ds_ExcValores;
        $ClasseEvento = $r->ClasseEvento;
        $Tp_ExcValores = $r->Tp_ExcValores;
        $Vl_ExcValores = $r->Vl_ExcValores;
        $Tp_Ativo = $r->Tp_Ativo;
    }
}
}

?>

<style>
    #table, th, td {
    border: 1px solid #c0c0c0;
    border-collapse: collapse;
    }
    #table input {border:0!important;outline:0;}
    #table input:focus {outline:none!important;}
    #table select {border:0!important;outline:0;}
    #table select:focus {outline:none!important;}

    #table thead {
    position: sticky;
    top: 0;
    }

    #table thead th {
    border: 1px solid #e4eff8;
    background: white;
    cursor: pointer;
    }

    #table thead th.header-label {
    cursor: pointer;
    background: linear-gradient(0deg, #3c8dbc, #4578a2 5%, #e4eff8 150%);
    color: white;
    border: 1px solid white;
    }


</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h1>
        <i class="fa fa-users"></i> <?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Cadastrar Exceção Valores' : 'Editar Exceção Valores' ; ?>
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
                    <form role="form" id="addExcecaoValores" action="<?php echo ($this->uri->segment(2) == 'cadastrar') ? base_url().'adicionaExcecaoValores' : base_url().'editaExcecaoValores'; ?>" method="post" role="form">
                        <div class="box-body">

                            <div class="row" style="display: inline-block;width: 98%;height: 100%;margin: 0.15rem;padding-top: 0.85rem;padding-left:1rem;padding-right:1rem;
                                background-color: #f5f5f5;padding-bottom:2rem">

                                <h4><strong>Exceção Valores</strong></h4>

                                <table style="width:100%;">
                                    <thead>
                                    <tr style="background-color:#e0e0e0">
                                        <th class="header-label" style="padding:10px">
                                        Id Seq
                                        </th>
                                        <th class="header-label" style="padding:10px">
                                        Convênio
                                        </th>
                                        <th class="header-label" style="padding:10px">
                                        TUSS associada
                                        </th>                                        
                                        <th class="header-label" style="padding:10px">
                                        ProFat associado
                                        </th>
                                        <th class="header-label" style="padding:10px">
                                        Descrição
                                        </th>
                                        <th class="header-label" style="padding:10px">
                                        Classe Evento
                                        </th>
                                        <th class="header-label" style="padding:10px">
                                        Tipo
                                        </th>
                                        <th class="header-label" style="padding:10px">
                                        Valor
                                        </th>
                                        <th class="header-label" style="padding:10px">
                                        Ativo?
                                        </th>
                                    </tr>
                                </thead>
                                <tr id="row0">
                                            <td style="width:5%!important">
                                            <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('IdExcecaoValores') : $Id_ExcValores ; ?>" id="IdExcecaoValores" name="IdExcecaoValores" disabled>
                                            </td>

                                            <td>
                                            <select class="form-control required" id="CD_Convenio" name="CD_Convenio" required>
                                            <option value="" disabled selected>SELECIONE</option>
                                            <?php
                                            if(!empty($infoConvenio))
                                            {
                                                foreach ($infoConvenio as $convenio)
                                                {
                                                    ?>
                                                <option value="<?php echo $convenio->Id_Convenio ?>" <?php if ($this->uri->segment(2) == 'editar' && $convenio->Id_Convenio == $CD_Convenio) { echo 'selected'; } ?>>
                                                    <?php echo $convenio->Id_Convenio.' - '.$convenio->Ds_Convenio ?>
                                                </option>
                                                <?php
                                                }
                                            }
                                            ?>
                                            </select>
                                            </td>

                                            <td>
                                            <input type="text" class="form-control required" id="Cd_TUSS" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Cd_TUSS') : $Cd_TUSS ; ?>" name="Cd_TUSS"
                                                   maxlength="13">
                                            </td>

                                         <!--   <td>
                                            <select class="form-control required" id="Cd_ProFat" name="Cd_ProFat" required>
                                            <option value="" disabled selected>SELECIONE</option>
                                            <?php /*
                                            if(!empty($infoProFat))
                                            {
                                                foreach ($infoProFat as $proFat)
                                                {
                                                    ?>
                                                <option value="<?php echo $proFat->Cd_ProFat ?>" <?php if ($this->uri->segment(2) == 'editar' && $proFat->Cd_ProFat == $Cd_ProFat) { echo 'selected'; } ?>>
                                                    <?php echo $proFat->Cd_ProFat.' - '.$proFat->Ds_ProFat ?>
                                                </option>
                                                <?php
                                                }
                                            } */
                                            ?>
                                            </select>
                                            </td> -->

                                            <td>
                                            <select id="itemName" class="form-control" style="width:500px"></select>
                                            </td>

                                            <td>
                                            <input type="text" class="form-control required" id="Ds_ExcValores" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_ExcValores') : $Ds_ExcValores ; ?>" name="Ds_ExcValores"
                                            maxlength="13">
                                            </td>

                                            <td>
                                            <input type="text" class="form-control required" id="ClasseEvento" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('ClasseEvento') : $ClasseEvento ; ?>" name="ClasseEvento"
                                            maxlength="13">
                                            </td>

                                            <td>
                                            <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Tp_ExcValores') : $Tp_ExcValores ; ?>" id="Tp_ExcValores" name="Tp_ExcValores">
                                            </td>

                                            <td>
                                            <input type="text" class="form-control valor required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_ExcValores') : $Vl_ExcValores ; ?>" id="Vl_ExcValores" name="Vl_ExcValores">
                                            </td>

                                            <td>
                                            <select class="form-control required" id="Tp_Ativo" name="Tp_Ativo">
                                            <option value="S" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Ativo == 'S') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>Sim</option>
											<option value="N" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Ativo == 'N') { echo 'selected'; } ?>>Não</option>
                                            </select>
                                            </td>
                                </tr>

                                </table>
                            </div>     

                            
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="button" class="btn btn-primary" onclick="window.location='<?php echo base_url(); ?>principalExcecaoValores/listar';" value="Lista (CTRL+L)" name="IrLista" id="IrLista"/>
                            <input type="submit" class="btn btn-primary" value="Salva e lista (CTRL+S)" name="salvarIrLista" id="salvarIrLista" style="margin-left:5px;"/>
                            <input type="submit" class="btn btn-primary" value="Salva e cadastra outra exceção (CTRL+A)" name="salvarMesmaTela" id="salvarMesmaTela" style="margin-left:5px;<?php if ($this->uri->segment(2) == 'editar') { echo 'display:none'; } ?>"/>
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
<script src="<?php echo base_url(); ?>assets/js/addExcecaoValores.js" type="text/javascript"></script>
<script>

    $(document).ready(function(){
        $(":input").inputmask();
        $('.valor').maskMoney();

        $("#itemName").select2({
                placeholder: "Buscar",
                minimumInputLength: 3,
                ajax: {
                    url:"/buscaProFat",
                    dataType: 'json',
                    quietMillis: 100,
                    data: function (term, page) {
                        return {
                            json: JSON.stringify(term),
                            delay: 0.3
                        };
                    },
                    processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                        return {
                            id: obj.id,
                            text: obj.text
                        };
                        })
                    };
                    }
                },
                escapeMarkup: function (m) { return m; }
            });

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
        document.getElementById('salvarPlano').click();
    });


</script>
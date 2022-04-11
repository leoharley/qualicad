<?php

$Id_Indice = '';
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
            <i class="fa fa-users"></i> <?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Cadastrar Índice' : 'Editar Índice' ; ?>
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
                    <form role="form" id="addIndice" action="<?php echo ($this->uri->segment(2) == 'cadastrar') ? base_url().'adicionaIndice' : base_url().'editaIndice'; ?>" method="post" role="form">
                        <div class="box-body" style="padding-left:1rem;padding-right:1rem">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Ds_indice">Índice (descrição)</label>
                                        <input type="text" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Ds_indice') : $Ds_indice ; ?>" id="Ds_indice" name="Ds_indice" maxlength="128">
                                        <input type="hidden" value="<?php echo $Id_Indice; ?>" name="Id_Indice" id="Id_Indice" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Dt_IniVigencia">Data de início da vigência</label>
                                        <input type="date" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Dt_IniVigencia') : $Dt_IniVigencia ; ?>" id="Dt_IniVigencia" name="Dt_IniVigencia">
                                    </div>
                                </div>
                        <!--    </div> -->
                        <!--    <div class="row"> -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Dt_FimVigencia">Data de fim da vigência</label>
                                        <input type="date" class="form-control required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Dt_FimVigencia') : $Dt_FimVigencia ; ?>" id="Dt_FimVigencia" name="Dt_FimVigencia">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Vl_Indice">Valor índice</label>
                                        <input type="text" class="form-control valor required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_Indice') : $Vl_Indice ; ?>" id="Vl_Indice" name="Vl_Indice">
                                    </div>
                                </div>
                        <!--    </div> -->
                        <!--    <div class="row"> -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Vl_M2Filme">Valor M2 Filme</label>
                                        <input type="text" class="form-control valor required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_M2Filme') : $Vl_M2Filme ; ?>" id="Vl_M2Filme" name="Vl_M2Filme"
                                        maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Vl_Honorário">Valor honorário</label>
                                        <input type="text" class="form-control valor required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_Honorário') : $Vl_Honorário ; ?>" id="Vl_Honorário" name="Vl_Honorário"
                                        maxlength="11">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Vl_UCO">Valor UCO</label>
                                        <input type="text" class="form-control valor required" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('Vl_UCO') : $Vl_UCO ; ?>" id="Vl_UCO" name="Vl_UCO"
                                        maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="Tp_Ativo">Índice ativo?</label>
                                        <select class="form-control required" id="Tp_Ativo" name="Tp_Ativo">
                                            <option value="S" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Ativo == 'S') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>Sim</option>
                                            <option value="N" <?php if ($this->uri->segment(2) == 'editar' && $Tp_Ativo == 'N') { echo 'selected'; } ?>>Não</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="row" style="display: inline-block;width: 98%;height: 100%;margin: 0.15rem;padding-top: 0.85rem;padding-left:1rem;padding-right:1rem;
                            background-color: #f5f5f5;padding-bottom:2rem">

                                <h4><strong>Índice Grupo</strong></h4>

                                <table style="width:100%;">
                                    <thead>
                                    <tr style="background-color:#e0e0e0">
                                        <th class="header-label" style="padding:10px">
                                        Grupo associado
                                        </th>
                                        <th class="header-label" style="padding:10px">
                                        Data de início da vigência
                                        </th>
                                        <th class="header-label" style="padding:10px">
                                        Valor índice
                                        </th>                                        
                                        <th class="header-label" style="padding:10px">
                                        Valor M2 Filme
                                        </th>
                                        <th class="header-label" style="padding:10px">
                                        Valor honorário
                                        </th>
                                        <th class="header-label" style="padding:10px">
                                        Valor UCO
                                        </th>
                                        <th class="header-label" style="padding:10px">
                                        Ativo?
                                        </th>
                                    </tr>
                                </thead>
                                <tr id="row0">
                                            <td>
                                                <select class="form-control" id="TbGrupoPro_CodGrupo" name="TbGrupoPro_CodGrupo">
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
                                            </td>

                                            <td>
                                            <input type="date" class="form-control" value="<?php echo set_value('Dt_IniVigencia_GrupoPro'); ?>" id="Dt_IniVigencia_GrupoPro" name="Dt_IniVigencia_GrupoPro">
                                            </td>

                                            <td>
                                            <input type="date" class="form-control" value="<?php echo set_value('Dt_FimVigencia_GrupoPro'); ?>" id="Dt_FimVigencia_GrupoPro" name="Dt_FimVigencia_GrupoPro">
                                            </td>

                                            <td>
                                            <input type="text" class="form-control valor" value="<?php echo set_value('Vl_Indice_GrupoPro'); ?>" id="Vl_Indice_GrupoPro" name="Vl_Indice_GrupoPro">
                                            </td>

                                            <td>
                                            <input type="text" class="form-control valor" value="<?php echo set_value('Vl_M2Filme_GrupoPro'); ?>" id="Vl_M2Filme_GrupoPro" name="Vl_M2Filme_GrupoPro"
                                                   maxlength="11">
                                            </td>

                                            <td>
                                            <input type="text" class="form-control valor" value="<?php echo set_value('Vl_Honorario_GrupoPro'); ?>" id="Vl_Honorario_GrupoPro" name="Vl_Honorario_GrupoPro"
                                                   maxlength="11">
                                            </td>

                                            <td>
                                            <input type="text" class="form-control valor" value="<?php echo set_value('Vl_UCO_GrupoPro'); ?>" id="Vl_UCO_GrupoPro" name="Vl_UCO_GrupoPro"
                                                   maxlength="11">
                                            </td>

                                            <td>
                                            <select class="form-control" id="Tp_Ativo_GrupoPro" name="Tp_Ativo_GrupoPro">
                                                <option value="S">Sim</option>
                                                <option value="N">Não</option>
                                            </select>
                                            </td>
                                </tr>

                                <?php
                                if(!empty($infoIndiceGrupoPro))
                                {
                                foreach ($infoIndiceGrupoPro as $indice)
                                {
                                ?>
                                <tr style="background-color:#c0c0c0">
                                    <td>
                                        <input type="text" class="form-control" value="<?php echo $indice->TbGrupoPro_CodGrupo.' - '.$indice->Ds_GrupoPro ?>" disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="<?php echo $indice->TbIndice_Id_Indice.' - '.$indice->Ds_indice ?>" disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="<?php echo $indice->Dt_IniVigencia ?>" disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="<?php echo $indice->Dt_FimVigencia ?>" disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="<?php echo $indice->Vl_Indice ?>" disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="<?php echo $indice->Vl_M2Filme ?>" disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="<?php echo $indice->Vl_Honorario ?>" disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="<?php echo $indice->Vl_UCO ?>" disabled>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" value="<?php echo ($indice->Tp_Ativo == 'S') ? 'Sim' : 'Não'; ?>" disabled>
                                    </td>
                                </tr>
                                    <?php
                                }
                                }
                                ?>

                                </table>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <input type="button" class="btn btn-primary" onclick="window.location='<?php echo base_url(); ?>principalIndice/listar';" value="Lista (CTRL+L)" name="IrLista" id="IrLista"/>
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
<script src="<?php echo base_url(); ?>assets/js/addIndice.js" type="text/javascript"></script>
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
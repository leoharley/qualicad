<?php

$Id_DeparaImportacao = '';
$No_Importacao = '';
$No_Tabela = '';
$No_CampoOrigem = '';
$No_CampoDestino = '';
$Tp_Ativo = '';

if ($this->uri->segment(2) == 'editar') {
if(!empty($infoDePara))
{
    foreach ($infoDePara as $r)
    {
        $Id_DeparaImportacao = $r->Id_DeparaImportacao;
        $No_Importacao = $r->No_Importacao;
        $No_Tabela = $r->No_Tabela;
        $No_CampoOrigem = $r->No_CampoOrigem;
        $No_CampoDestino = $r->No_CampoDestino;
        $Tp_Ativo = $r->Tp_Ativo;
    }
}
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> <?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Cadastrar Plano' : 'Editar Plano' ; ?>
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
                    <form role="form" id="addDePara" action="<?php echo ($this->uri->segment(2) == 'cadastrar') ? base_url().'adicionaDePara' : base_url().'editaDePara'; ?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="No_Importacao">Nome importação</label>
                                        <select class="form-control required" id="No_Importacao" name="No_Importacao">
                                            <option value="GrupoPro" <?php if ($this->uri->segment(2) == 'editar' && $No_Importacao == 'GrupoPro') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>GrupoPro</option>
                                            <option value="ProFat" <?php if ($this->uri->segment(2) == 'editar' && $No_Importacao == 'ProFat') { echo 'selected'; } ?>>ProFat</option>
                                            <option value="TUSS" <?php if ($this->uri->segment(2) == 'editar' && $No_Importacao == 'TUSS') { echo 'selected'; } ?>>TUSS</option>
                                            <option value="RegraGruPro" <?php if ($this->uri->segment(2) == 'editar' && $No_Importacao == 'RegraGruPro') { echo 'selected'; } ?>>RegraGruPro</option>
                                            <option value="FracaoSimproBra" <?php if ($this->uri->segment(2) == 'editar' && $No_Importacao == 'FracaoSimproBra') { echo 'selected'; } ?>>FracaoSimproBra</option>
                                            <option value="Produto" <?php if ($this->uri->segment(2) == 'editar' && $No_Importacao == 'Produto') { echo 'selected'; } ?>>Produto</option>
                                            <option value="Producao" <?php if ($this->uri->segment(2) == 'editar' && $No_Importacao == 'Producao') { echo 'selected'; } ?>>Producao</option>
                                            <option value="Contrato" <?php if ($this->uri->segment(2) == 'editar' && $No_Importacao == 'Contrato') { echo 'selected'; } ?>>Contrato</option>
                                        </select>
                                        <input type="hidden" value="<?php echo $Id_DeparaImportacao; ?>" name="Id_DeparaImportacao" id="Id_DeparaImportacao" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="No_Tabela">Nome tabela</label>
                                        <select class="form-control required" id="No_Tabela" name="No_Tabela">
                                            <option value="TabTela" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TabTela') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>TabTela</option>
                                            <option value="TabUsuario" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TabUsuario') { echo 'selected'; } ?>>TabUsuario</option>
                                            <option value="TbConvenio" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TbConvenio') { echo 'selected'; } ?>>TbConvenio</option>
                                            <option value="TbEmpresa" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TbEmpresa') { echo 'selected'; } ?>>TbEmpresa</option>
                                            <option value="TbFatItem" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TbFatItem') { echo 'selected'; } ?>>TbFatItem</option>
                                            <option value="TbFaturamento" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TbFaturamento') { echo 'selected'; } ?>>TbFaturamento</option>
                                            <option value="TbGrupoPro" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TbGrupoPro') { echo 'selected'; } ?>>TbGrupoPro</option>
                                            <option value="TbIndice" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TbIndice') { echo 'selected'; } ?>>TbIndice</option>
                                            <option value="TbIndiceGrupo" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TbIndiceGrupo') { echo 'selected'; } ?>>TbIndiceGrupo</option>
                                            <option value="TbPerfil" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TbPerfil') { echo 'selected'; } ?>>TbPerfil</option>
                                            <option value="TbPermissao" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TbPermissao') { echo 'selected'; } ?>>TbPermissao</option>
                                            <option value="TbPlano" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TbIndice') { echo 'selected'; } ?>>TbPlano</option>
                                            <option value="TbProFat" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TbProFat') { echo 'selected'; } ?>>TbProFat</option>
                                            <option value="TbRegra" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TbRegra') { echo 'selected'; } ?>>TbRegra</option>
                                            <option value="TbTUSS" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TbTUSS') { echo 'selected'; } ?>>TbTUSS</option>
                                            <option value="TbUsuEmp" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'TbUsuEmp') { echo 'selected'; } ?>>TbUsuEmp</option>
                                            <option value="Tb_FracaoSimproBra" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'Tb_FracaoSimproBra') { echo 'selected'; } ?>>Tb_FracaoSimproBra</option>
                                            <option value="Tb_Producao" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'Tb_Producao') { echo 'selected'; } ?>>Tb_Producao</option>
                                            <option value="Tb_Produto" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'Tb_Produto') { echo 'selected'; } ?>>Tb_Produto</option>
                                            <option value="Tb_Proibicao" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'Tb_Proibicao') { echo 'selected'; } ?>>Tb_Proibicao</option>
                                            <option value="Tb_RegraGruPro" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'Tb_RegraGruPro') { echo 'selected'; } ?>>Tb_RegraGruPro</option>
                                            <option value="Tb_RegraProibicao" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'Tb_RegraProibicao') { echo 'selected'; } ?>>Tb_RegraProibicao</option>
                                            <option value="Tb_Unidade" <?php if ($this->uri->segment(2) == 'editar' && $No_Tabela == 'Tb_Unidade') { echo 'selected'; } ?>>Tb_Unidade</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="No_CampoOrigem">Campo origem</label>
                                        <input type="text" class="form-control required" id="No_CampoOrigem" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('No_CampoOrigem') : $No_CampoOrigem ; ?>" name="No_CampoOrigem"
                                            maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="No_CampoDestino">Campo destino</label>
                                        <input type="text" class="form-control required" id="No_CampoDestino" value="<?php echo ($this->uri->segment(2) == 'cadastrar') ? set_value('No_CampoDestino') : $No_CampoDestino ; ?>" name="No_CampoDestino"
                                            maxlength="11">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_Ativo">DePara ativo?</label>
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
                            <input type="button" class="btn btn-primary" onclick="window.location='<?php echo base_url(); ?>importacaoDePara/listar';" value="Lista (CTRL+L)" name="IrLista" id="IrLista"/>
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
<script src="<?php echo base_url(); ?>assets/js/addPlano.js" type="text/javascript"></script>

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
    shortcut.add("ctrl+c", function() {
        document.getElementById('salvarRetroceder').click();
    });
</script>    
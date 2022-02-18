<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Cadastrar Item de Faturamento
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
                                        <label for="dsfaturamento">Faturamento associado</label>
                                        <select class="form-control required" id="dsfaturamento" name="dsfaturamento">
                                            <option value="1">FATURAMENTO_1</option>
											<option value="2">FATURAMENTO_2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dsfatitem">Descrição</label>
                                        <input type="text" class="form-control required email" id="dsfatitem" value="<?php echo set_value('dsfatitem'); ?>" name="dsfatitem"
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
                                        <label for="vlhonorario">Valor do honorário</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('vlhonorario'); ?>" id="vlhonorario" name="vlhonorario" 
                                        maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vloperacional">Valor operacional</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('vloperacional'); ?>" id="vloperacional" name="vloperacional"
                                        maxlength="11">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vltotal">Valor total</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('vltotal'); ?>" id="vltotal" name="vltotal"
                                        maxlength="11">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vlfilme">Valor filme</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('vlfilme'); ?>" id="vlfilme" name="vlfilme"
                                        maxlength="11">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dtcriacao">Data criação</label>
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
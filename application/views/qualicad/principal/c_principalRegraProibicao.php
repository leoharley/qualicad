<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Cadastrar Regra Proibição
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
                                        <label for="dsgrupropro">Grupro pro associado</label>
                                        <select class="form-control required" id="dsgrupropro" name="dsgrupropro">
                                            <option value="1">GRUPO_PRO_1</option>
											<option value="2">GRUPO_PRO_2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dsplano">Plano associado</label>
                                        <select class="form-control required" id="dsplano" name="dsplano">
                                            <option value="1">PLANO_1</option>
											<option value="2">PLANO_2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dsregraproibicao">Descrição</label>
                                        <input type="text" class="form-control required email" id="dsregraproibicao" value="<?php echo set_value('dsregraproibicao'); ?>" name="dsregraproibicao"
                                            maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tpregraproibicao">Tipo de regra de proibição</label>
                                        <select class="form-control required" id="tpregraproibicao" name="tpregraproibicao">
                                            <option value="1">TIPO_REGRA_PROIBICAO_1</option>
											<option value="2">TIPO_REGRA_PROIBICAO_2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tpatendimento">Tipo de atendimento</label>
                                        <select class="form-control required" id="tpatendimento" name="tpatendimento">
                                            <option value="1">TIPO_ATENDIMENTO_1</option>
											<option value="2">TIPO_ATENDIMENTO_2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vlregraproibicao">Valor da regra de proibição</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('vlregraproibicao'); ?>" id="vlregraproibicao" name="vlregraproibicao"
                                        maxlength="11">
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
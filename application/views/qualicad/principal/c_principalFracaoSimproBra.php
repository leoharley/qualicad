<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Cadastrar Fração Simpro Bra
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
                                        <label for="dsprofat">ProFat associada</label>
                                        <select class="form-control required" id="dsprofat" name="dsprofat">
                                            <option value="1">PROFAT_1</option>
											<option value="2">PROFAT_2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dsfaturamento">Faturamento associado</label>
                                        <select class="form-control required" id="dsfaturamento" name="dsfaturamento">
                                            <option value="1">FATURAMENTO_1</option>
											<option value="2">FATURAMENTO_2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dstuss">TUSS associada</label>
                                        <select class="form-control required" id="dstuss" name="dstuss">
                                            <option value="1">TUSS_1</option>
											<option value="2">TUSS_1</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dsfracaosimprobra">Descrição fração simpro bra</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('dsfracaosimprobra'); ?>" id="dsfracaosimprobra" name="dsfracaosimprobra"
                                        maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dslaboratorio">Descrição laboratório</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('dslaboratorio'); ?>" id="dslaboratorio" name="dslaboratorio"
                                        maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dsapresentacao">Descrição apresentação</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('dsapresentacao'); ?>" id="dsapresentacao" name="dsapresentacao"
                                        maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="Tp_MatMed">Tipo MatMed</label>
                                        <select class="form-control required" id="Tp_MatMed" name="Tp_MatMed">
                                            <option value="MED" <?php if ($this->uri->segment(2) == 'editar' && $Tp_MatMed == 'MED') { echo 'selected'; } else if ($this->uri->segment(2) == 'cadastrar') { echo 'selected'; } ?>>MED</option>
                                            <option value="MAT" <?php if ($this->uri->segment(2) == 'editar' && $Tp_MatMed == 'MAT') { echo 'selected'; } ?>>MAT</option>
                                            <option value="SOL" <?php if ($this->uri->segment(2) == 'editar' && $Tp_MatMed == 'SOL') { echo 'selected'; } ?>>SOL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vlfatordivisao">Valor do fator de divisão</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('vlfatordivisao'); ?>" id="vlfatordivisao" name="vlfatordivisao"
                                        maxlength="11">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="qtprod">Quantidade de produção</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('qtprod'); ?>" id="qtprod" name="qtprod"
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
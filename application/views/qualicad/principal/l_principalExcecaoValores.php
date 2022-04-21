<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Listar Exceção Valores
      <small>Listar</small>
    </h1>
  </section>

  <style>
  th {
    border-color: #c0c0c0;
    color: white;
    background-color: #a0a0a0;
    }
  td {
    border-color: #c0c0c0;
    color: black;
    }
  </style>

  <section class="content">
    <div class="col-xs-12">
      <div class="text-left">
        <a class="btn btn-primary" href="<?php echo base_url(); ?>principalExcecaoValores/cadastrar">
          <i class="fa fa-plus"></i> Adicionar exceção valores</a>
      </div>
      <br/>
      <div class="box">
        <div class="box-header">
          <div class="box-tools">
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
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
            <div class="panel-body">
              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Convênio</th>
                    <th>TUSS</th>
                    <th>ProFat</th>
                    <th>Descrição</th>
                    <th>Classe evento</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Ativo?</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      if(!empty($registroExcecaoValores))
                      {
                          foreach($registroExcecaoValores as $registro)
                          {
                      ?>
                    <tr>
                      <td>
                        <?php echo $registro->Id_ExcValores ?>
                      </td>
                      <td>
                        <?php echo $registro->Ds_Convenio ?>
                      </td>
                      <td>
                        <?php echo $registro->Ds_Tuss ?>
                      </td>
                      <td>
                        <?php echo $registro->Ds_ProFat ?>
                      </td>
                      <td>
                        <?php echo $registro->Ds_ExcValores ?>
                      </td>
                      <td>
                        <?php echo $registro->ClasseEvento ?>
                      </td>
                      <td>
                        <?php echo $registro->Tp_ExcValores ?>
                      </td>
                      <td>
                        <?php echo $registro->Vl_ExcValores ?>
                      </td>
                      <td>
                        <?php echo $registro->Tp_Ativo ?>
                      </td>
                       
                      <td class="text-center">
                        <!--  <a class="btn btn-sm btn-primary" href="<?php //echo base_url().'log-history/'.$record->userId; ?>" title="Log geçmişi">
                              <i class="fa fa-history"></i>
                          </a> -->
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'principalExcecaoValores/editar/'.$registro->Id_ExcValores; ?>" title="Editar">
                              <i class="fa fa-pencil"></i>
                          </a>
                          <a class="btn btn-sm btn-danger deleteUser" href="<?php echo base_url().'apagaExcecaoValores/'.$registro->Id_ExcValores; ?>" title="Excluir">
                              <i class="fa fa-trash-o"></i>
                          </a>
                      </td>
                    </tr>
                    <?php
                          }
                      }
                      ?>
                </tbody>
              </table>
            </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
</div>
</section>
</div>
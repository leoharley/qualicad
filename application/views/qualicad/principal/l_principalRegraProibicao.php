<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <i class="fa fa-users"></i> Listar Regra de Proibição
      <small>Listar</small>
    </h1>
  </section>

  <style>
  table {
    border-color: #808080!important;
  }
  th {
    border-color: #808080!important;
    color: black;
    background-color: #d0d0d0;
    }
  td {
    border-color: #808080!important;
    color: black;
    }
  </style>
  
  <section class="content">
    <div class="col-xs-12">
      <div class="text-left">
        <a class="btn btn-primary" href="<?php echo base_url(); ?>principalRegraProibicao/cadastrar">
          <i class="fa fa-plus"></i> Adicionar regra de proibição</a>
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
                    <th>Id Seq</th>
                    <th>Faturamento (descrição)</th>
                    <th>Grupo Pro (descrição)</th>
                    <th>Plano (descrição)</th>
                    <th>Regra de proibição (descrição)</th>
                    <th>Tipo da regra</th>
                    <th>Tipo de atendimento</th>
                    <th>Valor</th>
                    <th>Regra ativa?</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                      if(!empty($registrosRegraProibicao))
                      {
                          foreach($registrosRegraProibicao as $registro)
                          {
                      ?>
                    <tr>
                      <td>
                        <?php echo $registro->Id_RegraProibicao ?>
                      </td>
                      <td>
                        <?php echo $registro->Ds_Faturamento ?>
                      </td>
                      <td>
                        <?php echo $registro->Ds_GrupoPro ?>
                      </td>
                      <td>
                        <?php echo $registro->Ds_Plano ?>
                      </td>
                      <td>
                        <?php echo $registro->Ds_RegraProibicao ?>
                      </td>
                      <td>
                        <?php echo $registro->Tp_RegraProibicao ?>
                      </td>
                      <td>
                        <?php echo $registro->Tp_Atendimento ?>
                      </td>
                      <td>
                        <?php echo $registro->Vl_RegraProibicao ?>
                      </td>
                      <td>
                        <?php echo ($registro->Tp_Ativo == 'S') ? 'Sim' : 'Não'; ?>
                      </td>
                      <td class="text-center">
                        <!--  <a class="btn btn-sm btn-primary" href="<?php //echo base_url().'log-history/'.$record->userId; ?>" title="Log geçmişi">
                              <i class="fa fa-history"></i>
                          </a> -->
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'principalRegraProibicao/editar/'.$registro->Id_RegraProibicao ; ?>" title="Editar">
                              <i class="fa fa-pencil"></i>
                          </a>
                          <a class="btn btn-sm btn-danger deleteUser" href="<?php echo base_url().'apagaRegraProibicao/'.$registro->Id_RegraProibicao; ?>" title="Excluir">
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
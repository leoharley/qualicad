<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Importa Produção
            <small>Importação</small>
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
    #importFrm {
        margin-bottom: 20px;
    } 
  </style>   

    <section class="content">

      
<div class="container">
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
	
    <div class="row">
		
        <!-- File upload form -->
        <div class="col-md-12" id="importFrm">
            <form action="<?php echo base_url() ?>importaProducao" method="post" enctype="multipart/form-data">
                <input type="file" name="file" />
                <br/>
                <input type="submit" class="btn btn-primary" name="importSubmit" id="importSubmit" value="IMPORTAR">
            </form>
        </div>
        
        <!-- Data list table -->
        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>TbProFat_Cd_ProFat</th>
                    <th>TbPlano_Id_Plano</th>
                    <th>Num_Conta</th>
                    <th>Num_Atendimento</th>
                    <th>Dt_Lancamento</th>
                    <th>Qt_Lancamento</th>
                    <th>Vl_Conta</th>
                    <th>Cd_Movimento</th>
                    <th>Cd_ITMovimento</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($infoProducao)){ foreach($infoProducao as $registro){ ?>
                <tr>
                    <td><?php echo $registro->TbProFat_Cd_ProFat ?></td>
                    <td><?php echo $registro->TbPlano_Id_Plano ?></td>
                    <td><?php echo $registro->Num_Conta ?></td>
                    <td><?php echo $registro->Num_Atendimento ?></td>
                    <td><?php echo $registro->Dt_Lancamento ?></td>
                    <td><?php echo $registro->Qt_Lancamento ?></td>
                    <td><?php echo $registro->Vl_Conta ?></td>
                    <td><?php echo $registro->Cd_Movimento ?></td>
                    <td><?php echo $registro->Cd_ITMovimento ?></td>
                </tr>
                <?php } }else{ ?>
                <tr><td colspan="5">Nenhum registro encontrado...</td></tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</section>
</div>

<script>
function formToggle(ID){
    var element = document.getElementById(ID);
    if(element.style.display === "none"){
        element.style.display = "block";
    }else{
        element.style.display = "none";
    }
}
$(document).ready(function () {
        $('#importSubmit').attr('disabled', true);
        $('input:file').change(
            function () {
                if ($(this).val()) {
                    $('#importSubmit').removeAttr('disabled');
                }
                else {
                    $('#importSubmit').attr('disabled', true);
                }
            });
    });
</script>
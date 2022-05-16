<?php

$Id_Regra = '';
$Ds_Regra = '';
$Tp_Ativo = '';

if ($this->uri->segment(2) == 'editar') {
if(!empty($infoRegra))
{
    foreach ($infoRegra as $r)
    {
        $Id_Regra = $r->Id_Regra;
        $Ds_Regra = $r->Ds_Regra;
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
            <i class="fa fa-users"></i> <?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Cadastrar Regra' : 'Editar Regra' ; ?>
            <small><?php echo ($this->uri->segment(2) == 'cadastrar') ? 'Adicionar' : 'Editar' ; ?></small>
        </h1>
    </section>

    <section class="content" ng-app="appPrincipal" ng-controller="entercontroller">

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
<script src="<?php echo base_url(); ?>assets/js/addRegra.js" type="text/javascript"></script>

<script>
$(document).ready(function(){
        $(":input").inputmask();
        $('.valor').maskMoney();
        document.getElementById("perc").focus();
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
        document.getElementById('salvarRegraGruPro').click();
    });
</script>

<script !src="">
    var app = angular.module('appPrincipal', []);
    app.controller('entercontroller', function ($scope, $http) {
        console.log('success');
    });
</script>
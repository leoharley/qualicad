<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class PrincipalModel extends CI_Model
{
    
// INICIO DAS CONSULTAS NA TELA DE CONVENIO
    function listaConvenio($IdEmpresa, $searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('TbConvenio as Convenio');
        $this->db->join('TbUsuEmp as UsuEmp', 'UsuEmp.Id_UsuEmp = Convenio.TbUsuEmp_Id_UsuEmp','inner');
   //     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(Convenio.Ds_Convenio  LIKE '%".$searchText."%'
                            OR  Convenio.CNPJ_Convenio  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('Convenio.Deletado !=', 'S');
        $this->db->where('Convenio.Tp_Ativo', 'S');
        $this->db->where('Convenio.TbEmpresa_Id_Empresa', $IdEmpresa);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function adicionaConvenio($info)
    {
        $this->db->trans_start();
        $this->db->insert('TbConvenio', $info);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function editaConvenio($info, $id)
    {
        $this->db->where('Id_Convenio', $id);
        $this->db->update('TbConvenio', $info);
        
        return TRUE;
    }

    function apagaConvenio($info, $id)
    {
        $this->db->where('Id_Convenio', $id);
        $this->db->update('TbConvenio', $info);
        
        return $this->db->affected_rows();
    }

    function consultaConvenioExistente($CNPJ_Convenio, $IdEmpresa)
    {
        $this->db->select('Convenio.Id_Convenio');
        $this->db->from('TbConvenio as Convenio');
        $this->db->join('TbUsuEmp as UsuEmp', 'UsuEmp.Id_UsuEmp = Convenio.TbUsuEmp_Id_UsuEmp','inner');
        $campos = "(Convenio.CNPJ_Convenio = '".$CNPJ_Convenio."'
                    AND UsuEmp.TbEmpresa_Id_Empresa  = '".$IdEmpresa."')";
        $this->db->where($campos);
        $query = $this->db->get();

        return $query->result();
    }

    function carregaInfoConvenio($IdConvenio)
    {
        $this->db->select('*');
        $this->db->from('TbConvenio');
        $this->db->where('Id_Convenio', $IdConvenio);
        $query = $this->db->get();

        return $query->result();
    }

    function carregaInfoConveniosEmpresa($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('TbConvenio as Convenio');
        $this->db->where('Convenio.TbEmpresa_Id_Empresa', $idEmpresa);
        $query = $this->db->get();

        return $query->result();
    }

// FIM DAS CONSULTAS NA TELA DE CONVENIO

    // INICIO DAS CONSULTAS NA TELA DE PLANO
    function listaPlano($IdEmpresa, $searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('TbPlano as Plano');
        $this->db->join('TbConvenio as Convenio', 'Convenio.Id_Convenio = Plano.TbConvenio_Id_Convenio AND Convenio.Deletado != "S" AND Convenio.Tp_Ativo = "S"','inner');
        $this->db->join('TbIndice as Indice', 'Indice.Id_Indice = Plano.TbIndice_Id_Indice AND Indice.Deletado != "S" AND Indice.Tp_Ativo = "S"','inner');
        $this->db->join('TbRegra as Regra', 'Regra.Id_Regra = Plano.TbRegra_Id_Regra AND Regra.Deletado != "S" AND Regra.Tp_Ativo = "S"','inner');
        $this->db->join('TbUsuEmp as UsuEmp', 'UsuEmp.Id_UsuEmp = Convenio.TbUsuEmp_Id_UsuEmp','inner');
    //     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(Plano.Ds_Plano LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }

        $this->db->where('Plano.Deletado !=', 'S');
        $this->db->where('Plano.Tp_Ativo', 'S');
        $this->db->where('Plano.TbEmpresa_Id_Empresa', $IdEmpresa);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function adicionaPlano($info)
    {
        $this->db->trans_start();
        $this->db->insert('TbPlano', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function editaPlano($info, $id)
    {
        $this->db->where('Id_Plano', $id);
        $this->db->update('TbPlano', $info);

        return TRUE;
    }

    function apagaPlano($info, $id)
    {
        $this->db->where('Id_Plano', $id);
        $this->db->update('TbPlano', $info);

        return $this->db->affected_rows();
    }

/*    function consultaPlanoExistente($CNPJ_Convenio, $IdUsuEmp)
    {
        $this->db->select('Id_Convenio');
        $this->db->from('TbConvenio');
        $campos = "(CNPJ_Convenio = '".$CNPJ_Convenio."'
                    AND TbUsuEmp_Id_UsuEmp  = '".$IdUsuEmp."')";
        $this->db->where($campos);
        $query = $this->db->get();

        return $query->result();
    } */

    function carregaInfoPlano($Id)
    {
        $this->db->select('*');
        $this->db->from('TbPlano');
        $this->db->where('Id_Plano', $Id);
        $query = $this->db->get();

        return $query->result();
    }
// FIM DAS CONSULTAS NA TELA DE PLANO

// INICIO DAS CONSULTAS NA TELA DE FATURAMENTO
function listaFaturamento($IdEmpresa, $searchText = '', $page, $segment)
{
    $this->db->select('*');
    $this->db->from('TbFaturamento as Faturamento');
//    $this->db->join('TbConvenio as Convenio', 'Empresa.Id_Empresa = UsuEmp.TbEmpresa_Id_Empresa AND Empresa.Deletado != "S" AND Empresa.Tp_Ativo = "S"','inner');
//     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
    if(!empty($searchText)) {
        $likeCriteria = "(Faturamento.Ds_Faturamento  LIKE '%".$searchText."%')";
        $this->db->where($likeCriteria);
    }

    $this->db->where('Faturamento.Deletado !=', 'S');
    $this->db->where('Faturamento.Tp_Ativo', 'S');
    $this->db->where('Faturamento.TbEmpresa_Id_Empresa', $IdEmpresa);
    $this->db->limit($page, $segment);
    $query = $this->db->get();
    
    $result = $query->result();        
    return $result;
}

function adicionaFaturamento($info)
{
    $this->db->trans_start();
    $this->db->insert('TabUsuario', $infoUsuario);
    
    $insert_id = $this->db->insert_id();
    
    $this->db->trans_complete();
    
    return $insert_id;
}

function editaFaturamento($info, $id)
{
    $this->db->where('Id_Usuario', $IdUsuario);
    $this->db->update('TabUsuario', $infoUsuario);
    
    return TRUE;
}

function apagaFaturamento($info, $id)
{
    $this->db->where('Id_Usuario', $IdUsuario);
    $this->db->update('TabUsuario', $infoUsuario);
    
    return $this->db->affected_rows();
}
// FIM DAS CONSULTAS NA TELA DE FATURAMENTO

// INICIO DAS CONSULTAS NA TELA DE REGRA
function listaRegra($IdEmpresa, $searchText = '', $page, $segment)
{
    $this->db->select('*');
    $this->db->from('TbRegra as Regra');
//     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
    if(!empty($searchText)) {
        $likeCriteria = "(Regra.Ds_Regra LIKE '%".$searchText."%')";
        $this->db->where($likeCriteria);
    }

    $this->db->where('Regra.Deletado !=', 'S');
    $this->db->where('Regra.Tp_Ativo', 'S');
    $this->db->where('Regra.TbEmpresa_Id_Empresa', $IdEmpresa);
    $this->db->limit($page, $segment);
    $query = $this->db->get();
    
    $result = $query->result();        
    return $result;
}

function adicionaRegra($info)
{
    $this->db->trans_start();
    $this->db->insert('TbRegra', $info);
    
    $insert_id = $this->db->insert_id();
    
    $this->db->trans_complete();
    
    return $insert_id;
}

function editaRegra($info, $id)
{
    $this->db->where('Id_Regra', $id);
    $this->db->update('TbRegra', $info);
    
    return TRUE;
}

function apagaRegra($info, $id)
{
    $this->db->where('Id_Regra', $id);
    $this->db->update('TbRegra', $info);
    
    return $this->db->affected_rows();
}
// FIM DAS CONSULTAS NA TELA DE REGRA

// INICIO DAS CONSULTAS NA TELA DE INDICE
function listaIndice($IdEmpresa, $searchText = '', $page, $segment)
{
    $this->db->select('*');
    $this->db->from('TbIndice as Indice');
//     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
    if(!empty($searchText)) {
        $likeCriteria = "(Indice.Ds_Indice LIKE '%".$searchText."%')";
        $this->db->where($likeCriteria);
    }
    $this->db->where('Indice.Deletado !=', 'S');
    $this->db->where('Indice.Tp_Ativo', 'S');
    $this->db->where('Indice.TbEmpresa_Id_Empresa', $IdEmpresa);
    $this->db->limit($page, $segment);
    $query = $this->db->get();
    
    $result = $query->result();        
    return $result;
}

function adicionaIndice($info)
{
    $this->db->trans_start();
    $this->db->insert('TbIndice', $info);
    
    $insert_id = $this->db->insert_id();
    
    $this->db->trans_complete();
    
    return $insert_id;
}

function editaIndice($info, $id)
{
    $this->db->where('Id_Indice', $id);
    $this->db->update('TbIndice', $info);
    
    return TRUE;
}

function apagaIndice($info, $id)
{
    $this->db->where('Id_Indice', $id);
    $this->db->update('TbIndice', $info);
    
    return $this->db->affected_rows();
}
// FIM DAS CONSULTAS NA TELA DE INDICE

}

  
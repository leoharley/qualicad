<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class PrincipalModel extends CI_Model
{
    
// INICIO DAS CONSULTAS NA TELA DE CONVENIO
    function listaConvenio($id, $searchText = '', $page, $segment)
    {
        $this->db->select('Usuarios.Id_Usuario, Usuarios.Nome_Usuario, Usuarios.Admin, Usuarios.Cpf_Usuario, Usuarios.Tp_Ativo, Usuarios.Dt_Ativo, Usuarios.Dt_Inativo, Usuarios.Email');
        $this->db->from('TabUsuario as Usuarios');
   //     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(Usuarios.Email  LIKE '%".$searchText."%'
                            OR  Usuarios.Nome_Usuario  LIKE '%".$searchText."%'
                            OR  Usuarios.Cpf_Usuario  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $campos = "((Usuarios.Admin = 'S'
                    AND Usuarios.CriadoPor = '".$idUser."'))
                    OR
                    (Usuarios.Admin = 'N')";
        $this->db->where($campos);

        $this->db->where('Usuarios.Deletado !=', 'S');
        $this->db->where('Usuarios.Id_Usuario !=', $idUser);
        $this->db->where('Usuarios.CriadoPor', $idUser);
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function adicionaConvenio($info)
    {
        $this->db->trans_start();
        $this->db->insert('TabUsuario', $infoUsuario);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function editaConvenio($info, $id)
    {
        $this->db->where('Id_Usuario', $IdUsuario);
        $this->db->update('TabUsuario', $infoUsuario);
        
        return TRUE;
    }

    function apagaConvenio($info, $id)
    {
        $this->db->where('Id_Usuario', $IdUsuario);
        $this->db->update('TabUsuario', $infoUsuario);
        
        return $this->db->affected_rows();
    }
// FIM DAS CONSULTAS NA TELA DE CONVENIO

// INICIO DAS CONSULTAS NA TELA DE PLANO
function listaPlano($id, $searchText = '', $page, $segment)
{
    $this->db->select('Usuarios.Id_Usuario, Usuarios.Nome_Usuario, Usuarios.Admin, Usuarios.Cpf_Usuario, Usuarios.Tp_Ativo, Usuarios.Dt_Ativo, Usuarios.Dt_Inativo, Usuarios.Email');
    $this->db->from('TabUsuario as Usuarios');
//     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
    if(!empty($searchText)) {
        $likeCriteria = "(Usuarios.Email  LIKE '%".$searchText."%'
                        OR  Usuarios.Nome_Usuario  LIKE '%".$searchText."%'
                        OR  Usuarios.Cpf_Usuario  LIKE '%".$searchText."%')";
        $this->db->where($likeCriteria);
    }
    $campos = "((Usuarios.Admin = 'S'
                AND Usuarios.CriadoPor = '".$idUser."'))
                OR
                (Usuarios.Admin = 'N')";
    $this->db->where($campos);

    $this->db->where('Usuarios.Deletado !=', 'S');
    $this->db->where('Usuarios.Id_Usuario !=', $idUser);
    $this->db->where('Usuarios.CriadoPor', $idUser);
    $this->db->limit($page, $segment);
    $query = $this->db->get();
    
    $result = $query->result();        
    return $result;
}

function adicionaPlano($info)
{
    $this->db->trans_start();
    $this->db->insert('TabUsuario', $infoUsuario);
    
    $insert_id = $this->db->insert_id();
    
    $this->db->trans_complete();
    
    return $insert_id;
}

function editaPlano($info, $id)
{
    $this->db->where('Id_Usuario', $IdUsuario);
    $this->db->update('TabUsuario', $infoUsuario);
    
    return TRUE;
}

function apagaPlano($info, $id)
{
    $this->db->where('Id_Usuario', $IdUsuario);
    $this->db->update('TabUsuario', $infoUsuario);
    
    return $this->db->affected_rows();
}
// FIM DAS CONSULTAS NA TELA DE PLANO

// INICIO DAS CONSULTAS NA TELA DE FATURAMENTO
function listaFaturamento($id, $searchText = '', $page, $segment)
{
    $this->db->select('Usuarios.Id_Usuario, Usuarios.Nome_Usuario, Usuarios.Admin, Usuarios.Cpf_Usuario, Usuarios.Tp_Ativo, Usuarios.Dt_Ativo, Usuarios.Dt_Inativo, Usuarios.Email');
    $this->db->from('TabUsuario as Usuarios');
//     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
    if(!empty($searchText)) {
        $likeCriteria = "(Usuarios.Email  LIKE '%".$searchText."%'
                        OR  Usuarios.Nome_Usuario  LIKE '%".$searchText."%'
                        OR  Usuarios.Cpf_Usuario  LIKE '%".$searchText."%')";
        $this->db->where($likeCriteria);
    }
    $campos = "((Usuarios.Admin = 'S'
                AND Usuarios.CriadoPor = '".$idUser."'))
                OR
                (Usuarios.Admin = 'N')";
    $this->db->where($campos);

    $this->db->where('Usuarios.Deletado !=', 'S');
    $this->db->where('Usuarios.Id_Usuario !=', $idUser);
    $this->db->where('Usuarios.CriadoPor', $idUser);
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
function listaRegra($id, $searchText = '', $page, $segment)
{
    $this->db->select('Usuarios.Id_Usuario, Usuarios.Nome_Usuario, Usuarios.Admin, Usuarios.Cpf_Usuario, Usuarios.Tp_Ativo, Usuarios.Dt_Ativo, Usuarios.Dt_Inativo, Usuarios.Email');
    $this->db->from('TabUsuario as Usuarios');
//     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
    if(!empty($searchText)) {
        $likeCriteria = "(Usuarios.Email  LIKE '%".$searchText."%'
                        OR  Usuarios.Nome_Usuario  LIKE '%".$searchText."%'
                        OR  Usuarios.Cpf_Usuario  LIKE '%".$searchText."%')";
        $this->db->where($likeCriteria);
    }
    $campos = "((Usuarios.Admin = 'S'
                AND Usuarios.CriadoPor = '".$idUser."'))
                OR
                (Usuarios.Admin = 'N')";
    $this->db->where($campos);

    $this->db->where('Usuarios.Deletado !=', 'S');
    $this->db->where('Usuarios.Id_Usuario !=', $idUser);
    $this->db->where('Usuarios.CriadoPor', $idUser);
    $this->db->limit($page, $segment);
    $query = $this->db->get();
    
    $result = $query->result();        
    return $result;
}

function adicionaRegra($info)
{
    $this->db->trans_start();
    $this->db->insert('TabUsuario', $infoUsuario);
    
    $insert_id = $this->db->insert_id();
    
    $this->db->trans_complete();
    
    return $insert_id;
}

function editaRegra($info, $id)
{
    $this->db->where('Id_Usuario', $IdUsuario);
    $this->db->update('TabUsuario', $infoUsuario);
    
    return TRUE;
}

function apagaRegra($info, $id)
{
    $this->db->where('Id_Usuario', $IdUsuario);
    $this->db->update('TabUsuario', $infoUsuario);
    
    return $this->db->affected_rows();
}
// FIM DAS CONSULTAS NA TELA DE REGRA

// INICIO DAS CONSULTAS NA TELA DE INDICE
function listaIndice($id, $searchText = '', $page, $segment)
{
    $this->db->select('Usuarios.Id_Usuario, Usuarios.Nome_Usuario, Usuarios.Admin, Usuarios.Cpf_Usuario, Usuarios.Tp_Ativo, Usuarios.Dt_Ativo, Usuarios.Dt_Inativo, Usuarios.Email');
    $this->db->from('TabUsuario as Usuarios');
//     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
    if(!empty($searchText)) {
        $likeCriteria = "(Usuarios.Email  LIKE '%".$searchText."%'
                        OR  Usuarios.Nome_Usuario  LIKE '%".$searchText."%'
                        OR  Usuarios.Cpf_Usuario  LIKE '%".$searchText."%')";
        $this->db->where($likeCriteria);
    }
    $campos = "((Usuarios.Admin = 'S'
                AND Usuarios.CriadoPor = '".$idUser."'))
                OR
                (Usuarios.Admin = 'N')";
    $this->db->where($campos);

    $this->db->where('Usuarios.Deletado !=', 'S');
    $this->db->where('Usuarios.Id_Usuario !=', $idUser);
    $this->db->where('Usuarios.CriadoPor', $idUser);
    $this->db->limit($page, $segment);
    $query = $this->db->get();
    
    $result = $query->result();        
    return $result;
}

function adicionaIndice($info)
{
    $this->db->trans_start();
    $this->db->insert('TabUsuario', $infoUsuario);
    
    $insert_id = $this->db->insert_id();
    
    $this->db->trans_complete();
    
    return $insert_id;
}

function editaIndice($info, $id)
{
    $this->db->where('Id_Usuario', $IdUsuario);
    $this->db->update('TabUsuario', $infoUsuario);
    
    return TRUE;
}

function apagaIndice($info, $id)
{
    $this->db->where('Id_Usuario', $IdUsuario);
    $this->db->update('TabUsuario', $infoUsuario);
    
    return $this->db->affected_rows();
}
// FIM DAS CONSULTAS NA TELA DE INDICE

}

  
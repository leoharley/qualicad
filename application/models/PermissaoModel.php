<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class PermissaoModel extends CI_Model
{
    
    function permissaoTela($IdUsuEmp, $dsTela)
    {
        $this->db->select('*');    
        $this->db->from('TbUsuEmp as UsuEmp'); 
        $this->db->join('TabTela as Tela', 'Tela.TbPerfil_Id_CdPerfil = UsuEmp.TbPerfil_Id_CdPerfil','left');
        $this->db->where('UsuEmp.Id_UsuEmp', $IdUsuEmp);
        $this->db->where('UsuEmp.Deletado', 'N');
        $this->db->where('Tela.Ds_Tela', $dsTela);
        $this->db->where('Tela.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function permissaoAcaoInserir($IdUsuEmp, $dsTela)
    {
        $this->db->select('*');    
        $this->db->from('TbPermissao as Permissao'); 
        $this->db->join('TbUsuEmp as UsuEmp', 'UsuEmp.TbPerfil_Id_CdPerfil  = Permissao.TbPerfil_Id_CdPerfil','left');
        $this->db->join('TabTela as Tela', 'Tela.TbPerfil_Id_CdPerfil = UsuEmp.TbPerfil_Id_CdPerfil','left');
        $this->db->where('UsuEmp.Id_UsuEmp', $IdUsuEmp);
        $this->db->where('Tela.Ds_Tela', $dsTela);
        $this->db->where('Tela.Tp_Ativo', 'S');
        $this->db->where('Permissao.Inserir', 'S');
        $query = $this->db->get();

        return $query->result();
    }

}

  
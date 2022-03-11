<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class PermissaoModel extends CI_Model
{
    
    function permissaoTela($IdUsuEmp, $dsTela)
    {
        $this->db->select('Tela.Tp_Ativo');
        $this->db->from('TbUsuEmp as UsuEmp'); 
        $this->db->join('TabTela as Tela', 'Tela.TbPerfil_Id_CdPerfil = UsuEmp.TbPerfil_Id_CdPerfil','left');
        $this->db->where('UsuEmp.Id_UsuEmp', $IdUsuEmp);
        $this->db->where('UsuEmp.Deletado', 'N');
        $this->db->where('Tela.Ds_Tela', $dsTela);
        $query = $this->db->get();

        return $query->result();
    }

    function permissaoAcaoAtualizar($IdUsuEmp, $dsTela)
    {
        $this->db->select('*');    
        $this->db->from('TbPermissao as Permissao'); 
        $this->db->join('TbUsuEmp as UsuEmp', 'UsuEmp.TbPerfil_Id_CdPerfil = Permissao.TbPerfil_Id_CdPerfil','inner');
        $this->db->join('TabTela as Tela', 'Tela.TbPerfil_Id_CdPerfil = Permissao.TbPerfil_Id_CdPerfil and Tela.Id_Tela = Permissao.TabTela_Id_Tela','inner');
        $this->db->where('UsuEmp.Id_UsuEmp', $IdUsuEmp);
        $this->db->where('UsuEmp.Deletado', 'N');
        $this->db->where('Tela.Ds_Tela', $dsTela);
        $this->db->where('Tela.Tp_Ativo', 'S');
        $this->db->where('Permissao.Atualizar', 'S');
        $query = $this->db->get();

    //    return $query->result();
        return TRUE;
    }

    function permissaoAcaoInserir($IdUsuEmp, $dsTela)
    {
        $this->db->select('*');    
        $this->db->from('TbPermissao as Permissao'); 
        $this->db->join('TbUsuEmp as UsuEmp', 'UsuEmp.TbPerfil_Id_CdPerfil = Permissao.TbPerfil_Id_CdPerfil','inner');
        $this->db->join('TabTela as Tela', 'Tela.TbPerfil_Id_CdPerfil = Permissao.TbPerfil_Id_CdPerfil and Tela.Id_Tela = Permissao.TabTela_Id_Tela','inner');
        $this->db->where('UsuEmp.Id_UsuEmp', $IdUsuEmp);
        $this->db->where('UsuEmp.Deletado', 'N');
        $this->db->where('Tela.Ds_Tela', $dsTela);
        $this->db->where('Tela.Tp_Ativo', 'S');
        $this->db->where('Permissao.Inserir', 'S');
        $query = $this->db->get();

    //    return $query->result();
        return TRUE;
    }

    function permissaoAcaoExcluir($IdUsuEmp, $dsTela)
    {       
        $this->db->select('*');    
        $this->db->from('TbPermissao as Permissao'); 
        $this->db->join('TbUsuEmp as UsuEmp', 'UsuEmp.TbPerfil_Id_CdPerfil = Permissao.TbPerfil_Id_CdPerfil','inner');
        $this->db->join('TabTela as Tela', 'Tela.TbPerfil_Id_CdPerfil = Permissao.TbPerfil_Id_CdPerfil and Tela.Id_Tela = Permissao.TabTela_Id_Tela','inner');
        $this->db->where('UsuEmp.Id_UsuEmp', $IdUsuEmp);
        $this->db->where('UsuEmp.Deletado', 'N');
        $this->db->where('Tela.Ds_Tela', $dsTela);
        $this->db->where('Tela.Tp_Ativo', 'S');
        $this->db->where('Permissao.Excluir', 'S');
        $query = $this->db->get();

    //    return $query->result();
        return TRUE;
    }

    function permissaoAcaoConsultar($IdUsuEmp, $dsTela)
    {
        $this->db->select('Permissao.Consultar');    
        $this->db->from('TbPermissao as Permissao'); 
        $this->db->join('TbUsuEmp as UsuEmp', 'UsuEmp.TbPerfil_Id_CdPerfil = Permissao.TbPerfil_Id_CdPerfil','inner');
        $this->db->join('TabTela as Tela', 'Tela.TbPerfil_Id_CdPerfil = Permissao.TbPerfil_Id_CdPerfil and Tela.Id_Tela = Permissao.TabTela_Id_Tela','inner');
        $this->db->where('UsuEmp.Id_UsuEmp', $IdUsuEmp);
        $this->db->where('UsuEmp.Deletado', 'N');
        $this->db->where('Tela.Ds_Tela', $dsTela);
        $this->db->where('Tela.Tp_Ativo', 'S');
        $query = $this->db->get();

        if ($this->session->userdata('email') == 'admin@admin.com') { echo $query->result(); }

        return $query->result();
    }

    function permissaoAcaoImprimir($IdUsuEmp, $dsTela)
    {
        $this->db->select('*');    
        $this->db->from('TbPermissao as Permissao'); 
        $this->db->join('TbUsuEmp as UsuEmp', 'UsuEmp.TbPerfil_Id_CdPerfil = Permissao.TbPerfil_Id_CdPerfil','inner');
        $this->db->join('TabTela as Tela', 'Tela.TbPerfil_Id_CdPerfil = Permissao.TbPerfil_Id_CdPerfil and Tela.Id_Tela = Permissao.TabTela_Id_Tela','inner');
        $this->db->where('UsuEmp.Id_UsuEmp', $IdUsuEmp);
        $this->db->where('UsuEmp.Deletado', 'N');
        $this->db->where('Tela.Ds_Tela', $dsTela);
        $this->db->where('Tela.Tp_Ativo', 'S');
        $this->db->where('Permissao.Imprimir', 'S');
        $query = $this->db->get();

        //return $query->result();
        return TRUE;
    }

}

  
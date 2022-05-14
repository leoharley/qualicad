<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class ExportacaoModel extends CI_Model
{

    function exportaFatItem($idEmpresa,$var)
    {
        if ($var != 0) {
            $sql = 'SELECT * FROM ( SELECT * FROM TbFatItem ORDER BY Id_FatItem DESC LIMIT '.$var.' ) sub ORDER BY Id_FatItem ASC;';
            return $this->query($sql);
        }
        $this->db->select('*');
        $this->db->from('TbFatItem as FatItem');
        $this->db->where('FatItem.Deletado !=', 'S');
        $this->db->where('FatItem.Tp_Ativo', 'S');
        $this->db->where('FatItem.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->order_by('FatItem.Id_FatItem', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaGrupoPro($idEmpresa,$var)
    {
        $this->db->select('*');
        $this->db->from('TbGrupoPro as GrupoPro');
        $this->db->where('GrupoPro.Deletado !=', 'S');
        $this->db->where('GrupoPro.Tp_Ativo', 'S');
        $this->db->where('GrupoPro.TbEmpresa_Id_Empresa', $idEmpresa);
        if ($var != 0) { $this->db->limit($var); }
        $this->db->order_by('GrupoPro.CdGrupoPro', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaProFat($idEmpresa,$var)
    {
        $this->db->select('*');
        $this->db->from('TbProFat as ProFat');
        $this->db->where('ProFat.Deletado !=', 'S');
        $this->db->where('ProFat.Tp_Ativo', 'S');
        $this->db->where('ProFat.TbEmpresa_Id_Empresa', $idEmpresa);
        if ($var != 0) { $this->db->limit($var); }
        $this->db->order_by('ProFat.CodProFat', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaTUSS($idEmpresa,$var)
    {
        $this->db->select('*');
        $this->db->from('TbTUSS as TUSS');
        $this->db->where('TUSS.Deletado !=', 'S');
        $this->db->where('TUSS.Tp_Ativo', 'S');
        $this->db->where('TUSS.TbEmpresa_Id_Empresa', $idEmpresa);
        if ($var != 0) { $this->db->limit($var); }
        $this->db->order_by('TUSS.TbProFat_Cd_ProFat', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaRegraGruPro($idEmpresa,$var)
    {
        $this->db->select('*');
        $this->db->from('Tb_RegraGruPro as RegraGruPro');
        $this->db->where('RegraGruPro.Deletado !=', 'S');
        $this->db->where('RegraGruPro.Tp_Ativo', 'S');
        $this->db->where('RegraGruPro.TbEmpresa_Id_Empresa', $idEmpresa);
        if ($var != 0) { $this->db->limit($var); }
        $this->db->order_by('RegraGruPro.TbGrupoPro_CodGrupo', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaFracaoSimproBra($idEmpresa,$var)
    {
        $this->db->select('*');
        $this->db->from('Tb_FracaoSimproBra as FracaoSimproBra');
        $this->db->where('FracaoSimproBra.Deletado !=', 'S');
        $this->db->where('FracaoSimproBra.Tp_Ativo', 'S');
        $this->db->where('FracaoSimproBra.TbEmpresa_Id_Empresa', $idEmpresa);
        if ($var != 0) { $this->db->limit($var); }
        $this->db->order_by('FracaoSimproBra.TbProFat_Cd_ProFat', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaProduto($idEmpresa,$var)
    {
        $this->db->select('*');
        $this->db->from('Tb_Produto as Produto');
        $this->db->where('Produto.Deletado !=', 'S');
        $this->db->where('Produto.Tp_Ativo', 'S');
        $this->db->where('Produto.TbEmpresa_Id_Empresa', $idEmpresa);
        if ($var != 0) { $this->db->limit($var); }
        $this->db->order_by('Produto.TbProFat_Cd_ProFat', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaProducao($idEmpresa,$var)
    {
        $this->db->select('*');
        $this->db->from('Tb_Producao as Producao');
        $this->db->where('Producao.Deletado !=', 'S');
        $this->db->where('Producao.Tp_Ativo', 'S');
        $this->db->where('Producao.TbEmpresa_Id_Empresa', $idEmpresa);
        if ($var != 0) { $this->db->limit($var); }
        $this->db->order_by('Producao.TbProFat_Cd_ProFat', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaPorteMedico($idEmpresa,$var)
    {
        $this->db->select('*');
        $this->db->from('TbPorteMedico as PorteMedico');
        $this->db->where('PorteMedico.Deletado !=', 'S');
        $this->db->where('PorteMedico.Tp_Ativo', 'S');
        $this->db->where('PorteMedico.TbEmpresa_Id_Empresa', $idEmpresa);
        if ($var != 0) { $this->db->limit($var); }
        $this->db->order_by('PorteMedico.Cd_PorteMedico', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaExcecaoValores($idEmpresa,$var)
    {
        $this->db->select('*');
        $this->db->from('TbExcValores as ExcValores');
        $this->db->where('ExcValores.Deletado !=', 'S');
        $this->db->where('ExcValores.Tp_Ativo', 'S');
        $this->db->where('ExcValores.TbEmpresa_Id_Empresa', $idEmpresa);
        if ($var != 0) { $this->db->limit($var); }
        $this->db->order_by('ExcValores.CD_Convenio', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }


}

  
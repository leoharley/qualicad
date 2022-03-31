<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class ImportacaoModel extends CI_Model
{

    function carregaInfoGrupoPro($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('TbGrupoPro as GrupoPro');
        $this->db->where('GrupoPro.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('GrupoPro.Deletado !=', 'S');
        $this->db->where('GrupoPro.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function adicionaGrupoPro($info)
    {
        $this->db->trans_start();
        $this->db->insert('TbGrupoPro', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function carregaInfoProFat($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('TbProFat as ProFat');
        $this->db->where('ProFat.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('ProFat.Deletado !=', 'S');
        $this->db->where('ProFat.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function adicionaProFat($info)
    {
        $this->db->trans_start();
        $this->db->insert('TbProFat', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function carregaInfoDePara($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('Rl_DeparaImportacao as DePara');
        $this->db->where('ProFat.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('ProFat.Deletado !=', 'S');
        $this->db->where('ProFat.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function consultaDePara($tpImportacao, $idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('Rl_DeparaImportacao as DePara');
        $this->db->where('DePara.Tp_Importacao', $tpImportacao);
        $this->db->where('DePara.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('DePara.Deletado !=', 'S');
        $this->db->where('DePara.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

}

  
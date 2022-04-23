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

    function carregaInfoTUSS($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('TbTUSS as TUSS');
        $this->db->where('TUSS.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('TUSS.Deletado !=', 'S');
        $this->db->where('TUSS.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function adicionaTUSS($info)
    {
        $this->db->trans_start();
        $this->db->insert('TbTUSS', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function carregaInfoRegraGruPro($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('Tb_RegraGruPro as RegraGruPro');
        $this->db->where('RegraGruPro.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('RegraGruPro.Deletado !=', 'S');
        $this->db->where('RegraGruPro.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function adicionaRegraGruPro($info)
    {
        $this->db->trans_start();
        $this->db->insert('Tb_RegraGruPro', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function carregaInfoFracaoSimproBra($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('Tb_FracaoSimproBra as FracaoSimproBra');
        $this->db->where('FracaoSimproBra.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('FracaoSimproBra.Deletado !=', 'S');
        $this->db->where('FracaoSimproBra.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function adicionaFracaoSimproBra($info)
    {
        $this->db->trans_start();
        $this->db->insert('Tb_FracaoSimproBra', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function carregaInfoProduto($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('Tb_Produto as Produto');
        $this->db->where('Produto.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('Produto.Deletado !=', 'S');
        $this->db->where('Produto.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function adicionaProduto($info)
    {
        $this->db->trans_start();
        $this->db->insert('Tb_Produto', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function carregaInfoProducao($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('Tb_Producao as Producao');
        $this->db->where('Producao.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('Producao.Deletado !=', 'S');
        $this->db->where('Producao.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function adicionaProducao($info)
    {
        $this->db->trans_start();
        $this->db->insert('Tb_Producao', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function carregaInfoContrato($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('Tb_Contrato as Contrato');
        $this->db->where('Contrato.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('Contrato.Deletado !=', 'S');
        $this->db->where('Contrato.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function adicionaContrato($info)
    {
        $this->db->trans_start();
        $this->db->insert('Tb_Contrato', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function carregaInfoPorteMedico($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('TbPorteMedico as PorteMedico');
        $this->db->where('PorteMedico.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('PorteMedico.Deletado !=', 'S');
        $this->db->where('PorteMedico.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function adicionaPorteMedico($info)
    {
        $this->db->trans_start();
        $this->db->insert('TbPorteMedico', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function carregaInfoExcecaoValores($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('TbExcValores as ExcValores');
        $this->db->where('ExcValores.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('ExcValores.Deletado !=', 'S');
        $this->db->where('ExcValores.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function adicionaExcecaoValores($info)
    {
        $this->db->trans_start();
        $this->db->insert('TbExcValores', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }


    function carregaInfoFatItem($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('TbFatItem as FatItem');
        $this->db->where('FatItem.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('FatItem.Deletado !=', 'S');
        $this->db->where('FatItem.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function adicionaFatItem($info)
    {
        $this->db->trans_start();
        $this->db->insert('TbFatItem', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function carregaInfoFaturamento($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('TbFaturamento as Faturamento');
        $this->db->where('Faturamento.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('Faturamento.Deletado !=', 'S');
        $this->db->where('Faturamento.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function carregaInfoDePara($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('Rl_DeparaImportacao as DePara');
        $this->db->where('DePara.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('DePara.Deletado !=', 'S');
        $this->db->where('DePara.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function consultaDePara($idLayout, $noImportacao, $idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('Rl_DeparaImportacao as DePara');
        $this->db->where('DePara.No_Importacao', $noImportacao);
        $this->db->where('DePara.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('DePara.Tb_Id_LayoutImportacao', $idLayout);
        $this->db->where('DePara.Deletado !=', 'S');
        $this->db->where('DePara.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function listaDePara($IdEmpresa, $searchText = '', $page, $segment)
    {
        $this->db->select('LayoutImportacao.Ds_LayoutImportacao, DePara.*');
        $this->db->from('Rl_DeparaImportacao as DePara');
        $this->db->join('Tb_LayoutImportacao as LayoutImportacao', 'LayoutImportacao.Id_LayoutImportacao = DePara.Tb_Id_LayoutImportacao','left');
    //     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(DePara.No_Importacao LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }

        $this->db->where('DePara.Deletado !=', 'S');
        $this->db->where('DePara.TbEmpresa_Id_Empresa', $IdEmpresa);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function adicionaDePara($info)
    {
        $this->db->trans_start();
        $this->db->insert('Rl_DeparaImportacao', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function editaDePara($info, $id)
    {
        $this->db->where('Id_DeparaImportacao ', $id);
        $this->db->update('Rl_DeparaImportacao', $info);

        return TRUE;
    }

    function apagaDePara($info, $id)
    {
        $this->db->where('Id_DeparaImportacao', $id);
        $this->db->update('Rl_DeparaImportacao', $info);

        return $this->db->affected_rows();
    }

    function carregaInfoDeParaEmpresa($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('Rl_DeparaImportacao as DePara');
        $this->db->where('DePara.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('DePara.Deletado !=', 'S');
        $this->db->where('DePara.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function carregaInfoDeParaId($Id)
    {
        $this->db->select('*');
        $this->db->from('Rl_DeparaImportacao');
        $this->db->where('Id_DeparaImportacao', $Id);
        $query = $this->db->get();

        return $query->result();
    }

    function carregaInfoLayoutImportacaoEmpresa($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('Tb_LayoutImportacao as LayoutImportacao');
        $this->db->where('LayoutImportacao.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->where('LayoutImportacao.Deletado !=', 'S');
        $this->db->where('LayoutImportacao.Tp_Ativo', 'S');
        $query = $this->db->get();

        return $query->result();
    }

    function listaLayoutImportacao($IdEmpresa, $searchText = '', $page, $segment)
    {
        $this->db->select('LayoutImportacao.*');
        $this->db->from('Tb_LayoutImportacao as LayoutImportacao');
    //     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(LayoutImportacao.Ds_LayoutImportacao LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }

        $this->db->where('LayoutImportacao.Deletado !=', 'S');
        $this->db->where('LayoutImportacao.TbEmpresa_Id_Empresa', $IdEmpresa);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function carregaInfoLayoutImportacao($Id)
    {
        $this->db->select('*');
        $this->db->from('Tb_LayoutImportacao');
        $this->db->where('Id_LayoutImportacao', $Id);
        $query = $this->db->get();

        return $query->result();
    }

    function adicionaLayoutImportacao($info)
    {
        $this->db->trans_start();
        $this->db->insert('Tb_LayoutImportacao', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function editaLayoutImportacao($info, $id)
    {
        $this->db->where('Id_LayoutImportacao ', $id);
        $this->db->update('Tb_LayoutImportacao', $info);

        return TRUE;
    }

    function apagaLayoutImportacao($info, $id)
    {
        $this->db->where('Id_LayoutImportacao', $id);
        $this->db->update('Tb_LayoutImportacao', $info);

        return $this->db->affected_rows();
    }

    function consultaCamposTabela($DsTabela)
    {
        $this->db->select('COLUMN_NAME as Ds_CampoDestino');
        $this->db->from('INFORMATION_SCHEMA.COLUMNS');
        $this->db->where('TABLE_NAME', $DsTabela);
        $query = $this->db->get();

        return $query->result();
    }

}

  
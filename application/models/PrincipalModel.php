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
        $this->db->select('Plano.Id_Plano, Plano.Ds_Plano, Convenio.Ds_Convenio, Indice.Ds_Indice, Regra.Ds_Regra, Plano.Cd_PlanoERP, Plano.Tp_AcomodacaoPadrao, Plano.Tp_Ativo');
        $this->db->from('TbPlano as Plano');
        $this->db->join('TbConvenio as Convenio', 'Convenio.Id_Convenio = Plano.TbConvenio_Id_Convenio AND Convenio.Deletado != "S" AND Convenio.Tp_Ativo = "S"','left');
        $this->db->join('TbIndice as Indice', 'Indice.Id_Indice = Plano.TbIndice_Id_Indice AND Indice.Deletado != "S" AND Indice.Tp_Ativo = "S"','left');
        $this->db->join('TbRegra as Regra', 'Regra.Id_Regra = Plano.TbRegra_Id_Regra AND Regra.Deletado != "S" AND Regra.Tp_Ativo = "S"','left');
    //     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(Plano.Ds_Plano LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }

        $this->db->where('Plano.Deletado !=', 'S');
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

    function carregaInfoPlanosEmpresa($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('TbPlano as Plano');
        $this->db->where('Plano.TbEmpresa_Id_Empresa', $idEmpresa);
        $query = $this->db->get();

        return $query->result();
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
    $this->db->where('Faturamento.TbEmpresa_Id_Empresa', $IdEmpresa);
    $this->db->limit($page, $segment);
    $query = $this->db->get();
    
    $result = $query->result();        
    return $result;
}

function adicionaFaturamento($info)
{
    $this->db->trans_start();
    $this->db->insert('TbFaturamento', $info);
    
    $insert_id = $this->db->insert_id();
    
    $this->db->trans_complete();
    
    return $insert_id;
}

function editaFaturamento($info, $id)
{
    $this->db->where('Id_Faturamento', $id);
    $this->db->update('TbFaturamento', $info);
    
    return TRUE;
}

function apagaFaturamento($info, $id)
{
    $this->db->where('Id_Faturamento', $id);
    $this->db->update('TbFaturamento', $info);
    
    return $this->db->affected_rows();
}

function carregaInfoFaturamento($Id)
{
    $this->db->select('*');
    $this->db->from('TbFaturamento');
    $this->db->where('Id_Faturamento', $Id);
    $query = $this->db->get();

    return $query->result();
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

function carregaInfoRegra($Id)
{
    $this->db->select('*');
    $this->db->from('TbRegra');
    $this->db->where('Id_Regra', $Id);
    $query = $this->db->get();

    return $query->result();
}

function carregaInfoRegrasEmpresa($idEmpresa)
{
    $this->db->select('*');
    $this->db->from('TbRegra as Regra');
    $this->db->where('Regra.TbEmpresa_Id_Empresa', $idEmpresa);
    $query = $this->db->get();

    return $query->result();
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

function carregaInfoIndice($Id)
{
    $this->db->select('*');
    $this->db->from('TbIndice');
    $this->db->where('Id_Indice', $Id);
    $query = $this->db->get();

    return $query->result();
}

function carregaInfoIndicesEmpresa($idEmpresa)
{
    $this->db->select('*');
    $this->db->from('TbIndice as Indice');
    $this->db->where('Indice.TbEmpresa_Id_Empresa', $idEmpresa);
    $this->db->where('Indice.Deletado !=', 'S');
    $this->db->where('Indice.Tp_Ativo', 'S');
    $query = $this->db->get();

    return $query->result();
}
// FIM DAS CONSULTAS NA TELA DE INDICE


// INICIO DAS CONSULTAS NA TELA DE INDICE GRUPO PRO
    function listaIndiceGrupoPro($IdEmpresa, $searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('TbIndiceGrupo as IndiceGrupo');
        $this->db->join('TbGrupoPro as GrupoPro', 'GrupoPro.CodGrupo = IndiceGrupo.TbGrupoPro_CodGrupo AND GrupoPro.Deletado != "S" AND GrupoPro.Tp_Ativo = "S"','left');
        $this->db->join('TbIndice as Indice', 'Indice.Id_Indice = IndiceGrupo.TbIndice_Id_Indice AND Indice.Deletado != "S" AND Indice.Tp_Ativo = "S"','left');
//     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(GrupoPro.Ds_GrupoPro LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('IndiceGrupo.Deletado !=', 'S');
        $this->db->where('IndiceGrupo.TbEmpresa_Id_Empresa', $IdEmpresa);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function adicionaIndiceGrupoPro($info)
    {
        $this->db->trans_start();
        $this->db->insert('TbIndiceGrupo', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function editaIndiceGrupoPro($info, $id)
    {
        $this->db->where('Id_IndiceGrupo', $id);
        $this->db->update('TbIndiceGrupo', $info);

        return TRUE;
    }

    function apagaIndiceGrupoPro($info, $id)
    {
        $this->db->where('Id_IndiceGrupo', $id);
        $this->db->update('TbIndiceGrupo', $info);

        return $this->db->affected_rows();
    }

    function carregaInfoIndiceGrupoPro($Id)
    {
        $this->db->select('*');
        $this->db->from('TbIndiceGrupo');
        $this->db->where('Id_IndiceGrupo', $Id);
        $query = $this->db->get();

        return $query->result();
    }

    function carregaInfoIndiceGrupoProEmpresa($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('TbIndiceGrupo as IndiceGrupo');
        $this->db->where('IndiceGrupo.TbEmpresa_Id_Empresa', $idEmpresa);
        $query = $this->db->get();

        return $query->result();
    }

    function carregaInfoGrupoPro($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('TbGrupoPro as GrupoPro');
        $this->db->where('GrupoPro.TbEmpresa_Id_Empresa', $idEmpresa);
        $query = $this->db->get();

        return $query->result();
    }

// FIM DAS CONSULTAS NA TELA DE INDICE GRUPO PRO

// INICIO DAS CONSULTAS NA TELA DE REGRA PROIBIÇÃO
function listaRegraProibicao($IdEmpresa, $searchText = '', $page, $segment)
{
    $this->db->select('*');
    $this->db->from('Tb_RegraProibicao as RegraProibicao');
    $this->db->join('TbFaturamento as Faturamento', 'Faturamento.Id_Faturamento = RegraProibicao.TbFaturamento_Id_Faturamento AND Faturamento.Deletado != "S" AND Faturamento.Tp_Ativo = "S"','left');
    $this->db->join('TbGrupoPro as GrupoPro', 'GrupoPro.CodGrupo = RegraProibicao.TbGrupoPro_CodGrupo AND GrupoPro.Deletado != "S" AND GrupoPro.Tp_Ativo = "S"','left');
    $this->db->join('TbPlano as Plano', 'Plano.Id_Plano = RegraProibicao.TbPlano_Id_Plano AND Plano.Deletado != "S" AND Plano.Tp_Ativo = "S"','left');
//     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
    if(!empty($searchText)) {
        $likeCriteria = "(RegraProibicao.Ds_RegraProibicao LIKE '%".$searchText."%')";
        $this->db->where($likeCriteria);
    }
    $this->db->where('RegraProibicao.Deletado !=', 'S');
    $this->db->where('RegraProibicao.TbEmpresa_Id_Empresa', $IdEmpresa);
    $this->db->limit($page, $segment);
    $query = $this->db->get();

    $result = $query->result();
    return $result;
}

function adicionaRegraProibicao($info)
{
    $this->db->trans_start();
    $this->db->insert('Tb_RegraProibicao', $info);

    $insert_id = $this->db->insert_id();

    $this->db->trans_complete();

    return $insert_id;
}

function editaRegraProibicao($info, $id)
{
    $this->db->where('Id_RegraProibicao', $id);
    $this->db->update('Tb_RegraProibicao', $info);

    return TRUE;
}

function apagaRegraProibicao($info, $id)
{
    $this->db->where('Id_RegraProibicao', $id);
    $this->db->update('Tb_RegraProibicao', $info);

    return $this->db->affected_rows();
}

function carregaInfoRegraProibicao($Id)
{
    $this->db->select('*');
    $this->db->from('Tb_RegraProibicao');
    $this->db->where('Id_RegraProibicao', $Id);
    $query = $this->db->get();

    return $query->result();
}

function carregaInfoRegraProibicaoEmpresa($idEmpresa)
{
    $this->db->select('*');
    $this->db->from('Tb_RegraProibicao as RegraProibicao');
    $this->db->where('RegraProibicao.TbEmpresa_Id_Empresa', $idEmpresa);
    $query = $this->db->get();

    return $query->result();
}
// FIM DAS CONSULTAS NA TELA DE REGRA PROIBIÇÃO

// INICIO DAS CONSULTAS NA TELA DE FRAÇÃO SIMPRO BRA
    function listaFracaoSimproBra($IdEmpresa, $searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('Tb_FracaoSimproBra as FracaoSimproBra');
        $this->db->join('TbProFat_Cd_ProFat as ProFat', 'ProFat.Cd_ProFat = FracaoSimproBra.TbProFat_Cd_ProFat AND ProFat.Deletado != "S" AND ProFat.Tp_Ativo = "S"','left');
        $this->db->join('TbFaturamento as Faturamento', 'Faturamento.Id_Faturamento = FracaoSimproBra.TbFaturamento_Id_Faturamento AND Faturamento.Deletado != "S" AND Faturamento.Tp_Ativo = "S"','left');
        $this->db->join('TbTUSS as TUSS', 'TUSS.Id_Tuss = FracaoSimproBra.TbTUSS_Id_Tuss AND TUSS.Deletado != "S" AND TUSS.Tp_Ativo = "S"','left');
//     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(FracaoSimproBra.Ds_FracaoSimproBra LIKE '%".$searchText."%'
                            OR FracaoSimproBra.Ds_Laboratorio LIKE '%".$searchText."%'
                            OR FracaoSimproBra.Ds_Apresentacao LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('FracaoSimproBra.Deletado !=', 'S');
        $this->db->where('FracaoSimproBra.TbEmpresa_Id_Empresa', $IdEmpresa);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function adicionaFracaoSimproBra($info)
    {
        $this->db->trans_start();
        $this->db->insert('Tb_FracaoSimproBra', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function editaFracaoSimproBra($info, $id)
    {
        $this->db->where('Id_FracaoSimproBra ', $id);
        $this->db->update('Tb_FracaoSimproBra', $info);

        return TRUE;
    }

    function apagaFracaoSimproBra($info, $id)
    {
        $this->db->where('Id_FracaoSimproBra ', $id);
        $this->db->update('Tb_FracaoSimproBra', $info);

        return $this->db->affected_rows();
    }

    function carregaInfoFracaoSimproBra($Id)
    {
        $this->db->select('*');
        $this->db->from('Tb_FracaoSimproBra');
        $this->db->where('Id_FracaoSimproBra', $Id);
        $query = $this->db->get();

        return $query->result();
    }

    function carregaInfoFracaoSimproBraEmpresa($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('Tb_FracaoSimproBra as FracaoSimproBra');
        $this->db->where('FracaoSimproBra.TbEmpresa_Id_Empresa', $idEmpresa);
        $query = $this->db->get();

        return $query->result();
    }
// FIM DAS CONSULTAS NA TELA DE FRAÇÃO SIMPRO BRA

// INICIO DAS CONSULTAS NA TELA DE FATURAMENTO ITEM
    function listaFaturamentoItem($IdEmpresa, $searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('TbFatItem as FaturamentoItem');
        $this->db->join('TbFaturamento as Faturamento', 'Faturamento.Id_Faturamento = FaturamentoItem.TbFaturamento_Id_Faturamento AND Faturamento.Deletado != "S" AND Faturamento.Tp_Ativo = "S"','left');
//     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(FaturamentoItem.Ds_FatItem LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('FaturamentoItem.Deletado !=', 'S');
        $this->db->where('FaturamentoItem.TbEmpresa_Id_Empresa', $IdEmpresa);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function adicionaFaturamentoItem($info)
    {
        $this->db->trans_start();
        $this->db->insert('TbFatItem', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function editaFaturamentoItem($info, $id)
    {
        $this->db->where('Id_FatItem', $id);
        $this->db->update('TbFatItem', $info);

        return TRUE;
    }

    function apagaFaturamentoItem($info, $id)
    {
        $this->db->where('Id_FatItem', $id);
        $this->db->update('TbFatItem', $info);

        return $this->db->affected_rows();
    }

    function carregaInfoFaturamentoItem($Id)
    {
        $this->db->select('*');
        $this->db->from('TbFatItem');
        $this->db->where('Id_FatItem', $Id);
        $query = $this->db->get();

        return $query->result();
    }

    function carregaInfoFaturamentoItemEmpresa($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('TbFatItem as FaturamentoItem');
        $this->db->where('FaturamentoItem.TbEmpresa_Id_Empresa', $idEmpresa);
        $query = $this->db->get();

        return $query->result();
    }
// FIM DAS CONSULTAS NA TELA DE FATURAMENTO ITEM

// INICIO DAS CONSULTAS NA TELA DE UNIDADE
    function listaUnidade($IdEmpresa, $searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('Tb_Unidade as Unidade');
//     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
        if(!empty($searchText)) {
            $likeCriteria = "(Unidade.Ds_Unidade LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('Unidade.Deletado !=', 'S');
        $this->db->where('Unidade.TbEmpresa_Id_Empresa', $IdEmpresa);
        $this->db->limit($page, $segment);
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function adicionaUnidade($info)
    {
        $this->db->trans_start();
        $this->db->insert('Tb_Unidade', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function editaUnidade($info, $id)
    {
        $this->db->where('Id_Unidade', $id);
        $this->db->update('Tb_Unidade', $info);

        return TRUE;
    }

    function apagaUnidade($info, $id)
    {
        $this->db->where('Id_Unidade', $id);
        $this->db->update('Tb_Unidade', $info);

        return $this->db->affected_rows();
    }

    function carregaInfoUnidade($Id)
    {
        $this->db->select('*');
        $this->db->from('Tb_Unidade');
        $this->db->where('Id_Unidade', $Id);
        $query = $this->db->get();

        return $query->result();
    }

    function carregaInfoUnidadeEmpresa($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('Tb_Unidade as Unidade');
        $this->db->where('Unidade.TbEmpresa_Id_Empresa', $idEmpresa);
        $query = $this->db->get();

        return $query->result();
    }
// FIM DAS CONSULTAS NA TELA DE UNIDADE




// INICIO DAS CONSULTAS NA TELA DE PROIBIÇÃO
function listaProibicao($IdEmpresa, $searchText = '', $page, $segment)
{
    $this->db->select('*');
    $this->db->from('TbIndice as Indice');
//     $this->db->join('tbl_roles as Role', 'Role.roleId = Usuarios.roleId','left');
    if(!empty($searchText)) {
        $likeCriteria = "(Indice.Ds_Indice LIKE '%".$searchText."%')";
        $this->db->where($likeCriteria);
    }
    $this->db->where('Indice.Deletado !=', 'S');
    $this->db->where('Indice.TbEmpresa_Id_Empresa', $IdEmpresa);
    $this->db->limit($page, $segment);
    $query = $this->db->get();

    $result = $query->result();
    return $result;
}

function adicionaProibicao($info)
{
    $this->db->trans_start();
    $this->db->insert('TbIndice', $info);

    $insert_id = $this->db->insert_id();

    $this->db->trans_complete();

    return $insert_id;
}

function editaProibicao($info, $id)
{
    $this->db->where('Id_Indice', $id);
    $this->db->update('TbIndice', $info);

    return TRUE;
}

function apagaProibicao($info, $id)
{
    $this->db->where('Id_Indice', $id);
    $this->db->update('TbIndice', $info);

    return $this->db->affected_rows();
}

function carregaInfoProibicao($Id)
{
    $this->db->select('*');
    $this->db->from('TbIndice');
    $this->db->where('Id_Indice', $Id);
    $query = $this->db->get();

    return $query->result();
}

function carregaInfoProibicaoEmpresa($idEmpresa)
{
    $this->db->select('*');
    $this->db->from('TbIndice as Indice');
    $this->db->where('Indice.TbEmpresa_Id_Empresa', $idEmpresa);
    $query = $this->db->get();

    return $query->result();
}
// FIM DAS CONSULTAS NA TELA DE PROIBIÇÃO

}

  
<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class ExportacaoModel extends CI_Model
{

    function exportaFatItem($idEmpresa,$var)
    {
        if ($var != 0) {
            $this->db->select('*');
            $this->db->from('TbFatItem');   
            $this->db->order_by('Id_FatItem','DESC');
            $this->db->limit($var);
            $query = $this->db->get();
            return $query->result();
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
        if ($var != 0) {
            $this->db->select('*');
            $this->db->from('TbGrupoPro');   
            $this->db->order_by('CodGrupo','DESC');
            $this->db->limit($var);
            $query = $this->db->get();
            return $query->result();
        }
        $this->db->select('*');
        $this->db->from('TbGrupoPro as GrupoPro');
        $this->db->where('GrupoPro.Deletado !=', 'S');
        $this->db->where('GrupoPro.Tp_Ativo', 'S');
        $this->db->where('GrupoPro.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->order_by('GrupoPro.CdGrupoPro', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaProFat($idEmpresa,$var)
    {
        if ($var != 0) {
            $this->db->select('*');
            $this->db->from('TbProFat');   
            $this->db->order_by('Cd_ProFat','DESC');
            $this->db->limit($var);
            $query = $this->db->get();
            return $query->result();
        }
        $this->db->select('*');
        $this->db->from('TbProFat as ProFat');
        $this->db->where('ProFat.Deletado !=', 'S');
        $this->db->where('ProFat.Tp_Ativo', 'S');
        $this->db->where('ProFat.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->order_by('ProFat.CodProFat', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaTUSS($idEmpresa,$var)
    {
        if ($var != 0) {
            $this->db->select('*');
            $this->db->from('TbTUSS');   
            $this->db->order_by('Id_Tuss','DESC');
            $this->db->limit($var);
            $query = $this->db->get();
            return $query->result();
        }
        $this->db->select('*');
        $this->db->from('TbTUSS as TUSS');
        $this->db->where('TUSS.Deletado !=', 'S');
        $this->db->where('TUSS.Tp_Ativo', 'S');
        $this->db->where('TUSS.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->order_by('TUSS.TbProFat_Cd_ProFat', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaRegraGruPro($idEmpresa,$var)
    {
        if ($var != 0) {
            $this->db->select('*');
            $this->db->from('Tb_RegraGruPro');   
            $this->db->order_by('Id_RegraGruPro','DESC');
            $this->db->limit($var);
            $query = $this->db->get();
            return $query->result();
        }
        $this->db->select('*');
        $this->db->from('Tb_RegraGruPro as RegraGruPro');
        $this->db->where('RegraGruPro.Deletado !=', 'S');
        $this->db->where('RegraGruPro.Tp_Ativo', 'S');
        $this->db->where('RegraGruPro.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->order_by('RegraGruPro.TbGrupoPro_CodGrupo', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaFracaoSimproBra($idEmpresa,$var)
    {
        if ($var != 0) {
            $this->db->select('*');
            $this->db->from('Tb_FracaoSimproBra');   
            $this->db->order_by('Id_FracaoSimproBra','DESC');
            $this->db->limit($var);
            $query = $this->db->get();
            return $query->result();
        }
        $this->db->select('*');
        $this->db->from('Tb_FracaoSimproBra as FracaoSimproBra');
        $this->db->where('FracaoSimproBra.Deletado !=', 'S');
        $this->db->where('FracaoSimproBra.Tp_Ativo', 'S');
        $this->db->where('FracaoSimproBra.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->order_by('FracaoSimproBra.TbProFat_Cd_ProFat', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaProduto($idEmpresa,$var)
    {
        if ($var != 0) {
            $this->db->select('*');
            $this->db->from('Tb_Produto');   
            $this->db->order_by('Id_Produto','DESC');
            $this->db->limit($var);
            $query = $this->db->get();
            return $query->result();
        }
        $this->db->select('*');
        $this->db->from('Tb_Produto as Produto');
        $this->db->where('Produto.Deletado !=', 'S');
        $this->db->where('Produto.Tp_Ativo', 'S');
        $this->db->where('Produto.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->order_by('Produto.TbProFat_Cd_ProFat', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaProducao($idEmpresa,$var)
    {
        if ($var != 0) {
            $this->db->select('*');
            $this->db->from('Tb_Producao');   
            $this->db->order_by('Id_Producao','DESC');
            $this->db->limit($var);
            $query = $this->db->get();
            return $query->result();
        }
        $this->db->select('*');
        $this->db->from('Tb_Producao as Producao');
        $this->db->where('Producao.Deletado !=', 'S');
        $this->db->where('Producao.Tp_Ativo', 'S');
        $this->db->where('Producao.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->order_by('Producao.TbProFat_Cd_ProFat', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaPorteMedico($idEmpresa,$var)
    {
        if ($var != 0) {
            $this->db->select('*');
            $this->db->from('TbPorteMedico');   
            $this->db->order_by('Id_PorteMedico','DESC');
            $this->db->limit($var);
            $query = $this->db->get();
            return $query->result();
        }
        $this->db->select('*');
        $this->db->from('TbPorteMedico as PorteMedico');
        $this->db->where('PorteMedico.Deletado !=', 'S');
        $this->db->where('PorteMedico.Tp_Ativo', 'S');
        $this->db->where('PorteMedico.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->order_by('PorteMedico.Cd_PorteMedico', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaExcecaoValores($idEmpresa,$var)
    {
        if ($var != 0) {
            $this->db->select('*');
            $this->db->from('TbExcValores');   
            $this->db->order_by('Id_ExcValores','DESC');
            $this->db->limit($var);
            $query = $this->db->get();
            return $query->result();
        }
        $this->db->select('*');
        $this->db->from('TbExcValores as ExcValores');
        $this->db->where('ExcValores.Deletado !=', 'S');
        $this->db->where('ExcValores.Tp_Ativo', 'S');
        $this->db->where('ExcValores.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->order_by('ExcValores.CD_Convenio', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function exportaContrato($idEmpresa,$var)
    {
        if ($var != 0) {
            $this->db->select('*');
            $this->db->from('TbContrato');   
            $this->db->order_by('Id_Contrato','DESC');
            $this->db->limit($var);
            $query = $this->db->get();
            return $query->result();
        }
        $this->db->select('*');
        $this->db->from('TbContrato as Contrato');
        $this->db->where('Contrato.Deletado !=', 'S');
        $this->db->where('Contrato.Tp_Ativo', 'S');
        $this->db->where('Contrato.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->order_by('Contrato.Id_Contrato', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

    function consultaConvenioBI($idEmpresa,$idConvenio)
    {
    $sql="SELECT CON_CONV_FINAL.id_convenio,
       CON_CONV_FINAL.ds_convenio,
        CON_CONV_FINAL.Cd_ConvenioERP,
        CON_CONV_FINAL.TbEmpresa_Id_Empresa,
        CON_CONV_FINAL.Id_Plano,
        CON_CONV_FINAL.Ds_Plano,
        CON_CONV_FINAL.Cd_PlanoERP,
        CON_CONV_FINAL.Tp_AcomodacaoPadrao,
        CON_CONV_FINAL.TbIndice_Id_Indice,
        CON_CONV_FINAL.Ds_indice,
        CON_CONV_FINAL.Vl_Indice,
        CON_CONV_FINAL.Vl_M2Filme,
        CON_CONV_FINAL.Vl_IND_Honorário,
        CON_CONV_FINAL.Vl_UCO,
        CON_CONV_FINAL.TbRegra_Id_Regra,
        CON_CONV_FINAL.Ds_Regra,
        CON_CONV_FINAL.TbGrupoPro_CodGrupo,
        CON_CONV_FINAL.TbFaturamento_Id_Faturamento,
        CON_CONV_FINAL.Ds_Faturamento,
        CON_CONV_FINAL.Tp_Faturamento,
        CON_CONV_FINAL.Perc_Pago,
        CON_CONV_FINAL.Cd_TUSS,
        CON_CONV_FINAL.Cd_TISS,
        CON_CONV_FINAL.Ds_FatItem,
        CON_CONV_FINAL.Vl_Honorário Vl_Honorario,
        CON_CONV_FINAL.Vl_Operacional,
        CON_CONV_FINAL.Vl_Filme,
        CON_CONV_FINAL.Vl_Total,
        CON_CONV_FINAL.Qt_Embalagem,
        CON_CONV_FINAL.Ds_Unidade,
        CON_CONV_FINAL.Cd_PorteMedico,
        CON_CONV_FINAL.Ds_PorteMedico,
        CON_CONV_FINAL.Vl_PorteMedico,
        CON_CONV_FINAL.Ds_Tuss,
        CON_CONV_FINAL.TP_TUSS,
        CON_CONV_FINAL.DS_TIP_TUSS,
        CON_CONV_FINAL.TbProFat_Cd_ProFat,
        CON_CONV_FINAL.Vl_ExcValores,
        CON_CONV_FINAL.Tp_ExcValores,
       CON_CONV_FINAL.Vl_FatorDivisao,
        CON_CONV_FINAL.VR_FINAL_CONV
        ,round (CASE WHEN  CON_CONV_FINAL.tp_FATURAMENTO = 'REAIS'
            THEN  ((CON_CONV_FINAL.VR_FINAL_CONV  + (NVL(CON_CONV_FINAL.Vl_Filme,0) * NVL( CON_CONV_FINAL.Vl_M2Filme,0) ) ) *  CON_CONV_FINAL.Perc_Pago)/100
            ELSE  CASE WHEN   CON_CONV_FINAL.tp_FATURAMENTO = 'CBHPM'
                       THEN (((NVL(CON_CONV_FINAL.Vl_Honorário,0) * NVL(CON_CONV_FINAL.Vl_PorteMedico,0) )
                             + ( NVL(CON_CONV_FINAL.Vl_Operacional,0) * NVL(CON_CONV_FINAL.Vl_UCO,0)   )
                             + (NVL(CON_CONV_FINAL.Vl_Filme,0)* NVL(CON_CONV_FINAL.Vl_M2Filme ,0) ) )* CON_CONV_FINAL.Perc_Pago)/100

                       ELSE (((NVL(CON_CONV_FINAL.Vl_Honorário,0) *  NVL(CON_CONV_FINAL.Vl_IND_Honorário,0))
                              + (NVL(CON_CONV_FINAL.Vl_Operacional,0) * NVL(CON_CONV_FINAL.Vl_Indice,0))
                              + (NVL(CON_CONV_FINAL.Vl_Filme,0) * NVL(CON_CONV_FINAL.Vl_M2Filme ,0)))* CON_CONV_FINAL.Perc_Pago)/100
                       END

       END ,2)    VR_FINAL ,
         CON_CONV_FINAL.Id_RegraProibicao,
    CON_CONV_FINAL.Ds_RegraProibicao,
    CON_CONV_FINAL.Tp_RegraProibicao,
    CON_CONV_FINAL.Tp_Atendimento,
    CON_CONV_FINAL.Vl_RegraProibicao
FROM 
(SELECT EXV.id_convenio,
      EXV.ds_convenio,
       EXV.Cd_ConvenioERP,
       EXV.tbempresa_id_empresa,
       EXV.Id_Plano,
       EXV.Ds_Plano,
       EXV.Cd_PlanoERP,
       EXV.Tp_AcomodacaoPadrao,
       EXV.TbIndice_Id_Indice,
       EXV.Ds_indice,
       EXV.Vl_Indice,
       EXV.Vl_M2Filme,
       EXV.Vl_IND_Honorário,
       EXV.Vl_UCO,
       EXV.TbRegra_Id_Regra,
      EXV.Ds_Regra,
       EXV.TbGrupoPro_CodGrupo,
       EXV.CodGrupo ,
       EXV.Desc_Tp_GrupoPro,
       EXV.TbFaturamento_Id_Faturamento,
       EXV.Ds_Faturamento,
       EXV.Tp_Faturamento,
       EXV.Perc_Pago,
       EXV.Cd_TUSS,
       EXV.Cd_TISS,
       EXV.Ds_FatItem,
       EXV.Vl_Honorário ,
       EXV.Vl_Operacional,
       EXV.Vl_Filme,
       EXV.Vl_Total,
       EXV.Qt_Embalagem,
       EXV.Ds_Unidade,
       EXV.Cd_PorteMedico,
       EXV.Ds_PorteMedico,
       EXV.Vl_PorteMedico,
       EXV.Ds_Tuss,
       EXV.TP_TUSS,
       EXV.DS_TIP_TUSS,
       EXV.TbProFat_Cd_ProFat,
       TbExcValores.Vl_ExcValores,
       TbExcValores.Tp_ExcValores,
       Tb_FracaoSimproBra.Vl_FatorDivisao,
         round(case when Tb_FracaoSimproBra.Vl_FatorDivisao is not null
              then (case when (TbExcValores.Vl_ExcValores is not null )
                        then case when (TbExcValores.Tp_ExcValores is null OR TbExcValores.Tp_ExcValores = '')
                                  then TbExcValores.Vl_ExcValores
                                  else EXV.Vl_Total
                              end 
                        else  EXV.Vl_Total
                    end) /  Tb_FracaoSimproBra.Vl_FatorDivisao
              else (case when (TbExcValores.Vl_ExcValores is not null )
                        then case when (TbExcValores.Tp_ExcValores is null OR TbExcValores.Tp_ExcValores = '')
                                  then TbExcValores.Vl_ExcValores
                                  else EXV.Vl_Total
                              end 
                        else  EXV.Vl_Total
                    end) 
         end,2) vr_final_conv,
   Tb_RegraProibicao.Id_RegraProibicao,
   Tb_RegraProibicao.Ds_RegraProibicao,
   Tb_RegraProibicao.Tp_RegraProibicao,
   Tb_RegraProibicao.Tp_Atendimento,
   Tb_RegraProibicao.Vl_RegraProibicao

FROM
(SELECT AA.id_convenio,
       AA.ds_convenio,
       AA.Cd_ConvenioERP,
       AA.tbempresa_id_empresa,
       AA.Id_Plano,
       AA.Ds_Plano,
       AA.Cd_PlanoERP,
       AA.Tp_AcomodacaoPadrao,
       AA.TbIndice_Id_Indice,
       AA.Ds_indice,
       AA.Vl_Indice,
       AA.Vl_M2Filme,
       AA.Vl_IND_Honorário,
       AA.Vl_UCO,
       AA.TbRegra_Id_Regra,
       AA.Ds_Regra,
       AA.TbGrupoPro_CodGrupo,
       AA.CodGrupo ,
       AA.Desc_Tp_GrupoPro,
       AA.TbFaturamento_Id_Faturamento,
       AA.Ds_Faturamento,
       AA.Tp_Faturamento,
       AA.Perc_Pago,
       AA.Cd_TUSS,
       AA.Cd_TISS,
       AA.Ds_FatItem,
       AA.Vl_Honorário,
       AA.Vl_Operacional,
       AA.Vl_Filme,
       AA.Vl_Total,
       AA.Qt_Embalagem,
       AA.Ds_Unidade,
       AA.Cd_PorteMedico,
       AA.Ds_PorteMedico,
       AA.Vl_PorteMedico,
       TbTUSS.Ds_Tuss,
       TbTUSS.TP_TUSS,
       TbTUSS.DS_TIP_TUSS,
       TbTUSS.TbProFat_Cd_ProFat

FROM
(SELECT TbConvenio.id_convenio,
       TbConvenio.ds_convenio,
       TbConvenio.Cd_ConvenioERP,
       TbConvenio.tbempresa_id_empresa,
       TbPlano.Id_Plano,
       TbPlano.Ds_Plano,
       TbPlano.Cd_PlanoERP,
       TbPlano.Tp_AcomodacaoPadrao,
       TbPlano.TbIndice_Id_Indice,
       TbIndice.Ds_indice,
       TbIndice.Vl_Indice,
       TbIndice.Vl_M2Filme,
       TbIndice.Vl_Honorário Vl_IND_Honorário,
       TbIndice.Vl_UCO,
       TbPlano.TbRegra_Id_Regra,
       TbRegra.Ds_Regra,
       Tb_RegraGruPro.TbGrupoPro_CodGrupo,
      Tb_RegraGruPro.TbFaturamento_Id_Faturamento,
       TbFaturamento.Ds_Faturamento,
       TbFaturamento.Tp_Faturamento,
       Tb_RegraGruPro.Perc_Pago,
       TbFatItem.Cd_TUSS,
       TbFatItem.Cd_TISS,
       TbFatItem.Ds_FatItem,
       TbFatItem.Vl_Honorário,
       TbFatItem.Vl_Operacional,
       TbFatItem.Vl_Filme,
       TbFatItem.Vl_Total,
       TbFatItem.Qt_Embalagem,
       TbFatItem.Ds_Unidade,
       TbFatItem.Cd_PorteMedico,
       TbPorteMedico.Ds_PorteMedico,
       TbPorteMedico.Vl_PorteMedico,
       TbGrupoPro.CodGrupo ,
       TbGrupoPro.Desc_Tp_GrupoPro
      
FROM TbConvenio,TbPlano,TbIndice,TbRegra,Tb_RegraGruPro, TbGrupoPro, TbFaturamento,TbFatItem
  
LEFT OUTER JOIN TbPorteMedico ON (TbPorteMedico.Id_TabFaturamento = TbFatItem.TbFaturamento_Id_Faturamento AND TbPorteMedico.Cd_PorteMedico = TbFatItem.Cd_PorteMedico)

where TbConvenio.tbempresa_id_empresa = $idEmpresa
      and TbConvenio.Cd_ConvenioERP = $idConvenio
      and TbConvenio.id_convenio = TbPlano.TbConvenio_Id_Convenio
      and TbConvenio.tbempresa_id_empresa = TbPlano.TbEmpresa_Id_Empresa
      and TbPlano.TbIndice_Id_Indice = TbIndice.Id_Indice
      and TbPlano.TbRegra_Id_Regra = TbRegra.Id_Regra
      and TbPlano.TbEmpresa_Id_Empresa = TbRegra.TbEmpresa_Id_Empresa
      and TbRegra.Id_Regra = Tb_RegraGruPro.TbRegra_Id_Regra
      and TbRegra.TbEmpresa_Id_Empresa = Tb_RegraGruPro.TbEmpresa_Id_Empresa
      and Tb_RegraGruPro.TbFaturamento_Id_Faturamento = TbFaturamento.Id_Faturamento
      and Tb_RegraGruPro.TbFaturamento_Id_Faturamento = TbFatItem.TbFaturamento_Id_Faturamento
      and  Tb_RegraGruPro.TbGrupoPro_CodGrupo = TbGrupoPro.CdGrupoPro and Tb_RegraGruPro.TbEmpresa_Id_Empresa = TbGrupoPro.TbEmpresa_Id_Empresa 
      and TbConvenio.Tp_Ativo= 'S'
      and TbPlano.Tp_Ativo = 'S'
      and TbIndice.Tp_Ativo = 'S'
      and TbRegra.Tp_Ativo = 'S'
      and TbGrupoPro.Tp_Ativo = 'S'
) AA
      inner JOIN TbTUSS ON (TbTUSS.TbConvenio_Id_Convenio =  AA.Cd_ConvenioERP AND TbTUSS.Cd_Tuss = AA.CD_TUSS and TbTUSS.cd_gru_pro = AA.TbGrupoPro_CodGrupo)) EXV
      LEFT OUTER JOIN TbExcValores ON (TbExcValores.CD_Convenio = EXV.Cd_ConvenioERP AND TbExcValores.Cd_TUSS =  EXV.Cd_TUSS AND TbExcValores.Cd_ProFat = EXV.TbProFat_Cd_ProFat and TbExcValores.TbEmpresa_Id_Empresa = EXV.tbempresa_id_empresa)
      LEFT OUTER JOIN Tb_FracaoSimproBra ON (Tb_FracaoSimproBra.TbEmpresa_Id_Empresa = EXV.tbempresa_id_empresa and Tb_FracaoSimproBra.TbFatItem_Id_FatItem =EXV.TbFaturamento_Id_Faturamento and Tb_FracaoSimproBra.CD_TISS = EXV.Cd_TISS)
      Left outer join Tb_RegraProibicao on ( Tb_RegraProibicao.TbEmpresa_Id_Empresa =  EXV.tbempresa_id_empresa and Tb_RegraProibicao.TbPlano_Id_Plano = EXV.Id_Plano and Tb_RegraProibicao.TbGrupoPro_CodGrupo = EXV.CodGrupo )) CON_CONV_FINAL
      LIMIT 20
      ";

    $query = $this->db->query($sql);    
    return $query->result();
    }

    function consultaContratoBI($idEmpresa,$idConvenio)
    {
    $sql="SELECT CON_CONTRATO.TbEmpresa_Id_Empresa,
            CON_CONTRATO.Cd_EmpresaERP, 
            CON_CONTRATO.Cd_ConvenioERP, 
            CON_CONTRATO.ds_convenioerp, 
            CON_CONTRATO.Cd_PlanoERP, 
            CON_CONTRATO.Ds_PlanoERP, 
            CON_CONTRATO.Cd_IndiceERP, 
            CON_CONTRATO.Ds_IndiceERP, 
            CON_CONTRATO.Dt_VigenciaIndiceERP, 
            CON_CONTRATO.Vl_IndiceERP, 
            CON_CONTRATO.Vl_FilmeIndiceERP, 
            CON_CONTRATO.Vl_HonorarioIndiceERP, 
            CON_CONTRATO.Vl_UCOIndiceERP, 
            CON_CONTRATO.Cd_RegraERP, 
            CON_CONTRATO.Ds_RegraERP, 
            CON_CONTRATO.Cd_TabFatERP, 
            CON_CONTRATO.Ds_TabFatERP, 
            CON_CONTRATO.Cd_MoedaERP, 
            CON_CONTRATO.Ds_MoedaERP, 
            CON_CONTRATO.Cd_RegraGruProErp, 
            CON_CONTRATO.Ds_RegraGruProErp, 
            CON_CONTRATO.TP_GRU_PRO_ERP,
            CON_CONTRATO.DS_TP_GRU_PRO_ERP,
            CON_CONTRATO.Per_RegraPGErp, 
            CON_CONTRATO.Cd_ProFatERP, 
            CON_CONTRATO.Ds_ProFatERP, 
            CON_CONTRATO.UnidadeProFatERP, 
            CON_CONTRATO.Vl_ProHonorarioERP, 
            CON_CONTRATO.Vl_ProOperaçãoERP, 
            CON_CONTRATO.Vl_ProTotalERP, 
            CON_CONTRATO.Vl_ProExcecValorERP,
            CON_CONTRATO.Ds_PrestadoraExcec,
            CON_CONTRATO.Qtde_M2FilmeERP, 
            CON_CONTRATO.Cd_PortMedicoERP, 
            CON_CONTRATO.Ds_PortMedicoERP, 
            CON_CONTRATO.Vl_PorteMedicoERP, 
            CON_CONTRATO.Cd_ExcecPorMedicoERP, 
            CON_CONTRATO.Vl_ExcecPorMedicoERP, 
            CON_CONTRATO.Vl_FinalERP, 
            CON_CONTRATO.Vl_FinalExecERP, 
            CON_CONTRATO.CD_PRODUTO, 
            CON_CONTRATO.DS_PRODUTO, 
            CON_CONTRATO.Cd_unidade, 
            CON_CONTRATO.Vl_CustoMedio, 
            CON_CONTRATO.Vl_Fator, 
            CON_CONTRATO.Vl_FatorProFat, 
            CON_CONTRATO.Vl_CustoFinal,
            CON_CONTRATO.vr_contrato_final,
            CON_CONTRATO.Tp_ProibicaoERP, 
            CON_CONTRATO.CD_TISS,
            CON_CONTRATO.vl_fator_divisao_fracao,
            CON_CONTRATO.qtde_final,
        CON_CONTRATO.PRODUCAO_FINAL,
        CON_CONTRATO.TP_TUSS,
        CON_CONTRATO.DS_TIP_TUSS,
        CON_CONTRATO.Cd_Tuss,
        CON_CONTRATO.Ds_Tuss,
        CON_CONTRATO.PRODUTO_ATIVO
            
        FROM

        (SELECT TbContrato.TbEmpresa_Id_Empresa,
            TbContrato.Cd_EmpresaERP, 
            TbContrato.Cd_ConvenioERP, 
            TbContrato.ds_convenioerp, 
            TbContrato.Cd_PlanoERP, 
            TbContrato.Ds_PlanoERP, 
            TbContrato.Cd_IndiceERP, 
            TbContrato.Ds_IndiceERP, 
            TbContrato.Dt_VigenciaIndiceERP, 
            TbContrato.Vl_IndiceERP, 
            TbContrato.Vl_FilmeIndiceERP, 
            TbContrato.Vl_HonorarioIndiceERP, 
            TbContrato.Vl_UCOIndiceERP, 
            TbContrato.Cd_RegraERP, 
            TbContrato.Ds_RegraERP, 
            TbContrato.Cd_TabFatERP, 
            TbContrato.Ds_TabFatERP, 
            TbContrato.Cd_MoedaERP, 
            TbContrato.Ds_MoedaERP, 
            TbContrato.Cd_RegraGruProErp, 
            TbContrato.Ds_RegraGruProErp, 
            TbContrato.TP_GRU_PRO_ERP,
            TbContrato.DS_TP_GRU_PRO_ERP,
            TbContrato.Per_RegraPGErp, 
            TbContrato.Cd_ProFatERP, 
            TbContrato.Ds_ProFatERP, 
            TbContrato.UnidadeProFatERP, 
            TbContrato.Vl_ProHonorarioERP, 
            TbContrato.Vl_ProOperaçãoERP, 
            TbContrato.Vl_ProTotalERP, 
            TbContrato.Vl_ProExcecValorERP,
            TbContrato.Ds_PrestadoraExcec,
            TbContrato.Qtde_M2FilmeERP, 
            TbContrato.Cd_PortMedicoERP, 
            TbContrato.Ds_PortMedicoERP, 
            TbContrato.Vl_PorteMedicoERP, 
            TbContrato.Cd_ExcecPorMedicoERP, 
            TbContrato.Vl_ExcecPorMedicoERP, 
            TbContrato.Vl_FinalERP, 
            TbContrato.Vl_FinalExecERP, 
            Tb_Produto.CD_PRODUTO, 
            Tb_Produto.DS_PRODUTO, 
            Tb_Produto.Cd_unidade, 
            Tb_Produto.Vl_CustoMedio, 
            Tb_Produto.Vl_Fator, 
            Tb_Produto.Vl_FatorProFat, 
            Tb_Produto.Vl_CustoFinal,
            
            CASE WHEN  (TbContrato.Vl_ProExcecValorERP > 0 AND (TbContrato.Ds_PrestadoraExcec = NULL or TbContrato.Ds_PrestadoraExcec = '' ))
                THEN  TbContrato.Vl_ProExcecValorERP 
                ELSE CASE WHEN  (TbContrato.Cd_ExcecPorMedicoERP != NULL )
                            THEN  TbContrato.Vl_FinalExecERP
                            ELSE TbContrato.Vl_FinalERP 
                    END
            END vr_contrato_final,
            
            CASE WHEN (TbContrato.Vl_ProExcecValorERP > 0 AND (TbContrato.Ds_PrestadoraExcec = NULL or TbContrato.Ds_PrestadoraExcec = '' ))
                THEN  'TbContrato.Vl_ProExcecValorERP' 
                ELSE CASE WHEN  (TbContrato.Cd_ExcecPorMedicoERP != NULL )
                            THEN  'TbContrato.Vl_FinalExecERP2'
                            ELSE  'TbContrato.Vl_FinalERP'
                    END
            END teste,
        
            TbContrato.Tp_ProibicaoERP, 
            TbContrato.CD_TISS,
            TbContrato.vl_fator_divisao_fracao,
            CON_TUSS.qtde_final,
        CON_TUSS.PRODUCAO_FINAL,
        TbTUSS.TP_TUSS,
        TbTUSS.DS_TIP_TUSS,
        TbTUSS.Cd_Tuss,
        TbTUSS.Ds_Tuss,
        
        case when((TbContrato.TP_GRU_PRO_ERP ='MT' or TbContrato.TP_GRU_PRO_ERP ='MD') and (Tb_Produto.CD_PRODUTO is not null))
            then case when  Tb_Produto.CD_PRODUTO is not null
                        then 'A'
                    END
            else 'A'
        END AS PRODUTO_ATIVO

        FROM TbProFat,
        TbContrato
        LEFT JOIN Tb_Produto ON (TbContrato.Cd_EmpresaERP = Tb_Produto .cd_empresaerp AND TbContrato.Cd_ProFatERP = Tb_Produto .TbProFat_Cd_ProFat) 
        LEFT JOIN TbTUSS ON (TbContrato.Cd_EmpresaERP = TbTUSS.TbEmpresa_Id_Empresa AND TbContrato.Cd_ConvenioERP = TbTUSS.TbConvenio_Id_Convenio AND  TbContrato.Cd_ProFatERP = TbTUSS.TbProFat_Cd_ProFat)
        LEFT JOIN (SELECT Tb_Producao.TbEmpresa_Id_Empresa,
            Tb_Producao.TbContrato_Cd_EmpresaERP,
            Tb_Producao.TbContrato_Cd_Convenio,
            Tb_Producao.TbContrato_Cd_PlanoERP,
            Tb_Producao.TbContrato_Cd_ProFatERP,
            TbTUSS.Dt_IniVigencia,
            Sum(case when TbTUSS.Dt_IniVigencia is not null
                    then case when Tb_Producao.Dt_Lancamento >=TbTUSS.Dt_IniVigencia
                            then Tb_Producao.Qt_Lancamento
                            else 0
                        END
                    ELSE
                        Tb_Producao.Qt_Lancamento
                END)  qtde_final,
            Sum(case when TbTUSS.Dt_IniVigencia is not null
                    then case when Tb_Producao.Dt_Lancamento >=TbTUSS.Dt_IniVigencia
                            then Tb_Producao.Vl_Conta
                            else 0
                        END
                    ELSE
                        Tb_Producao.Vl_Conta
                END)  producao_final
                                
        FROM Tb_Producao 
                LEFT JOIN  TbTUSS ON( Tb_Producao.TbContrato_Cd_EmpresaERP = TbTUSS.TbEmpresa_Id_Empresa and Tb_Producao.TbContrato_Cd_Convenio = TbTUSS.TbConvenio_Id_Convenio and Tb_Producao.TbContrato_Cd_ProFatERP = TbTUSS.TbProFat_Cd_ProFat)
        group by 
        Tb_Producao.TbEmpresa_Id_Empresa,
            Tb_Producao.TbContrato_Cd_EmpresaERP,
            Tb_Producao.TbContrato_Cd_Convenio,
            Tb_Producao.TbContrato_Cd_PlanoERP,
            Tb_Producao.TbContrato_Cd_ProFatERP,
            TbTUSS.Dt_IniVigencia) CON_TUSS ON (TbContrato.Cd_EmpresaERP = CON_TUSS.TbContrato_Cd_EmpresaERP AND  TbContrato.Cd_ConvenioERP = CON_TUSS.TbContrato_Cd_Convenio AND  TbContrato.Cd_PlanoERP = CON_TUSS.TbContrato_Cd_PlanoERP AND TbContrato.Cd_ProFatERP = CON_TUSS.TbContrato_Cd_ProFatERP)


        WHERE 
        (TbProFat.CodProFat = TbContrato.Cd_ProFatERP and TbContrato.TbEmpresa_Id_Empresa = TbProFat.TbEmpresa_Id_Empresa)
        AND TbContrato.Cd_EmpresaERP = $idEmpresa -- selecionar empresa
        and  TbContrato.Cd_ConvenioERP= $idConvenio -- selecionar empresa
        and (case when(TbContrato.TP_GRU_PRO_ERP ='MT' or TbContrato.TP_GRU_PRO_ERP ='MD')
            then case when  Tb_Produto.CD_PRODUTO is not null
                        then 'A'
                    END
            else 'A'
        END) IN ('A')
        ) CON_CONTRATO
        LIMIT 20
      ";

    $query = $this->db->query($sql);    
    return $query->result();
    }

    function adicionaConvenio($info)
    {
        $this->db->trans_start();
        $this->db->insert('Tmp_Convenio', $info);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    function consultaCodERPEmpresa($IdEmpresa)
    {
        $this->db->select('empresa.Cd_EmpresaERP');
        $this->db->from('TbEmpresa as empresa');
        $this->db->where('empresa.Id_Empresa', $IdEmpresa);
        $query = $this->db->get();

        return $query->result();
    }



}

  
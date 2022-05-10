<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class ExportacaoModel extends CI_Model
{

    function exportaFatItem_Tudo()
    {
        $this->db->select('Id_FatItem,CodFatItem,TbFaturamento_Id_Faturamento,Ds_FatItem,Dt_IniVigencia,
        Dt_FimVigencia,Vl_Honorário,Vl_Operacional,Vl_Total,Vl_Filme,Cd_PorteMedico,Cd_TUSS,Cd_TISS,Qt_Embalagem,
        Ds_Unidade');
        $this->db->from('TbFatItem as FatItem');
        $this->db->where('FatItem.Deletado !=', 'S');
        $this->db->where('FatItem.Tp_Ativo', 'S');
        $this->db->order_by('FatItem.Id_FatItem', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

}

  
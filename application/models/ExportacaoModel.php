<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class ExportacaoModel extends CI_Model
{

    function exportaFatItem_Tudo($idEmpresa)
    {
        $this->db->select('*');
        $this->db->from('TbFatItem as FatItem');
        $this->db->where('FatItem.Deletado !=', 'S');
        $this->db->where('FatItem.Tp_Ativo', 'S');
        $this->db->where('FatItem.TbEmpresa_Id_Empresa', $idEmpresa);
        $this->db->order_by('FatItem.Id_FatItem', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

}

  
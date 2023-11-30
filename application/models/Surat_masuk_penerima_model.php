<?php 

class Surat_masuk_penerima_model extends CI_Model
{
    private $_table = 'surat_masuk__penerima';

    public function insert($article)
    {
        $this->db->insert($this->_table, $article);
		return $this->db->insert_id();
    }

    public function get_by_penerima($id)
    {
        if (!$id) {
			return;
		}

		$surat_masuk = $this->db->get_where($this->_table, array('penerima_id' => $id))->result();
        $surat_id = [];
        foreach($surat_masuk as $surat){
            $surat_id[] =+ $surat->surat_masuk_id;
        }
		return $surat_id;
    }
    
    public function get_by_surat($id)
    {
        if (!$id) {
			return;
		}

		$penerima = $this->db->get_where($this->_table, array('surat_masuk_id' => $id))->result();
        $penerima_id = [];
        foreach($penerima as $pen){
            $penerima_id[] =+ $pen->penerima_id;
        }
		return $penerima_id;
    }

    public function delete_by_surat($id)
    {
        if (!$id) {
			return;
		}

		return $this->db->delete($this->_table, ['surat_masuk_id' => $id]);
    }

    public function update_by_surat($article)
    {
        if (!isset($article['surat_masuk_id'])) {
			return;
		}

		return $this->db->update($this->_table, $article, ['surat_masuk_id' => $article['surat_masuk_id']]);
    }
}
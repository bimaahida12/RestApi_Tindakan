<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rawat_inap_model extends CI_Model
{

    public $table = 'rawat_inap';
    public $id = 'id_rawat_inap';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_rawat_inap,id_tindakan,id_ruangan,ruangan,tgl_masuk,tgl_keluar');
        $this->datatables->from('rawat_inap');
        //add this line for join
        //$this->datatables->join('table2', 'rawat_inap.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('rawat_inap/read/$1'),'Read')." | ".anchor(site_url('rawat_inap/update/$1'),'Update')." | ".anchor(site_url('rawat_inap/delete/$1'),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id_rawat_inap');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function Api_get_rawat_inap(){
        $this->db->select('rawat_inap.id_rawat_inap,rawat_inap.id_ruangan,rawat_inap.ruangan,tindakan.id_dokter ,tindakan.nama_dokter,tindakan.id_pasien,tindakan.nama_pasien,tindakan.id_jenis_tindakan,tindakan.jenis_tindakan,penyakit.penyakit');
        $this->db->from('rawat_inap');
        $this->db->join('tindakan','tindakan.id_tindakan = rawat_inap.id_tindakan');
        $this->db->join('penyakit','tindakan.id_penyakit  = penyakit.id_penyakit');
        return $this->db->get()->result();
    }

    function Api_get_rawat_inap_Byid($id){
        $this->db->select('rawat_inap.id_rawat_inap,rawat_inap.id_ruangan,rawat_inap.ruangan,tindakan.id_dokter ,tindakan.nama_dokter,tindakan.id_pasien,tindakan.nama_pasien,tindakan.id_jenis_tindakan,tindakan.jenis_tindakan,penyakit.penyakit');
        $this->db->from('rawat_inap');
        $this->db->join('tindakan','tindakan.id_tindakan = rawat_inap.id_tindakan');
        $this->db->join('penyakit','tindakan.id_penyakit  = penyakit.id_penyakit');
        $this->db->where($this->id, $id);
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_rawat_inap', $q);
	$this->db->or_like('id_tindakan', $q);
	$this->db->or_like('id_ruangan', $q);
	$this->db->or_like('ruangan', $q);
	$this->db->or_like('tgl_masuk', $q);
	$this->db->or_like('tgl_keluar', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_rawat_inap', $q);
	$this->db->or_like('id_tindakan', $q);
	$this->db->or_like('id_ruangan', $q);
	$this->db->or_like('ruangan', $q);
	$this->db->or_like('tgl_masuk', $q);
	$this->db->or_like('tgl_keluar', $q);
	$this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Rawat_inap_model.php */
/* Location: ./application/models/Rawat_inap_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2017-10-23 18:29:42 */
/* http://harviacode.com */
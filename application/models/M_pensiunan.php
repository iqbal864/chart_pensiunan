<?php

class M_pensiunan extends CI_Model
{

    public function add($nopen, $nik, $name, $tgl_lahir, $tgl_pensiun, $status, $hidup_md_bk, $no_npp, $tgl_meninggal, $contact_person, $no_rek, $bank, $gender, $bulanan_sekaligus, $no_bpjs, $kelas_bpjs, $address, $nama_pasangan)
    {
        $query = "INSERT INTO all_pensiunan (nopen, nik, name, tgl_lahir, tgl_pensiun, status, hidup_md_bk, no_npp, tgl_meninggal, contact_person, no_rek, bank, gender, bulanan_sekaligus, no_bpjs, kelas_bpjs, address, nama_pasangan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $this->db->query($query, array($nopen, $nik, $name, $tgl_lahir, $tgl_pensiun, $status, $hidup_md_bk, $no_npp, $tgl_meninggal, $contact_person, $no_rek, $bank, $gender, $bulanan_sekaligus, $no_bpjs, $kelas_bpjs, $address, $nama_pasangan));
    }

    // start datatables
    var $column_order = array(null, 'name'); //set column field database for datatable orderable
    var $column_search = array('name', 'nopen'); //set column field database for datatable searchable
    var $order = array('no' => 'asc'); // default order 

    private function _get_datatables_query($hidup_md_bk)
    {
        $this->db->select('all_pensiunan.*');
        $this->db->from('all_pensiunan');
        if ($hidup_md_bk != '') {
            $this->db->where('hidup_md_bk', $hidup_md_bk);
        }

        $i = 0;
        foreach ($this->column_search as $item) { // loop column 

            if (@$_POST['search']['value']) { // if datatable send POST for search

                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_list($hidup_md_bk)
    {
        $this->_get_datatables_query($hidup_md_bk);
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($hidup_md_bk)
    {
        $this->_get_datatables_query($hidup_md_bk);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all($hidup_md_bk)
    {
        $this->db->from('all_pensiunan');
        if ($hidup_md_bk != '') {
            $this->db->where('hidup_md_bk', $hidup_md_bk);
        }
        return $this->db->count_all_results();
    }

    public function edit($id, $data)
    {
        $query = $this->db->update('all_pensiunan', $data, array('no' => $id));
        return $query;
    }
}

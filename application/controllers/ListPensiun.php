<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ListPensiun extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_pensiunan');
    }

    public function index()
    {
        $this->load->view('list_pensiun');
    }

    public function get_datatables()
    {
        if ($this->input->is_ajax_request()) {
            $list = $this->M_pensiunan->get_list();
            $count_filter = $this->M_pensiunan->count_filtered();

            $data = array();
            $no = @$_POST['start'];
            foreach ($list as $item) {
                $no++;
                $row = array();
                $row[] = $no . ".";
                $row[] = htmlentities($item->nopen);
                $row[] = htmlentities($item->name);
                $row[] = date('d-m-Y', strtotime($item->tgl_lahir));
                $row[] = date('d-m-Y', strtotime($item->tgl_pensiun));
                $row[] = htmlentities($item->status);
                $row[] = htmlentities($item->hidup_md_bk);
                $row[] = htmlentities($item->gender);
                $row[] = '<div class="form-button-action">
                            <button onclick="view(' . $this->db->escape($item->nopen) . ')"  type="button" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-info btn-lg" data-original-title="View">
							    <i class="fas fa-eye"></i>
							</button>
							<button onclick="edit(' . $this->db->escape($item->nopen) . ')"  type="button" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-warning btn-lg" data-original-title="Edit">
								<i class="fa fa-edit"></i>
							</button>
						</div>';
                $data[] = $row;
            }
            $output = array(
                "draw" => @$_POST['draw'],
                "recordsTotal" => $this->M_pensiunan->count_all(),
                "recordsFiltered" => $count_filter,
                "data" => $data,
            );
            // output to json format
            echo json_encode($output);
        } else {
            $this->load->view('errors/forbidden');
        }
    }
}

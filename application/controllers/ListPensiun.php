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
        $data['status_hidup'] = $this->db->group_by('hidup_md_bk')->get('all_pensiunan')->result_array();
        $this->load->view('templates/header');
        $this->load->view('list_pensiun', $data);
        $this->load->view('templates/footer');
    }

    public function get_datatables()
    {
        if ($this->input->is_ajax_request()) {
            $hidup_md_bk = $this->input->post('hidup_md_bk');
            $list = $this->M_pensiunan->get_list($hidup_md_bk);
            $count_filter = $this->M_pensiunan->count_filtered($hidup_md_bk);

            $data = array();
            $no = @$_POST['start'];
            foreach ($list as $item) {

                $queryGetDuplikatNopen = $this->db->select('nopen, count(*) as total')->where('nopen', $item->nopen)->group_by('nopen')->having('total > 2')->get('all_pensiunan')->row_array();

                if (!empty($queryGetDuplikatNopen)) {
                    $duplikat_nopen = $queryGetDuplikatNopen['total'];
                } else {
                    $duplikat_nopen = 0;
                }


                $no++;
                $row = array();
                $row[] = $no . ".";
                $row[] = htmlentities($item->nopen);
                $row[] = htmlentities($item->name);
                $row[] = ($item->tgl_lahir != '0000-00-00') ? date('d-m-Y', strtotime($item->tgl_lahir)) : '';
                $row[] = ($item->tgl_pensiun != '0000-00-00') ? date('d-m-Y', strtotime($item->tgl_pensiun)) : '';
                $row[] = htmlentities($item->status);
                $row[] = htmlentities($item->hidup_md_bk);
                $row[] = htmlentities($item->gender);
                $row[] = '<div class="form-button-action">
                            <button onclick="view(' . $this->db->escape($item->nopen) . ')"  type="button" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-info btn-lg" data-original-title="View">
							    <i class="fas fa-eye"></i>
							</button>
							<a href="' . base_url() . 'list/edit' . '/' . $item->no . '" data-toggle="tooltip" title="" class="btn btn-sm btn-outline-warning btn-lg" data-original-title="Edit">
								<i class="fa fa-edit"></i>
							</a>
						</div>';
                $row['duplikat_nopen'] = $duplikat_nopen;
                $data[] = $row;
            }
            $output = array(
                "draw" => @$_POST['draw'],
                "recordsTotal" => $this->M_pensiunan->count_all($hidup_md_bk),
                "recordsFiltered" => $count_filter,
                "data" => $data,
            );
            // output to json format
            echo json_encode($output);
        } else {
            $this->load->view('errors/forbidden');
        }
    }

    public function edit($no)
    {
        $queryGetData = $this->db->get_where('all_pensiunan', ['no' => $no])->row_array();
        if ($queryGetData) {

            $data = [
                'no' => $no,
                'nopen' => $queryGetData['nopen'],
                'nik' => $queryGetData['nik'],
                'name' => $queryGetData['name'],
                'tgl_lahir' => $queryGetData['tgl_lahir'],
                'tgl_pensiun' => $queryGetData['tgl_pensiun'],
                'status' => $queryGetData['status'],
                'hidup_md_bk' => $queryGetData['hidup_md_bk'],
                'no_npp' => $queryGetData['no_npp'],
                'tgl_meninggal' => $queryGetData['tgl_meninggal'],
                'contact_person' => $queryGetData['contact_person'],
                'no_rek' => $queryGetData['no_rek'],
                'bank' => $queryGetData['bank'],
                'gender' => $queryGetData['gender'],
                'bulanan_sekaligus' => $queryGetData['bulanan_sekaligus'],
                'no_bpjs' => $queryGetData['no_bpjs'],
                'kelas_bpjs' => $queryGetData['kelas_bpjs'],
                'address' => $queryGetData['address'],
                'nama_pasangan' => $queryGetData['nama_pasangan'],
            ];

            $this->load->view('templates/header');
            $this->load->view('edit_list', $data);
            $this->load->view('templates/footer');
        } else {
            $this->load->view('errors/forbidden');
        }
    }


    private function validation_edit($no, $nopen, $name)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['valid'] = array();
        $data['status'] = true;

        $queryCekNopen = $this->db->where(['nopen' => $nopen, 'no !=' => $no])->count_all_results('all_pensiunan');

        if ($nopen == '') {
            $data['inputerror'][] = "inputNopen";
            $data['error_string'][] = "Nopen tidak boleh kosong!";
            $data['valid'][] = false;
            $data['status'] = false;
        }

        if ($name == '') {
            $data['inputerror'][] = "inputName";
            $data['error_string'][] = "Nama tidak boleh kosong!";
            $data['valid'][] = false;
            $data['status'] = false;
        }

        if ($this->input->post('inputNopen') != '') {
            if ($queryCekNopen == 2) {
                $data['inputerror'][] = "inputNopen";
                $data['error_string'][] = "Nopen sudah pernah ditambahkan!";
                $data['valid'][] = false;
                $data['status'] = false;
            } else {
                $data['inputerror'][] = "inputNopen";
                $data['error_string'][] = "";
                $data['valid'][] = true;
            }
        }

        if ($this->input->post('inputName') != '') {
            $data['inputerror'][] = "inputName";
            $data['error_string'][] = "";
            $data['valid'][] = true;
        }

        if ($data['status'] == false) {
            echo json_encode($data);
            exit();
        }
    }

    public function proses_edit()
    {
        if ($this->input->is_ajax_request()) {
            $no = $this->input->post('inputNo');
            $queryCekData = $this->db->get_where('all_pensiunan', ['no' => $no])->row_array();
            if ($queryCekData) {
                $nopen = $this->input->post('inputNopen');
                $nik = $this->input->post('inputNik');
                $name = $this->input->post('inputName');
                $tgl_lahir = ($this->input->post('inputTgl_lahir') != '') ? date('Y-m-d', strtotime($this->input->post('inputTgl_lahir'))) : '';
                $tgl_pensiun = ($this->input->post('inputTgl_pensiun') != '') ? date('Y-m-d', strtotime($this->input->post('inputTgl_pensiun'))) : '';
                $status = $this->input->post('inputStatus');
                $hidup_md_bk = $this->input->post('inputKeterangan');

                if ($hidup_md_bk == "MD") {
                    $tgl_meninggal = date('Y-m-d', strtotime($this->input->post('inputTgl_meninggal')));
                } else {
                    $tgl_meninggal = "";
                }

                $no_npp = $this->input->post('inputNonpp');
                $contact_person = $this->input->post('inputContact');
                $no_rek = $this->input->post('inputRekening');
                $bank = $this->input->post('inputBank');
                $gender = $this->input->post('inputGender');
                $bulanan_sekaligus = $this->input->post('inputPembayaran');
                $no_bpjs = $this->input->post('inputNoBpjs');
                $kelas_bpjs = $this->input->post('inputKelasBpjs');
                $address = $this->input->post('inputAddress');
                $nama_pasangan = $this->input->post('inputPasangan');

                $this->validation_edit($no, $nopen, $name);

                $data = [
                    'no' => $no,
                    'nopen' => $nopen,
                    'nik' => $nik,
                    'name' => $name,
                    'tgl_lahir' => $tgl_lahir,
                    'tgl_pensiun' => $tgl_pensiun,
                    'status' => $status,
                    'hidup_md_bk' => $hidup_md_bk,
                    'no_npp' => $no_npp,
                    'tgl_meninggal' => $tgl_meninggal,
                    'contact_person' => $contact_person,
                    'no_rek' => $no_rek,
                    'bank' => $bank,
                    'gender' => $gender,
                    'bulanan_sekaligus' => $bulanan_sekaligus,
                    'no_bpjs' => $no_bpjs,
                    'kelas_bpjs' => $kelas_bpjs,
                    'address' => $address,
                    'nama_pasangan' => $nama_pasangan,
                ];

                $this->M_pensiunan->edit($no, $data);

                $this->session->set_flashdata('berhasil', 'Berhasil Edit Pensiunan');

                $msg = array('berhasil' => "list");
                echo json_encode($msg);
            } else {
                $this->load->view('errors/forbidden');
            }
        } else {
            $this->load->view('errors/forbidden');
        }
    }
}

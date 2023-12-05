<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function index()
    {
        $getKeterangan = $this->db->select('hidup_md_bk')->group_by('hidup_md_bk')->get('all_pensiunan')->result_array();

        $pensiunan = [];
        $count_all_status = [];
        $count_all_keterangan = [];
        foreach ($getKeterangan as $hmb) {
            $getStatus =  $this->db->select('status')->where(['hidup_md_bk' => $hmb['hidup_md_bk']])->group_by('status')->get('all_pensiunan')->result_array();

            $status = [];
            foreach ($getStatus as $gs) {

                $countBulanan = $this->db->select('bulanan_sekaligus')->where(['hidup_md_bk' => $hmb['hidup_md_bk'], 'status' => $gs['status'], 'bulanan_sekaligus' => 'Bulanan'])->count_all_results('all_pensiunan');
                $countSekaligus = $this->db->select('bulanan_sekaligus')->where(['hidup_md_bk' => $hmb['hidup_md_bk'], 'status' => $gs['status'], 'bulanan_sekaligus' => 'Sekaligus'])->count_all_results('all_pensiunan');
                $countAllStatus = $this->db->select('bulanan_sekaligus')->where(['hidup_md_bk' => $hmb['hidup_md_bk'], 'status' => $gs['status']])->count_all_results('all_pensiunan');

                $status[] = [
                    'nama_status' => $gs['status'],
                    'data_total' => [
                        'bulanan' => $countBulanan,
                        'sekaligus' => $countSekaligus,
                        'semua' => $countAllStatus
                    ]
                ];
            }

            $pensiunan[] = [
                'keterangan' => $hmb['hidup_md_bk'],
                'status' => $status
            ];



            $countAllKeterangan = $this->db->select('hidup_md_bk')->where(['hidup_md_bk' => $hmb['hidup_md_bk']])->count_all_results('all_pensiunan');

            $count_all_keterangan[] = [
                'nama_keterangan' => $hmb['hidup_md_bk'],
                'data_total' => [
                    'semua' => $countAllKeterangan
                ]
            ];
        }



        $getStatus =  $this->db->select('status')->where(['hidup_md_bk' => $hmb['hidup_md_bk']])->group_by('status')->get('all_pensiunan')->result_array();

        $count_all_status = [];
        foreach ($getStatus as $gs) {
            $countAllStatus = $this->db->select('bulanan_sekaligus')->where(['status' => $gs['status']])->count_all_results('all_pensiunan');

            $count_all_status[] = [
                'nama_status' => $gs['status'],
                'data_total' => [
                    'semua' => $countAllStatus
                ]
            ];
        }


        $data['countAll'] = $this->db->count_all_results('all_pensiunan');
        $data['pensiunan'] = $pensiunan;
        $data['pie_status'] = $count_all_status;
        $data['pie_keterangan'] = $count_all_keterangan;

        // print("<pre>" . print_r($count_all_keterangan, true) . "</pre>");

        $this->load->view('index', $data);
    }
}

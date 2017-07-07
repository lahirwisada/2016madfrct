<?php

if (!defined("BASEPATH")) {
    exit("No direct script access allowed");
}

class Model_laporan extends LWS_Model {

    protected $master_pangkat = '';
    protected $master_kelompok_pangkat = '';
    protected $master_golongan_pangkat = '';
    protected $master_tingkat_pangkat = '';
    protected $master_kotama = '';
    protected $master_satminkal = '';
    protected $master_corps = '';
    protected $tr_pasukan_rekap = '';
    protected $tr_pasukan_detail = '';

    public function __construct() {
        parent::__construct();
        $this->master_pangkat = $this->get_schema_name("master_pangkat", TRUE);
        $this->master_kelompok_pangkat = $this->get_schema_name("master_kelompok_pangkat", TRUE);
        $this->master_golongan_pangkat = $this->get_schema_name("master_golongan_pangkat", TRUE);
        $this->master_tingkat_pangkat = $this->get_schema_name("master_tingkat_pangkat", TRUE);
        $this->master_kotama = $this->get_schema_name("master_kotama", TRUE);
        $this->master_satminkal = $this->get_schema_name("master_satminkal", TRUE);
        $this->master_corps = $this->get_schema_name("master_corps", TRUE);
        $this->tr_pasukan_rekap = $this->get_schema_name("tr_pasukan_rekap", TRUE);
        $this->tr_pasukan_detail = $this->get_schema_name("tr_pasukan_detail", TRUE);
    }

    public function get_by_kelompok_for_graph($jenis, $bulan, $tahun) {
        $this->db->select($this->master_kelompok_pangkat . '.kode_kelompok');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas');
        $this->db->select_sum($this->tr_pasukan_detail . '.mpp');
        $this->db->select_sum($this->tr_pasukan_detail . '.lf');
        $this->db->select_sum($this->tr_pasukan_detail . '.skorsing');
        $this->db->join($this->master_kelompok_pangkat, $this->master_kelompok_pangkat . '.id_kelompok=' . $this->master_pangkat . '.id_kelompok');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_pangkat=' . $this->master_pangkat . '.id_pangkat');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_rekap=' . $this->tr_pasukan_detail . '.id_rekap');
        $this->db->join($this->master_kotama, $this->master_kotama . '.id_kotama=' . $this->tr_pasukan_rekap . '.id_kotama');
        $this->db->where($this->master_pangkat . '.id_kelompok < 18');
        $this->db->where($this->master_kotama . '.struktur_kotama = ' . $jenis);
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->group_by($this->master_kelompok_pangkat . '.id_kelompok');
        $this->db->order_by($this->master_kelompok_pangkat . '.id_kelompok', 'desc');
        $query = $this->db->get($this->master_pangkat);
//        echo $this->db->last_query();
        $result = array();
        $top = 0;
        $nyata = 0;
        foreach ($query->result() as $record) {
            if ($record->kode_kelompok == "SERMA") {
                $nyata = $record->dinas + $record->mpp + $record->lf + $record->skorsing;
                $top = $record->top;
            } elseif ($record->kode_kelompok == "SERKA") {
                $result[] = array(
                    'label' => 'SRK/SRM',
                    'nyata' => $record->dinas + $record->mpp + $record->lf + $record->skorsing + $nyata,
                    'top' => $record->top + $top
                );
            } elseif ($record->kode_kelompok == "KOPKA") {
                $nyata = $record->dinas + $record->mpp + $record->lf + $record->skorsing;
                $top = $record->top;
            } elseif ($record->kode_kelompok == "KOPRAL") {
                $result[] = array(
                    'label' => 'KOPRAL',
                    'nyata' => $record->dinas + $record->mpp + $record->lf + $record->skorsing + $nyata,
                    'top' => $record->top + $top
                );
            } elseif ($record->kode_kelompok == "PRAKA") {
                $nyata = $record->dinas + $record->mpp + $record->lf + $record->skorsing;
                $top = $record->top;
            } elseif ($record->kode_kelompok == "PRAJURIT") {
                $result[] = array(
                    'label' => 'PRAJURIT',
                    'nyata' => $record->dinas + $record->mpp + $record->lf + $record->skorsing + $nyata,
                    'top' => $record->top + $top
                );
            } else {
                $result[] = array(
                    'label' => $record->kode_kelompok,
                    'nyata' => $record->dinas + $record->mpp + $record->lf + $record->skorsing,
                    'top' => $record->top
                );
            }
        }
//        var_dump($result);
//        var_dump($query->result());
//        exit();
        return $result;
    }

    public function get_by_tingkat_for_graph($jenis, $bulan, $tahun) {
        $this->db->select($this->master_tingkat_pangkat . '.kode_tingkat');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas');
        $this->db->select_sum($this->tr_pasukan_detail . '.mpp');
        $this->db->select_sum($this->tr_pasukan_detail . '.lf');
        $this->db->select_sum($this->tr_pasukan_detail . '.skorsing');
        $this->db->join($this->master_tingkat_pangkat, $this->master_tingkat_pangkat . '.id_tingkat=' . $this->master_pangkat . '.id_tingkat');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_pangkat=' . $this->master_pangkat . '.id_pangkat');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_rekap=' . $this->tr_pasukan_detail . '.id_rekap');
        $this->db->join($this->master_kotama, $this->master_kotama . '.id_kotama=' . $this->tr_pasukan_rekap . '.id_kotama');
        $this->db->where($this->master_pangkat . '.id_tingkat < 6');
        $this->db->where($this->master_kotama . '.struktur_kotama = ' . $jenis);
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->group_by($this->master_tingkat_pangkat . '.id_tingkat');
        $this->db->order_by($this->master_tingkat_pangkat . '.id_tingkat', 'desc');
        $query = $this->db->get($this->master_pangkat);
//        echo $this->db->last_query();
        $result = array();
        foreach ($query->result() as $record) {
            $result[] = array(
                'label' => $record->kode_tingkat,
                'nyata' => $record->dinas + $record->mpp + $record->lf + $record->skorsing,
                'top' => $record->top
            );
        }
//        var_dump($result);
//        var_dump($query->result());
//        exit();
        return $result;
    }

    public function get_by_golongan_for_graph($jenis, $bulan, $tahun) {
        $this->db->select($this->master_golongan_pangkat . '.ur_golongan');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas');
        $this->db->select_sum($this->tr_pasukan_detail . '.mpp');
        $this->db->select_sum($this->tr_pasukan_detail . '.lf');
        $this->db->select_sum($this->tr_pasukan_detail . '.skorsing');
        $this->db->join($this->master_golongan_pangkat, $this->master_golongan_pangkat . '.id_golongan=' . $this->master_pangkat . '.id_golongan');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_pangkat=' . $this->master_pangkat . '.id_pangkat');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_rekap=' . $this->tr_pasukan_detail . '.id_rekap');
        $this->db->join($this->master_kotama, $this->master_kotama . '.id_kotama=' . $this->tr_pasukan_rekap . '.id_kotama');
        $this->db->where($this->master_pangkat . '.id_golongan < 4');
        $this->db->where($this->master_kotama . '.struktur_kotama = ' . $jenis);
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->group_by($this->master_golongan_pangkat . '.id_golongan');
        $this->db->order_by($this->master_golongan_pangkat . '.id_golongan', 'desc');
        $query = $this->db->get($this->master_pangkat);
//        echo $this->db->last_query();
        $result = array();
        foreach ($query->result() as $record) {
            $result[] = array(
                'label' => $record->ur_golongan,
                'nyata' => $record->dinas + $record->mpp + $record->lf + $record->skorsing,
                'top' => $record->top
            );
        }
//        var_dump($result);
//        var_dump($query->result());
//        exit();
        return $result;
    }

    public function get_by_in_structure($bulan = 1, $tahun = 2014) {
        $this->db->select($this->master_pangkat . '.id_pangkat');
        $this->db->select($this->master_pangkat . '.ur_pangkat');
        $this->db->select($this->master_tingkat_pangkat . '.kode_tingkat');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas');
        $this->db->select_sum($this->tr_pasukan_detail . '.mpp');
        $this->db->select_sum($this->tr_pasukan_detail . '.lf');
        $this->db->select_sum($this->tr_pasukan_detail . '.skorsing');
        $this->db->join($this->master_tingkat_pangkat, $this->master_tingkat_pangkat . '.id_tingkat=' . $this->master_pangkat . '.id_tingkat');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_pangkat=' . $this->master_pangkat . '.id_pangkat');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_rekap=' . $this->tr_pasukan_detail . '.id_rekap');
        $this->db->join($this->master_kotama, $this->master_kotama . '.id_kotama=' . $this->tr_pasukan_rekap . '.id_kotama');
        $this->db->where($this->master_pangkat . '.id_tingkat < 6');
        $this->db->where($this->master_kotama . '.struktur_kotama = 1');
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->group_by($this->master_pangkat . '.id_pangkat');
        $this->db->group_by($this->master_tingkat_pangkat . '.kode_tingkat');
        $this->db->order_by($this->master_pangkat . '.id_pangkat', 'desc');
        $query = $this->db->get($this->master_pangkat);
//        echo $this->db->last_query();
//        var_dump($query->result());
//        exit();
        return $this->arrange_by_tingkat($query->result());
    }

    public function arrange_by_tingkat($records = FALSE) {
        $result = array();
        if ($records) {
            foreach ($records as $record) {
                $result[$record->kode_tingkat][] = $record;
            }
        }
//        var_dump($result);
//        exit();
        return $result;
    }

    public function get_by_kotama_and_golongan($bulan = 1, $tahun = 2014) {
        $this->db->select($this->master_kotama . '.ur_kotama');
        $this->db->select($this->master_golongan_pangkat . '.ur_golongan');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas + ' . $this->tr_pasukan_detail . '.mpp + ' . $this->tr_pasukan_detail . '.lf + ' . $this->tr_pasukan_detail . '.skorsing', 'nyata');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_kotama=' . $this->master_kotama . '.id_kotama');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_rekap=' . $this->tr_pasukan_rekap . '.id_rekap');
        $this->db->join($this->master_pangkat, $this->master_pangkat . '.id_pangkat=' . $this->tr_pasukan_detail . '.id_pangkat');
        $this->db->join($this->master_golongan_pangkat, $this->master_golongan_pangkat . '.id_golongan=' . $this->master_pangkat . '.id_golongan');
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->where($this->master_golongan_pangkat . '.id_golongan < 4');
        $this->db->group_by($this->master_kotama . '.id_kotama');
        $this->db->group_by($this->master_golongan_pangkat . '.id_golongan');
        $this->db->order_by($this->master_kotama . '.kode_kotama', 'asc');
        $query = $this->db->get($this->master_kotama);
//        echo $this->db->last_query();
//        var_dump($query->result());
//        exit();
        return $this->arrange_by_kotama_and_golongan($query->result());
    }

    public function arrange_by_kotama_and_golongan($records = FALSE) {
        $result = array();
        if ($records) {
            $i = -1;
            $kotama = '';
            foreach ($records as $record) {
                if ($kotama <> $record->ur_kotama) {
                    $kotama = $record->ur_kotama;
                    $i++;
                }
                $result[$i]["kotama"] = $record->ur_kotama;
                $result[$i][strtolower($record->ur_golongan) . "_top"] = $record->top;
                $result[$i][strtolower($record->ur_golongan) . "_nyata"] = $record->nyata;
            }
        }
//        var_dump($result);exit();
        return $result;
    }

    public function get_by_kotama_and_tingkat($tingkat = 5, $bulan = 1, $tahun = 2014) {
        $this->db->select($this->master_kotama . '.ur_kotama');
        $this->db->select($this->master_kelompok_pangkat . '.kode_kelompok');
        $this->db->select($this->master_tingkat_pangkat . '.kode_tingkat');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas + ' . $this->tr_pasukan_detail . '.mpp + ' . $this->tr_pasukan_detail . '.lf + ' . $this->tr_pasukan_detail . '.skorsing', 'nyata');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_kotama=' . $this->master_kotama . '.id_kotama');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_rekap=' . $this->tr_pasukan_rekap . '.id_rekap');
        $this->db->join($this->master_pangkat, $this->master_pangkat . '.id_pangkat=' . $this->tr_pasukan_detail . '.id_pangkat');
        $this->db->join($this->master_kelompok_pangkat, $this->master_kelompok_pangkat . '.id_kelompok=' . $this->master_pangkat . '.id_kelompok');
        $this->db->join($this->master_tingkat_pangkat, $this->master_tingkat_pangkat . '.id_tingkat=' . $this->master_pangkat . '.id_tingkat');
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->where($this->master_tingkat_pangkat . '.id_tingkat < 6');
        $this->db->group_by($this->master_kotama . '.id_kotama');
        $this->db->group_by($this->master_kelompok_pangkat . '.id_kelompok');
        $this->db->group_by($this->master_tingkat_pangkat . '.id_tingkat');
        $this->db->order_by($this->master_kotama . '.kode_kotama', 'asc');
        $this->db->order_by($this->master_tingkat_pangkat . '.id_tingkat', 'desc');
        $query = $this->db->get($this->master_kotama);
//        echo $this->db->last_query();
//        var_dump($query->result());
//        exit();
        return $this->arrange_by_kotama_and_tingkat($query->result());
    }

    public function arrange_by_kotama_and_tingkat($records = FALSE) {
        $result = array();
        if ($records) {
            $i = -1;
            $kotama = '';
            foreach ($records as $record) {
                if ($kotama <> $record->ur_kotama) {
                    $kotama = $record->ur_kotama;
                    $i++;
                }
                $result[$record->kode_tingkat]["pangkat"][$record->kode_kelompok] = $record->kode_kelompok;
                $result[$record->kode_tingkat]["data"][$i]["kotama"] = $record->ur_kotama;
                $result[$record->kode_tingkat]["data"][$i][strtolower($record->kode_kelompok) . "_top"] = $record->top;
                $result[$record->kode_tingkat]["data"][$i][strtolower($record->kode_kelompok) . "_nyata"] = $record->nyata;
            }
        }
//        var_dump($result);
//        exit();
        return $result;
    }

    public function get_by_corps_and_golongan($bulan = 1, $tahun = 2014) {
        $this->db->select($this->master_corps . '.init_corps');
        $this->db->select($this->master_golongan_pangkat . '.ur_golongan');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas + ' . $this->tr_pasukan_detail . '.mpp + ' . $this->tr_pasukan_detail . '.lf + ' . $this->tr_pasukan_detail . '.skorsing', 'nyata');
        $this->db->join($this->master_satminkal, $this->master_satminkal . '.id_corps=' . $this->master_corps . '.id_corps');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_satminkal=' . $this->master_satminkal . '.id_satminkal');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_rekap=' . $this->tr_pasukan_detail . '.id_rekap');
        $this->db->join($this->master_pangkat, $this->master_pangkat . '.id_pangkat=' . $this->tr_pasukan_detail . '.id_pangkat');
        $this->db->join($this->master_golongan_pangkat, $this->master_golongan_pangkat . '.id_golongan=' . $this->master_pangkat . '.id_golongan');
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->where($this->master_golongan_pangkat . '.id_golongan < 4');
        $this->db->where($this->master_corps . '.id_corps > 0');
        $this->db->group_by($this->master_corps . '.id_corps');
        $this->db->group_by($this->master_golongan_pangkat . '.id_golongan');
        $this->db->order_by($this->master_corps . '.kode_corps', 'asc');
        $this->db->order_by($this->master_golongan_pangkat . '.id_golongan', 'desc');
        $query = $this->db->get($this->master_corps);
//        echo $this->db->last_query();
//        var_dump($query->result());
//        exit();
        return $this->arrange_by_corps_and_golongan($query->result());
    }

    public function arrange_by_corps_and_golongan($records = FALSE) {
        $result = array();
        if ($records) {
            $i = -1;
            $corps = '';
            foreach ($records as $record) {
                if ($corps <> $record->init_corps) {
                    $corps = $record->init_corps;
                    $i++;
                }
                $result[$i]["corps"] = $record->init_corps;
                $result[$i][strtolower($record->ur_golongan) . "_top"] = $record->top;
                $result[$i][strtolower($record->ur_golongan) . "_nyata"] = $record->nyata;
            }
        }
//        var_dump($result);exit();
        return $result;
    }

    public function get_by_corps_and_tingkat($tingkat = 5, $bulan = 1, $tahun = 2014) {
        $this->db->select($this->master_corps . '.init_corps');
        $this->db->select($this->master_kelompok_pangkat . '.kode_kelompok');
        $this->db->select($this->master_tingkat_pangkat . '.kode_tingkat');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas + ' . $this->tr_pasukan_detail . '.mpp + ' . $this->tr_pasukan_detail . '.lf + ' . $this->tr_pasukan_detail . '.skorsing', 'nyata');
        $this->db->join($this->master_satminkal, $this->master_satminkal . '.id_corps=' . $this->master_corps . '.id_corps');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_satminkal=' . $this->master_satminkal . '.id_satminkal');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_rekap=' . $this->tr_pasukan_detail . '.id_rekap');
        $this->db->join($this->master_pangkat, $this->master_pangkat . '.id_pangkat=' . $this->tr_pasukan_detail . '.id_pangkat');
        $this->db->join($this->master_kelompok_pangkat, $this->master_kelompok_pangkat . '.id_kelompok=' . $this->master_pangkat . '.id_kelompok');
        $this->db->join($this->master_tingkat_pangkat, $this->master_tingkat_pangkat . '.id_tingkat=' . $this->master_pangkat . '.id_tingkat');
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->where($this->master_tingkat_pangkat . '.id_tingkat < 6');
        $this->db->where($this->master_corps . '.id_corps > 0');

        $this->db->group_by($this->master_corps . '.id_corps');
        $this->db->group_by($this->master_kelompok_pangkat . '.id_kelompok');
        $this->db->group_by($this->master_tingkat_pangkat . '.id_tingkat');
        $this->db->order_by($this->master_corps . '.kode_corps', 'asc');
        $this->db->order_by($this->master_tingkat_pangkat . '.id_tingkat', 'desc');
        $query = $this->db->get($this->master_corps);
//        echo $this->db->last_query();
//        var_dump($query->result());
//        exit();
        return $this->arrange_by_corps_and_tingkat($query->result());
    }

    public function arrange_by_corps_and_tingkat($records = FALSE) {
        $result = array();
        if ($records) {
            $i = -1;
            $corps = '';
            foreach ($records as $record) {
                if ($corps <> $record->init_corps) {
                    $corps = $record->init_corps;
                    $i++;
                }
                $result[$record->kode_tingkat]["pangkat"][$record->kode_kelompok] = $record->kode_kelompok;
                $result[$record->kode_tingkat]["data"][$i]["corps"] = $record->init_corps;
                $result[$record->kode_tingkat]["data"][$i][strtolower($record->kode_kelompok) . "_top"] = $record->top;
                $result[$record->kode_tingkat]["data"][$i][strtolower($record->kode_kelompok) . "_nyata"] = $record->nyata;
            }
        }
//        var_dump($result);
//        exit();
        return $result;
    }

    public function get_multi_by_kotama_and_golongan($bulan = 1, $tahun = 2014) {
        $this->db->select($this->master_kotama . '.ur_kotama');
        $this->db->select($this->master_golongan_pangkat . '.ur_golongan');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas + ' . $this->tr_pasukan_detail . '.mpp + ' . $this->tr_pasukan_detail . '.lf + ' . $this->tr_pasukan_detail . '.skorsing', 'nyata');
        $this->db->join($this->master_satminkal, $this->master_satminkal . '.id_kotama=' . $this->master_kotama . '.id_kotama');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_satminkal=' . $this->master_satminkal . '.id_satminkal');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_rekap=' . $this->tr_pasukan_detail . '.id_rekap');
        $this->db->join($this->master_pangkat, $this->master_pangkat . '.id_pangkat=' . $this->tr_pasukan_detail . '.id_pangkat');
        $this->db->join($this->master_golongan_pangkat, $this->master_golongan_pangkat . '.id_golongan=' . $this->master_pangkat . '.id_golongan');
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->where($this->master_golongan_pangkat . '.id_golongan < 4');
        $this->db->where($this->master_satminkal . '.id_corps < 1');
        $this->db->group_by($this->master_kotama . '.id_kotama');
        $this->db->group_by($this->master_golongan_pangkat . '.id_golongan');
        $this->db->order_by($this->master_kotama . '.kode_kotama', 'asc');
        $query = $this->db->get($this->master_kotama);
//        echo $this->db->last_query();
//        var_dump($query->result());
//        exit();
        return $this->arrange_multi_by_kotama_and_golongan($query->result());
    }

    public function arrange_multi_by_kotama_and_golongan($records = FALSE) {
        $result = array();
        if ($records) {
            $i = -1;
            $kotama = '';
            foreach ($records as $record) {
                if ($kotama <> $record->ur_kotama) {
                    $kotama = $record->ur_kotama;
                    $i++;
                }
                $result[$i]["kotama"] = $record->ur_kotama;
                $result[$i][strtolower($record->ur_golongan) . "_top"] = $record->top;
                $result[$i][strtolower($record->ur_golongan) . "_nyata"] = $record->nyata;
            }
        }
//        var_dump($result);exit();
        return $result;
    }

    public function get_multi_by_kotama_and_tingkat($tingkat = 5, $bulan = 1, $tahun = 2014) {
        $this->db->select($this->master_kotama . '.ur_kotama');
        $this->db->select($this->master_kelompok_pangkat . '.kode_kelompok');
        $this->db->select($this->master_tingkat_pangkat . '.kode_tingkat');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas + ' . $this->tr_pasukan_detail . '.mpp + ' . $this->tr_pasukan_detail . '.lf + ' . $this->tr_pasukan_detail . '.skorsing', 'nyata');
        $this->db->join($this->master_satminkal, $this->master_satminkal . '.id_kotama=' . $this->master_kotama . '.id_kotama');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_satminkal=' . $this->master_satminkal . '.id_satminkal');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_rekap=' . $this->tr_pasukan_detail . '.id_rekap');
        $this->db->join($this->master_pangkat, $this->master_pangkat . '.id_pangkat=' . $this->tr_pasukan_detail . '.id_pangkat');
        $this->db->join($this->master_kelompok_pangkat, $this->master_kelompok_pangkat . '.id_kelompok=' . $this->master_pangkat . '.id_kelompok');
        $this->db->join($this->master_tingkat_pangkat, $this->master_tingkat_pangkat . '.id_tingkat=' . $this->master_pangkat . '.id_tingkat');
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->where($this->master_tingkat_pangkat . '.id_tingkat < 6');
        $this->db->where($this->master_satminkal . '.id_corps < 1');
        $this->db->group_by($this->master_kotama . '.id_kotama');
        $this->db->group_by($this->master_kelompok_pangkat . '.id_kelompok');
        $this->db->group_by($this->master_tingkat_pangkat . '.id_tingkat');
        $this->db->order_by($this->master_kotama . '.kode_kotama', 'asc');
        $this->db->order_by($this->master_tingkat_pangkat . '.id_tingkat', 'desc');
        $query = $this->db->get($this->master_kotama);
//        echo $this->db->last_query();
//        var_dump($query->result());
//        exit();
        return $this->arrange_multi_by_kotama_and_tingkat($query->result());
    }

    public function arrange_multi_by_kotama_and_tingkat($records = FALSE) {
        $result = array();
        if ($records) {
            $i = -1;
            $kotama = '';
            foreach ($records as $record) {
                if ($kotama <> $record->ur_kotama) {
                    $kotama = $record->ur_kotama;
                    $i++;
                }
                $result[$record->kode_tingkat]["pangkat"][$record->kode_kelompok] = $record->kode_kelompok;
                $result[$record->kode_tingkat]["data"][$i]["kotama"] = $record->ur_kotama;
                $result[$record->kode_tingkat]["data"][$i][strtolower($record->kode_kelompok) . "_top"] = $record->top;
                $result[$record->kode_tingkat]["data"][$i][strtolower($record->kode_kelompok) . "_nyata"] = $record->nyata;
            }
        }
//        var_dump($result);
//        exit();
        return $result;
    }

    public function get_tempur_by_kotama_and_golongan($bulan = 1, $tahun = 2014) {
        $this->db->select($this->master_kotama . '.ur_kotama');
        $this->db->select($this->master_golongan_pangkat . '.kode_golongan');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas + ' . $this->tr_pasukan_detail . '.mpp + ' . $this->tr_pasukan_detail . '.lf + ' . $this->tr_pasukan_detail . '.skorsing', 'nyata');
        $this->db->join($this->master_satminkal, $this->master_satminkal . '.id_kotama=' . $this->master_kotama . '.id_kotama');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_satminkal=' . $this->master_satminkal . '.id_satminkal');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_rekap=' . $this->tr_pasukan_detail . '.id_rekap');
        $this->db->join($this->master_pangkat, $this->master_pangkat . '.id_pangkat=' . $this->tr_pasukan_detail . '.id_pangkat');
        $this->db->join($this->master_golongan_pangkat, $this->master_golongan_pangkat . '.id_golongan=' . $this->master_pangkat . '.id_golongan');
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->where($this->master_golongan_pangkat . '.id_golongan < 4');
        $this->db->where_in($this->master_satminkal . '.id_kesatuan', array(1, 2, 3));
        $this->db->group_by($this->master_kotama . '.id_kotama');
        $this->db->group_by($this->master_golongan_pangkat . '.id_golongan');
        $this->db->order_by($this->master_kotama . '.kode_kotama', 'asc');
        $this->db->order_by($this->master_golongan_pangkat . '.id_golongan', 'desc');
        $query = $this->db->get($this->master_kotama);
//        echo $this->db->last_query();
//        var_dump($query->result());
//        exit();
        return $this->arrange_tempur_by_kotama_and_golongan($query->result());
    }

    public function arrange_tempur_by_kotama_and_golongan($records = FALSE) {
        $result = array();
        if ($records) {
            foreach ($records as $record) {
                $result[$record->ur_kotama][$record->kode_golongan] = array(
                    'top' => $record->top,
                    'nyata' => $record->nyata
                );
            }
        }
//        var_dump($result);
//        exit();
        return $result;
    }

    public function get_satbalak_by_kotama_and_golongan($bulan = 1, $tahun = 2014) {
        $this->db->select($this->master_kotama . '.ur_kotama');
        $this->db->select($this->master_golongan_pangkat . '.kode_golongan');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas + ' . $this->tr_pasukan_detail . '.mpp + ' . $this->tr_pasukan_detail . '.lf + ' . $this->tr_pasukan_detail . '.skorsing', 'nyata');
        $this->db->join($this->master_satminkal, $this->master_satminkal . '.id_kotama=' . $this->master_kotama . '.id_kotama');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_satminkal=' . $this->master_satminkal . '.id_satminkal');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_rekap=' . $this->tr_pasukan_detail . '.id_rekap');
        $this->db->join($this->master_pangkat, $this->master_pangkat . '.id_pangkat=' . $this->tr_pasukan_detail . '.id_pangkat');
        $this->db->join($this->master_golongan_pangkat, $this->master_golongan_pangkat . '.id_golongan=' . $this->master_pangkat . '.id_golongan');
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->where($this->master_golongan_pangkat . '.id_golongan < 4');
        $this->db->where_in($this->master_satminkal . '.id_kesatuan', array(4, 5));
        $this->db->group_by($this->master_kotama . '.id_kotama');
        $this->db->group_by($this->master_golongan_pangkat . '.id_golongan');
        $this->db->order_by($this->master_kotama . '.kode_kotama', 'asc');
        $this->db->order_by($this->master_golongan_pangkat . '.id_golongan', 'desc');
        $query = $this->db->get($this->master_kotama);
//        echo $this->db->last_query();
//        var_dump($query->result());
//        exit();
        return $this->arrange_satbalak_by_kotama_and_golongan($query->result());
    }

    public function arrange_satbalak_by_kotama_and_golongan($records = FALSE) {
        $result = array();
        if ($records) {
            foreach ($records as $record) {
                $result[$record->ur_kotama][] = array(
                    'golongan' => $record->kode_golongan,
                    'top' => $record->top,
                    'nyata' => $record->nyata
                );
            }
        }
//        var_dump($result);
//        exit();
        return $result;
    }

    public function get_satbalak_by_satminkal_and_golongan($bulan = 1, $tahun = 2014) {
        $this->db->select($this->master_kotama . '.ur_kotama');
        $this->db->select($this->master_satminkal . '.ur_satminkal');
        $this->db->select($this->master_golongan_pangkat . '.kode_golongan');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas + ' . $this->tr_pasukan_detail . '.mpp + ' . $this->tr_pasukan_detail . '.lf + ' . $this->tr_pasukan_detail . '.skorsing', 'nyata');
        $this->db->join($this->master_satminkal, $this->master_satminkal . '.id_kotama=' . $this->master_kotama . '.id_kotama');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_satminkal=' . $this->master_satminkal . '.id_satminkal');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_rekap=' . $this->tr_pasukan_detail . '.id_rekap');
        $this->db->join($this->master_pangkat, $this->master_pangkat . '.id_pangkat=' . $this->tr_pasukan_detail . '.id_pangkat');
        $this->db->join($this->master_golongan_pangkat, $this->master_golongan_pangkat . '.id_golongan=' . $this->master_pangkat . '.id_golongan');
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->where($this->master_golongan_pangkat . '.id_golongan < 4');
        $this->db->where_in($this->master_satminkal . '.id_kesatuan', array(4, 5));
        $this->db->group_by($this->master_kotama . '.id_kotama');
        $this->db->group_by($this->master_satminkal . '.id_satminkal');
        $this->db->group_by($this->master_golongan_pangkat . '.id_golongan');
        $this->db->order_by($this->master_kotama . '.kode_kotama', 'asc');
        $this->db->order_by($this->master_golongan_pangkat . '.id_golongan', 'desc');
        $query = $this->db->get($this->master_kotama);
//        echo $this->db->last_query();
//        var_dump($query->result());
//        exit();
        return $this->arrange_satbalak_by_satminkal_and_golongan($query->result());
    }

    public function arrange_satbalak_by_satminkal_and_golongan($records = FALSE) {
        $result = array();
        if ($records) {
            foreach ($records as $record) {
                $result[$record->ur_kotama][$record->ur_satminkal][] = array(
                    'golongan' => $record->kode_golongan,
                    'top' => $record->top,
                    'nyata' => $record->nyata
                );
            }
        }
//        var_dump($result);
//        exit();
        return $result;
    }

    public function get_satkowil_by_kotama_and_golongan($bulan = 1, $tahun = 2014) {
        $this->db->select($this->master_kotama . '.ur_kotama');
        $this->db->select($this->master_golongan_pangkat . '.kode_golongan');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas + ' . $this->tr_pasukan_detail . '.mpp + ' . $this->tr_pasukan_detail . '.lf + ' . $this->tr_pasukan_detail . '.skorsing', 'nyata');
        $this->db->join($this->master_satminkal, $this->master_satminkal . '.id_kotama=' . $this->master_kotama . '.id_kotama');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_satminkal=' . $this->master_satminkal . '.id_satminkal');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_rekap=' . $this->tr_pasukan_detail . '.id_rekap');
        $this->db->join($this->master_pangkat, $this->master_pangkat . '.id_pangkat=' . $this->tr_pasukan_detail . '.id_pangkat');
        $this->db->join($this->master_golongan_pangkat, $this->master_golongan_pangkat . '.id_golongan=' . $this->master_pangkat . '.id_golongan');
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->where($this->master_golongan_pangkat . '.id_golongan < 4');
        $this->db->where_in($this->master_satminkal . '.id_kesatuan', array(6, 7));
        $this->db->group_by($this->master_kotama . '.id_kotama');
        $this->db->group_by($this->master_golongan_pangkat . '.id_golongan');
        $this->db->order_by($this->master_kotama . '.kode_kotama', 'asc');
        $this->db->order_by($this->master_golongan_pangkat . '.id_golongan', 'desc');
        $query = $this->db->get($this->master_kotama);
//        echo $this->db->last_query();
//        var_dump($query->result());
//        exit();
        return $this->arrange_satkowil_by_kotama_and_golongan($query->result());
    }

    public function arrange_satkowil_by_kotama_and_golongan($records = FALSE) {
        $result = array();
        if ($records) {
            foreach ($records as $record) {
                $result[$record->ur_kotama][] = array(
                    'golongan' => $record->kode_golongan,
                    'top' => $record->top,
                    'nyata' => $record->nyata
                );
            }
        }
//        var_dump($result);
//        exit();
        return $result;
    }

    public function get_satkowil_by_satminkal_and_golongan($bulan = 1, $tahun = 2014) {
        $this->db->select($this->master_kotama . '.ur_kotama');
        $this->db->select($this->master_satminkal . '.ur_satminkal');
        $this->db->select($this->master_golongan_pangkat . '.kode_golongan');
        $this->db->select_sum($this->tr_pasukan_detail . '.top');
        $this->db->select_sum($this->tr_pasukan_detail . '.dinas + ' . $this->tr_pasukan_detail . '.mpp + ' . $this->tr_pasukan_detail . '.lf + ' . $this->tr_pasukan_detail . '.skorsing', 'nyata');
        $this->db->join($this->master_satminkal, $this->master_satminkal . '.id_kotama=' . $this->master_kotama . '.id_kotama');
        $this->db->join($this->tr_pasukan_detail, $this->tr_pasukan_detail . '.id_satminkal=' . $this->master_satminkal . '.id_satminkal');
        $this->db->join($this->tr_pasukan_rekap, $this->tr_pasukan_rekap . '.id_rekap=' . $this->tr_pasukan_detail . '.id_rekap');
        $this->db->join($this->master_pangkat, $this->master_pangkat . '.id_pangkat=' . $this->tr_pasukan_detail . '.id_pangkat');
        $this->db->join($this->master_golongan_pangkat, $this->master_golongan_pangkat . '.id_golongan=' . $this->master_pangkat . '.id_golongan');
        $this->db->where($this->tr_pasukan_rekap . '.id_bulan', $bulan);
        $this->db->where($this->tr_pasukan_rekap . '.id_tahun', $tahun);
        $this->db->where($this->master_golongan_pangkat . '.id_golongan < 4');
        $this->db->where_in($this->master_satminkal . '.id_kesatuan', array(6, 7));
        $this->db->group_by($this->master_kotama . '.id_kotama');
        $this->db->group_by($this->master_satminkal . '.id_satminkal');
        $this->db->group_by($this->master_golongan_pangkat . '.id_golongan');
        $this->db->order_by($this->master_kotama . '.kode_kotama', 'asc');
        $this->db->order_by($this->master_golongan_pangkat . '.id_golongan', 'desc');
        $query = $this->db->get($this->master_kotama);
//        echo $this->db->last_query();
//        var_dump($query->result());
//        exit();
        return $this->arrange_satkowil_by_satminkal_and_golongan($query->result());
    }

    public function arrange_satkowil_by_satminkal_and_golongan($records = FALSE) {
        $result = array();
        if ($records) {
            foreach ($records as $record) {
                $result[$record->ur_kotama][$record->ur_satminkal][] = array(
                    'golongan' => $record->kode_golongan,
                    'top' => $record->top,
                    'nyata' => $record->nyata
                );
            }
        }
//        var_dump($result);
//        exit();
        return $result;
    }

}

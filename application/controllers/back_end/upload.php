<?php
class upload extends CI_Controller
{
        
    function index()
    {
        $this->load->view('back_end/upload/form_upload');
    }
    
    
    function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xls|xlsx';
	$config['max_size']	= '1000'; // kb
	$this->load->library('upload', $config);
        $this->upload->do_upload();
        $hasil=$this->upload->data();
        $data=array('nama_file'=>$hasil['file_name'],'ukuran'=>$hasil['file_size']);
        $this->db->insert('transaksi_upload',$data);
                
    }
}
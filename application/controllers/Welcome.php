<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public $res = [['snack'=>'Biskuit','harga'=>7000, 'stok'=>7],
					['snack'=>'Oreo','harga'=>9800, 'stok'=>8], 
					['snack'=>'Chips','harga'=>8500, 'stok'=>12], 
					['snack'=>'Tanggo','harga'=>7500, 'stok'=>12], 
					['snack'=>'Coklat','harga'=>14500, 'stok'=>9]];
	
	public $pecahan = ['2000', '5000', '10000', '20000', '50000'];

	public function index()
	{
		$result['snacks'] = $this->res;
		$this->load->view('welcome_message', $result);
	}

	public function bayar() {
		$val = $this->input->post('snack');
		$bayar = $this->input->post('bayar');

		foreach ($this->res as $s) {
			if ($s['snack'] === $val) {
				$harga = $s['harga'];
				$stok = $s['stok'];
			}
		}

		if (!in_array($bayar, $this->pecahan)) {
			echo json_encode("Uang pecahan tidak diterima!");
			exit;
		}
		
		if ($stok != 0){
			if ($bayar < $harga){
				echo json_encode("Uang anda tidak cukup!");
			}else{
				$hasil = $bayar - $harga;
				if($hasil == 0){
					echo json_encode("Terima kasih telah membeli");
				}else{
					echo json_encode("Terima kasih telah membeli, uang kembalian anda ". $hasil);
				}
			}
		}else{
			echo json_encode("Sorry, stok abis");
		}

		

	}

	public function test() {
		echo "alief jelek";
	}
}

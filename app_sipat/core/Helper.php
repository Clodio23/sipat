<?php

/**
 * 
 */
class Helper
{

	public function get_cookie($key)
	{
		if( isset($_COOKIE[$key]) ) {
			return $_COOKIE[$key];
		} else {
			return false;
		}
	}
	public function set_cookie($data)
	{
		setcookie($data['cookie_name'], $data['cookie_value'], time() + (60 * 60), "/");
							
	}

	public function unset_cookie($data)
	{
		setcookie($data['cookie_name'], $data['cookie_value'], time() - 3600);
	}

	public function get_session($data)
	{
		if (!empty($_SESSION[$data])) {
			return $_SESSION[$data];
		} else {
			return false;
		}
	}

	public function set_session($data)
	{
		foreach ($data as $key => $value) {
			$_SESSION[$key] = $value;
		}
	}

	public function unset_session()
	{
		unset($_SESSION);
	}

	public function destroy_session()
	{
		session_destroy();
	}

	public function is_login()
	{
		if ($this->get_session('iduser')) {
			return true;
		} else {
			return false;
		}
	}

	public function redirect($uri)
	{
		return header('location:' . $uri);
	}


	public function getjk($data)
	{
		switch ($data) {
			case 'L':
				return "Laki-laki";
				break;
			case 'P':
				return "Perempuan";
				break;
			default:
				return "Tidak diisi";
				break;
		}
	}

	public function gettgl($data)
	{
		$tgl = substr($data, 8, 2);
		$bln = substr($data, 5, 2);
		$thn = substr($data, 0, 4);

		switch ($bln) {
			case '01':
				$bln = "Januari";
				break;
			case '02':
				$bln = "Februari";
				break;
			case '03':
				$bln = "Maret";
				break;
			case '04':
				$bln = "April";
				break;
			case '05':
				$bln = "Mei";
				break;
			case '06':
				$bln = "Juni";
				break;
			case '07':
				$bln = "Juli";
				break;
			case '08':
				$bln = "Agustus";
				break;
			case '09':
				$bln = "September";
				break;
			case '10':
				$bln = "Oktober";
				break;
			case '11':
				$bln = "November";
				break;
			case '12':
				$bln = "Desember";
				break;
			default:
				$bln = "tidak ditentukan";
				break;
		}
		return $tgl . " " . $bln . " " . $thn;
	}

	public function gettglwithtime($data)
	{
		$tgl = substr($data, 8, 2);
		$bln = substr($data, 5, 2);
		$thn = substr($data, 0, 4);
		$pukul = substr($data, 11);

		switch ($bln) {
			case '01':
				$bln = "Januari";
				break;
			case '02':
				$bln = "Februari";
				break;
			case '03':
				$bln = "Maret";
				break;
			case '04':
				$bln = "April";
				break;
			case '05':
				$bln = "Mei";
				break;
			case '06':
				$bln = "Juni";
				break;
			case '07':
				$bln = "Juli";
				break;
			case '08':
				$bln = "Agustus";
				break;
			case '09':
				$bln = "September";
				break;
			case '10':
				$bln = "Oktober";
				break;
			case '11':
				$bln = "November";
				break;
			case '12':
				$bln = "Desember";
				break;
			default:
				$bln = "tidak ditentukan";
				break;
		}
		return $tgl . " " . $bln . " " . $thn . " pukul " . $pukul;
	}

	public function getterbilang($nilai)
	{
		$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		if ($nilai == 0) {
			return "";
		} elseif ($nilai < 12 & $nilai != 0) {
			return "" . $huruf[$nilai];
		} elseif ($nilai < 20) {
			return $this->getterbilang($nilai - 10) . " Belas ";
		} elseif ($nilai < 100) {
			return $this->getterbilang($nilai / 10) . " Puluh " . $this->getterbilang($nilai % 10);
		} elseif ($nilai < 200) {
			return " Seratus " . $this->getterbilang($nilai - 100);
		} elseif ($nilai < 1000) {
			return $this->getterbilang($nilai / 100) . " Ratus " . $this->getterbilang($nilai % 100);
		} elseif ($nilai < 2000) {
			return " Seribu " . $this->getterbilang($nilai - 1000);
		} elseif ($nilai < 1000000) {
			return $this->getterbilang($nilai / 1000) . " Ribu " . $this->getterbilang($nilai % 1000);
		} elseif ($nilai < 1000000000) {
			return $this->getterbilang($nilai / 1000000) . " Juta " . $this->getterbilang($nilai % 1000000);
		} elseif ($nilai < 1000000000000) {
			return $this->getterbilang($nilai / 1000000000) . " Milyar " . $this->getterbilang($nilai % 1000000000);
		} elseif ($nilai < 100000000000000) {
			return $this->getterbilang($nilai / 1000000000000) . " Trilyun " . $this->getterbilang($nilai % 1000000000000);
		} elseif ($nilai <= 100000000000000) {
			return "Maaf Tidak Dapat di Prose Karena Jumlah nilai Terlalu Besar ";
		}
	}

	// untuk validasi nama file
	// filenname('nama_file', 'ekstensi_yg_diijinkan')
	public function getfileekstensi($file, $key)
	{
		$name = $_FILES[$file]['name'];
		$jenis = explode('.', $name);
		$ekstensi = strtolower(end($jenis));
		
		if ($ekstensi != $key) {
			return true;
		}else {
			return false;
		}
	}

	// untuk validasi nama file
	// filensize('nama_file', 'ekstensi_yg_diijinkan')
	public function getfilesize($file, $key)
	{
		$size = $_FILES[$file]['size'];
		if ($size > $key) {
			return true;
		} else {
			return false;
		}
	}

	// untuk mendapatkan nama file
	// getfilename(name_file)
	public function getfilename($key)
	{
		$key = htmlspecialchars($key);
		$file = $_FILES[$key]['name'];
		$ekstensi = explode('.', $file);
		$ekstensi = strtolower(end($ekstensi));
		// generate nama file baru
		$newfilename = uniqid();
		$newfilename .= '.';
		$newfilename .= $ekstensi;
		return $newfilename;
	}

	// untuk mengupload file 
	// getfileupload(file_name, lokasi_file)
	public function uploadfile($key, $lokasi, $filename)
	{
		$destination_path = getcwd() . DIRECTORY_SEPARATOR;
		$key = htmlspecialchars($key);
		$file = $_FILES[$key]['name'];
		$ekstensi = explode('.', $file);
		$ekstensi = strtolower(end($ekstensi));
		$tmpname = $_FILES[$key]['tmp_name'];
		// generate nama file baru
		$newfilename = $key."-".$filename;
		$newfilename .= '.';
		$newfilename .= $ekstensi;
		$target_path = $destination_path . 'files/' . $lokasi . '/' . basename($newfilename);
		// lolos pengecekan, fle siap diuploud
		move_uploaded_file($tmpname, $target_path);
		return $newfilename;
	}

	// untuk cek file di upload atau tidak
	public function getfileerror($key)
	{
		$file = $_FILES[$key]['error'];
		if ($file === 4) {
			return true;
		} else {
			return false;
		}
	}

	// validasi hanya memperbolehkan huruf yang di uplouad
	public function gethuruf($key)
	{
		$string = $_POST[$key];
		return preg_replace("/[^a-zA-Z]/", " ", $string);
	}

	// validasi hanya memperbolehkan angka yang di uplouad
	public function getangka($key)
	{
		$string = $_POST[$key];
		return preg_replace("/[^0-9]/", "", $string);
	}

	// // validasi hanya memperbolehkan huruf dan angka yang di uplouad
	// public function getstring($key)
	// {
	// 	$string = $_POST[$key];
	// 	return preg_replace("/[^a-zA-Z0-9]/", "", $string);
	// }

	// validasi untuk membersihkan karakter aneh
	public function getString($key)
	{
		return htmlspecialchars($_POST[$key]);
		// $string = preg_replace("/[^a-zA-Z0-9,.]/", "", $string);
		// return array($key => $string);
	}

	public function generatePassword()
	{
		return rand(111111,999999);
	}

	public function getmenu($key)
	{
		switch ($key) {
			case '30':
				$menu = '<li class="nav-item">
							<a href="'.BASEURL.'/Sarjana" class="nav-link">Petunjuk</a>
						</li>
						<li class="nav-item">
							<a href="'.BASEURL.'/Sarjana/foto" class="nav-link">Unggah Foto</a>
						</li>
						<li class="nav-item">
							<a href="'.BASEURL.'/Sarjana/lokasi" class="nav-link">Pilih Lokasi Ujian</a>
						</li>
						<li class="nav-item">
							<a href="'.BASEURL.'/Sarjana/prodi" class="nav-link">Pilih Program Studi</a>
						</li>
						<li class="nav-item">
							<a href="'.BASEURL.'/Sarjana/parmanen" class="nav-link">Parmanen Data dan Cetak Kartu</a>
						</li>';
				break;
			
			default:
				# code...
				break;
		}
		return $menu;
	}
}

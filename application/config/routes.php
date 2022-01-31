<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'C_AkunPuskesmas';
$route['404_override'] = 'controllererror';
$route['translate_uri_dashes'] = FALSE;

//BERANDA SISTEM
$route['beranda_eoffice'] = 'fajar/controllerprofil';

$route['beranda_siputri_hebat'] = 'fajar/controllerprofil';

$route['menu_master_data'] = 'fajar/controllerprofil';
$route['menu_puskesmas'] = 'fajar/controllerprofil';
$route['menu_laporan'] = 'fajar/controllerprofil';
$route['rekap_data'] = 'fajar/controllerprofil';

//MASTER DATA
$route['akun_puskesmas'] = 'C_AkunPuskesmas';

$route['puskesmas'] = 'C_Puskesmas';
$route['add_puskesmas'] = 'C_Puskesmas/add_puskesmas';
$route['edit_puskesmas'] = 'C_Puskesmas/edit_puskesmas';

$route['kategori_obat'] = 'C_KategoriObat';
$route['add_kategori_obat'] = 'C_KategoriObat/add_kategori_obat';
$route['edit_kategori_obat'] = 'C_KategoriObat/edit_kategori_obat';

$route['golongan_obat'] = 'C_GolonganObat';
$route['add_golongan_obat'] = 'C_GolonganObat/add_golongan_obat';
$route['edit_golongan_obat'] = 'C_GolonganObat/edit_golongan_obat';

$route['cara_pakai_obat'] = 'C_CaraPakaiObat';
$route['add_cara_pakai_obat'] = 'C_CaraPakaiObat/add_cara_pakai_obat';
$route['edit_cara_pakai_obat'] = 'C_CaraPakaiObat/edit_cara_pakai_obat';

$route['obat'] = 'C_Obat';
$route['detail_obat'] = 'C_Obat/detail_obat';

$route['tarif/tarif_layanan'] = 'C_DataTarif/tarif_layanan';
$route['tarif/tarif_tindakan'] = 'C_DataTarif/tarif_tindakan';
$route['tarif/tarif_lab'] = 'C_DataTarif/tarif_lab';
//manage puskesmas
$route['manage_puskesmas/layanan_puskesmas'] = 'C_DataManagePuskesmas/layanan_puskesmas';
$route['manage_puskesmas/petugas'] = 'C_DataManagePuskesmas/petugas';
$route['manage_puskesmas/dokter'] = 'C_DataManagePuskesmas/dokter';
$route['manage_puskesmas/estimasi_waktu'] = 'C_DataManagePuskesmas/estimasi_waktu';
$route['manage_puskesmas/pasien'] = 'C_DataManagePuskesmas/pasien';
$route['manage_puskesmas/video_antrian'] = 'C_DataManagePuskesmas/video_antrian';

//PUSKESMAS
//pendaftaran
$route['pendaftaran_antrian'] = 'fajar/controllerprofil';
$route['pendaftaran_poliklinik'] = 'fajar/controllerprofil';
//pemeriksaan
$route['pemeriksaan_fisik'] = 'fajar/controllerprofil';
$route['pemeriksaan_dokter'] = 'fajar/controllerprofil';
//kasir
$route['kasir'] = 'fajar/controllerprofil';
//apotek
$route['penyerahan_resep'] = 'fajar/controllerprofil';
$route['request_obat'] = 'fajar/controllerprofil';
$route['penerimaan_obat'] = 'fajar/controllerprofil';
$route['stock_obat'] = 'fajar/controllerprofil';
$route['item_adjustment'] = 'fajar/controllerprofil';
//gudang obat
$route['stock_obat'] = 'fajar/controllerprofil';
$route['purchase_order'] = 'fajar/controllerprofil';
$route['receive_order'] = 'fajar/controllerprofil';
$route['mutasi_obat'] = 'fajar/controllerprofil';
$route['item_adjustment'] = 'fajar/controllerprofil';
//laboratorium
$route['pemeriksaan_pasien'] = 'fajar/controllerprofil';

//REKAP DATA
$route['rekap_diagnosa'] = 'fajar/controllerprofil';
$route['sensus_harian_pasien'] = 'fajar/controllerprofil';
$route['rekap_kunjungan_pasian'] = 'fajar/controllerprofil';
$route['kunjungan_jenis_pasien'] = 'fajar/controllerprofil';

//USERS
$route['users'] = 'fajar/controllerprofil';
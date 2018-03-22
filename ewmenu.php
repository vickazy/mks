<?php

// Menu
$RootMenu = new cMenu("RootMenu", TRUE);
$RootMenu->AddMenuItem(6, "mi_cf01_home_php", $Language->MenuPhrase("6", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{EC8C353E-21D9-43CE-9845-66794CB3C5CD}cf01_home.php'), FALSE, TRUE, "");
$RootMenu->AddMenuItem(1, "mi_t01_master_sekolah", $Language->MenuPhrase("1", "MenuText"), "t01_master_sekolahlist.php", -1, "", AllowListMenu('{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t01_master_sekolah'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(17, "mci_RKAS", $Language->MenuPhrase("17", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(18, "mci_RPU", $Language->MenuPhrase("18", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(19, "mci_Buku_Kas_BOS_26_Pembantu_Tunai", $Language->MenuPhrase("19", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(20, "mci_Buku_Transparansi_Dana_BOS", $Language->MenuPhrase("20", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(21, "mci_Buku_Kas_Umum_26_Pembantu_Bank", $Language->MenuPhrase("21", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(22, "mci_Buku_Kas_DOS_26_Laporan_Keuangan", $Language->MenuPhrase("22", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(23, "mci_Jadwal_Kegiatan_Pelaksanaan_Keuangan", $Language->MenuPhrase("23", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(12, "mci_Setup", $Language->MenuPhrase("12", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(30, "mci_RKAS", $Language->MenuPhrase("30", "MenuText"), "", 12, "", TRUE, FALSE, TRUE, "");
$RootMenu->AddMenuItem(24, "mi_t02_rkas01", $Language->MenuPhrase("24", "MenuText"), "t02_rkas01list.php", 30, "", AllowListMenu('{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t02_rkas01'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(31, "mi_t03_rkas02", $Language->MenuPhrase("31", "MenuText"), "t03_rkas02list.php", 30, "", AllowListMenu('{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t03_rkas02'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(32, "mi_t04_rkas03", $Language->MenuPhrase("32", "MenuText"), "t04_rkas03list.php", 30, "", AllowListMenu('{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t04_rkas03'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(5, "mi_t96_employees", $Language->MenuPhrase("5", "MenuText"), "t96_employeeslist.php", 12, "", AllowListMenu('{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t96_employees'), FALSE, FALSE, "");
$RootMenu->AddMenuItem(3, "mi_t97_userlevels", $Language->MenuPhrase("3", "MenuText"), "t97_userlevelslist.php", 12, "", IsAdmin(), FALSE, FALSE, "");
$RootMenu->AddMenuItem(2, "mi_t99_audit_trail", $Language->MenuPhrase("2", "MenuText"), "t99_audit_traillist.php", 12, "", AllowListMenu('{EC8C353E-21D9-43CE-9845-66794CB3C5CD}t99_audit_trail'), FALSE, FALSE, "");
echo $RootMenu->ToScript();
?>
<div class="ewVertical" id="ewMenu"></div>
<?php 

function rupiahFormat($angka = 0) {
    return 'Rp. ' . number_format(intval($angka), 0, '', '.') . ',-';
}
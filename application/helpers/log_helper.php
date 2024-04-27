<?php
function cek_login()
{
    $ci = &get_instance();
    if (!$ci->session->userdata('username')) {
        redirect('auth');
    }
}
function cek_role()
{
    $ci = &get_instance();
    if ($ci->session->userdata('roleId') != 1) {
        redirect('auth');
    }
}

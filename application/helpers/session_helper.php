<?php

function cek_session()
{
    $cek = get_instance();
    if (!$cek->session->userdata('username')) {
        redirect('Auth');
    }
}

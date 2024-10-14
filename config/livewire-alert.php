<?php

/*
 * For more details about the configuration, see:
 * https://sweetalert2.github.io/#configuration
 */
return [
    'alert'   => [
        'position'           => 'center',
        'toast'              => false,
        'timer'              => null,
        'text'               => null,
        'reverseButtons'     => true,
        'allowOutsideClick'  => false,
        'heightAuto'         => false,
        'showCancelButton'   => false,
        'showConfirmButton'  => true,
        'confirmButtonText'  => 'OK',
        'confirmButtonColor' => '#3085d6',
        'cancelButtonColor'  => '#d33',
    ],
    'confirm' => [
        'icon'               => 'warning',
        'position'           => 'center',
        'toast'              => false,
        'timer'              => null,
        'showConfirmButton'  => true,
        'showCancelButton'   => true,
        'allowOutsideClick'  => false,
        'reverseButtons'     => true,
        'heightAuto'         => false,
        'confirmButtonText'  => 'Yakin',
        'cancelButtonText'   => 'Batal',
        'confirmButtonColor' => '#0054a6',
        'cancelButtonColor'  => '#d63939',
    ],
];

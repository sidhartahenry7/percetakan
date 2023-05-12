<?php

namespace App\Policies;

use App\Models\pegawai;
use App\Models\penggunaan_bahan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PenggunaanBahanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(pegawai $pegawai)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @param  \App\Models\penggunaan_bahan  $penggunaanBahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(pegawai $pegawai, penggunaan_bahan $penggunaanBahan)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(pegawai $pegawai)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @param  \App\Models\penggunaan_bahan  $penggunaanBahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(pegawai $pegawai, penggunaan_bahan $penggunaanBahan)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @param  \App\Models\penggunaan_bahan  $penggunaanBahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(pegawai $pegawai, penggunaan_bahan $penggunaanBahan)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @param  \App\Models\penggunaan_bahan  $penggunaanBahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(pegawai $pegawai, penggunaan_bahan $penggunaanBahan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @param  \App\Models\penggunaan_bahan  $penggunaanBahan
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(pegawai $pegawai, penggunaan_bahan $penggunaanBahan)
    {
        //
    }
}

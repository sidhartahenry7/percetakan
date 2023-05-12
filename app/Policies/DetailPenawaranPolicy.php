<?php

namespace App\Policies;

use App\Models\detail_penawaran;
use App\Models\pegawai;
use Illuminate\Auth\Access\HandlesAuthorization;

class DetailPenawaranPolicy
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
     * @param  \App\Models\detail_penawaran  $detailPenawaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(pegawai $pegawai, detail_penawaran $detailPenawaran)
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
     * @param  \App\Models\detail_penawaran  $detailPenawaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(pegawai $pegawai, detail_penawaran $detailPenawaran)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @param  \App\Models\detail_penawaran  $detailPenawaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(pegawai $pegawai, detail_penawaran $detailPenawaran)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @param  \App\Models\detail_penawaran  $detailPenawaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(pegawai $pegawai, detail_penawaran $detailPenawaran)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @param  \App\Models\detail_penawaran  $detailPenawaran
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(pegawai $pegawai, detail_penawaran $detailPenawaran)
    {
        //
    }
}

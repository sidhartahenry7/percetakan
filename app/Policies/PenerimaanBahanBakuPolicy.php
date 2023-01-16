<?php

namespace App\Policies;

use App\Models\pegawai;
use App\Models\penerimaan_bahan_baku;
use Illuminate\Auth\Access\HandlesAuthorization;

class PenerimaanBahanBakuPolicy
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
     * @param  \App\Models\penerimaan_bahan_baku  $penerimaanBahanBaku
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(pegawai $pegawai, penerimaan_bahan_baku $penerimaanBahanBaku)
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
     * @param  \App\Models\penerimaan_bahan_baku  $penerimaanBahanBaku
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(pegawai $pegawai, penerimaan_bahan_baku $penerimaanBahanBaku)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @param  \App\Models\penerimaan_bahan_baku  $penerimaanBahanBaku
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(pegawai $pegawai, penerimaan_bahan_baku $penerimaanBahanBaku)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @param  \App\Models\penerimaan_bahan_baku  $penerimaanBahanBaku
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(pegawai $pegawai, penerimaan_bahan_baku $penerimaanBahanBaku)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @param  \App\Models\penerimaan_bahan_baku  $penerimaanBahanBaku
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(pegawai $pegawai, penerimaan_bahan_baku $penerimaanBahanBaku)
    {
        //
    }
}

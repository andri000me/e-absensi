<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Cetak Laporan</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="<?php base_url(); ?>home">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cetak laporan</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">

        <!-- <div class="container-fluid"> -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <?php
                     if (isset($data_mkterkini)) : ?>
                    <div class="card-body">
                        <h5 class="card-title">DATA AJAR TERKINI (
                            <?php echo $thnAjar; ?>)</h5>
                        <div class="table-responsive">
                            <table id="" class="table table-striped table-bordered">
                                <thead class="text">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">ID Makul</th>
                                        <th>Nama Makul</th>
                                        <th class="text-center">Program Studi</th>
                                        <th class="text-center">KELAS</th>
                                        <th class="text-center">SEMESTER</th>
                                        <th class="text-center" id="icons"> <span class="m-r-10 mdi mdi-printer"></span> Cetak</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data_mkterkini as $value) : ?>
                                    <tr>
                                        <td class="text-center">
                                            <?php echo $no; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $value->IDMAKUL; ?>
                                        </td>
                                        <td>
                                            <!-- <a href="<?php echo base_url(); ?>makul/detail/<?php echo $value->IDMAKUL; ?>/<?php echo $value->THSHM; ?>/<?php echo $value->IDPRODI; ?>/<?php echo $value->NAMAKLS; ?>/<?php echo $value->SEMESTER; ?>"> -->
                                            <b>
                                                <?php echo $value->NAMAMK; ?></b></a>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $value->NMPSTMSPST; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                             if ($value->NAMAKLS == 01) {
                                                $kelas = "A";
                                             } elseif ($value->NAMAKLS == 02) {
                                                $kelas = "B";
                                             } else {
                                                $kelas = "NR";
                                             }
                                             echo $kelas;
                                             ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $value->smt; ?>
                                        </td>
                                        <td>
                                            <div class="text-center span12 btn-icon-pg">
                                                <a class="btn btn-primary btn-mini" href="<?php echo base_url() ?>absen/print_absen/<?php echo $value->IDMAKUL; ?>/<?php echo $value->THSHM; ?>/<?php echo $value->IDPRODI; ?>/<?php echo $value->NAMAKLS; ?>/<?php echo $value->SEMESTER; ?>"><i class="icon-print"></i><span class="m-r-10 mdi mdi-printer"></span> Absensi Mahasiswa</a>
                                                <a class="btn btn-primary btn-mini" href="<?php echo base_url() ?>absen/brt_acara/<?php echo $value->IDMAKUL; ?>/<?php echo $value->THSHM; ?>/<?php echo $value->IDPRODI; ?>/<?php echo $value->NAMAKLS; ?>/<?php echo $value->SEMESTER; ?>"><i class="icon-print"></i><span class="m-r-10 mdi mdi-printer"></span> Berita Acara</a>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" href="<?php echo base_url() ?>absen/edit_laporan/<?php echo $value->IDMAKUL; ?>/<?php echo $value->THSHM; ?>/<?php echo $value->IDPRODI; ?>/<?php echo $value->NAMAKLS; ?>/<?php echo $value->SEMESTER; ?>"><i class="icon-print"></i><span class="m-r-10 fas fa-edit"></span> Edit</a>
                                        </td>
                                    </tr>
                                    <?php $no++;
                                 endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php endif;
                     echo $this->session->flashdata("msg"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div> 
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Profil Dosen</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profl Saya</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($DataProfil)) {
        foreach ($DataProfil as $value);
        $namaDos = 'value="' . $value->NAMADOS . '"';
        $prodiDos = $value->PRODIDOS;
        $keahlian = $value->KEAHLIAN;
        if ($value->PRODIDOS != '') {
            $ketpic = '*';
            $picture = "";
        } else {
            $ketpic = '';
            $picture = 'required';
        }
    } ?>
    <!-- <p><?= $value->PICTURE; ?></p>
    <img src="<?= base_url(); ?>img/<?= $value->PICTURE; ?>" alt=""> -->
    <!-- sl -->
    <!--Action boxes-->

    <div class="container-fluid">
        <div class="row-fluid el-element-overlay">
            <div class="card float-left mr-3" style="width:15rem">
                <img src="<?= base_url(); ?>img/<?= $value->PICTURE; ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title text-center"><?= $value->NAMADOS; ?> </h5>
                    <p class="card-text text-center"> (<?= $value->NAMAPRODIDOS; ?>)</p>
                    <div class="text-center">
                        <!-- <i class="mdi mdi-facebook mr-1" style="font-size:25px"></i>
                        <i class="mdi mdi-twitter mr-1" style="font-size:25px"></i>
                        <i class="mdi mdi-instagram mr-1" style="font-size:25px"></i>
                        <i class="mdi mdi-youtube-play" style="font-size:25px"></i> -->
                        <!-- <a href="#" class="btn btn-primary ">Go somewhere</a> -->
                    </div>
                </div>
            </div>
            <div class="card col-md-10">
                <div class="card-body">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                            <h5>PROFIL SAYA</h5>
                        </div>
                        <hr>
                        <div class="widget-content">
                            Jika data profil anda belum muncul/belum lengkap siahkan pilih/klik tombol <b>sinkronisasi</b> pada link berikut.
                            <a class="ml-3" href="<?php echo base_url(); ?>home/sinkronisasi"><button class="btn btn-info btn-mini">Sinkronisasi >></button></a>
                            <hr>
                            <?php
                            if (isset($DataProfil)) { ?>
                            <form enctype="multipart/form-data" action="<?php echo base_url(); ?>home/actprofil" method="POST" class="form-horizontal">
                                <div class="form-group row mt-4">
                                    <label for="fname" class="col-sm-2 text-left control-label col-form-label">Nama *</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="fname" name="NamaDos" placeholder="Nama Dosen" <?php echo $namaDos; ?> style="width:50%" required>
                                    </div>
                                </div>
                                <div class="form-group row mt-4">
                                    <label for="fname" class="col-sm-2 text-left control-label col-form-label">Gambar </label>
                                    <div class="controls col-sm-9">
                                        <input type="file" name="picture" <?php echo $picture; ?> />
                                        <span class="help-block">Format dokumen harus berformat jpg/png max 1mb.</span>
                                    </div>
                                </div>
                                <div class="form-group row mt-4">
                                    <label for="fname" class="col-sm-2 text-left control-label col-form-label">Keahlian/Bidang Ilmu</label>
                                    <div class="col-sm-9">
                                        <textarea type="text" class="form-control" id="fname" name="keahlian" placeholder="Nama Dosen" style="width:70%; height:150px" required><?php echo $keahlian; ?></textarea>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form>
                            <?php 
                        } ?>
                        </div>
                    </div>
                    <?php
                    echo $this->session->flashdata("msg"); ?>
                </div>
            </div>
        </div>
    </div>
</div> 
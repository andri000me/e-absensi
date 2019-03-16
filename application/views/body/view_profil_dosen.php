<!--main-container-part-->
<div id="content">
    <!--breadcrumbs-->
    <div id="content-header">
        <div id="breadcrumb">
            <a href="<?php echo base_url(); ?>home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
            <a class="current">My Profile</a>
        </div>
    </div>
    <!--End-breadcrumbs-->

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
    <!--Action boxes-->
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>PROFIL DOSEN</h5>
                    </div>
                    <div class="widget-content">
                        Jika data profil anda belum muncul/belum lengkap siahkan pilih/klik tombol <b>sinkronisasi</b> pada link berikut. <a href="<?php echo base_url(); ?>home/sinkronisasi"><button class="btn btn-info btn-mini">Sinkronisasi >></button></a><?php
																																																																																																																																if (isset($DataProfil)) { ?>
                        <form enctype="multipart/form-data" action="<?php echo base_url(); ?>home/actprofil" method="POST" class="form-horizontal">
                            <div class="control-group">
                                <label class="control-label">Nama *</label>
                                <div class="controls">
                                    <input type="text" class="span6" name="NamaDos" placeholder="Nama Dosen" <?php echo $namaDos; ?>required />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Gambar </label>
                                <div class="controls">
                                    <input type="file" name="picture" <?php echo $picture; ?> />
                                    <span class="help-block">Format dokumen harus berformat jpg/png max 1mb. Dimensi 64x64.</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Keahlian/Bidang Ilmu</label>
                                <div class="controls">
                                    <textarea class="textarea_editor span7" name="keahlian" rows="3" placeholder="Enter text ..."><?php echo $keahlian; ?></textarea>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form><?php

															} ?>
                    </div>
                </div><?php
											echo $this->session->flashdata("msg"); ?>
            </div>
        </div>
    </div>
</div>
<!--end-main-container-part--> 
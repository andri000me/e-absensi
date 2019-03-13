<div class="page-wrapper">
    <?php
    if (isset($data_mk)) {
        foreach ($data_mk as $value); ?>
    <div id="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Form Basic</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?php echo base_url(); ?>home">
                                    Home</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url(); ?>makul/view/<?php echo $thnAjarInt; ?>" class="breadcrumb-item active">
                                    <?php echo $thnAjar; ?></a></li>
                            <?php
                            if ($this->input->get('pertemuan')) { ?>
                            <li class="breadcrumb-item" aria-current="page"><a href="<?php echo base_url(); ?>makul/detail/<?php echo $value->IDMAKUL; ?>/<?php echo $value->THSHM; ?>/<?php echo $value->IDPRODI; ?>/<?php echo $value->NAMAKLS; ?>/<?php echo $value->SEMESTER; ?>" class="tip-bottom">
                                    <?php echo $value->IDMAKUL; ?> -
                                    <?php echo $value->NAMAMK; ?></a></li>
                            <?php
                            if ($this->input->get('act') && $this->input->get('act') == "absendos") { ?>
                            <li class="breadcrumb-item"><a href="<?php echo current_url() . '?pertemuan=' . trim($this->security->xss_clean($this->input->get('pertemuan'))); ?>">Pertemuan
                                    <?php echo trim($this->security->xss_clean($this->input->get('pertemuan'))); ?> </a></li>
                            <li class="breadcrumb-item"><a href="<?php echo current_url() . '?pertemuan=' . trim($this->security->xss_clean($this->input->get('pertemuan'))); ?>&act=absendos" class="current">Berita Acara</a></li>
                            <?php

                        } else { ?>
                            <li class="breadcrumb-item"><a href="<?php echo current_url() . '?pertemuan=' . trim($this->security->xss_clean($this->input->get('pertemuan'))); ?>" class="current">Pertemuan
                                    <?php echo trim($this->security->xss_clean($this->input->get('pertemuan'))); ?> </a></li>
                            <?php

                        }
                    } else { ?>
                            <li class="breadcrumb-item"><a href="<?php echo current_url(); ?>" class="tip-bottom">
                                    <?php echo $value->IDMAKUL; ?> -
                                    <?php echo $value->NAMAMK; ?></a></li>
                            <?php

                        } ?>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                        <h5>
                            <?php echo $value->IDMAKUL; ?> -
                            <?php echo $value->NAMAMK; ?>
                        </h5>
                    </div>
                    <div class="widget-content">
                        Silahkan pilih pertemuan 1-16 untuk mengelola bahan ajar untuk Mata Kuliah <b>
                            <?php echo $value->IDMAKUL; ?> -
                            <?php echo $value->NAMAMK; ?></b>
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"><i class="icon-ok"></i></span>
                                <h5>PERTEMUAN</h5>
                            </div>
                            <div class="widget-content">
                                <form action="<?php echo base_url(); ?>makul/detail/<?php echo $value->IDMAKUL; ?>/<?php echo $value->THSHM; ?>/<?php echo $value->IDPRODI; ?>/<?php echo $value->NAMAKLS; ?>/<?php echo $value->SEMESTER; ?>" method="GET" class="form-horizontal">
                                    <div class="control-group">
                                        <label class="control-label">Pilih Pertemuan</label>
                                        <div class="controls">
                                            <?php
                                            echo form_dropdown('pertemuan', $Pertemuan, trim($this->security->xss_clean($this->input->get('pertemuan'))), 'onchange="this.form.submit()"'); ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                        if ($this->input->get('pertemuan') && $this->input->get('act') && $this->input->get('act') == "absendos") { ?>
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                                <h5>ENTRI BERITA ACARA PERTEMUAN
                                    <?php echo trim($this->security->xss_clean($this->input->get('pertemuan'))); ?>
                                </h5>
                            </div>
                            <div class="widget-content">
                                <form action="<?php echo base_url(); ?>absen/dosenact/<?php echo trim($this->security->xss_clean($this->input->get('pertemuan'))); ?>" method="POST" class="form-horizontal">
                                    <?php
                                    echo form_hidden('idmakul', trim($this->security->xss_clean($this->uri->segment(3))));
                                    echo form_hidden('thnsm', trim($this->security->xss_clean($this->uri->segment(4))));
                                    echo form_hidden('idprodi', trim($this->security->xss_clean($this->uri->segment(5))));
                                    echo form_hidden('kls', trim($this->security->xss_clean($this->uri->segment(6))));
                                    echo form_hidden('smt', trim($this->security->xss_clean($this->uri->segment(7))));
                                    echo form_hidden('pertemuan', trim($this->security->xss_clean($this->input->get('pertemuan'))));
                                    echo form_hidden('hadir', $JlhMhsHadir);
                                    echo form_hidden('absen', $JlhMhsAbsen);
                                    if (isset($GetAbsenDos)) {
                                        foreach ($GetAbsenDos as $value);
                                        $TGL = 'value="' . $value->TGL . '"';
                                        $JM = 'value="' . $value->JM . '"';
                                        $JK = 'value="' . $value->JK . '"';
                                        $MATERI = $value->MATERI;
                                        $METODE = json_decode($value->METODE, true);
                                        $TUGAS = $value->TUGAS;
                                    } else {
                                        $TGL = $JM = $JK = $MATERI = $TUGAS = "";
                                        $dummy_arr = '[""]';
                                        $METODE = json_decode($dummy_arr, true);
                                    } ?>
                                    <div class="control-group">
                                        <label class="control-label">Hari/Tanggal *</label>
                                        <div class="controls">
                                            <input type="date" class="span3" name="tgl" <?php echo $TGL; ?> required />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Jam Masuk *</label>
                                        <div class="controls">
                                            <input type="time" class="span2" name="jm" <?php echo $JM; ?> required />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Jam Keluar *</label>
                                        <div class="controls">
                                            <input type="time" class="span2" name="jk" <?php echo $JK; ?> required />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Pokok Bahasan *</label>
                                        <div class="controls">
                                            <textarea class="span6" name="bahasan" rows="4" placeholder="Pokok bahasan materi ajar ..." required><?php echo $MATERI; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Metode Pembelajaran *</label>
                                        <div class="controls">
                                            <?php
                                            echo form_dropdown('metode[]', $MetodeAjar, $METODE, 'multiple class="span4"'); ?>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Tugas yg Diberikan</label>
                                        <div class="controls">
                                            <textarea class="span6" name="tugas" rows="4" placeholder="Tuliskan tugas yang anda berikan (opsional)"><?php echo $TUGAS; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Mhs Hadir</label>
                                        <div class="controls">
                                            <input type="text" class="span1" name="hadir" value="<?php echo $JlhMhsHadir; ?>" disabled />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Mhs Tidak Hadir</label>
                                        <div class="controls">
                                            <input type="text" class="span1" name="absen" value="<?php echo $JlhMhsAbsen; ?>" disabled />
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php

                    } elseif ($this->input->get('pertemuan')) { ?>
                        <div class="widget-box">
                            <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                                <h5>ABSENSI MAHASISWA PERTEMUAN
                                    <?php echo trim($this->security->xss_clean($this->input->get('pertemuan'))); ?>
                                </h5>
                            </div>
                            <div class="widget-content">
                                Jika data mahasiswa belum muncul/belum lengkap siahkan pilih/klik tombol <b>sinkronisasi</b>
                                pada link berikut.
                                <a href="<?php echo base_url(); ?>home/sinkronisasi_mhs?IDMAKUL=<?php echo $value->IDMAKUL; ?>&KELAS=<?php echo $value->NAMAKLS; ?>&THNSM=<?php echo $value->THSHM; ?>">
                                    <button class="btn btn-success btn-mini">Sinkronisasi Mhs >></button>
                                </a>
                                <?php
                                if (isset($GetMhs)) { ?>
                                <div class="widget-box">
                                    <div class="widget-content">
                                        <?php
                                        if (isset($GetAbsenMhs)) { ?>
                                        <a href="<?php echo base_url(); ?>makul/detail/<?php echo $value->IDMAKUL; ?>/<?php echo $value->THSHM; ?>/<?php echo $value->IDPRODI; ?>/<?php echo $value->NAMAKLS; ?>/<?php echo $value->SEMESTER; ?>?pertemuan=<?php echo trim($this->security->xss_clean($this->input->get('pertemuan'))); ?>&act=absendos">
                                            <button class="btn btn-danger btn-mini">Entri Berita Acara >></button>
                                        </a>
                                        <?php

                                    } ?>
                                        <form action="<?php echo base_url(); ?>absen/simpan/<?php echo trim($this->security->xss_clean($this->input->get('pertemuan'))); ?>" method="POST" class="form-horizontal">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>NIM</th>
                                                        <th>NAMA</th>
                                                        <th>KETERANGAN</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (isset($GetAbsenMhs)) {
                                                        $no = 1;
                                                        echo form_hidden('idmakul', trim($this->security->xss_clean($this->uri->segment(3))));
                                                        echo form_hidden('thnsm', trim($this->security->xss_clean($this->uri->segment(4))));
                                                        echo form_hidden('idprodi', trim($this->security->xss_clean($this->uri->segment(5))));
                                                        echo form_hidden('kls', trim($this->security->xss_clean($this->uri->segment(6))));
                                                        echo form_hidden('smt', trim($this->security->xss_clean($this->uri->segment(7))));
                                                        echo form_hidden('pertemuan', trim($this->security->xss_clean($this->input->get('pertemuan'))));
                                                        foreach ($GetAbsenMhs as $value) {
                                                            if ($no % 2 == 0) {
                                                                $var = 'class="warning"';
                                                            } else {
                                                                $var = '';
                                                            } ?>
                                                    <tr <?php echo $var; ?>>
                                                        <td width="15"><?php echo $no; ?></td>
                                                        <td width="70"><?php echo $value->IDMAHASISWA; ?></td>
                                                        <td width="350"><?php echo $value->NAMAMHS; ?></td>
                                                        <td width="250">
                                                            <select name="ket[<?php echo $value->IDMAHASISWA; ?>]" class="selecter_4">
                                                                <?php
                                                                if (isset($GetAbsenMhsDetail[$value->IDMAHASISWA])) {
                                                                    $data_absen = $GetAbsenMhsDetail[$value->IDMAHASISWA];
                                                                } else {
                                                                    $data_absen = null;
                                                                }
                                                                switch ($data_absen) {
                                                                    case "H":
                                                                        echo '<option value="H">Hadir</option>';
                                                                        echo '<option value="S">Sakit</option>';
                                                                        echo '<option value="I">Izin</option>';
                                                                        echo '<option value="A">Alpha</option>';
                                                                        break;
                                                                    case "S":
                                                                        echo '<option value="S">Sakit</option>';
                                                                        echo '<option value="H">Hadir</option>';
                                                                        echo '<option value="I">Izin</option>';
                                                                        echo '<option value="A">Alpha</option>';
                                                                        break;
                                                                    case "I":
                                                                        echo '<option value="I">Izin</option>';
                                                                        echo '<option value="S">Sakit</option>';
                                                                        echo '<option value="H">Hadir</option>';
                                                                        echo '<option value="A">Alpha</option>';
                                                                        break;
                                                                    case "A":
                                                                        echo '<option value="A">Alpha</option>';
                                                                        echo '<option value="I">Izin</option>';
                                                                        echo '<option value="S">Sakit</option>';
                                                                        echo '<option value="H">Hadir</option>';
                                                                        break;
                                                                    default:
                                                                        echo '<option value="A">Alpha</option>';
                                                                        echo '<option value="I">Izin</option>';
                                                                        echo '<option value="S">Sakit</option>';
                                                                        echo '<option value="H">Hadir</option>';
                                                                        break;
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                    </tr><?php
                                                            $no++;
                                                        }
                                                    } else {
                                                        $no = 1;
                                                        echo form_hidden('idmakul', trim($this->security->xss_clean($this->uri->segment(3))));
                                                        echo form_hidden('thnsm', trim($this->security->xss_clean($this->uri->segment(4))));
                                                        echo form_hidden('idprodi', trim($this->security->xss_clean($this->uri->segment(5))));
                                                        echo form_hidden('kls', trim($this->security->xss_clean($this->uri->segment(6))));
                                                        echo form_hidden('smt', trim($this->security->xss_clean($this->uri->segment(7))));
                                                        echo form_hidden('pertemuan', trim($this->security->xss_clean($this->input->get('pertemuan'))));
                                                        foreach ($GetMhs as $value) {
                                                            if ($no % 2 == 0) {
                                                                $var = 'class="warning"';
                                                            } else {
                                                                $var = '';
                                                            } ?>
                                                    <tr <?php echo $var; ?>>

                                                        <td width="15"><?php echo $no; ?></td>
                                                        <td width="70"><?php echo $value->IDMAHASISWA; ?></td>
                                                        <td width="350"><?php echo $value->NAMAMHS; ?></td>
                                                        <td width="250">
                                                            <select name="ket[<?php echo $value->IDMAHASISWA; ?>]" class="selecter_4">
                                                                <option value="H">Hadir</option>
                                                                <option value="S">Sakit</option>
                                                                <option value="I">Izin</option>
                                                                <option value="A">Alpha</option>
                                                            </select>
                                                        </td>
                                                    </tr><?php
                                                            $no++;
                                                        }
                                                    } ?>
                                                </tbody>
                                            </table>
                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php

                            } ?>
                            </div>
                        </div>
                        <?php

                    } ?>
                    </div>
                    <?php
                    echo $this->session->flashdata("msg"); ?>
                </div>
            </div>
        </div>
        <?php

    } ?>
    </div>
</div> 
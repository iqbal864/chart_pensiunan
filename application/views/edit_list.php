<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Form Edit Pensiunan</h4>
                </div>
            </div>
            <div class="card-body">
                <form id="form_edit" method="post" action="<?= base_url() ?>list/proses_edit">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="row">
                                <div hidden class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>No</label>
                                        <input readonly type="text" class="form-control" name="inputNo" id="inputNo" value="<?= $no ?>" placeholder="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Nopen</label>
                                        <input type="text" class="form-control" name="inputNopen" id="inputNopen" value="<?= $nopen ?>" placeholder="">
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Nik</label>
                                        <input type="text" class="form-control" name="inputNik" id="inputNik" value="<?= $nik ?>" placeholder="">
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Nama</label>
                                        <input type="text" class="form-control" name="inputName" id="inputName" value="<?= $name ?>" placeholder="">
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Tanggal Lahir</label>
                                        <input type="text" style="background-color:#fff !important;" class="form-control tgl_lahir" name="inputTgl_lahir" id="inputTgl_lahir" value="<?= date('d-m-Y', strtotime($tgl_lahir)) ?>" placeholder="">
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Tanggal Pensiun</label>
                                        <input type="text" style="background-color:#fff !important;" class="form-control tgl_pensiun" name="inputTgl_pensiun" id="inputTgl_pensiun" value="<?= date('d-m-Y', strtotime($tgl_pensiun)) ?>" placeholder="">
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="inputStatus">Status</label>
                                        <select id="inputStatus" name="inputStatus" class="form-control">
                                            <option disabled selected>-- Pilih --</option>
                                            <option <?= ($status == 'ISTRI') ? 'selected' : '' ?> value="ISTRI">Istri</option>
                                            <option <?= ($status == 'SUAMI') ? 'selected' : '' ?> value="SUAMI">Suami</option>
                                            <option <?= ($status == 'PENSIUN') ? 'selected' : '' ?> value="PENSIUN">Pensiun</option>
                                            <option <?= ($status == 'JANDA/DUDA') ? 'selected' : '' ?> value="JANDA/DUDA">Janda/Duda</option>
                                        </select>
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="inputKeterangan">Keterangan</label>
                                        <select id="inputKeterangan" name="inputKeterangan" class="form-control">
                                            <option disabled selected>-- Pilih --</option>
                                            <option <?= ($hidup_md_bk == 'HIDUP') ? 'selected' : '' ?> value="HIDUP">Hidup</option>
                                            <option <?= ($hidup_md_bk == 'MD') ? 'selected' : '' ?> value="MD">Meninggal Dunia</option>
                                            <option <?= ($hidup_md_bk == 'BK') ? 'selected' : '' ?> value="BK">Belum Diketahui</option>
                                        </select>
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Tanggal Meninggal</label>
                                        <input type="text" class="form-control tgl_meninggal" name="inputTgl_meninggal" id="inputTgl_meninggal" value="" placeholder="">
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="inputGender">Gender</label>
                                        <select id="inputGender" name="inputGender" class="form-control">
                                            <option disabled selected>-- Pilih --</option>
                                            <option <?= ($gender == 'FEMALE') ? 'selected' : '' ?> value="FEMALE">Female</option>
                                            <option <?= ($gender == 'MALE') ? 'selected' : '' ?> value="MALE">Male</option>
                                        </select>
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Nama Pasangan</label>
                                        <input type="text" class="form-control" name="inputPasangan" id="inputPasangan" value="<?= $nama_pasangan ?>" placeholder="">
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>No. Npp</label>
                                        <input type="text" class="form-control" name="inputNonpp" id="inputNonpp" value="<?= $no_npp ?>" placeholder="">
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Contact Person</label>
                                        <input type="text" class="form-control" name="inputContact" id="inputContact" value="<?= $contact_person ?>" placeholder="">
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>No. Rekening</label>
                                        <input type="text" class="form-control" name="inputRekening" id="inputRekening" value="<?= $no_rek ?>" placeholder="">
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Bank</label>
                                        <input type="text" class="form-control" name="inputBank" id="inputBank" value="<?= $bank ?>" placeholder="">
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label for="inputPembayaran">Tipe Pembayaran</label>
                                        <select id="inputPembayaran" name="inputPembayaran" class="form-control">
                                            <option disabled selected>-- Pilih --</option>
                                            <option <?= ($bulanan_sekaligus == 'Bulanan') ? 'selected' : '' ?> value="Bulanan">Bulanan</option>
                                            <option <?= ($bulanan_sekaligus == 'Sekaligus') ? 'selected' : '' ?> value="Sekaligus">Sekaligus</option>
                                        </select>
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>No. Bpjs</label>
                                        <input type="text" class="form-control" name="inputNoBpjs" id="inputNoBpjs" value="<?= $no_bpjs ?>" placeholder="">
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label for="inputKelasBpjs">Kelas Bpjs</label>
                                        <select id="inputKelasBpjs" name="inputKelasBpjs" class="form-control">
                                            <option disabled selected>-- Pilih --</option>
                                            <option <?= ($kelas_bpjs == 1) ? 'selected' : '' ?> value="1">Kelas 1</option>
                                            <option <?= ($kelas_bpjs == 2) ? 'selected' : '' ?> value="2">Kelas 2</option>
                                            <option <?= ($kelas_bpjs == 3) ? 'selected' : '' ?> value="3">Kelas 3</option>
                                        </select>
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group form-group-default">
                                        <label>Address</label>
                                        <textarea type="text" class="form-control" rows="5" cols="20" wrap="off" name="inputAddress" id="inputAddress" placeholder=""><?= $address ?></textarea>
                                        <div class="invalid-feedback pesan_gagal d-block"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer no-bd">
                <a href="<?= base_url() ?>list" class="btn btn-light">Batal</a>
                <button type="button" id="editRowButton" class="btn btn-warning">Edit</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.tgl_meninggal').prop('disabled', true);
        $('.tgl_meninggal').val('');

        if ($('#inputKeterangan option:selected').val() == 'MD') {
            $('.tgl_meninggal').prop('disabled', false);
            $('.tgl_meninggal').prop('style', 'background-color: #FFF !important');
            $('.tgl_meninggal').val('<?= ($tgl_meninggal != '0000-00-00') ? date('d-m-Y', strtotime($tgl_meninggal)) : '' ?>');
        }
    });

    $('#inputKeterangan').change(function() {
        if ($(this).val() == 'HIDUP' || $(this).val() == 'BK') {
            $('.tgl_meninggal').prop('disabled', true);
            $('.tgl_meninggal').prop('style', '');
            $('.tgl_meninggal').val('');
        } else {
            $('.tgl_meninggal').prop('disabled', false);
            $('.tgl_meninggal').prop('style', 'background-color: #FFF !important');
            $('.tgl_meninggal').val('<?= ($tgl_meninggal != '0000-00-00') ? date('d-m-Y', strtotime($tgl_meninggal)) : '' ?>');
        }
    });

    $('.tgl_lahir, .tgl_pensiun, .tgl_meninggal').flatpickr({
        dateFormat: 'd-m-Y',
    });

    $('#editRowButton').on('click', function() {
        var form = $('#form_edit')[0];
        var data_form = new FormData(form);
        $.ajax({
            url: $('#form_edit').attr('action'),
            method: 'POST',
            enctype: 'multipart/form-data',
            data: data_form,
            dataType: 'json',
            contentType: false,
            processData: false,
            chace: false,
            beforeSend: function() {
                $('#editRowButton').attr('disabled', 'disabled');
                $('#editRowButton').html('<i class="fas fa-spinner fa-spin"></i> In Process');
            },
            complete: function() {
                $('#editRowButton').removeAttr('disabled', 'disabled');
                $('#editRowButton').html('Edit');
            },
            success: function(data) {

                if (data.status == false) {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                        $('[name="' + data.inputerror[i] + '"]').nextAll('.pesan_gagal').text(data.error_string[i]);
                        if (data.valid[i] == true) {
                            $('[name="' + data.inputerror[i] + '"]').removeClass('is-invalid');
                            $('[name="' + data.inputerror[i] + '"]').addClass('is-valid');
                            $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]);
                        }
                    }
                }

                if (data.berhasil) {
                    window.location.href = '<?= base_url() ?>' + data.berhasil;
                }
            }

        });
    });
</script>
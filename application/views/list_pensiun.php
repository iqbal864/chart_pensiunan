<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">List Pensiunan</h4>
                    <a href="<?= base_url() ?>list/add" class="btn btn-primary btn-round ml-auto">
                        <i class="fa fa-plus"></i>
                        Add
                    </a>
                </div>
            </div>
            <div class="card-body">
                <p hidden id="hidup_md_bk"></p>
                <div class="table-responsive">
                    <table id="tabel_list" style="width: 100%;" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nopen</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Tanggal Pensiun</th>
                                <th>Status</th>
                                <th>Status Hidup</th>
                                <th>Gender</th>
                                <th class="text-center" style="width: 10%">Action</th>
                            </tr>
                            <tr>
                                <th style="padding: 0 !important; height:30px !important;"></th>
                                <th style="padding: 0 !important; height:30px !important;"></th>
                                <th style="padding: 0 !important; height:30px !important;"></th>
                                <th style="padding: 0 !important; height:30px !important;"></th>
                                <th style="padding: 0 !important; height:30px !important;"></th>
                                <th style="padding: 0 !important; height:30px !important;"></th>
                                <th style="padding: 0 !important; height:30px !important;">
                                    <select class="form-control form-control-sm" id="filter_status_hidup">
                                        <option value=""></option>
                                        <?php foreach ($status_hidup as $sh) : ?>
                                            <option value="<?= $sh['hidup_md_bk'] ?>"><?= $sh['hidup_md_bk'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </th>
                                <th style="padding: 0 !important; height:30px !important;"></th>
                                <th style="padding: 0 !important; height:30px !important;"></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#filter_status_hidup').on('change', function() {
        $('#hidup_md_bk').text($(this).val());
        table.ajax.reload();
    });

    var table = $('#tabel_list').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        pageLength: 50,
        lengthMenu: [10, 25, 50, 100, 500, 1000],
        stateSave: true,
        "ajax": {
            "url": "<?= base_url() ?>list/get_datatables",
            "type": "POST",
            "data": function(d) {
                d.hidup_md_bk = $("#hidup_md_bk").text();
            }
        },
        "fnDrawCallback": function() {
            $('[data-toggle="tooltip"]').tooltip();
        },
        "columnDefs": [{
            "targets": [0, 8],
            "orderable": false
        }],
        'createdRow': function(row, data, dataIndex) {
            if (data['duplikat_nopen'] > 2) {
                $(row).addClass('table-danger');
            }
        },
        "orderCellsTop": true,
    });

    <?php if ($this->session->flashdata('berhasil') == TRUE) : ?>

        $(document).ready(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: '<?= $this->session->flashdata('berhasil') ?>',
            });
        });

    <?php endif; ?>
</script>
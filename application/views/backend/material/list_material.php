<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18">Manage Barang</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Administration</a></li>
                                            <li class="breadcrumb-item active">Barang</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title -->  

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <button onclick="add_type()" class="btn btn-primary waves-effect waves-light mb-2">
                                                <i class="bx bx-plus font-size-12 align-middle mr-2"></i> Add Barang
                                            </button>
                                        </h4>        
                                        <table id="tableon" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                              <th width="2%" rowspan="2" style="text-align: center; vertical-align: middle;">No</th>
                                              <th width="10%" style="text-align: center; vertical-align: middle;" >Kode Barang</th>
                                              <th style="text-align: center; vertical-align: middle;" >Jenis</th>
                                              <th style="text-align: center; vertical-align: middle;" >Merk</th><!-- 
                                              <th width="4%" style="text-align: center; vertical-align: middle;" >Ukuran</th>
                                              <th style="text-align: center; vertical-align: middle;" >Warna</th>
                                              <th style="text-align: center; vertical-align: middle;" >Harga <br> Beli</th>
                                              <th style="text-align: center; vertical-align: middle;" >Harga <br> Jual</th>
                                              <th width="5%" style="text-align: center; vertical-align: middle;" >Stok</th> -->
                                              <th width="5%" style="text-align: center; vertical-align: middle;" >Action</th>
                                            </tr>
                                           
                                            </thead>
                                            <tbody>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div>
                            
                        
                       </div>     
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->


                <!--  Modal content for the above example -->
                    <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_form">
                        <div class="modal-dialog modal-md modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="modal_title">Title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body form">
                                    <form class="custom-validation" action="#" id="form">
                                         <div class="form-group">
                                            <label>Kode Barang</label>
                                            <input type="text" name="kode_barang"  class="form-control" placeholder="Kode Barang"/>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis</label> 
                                            <div>
                                                <select name="satuan" class="form-control">
                                                    <option value="">-- pilih jenis --</option>
                                                    <?php
                                                        $satuan = $this->db->get('tb_satuan')->result();
                                                        foreach ($satuan as $mg){
                                                            echo "<option value='$mg->id_satuan' ";
                                                            // echo $mg->menu_id==$mg->is_main_menu?'selected':'';
                                                            echo ">".$mg->nama_satuan."</option>";
                                                        }
                                                    ?>
                                               </select>  
                                            </div>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Merk</label>
                                            <div>
                                                <select name="kategori" class="form-control">
                                                    <option value="">-- pilih merk --</option>
                                                    <?php
                                                        $kategori = $this->db->get('tb_kategori')->result();
                                                        foreach ($kategori as $m){
                                                            echo "<option value='$m->id_kategori' ";
                                                            // echo $m->menu_id==$m->is_main_menu?'selected':'';
                                                            echo ">".$m->nama_kategori."</option>";
                                                        }
                                                    ?>
                                               </select>  
                                            </div>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Ukuran</label>
                                            <select name="ukuran" class="form-control">
                                                <option value="0">-- pilih ukuran --</option>
                                                <option value="L">L</option>
                                                <option value="M">M</option>
                                                <option value="S">S</option>
                                                <option value="ALL SIZE">ALL SIZE</option>
                                            </select>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Warna</label>
                                            <input type="text" name="warna"  class="form-control" placeholder="Harga Beli"/>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Harga Beli</label>
                                            <input type="number" name="harga_beli" class="form-control" placeholder="Harga Beli"/>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                         <div class="form-group">
                                            <label>Harga Jual</label>
                                            <input type="number" name="harga_jual"  class="form-control" placeholder="Harga Beli"/>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Stok</label>
                                            <input type="number" name="stok" class="form-control" placeholder="Stok"/>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                        <div class="form-group">
                                            <label>Minimal Stok</label>
                                            <input type="number" name="min_stok" class="form-control" placeholder="Minimal Stok"/>
                                            <span class="invalid-feedback"></span>
                                        </div>
                                                                                                    
                                        <div class="form-group mb-0">
                                            <div>
                                                <button type="submit" id="btnSave" onclick="save()" class="btn btn-primary waves-effect waves-light mr-1">
                                                    Save
                                                </button>
                                                <button type="reset" class="btn btn-secondary waves-effect">
                                                    Reset
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->




<script src="<?= base_url();?>assets/admin/assets/libs/jquery/jquery.min.js"></script>
<script type="text/javascript">
    var save_label;
    var table;

    $(document).ready(function() {
        
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
      {
      return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
      };
    };
        
        table = $("#tableon").DataTable({
        initComplete: function() {
          var api = this.api();
          $('#tableon_filter input')
            .off('.DT')
            .on('keyup.DT', function(e) {
                          api.search(this.value).draw();
                      });
        },
        oLanguage: {
                  sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {
                  "url": "<?= base_url().'material/material_json'?>",
                  "type": "POST"
              },
        columns: [
                  {
                      "data": "id_barang",
                      "orderable": false,
                      "searchable": false
                  },                  
          {"data": "kd_baranag"},
          {"data": "nama_satuan"},
          {"data": "nama_kategori"},
          // {"data": "ukuran"},
          // {"data": "warna"},
          {"data": "harga_beli", render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp ' )},
          {"data": "harga_jual", render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp ' )},
          // {"data": "qty","className" : "text-center"},
          {
                      "data": "view",
                      "orderable": false,
                      "searchable": false,
                      "className" : "text-center"
                  }
        ],
        order: [[0, 'asc']],
        rowId: function(a){
                  return a;
              },
              rowCallback: function(row, data, iDisplayIndex) {
          var info = this.fnPagingInfo();
          var page = info.iPage;
          var length = info.iLength;
          var index = page * length + (iDisplayIndex + 1);
          $('td:eq(0)', row).html(index);
        }
      });


          $('#modal_form').on('hidden.bs.modal', function (e) {
              var inputs = $('#form input, #form textarea, #form select');
              inputs.removeClass('is-valid is-invalid');
          });
      });



    function reload_ajax(){
        table.ajax.reload(null, false);
    }

    function swalert(method){
        Swal.fire({
            title: 'Success',
            text: 'Data berhasil '+method,
            type: 'success'
        });
    };

    function add_type()
    {
        save_label = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add Barang'); // Set Title to Bootstrap modal title
    }

    function edit_type(id)
    {
        save_label = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?=base_url('material/edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data.id_barang);
                $('[name="nama_barang"]').val(data.nama_barang);
                $('[name="satuan"]').val(data.satuan);
                $('[name="kategori"]').val(data.kategori);
                $('[name="harga_beli"]').val(data.harga_beli);
                $('[name="stok"]').val(data.stok);
                $('[name="min_stok"]').val(data.min_stok);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Barang'); // Set title to Bootstrap modal title
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }


    function save()
    {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable 
        var url, method;

        if(save_label == 'add') {
            url = "<?=base_url('material/add')?>";
            method = 'disimpan';
        } else {
            url = "<?=base_url('material/update')?>";
            method = 'diupdate';
        }

        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "json",
            success: function(data)
            {
                console.log(data);
                if(data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reload_ajax();
                    swalert(method);
                }
                else
                {
                    $.each(data.errors, function(key, value){
                        $('[name="'+key+'"]').addClass('is-invalid'); //select parent twice to select div form-group class and add has-error class
                        $('[name="'+key+'"]').next().text(value); //select span help-block class set text error string
                        if(value == ""){
                            $('[name="'+key+'"]').removeClass('is-invalid');
                            $('[name="'+key+'"]').addClass('is-valid');
                        }
                    });
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
            }
        });

        $('#form input').on('keyup', function(){
            $(this).removeClass('is-valid is-invalid');            
        });
        $('#form select').on('change', function(){
            $(this).removeClass('is-valid is-invalid');
        });
    }

    function hapus_type(id)
    {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data akan dihapus!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus data!'
        }).then((result) => {
            if(result.value) {
                $.ajax({
                    url : "<?=base_url('material/delete')?>/"+id,
                    type: "POST",
                    success: function(data)
                    {
                        reload_ajax();
                        swalert('dihapus');
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error deleting data');
                    }
                });
            }
        });
    } 

</script>


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
                                    <h4 class="mb-0 font-size-18">Manage User</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Administration</a></li>
                                            <li class="breadcrumb-item active">User</li>
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
                                                <i class="bx bx-plus font-size-12 align-middle mr-2"></i> Add User
                                            </button>
                                        </h4>        
                                        <table id="tableon" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                              <th style="width: 3%;">No.</th>
                                              <th>Nama Lengkap</th>
                                              <th>Username</th>
                                              <th>Role</th>
                                              <th>Is Active</th>
                                              <th>Images</th>
                                              <th style="text-align: center;width: 10%;">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->     
                        

                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->  


     <!--  Modal content for the above example -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_form">
            <div class="modal-dialog modal-dialog-scrollable">
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
                                <label>Title</label>
                                <input type="hidden" value="" name="id">
                                <input type="text" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap"/>
                                <span class="invalid-feedback"></span>
                            </div>    
                            <div class="form-group">
                                <label>Username</label>
                                <div>
                                    <input type="text" name="username" class="form-control" placeholder="Username"/>
                                    <span class="invalid-feedback"></span>        
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div>
                                    <input type="password" name="password" class="form-control" placeholder="password"/>
                                    <span class="invalid-feedback"></span>        
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role_name" class="form-control">
                                </select>
                                <span class="invalid-feedback"></span>        
                            </div>
                            <div class="form-group">
                                <label>Is Active</label>
                                <div>
                                    <select name="is_active" class="form-control">
                                        <option value="">-- Pilh --</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-body">
                              <div class="form-group" id="photo-preview">
                                  <label class="control-label">Photo</label>
                                  <div>
                                      (No photo)
                                      <span class="invalid-feedback"></span>
                                  </div>
                              </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label" id="label-photo">Foto</label>
                                    <input name="photo" class="form-control" type="file">
                                    <span class="invalid-feedback"></span>
                                </div>
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
    var base_url = '<?php echo base_url();?>';
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
                  "url": "<?= base_url().'user/user_json'?>",
                  "type": "POST"
              },
        columns: [
                  {
                      "data": "user_id",
                      "orderable": false,
                      "searchable": false
                  },
                  {"data": "nama_lengkap"},
                  {"data": "username"},
                  {"data": "role_name"},
                  {"data": "is_active"},
                  {"data": "photo","render": function(data, type, row) {
                        if(data){
                          return '<img src="<?php echo base_url();?>uploads/user/'+data+'"style="height:50px;width:50px;" />';
                        } else {
                          return '<img src="<?php echo base_url();?>uploads/user/default.png "style="height:50px;width:50px;" />';
                        }     
                            
                        }},
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

        $('#modal_form').on('shown.bs.modal', function (e) {
            load_role();
        });

          $('#modal_form').on('hidden.bs.modal', function (e) {
              var inputs = $('#form input, #form textarea, #form select');
              inputs.removeClass('is-valid is-invalid');
          });
      });
   
    function load_role(){
        $.ajax({
            url: "<?=base_url('user/get_role')?>",
            method: 'GET',
            dataType: 'JSON',
            success: function(categories){
                console.log(categories);
                var opsi_kategori;
                $('[name="role_name"]').html('');
                $.each(categories, function(key, val){
                    opsi_kategori = `<option value="${val.role_id}">${val.role_name}</option>`;
                    $('[name="role_name"]').append(opsi_kategori);
                });
            }
        });
    }
  
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
        $('.modal-title').text('Add User'); // Set Title to Bootstrap modal title
        
        $('#photo-preview').hide(); // hide photo preview modal

        $('#label-photo').text('Upload Photo'); // label photo upload  
    }

    function edit_type(id)
    {
        save_label = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?=base_url('user/edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data.user_id);
                $('[name="nama_lengkap"]').val(data.nama_lengkap);
                $('[name="username"]').val(data.username);
                $('[name="role_name"]').val(data.id_role);
                $('[name="is_active"]').val(data.is_active);
                
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title

                $('#photo-preview').show(); // show photo preview modal

            if(data.photo){
                $('#label-photo').text('Change Photo'); // label photo upload
                $('#photo-preview div').html('<img src="'+base_url+'uploads/user/'+data.photo+'" style="width:100px;">'); // show photo
                $('#photo-preview div').append('<br><input type="checkbox" name="remove_photo" value="'+data.photo+'"/> Remove photo when saving'); // remove photo
            } else {
                $('#label-photo').text('Upload Photo'); // label photo upload
                $('#photo-preview div').text('(No photo)');
            }

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
            url = "<?=base_url('user/add')?>";
            method = 'disimpan';
        } else {
            url = "<?=base_url('user/update')?>";
            method = 'diupdate';
        }
        var formData = new FormData($('#form')[0]);
        // ajax adding data to database
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType : false,
            processData : false,
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
                    url : "<?=base_url('user/delete')?>/"+id,
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
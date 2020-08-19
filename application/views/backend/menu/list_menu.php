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
                                    <h4 class="mb-0 font-size-18">Manage Menu</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Administration</a></li>
                                            <li class="breadcrumb-item active">Menu</li>
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
                                                <i class="bx bx-plus font-size-12 align-middle mr-2"></i> Add Menu
                                            </button>
                                        </h4>        
                                        <table id="tableon" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                              <th>No</th>
                                              <th>Group Name</th>
                                              <th>Title</th>
                                              <th style="text-align: center;">Link</th>
                                              <th style="text-align: center;">Icon</th>
                                              <th style="text-align: center;">Type</th>
                                              <th style="text-align: center;">Action</th>
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
                    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal_form">
                        <div class="modal-dialog modal-lg">
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
                                            <input type="hidden" value="" name="id">
                                            <label>Group Name</label>
                                            <div>
                                               <select name="group_name" class="form-control">
                                                 <?php
                                                        $menu_group = $this->db->get('menu_group')->result();
                                                        foreach ($menu_group as $mg){
                                                            echo "<option value='$mg->group_id' ";
                                                            // echo $mg->menu_id==$mg->is_main_menu?'selected':'';
                                                            echo ">".  strtoupper($mg->group_name)."</option>";
                                                        }
                                                    ?>
                                               </select>  
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Main Menu</label>
                                            <div>
                                               <select name="menu_type" class="form-control">
                                                    <option value="0">MAIN MENU</option>
                                                        //tampilkan menu
                                                        <?php
                                                            $menu = $this->db->get('menu')->result();
                                                            foreach ($menu as $m){
                                                                echo "<option value='$m->menu_id' ";
                                                                // echo $m->menu_id==$m->is_main_menu?'selected':'';
                                                                echo ">".  strtoupper($m->menu_title)."</option>";
                                                            }
                                                        ?>
                                               </select>  
                                            </div>
                                        </div>
                                       
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="menu_title" class="form-control" placeholder="Title"/>
                                            <span class="invalid-feedback"></span>
                                        </div>     
                                        <div class="form-group">
                                            <label>Link</label>
                                            <div>
                                                <input type="text" name="menu_link" class="form-control" placeholder="link"/>
                                                <span class="invalid-feedback"></span>        
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Icon</label>
                                            <div>
                                                <input type="text" name="menu_icon" class="form-control" placeholder="Icon"/>
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
                  "url": "<?= base_url().'menu/menu_json'?>",
                  "type": "POST"
              },
        columns: [
                  {
                      "data": "menu_id",
                      "orderable": false,
                      "searchable": false
                  },
          {"data": "group_name"},
          {"data": "menu_title"},
          {"data": "menu_link"},
          {
            "data": "menu_icon",
            "className" : "text-center"
          },
          {
            "data": "menu_type",
            "className" : "text-center"},
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
        $('.modal-title').text('Add Menu'); // Set Title to Bootstrap modal title
    }

    function edit_type(id)
    {
        save_label = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?=base_url('menu/edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data.menu_id);
                $('[name="group_name"]').val(data.group_id);
                $('[name="menu_title"]').val(data.menu_title);
                $('[name="menu_link"]').val(data.menu_link);
                $('[name="menu_icon"]').val(data.menu_icon);
                $('[name="menu_type"]').val(data.menu_type);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit Menu'); // Set title to Bootstrap modal title
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
            url = "<?=base_url('menu/add')?>";
            method = 'disimpan';
        } else {
            url = "<?=base_url('menu/update')?>";
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
                    url : "<?=base_url('menu/delete')?>/"+id,
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


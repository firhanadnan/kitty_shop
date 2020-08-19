<!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
                    <?php if ($this->session->flashdata('flash')) : ?>
                    <?php endif; ?>
                <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-flex align-items-center justify-content-between">
                                    <h4 class="mb-0 font-size-18 badge badge-info">Role <?= $role['role_name']; ?></h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Administration</a></li>
                                            <li class="breadcrumb-item active">Role Access</li>
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
                                             
                                        <table id="data" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                              <tr>
                                                <th>No</th>
                                                <th>Group Menu</th> 
                                                <th style="text-align:center;">Access</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                                  <?php
                                                      $no = 1;
                                                      foreach ($group as $m) {
                                                          echo "<tr>
                                                                <td>$no</td>
                                                                <td>$m->group_name</td>
                                                                <td align='center'><input type='checkbox' style='margin-left:-20px;'".  checked_akses($this->uri->segment(3), $m->group_id)." onClick='kasi_akses($m->group_id)'></td>
                                                                </tr>";
                                                      $no++;
                                                  }
                                                  ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->     
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

<script type="text/javascript">
    function kasi_akses(id_menu){
        //alert(id_menu);
        var id_menu = id_menu;
        var level = '<?php echo $this->uri->segment(3); ?>';
        //alert(level);
        $.ajax({
            url:"<?php echo base_url()?>role/kasi_akses_ajax",
            data:"id_menu=" + id_menu + "&level="+ level ,
            success: function(html)
            { 
                load();
                alert('sukses');
            }
        });
    }    
</script>
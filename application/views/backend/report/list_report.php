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
                                    <h4 class="mb-0 font-size-18">Laporan</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Administration</a></li>
                                            <li class="breadcrumb-item active">Laporan</li>
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
                                        <table class="table table-bordered table-condensed" style="font-size:12px;" id="mydata">
                                            <thead>
                                                <tr>
                                                    <th style="text-align:center;width:40px;">No</th>
                                                    <th>Laporan</th>
                                                    <th style="width:100px;text-align:center;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                                <tr>
                                                    <td style="text-align:center;vertical-align:middle">1</td>
                                                    <td style="vertical-align:middle;">Laporan Data Barang</td>
                                                    <td style="text-align:center;">
                                                        <a class="btn btn-sm btn-warning" href="<?php echo base_url().'report/lap_data_barang'?>" target="_blank"><span class="fa fa-print"></span> Print</a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="text-align:center;vertical-align:middle">2</td>
                                                    <td style="vertical-align:middle;">Laporan Stok Barang</td>
                                                    <td style="text-align:center;">
                                                        <a class="btn btn-sm btn-warning" href="<?php echo base_url().'report/lap_stok_barang'?>" target="_blank"><span class="fa fa-print"></span> Print</a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="text-align:center;vertical-align:middle">3</td>
                                                    <td style="vertical-align:middle;">Laporan Penjualan</td>
                                                    <td style="text-align:center;">
                                                        <a class="btn btn-sm btn-warning" href="<?php echo base_url().'report/lap_data_penjualan'?>" target="_blank"><span class="fa fa-print"></span> Print</a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="text-align:center;vertical-align:middle">4</td>
                                                    <td style="vertical-align:middle;">Laporan Penjualan PerTanggal</td>
                                                    <td style="text-align:center;">
                                                        <a class="btn btn-sm btn-warning" href="#lap_jual_pertanggal" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="text-align:center;vertical-align:middle">5</td>
                                                    <td style="vertical-align:middle;">Laporan Penjualan PerBulan</td>
                                                    <td style="text-align:center;">
                                                        <a class="btn btn-sm btn-warning" href="#lap_jual_perbulan" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="text-align:center;vertical-align:middle">6</td>
                                                    <td style="vertical-align:middle;">Laporan Penjualan PerTahun</td>
                                                    <td style="text-align:center;">
                                                        <a class="btn btn-sm btn-warning" href="#lap_jual_pertahun" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                                                    </td>
                                                </tr>

                                                 <tr>
                                                    <td style="text-align:center;vertical-align:middle">7</td>
                                                    <td style="vertical-align:middle;">Laporan Laba/Rugi</td>
                                                    <td style="text-align:center;">
                                                        <a class="btn btn-sm btn-warning" href="#lap_laba_rugi" data-toggle="modal"><span class="fa fa-print"></span> Print</a>
                                                    </td>
                                                </tr>
                                          
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
                    <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="lap_laba_rugi">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="modal_title">Laporan Laba / Rugi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body form">
                                    <form class="form-horizontal" method="post" action="<?php echo base_url().'report/lap_laba_rugi'?>" target="_blank">
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label class="control-label col-xs-3" >Bulan</label>
                                                <div class="col-xs-9">
                                                    <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                                    <?php foreach ($jual_bln->result_array() as $k) {
                                                        $bln=$k['bulan'];
                                                    ?>
                                                        <option><?php echo $bln;?></option>
                                                    <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                            <button class="btn btn-warning"><span class="fa fa-print"></span> Print</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->


                    <!--  Modal content for the above example -->
                    <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="lap_jual_pertanggal">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="modal_title">Laporan Penjualan Pertanggal</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body form">
                                    <form class="form-horizontal" method="post" action="<?php echo base_url().'report/lap_penjualan_pertanggal'?>" target="_blank">
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label class="control-label col-xs-3" >Tanggal</label>
                                                <div class="col-xs-9">
                                                    <input type='date' name="tgl" class="form-control" value="" placeholder="Tanggal..." required/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                            <button class="btn btn-warning"><span class="fa fa-print"></span> Print</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <!--  Modal content for the above example -->
                    <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="lap_jual_perbulan">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="modal_title">Laporan Penjualan Perbulan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body form">
                                    <form class="form-horizontal" method="post" action="<?php echo base_url().'report/lap_penjualan_perbulan'?>" target="_blank">
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label class="control-label col-xs-3" >Bulan</label>
                                                <div class="col-xs-9">
                                                    <select name="bln" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Bulan" data-width="80%" required/>
                                                    <?php foreach ($jual_bln->result_array() as $k) {
                                                        $bln=$k['bulan'];
                                                    ?>
                                                        <option><?php echo $bln;?></option>
                                                    <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                            <button class="btn btn-warning"><span class="fa fa-print"></span> Print</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal --> 

                    <!--  Modal content for the above example -->
                    <div class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="lap_jual_pertahun">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="modal_title">Laporan Penjualan Pertahun</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body form">
                                    <form class="form-horizontal" method="post" action="<?php echo base_url().'report/lap_penjualan_pertahun'?>" target="_blank">
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label class="control-label col-xs-3" >Tahun</label>
                                                <div class="col-xs-9">
                                                     <select name="thn" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Tahun" data-width="80%" required/>
                                                    <?php foreach ($jual_thn->result_array() as $t) {
                                                        $thn=$t['tahun'];
                                                    ?>
                                                        <option><?php echo $thn;?></option>
                                                    <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">Tutup</button>
                                            <button class="btn btn-warning"><span class="fa fa-print"></span> Print</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->    


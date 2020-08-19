<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        	<!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Penjualan Barang</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Transaksi</a></li>
                                <li class="breadcrumb-item active">Penjualan</li>
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
                          <form action="<?= base_url()?>penjualan/add_to_cart" method="POST">
                            <div class="form-group row">
                                
                                    <a href="" data-toggle="modal" data-target="#cari" class="btn btn-md btn-info float-right" style="margin-left: 15px;"><i class="bx bx-search-alt-2 font-size-16 align-middle"></i>Cari Barang</a>
                                
                            </div>
                            <hr>
              							<!-- auto input Barang -->
              							<table>
                                <tr>
                                    <th>Kode Barang</th>
                                </tr>
                                <tr>
                                    <th><input type="text" name="kode_brg" id="kode_brg" class="form-control input-sm"></th>                     
                                </tr>
                                    <div id="detail_bahan" style="position:absolute;">

                                    </div>
                            </table>
                            </form>
                        	<table class="table table-bordered table-condensed" style="font-size:12px;margin-top:10px;">
				                <thead>
				                    <tr>
				                        <th>Kode Barang</th>
				                        <th>Jenis</th>
				                        <th style="text-align:center;">Merk</th>
                                <th style="text-align:center;">Ukuran</th>
                                <th style="text-align:center;">Warna</th>
				                        <!-- <th style="text-align:center;">Harga Beli</th> -->
                                <th style="text-align:center;">Harga Jual</th>
				                        <th style="text-align:center;">Jumlah Beli</th>
				                        <th style="text-align:center;">Sub Total</th>
				                        <th style="width:100px;text-align:center;">Aksi</th>
				                    </tr>
				                </thead>
				                <tbody>
				                      <?php $i = 1; ?>
                              <?php foreach ($this->cart->contents() as $items): ?>
                              <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>
                              <tr>
                                   <td><?=$items['id'];?></td>
                                   <td><?=$items['name'];?></td>
                                   <td style="text-align:center;"><?= $items['satuan'];?></td>
                                   <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                                          <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                                                <td style="text-align:center;">
                                                  <?php echo $option_value; ?>
                                                </td>
                                          <?php endforeach; ?>
                                   <?php endif; ?>
                                   <!-- <td style="text-align:right;"><?php echo number_format($items['harga']);?></td> -->
                                   <td style="text-align:right;"><?php echo number_format($items['price']);?></td>
                                   <td style="text-align:center;"><?php echo number_format($items['qty']);?></td>
                                   <td style="text-align:right;"><?php echo number_format($items['subtotal']);?></td>
                                   <td style="text-align:center;"><a href="<?php echo base_url().'penjualan/remove/'.$items['rowid'];?>" class="btn btn-danger btn-xs"><span class="fas fa-window-close"></span></a></td>
                              </tr>
                              <?php $i++; ?>
                              <?php endforeach; ?>
				                </tbody>
			                	<tfoot>
				                    <tr>
				                        <td colspan="8" style="text-align:center;">Total</td>
				                        <td style="text-align:right;">Rp.  <?php echo number_format($this->cart->total());?></td>
				                    </tr>
				                </tfoot>
			            	</table>
			            
                    <form action="<?php echo base_url().'penjualan/save'?>" method="post">
                      <table>
                          <tr>
                              <td style="width:760px;" rowspan="2"><button type="submit" class="btn btn-primary btn-md"><span class="far fa-save"></span> Simpan</button></td>
                              <th style="width:140px;">Total Belanja(Rp)</th>
                              <th style="text-align:right;width:140px;"><input type="text" name="total2" value="<?php echo number_format($this->cart->total());?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly></th>
                              <input type="hidden" id="total" name="total" value="<?php echo $this->cart->total();?>" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" readonly>
                          </tr>
                          <tr>
                              <th>Tunai(Rp)</th>
                              <th style="text-align:right;"><input type="text" id="jml_uang" name="jml_uang" class="jml_uang form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                              <input type="hidden" id="jml_uang2" name="jml_uang2" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required>
                          </tr>
                          <tr>
                              <td></td>
                              <th>Kembalian(Rp)</th>
                              <th style="text-align:right;"><input type="text" id="kembalian" name="kembalian" class="form-control input-sm" style="text-align:right;margin-bottom:5px;" required></th>
                          </tr>

                      </table>
                      </form>
                      <hr/>
                        </div>    
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row --> 
        </div>
    </div>
</div>

<!--  Modal content for the above example -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="cari">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="modal_title">Daftar Bahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form">
                <table id="tableon" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                      <th width="2%">No</th>
                      <th style="text-align: center;">Kode Barang</th>
                      <th style="text-align: center;">Jenis</th>
                      <th style="text-align: center;">Merk</th>
                      <th style="text-align: center;">Ukuran</th>
                      <th style="text-align: center;">Warna</th>
                      <th style="text-align: center;">Harga Beli</th>
                      <th style="text-align: center;">Stok</th>
                      <th width="5%" style="text-align: center;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
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
                  "url": "<?= base_url().'pembelian/bahan_json'?>",
                  "type": "POST"
              },
        columns: [
                  {
                      "data": "id_barang",
                      "orderable": false,
                      "searchable": false
                  },
          {"data": "kd_barang"},
          {"data": "nama_satuan"},
          {"data": "nama_kategori"},
          {"data": "ukuran"},
          {"data": "warna"},
          {"data": "harga_beli"},
          {"data": "qty"},
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

    });
</script>

<script type="text/javascript">
    $(function(){
        $('#jml_uang').on("input",function(){
            var total=$('#total').val();
            var jumuang=$('#jml_uang').val();
            var hsl=jumuang.replace(/[^\d]/g,"");
            $('#jml_uang2').val(hsl);
            $('#kembalian').val(hsl-total);
        })
        
    });
</script>

<script type="text/javascript">
        $(function(){
            $('.jml_uang').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            $('#jml_uang2').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ''
            });
            $('#kembalian').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
            $('.harjul').priceFormat({
                    prefix: '',
                    //centsSeparator: '',
                    centsLimit: 0,
                    thousandsSeparator: ','
            });
        });
    </script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#kode_brg").focus();
        $("#kode_brg").keyup(function(){
            var kobar = {kode_brg:$(this).val()};
               $.ajax({
           type: "POST",
           url : "<?php echo base_url().'penjualan/get_bahan';?>",
           data: kobar,
           success: function(msg){
           $('#detail_bahan').html(msg);
           }
        });
        }); 

        $("#kode_brg").keypress(function(e){
            if(e.which==13){
                $("#jumlah").focus();
            }
        });
    });
</script>
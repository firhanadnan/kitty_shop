<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
        	<!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Pembelian Barang</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Transaksi</a></li>
                                <li class="breadcrumb-item active">Pembelian</li>
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
                          <form action="<?= base_url()?>pembelian/add_to_cart" method="POST">
                            <div class="form-group row">
                               
                                <label for="example-search-input" class="col-md-1 col-form-label">Tanggal</label>
                                <div class="col-md-4">
                                    <input class="form-control" type="date" name="tgl" value="<?php echo $this->session->userdata('tgl');?>" placeholder="tanggal pembelian">
                                </div>
                                <label for="example-text-input" class="col-md-1 col-form-label">Supplier</label>
                                <div class="col-md-3">
                                    <select class="select2 form-control" name="supplier">
	                                    <option>Pilih Supplier</option>
                                        <?php                                         
                                        	
                                        	foreach($sup->result_array() as $supplier) {
                                          $sess_id = $this->session->userdata('supplier');
                                          $id_sup = $supplier['id_supplier'];
                                          $nama_sup = $supplier['nama'];
                                          if($sess_id==$id_sup)
                                              echo "<option value='$id_sup' selected>$nama_sup </option>";
                                          else
                                              echo "<option value='$id_sup'>$nama_sup</option>";
                                        }
                                       
                                          
                                        ?>
											                		
                                    	
                                    </select>
                    			     </div>
                                <div class="col-md-2">
                                    <a href="" data-toggle="modal" data-target="#cari" class="btn btn-md btn-info float-right"><i class="bx bx-search-alt-2 font-size-16 align-middle"></i>Cari Barang</a>
                                </div>
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
				                        <th style="text-align:center;">Harga Beli</th>
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
                                   <td style="text-align:right;"><?php echo number_format($items['price']);?></td>
                                   <td style="text-align:right;"><?php echo number_format($items['harga']);?></td>
                                   <td style="text-align:center;"><?php echo number_format($items['qty']);?></td>
                                   <td style="text-align:right;"><?php echo number_format($items['subtotal']);?></td>
                                   <td style="text-align:center;"><a href="<?php echo base_url().'pembelian/remove/'.$items['rowid'];?>" class="btn btn-danger btn-xs"><span class="fas fa-window-close"></span></a></td>
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
			            	<a href="<?= base_url()?>pembelian/save" class="btn btn-success btn-md"><span class="far fa-save"></span> Simpan</a>
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
                <table id="tableon" class="table table-bordered " style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                      <th width="2%">No</th>
                      <th style="text-align: center;">Kode Barang</th>
                      <th style="text-align: center;">Jenis</th>
                      <th style="text-align: center;">Merk</th>
                      <th style="text-align: center;">Stok</th>
                      <th style="text-align: center;">Action</th>
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
          {"data": "kd_barang",
          "className": "text-center"
          },
          {"data": "nama_satuan",
          "className": "text-center"
          },
          {"data": "nama_kategori",
          "className": "text-center"
          },
          {"data": "qty",
          "className": "text-center"
          },
          {
              "data": "view",
              "orderable": false,
              "searchable": false,
              "className" : "text-center"
          },
          
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
        $(document).ready(function(){
            $("#kode_brg").focus();
            $("#kode_brg").keyup(function(){
                var kobar = {kode_brg:$(this).val()};
                   $.ajax({
               type: "POST",
               url : "<?php echo base_url().'pembelian/get_bahan';?>",
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
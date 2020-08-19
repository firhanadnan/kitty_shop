<html lang="en" moznomarginboxes mozdisallowselectionprint>
<head>
    <title>laporan data stok barang</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/assets/css/laporan.css')?>"/>
</head>
<body onload="window.print()">
<div id="laporan">
<table align="center" style="width:900px; border-bottom:3px double;border-top:none;border-right:none;border-left:none;margin-top:5px;margin-bottom:20px;">
<!--<tr>
    <td><img src="<?php// echo base_url().'assets/img/kop_surat.png'?>"/></td>
</tr>-->
</table>
<?php 
    $b=$jml->row_array();
?>

<table border="0" align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:0px;">
<tr>
    <td colspan="2" style="width:800px;paddin-left:20px;"><center><h4>LAPORAN PENJUALAN TAHUN <?php echo $b['tahun'];?></h4></center><br/></td>
</tr>
                       
</table>
 
<table border="0" align="center" style="width:900px;border:none;">
        <tr>
            <th style="text-align:left"></th>
        </tr>
</table>

<table border="1" align="center" style="width:900px;margin-bottom:20px;">
<?php 
    $urut=0;
    $nomor=0;
    $group='-';
    foreach($data->result_array()as $d){
    $nomor++;
    $urut++;
    if($group=='-' || $group!=$d['bulan']){
        $bulan=$d['bulan'];
        $query=$this->db->query("SELECT DATE_FORMAT(tanggal,'%M %Y') AS bulan,DATE_FORMAT(tanggal,'%d %M %Y') AS tanggal,SUM(tb_detail_order.total) as total FROM tb_order JOIN tb_detail_order ON invoice=invoice_order WHERE DATE_FORMAT(tanggal,'%M %Y')='$bulan' ORDER BY invoice DESC");
        $t=$query->row_array();
        $tots=$t['total'];
        if($group!='-')
        echo "</table><br>";
        echo "<table align='center' width='900px;' border='1'>";
        echo "<tr><td colspan='9'><b>Bulan: $bulan</b></td> <td style='text-align:right;'><b>Total:</b></td><td style='text-align:right;'><b>".'Rp '.number_format($tots)."</b></td></tr>";
echo "<tr style='background-color:#ccc;'>
    <td width='3%' align='center'>No</td>
    <th>No Faktur</th>
    <th>Tanggal</th>
    <th>Kode Barang</th>
    <th>Nama Barang</th>
    <th>Merk</th>
    <th>Ukuran</th>
    <th>Warna</th>
    <th>Harga Jual</th>
    <th>Qty</th>
    <th>SubTotal</th>
    
    </tr>";
$nomor=1;
    }
    $group=$d['bulan'];
        if($urut==500){
        $nomor=0;
            echo "<div class='pagebreak'> </div>";
            //echo "<center><h2>KALENDER EVENTS PER TAHUN</h2></center>";
            }
        ?>
        <tr>
                <td style="text-align:center;vertical-align:top;text-align:center;"><?php echo $nomor; ?></td>
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['invoice']; ?></td>
                <td style="vertical-align:top;text-align:center;"><?php echo $d['tanggal']; ?></td>
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['kd_barang']; ?></td>
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['nabar']; ?></td> 
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['kategori']; ?></td>
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['ukuran']; ?></td>
                <td style="vertical-align:top;padding-left:5px;"><?php echo $d['warna']; ?></td>
                <td style="vertical-align:top;padding-left:5px;text-align:right;"><?php echo 'Rp '.number_format($d['harjul']); ?></td>
                <td style="vertical-align:top;padding-left:5px;text-align:center;"><?php echo $d['qty']; ?></td>
                <td style="vertical-align:top;padding-left:5px;text-align:right;"><?php echo 'Rp '.number_format($d['total']); ?></td> 
        </tr>
        
        

        <?php
        }
        ?>
        <tfoot>
            <tr>
                <td colspan="10" style="text-align:center;"><b>Total</b></td>
                <td style="text-align:right;"><b><?php echo 'Rp '.number_format($b['total']);?></b></td>
            </tr>
        </tfoot>
</table>

<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td></td>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <td align="right">Serang, <?php echo date('d-M-Y')?></td>
    </tr>
    <tr>
        <td align="right"></td>
    </tr>
   
    <tr>
    <td><br/><br/><br/><br/></td>
    </tr>    
    <tr>
        <td align="right">( <?php echo $this->session->userdata('nama_lengkap');?> )</td>
    </tr>
    <tr>
        <td align="center"></td>
    </tr>
</table>
<table align="center" style="width:800px; border:none;margin-top:5px;margin-bottom:20px;">
    <tr>
        <th><br/><br/></th>
    </tr>
    <tr>
        <th align="left"></th>
    </tr>
</table>
</div>
</body>
</html>
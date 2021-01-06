<style type="text/css">
  /*
 * detail styles
 */
td.details-control {
    background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_open.png') no-repeat center center;
    cursor: pointer;
}
tr.shown td.details-control {
    background: url('https://cdn.rawgit.com/DataTables/DataTables/6c7ada53ebc228ea9bc28b1b216e793b1825d188/examples/resources/details_close.png') no-repeat center center;
}
</style>
<div class="row">
<div role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
              </div>
            </div>
            <div class="clearfix"></div>
          <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-align-left"></i> Atur  Inventaris<small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- start accordion -->
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                      <div class="panel" id="panelone">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">Form tambah Inventaris</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            
                            <form class="form-horizontal form-label-left" id="tambah" data-parsley-validate  enctype="multipart/form-data">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <span class="section">Tambah Inventaris</span>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kode">Kode Barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   
                                    <input class="form-control col-md-7 col-xs-12" minlength="2"  name="kode" required="required" id="kode"  type="text">
                                    
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">Nama Barang
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   
                                    <input class="form-control col-md-7 col-xs-12" name="barang" id="barang"  required="required" type="text">
                                    
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ukuran">Ukuran
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   
                                     <select id="s2ukuran" class="form-control col-md-7 col-xs-12" name="ukuran" required="required">
                                    </select>
                                    
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="spefikasi">Spefikasi
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea type="text" name="spefikasi"  class="form-control col-md-7 col-xs-12" required></textarea>
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="spefikasi">Pengguna
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2pengguna" class="form-control col-md-7 col-xs-12" name="pengguna[]">
                                    </select>
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal_pembelian">Tanggal Pembelian
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12 datepicker" name="tanggal_pembelian" required="required" id="tanggal_pembelian"   type="text" readonly>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">Jumlah
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="jumlah" required="required" id="jumlah" data-parsley-type="integer" type="text">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Kondisi ?<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <select  class="form-control col-md-7 col-xs-12" id="kondisi" name="kondisi" required="required">
                                      <option value="">Pilih Kondisi..</option>
                                      <option value="Baik">Baik</option>
                                      <option value="Rusak">Rusak</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keterangan">Keterangan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea type="text" name="Keterangan"  class="form-control col-md-7 col-xs-12"></textarea>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis"> Upload foto<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="foto" id="foto"  type="file">
                                  </div>
                                </div>
                               
                                <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                      <button type="reset" class="btn btn-default" value="Reset">Reset</button>
                                      <a class="btn btn-primary" id="validate">Submit</a>
                                    </div>
                                  </div>
                                 </form>
                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title">Tabel Inventaris</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <form class="form-horizontal form-label-left">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              
                              <span class="section">Pencarian</span>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="produk">Kode Barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input type="text" class="form-control col-md-7 col-xs-12"  name="kode" id="carikode">
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_produk">Barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input type="text" class="form-control col-md-7 col-xs-12" id="caribarang" name="barang" >
                                    </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Ukuran
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="cariukuran" class="form-control col-md-7 col-xs-12" name="ukuran">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warna">Spefikasi
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input type="text" id="carispefikasi" class="form-control col-md-7 col-xs-12" name="spefikasi">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warna">pengguna
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input type="text" id="caripengguna" class="form-control col-md-7 col-xs-12" name="pengguna">
                                    </select>
                                  </div>
                                </div>
                                
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ketebalan">tanggal beli
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <input type="text" id="caritanggal" class="form-control col-md-7 col-xs-12 datepicker" data-date-format='yy-mm-dd' name="tanggal_pembelian" readonly>
                                    
                                  </div>
                                </div>
                               
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="finishing">Kondisi<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="prioritas" id="carikondisi" required="required">
                                      <option value="">Pilih Kondisi</option>
                                      <option value="Baik">Baik</option>
                                      <option value="Rusak">Rusak</option>
                                    </select>
                                  </div>
                                </div>
                                 


                                
                               
                                <div class="ln_solid"></div>
                                  <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                        <button type="reset" class="btn btn-default" value="Reset">Reset</button>
                                      <a class="btn btn-primary" id="filter">Cari</a>
                                    </div>
                                  </div>
                                 </form>
                            <table id="table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        
                                        <th width="5%">No</th>
                                        <th width="20%">Kode</th>
                                        <th width="20%">Barang</th>
                                        <th width="20%">Ukuran</th>
                                        <th width="20%">Spefikasi</th>
                                        <th width="20%">Pengguna</th>
                                        <th width="20%">Tanggal Beli</th>
                                        <th width="20%">Jumlah</th>
                                        <th width="20%">Kondisi</th>
                                        <th width="20%">Keterangan</th>
                                        <th width="20%">Foto</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                     
                                        <th width="5%">No</th>
                                        <th width="20%">Kode</th>
                                        <th width="20%">Barang</th>
                                        <th width="20%">Ukuran</th>
                                        <th width="20%">Spefikasi</th>
                                        <th width="20%">Pengguna</th>
                                        <th width="20%">Tanggal Beli</th>
                                        <th width="20%">Jumlah</th>
                                        <th width="20%">Kondisi</th>
                                        <th width="20%">Keterangan</th>
                                        <th width="20%">Foto</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                          </div>
                        </div>
                      </div>
                     
                    </div>
                    <!-- end of accordion -->


                  </div>
                </div>
              </div>

            
          </div>
        </div>

 <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="modubah" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Data Inventaris</h4>
                        </div>
                        <div class="modal-body">
                          <form action="#" id="formubah" class="form-horizontal" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>"  enctype="multipart/form-data" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                          <input name="id" id="id" type="hidden">
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kode">Kode Barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   
                                    <input class="form-control col-md-7 col-xs-12" minlength="2"  name="kode" required="required" id="kodeup"  type="text">
                                    
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">Nama Barang
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   
                                    <input class="form-control col-md-7 col-xs-12" name="barang" id="barangup"  required="required" type="text">
                                    
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ukuran">Ukuran
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   
                                    <select id="s2ukuranup" class="form-control col-md-7 col-xs-12" name="ukuran" required="required">
                                    </select>
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="spefikasi">Spefikasi
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <textarea type="text" name="spefikasi"  class="form-control col-md-7 col-xs-12" id="spefikasiup" required></textarea>
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="spefikasi">Pengguna
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <select id="s2penggunaup" class="form-control col-md-7 col-xs-12" name="pengguna[]">
                                    </select>
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal_pembelian">Tanggal Pembelian
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12 datepicker" name="tanggal_pembelian" required="required" id="tanggal_pembelianup"   type="text" readonly>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah">Jumlah
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="jumlah" required="required" id="jumlahup" data-parsley-type="integer" type="text">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Kondisi<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select  class="form-control col-md-7 col-xs-12" id="kondisiup" name="kondisi" required="required">
                                      <option value="">Pilih Kondisi..</option>
                                      <option value="Baik">Baik</option>
                                      <option value="Rusak">Rusak</option>
                                    </select>
                                  
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="keterangan">Keterangan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea type="text" name="keterangan"  id="keteranganup" class="form-control col-md-7 col-xs-12"></textarea>
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis"> Upload foto<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <img src="" class="img-thumbnail" id="fotoup" alt="foto"> 
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis"><span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="foto" type="file">
                                  </div>
                                </div>
                                </form>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <a class="btn btn-primary" id="validate2">Submit</a>
                          
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
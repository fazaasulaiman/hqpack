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
                    <h2><i class="fa fa-align-left"></i> Atur  Harga Distributor<small></small></h2>
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
                          <h4 class="panel-title">Form tambah harga distributor</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            
                            <form class="form-horizontal form-label-left" id="tambah" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <span class="section">Tambah Harga Distributor</span>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="distributor">Distributor<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2distributor" class="form-control col-md-7 col-xs-12" name="distributor" required="required">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">Barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2barangjasa" class="form-control col-md-7 col-xs-12" name="barangjasa" required="required">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warna">Warna
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2warna" class="form-control col-md-7 col-xs-12" name="warna">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="merk">Merk
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2merk" class="form-control col-md-7 col-xs-12" name="merk">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Size
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2size" class="form-control col-md-7 col-xs-12" name="size">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ketebalan">Ketebalan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2ketebalan" class="form-control col-md-7 col-xs-12" name="ketebalan">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                      <span class="input-group-addon">Rp</span>
                                      <input id="harga" type="text" class="form-control col-md-7 col-xs-12 harga"  name="harga" required="required">
                                      </input>
                                    </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Satuan">Satuan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2satuan" class="form-control col-md-7 col-xs-12" name="satuan">
                                    </select>
                                  </div>
                                </div>
                                 <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="produk">Id produk
                                  </label>
                                  <div class="col-md-4 col-sm-4 col-xs-6">
                                    <input class="form-control col-md-7 col-xs-6" minlength="2"   name="id_produk" type="text">
                                  </div>
                                  <div class="col-md-2 col-sm-2 col-xs-6">
                                    <input class="form-control col-md-7 col-xs-6 generateval" id="generateval" name="id_produk2"readonly="true">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tglorder">Tgl Update<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="tglgenerate" type="text" class="form-control col-md-7 col-xs-12 datepicker"  name="updated_on" required="required" readonly="readonly">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Keterangan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea type="text" name="keterangan" class="form-control col-md-7 col-xs-12"></textarea>
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
                          <h4 class="panel-title">Tabel Harga Distributor</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">
                            <form class="form-horizontal form-label-left">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <input name="id" id="cariid" type="hidden">
                              <input name="harga" id="cariharga" type="hidden">
                              <input name="id_produk" id="cariid_produk" type="hidden">
                              <input name="updated_on" id="cariupdated_on" type="hidden">
                              <input name="created_on" id="caricreated_on" type="hidden">
                              <input name="keterangan" id="cariketerangan" type="hidden">
                              <span class="section">Cari Harga Distributor</span>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="distributor">Distributor
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="caridistributor" class="form-control col-md-7 col-xs-12" name="distributor" >
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">Barang
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="caribarangjasa" class="form-control col-md-7 col-xs-12" name="barangjasa">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warna">Warna
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="cariwarna" class="form-control col-md-7 col-xs-12" name="warna">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="merk">Merk
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="carimerk" class="form-control col-md-7 col-xs-12" name="merk">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Size
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="carisize" class="form-control col-md-7 col-xs-12" name="size">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ketebalan">Ketebalan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="cariketebalan" class="form-control col-md-7 col-xs-12" name="ketebalan">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Satuan">Satuan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text"  id="carisatuan" class="form-control col-md-7 col-xs-12" name="satuan">
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
                            <button id="btn-show-all-children" type="button">Expand All</button>
                            <button id="btn-hide-all-children" type="button">Collapse All</button>
                            <hr>
                            <table id="table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%"></th>
                                        <th width="5%">No</th>
                                        <th width="20%">Distributor</th>
                                        <th width="20%">Barang</th>
                                        <th width="20%">Warna</th>
                                        <th width="20%">Merk</th>
                                        <th width="20%">Size</th>
                                        <th width="10%">Ketebalan</th>
                                        <th width="10%">Harga</th>
                                        <th width="10%">Satuan</th>
                                        <th width="20%">Creted on</th>
                                        <th width="20%">Tgl Update</th>
                                        <th width="20%">Id Produk</th>
                                        <th width="20%">Keterangan</th>
                                        <th width="5%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="5%"></th>
                                        <th width="5%">No</th>
                                        <th width="20%">Distributor</th>
                                        <th width="20%">Barang</th>
                                        <th width="20%">Warna</th>
                                        <th width="20%">Merk</th>
                                        <th width="20%">Size</th>
                                        <th width="20%">Ketebalan</th>
                                        <th width="20%">Harga</th>
                                        <th width="20%">Satuan</th>
                                        <th width="20%">Creted on</th>
                                        <th width="20%">Tgl Update</th>
                                        <th width="20%">Id Produk</th>
                                        <th width="20%">Keterangan</th>
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
                          <h4 class="modal-title" id="myModalLabel">Ubah Data Harga Distributor</h4>
                        </div>
                        <div class="modal-body" style="overflow:hidden;">
                          <form action="#" id="formubah" class="form-horizontal" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                          <input name="id" id="id" type="hidden">
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="distributor">Distributor<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select id="s2distributorup" class="form-control col-md-7 col-xs-12" name="distributor">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barang">Barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                     <select id="s2barangjasaup" class="form-control col-md-7 col-xs-12" name="barangjasa">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warna">Warna
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2warnaup" class="form-control col-md-7 col-xs-12" name="warna">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="merk">Merk
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2merkup" class="form-control col-md-7 col-xs-12" name="merk">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ketebalan">Ketebalan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2ketebalanup" class="form-control col-md-7 col-xs-12" name="ketebalan">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ketebalan">Size
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2sizeup" class="form-control col-md-7 col-xs-12" name="size">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="harga">Harga<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="input-group">
                                      <span class="input-group-addon">Rp</span>
                                      <input id="s2hargaup" type="text" class="form-control col-md-7 col-xs-12 harga"  name="harga" required="required">
                                      </input>
                                    </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ketebalan">Satuan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="s2satuanup" class="form-control col-md-7 col-xs-12" name="satuan">
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ketebalan">Tgl Update
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="s2updateup" class="form-control col-md-7 col-xs-12 datepicker"  name="updated_on" required="required" readonly="readonly">
                                  </div>
                                </div>
                                <div class="item form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="idproduk">Id Produk
                                  </label>
                                  <div class="col-md-4 col-sm-4 col-xs-6">
                                      <input id="s2idprodukup" type="text" class="form-control col-md-7 col-xs-12" name="id_produk">
                                      </input>
                                  </div>
                                  <div class="col-md-2 col-sm-2 col-xs-6">
                                    <input class="form-control col-md-7 col-xs-6 generateval" id="generateval" name="id_produk2"readonly="true">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="level">Keterangan
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea type="text" id="s2keteranganup" name="keterangan" class="form-control col-md-7 col-xs-12" ></textarea>
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
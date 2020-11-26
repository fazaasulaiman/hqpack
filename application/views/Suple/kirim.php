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
                    <h2><i class="fa fa-align-left"></i> Atur Barang<small></small></h2>
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
                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h4 class="panel-title">Pengiriman Barang</h4>
                          </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <?php if($this->session->userdata('LEVEL')==2){?>
                            <form class="form-horizontal form-label-left" id="form" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <input name="id_barang" id="id_barang" type="hidden">
                              <input name="id_kpm" id="id_kpm" type="hidden">
                              <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kpm">KPM<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="kpm" id="kpm" required="required" class="form-control col-md-7 col-xs-12" required="required" autocomplete="off">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Nama barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="barang" id="barang" required="required" class="form-control col-md-7 col-xs-12" required="required" autocomplete="off">
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Jumlah<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="input-group">
                                    <input class="form-control col-md-7 col-xs-12" id="jumlah" name="jumlah" required="required" data-parsley-type="integer" type="text">
                                    <span class="input-group-addon">Item</span>
                                     </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Harga Produksi<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="input-group">
                                  <span class="input-group-addon">Rp</span>
                                    <input class="form-control col-md-7 col-xs-12" id="produksi" name="produksi" required="required" data-parsley-type="integer" readonly type="text">
                                     </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Harga Jual<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="input-group">
                                  <span class="input-group-addon">Rp</span>
                                    <input class="form-control col-md-7 col-xs-12" id="jual" name="jual" required="required" data-parsley-type="integer" readonly type="text">
                                     </div>
                                  </div>
                                </div>                              
                                </form>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                      <button type="reset" class="btn btn-default" value="Reset">Reset</button>
                                      <a class="btn btn-primary" id="validate">Submit</a>
                                    </div>
                                  </div>
                               <br>
                                <div class="ln_solid"></div>
                            <?php } ?>
                          <form class="form-horizontal form-label-left" id="filter" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input id="id" name="id" required="required" type="hidden">
                             <input name="id_kpmcari" id="id_kpmcari" type="hidden">
                              <div class="row">
                              <div class="col-md-2 form-group">
                                <input type="text" name="tgl" id="tgl" class="form-control datepicker"  placeholder="Tanggal 1"> 
                              </div>
                              <div class="col-xs-1 form-group">
                              <h5>Sampai</h5>
                              </div>
                              <div class="col-md-2 form-group">
                                <input type="text" name="tgl2" id="tgl2" class="form-control datepicker"  placeholder="Tanggal 2"> 
                              </div>
                              <div class="col-md-2 form-group">
                                <input type="text" name="kpm" id="kpmcari" placeholder="Nama KPM" class="form-control" autocomplete="off">
                              </div>
                              <div class="col-md-2 form-group">
                                <input type="text" name="barang" id="barangcari" placeholder="nama barang" class="form-control">
                              </div>
                              <div class="col-md-2 form-group">
                                <select name="ket" id="ketcari" class="form-control">
                                  <option value="">Pilih Alasan</option>
                                  <option value="OK">OK</option>
                                  <option value="Barang Rusak">Barang Rusak</option>
                                  <option value="Jumlah Tidak Sesuai">Jumlah Tidak Sesuai</option>
                                </select>
                              </div>
                              </form>
                              <a class="btn btn-primary" id="filter">Filter</a>
                                </div>
                            <div class="table-responsive">
                              <table id="table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>KPM</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Produksi</th>
                                        <th>Harga Jual</th>
                                        <th>Jumlah Kirim</th>
                                        <th>Tanggal Diterima</th>
                                        <th>Jumlah Diterima</th>
                                        <th>Jumlah Selisih</th>
                                        <th>Keterangan</th>
                                        <?php if($this->session->userdata('LEVEL')==1){ ?>
                                        <th>Aksi</th>
                                        <?php }?>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>KPM</th>
                                        <th>Nama Barang</th>
                                        <th>Harga Produksi</th>
                                        <th>Harga Jual</th>
                                        <th>Jumlah Kirim</th>
                                        <th>Tanggal Diterima</th>
                                        <th>Jumlah Diterima</th>
                                        <th>Jumlah Selisih</th>
                                        <th>Keterangan</th>
                                        <?php if($this->session->userdata('LEVEL')==1){ ?>
                                        <th>Aksi</th>
                                        <?php }?>
                                    </tr>
                                </tfoot>
                            </table>
                           </div>
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
                          <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <div class="modal-body">
                          <form action="#" id="formubah" class="form-horizontal" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <input name="id" id="idget" type="hidden">
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user">Kode Barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" id="kode" name="kode" required="required"  type="text" readonly>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Nama barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="nama" id="nama" required="required" class="form-control col-md-7 col-xs-12" required="required" readonly>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Tanggal Kirim<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="tgl" id="tgledit" required="required"  class="form-control col-md-7 col-xs-12" required="required" readonly>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Jumlah Kirim<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="kirim" id="kirimedit" required="required" class="form-control col-md-7 col-xs-12" required="required" readonly>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Status<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control col-md-7 col-xs-12" name="status" required="required">
                                      <option value="">Pilih</option>
                                      <option value="Barang Rusak">Barang Rusak</option>
                                      <option value="Jumlah Tidak Sesuai">Jumlah Tidak Sesuai</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Jumlah Terima<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="terima" id="terima" required="required" class="form-control col-md-7 col-xs-12" required="required" data-parsley-type="integer">
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
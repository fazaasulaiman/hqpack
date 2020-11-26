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
                    <h2><i class="fa fa-align-left"></i> Koreksi Stock Gudang<small></small></h2>
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
                          <h4 class="panel-title">Form Koreksi Stock Gudang</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            
                            <form class="form-horizontal form-label-left" id="form" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <input name="id" id="id" type="hidden">
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Nama barang<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="barang" id="barang" required="required" class="form-control col-md-7 col-xs-12" required="required" autocomplete="off">
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
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Stok Komputer<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="input-group">
                                    <input class="form-control col-md-7 col-xs-12" id="stokkompi" name="stokkompi" required="required" data-parsley-type="integer" readonly type="text">
                                    <span class="input-group-addon">Item</span>
                                     </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Stok Nyata<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="input-group">
                                    <input class="form-control col-md-7 col-xs-12" id="stoknyata" name="stoknyata" required="required" data-parsley-type="integer" type="text">
                                    <span class="input-group-addon">Item</span>
                                     </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Qty. Selisih<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="input-group">
                                    <input class="form-control col-md-7 col-xs-12" id="selisih" name="selisih" required="required" data-parsley-type="integer" type="text" readonly>
                                    <span class="input-group-addon">Item</span>
                                     </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Nilai Selisih<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="input-group">
                                  <span class="input-group-addon">Rp</span>
                                    <input class="form-control col-md-7 col-xs-12" id="hargaselisih" name="hargaselisih" required="required" data-parsley-type="integer" type="text" readonly>
                                     </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Alasan<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <div class="col-md-3">
                                    <input type="radio" class="flat" name="alasan" id="alasan"  value="Hilang" required/>Hilang 
                                    </div>
                                    <div class="col-md-3">
                                    <input type="radio" class="flat" name="alasan" id="alasan" value="Rusak"/>Rusak
                                    </div>
                                  </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nis">Keterangan<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea class="form-control col-md-7 col-xs-12" required="required" name="ket" data-parsley-length="[3, 200]" placeholder="Keterangan untuk memperkuat alasan"></textarea>
                                  </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-3">
                                      <button type="reset" class="btn btn-default" value="Reset">Reset</button>
                                      <a class="btn btn-primary" id="validate">Submit</a>
                                    </div>
                                  </div>
                                </form>
                                
                               <br>
                                <div class="ln_solid"></div>
                                  
                          <form class="form-horizontal form-label-left" id="filter" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input id="id" name="id" required="required" type="hidden">
                              <div class="row">
                              <div class="col-md-2 form-group">
                                <input type="text" name="tgl" id="tgl" class="form-control datepicker"  placeholder="Tanggal 1"> 
                              </div>
                              <div class="col-md-1 form-group">
                              <h5>Sampai</h5>
                              </div>
                              <div class="col-md-2 form-group">
                                <input type="text" name="tgl2" id="tgl2" class="form-control datepicker"  placeholder="Tanggal 2"> 
                              </div>
                              <div class="col-md-3 form-group">
                                <input type="text" name="barang" id="barangcari" placeholder="nama barang" class="form-control">
                              </div>
                              <div class="col-md-3 form-group">
                                <select name="alasan" id="alasancari" class="form-control">
                                  <option value="">Pilih Alasan</option>
                                  <option value="Hilang">Hilang</option>
                                  <option value="Rusak">Rusak</option>
                                </select>
                              </div>
                              </form>
                              <a class="btn btn-primary" id="filter">Filter</a>
                                </div>
                              <table id="table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th >No</th>
                                        <th >Tanggal</th>
                                        <th >Kode</th>
                                        <th >Nama Barang</th>
                                        <th >Harga Produksi</th>
                                        <th >Stok Komputer</th>
                                        <th >Stok Nyata</th>
                                        <th >Qty. Selisih</th>
                                        <th >Nilai Selisih</th>
                                        <th >Alasan</th>
                                        <th >Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th >No</th>
                                        <th >Tanggal</th>
                                        <th >Kode</th>
                                        <th >Nama Barang</th>
                                        <th >Harga Produksi</th>
                                        <th >Stok Komputer</th>
                                        <th >Stok Nyata</th>
                                        <th >Qty. Selisih</th>
                                        <th >Nilai Selisih</th>
                                        <th >Alasan</th>
                                        <th >Keterangan</th>
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

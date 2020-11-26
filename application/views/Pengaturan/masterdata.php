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
                    <h2><i class="fa fa-align-left"></i> Atur Master Data<small></small></h2>
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
                          <h4 class="panel-title">Master Barang Jasa</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <form class="form-horizontal form-label-left" id="barangjasa" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                              <span class="section">Tambah Barang Jasa</span>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barangjasa">Barang / Jasa<span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="nama" required="required"  type="text">
                                  </div>
                                  <div class="col-md-3 col-sm-3 col-xs-12">
                                    <a class="btn btn-primary" id="validatebarangjasa">Submit</a>
                                  </div>
                                </div>
                            </form>
                             
                                <table id="tabelbarangjasa" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                  <thead>
                                      <tr>
                                          <th width="1%"></th>
                                          <th width="2%">No</th>
                                          <th width="20%">Barang / Jasa</th>
                                         
                                      </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                  <tfoot>
                                      <tr>
                                          <th width="1%"></th>
                                          <th width="2%">No</th>
                                          <th width="20%">Barang / Jasa</th>
                                      </tr>
                                  </tfoot>
                                </table>
                          </div>
                        </div>
                      </div>
                     <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h4 class="panel-title">Master Warna</h4>
                      </a>
                      <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                          <form class="form-horizontal form-label-left" id="warna" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <span class="section">Tambah Warna</span>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="warna">Warna<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input class="form-control col-md-7 col-xs-12" name="nama" required="required"  type="text">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                  <a class="btn btn-primary" id="validatewarna">Submit</a>
                                </div>
                              </div>
                          </form>
                           
                              <table id="tabelwarna" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Warna</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Warna</th>
                                    </tr>
                                </tfoot>
                              </table>
                        </div>
                      </div>
                    </div>
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h4 class="panel-title">Master Merk</h4>
                      </a>
                      <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                          <form class="form-horizontal form-label-left" id="merk" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <span class="section">Tambah Merk</span>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="merk">Merk<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input class="form-control col-md-7 col-xs-12" name="nama" required="required"  type="text">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                  <a class="btn btn-primary" id="validatemerk">Submit</a>
                                </div>
                              </div>
                          </form>
                           
                              <table id="tabelmerk" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Merk</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Merk</th>
                                    </tr>
                                </tfoot>
                              </table>
                        </div>
                      </div>
                    </div>
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingFour" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <h4 class="panel-title">Master Size</h4>
                      </a>
                      <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                        <div class="panel-body">
                          <form class="form-horizontal form-label-left" id="size" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <span class="section">Tambah Size</span>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Size<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input class="form-control col-md-7 col-xs-12" name="nama" required="required"  type="text">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                  <a class="btn btn-primary" id="validatesize">Submit</a>
                                </div>
                              </div>
                          </form>
                           
                              <table id="tabelsize" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Size</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Size</th>
                                    </tr>
                                </tfoot>
                              </table>
                        </div>
                      </div>
                    </div>
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingFive" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <h4 class="panel-title">Master Ketebalan</h4>
                      </a>
                      <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                        <div class="panel-body">
                          <form class="form-horizontal form-label-left" id="ketebalan" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <span class="section">Tambah Ketebalan</span>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ketebalan">Ketebalan<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input class="form-control col-md-7 col-xs-12" name="nama" required="required"  type="text">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                  <a class="btn btn-primary" id="validateketebalan">Submit</a>
                                </div>
                              </div>
                          </form>
                           
                              <table id="tabelketebalan" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Ketebalan</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Ketebalan</th>
                                    </tr>
                                </tfoot>
                              </table>
                        </div>
                      </div>
                    </div>
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingSix" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        <h4 class="panel-title">Master Satuan</h4>
                      </a>
                      <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                        <div class="panel-body">
                          <form class="form-horizontal form-label-left" id="satuan" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <span class="section">Tambah Satuan</span>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="satuan">Satuan<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input class="form-control col-md-7 col-xs-12" name="nama" required="required"  type="text">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                  <a class="btn btn-primary" id="validatesatuan">Submit</a>
                                </div>
                              </div>
                          </form>
                           
                              <table id="tabelsatuan" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Satuan</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Satuan</th>
                                    </tr>
                                </tfoot>
                              </table>
                        </div>
                      </div>
                    </div>
                     <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingSeven" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        <h4 class="panel-title">Master Kategori Beban</h4>
                      </a>
                      <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                        <div class="panel-body">
                          <form class="form-horizontal form-label-left" id="kategori" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <span class="section">Tambah Kategori</span>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategori">Kategori<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input class="form-control col-md-7 col-xs-12" name="nama" required="required"  type="text">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                  <a class="btn btn-primary" id="validatekategori">Submit</a>
                                </div>
                              </div>
                          </form>
                           
                              <table id="tabelkategori" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Kategori</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Kategori</th>
                                    </tr>
                                </tfoot>
                              </table>
                        </div>
                      </div>
                    </div>
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingTen" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                        <h4 class="panel-title">Master Jenis Distributor</h4>
                      </a>
                      <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                        <div class="panel-body">
                          <form class="form-horizontal form-label-left" id="jenisdistributor" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <span class="section">Tambah Jenis Distributor</span>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jenisdistributor">Jenis Distributor<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input class="form-control col-md-7 col-xs-12" name="nama" required="required"  type="text">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                  <a class="btn btn-primary" id="validatejenisdistributor">Submit</a>
                                </div>
                              </div>
                          </form>
                           
                              <table id="tabeljenisdistributor" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Jenis DIstributor</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Jenis DIstributor</th>
                                    </tr>
                                </tfoot>
                              </table>
                        </div>
                      </div>
                    </div>
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingEight" data-toggle="collapse" data-parent="#accordion" href="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        <h4 class="panel-title">Master Produk Konsumen</h4>
                      </a>
                      <div id="collapseEight" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEight">
                        <div class="panel-body">
                          <form class="form-horizontal form-label-left" id="produk_konsumen" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <span class="section">Tambah Produk Konsumen</span>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategori">Produk Konsumen<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input class="form-control col-md-7 col-xs-12" name="nama" required="required"  type="text">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                  <a class="btn btn-primary" id="validateprodukkonsumen">Submit</a>
                                </div>
                              </div>
                          </form>
                           
                              <table id="tabelprodukkonsumen" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Produk Konsumen</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Produk Konsumen</th>
                                    </tr>
                                </tfoot>
                              </table>
                        </div>
                      </div>
                    </div>
                    <div class="panel">
                      <a class="panel-heading collapsed" role="tab" id="headingNine" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                        <h4 class="panel-title">Master Margin</h4>
                      </a>
                      <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                        <div class="panel-body">
                          <form class="form-horizontal form-label-left" id="margin" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <span class="section">Tambah Margin</span>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategori">Margin<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input class="form-control col-md-7 col-xs-12" name="nama" required="required"  type="text">
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-12">
                                  <a class="btn btn-primary" id="validatemargin">Submit</a>
                                </div>
                              </div>
                          </form>
                           
                              <table id="tabelmargin" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Margin</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="1%"></th>
                                        <th width="2%">No</th>
                                        <th width="20%">Margin</th>
                                    </tr>
                                </tfoot>
                              </table>
                        </div>
                      </div>
                    </div>











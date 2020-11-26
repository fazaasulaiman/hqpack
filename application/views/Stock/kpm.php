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
                    <h2><i class="fa fa-align-left"></i>Jumlah Stok  di setiap KPM<small></small></h2>
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
                          <h4 class="panel-title">Jumlah Stok  di setiap KPM</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                          <div class="panel-body">
                            <form class="form-horizontal form-label-left" id="filter" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input id="id" name="id" required="required" type="hidden">
                              <div class="row">
                              <div class="col-md-5 form-group">
                                <input type="text" name="barang" id="kpmcari" placeholder="nama KPM" class="form-control" autocomplete="off">
                              </div>
                              <div class="col-md-5 form-group">
                                <input type="text" name="barang" id="barangcari" placeholder="nama barang" class="form-control" autocomplete="off">
                              </div>
                              </form>
                                <a class="btn btn-primary" id="filter">Filter</a>
                                </div>
                                <br>
                                <table id="table" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>                                       
                                        <th width="5%">No</th>
                                        <th width="20%">KPM</th>
                                        <th width="20%">Kode</th>
                                        <th width="20%">Nama Barang</th>
                                        <th width="20%">Jumlah Stok</th>
                                        <th width="5%">Harga Produksi</th>
                                        <th width="5%">Harga Jual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="20%">KPM</th>
                                        <th width="20%">Kode</th>
                                        <th width="20%">Nama Barang</th>
                                        <th width="20%">Jumlah Stok</th>
                                        <th width="5%">Harga Produksi</th>
                                        <th width="5%">Harga Jual</th>
                                    </tr>
                                </tfoot>
                            </table>
                                </div>
                              </div>
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
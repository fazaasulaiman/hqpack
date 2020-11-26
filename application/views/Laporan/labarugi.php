<div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Laporan Laba Rugi</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                    
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                <i class="fa fa-money"></i> Laba Rugi.
                                <small class="pull-right">Date: <?php echo date("d/m/Y")?></small>
                              </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <div class="row">
                      <form id="form" data-parsley-validate>
                      <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                        <input type="hidden" id="id" name="id">
                      <div class="col-md-2 form-group">
                        <input type="text" name="tgl" id="tgl1" class="form-control datepicker"  placeholder="Tanggal 1" required="required"> 
                      </div>
                      <div class="col-xs-1 form-group">
                        <h5>Sampai</h5>
                      </div>
                      <div class="col-md-2 form-group">
                        <input type="text" name="tgl2" id="tgl2" class="form-control datepicker"  placeholder="Tanggal 2" required="required"> 
                      </div>
                      <div class="col-md-2 col-md-offset-2 form-group">
                        <input type="text" class="form-control" id="kpm" name="kpm" placeholder="KPM" required="required">
                      </div>
                        <a class="btn btn-primary" id="pencarian">Submit</a>
                        </form>
                      </div>
                      <!-- Table row -->
                      <div class="row printini">
                        <div class="col-xs-12 table">
                          <table class="table">
                            <tbody>
                              <tr>
                                <td>Laba Kotor</td>
                                <td></td>
                                <td id="kotor"></td>
                              </tr>
                              <tr>
                                <td>Pengeluaran Biaya:</td>
                                <td></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td>-Hilang</td>
                                <td id="hilang"></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td>-Rusak</td>
                                <td id="rusak"></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td>-FOC</td>
                                <td id="foc"></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td>Total Pengeluaran</td>
                                <td id="pengeluaran"></td>
                                <td id="pengeluaran2"></td>
                              </tr>
                              <tr>
                                <td>Laba Bersih</td>
                                <td></td>
                                <td id="tot"></td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          <a class="btn btn-success pull-right" id="pdf"><i class="fa fa-download"></i> PDF</a>
                          
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
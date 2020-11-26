<div class="row">
  <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Laporan <small>Analitik </small></h2>
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

                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
                      <div class="col-md-12">
                        <div class="row">
                          <form id="form" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" id="id" name="id">
                          <div class="col-md-2 form-group">
                            <input type="text" name="tahun" id="tahun" class="form-control"  placeholder="Tahun" required="required"> 
                          </div>
                          <div class="col-md-2 form-group">
                            <input type="text" class="form-control" id="kpm" name="kpm" placeholder="KPM" required="required">
                          </div>
                          <div class="col-md-2 form-group">
                            <select class="form-control" id="bandingtahun">
                            <option>Pilih Laba</option>
                              <option value="kotor">Laba Kotor</option>
                              <option value="bersih">Laba Bersih</option>
                            </select>
                          </div>
                            <a class="btn btn-primary" id="pencarian">Submit</a>
                            </form>
                        </div>
                        <div class="row">
                          <form id="form2" data-parsley-validate>
                          <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" id="id1" name="id1">
                            <input type="hidden" id="id2" name="id2">
                          <div class="col-md-2 form-group">
                            <input type="text" name="tgl1" id="tgl1" class="form-control datepicker"  placeholder="Tanggal 1" required="required"> 
                          </div>
                           
                          <div class="col-md-2 form-group">
                            <input type="text" name="tgl2" id="tgl2" class="form-control datepicker"  placeholder="Tanggal 2" required="required"> 
                          </div>
                          <div class="col-md-2 form-group">
                            <input type="text" class="form-control" id="kpm1" name="kpm1" placeholder="KPM 1" required="required">
                          </div>
                          <div class="col-md-2 form-group">
                            <input type="text" class="form-control" id="kpm2" name="kpm2" placeholder="KPM 2" required="required">
                          </div>
                          <div class="col-md-2 form-group">
                            <select class="form-control" id="bandingkpm">
                              <option>Pilih Laba</option>
                              <option value="kotor">Laba Kotor</option>
                              <option value="bersih">Laba Bersih</option>
                            </select>
                          </div>
                            <a class="btn btn-primary" id="pencarian2">Submit</a>
                            </form>
                        </div>
                        <div id="taruh">
                          
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
</div>

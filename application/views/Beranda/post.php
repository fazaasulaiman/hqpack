<input type="hidden" name="sisennow" value="<?php echo $this->session->userdata('ID');?>"  id="sisennow" style="display: none">
<script type="text/javascript">
      var BASE_URL = "<?php echo base_url(); ?>";
      var Broadcast = {
              POST : "<?php echo POST; ?>",
              BROADCAST_URL : "<?php echo BROADCAST_URL; ?>",
              BROADCAST_PORT : "<?php echo BROADCAST_PORT; ?>",
              };
    </script>
<div class="row">
            <div class="col-md-8 col-sm-8 col-xs-8">
            <div class="x_panel">
                  <div class="x_title">
                    <h2><i class="fa fa-bars"></i> Posting <small>Loker</small></h2>
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
                            <form id="formpost" data-parsley-validate>
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                                <div class="form-group">
                                    <textarea name="posting" placeholder="Apa yang Anda ingin sampaikan?" class="form-control" required="required" data-parsley-length="[6, 300]"></textarea>
                                </div>
                              </form>
                                <div class="row">
                                    <a class="btn btn-primary pull-right" id="validate">Kirim</a>
                                </div>
                          <div class="ln_solid"></div>
                        <ul class="messages">
                            
                        </ul>
                        <div class="row">
                        <div class="text-center">
                            <button type="button" class="btn btn-default btn-lg" id="load_more" data-val = "0">Load more</button>
                        </div>
                      </div>

                </div>
              </div>
            </div>
        </div>
                            
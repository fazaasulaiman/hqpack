$(document).ready(function() {
	var kirim;
	var form;
 var max_fields      = 10;
 var x = 1;
   $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "top auto",
        todayBtn: true,
        todayHighlight: true  
    },{
  onClose: function() {
    $('.datepicker').validate();
    }
});

   $('#addform').click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $('.addingform').append('<div class="col-md-6 form-group"><input type="text" name="prestasi[]" class="form-control"><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
   $('.addingform').on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    });
   $('#validate').click(function () {
    if ( $('#formdiri').parsley().validate() && $('#formpendidikan').parsley().validate() && $('#formgemar').parsley().validate()){
    		kirim='diri';
    		form= $("#formdiri, #formpendidikan,#formgemar").serialize();
    		save(kirim,form);
        }else{
      gagal();
    }
 
});
   $('#validate2').click(function () {
    if ( $('#formayah').parsley().validate() && $('#formibu').parsley().validate()){
            kirim='wali';
            form= $("#formayah, #formibu,#formwali").serialize();
            save(kirim,form);
        }else{
      gagal();
    }
 
});
    $('#validate3').click(function () {
    if ( $('#formkeadaan').parsley().validate() && $('#formprestasi').parsley().validate()){
            kirim='keadaan';
            form= $("#formkeadaan, #formprestasi").serialize();
            save(kirim,form);
        }else{
      gagal();
    }
 
});
     $('#crop').click(function () {
   
      crop();
    
});
   runpro();
   rundiri();
   runwali();
   runeko();
   runfoto();
});

$("#imgInp").change(function(){
  $('.jcrop-holder img').attr('src','');
      var formData = new FormData($('#formupload')[0]);
 $.ajax({
        url : site_url+"Regis/upload",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data)
        {
            if(data.status){
              d = new Date();
              t=d.getTime();
            $('#pppreview').prop('src', data.url+t);
            $('.jcrop-holder img').attr('src', data.url+t);
            
            }else{
              new PNotify({
              title: 'Gagal',
              text: data.gagal,
              type: 'notice',
              styling: 'bootstrap3',
              delay:3000
          });

            }


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('error update data');
            $('#btnSave').text('Daftar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
 var selectcrop=$('#pppreview').Jcrop({
  bgColor: 'black',
  bgOpacity:0.6,
  maxSize:[220,220],
  minSize:[220,220],
  aspectRatio: 1,
  setSelect: [0, 160, 160, 0], 
  onSelect: storeCoords,

  });
  
});
function crop(){
  
}
function storeCoords(c){
  $('#cropx').val(c.x);
  $('#cropy').val(c.y);
  $('#cropw').val(c.w);
  $('#croph').val(c.h);
}
function runpro(){
    var $select = $('.propinsi');
        $.ajax({
            url: site_url+"Master/runpro",
            dataType: 'JSON',
            success: function (data) {
                $.each(data, function (i, val) {
                    $select.append('<option value="' + val.id_pro + '">' + val.propinsi + '</option>');  
                });
            }
        });


$('.propinsi').change(function(){
            var $this = $(this);
            var val = $this.val();
            $this.parents().next().children('.kota').empty();
            $.ajax({
                url: site_url+"Master/runkab/"+val,
                dataType: 'JSON',
                success: function (data) {
                    
                    $.each(data, function (i, valu) {
                        $this.parents().next().children('.kota').append('<option value="' + valu.id_kab + '">' + valu.kota + '</option>');
                    });
                }
            });
        });
$('.kota').change(function(){
            var $this = $(this);
            var val = $this.val();
            $this.parents().parents().next().children().next().next().children('.kec').empty();
            $.ajax({
                url: site_url+"Master/runkec/"+val,
                dataType: 'JSON',
                success: function (data) {
                    
                    $.each(data, function (i, valu) {
                        $this.parents().parents().next().children().next().next().children('.kec').append('<option value="' + valu.id_kec + '">' + valu.kecamatan + '</option>');
                    });
                }
            });
        });


}
function rundiri(){
  $('#lokasi').empty();
  $('#program').empty();
    var url = site_url+"Regis/rundiri";
    $.getJSON(url,function(data) {
                $('#id').val(data.id);
                $('#jk').val(data.jk);
                $('#agama').val(data.agama);
                $('.nama').text(data.panggilan);
                $('#program').append(data.program);
                $('.nama').val(data.panggilan);
                $('#lokasi').append(data.kecamatan+', '+data.kota+', '+data.propinsi);
                $('#fullname').val(data.nama);
                $('#tempat').val(data.tempatlahir);
                $('#tgl').val(data.tgllahir);
                $('#nohp').val(data.hp);
                $('#anak').val(data.anakke);
                $('#tinggal').val(data.tempattinggal);
                $('#saudara').val(data.sodara);
                $('#kwn').val(data.warganegara);
                $('#tinggi').val(data.tinggi);
                $('#berat').val(data.berat);
                $('#goldar').val(data.darah);
                $('#propinsi').val(data.prov);
                $('#kota').val(data.kab);
                $('#penyakit').val(data.penyakit);
                $('#cacat').val(data.kelainan);
                $('#kec').val(data.kec);
                $('#jarak').val(data.jarak);
                $('#alamat').val(data.alamat);
                $('#nisn').val(data.nisn);
                $('#smp').val(data.namasmp);
                $('#smk').val(data.namasmk);
                $('#paketasl').val(data.keahlian);
                $('#noijazah').val(data.noijazah);
                $('#tglijazah').val(data.tglijazah);
                $('#tglmasuk').val(data.tglmasuk);
                $('#alasan').val(data.alasan);
                $('#alamatsmp').val(data.alamatsmp);
                $('#olahraga').val(data.olahraga);
                $('#kendaraan').val(data.kendaraan);
                $('#merk').val(data.tipekendaraan);
                $('#seni').val(data.kesenian);
                $('#tahunbuat').val(data.tahunbuat);
                $('#nopol').val(data.nopol);
                $('#organisasi').val(data.organisasi);
            });

}
function runwali(){
    var url = site_url+"Regis/runwali";
    $.getJSON(url,function(data) {
        $('#id').val(data.id);
            $('[name="nis"]').val(data.nis);
             $('[name="fullnameayah"]').val(data.ayah);
             $('[name="tempatayah"]').val(data.t4lahirayah);
             $('[name="tglayah"]').val(data.tgllahirayah);
             $('[name="agamaayah"]').val(data.agamaayah);
             $('[name="kwnayah"]').val(data.warganegaraayah);
             $('[name="pendidikanayah"]').val(data.pendidikanayah);
             $('[name="profesiayah"]').val(data.pekerjaanayah);
             $('[name="penghasilanayah"]').val(data.gajiayah);
             $('[name="alamatayah"]').val(data.alamatayah);
             $('[name="statusayah"]').val(data.statusayah);
              $('[name="nohpayah"]').val(data.hpayah);
              $('[name="fullnameibu"]').val(data.ibu);
              $('[name="tempatibu"]').val(data.t4lahiribu);
              $('[name="tglibu"]').val(data.tgllahiribu);
              $('[name="agamaibu"]').val(data.agamaibu);
              $('[name="kwnibu"]').val(data.warganegaraibu);
              $('[name="pendidikanibu"]').val(data.pendidikanibu);
              $('[name="profesiibu"]').val(data.pekerjaanibu);
              $('[name="penghasilanibu"]').val(data.gajiibu);
              $('[name="alamatibu"]').val(data.alamatibu);
              $('[name="statusibu"]').val(data.statusibu);
              $('[name="nohpibu"]').val(data.hpibu);
              $('[name="fullnamewali"]').val(data.wali);
              $('[name="tempatwali"]').val(data.t4lahirwali);
              $('[name="tglwali"]').val(data.tgllahirwali);
              $('[name="agamawali"]').val(data.agamawali);
              $('[name="kwnwali"]').val(data.warganegarawali);
              $('[name="pendidikanwali"]').val(data.pendidikanwali);
              $('[name="profesiwali"]').val(data.pekerjaanwali);
              $('[name="penghasilanwali"]').val(data.gajiwali);
              $('[name="alamatwali"]').val(data.alamatwali);
              $('[name="statuswali"]').val(data.statuswali);
              $('[name="nohpwali"]').val(data.hpwali);
              
            });

}
function runeko(){
    var url = site_url+"Regis/eko";
    $.getJSON(url,function(data) {
        $('#id').val(data.id);
        $('input[name="fisikrumah"][value="' + data.kondisirumah + '"]').iCheck('check');
        $('input[name="pemilikanrumah"][value="' + data.statusrumah + '"]').iCheck('check');
        $('input[name="ekonomi"][value="' + data.ekonomi + '"]').iCheck('check');
        var array = data.hpkluarga.split(',');
        $('#hp1').val(array[0]);
        $('#hp2').val(array[1]);
        $('#hp3').val(array[2]);
        $('#hp4').val(array[3]);
        var sarana= data.sarana.split(',');
        for (i = 0; i < sarana.length; i++) {
        $('input[name="sarana[]"][value="' + sarana[i] + '"]').iCheck('check'); 
        if(i==sarana.length-3){
          $('#tv1').val(sarana[i].replace('tv=', '')); 
          }
        if(i==sarana.length-2){
           $('#motor1').val(sarana[i].replace('motor=', ''));
        }
        if(i==sarana.length-1){
          $('#mobil1').val(sarana[i].replace('mobil=', ''));
        }
        }
        var prestasi= data.prestasi.split(',');
       for(i=0;i<prestasi.length;i++){
        $('.addingform').empty();
        $('.addingform').append('<div class="col-md-6 form-group"><input type="text" name="prestasi[]" class="form-control" value="'+prestasi[i]+'"><a href="#" class="remove_field">Remove</a></div>');

       }


        
        
      });

}
function save(kirim,form){
  $('.btn-primary').text('simpan...');
  $('.btn-primary').attr('disabled', true);
	var url;
	var formnya;
  var reload;
	if (kirim==='diri') {
	url=site_url+"Regis/diri";
	formnya=form;
  rel=1;	
	}else if(kirim==='wali') {
	url=site_url+"Regis/wali";
	formnya=form;
    rel=2;
	}else if(kirim==='keadaan'){
    formnya=form;
	url=site_url+"Regis/keadaan";
  rel=3;	
	}
	             $.ajax({
                context: this,
                url: url,
                type: "POST",
                data: formnya,
                dataType: "JSON",
                success: function(data)
                {       
                    if(data.status){
                    $('form').each(function() { this.reset(); });
                    if(rel===1){
                        rundiri();
                        runfoto();
                        PNotify.removeAll();
                        status();
                    }else if(rel==2){
                        runwali();
                        PNotify.removeAll();
                        status();
                    }else{
                        runeko();
                        PNotify.removeAll();
                        status();
                    }
                    berhasil();
                    $('.btn-primary').text('simpan');
                    $('.btn-primary').attr('disabled', false);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Terjadi error');
                }
            });
}
function crop(){
   $('#image').removeAttr('src');
  $.ajax({
                context: this,
                url: site_url+"Regis/crop",
                type: "POST",
                data: $('#formcrop').serialize(),
                dataType: "JSON",
                success: function(data)
                {   
                berhasil();  
                $('#pppreview').attr('src',data.url+ new Date().getTime()); 
                $('#modal').modal('hide');
                runfoto();
                fotomenu();
                  
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    
                }
            });

}
function runfoto(){

  var url = site_url+"Regis/foto";
    $.getJSON(url,function(data) {
                if(data.foto!==null){
                  $('#pp').attr('src',site_url+'production/images/'+data.foto+'?'+ new Date().getTime()); 
                    }
                    else{
                      $('#pp').attr('src',site_url+'production/images/user.png?'+ new Date().getTime());
                     
                    }
              
            });
}
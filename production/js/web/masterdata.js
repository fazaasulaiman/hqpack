// load tabel awal

$(function() {
	tabelbarangjasa = $('#tabelbarangjasa').DataTable({ 
	 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": site_url+"Master/runmasterdata/barangjasa",
	            "type": "POST"
	        },
	});
	tabelwarna = $('#tabelwarna').DataTable({ 
	 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": site_url+"Master/runmasterdata/warna",
	            "type": "POST"
	        },
	});
	tabelmerk = $('#tabelmerk').DataTable({ 
	 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": site_url+"Master/runmasterdata/merk",
	            "type": "POST"
	        },
	});
	tabelsize = $('#tabelsize').DataTable({ 
	 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": site_url+"Master/runmasterdata/size",
	            "type": "POST"
	        },
	});
	tabelketebalan = $('#tabelketebalan').DataTable({ 
	 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": site_url+"Master/runmasterdata/ketebalan",
	            "type": "POST"
	        },
	});
	tabelsatuan = $('#tabelsatuan').DataTable({ 
	 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": site_url+"Master/runmasterdata/satuan",
	            "type": "POST"
	        },
	});
	tabelkategori = $('#tabelkategori').DataTable({ 
	 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": site_url+"Master/runmasterdata/kategori",
	            "type": "POST"
	        },
	});
	tabelprodukkonsumen = $('#tabelprodukkonsumen').DataTable({ 
	 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": site_url+"Master/runmasterdata/produk_konsumen",
	            "type": "POST"
	        },
	});
	tabelmargin = $('#tabelmargin').DataTable({ 
	 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": site_url+"Master/runmasterdata/margin",
	            "type": "POST"
	        },
	});
	tabeljenisdistributor = $('#tabeljenisdistributor').DataTable({ 
	 
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "order": [], //Initial no order.
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": site_url+"Master/runmasterdata/jenisdistributor",
	            "type": "POST"
	        },
	});
});


// validasi
$('#validatebarangjasa').click(function () {
    if ( $('#barangjasa').parsley().validate()){
        save('barangjasa');
    }
    else
    {
      gagal();
    }
});
$('#validatewarna').click(function () {
    if ( $('#warna').parsley().validate()){
        save('warna');
    }
    else
    {
      gagal();
    }
});
$('#validatemerk').click(function () {
    if ( $('#merk').parsley().validate()){
        save('merk');
    }
    else
    {
      gagal();
    }
});
$('#validatesize').click(function () {
    if ( $('#size').parsley().validate()){
        save('size');
    }
    else
    {
      gagal();
    }
});
$('#validateketebalan').click(function () {
    if ( $('#ketebalan').parsley().validate()){
        save('ketebalan');
    }
    else
    {
      gagal();
    }
});
$('#validatesatuan').click(function () {
    if ( $('#satuan').parsley().validate()){
        save('satuan');
    }
    else
    {
      gagal();
    }
});
$('#validatekategori').click(function () {
    if ( $('#kategori').parsley().validate()){
        save('kategori');
    }
    else
    {
      gagal();
    }
});
$('#validateprodukkonsumen').click(function () {
    if ( $('#produk_konsumen').parsley().validate()){
        save('produk_konsumen');
    }
    else
    {
      gagal();
    }
});
$('#validatemargin').click(function () {
    if ( $('#margin').parsley().validate()){
        save('margin');
    }
    else
    {
      gagal();
    }
});
$('#validatejenisdistributor').click(function () {
    if ( $('#jenisdistributor').parsley().validate()){
        save('jenisdistributor');
    }
    else
    {
      gagal();
    }
});





////tambah data
function save(tabel){
    $('#send').text('Submit...'); //change button text
    $('#send').attr('disabled'); //set button enable 
    
 $.ajax({
        context: this,
        url: site_url+"Master/addmasterdata/"+tabel,
        type: "POST",
        data: $('#'+tabel).serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal 
            {
                berhasil();
                $('#'+tabel)[0].reset();
                $('#send').text('Submit'); 
                $('#send').attr('disabled',false);
                console.log(tabel);
                switch (tabel) {
				  case 'barangjasa':
				    tabelbarangjasa.ajax.reload(null,false);
				    break;
				  case 'warna':
				    tabelwarna.ajax.reload(null,false);
				    break;
				  case 'merk':
				    tabelmerk.ajax.reload(null,false);
				    break;
				  case 'size':
				    tabelsize.ajax.reload(null,false);
				    break;
				  case 'ketebalan':
				    tabelketebalan.ajax.reload(null,false);
				    break;
				  case 'satuan':
				    tabelsatuan.ajax.reload(null,false);
				    break;
				   case 'kategori':
				    tabelkategori.ajax.reload(null,false);
				    break;
				     case 'produk_konsumen':
				    tabelprodukkonsumen.ajax.reload(null,false);
				    break;
				    case 'margin':
				    tabelmargin.ajax.reload(null,false);
				    break;
				    case 'jenisdistributor':
				   	tabeljenisdistributor.ajax.reload(null,false);
				    break;
				}
                
            }else{
                info(data.ket);
            }
            $('#send').text('Submit'); //change button text
            $('#send').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            info('data tidak boleh sama');
            $('#send').text('Submit'); //change button text
            $('#send').attr('disabled',false); //set button enable 

        }
    });
}

//hapus data
function hapus(nama,id,tabelnya){
      if(confirm('apakah ada yakin ingin menghapus data ini "'+nama+'"')){
    var url = site_url+"Master/hpsmasterdata/"+tabelnya+':';
  $.ajax({
        url : url+id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {   
            
             if(data.status){
                berhasil();
               switch (tabelnya) {
				  case 'barangjasa':
				    tabelbarangjasa.ajax.reload(null,false);
				    break;
				  case 'warna':
				    tabelwarna.ajax.reload(null,false);
				    break;
				  case 'merk':
				    tabelmerk.ajax.reload(null,false);
				    break;
				  case 'size':
				    tabelsize.ajax.reload(null,false);
				    break;
				  case 'ketebalan':
				    tabelketebalan.ajax.reload(null,false);
				    break;
				  case 'satuan':
				    tabelsatuan.ajax.reload(null,false);
				    break;
				   case 'kategori':
				    tabelkategori.ajax.reload(null,false);
				    break;
				    case 'produk_konsumen':
				    tabelprodukkonsumen.ajax.reload(null,false);
				    break;
				    case 'margin':
				    tabelmargin.ajax.reload(null,false);
				    break;
				    case 'jenisdistributor':
				   	tabeljenisdistributor.ajax.reload(null,false);
				    break;
				}
            } 
        }
     });
  } 
  else {
    return false;
  }
    
}
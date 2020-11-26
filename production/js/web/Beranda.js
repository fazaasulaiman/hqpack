 $(document).ready(function() {
singkat();
});
function singkat(){
    url=site_url+"Master/ranking";
    var warna = ['blue','green','purple','aero','red','grey','orange','pink','yellow','minimal']
    $.getJSON(url,function(val) 
        {   
            
            var html;
            var i=0;
            $.each(val.rank.penjualan, function( subindex, subval ) {

                 html += '<tr><td><p>'+[i+1]+'. '+subval.konsumen+'</p></td>';
                 html += '<td>Rp. '+subval.penjualan+'</td></tr>';
                 i++;            
            });
            $('#penjualan').append(html);  
            html='';
            i=0;
            $.each(val.rank.aktivitas, function( subindex, subval ) {

                  html += '<tr><td><p>'+[i+1]+'. '+subval.konsumen+'</p></td>';
                 html += '<td>'+subval.aktivitas+' X</td></tr>';
                 i++;            
            });
            $('#aktivitas').append(html);          
        });
}


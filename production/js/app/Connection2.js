var Connection2 = (function(){

  function Connection2(url) {

      this.open = false;

      this.socket = new WebSocket("ws://" + url);
      this.setupConnectionEvents();
    }

  Connection2.prototype = {
    setupConnectionEvents : function () {
          var self = this;

          self.socket.onopen = function(evt) { self.connectionOpen(evt); };
          self.socket.onmessage = function(evt) { self.connectionMessage(evt); };
          self.socket.onclose = function(evt) { self.connectionClose(evt); };
      },

      connectionOpen : function(evt){
          this.open = true;
          this.addSystemMessage("Connected");
    },
      connectionMessage : function(evt){
          var data = JSON.parse(evt.data);
                
          this.addChatMessage(data.msg);
      },
      connectionClose : function(evt){
          this.open = false;
          this.addSystemMessage("Disconnected");
      },

      sendMsg : function(message){
        
          this.socket.send(JSON.stringify({
              msg : message
          }));
      },

      addChatMessage : function(data){
        
        switch(data.broadType){
          case Broadcast.POST : this.addNewPost(data); break;
          default : console.log("nothing to do");
        }
      },
    
      addNewPost : function(data){
      
      var months = new Array(12);
                months[0] = "Jan";
                months[1] = "Feb";
                months[2] = "Mar";
                months[3] = "Apr";
                months[4] = "Mei";
                months[5] = "Jun";
                months[6] = "Jul";
                months[7] = "Aug";
                months[8] = "Sept";
                months[9] = "Okto";
                months[10] = "Nov";
                months[11] = "Des";
                var html;
                var hps;
                var foto;
                var tabel='posting';
                html='';
      var val = data.data;

      d = new Date();
      t=d.getTime();
      var tgl = new Date(Date.parse(val.tgl));
      var day = tgl.getDate();
      var bulan = tgl.getMonth();
      var year = tgl.getFullYear().toString().substr(2, 2);
      if(val.foto!==null){
      foto= site_url+'production/images/'+val.foto+'?'+t;
          }
      if(val.foto===null){
               foto= site_url+'production/images/user.png';
          }
      if(val.panggilan!==null){
        user= val.panggilan;
            }
      if(val.panggilan===null){
        user= val.nama;
            }                        
      if($('#sisennow').val()===val.idakun){
      hps='<div class="row"><a href="#dlt" data-id="'+val.id+'" data-tabel="'+tabel+'" class="btn btn-xs btn-link pull-right"><i class="fa fa-times"></i></a></div>'; 
      }
      else{
        hps='';
      }
      html+='<li>'+hps;    
      html+='<img src="'+foto+'" class="avatar" alt="Avatar">';
      html+='<div class="message_date"><h3 class="date text-info">'+day+'</h3><p class="month">'+months[bulan]+'</p><p class="year">'+year+'</p></div>';
      html+='<div class="message_wrapper"><h4 class="heading">'+user+'</h4><small>'+val.jam+'</small>';
      html+='<blockquote class="message">'+val.posting+'</blockquote><br/>';
      html+='</div></li>';

        $(".messages").prepend(html);
      },
    
      addSystemMessage : function(msg){
          // this.chatwindow.innerHTML += "<p>" + msg + "</p>";
      }
    };

    return Connection2;

})();

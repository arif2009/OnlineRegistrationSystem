<script type="text/javascript">
    //Changing semister with changing year 
    $("select[name='drpYear']").change(function() {
       var year = $(this).val();
       if (year == 'default') {
          alert('Please Select Department');
          return false;
       }
       else if(year == '1st'){
            var msg  = "<select id='drpSemister' name='drpSemister' class='deptSelect grid_5'>";
                msg += "<option value='default' selected='selected'>Select Subject year</option>";
                msg += "<option value='2nd'>Second</option>";
                msg += "</select>";
            $('#semisterDiv').html(msg);
            return true;
      } 
      else{
          var msg  = "<select id='drpSemister' name='drpSemister' class='deptSelect grid_5'>";
              msg += "<option value='default' selected='selected'>Select Subject Semister</option>";
              msg += "<option value='1st'>First</option>";
              msg += "<option value='2nd'>Second</option>";
              msg += "</select>";
          $('#semisterDiv').html(msg);
      }
      return false;
    });
    //Script for Waiting
    var ray={
        ajax:function(){
                this.show('load');
        },
        show:function(animation){
                this.getID(animation).style.display='';
        },
        getID:function(animation){
                return document.getElementById(animation);
        }
    }
</script>
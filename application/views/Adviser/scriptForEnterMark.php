<!--Script for enterMark page-->
<script type="text/javascript">
    //Changing semister with changing year 
    $("select[name='drpYear']").change(function() {
       var year = $(this).val();
       if (year == 'default') {
          alert('Please Select Department');
          return false;
       }
       else if(year == '1st'){
            var msg  = "<select id='subSemister' name='subSemister' class='deptSelect grid_5'>";
                msg += "<option value='default' selected='selected'>Select Subject year</option>";
                msg += "<option value='2nd'>Second</option>";
                msg += "</select>";
            $('#semisterDiv').html(msg);
            return true;
      } 
      else{
          var msg  = "<select id='subSemister' name='subSemister' class='deptSelect grid_5'>";
              msg += "<option value='default' selected='selected'>Select Subject Semister</option>";
              msg += "<option value='1st'>First</option>";
              msg += "<option value='2nd'>Second</option>";
              msg += "</select>";
          $('#semisterDiv').html(msg);
      }
      return false;
    });
    
    //Select radio to load book and 
    $("input[name='rdoSubjectType']").click(function(){
        var deptId          = $('#drpDepartmentName').val();
        var subjectYear     = $('#drpYear').val();
        var subjectSemister = $('#subSemister').val();
        var subjectType     = $(this).val();
        var exam            = $('#exam');
        var message         = 'You must Select Subject ';
        var messageCounter  = 0;
        if(deptId == 'default'){
            message += '* Department';
            messageCounter++;
        }
        if(subjectYear == 'default'){
            message += '* Year';
            messageCounter++;
        }
        if(subjectSemister == 'default'){
            message += '* Semister';
            messageCounter++;
        }
        if(messageCounter > 0){
            alert(message);
            $('#rdoSubjectType').removeAttr('checked');
            return false;
        }
        else{
             var theory = "<span class='grid_7 radio'>";
             theory += "<input type='radio' id='rdoExamType' value='finalExam' name='rdoExamType' onclick='return ShowTheoryFinalExam()'>Final Exam Mark ";
             theory += "<input type='radio' id='rdoExamType' value='others' name='rdoExamType' onclick='return ShowTheoryOthers()'>Others Mark";
             theory += "</span>";
             theory += "<span style='color:red; margin-left: 1px' class='grid_1 alpha'>*</span><span class='grid_3'></span>";
             
             var sessional = "<span class='grid_7 radio'>";
             sessional += "<input type='radio' id='rdoExamType' value='labAssessment' name='rdoExamType' onclick='return ShowSessionalLabAss()'>Lab Assessment ";
             sessional += "<input type='radio' id='rdoExamType' value='attendanceQuize' name='rdoExamType' onclick='return ShowSessionalQA()'>Quize &amp; Attendance";
             sessional += "</span>";
             sessional += "<span style='color:red; margin-left: 1px' class='grid_1 alpha'>*</span><span class='grid_3'></span>";
             
             var form_data = {
                 deptId         :deptId,
                 subjectYear    :subjectYear,
                 subjectSemister:subjectSemister,
                 subjectType    :subjectType,
                 ajax: '1'		
             };
             
              $.ajax({
                  url: "<?php echo site_url('adviser/GetSubjectForEnterMark'); ?>",
                  type: 'POST',
                  data: form_data,
                  success: function(msg) {
                    $('#subjectDiv').html(msg);
                    
                    if(subjectType == 'theory'){
                        exam.html(theory);
                    }
                    else{
                        exam.html(sessional);
                    }
                  }
              });
       }
    });
    //Show the student for enter mark, when Subject type theory and Exam type others
       function ShowTheoryOthers(){
           var subjectCode = $('#drpSubject').val();
           $('#ok').removeAttr('disabled');
           var form_data = {
                 subjectCode:subjectCode,
                 ajax       : '1'		
             };
           $.ajax({
                  url: "<?php echo site_url('adviser/GetStudentToGiveTheoryOthers'); ?>",
                  type: 'POST',
                  data: form_data,
                  success: function(msg) {
                    $('#markTable').html(msg);
                  }
              });
       }
       //For summation total mark of CT and Attendance(when Subject type theory and Exam type others)
        function sumOfCtAttendance(i){
            var ct = new Array(5);
            ct[0] = Number($('input[name="ct1['+i+']"]').val());
            ct[1] = Number($('input[name="ct2['+i+']"]').val());
            ct[2] = Number($('input[name="ct3['+i+']"]').val());
            ct[3] = Number($('input[name="ct4['+i+']"]').val());
            ct[4] = Number($('input[name="ct5['+i+']"]').val());
            ct.sort(SortFunc);
            function SortFunc(a,b){
                return(b-a); //sort decending order
            }
            var attendance = Number($('input[name="attendance['+i+']"]').val());
            var total = ct[0]+ct[1]+ct[2]+ct[3]+attendance;
            $('input[name="total['+i+']"]').attr('value',total);
        }

    //Show the student for enter mark, when Subject type theory and Exam type finalExam
       function ShowTheoryFinalExam(){
           var subjectCode = $('#drpSubject').val();
           $('#ok').removeAttr('disabled');
           var form_data = {
                 subjectCode:subjectCode,
                 ajax       : '1'		
             };
           $.ajax({
                  url: "<?php echo site_url('adviser/GetStudentToGiveTheoryFinal'); ?>",
                  type: 'POST',
                  data: form_data,
                  success: function(msg) {
                    $('#markTable').html(msg);
                  }
              });
       }
       //For summation of final exam and others mark (when Subject type theory and Exam type finalExam)
        function sumOfFinalOthers(i){
            var gpa, gradeLetter;
            var finalMark       = Number($('input[name="final['+i+']"]').val());
            var ctAndAttendance = Number($('input[name="ctAttend['+i+']"]').val());
            var total       = finalMark + ctAndAttendance;
            $('input[name="total['+i+']"]').attr('value', total);
            var grade = parseInt(total/15);
            switch(grade)
            {
                case 20:
                case 19:
                case 18:
                case 17:
                case 16:
                gpa  = 4;
                gradeLetter = 'A+';
                break;

                case 15:
                gpa  = 3.75;
                gradeLetter = 'A';
                break;

                case 14:
                gpa = 3.5;
                gradeLetter = 'A-';
                break;

                case 13:
                gpa = 3.25;
                gradeLetter = 'B+';
                break;

                case 12:
                gpa = 3;
                gradeLetter = 'B';
                break;

                case 11:
                gpa = 2.75;
                gradeLetter = 'B-';
                break;

                case 10:
                gpa = 2.5;
                gradeLetter = 'C+';
                break;

                case 9:
                gpa = 2.25;
                gradeLetter = 'C';
                break;

                case 8:
                gpa = 2;
                gradeLetter = 'D';
                break;

                default:
                gpa = 0;
                gradeLetter = 'F';
            }
            $('input[name="GPA['+i+']"]').attr('value',gpa);
            $('input[name="gradeLetter['+i+']"]').attr('value',gradeLetter);
        }
        
      //Show the student for enter mark, when Subject type Sessional and Exam type LabAssesment
      function ShowSessionalLabAss(){
         var subjectCode = $('#drpSubject').val();
         $('#ok').removeAttr('disabled');
           var form_data = {
                 subjectCode:subjectCode,
                 ajax       : '1'		
             };
           $.ajax({
                  url: "<?php echo site_url('adviser/GetStudentToGiveSessionalLabAss'); ?>",
                  type: 'POST',
                  data: form_data,
                  success: function(msg) {
                    $('#markTable').html(msg);
                  }
            });
      }
      
      //Show the student for enter mark, when Subject type Sessional and Exam type Quize and Attendance
      function ShowSessionalQA(){
         var subjectCode = $('#drpSubject').val();
         $('#ok').removeAttr('disabled');
           var form_data = {
                 subjectCode:subjectCode,
                 ajax       : '1'		
             };
           $.ajax({
                  url: "<?php echo site_url('adviser/GetStudentToGiveSessionalQA'); ?>",
                  type: 'POST',
                  data: form_data,
                  success: function(msg) {
                    $('#markTable').html(msg);
                  }
            });
      }
      //For summation total Contineous Assesment Quize and attendance (when Subject type sessional and Exam type Quize & attendance)
      function sumOfCAQuizeAttendance(i){
            var gpa, gradeLetter;
            var quize      = Number($('input[name="quize['+i+']"]').val());
            var attendance = Number($('input[name="attendance['+i+']"]').val());
            var contEva    = Number($('input[name="contEva['+i+']"]').val());
            var total      = quize + attendance + contEva;
            var grade      = parseInt(total/5);
            switch(grade)
            {
                case 20:
                case 19:
                case 18:
                case 17:
                case 16:
                gpa  = 4;
                gradeLetter = 'A+';
                break;

                case 15:
                gpa  = 3.75;
                gradeLetter = 'A';
                break;

                case 14:
                gpa = 3.5;
                gradeLetter = 'A-';
                break;

                case 13:
                gpa = 3.25;
                gradeLetter = 'B+';
                break;

                case 12:
                gpa = 3;
                gradeLetter = 'B';
                break;

                case 11:
                gpa = 2.75;
                gradeLetter = 'B-';
                break;

                case 10:
                gpa = 2.5;
                gradeLetter = 'C+';
                break;

                case 9:
                gpa = 2.25;
                gradeLetter = 'C';
                break;

                case 8:
                gpa = 2;
                gradeLetter = 'D';
                break;

                default:
                gpa = 0;
                gradeLetter = 'F';
            }
            $('input[name="total['+i+']"]').attr('value', total);
            $('input[name="gpa['+i+']"]').attr('value',gpa);
            $('input[name="gradeLetter['+i+']"]').attr('value',gradeLetter);
        }
</script>


//Script for image checking onUpload
function createReader(file, whenReady) {
    //check image height and width
    var files = file.files[0];
    var reader = new FileReader();
    reader.onload = function(evt){
        var image = new Image();
        image.onload = function(evt){
            var width = this.width;
            var height = this.height;
            if (whenReady) whenReady(width, height);
        };
        image.src = evt.target.result; 
    };
    reader.readAsDataURL(files);
}
function ImageValidation(){
    var value = document.getElementById('file');
    createReader(value, function(w, h) {
        if(w>300 || h>300){
            alert("Image Size is too large.\n Maximum supported image is(300 X 300).\n Your image size is " + w +" X " + h);
            value.value = '';
        }
        else if(w<150 || h<100){
            alert("Image Size is too small.\n Minimum required image size(150 X 100).\n Your image size is " + w +" X " + h);
            value.value = '';
        }
        
    });
return false;
}
function CheckImageType(){
    var extensions  = new Array("jpg","jpeg","gif","png","bmp");
    var img_control = document.getElementById('file');
    var image_file  = img_control.value;
    var image_length= image_file.length;
    var pos         = image_file.lastIndexOf('.') + 1;
    var ext         = image_file.substring(pos, image_length);
    var final_ext   = ext.toLowerCase();
    for (i = 0; i < extensions.length; i++)
    {
        if(extensions[i] == final_ext)
        {
        return true;
        }
    }
    alert("You must upload an image file with one of the following extensions: "+ extensions.join(', ') +".");
    img_control.value = '';
    return false;
}
//End Script for image checking onUpload

//Receive no field blank or not
function ReceiveRadioValidation(){
    var receiveNo = document.getElementById('txtReceiveNo');
    var checkAll = document.courseRegistration.chkBox;
    var j=0;
    for (i = checkAll.length-1; i >= 0; i--){
            if(checkAll[i].checked == true)
                j++;
    }
    if(receiveNo.value == '' && j<9){
        alert('You must put receive no and Select all of current semister Subject.');
        return(false);
    }
    else if(receiveNo.value == ''){
        alert('You must put receive no.');
        return(false);
    }
    else if(j<9){
        alert('You must be Select all of current semister Subject.');
        return(false);
    }
    else{
        return(true);
    }
}

//This script checks all check box
function CheckAll(chkBox){
    var checkAll = document.getElementById('btnCheckAll');
    if(checkAll.value == 'Checked All'){
        for (i = 0; i < chkBox.length; i++)
            chkBox[i].checked = true ;
        checkAll.value = 'Uncheck All';
    }
    else{
        for (i = 0; i < chkBox.length; i++)
            chkBox[i].checked = false ;
        checkAll.value = 'Checked All';
    }
}
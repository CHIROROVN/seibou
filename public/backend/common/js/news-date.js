   $(document).ready(function(){
    var date = new Date();
    var year = date.getFullYear();
    var month    = date.getMonth()+1;
    var day = format2Digit(date.getDate());

    var oldYear = "{{old('year')}}";
    var oldMonth = "{{old('month')}}";
    var oldDay = "{{old('day')}}";

    var oldTotalDays = new Date(oldYear,oldMonth,1,-1).getDate();
    var opthtml = "<option value=''>--日</option>";

    for(var i=1; i<=oldTotalDays; i++){
      opthtml += '<option value="' + format2Digit(i) + '">'+ format2Digit(i) +'日</option>';
    }
    $('#day').html(opthtml);
    $('#day option[value="' + oldDay + '"]').prop('selected',true);

  });


$('#year').click(function(event) {
    var date = new Date();
    var year = date.getFullYear();
    var month    = format2Digit(date.getMonth()+1);
    var day = format2Digit(date.getDate());
    var totaldays = new Date(year,month,1,-1).getDate();
    var opthtml = "<option value=''>--日</option>";

    for(var i=1; i<=totaldays; i++){
      opthtml += '<option value="' + format2Digit(i) + '">'+ format2Digit(i) +'日</option>';
    }
    $('#day').html(opthtml);

    if( $(this).val() == '' ){
      $('#month option[value=""]').prop('selected',true);
      $('#day option[value=""]').prop('selected',true);
    }else{
      $('#month option[value="' + month + '"]').prop('selected',true);
      $('#day option[value="' + day + '"]').prop('selected',true);
    }

   $('#month').click(function(event) {
    var cyear = $('#year').val();
    var cmonth = $(this).val();
    var totaldays = new Date(cyear,cmonth,1,-1).getDate();

    var opthtml = "<option value=''>--日</option>";

    for(var i=1; i<=totaldays; i++){
      opthtml += '<option value="' + format2Digit(i) + '">'+ format2Digit(i) +'日</option>';
    }
    $('#day').html(opthtml);

    if( $(this).val() == '' ){
      $('#day option[value=""]').prop('selected',true);
    }else{
      $('#day option[value="' + day + '"]').prop('selected',true);
    }

   });

});


function format2Digit(num)
{
  if(num < 10) { return '0'+num }
  else return num;
}
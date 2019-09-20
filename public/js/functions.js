$(function()
{
	
	$('.filed-checkbox label').change(function(event) {

        $(this).toggleClass('active');
        /* Act on the event */
    });

	
	var d = new Date();
	time_h=d.getHours();
	time_m=d.getMinutes();
	time_s=d.getSeconds();

	wr_clock();
	setInterval(wr_clock,1000);


	function calc(){
		var amount = parseFloat($('#money').val());
		if (amount <= 5000){
			var plan= 10;
			$('#plan-text').text('10% Daily for forever');
		}
		else{
			var plan=12;
			$('#plan-text').text('12% Daily for forever');
		}
		var result = parseFloat( (amount*plan)/100 ).toFixed(2);
		var resultweekly = (result * 7).toFixed(2);
		$('#daily_profit').text(result);
		$('#weekly_profit').text(resultweekly);
		var days = $('#plan-choose option:selected').data('day');
		var totalprofit = parseFloat(result * 30).toFixed(2);
		$('#total_profit').text(totalprofit);
		
	}
	calc();
	$('#money').keyup(function(){
		calc();
	});
	$('#money').change(function(){
		calc();
	});
	$('#money').click(function() {
         $(this).attr('value', '');  
    });
	
	
      function radioactive(){
	    $('.plan-inner > input[type="radio"]').each(function(){
	      if($(this).is(":checked")) {
		     $(this).parent('.plan-inner').addClass('selected');
		  }
		  else{
		     $(this).parent('.plan-inner').removeClass('selected');
		  }
	    });
	  }
	  radioactive(); 
      $('.plan-inner > input[type="radio"]').change(function(){
	      radioactive();
          if($('input.h_id1').is(":checked")) {
		     $('#money').val('10')
		  }	
          if($('input.h_id2').is(":checked")) {
		     $('#money').val('5001')
		  }	
         calc();		  
	  });	  
      $('#money').keyup(function(){
	     var inputamt = parseFloat($('#money').val());
		 if(inputamt >= 5001){
		    $('input.h_id2').prop('checked', true);
		 }
		 else{
		    $('input.h_id1').prop('checked', true);
		 }
		 radioactive(); 
	  });  
  
	
	var clipboard = new Clipboard('.btn');
	
	
});


	function dig2(d)
	{
		return ((d<10)?"0":"")+d;
	}
	function wr_clock(object)
	{
		$("#clock").html(dig2(time_h)+':'+dig2(time_m)+':'+dig2(time_s));
		$("#clock1").html(dig2(time_h)+':'+dig2(time_m)+':'+dig2(time_s));
		time_s++;
		if (time_s>=60)
		{
			time_s=0;
			time_m++;
			if (time_m>=60)
			{
				time_m=0;
				time_h++;
				if (time_h>=24)
				{
					time_h=0;
				}
			}
		}
	}

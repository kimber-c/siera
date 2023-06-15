jQuery.validator.setDefaults({
	errorPlacement: function(error, element) 
	{ 	

		// console.log(element.parent().parent('.form-group').find('.sValidate'));
		// if(element.parent().parent('.form-group').find('.sValidate').hasClass('.sValidate'))
		// {
		// 	element.parent().parent('.form-group').find('.sValidate').attr('class');
		// 	console.log('encontro');
		// }
		if(element.parent().parent('.form-group').find('.input-group-prepend').hasClass('input-group-prepend'))
		{
			// error.appendTo(element.parent('.input-group').parent('form-group').find('label').html()); 
			// console.log(element.parent().parent().find('.input-group-prepend').hasClass('input-group-prepend'));
			// console.log(element.parent().parent('.form-group').hasClass('form-group'));
			// console.log(element.parent().parent('.form-group').find('.input-group-prepend').hasClass('input-group-prepend'));
			error.appendTo(element.parent().parent('.form-group')); 
			// console.log('entro aki');
		}
		else
		{
			if(element.parent('.input-group').hasClass('input-group'))
			{
				// if()
				// console.log('si tiene');
				error.appendTo(element.parent('.input-group')); 
			}
			else
			{
				error.appendTo(element.parent('.form-group')); 
			}
			// console.log(element.parent('.form-group'));
			// error.appendTo(element.parent('.input-group')); 
			// error.appendTo(element.prev()); 
		}
		if(element.parent().find('[id=numeroPart]').attr('id')=='numeroPart' || element.parent().find('[id=numeroPart]').attr('id')=='anioPart')
		{
			// console.log('si entro aiki----------');
			error.appendTo(element.parent().parent('form-group'));
		}
		// console.log('validacion start-------------------------------');
		// console.log(element.parent().find('[id=numeroPart]').attr('id')=='numeroPart');
		// console.log(element.parent().parent().attr('class'));
		// console.log('validacion end-------------------------------');
	}
});
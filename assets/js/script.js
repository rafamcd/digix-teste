$(function(){

	$('#cnpj').mask('00.000.000/0000-00');	
        $('#cpf').mask('000.000.000-00');	
        $('#data_nascimento').mask('00/00/0000');	
        $('#telefone').mask('(00) 00000-0000');
        $('#telefonecel').mask('(00) 000000-0000');
        $('#cep').mask('00.000-000');
       $('input[name=renda]').mask('000.000.000.000.000,00', {reverse:true, placeholder:"0,00"}); 

	
});

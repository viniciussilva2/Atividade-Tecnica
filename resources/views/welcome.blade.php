

<!DOCTYPE html>
<html lang="pt-br">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <div style="text-align:center">


    <!--Titulo da Página-->
    <title>Projeto LABCHECAP</title>


    
<!-- Adicionando JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>

<!-- Adicionando Javascript -->
<script>

    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#rua").val("");
            $("#bairro").val("");
            $("#cidade").val("");
            $("#uf").val("");
            $("#ibge").val("");
        }
        
        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#rua").val("...");
                    $("#bairro").val("...");
                    $("#cidade").val("...");
                    $("#uf").val("...");
                    $("#ibge").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#rua").val(dados.logradouro);
                            $("#bairro").val(dados.bairro);
                            $("#cidade").val(dados.localidade);
                            $("#uf").val(dados.uf);
                            $("#ibge").val(dados.ibge);
                        } 
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alert("CEP não encontrado.");
                        }
                    });
                }
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            } 
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });

</script>
    </head>

    <body>

<!--Formulário de Cadastro da empresa-->
<div style="text-align:center">
    <h1>CADASTRO DE EMPRESA.</h1>

    @if(session()->has('success'))
    <h1>Empresa cadastradas com sucesso!</h1>
    @endif
   
        <form action="{{ route('cadastrar-empresa') }}" method="POST">
           
        @csrf
            <!--campos do Formulário-->
            <label>Nome da Empresa</label>
            <input type="text" required placeholder="Digite o nome da empresa." name="nome">
            <br>
            <br>
            <label>CNPJ da Empresa</label>
            <input type="text" required placeholder="Digite o CNPJ da empresa." name="cnpj">
            <br>
            <br>
            <label>Telefone da Empresa</label>
            <input type="text" required placeholder="Digite o telefone da empresa." name="telefone">
            <br>
            <br>
            <label>CEP da Empresa</label>
            <input type="text" required placeholder="Digite o CEP da empresa." name="cep">
            <br>
            <br>
            <label>Endereço da Empresa</label>
            <input type="text" required placeholder="Digite endereço da empresa." name="endereco">

            <br>
                <br>
                    <br>
                        <br>
           
            <button>Cadastrar Empresa</button>
            <br>
                <br>
                    <br>
                        <br>
                            <br>
                                <br>
        <!--UTILIZAÇÃO DE API DO VIACEP-->
        </form>
        <div style="text-align:left">
        <form method="get" action=".">
        <label><h2>Consultar Endereço da Empresa via CEP:</h2>
        <br>
        Digite o CEP da empresa:
        <!--INPUT DO CEP QUE SERÁ BUSCADO-->
        <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" />
        <br>
         <br>
         <!--DADOS RERTORNADOS-->
        <input name="rua" type="text" id="rua">
        <label>Bairro:
        <input name="bairro" type="text" id="bairro">
        <label>Cidade:
        <input name="cidade" type="text" id="cidade">
        <label>Estado:
        <input name="uf" type="text" id="uf">
        <label>IBGE:
        <input name="ibge" type="text" id="ibge">
      </form>
         
    </body>
</html>




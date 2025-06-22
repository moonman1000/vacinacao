<<<<<<< HEAD
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Vacinação</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <style>
        body {
            background-color: #f5f5f5;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card-registration {
            max-width: 600px;
            width: 100%;
            margin: auto;
            border: none;
        }
        .card-header {
            text-align: center;
        }
        .logo_title {
            color: #fff;
            font-size: 1.5rem;
            margin-top: 20px;
        }
        .input-group-prepend .input-group-text {
            background-color: #fff;
        }
        .submit_btn {
            background-color: #28a745;
            color: #fff;
        }
        .submit_btn:hover {
            background-color: #218838;
        }
        .back_btn {
            background-color: #007bff;
            color: #fff;
        }
        .back_btn:hover {
            background-color: #0056b3;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .form-check-label {
            color: #fff;
        }
    </style>
    <script>
        function validarNome(event) {
            const input = event.target;
            const valor = input.value.trim();
            if (/\d/.test(valor) || /^\d/.test(valor)) {
                input.setCustomValidity('O nome não pode conter números.');
            } else {
                input.setCustomValidity('');
            }
        }

        function formatarTelefone(event) {
            const input = event.target;
            let valor = input.value.replace(/\D/g, '');
            let formattedValue = '';

            if (valor.length > 11) {
                valor = valor.slice(0, 11);
            }

            if (valor.length > 2) {
                formattedValue = `(${valor.substring(0, 2)}) ${valor.substring(2, 11)}`;
            } else if (valor.length > 0) {
                formattedValue = `(${valor}`;
            }

            input.value = formattedValue;
        }

        function limitarIdade(event) {
            const input = event.target;
            if (input.value.length > 3) {
                input.value = input.value.slice(0, 3);
            }
        }
    </script>
</head>
<body>
<div class="container">
    <div class="card card-registration mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            
            <span class="logo_title mt-5">PARÔQUIA NOSSA SENHORA DE FÁTIMA<br>Cadastro de Membros</span>
        </div>
        <div class="card-body">
            <?php
            if (isset($_GET['insert_success']) && $_GET['insert_success'] == 'true') {
                echo "<div class='success-message'>Cadastro realizado com sucesso!</div>";
                echo "<div class='success-message'>Um Agente de Saúde Entrará em Contato!</div>";
            }
            ?>
            <form action="processa.php" method="POST">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" required oninput="validarNome(event)">
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                    <input type="number" id="idade" name="idade" class="form-control" placeholder="Idade" required oninput="limitarIdade(event)">
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" id="telefone" name="telefone" class="form-control" pattern="\(\d{2}\) \d{9}" title="Por favor, insira um telefone válido com o formato (99) 999999999" oninput="formatarTelefone(event)" placeholder="Telefone" required>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" id="vacinado_gripe" name="vacinado_gripe" class="form-check-input" value="Sim">
                        <label class="form-check-label" for="vacinado_gripe">Vacinado contra Gripe</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="vacinado_covid" name="vacinado_covid" class="form-check-input" value="Sim">
                        <label class="form-check-label" for="vacinado_covid">Vacinado contra Covid-19</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success submit_btn float-right">Enviar</button>
                    <a href="index.php" class="btn btn-outline-primary back_btn float-left">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

=======
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Vacinação</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <style>
        body {
            background-color: #f5f5f5;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card-registration {
            max-width: 600px;
            width: 100%;
            margin: auto;
            border: none;
        }
        .card-header {
            text-align: center;
        }
        .logo_title {
            color: #fff;
            font-size: 1.5rem;
            margin-top: 20px;
        }
        .input-group-prepend .input-group-text {
            background-color: #fff;
        }
        .submit_btn {
            background-color: #28a745;
            color: #fff;
        }
        .submit_btn:hover {
            background-color: #218838;
        }
        .back_btn {
            background-color: #007bff;
            color: #fff;
        }
        .back_btn:hover {
            background-color: #0056b3;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .form-check-label {
            color: #fff;
        }
    </style>
    <script>
        function validarNome(event) {
            const input = event.target;
            const valor = input.value.trim();
            if (/\d/.test(valor) || /^\d/.test(valor)) {
                input.setCustomValidity('O nome não pode conter números.');
            } else {
                input.setCustomValidity('');
            }
        }

        function formatarTelefone(event) {
            const input = event.target;
            let valor = input.value.replace(/\D/g, '');
            let formattedValue = '';

            if (valor.length > 11) {
                valor = valor.slice(0, 11);
            }

            if (valor.length > 2) {
                formattedValue = `(${valor.substring(0, 2)}) ${valor.substring(2, 11)}`;
            } else if (valor.length > 0) {
                formattedValue = `(${valor}`;
            }

            input.value = formattedValue;
        }

        function limitarIdade(event) {
            const input = event.target;
            if (input.value.length > 3) {
                input.value = input.value.slice(0, 3);
            }
        }
    </script>
</head>
<body>
<div class="container">
    <div class="card card-registration mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            
            <span class="logo_title mt-5">PARÔQUIA NOSSA SENHORA DE FÁTIMA<br>Cadastro de Membros</span>
        </div>
        <div class="card-body">
            <?php
            if (isset($_GET['insert_success']) && $_GET['insert_success'] == 'true') {
                echo "<div class='success-message'>Cadastro realizado com sucesso!</div>";
                echo "<div class='success-message'>Um Agente de Saúde Entrará em Contato!</div>";
            }
            ?>
            <form action="processa.php" method="POST">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" required oninput="validarNome(event)">
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                    </div>
                    <input type="number" id="idade" name="idade" class="form-control" placeholder="Idade" required oninput="limitarIdade(event)">
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" id="telefone" name="telefone" class="form-control" pattern="\(\d{2}\) \d{9}" title="Por favor, insira um telefone válido com o formato (99) 999999999" oninput="formatarTelefone(event)" placeholder="Telefone" required>
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" id="vacinado_gripe" name="vacinado_gripe" class="form-check-input" value="Sim">
                        <label class="form-check-label" for="vacinado_gripe">Vacinado contra Gripe</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" id="vacinado_covid" name="vacinado_covid" class="form-check-input" value="Sim">
                        <label class="form-check-label" for="vacinado_covid">Vacinado contra Covid-19</label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success submit_btn float-right">Enviar</button>
                    <a href="dashboard.php" class="btn btn-outline-primary back_btn float-left">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

>>>>>>> 68221b35f241cb4d8c71073fab7709096587fc5d

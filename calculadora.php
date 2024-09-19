<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcular a Média com conceito</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
           background: linear-gradient(to bottom, red, black);
            min-height: 100vh;
            margin: 0; 
            color: white; 
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Cálculo de Média</h1>
        <form method="POST" class="mt-4">
            <div class="mb-3 row">
                <label for="media1" class="form-label col-sm-2">Média 1</label>
                <div class="col-sm-4">
                    <input type="number" step="0.1" class="form-control form-control-sm" id="media1" name="media1" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="media2" class="form-label col-sm-2">Média 2</label>
                <div class="col-sm-4">
                    <input type="number" step="0.1" class="form-control form-control-sm" id="media2" name="media2" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="media3" class="form-label col-sm-2">Média 3</label>
                <div class="col-sm-4">
                    <input type="number" step="0.1" class="form-control form-control-sm" id="media3" name="media3" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="media4" class="form-label col-sm-2">Média 4</label>
                <div class="col-sm-4">
                    <input type="number" step="0.1" class="form-control form-control-sm" id="media4" name="media4" required>
                </div>
            </div>
            <button type="submit" class="btn btn-secondary">Calcular a Média</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['media1'], $_POST['media2'], $_POST['media3'], $_POST['media4'])) {

            $media1 = (float) $_POST['media1'];
            $media2 = (float) $_POST['media2'];
            $media3 = (float) $_POST['media3'];
            $media4 = (float) $_POST['media4'];

            $mediaFinal = ($media1 + $media2 + $media3 + $media4) / 4;

            if ($mediaFinal >= 9) {
                $conceito = 'A';
                $mensagem = 'Aluno Aprovado';
            } elseif ($mediaFinal >= 7) {
                $conceito = 'B';
                $mensagem = 'Aluno Aprovado';
            } elseif ($mediaFinal >= 4) {
                $conceito = 'C';
                $mensagem = 'Recuperação, tem a possibilidade de passar';
            } else {
                $conceito = 'D';
                $mensagem = 'Poxa vida, Ano que vem vai tentar novamente';
            }

            echo "<div class='mt-4'>";
            echo "<h2 class='text-center'>Resultado</h2>";
            echo "<p>Média Final: <strong>$mediaFinal</strong></p>";
            echo "<p>Conceito: <strong>$conceito</strong></p>";
            echo "<p><strong>$mensagem</strong></p>";
            echo "</div>";

            if ($conceito == 'C') {
                echo '
                <form method="POST" class="mt-3">
                    <input type="hidden" name="mediaFinal" value="'.$mediaFinal.'">
                    <div class="mb-3">
                        <label for="recuperacao" class="form-label">Nota da Recuperação</label>
                        <input type="number" step="0.1" class="form-control form-control-sm col-sm-4" id="recuperacao" name="recuperacao" required>
                    </div>
                    <button type="submit" class="btn btn-warning">Verificar Recuperação</button>
                </form>';
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['recuperacao'], $_POST['mediaFinal'])) {
            $mediaFinal = (float) $_POST['mediaFinal'];
            $notaRecuperacao = (float) $_POST['recuperacao'];

            // Calculando a nova média com a nota de recuperação
            $novaMedia = ($mediaFinal + $notaRecuperacao) / 2;

            echo "<div class='mt-4'>";
            if ($novaMedia >= 5) {
                echo "<p><strong>Parabéns, você foi aprovado!</strong></p>";
            } else {
                echo "<p><strong>Infelizmente, você foi reprovado.</strong></p>";
            }
            echo "<p>Sua média final após recuperação foi: <strong>$novaMedia</strong></p>";
            echo "</div>";
        }
        ?>
    </div>  

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
</body>
</html>

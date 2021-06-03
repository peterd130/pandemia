<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Nova solicitação</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style>
    .remed-atr{
        display: none
    }
  </style>
</head>
<body>

<div class="container mt-4">
  <div class="mt-3 col-lg-8 col-xl-6 mx-auto">
  <a href="<?php echo base_url('/');?>" class="mb-5">Início</a>
    <h1 class="mb-4">Nova solicitação</h1>
    <form method="post" id="adc_solic" name="adc_solic" 
        action="/solicitacoes/nova">
        <div class="form-group">
            <label>Nome completo</label>
            <input type="text" name="nome" class="form-control"  required>
        </div>

        <div class="form-group">
            <label>CPF</label>
            <input type="text" name="cpf" class="form-control" pattern="[0-9]{11}" placeholder="Apenas números" required>
        </div>

        <div class="form-group">
            <label>Tipo</label>
            <select class="form-control d-block" name="tipo">
                <option value="Vacina" selected>Vacina</option>
                <option value="Remédio">Remédio</option>
            </select>
        </div>

        <div class="form-group remed-atr">
            <label>Data da contaminação</label>
            <input type="date" name="datacontam" id="datacontam" class="form-control"  disabled required>
        </div>

        <div class="form-group remed-atr">
            <label>Data da melhora</label>
            <input type="date" name="datamelhora" id="datamelhora" class="form-control" value="" disabled>
        </div>

        <div class="form-group mt-5">
            <button type="submit" class="btn btn-primary btn-block">Salvar solicitação</button>
        </div>
    </form>
  </div>
</div>

<script>
    $('select').on('change', function() {
        if (this.value === 'Remédio') {
            $('.remed-atr').show();
            $('.remed-atr input').prop( "disabled", false );
        } else {
            $('.remed-atr').hide();
            $('.remed-atr input').prop( "disabled", true );
        }
    });
</script>
</body>
</html>

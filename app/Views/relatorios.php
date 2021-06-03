<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Relatórios</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <a href="<?php echo base_url('/');?>" class="">Início</a>
  <div class="mt-3">
     <h1 class="mb-4">Relatórios</h1>
     <div class="mb-5 col-lg-6 col-xl-4 px-0">
        <select class="form-control d-block" name="tipo">
            <option value="">Tudo</option>
            <option value="pendentes">Pendentes</option>
            <option value="concluidos">Concluídos</option>
            <option value="cancelados">Cancelados</option>
        </select>
     </div>
     <?php if($solic): ?>
     <table class="table table-bordered" id="vacinas-list">
       <thead>
          <tr>
             <th>Nome</th>
             <th>CPF</th>
             <th>SOLICITAÇÃO</th>
             <th>ENTREGA</th>
             <th>CONTAMINAÇÃO</th>
             <th>MELHORA</th>
             <th>TIPO</th>
             <th>STATUS</th>
          </tr>
       </thead>
       <tbody>
          <?php foreach($solic as $s): ?>
          <tr>
             <td><?php echo $s['NOME']; ?></td>
             <td><?php echo $s['CPF']; ?></td>
             <td>
               <?php 
                  $date=date_create($s['DATASOLIC']);
                  echo date_format($date,"d/m/Y H:i:s");
               ?>
             </td>
             <td>
               <?php 
                  $date=date_create($s['DATAENTREG']);
                  echo date_format($date,"d/m/Y");
               ?>
             </td>
             <td>
               <?php 
                  if (empty($s['DATACONTAM'])) {
                     echo '-';
                  } else {
                     $date=date_create($s['DATACONTAM']);
                     echo date_format($date,"d/m/Y");
                  }
               ?>
             </td>
             <td>
               <?php 
                  if (empty($s['DATAMELHORA'])) {
                     echo '-';
                  } else {
                     $date=date_create($s['DATAMELHORA']);
                     echo date_format($date,"d/m/Y");
                  }
               ?>
             </td>
             <td><?php echo $s['TIPO']; ?></td>
             <td><?php echo $s['STATUS']; ?></td>
          </tr>
         <?php endforeach; ?>
       </tbody>
     </table>
     <?php else: ?>
         <?php if (strcmp($_SERVER['PHP_SELF'], '/index.php/solicitacoes') != 0): ?>
            Nenhuma solicitação encontrada
         <?php endif; ?>

     <?php endif; ?>
  </div>
</div>

<script>
    $('select').on('change', function() {
        if (this.value === '') {
            window.open("<?php echo base_url('relatorios');?>", "_self");
        } else if (this.value === 'concluidos'){
            window.open("<?php echo base_url('relatorios/concluidos');?>", "_self");
        } else if (this.value === 'pendentes'){
            window.open("<?php echo base_url('relatorios/pendentes');?>", "_self");
        } else if (this.value === 'cancelados'){
            window.open("<?php echo base_url('relatorios/cancelados');?>", "_self");
        }
    });

    $(document).ready(function(){
        if ($(location).attr("href").includes('relatorios/pendentes')) {
            $("select").val('pendentes');
        } else if ($(location).attr("href").includes('relatorios/concluidos')) {
            $("select").val('concluidos');
        } else if ($(location).attr("href").includes('relatorios/cancelados')) {
            $("select").val('cancelados');
        } else {
            $("select").val('');
        }
    });

</script>
</body>
</html>

<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Solicitações</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-4">
<a href="<?php echo base_url('/');?>" class="">Início</a>
  <div class="mt-3">
     <h1 class="mb-4">Buscar solicitações</h1>
     <form method="post" class="mb-5 col-xl-6 col-lg-8 px-0" action="/solicitacoes-busca">
        <div class="d-flex">
            <input type="text" name="cpf" class="form-control" placeholder="Digite o CPF (somente números)" pattern="[0-9]{11}" required>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>
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
             <th>AÇÕES</th>
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
             <?php if (strcmp($s['STATUS'], 'PENDENTE') == 0): ?>
                  <td>
                        <form method="post" action="/cancelar-solic">
                           <input type="hidden" name="id" value="<?php echo $s['ID'];?>">
                           <input type="hidden" name="cpf" value="<?php echo $s['CPF'];?>">
                           <button type="submit" class="btn btn-danger mb-3">Cancelar</Button>
                        </form>
                        <form method="post" action="/solic-receb">
                           <input type="hidden" name="id" value="<?php echo $s['ID'];?>">
                           <input type="hidden" name="cpf" value="<?php echo $s['CPF'];?>">
                           <button type="submit" class="btn btn-success">Recebido</Button>
                        </form>
                  </td>
             <?php else: ?>
                  <td> - </td>
             <?php endif; ?>
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

</body>
</html>

<h3>Famílias [Contempladas]</h3>
<div class="box">
<div class="box-body no-padding">

    <table class="table table-striped table-hover"">
        <thead>
      <tr>
        <th style="width: 10px">ID</th>
        <th>Nome Pretendente</th>
        <th>Qtd Dependentes</th>
        <th>Renda Família</th>
        <th>Pontuação Total</th>                                        
        <th>Qtd Requisitos</th>                                        
        <th>Data Doação</th>                                        
        <th>Ações</th>                  
      </tr>
      </thead>
      <tbody>
      <?php foreach($familias as $familia): ?>
          <tr>                    
            <td><?php echo $familia['id']; ?></td>
            <td><?php echo utf8_encode($familia['nome']); ?></td>  
            <td><?php echo $familia['qtd_dependentes']; ?></td>
            <td><?php echo number_format($familia['rendaTotal'],2,',','.'); ?></td>
            <td><?php echo $familia['pontuacaoTotal']; ?></td>                        
            <td><?php echo $familia['qtd_requisitos']; ?></td>                        
            <td><?php echo date('d/m/Y'); ?></td>                        
            <td>
               <a href="<?php echo BASE_URL; ?>digix/familia/descontempla/<?php echo $familia['id']; ?>" class="btn btn-success">Descontemplar</a>
            </td>                      
          </tr>
      <?php endforeach; ?>
      </tbody>
     </table>
    <div class="box-footer clearfix">                    
        <ul class="pagination pagination-sm no-margin pull-left">
            <?php for($q=1;$q<=$total_paginas; $q++): ?>
                    <li class="<?php echo($p==$q)?'active':''; ?>"><a href="<?php echo BASE_URL; ?>digix/contemplados?<?php 
                    $w = $_GET;
                    $w['p'] = $q;                                        
                    echo http_build_query($w);
                    ?>"><?php echo $q; ?></a></li>
            <?php endfor; ?>                                        
        </ul>                    
    </div>
</div>            
</div>

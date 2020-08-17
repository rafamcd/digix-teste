<h3>Pessoas</h3>
<div class="box">
<div class="box-header">
  <div class="row">
    <div class="col-md-2">
      <div>            
        <div class="box-body">
            <h3 class="box-title">
                <a href="<?php echo BASE_URL; ?>digix/pessoa/add" class="btn btn-info">Adicionar Pessoa</a>
            </h3>
        </div>            
      </div>          
    </div>               
</div>                  
</div>            
<div class="box-body no-padding">
    <table class="table table-striped table-hover"">
        <thead>
      <tr>
        <th style="width: 10px">ID</th>
        <th>Nome</th>
        <th>Data Nascimento</th>                                        
        <th>Telefone</th>                                        
        <th>Ações</th>                  
      </tr>
      </thead>
      <tbody>
      <?php foreach($pessoas as $pessoa): ?>
          <tr>                    
            <td><?php echo $pessoa['id']; ?></td>
            <td><?php echo utf8_encode($pessoa['nome']); ?></td>  
            <td><?php echo date('d/m/Y', strtotime($pessoa['data_nascimento'])); ?></td>                        
            <td><?php echo $pessoa['fone']; ?></td>                                                
            <td>
               <a href="<?php echo BASE_URL; ?>digix/pessoa/edit/<?php echo $pessoa['id']; ?>" class="btn btn-success">Editar</a>
               <a href="<?php echo BASE_URL; ?>digix/pessoa/remove/<?php echo $pessoa['id']; ?>" class="btn btn-danger">Excluir</a>
            </td>                      
          </tr>
      <?php endforeach; ?>
      </tbody>
     </table>
    <div class="box-footer clearfix">                    
        <ul class="pagination pagination-sm no-margin pull-left">
            <?php for($q=1;$q<=$total_paginas; $q++): ?>
                    <li class="<?php echo($p==$q)?'active':''; ?>"><a href="<?php echo BASE_URL; ?>digix/pessoa?<?php 
                    $w = $_GET;
                    $w['p'] = $q;                                        
                    echo http_build_query($w);
                    ?>"><?php echo $q; ?></a></li>
            <?php endfor; ?>                                        
        </ul>                    
    </div>
</div>            
</div>

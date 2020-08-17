<h3>Regras</h3>
<div class="box">
    <div class="box-header">
      <div class="row">
        <div class="col-md-2">
          <div>            
            <div class="box-body">
                <h3 class="box-title">
                    <a href="<?php echo BASE_URL; ?>digix/regras/add" class="btn btn-info">Adicionar Regra</a>
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
            <th>Tabela</th>
            <th>Campo</th>                                        
            <th>Sinal</th>
            <th>Valor</th>
            <th>Valor Final</th>
            <th>Pontos</th>
            <th>Ações</th>                  
          </tr>
          </thead>
          <tbody>
          <?php foreach($regras as $regra): ?>
              <tr>                    
                <td><?php echo $regra['id']; ?></td>

                <td><?php echo $regra['tabela']; ?></td>   
                <td><?php echo $regra['campo']; ?></td>   
                <td><?php echo $regra['sinal']; ?></td>                           
                <td><?php echo $regra['valor1']; ?></td>                           
                <td><?php echo $regra['valor2']; ?></td>                                                   
                <td><?php echo $regra['pontos']; ?></td>                           
                <td>
                   <a href="<?php echo BASE_URL; ?>digix/regras/edit/<?php echo $regra['id']; ?>" class="btn btn-success">Editar</a>
                   <a href="<?php echo BASE_URL; ?>digix/regras/remove/<?php echo $regra['id']; ?>" class="btn btn-danger">Excluir</a>
                </td>                      
              </tr>
          <?php endforeach; ?>
          </tbody>
         </table>
        <div class="box-footer clearfix">                    
            <ul class="pagination pagination-sm no-margin pull-left">
                <?php for($q=1;$q<=$total_paginas; $q++): ?>
                        <li class="<?php echo($p==$q)?'active':''; ?>"><a href="<?php echo BASE_URL; ?>digix/regras?<?php 
                        $w = $_GET;
                        $w['p'] = $q;                                        
                        echo http_build_query($w);
                        ?>"><?php echo $q; ?></a></li>
                <?php endfor; ?>                                        
            </ul>                    
        </div>
    </div>           
</div>

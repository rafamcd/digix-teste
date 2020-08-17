<div class="col-md-12">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Regra <small>[Editar]</small></h3>
    </div>
    <form method="POST" role="form">                
        <div class="box-body">

         <div class="col-md-3">  
            <div class="form-group">
                <label for="id_tabela">Campo</label>
                <select name="campo" class="form-control" required>  
                    <?php foreach($colunas as $coluna): ?>                                
                      <?php $concatenacao = $regra['tabela'].'.'.$regra['campo']; ?>
                          <option value="<?php echo $coluna['coluna']; ?>" <?php echo($coluna['coluna'] == $concatenacao)?'selected="selected"':''; ?>><?php echo $coluna['coluna']; ?></option>
                     <?php endforeach; ?>                                      
                </select>
           </div>
         </div>   

         <div class="col-md-3">     
            <div class="form-group">
               <label for="id_sinal">Sinal</label>
               <select name="sinal" class="form-control" required>   
                   <option value="igual" <?php echo($regra['sinal'] == 'igual')?'selected="selected"':''; ?>>Igual</option>
                   <option value="menor" <?php echo($regra['sinal'] == 'menor')?'selected="selected"':''; ?>>Menor</option>
                   <option value="maior" <?php echo($regra['sinal'] == 'maior')?'selected="selected"':''; ?>>Maior</option>
                   <option value="entre" <?php echo($regra['sinal'] == 'entre')?'selected="selected"':''; ?>>Entre</option>                        
               </select>
           </div>
         </div>    
         <div class="col-md-3">    
            <div class="form-group">
             <label for="valorini">Valor</label>
             <input type="number" name="valorini" class="form-control" id="valor1" required value="<?php echo $regra['valor1']; ?>">
           </div>
         </div>

         <div class="col-md-3"> 
            <div class="form-group">
              <label for="valorfin">Valor Final</label>
              <input type="number" name="valorfin" class="form-control" id="valorfin" value="<?php echo $regra['valor2']; ?>">
            </div>
         </div>

        <div class="col-md-3">     
            <div class="form-group">
              <label for="pontos">Pontos</label>
              <input type="number" name="pontos" class="form-control" id="pontos" required value="<?php echo $regra['pontos']; ?>" >
            </div>     
        </div>
        
        <div style="clear:both"></div>

        <div class="form-group">
            <div class="row">
            <div class="col-md-2">
                <div>            
                  <div class="box-body">
                      <input type="submit" value="Salvar" class="btn btn-primary" />
                  </div>            
                </div>          
            </div>
            <div class="col-md-2">          
                <div class="box-body">                                                               
                    <a href="<?php echo BASE_URL; ?>digix/regras" class="btn btn-danger">Fechar</a>
                </div>                
            </div>
            </div>
        </div>
        </div>
    </form>                
</div>
</div>



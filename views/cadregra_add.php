<div class="col-md-12">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Regra <small>[Adicionar]</small></h3>
    </div>
    <form method="POST" role="form">                
        <div class="box-body">
            
         <div class="col-md-3">     
            <div class="form-group">
               <label for="id_tabela">Campo</label>
               <select name="campo" class="form-control" required>   
                   <option value="">Selecione o campo</option>
                   <?php foreach($colunas as $coluna): ?>                                
                       <option value="<?php echo $coluna['coluna']; ?>"><?php echo $coluna['coluna']; ?></option>
                    <?php endforeach; ?>
               </select>
           </div>
         </div>   

         <div class="col-md-3">     
            <div class="form-group">
               <label for="id_sinal">Sinal</label>
               <select name="sinal" class="form-control" required>   
                   <option value="">Selecione o sinal</option>                        
                       <option value="igual">Igual</option>                        
                       <option value="menor">Menor</option>                        
                       <option value="maior">Maior</option>                        
                       <option value="entre">Entre</option>                        
               </select>
           </div>
         </div>   
            
         <div class="col-md-3">    
            <div class="form-group">
             <label for="valorini">Valor</label>
             <input type="number" name="valorini" class="form-control" id="valor1" required>
           </div>
         </div>

         <div class="col-md-3"> 
            <div class="form-group">
              <label for="valorfin">Valor Final</label>
              <input type="number" name="valorfin" class="form-control" id="valorfin" >
            </div>
         </div>

        <div class="col-md-3">     
            <div class="form-group">
              <label for="pontos">Pontos</label>
              <input type="number" name="pontos" class="form-control" id="pontos" required >
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



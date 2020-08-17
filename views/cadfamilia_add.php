<div class="col-md-12">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Família <small>[Adicionar]</small></h3>
    </div>
    <form method="POST" role="form">                
        <div class="box-body">
            <?php
               if(!empty($erros)) {
                   foreach($erros as $erro) {
                       ?>
                       <div class="alert alert-danger" role="alert">
                         <?php echo $erro; ?>
                       </div>
               <?php  }  } ?>

         <div class="col-md-3">     
            <div class="form-group">
               <label for="id_pessoa">Responsável Familiar (Pretendente) </label>
               <select name="pretendente" class="form-control" required>   
                   <option value="">Selecione o pretendente</option>
                   <?php foreach($pessoas as $pessoa): ?>
                                       <option value="<?php echo $pessoa['id']; ?>"><?php echo utf8_encode($pessoa['nome']); ?></option>
                    <?php endforeach; ?>
               </select>
           </div>
         </div>
            
        <div class="col-md-3">   
            <div class="form-group">
            <label>Cônjugue </label>
            <select name="conjugue" class="form-control">   
                <option value="">Selecione o conjugue (caso possua)</option>
                <?php foreach($pessoas as $pessoa): ?>
                                    <option value="<?php echo $pessoa['id']; ?>"><?php echo utf8_encode($pessoa['nome']); ?></option>
                 <?php endforeach; ?>
            </select>
            </div>   
        </div>

        <div class="col-md-3">
            <div class="form-group">
            <label>Possui Casa? </label>
            <select name="possui_casa" class="form-control">   
            <option value="0">Não</option>
            <option value="1">Sim</option>                    
            </select>
            </div>
        </div>  

        <div class="form-group">
            <div class="col-md-12" style="margin-top: 15px !important;"><strong>Dependentes</strong></div>
            <?php foreach($pessoas as $pessoa): ?>
            <div class="col-md-4" style="margin-top: 15px !important;">
                <label><input type="checkbox" name="check<?php echo $pessoa['id']; ?>"> <?php echo utf8_encode($pessoa['nome']); ?></label><br/>
            </div>
            <?php endforeach; ?>
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
                              <a href="<?php echo BASE_URL; ?>digix/familia" class="btn btn-danger">Fechar</a>
                    </div>                
                </div>
            </div>
        </div>
        </div>
    </form>                
</div>
</div>



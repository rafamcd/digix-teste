<div class="col-md-6">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Pessoa <small>[Editar]</small></h3>
    </div>
    <form method="POST" role="form" enctype="multipart/form-data">                
        <div class="box-body">
           <div class="form-group">
            <div class="row">
            <div class="col-md-8">
                <div>            
                  <div class="box-body">
                    
                      <label>ID</label>
                    <input type="number" name="id" class="form-control" disabled value="<?php echo $pessoa['id']; ?>">

                    <div class="form-group">
                      <label for="nome">Nome</label>
                      <input type="text" name="nome" class="form-control" id="nome" placeholder="Digite o nome da Pessoa." autofocus required value="<?php echo utf8_encode($pessoa['nome']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <input type="text" name="fone" class="form-control" data-mask="(00) 00000-0000" data-mask-selectonfocus="true" value="<?php echo $pessoa['fone']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" name="data_nascimento" class="form-control" value="<?php echo $pessoa['data_nascimento']; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Digite o e-mail da Pessoa." value="<?php echo $pessoa['email']; ?>">
                    </div>

                    <div class="form-group">
                          <label for="renda">Renda (R$)</label> <br/>
                          <input type="text" name="renda" value="<?php echo number_format($pessoa['renda'],2,',','.'); ?>" /> <br/><br/>   
                    </div>

                    <div class="form-group">
                          <label for="imagem">Trocar Imagem</label>                                  
                          <div class="btn btn-default btn-sm float-left">                                        
                                <input type="file" name="imagem" id="imagem">
                            </div>
                    </div>
                  </div>            
                </div>          
            </div>
            <div class="col-md-4">          
                <div class="box-body">
                    <div class="box-body">           
                        <figure class="figure">        
                        <img src="<?php echo BASE_URL; ?>digix/assets/images/pessoas/<?php echo $pessoa['imagem']; ?>" class="img-thumbnail" />
                                 <figcaption class="figure-caption text-center">Imagem Atual</figcaption>
                        </figure>
                    </div>                
                </div>                
            </div>
            </div>
        </div>

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
                      <a href="<?php echo BASE_URL; ?>digix/pessoa" class="btn btn-danger">Fechar</a>
                </div>                
            </div>
            </div>
        </div>
        </div>
    </form>
</div>    
</div>



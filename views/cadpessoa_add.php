<div class="col-md-6">
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Pessoa <small>[Adicionar]</small></h3>
    </div>
    <form method="POST" role="form" enctype="multipart/form-data">                
        <div class="box-body">

        <div class="form-group">
          <label for="nome">Nome</label>
          <input type="text" name="nome" class="form-control" id="nome" placeholder="Digite o nome da Pessoa." autofocus required>
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input type="text" name="fone" class="form-control" data-mask="(00) 00000-0000" data-mask-selectonfocus="true" required>
        </div>

        <div class="form-group">
          <label for="data_nascimento">Data de Nascimento</label>
          <input type="date" name="data_nascimento" class="form-control" required>
        </div>

        <div class="form-group">
          <label for="email">E-mail</label>
          <input type="email" name="email" class="form-control" id="email" placeholder="Digite o e-mail da Pessoa.">
        </div>

        <div class="form-group">
            <label for="renda">Renda (R$)</label> <br/>
            <input type="text" name="renda" /> <br/><br/>   
        </div>

        <div class="form-group">
            <label for="imagem">Imagem</label><br/>                                  
            <div class="btn btn-default btn-sm float-left">                                        
                  <input type="file" name="imagem" id="imagem">
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



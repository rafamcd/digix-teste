
<?php foreach($permissao as $p => $it): ?> 
                    
    <?php if (!empty($it['url1'])): ?>                                
       <li><a href="<?php echo BASE_URL; ?>digix/<?php echo $it['url1']; ?>"><i class="<?php echo $it['class_bootstrap']; ?>"></i> <span><?php echo utf8_encode($it['desc1']); ?></span></a></li>
    <?php endif; ?>

    <?php if (empty($it['url1'])): ?>                                
       <li class="treeview">
       <a href="#">
          <i class="<?php echo $it['class_bootstrap']; ?>"></i>
          <span><?php echo utf8_encode($it['desc1']); ?></span>
          <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
          </span>
       </a>
       <ul class="treeview-menu">
           <?php foreach ($it['submenu'] as $chave => $valor): ?>                                    
               <li><a href="<?php echo BASE_URL; ?>digix/<?php echo $valor['url']; ?>"><?php echo utf8_encode($valor['descricao']); ?></a></li>
           <?php endforeach; ?>
       </ul>
        </li>

    <?php endif; ?>
  <?php endforeach; ?>

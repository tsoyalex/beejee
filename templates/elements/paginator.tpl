<?php if (isset($this->_vars['paginator']->pages) && $this->_vars['paginator']->pages):?>
	<nav class="mt-3">
		<ul class="pagination">
			<?php foreach ($this->_vars['paginator']->pages as $page):?>
				<li class="page-item<?=$page['current']?' active':''?>"><a class="page-link" href="<?=$page['url']?>"><?=$page['page']?></a></li>
  			<?php endforeach?>
		</ul>
	</nav>
<?php endif?>
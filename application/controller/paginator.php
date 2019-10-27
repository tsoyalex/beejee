<?php
namespace controller;

class paginator
{
	public $pages, $start, $page, $item_per_page, $app, $pagePath, $pageQuery, $domain;

	public function __construct()
	{
		$this->app = \application::getInstance();
		$this->pagePath = $this->app->pageUri;
		parse_str($this->app->pageQuery, $this->pageQuery);
		if (isset($this->pageQuery['page']))
			unset($this->pageQuery['page']);

		$this->domain = $this->app->getSiteDomain();
	}
  public function paginate($item_count, $item_per_page = 3)
	{
		$this->item_per_page = $item_per_page;
		$this->page = (int)$_GET['page'] ? $_GET['page'] : 1;
		if (!$this->page)
			$this->page = 1;

		$this->start = ($this->page - 1) * $this->item_per_page;

		if ($item_count > $this->item_per_page) {
			$pointer = 0;
			$curPage = 1;
			while ($pointer < $item_count) {
				$this->pages[] = array(
					'page' => $curPage,
					'url' => $this->_makePageUrl($curPage),
					'current' => ($curPage == $this->page ? true : false),
				);
				$pointer += $this->item_per_page;
				$curPage++;
			}
		}
	}

	protected function _makePageUrl($page) {
		$query = $this->pageQuery;
		if ($page>1)
			$query['page'] = $page;

		$url = $this->domain.$this->pagePath;
		if ($query)
			$url .= '?'.http_build_query($query);

		return $url;
	}
}
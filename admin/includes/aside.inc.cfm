<aside style="height: 870px;">
	<form id="globalSearch" action="../apps.php" method="get">
		<input type="search" name="q" placeholder="Search...">
		<i class="fa fa-search"></i>
	</form>
	<div class="all">
		<h4>Categories</h4>
		<cftransaction>
			<cfquery name="getAllCategories" datasource="sql1104309">
				SELECT * FROM categories
			</cfquery>
		</cftransaction>
		<ul>
			<cfoutput query="getAllCategories">
				<li><a href="../apps.php?catID=#catID#">#category#</a></li>
			</cfoutput>
		</ul>
		<div class="seperator"></div>
	</div>
</aside>
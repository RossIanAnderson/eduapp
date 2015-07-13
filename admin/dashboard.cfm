<cfinclude template = "includes/overall/header.inc.cfm">

<cfif !IsDefined("session.admin")>
	<cflocation url="." addToken="no">
</cfif>

<div class="titleBar">
	<h3>Admin - Dashboard</h3>
</div>
<section>
	<div class="dashLinks">
		<a href="users.cfm">Moderate Users</a>
		<a href="apps.cfm">Moderate Applications</a>
		<a href="reviews.cfm">Moderate Reviews</a>
		<a href="logout.cfm">Logout</a>
	</div>
</section>

<cfinclude template = "includes/overall/footer.inc.cfm">
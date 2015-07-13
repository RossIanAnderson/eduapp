<cfinclude template = "includes/overall/header.inc.cfm">

<cfif !IsDefined("session.admin")>
	<cflocation url="."addToken="no">
</cfif>

<div class="titleBar">
	<h3>Admin - Logout</h3>
</div>

<cfset exists = structclear(session)> 
<cflocation url="."addToken="no">

</section>
<cfinclude template = "includes/overall/footer.inc.cfm">
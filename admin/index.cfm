<cfinclude template = "includes/overall/header.inc.cfm">

<div class="titleBar">
	<h3>Admin - Login</h3>
</div>

<section>
	<cfform method="post" action="" autocomplete="off">
		<cfinput type="text" name="adminUsername" placeholder="Admin Username" required="yes" message="Please enter a Username">
		<cfinput type="password" name="adminPassword" placeholder="Admin Password" required="yes" message="Please enter a Password">
		<cfinput type="submit" name="submit" value="Log In">
	</cfform>
</section>

<cfif IsDefined("form.submit")>
	<cfset form.hashedPassword = hash("#form.adminPassword#", "MD5")>
	<cfquery name="compareDetails" datasource="sql1104309">
		SELECT * FROM admin WHERE adminUsername='#form.adminUsername#' and adminPassword='#form.hashedPassword#'
	</cfquery>
	<cfoutput query="compareDetails">
		<cfif compareDetails.recordcount eq 0>
			<cfset errorOutput = "Incorrect username or password">
		<cfelse>
			<cfset session.admin="true">
		</cfif>
	</cfoutput>
</cfif>


<cfif IsDefined("session.admin")>
	<cflocation url="dashboard.cfm" addToken="no" />
</cfif>

<cfinclude template = "includes/overall/footer.inc.cfm">
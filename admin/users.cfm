<cfinclude template = "includes/overall/header.inc.cfm">

<cfif !IsDefined("session.admin")>
	<cflocation url="." addToken="no">
</cfif>

<cftransaction>
	<cfquery name="getAllUsers" datasource="sql1104309">
		SELECT id, firstname, lastname, email, created, blocked FROM users ORDER BY created DESC
	</cfquery>
</cftransaction>

<div class="titleBar">
	<h3>Admin - Users</h3>
</div>
<section>
	<table>
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Unblock</th>
				<th>Block</th>
			</tr>
		</thead>
		<tbody>
			<cfoutput query="getAllUsers">
				<tr>
					<td>#firstname#</td>
					<td>#lastname#</td>
					<td>#email#</td>
					<cfif #blocked# is 0>
						<td>
							<p><i class="fa fa-check"></i></p>
						</td>
						<td>
							<a href="?block=#id#" title="Block"><i class="fa fa-times"></i></a>
						</td>
					<cfelse>
						<td>
							<a href="?unblock=#id#" title="Unblock" title="Unblock"><i class="fa fa-check"></i></a>
						</td>
						<td>
							<p><i class="fa fa-times"></i></p>
						</td>
					</cfif>
				</tr>
			</cfoutput>
		</tbody>
	</table>
	<a class="returnBtn" href="dashboard.cfm">Back</a>
</section>

<cfif IsDefined("url.block")>
	<cfset blockID = url.block />
	<cfquery name="blockUser" datasource="sql1104309">
		UPDATE users SET blocked=1 WHERE id=#blockID#
	</cfquery>
	<cflocation url="users.cfm">
</cfif>

<cfif IsDefined("url.unblock")>
	<cfset unblockID = url.unblock />
	<cfquery name="unblockUser" datasource="sql1104309">
		UPDATE users SET blocked=0 WHERE id=#unblockID#
	</cfquery>
	<cflocation url="users.cfm">
</cfif>

<cfinclude template = "includes/overall/footer.inc.cfm">
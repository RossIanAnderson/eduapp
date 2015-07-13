<cfinclude template = "includes/overall/header.inc.cfm">

<cfif !IsDefined("session.admin")>
	<cflocation url="." addToken="no">
</cfif>

<cftransaction>
	<cfquery name="getAllApps" datasource="sql1104309">
		SELECT a.id , a.name, a.description, a.uploadedBy, u.email, a.moderated FROM apps a, users u WHERE u.id = a.uploadedBy
	</cfquery>
</cftransaction>


<div class="titleBar">
	<h3>Admin - Applications</h3>
</div>
<section>
	<table>
		<thead>
			<tr>
				<th>Name</th>
				<th>Description</th>
				<th>Uploaded By</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<cfoutput query="getAllApps">
				<tr>
					<td>#name#</td>
					<td>#description#</td>
					<td>#email#</td>
					<cfif #moderated# is 1>
						<td>
							<p><i class="fa fa-thumbs-o-up"></i></p>
						</td>
						<td>
							<a href="?disallow=#id#" title="Disallow"><i class="fa fa-ban"></i></a>
						</td>
					<cfelse>
						<td>
							<a href="?allow=#id#" title="Allow" title="Unblock"><i class="fa fa-thumbs-o-up"></i></a>
						</td>
						<td>
							<p><i class="fa fa-ban"></i></p>
						</td>
					</cfif>
					<td>
						<a class="delete" data-message="Are you sure you want to delete this application? This will delete all ratings and reviews for this application." href="?delete=#id#"><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>
			</cfoutput>
		</tbody>
	</table>
	<a class="returnBtn" href="dashboard.cfm">Back</a>
	
<cfif IsDefined("url.disallow")>
	<cfset disallowID = url.disallow />
	<cfquery name="disallowApp" datasource="sql1104309">
		UPDATE apps SET moderated=0 WHERE id=#disallowID#
	</cfquery>
	<cflocation url="apps.cfm" addToken="no">
</cfif>

<cfif IsDefined("url.allow")>
	<cfset allowID = url.allow />
	<cfquery name="allowApp" datasource="sql1104309">
		UPDATE apps SET moderated=1 WHERE id=#allowID#
	</cfquery>
	<cflocation url="apps.cfm" addToken="no">
</cfif>

<cfif IsDefined("url.delete")>
	<cfset deleteID = url.delete />
	<cfquery name="deleteApp" datasource="sql1104309">
		DELETE FROM apps WHERE id=#deleteID#
	</cfquery>
	<cfquery name="deleteReviews" datasource="sql1104309">
		DELETE FROM reviews WHERE appID=#deleteID#
	</cfquery>
	<cfquery name="deleteRatings" dataSource="sql1104309">
		DELETE FROM ratings WHERE appID=#deleteID#
	</cfquery>
	<cflocation url="apps.cfm" addToken="no">
</cfif>
</section>

<cfinclude template = "includes/overall/footer.inc.cfm">
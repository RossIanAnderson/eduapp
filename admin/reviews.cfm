<cfinclude template = "includes/overall/header.inc.cfm">

<cfif !IsDefined("session.admin")>
	<cflocation url="." addToken="no">
</cfif>

<cftransaction>
	<cfquery name="getAllReviews" datasource="sql1104309">
		SELECT r.appID, r.title, r.body, r.uploadedBy, u.firstname, u.lastname, r.moderated FROM reviews r, users u WHERE u.id = r.uploadedBy
	</cfquery>
</cftransaction>

<div class="titleBar">
	<h3>Admin - Reviews</h3>
</div>
<section>
	<table>
		<thead>
			<tr>
				<th>App</th>
				<th>Title</th>
				<th>Body</th>
				<th>By</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<cfoutput query="getAllReviews">
				<tr>
					<td>#appID#</td>
					<td>#title#</td>
					<td>#body#</td>
					<td>#firstname# #lastname#</td>
					<cfif #moderated# is 0>
						<td>
							<a href="?allow=#appID#" title="Allow" title="Unblock"><i class="fa fa-thumbs-o-up"></i></a>
						</td>
						<td>
							<p><i class="fa fa-ban"></i></p>
						</td>
					<cfelse>
						<td>
							<p><i class="fa fa-thumbs-o-up"></i></p>
						</td>
						<td>
							<a href="?disallow=#appID#" title="Disallow"><i class="fa fa-ban"></i></a>
						</td>
					</cfif>
					<td>
						<a class="delete" data-message="Are you sure you want to delete this review" href="?delete=#appID#"><i class="fa fa-trash-o"></i></a>
					</td>
				</tr>
			</cfoutput>
		</tbody>
	</table>
	<a class="returnBtn" href="dashboard.cfm">Back</a>
	
<cfif IsDefined("url.disallow")>
	<cfset disallowID = url.disallow />
	<cfquery name="disallowReview" datasource="sql1104309">
		UPDATE reviews SET moderated=0 WHERE reviewID=#disallowID#
	</cfquery>
	<cflocation url="reviews.cfm" addToken="no">
</cfif>

<cfif IsDefined("url.allow")>
	<cfset allowID = url.allow />
	<cfquery name="allowReview" datasource="sql1104309">
		UPDATE reviews SET moderated=1 WHERE reviewID=#allowID#
	</cfquery>
	<cflocation url="reviews.cfm" addToken="no">
</cfif>

<cfif IsDefined("url.delete")>
	<cfset deleteID = url.delete />
	<cfquery name="deleteReview" datasource="sql1104309">
		DELETE FROM reviews WHERE reviewID=#deleteID#
	</cfquery>
	<cflocation url="reviews.cfm" addToken="no">
</cfif>

</section>

<cfinclude template = "includes/overall/footer.inc.cfm">
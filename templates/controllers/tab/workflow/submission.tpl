{**
 * templates/workflow/submission.tpl
 *
 * Copyright (c) 2014-2016 Simon Fraser University Library
 * Copyright (c) 2003-2016 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * Display submission details (metadata, file grid)
 *}
<div class="pkp_context_sidebar">
	{url|assign:submissionEditorDecisionsUrl router=$smarty.const.ROUTE_PAGE page="workflow" op="editorDecisionActions" submissionId=$submission->getId() stageId=$stageId contextId="submission" escape=false}
	{load_url_in_div id="submissionEditorDecisionsDiv" url=$submissionEditorDecisionsUrl class="pkp_tab_actions"}
	{include file="controllers/tab/workflow/stageParticipants.tpl"}
</div>

<div class="pkp_content_panel">
	<p class="pkp_help">{translate key="editor.submission.introduction"}</p>

	{url|assign:submissionFilesGridUrl router=$smarty.const.ROUTE_COMPONENT component="grid.files.submission.EditorSubmissionDetailsFilesGridHandler" op="fetchGrid" submissionId=$submission->getId() stageId=$stageId escape=false}
	{load_url_in_div id="submissionFilesGridDiv" url=$submissionFilesGridUrl}

	{url|assign:queriesGridUrl router=$smarty.const.ROUTE_COMPONENT component="grid.queries.QueriesGridHandler" op="fetchGrid" submissionId=$submission->getId() stageId=$stageId escape=false}
	{load_url_in_div id="queriesGrid" url=$queriesGridUrl}
</div>

{include file='documentHeader'}

<head>
	<title>{lang}wcf.store.verification.title{/lang} - {PAGE_TITLE|language}</title>
	
	{include file='headInclude'}

	<link rel="canonical" href="{link controller='PluginStoreActivation'}{/link}" />
</head>

<body id="tpl{$templateName|ucfirst}">

{include file='header'}

<header class="boxHeadline">
	<h1>{lang}wcf.store.verification.title{/lang}</h1>
</header>

{include file='userNotice'}

{include file='formError'}

<div class="contentNavigation">
	{hascontent}
	<nav>
		<ul>
			{content}
				{event name='contentNavigationButtonsTop'}
			{/content}
		</ul>
	</nav>
	{/hascontent}
</div>

<form action="" method="post">
	<div class="container containerPadding marginTop">
		<fieldset>
			<legend>{lang}wcf.global.form.data{/lang}</legend>

			<dl{if $errorField == 'groupID'} class="formError"{/if}>
				<dt><label for="groupID">{lang}wcf.store.verification.groupID{/lang}</label></dt>
				<dd>
					<select name="groupID" id="groupID">
						{foreach from=$availableGroups key=__groupID item=__packageName}
							<option value="{$__groupID}"{if $groupID == $__groupID} selected="selected"{/if}>{$__packageName}</option>
						{/foreach}
					</select>
					{if $errorField == 'groupID'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{else}
								{lang}wcf.store.verification.groupID.error.{$errorType}{/lang}
							{/if}
						</small>
					{/if}
				</dd>
			</dl>

			<dl{if $errorField == 'woltlabID'} class="formError"{/if}>
				<dt><label for="woltlabID">{lang}wcf.store.verification.woltlabID{/lang}</label></dt>
				<dd>
					<input type="number" id="woltlabID" name="woltlabID" value="{$woltlabID}" required="required" class="medium" />
					{if $errorField == 'woltlabID'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{else}
								{lang}wcf.store.verification.woltlabID.error.{@$errorType}{/lang}
							{/if}
						</small>
					{/if}
					<small>{lang}wcf.store.verification.woltlabID.description{/lang}</small>
				</dd>
			</dl>

			<dl{if $errorField == 'pluginStoreApiKey'} class="formError"{/if}>
				<dt><label for="pluginStoreApiKey">{lang}wcf.store.verification.pluginStoreApiKey{/lang}</label></dt>
				<dd>
					<input type="text" id="pluginStoreApiKey" name="pluginStoreApiKey" value="{$pluginStoreApiKey}" required="required" class="medium" />
					{if $errorField == 'pluginStoreApiKey'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{else}
								{lang}wcf.store.verification.pluginStoreApiKey.error.{@$errorType}{/lang}
							{/if}
						</small>
					{/if}
					<small>{lang}wcf.store.verification.pluginStoreApiKey.description{/lang}</small>
				</dd>
			</dl>

			<dl>
				<dd>
					<label for="saveCredentials">
						<input type="checkbox" id="saveCredentials" name="saveCredentials" value="1"{if $saveCredentials} checked="checked"{/if} /> {lang}wcf.store.verification.saveCredentials{/lang}
					</label>
				</dd>
			</dl>
		</fieldset>
	</div>

	<div class="formSubmit">
		<input type="submit" value="{lang}wcf.global.button.submit{/lang}" accesskey="s" />

		{@SECURITY_TOKEN_INPUT_TAG}
	</div>
</form>

<div class="contentNavigation">
	{hascontent}
		<nav>
			<ul>
				{content}
					{event name='contentNavigationButtonsBottom'}
				{/content}
			</ul>
		</nav>
	{/hascontent}
</div>

<address class="copyright marginTop" style="text-align: center;">{lang}wcf.store.verification.copyright{/lang}</address>

{include file='footer'}
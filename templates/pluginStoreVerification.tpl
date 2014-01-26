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
				<dt><label for="groupID">{lang}wcf.store.verification.packageName{/lang}</label></dt>
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
								{lang}wcf.store.verification.packageName.error.{$errorType}{/lang}
							{/if}
						</small>
					{/if}
				</dd>
			</dl>

			<dl{if $errorField == 'username'} class="formError"{/if}>
				<dt><label for="username">{lang}wcf.store.verification.username{/lang}</label></dt>
				<dd>
					<input type="text" id="username" name="username" value="{$username}" required="required" class="medium" />
					{if $errorField == 'username'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{else}
								{lang}wcf.store.verification.username.error.{@$errorType}{/lang}
							{/if}
						</small>
					{/if}
					<small>{lang}wcf.store.verification.username.description{/lang}</small>
				</dd>
			</dl>

			<dl{if $errorField == 'password'} class="formError"{/if}>
				<dt><label for="password">{lang}wcf.store.verification.password{/lang}</label></dt>
				<dd>
					<input type="password" id="password" name="password" value="{$password}" required="required" class="medium" />
					{if $errorField == 'password'}
						<small class="innerError">
							{if $errorType == 'empty'}
								{lang}wcf.global.form.error.empty{/lang}
							{else}
								{lang}wcf.store.verification.password.error.{@$errorType}{/lang}
							{/if}
						</small>
					{/if}
					<small>{lang}wcf.store.verification.password.description{/lang}</small>
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
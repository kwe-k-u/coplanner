<?php
	$preview_text = "You've been invited to manage $curator_name";
	$subject = "Invitation to manage $curator_name on easyGo";
	$image_url = "https://mcusercontent.com/2bd1d8f7814d0d70eb78d4383/images/2a8f6dee-55b4-5807-9f97-95f9d0620374.png";
	$heading_text = "Invitation link to manage $curator_name on easyGo";
	$message = "Hey! We're letting you know that you have been invited to manage the Curator account of $curator_name on easyGo. You can click on the button below to accept the invite and sign up on the platform";
	$button_text = "Sign Up";
	$button_url = server_base_url()."curator/register.php?invite_token=$token";
?>


<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraph.org/schema/">

<head>

	<meta property="og:title" content="We saw you signed up">
	<meta property="fb:page_id" content="43929265776">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="referrer" content="origin">
	<!--[if gte mso 15]>
<xml>
<o:OfficeDocumentSettings>
<o:AllowPNG/>
<o:PixelsPerInch>96</o:PixelsPerInch>
</o:OfficeDocumentSettings>
</xml>
<![endif]-->
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>We saw you signed up</title>
	<style>
		img {
			-ms-interpolation-mode: bicubic;
		}

		table,
		td {
			mso-table-lspace: 0pt;
			mso-table-rspace: 0pt;
		}

		.mceStandardButton,
		.mceStandardButton td,
		.mceStandardButton td a {
			mso-hide: all !important;
		}

		p,
		a,
		li,
		td,
		blockquote {
			mso-line-height-rule: exactly;
		}

		p,
		a,
		li,
		td,
		body,
		table,
		blockquote {
			-ms-text-size-adjust: 100%;
			-webkit-text-size-adjust: 100%;
		}

		@media only screen and (max-width: 480px) {

			body,
			table,
			td,
			p,
			a,
			li,
			blockquote {
				-webkit-text-size-adjust: none !important;
			}
		}

		.mcnPreviewText {
			display: none !important;
		}

		.bodyCell {
			margin: 0 auto;
			padding: 0;
			width: 100%;
		}

		.ExternalClass,
		.ExternalClass p,
		.ExternalClass td,
		.ExternalClass div,
		.ExternalClass span,
		.ExternalClass font {
			line-height: 100%;
		}

		.ReadMsgBody {
			width: 100%;
		}

		.ExternalClass {
			width: 100%;
		}

		a[x-apple-data-detectors] {
			color: inherit !important;
			text-decoration: none !important;
			font-size: inherit !important;
			font-family: inherit !important;
			font-weight: inherit !important;
			line-height: inherit !important;
		}

		body {
			height: 100%;
			margin: 0;
			padding: 0;
			width: 100%;
			background: #ffffff;
		}

		p {
			margin: 0;
			padding: 0;
		}

		table {
			border-collapse: collapse;
		}

		td,
		p,
		a {
			word-break: break-word;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			display: block;
			margin: 0;
			padding: 0;
		}

		img,
		a img {
			border: 0;
			height: auto;
			outline: none;
			text-decoration: none;
		}

		a[href^="tel"],
		a[href^="sms"] {
			color: inherit;
			cursor: default;
			text-decoration: none;
		}

		li p {
			margin: 0 !important;
		}

		.ProseMirror a {
			pointer-events: none;
		}

		@media only screen and (max-width: 480px) {
			body {
				width: 100% !important;
				min-width: 100% !important;
			}

			body.mobile-native {
				-webkit-user-select: none;
				user-select: none;
				transition: transform 0.2s ease-in;
				transform-origin: top center;
			}

			body.mobile-native.selection-allowed a,
			body.mobile-native.selection-allowed .ProseMirror {
				user-select: auto;
				-webkit-user-select: auto;
			}

			colgroup {
				display: none;
			}

			img {
				height: auto !important;
			}

			.mceWidthContainer {
				max-width: 660px !important;
			}

			.mceColumn {
				display: block !important;
				width: 100% !important;
			}

			.mceColumn-forceSpan {
				display: table-cell !important;
				width: auto !important;
			}

			.mceBlockContainer {
				padding-right: 16px !important;
				padding-left: 16px !important;
			}

			.mceBlockContainerE2E {
				padding-right: 0px;
				padding-left: 0px;
			}

			.mceSpacing-24 {
				padding-right: 16px !important;
				padding-left: 16px !important;
			}

			.mceImage,
			.mceLogo {
				width: 100% !important;
				height: auto !important;
			}

			.mceFooterSection .mceText,
			.mceFooterSection .mceText p {
				font-size: 16px !important;
				line-height: 140% !important;
			}

			.mceText,
			.mceText p {
				font-size: 16px !important;
				line-height: 140% !important;
			}

			h1 {
				font-size: 30px !important;
				line-height: 120% !important;
			}

			h2 {
				font-size: 26px !important;
				line-height: 120% !important;
			}

			h3 {
				font-size: 20px !important;
				line-height: 125% !important;
			}

			h4 {
				font-size: 18px !important;
				line-height: 125% !important;
			}
		}

		@media only screen and (max-width: 640px) {
			.mceClusterLayout td {
				padding: 4px !important;
			}
		}

		div[contenteditable="true"] {
			outline: 0;
		}

		.ProseMirror .empty-node,
		.ProseMirror:empty {
			position: relative;
		}

		.ProseMirror .empty-node::before,
		.ProseMirror:empty::before {
			position: absolute;
			left: 0;
			right: 0;
			color: rgba(0, 0, 0, 0.2);
			cursor: text;
		}

		.ProseMirror .empty-node:hover::before,
		.ProseMirror:empty:hover::before {
			color: rgba(0, 0, 0, 0.3);
		}

		.ProseMirror h1.empty-node:only-child::before,
		.ProseMirror h2.empty-node:only-child::before,
		.ProseMirror h3.empty-node:only-child::before,
		.ProseMirror h4.empty-node:only-child::before {
			content: 'Heading';
		}

		.ProseMirror p.empty-node:only-child::before,
		.ProseMirror:empty::before {
			content: 'Start typing...';
		}

		a .ProseMirror p.empty-node::before,
		a .ProseMirror:empty::before {
			content: '';
		}

		.mceText,
		.ProseMirror {
			white-space: pre-wrap;
		}

		body,
		#bodyTable {
			background-color: rgb(244, 244, 244);
		}

		.mceText,
		.mceLabel {
			font-family: "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
		}

		.mceText,
		.mceLabel {
			color: rgb(0, 0, 0);
		}

		.mceText h1 {
			margin-bottom: 0px;
		}

		.mceText p {
			margin-bottom: 0px;
		}

		.mceText label {
			margin-bottom: 0px;
		}

		.mceText input {
			margin-bottom: 0px;
		}

		.mceSpacing-24 .mceInput+.mceErrorMessage {
			margin-top: -12px;
		}

		.mceText h1 {
			margin-bottom: 0px;
		}

		.mceText p {
			margin-bottom: 0px;
		}

		.mceText label {
			margin-bottom: 0px;
		}

		.mceText input {
			margin-bottom: 0px;
		}

		.mceSpacing-12 .mceInput+.mceErrorMessage {
			margin-top: -6px;
		}

		.mceText h1 {
			margin-bottom: 0px;
		}

		.mceText p {
			margin-bottom: 0px;
		}

		.mceText label {
			margin-bottom: 0px;
		}

		.mceText input {
			margin-bottom: 0px;
		}

		.mceSpacing-48 .mceInput+.mceErrorMessage {
			margin-top: -24px;
		}

		.mceInput {
			background-color: transparent;
			border: 2px solid rgb(208, 208, 208);
			width: 60%;
			color: rgb(77, 77, 77);
			display: block;
		}

		.mceInput[type="radio"],
		.mceInput[type="checkbox"] {
			float: left;
			margin-right: 12px;
			display: inline;
			width: auto !important;
		}

		.mceLabel>.mceInput {
			margin-bottom: 0px;
			margin-top: 2px;
		}

		.mceLabel {
			display: block;
		}

		.mceText p {
			color: rgb(0, 0, 0);
			font-family: "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
			font-size: 16px;
			font-weight: normal;
			line-height: 1.5;
			text-align: center;
			letter-spacing: 0px;
			direction: ltr;
		}

		.mceText h1 {
			color: rgb(0, 0, 0);
			font-family: "Helvetica Neue", Helvetica, Arial, Verdana, sans-serif;
			font-size: 31px;
			font-weight: bold;
			line-height: 1.5;
			text-align: center;
			letter-spacing: 0px;
			direction: ltr;
		}

		.mceText a {
			color: rgb(0, 0, 0);
			font-style: normal;
			font-weight: normal;
			text-decoration: underline;
			direction: ltr;
		}

		@media only screen and (max-width: 480px) {
			.mceText p {
				font-size: 16px !important;
				line-height: 1.5 !important;
			}
		}

		@media only screen and (max-width: 480px) {
			.mceText h1 {
				font-size: 31px !important;
				line-height: 1.5 !important;
			}
		}

		@media only screen and (max-width: 480px) {
			.mceBlockContainer {
				padding-left: 16px !important;
				padding-right: 16px !important;
			}
		}

		#dataBlockId-9 p,
		#dataBlockId-9 h1,
		#dataBlockId-9 h2,
		#dataBlockId-9 h3,
		#dataBlockId-9 h4,
		#dataBlockId-9 ul {
			text-align: center;
		}

		@media only screen and (max-width: 480px) {
			.mobileClass-8 {
				padding-left: 12 !important;
				padding-top: 0 !important;
				padding-right: 12 !important;
			}

			.mobileClass-8 {
				padding-left: 12 !important;
				padding-top: 0 !important;
				padding-right: 12 !important;
			}

			.mobileClass-8 {
				padding-left: 12 !important;
				padding-top: 0 !important;
				padding-right: 12 !important;
			}
		}
	</style>
	<link rel="stylesheet" href="https://us21.campaign-archive.com/css/archivebar-desktop.css" mc:nocompile>
	<script>
		! function() {
			function o(n, i) {
				if (n && i)
					for (var r in i) i.hasOwnProperty(r) && (void 0 === n[r] ? n[r] = i[r] : n[r].constructor === Object && i[r].constructor === Object ? o(n[r], i[r]) : n[r] = i[r])
			}
			try {
				var n = decodeURIComponent("%7B%0A%22ResourceTiming%22%3A%7B%0A%22comment%22%3A%20%22Clear%20RT%20Buffer%20on%20mPulse%20beacon%22%2C%0A%22clearOnBeacon%22%3A%20true%0A%7D%2C%0A%22AutoXHR%22%3A%7B%0A%22comment%22%3A%20%22Monitor%20XHRs%20requested%20using%20FETCH%22%2C%0A%22monitorFetch%22%3A%20true%2C%0A%22comment%22%3A%20%22Start%20Monitoring%20SPAs%20from%20Click%22%2C%0A%22spaStartFromClick%22%3A%20true%0A%7D%2C%0A%22PageParams%22%3A%7B%0A%22comment%22%3A%20%22Monitor%20all%20SPA%20XHRs%22%2C%0A%22spaXhr%22%3A%20%22all%22%0A%7D%0A%7D");
				if (n.length > 0 && window.JSON && "function" == typeof window.JSON.parse) {
					var i = JSON.parse(n);
					void 0 !== window.BOOMR_config ? o(window.BOOMR_config, i) : window.BOOMR_config = i
				}
			} catch (r) {
				window.console && "function" == typeof window.console.error && console.error("mPulse: Could not parse configuration", r)
			}
		}();
	</script>
	<script>
		! function(e) {
			var n = "https://s.go-mpulse.net/boomerang/";
			if ("True" == "True") e.BOOMR_config = e.BOOMR_config || {}, e.BOOMR_config.PageParams = e.BOOMR_config.PageParams || {}, e.BOOMR_config.PageParams.pci = !0, n = "https://s2.go-mpulse.net/boomerang/";
			if (window.BOOMR_API_key = "QAT5G-9HZLF-7EDMX-YMVCJ-QZJDA", function() {
					function e() {
						if (!r) {
							var e = document.createElement("script");
							e.id = "boomr-scr-as", e.src = window.BOOMR.url, e.async = !0, o.appendChild(e), r = !0
						}
					}

					function t(e) {
						r = !0;
						var n, t, a, i, d = document,
							O = window;
						if (window.BOOMR.snippetMethod = e ? "if" : "i", t = function(e, n) {
								var t = d.createElement("script");
								t.id = n || "boomr-if-as", t.src = window.BOOMR.url, BOOMR_lstart = (new Date).getTime(), e = e || d.body, e.appendChild(t)
							}, !window.addEventListener && window.attachEvent && navigator.userAgent.match(/MSIE [67]\./)) return window.BOOMR.snippetMethod = "s", void t(o, "boomr-async");
						a = document.createElement("IFRAME"), a.src = "about:blank", a.title = "", a.role = "presentation", a.loading = "eager", i = (a.frameElement || a).style, i.width = 0, i.height = 0, i.border = 0, i.display = "none", o.appendChild(a);
						try {
							O = a.contentWindow, d = O.document.open()
						} catch (_) {
							n = document.domain, a.src = "javascript:var d=document.open();d.domain='" + n + "';void 0;", O = a.contentWindow, d = O.document.open()
						}
						if (n) d._boomrl = function() {
							this.domain = n, t()
						}, d.write("<bo" + "dy onload='document._boomrl();'>");
						else if (O._boomrl = function() {
								t()
							}, O.addEventListener) O.addEventListener("load", O._boomrl, !1);
						else if (O.attachEvent) O.attachEvent("onload", O._boomrl);
						d.close()
					}

					function a(e) {
						window.BOOMR_onload = e && e.timeStamp || (new Date).getTime()
					}
					if (!window.BOOMR || !window.BOOMR.version && !window.BOOMR.snippetExecuted) {
						window.BOOMR = window.BOOMR || {}, window.BOOMR.snippetStart = (new Date).getTime(), window.BOOMR.snippetExecuted = !0, window.BOOMR.snippetVersion = 14, window.BOOMR.url = n + "QAT5G-9HZLF-7EDMX-YMVCJ-QZJDA";
						var i = document.currentScript || document.getElementsByTagName("script")[0],
							o = i.parentNode,
							r = !1,
							d = document.createElement("link");
						if (d.relList && "function" == typeof d.relList.supports && d.relList.supports("preload") && "as" in d) window.BOOMR.snippetMethod = "p", d.href = window.BOOMR.url, d.rel = "preload", d.as = "script", d.addEventListener("load", e), d.addEventListener("error", function() {
							t(!0)
						}), setTimeout(function() {
							if (!r) t(!0)
						}, 3e3), BOOMR_lstart = (new Date).getTime(), o.appendChild(d);
						else t(!1);
						if (window.addEventListener) window.addEventListener("load", a, !1);
						else if (window.attachEvent) window.attachEvent("onload", a)
					}
				}(), "400".length > 0)
				if (e && "performance" in e && e.performance && "function" == typeof e.performance.setResourceTimingBufferSize) e.performance.setResourceTimingBufferSize(400);
			! function() {
				if (BOOMR = e.BOOMR || {}, BOOMR.plugins = BOOMR.plugins || {}, !BOOMR.plugins.AK) {
					var n = "" == "true" ? 1 : 0,
						t = "",
						a = "zxeyislaceqtyzny5cqa-f-0a94f0c85-clientnsv4-s.akamaihd.net",
						i = "false" == "true" ? 2 : 1,
						o = {
							"ak.v": "36",
							"ak.cp": "641026",
							"ak.ai": parseInt("761902", 10),
							"ak.ol": "0",
							"ak.cr": 1,
							"ak.ipv": 4,
							"ak.proto": "http/1.1",
							"ak.rid": "2d86669",
							"ak.r": 42588,
							"ak.a2": n,
							"ak.m": "x",
							"ak.n": "essl",
							"ak.bpcip": "154.160.21.0",
							"ak.cport": 64901,
							"ak.gh": "23.1.104.91",
							"ak.quicv": "",
							"ak.tlsv": "tls1.2",
							"ak.0rtt": "",
							"ak.csrc": "-",
							"ak.acc": "reno",
							"ak.t": "1706616992",
							"ak.ak": "hOBiQwZUYzCg5VSAfCLimQ==XkNt7kuLVPcyszX9ePOgREMXIQfx+HRfVH/CANYXkZHNyl5QSz0HdQgRERKUlVrMLDsAyJ15mTnKX/tgIvBoKvTfufOz4aV4SEdtSQwulSBLDwLKeLEm+oPkU5SMcLNjX9w8AKeDsjZ4FWIspLqwOvNr/QBc+zTdEDO9/R1qV6Ghmt2ADB+bQXAA8JyXvR1d2mrlOctb46oToMzEOp4CTE5M8DUJKWcY1iXiQB3Xsp6+srxq9CL9ednpuNCzBIMM126FHFSN51Sljo17uzvsIB4equCppvOzPOwXg1PQt3WmHYdafB5V0K1u7sIAGa23LtUaSoLBsKRriIoOUNC58NbgobYf+OoionQYmYqQ31vidlvx4CEWeWV0924htBx2TvIZ2zZDprj7YKGaeyLhRi8SLFKUOwAaI/fDTcQ5HoY=",
							"ak.pv": "86",
							"ak.dpoabenc": "",
							"ak.tf": i
						};
					if ("" !== t) o["ak.ruds"] = t;
					var r = {
						i: !1,
						av: function(n) {
							var t = "http.initiator";
							if (n && (!n[t] || "spa_hard" === n[t])) o["ak.feo"] = void 0 !== e.aFeoApplied ? 1 : 0, BOOMR.addVar(o)
						},
						rv: function() {
							var e = ["ak.bpcip", "ak.cport", "ak.cr", "ak.csrc", "ak.gh", "ak.ipv", "ak.m", "ak.n", "ak.ol", "ak.proto", "ak.quicv", "ak.tlsv", "ak.0rtt", "ak.r", "ak.acc", "ak.t", "ak.tf"];
							BOOMR.removeVar(e)
						}
					};
					BOOMR.plugins.AK = {
						akVars: o,
						akDNSPreFetchDomain: a,
						init: function() {
							if (!r.i) {
								var e = BOOMR.subscribe;
								e("before_beacon", r.av, null, null), e("onbeacon", r.rv, null, null), r.i = !0
							}
							return this
						},
						is_complete: function() {
							return !0
						}
					}
				}
			}()
		}(window);
	</script>
</head>

<body id="archivebody">

	<body>
		<!---->
		<!--[if !gte mso 9]><!----><span class="mcnPreviewText" style="display:none; font-size:0px; line-height:0px; max-height:0px; max-width:0px; opacity:0; overflow:hidden; visibility:hidden; mso-hide:all;"><?php echo $preview_text; ?></span><!--<![endif]-->
		<!---->
		<center>
			<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable" style="background-color: rgb(244, 244, 244);">
				<tbody>
					<tr>
						<td class="bodyCell" align="center" valign="top">
							<table id="root" border="0" cellpadding="0" cellspacing="0" width="100%">
								<tbody data-block-id="13" class="mceWrapper">
									<tr>
										<td align="center" valign="top" class="mceWrapperOuter"><!--[if (gte mso 9)|(IE)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="660" style="width:660px;"><tr><td><![endif]-->
											<table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:660px" role="presentation">
												<tbody>
													<tr>
														<td style="background-color:#ffffff;background-position:center;background-repeat:no-repeat;background-size:cover" class="mceWrapperInner" valign="top">
															<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" data-block-id="12">
																<tbody>
																	<tr class="mceRow">
																		<td style="background-position:center;background-repeat:no-repeat;background-size:cover" valign="top">
																			<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
																				<tbody>
																					<tr>
																						<td style="padding-top:0;padding-bottom:0" class="mceColumn" data-block-id="-10" valign="top" colspan="12" width="100%">
																							<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
																								<tbody>
																									<tr>
																										<td style="padding-top:12px;padding-bottom:12px;padding-right:48px;padding-left:48px" class="mceBlockContainer" align="center" valign="top"><img data-block-id="2" width="236" height="auto" style="width:236px;height:auto;max-width:236px !important;display:block" alt="Logo" src="https://www.easygo.com.gh/assets/images/site_images/logo.png" class="mceLogo"></td>
																									</tr>
																									<tr>
																										<td style="padding-top:12px;padding-bottom:12px;padding-right:0;padding-left:0" class="mceBlockContainer" align="center" valign="top"><img data-block-id="4" width="344" height="auto" style="width:344px;height:auto;max-width:1080px !important;display:block" alt="" <?php echo "src='$image_url'"; ?> role="presentation" class="imageDropZone mceImage"></td>
																									</tr>
																									<tr>
																										<td style="padding-top:12px;padding-bottom:12px;padding-right:24px;padding-left:24px" class="mceBlockContainer" valign="top">
																											<div data-block-id="3" class="mceText" id="dataBlockId-3" style="width:100%">

																												<?php
																													echo "<h1>$heading_text</h1>";
																												?>
																												<p style="text-align: center;" class="last-child"><?php echo $message ?></p>
																											</div>
																										</td>
																									</tr>
																									<tr>
																										<td style="padding-top:12px;padding-bottom:12px;padding-right:24px;padding-left:24px" class="mceBlockContainer" align="center" valign="top">
																											<table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" data-block-id="5">
																												<tbody>
																													<tr class="mceStandardButton">
																														<td style="background-color:#1204b5;border-radius:8px;text-align:center" class="mceButton" valign="top">
																															<a <?php echo "href=\"$button_url\""; ?> target="_blank" style="background-color:#1204b5;border-radius:8px;border:2px solid #1204b5;color:#ffffff;display:block;font-family:'Helvetica Neue', Helvetica, Arial, Verdana, sans-serif;font-size:16px;font-weight:normal;font-style:normal;padding:16px 28px;text-decoration:none;min-width:30px;text-align:center;direction:ltr;letter-spacing:0px">
																															<?php
																																echo $button_text
																															?>
																															</a>
																														</td>
																													</tr>
																													<tr>
																														<!--[if mso]>
<td align="center">
<v:roundrect xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:w="urn:schemas-microsoft-com:office:word"
href="http://wa.me/233506899883"
style="v-text-anchor:middle; width:174.82px; height:53.6px;"
arcsize="5%"
strokecolor="#1204b5"
strokeweight="2px"
fillcolor="#1204b5">
<v:stroke dashstyle="solid"/>
<w:anchorlock />
<center style="
color: #ffffff;
display: block;
font-family: 'Helvetica Neue', Helvetica, Arial, Verdana, sans-serif;
font-size: 16;
font-style: normal;
font-weight: normal;
letter-spacing: 0px;
text-decoration: none;
text-align: center;
direction: ltr;"
>
Contact Support
</center>
</v:roundrect>
</td>
<![endif]-->
																													</tr>
																												</tbody>
																											</table>
																										</td>
																									</tr>
																									<tr>
																										<td style="background-color:transparent;padding-top:20px;padding-bottom:20px;padding-right:24px;padding-left:24px" class="mceBlockContainer" valign="top">
																											<table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color:transparent" role="presentation" data-block-id="6">
																												<tbody>
																													<tr>
																														<td style="min-width:100%;border-top:2px solid #000000" valign="top"></td>
																													</tr>
																												</tbody>
																											</table>
																										</td>
																									</tr>
																									<tr>
																										<td style="padding-top:12px;padding-bottom:12px;padding-right:0;padding-left:0" class="mceLayoutContainer" valign="top">
																											<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" data-block-id="7">
																												<tbody>
																													<tr class="mceRow">
																														<td style="background-position:center;background-repeat:no-repeat;background-size:cover" valign="top">
																															<table border="0" cellpadding="0" cellspacing="24" width="100%" role="presentation">
																																<tbody>
																																	<tr>
																																		<td style="margin-bottom:24px" class="mceColumn" data-block-id="-9" valign="top" colspan="12" width="100%">
																																			<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
																																				<tbody>
																																					<tr>
																																						<td align="center" valign="top">
																																							<table border="0" cellpadding="0" cellspacing="0" width="" role="presentation" class="mceClusterLayout" data-block-id="-8">
																																								<tbody>
																																									<tr>
																																										<td style="padding-left:24px;padding-top:0;padding-right:24px" data-breakpoint="8" valign="top" class="mobileClass-8"><a href="https://www.instagram.com/easygo_gh"><img data-block-id="-5" width="40" height="auto" style="width:40px;height:auto;max-width:40px !important;display:block" alt="Facebook icon" src="https://cdn-images.mailchimp.com/icons/social-block-v3/block-icons-v3/instagram-filled-color-40.png" class="mceImage"></a></td>
																																										<td style="padding-left:24px;padding-top:0;padding-right:24px" data-breakpoint="8" valign="top" class="mobileClass-8"><a href="https://www.prototype.easygo.com.gh"><img data-block-id="-6" width="40" height="auto" style="width:40px;height:auto;max-width:40px !important;display:block" alt="Instagram icon" src="https://cdn-images.mailchimp.com/icons/social-block-v3/block-icons-v3/website-filled-color-40.png" class="mceImage"></a></td>
																																										<td style="padding-left:24px;padding-top:0;padding-right:24px" data-breakpoint="8" valign="top" class="mobileClass-8"><a href="https://www.twitter.com/easygo_gh"><img data-block-id="-7" width="40" height="auto" style="width:40px;height:auto;max-width:40px !important;display:block" alt="Twitter icon" src="https://cdn-images.mailchimp.com/icons/social-block-v3/block-icons-v3/twitter-filled-color-40.png" class="mceImage"></a></td>
																																									</tr>
																																								</tbody>
																																							</table>
																																						</td>
																																					</tr>
																																				</tbody>
																																			</table>
																																		</td>
																																	</tr>
																																</tbody>
																															</table>
																														</td>
																													</tr>
																												</tbody>
																											</table>
																										</td>
																									</tr>
																									<tr>
																										<td style="padding-top:8px;padding-bottom:8px;padding-right:8px;padding-left:8px" class="mceLayoutContainer" valign="top">
																											<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation" data-block-id="11" id="section_10c16aef7e8cdb3b68e872d8c0c18ec9" class="mceFooterSection">
																												<tbody>
																													<tr class="mceRow">
																														<td style="background-position:center;background-repeat:no-repeat;background-size:cover" valign="top">
																															<table border="0" cellpadding="0" cellspacing="12" width="100%" role="presentation">
																																<tbody>
																																	<tr>
																																		<td style="padding-top:0;padding-bottom:0;margin-bottom:12px" class="mceColumn" data-block-id="-3" valign="top" colspan="12" width="100%">
																																			<table border="0" cellpadding="0" cellspacing="0" width="100%" role="presentation">
																																				<tbody>
																																					<tr>
																																						<td style="padding-top:12px;padding-bottom:12px;padding-right:48px;padding-left:48px" class="mceBlockContainer" align="center" valign="top"><img data-block-id="8" width="130" height="auto" style="width:130px;height:auto;max-width:130px !important;display:block" alt="Logo" src="https://www.easygo.com.gh/assets/images/site_images/logo.png" class="mceLogo"></td>
																																					</tr>
																																					<tr>
																																						<td style="padding-top:12px;padding-bottom:12px;padding-right:16px;padding-left:16px" class="mceBlockContainer" align="center" valign="top">
																																							<div data-block-id="9" class="mceText" id="dataBlockId-9" style="display:inline-block;width:100%">
																																								<p class="last-child"><em><span style="font-size: 12px">Copyright (C) 2024 easyGo. All rights reserved.</span></em></p>
																																							</div>
																																						</td>
																																					</tr>
																																					<tr>
																																					</tr>
																																				</tbody>
																																			</table>
																																		</td>
																																	</tr>
																																</tbody>
																															</table>
																														</td>
																													</tr>
																												</tbody>
																											</table>
																										</td>
																									</tr>
																								</tbody>
																							</table>
																						</td>
																					</tr>
																				</tbody>
																			</table>
																		</td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table><!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]-->
										</td>
									</tr>
								</tbody>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</center>
	</body>
</body>

</html>
